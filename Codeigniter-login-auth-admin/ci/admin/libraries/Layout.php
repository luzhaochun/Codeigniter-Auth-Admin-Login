<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Layout {

    public $layout;

    function __construct($params = array('main')) {
        //本来是想在controller中加载这个类的时候顺便给构造函数传参设置要加载的布局文件，
        //结果看文档好像$this -> load -> library('**','**')的第二个参数必须得是数组才能给构造函数传参，
        //也许可以传字符串吧，有时间我再试试
        $this->layout = 'layouts' . DIRECTORY_SEPARATOR . $params[0];
    }

    function view($view, $data = null, $flag = false) {
        $ci = &get_instance();
        $data['content'] = $ci->load->view($view, $data, true); 
        //这里的第三个参数true代表不输出，如果是false就会输出，默认是false，
        //和thinkphp里的display和assign类似，这里用第三个参数来控制
        if ($flag) {
            $view = $ci->load->view($this->layout, $data, true);
            return $view;
        } else {
            $ci->load->view($this->layout, $data, false);
        }
    }

}
?>