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
	`ExpirationMonth` INT(2) NOT NULL,
	`ExpirationYear` INT(4) NOT NULL,
	`AddDate` DATETIME,
	`ChangeDate` DATETIME,
	PRIMARY KEY (`IdCreditCard`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=0;

CREATE TABLE IF NOT EXISTS `card_amounts` (
	`IdCardAmounts` INT(11) NOT NULL AUTO_INCREMENT,
	`IdCreditCard` INT(11) NOT NULL,
	`Sold` INT(11) NOT NULL,
	`Currency` INT(11) NOT NULL DEFAULT 'RON',
	PRIMARY KEY (`IdCardAmounts`)
)
	COLLATE='utf8_general_ci'
	ENGINE=InnoDB
	AUTO_INCREMENT=0;
