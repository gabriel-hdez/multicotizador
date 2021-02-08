/*
 Navicat Premium Data Transfer

 Source Server         : MySQL
 Source Server Type    : MySQL
 Source Server Version : 100411
 Source Host           : 127.0.0.7:3306
 Source Schema         : multicotizador

 Target Server Type    : MySQL
 Target Server Version : 100411
 File Encoding         : 65001

 Date: 08/02/2021 17:34:39
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for aseguradoras
-- ----------------------------
DROP TABLE IF EXISTS `aseguradoras`;
CREATE TABLE `aseguradoras`  (
  `id_aseguradora` int NOT NULL AUTO_INCREMENT,
  `aseguradora` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `rif` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tlf` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `correo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `img` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `estado_aseguradora` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '1',
  PRIMARY KEY (`id_aseguradora`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of aseguradoras
-- ----------------------------
INSERT INTO `aseguradoras` VALUES (1, 'MAPFRE Seguros', 'J-123456789', '02441234567', 'mapfre@correo.com', 'mapfre01.png', '1');
INSERT INTO `aseguradoras` VALUES (2, 'Mercantil Seguros', 'J-123456798', '04121234567', 'mercantil@correo.com', 'mercantil.png', '1');
INSERT INTO `aseguradoras` VALUES (3, 'Seguros Caracas', 'J-987654321', '02441234567', 'caracas@correo.com', 'SegurosCaracas_web.png', '0');
INSERT INTO `aseguradoras` VALUES (4, 'Seguros Universitas', 'J-123654789', '02441234567', 'universitas@correo.com', 'seguros-universitas.png', '1');
INSERT INTO `aseguradoras` VALUES (5, 'Estar Seguros', 'J-321456789', '02121234567', 'estar@correo.com', 'descarga.png', '1');
INSERT INTO `aseguradoras` VALUES (6, 'Seguros Altamira', 'J-654987321', '04241234567', 'altamira@correo.com', 'Logo-Entendemos-la-Vida-en-horizontal-y-alta.jpg', '1');
INSERT INTO `aseguradoras` VALUES (7, 'Multinacional de Seguros', 'J-58565452', '02441234567', 'multinacional@correo.com', 'unnamed.jpg', '1');

-- ----------------------------
-- Table structure for beneficiarios
-- ----------------------------
DROP TABLE IF EXISTS `beneficiarios`;
CREATE TABLE `beneficiarios`  (
  `id_beneficiario` int NOT NULL AUTO_INCREMENT,
  `id_cotizacion` int NULL DEFAULT NULL,
  `parentesco` enum('madre','hija','hermana','tia','prima','abuela','esposa','padre','hijo','hermano','tio','primo','abuelo','esposo','indefinido') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'indefinido',
  `nombres` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `apellidos` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `dni` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `genero` enum('1','2','3') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tlf` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `correo` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nacimiento` date NULL DEFAULT NULL,
  `estado` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '1',
  PRIMARY KEY (`id_beneficiario`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of beneficiarios
-- ----------------------------

-- ----------------------------
-- Table structure for condiciones
-- ----------------------------
DROP TABLE IF EXISTS `condiciones`;
CREATE TABLE `condiciones`  (
  `id_condicion` int NOT NULL AUTO_INCREMENT,
  `id_plan` int NULL DEFAULT NULL,
  `tipo_servicio` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `maternidad` decimal(18, 2) NULL DEFAULT NULL,
  `viaje_internacional` decimal(18, 2) NULL DEFAULT NULL,
  `gastos_funerarios` decimal(18, 2) NULL DEFAULT NULL,
  `atencion_primaria` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0',
  `vida` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0',
  `ambulancia` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0',
  `odontologia` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0',
  `oftalmologia` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0',
  `psicologia` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0',
  `nutricion` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0',
  `fisioterapia` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0',
  `dermatologia` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0',
  `muerte_accidental` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0',
  `invalidez_permanente` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0',
  `orientacion_medica_tlf` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0',
  `cirugia_bariatica` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0',
  `cirugia_profilactica_cancer` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0',
  `condicion_congenita` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0',
  `tratamiento_vih_sida` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0',
  `transplante` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `complicacion_nacimiento` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0',
  `complicacion_maternidad` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0',
  PRIMARY KEY (`id_condicion`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of condiciones
-- ----------------------------
INSERT INTO `condiciones` VALUES (1, 1, 'REEMBOLSO', 1000.00, 1000.00, 1100.00, '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', NULL, '1', '1', '1');
INSERT INTO `condiciones` VALUES (2, 2, 'REEMBOLSO', 2000.00, 2000.00, 2000.00, '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1');
INSERT INTO `condiciones` VALUES (3, 3, 'REEMBOLSO', 1000.00, 1000.00, 1100.00, '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', NULL, '1', '1', NULL, NULL, NULL, '1', NULL, NULL);
INSERT INTO `condiciones` VALUES (4, 4, 'REEMBOLSO', 2000.00, 2000.00, 2000.00, '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', NULL, '1', NULL, NULL);
INSERT INTO `condiciones` VALUES (5, 5, 'REEMBOLSO', 2000.00, 2000.00, 2000.00, '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1');

-- ----------------------------
-- Table structure for cotizaciones
-- ----------------------------
DROP TABLE IF EXISTS `cotizaciones`;
CREATE TABLE `cotizaciones`  (
  `id_cotizacion` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NULL DEFAULT NULL,
  `codigo` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `fecha_creacion` timestamp(0) NULL DEFAULT current_timestamp(0),
  `nombres` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `apellidos` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `dni` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `genero` enum('1','2','3') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tlf` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `correo` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nacimiento` date NULL DEFAULT NULL,
  `estado` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '1',
  PRIMARY KEY (`id_cotizacion`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of cotizaciones
-- ----------------------------

-- ----------------------------
-- Table structure for detalles_cotizacion
-- ----------------------------
DROP TABLE IF EXISTS `detalles_cotizacion`;
CREATE TABLE `detalles_cotizacion`  (
  `id_detalle` int NOT NULL AUTO_INCREMENT,
  `id_cotizacion` int NULL DEFAULT NULL,
  `id_plan` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_detalle`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of detalles_cotizacion
-- ----------------------------

-- ----------------------------
-- Table structure for planes
-- ----------------------------
DROP TABLE IF EXISTS `planes`;
CREATE TABLE `planes`  (
  `id_plan` int NOT NULL AUTO_INCREMENT,
  `id_aseguradora` int NULL DEFAULT NULL,
  `codigo` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `plan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',
  `suma_asegurada` decimal(18, 2) NULL DEFAULT NULL,
  `deducible_nacional` decimal(18, 2) NULL DEFAULT NULL,
  `deducible_exterior` decimal(18, 2) NULL DEFAULT NULL,
  `plazo` int NULL DEFAULT NULL,
  `estado` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '1',
  PRIMARY KEY (`id_plan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of planes
-- ----------------------------
INSERT INTO `planes` VALUES (1, 5, 'dsf8wjrcy0', 'Estar basico', 2000.00, 2000.00, 2100.00, 12, '1');
INSERT INTO `planes` VALUES (2, 5, 'mbvtuf8j41', 'Estar premium', 3000.00, 3000.00, 3200.00, 9, '1');
INSERT INTO `planes` VALUES (3, 1, 'dxubcjs6z7', 'MAPFRE bronze', 2000.00, 2000.00, 2100.00, 24, '1');
INSERT INTO `planes` VALUES (4, 1, 'p75qtfhcax', 'MAPFRE silver', 2800.00, 2800.00, 2900.00, 18, '1');
INSERT INTO `planes` VALUES (5, 1, '8mniualyb7', 'MAPFRE gold', 3000.00, 3000.00, 3200.00, 12, '1');

-- ----------------------------
-- Table structure for primas
-- ----------------------------
DROP TABLE IF EXISTS `primas`;
CREATE TABLE `primas`  (
  `id_prima` int NOT NULL AUTO_INCREMENT,
  `id_plan` int NULL DEFAULT NULL,
  `titular_9` decimal(18, 2) NULL DEFAULT NULL,
  `titular_19` decimal(18, 2) NULL DEFAULT NULL,
  `titular_29` decimal(18, 2) NULL DEFAULT NULL,
  `titular_39` decimal(18, 2) NULL DEFAULT NULL,
  `titular_49` decimal(18, 2) NULL DEFAULT NULL,
  `titular_54` decimal(18, 2) NULL DEFAULT NULL,
  `titular_59` decimal(18, 2) NULL DEFAULT NULL,
  `titular_69` decimal(18, 2) NULL DEFAULT NULL,
  `titular_75` decimal(18, 2) NULL DEFAULT NULL,
  `beneficiario_9` decimal(18, 2) NULL DEFAULT NULL,
  `beneficiario_19` decimal(18, 2) NULL DEFAULT NULL,
  `beneficiario_29` decimal(18, 2) NULL DEFAULT NULL,
  `beneficiario_39` decimal(18, 2) NULL DEFAULT NULL,
  `beneficiario_49` decimal(18, 2) NULL DEFAULT NULL,
  `beneficiario_54` decimal(18, 2) NULL DEFAULT NULL,
  `beneficiario_59` decimal(18, 2) NULL DEFAULT NULL,
  `beneficiario_69` decimal(18, 2) NULL DEFAULT NULL,
  `beneficiario_75` decimal(18, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id_prima`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of primas
-- ----------------------------
INSERT INTO `primas` VALUES (1, 1, 500.00, 600.00, 700.00, 800.00, 900.00, 1000.00, 1100.00, 1200.00, 1300.00, 550.00, 650.00, 750.00, 850.00, 950.00, 1050.00, 1150.00, 1250.00, 1350.00);
INSERT INTO `primas` VALUES (2, 2, 1500.00, 1600.00, 1700.00, 1800.00, 1900.00, 2000.00, 2100.00, 2200.00, 2300.00, 1550.00, 1650.00, 1750.00, 1850.00, 1950.00, 2050.00, 2150.00, 2250.00, 2350.00);
INSERT INTO `primas` VALUES (3, 3, 500.00, 600.00, 700.00, 800.00, 900.00, 1000.00, 1100.00, 1200.00, 1300.00, 550.00, 650.00, 750.00, 850.00, 950.00, 1050.00, 1150.00, 1250.00, 1350.00);
INSERT INTO `primas` VALUES (4, 4, 1000.00, 1100.00, 1200.00, 1300.00, 1400.00, 1500.00, 1600.00, 1700.00, 1800.00, 1550.00, 1650.00, 1750.00, 1850.00, 1950.00, 2050.00, 2150.00, 2250.00, 2350.00);
INSERT INTO `primas` VALUES (5, 5, 1000.00, 1100.00, 1200.00, 1300.00, 1400.00, 1500.00, 1600.00, 1700.00, 1800.00, 1550.00, 1650.00, 1750.00, 1850.00, 1950.00, 2050.00, 2150.00, 2250.00, 2350.00);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id_rol` int NOT NULL AUTO_INCREMENT,
  `rol` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_rol`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'Administrador');
INSERT INTO `roles` VALUES (2, 'Usuario');

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios`  (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `id_rol` int NULL DEFAULT NULL,
  `correo` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',
  `clave` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',
  `pregunta` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `respuesta` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`id_usuario`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES (1, 1, 'admin@correo.com', '302904879a75ca3552c830271158054e300d45c0293c8c5d4d3325a23e607f36bca332cd97d0477b3ae7156afb624ccb50be65819777b1c7d3cfc023f162b705gzxhPzYP7HJmuMlWkLnpVJT1faSrDd0DG1uCN6JAbLA=', 'Administrador', 'admin', '302904879a75ca3552c830271158054e300d45c0293c8c5d4d3325a23e607f36bca332cd97d0477b3ae7156afb624ccb50be65819777b1c7d3cfc023f162b705gzxhPzYP7HJmuMlWkLnpVJT1faSrDd0DG1uCN6JAbLA=');

SET FOREIGN_KEY_CHECKS = 1;
