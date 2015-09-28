<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class auth_group_access extends CI_Model{
    
    protected $table = 'auth_group_access';
    
    public function __construct() {
        parent::__construct();
    }
    //fix me...
    public function updateAccess($uid,$role_id){
        //first check data exist
        $this->db->where('uid',$uid);
        $query = $this->db->get($this->table);
        if(sizeof($query->row_array())>0){
            $this->db->where('uid',$uid);
            $this->db->update($this->table,['group_id'=>$role_id]);
        }else{
            $data['uid'] = $uid;
            $data['group_id'] = $role_id;
            $this->db->insert($this->table,$data);
        }
    }
    
     public function getBehaveMemberIds($authGroupId) {
        $this->db->where('group_id', $authGroupId);
        $query = $this->db->get($this->table);
        $behaveMemberIds = $query->result_array();
        $tmp = [];
        if (!empty($behaveMemberIds)) {
            foreach ($behaveMemberIds as $v) {
                $tmp[] = $v['uid'];
            }
        }
        return [$tmp, []][empty($tmp)];
    }
}