CREATE TABLE `pac3_daw`.`users` (
  `Id` INT NOT NULL,
  `UserName` VARCHAR(45) NOT NULL,
  `Password` VARCHAR(45) NOT NULL,
  `Address` VARCHAR(155) NULL,
  `CreatedAt` DATETIME NOT NULL,
  `CreatedBy` VARCHAR(45) NULL,
  `DisabledAt` DATETIME NULL,
  PRIMARY KEY (`Id`));