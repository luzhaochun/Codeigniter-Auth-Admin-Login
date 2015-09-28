<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('ajax_return')) {

    function ajax_return($data, $type = 'JSON') {
        
        switch (strtoupper($type)) {
            case 'JSON' :
                // 返回JSON数据格式到客户端 包含状态信息
                header('Content-Type:application/json; charset=utf-8');
                exit(json_encode($data));
            case 'XML' :
                // 返回xml格式数据
                header('Content-Type:text/xml; charset=utf-8');
                exit(xml_encode($data));
            case 'JSONP':
                // 返回JSON数据格式到客户端 包含状态信息
                header('Content-Type:application/json; charset=utf-8');
                $handler = isset($_GET['callback']) ? $_GET['callback'] : 'jsonpReturn';
                exit($handler . '(' . json_encode($data) . ');');
            case 'EVAL' :
                // 返回可执行的js脚本
                header('Content-Type:text/html; charset=utf-8');
                exit($data);
            default :
                // 返回JSON数据格式到客户端 包含状态信息
                header('Content-Type:application/json; charset=utf-8');
                exit(json_encode($data));
        }
    }
    

}

    function get_client_ip(){
        if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
            $ip = getenv("HTTP_CLIENT_IP");
        else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
            $ip = getenv("REMOTE_ADDR");
        else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
            $ip = $_SERVER['REMOTE_ADDR'];
        else
            $ip = "unknown";
        return($ip);
    }
    /**
     * 获取客户端IP地址
     * @return String
     */
    function generate_csv($data_title,$data,$file_path_name=''){
        if(empty($file_path_name)){
            $file_path = DOCROOT.'var'.DIRECTORY_SEPARATOR;
            $file_name = 'default_csv.csv';
        }else{
            $file_path = substr($file_path_name,0,strrpos($file_path_name,DIRECTORY_SEPARATOR) + 1);
            $file_name = substr($file_path_name,strrpos($file_path_name,DIRECTORY_SEPARATOR) + 1);
        }
        if(!is_dir($file_path)){
            mkdir($file_path,0600);
        }
        $is_have_title_now = file_exists($file_path.$file_name);
        $handle = fopen($file_path.$file_name,'a');
        foreach($data as $key => $item){
            //写头部
            if(!$is_have_title_now){
                $title_array = array();
                foreach($data_title as $write_key=>$write_title){
                    if($write_key == 'sub_info') continue;
                    $title_array[] = $write_title;
                }
                fputcsv($handle, array_map(create_function('$item','return iconv(\'UTF-8\', \'GBK//IGNORE\', $item);'),$title_array));
                $is_have_title_now = true;
            }
            $line_data_array = array();
            foreach($data_title as $write_key=>$write_title){
                if($write_key == 'sub_info') continue;
                $line_data_array[] = isset($item[$write_key]) ? $item[$write_key] : '';
            }
            fputcsv($handle, array_map(create_function('$item','return iconv(\'UTF-8\', \'GBK//IGNORE\', $item);'),$line_data_array));
            if(isset($data_title['sub_info'])){
                foreach($data_title['sub_info'] as $keys_str=>$sub_info_title){
                    fputcsv($handle, array_map(create_function('$item','return iconv(\'UTF-8\', \'GBK//IGNORE\', $item);'),$sub_info_title));
                    $keys_str = '$sub_info_data = $item["'.str_replace('/','"]["',$keys_str).'"];';
                    eval($keys_str);
                    if(!empty($sub_info_data)){
                        foreach($sub_info_data as $sub_item){
                            $write_sub_data_array = array();
                            foreach($sub_info_title as $sub_info_title_key=>$sub_info_title_val){
                                $write_sub_data_array[] = isset($sub_item[$sub_info_title_key]) ? $sub_item[$sub_info_title_key] : '';
                            }
                            fputcsv($handle, array_map(create_function('$item','return iconv(\'UTF-8\', \'GBK//IGNORE\', $item);'),$write_sub_data_array));
                        }
                    }
                }
            }
        }
    }
