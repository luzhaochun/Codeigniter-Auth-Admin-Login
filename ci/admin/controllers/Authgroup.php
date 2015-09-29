<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


require_once 'MY_Controller.php';

class Authgroup extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('auth_group');
        $this->load->model('auth_group_access');
        $this->load->model('auth_rule');
        $this->load->library('form_validation');
        $this->load->helper('string');
        $this->load->library('pagination');
    }

    public function index() {
        $this->load->model('auth_group');
        $data['list'] = $this->auth_group->get_group_list();
        $data['msg'] = '';
        $data['status'] = '';
        $this->layout->view('auth/index', $data);
    }

    public function checkRoleNameUnique() {
        if (empty($this->input->get('title')))
            ajax_return(false);
        $title = $this->input->get('title');
        $type = $this->input->get('type');
        $id = $this->input->get('id');
        $result = $this->auth_group->get_role_info($title, $type, $id);
        if (!empty($result))
            ajax_return(false);
        ajax_return(true);
    }

    public function addRole() {
        $this->form_validation->set_rules('title', 'Title', 'required');
        if ($this->form_validation->run()) {
            $data['title'] = $this->input->post('title');
            $data['status'] = 1;
            $data['rules'] = '';
            $result = $this->db->insert('auth_group', $data);
            if ($result) {
                redirect('Authgroup/index');
            } else {
                $data['msg'] = '新增失败!';
                $data['status'] = 'error';
            }
        } else {
            $data['msg'] = '新增失败!';
            $data['status'] = 'error';
        }
        $this->load->model('auth_group');
        $data['list'] = $this->auth_group->get_group_list();
        $this->layout->view('auth/index', $data);
    }

    public function editRole() {
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('id', 'Id', 'required');
        if ($this->form_validation->run()) {
            $data = array(
                'title' => $this->input->post('title'),
            );
            $this->db->where('id', $this->input->post('id'));
            $result = $this->db->update('auth_group', $data);
            if ($result) {
                redirect('Authgroup/index');
            } else {
                $data['msg'] = '更新失败!';
                $data['status'] = 'error';
            }
        } else {
            $data['msg'] = '新增失败!';
            $data['status'] = 'error';
        }
        $this->load->model('auth_group');
        $data['list'] = $this->auth_group->get_group_list();
        $this->layout->view('auth/index', $data);
    }

    public function getRoleInfo() {
        $res = $this->auth_group->get_role_info_by_id($this->input->get('id'));
        ajax_return($res);
    }

    public function delRole() {
        $res = $this->db->delete('auth_group', ['id' => $this->input->get('id')]);
        redirect('Authgroup/index');
    }

    public function menuList() {
        //get all menu list
        $list = $this->auth_rule->showTreeRule($this->auth_rule->buildAllRuleToTree($this->auth_rule->get_all_rule(), 0, 0));
        $data['list'] = $list;
        $this->layout->view('auth/menuList', $data);
    }

    public function addMenu() {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('sort', 'Sort', 'required');
        if ($this->form_validation->run()) {
            $data = array(
                'name' => $this->input->post('name'),
                'title' => $this->input->post('title'),
                'display' => $this->input->post('display'),
                'sort' => $this->input->post('sort'),
                'class' => $this->input->post('class'),
                'parent_id' => $this->input->post('parent_id'),
            );
            $result = $this->db->insert('auth_rule', $data);
            if ($result) {
                redirect('Authgroup/menuList');
            } else {
                //fix me
            }
        } else {
            //fix me
        }
    }

    public function editMenu() {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('sort', 'Sort', 'required');

        if ($this->form_validation->run()) {
            $data = array(
                'name' => $this->input->post('name'),
                'title' => $this->input->post('title'),
                'display' => $this->input->post('display'),
                'sort' => $this->input->post('sort'),
                'class' => $this->input->post('class'),
                'parent_id' => $this->input->post('parent_id'),
            );
            $this->db->where('id', $this->input->post('id'));
            $result = $this->db->update('auth_rule', $data);
            if ($result) {
                redirect('Authgroup/menuList');
            } else {
                //fix me
            }
        } else {
            //fix me
        }
    }

    public function delMenu() {
        $this->db->where('id', $this->input->get('id'));
        $result = $this->db->update('auth_rule', ['status' => 0]);
        if ($result) {
            echo 1;
            exit;
        } else {
            echo 0;
            exit;
        }
    }

    public function checkMenuModuleUnique() {
        
    }

    public function getMenuInfoById() {
        $res = $this->auth_rule->get_menu_info_by_id($this->input->get('id'));
        ajax_return($res);
    }

    public function scanAdmin() {
        //get current role user list
        $id = $this->input->get('id');
        $behaveMemberIds = $this->auth_group_access->getBehaveMemberIds($id);
        $cur_page = (int) $this->uri->segment(4);
        //pagination initialize
        $config['per_page'] = 10;
        $config['cur_page'] = $cur_page;
        $config['total_rows'] = $this->user->get_users_total();
        $config['base_url'] = site_url('Authgroup/scanAdmin');
        $this->pagination->initialize($config);
        $this->data['pageLinks'] = $this->pagination->create_links();

        $list = $this->user->get_users($config['per_page'], $config['cur_page']);
        foreach ($list as &$v) {
            $v['flag'] = in_array($v['id'], $behaveMemberIds);
        }
        $this->data['list'] = $list;
        $this->data['role_list'] = $this->auth_group->group_list();

        $this->load->view('auth/scanAdmin', $this->data);
    }

    public function authList() {
        $id = $this->input->get('id');
        $list = $this->auth_rule->get_all_rule();
        $authRuleIds = $this->auth_group->getAuthRuleIds($id);
        foreach ($list as &$v) {
            if (in_array($v['id'], $authRuleIds)) {
                $v['flag'] = 1;
            }
        }
        //make list to tree
        $this->data['list'] = $this->auth_rule->showTreeRule($this->auth_rule->buildAllRuleToTree($list, 0, 0));
        $this->data['id'] = $id;
        $this->load->view('auth/authList', $this->data);
    }

    public function editAuth() {
        $addRuleIds = $this->input->post('addRuleIds');
        $allRuleIds = $this->input->post('allRuleIds');
        $id = $this->input->post('id');
        foreach ($allRuleIds as $v) {
            $this->auth_group->updateAuthRule($id, $v, in_array($v, $addRuleIds));
        }
        redirect('Authgroup/authList?id='.$id);
    }
}
