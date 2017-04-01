USE sample_bank;

INSERT INTO `users` (`Username`, `Firstname`, `Lastname`, `Email`, `Password`)
VALUES ('andra.s', 'Andra', 'Simi', 'andra@tahoo.com', '12345');

SET @IdUser =  LAST_INSERT_ID();

INSERT INTO `credit_cards` (`IdUser`, `CardNumber`, `Cvv`, `ExpirationMonth`, `ExpirationYear`, `AddData`)
VALUES (@IdUser, '41111111111111', '123', '10', '2020', NOW());

SET @IdCard = LAST_INSERT_ID();

INSERT INTO `card_amounts` (`IdCreditCard`, `Sold`, `Currency`)
VALUES (@IdCard, 1000, 'RON');
