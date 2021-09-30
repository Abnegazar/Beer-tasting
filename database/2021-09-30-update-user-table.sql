-- -----------------------------------------------------
-- Table `beer_tasting_app`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `beer_tasting_app`.`user` ;

CREATE TABLE IF NOT EXISTS `beer_tasting_app`.`user` (
  `idUser` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(50) NOT NULL,
  `last_name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NULL,
  `password` VARCHAR(32) NOT NULL,
  `rememberme` TINYINT NULL DEFAULT 0,
  `create_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` TIMESTAMP NULL,
  `last_login_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_login_id` INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`idUser`),
  UNIQUE INDEX `idUser_UNIQUE` (`idUser` ASC));