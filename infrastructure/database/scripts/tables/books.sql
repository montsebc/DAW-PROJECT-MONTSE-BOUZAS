CREATE TABLE `pac3_daw`.`books` (
  `ISBN` VARCHAR(45) NOT NULL,
  `Name` VARCHAR(45) NOT NULL,
  `Description` VARCHAR(255) NULL,
  `Editorial` VARCHAR(45) NOT NULL,
  `Edition` VARCHAR(45) NOT NULL,
  `CreatedAt` DATETIME NOT NULL,
  `CreatedBy` VARCHAR(45) NULL,
  `UpdatedAt` VARCHAR(45) NULL,
  PRIMARY KEY (`ISBN`));
