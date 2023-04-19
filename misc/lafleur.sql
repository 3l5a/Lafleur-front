-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`cities`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`cities` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NOT NULL,
  `zip_code` VARCHAR(5) NOT NULL,
  `deliverable` TINYINT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`customers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`customers` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `address` VARCHAR(45) NOT NULL,
  `city_id` INT NOT NULL,
  `email` VARCHAR(254) NOT NULL,
  `password` VARCHAR(70) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_client_ville_idx` (`city_id` ASC),
  CONSTRAINT `fk_client_ville`
    FOREIGN KEY (`city_id`)
    REFERENCES `mydb`.`cities` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`suppliers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`suppliers` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NOT NULL,
  `siret` VARCHAR(45) NOT NULL,
  `phone` VARCHAR(12) NOT NULL,
  `address` VARCHAR(45) NULL,
  `ville_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_fournisseur_ville1_idx` (`ville_id` ASC),
  CONSTRAINT `fk_fournisseur_ville1`
    FOREIGN KEY (`ville_id`)
    REFERENCES `mydb`.`cities` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`ref_colors`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`ref_colors` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `color_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`measures`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`measures` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `measure_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`stock_items`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`stock_items` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `item_name` VARCHAR(45) NOT NULL,
  `color_id` INT NOT NULL,
  `desc` VARCHAR(100) NULL,
  `measures_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_matieres_premieres_couleurs1_idx` (`color_id` ASC),
  INDEX `fk_stock_items_measures1_idx` (`measures_id` ASC),
  CONSTRAINT `fk_matieres_premieres_couleurs1`
    FOREIGN KEY (`color_id`)
    REFERENCES `mydb`.`ref_colors` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_stock_items_measures1`
    FOREIGN KEY (`measures_id`)
    REFERENCES `mydb`.`measures` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`ref_payment_methods`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`ref_payment_methods` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name_payment_method` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`order_status`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`order_status` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `status_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`orders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`orders` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `time` TIMESTAMP(1) NOT NULL,
  `client_id` INT NOT NULL,
  `credit_card_number` INT NULL,
  `payment_method_id` INT NOT NULL,
  `order_status_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_infos_paiment_client1_idx` (`client_id` ASC),
  INDEX `fk_commandes_clients_moyens_de_paiement1_idx` (`payment_method_id` ASC),
  INDEX `fk_commandes_clients_order_status1_idx` (`order_status_id` ASC),
  CONSTRAINT `fk_infos_paiment_client1`
    FOREIGN KEY (`client_id`)
    REFERENCES `mydb`.`customers` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_commandes_clients_moyens_de_paiement1`
    FOREIGN KEY (`payment_method_id`)
    REFERENCES `mydb`.`ref_payment_methods` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_commandes_clients_order_status1`
    FOREIGN KEY (`order_status_id`)
    REFERENCES `mydb`.`order_status` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`supplier_orders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`supplier_orders` (
  `id` BIGINT NOT NULL,
  `supplier_id` INT NOT NULL,
  `date` DATE NOT NULL,
  INDEX `fk_fournisseur_has_matieres_premieres_fournisseur1_idx` (`supplier_id` ASC),
  PRIMARY KEY (`id`, `supplier_id`),
  CONSTRAINT `fk_fournisseur_has_matieres_premieres_fournisseur1`
    FOREIGN KEY (`supplier_id`)
    REFERENCES `mydb`.`suppliers` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`products` (
  `id` INT NOT NULL,
  `description` VARCHAR(45) NULL,
  `image` VARCHAR(45) NULL,
  `price` DECIMAL(5,2) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`order_items`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`order_items` (
  `order_id` INT NOT NULL,
  `product_id` INT NOT NULL,
  `quantity` INT NOT NULL,
  PRIMARY KEY (`order_id`, `product_id`),
  INDEX `fk_facture_has_composition_bouquet_facture1_idx` (`order_id` ASC),
  INDEX `fk_lignes_de_commandes_articles1_idx` (`product_id` ASC),
  CONSTRAINT `fk_facture_has_composition_bouquet_facture1`
    FOREIGN KEY (`order_id`)
    REFERENCES `mydb`.`orders` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lignes_de_commandes_articles1`
    FOREIGN KEY (`product_id`)
    REFERENCES `mydb`.`products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`product_compositions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`product_compositions` (
  `stock_item_id` INT NOT NULL,
  `product_id` INT NOT NULL,
  `quantity` INT NOT NULL,
  PRIMARY KEY (`stock_item_id`, `product_id`),
  INDEX `fk_fleurs_has_articles_articles1_idx` (`product_id` ASC),
  INDEX `fk_fleurs_has_articles_fleurs1_idx` (`stock_item_id` ASC),
  CONSTRAINT `fk_fleurs_has_articles_fleurs1`
    FOREIGN KEY (`stock_item_id`)
    REFERENCES `mydb`.`stock_items` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_fleurs_has_articles_articles1`
    FOREIGN KEY (`product_id`)
    REFERENCES `mydb`.`products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`items_ordered`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`items_ordered` (
  `supplier_order_id` INT NOT NULL,
  `stock_item_id` INT NOT NULL,
  `quantity` INT NOT NULL,
  PRIMARY KEY (`supplier_order_id`, `stock_item_id`),
  INDEX `fk_commandes_fournisseurs_has_fleurs_fleurs1_idx` (`stock_item_id` ASC),
  INDEX `fk_commandes_fournisseurs_has_fleurs_commandes_fournisseurs_idx` (`supplier_order_id` ASC),
  CONSTRAINT `fk_commandes_fournisseurs_has_fleurs_commandes_fournisseurs1`
    FOREIGN KEY (`supplier_order_id`)
    REFERENCES `mydb`.`supplier_orders` (`supplier_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_commandes_fournisseurs_has_fleurs_fleurs1`
    FOREIGN KEY (`stock_item_id`)
    REFERENCES `mydb`.`stock_items` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`categories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `category_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`emails_newsletters`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`emails_newsletters` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`category_product`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`category_product` (
  `product_id` INT NOT NULL,
  `category_id` INT NOT NULL,
  PRIMARY KEY (`product_id`, `category_id`),
  INDEX `fk_articles_has_categories_categories1_idx` (`category_id` ASC),
  INDEX `fk_articles_has_categories_articles1_idx` (`product_id` ASC),
  CONSTRAINT `fk_articles_has_categories_articles1`
    FOREIGN KEY (`product_id`)
    REFERENCES `mydb`.`products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_articles_has_categories_categories1`
    FOREIGN KEY (`category_id`)
    REFERENCES `mydb`.`categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
