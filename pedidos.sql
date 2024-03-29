-- MySQL Script generated by MySQL Workbench
-- 11/07/19 18:44:21
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema pedidos
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema pedidos
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `pedidos` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `pedidos` ;

-- -----------------------------------------------------
-- Table `pedidos`.`type_users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pedidos`.`type_users` (
  `idtype_user` TINYINT(3) NOT NULL,
  `name_type_user` VARCHAR(45) NOT NULL,
  `permission_json` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`idtype_user`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pedidos`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pedidos`.`users` (
  `document` VARCHAR(20) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `birth` VARCHAR(10) NOT NULL,
  `sexo` VARCHAR(1) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `idtype_user` TINYINT(3) NOT NULL,
  PRIMARY KEY (`document`),
  UNIQUE INDEX `documento_UNIQUE` (`document` ASC),
  INDEX `fk_users_type_users1_idx` (`idtype_user` ASC),
  CONSTRAINT `fk_users_type_users1`
    FOREIGN KEY (`idtype_user`)
    REFERENCES `pedidos`.`type_users` (`idtype_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pedidos`.`orders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pedidos`.`orders` (
  `idorder` INT NOT NULL AUTO_INCREMENT,
  `user_document` VARCHAR(20) NOT NULL,
  `datetime_order` VARCHAR(20) NOT NULL,
  `order_total` VARCHAR(6) NOT NULL,
  `status` VARCHAR(1) NULL DEFAULT '1',
  `send_mail` VARCHAR(1) NULL DEFAULT 0,
  PRIMARY KEY (`idorder`),
  INDEX `fk_orders_users_idx` (`user_document` ASC),
  CONSTRAINT `fk_orders_users`
    FOREIGN KEY (`user_document`)
    REFERENCES `pedidos`.`users` (`document`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pedidos`.`suppliers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pedidos`.`suppliers` (
  `idsupplier` TINYINT(3) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `status` VARCHAR(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idsupplier`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pedidos`.`products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pedidos`.`products` (
  `idproduct` SMALLINT NOT NULL,
  `idsupplier` TINYINT(3) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `value` VARCHAR(6) NOT NULL,
  `status` VARCHAR(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idproduct`),
  INDEX `fk_products_suppliers1_idx` (`idsupplier` ASC),
  CONSTRAINT `fk_products_suppliers1`
    FOREIGN KEY (`idsupplier`)
    REFERENCES `pedidos`.`suppliers` (`idsupplier`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pedidos`.`lines_orders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pedidos`.`lines_orders` (
  `idlines_order` INT NOT NULL AUTO_INCREMENT,
  `orders_idorder` INT NOT NULL,
  `idproduct` INT NOT NULL,
  `value_product` VARCHAR(6) NOT NULL,
  `quantity` VARCHAR(2) NULL,
  PRIMARY KEY (`idlines_order`),
  INDEX `fk_lines_orders_orders1_idx` (`orders_idorder` ASC),
  INDEX `fk_lines_orders_products1_idx` (`idproduct` ASC),
  CONSTRAINT `fk_lines_orders_orders1`
    FOREIGN KEY (`orders_idorder`)
    REFERENCES `pedidos`.`orders` (`idorder`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lines_orders_products1`
    FOREIGN KEY (`idproduct`)
    REFERENCES `pedidos`.`products` (`idproduct`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pedidos`.`modules`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pedidos`.`modules` (
  `idmodule` SMALLINT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idmodule`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pedidos`.`options`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pedidos`.`options` (
  `idoption` TINYINT(3) NOT NULL AUTO_INCREMENT,
  `option` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idoption`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pedidos`.`permissions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pedidos`.`permissions` (
  `idpermission` INT NOT NULL AUTO_INCREMENT,
  `document` VARCHAR(20) NOT NULL,
  `idmodule` SMALLINT NOT NULL,
  `idoption` TINYINT(3) NOT NULL,
  `status` VARCHAR(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`idpermission`),
  INDEX `fk_permissions_users1_idx` (`document` ASC),
  INDEX `fk_permissions_modules1_idx` (`idmodule` ASC),
  INDEX `fk_permissions_options1_idx` (`idoption` ASC),
  CONSTRAINT `fk_permissions_users1`
    FOREIGN KEY (`document`)
    REFERENCES `pedidos`.`users` (`document`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_permissions_modules1`
    FOREIGN KEY (`idmodule`)
    REFERENCES `pedidos`.`modules` (`idmodule`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_permissions_options1`
    FOREIGN KEY (`idoption`)
    REFERENCES `pedidos`.`options` (`idoption`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
