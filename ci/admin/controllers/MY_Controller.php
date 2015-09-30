<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    protected $data = [];

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
            if (!$this->check_rule(strtolower($this->router->class . '/' . $this->router->method), $this->user->check_login())) {
                echo '未授权访问！';
                exit;
            }
        }
        //generate left navigation
        $allRuleList = $this->auth_rule->get_all_rule();
        foreach ($allRuleList as $k => $v) {
            if (!$this->check_rule($v['name'], $this->user->check_login())) {
                unset($allRuleList[$k]);
            }
        }
        $this->data['menuList'] = $this->generate_menu($this->auth_rule->build_all_rule_to_tree($allRuleList));
        $nodeInfo = $this->auth_rule->get_node_info($this->router->class . '/' . $this->router->method);
        $this->data['pids'] = $this->auth_rule->search_parents($allRuleList, $nodeInfo['id']) ? explode(',', $this->auth_rule->search_parents($allRuleList, $nodeInfo['id'])) : array('1', '2');
    }

    public function check_rule($rule, $uid, $type = 1, $mode = 'url') {
        static $Auth = null;
        if (!$this->auth_rule->check($rule, $uid, $type, $mode)) {
            return false;
        }
        return true;
    }

    public function generate_menu($authlist = [], $sub = false, $level = 0) {
        $numberArray = $this->auth_rule->number_array();
        $html = '';
        if (!$sub) {
            $html .= 
                '<li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </li>';
        }else{
            $html .= "<ul class=\"nav nav-" . $numberArray[$level] . "-level collapse\">";
        }
      
        foreach ($authlist as $item) {
            if (!empty($item['display'])) {
                $html .= "<li><a href=\"" . ((empty($item['displayChild'])) ? site_url($item['name']) : '#') . 
                    "\"><i class=\"fa " . $item['class'] . "\"></i> " . $item['title'];
                if (!empty($item['displayChild'])) {
                    $html .= "<span class=\"fa arrow\"></span>";
                }
                $html .= "</a>";
                if (!empty($item['displayChild'])) {
                    $html .= $this->generate_menu($item['sub'], true, $item['level'] + 1);
                }
                $html .= "</li>";
            }
        }
        if ($sub) {
            $html .= "</ul>";
        }
        return $html ;
    }
     
}
