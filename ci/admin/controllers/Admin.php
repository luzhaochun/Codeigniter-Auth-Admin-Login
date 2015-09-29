<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


require_once 'MY_Controller.php';

class Admin extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('auth_group');
        $this->load->model('auth_group_access');
        $this->load->model('user');
        $this->load->helper('string');
        $this->load->library('form_validation');
    }
    
    public function index(){
        $this->data['group'] = $this->auth_group->group_list();
        $this->data['userlist'] = $this->user->userList();
        $this->layout->view('Admin/index',$this->data);
    }
    
    public function add(){
        $this->form_validation->set_rules('username', 'Username', 'required');
        if ($this->form_validation->run()) {
            $data['username'] = $this->input->post('username');
            $data['email'] = $this->input->post('email');
            $data['mobile'] = $this->input->post('mobile');
            $data['reg_ip'] = get_client_ip();
            $data['reg_time'] = strtotime(date('Y-m-d H:i:s'));
            if(!empty($this->input->post('password'))){
                $data['password'] = $this->user->hash_password($this->input->post('password'));
            }
            $data['role'] = $this->input->post('role');
            $result = $this->db->insert('user', $data);
            
            if ($result) {
                //add new data to auth group access
                $map['uid'] = $this->db->insert_id();
                $map['group_id'] = $this->input->post('role');
                $this->db->insert('auth_group_access', $map);
                redirect('Admin/index');
            } else {
                $this->data['msg'] = '新增失败!';
                $this->data['status'] = 'error';
            }
        } else {
            $this->data['msg'] = '新增失败!';
            $this->data['status'] = 'error';
        }
        $this->load->model('auth_group');
        $this->data['list'] = $this->auth_group->get_group_list();
        $this->layout->view('Admin/index', $this->data);
    }
    
    public function getAdminInfoById(){
        $res = $this->user->get_admin_info_by_id($this->input->get('id'));
        ajax_return($res);
    }
    
    public function edit(){
        $this->form_validation->set_rules('username', 'Username', 'required');
        if ($this->form_validation->run()) {
            $data['username'] = $this->input->post('username');
            $data['email'] = $this->input->post('email');
            $data['mobile'] = $this->input->post('mobile');
            $data['role'] = $this->input->post('role');
            if(!empty($this->input->post('password'))){
                $data['password'] = $this->user->hash_password($this->input->post('password'));
            }
            $this->db->where('id', $this->input->post('id'));
            $result = $this->db->update('user', $data);
            if ($result) {
                //update auth group access
                $this->auth_group_access->updateAccess($this->input->post('id'),$this->input->post('role'));
                redirect('Admin/index');
            } else {
                $this->data['msg'] = '新增失败!';
                $this->data['status'] = 'error';
            }
        } else {
            $this->data['msg'] = '新增失败!';
            $this->data['status'] = 'error';
        }
        $this->load->model('auth_group');
        $data['list'] = $this->auth_group->get_group_list();
        $this->layout->view('Admin/index', $this->data);
    }
    
    
    public function del(){
        $res = $this->db->delete('user', ['id' => $this->input->get('id')]);
        redirect('Admin/index');
    }
    
}