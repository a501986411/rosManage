/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : ros_admin

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2017-06-28 17:14:57
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for zxc_ios_api_data
-- ----------------------------
DROP TABLE IF EXISTS `zxc_ios_api_data`;
CREATE TABLE `zxc_ios_api_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adv_id` varchar(255) NOT NULL DEFAULT '' COMMENT '被下载应用id',
  `app_id` varchar(255) NOT NULL DEFAULT '' COMMENT '调用推荐列表的应用ID',
  `key` varchar(255) NOT NULL DEFAULT '' COMMENT '调用推荐列表时传递的key或用户ID',
  `udid` varchar(255) NOT NULL DEFAULT '' COMMENT '设备唯码(ios7以下使用MAC地址,ios7以上使用idfa)',
  `open_udid` varchar(255) NOT NULL DEFAULT '' COMMENT '设备openudid',
  `bill` decimal(11,2) DEFAULT NULL COMMENT '价格,单位元（如果获取到该参数值为0或null，则表示该条数据无效）',
  `points` int(11) DEFAULT '0' COMMENT '积分,单位为服务端设置(金币)[如果判断bill为0或null，则给用户积分时，points也为0.]',
  `ad_name` varchar(255) NOT NULL DEFAULT '' COMMENT '被激活应用名称',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态，1为正常激活',
  `activate_time` int(11) NOT NULL DEFAULT '0' COMMENT '激活时间',
  `order_id` varchar(255) NOT NULL DEFAULT '' COMMENT '订单号,[由此字段判断接收数据是否唯一]',
  `random_code` varchar(255) NOT NULL DEFAULT '' COMMENT '随机串[此字段参与加密操作，值如：05141441400146701119]',
  `secret_key` varchar(255) NOT NULL DEFAULT '' COMMENT '验证密钥(老)[密钥串，md5(random_code + order_id)]',
  `wapskey` varchar(255) NOT NULL DEFAULT '' COMMENT '验证密钥结果值(新）【Md5(${adv_id}${app_id}${key}${udid}${bill}${points}${activate_time}${order_id}${回调密钥})】',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='周小川 IOS 接口调用保存数据';
