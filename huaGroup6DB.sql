-- MySQL Script generated by MySQL Workbench
-- Sun Dec  6 17:59:43 2020
-- Model: New Model    Version: 1.0
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
-- Table `mydb`.`Events`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `mydb`.`Events` (
  `idEvents` INT NOT NULL,
  `eventName` VARCHAR(255) NOT NULL,
  `eventAddress` VARCHAR(255) NOT NULL,
  `eventDescription` MEDIUMTEXT NOT NULL,
  `eventStart` DATE NOT NULL,
  `eventEnd` DATE NOT NULL,
  PRIMARY KEY (`idEvents`),
  UNIQUE INDEX `eventName_UNIQUE` (`eventName` ASC),
  UNIQUE INDEX `idEvents_UNIQUE` (`idEvents` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Participants`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `mydb`.`Participants` (
  `idParticipants` INT NOT NULL DEFAULT 0,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `eventsParticipated` VARCHAR(45) NULL,
  PRIMARY KEY (`idParticipants`),
  UNIQUE INDEX `idParticipants_UNIQUE` (`idParticipants` ASC),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Events_has_Participants`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `mydb`.`Events_has_Participants` (
  `Events_idEvents` INT NOT NULL,
  `Participants_idParticipants` INT NOT NULL,
  PRIMARY KEY (`Events_idEvents`, `Participants_idParticipants`),
  INDEX `fk_Events_has_Participants_Participants1_idx` (`Participants_idParticipants` ASC),
  INDEX `fk_Events_has_Participants_Events_idx` (`Events_idEvents` ASC),
  CONSTRAINT `fk_Events_has_Participants_Events`
    FOREIGN KEY (`Events_idEvents`)
    REFERENCES `mydb`.`Events` (`idEvents`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Events_has_Participants_Participants1`
    FOREIGN KEY (`Participants_idParticipants`)
    REFERENCES `mydb`.`Participants` (`idParticipants`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Admins`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `mydb`.`Admins` (
  `idParticipants` INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idParticipants`),
  UNIQUE INDEX `idParticipants_UNIQUE` (`idParticipants` ASC),
  CONSTRAINT `idParticpants`
    FOREIGN KEY (`idParticipants`)
    REFERENCES `mydb`.`Participants` (`idParticipants`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Organize`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `mydb`.`Organize` (
  `adminId` INT NOT NULL,
  `eventsId` INT,
  `status` TINYINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`adminId`, `eventsId`),
  UNIQUE INDEX `adminId_UNIQUE` (`adminId` ASC),
  UNIQUE INDEX `eventsId_UNIQUE` (`eventsId` ASC),
  CONSTRAINT `idParticipants`
    FOREIGN KEY (`adminId`)
    REFERENCES `mydb`.`Admins` (`idParticipants`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Organize_Events1`
    FOREIGN KEY (`eventsId`)
    REFERENCES `mydb`.`Events` (`idEvents`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`superAdmin`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `mydb`.`superAdmin` (
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`username`, `password`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  UNIQUE INDEX `password_UNIQUE` (`password` ASC))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
