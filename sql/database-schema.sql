# table schema queries
CREATE DATABASE IF NOT EXISTS `sample_bank`;

USE `sample_bank`;

CREATE TABLE IF NOT EXISTS `users` (
	`IdUser` INT(11) NOT NULL AUTO_INCREMENT,
	`Username` VARCHAR(100) NOT NULL DEFAULT '',
	`FirstName` VARCHAR(50) NOT NULL DEFAULT '',
	`LastName` VARCHAR(50) NOT NULL DEFAULT '',
	`Email` VARCHAR(100) NOT NULL DEFAULT '',
	`Password` VARCHAR(40) NOT NULL DEFAULT '' COMMENT 'SHA-1 algorithm.',
	PRIMARY KEY (`IdUser`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=0;

CREATE TABLE IF NOT EXISTS `credit_cards` (
	`IdCreditCard` INT(11) NOT NULL AUTO_INCREMENT,
	`IdUser` INT(11) NOT NULL,
	`CardNumber` INT(19) NOT NULL,
	`Cvv` INT(4) NOT NULL,
	`Sold` INT(11) NOT NULL,
	`ExpirationDate` VARCHAR(7) NOT NULL,
	PRIMARY KEY (`IdCreditCard`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=0;
