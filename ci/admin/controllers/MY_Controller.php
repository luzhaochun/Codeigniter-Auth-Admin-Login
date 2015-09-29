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
            if (!$this->checkRule(strtolower($this->router->class . '/' . $this->router->method), $this->user->check_login())) {
                echo '未授权访问！';
                exit;
            }
        }
        //generate left navigation
        $allRuleList = $this->auth_rule->get_all_rule();
        foreach ($allRuleList as $k => $v) {
            if (!$this->checkRule($v['name'], $this->user->check_login())) {
                unset($allRuleList[$k]);
            }
        }
        $this->data['menuList'] = $this->auth_rule->buildAllRuleToTree($allRuleList);
        $nodeInfo = $this->auth_rule->get_node_info($this->router->class . '/' . $this->router->method);
        //print_r($nodeInfo);
        $this->data['pids'] = $this->auth_rule->searchParents($allRuleList, $nodeInfo['id']) ? explode(',', $this->auth_rule->searchParents($allRuleList, $nodeInfo['id'])) : array('1','2');
        //print_r($pids);exit;
    }

    public function checkRule($rule, $uid, $type = 1, $mode = 'url') {
        static $Auth = null;
        if (!$this->auth_rule->check($rule, $uid, $type, $mode)) {
            return false;
        }
        return true;
    }

}
