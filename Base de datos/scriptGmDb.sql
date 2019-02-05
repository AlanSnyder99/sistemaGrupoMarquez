-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema GmDb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema GmDb
-- -----------------------------------------------------
DROP DATABASE IF EXISTS GmDb;
CREATE SCHEMA IF NOT EXISTS `GmDb` DEFAULT CHARACTER SET utf8 ;
USE `GmDb` ;


-- -----------------------------------------------------
-- Table `GmDb`.`Rol`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GmDb`.`Rol` (
  `idRol` INT NOT NULL,
  `tipo` VARCHAR(45) NULL,
  PRIMARY KEY (`idRol`),
  UNIQUE INDEX `tipo_UNIQUE` (`tipo` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GmDb`.`Integrantes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GmDb`.`Integrantes` (
  `idIntegrantes` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `razonSocial` VARCHAR(45) NULL,
  `domicilio` VARCHAR(45) NULL,
  PRIMARY KEY (`idIntegrantes`)
)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `GmDb`.`Clientes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GmDb`.`Clientes` (
  `idClientes` INT NOT NULL AUTO_INCREMENT,
  `nombreCompleto` VARCHAR(45) NOT NULL,
  `dni` INT NOT NULL,
  `productoComprado` VARCHAR(45) NULL,
  `Tarjetas_idTarjetas` INT NOT NULL,
  `observaciones` VARCHAR(45) NULL,
  `ruta_img` VARCHAR(45) NULL,
	`Usuario_idUsuario` INT NOT NULL,
	`fechaDeCreacion` VARCHAR(45) NULL,
  PRIMARY KEY (`idClientes`),
   FOREIGN KEY (`Usuario_idUsuario`)
    REFERENCES `GmDb`.`usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
      FOREIGN KEY (`Tarjetas_idTarjetas`)
    REFERENCES `GmDb`.`tarjetas` (`idTarjetas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GmDb`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GmDb`.`Usuario` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT,
  `nombreUsuario` VARCHAR(45) NULL,
  `clave` VARCHAR(150) NULL,
  `Rol_idRol` INT NOT NULL,
  `Integrantes_idIntegrantes` INT NOT NULL,
  
PRIMARY KEY (`idUsuario`),
  UNIQUE INDEX `nombreUsuario_UNIQUE` (`nombreUsuario` ASC),
  INDEX `fk_Usuario_Rol1` (`Rol_idRol` ASC),
  CONSTRAINT `fk_Usuario_Rol1`
    FOREIGN KEY (`Rol_idRol`)
    REFERENCES `GmDb`.`rol` (`idRol`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
   FOREIGN KEY (`Integrantes_idIntegrantes`)
    REFERENCES `GmDb`.`integrantes` (`idIntegrantes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
 
 )
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `GmDb`.`Marcas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GmDb`.`Marcas` (
  `idMarcas` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
PRIMARY KEY (`idMarcas`)
 )
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `GmDb`.`Servicios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GmDb`.`Servicios` (
  `idServicios` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `domicilio` VARCHAR(150) NULL,
  `telefono` INT NULL,
  `horarioDeAtencion` VARCHAR(150) NULL,
  `email` VARCHAR(150) NULL,
  `marcas` VARCHAR(150) NOT NULL,
  
PRIMARY KEY (`idServicios`)
 )
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `GmDb`.`Tarjetas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GmDb`.`Tarjetas` (
  `idTarjetas` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  PRIMARY KEY (`idTarjetas`)
)
ENGINE = InnoDB


DEFAULT CHARACTER SET = utf8;

use GmDb;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


insert into Rol 
values
(1,'Administrador'),(2,'Operador'),(3,'Operador2');

insert into Marcas 
values
(1,'Samsung'),(2,'Hp'),(3,'Lenovo'),(4,'Sommier center');

insert into Integrantes 
values
(1,'Grupo Marquez Moron',null,null),(2,'Grupo Marquez Luro',null,null),(3,'Alan2',null,null);


insert into Usuario(idUsuario, nombreUsuario, clave, Rol_idRol, Integrantes_idIntegrantes)
values
( 1,'admin1',md5('1111'),1,1),
( 2,'operador1',md5('2222'),2,2),
( 3,'operador2',md5('3333'),3,3),
( 4,'admin2',md5('1111'),1,1);

insert into Tarjetas (nombre)
values
('Visa'),('Cabal'),('Mastercard'),('Naranja');


