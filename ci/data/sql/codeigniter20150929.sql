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

 Date: 09/29/2015 17:55:51 PM
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
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `auth_group`
-- ----------------------------
BEGIN;
INSERT INTO `auth_group` VALUES ('1', '?????', '1', '1,2,3,4,6,5,26,7,8,13,10,11,12,14,28,30,27,29,31,32,33,34'), ('2', '?????', '1', ',2,3,5,26,6,7,8,4,13,10,11,12,14,15,16,17,18,19,20,21,22,23,24,25,1'), ('3', '?????', '1', ',2,3,5,26,6,7,8,4,13,10,11,12,14'), ('4', '?????', '1', ',1,2,3,5,26,6,7,8,4,13,10,11,12,14,15,16,17,18,19,20,21,22,23,24,25'), ('5', '?????', '1', ',1,2,3,5,26,6,7,8,4,13,10,11,12,14,15,16,17,18,19,20,21,22,23,24,25'), ('6', '??????', '1', ''), ('44', '??', '1', '');
COMMIT;

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
--  Records of `auth_group_access`
-- ----------------------------
BEGIN;
INSERT INTO `auth_group_access` VALUES ('1', '1'), ('2', '2'), ('4', '6'), ('5', '1'), ('6', '3'), ('7', '3'), ('8', '3'), ('9', '3'), ('10', '1');
COMMIT;

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
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `auth_rule`
-- ----------------------------
BEGIN;
INSERT INTO `auth_rule` VALUES ('1', 'Index/index', '??', '1', '1', '', '0', '1', '1', 'icon_test'), ('2', 'Auth', '????', '1', '1', '', '0', '1', '1', ''), ('3', 'Authgroup/index', '????', '1', '1', '', '2', '1', '1', ''), ('4', 'Authgroup/menuList', '????', '1', '1', '', '2', '1', '1', ''), ('5', 'Authgroup/addRole', '????', '1', '1', '', '3', '1', '0', ''), ('6', 'Authgroup/editRole', '????', '1', '1', '', '3', '1', '0', ''), ('7', 'Authgroup/delRole', '????', '1', '1', '', '3', '1', '0', ''), ('8', 'Authgroup/checkRoleNameUnique', '????????', '1', '1', '', '3', '1', '0', ''), ('9', 'testing/tim', '??', '1', '0', '', '1', '1', '0', ''), ('10', 'Authgroup/addMenu', '????', '1', '1', '', '4', '1', '0', ''), ('11', 'Authgroup/editMenu', '????', '1', '1', '', '4', '1', '0', ''), ('12', 'Authgroup/delMenu', '????', '1', '1', '', '4', '1', '0', ''), ('13', 'Authgroup/getMenuInfoById', '????????', '1', '1', '', '4', '2', '0', ''), ('14', 'Admin/index', '?????', '1', '1', '', '0', '1', '1', null), ('15', 'Enterprise/index', '????', '1', '1', '', '0', '1', '1', null), ('16', 'Statictis', '????', '1', '1', '', '0', '1', '1', null), ('17', 'Statictis/index', '????', '1', '1', '', '16', '1', '1', null), ('18', 'Statictis/user', '????', '1', '1', '', '16', '1', '1', null), ('19', 'Statictis/productStatictis', '????', '1', '1', '', '16', '1', '1', null), ('20', 'SystemConfig', '????', '1', '1', '', '0', '1', '1', null), ('21', 'SystemConfig/index', '????', '1', '1', '', '20', '1', '1', null), ('22', 'SystemConfig/backstageConfig', '????', '1', '1', '', '20', '1', '1', null), ('23', 'MallMange', '????', '1', '1', '', '0', '1', '1', null), ('24', 'MallManage/list', '????', '1', '1', '', '23', '1', '1', null), ('25', 'MallManage/add', '????', '1', '1', '', '24', '1', '1', ''), ('26', 'Authgroup/testingThree', '??????', '1', '1', '', '5', '1', '0', ''), ('27', 'Authgroup/authList', '????', '1', '1', '', '4', '11', '0', null), ('28', 'Authgroup/scanAdmin', '?????', '1', '1', '', '3', '11', '1', null), ('29', 'Authgroup/editAuth', '??????', '1', '1', '', '27', '1', '0', null), ('30', 'Authgroup/getRoleInfo', '??????', '1', '1', '', '3', '1', '0', null), ('31', 'Admin/add', '?????', '1', '1', '', '14', '1', '0', null), ('32', 'Admin/getAdminInfoById', '???????', '1', '1', '', '14', '1', '0', null), ('33', 'Admin/edit', '?????', '1', '1', '', '14', '1', '0', null), ('34', 'Admin/del', '?????', '1', '1', '', '14', '1', '0', null);
COMMIT;

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `user`
-- ----------------------------
BEGIN;
INSERT INTO `user` VALUES ('1', 'admin', 'lBNVoZiObE.b254ce8ba5a19049d8ba23264bd0db6f', 'lzzccc.happy@163.com', '13913036373', null, null, null, null, null, null, '1', '0', '1'), ('2', 'root', 'lBNVoZiObE.b254ce8ba5a19049d8ba23264bd0db6f', 'tim@qq.com', '15651616552', null, null, null, null, null, null, '1', '0', '2'), ('4', 'tim', 'GK8fmtte7v.4d8fcaf1c0de3f8c34ae2af7ba272fde', 'tim@gmail.com', '13812348765', '127.0.0.1', '1442914760', null, null, null, null, '1', '0', '6'), ('5', 'LinKen', 'vzFbXLJ7Ju.5922e86bab1dc87f3ce5e9fcb6c81d56', 'linken@gmail.com', '85830621677', '127.0.0.1', '1443144074', null, null, null, null, '1', '0', '1'), ('6', 'CNM', '', 'cnm@gmail.com', '13612345698', '127.0.0.1', '1443147334', null, null, null, null, '1', '0', '3'), ('7', 'CNM1', '', 'cnm@gmail.com', '13612345698', '127.0.0.1', '1443147351', null, null, null, null, '1', '0', '3'), ('8', 'CNM2', '', 'cnm@gmail.com', '13612345698', '127.0.0.1', '1443147379', null, null, null, null, '1', '0', '3'), ('10', 'admin', '6BGPX0qZ5v.8922033d01fa278ac2d1f2f3ae2ae280', '429270182@qq.com', '85830621677', '127.0.0.1', '1443514502', null, null, null, null, '1', '0', '1');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
