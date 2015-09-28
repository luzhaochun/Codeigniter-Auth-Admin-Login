<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class user extends CI_Model{
    protected $table = 'user';
    protected $max_idle_time = 300; // allowed idle time in secs, 300 secs = 5 minute
    
    public function __construct() {
        parent::__construct();
    }
    
    
    function get_by_username($username){
        //$this->db->last_query(); get last query way
        if(!empty($username)){
            $this->db->where('username',$username);
            $this->db->or_where('email',$username);
            $this->db->or_where('mobile',$username);
            $query = $this->db->get($this->table,1);
            if($query->num_rows()>0){
                return $query->row_array();
            }else{
                return false;
            }
        }
        return false;
    }
    
    function check_password($password,$hash_password){
        list($salt,$hash) = explode('.', $hash_password);
        $hash2 = $salt .'.'.md5($salt.$password);
        return ($hash_password == $hash2);
    }
    
    function allow_pass($user_data){
        $this->session->set_userdata(array('logged_in' => 'yes', 'user' => $user_data));
    }
    // Generate hashed password
    function hash_password($password) {
        $salt = $this->generate_salt();
        return $salt . '.' . md5($salt . $password);
    }
    // create salt for password hashing
    private function generate_salt($length = 10) {
        $characterList = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $i = 0;
        $salt = "";
        while ($i < $length) {
            $salt .= $characterList{mt_rand(0, (strlen($characterList) - 1))};
            $i++;
        }
        return $salt;
    }
    
    function is_logged_in(){
        $logged_in = $this->session->userdata('logged_in');
        $user = $this->session->userdata('user');
        if($logged_in == 'yes'){
            $this->allow_pass($user);
            return true;
        }else{
            $this->remove_pass();
            return false;
        }
    }
    
    function remove_pass() {
        $this->session->unset_userdata('user');
        $this->session->unset_userdata('logged_in','');
    }
    
    public function userList(){
        $this->db->where('status',1);
        $query = $this->db->get($this->table);
        return $query->result_array();
    }
    
    public function get_admin_info_by_id($id){
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        return $query->row_array();
    }
    
    public function get_users_total($where = []){
        $this->db->from($this->table);
        if (!empty($where['username']))
            $this->db->like('username', $where['username']);
        if (!empty($where['email']))
            $this->db->like('email', $where['email']);
        return $this->db->count_all_results();
    }
    
    function get_users($per_page = 0, $cur_page = 0, $where = []) {
        if (!empty($where['username']))
            $this->db->like('username', $where['username']);
        if (!empty($where['email']))
            $this->db->like('email', $where['email']);
        
        $this->db->limit($per_page, $cur_page);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            return $result;
        } else {
            return array();
        }
    }
    
}