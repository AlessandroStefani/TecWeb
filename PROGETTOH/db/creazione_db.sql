SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE SCHEMA IF NOT EXISTS `progweb` DEFAULT CHARACTER SET utf8 ;
USE `progweb` ;


CREATE TABLE IF NOT EXISTS `progweb`.`utente` (
    `idutente` INT NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(128) NOT NULL,
    `email` VARCHAR(128) NOT NULL,
    `password` VARCHAR(512) NOT NULL,
    `foto profilo` VARCHAR(128),
    PRIMARY KEY (`idutente`),
    UNIQUE(`email`)
)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `progweb`.`post` (
    `idpost` INT NOT NULL AUTO_INCREMENT,
    `testo` TEXT,
    `immagine` VARCHAR(128),
    `autore` INT NOT NULL,
    `data` DATETIME NOT NULL,
    PRIMARY KEY (`idpost`),    
    FOREIGN KEY (`autore`) REFERENCES `progweb`.`utente` (idutente)
)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `progweb`.`film` (
    `idfilm` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(128) NOT NULL,
    `durata` INT NOT NULL,
    `trama` TEXT DEFAULT "trama non disponibile",
    `immagine` VARCHAR(128),
    PRIMARY KEY (`idfilm`)
)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `progweb`.`serietv` (    
    `idserietv` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(128) NOT NULL,
    `stagioni` INT NOT NULL,
    `episodi` INT NOT NULL,
    `durata episodi` INT NOT NULL,
    `trama` TEXT DEFAULT "trama non disponibile",
    `immagine` VARCHAR(128),
    PRIMARY KEY (`idserietv`)
)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `progweb`.`anime` (    
    `idanime` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(128) NOT NULL,
    `stagioni` INT NOT NULL,
    `episodi` INT NOT NULL,
    `durata episodi` INT NOT NULL,
    `trama` TEXT DEFAULT "trama non disponibile",
    `immagine` VARCHAR(128),
    PRIMARY KEY (`idanime`)
)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `progweb`.`post_associati` (
    `idpost` INT,
    `idfilm` INT,
    `idserietv` INT,
    `idanime` INT,
    FOREIGN KEY (`idpost`) REFERENCES `progweb`.`post` (idpost),
    FOREIGN KEY (`idfilm`) REFERENCES `progweb`.`film` (idfilm),
    FOREIGN KEY (`idserietv`) REFERENCES `progweb`.`serietv` (idserietv),
    FOREIGN KEY (`idanime`) REFERENCES `progweb`.`anime` (idanime)
)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `progweb`.`content_seguito` (
    `idutente` INT,
    `idfilm` INT,
    `idserietv` INT,
    `idanime` INT,
    `notifiche` BOOLEAN DEFAULT 0, 
    FOREIGN KEY (`idutente`) REFERENCES `progweb`.`utente` (idutente),
    FOREIGN KEY (`idfilm`) REFERENCES `progweb`.`film` (idfilm),
    FOREIGN KEY (`idserietv`) REFERENCES `progweb`.`serietv` (idserietv),
    FOREIGN KEY (`idanime`) REFERENCES `progweb`.`anime` (idanime),
    UNIQUE(`idfilm`),
    UNIQUE(`idserietv`),
    UNIQUE(`idanime`)
)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `progweb`.`utente_seguito`(
    `idutente` INT,
    `idutenteseguito` INT
)
ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;