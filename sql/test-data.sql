USE sample_bank;

INSERT INTO `users` (`Username`, `Email`, `Password`, `RegistrationDate`)
VALUES ('andra.s', 'andra@yahoo.com', 'FpzDtOh4YG.ea52fc619ec7905b56bfc9d978a3cf37', NOw()),
  ('diana.d','diana@yahoo.com', 'FpzDtOh4YG.ea52fc619ec7905b56bfc9d978a3cf37', NOW());

INSERT INTO `credit_cards` (`IdUser`, `CardNumber`, `Cvv`, `ExpirationMonth`, `ExpirationYear`, `AddDate`)
VALUES (1, '4111111111111111', '123', '10', '2021', NOW()),
  (2, '4111111111111111', '456', '12', '2021', NOW());

INSERT INTO `card_amounts` (`IdCreditCard`, `Sold`, `Currency`)
VALUES (1, 6000, 'RON'),
  (2, 6000, 'RON');

INSERT INTO `user_credentials` (`ClientId`, `SecretKey`, `Email`, `AddDate`)
VALUES ('Andra_ID19', 'Andra_TEST', 'andra@yahoo.com', NOW()),
  ('Diana_ID10', 'Diana_TEST', 'diana@yahoo.com', NOW());
