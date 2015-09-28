<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'MY_Controller.php';
class Index extends MY_Controller {
    
    public function __construct() {
        
        parent::__construct();
        //加载layouts下的main文件，可以写其他的布局文件，如$this->load->library('layout',array('hello'));
        //表示加载layouts下的hello布局文件，默认$this->load->library('layout')不传参表示加载默认的布局文件，
        //在layout扩展类的构造方法中已经设置了默认参数main
        //$this->load->library('layout',array('main'));
    }

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {
        //$data['test'] = 'ci模拟layout';        
        $this->layout->view('index/index');   
    }
}
