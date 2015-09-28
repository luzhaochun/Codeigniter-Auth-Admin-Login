<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class auth_group extends CI_Model {

    protected $table = 'auth_group';

    public function __construct() {
        parent::__construct();
    }

    public function get_group_list() {
        $this->db->where('status', 1);
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    public function get_role_info($title, $type = 'add', $id) {
        if ($type == 'add') {
            $this->db->where('title', $title);
        } else {
            $this->db->where('title', $title)->where('id !=', $id);
        }
        $query = $this->db->get($this->table);
        return $query->row_array();
    }

    public function get_role_info_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        return $query->row_array();
    }

    public function group_list() {
        $temp = [];
        $this->db->where('status', 1);
        $query = $this->db->get($this->table);
        $res = $query->result_array();
        if (sizeof($res) > 0) {
            foreach ($res as $key => $value) {
                $temp[$value['id']] = $value['title'];
            }
        }
        return $temp;
    }
    
     /**
     * 该权限组下的权限id
     * @param int $authGroupId
     * @return array(ruleIds):
     */
    public function getAuthRuleIds($authGroupId) {
        $this->db->where('id',$authGroupId);
        $query = $this->db->get($this->table);
        $res = $query->row_array();
        
        if (!empty($res)) {
            return explode(',', $res['rules']);
        }
        return [];
    }
   
    /**
    * 更新权限组
    */
    public function updateAuthRule($authGroupId, $authRuleId, $add = true) {
        $authRuleIds = $this->getAuthRuleIds($authGroupId);
        if ($add) {
            if (!in_array($authRuleId, $authRuleIds)) {
                $authRuleIds[] = $authRuleId;
            }
        } else {
            if ($index = array_search($authRuleId, $authRuleIds)) {
                unset($authRuleIds[$index]);
            }
        }
        $authRuleIds = implode(',', $authRuleIds);
        $data = ['rules'=>$authRuleIds];
        $this->db->where('id', $authGroupId);
        $this->db->update($this->table,$data);
    }
   
}
