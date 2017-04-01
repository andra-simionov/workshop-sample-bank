USE sample_bank;

INSERT INTO `users` (`Username`, `Firstname`, `Lastname`, `Email`, `Password`, `RegisterDate`)
VALUES ('andra.s', 'Andra', 'Simi', 'andra@yahoo.com', '12345', NOw()),
  ('diana.d', 'Diana', 'Drajdi', 'diana@yahoo.com', '12345', NOW());

INSERT INTO `credit_cards` (`IdUser`, `CardNumber`, `Cvv`, `ExpirationMonth`, `ExpirationYear`, `AddDate`)
VALUES (1, '41111111111111', '123', '10', '2021', NOW()),
  (2, '422222222222', '456', '12', '2021', NOW());

INSERT INTO `card_amounts` (`IdCreditCard`, `Sold`, `Currency`)
VALUES (1, 6000, 'RON'),
  (2, 6000, 'RON');

INSERT INTO `user_credentials` (`ClientId`, `SecretKey`, `Email`, `AddDate`)
VALUES ('Andra_ID19', 'Andra_TEST', 'andra@yahoo.com', NOW()),
  ('Diana_ID10', 'Diana_TEST', 'diana@yahoo.com', NOW());
