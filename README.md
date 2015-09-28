# Codeigniter-login-auth-admin
codeigniter 实现登陆 后台auth权限 管理员管理

项目文件请参考 根目录下的CI文件夹


个人娱乐，使用CI框架进行开发一个含有登陆，auth权限验证，后台管理员管理登陆的简单项目
1：数据库结构如下（使用mysql）
/*
 Navicat Premium Data Transfer

 Source Server         : mysql_localhot
 Source Server Type    : MySQL
 Source Server Version : 50624
 Source Host           : localhost
 Source Database       : codeigniter

 Target Server Type    : MySQL
 Target Server Version : 50624
 File Encoding         : utf-8

 Date: 09/28/2015 17:07:46 PM
*/

SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `auth_group`
-- ----------------------------
DROP TABLE IF EXISTS `auth_group`;
CREATE TABLE `auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` varchar(256) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `auth_group_access`
-- ----------------------------
DROP TABLE IF EXISTS `auth_group_access`;
CREATE TABLE `auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `auth_rule`
-- ----------------------------
DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  `parent_id` mediumint(8) DEFAULT '0',
  `sort` mediumint(8) DEFAULT '1',
  `display` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:显示  0：不显示',
  `class` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` char(100) DEFAULT NULL,
  `mobile` char(15) DEFAULT NULL,
  `reg_ip` varchar(15) DEFAULT NULL,
  `reg_time` int(10) DEFAULT NULL,
  `last_login_time` int(10) DEFAULT NULL,
  `last_login_ip` varchar(15) DEFAULT NULL,
  `login_count` int(11) DEFAULT NULL,
  `update_time` int(10) DEFAULT NULL,
  `status` enum('1','0') DEFAULT '1' COMMENT '1：激活 0：禁用',
  `del` enum('0','1') DEFAULT '0' COMMENT '1:删除',
  `role` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;

2:了解该项目主要是如何熟悉一个新框架的工作原理，如果快速开发，怎样搭建一个项目。
1）：框架的layout（网上查找，主要有两种方式，比较方便是通过写layout类），如下：admin/libraries/Layout.php

在Controller中定义公共类My_Controller继承CI_Controller，在构造函数中直接加载,如下：admin/controllers/MY_Controller.php

2）：在ci如何加载css,js，image等等公共文件，在对应的模块中helper中可以扩展url，我的扩展如下（我是使用bootstrap进行搭建后台）：admin/helpers/MY_url_helper.php

3）：在layout定义layout视图文件，具体看code
注意：加载url中助手类中自定义方法，需要$this->load->helper('url');例如
<?php echo css_url('/jquery-ui.min.css');?>
<?php echo bootstrap_url('/bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>
<?php echo bootstrap_url('/bower_components/jquery/dist/jquery.min.js','javascript'); ?>

3，具体的ci项目是如何进行工作，参考codeigniter手册以及项目代码

4，时间匆忙，也属于学习ci框架阶段，可能有错误或者code有问题的地方，尽请谅解，后面继续完善


