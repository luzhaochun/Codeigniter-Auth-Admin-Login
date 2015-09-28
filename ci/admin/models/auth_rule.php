<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class auth_rule extends CI_Model {

    protected $table = 'auth_rule';

    public function __construct() {
        parent::__construct();
    }

    public function get_all_rule() {
        $this->db->where('status', 1);
        $this->db->order_by('sort desc');
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    public function buildAllRuleToTree($allRuleList, $pid = 0, $level = 0) {
        $newList = [];
        foreach ($allRuleList as $v) {
            if ($v['parent_id'] == $pid) {
                $v['level'] = $level;
                $newList[] = $v;
            }
        }
        foreach ($newList as $k => $v) {
            $newList[$k]['hasChild'] = count($this->buildAllRuleToTree($allRuleList, $v['id'], $level + 1));
            $newList[$k]['sub'] = $this->buildAllRuleToTree($allRuleList, $v['id'], $level + 1);
        }
        return $newList;
    }

    public function showTreeRule($treeRuleList) {
        $newList = array();
        foreach ($treeRuleList as $k => $v) {
            $sub = $v['sub'];
            unset($v['sub']);
            $v['nodeName'] = !empty($v['nodeName']) ? $v['nodeName'] : $this->getPrefixFromLevel($v['level'], (count($treeRuleList) - 1) == $k) . $v['title'];
            $newList[] = $v;
            if (!empty($sub)) {
                $tmpNewList = $this->showTreeRule($sub);
                foreach ($tmpNewList as $tmpk => $tmpv) {
                    $tmpv['nodeName'] = $tmpv['nodeName'] ? $tmpv['nodeName'] :
                            $this->getPrefixFromLevel($tmpv['level'], (count($tmpNewList) - 1) == $tmpk) . $tmpv['name'];
                    $newList[] = $tmpv;
                }
            }
        }
        return $newList;
    }
    
    public function getPrefixFromLevel($level, $end = false) {
        $prefix = "";
        $num = $level * 6;
        for($i=0; $i < $num; $i++) {
            if ($i % 6 == 0) {
                $prefix .= '│';
            } else {
                $prefix .= '&nbsp;';
            }
        }
        return $prefix . ($end ? '└─' : '├─');
    }
    
    public function get_menu_info_by_id($id){
        $this->db->where('id',$id);
        $query = $this->db->get($this->table);
        return $query->row_array();
    }

}
