/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : blog

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-05-17 23:46:12
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin_menu
-- ----------------------------
DROP TABLE IF EXISTS `admin_menu`;
CREATE TABLE `admin_menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父id',
  `name` varchar(30) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '菜单名称',
  `url` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '菜单连接地址',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1:启用,2:停用',
  `path` varchar(20) NOT NULL DEFAULT '' COMMENT '上级所有节点路径如（1-3-4）',
  `is_update_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否支持启用或者停用操作1：支持，0：不支持',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 COMMENT='菜单数据表';

-- ----------------------------
-- Records of admin_menu
-- ----------------------------
INSERT INTO `admin_menu` VALUES ('1', '0', '系统设置', '', '0', '1', '', '0');
INSERT INTO `admin_menu` VALUES ('2', '1', '菜单管理', '/MenuManage/index', '1', '1', '1', '0');
INSERT INTO `admin_menu` VALUES ('3', '0', '文章管理', '', '0', '2', '', '1');
INSERT INTO `admin_menu` VALUES ('4', '3', '类型管理', '', '0', '2', '3', '1');
INSERT INTO `admin_menu` VALUES ('5', '1', '权限管理', '/auth/index', '2', '2', '1', '0');
INSERT INTO `admin_menu` VALUES ('6', '3', '标签管理', '/tag/index', '2', '2', '3', '1');
INSERT INTO `admin_menu` VALUES ('7', '3', '作者管理', '/author/index', '3', '2', '3', '1');
INSERT INTO `admin_menu` VALUES ('8', '0', '评论管理', '', '3', '2', '', '1');
INSERT INTO `admin_menu` VALUES ('9', '0', 'ROS管理', '', '3', '1', '', '1');
INSERT INTO `admin_menu` VALUES ('10', '9', '服务器管理', '/RouteService/index', '1', '1', '9', '1');
INSERT INTO `admin_menu` VALUES ('11', '9', 'ROS状态列表', '/RouteService/rosStatusList', '2', '1', '9', '1');
INSERT INTO `admin_menu` VALUES ('12', '0', '用户管理', '', '4', '1', '', '1');
INSERT INTO `admin_menu` VALUES ('13', '12', '管理员账号', '/AdminUser/index', '1', '1', '12', '1');
INSERT INTO `admin_menu` VALUES ('14', '12', '修改密码', '/AdminUser/updatePwdIndex', '2', '1', '12', '1');

-- ----------------------------
-- Table structure for admin_user
-- ----------------------------
DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user` (
  `id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL DEFAULT '' COMMENT '用户名',
  `password_hash` varchar(255) NOT NULL DEFAULT '' COMMENT '密码hash加密字符串',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否启用1：启用，0：停用',
  `last_login_time` int(11) NOT NULL DEFAULT '0' COMMENT '最后一次登录时间',
  `last_login_ip` varchar(20) NOT NULL DEFAULT '' COMMENT '最后一次登录IP',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='管理后台用户基础信息表';

-- ----------------------------
-- Records of admin_user
-- ----------------------------
INSERT INTO `admin_user` VALUES ('1', 'chenhailong', '341106d58d01b48fe78fb9cc4de00c22', '0', '1495005404', '127.0.0.1', '0', '1495005404');
INSERT INTO `admin_user` VALUES ('2', 'admin', 'c3284d0f94606de1fd2af172aba15bf3', '1', '1495033979', '127.0.0.1', '1494939786', '1495033979');

-- ----------------------------
-- Table structure for route_service
-- ----------------------------
DROP TABLE IF EXISTS `route_service`;
CREATE TABLE `route_service` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL DEFAULT '' COMMENT '服务器名称',
  `domain` varchar(40) NOT NULL DEFAULT '' COMMENT '服务器域名',
  `by_domain` varchar(200) NOT NULL DEFAULT '' COMMENT '备用域名（用竖线|分隔）',
  `port` int(5) NOT NULL DEFAULT '8728' COMMENT '服务器连接端口',
  `username` varchar(40) NOT NULL DEFAULT '' COMMENT '服务器登录用户名',
  `password` varchar(50) NOT NULL DEFAULT '' COMMENT '服务器登陆密码',
  `remark` varchar(400) NOT NULL DEFAULT '' COMMENT '备注',
  `max_number` int(11) NOT NULL DEFAULT '0' COMMENT '最大允许在线人数',
  `overdue` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '过期时间（服务器过期时间）',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='rout os 服务器连接信息';

-- ----------------------------
-- Records of route_service
-- ----------------------------
INSERT INTO `route_service` VALUES ('1', 'home', 'home.webok.me', 'vpn.webok.me', '8728', 'api', 'api', '123454353', '60', '0', '1494746889', '1494859715');
INSERT INTO `route_service` VALUES ('3', 'ay1', 'ay1.webok.net', '', '8999', 'api', 'api', '', '80', '0', '1494750631', '1494859724');
INSERT INTO `route_service` VALUES ('4', 'xz', 'xz009.webok.net', 'xz10.webok.net|xz11.webok.net|xz12.webok.net|xz88.webok.net', '8999', 'api', 'api', '', '60', '1496211300', '1494858027', '1494858027');
