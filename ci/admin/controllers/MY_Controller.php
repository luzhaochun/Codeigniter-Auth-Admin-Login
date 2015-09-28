<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    protected $_data = [];

    function __construct() {
        parent::__construct();
        $this->load->model('user');
        $this->load->helper('url');
        $this->load->library('Layout', array('main'));
        if (!$this->user->is_logged_in()) {
            redirect('Login');
        }
    }
    
    function pagenation(){
        
    }
}
