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
    protected $_config = array(
        'AUTH_ON' => true, // 认证开关
        'AUTH_TYPE' => 1, // 认证方式，1为实时认证；2为登录认证。
        'AUTH_GROUP' => 'auth_group', // 用户组数据表名
        'AUTH_GROUP_ACCESS' => 'auth_group_access', // 用户-用户组关系表
        'AUTH_RULE' => 'auth_rule', // 权限规则表
        'AUTH_USER' => 'member'             // 用户信息表
    );
    protected $config;
    protected $CI;

    public function __construct() {
        parent::__construct();
        $this->CI = &get_instance();
        $this->config = &get_config();
        $prefix = $this->CI->db->dbprefix;
        $this->_config['AUTH_GROUP'] = $prefix . $this->_config['AUTH_GROUP'];
        $this->_config['AUTH_RULE'] = $prefix . $this->_config['AUTH_RULE'];
        $this->_config['AUTH_USER'] = $prefix . $this->_config['AUTH_USER'];
        $this->_config['AUTH_GROUP_ACCESS'] = $prefix . $this->_config['AUTH_GROUP_ACCESS'];
        if ($this->config['auth_config']) {
            //可设置配置项 AUTH_CONFIG, 此配置项为数组。
            $this->_config = array_merge($this->_config, $this->config['auth_config']);
        }
    }

    /**
     * 检查权限
     * @param name string|array  需要验证的规则列表,支持逗号分隔的权限规则或索引数组
     * @param uid  int           认证用户的id
     * @param string mode        执行check的模式
     * @param relation string    如果为 'or' 表示满足任一条规则即通过验证;如果为 'and'则表示需满足所有规则才能通过验证
     * @return boolean           通过验证返回true;失败返回false
     */
    public function check($name, $uid, $type = 1, $mode = 'url', $relation = 'or') {

        if (!$this->_config['AUTH_ON'])
            return true;
        $authList = $this->getAuthList($uid, $type); //获取用户需要验证的所有有效规则列表
        if (is_string($name)) {
            $name = strtolower($name);
            if (strpos($name, ',') !== false) {
                $name = explode(',', $name);
            } else {
                $name = array($name);
            }
        }
        $list = array(); //保存验证通过的规则名
        if ($mode == 'url') {
            $REQUEST = unserialize(strtolower(serialize($_REQUEST)));
        }
        foreach ($authList as $auth) {
            $query = preg_replace('/^.+\?/U', '', $auth);
            if ($mode == 'url' && $query != $auth) {
                parse_str($query, $param); //解析规则中的param
                $intersect = array_intersect_assoc($REQUEST, $param);
                $auth = preg_replace('/\?.*$/U', '', $auth);
                if (in_array($auth, $name) && $intersect == $param) {  //如果节点相符且url参数满足
                    $list[] = $auth;
                }
            } else if (in_array($auth, $name)) {
                $list[] = $auth;
            }
        }
        if ($relation == 'or' and ! empty($list)) {
            return true;
        }
        $diff = array_diff($name, $list);
        if ($relation == 'and' and empty($diff)) {
            return true;
        }
        return false;
    }

    /**
     * 根据用户id获取用户组,返回值为数组
     * @param  uid int     用户id
     * @return array       用户所属的用户组 array(
     *                                         array('uid'=>'用户id','group_id'=>'用户组id','title'=>'用户组名称','rules'=>'用户组拥有的规则id,多个,号隔开'),
     *                                         ...)   
     */
    public function getGroups($uid) {
        static $groups = array();
        if (isset($groups[$uid]))
            return $groups[$uid];
        $this->db->select('auth_group.rules');
        $this->db->from('auth_group_access');
        $this->db->join('auth_group', 'auth_group.id = auth_group_access.group_id');
        $this->db->where('auth_group_access.uid', $uid);
        $this->db->where('auth_group.status', 1);
        $query = $this->db->get();
        $user_groups = $query->result_array();
        $groups[$uid] = $user_groups? : [];
        return $groups[$uid];
    }

    /**
     * 获得权限列表
     * @param integer $uid  用户id
     * @param integer $type 
     */
    protected function getAuthList($uid, $type) {
        static $_authList = array(); //保存用户验证通过的权限列表
        $t = implode(',', (array) $type);
        if (isset($_authList[$uid . $t])) {
            return $_authList[$uid . $t];
        }
        if ($this->_config['AUTH_TYPE'] == 2 && isset($_SESSION['_AUTH_LIST_' . $uid . $t])) {
            return $_SESSION['_AUTH_LIST_' . $uid . $t];
        }

        //读取用户所属用户组
        $groups = $this->getGroups($uid);
        $ids = array(); //保存用户所属用户组设置的所有权限规则id
        foreach ($groups as $g) {
            $ids = array_merge($ids, explode(',', trim($g['rules'], ',')));
        }
        $ids = array_unique($ids);
        if (empty($ids)) {
            $_authList[$uid . $t] = array();
            return array();
        }

        $map = array(
            'id' => array('in', $ids),
            'type' => $type,
            'status' => 1,
        );
        //读取用户组所有权限规则
        $this->db->select('condition,name');
        $this->db->from('auth_rule');
        $this->db->where_in('id', $ids);
        $this->db->where('type', $type);
        $this->db->where('status', 1);
        $query = $this->db->get();
        $rules = $query->result_array();
        //循环规则，判断结果。
        $authList = array();   //
        foreach ($rules as $rule) {
            if (!empty($rule['condition'])) { //根据condition进行验证
                $user = $this->getUserInfo($uid); //获取用户信息,一维数组

                $command = preg_replace('/\{(\w*?)\}/', '$user[\'\\1\']', $rule['condition']);
                //dump($command);//debug
                @(eval('$condition=(' . $command . ');'));
                if ($condition) {
                    $authList[] = strtolower($rule['name']);
                }
            } else {
                //只要存在就记录
                $authList[] = strtolower($rule['name']);
            }
        }
        $_authList[$uid . $t] = $authList;
        if ($this->_config['AUTH_TYPE'] == 2) {
            //规则列表结果保存到session
            $_SESSION['_AUTH_LIST_' . $uid . $t] = $authList;
        }
        return array_unique($authList);
    }

    /**
     * 获得用户资料,根据自己的情况读取数据库
     */
    protected function getUserInfo($uid) {
        static $userinfo = array();
        if (!isset($userinfo[$uid])) {
            $this->db->select('*');
            $this->db->from('user');
            $this->db->where('id', $uid);
            $query->db->get();
            $userinfo[$uid] = $query->row_array();
        }
        return $userinfo[$uid];
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
            $i = 0;
            foreach ($newList[$k]['sub'] as $item) {
                if($item['display'] == 1){
                    $i++;
                }
            }
            $newList[$k]['displayChild'] = $i;
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
        for ($i = 0; $i < $num; $i++) {
            if ($i % 6 == 0) {
                $prefix .= '│';
            } else {
                $prefix .= '&nbsp;';
            }
        }
        return $prefix . ($end ? '└─' : '├─');
    }

    public function get_menu_info_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        return $query->row_array();
    }

    public function getnerate_menu($rulelist = []) {
        
    }

    public function searchParents($allRuleList, $id) {
        foreach ($allRuleList as $node) {
            if ($node['id'] == $id) {
                if ($node['parent_id'] != '0') {
                    $pid = $node['parent_id'];
                    $searchPid = $this->searchParents($allRuleList, $node['parent_id']);
                    $pid = ($searchPid ? $searchPid . ',' : '') . $pid;
                    return $pid;
                } else {
                    return '';
                }
            }
        }
    }
    
    public function get_node_info($name = ''){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('name',$name);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function numberArray(){
        //if left navigation has more level,you can fix this array,just control class
        return [0=>'',1=>'second',2=>'third',3=>'fourth',4=>'fifth'];
    }
}
