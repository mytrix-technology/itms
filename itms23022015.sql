/*
Navicat MySQL Data Transfer

Source Server         : Mysql Server Development
Source Server Version : 50516
Source Host           : 192.168.0.106:3306
Source Database       : itms

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2015-02-23 10:35:50
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `autoemail`
-- ----------------------------
DROP TABLE IF EXISTS `autoemail`;
CREATE TABLE `autoemail` (
  `id` int(11) NOT NULL,
  `id_job_daily_report` int(10) DEFAULT NULL,
  `mailto` varchar(255) DEFAULT NULL,
  `mailfrom` varchar(255) DEFAULT NULL,
  `cc` varchar(255) DEFAULT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `user_created` int(10) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_updated` int(10) DEFAULT NULL,
  `status_sent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of autoemail
-- ----------------------------

-- ----------------------------
-- Table structure for `backup_db_daily`
-- ----------------------------
DROP TABLE IF EXISTS `backup_db_daily`;
CREATE TABLE `backup_db_daily` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_master_DB` int(10) DEFAULT NULL,
  `period` varchar(255) DEFAULT NULL,
  `user_backup` int(10) DEFAULT NULL,
  `backup_date` date DEFAULT NULL,
  `id_master_status` int(10) DEFAULT NULL,
  `remark` text,
  `approval_dba` int(10) DEFAULT NULL,
  `approval_itd_dev` int(10) DEFAULT NULL,
  `receiver_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `user_created` int(10) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_updated` int(10) DEFAULT NULL,
  `status_activated` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of backup_db_daily
-- ----------------------------
INSERT INTO `backup_db_daily` VALUES ('35', '2', '2014-02', '1', '2014-02-01', '20', 'cccccccccc', '1', '1', null, '2014-06-16 16:35:12', '1', '2015-01-14 02:47:17', '1', '0');
INSERT INTO `backup_db_daily` VALUES ('36', '2', '2014-02', '1', '2014-02-02', '19', 'dddddddddddd', '1', '1', null, '2014-06-16 16:35:12', '1', '2015-01-02 10:33:14', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('37', '2', '2014-02', '1', '2014-02-03', '20', 'aaaaaaaaa', '1', '1', null, '2014-06-16 16:35:12', '1', '2014-06-18 16:39:43', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('38', '2', '2014-02', '1', '2014-02-04', '20', 'bbbb', '1', null, null, '2014-06-16 16:35:12', '1', '2015-01-02 10:03:19', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('39', '2', '2014-02', '1', '2014-02-05', '19', 'cccc', '1', null, null, '2014-06-16 16:35:12', '1', '2015-01-02 10:45:11', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('40', '2', '2014-02', '1', '2014-02-06', '20', '', '1', null, null, '2014-06-16 16:35:12', '1', '2015-01-02 10:47:59', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('41', '2', '2014-02', '1', '2014-02-07', '20', '', null, null, null, '2014-06-16 16:35:12', '1', '2014-06-18 16:39:43', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('42', '2', '2014-02', '1', '2014-02-08', '19', '', null, null, null, '2014-06-16 16:35:12', '1', '2014-06-18 16:39:43', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('43', '2', '2014-02', '1', '2014-02-09', '19', '', null, null, null, '2014-06-16 16:35:12', '1', '2014-06-18 16:39:43', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('44', '2', '2014-02', '1', '2014-02-10', '19', '', null, null, null, '2014-06-16 16:35:12', '1', '2014-06-18 16:39:43', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('45', '2', '2014-02', '1', '2014-02-11', '20', '', null, null, null, '2014-06-16 16:35:12', '1', '2014-06-18 16:39:43', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('46', '2', '2014-02', '1', '2014-02-12', '20', '', null, null, null, '2014-06-16 16:35:12', '1', '2014-06-18 16:39:43', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('47', '2', '2014-02', '1', '2014-02-13', '20', '', null, null, null, '2014-06-16 16:35:12', '1', '2014-06-18 16:39:43', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('48', '2', '2014-02', '1', '2014-02-14', '20', '', null, null, null, '2014-06-16 16:35:12', '1', '2014-06-18 16:39:43', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('49', '2', '2014-02', '1', '2014-02-15', '2', '', null, null, null, '2014-06-16 16:35:12', '1', '2014-06-18 16:39:43', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('50', '2', '2014-02', '1', '2014-02-16', '2', '', null, null, null, '2014-06-16 16:35:12', '1', '2014-06-18 16:39:43', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('51', '2', '2014-02', '1', '2014-02-17', '2', '', null, null, null, '2014-06-16 16:35:12', '1', '2014-06-18 16:39:43', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('52', '2', '2014-02', '1', '2014-02-18', '2', '', null, null, null, '2014-06-16 16:35:12', '1', '2014-06-18 16:39:43', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('53', '2', '2014-02', '1', '2014-02-19', '2', '', null, null, null, '2014-06-16 16:35:12', '1', '2014-06-18 16:39:43', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('54', '2', '2014-02', '1', '2014-02-20', '2', '', null, null, null, '2014-06-16 16:35:12', '1', '2014-06-18 16:39:43', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('55', '2', '2014-02', '1', '2014-02-21', '2', '', null, null, null, '2014-06-16 16:35:12', '1', '2014-06-18 16:39:43', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('56', '2', '2014-02', '1', '2014-02-22', '2', '', null, null, null, '2014-06-16 16:35:12', '1', '2014-06-18 16:39:43', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('57', '2', '2014-02', '1', '2014-02-23', '2', '', null, null, null, '2014-06-16 16:35:12', '1', '2014-06-18 16:39:43', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('58', '2', '2014-02', '1', '2014-02-24', '2', '', null, null, null, '2014-06-16 16:35:12', '1', '2014-06-18 16:39:43', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('59', '2', '2014-02', '1', '2014-02-25', '2', '', null, null, null, '2014-06-16 16:35:12', '1', '2014-06-18 16:39:43', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('60', '2', '2014-02', '1', '2014-02-26', '2', '', null, null, null, '2014-06-16 16:35:12', '1', '2014-06-18 16:39:43', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('61', '2', '2014-02', '1', '2014-02-27', '2', '', null, null, null, '2014-06-16 16:35:12', '1', '2014-06-18 16:39:43', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('90', '2', '2014-02', '1', '2014-02-28', '2', '', null, null, null, '2014-06-18 16:39:43', '1', '2014-06-18 16:39:43', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('91', '1', '2014-06', '1', '2014-06-01', '2', 'aaaa', null, null, null, '2014-06-19 15:16:16', '1', '2014-06-19 15:16:16', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('92', '1', '2014-06', '1', '2014-06-02', '2', 'bbbb', null, null, null, '2014-06-19 15:16:16', '1', '2014-06-19 15:16:16', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('93', '1', '2014-06', '1', '2014-06-03', '2', 'cccc', null, null, null, '2014-06-19 15:16:16', '1', '2014-06-19 15:16:16', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('94', '1', '2014-06', '1', '2014-06-04', '2', '', null, null, null, '2014-06-19 15:16:16', '1', '2014-06-19 15:16:16', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('95', '1', '2014-06', '1', '2014-06-05', '2', '', null, null, null, '2014-06-19 15:16:16', '1', '2014-06-19 15:16:16', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('96', '1', '2014-06', '1', '2014-06-06', '2', '', null, null, null, '2014-06-19 15:16:16', '1', '2014-06-19 15:16:16', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('97', '1', '2014-06', '1', '2014-06-07', '2', '', null, null, null, '2014-06-19 15:16:16', '1', '2014-06-19 15:16:16', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('98', '1', '2014-06', '1', '2014-06-08', '2', '', null, null, null, '2014-06-19 15:16:16', '1', '2014-06-19 15:16:16', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('99', '1', '2014-06', '1', '2014-06-09', '2', '', null, null, null, '2014-06-19 15:16:16', '1', '2014-06-19 15:16:16', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('100', '1', '2014-06', '1', '2014-06-10', '2', '', null, null, null, '2014-06-19 15:16:16', '1', '2014-06-19 15:16:16', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('101', '1', '2014-06', '1', '2014-06-11', '2', '', null, null, null, '2014-06-19 15:16:16', '1', '2014-06-19 15:16:16', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('102', '1', '2014-06', '1', '2014-06-12', '2', '', null, null, null, '2014-06-19 15:16:16', '1', '2014-06-19 15:16:16', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('103', '1', '2014-06', '1', '2014-06-13', '2', '', null, null, null, '2014-06-19 15:16:16', '1', '2014-06-19 15:16:16', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('104', '1', '2014-06', '1', '2014-06-14', '2', '', null, null, null, '2014-06-19 15:16:16', '1', '2014-06-19 15:16:16', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('105', '1', '2014-06', '1', '2014-06-15', '2', '', null, null, null, '2014-06-19 15:16:16', '1', '2014-06-19 15:16:16', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('106', '1', '2014-06', '1', '2014-06-16', '2', '', null, null, null, '2014-06-19 15:16:16', '1', '2014-06-19 15:16:16', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('107', '1', '2014-06', '1', '2014-06-17', '2', '', null, null, null, '2014-06-19 15:16:16', '1', '2014-06-19 15:16:16', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('108', '1', '2014-06', '1', '2014-06-18', '2', '', null, null, null, '2014-06-19 15:16:16', '1', '2014-06-19 15:16:16', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('109', '1', '2014-06', '1', '2014-06-19', '2', '', null, null, null, '2014-06-19 15:16:16', '1', '2014-06-19 15:16:16', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('110', '1', '2014-06', '1', '2014-06-20', '2', '', null, null, null, '2014-06-19 15:16:16', '1', '2014-06-19 15:16:16', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('111', '1', '2014-06', '1', '2014-06-21', '2', '', null, null, null, '2014-06-19 15:16:16', '1', '2014-06-19 15:16:16', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('112', '1', '2014-06', '1', '2014-06-22', '2', '', null, null, null, '2014-06-19 15:16:16', '1', '2014-06-19 15:16:16', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('113', '1', '2014-06', '1', '2014-06-23', '2', '', null, null, null, '2014-06-19 15:16:16', '1', '2014-06-19 15:16:16', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('114', '1', '2014-06', '1', '2014-06-24', '2', '', null, null, null, '2014-06-19 15:16:16', '1', '2014-06-19 15:16:16', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('115', '1', '2014-06', '1', '2014-06-25', '2', '', null, null, null, '2014-06-19 15:16:16', '1', '2014-06-19 15:16:16', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('116', '1', '2014-06', '1', '2014-06-26', '2', '', null, null, null, '2014-06-19 15:16:16', '1', '2014-06-19 15:16:16', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('117', '1', '2014-06', '1', '2014-06-27', '2', '', null, null, null, '2014-06-19 15:16:16', '1', '2014-06-19 15:16:16', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('118', '1', '2014-06', '1', '2014-06-28', '2', '', null, null, null, '2014-06-19 15:16:16', '1', '2014-06-19 15:16:16', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('119', '1', '2014-06', '1', '2014-06-29', '2', '', null, null, null, '2014-06-19 15:16:16', '1', '2014-06-19 15:16:16', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('120', '1', '2014-06', '1', '2014-06-30', '2', '', null, null, null, '2014-06-19 15:16:16', '1', '2014-06-19 15:16:16', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('121', '3', '2014-11', '1', '2014-11-13', '19', 'tes lagi\r\n', null, null, null, '2014-12-29 07:16:08', '1', '2014-12-29 07:49:20', '1', '0');
INSERT INTO `backup_db_daily` VALUES ('122', '3', '2015-01', '1', '2015-01-14', '20', 'cacsacaca', null, null, null, '2015-01-14 08:15:43', '1', '2015-01-23 08:00:29', '1', '1');
INSERT INTO `backup_db_daily` VALUES ('123', '5', '2015-06', '4', '2015-01-08', '19', 'Remark Test Edit', '1', '1', null, '2015-02-21 05:20:38', '4', '2015-02-21 05:21:32', '4', '0');

-- ----------------------------
-- Table structure for `backup_db_monthly`
-- ----------------------------
DROP TABLE IF EXISTS `backup_db_monthly`;
CREATE TABLE `backup_db_monthly` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_master_DB` int(10) DEFAULT NULL,
  `period` varchar(255) DEFAULT NULL,
  `user_backup` int(10) DEFAULT NULL,
  `backup_date` date DEFAULT NULL,
  `id_master_status` int(10) DEFAULT NULL,
  `remark` text,
  `approval_dba` int(10) DEFAULT NULL,
  `approval_itd_dev` int(10) DEFAULT NULL,
  `approval_itd_head_dev` int(10) DEFAULT NULL,
  `receiver_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `user_created` int(10) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_updated` int(10) DEFAULT NULL,
  `status_activated` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_master_DB1` (`id_master_DB`),
  KEY `id_master_status1` (`id_master_status`),
  KEY `status_activated1` (`status_activated`),
  CONSTRAINT `id_master_DB1` FOREIGN KEY (`id_master_DB`) REFERENCES `master_db` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_master_status1` FOREIGN KEY (`id_master_status`) REFERENCES `master_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of backup_db_monthly
-- ----------------------------
INSERT INTO `backup_db_monthly` VALUES ('55', '1', '2014-01', '1', '2014-06-01', '20', 'aaaaccqq', '1', '1', '1', null, '2014-06-18 14:14:55', '1', '2015-01-02 10:53:17', '1', '1');
INSERT INTO `backup_db_monthly` VALUES ('56', '1', '2014-02', '1', '2014-06-02', '20', 'aaaabddqq', '1', null, null, null, '2014-06-18 14:14:55', '1', '2014-06-18 15:50:07', '1', '1');
INSERT INTO `backup_db_monthly` VALUES ('57', '1', '2014-03', '1', '2014-06-03', '19', 'aaaabeeqq', '1', '1', null, null, '2014-06-18 14:14:55', '1', '2014-06-18 15:50:07', '1', '1');
INSERT INTO `backup_db_monthly` VALUES ('58', '1', '2014-04', '1', null, '19', 'avsssqqqq', '1', '1', '1', null, '2014-06-18 14:14:55', '1', '2014-06-18 15:50:07', '1', '1');
INSERT INTO `backup_db_monthly` VALUES ('59', '1', '2014-05', '1', null, '19', '', null, null, null, null, '2014-06-18 14:14:55', '1', '2014-06-18 15:50:07', '1', '1');
INSERT INTO `backup_db_monthly` VALUES ('60', '1', '2014-06', '1', null, '20', '', null, null, null, null, '2014-06-18 14:14:55', '1', '2014-06-18 15:50:07', '1', '1');
INSERT INTO `backup_db_monthly` VALUES ('61', '1', '2014-07', '1', null, '19', '', null, null, null, null, '2014-06-18 14:14:55', '1', '2014-06-18 15:50:07', '1', '1');
INSERT INTO `backup_db_monthly` VALUES ('62', '1', '2014-08', '1', null, '19', '', null, null, null, null, '2014-06-18 14:14:55', '1', '2014-06-18 15:50:07', '1', '1');
INSERT INTO `backup_db_monthly` VALUES ('63', '1', '2014-09', '1', null, '20', '', null, null, null, null, '2014-06-18 14:14:55', '1', '2014-06-18 15:50:07', '1', '1');
INSERT INTO `backup_db_monthly` VALUES ('64', '1', '2014-10', '1', null, '20', '', null, null, null, null, '2014-06-18 14:14:55', '1', '2014-06-18 15:50:07', '1', '1');
INSERT INTO `backup_db_monthly` VALUES ('65', '1', '2014-11', '1', null, '2', '', null, null, null, null, '2014-06-18 14:14:55', '1', '2014-06-18 15:50:07', '1', '1');
INSERT INTO `backup_db_monthly` VALUES ('66', '1', '2014-12', '1', null, '2', '', null, null, null, null, '2014-06-18 14:14:55', '1', '2014-06-18 15:50:07', '1', '1');
INSERT INTO `backup_db_monthly` VALUES ('67', '2', '2014-01', '1', '2014-06-01', '2', 'aaabbb', null, null, null, null, '2014-06-18 15:19:21', '1', '2014-06-18 15:51:33', '1', '1');
INSERT INTO `backup_db_monthly` VALUES ('68', '2', '2014-02', '1', '2014-06-02', '2', 'bbbccc', null, null, null, null, '2014-06-18 15:19:21', '1', '2014-06-18 15:51:33', '1', '1');
INSERT INTO `backup_db_monthly` VALUES ('69', '2', '2014-03', '1', '2014-06-03', '2', 'cccddd', null, null, null, null, '2014-06-18 15:19:21', '1', '2014-06-18 15:51:33', '1', '1');
INSERT INTO `backup_db_monthly` VALUES ('70', '2', '2014-04', '1', '2014-06-04', '2', 'dddeee', null, null, null, null, '2014-06-18 15:19:21', '1', '2014-06-18 15:51:33', '1', '1');
INSERT INTO `backup_db_monthly` VALUES ('71', '2', '2014-05', '1', null, '2', '', null, null, null, null, '2014-06-18 15:19:21', '1', '2014-06-18 15:51:33', '1', '1');
INSERT INTO `backup_db_monthly` VALUES ('72', '2', '2014-06', '1', null, '2', '', null, null, null, null, '2014-06-18 15:19:21', '1', '2014-06-18 15:51:33', '1', '1');
INSERT INTO `backup_db_monthly` VALUES ('73', '2', '2014-07', '1', null, '2', '', null, null, null, null, '2014-06-18 15:19:21', '1', '2014-06-18 15:51:33', '1', '1');
INSERT INTO `backup_db_monthly` VALUES ('74', '2', '2014-08', '1', null, '2', '', null, null, null, null, '2014-06-18 15:19:21', '1', '2014-06-18 15:51:33', '1', '1');
INSERT INTO `backup_db_monthly` VALUES ('75', '2', '2014-09', '1', null, '2', '', null, null, null, null, '2014-06-18 15:19:21', '1', '2014-06-18 15:51:33', '1', '1');
INSERT INTO `backup_db_monthly` VALUES ('76', '2', '2014-10', '1', null, '2', '', null, null, null, null, '2014-06-18 15:19:21', '1', '2014-06-18 15:51:33', '1', '1');
INSERT INTO `backup_db_monthly` VALUES ('77', '2', '2014-11', '1', null, '2', '', null, null, null, null, '2014-06-18 15:19:21', '1', '2014-06-18 15:51:33', '1', '1');
INSERT INTO `backup_db_monthly` VALUES ('78', '2', '2014-12', '1', null, '2', '', null, null, null, null, '2014-06-18 15:19:21', '1', '2014-06-18 15:51:33', '1', '1');
INSERT INTO `backup_db_monthly` VALUES ('79', '1', '2014-11', '1', '2014-11-30', '20', 'tes lagi', '1', '1', '1', null, '2014-12-29 08:57:02', '1', '2015-02-21 05:27:28', '1', '0');

-- ----------------------------
-- Table structure for `chat_history`
-- ----------------------------
DROP TABLE IF EXISTS `chat_history`;
CREATE TABLE `chat_history` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_user` int(10) DEFAULT NULL,
  `message_chat` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attach` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `log` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_created` int(10) DEFAULT NULL,
  `user_updated` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of chat_history
-- ----------------------------

-- ----------------------------
-- Table structure for `design_apps`
-- ----------------------------
DROP TABLE IF EXISTS `design_apps`;
CREATE TABLE `design_apps` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `project_id` int(10) DEFAULT NULL,
  `design_table_file` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc_table_file` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `design_form_file` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc_form_file` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rule` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remark` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `requirement_testing` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sit` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sit_date` date DEFAULT NULL,
  `status_sit` int(10) DEFAULT NULL,
  `user_created` int(10) DEFAULT NULL,
  `user_updated` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id1` (`project_id`),
  KEY `user_created7` (`user_created`),
  KEY `user_updated7` (`user_updated`),
  KEY `status_sit1` (`status_sit`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of design_apps
-- ----------------------------
INSERT INTO `design_apps` VALUES ('1', '1', null, 'Design table IT Management System - IT Development', null, 'Design Form IT Management System - IT Development Staff', 'Melakukan desain pada tabel dan form', 'IT Management System adalah sistem untuk memanajemen IT Development dalam pengerjaan sebuah proyek aplikasi', 'coba requirement', 'coba sit', '2014-12-16', '14', '1', '1', '2014-12-16 06:17:59', '2015-01-20 07:09:17');
INSERT INTO `design_apps` VALUES ('2', '4', '4.txt', 'coba donk', '4.pdf', 'lagi coba', 'tes lagi', 'tes lagi donk aahhh', 'Coba isi dulu aahhhh', 'Coba isi data testing', '2014-12-23', '13', '1', '1', '2014-12-22 01:57:42', '2014-12-22 09:38:02');
INSERT INTO `design_apps` VALUES ('3', '2', '2.pdf', 'veavavavaveavea', '2.pdf', 'evavavavavae', 'rule design', 'remark design', 'csacsaca', 'ceaeacacea', '2015-01-21', '13', '1', '1', '2015-01-19 06:44:42', '2015-01-23 10:40:33');
INSERT INTO `design_apps` VALUES ('4', '10', '10-designtable.jpg', 'Testing Design Table edit', '10-designform.jpg', 'Testing Design Form edit', 'Testing Rule edit', 'Testing Remark edit', 'Testing Requirement Testing', 'Testing SIT', '2015-01-08', '14', '4', '4', '2015-02-21 04:12:27', '2015-02-21 04:25:09');

-- ----------------------------
-- Table structure for `groups`
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `groups_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of groups
-- ----------------------------
INSERT INTO `groups` VALUES ('1', 'Admin', '{\"superuser\":1}', '2014-12-08 02:04:50', '2014-12-08 02:04:50');
INSERT INTO `groups` VALUES ('2', 'HeadITDev', '{\"superuser\":1}', '2014-12-11 02:13:55', '2014-12-23 02:22:30');
INSERT INTO `groups` VALUES ('3', 'SupervisorITDev', '{\"update-user-info\":1,\"view-task-list\":1,\"view-dailyBackupDB-list\":1,\"view-monthlyBackupDB-list\":1,\"approveitdspv-dailyBackupDB\":1,\"approveitdspv-monthlyBackupDB\":1}', '2014-12-11 02:14:48', '2015-01-02 10:29:13');
INSERT INTO `groups` VALUES ('4', 'CoordinatorITDev', '{\"update-user-info\":1,\"view-design-list\":1,\"view-design-detail\":1,\"create-design\":1,\"update-design\":1,\"view-testing-list\":1,\"update-testing\":1,\"create-testing\":1,\"view-task-list\":1,\"create-task\":1,\"update-task\":1,\"view-dailyreport-list\":1,\"update-dailyreport\":1,\"view-updateapps-list\":1,\"create-updateapps\":1,\"update-updateapps\":1,\"create-project\":1,\"update-project\":1,\"view-masterapps-list\":1,\"view-mastermodul-list\":1,\"view-masterprojecttype-list\":1,\"view-mastertasktype-list\":1,\"view-assesment-list\":1,\"create-assestment\":1,\"update-assestment\":1,\"view-uat-list\":1,\"create-uat\":1,\"update-uat\":1,\"view-training-list\":1,\"create-training\":1,\"update-training\":1,\"view-weeklymeeting-list\":1,\"view-projectdetail-list\":1,\"view-requestupdate-list\":1,\"create-requestupdate\":1,\"update-requestupdate\":1,\"view-project-list\":1}', '2014-12-11 02:15:20', '2015-01-05 02:16:21');
INSERT INTO `groups` VALUES ('5', 'StaffITDev', '{\"update-user-info\":1,\"view-task-list\":1,\"view-users-list\":1,\"view-design-list\":1,\"view-testing-list\":1,\"view-dailyreport-list\":1,\"view-updateapps-list\":1,\"view-masterapps-list\":1,\"view-mastermodul-list\":1,\"view-masterprojecttype-list\":1,\"view-mastertasktype-list\":1,\"approvedba-dailyBackupDB\":1,\"approvedba-monthlyBackupDB\":1,\"view-project-list\":1}', '2014-12-11 02:15:52', '2015-01-02 10:29:46');

-- ----------------------------
-- Table structure for `job_daily_report`
-- ----------------------------
DROP TABLE IF EXISTS `job_daily_report`;
CREATE TABLE `job_daily_report` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tasklist_id` int(10) DEFAULT NULL,
  `reference` int(10) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `job` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `target_finish` date DEFAULT NULL,
  `actual_finish_date` date DEFAULT NULL,
  `note` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_job_daily_report` int(10) DEFAULT NULL,
  `user_created` int(10) DEFAULT NULL,
  `user_updated` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tasklist_id1` (`tasklist_id`),
  KEY `user_created14` (`user_created`),
  KEY `user_updated14` (`user_updated`),
  KEY `status_job_daily_report1` (`status_job_daily_report`),
  CONSTRAINT `status_job_daily_report1` FOREIGN KEY (`status_job_daily_report`) REFERENCES `master_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tasklist_id1` FOREIGN KEY (`tasklist_id`) REFERENCES `tasklist` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of job_daily_report
-- ----------------------------
INSERT INTO `job_daily_report` VALUES ('1', '1', '1', '2014-12-23', 'Pengerjaan Modul Tasklist', 'Membuat modul tasklist', '2014-12-31', '2015-01-21', 'xacsacacacasacaca', '9', '1', '1', '2014-12-23 07:24:15', '2015-01-21 03:58:47');
INSERT INTO `job_daily_report` VALUES ('2', '2', '1', '2015-01-21', 'coba tasklist', 'csacacacaca', '2015-01-24', null, null, '6', '1', '1', '2015-01-21 03:23:56', '2015-01-21 03:23:56');
INSERT INTO `job_daily_report` VALUES ('3', '3', '6', '2015-01-23', 'coba lagi aahhh', 'cacaecacaca', '2015-01-23', '2015-01-20', 'Note Testing', '9', '1', '4', '2015-01-23 03:01:55', '2015-02-21 05:07:37');

-- ----------------------------
-- Table structure for `master_apps`
-- ----------------------------
DROP TABLE IF EXISTS `master_apps`;
CREATE TABLE `master_apps` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name_apps` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc_apps` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `build_date` date DEFAULT NULL,
  `development_by` int(10) DEFAULT NULL,
  `version` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activated` int(3) DEFAULT NULL,
  `user_created` int(10) DEFAULT NULL,
  `user_updated` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `development_by1` (`development_by`),
  KEY `user_created1` (`user_created`),
  KEY `user_updated1` (`user_updated`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of master_apps
-- ----------------------------
INSERT INTO `master_apps` VALUES ('3', 'coba', 'coba lagi', '2014-12-24', '1', 'coba aahhh', 'coba lagi', '1', '1', '1', '2014-12-23 10:44:46', '2015-01-19 02:35:00');
INSERT INTO `master_apps` VALUES ('4', 'ERP-PDT', 'ini coba dulu', '2015-01-14', '1', '1.0', 'siapa tahu berhasil', '1', '1', '1', '2015-01-14 06:46:58', '2015-01-19 02:34:53');
INSERT INTO `master_apps` VALUES ('5', 'itms', 'coba lagi', '2015-01-15', '1', '1.0', 'sacacascac', '1', '1', null, '2015-01-14 06:56:54', '2015-01-14 06:56:54');
INSERT INTO `master_apps` VALUES ('6', 'tes', 'masih penasaran', '2015-01-10', '1', '2.0', 'cacacaca', '1', '1', null, '2015-01-14 06:58:15', '2015-01-14 06:58:15');
INSERT INTO `master_apps` VALUES ('7', 'nclsknalck', 'camkcmsaklc', '2015-01-02', '1', '2.0', 'csacaca', '1', '1', null, '2015-01-14 06:59:00', '2015-01-14 06:59:00');
INSERT INTO `master_apps` VALUES ('8', 'coba lagi', 'bismillah', '2015-01-03', '1', '2.0', 'cacasca', '1', '1', null, '2015-01-14 07:08:58', '2015-01-14 07:08:58');
INSERT INTO `master_apps` VALUES ('9', 'coba lagi', 'csakcnalk', '2015-01-10', '1', '2.0', 'csacsac', '1', '1', null, '2015-01-14 07:17:35', '2015-01-14 07:17:35');
INSERT INTO `master_apps` VALUES ('10', 'csaca', 'cascacac', '2015-01-17', '1', '2.0', 'cacaca', '1', '1', null, '2015-01-14 08:09:07', '2015-01-14 08:09:07');
INSERT INTO `master_apps` VALUES ('11', 'cacadca', 'cdacacacac', '2015-01-15', '1', '1.2', 'csacsacasc', '1', '1', null, '2015-01-15 06:35:19', '2015-01-15 06:35:19');
INSERT INTO `master_apps` VALUES ('12', 'scacacacac', 'csacacacaca', '2015-01-15', '1', '1.2', 'csacacaceaca', '1', '1', null, '2015-01-15 06:38:14', '2015-01-15 06:38:14');
INSERT INTO `master_apps` VALUES ('13', 'cacadca', 'cadcacaca', '2015-01-03', '1', '1.2', 'cacaecacea', '1', '1', null, '2015-01-17 04:26:14', '2015-01-17 04:26:14');
INSERT INTO `master_apps` VALUES ('14', 'Testing Aplication Name Edit', 'Testing Application Description Edit', '2015-02-21', '4', 'Testing ve', 'Testing Note Edit', '1', '4', '4', '2015-02-21 03:04:17', '2015-02-21 03:50:02');

-- ----------------------------
-- Table structure for `master_db`
-- ----------------------------
DROP TABLE IF EXISTS `master_db`;
CREATE TABLE `master_db` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `server_name` varchar(255) DEFAULT NULL,
  `database_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `user_created` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_updated` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of master_db
-- ----------------------------
INSERT INTO `master_db` VALUES ('1', 'Server01', 'PDT', '2014-06-09 10:44:04', '1', '2015-01-21 08:24:52', '1', '1');
INSERT INTO `master_db` VALUES ('2', 'Server 25', 'All db Mysql', '2014-06-09 10:55:26', '1', '2015-01-21 08:24:47', '1', '0');
INSERT INTO `master_db` VALUES ('3', 'Server 33', 'ITMS', '2014-12-29 03:24:16', '1', '2014-12-29 03:24:16', null, '1');
INSERT INTO `master_db` VALUES ('4', 'cacecaeae', 'ceacacea', '2015-01-19 08:08:09', '1', '2015-01-19 08:08:21', '1', '0');
INSERT INTO `master_db` VALUES ('5', 'Testing databases Name Edit', 'testing Database Name Edit', '2015-02-21 05:14:37', '4', '2015-02-21 05:20:05', '4', '1');

-- ----------------------------
-- Table structure for `master_modul`
-- ----------------------------
DROP TABLE IF EXISTS `master_modul`;
CREATE TABLE `master_modul` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name_modul` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc_modul` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `master_apps_id` int(10) DEFAULT NULL,
  `activated` int(3) DEFAULT NULL,
  `user_created` int(10) DEFAULT NULL,
  `user_updated` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `apps_id1` (`master_apps_id`),
  KEY `user_created2` (`user_created`),
  KEY `user_updated2` (`user_updated`),
  CONSTRAINT `master_apps_id` FOREIGN KEY (`master_apps_id`) REFERENCES `master_apps` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of master_modul
-- ----------------------------
INSERT INTO `master_modul` VALUES ('2', 'coba modul', 'cawcaacawca', '5', '1', '1', '1', '2015-01-17 04:21:14', '2015-01-23 07:06:31');
INSERT INTO `master_modul` VALUES ('3', 'kucoba lagi', 'nlknkmjkmmkj', '5', '1', '1', '1', '2015-01-17 04:22:41', '2015-02-21 03:49:34');
INSERT INTO `master_modul` VALUES ('4', 'Modul Name Testing Edit', 'Testing Description Edit', '14', '1', '4', '4', '2015-02-21 03:09:07', '2015-02-21 03:54:16');

-- ----------------------------
-- Table structure for `master_status`
-- ----------------------------
DROP TABLE IF EXISTS `master_status`;
CREATE TABLE `master_status` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `group` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_desc` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activated` tinyint(1) DEFAULT NULL,
  `user_created` int(10) DEFAULT NULL,
  `user_updated` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of master_status
-- ----------------------------
INSERT INTO `master_status` VALUES ('1', 'project', 'open', 'Status Proyek Dimulai', '1', null, '1', null, '2015-01-19 02:31:32');
INSERT INTO `master_status` VALUES ('2', 'project', 'design', 'Status Proyek Tahap Desain', '1', null, '1', null, '2014-12-12 09:49:46');
INSERT INTO `master_status` VALUES ('3', 'project', 'testing', 'Status Proyek Tahap Testing', '1', null, '1', null, '2014-12-12 09:50:03');
INSERT INTO `master_status` VALUES ('4', 'project', 'close', 'Status Proyek Selesai', '1', null, '1', null, '2015-02-21 03:48:15');
INSERT INTO `master_status` VALUES ('5', 'tasklist', 'open', 'Status Tasklist Dimulai', '1', null, '1', null, '2015-02-21 03:48:12');
INSERT INTO `master_status` VALUES ('6', 'tasklist', 'in progress', 'Status Tasklist Dalam Tahap Pengerjaan', '1', null, '1', null, '2014-12-12 09:55:33');
INSERT INTO `master_status` VALUES ('7', 'tasklist', 'test request', 'Status Tasklist Dalam Tahap Permintaan Testing', '1', null, '1', null, '2014-12-12 09:55:47');
INSERT INTO `master_status` VALUES ('8', 'tasklist', 'revision', 'Status Tasklist Dalam Tahap Revisi', '1', null, '1', null, '2014-12-12 09:56:06');
INSERT INTO `master_status` VALUES ('9', 'tasklist', 'close', 'Status Tasklist Selesai', '1', null, '1', null, '2014-12-12 09:56:27');
INSERT INTO `master_status` VALUES ('10', 'priority', 'low', 'Status Prioritas Lemah', '1', null, '1', null, '2014-12-12 09:59:04');
INSERT INTO `master_status` VALUES ('11', 'priority', 'medium', 'Status Prioritas Sedang', '1', null, '1', null, '2014-12-12 09:59:22');
INSERT INTO `master_status` VALUES ('12', 'priority', 'high', 'Status Prioritas Tinggi', '1', null, '1', null, '2014-12-12 10:00:15');
INSERT INTO `master_status` VALUES ('13', 'sit', 'open', 'Status SIT Dimulai', '1', null, '1', null, '2014-12-12 10:00:32');
INSERT INTO `master_status` VALUES ('14', 'sit', 'pending', 'Status SIT Pending', '1', null, '1', null, '2014-12-12 10:00:53');
INSERT INTO `master_status` VALUES ('15', 'sit', 'close', 'Status SIT Selesai', '1', null, '1', null, '2014-12-12 10:01:09');
INSERT INTO `master_status` VALUES ('16', 'approveUpdate', 'open', 'Status Approval Update Aplikasi Dimulai', '1', null, '1', null, '2014-12-12 10:01:36');
INSERT INTO `master_status` VALUES ('17', 'approveUpdate', 'approve', 'Status Approval Update Aplikasi Disetujui', '1', null, '1', null, '2014-12-12 10:01:52');
INSERT INTO `master_status` VALUES ('18', 'approveUpdate', 'reject', 'Status Approval Update Aplikasi Ditolak', '1', null, '1', null, '2014-12-12 10:02:09');
INSERT INTO `master_status` VALUES ('19', 'backupDB', 'Success', 'Status Backup Database Sukses', '1', '1', null, '2014-12-17 07:32:08', '2014-12-17 07:32:08');
INSERT INTO `master_status` VALUES ('20', 'backupDB', 'Failed', 'Status Backup Database Gagal', '1', '1', null, '2014-12-17 07:32:46', '2014-12-17 07:32:46');
INSERT INTO `master_status` VALUES ('21', 'Testing Group', 'Testing nama Status', 'TEsting Dekripsi Status', '1', '4', null, '2015-02-21 03:21:15', '2015-02-21 03:21:15');
INSERT INTO `master_status` VALUES ('22', 'Testing Group 2', 'Testing nama Status ', 'TEsting Dekripsi Status 2', '1', '4', '4', '2015-02-21 03:21:30', '2015-02-21 03:24:26');

-- ----------------------------
-- Table structure for `master_task_type`
-- ----------------------------
DROP TABLE IF EXISTS `master_task_type`;
CREATE TABLE `master_task_type` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name_task_type` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc_task_type` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activated` int(3) DEFAULT NULL,
  `user_created` int(10) DEFAULT NULL,
  `user_updated` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_created3` (`user_created`),
  KEY `user_updated3` (`user_updated`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of master_task_type
-- ----------------------------
INSERT INTO `master_task_type` VALUES ('1', 'Coding Application', 'Melakukan pembuatan program pada aplikasi PDT', '1', '1', '1', null, '2014-12-12 09:35:04');
INSERT INTO `master_task_type` VALUES ('2', 'Setting Database', 'Melakukkan setting pada database', '1', '1', '1', null, '2015-01-19 02:43:12');
INSERT INTO `master_task_type` VALUES ('3', 'Managerial', 'Melakukan agenda diluar pemrograman', '1', '1', '1', null, '2015-01-19 02:43:18');
INSERT INTO `master_task_type` VALUES ('4', 'Other', 'melakukan kegiatan lain', '1', '1', '1', null, '2014-12-12 08:32:08');
INSERT INTO `master_task_type` VALUES ('5', 'Testing Nama Tipe Tugas ', 'Testing Deskripsi Tipe Tugas', '1', '4', null, '2015-02-21 03:16:49', '2015-02-21 03:16:49');
INSERT INTO `master_task_type` VALUES ('6', 'Testing Nama Tipe Tugas 2 Edit', 'Testing Deskripsi Tipe Tugas 2 Edit', '1', '4', '4', '2015-02-21 03:17:02', '2015-02-21 03:19:21');

-- ----------------------------
-- Table structure for `master_type_project`
-- ----------------------------
DROP TABLE IF EXISTS `master_type_project`;
CREATE TABLE `master_type_project` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name_project_type` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc_project_type` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activated` int(3) DEFAULT NULL,
  `user_created` int(10) DEFAULT NULL,
  `user_updated` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_created4` (`user_created`),
  KEY `user_updated4` (`user_updated`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of master_type_project
-- ----------------------------
INSERT INTO `master_type_project` VALUES ('1', 'New Application', 'Membuat aplikasi baru', '1', null, '1', null, '2014-12-12 09:37:37');
INSERT INTO `master_type_project` VALUES ('2', 'New Modul', 'Membuat modul baru', '1', null, '1', null, '2015-01-19 02:42:50');
INSERT INTO `master_type_project` VALUES ('3', 'Change Request', 'melakukan perubahan pada aplikasi', '1', null, '1', null, '2015-01-19 02:41:07');
INSERT INTO `master_type_project` VALUES ('4', 'Bugs', 'Mengatasi bugs pada aplikasi', '1', null, '1', null, '2014-12-12 09:38:05');
INSERT INTO `master_type_project` VALUES ('5', 'coba', 'nlcksnalcalkcn', '1', '1', null, '2015-01-22 10:27:21', '2015-01-22 10:27:21');
INSERT INTO `master_type_project` VALUES ('6', 'lagi donk', 'nclkancanclka', '1', '1', null, '2015-01-22 10:30:27', '2015-01-22 10:30:27');
INSERT INTO `master_type_project` VALUES ('7', 'Testing Tipe Projek Baru Edit', 'Deskripsi tipe project baru Edit', '1', '4', '4', '2015-02-21 03:12:14', '2015-02-21 03:51:09');

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('2012_12_06_225921_migration_cartalyst_sentry_install_users', '1');
INSERT INTO `migrations` VALUES ('2012_12_06_225929_migration_cartalyst_sentry_install_groups', '1');
INSERT INTO `migrations` VALUES ('2012_12_06_225945_migration_cartalyst_sentry_install_users_groups_pivot', '1');
INSERT INTO `migrations` VALUES ('2012_12_06_225988_migration_cartalyst_sentry_install_throttle', '1');
INSERT INTO `migrations` VALUES ('2013_07_16_172358_alter_user_table', '2');
INSERT INTO `migrations` VALUES ('2013_09_02_072804_create_permission_table', '2');
INSERT INTO `migrations` VALUES ('2013_09_08_191339_update_admin_group_permission', '2');
INSERT INTO `migrations` VALUES ('2014_05_05_212549_create_notifications_table', '3');
INSERT INTO `migrations` VALUES ('2014_05_05_212609_create_notifications_categories_table', '3');
INSERT INTO `migrations` VALUES ('2014_08_01_210813_create_notification_groups_table', '3');
INSERT INTO `migrations` VALUES ('2014_08_01_211045_create_notification_category_notification_group_table', '3');

-- ----------------------------
-- Table structure for `notifications`
-- ----------------------------
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_id` bigint(20) NOT NULL,
  `from_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `to_id` bigint(20) NOT NULL,
  `to_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` smallint(6) NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `extra` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `read` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `notifications_from_id_index` (`from_id`),
  KEY `notifications_from_type_index` (`from_type`),
  KEY `notifications_to_id_index` (`to_id`),
  KEY `notifications_to_type_index` (`to_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of notifications
-- ----------------------------

-- ----------------------------
-- Table structure for `notifications_categories_in_groups`
-- ----------------------------
DROP TABLE IF EXISTS `notifications_categories_in_groups`;
CREATE TABLE `notifications_categories_in_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_categories_in_groups_category_id_index` (`category_id`),
  KEY `notifications_categories_in_groups_group_id_index` (`group_id`),
  CONSTRAINT `category_id1` FOREIGN KEY (`category_id`) REFERENCES `notification_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `group_id1` FOREIGN KEY (`group_id`) REFERENCES `notification_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of notifications_categories_in_groups
-- ----------------------------
INSERT INTO `notifications_categories_in_groups` VALUES ('1', '2', '7');
INSERT INTO `notifications_categories_in_groups` VALUES ('2', '2', '13');
INSERT INTO `notifications_categories_in_groups` VALUES ('3', '1', '1');
INSERT INTO `notifications_categories_in_groups` VALUES ('4', '1', '2');
INSERT INTO `notifications_categories_in_groups` VALUES ('5', '1', '3');
INSERT INTO `notifications_categories_in_groups` VALUES ('6', '1', '4');
INSERT INTO `notifications_categories_in_groups` VALUES ('7', '1', '5');
INSERT INTO `notifications_categories_in_groups` VALUES ('8', '1', '6');
INSERT INTO `notifications_categories_in_groups` VALUES ('9', '1', '8');
INSERT INTO `notifications_categories_in_groups` VALUES ('10', '1', '9');
INSERT INTO `notifications_categories_in_groups` VALUES ('11', '1', '10');
INSERT INTO `notifications_categories_in_groups` VALUES ('12', '1', '11');
INSERT INTO `notifications_categories_in_groups` VALUES ('13', '1', '12');
INSERT INTO `notifications_categories_in_groups` VALUES ('14', '1', '14');
INSERT INTO `notifications_categories_in_groups` VALUES ('15', '1', '15');
INSERT INTO `notifications_categories_in_groups` VALUES ('16', '1', '16');
INSERT INTO `notifications_categories_in_groups` VALUES ('17', '1', '17');
INSERT INTO `notifications_categories_in_groups` VALUES ('18', '1', '18');
INSERT INTO `notifications_categories_in_groups` VALUES ('19', '1', '19');
INSERT INTO `notifications_categories_in_groups` VALUES ('20', '1', '20');
INSERT INTO `notifications_categories_in_groups` VALUES ('21', '1', '21');
INSERT INTO `notifications_categories_in_groups` VALUES ('22', '1', '22');
INSERT INTO `notifications_categories_in_groups` VALUES ('23', '1', '23');
INSERT INTO `notifications_categories_in_groups` VALUES ('24', '1', '24');
INSERT INTO `notifications_categories_in_groups` VALUES ('25', '1', '25');
INSERT INTO `notifications_categories_in_groups` VALUES ('26', '1', '26');
INSERT INTO `notifications_categories_in_groups` VALUES ('27', '1', '27');
INSERT INTO `notifications_categories_in_groups` VALUES ('28', '1', '28');
INSERT INTO `notifications_categories_in_groups` VALUES ('29', '1', '29');
INSERT INTO `notifications_categories_in_groups` VALUES ('30', '1', '30');

-- ----------------------------
-- Table structure for `notification_categories`
-- ----------------------------
DROP TABLE IF EXISTS `notification_categories`;
CREATE TABLE `notification_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `notification_categories_name_index` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of notification_categories
-- ----------------------------
INSERT INTO `notification_categories` VALUES ('1', 'notification', 'Notify ITMS', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `notification_categories` VALUES ('2', 'tasklist', 'Tasklist ITMS', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `notification_groups`
-- ----------------------------
DROP TABLE IF EXISTS `notification_groups`;
CREATE TABLE `notification_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `notification_groups_name_unique` (`name`),
  KEY `notification_groups_name_index` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of notification_groups
-- ----------------------------
INSERT INTO `notification_groups` VALUES ('23', 'apps.master');
INSERT INTO `notification_groups` VALUES ('2', 'assesment.apps');
INSERT INTO `notification_groups` VALUES ('15', 'assesment.report');
INSERT INTO `notification_groups` VALUES ('11', 'backupDaily.database');
INSERT INTO `notification_groups` VALUES ('12', 'backupMonthly.database');
INSERT INTO `notification_groups` VALUES ('18', 'dailyReport.report');
INSERT INTO `notification_groups` VALUES ('5', 'design.design');
INSERT INTO `notification_groups` VALUES ('16', 'design.report');
INSERT INTO `notification_groups` VALUES ('29', 'group.setting');
INSERT INTO `notification_groups` VALUES ('13', 'jobDaily.report');
INSERT INTO `notification_groups` VALUES ('10', 'master.database');
INSERT INTO `notification_groups` VALUES ('24', 'modul.master');
INSERT INTO `notification_groups` VALUES ('30', 'permission.setting');
INSERT INTO `notification_groups` VALUES ('1', 'project.apps');
INSERT INTO `notification_groups` VALUES ('14', 'project.report');
INSERT INTO `notification_groups` VALUES ('25', 'projectType.master');
INSERT INTO `notification_groups` VALUES ('27', 'status.master');
INSERT INTO `notification_groups` VALUES ('7', 'task.list');
INSERT INTO `notification_groups` VALUES ('17', 'tasklist.report');
INSERT INTO `notification_groups` VALUES ('26', 'taskType.master');
INSERT INTO `notification_groups` VALUES ('6', 'testing.design');
INSERT INTO `notification_groups` VALUES ('19', 'testing.report');
INSERT INTO `notification_groups` VALUES ('4', 'training.apps');
INSERT INTO `notification_groups` VALUES ('21', 'training.report');
INSERT INTO `notification_groups` VALUES ('3', 'uat.apps');
INSERT INTO `notification_groups` VALUES ('20', 'uat.report');
INSERT INTO `notification_groups` VALUES ('8', 'update.apps');
INSERT INTO `notification_groups` VALUES ('22', 'updateapps.report');
INSERT INTO `notification_groups` VALUES ('28', 'user.setting');
INSERT INTO `notification_groups` VALUES ('9', 'weekly.meeting');

-- ----------------------------
-- Table structure for `permissions`
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_value_unique` (`value`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES ('1', 'Super User', 'superuser', 'All permissions', '2014-12-08 02:04:49', '2014-12-08 02:04:49');
INSERT INTO `permissions` VALUES ('2', 'List Users', 'view-users-list', 'View the list of users', '2014-12-08 02:04:49', '2014-12-08 02:04:49');
INSERT INTO `permissions` VALUES ('3', 'Create user', 'create-user', 'Create new user', '2014-12-08 02:04:49', '2014-12-08 02:04:49');
INSERT INTO `permissions` VALUES ('4', 'Delete user', 'delete-user', 'Delete a user', '2014-12-08 02:04:49', '2014-12-08 02:04:49');
INSERT INTO `permissions` VALUES ('5', 'Update user', 'update-user-info', 'Update a user profile', '2014-12-08 02:04:49', '2014-12-08 02:04:49');
INSERT INTO `permissions` VALUES ('6', 'Update user group', 'user-group-management', 'Add/Remove a user in a group', '2014-12-08 02:04:49', '2014-12-08 02:04:49');
INSERT INTO `permissions` VALUES ('7', 'Groups management', 'groups-management', 'Manage group (CRUD)', '2014-12-08 02:04:50', '2014-12-08 02:04:50');
INSERT INTO `permissions` VALUES ('8', 'Permissions management', 'permissions-management', 'Manage permissions (CRUD)', '2014-12-08 02:04:50', '2014-12-08 02:04:50');
INSERT INTO `permissions` VALUES ('9', 'List Design', 'view-design-list', 'Lihat Daftar Design', '2014-12-08 04:35:29', '2014-12-08 04:43:46');
INSERT INTO `permissions` VALUES ('10', 'Detail Design', 'view-design-detail', 'Lihat Detail Design', '2014-12-08 04:36:56', '2014-12-08 04:44:14');
INSERT INTO `permissions` VALUES ('11', 'Create Design', 'create-design', 'Input Data Design Baru', '2014-12-08 04:38:17', '2014-12-08 04:44:48');
INSERT INTO `permissions` VALUES ('12', 'Delete Design', 'delete-design', 'Hapus Data Design', '2014-12-08 04:39:10', '2014-12-08 04:45:21');
INSERT INTO `permissions` VALUES ('13', 'Update Design', 'update-design', 'Ubah Data Design', '2014-12-08 04:40:23', '2014-12-08 04:50:03');
INSERT INTO `permissions` VALUES ('14', 'List Testing', 'view-testing-list', 'Lihat Daftar Testing', '2014-12-08 04:46:01', '2014-12-08 04:46:01');
INSERT INTO `permissions` VALUES ('15', 'Create Testing', 'create-testing', 'Input Data Testing Baru', '2014-12-08 04:48:27', '2014-12-08 04:48:27');
INSERT INTO `permissions` VALUES ('16', 'Delete Testing', 'delete-testing', 'Hapus Data Testing', '2014-12-08 04:49:13', '2014-12-08 04:49:13');
INSERT INTO `permissions` VALUES ('17', 'Update Testing', 'update-testing', 'Ubah Data Testing', '2014-12-08 04:50:50', '2014-12-08 04:50:50');
INSERT INTO `permissions` VALUES ('18', 'List Tugas', 'view-task-list', 'Lihat Daftar Tugas', '2014-12-08 04:52:07', '2014-12-08 04:52:07');
INSERT INTO `permissions` VALUES ('19', 'Detail Tugas', 'view-task-detail', 'Lihat Detail Tugas', '2014-12-08 04:53:04', '2014-12-08 04:53:04');
INSERT INTO `permissions` VALUES ('20', 'Create Tugas', 'create-task', 'Input Data Tugas Baru', '2014-12-08 04:53:46', '2014-12-08 04:53:46');
INSERT INTO `permissions` VALUES ('21', 'Delete Tugas', 'delete-task', 'Hapus Data Tugas', '2014-12-08 04:54:25', '2014-12-08 04:54:25');
INSERT INTO `permissions` VALUES ('22', 'Update Tugas', 'update-task', 'Ubah Data Tugas', '2014-12-08 04:55:13', '2014-12-08 04:55:13');
INSERT INTO `permissions` VALUES ('23', 'List Daily Report', 'view-dailyreport-list', 'Lihat Daftar Laporan Kerja Harian', '2014-12-08 04:56:58', '2014-12-08 04:56:58');
INSERT INTO `permissions` VALUES ('24', 'Update Daily Report', 'update-dailyreport', 'Ubah Data Daily Report', '2014-12-08 04:57:54', '2014-12-08 04:57:54');
INSERT INTO `permissions` VALUES ('25', 'List Update Aplikasi', 'view-updateapps-list', 'Lihat Daftar Upgrade Aplikasi', '2014-12-08 04:59:38', '2014-12-15 06:54:34');
INSERT INTO `permissions` VALUES ('26', 'Create Update Aplikasi', 'create-updateapps', 'Input Data Upgrade Aplikasi Baru', '2014-12-08 05:00:32', '2014-12-15 06:55:03');
INSERT INTO `permissions` VALUES ('27', 'Update Update Aplikasi', 'update-updateapps', 'Ubah Data Upgrade Aplikasi', '2014-12-08 05:01:24', '2014-12-15 06:55:44');
INSERT INTO `permissions` VALUES ('28', 'Create Design Detail', 'create-design-detail', 'Input Data Design Detail Baru', '2014-12-09 04:26:58', '2014-12-09 04:26:58');
INSERT INTO `permissions` VALUES ('29', 'Delete Design Detail', 'delete-design-detail', 'Hapus Data Design Detail', '2014-12-09 04:28:01', '2014-12-09 04:28:01');
INSERT INTO `permissions` VALUES ('30', 'Update Design Detail', 'update-design-detail', 'Ubah Data Design Detail', '2014-12-09 04:29:10', '2014-12-09 04:29:10');
INSERT INTO `permissions` VALUES ('31', 'Create Tugas Detail', 'create-task-detail', 'Input Data Tugas Detail Baru', '2014-12-09 04:30:01', '2014-12-09 04:30:01');
INSERT INTO `permissions` VALUES ('32', 'Delete Tugas Detail', 'delete-task-detail', 'Hapus Data Tugas Detail', '2014-12-09 04:30:43', '2014-12-09 04:30:43');
INSERT INTO `permissions` VALUES ('33', 'Update Tugas Detail', 'update-task-detail', 'Ubah Data Tugas Detail', '2014-12-09 04:31:38', '2014-12-09 04:31:38');
INSERT INTO `permissions` VALUES ('34', 'List Master Application', 'view-masterapps-list', 'Lihat Daftar Master Aplikasi', '2014-12-10 06:05:44', '2014-12-10 06:05:44');
INSERT INTO `permissions` VALUES ('35', 'Create Master Application', 'create-masterapps', 'Input Data Master Aplikasi Baru', '2014-12-10 06:06:36', '2014-12-10 06:06:36');
INSERT INTO `permissions` VALUES ('36', 'Update Master Application', 'update-masterapps', 'Ubah Data Master Aplikasi', '2014-12-10 06:07:16', '2014-12-10 06:07:16');
INSERT INTO `permissions` VALUES ('37', 'Delete Master Application', 'delete-masterapps', 'Hapus Data Master Aplikasi', '2014-12-10 06:07:56', '2014-12-10 06:07:56');
INSERT INTO `permissions` VALUES ('38', 'List Master Modul', 'view-mastermodul-list', 'Lihat Daftar Master Modul', '2014-12-10 06:08:48', '2014-12-10 06:08:48');
INSERT INTO `permissions` VALUES ('39', 'Create Master Modul', 'create-mastermodul', 'Input Data Master Modul Baru', '2014-12-10 06:09:19', '2014-12-10 06:09:19');
INSERT INTO `permissions` VALUES ('40', 'Update Master Modul', 'update-mastermodul', 'Ubah Data Master Modul', '2014-12-10 06:09:46', '2014-12-10 06:09:46');
INSERT INTO `permissions` VALUES ('41', 'Delete Master Modul', 'delete-mastermodul', 'Hapus Data Master Modul', '2014-12-10 06:10:37', '2014-12-10 06:10:37');
INSERT INTO `permissions` VALUES ('42', 'List Master Project Type', 'view-masterprojecttype-list', 'Lihat Daftar Master Tipe Proyek', '2014-12-10 06:11:55', '2014-12-10 06:11:55');
INSERT INTO `permissions` VALUES ('43', 'Create Master Project Type', 'create-masterprojecttype', 'Input Data Master Tipe Proyek Baru', '2014-12-10 06:12:30', '2014-12-10 06:12:30');
INSERT INTO `permissions` VALUES ('44', 'Update Master Project Type', 'update-masterprojecttype', 'Ubah Data Master Tipe Proyek', '2014-12-10 06:13:03', '2014-12-10 06:13:03');
INSERT INTO `permissions` VALUES ('45', 'Delete Master Project Type', 'delete-masterprojecttype', 'Hapus Data Master Tipe Proyek', '2014-12-10 06:13:37', '2014-12-10 06:13:37');
INSERT INTO `permissions` VALUES ('46', 'List Master Task Type', 'view-mastertasktype-list', 'Lihat Daftar Master Tipe Tugas', '2014-12-10 06:14:34', '2014-12-10 06:14:34');
INSERT INTO `permissions` VALUES ('47', 'Create Master Task Type', 'create-mastertasktype', 'Input Data Master Tipe Tugas Baru', '2014-12-10 06:15:08', '2014-12-10 06:15:08');
INSERT INTO `permissions` VALUES ('48', 'Update Master Task Type', 'update-mastertasktype', 'Ubah Data Master Tipe Tugas', '2014-12-10 06:16:50', '2014-12-10 06:16:50');
INSERT INTO `permissions` VALUES ('49', 'Delete Master Task Type', 'delete-mastertasktype', 'Hapus Data Master Tipe Tugas', '2014-12-10 06:17:25', '2014-12-10 06:17:25');
INSERT INTO `permissions` VALUES ('50', 'List Project ', 'view-project-list', 'Lihat Daftar Proyek', '2014-12-10 06:18:32', '2014-12-10 06:18:32');
INSERT INTO `permissions` VALUES ('51', 'Create Project', 'create-project', 'Input Data Proyek Baru', '2014-12-10 06:19:19', '2014-12-10 06:19:19');
INSERT INTO `permissions` VALUES ('52', 'Update Project', 'update-project', 'Ubah Data Proyek', '2014-12-10 06:19:57', '2014-12-10 06:19:57');
INSERT INTO `permissions` VALUES ('53', 'List Assestment', 'view-assesment-list', 'Lihat Daftar Assesment', '2014-12-10 06:22:11', '2014-12-10 06:22:11');
INSERT INTO `permissions` VALUES ('54', 'Create Assestment', 'create-assestment', 'Input Data Assestment Baru', '2014-12-10 06:23:13', '2014-12-10 06:23:13');
INSERT INTO `permissions` VALUES ('55', 'Update Assestment', 'update-assestment', 'Ubah Data Assestment', '2014-12-10 06:23:54', '2014-12-10 06:23:54');
INSERT INTO `permissions` VALUES ('56', 'List UAT', 'view-uat-list', 'Lihat Daftar UAT', '2014-12-10 06:25:04', '2014-12-10 06:25:04');
INSERT INTO `permissions` VALUES ('57', 'Create UAT', 'create-uat', 'Input Data UAT Baru', '2014-12-10 06:25:34', '2014-12-10 06:25:34');
INSERT INTO `permissions` VALUES ('58', 'Update UAT', 'update-uat', 'Ubah Data UAT', '2014-12-10 06:26:04', '2014-12-10 06:26:04');
INSERT INTO `permissions` VALUES ('59', 'Delete UAT', 'delete-uat', 'Hapus Data UAT', '2014-12-10 06:26:43', '2014-12-10 06:26:43');
INSERT INTO `permissions` VALUES ('60', 'List Training', 'view-training-list', 'Lihat Daftar Training', '2014-12-10 06:27:39', '2014-12-10 06:27:39');
INSERT INTO `permissions` VALUES ('61', 'Create Training', 'create-training', 'Input Data Training Baru', '2014-12-10 06:28:17', '2014-12-10 06:28:17');
INSERT INTO `permissions` VALUES ('62', 'Update Training', 'update-training', 'Ubah Data Training', '2014-12-10 06:28:49', '2014-12-10 06:28:49');
INSERT INTO `permissions` VALUES ('63', 'Delete Training', 'delete-training', 'Hapus Data Training', '2014-12-10 06:29:23', '2014-12-10 06:29:23');
INSERT INTO `permissions` VALUES ('68', 'Approve Update Application', 'approve-updateapps', 'Approval Update Aplikasi', '2014-12-10 06:33:47', '2014-12-10 06:33:47');
INSERT INTO `permissions` VALUES ('69', 'List Master Status', 'view-masterstatus-list', 'Lihat Daftar Master Status', '2014-12-10 09:28:14', '2014-12-10 09:28:14');
INSERT INTO `permissions` VALUES ('70', 'Update Master Status', 'update-masterstatus', 'Ubah Data Master Status', '2014-12-10 09:28:44', '2014-12-10 09:28:44');
INSERT INTO `permissions` VALUES ('71', 'Create Master Status', 'create-masterstatus', 'Input Data Master Status Baru', '2014-12-10 09:29:12', '2014-12-10 09:29:12');
INSERT INTO `permissions` VALUES ('72', 'List Weekly Meeting', 'view-weeklymeeting-list', 'Lihat Daftar Weekly Meeting', '2014-12-15 07:41:50', '2014-12-15 07:41:50');
INSERT INTO `permissions` VALUES ('73', 'Create Weekly Meeting', 'create-weeklymeeting', 'Input Data Weekly Meeting Baru', '2014-12-15 07:42:50', '2014-12-15 07:42:50');
INSERT INTO `permissions` VALUES ('74', 'Update Weekly Meeting', 'update-weeklymeeting', 'Ubah Data Weekly Meeting', '2014-12-15 07:43:39', '2014-12-15 07:43:39');
INSERT INTO `permissions` VALUES ('75', 'Detail Project Application', 'view-projectdetail-list', 'Lihat Detail Project', '2014-12-15 10:24:12', '2014-12-15 10:24:12');
INSERT INTO `permissions` VALUES ('76', 'List Report Project', 'view-reportproject-list', 'Lihat Laporan Proyek', '2014-12-18 05:01:15', '2014-12-18 05:01:15');
INSERT INTO `permissions` VALUES ('77', 'List Report Assesment', 'view-reportassesment-list', 'Lihat Laporan Assesment', '2014-12-18 05:09:54', '2014-12-18 05:09:54');
INSERT INTO `permissions` VALUES ('78', 'List Report Design', 'view-reportdesign-list', 'Lihat Laporan Design', '2014-12-18 05:10:34', '2014-12-18 05:10:34');
INSERT INTO `permissions` VALUES ('79', 'List Report Tasklist', 'view-reporttasklist-list', 'Lihat Laporan Tasklist', '2014-12-18 05:11:23', '2014-12-18 05:11:23');
INSERT INTO `permissions` VALUES ('80', 'List Report Daily Report', 'view-reportdailyreport-list', 'Lihat Laporan Kerja Harian', '2014-12-18 05:12:20', '2014-12-18 05:12:20');
INSERT INTO `permissions` VALUES ('81', 'List Report SIT', 'view-reportsit-list', 'Lihat Laporan SIT', '2014-12-18 05:13:10', '2014-12-18 05:13:10');
INSERT INTO `permissions` VALUES ('82', 'List Report UAT', 'view-reportuat-list', 'Lihat Laporan User Accept Test', '2014-12-18 05:13:47', '2014-12-18 05:13:47');
INSERT INTO `permissions` VALUES ('83', 'List Report Training', 'view-reporttraining-list', 'Lihat Laporan Training', '2014-12-18 05:14:18', '2014-12-18 05:14:18');
INSERT INTO `permissions` VALUES ('84', 'List Report Update Application', 'view-reportupdateapps-list', 'Lihat Laporan Aplikasi Update', '2014-12-18 05:14:54', '2014-12-18 05:14:54');
INSERT INTO `permissions` VALUES ('85', 'Reject Update Application', 'reject-updateapps', 'Reject Update Aplikasi', '2014-12-20 03:19:58', '2014-12-20 03:19:58');
INSERT INTO `permissions` VALUES ('86', 'Closed Status Project', 'close-project', 'Closed The Project Status', '2014-12-22 08:17:48', '2014-12-22 08:17:48');
INSERT INTO `permissions` VALUES ('87', 'List Master Database', 'view-masterDB-list', 'Lihat Master Database', '2014-12-24 07:30:09', '2014-12-24 07:30:09');
INSERT INTO `permissions` VALUES ('88', 'Create Master Database', 'create-masterDB', 'Input Data Master Database Baru', '2014-12-24 07:31:08', '2014-12-24 07:31:08');
INSERT INTO `permissions` VALUES ('89', 'Update Master Database', 'update-masterDB', 'Ubah Data Master Database', '2014-12-24 07:31:47', '2014-12-24 07:31:47');
INSERT INTO `permissions` VALUES ('90', 'List Daily Backup Database', 'view-dailyBackupDB-list', 'Lihat Data Backup Harian Database', '2014-12-24 07:34:24', '2014-12-24 07:34:24');
INSERT INTO `permissions` VALUES ('92', 'Create Daily Backup Database', 'create-dailyBackupDB', 'Input Data Backup Harian Database Baru', '2014-12-24 07:35:41', '2014-12-24 07:35:41');
INSERT INTO `permissions` VALUES ('93', 'Update Daily Backup Database', 'update-dailyBackupDB', 'Ubah Data Backup Harian Database', '2014-12-24 07:36:42', '2014-12-24 07:36:42');
INSERT INTO `permissions` VALUES ('94', 'Approval DBA Daily Backup Database', 'approvedba-dailyBackupDB', 'Approval DBA Backup Harian Database', '2014-12-24 07:37:30', '2015-01-02 08:12:24');
INSERT INTO `permissions` VALUES ('95', 'List Monthly Backup Database', 'view-monthlyBackupDB-list', 'Lihat Data Backup Bulanan Database', '2014-12-24 07:38:37', '2014-12-24 07:38:37');
INSERT INTO `permissions` VALUES ('96', 'Create Monthly Backup Database', 'create-monthlyBackupDB', 'Input Data Backup Bulanan Database Baru', '2014-12-24 07:39:27', '2014-12-24 07:39:27');
INSERT INTO `permissions` VALUES ('97', 'Update Monthly Backup Database', 'update-monthlyBackupDB', 'Ubah Data Backup Bulanan Database', '2014-12-24 07:40:00', '2014-12-24 07:40:00');
INSERT INTO `permissions` VALUES ('98', 'Approval DBA Monthly Backup Database', 'approvedba-monthlyBackupDB', 'Approval DBA Backup Bulanan Database', '2014-12-24 07:43:22', '2015-01-02 08:17:00');
INSERT INTO `permissions` VALUES ('99', 'Approval ITD SPV Daily Backup Database', 'approveitdspv-dailyBackupDB', 'Approval ITD Supervisor Backup Harian Database', '2015-01-02 08:16:27', '2015-01-02 08:16:27');
INSERT INTO `permissions` VALUES ('100', 'Approval ITD SPV Monthly Backup Database', 'approveitdspv-monthlyBackupDB', 'Approval ITD Supervisor Backup Bulanan Database', '2015-01-02 08:18:06', '2015-01-02 08:18:06');
INSERT INTO `permissions` VALUES ('101', 'Approval ITD Head Monthly Backup Database', 'approveitdhead-monthlyBackupDB', 'Approval ITD Head Backup Bulanan Database', '2015-01-02 08:18:44', '2015-01-02 08:18:44');
INSERT INTO `permissions` VALUES ('102', 'Search Project Report', 'search-reportProjects', 'Searching Project Report', '2015-01-06 03:18:49', '2015-01-06 03:18:49');
INSERT INTO `permissions` VALUES ('103', 'Search Assesment Report', 'search-reportAssesments', 'Searching Assesment Report', '2015-01-06 03:19:42', '2015-01-06 03:19:42');
INSERT INTO `permissions` VALUES ('104', 'Search Design Report', 'search-reportDesigns', 'Searching Design Report', '2015-01-06 03:23:23', '2015-01-06 03:23:23');
INSERT INTO `permissions` VALUES ('105', 'Search Task Report', 'search-reportTasklists', 'Searching Task Report', '2015-01-06 03:24:31', '2015-01-06 03:24:31');
INSERT INTO `permissions` VALUES ('106', 'Search Daily-Report Report', 'search-reportDailyReports', 'Searching Daily-Report Report', '2015-01-06 03:25:46', '2015-01-06 03:25:46');
INSERT INTO `permissions` VALUES ('107', 'Search SIT Report', 'search-reportSITs', 'Searching SIT Report', '2015-01-06 03:27:55', '2015-01-06 03:27:55');
INSERT INTO `permissions` VALUES ('108', 'Search UAT Report', 'search-reportUATs', 'Searching UAT Report', '2015-01-06 03:28:34', '2015-01-06 03:28:34');
INSERT INTO `permissions` VALUES ('109', 'Search Training Report', 'search-reportTrainings', 'Searching Training Report', '2015-01-06 03:29:26', '2015-01-06 03:29:26');
INSERT INTO `permissions` VALUES ('110', 'Search Update Application Report', 'search-reportUpdateAppss', 'Searching Update Application Report', '2015-01-06 03:30:51', '2015-01-06 03:30:51');
INSERT INTO `permissions` VALUES ('111', 'Detail Tasklist Report', 'view-reporttasklist-detail', 'Lihat Detail Laporan Tasklist', '2015-01-09 10:02:00', '2015-01-09 10:02:00');
INSERT INTO `permissions` VALUES ('112', 'Detail Application Update Report', 'view-reportupdateapps-detail', 'Lihat Detail Laporan Update Aplikasi', '2015-01-09 10:02:54', '2015-01-09 10:02:54');
INSERT INTO `permissions` VALUES ('113', 'Activated', 'activated', 'Aktifasi', '2015-01-15 09:39:40', '2015-01-15 09:39:40');
INSERT INTO `permissions` VALUES ('114', 'Non Activated', 'non-activated', 'Non-Aktifasi', '2015-01-15 09:40:16', '2015-01-15 09:40:16');
INSERT INTO `permissions` VALUES ('115', 'Activated Application Master', 'activated-masterapps', 'Aktifasi Master Aplikasi', '2015-01-17 05:04:55', '2015-01-17 05:04:55');
INSERT INTO `permissions` VALUES ('116', 'Non Activated Application Master', 'non-activated-masterapps', 'Non-Aktifasi Master Aplikasi', '2015-01-17 05:05:31', '2015-01-17 05:05:31');
INSERT INTO `permissions` VALUES ('117', 'Activated Modul Master', 'activated-mastermodul', 'Aktifasi Master Modul', '2015-01-17 05:06:08', '2015-01-17 05:06:08');
INSERT INTO `permissions` VALUES ('118', 'Non Activated Modul Master', 'non-activated-mastermodul', 'Non-Aktifasi Master Modul', '2015-01-17 05:07:04', '2015-01-17 05:07:04');
INSERT INTO `permissions` VALUES ('119', 'Activated Project Type Master', 'activated-masterprojecttype', 'Aktifasi Master Tipe Proyek', '2015-01-17 05:07:57', '2015-01-17 05:07:57');
INSERT INTO `permissions` VALUES ('120', 'Activated Task Type Master', 'activated-mastertasktype', 'Aktifasi Master Tipe Tugas', '2015-01-17 05:08:49', '2015-01-17 05:08:49');
INSERT INTO `permissions` VALUES ('121', 'Non Activated Project Type Master', 'non-activated-masterprojecttype', 'Non-Aktifasi Master Tipe Proyek', '2015-01-17 05:09:26', '2015-01-17 05:09:26');
INSERT INTO `permissions` VALUES ('122', 'Non Activated Task Type Master', 'non-activated-mastertasktype', 'Non-Aktifasi Master Tipe Tugas', '2015-01-17 05:09:59', '2015-01-17 05:09:59');
INSERT INTO `permissions` VALUES ('123', 'Activated Database Master', 'activated-masterDB', 'Aktifasi Master Database', '2015-01-21 08:20:28', '2015-01-21 08:20:28');
INSERT INTO `permissions` VALUES ('124', 'Non Activated Database Master', 'non-activated-masterDB', 'Non-Aktifasi Master Database', '2015-01-21 08:20:59', '2015-01-21 08:20:59');

-- ----------------------------
-- Table structure for `project`
-- ----------------------------
DROP TABLE IF EXISTS `project`;
CREATE TABLE `project` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name_project` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reference` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc_project` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `master_apps_id` int(10) DEFAULT NULL,
  `master_modul_id` int(10) DEFAULT NULL,
  `master_type_project_id` int(10) DEFAULT NULL,
  `user_request` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `project_request_date` date DEFAULT NULL,
  `assesment_date` date DEFAULT NULL,
  `assesment_user` int(10) DEFAULT NULL,
  `assesment_note` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `training_target` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `training_actual_date` date DEFAULT NULL,
  `trainer` int(10) DEFAULT NULL,
  `update_apps_id` int(10) DEFAULT NULL,
  `status_project_request` int(10) DEFAULT NULL,
  `manual_book_file` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `doc_project_file` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_created` int(10) DEFAULT NULL,
  `user_updated` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of project
-- ----------------------------
INSERT INTO `project` VALUES ('1', 'IT Management System', 'yudhis123456', 'Aplikasi IT Manajement Sistem untuk departemen IT development', '5', '2', '1', 'Ndaru Ruseno', '2014-12-17', '2014-12-16', '1', 'Coba lagi', 'IT Development', '2014-12-18', '2', '1', '3', 'KMS.png', 'KMS.png', '1', '1', '2014-12-17 09:38:52', '2015-01-20 07:09:17');
INSERT INTO `project` VALUES ('2', 'KMS', 'riyan12345', 'Knowledge Management System', '5', '2', '1', 'Ndaru Ruseno', '2014-12-19', '2015-01-20', '2', 'csacacaca', null, null, '3', '2', '3', 'KMS.png', 'KMS.png', '1', '1', '2014-12-19 06:40:30', '2015-01-21 02:29:50');
INSERT INTO `project` VALUES ('3', 'DMS', 'Ndaru', 'Document Management System', '5', '2', '1', 'Ndaru Ruseno', '2014-12-19', null, '3', null, null, null, '3', '1', '4', 'DMS.pdf', 'DMS.pdf', '1', null, '2014-12-19 06:49:43', '2014-12-19 06:49:43');
INSERT INTO `project` VALUES ('4', 'KMS', 'riyan12345', 'Knowledge Management System', '5', '2', '2', 'Ndaru Ruseno', '2014-12-19', null, '4', null, null, null, '1', '1', '3', 'KMS.apiguide.pdf', 'KMS.apiguide.pdf', '1', null, '2014-12-19 06:52:44', '2014-12-22 09:38:02');
INSERT INTO `project` VALUES ('5', 'KMS', 'yudhis123456', 'Knowledge Management System', '5', '2', '1', 'Ndaru Ruseno', '2014-12-19', null, '5', null, null, null, '2', null, '4', 'KMS.png', 'KMS.png', '1', null, '2014-12-19 08:21:10', '2015-02-21 03:58:01');
INSERT INTO `project` VALUES ('6', 'yudhis', 'fathur123456', 'yudhis project', '7', '3', '1', 'Ndaru Ruseno', '2014-12-19', null, '1', null, 'cacaca', '2015-01-21', '3', '6', '1', 'yudhis.pdf', 'yudhis.pdf', '1', '1', '2014-12-19 08:31:07', '2015-01-21 02:34:23');
INSERT INTO `project` VALUES ('7', 'test', 'csacaca', 'cascacascac', '7', '3', '1', 'Ndaru Ruseno', '2015-01-16', '2015-01-20', '1', 'scacacaca', 'csacaacaa', '2015-01-20', '4', null, '1', 'dacaca.pdf', 'dacaca.pdf', '1', '1', '2015-01-16 07:06:59', '2015-01-19 03:42:13');
INSERT INTO `project` VALUES ('8', 'dacaca', 'cdacaca', 'cdacacacad', '7', '3', '1', 'riyan', '2015-01-16', '2015-01-13', null, 'ascacacaaeca', null, null, null, null, '1', 'dacaca.pdf', 'dacaca.js', '1', '1', '2015-01-16 07:35:41', '2015-01-19 03:30:30');
INSERT INTO `project` VALUES ('9', 'Project coba', 'caawcwacawca', 'cwacacacwacacwa', '5', '2', '1', 'riyan', '2015-01-17', '2015-01-13', null, 'cacacacwcaca', null, null, null, null, '1', 'ckenalcnalicnai.pdf', 'ckenalcnalicnai.pdf', '1', '1', '2015-01-17 04:32:16', '2015-01-23 10:33:11');
INSERT INTO `project` VALUES ('10', 'Project Name Testing Edit', 'Reference Number Testing Edit', 'Project Description Testing Edit', '14', '4', '7', 'User Request Testing Edit', '2015-02-21', '2015-01-22', '4', 'TEsting Note', 'Testing Training Target ', '2015-01-09', '3', '10', '3', 'Project Name Testing Edit-manualbook.jpg', 'Project Name Testing-docproject.jpg', '4', '4', '2015-02-21 03:55:01', '2015-02-21 04:40:24');

-- ----------------------------
-- Table structure for `tasklist`
-- ----------------------------
DROP TABLE IF EXISTS `tasklist`;
CREATE TABLE `tasklist` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `assignment_from` int(10) DEFAULT NULL,
  `assignment_to` int(10) DEFAULT NULL,
  `subject` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc_tasklist` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `assignment_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `status_tasklist` int(10) DEFAULT NULL,
  `reference` int(10) DEFAULT NULL,
  `master_task_type_id` int(10) DEFAULT NULL,
  `actual_finish_date` date DEFAULT NULL,
  `close_by` int(10) DEFAULT NULL,
  `parameter_reminder` int(2) DEFAULT NULL,
  `upload_file` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `priority` int(10) DEFAULT NULL,
  `user_created` int(10) DEFAULT NULL,
  `user_updated` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `assignment_from1` (`assignment_from`),
  KEY `assignment_to` (`assignment_to`),
  KEY `reference1` (`reference`),
  KEY `task_type_id1` (`master_task_type_id`),
  KEY `user_created8` (`user_created`),
  KEY `user_updated8` (`user_updated`),
  KEY `status_tasklist1` (`status_tasklist`),
  KEY `priority1` (`priority`),
  KEY `close_by1` (`close_by`),
  CONSTRAINT `close_by1` FOREIGN KEY (`close_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tasklist
-- ----------------------------
INSERT INTO `tasklist` VALUES ('1', '1', '3', 'Pengerjaan Modul Tasklist', 'Membuat modul tasklist', '2014-12-16', '2014-12-18', '7', '1', '1', '2015-01-21', '1', '1', null, '11', '1', '1', '2014-12-16 08:01:13', '2015-01-21 03:58:47');
INSERT INTO `tasklist` VALUES ('2', '1', '3', 'tasklist', 'coba lagi tasklist nya...', '2015-01-20', '2015-01-22', '6', '1', '2', null, null, '3', 'coba tasklist.pdf', '12', '1', '1', '2015-01-21 02:49:20', '2015-01-23 10:11:42');
INSERT INTO `tasklist` VALUES ('3', '1', '4', 'coba lagi aahhh', 'cacaecacaca', '2015-01-19', '2015-01-23', '5', '6', '2', '2015-01-20', '4', '2', 'coba lagi aahhh.pdf', '12', '1', null, '2015-01-21 02:54:08', '2015-02-21 05:07:37');
INSERT INTO `tasklist` VALUES ('4', '4', '3', 'Testing Subject edit', 'Tasklist Description Testing edit', '2015-01-21', '2015-01-18', '5', '10', '1', null, null, '5', 'Testing Subject.jpg', '12', '4', '4', '2015-02-21 04:50:51', '2015-02-21 04:52:35');

-- ----------------------------
-- Table structure for `throttle`
-- ----------------------------
DROP TABLE IF EXISTS `throttle`;
CREATE TABLE `throttle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attempts` int(11) NOT NULL DEFAULT '0',
  `suspended` tinyint(1) NOT NULL DEFAULT '0',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `last_attempt_at` timestamp NULL DEFAULT NULL,
  `suspended_at` timestamp NULL DEFAULT NULL,
  `banned_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `throttle_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of throttle
-- ----------------------------
INSERT INTO `throttle` VALUES ('1', '1', '::1', '0', '0', '0', null, null, null);
INSERT INTO `throttle` VALUES ('2', '1', '127.0.0.1', '0', '0', '0', null, null, null);
INSERT INTO `throttle` VALUES ('3', '2', null, '0', '0', '0', '2015-01-02 10:14:21', null, null);
INSERT INTO `throttle` VALUES ('4', '3', null, '0', '0', '0', null, null, null);
INSERT INTO `throttle` VALUES ('5', '4', null, '0', '0', '0', '2015-02-14 02:44:03', null, null);
INSERT INTO `throttle` VALUES ('6', '5', null, '0', '0', '0', null, null, null);
INSERT INTO `throttle` VALUES ('7', '6', null, '0', '0', '0', null, null, null);
INSERT INTO `throttle` VALUES ('8', '7', null, '0', '0', '0', null, null, null);
INSERT INTO `throttle` VALUES ('9', '1', '192.168.0.150', '0', '0', '0', null, null, null);

-- ----------------------------
-- Table structure for `uat`
-- ----------------------------
DROP TABLE IF EXISTS `uat`;
CREATE TABLE `uat` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sequence` int(10) DEFAULT NULL,
  `project_apps_id` int(10) DEFAULT NULL,
  `uat_target` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uat_actual_date` date DEFAULT NULL,
  `uat_user` int(10) DEFAULT NULL,
  `uat_note` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uat_revision` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_created` int(10) DEFAULT NULL,
  `user_updated` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uat_user1` (`uat_user`),
  KEY `user_created10` (`user_created`),
  KEY `user_updated10` (`user_updated`),
  KEY `project_apps_id4` (`project_apps_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of uat
-- ----------------------------
INSERT INTO `uat` VALUES ('1', '1', '1', 'Target untuk Departemen IT Development', '2014-12-18', '4', 'coba test', '1.0', '1', '1', '2014-12-17 06:28:43', '2015-01-19 06:40:01');
INSERT INTO `uat` VALUES ('2', '1', '2', 'All Department', '2014-12-23', '1', 'coba dulu', '2.0', '1', '1', '2014-12-22 04:59:45', '2015-01-12 03:22:26');
INSERT INTO `uat` VALUES ('3', '3', '1', 'scacsa', '2015-01-03', '2', 'acaca', '1.1', '1', null, '2015-01-13 07:17:10', '2015-01-13 07:17:10');
INSERT INTO `uat` VALUES ('4', '2', '1', 'acacdaca', '2015-01-02', '3', 'coba UAT', '2.0', '1', '1', '2015-01-19 06:38:30', '2015-01-23 07:28:55');
INSERT INTO `uat` VALUES ('5', '2', '10', 'Testing User Accept Test Target edit', '2015-01-07', '3', 'Note Testing edit', 'Testing Revision edit', '4', '4', '2015-02-21 04:25:09', '2015-02-21 04:29:04');

-- ----------------------------
-- Table structure for `update_app`
-- ----------------------------
DROP TABLE IF EXISTS `update_app`;
CREATE TABLE `update_app` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `project_id` int(10) DEFAULT NULL,
  `filename_update` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `database_change` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apps_change` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remark` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apps_version` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_request` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `request_date` date DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  `status_update_apps` int(10) DEFAULT NULL,
  `user_confirmation` int(10) DEFAULT NULL,
  `confirmation_date` date DEFAULT NULL,
  `pic` int(10) DEFAULT NULL,
  `user_created` int(10) DEFAULT NULL,
  `user_updated` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of update_app
-- ----------------------------
INSERT INTO `update_app` VALUES ('1', '2', 'Modul Report', 'membuat table report', 'membuat modul report', 'coba remark', '1.0', 'Ndaru Ruseno', '2014-12-14', '2014-12-17', '17', '1', '2015-01-22', '2', '1', '1', '2014-12-18 02:01:21', '2015-01-22 08:18:19');
INSERT INTO `update_app` VALUES ('2', '2', 'cacacaca', 'csacacacaca', 'csacacacac', 'ceacaca', '2.0', 'Ndaru Ruseno', '2015-01-17', '2015-01-22', '18', '1', '2015-01-22', '3', '1', '1', '2015-01-21 02:29:50', '2015-01-22 08:18:27');
INSERT INTO `update_app` VALUES ('3', '1', 'ceacaaca', 'ganti database', 'ganti modul aplikasi', 'ceacaaca', '2.0', 'Ndaru Ruseno', '2015-01-22', '2015-01-20', '18', '4', '2015-02-21', '4', '1', '4', '2015-01-21 02:34:23', '2015-02-21 04:43:06');
INSERT INTO `update_app` VALUES ('4', '10', 'Filename Update TEsting Edit', 'Change in Database Testing Edit', 'Change in Application Testing Edit', 'Remark Testing Edit', 'Applicatio', 'User Request Testing', '2015-01-09', '2015-01-15', '17', '4', '2015-02-21', '4', '4', '4', '2015-02-21 04:40:24', '2015-02-21 04:43:03');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `activation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `password_expired_date` date DEFAULT NULL,
  `persist_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_password_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`),
  KEY `users_activation_code_index` (`activation_code`),
  KEY `users_reset_password_code_index` (`reset_password_code`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'yudhistiro@pancaran-group.com', 'Yudhistiro', '$2y$10$.noihK.NhVAkSkxFTVL6weVMxwxZSFedqbzbY2mLBHuvTmIoJAk3C', null, '', '1', null, '2014-12-08 02:05:40', '2015-01-29 02:06:25', null, '$2y$10$NtLdchGzygOKiHRPhtv06eJKcKMAuMQXUDhe6qu1Ee2nPVg0Iluhm', null, 'Yudhistiro', 'TriAronggo', '2014-12-08 02:05:40', '2015-01-29 02:06:25');
INSERT INTO `users` VALUES ('2', 'fathur@pancaran-group.com', 'fathur', '$2y$10$NDsOj0VXmV0ehoE0LX6R.ut0lRT7SUJ.ryE5JI6Mfa8OrGciKI5Hm', null, '{\"view-project-list\":1}', '1', null, '2014-12-16 03:44:46', '2015-01-05 10:37:45', null, '$2y$10$w0UYpXem.VVJOfETQkpnk.OeavqUmHwYWqzwGnTmlap2FJud.mnxC', null, 'Rohman', 'Fathur', '2014-12-16 03:44:46', '2015-01-05 10:37:45');
INSERT INTO `users` VALUES ('3', 'riyan@pancaran-group.com', 'riyan', '$2y$10$MOeVc9MwLC.a8pWp0jE1/O4ggjjc15w8YzlqyJrtRNv68BTAtTSpy', null, '', '1', null, '2014-12-16 03:45:21', '2015-01-02 10:43:04', null, '$2y$10$fFNuDqTHRqTzedXzOUE2K.dh1zPlsQhF2gnj1G9NDSBuhq8Uz.o6S', null, 'Aprianto', 'Riyan', '2014-12-16 03:45:21', '2015-01-02 10:43:04');
INSERT INTO `users` VALUES ('4', 'ndaru@pancaran-group.com', 'ndaru', '$2y$10$sN31HQaYWYX8gl2hXl35oeR2i4ieh4.S4lyN7yVBLDQ5nXH/GlTK2', null, '', '1', null, '2014-12-23 02:21:46', '2015-02-21 02:06:34', null, '$2y$10$lFVANs9.Ook2mERA9bpB0ur3.vHBdVfT8qNQRiwLEHCNvaaOOBv0y', null, 'Ndaru', 'Ruseno', '2014-12-23 02:21:45', '2015-02-21 02:06:34');
INSERT INTO `users` VALUES ('5', 'upi@pancaran-group.com', 'upi', '$2y$10$zUU4Mt9hTZJv687vEZ/n2uVViRu169T72.P4Y1Tv8NICgsFqPMzq6', null, '', '1', null, '2015-01-05 02:03:53', '2015-01-05 06:23:16', null, '$2y$10$DtSljf/3oiZ4jVybFssSE..X2ROrDO40z2nNf1n5TkHZFDU5jFv3O', null, 'StaffPDT', 'Upi', '2015-01-05 02:03:53', '2015-01-05 06:23:16');
INSERT INTO `users` VALUES ('6', 'sangaji@pancaran-group.com', 'aji', '$2y$10$33B1LevaOOf4.7sNIGn3lug7UmSdEkUa50j1gZMQcC18BHG9wTqUi', null, '{\"view-project-list\":1}', '1', null, '2015-01-05 02:07:46', '2015-01-05 10:38:18', null, '$2y$10$EGe103qgJY9oMGTVtplCvu1r.7XTQ3hYtS4htO60ruzRFKzqy3qq2', null, 'Sangaji', 'Fadlil', '2015-01-05 02:07:45', '2015-01-05 10:38:18');
INSERT INTO `users` VALUES ('7', 'djanu@pancaran-group.com', 'djanu', '$2y$10$XJcu48NhlEliNa8PlQgTgO2ziLgfupC/JzOMLYQRSaB9B49iwtyp.', null, '', '1', null, '2015-01-05 02:08:19', null, null, null, null, '', 'Djanu', '2015-01-05 02:08:19', '2015-01-05 02:08:19');

-- ----------------------------
-- Table structure for `users_groups`
-- ----------------------------
DROP TABLE IF EXISTS `users_groups`;
CREATE TABLE `users_groups` (
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users_groups
-- ----------------------------
INSERT INTO `users_groups` VALUES ('1', '1');
INSERT INTO `users_groups` VALUES ('2', '3');
INSERT INTO `users_groups` VALUES ('3', '5');
INSERT INTO `users_groups` VALUES ('4', '1');
INSERT INTO `users_groups` VALUES ('4', '2');
INSERT INTO `users_groups` VALUES ('5', '5');
INSERT INTO `users_groups` VALUES ('6', '4');
INSERT INTO `users_groups` VALUES ('7', '5');

-- ----------------------------
-- Table structure for `weekly_meeting`
-- ----------------------------
DROP TABLE IF EXISTS `weekly_meeting`;
CREATE TABLE `weekly_meeting` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `weekly_meeting_date` date DEFAULT NULL,
  `weekly_meeting_user` int(10) DEFAULT NULL,
  `weekly_meeting_note` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_created` int(10) DEFAULT NULL,
  `user_updated` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of weekly_meeting
-- ----------------------------
INSERT INTO `weekly_meeting` VALUES ('1', '2014-12-16', '15', 'Membahas tentang progress minggu lalu dan target minggu ini', '1', '1', '2014-12-18 03:41:24', '2015-01-19 07:59:46');
INSERT INTO `weekly_meeting` VALUES ('2', '2015-01-19', '5', 'membahas apa saja boleh', '1', null, '2015-01-19 08:00:17', '2015-01-19 08:00:17');
INSERT INTO `weekly_meeting` VALUES ('3', '2015-01-09', '5', 'Weekly Meeting Note Test Edit', '4', '4', '2015-02-21 05:10:56', '2015-02-21 05:11:57');

-- ----------------------------
-- Event structure for `daily_report_scheduler`
-- ----------------------------
DROP EVENT IF EXISTS `daily_report_scheduler`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` EVENT `daily_report_scheduler` ON SCHEDULE EVERY 1 DAY STARTS '2014-12-30 13:54:49' ON COMPLETION NOT PRESERVE ENABLE DO INSERT INTO autoemail (id,id_job_daily_report,mailto,mailfrom,cc,judul,subject,message,created_at,user_created,updated_at,user_updated,status_sent)
VALUES (
	(SELECT MAX(aem.id)+1
	FROM autoemail aem
	JOIN job_daily_report jdr ON jdr.id = aem.id_job_daily_report
	WHERE jdr.target_finish = DATE(NOW())),
	(SELECT id FROM job_daily_report WHERE target_finish = DATE(NOW())),
	'ndaru@pancaran-group.com', 
	'yudhistiro@pancaran-group.com',
	'riyan@pancaran-group.com',
	(SELECT job FROM job_daily_report),
	(SELECT job FROM job_daily_report),
	(SELECT description FROM job_daily_report),
	(SELECT NOW() FROM job_daily_report WHERE target_finish = DATE(NOW())),
	(SELECT 1 FROM job_daily_report WHERE target_finish = DATE(NOW())),
	(SELECT NOW() FROM job_daily_report WHERE target_finish = DATE(NOW())),
	(SELECT 1 FROM job_daily_report WHERE target_finish = DATE(NOW())),
	(SELECT 0 FROM job_daily_report WHERE target_finish = DATE(NOW()))
)
;
;;
DELIMITER ;
