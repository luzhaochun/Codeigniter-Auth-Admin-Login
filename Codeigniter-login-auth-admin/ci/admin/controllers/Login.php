<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller{
    var $data = [];
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('user');
        $this->load->helper('url');
        $this->load->helper('cookie');
    }
    public function index(){
        if($this->user->is_logged_in()){
            redirect('index');
        }
        $this->load->view('login');  
    }
    
    public function checkLogin(){
        if($this->user->is_logged_in()){
            redirect('index');
        }
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if($this->form_validation->run()){
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            if($row = $this->user->get_by_username($username)){
                if($this->user->check_password($password,$row['password'])){
                    $this->user->allow_pass($row);
                    if(!empty($this->input->post('remember'))){
//                        $this->input->set_cookie("username",$row['username'],3600*24*7);
//                        $this->input->set_cookie("password",$row['password'],3600*24*7);
//                        $this->input->set_cookie("user_id",$row['id'],3600*24*7);
                        set_cookie("user_id",$this->session->userdata('logged_in'),3600*24*7);
                        set_cookie("username",$this->session->userdata('user'),3600*24*7);
//                        set_cookie("password",$row['password'],3600*24*7);
//                        set_cookie("user_id",$row['id'],3600*24*7);
                    }
                    redirect('index');
                }else{
                    $this->data['error'] = 'Invalid username or password';
                }
            }else{
                $this->data['error'] = 'Username not found';
            }
        }
        $this->load->view('login', $this->data);
    }
    
    public function logout(){
        $this->user->remove_pass();
        $this->load->view('login');
    }
}

