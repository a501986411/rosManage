/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : ros_admin

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2017-05-19 18:33:29
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
INSERT INTO `admin_user` VALUES ('2', 'admin', 'c3284d0f94606de1fd2af172aba15bf3', '1', '1495186703', '127.0.0.1', '1494939786', '1495186703');

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
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COMMENT='rout os 服务器连接信息';

-- ----------------------------
-- Records of route_service
-- ----------------------------
INSERT INTO `route_service` VALUES ('1', 'home', 'home.webok.me', 'vpn.webok.me', '8728', 'api', 'api', '', '54', '0', '1494746889', '1495035046');
INSERT INTO `route_service` VALUES ('3', 'ay1', 'ay1.webok.net', '', '8999', 'api', 'api', '河南安阳', '70', '0', '1494750631', '1495096580');
INSERT INTO `route_service` VALUES ('4', 'xz10', 'xz009.webok.net', 'xz10.webok.net|xz88.webok.net', '8999', 'api', 'api', '江苏徐州', '100', '0', '1494858027', '1495037553');
INSERT INTO `route_service` VALUES ('5', 'ahcz', 'ahcz.webok.net', '', '8999', 'api', 'api', '安徽池州', '30', '0', '1495034256', '1495035416');
INSERT INTO `route_service` VALUES ('6', 'anh2', 'anh2.webok.net', 'anh1.webok.net', '8999', 'api', 'api', '安徽蚌埠', '60', '0', '1495035230', '1495035230');
INSERT INTO `route_service` VALUES ('7', 'bz1', 'bz1.webok.net', 'bz2.webok.net', '8999', 'api', 'api', '安徽亳州', '38', '0', '1495035402', '1495035402');
INSERT INTO `route_service` VALUES ('8', 'cd1', 'cd1.webok.net', '', '8999', 'api', 'api', '四川成都', '27', '0', '1495035644', '1495073399');
INSERT INTO `route_service` VALUES ('9', 'cq1', 'cq1.webok.net', 'cq2.webok.net', '8999', 'api', 'api', '重庆', '54', '0', '1495035822', '1495067996');
INSERT INTO `route_service` VALUES ('10', 'cs001', 'cs001.webok.net', 'cs003.webok.net', '8999', 'api', 'api', '湖南长沙', '30', '1496160000', '1495036018', '1495036078');
INSERT INTO `route_service` VALUES ('11', 'cz1', 'cz1.webok.net', '', '8999', 'api', 'api', '湖南郴州', '50', '1496160000', '1495036251', '1495036251');
INSERT INTO `route_service` VALUES ('12', 'gz2', 'gz2.webok.net', 'gz1.webok.net', '8999', 'api', 'api', '广东广州', '30', '1496160000', '1495036372', '1495036372');
INSERT INTO `route_service` VALUES ('13', 'ha3', 'ha3.webok.net', 'ha1.webok.net|ha2.webok.net', '8999', 'api', 'api', '江苏淮安', '28', '0', '1495036516', '1495036516');
INSERT INTO `route_service` VALUES ('14', 'hb2', 'hb2.webok.net', 'hb1.webok.net', '8999', 'api', 'api', '安徽淮北', '38', '0', '1495037258', '1495037258');
INSERT INTO `route_service` VALUES ('15', 'hbsy1', 'hbsy1.webok.net', '', '8999', 'api', 'api', '河北十堰', '53', '0', '1495037331', '1495037331');
INSERT INTO `route_service` VALUES ('16', 'hf1', 'hf1.webok.net', '', '8999', 'api', 'api', '安徽合肥', '60', '0', '1495037452', '1495037884');
INSERT INTO `route_service` VALUES ('17', 'nt1', 'nt1.webok.net', '', '8999', 'api', 'api', '江苏南通', '39', '0', '1495037530', '1495037530');
INSERT INTO `route_service` VALUES ('18', 'nj3', 'nj3.webok.net', 'nj1.webok.net|nj2.webok.net', '8999', 'api', 'api', '江苏南京', '40', '0', '1495037641', '1495037641');
INSERT INTO `route_service` VALUES ('19', 'hn1', 'hn1.webok.net', '', '8999', 'api', 'api', '河南三门峡', '40', '0', '1495068262', '1495068262');
INSERT INTO `route_service` VALUES ('20', 'hs1', 'hs1.webok.net', '', '8999', 'api', 'api', '河北衡水', '50', '1497456000', '1495068372', '1495068372');
INSERT INTO `route_service` VALUES ('21', 'hz1', 'hz1.webok.net', '', '8999', 'api', 'api', '浙江杭州', '31', '0', '1495068423', '1495068423');
INSERT INTO `route_service` VALUES ('22', 'jx004', 'jx004.webok.net', 'jx001.webok.net|jx002.webok.net', '8999', 'api', 'api', '江西宜春', '100', '0', '1495068545', '1495068545');
INSERT INTO `route_service` VALUES ('23', 'lc1', 'lc1.webok.net', '', '8999', 'api', 'api', '山东聊城', '28', '0', '1495068649', '1495068649');
INSERT INTO `route_service` VALUES ('24', 'lyg', 'lyg.webok.net', '', '8999', 'api', 'api', '江苏连云港', '48', '0', '1495068733', '1495068733');
INSERT INTO `route_service` VALUES ('25', 'nb1', 'nb1.webok.net', '', '8999', 'api', 'api', '浙江宁波', '49', '0', '1495068848', '1495068848');
INSERT INTO `route_service` VALUES ('26', 'sdbz', 'sdbz.webok.net', '', '8999', 'api', 'api', '山东滨州', '49', '0', '1495068975', '1495068975');
INSERT INTO `route_service` VALUES ('27', 'sq3', 'sq3.webok.net', 'sq1.webok.net', '8999', 'api', 'api', '江苏宿迁', '37', '0', '1495069108', '1495069108');
INSERT INTO `route_service` VALUES ('28', 'sxya', 'sxya.webok.net', '', '8999', 'api', 'api', '陕西延安', '50', '0', '1495069203', '1495069203');
INSERT INTO `route_service` VALUES ('29', 'tz2', 'tz2.webok.net', 'tz1.webok.net', '8999', 'api', 'api', '浙江台州', '100', '0', '1495069292', '1495069292');
INSERT INTO `route_service` VALUES ('30', 'zg1', 'zg1.webok.net', '', '8999', 'api', 'api', '四川自贡', '29', '0', '1495069818', '1495069818');
INSERT INTO `route_service` VALUES ('31', 'zt2', 'zt2.webok.net', 'zt1.webok.net', '8999', 'api', 'api', '浙江泰州', '36', '0', '1495070023', '1495070023');
INSERT INTO `route_service` VALUES ('32', 'zz1', 'zz1.webok.net', '', '8999', 'api', 'api', '河南郑州', '50', '0', '1495071093', '1495071093');
INSERT INTO `route_service` VALUES ('33', 'qhxn', 'qhxn.webok.net', '', '8999', 'api', 'api', '青海西宁', '30', '0', '1495072628', '1495072628');
INSERT INTO `route_service` VALUES ('34', 'ds1', 'ds1.webok.net', '', '8999', 'api', 'api', '混合ds1', '100', '0', '1495096250', '1495096250');
INSERT INTO `route_service` VALUES ('35', 'hh1', 'hh1.webok.net', 'hh2.webok.net', '8999', 'api', 'api', '', '100', '0', '1495096281', '1495096281');
INSERT INTO `route_service` VALUES ('36', 'xz7', 'xz7.webok.net', 'xz8.webok.net', '8999', 'api', 'api', '', '80', '0', '1495096302', '1495096302');
INSERT INTO `route_service` VALUES ('37', 'xz81', 'xz81.webok.net', 'xz82.webok.net', '8999', 'api', 'api', '', '100', '0', '1495096322', '1495096322');
INSERT INTO `route_service` VALUES ('38', 'xz91', 'xz91.webok.net', 'xz92.webok.net', '8999', 'api', 'api', '', '100', '0', '1495096349', '1495096349');
INSERT INTO `route_service` VALUES ('39', 'sxwn', 'sxwn.webok.net', '', '8999', 'api', 'api', '陕西渭南', '50', '0', '1495111318', '1495111318');
