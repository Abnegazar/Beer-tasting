-- -----------------------------------------------------
-- Table `beer_tasting_app`.`beer`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `beer_tasting_app`.`beer` ;

CREATE TABLE IF NOT EXISTS `beer_tasting_app`.`beer` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `style` VARCHAR(255) NOT NULL,
  `aroma` TEXT NULL,
  `appearance` TEXT NULL,
  `flavor` TEXT NULL,
  `body` TEXT NULL,
  `comments` TEXT NULL,
  `story` TEXT NULL,
  `ingredients` TEXT NULL,
  `styles_comparison` TEXT NULL,
  `commercial_examples` TEXT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `idbiere_UNIQUE` (`id` ASC)  )
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `beer_tasting_app`.`tasting`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `beer_tasting_app`.`tasting` ;

CREATE TABLE IF NOT EXISTS `beer_tasting_app`.`tasting` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `beer_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `aroma_comment` VARCHAR(2000) NULL,
  `aroma_score` DECIMAL(2,1) NOT NULL,
  `appearance_comment` VARCHAR(2000) NULL,
  `appearance_score` DECIMAL(2,1) NOT NULL,
  `flavor_comment` VARCHAR(2000) NULL,
  `flavor_score` DECIMAL(2,1) NOT NULL,
  `mouthfeel_comment` VARCHAR(2000) NULL,
  `mouthfeel_score` DECIMAL(2,1) NOT NULL,
  `overall_comment` VARCHAR(2000) NULL,
  `overall_score` DECIMAL(2,1) NOT NULL,
  `total_score` DECIMAL(2,1) NOT NULL,
  `is_acetaldehyde` TINYINT NULL DEFAULT 0,
  `is_alcoholic` TINYINT NULL DEFAULT 0,
  `is_astringent` TINYINT NULL DEFAULT 0,
  `is_diacetyl` TINYINT NULL DEFAULT 0,
  `is_dms` TINYINT NULL DEFAULT 0,
  `is_estery` TINYINT NULL DEFAULT 0,
  `is_grassy` TINYINT NULL DEFAULT 0,
  `is_light-struck` TINYINT NULL DEFAULT 0,
  `is_metallic` TINYINT NULL DEFAULT 0,
  `is_musty` TINYINT NULL DEFAULT 0,
  `is_oxidized` TINYINT NULL DEFAULT 0,
  `is_phenolic` TINYINT NULL DEFAULT 0,
  `is_solvent` TINYINT NULL DEFAULT 0,
  `is_acidic` TINYINT NULL DEFAULT 0,
  `is_sulfur` TINYINT NULL DEFAULT 0,
  `is_vegetal` TINYINT NULL DEFAULT 0,
  `is_bottle_ok` TINYINT NULL DEFAULT 0,
  `is_yeasty` TINYINT NULL DEFAULT 0,
  `stylistic_accuracy` ENUM('0', '1', '2', '3', '4', '5') NULL DEFAULT '0',
  `intangibles` ENUM('0', '1', '2', '3', '4', '5') NULL DEFAULT '0',
  `technical_merit` ENUM('0', '1', '2', '3', '4', '5') NULL DEFAULT '0',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_user_has_beer_beer1_idx` (`beer_id` ASC)  ,
  INDEX `fk_user_has_beer_user_idx` (`user_id` ASC)  ,
  UNIQUE INDEX `idtasting_UNIQUE` (`id` ASC)  ,
  CONSTRAINT `fk_user_has_beer_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `beer_tasting_app`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_beer_beer1`
    FOREIGN KEY (`beer_id`)
    REFERENCES `beer_tasting_app`.`beer` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- -----------------------------------------------------
-- Table `beer_tasting_app`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `beer_tasting_app`.`user` ;

CREATE TABLE IF NOT EXISTS `beer_tasting_app`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(255) NOT NULL,
  `last_name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` CHAR(32) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `last_login_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_login_ip` INT(11) UNSIGNED NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) );

ALTER TABLE tasting ADD `title` VARCHAR(250) NOT NULL AFTER `id`;

ALTER TABLE user ADD `remember_me` TINYINT NULL DEFAULT 0;

ALTER TABLE tasting CHANGE `is_light-struck` is_light_struck TINYINT NULL DEFAULT 0;

ALTER TABLE tasting CHANGE `total_score` total DECIMAL(3,1);

ALTER TABLE user MODIFY user.password CHAR(60);

ALTER table tasting Add column beer_name varchar(250) NULL AFTER beer_id;

RENAME TABLE  `beer` TO  `beer_style` ;
ALTER TABLE tasting CHANGE beer_id beer_style_id int(11);

ALTER table user add column is_verified tinyint(1) DEFAULT 0 NOT NULL after created_at;

ALTER TABLE user MODIFY user.password CHAR(60) NOT NULL;

ALTER TABLE tasting MODIFY tasting.appearance_score DECIMAL(2,1) NOT NULL;
ALTER TABLE tasting MODIFY tasting.mouthfeel_score DECIMAL(2,1) NOT NULL;
ALTER TABLE tasting MODIFY tasting.overall_score  DECIMAL(2,1) NOT NULL;


