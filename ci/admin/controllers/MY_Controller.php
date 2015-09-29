<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public $data = [];

    function __construct() {
        parent::__construct();
        $this->load->model('user');
        $this->load->helper('url');
        if (!$this->user->is_logged_in()) {
            redirect('Login');
        }
        $this->load->model('auth_rule');
        $this->load->library('Layout', array('main'));
        //check auth
        if (!in_array(strtolower($this->router->class . '/' . $this->router->method), $this->config->item('not_all_auth_check'))) {
            if (!$this->checkRule(strtolower($this->router->class . '/' . $this->router->method), $this->user->check_login())) {
                echo '未授权访问！';exit;
            }
        }
        //generate left navigation
        $this->data['list'] = '11';
    }
    
    public function checkRule($rule, $uid, $type=1, $mode='url') {
        static $Auth = null;
        if(!$this->auth_rule->check($rule, $uid, $type, $mode)) {
            return false;
        }
        return true;
    }

}
