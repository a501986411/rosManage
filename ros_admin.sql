/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : ros_admin

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2017-05-24 10:33:50
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
INSERT INTO `admin_menu` VALUES ('1', '0', '系统设置', '', '0', '2', '', '0');
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
INSERT INTO `admin_user` VALUES ('2', 'admin', 'c3284d0f94606de1fd2af172aba15bf3', '1', '1495586771', '10.105.79.8', '1494939786', '1495586771');

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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COMMENT='rout os 服务器连接信息';

-- ----------------------------
-- Records of route_service
-- ----------------------------
INSERT INTO `route_service` VALUES ('1', 'home', 'home.webok.me', 'vpn.webok.me', '8728', 'api', 'api', '', '54', '0', '1494746889', '1495035046');
INSERT INTO `route_service` VALUES ('3', 'ay1', 'ay1.webok.net', '', '8999', 'api', 'api', '河南安阳', '50', '0', '1494750631', '1495168695');
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
INSERT INTO `route_service` VALUES ('40', 'gdzh', 'gdzh.webok.net', '', '8999', 'api', 'api', '广东珠海', '30', '1498752000', '1495552114', '1495552114');

-- ----------------------------
-- Table structure for server_info
-- ----------------------------
DROP TABLE IF EXISTS `server_info`;
CREATE TABLE `server_info` (
  `server_id` int(11) NOT NULL DEFAULT '0' COMMENT '服务器主表信息id',
  `runTime` varchar(255) NOT NULL DEFAULT '' COMMENT '系统运行时间',
  `version` varchar(255) NOT NULL DEFAULT '' COMMENT '系统版本号',
  `totalMemory` varchar(50) NOT NULL DEFAULT '0' COMMENT '总内存',
  `freeMemory` varchar(50) NOT NULL DEFAULT '0' COMMENT '空闲内存',
  `totalHddSpace` varchar(50) NOT NULL DEFAULT '0' COMMENT '硬盘总空间',
  `freeHddSpace` varchar(50) NOT NULL DEFAULT '0' COMMENT '硬盘空闲空间',
  `buildTime` varchar(100) NOT NULL DEFAULT '' COMMENT '系统建立时间',
  `cpu` varchar(100) NOT NULL DEFAULT '' COMMENT 'cpu型号',
  `cpuCount` varchar(11) NOT NULL DEFAULT '0' COMMENT 'cpu个数',
  `cpuFrequency` varchar(100) NOT NULL DEFAULT '0' COMMENT 'cpu频率',
  `cpuLoad` varchar(100) NOT NULL DEFAULT '0' COMMENT 'cup负载百分数（用于计算频率）',
  `boardName` varchar(100) NOT NULL DEFAULT '' COMMENT '设备名称',
  `onLineUserNum` varchar(30) NOT NULL DEFAULT '0' COMMENT '在线用户数',
  `systemTime` varchar(50) NOT NULL DEFAULT '' COMMENT '系统时间',
  `timeZone` varchar(100) NOT NULL DEFAULT '' COMMENT '系统时区',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '服务器状态',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '最后一次更新时间',
  PRIMARY KEY (`server_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ros服务器其它信息';

-- ----------------------------
-- Records of server_info
-- ----------------------------
INSERT INTO `server_info` VALUES ('1', '1w6d19:15:15', '6.33', '134217728', '87269376', '67108864', '24416256', 'Nov/06/2015Z12:49:27', 'MIPS', '1', '600', '32', 'RB951G-2HnD', '50', 'may/24/2017Z10:07:25', 'Asia/Shanghai', '1', '1495591658');
INSERT INTO `server_info` VALUES ('3', '21w2d00:03:09', '6.24', '128819200', '75071488', '66564096', '36339712', 'Dec/23/2014Z13:38:45', 'QEMU', '1', '1999', '32', 'x86', '38', 'may/24/2017Z10:06:59', 'Asia/Shanghai', '1', '1495591800');
INSERT INTO `server_info` VALUES ('4', '5d23:30:05', '6.15', '1060159488', '947736576', '60457984', '29218816', 'Jun/12/2014Z12:25:29', 'Intel(R)', '4', '3491', '27', 'x86', '57', 'may/24/2017Z10:06:25', 'manual', '1', '1495591796');
INSERT INTO `server_info` VALUES ('5', '2w1d19:03:07', '6.29.1', '527859712', '481804288', '60457984', '31544320', 'Jun/01/2015Z13:30:35', 'Intel(R)', '4', '2261', '60', 'x86', '8', 'may/24/2017Z10:07:14', 'manual', '1', '1495591789');
INSERT INTO `server_info` VALUES ('6', '2w6d01:09:06', '6.24', '1985908736', '1862352896', '60457984', '31006720', 'Dec/23/2014Z13:38:45', 'Intel(R)', '8', '3292', '1', 'x86', '20', 'may/24/2017Z10:07:23', 'Asia/Shanghai', '1', '1495591667');
INSERT INTO `server_info` VALUES ('7', '6d06:42:11', '6.36.2', '1060442112', '1010802688', '134479872', '96858112', 'Aug/22/2016Z12:53:52', 'ARMv7', '2', '1400', '30', 'RB3011UiAS', '24', 'may/24/2017Z10:09:38', 'Asia/Shanghai', '1', '1495591796');
INSERT INTO `server_info` VALUES ('8', '6w4d03:24:35', '6.24', '268435456', '206741504', '536870912', '514994176', 'Dec/23/2014Z13:38:45', 'MIPS', '0', '0', '24', 'RB450G', '24', 'may/24/2017Z10:08:06', 'Asia/Shanghai', '1', '1495591710');
INSERT INTO `server_info` VALUES ('9', '3w01:36:06', '6.15', '1060294656', '1000853504', '60457984', '30212096', 'Jun/12/2014Z12:25:29', 'Pentium(R)', '1', '3066', '17', 'x86', '17', 'may/24/2017Z10:09:15', 'Asia/Shanghai', '1', '1495591752');
INSERT INTO `server_info` VALUES ('10', '2w15:03:04', '6.15', '527892480', '469221376', '60457984', '31420416', 'Jun/12/2014Z12:25:29', 'Intel(R)', '4', '3301', '6', 'x86', '7', 'may/24/2017Z10:08:46', 'manual', '1', '1495591743');
INSERT INTO `server_info` VALUES ('11', '1d14:44:06', '6.29.1', '527859712', '484925440', '60457984', '30404608', 'Jun/01/2015Z13:30:35', 'Intel(R)', '4', '2600', '18', 'x86', '38', 'may/24/2017Z10:07:55', 'manual', '1', '1495591799');
INSERT INTO `server_info` VALUES ('12', '1w2d13:33:13', '6.24', '1986088960', '1870299136', '3937918976', '3842977792', 'Dec/23/2014Z13:38:45', 'Intel(R)', '4', '1861', '1', 'x86', '2', 'may/24/2017Z10:07:37', 'Asia/Shanghai', '1', '1495591681');
INSERT INTO `server_info` VALUES ('13', '18:03:06', '6.15', '1060249600', '1011978240', '60457984', '31355904', 'Jun/12/2014Z12:25:29', 'Intel(R)', '2', '3292', '33', 'x86', '28', 'may/24/2017Z10:09:36', 'Asia/Shanghai', '1', '1495591794');
INSERT INTO `server_info` VALUES ('14', '4d09:09:06', '6.15', '528027648', '476008448', '60457984', '31346688', 'Jun/12/2014Z12:25:29', 'Intel(R)', '1', '2266', '31', 'x86', '26', 'may/23/2017Z20:44:14', 'Asia/Shanghai', '1', '0');
INSERT INTO `server_info` VALUES ('15', '4d22:33:06', '6.15', '528027648', '475242496', '60457984', '31344640', 'Jun/12/2014Z12:25:29', 'Intel(R)', '1', '2266', '21', 'x86', '19', 'may/24/2017Z10:08:14', 'Asia/Shanghai', '1', '1495591718');
INSERT INTO `server_info` VALUES ('16', '5d16:09:06', '6.15', '1059979264', '990437376', '60457984', '31289344', 'Jun/12/2014Z12:25:29', 'Intel(R)', '8', '3292', '6', 'x86', '15', 'may/24/2017Z10:06:18', 'manual', '1', '1495591667');
INSERT INTO `server_info` VALUES ('17', '1w5d16:30:06', '6.15', '1060249600', '999088128', '60457984', '31314944', 'Jun/12/2014Z12:25:29', 'Intel(R)', '2', '2693', '28', 'x86', '16', 'may/24/2017Z10:07:52', 'manual', '1', '1495591651');
INSERT INTO `server_info` VALUES ('18', '1w1d16:00:09', '6.35.4', '1060171776', '996114432', '134479872', '97349632', 'Jun/09/2016Z13:12:02', 'ARMv7', '2', '', '19', 'RB3011UiAS', '21', 'may/24/2017Z10:16:29', 'Asia/Shanghai', '1', '1495591711');
INSERT INTO `server_info` VALUES ('19', '2w6d15:30:04', '6.33', '1059995648', '995819520', '60457984', '26207232', 'Nov/06/2015Z12:49:27', 'Intel(R)', '4', '3591', '13', 'x86', '26', 'may/24/2017Z10:06:02', 'Asia/Shanghai', '1', '1495591558');
INSERT INTO `server_info` VALUES ('20', '10w15:54:03', '6.32.2', '128724992', '57245696', '60457984', '0', '', '', '0', '0', '0', 'x86', '36', 'may/23/2017Z21:15:38', '', '1', '1495591637');
INSERT INTO `server_info` VALUES ('21', '3w23:57:10', '6.15', '1060249600', '994668544', '60457984', '30977024', 'Jun/12/2014Z12:25:29', 'Intel(R)', '2', '3292', '27', 'x86', '19', 'may/24/2017Z10:07:45', 'manual', '1', '1495591673');
INSERT INTO `server_info` VALUES ('22', '1d15:15:09', '6.15', '1985908736', '1905086464', '60457984', '23079936', 'Jun/12/2014Z12:25:29', 'Intel(R)', '8', '3400', '9', 'x86', '28', 'may/24/2017Z10:07:20', 'Asia/Chongqing', '1', '1495591664');
INSERT INTO `server_info` VALUES ('23', '01:54:09', '6.36', '1060442112', '1027563520', '134479872', '95199232', 'Jul/20/2016Z14:09:10', 'ARMv7', '2', '', '13', 'RB3011UiAS', '15', 'may/24/2017Z10:09:34', 'Asia/Shanghai', '1', '1495591798');
INSERT INTO `server_info` VALUES ('24', '1d13:45:05', '6.15', '527982592', '470876160', '60457984', '30500864', 'Jun/12/2014Z12:25:29', 'Intel(R)', '2', '3292', '18', 'x86', '41', 'may/24/2017Z09:49:22', 'manual', '1', '1495591674');
INSERT INTO `server_info` VALUES ('25', '6w3d20:42:06', '6.29.1', '527966208', '453955584', '60457984', '31265792', 'Jun/01/2015Z13:30:35', 'Intel(R)', '2', '2133', '25', 'x86', '22', 'may/24/2017Z10:08:03', 'Asia/Shanghai', '1', '1495591708');
INSERT INTO `server_info` VALUES ('26', '1w2d19:57:06', '6.15', '1059979264', '989999104', '60457984', '31371264', 'Jun/12/2014Z12:25:29', 'Intel(R)', '8', '3400', '1', 'x86', '14', 'may/24/2017Z10:08:31', 'manual', '1', '1495591753');
INSERT INTO `server_info` VALUES ('27', '5w5d22:00:04', '6.15', '527982592', '474865664', '60457984', '30711808', 'Jun/12/2014Z12:25:29', 'Intel(R)', '2', '3300', '23', 'x86', '20', 'may/24/2017Z10:07:43', 'Asia/Shanghai', '1', '1495591687');
INSERT INTO `server_info` VALUES ('29', '5w3d12:09:06', '6.15', '527892480', '425885696', '60457984', '29044736', 'Jun/12/2014Z12:25:29', 'Intel(R)', '4', '2266', '26', 'x86', '52', 'may/24/2017Z10:07:59', 'manual', '1', '1495591792');
INSERT INTO `server_info` VALUES ('30', '5w3d00:54:06', '6.36', '527781888', '370790400', '59261952', '27930624', 'Jul/20/2016Z14:09:10', 'Intel(R)', '1', '2600', '25', 'x86', '23', 'may/24/2017Z10:10:10', 'Asia/Shanghai', '1', '1495591724');
INSERT INTO `server_info` VALUES ('31', '2d18:57:22', '6.29.1', '527859712', '482045952', '60457984', '31510528', 'Jun/01/2015Z13:30:35', 'Intel(R)', '4', '3392', '39', 'x86', '7', 'may/24/2017Z10:09:28', 'manual', '1', '1495591783');
INSERT INTO `server_info` VALUES ('32', '2w6d15:33:04', '6.33', '1059995648', '995889152', '60457984', '26207232', 'Nov/06/2015Z12:49:27', 'Intel(R)', '4', '3591', '15', 'x86', '24', 'may/24/2017Z10:09:02', 'Asia/Shanghai', '1', '1495591738');
INSERT INTO `server_info` VALUES ('33', '3d00:24:08', '6.24', '527982592', '487731200', '60457984', '33297408', 'Dec/23/2014Z13:38:45', 'Intel(R)', '2', '2266', '41', 'x86', '18', 'may/24/2017Z10:07:01', 'manual', '1', '1495591654');
INSERT INTO `server_info` VALUES ('34', '6d18:39:10', '6.36', '1060442112', '1016750080', '134479872', '93855744', 'Jul/20/2016Z14:09:10', 'ARMv7', '2', '', '1', 'RB3011UiAS', '5', 'may/24/2017Z10:07:01', 'Asia/Shanghai', '1', '1495591645');
INSERT INTO `server_info` VALUES ('35', '5d23:33:07', '6.27', '1986170880', '1864318976', '3937918976', '3837792256', 'Feb/11/2015Z13:24:13', 'Intel(R)', '2', '3192', '7', 'x86', '34', 'may/24/2017Z10:11:42', 'manual', '1', '1495591772');
INSERT INTO `server_info` VALUES ('36', '17:39:05', '6.15', '1986088960', '1916821504', '60457984', '29526016', 'Jun/12/2014Z12:25:29', 'Intel(R)', '4', '3691', '32', 'x86', '11', 'may/24/2017Z10:09:34', 'Asia/Chongqing', '1', '1495591798');
INSERT INTO `server_info` VALUES ('37', '5d23:33:11', '6.24', '1983983616', '1824002048', '3937918976', '3832627200', 'Dec/23/2014Z13:38:45', 'Intel(R)', '4', '3192', '10', 'x86', '47', 'may/24/2017Z10:09:26', 'Asia/Shanghai', '1', '1495591790');
INSERT INTO `server_info` VALUES ('38', '5d23:33:08', '6.27', '1986080768', '1535033344', '3937918976', '3820187648', 'Feb/11/2015Z13:24:13', 'Intel(R)', '4', '3591', '9', 'x86', '47', 'may/24/2017Z10:09:19', 'Asia/Shanghai', '1', '1495591784');
INSERT INTO `server_info` VALUES ('40', '15:35:32', '6.29.1', '527859712', '485687296', '60457984', '31264768', 'Jun/01/2015Z13:30:35', 'Intel(R)', '4', '2660', '45', 'x86', '2', 'may/24/2017Z10:07:08', 'manual', '1', '1495591657');
