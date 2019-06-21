USE sample_bank;

INSERT INTO `users` (`Username`, `Email`, `Password`, `RegistrationDate`)
VALUES ('andra.s', 'andra@yahoo.com', 'FpzDtOh4YG.ea52fc619ec7905b56bfc9d978a3cf37', NOw()),
  ('diana.d','diana@yahoo.com', 'FpzDtOh4YG.ea52fc619ec7905b56bfc9d978a3cf37', NOW());

INSERT INTO `credit_cards` (`IdUser`, `CardNumber`, `Cvv`, `ExpirationMonth`, `ExpirationYear`, `AddDate`)
VALUES (1, '4111111111111111', '123', '10', '2021', NOW()),
  (2, '4111111111111111', '456', '12', '2021', NOW());

INSERT INTO `card_amounts` (`IdCreditCard`, `Balance`, `Currency`, `AddDate`)
VALUES (1, 6000, 'RON', NOW()),
  (2, 6000, 'RON', NOW());

INSERT INTO `stores` (`StoreName`, `StoreId`, `SecretKey`, `AddDate`)
VALUES ('SampleStore', 'SampleStore_ID19', 'SampleStore_TEST', NOW()),
  ('PC_Garage','PC_Garage_ID10', 'PC_Garage_TEST', NOW());

INSERT INTO `client_tokens` (`IdUser`, `IdStore`, `ClientToken`, `AddDate`)
VALUES (1, 1, '2da9a98c-4e87-4fe7-a4cb-842768118e09', NOW()),
  (2,2, '2da9a98c-4e87-4fe7-a4cb-842768118e09', NOW());
