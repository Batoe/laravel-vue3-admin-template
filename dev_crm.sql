/*
 Navicat Premium Data Transfer

 Source Server         : 本地
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : 127.0.0.1:3306
 Source Schema         : dev_crm

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 23/08/2022 17:25:28
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for coding
-- ----------------------------
DROP TABLE IF EXISTS `coding`;
CREATE TABLE `coding`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '编号',
  `type` tinyint(1) NULL DEFAULT NULL COMMENT '类型：1-销售，2-采购，3-出库，4-入库',
  `used` tinyint(1) NULL DEFAULT 0 COMMENT '是否使用：0-未使用，1-已使用',
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 68 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '编码维护' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of coding
-- ----------------------------
INSERT INTO `coding` VALUES (1, 'RK202208190001', 4, 0, '2022-08-19 00:48:38', '2022-08-19 00:48:38', NULL);
INSERT INTO `coding` VALUES (2, 'RK202208190002', 4, 0, '2022-08-19 00:56:27', '2022-08-19 00:56:27', NULL);
INSERT INTO `coding` VALUES (3, 'RK202208190003', 4, 0, '2022-08-19 00:56:40', '2022-08-19 00:56:40', NULL);
INSERT INTO `coding` VALUES (4, 'RK202208190004', 4, 0, '2022-08-19 00:57:37', '2022-08-19 00:57:37', NULL);
INSERT INTO `coding` VALUES (5, 'RK202208190005', 4, 0, '2022-08-19 00:59:46', '2022-08-19 00:59:46', NULL);
INSERT INTO `coding` VALUES (6, 'CK202208190001', 3, 0, '2022-08-19 01:02:14', '2022-08-19 01:02:14', NULL);
INSERT INTO `coding` VALUES (7, 'RK202208190006', 4, 0, '2022-08-19 02:08:48', '2022-08-19 02:08:48', NULL);
INSERT INTO `coding` VALUES (8, 'XS202208200001', 1, 0, '2022-08-20 17:08:35', '2022-08-20 17:08:35', NULL);
INSERT INTO `coding` VALUES (9, 'XS202208220001', 1, 0, '2022-08-22 08:39:21', '2022-08-22 08:39:21', NULL);
INSERT INTO `coding` VALUES (10, 'XS202208220002', 1, 0, '2022-08-22 08:40:10', '2022-08-22 08:40:10', NULL);
INSERT INTO `coding` VALUES (11, 'XS202208220003', 1, 0, '2022-08-22 08:40:12', '2022-08-22 08:40:12', NULL);
INSERT INTO `coding` VALUES (12, 'XS202208220004', 1, 0, '2022-08-22 08:47:35', '2022-08-22 08:47:35', NULL);
INSERT INTO `coding` VALUES (13, 'XS202208220005', 1, 0, '2022-08-22 08:48:14', '2022-08-22 08:48:14', NULL);
INSERT INTO `coding` VALUES (14, 'XS202208220006', 1, 0, '2022-08-22 08:48:32', '2022-08-22 08:48:32', NULL);
INSERT INTO `coding` VALUES (15, 'XS202208220007', 1, 0, '2022-08-22 08:48:50', '2022-08-22 08:48:50', NULL);
INSERT INTO `coding` VALUES (16, 'XS202208220008', 1, 0, '2022-08-22 08:50:54', '2022-08-22 08:50:54', NULL);
INSERT INTO `coding` VALUES (17, 'XS202208220009', 1, 0, '2022-08-22 08:57:13', '2022-08-22 08:57:13', NULL);
INSERT INTO `coding` VALUES (18, 'XS202208220010', 1, 0, '2022-08-22 08:59:08', '2022-08-22 08:59:08', NULL);
INSERT INTO `coding` VALUES (19, 'XS202208220011', 1, 0, '2022-08-22 08:59:32', '2022-08-22 08:59:32', NULL);
INSERT INTO `coding` VALUES (20, 'XS202208220012', 1, 0, '2022-08-22 09:46:53', '2022-08-22 09:46:53', NULL);
INSERT INTO `coding` VALUES (21, 'XS202208220013', 1, 0, '2022-08-22 11:14:02', '2022-08-22 11:14:02', NULL);
INSERT INTO `coding` VALUES (22, 'XS202208220014', 1, 0, '2022-08-22 14:21:51', '2022-08-22 14:21:51', NULL);
INSERT INTO `coding` VALUES (23, 'XS202208220015', 1, 0, '2022-08-22 14:41:18', '2022-08-22 14:41:18', NULL);
INSERT INTO `coding` VALUES (24, 'CG202208230001', 2, 0, '2022-08-23 09:12:32', '2022-08-23 09:12:32', NULL);
INSERT INTO `coding` VALUES (25, 'CG202208230002', 2, 0, '2022-08-23 09:32:54', '2022-08-23 09:32:54', NULL);
INSERT INTO `coding` VALUES (26, 'CG202208230003', 2, 0, '2022-08-23 09:36:15', '2022-08-23 09:36:15', NULL);
INSERT INTO `coding` VALUES (27, 'CG202208230004', 2, 0, '2022-08-23 09:36:39', '2022-08-23 09:36:39', NULL);
INSERT INTO `coding` VALUES (28, 'CG202208230005', 2, 0, '2022-08-23 09:37:18', '2022-08-23 09:37:18', NULL);
INSERT INTO `coding` VALUES (29, 'CG202208230006', 2, 0, '2022-08-23 09:37:59', '2022-08-23 09:37:59', NULL);
INSERT INTO `coding` VALUES (30, 'CG202208230007', 2, 0, '2022-08-23 09:38:23', '2022-08-23 09:38:23', NULL);
INSERT INTO `coding` VALUES (31, 'CG202208230008', 2, 0, '2022-08-23 09:39:34', '2022-08-23 09:39:34', NULL);
INSERT INTO `coding` VALUES (32, 'CG202208230009', 2, 0, '2022-08-23 09:40:02', '2022-08-23 09:40:02', NULL);
INSERT INTO `coding` VALUES (33, 'CG202208230010', 2, 0, '2022-08-23 09:40:21', '2022-08-23 09:40:21', NULL);
INSERT INTO `coding` VALUES (34, 'RK202208230001', 4, 0, '2022-08-23 10:01:01', '2022-08-23 10:01:01', NULL);
INSERT INTO `coding` VALUES (35, 'RK202208230002', 4, 0, '2022-08-23 10:02:07', '2022-08-23 10:02:07', NULL);
INSERT INTO `coding` VALUES (36, 'RK202208230003', 4, 0, '2022-08-23 10:04:56', '2022-08-23 10:04:56', NULL);
INSERT INTO `coding` VALUES (37, 'RK202208230004', 4, 0, '2022-08-23 10:05:08', '2022-08-23 10:05:08', NULL);
INSERT INTO `coding` VALUES (38, 'RK202208230005', 4, 0, '2022-08-23 10:05:39', '2022-08-23 10:05:39', NULL);
INSERT INTO `coding` VALUES (39, 'RK202208230006', 4, 0, '2022-08-23 10:05:41', '2022-08-23 10:05:41', NULL);
INSERT INTO `coding` VALUES (40, 'RK202208230007', 4, 0, '2022-08-23 10:06:02', '2022-08-23 10:06:02', NULL);
INSERT INTO `coding` VALUES (41, 'RK202208230008', 4, 0, '2022-08-23 10:06:10', '2022-08-23 10:06:10', NULL);
INSERT INTO `coding` VALUES (42, 'RK202208230009', 4, 0, '2022-08-23 10:06:12', '2022-08-23 10:06:12', NULL);
INSERT INTO `coding` VALUES (43, 'RK202208230010', 4, 0, '2022-08-23 10:10:14', '2022-08-23 10:10:14', NULL);
INSERT INTO `coding` VALUES (44, 'XS202208230001', 1, 0, '2022-08-23 14:01:02', '2022-08-23 14:01:02', NULL);
INSERT INTO `coding` VALUES (45, 'CG202208230011', 2, 0, '2022-08-23 14:01:30', '2022-08-23 14:01:30', NULL);
INSERT INTO `coding` VALUES (46, 'CG202208230012', 2, 0, '2022-08-23 14:02:09', '2022-08-23 14:02:09', NULL);
INSERT INTO `coding` VALUES (47, 'RK202208230011', 4, 0, '2022-08-23 14:21:59', '2022-08-23 14:21:59', NULL);
INSERT INTO `coding` VALUES (48, 'RK202208230012', 4, 0, '2022-08-23 14:22:51', '2022-08-23 14:22:51', NULL);
INSERT INTO `coding` VALUES (49, 'RK202208230013', 4, 0, '2022-08-23 14:22:54', '2022-08-23 14:22:54', NULL);
INSERT INTO `coding` VALUES (50, 'RK202208230014', 4, 0, '2022-08-23 14:22:59', '2022-08-23 14:22:59', NULL);
INSERT INTO `coding` VALUES (51, 'RK202208230015', 4, 0, '2022-08-23 14:24:13', '2022-08-23 14:24:13', NULL);
INSERT INTO `coding` VALUES (52, 'RK202208230016', 4, 0, '2022-08-23 14:24:17', '2022-08-23 14:24:17', NULL);
INSERT INTO `coding` VALUES (53, 'RK202208230017', 4, 0, '2022-08-23 14:24:36', '2022-08-23 14:24:36', NULL);
INSERT INTO `coding` VALUES (54, 'RK202208230018', 4, 0, '2022-08-23 14:24:45', '2022-08-23 14:24:45', NULL);
INSERT INTO `coding` VALUES (55, 'CG202208230013', 2, 0, '2022-08-23 14:55:34', '2022-08-23 14:55:34', NULL);
INSERT INTO `coding` VALUES (56, 'CG202208230014', 2, 0, '2022-08-23 14:55:44', '2022-08-23 14:55:44', NULL);
INSERT INTO `coding` VALUES (57, 'CK202208230001', 3, 0, '2022-08-23 15:01:58', '2022-08-23 15:01:58', NULL);
INSERT INTO `coding` VALUES (58, 'CK202208230002', 3, 0, '2022-08-23 15:03:08', '2022-08-23 15:03:08', NULL);
INSERT INTO `coding` VALUES (59, 'CK202208230003', 3, 0, '2022-08-23 15:04:57', '2022-08-23 15:04:57', NULL);
INSERT INTO `coding` VALUES (60, 'CK202208230004', 3, 0, '2022-08-23 15:05:06', '2022-08-23 15:05:06', NULL);
INSERT INTO `coding` VALUES (61, 'CK202208230005', 3, 0, '2022-08-23 15:05:48', '2022-08-23 15:05:48', NULL);
INSERT INTO `coding` VALUES (62, 'CK202208230006', 3, 0, '2022-08-23 15:06:05', '2022-08-23 15:06:05', NULL);
INSERT INTO `coding` VALUES (63, 'CK202208230007', 3, 0, '2022-08-23 15:06:08', '2022-08-23 15:06:08', NULL);
INSERT INTO `coding` VALUES (64, 'CK202208230008', 3, 0, '2022-08-23 15:06:37', '2022-08-23 15:06:37', NULL);
INSERT INTO `coding` VALUES (65, 'CK202208230009', 3, 0, '2022-08-23 15:06:45', '2022-08-23 15:06:45', NULL);
INSERT INTO `coding` VALUES (66, 'CK202208230010', 3, 0, '2022-08-23 15:06:48', '2022-08-23 15:06:48', NULL);
INSERT INTO `coding` VALUES (67, 'CK202208230011', 3, 0, '2022-08-23 15:07:14', '2022-08-23 15:07:14', NULL);

-- ----------------------------
-- Table structure for company
-- ----------------------------
DROP TABLE IF EXISTS `company`;
CREATE TABLE `company`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '类型：1-销售, 2-采购, 3-销售+采购',
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `contact` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '联系人',
  `tel` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '联系方式',
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '公司地址',
  `license` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '营业执照',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '往来单位' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of company
-- ----------------------------
INSERT INTO `company` VALUES (1, '浙江托包', 2, '2022-08-15 07:45:30', '2022-08-15 08:54:18', NULL, '某某某', '13112345678', '浙江温州', '/storage/upload/2022/08/15/d40673687bc2e0529b86c929754186a0.png');
INSERT INTO `company` VALUES (2, '测试公司', 3, '2022-08-15 09:00:09', '2022-08-15 09:00:09', NULL, '某某', '17858908159', '浙江温州蒲州街道', '/storage/upload/2022/08/15/f3cff7417d849f4a60c654abcd480280.png');
INSERT INTO `company` VALUES (3, '销售单位', 1, '2022-08-19 07:44:24', '2022-08-20 08:56:43', NULL, '谢某', '17858908159', '浙江龙湾1', '/storage/upload/2022/08/19/5bab4147e5a8abd3090f796d0e501ccb.png');

-- ----------------------------
-- Table structure for managers
-- ----------------------------
DROP TABLE IF EXISTS `managers`;
CREATE TABLE `managers`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` char(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `salt` char(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `last_login_ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `last_login_time` datetime NULL DEFAULT NULL,
  `role` int(11) NULL DEFAULT NULL,
  `black` tinyint(1) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 33 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '管理员' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of managers
-- ----------------------------
INSERT INTO `managers` VALUES (1, 'admin', 'ba18d91fe47cd4f40034408da74b8dd9', 'tkFioeVE', '2022-08-11 09:16:03', '2022-08-23 14:45:59', NULL, NULL, '127.0.0.1', '2022-08-23 14:45:59', 3, 0);
INSERT INTO `managers` VALUES (2, '测试人员', 'd5078e019bb004dfd96333159ec85a9a', 'fhkqszAW', '2022-08-12 07:15:19', '2022-08-19 07:25:25', NULL, NULL, '127.0.0.1', '2022-08-15 09:22:16', 5, 0);
INSERT INTO `managers` VALUES (3, '测试人员1', '91e1a8473e7cb845fa2b1430e2242847', 'hvyzKNO7', '2022-08-12 07:16:10', '2022-08-12 07:16:10', '2022-08-12 07:52:54', NULL, NULL, NULL, 5, 0);
INSERT INTO `managers` VALUES (4, '测试人员2', 'd5078e019bb004dfd96333159ec85a9a', 'fhkqszAW', '2022-08-12 07:15:19', '2022-08-12 07:43:39', '2022-08-12 07:52:54', '', '', NULL, 5, 0);
INSERT INTO `managers` VALUES (6, '测试人员3', 'd5078e019bb004dfd96333159ec85a9a', 'fhkqszAW', '2022-08-12 07:15:19', '2022-08-12 07:52:54', '2022-08-12 07:52:54', '', '', NULL, 5, 0);
INSERT INTO `managers` VALUES (7, '测试人员', 'd5078e019bb004dfd96333159ec85a9a', 'fhkqszAW', '2022-08-12 07:15:19', '2022-08-12 07:15:19', '2022-08-12 07:52:54', '', '', NULL, 5, 0);
INSERT INTO `managers` VALUES (8, '测试人员', 'd5078e019bb004dfd96333159ec85a9a', 'fhkqszAW', '2022-08-12 07:15:19', '2022-08-12 07:15:19', '2022-08-12 07:52:54', '', '', NULL, 5, 0);
INSERT INTO `managers` VALUES (9, '测试人员', 'd5078e019bb004dfd96333159ec85a9a', 'fhkqszAW', '2022-08-12 07:15:19', '2022-08-12 07:15:19', '2022-08-12 07:52:54', '', '', NULL, 5, 0);
INSERT INTO `managers` VALUES (10, '测试人员', 'd5078e019bb004dfd96333159ec85a9a', 'fhkqszAW', '2022-08-12 07:15:19', '2022-08-12 07:15:19', '2022-08-12 07:52:54', '', '', NULL, 5, 0);
INSERT INTO `managers` VALUES (11, '测试人员', 'd5078e019bb004dfd96333159ec85a9a', 'fhkqszAW', '2022-08-12 07:15:19', '2022-08-12 07:15:19', '2022-08-12 07:52:54', '', '', NULL, 5, 0);
INSERT INTO `managers` VALUES (12, '测试人员', 'd5078e019bb004dfd96333159ec85a9a', 'fhkqszAW', '2022-08-12 07:15:19', '2022-08-12 07:15:19', '2022-08-12 07:52:54', '', '', NULL, 5, 0);
INSERT INTO `managers` VALUES (13, '测试人员', 'd5078e019bb004dfd96333159ec85a9a', 'fhkqszAW', '2022-08-12 07:15:19', '2022-08-12 07:15:19', '2022-08-12 07:52:54', '', '', NULL, 5, 0);
INSERT INTO `managers` VALUES (14, '测试人员', 'd5078e019bb004dfd96333159ec85a9a', 'fhkqszAW', '2022-08-12 07:15:19', '2022-08-12 07:15:19', '2022-08-12 07:52:54', '', '', NULL, 5, 0);
INSERT INTO `managers` VALUES (15, '测试人员', 'd5078e019bb004dfd96333159ec85a9a', 'fhkqszAW', '2022-08-12 07:15:19', '2022-08-12 07:15:19', '2022-08-12 07:52:54', '', '', NULL, 5, 0);
INSERT INTO `managers` VALUES (16, '测试人员', 'd5078e019bb004dfd96333159ec85a9a', 'fhkqszAW', '2022-08-12 07:15:19', '2022-08-12 07:15:19', '2022-08-12 07:52:54', '', '', NULL, 5, 0);
INSERT INTO `managers` VALUES (17, '测试人员', 'd5078e019bb004dfd96333159ec85a9a', 'fhkqszAW', '2022-08-12 07:15:19', '2022-08-12 07:15:19', '2022-08-12 07:52:54', '', '', NULL, 5, 0);
INSERT INTO `managers` VALUES (18, '测试人员', 'd5078e019bb004dfd96333159ec85a9a', 'fhkqszAW', '2022-08-12 07:15:19', '2022-08-12 07:15:19', '2022-08-12 07:52:54', '', '', NULL, 5, 0);
INSERT INTO `managers` VALUES (19, '测试人员', 'd5078e019bb004dfd96333159ec85a9a', 'fhkqszAW', '2022-08-12 07:15:19', '2022-08-12 07:15:19', '2022-08-12 07:52:54', '', '', NULL, 5, 0);
INSERT INTO `managers` VALUES (20, '测试人员', 'd5078e019bb004dfd96333159ec85a9a', 'fhkqszAW', '2022-08-12 07:15:19', '2022-08-12 07:15:19', '2022-08-12 07:52:54', '', '', NULL, 5, 0);
INSERT INTO `managers` VALUES (21, '测试人员', 'd5078e019bb004dfd96333159ec85a9a', 'fhkqszAW', '2022-08-12 07:15:19', '2022-08-12 07:15:19', '2022-08-12 07:52:54', '', '', NULL, 5, 0);
INSERT INTO `managers` VALUES (22, '测试人员', 'd5078e019bb004dfd96333159ec85a9a', 'fhkqszAW', '2022-08-12 07:15:19', '2022-08-12 07:15:19', '2022-08-12 07:52:54', '', '', NULL, 5, 0);
INSERT INTO `managers` VALUES (23, '测试人员', 'd5078e019bb004dfd96333159ec85a9a', 'fhkqszAW', '2022-08-12 07:15:19', '2022-08-12 07:15:19', '2022-08-12 07:52:54', '', '', NULL, 5, 0);
INSERT INTO `managers` VALUES (24, '测试人员', 'd5078e019bb004dfd96333159ec85a9a', 'fhkqszAW', '2022-08-12 07:15:19', '2022-08-12 07:15:19', '2022-08-12 07:52:54', '', '', NULL, 5, 0);
INSERT INTO `managers` VALUES (25, '测试人员', 'd5078e019bb004dfd96333159ec85a9a', 'fhkqszAW', '2022-08-12 07:15:19', '2022-08-12 07:15:19', '2022-08-12 07:52:54', '', '', NULL, 5, 0);
INSERT INTO `managers` VALUES (26, '测试人员', 'd5078e019bb004dfd96333159ec85a9a', 'fhkqszAW', '2022-08-12 07:15:19', '2022-08-12 07:15:19', '2022-08-12 07:52:54', '', '', NULL, 5, 0);
INSERT INTO `managers` VALUES (27, '测试人员', 'd5078e019bb004dfd96333159ec85a9a', 'fhkqszAW', '2022-08-12 07:15:19', '2022-08-12 07:15:19', '2022-08-12 07:52:54', '', '', NULL, 5, 0);
INSERT INTO `managers` VALUES (28, '测试人员', 'd5078e019bb004dfd96333159ec85a9a', 'fhkqszAW', '2022-08-12 07:15:19', '2022-08-12 07:15:19', '2022-08-12 07:52:54', '', '', NULL, 5, 0);
INSERT INTO `managers` VALUES (29, '测试人员', 'd5078e019bb004dfd96333159ec85a9a', 'fhkqszAW', '2022-08-12 07:15:19', '2022-08-12 07:15:19', '2022-08-12 07:52:54', '', '', NULL, 5, 0);
INSERT INTO `managers` VALUES (30, '测试人员', 'd5078e019bb004dfd96333159ec85a9a', 'fhkqszAW', '2022-08-12 07:15:19', '2022-08-12 07:15:19', '2022-08-12 07:52:54', '', '', NULL, 5, 0);
INSERT INTO `managers` VALUES (31, '测试人员', 'd5078e019bb004dfd96333159ec85a9a', 'fhkqszAW', '2022-08-12 07:15:19', '2022-08-12 07:15:19', '2022-08-12 07:52:54', '', '', NULL, 5, 0);
INSERT INTO `managers` VALUES (32, '🐂🍺', '3994036b78e2f435b54e2049fb99cb52', 'fklxCJ67', '2022-08-12 09:26:48', '2022-08-20 08:51:50', NULL, NULL, '127.0.0.1', '2022-08-12 09:27:03', 3, 0);

-- ----------------------------
-- Table structure for operation_logs
-- ----------------------------
DROP TABLE IF EXISTS `operation_logs`;
CREATE TABLE `operation_logs`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manager_id` int(11) NOT NULL COMMENT '操作员ID',
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '操作员名称',
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '操作',
  `table` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '被操作表',
  `table_id` int(11) NULL DEFAULT NULL COMMENT '被操作ID',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '备注',
  `ip` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '操作IP',
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 101 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '日志' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of operation_logs
-- ----------------------------
INSERT INTO `operation_logs` VALUES (1, 1, 'admin', '修改', 'managers', 1, '修改用户', '127.0.0.1', '2022-08-18 07:24:21', '2022-08-19 07:24:21', NULL);
INSERT INTO `operation_logs` VALUES (2, 1, 'admin', '拉黑', 'managers', 2, '拉黑用户', '127.0.0.1', '2022-08-18 07:24:21', '2022-08-19 07:25:04', NULL);
INSERT INTO `operation_logs` VALUES (3, 1, 'admin', '拉黑', 'managers', 2, '拉黑用户', '127.0.0.1', '2022-08-18 07:24:21', '2022-08-19 07:25:25', NULL);
INSERT INTO `operation_logs` VALUES (4, 1, 'admin', '修改', 'products', 1, '修改产品', '127.0.0.1', '2022-08-18 07:24:21', '2022-08-19 07:39:52', NULL);
INSERT INTO `operation_logs` VALUES (5, 1, 'admin', '修改', 'products', 2, '修改产品', '127.0.0.1', '2022-08-19 07:39:54', '2022-08-19 07:39:54', NULL);
INSERT INTO `operation_logs` VALUES (6, 1, 'admin', '修改', 'products', 3, '修改产品', '127.0.0.1', '2022-08-19 07:39:57', '2022-08-19 07:39:57', NULL);
INSERT INTO `operation_logs` VALUES (7, 1, 'admin', '修改', 'products', 4, '修改产品', '127.0.0.1', '2022-08-19 07:39:59', '2022-08-19 07:39:59', NULL);
INSERT INTO `operation_logs` VALUES (8, 1, 'admin', '修改', 'warehouses', 1, '修改仓库', '127.0.0.1', '2022-08-19 07:40:12', '2022-08-19 07:40:12', NULL);
INSERT INTO `operation_logs` VALUES (9, 1, 'admin', '修改', 'warehouses', 2, '修改仓库', '127.0.0.1', '2022-08-19 07:40:15', '2022-08-19 07:40:15', NULL);
INSERT INTO `operation_logs` VALUES (10, 1, 'admin', '修改', 'warehouses', 3, '修改仓库', '127.0.0.1', '2022-08-19 07:40:17', '2022-08-19 07:40:17', NULL);
INSERT INTO `operation_logs` VALUES (11, 1, 'admin', '修改', 'warehouses', 4, '修改仓库', '127.0.0.1', '2022-08-19 07:40:19', '2022-08-19 07:40:19', NULL);
INSERT INTO `operation_logs` VALUES (12, 1, 'admin', '新增', 'company', 3, '新增往来单位', '127.0.0.1', '2022-08-19 07:44:24', '2022-08-19 07:44:24', NULL);
INSERT INTO `operation_logs` VALUES (13, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-19 07:51:17', '2022-08-19 07:51:17', NULL);
INSERT INTO `operation_logs` VALUES (14, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-19 07:56:37', '2022-08-19 07:56:37', NULL);
INSERT INTO `operation_logs` VALUES (15, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-19 07:59:26', '2022-08-19 07:59:26', NULL);
INSERT INTO `operation_logs` VALUES (16, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-19 07:59:42', '2022-08-19 07:59:42', NULL);
INSERT INTO `operation_logs` VALUES (17, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-19 08:00:08', '2022-08-19 08:00:08', NULL);
INSERT INTO `operation_logs` VALUES (18, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-19 08:00:43', '2022-08-19 08:00:43', NULL);
INSERT INTO `operation_logs` VALUES (19, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-19 08:01:48', '2022-08-19 08:01:48', NULL);
INSERT INTO `operation_logs` VALUES (20, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-19 08:02:48', '2022-08-19 08:02:48', NULL);
INSERT INTO `operation_logs` VALUES (21, 1, 'admin', '修改', 'company', 3, '修改往来单位', '127.0.0.1', '2022-08-19 09:20:11', '2022-08-19 09:20:11', NULL);
INSERT INTO `operation_logs` VALUES (22, 1, 'admin', '修改', 'company', 1, '修改往来单位', '127.0.0.1', '2022-08-19 17:22:12', '2022-08-19 17:22:12', NULL);
INSERT INTO `operation_logs` VALUES (23, 0, 'admin', '登录', 'managers', 1, '用户登录', '127.0.0.1', '2022-08-20 08:48:15', '2022-08-20 08:48:15', NULL);
INSERT INTO `operation_logs` VALUES (24, 0, 'admin', '登录', 'managers', 1, '用户登录', '127.0.0.1', '2022-08-20 08:48:19', '2022-08-20 08:48:19', NULL);
INSERT INTO `operation_logs` VALUES (25, 1, 'admin', '拉黑', 'managers', 32, '恢复用户', '127.0.0.1', '2022-08-20 00:51:28', '2022-08-20 00:51:28', NULL);
INSERT INTO `operation_logs` VALUES (26, 1, 'admin', '恢复', 'managers', 32, '恢复用户', '127.0.0.1', '2022-08-20 08:51:50', '2022-08-20 08:51:50', NULL);
INSERT INTO `operation_logs` VALUES (27, 1, 'admin', '修改', 'company', 3, '修改往来单位', '127.0.0.1', '2022-08-20 08:53:17', '2022-08-20 08:53:17', NULL);
INSERT INTO `operation_logs` VALUES (28, 1, 'admin', '修改', 'company', 3, '修改往来单位', '127.0.0.1', '2022-08-20 08:56:43', '2022-08-20 08:56:43', NULL);
INSERT INTO `operation_logs` VALUES (29, 1, 'admin', '新增', 'roles', 6, '新增角色', '127.0.0.1', '2022-08-20 09:19:10', '2022-08-20 09:19:10', NULL);
INSERT INTO `operation_logs` VALUES (30, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-20 09:32:22', '2022-08-20 09:32:22', NULL);
INSERT INTO `operation_logs` VALUES (31, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-20 09:32:45', '2022-08-20 09:32:45', NULL);
INSERT INTO `operation_logs` VALUES (32, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-20 09:34:07', '2022-08-20 09:34:07', NULL);
INSERT INTO `operation_logs` VALUES (33, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-20 09:34:15', '2022-08-20 09:34:15', NULL);
INSERT INTO `operation_logs` VALUES (34, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-20 09:34:46', '2022-08-20 09:34:46', NULL);
INSERT INTO `operation_logs` VALUES (35, 1, 'admin', '修改', 'roles', 6, '修改角色', '127.0.0.1', '2022-08-20 09:34:58', '2022-08-20 09:34:58', NULL);
INSERT INTO `operation_logs` VALUES (36, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-20 09:40:21', '2022-08-20 09:40:21', NULL);
INSERT INTO `operation_logs` VALUES (37, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-20 09:42:33', '2022-08-20 09:42:33', NULL);
INSERT INTO `operation_logs` VALUES (38, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-20 09:43:03', '2022-08-20 09:43:03', NULL);
INSERT INTO `operation_logs` VALUES (39, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-20 09:44:17', '2022-08-20 09:44:17', NULL);
INSERT INTO `operation_logs` VALUES (40, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-20 09:44:26', '2022-08-20 09:44:26', NULL);
INSERT INTO `operation_logs` VALUES (41, 0, 'admin', '登录', 'managers', 1, '用户登录', '127.0.0.1', '2022-08-20 11:48:52', '2022-08-20 11:48:52', NULL);
INSERT INTO `operation_logs` VALUES (42, 1, 'admin', '修改', 'roles', 6, '修改角色', '127.0.0.1', '2022-08-20 14:04:41', '2022-08-20 14:04:41', NULL);
INSERT INTO `operation_logs` VALUES (43, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-20 14:10:11', '2022-08-20 14:10:11', NULL);
INSERT INTO `operation_logs` VALUES (44, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-20 14:11:12', '2022-08-20 14:11:12', NULL);
INSERT INTO `operation_logs` VALUES (45, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-20 14:11:59', '2022-08-20 14:11:59', NULL);
INSERT INTO `operation_logs` VALUES (46, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-20 14:12:39', '2022-08-20 14:12:39', NULL);
INSERT INTO `operation_logs` VALUES (47, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-20 14:14:07', '2022-08-20 14:14:07', NULL);
INSERT INTO `operation_logs` VALUES (48, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-20 14:14:53', '2022-08-20 14:14:53', NULL);
INSERT INTO `operation_logs` VALUES (49, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-20 14:20:10', '2022-08-20 14:20:10', NULL);
INSERT INTO `operation_logs` VALUES (50, 0, 'admin', '登录', 'managers', 1, '用户登录', '127.0.0.1', '2022-08-20 14:23:56', '2022-08-20 14:23:56', NULL);
INSERT INTO `operation_logs` VALUES (51, 0, 'admin', '登录', 'managers', 1, '用户登录', '127.0.0.1', '2022-08-20 14:24:26', '2022-08-20 14:24:26', NULL);
INSERT INTO `operation_logs` VALUES (52, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-20 14:32:20', '2022-08-20 14:32:20', NULL);
INSERT INTO `operation_logs` VALUES (53, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-20 14:33:01', '2022-08-20 14:33:01', NULL);
INSERT INTO `operation_logs` VALUES (54, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-20 14:33:51', '2022-08-20 14:33:51', NULL);
INSERT INTO `operation_logs` VALUES (55, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-20 14:34:03', '2022-08-20 14:34:03', NULL);
INSERT INTO `operation_logs` VALUES (56, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-20 14:34:26', '2022-08-20 14:34:26', NULL);
INSERT INTO `operation_logs` VALUES (57, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-20 14:34:48', '2022-08-20 14:34:48', NULL);
INSERT INTO `operation_logs` VALUES (58, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-20 14:35:37', '2022-08-20 14:35:37', NULL);
INSERT INTO `operation_logs` VALUES (59, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-20 15:38:24', '2022-08-20 15:38:24', NULL);
INSERT INTO `operation_logs` VALUES (60, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-20 15:38:44', '2022-08-20 15:38:44', NULL);
INSERT INTO `operation_logs` VALUES (61, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-20 15:39:24', '2022-08-20 15:39:24', NULL);
INSERT INTO `operation_logs` VALUES (62, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-20 15:41:08', '2022-08-20 15:41:08', NULL);
INSERT INTO `operation_logs` VALUES (63, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-20 15:41:23', '2022-08-20 15:41:23', NULL);
INSERT INTO `operation_logs` VALUES (64, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-20 15:49:14', '2022-08-20 15:49:14', NULL);
INSERT INTO `operation_logs` VALUES (65, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-20 15:51:56', '2022-08-20 15:51:56', NULL);
INSERT INTO `operation_logs` VALUES (66, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-20 15:53:25', '2022-08-20 15:53:25', NULL);
INSERT INTO `operation_logs` VALUES (67, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-20 17:04:23', '2022-08-20 17:04:23', NULL);
INSERT INTO `operation_logs` VALUES (68, 0, 'admin', '登录', 'managers', 1, '用户登录', '127.0.0.1', '2022-08-22 08:33:53', '2022-08-22 08:33:53', NULL);
INSERT INTO `operation_logs` VALUES (69, 1, 'admin', '新增', 'sale', 3, '新增入库单', '127.0.0.1', '2022-08-22 08:54:31', '2022-08-22 08:54:31', NULL);
INSERT INTO `operation_logs` VALUES (70, 1, 'admin', '新增', 'sale', 1, '新增入库单', '127.0.0.1', '2022-08-22 08:57:31', '2022-08-22 08:57:31', NULL);
INSERT INTO `operation_logs` VALUES (71, 1, 'admin', '新增', 'sale', 2, '新增入库单', '127.0.0.1', '2022-08-22 08:57:59', '2022-08-22 08:57:59', NULL);
INSERT INTO `operation_logs` VALUES (72, 1, 'admin', '修改', 'sale', 1, '修改入库单', '127.0.0.1', '2022-08-22 08:58:30', '2022-08-22 08:58:30', NULL);
INSERT INTO `operation_logs` VALUES (73, 1, 'admin', '新增', 'sale', 1, '新增入库单', '127.0.0.1', '2022-08-22 08:59:22', '2022-08-22 08:59:22', NULL);
INSERT INTO `operation_logs` VALUES (74, 1, 'admin', '删除', 'sale', 1, '删除销售单', '127.0.0.1', '2022-08-22 09:44:00', '2022-08-22 09:44:00', NULL);
INSERT INTO `operation_logs` VALUES (75, 1, 'admin', '新增', 'sale', 2, '新增入库单', '127.0.0.1', '2022-08-22 09:47:40', '2022-08-22 09:47:40', NULL);
INSERT INTO `operation_logs` VALUES (76, 1, 'admin', '修改', 'sale', 2, '修改入库单', '127.0.0.1', '2022-08-22 11:13:56', '2022-08-22 11:13:56', NULL);
INSERT INTO `operation_logs` VALUES (77, 0, 'admin', '登录', 'managers', 1, '用户登录', '127.0.0.1', '2022-08-22 11:39:07', '2022-08-22 11:39:07', NULL);
INSERT INTO `operation_logs` VALUES (78, 0, 'admin', '登录', 'managers', 1, '用户登录', '127.0.0.1', '2022-08-22 11:54:03', '2022-08-22 11:54:03', NULL);
INSERT INTO `operation_logs` VALUES (79, 0, 'admin', '登录', 'managers', 1, '用户登录', '127.0.0.1', '2022-08-22 11:57:31', '2022-08-22 11:57:31', NULL);
INSERT INTO `operation_logs` VALUES (80, 1, 'admin', '新增', 'sale', 3, '新增销售单', '127.0.0.1', '2022-08-22 14:41:44', '2022-08-22 14:41:44', NULL);
INSERT INTO `operation_logs` VALUES (81, 1, 'admin', '删除', 'sale', 3, '删除销售单', '127.0.0.1', '2022-08-22 14:43:13', '2022-08-22 14:43:13', NULL);
INSERT INTO `operation_logs` VALUES (82, 0, 'admin', '登录', 'managers', 1, '用户登录', '127.0.0.1', '2022-08-22 15:05:28', '2022-08-22 15:05:28', NULL);
INSERT INTO `operation_logs` VALUES (83, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-22 15:06:47', '2022-08-22 15:06:47', NULL);
INSERT INTO `operation_logs` VALUES (84, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-22 15:07:05', '2022-08-22 15:07:05', NULL);
INSERT INTO `operation_logs` VALUES (85, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-22 15:08:02', '2022-08-22 15:08:02', NULL);
INSERT INTO `operation_logs` VALUES (86, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-22 15:09:13', '2022-08-22 15:09:13', NULL);
INSERT INTO `operation_logs` VALUES (87, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-22 15:11:49', '2022-08-22 15:11:49', NULL);
INSERT INTO `operation_logs` VALUES (88, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-22 15:12:20', '2022-08-22 15:12:20', NULL);
INSERT INTO `operation_logs` VALUES (89, 0, 'admin', '登录', 'managers', 1, '用户登录', '127.0.0.1', '2022-08-23 08:42:23', '2022-08-23 08:42:23', NULL);
INSERT INTO `operation_logs` VALUES (90, 1, 'admin', '修改', 'roles', 3, '修改角色', '127.0.0.1', '2022-08-23 09:05:56', '2022-08-23 09:05:56', NULL);
INSERT INTO `operation_logs` VALUES (91, 1, 'admin', '新增', 'purchase', 1, '新增采购单', '127.0.0.1', '2022-08-23 09:13:00', '2022-08-23 09:13:00', NULL);
INSERT INTO `operation_logs` VALUES (92, 1, 'admin', '修改', 'purchase', 1, '修改采购单', '127.0.0.1', '2022-08-23 09:15:15', '2022-08-23 09:15:15', NULL);
INSERT INTO `operation_logs` VALUES (93, 1, 'admin', '新增', 'purchase', 2, '新增采购单', '127.0.0.1', '2022-08-23 09:43:56', '2022-08-23 09:43:56', NULL);
INSERT INTO `operation_logs` VALUES (94, 1, 'admin', '新增', 'warehousing', 3, '新增入库单', '127.0.0.1', '2022-08-23 10:11:44', '2022-08-23 10:11:44', NULL);
INSERT INTO `operation_logs` VALUES (95, 0, 'admin', '登录', 'managers', 1, '用户登录', '127.0.0.1', '2022-08-23 11:44:50', '2022-08-23 11:44:50', NULL);
INSERT INTO `operation_logs` VALUES (96, 1, 'admin', '新增', 'sale', 4, '新增销售单', '127.0.0.1', '2022-08-23 14:01:17', '2022-08-23 14:01:17', NULL);
INSERT INTO `operation_logs` VALUES (97, 1, 'admin', '新增', 'purchase', 3, '新增采购单', '127.0.0.1', '2022-08-23 14:02:19', '2022-08-23 14:02:19', NULL);
INSERT INTO `operation_logs` VALUES (98, 1, 'admin', '新增', 'warehousing', 4, '新增入库单', '127.0.0.1', '2022-08-23 14:24:53', '2022-08-23 14:24:53', NULL);
INSERT INTO `operation_logs` VALUES (99, 0, 'admin', '登录', 'managers', 1, '用户登录', '127.0.0.1', '2022-08-23 14:45:59', '2022-08-23 14:45:59', NULL);
INSERT INTO `operation_logs` VALUES (100, 1, 'admin', '新增', 'outbound', 2, '新增出库单', '127.0.0.1', '2022-08-23 15:07:22', '2022-08-23 15:07:22', NULL);

-- ----------------------------
-- Table structure for outbound
-- ----------------------------
DROP TABLE IF EXISTS `outbound`;
CREATE TABLE `outbound`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '出库单号',
  `outbound_time` date NULL DEFAULT NULL COMMENT '出库日期',
  `company_id` int(11) NULL DEFAULT NULL COMMENT '客户',
  `warehouse_id` int(11) NULL DEFAULT NULL COMMENT '仓库ID',
  `sale_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '销售单号',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '备注',
  `status` tinyint(1) NULL DEFAULT 0 COMMENT '状态：0-未审核，1-已审核',
  `creater` int(11) NULL DEFAULT NULL COMMENT '创建人',
  `updater` int(11) NULL DEFAULT NULL COMMENT '修改人',
  `auditer` int(11) NULL DEFAULT NULL COMMENT '审核人',
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '出库单-主表' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of outbound
-- ----------------------------
INSERT INTO `outbound` VALUES (1, 'CK202208190001', '2022-08-19', 2, 4, NULL, NULL, 0, 1, 1, NULL, '2022-08-19 01:02:37', '2022-08-19 06:57:17', NULL);
INSERT INTO `outbound` VALUES (2, 'CK202208230011', '2022-08-23', 3, 4, 'XS202208230001', NULL, 0, 1, NULL, NULL, '2022-08-23 15:07:22', '2022-08-23 15:07:22', NULL);

-- ----------------------------
-- Table structure for outbound_detail
-- ----------------------------
DROP TABLE IF EXISTS `outbound_detail`;
CREATE TABLE `outbound_detail`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `outbound_id` int(11) NOT NULL COMMENT '出库单ID',
  `product_id` int(11) NOT NULL COMMENT '产品ID',
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '产品名称',
  `num` float NOT NULL COMMENT '数量',
  `unit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '单位',
  `price` decimal(20, 2) NULL DEFAULT NULL COMMENT '单价',
  `money` decimal(20, 2) NULL DEFAULT NULL COMMENT '总价',
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '入库表-子表' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of outbound_detail
-- ----------------------------
INSERT INTO `outbound_detail` VALUES (1, 1, 3, '金', 1, '克', 499.00, 499.00, '2022-08-19 01:02:37', '2022-08-19 06:57:17', '2022-08-19 06:57:17');
INSERT INTO `outbound_detail` VALUES (2, 1, 3, '金', 1, '顿', 399000000.00, 399000000.00, '2022-08-19 06:57:17', '2022-08-19 06:57:17', NULL);
INSERT INTO `outbound_detail` VALUES (3, 2, 1, 'Cu铜', 0.3, '吨', 55120.00, 16536.00, '2022-08-23 15:07:22', '2022-08-23 15:07:22', NULL);

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `unit` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(20, 2) NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '产品' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (1, 'Cu铜', '吨', 55120.00, '2022-08-12 08:42:06', '2022-08-19 07:39:52', NULL);
INSERT INTO `products` VALUES (2, 'Fe铁', '吨', 5200.00, '2022-08-12 08:42:25', '2022-08-19 07:39:54', NULL);
INSERT INTO `products` VALUES (3, '金', '吨', 399000000.00, '2022-08-18 07:16:03', '2022-08-19 07:39:57', NULL);
INSERT INTO `products` VALUES (4, '银', '吨', 4288000.00, '2022-08-18 07:16:30', '2022-08-19 07:39:59', NULL);

-- ----------------------------
-- Table structure for purchase
-- ----------------------------
DROP TABLE IF EXISTS `purchase`;
CREATE TABLE `purchase`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '采购单号',
  `company` int(11) NULL DEFAULT NULL COMMENT '供货单位ID',
  `purchase_time` date NULL DEFAULT NULL COMMENT '采购时间',
  `remark` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '备注',
  `status` tinyint(1) NULL DEFAULT NULL COMMENT '状态：0-待审核，1-已审核',
  `creater` int(11) NULL DEFAULT NULL COMMENT '创建人',
  `updater` int(11) NULL DEFAULT NULL COMMENT '修改人',
  `auditer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '审核人',
  `sale_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '销售单号',
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '采购-主表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of purchase
-- ----------------------------
INSERT INTO `purchase` VALUES (1, 'CG202208230001', 2, '2022-08-23', '测试备注', 1, 1, 1, '测试,测试1', NULL, '2022-08-23 09:13:00', '2022-08-23 09:20:17', NULL);
INSERT INTO `purchase` VALUES (2, 'CG202208230010', 2, '2022-08-23', NULL, 1, 1, NULL, '测试', 'XS202208220012', '2022-08-23 09:43:56', '2022-08-23 10:01:47', NULL);
INSERT INTO `purchase` VALUES (3, 'CG202208230012', 1, '2022-08-23', NULL, 1, 1, NULL, '审核人', 'XS202208230001', '2022-08-23 14:02:19', '2022-08-23 14:02:31', NULL);

-- ----------------------------
-- Table structure for purchase_detail
-- ----------------------------
DROP TABLE IF EXISTS `purchase_detail`;
CREATE TABLE `purchase_detail`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_id` int(11) NULL DEFAULT NULL COMMENT '采购单ID',
  `product_id` int(11) NULL DEFAULT NULL COMMENT '产品ID',
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '产品名称',
  `unit` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '单位',
  `num` float NULL DEFAULT NULL COMMENT '数量',
  `price` decimal(20, 2) NULL DEFAULT NULL COMMENT '单价',
  `money` decimal(20, 2) NULL DEFAULT NULL COMMENT '总价',
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '采购-子表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of purchase_detail
-- ----------------------------
INSERT INTO `purchase_detail` VALUES (1, 1, 1, 'Cu铜', '吨', 0.1, 55120.00, 5512.00, '2022-08-23 09:13:00', '2022-08-23 09:15:15', '2022-08-23 09:15:15');
INSERT INTO `purchase_detail` VALUES (2, 1, 3, '金', '吨', 0, 399000000.00, 0.00, '2022-08-23 09:13:00', '2022-08-23 09:15:15', '2022-08-23 09:15:15');
INSERT INTO `purchase_detail` VALUES (3, 1, 1, 'Cu铜', '吨', 0.1, 55120.00, 5512.00, '2022-08-23 09:15:15', '2022-08-23 09:15:15', NULL);
INSERT INTO `purchase_detail` VALUES (4, 1, 3, '金', '吨', 0.01, 399000000.00, 3990000.00, '2022-08-23 09:15:15', '2022-08-23 09:15:15', NULL);
INSERT INTO `purchase_detail` VALUES (5, 2, 1, 'Cu铜', '吨', 0.1, 55120.00, 5512.00, '2022-08-23 09:43:56', '2022-08-23 09:43:56', NULL);
INSERT INTO `purchase_detail` VALUES (6, 2, 2, 'Fe铁', '吨', 3.2, 5200.00, 16640.00, '2022-08-23 09:43:56', '2022-08-23 09:43:56', NULL);
INSERT INTO `purchase_detail` VALUES (7, 2, 3, '金', '吨', 0.01, 399000000.00, 3990000.00, '2022-08-23 09:43:56', '2022-08-23 09:43:56', NULL);
INSERT INTO `purchase_detail` VALUES (8, 3, 1, 'Cu铜', '吨', 0.3, 55120.00, 16536.00, '2022-08-23 14:02:19', '2022-08-23 14:02:19', NULL);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '角色' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (3, '开发者', '2022-08-12 02:24:39', '2022-08-12 02:24:39', NULL);
INSERT INTO `roles` VALUES (5, '测试人员', '2022-08-12 05:37:41', '2022-08-15 01:13:27', NULL);
INSERT INTO `roles` VALUES (6, '管理员', '2022-08-20 09:19:10', '2022-08-20 09:19:10', NULL);

-- ----------------------------
-- Table structure for sale
-- ----------------------------
DROP TABLE IF EXISTS `sale`;
CREATE TABLE `sale`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '销售合同号',
  `company` int(11) NULL DEFAULT NULL COMMENT '客户ID',
  `sale_time` date NULL DEFAULT NULL COMMENT '下单日期',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '备注',
  `status` tinyint(1) NULL DEFAULT NULL COMMENT '状态：0-待审核，1-已审核',
  `creater` int(11) NULL DEFAULT NULL COMMENT '创建人',
  `updater` int(11) NULL DEFAULT NULL COMMENT '修改人',
  `auditer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '审核人',
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '销售-主表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sale
-- ----------------------------
INSERT INTO `sale` VALUES (1, 'XS202208220010', 2, '2022-08-22', '测试备注', NULL, 1, NULL, NULL, '2022-08-22 08:59:22', '2022-08-22 09:44:00', '2022-08-22 09:44:00');
INSERT INTO `sale` VALUES (2, 'XS202208220012', 3, '2022-08-22', '测试备注', 1, 1, 1, '测试人员', '2022-08-22 09:47:40', '2022-08-23 09:30:13', NULL);
INSERT INTO `sale` VALUES (3, 'XS202208220015', 2, '2022-08-22', '测试备注', 0, 1, NULL, NULL, '2022-08-22 14:41:44', '2022-08-22 14:43:13', '2022-08-22 14:43:13');
INSERT INTO `sale` VALUES (4, 'XS202208230001', 3, '2022-08-23', NULL, 1, 1, NULL, '测试人', '2022-08-23 14:01:17', '2022-08-23 14:01:26', NULL);

-- ----------------------------
-- Table structure for sale_detail
-- ----------------------------
DROP TABLE IF EXISTS `sale_detail`;
CREATE TABLE `sale_detail`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) NULL DEFAULT NULL COMMENT '销售单ID',
  `product_id` int(11) NULL DEFAULT NULL COMMENT '产品ID',
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '产品名称',
  `num` float NULL DEFAULT NULL COMMENT '数量',
  `unit` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '单位',
  `price` decimal(20, 2) NULL DEFAULT NULL COMMENT '单价',
  `money` decimal(20, 2) NULL DEFAULT NULL COMMENT '总价',
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '销售-子表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sale_detail
-- ----------------------------
INSERT INTO `sale_detail` VALUES (1, 1, 1, 'Cu铜', 0.32, '吨', 55120.00, 17638.40, '2022-08-22 08:59:22', '2022-08-22 09:44:00', '2022-08-22 09:44:00');
INSERT INTO `sale_detail` VALUES (2, 2, 1, 'Cu铜', 0.1, '吨', 55120.00, 5512.00, '2022-08-22 09:47:40', '2022-08-22 11:13:56', '2022-08-22 11:13:56');
INSERT INTO `sale_detail` VALUES (3, 2, 2, 'Fe铁', 3.2, '吨', 5200.00, 16640.00, '2022-08-22 09:47:40', '2022-08-22 11:13:56', '2022-08-22 11:13:56');
INSERT INTO `sale_detail` VALUES (4, 2, 3, '金', 0.01, '吨', 399000000.00, 3990000.00, '2022-08-22 09:47:40', '2022-08-22 11:13:56', '2022-08-22 11:13:56');
INSERT INTO `sale_detail` VALUES (5, 2, 1, 'Cu铜', 0.1, '吨', 55120.00, 5512.00, '2022-08-22 11:13:56', '2022-08-22 11:13:56', NULL);
INSERT INTO `sale_detail` VALUES (6, 2, 2, 'Fe铁', 3.2, '吨', 5200.00, 16640.00, '2022-08-22 11:13:56', '2022-08-22 11:13:56', NULL);
INSERT INTO `sale_detail` VALUES (7, 2, 3, '金', 0.01, '吨', 399000000.00, 3990000.00, '2022-08-22 11:13:56', '2022-08-22 11:13:56', NULL);
INSERT INTO `sale_detail` VALUES (8, 3, 4, '银', 1, '吨', 4288000.00, 4288000.00, '2022-08-22 14:41:44', '2022-08-22 14:43:13', '2022-08-22 14:43:13');
INSERT INTO `sale_detail` VALUES (9, 3, 3, '金', 0.65, '吨', 399000000.00, 259350000.00, '2022-08-22 14:41:44', '2022-08-22 14:43:13', '2022-08-22 14:43:13');
INSERT INTO `sale_detail` VALUES (10, 4, 1, 'Cu铜', 0.3, '吨', 55120.00, 16536.00, '2022-08-23 14:01:17', '2022-08-23 14:01:17', NULL);

-- ----------------------------
-- Table structure for statement
-- ----------------------------
DROP TABLE IF EXISTS `statement`;
CREATE TABLE `statement`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '结算单号',
  `statement_time` datetime NULL DEFAULT NULL COMMENT '结算时间',
  `sale_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '销售单号',
  `creater` int(11) NULL DEFAULT NULL COMMENT '创建人',
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '结算单-主表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of statement
-- ----------------------------

-- ----------------------------
-- Table structure for statement_detail
-- ----------------------------
DROP TABLE IF EXISTS `statement_detail`;
CREATE TABLE `statement_detail`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `statement_id` int(11) NULL DEFAULT NULL COMMENT '结算单ID',
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '出入库单号',
  `type` tinyint(1) NULL DEFAULT NULL COMMENT '单据类型：3-入库单，4-出库单',
  `date` date NULL DEFAULT NULL COMMENT '单据日期',
  `auditer` int(11) NULL DEFAULT NULL COMMENT '审核人',
  `audite_time` datetime NULL DEFAULT NULL COMMENT '审核时间',
  `product_id` int(11) NULL DEFAULT NULL COMMENT '产品ID',
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '产品名称',
  `unit` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '单位',
  `price` decimal(20, 2) NULL DEFAULT NULL COMMENT '单价',
  `money` decimal(20, 2) NULL DEFAULT NULL COMMENT '总价',
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '结算单-子表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of statement_detail
-- ----------------------------

-- ----------------------------
-- Table structure for stock
-- ----------------------------
DROP TABLE IF EXISTS `stock`;
CREATE TABLE `stock`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `warehouse_id` int(11) NULL DEFAULT NULL COMMENT '仓库ID',
  `product_id` int(11) NULL DEFAULT NULL COMMENT '产品ID',
  `num` float NULL DEFAULT 0 COMMENT '可用量',
  `actul_num` float NULL DEFAULT NULL COMMENT '现存量',
  `unit` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '单位',
  `price` decimal(10, 2) NULL DEFAULT NULL COMMENT '单价',
  `money` decimal(10, 2) NULL DEFAULT NULL COMMENT '总价',
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '库存量' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of stock
-- ----------------------------
INSERT INTO `stock` VALUES (1, 1, 1, 0.1, NULL, '吨', NULL, NULL, '2022-08-19 00:39:54', '2022-08-23 10:11:44', NULL);
INSERT INTO `stock` VALUES (2, 2, 1, 0, NULL, '吨', NULL, NULL, '2022-08-19 00:39:54', '2022-08-19 00:39:54', NULL);
INSERT INTO `stock` VALUES (3, 1, 2, 3.2, NULL, '吨', NULL, NULL, '2022-08-19 00:40:07', '2022-08-23 10:11:44', NULL);
INSERT INTO `stock` VALUES (4, 2, 2, 0, NULL, '吨', NULL, NULL, '2022-08-19 00:40:07', '2022-08-19 00:40:07', NULL);
INSERT INTO `stock` VALUES (5, 1, 3, 0.01, NULL, '克', NULL, NULL, '2022-08-19 00:40:10', '2022-08-23 10:11:44', NULL);
INSERT INTO `stock` VALUES (6, 2, 3, 0, NULL, '克', NULL, NULL, '2022-08-19 00:40:10', '2022-08-19 00:40:10', NULL);
INSERT INTO `stock` VALUES (7, 1, 4, 0, NULL, '克', NULL, NULL, '2022-08-19 00:40:12', '2022-08-19 00:40:12', NULL);
INSERT INTO `stock` VALUES (8, 2, 4, 0, NULL, '克', NULL, NULL, '2022-08-19 00:40:12', '2022-08-19 00:40:12', NULL);
INSERT INTO `stock` VALUES (9, 3, 1, 0, NULL, '吨', NULL, NULL, '2022-08-19 00:42:42', '2022-08-19 01:01:59', NULL);
INSERT INTO `stock` VALUES (10, 3, 2, 0, NULL, '吨', NULL, NULL, '2022-08-19 00:42:42', '2022-08-19 00:42:42', NULL);
INSERT INTO `stock` VALUES (11, 3, 3, 0, NULL, '克', NULL, NULL, '2022-08-19 00:42:42', '2022-08-19 00:42:42', NULL);
INSERT INTO `stock` VALUES (12, 3, 4, 0, NULL, '克', NULL, NULL, '2022-08-19 00:42:42', '2022-08-19 00:42:42', NULL);
INSERT INTO `stock` VALUES (13, 4, 1, 2.1, NULL, '吨', NULL, NULL, '2022-08-19 00:43:00', '2022-08-23 15:07:22', NULL);
INSERT INTO `stock` VALUES (14, 4, 2, 0, NULL, '吨', NULL, NULL, '2022-08-19 00:43:00', '2022-08-19 00:43:00', NULL);
INSERT INTO `stock` VALUES (15, 4, 3, 2.2, NULL, '克', NULL, NULL, '2022-08-19 00:43:00', '2022-08-19 06:57:17', NULL);
INSERT INTO `stock` VALUES (16, 4, 4, 800, NULL, '克', NULL, NULL, '2022-08-19 00:43:00', '2022-08-19 06:48:05', NULL);

-- ----------------------------
-- Table structure for warehouses
-- ----------------------------
DROP TABLE IF EXISTS `warehouses`;
CREATE TABLE `warehouses`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '仓库' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of warehouses
-- ----------------------------
INSERT INTO `warehouses` VALUES (1, '铁仓', '浙江温州龙湾区', '2022-08-12 09:22:03', '2022-08-19 00:42:17', NULL);
INSERT INTO `warehouses` VALUES (2, '铜仓', '浙江温州龙湾', '2022-08-12 09:23:02', '2022-08-19 00:42:21', NULL);
INSERT INTO `warehouses` VALUES (3, '南仓库', '海南', '2022-08-19 00:42:42', '2022-08-19 00:42:42', NULL);
INSERT INTO `warehouses` VALUES (4, '北仓库', '漠河', '2022-08-19 00:43:00', '2022-08-19 00:43:00', NULL);

-- ----------------------------
-- Table structure for warehousing
-- ----------------------------
DROP TABLE IF EXISTS `warehousing`;
CREATE TABLE `warehousing`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '入库单号',
  `warehousing_time` date NULL DEFAULT NULL COMMENT '入库日期',
  `company_id` int(11) NULL DEFAULT NULL COMMENT '供货单位',
  `warehouse_id` int(11) NULL DEFAULT NULL COMMENT '仓库ID',
  `purchase_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '采购单号',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '备注',
  `status` tinyint(1) NULL DEFAULT 0 COMMENT '状态：0-未审核，1-已审核',
  `creater` int(11) NULL DEFAULT NULL COMMENT '创建人',
  `updater` int(11) NULL DEFAULT NULL COMMENT '修改人',
  `auditer` int(11) NULL DEFAULT NULL COMMENT '审核人',
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '入库单-主表' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of warehousing
-- ----------------------------
INSERT INTO `warehousing` VALUES (1, 'RK202208190004', '2022-08-19', 1, 3, NULL, NULL, 0, 1, NULL, NULL, '2022-08-19 00:57:57', '2022-08-19 01:01:59', '2022-08-19 01:01:59');
INSERT INTO `warehousing` VALUES (2, 'RK202208190005', '2022-08-19', 1, 4, NULL, NULL, 1, 1, NULL, 1, '2022-08-19 01:00:21', '2022-08-19 06:58:38', NULL);
INSERT INTO `warehousing` VALUES (3, 'RK202208230010', '2022-08-23', 2, 1, 'CG202208230010', NULL, 0, 1, NULL, NULL, '2022-08-23 10:11:44', '2022-08-23 10:11:44', NULL);
INSERT INTO `warehousing` VALUES (4, 'RK202208230018', '2022-08-23', 1, 4, 'CG202208230012', NULL, 0, 1, NULL, NULL, '2022-08-23 14:24:53', '2022-08-23 14:24:53', NULL);

-- ----------------------------
-- Table structure for warehousing_detail
-- ----------------------------
DROP TABLE IF EXISTS `warehousing_detail`;
CREATE TABLE `warehousing_detail`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `warehousing_id` int(11) NOT NULL COMMENT '入库单ID',
  `product_id` int(11) NOT NULL COMMENT '产品ID',
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '产品名称',
  `num` float NOT NULL COMMENT '数量',
  `unit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '单位',
  `price` decimal(20, 2) NULL DEFAULT NULL COMMENT '单价',
  `money` decimal(20, 2) NULL DEFAULT NULL COMMENT '总价',
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '入库表-子表' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of warehousing_detail
-- ----------------------------
INSERT INTO `warehousing_detail` VALUES (1, 1, 1, '铜', 3.2, '吨', 10000.00, 32000.00, '2022-08-19 00:57:57', '2022-08-19 01:01:59', '2022-08-19 01:01:59');
INSERT INTO `warehousing_detail` VALUES (2, 2, 1, '铜', 2.1, '吨', 10000.00, 21000.00, '2022-08-19 01:00:21', '2022-08-19 01:00:21', NULL);
INSERT INTO `warehousing_detail` VALUES (3, 2, 4, '银', 800, '克', 299.00, 239200.00, '2022-08-19 01:00:21', '2022-08-19 01:00:21', NULL);
INSERT INTO `warehousing_detail` VALUES (4, 2, 3, '金', 3.2, '克', 499.00, 1596.80, '2022-08-19 01:00:21', '2022-08-19 01:00:21', NULL);
INSERT INTO `warehousing_detail` VALUES (5, 3, 1, 'Cu铜', 0.1, '吨', 55120.00, 5512.00, '2022-08-23 10:11:44', '2022-08-23 10:11:44', NULL);
INSERT INTO `warehousing_detail` VALUES (6, 3, 2, 'Fe铁', 3.2, '吨', 5200.00, 16640.00, '2022-08-23 10:11:44', '2022-08-23 10:11:44', NULL);
INSERT INTO `warehousing_detail` VALUES (7, 3, 3, '金', 0.01, '吨', 399000000.00, 3990000.00, '2022-08-23 10:11:44', '2022-08-23 10:11:44', NULL);
INSERT INTO `warehousing_detail` VALUES (8, 4, 1, 'Cu铜', 0.3, '吨', 55120.00, 16536.00, '2022-08-23 14:24:53', '2022-08-23 14:24:53', NULL);

SET FOREIGN_KEY_CHECKS = 1;
