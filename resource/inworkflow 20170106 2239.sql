--
-- Скрипт сгенерирован Devart dbForge Studio for MySQL, Версия 7.2.53.0
-- Домашняя страница продукта: http://www.devart.com/ru/dbforge/mysql/studio
-- Дата скрипта: 06.01.2017 22:39:14
-- Версия сервера: 5.5.53-0+deb8u1
-- Версия клиента: 4.1
--


-- 
-- Отключение внешних ключей
-- 
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

-- 
-- Установить режим SQL (SQL mode)
-- 
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 
-- Установка кодировки, с использованием которой клиент будет посылать запросы на сервер
--
SET NAMES 'utf8';

--
-- Описание для таблицы company
--
DROP TABLE IF EXISTS company;
CREATE TABLE company (
  id INT(11) NOT NULL AUTO_INCREMENT,
  account_name VARCHAR(50) NOT NULL,
  company_name VARCHAR(50) NOT NULL,
  url VARCHAR(255) NOT NULL,
  country VARCHAR(255) NOT NULL,
  timezone INT(11) DEFAULT NULL,
  active ENUM('Y','N') NOT NULL DEFAULT 'N',
  banned ENUM('Y','N') NOT NULL DEFAULT 'N',
  registered_at INT(11) NOT NULL,
  updated_at INT(11) NOT NULL,
  activate_code INT(8) DEFAULT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 1
AVG_ROW_LENGTH = 16384
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы country
--
DROP TABLE IF EXISTS country;
CREATE TABLE country (
  id INT(11) NOT NULL AUTO_INCREMENT,
  country_code CHAR(2) DEFAULT NULL,
  country_name VARCHAR(45) DEFAULT NULL,
  PRIMARY KEY (id),
  INDEX idx_country_code (country_code)
)
ENGINE = MYISAM
AUTO_INCREMENT = 248
AVG_ROW_LENGTH = 25
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы timezone
--
DROP TABLE IF EXISTS timezone;
CREATE TABLE timezone (
  id INT(10) NOT NULL AUTO_INCREMENT,
  country_code CHAR(2) NOT NULL,
  zone_name VARCHAR(35) NOT NULL,
  PRIMARY KEY (id),
  INDEX idx_zone_name (zone_name)
)
ENGINE = MYISAM
AUTO_INCREMENT = 418
AVG_ROW_LENGTH = 29
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы users
--
DROP TABLE IF EXISTS users;
CREATE TABLE users (
  id INT(11) NOT NULL AUTO_INCREMENT,
  company_id INT(11) DEFAULT NULL,
  name VARCHAR(50) DEFAULT NULL,
  email VARCHAR(50) DEFAULT NULL,
  passwd VARCHAR(255) DEFAULT NULL,
  timezone INT(11) DEFAULT 0,
  admin ENUM('Y','N') DEFAULT 'N',
  PRIMARY KEY (id),
  INDEX FK_users_company_id (company_id)
)
ENGINE = INNODB
AUTO_INCREMENT = 1
AVG_ROW_LENGTH = 16384
CHARACTER SET utf8
COLLATE utf8_general_ci;

-- 
-- Восстановить предыдущий режим SQL (SQL mode)
-- 
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;

-- 
-- Включение внешних ключей
-- 
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;