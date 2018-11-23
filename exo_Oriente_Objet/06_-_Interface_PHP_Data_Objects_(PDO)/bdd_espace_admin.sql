-------- Créer la BDD ------------------------------------
CREATE DATABASE IF NOT EXISTS `espace_admin` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ; 


-------- Créer les tables  ------------------------------------

CREATE TABLE IF NOT EXISTS `AUTORISATION` (
    `AUT_id` INT NOT NULL AUTO_INCREMENT, 
    `AUT_name` VARCHAR (50) NOT NULL,
    PRIMARY KEY (`AUT_id`)
) ENGINE=InnoDB CHARSET=utf8mb4; 


CREATE TABLE IF NOT EXISTS `ROLE` (
    `ROL_id` INT NOT NULL AUTO_INCREMENT, 
    `ROL_name` VARCHAR (50) NOT NULL,
    PRIMARY KEY (`ROL_id`)
) ENGINE=InnoDB CHARSET=utf8mb4; 


CREATE TABLE IF NOT EXISTS `USER` (
    `USE_id` INT NOT NULL AUTO_INCREMENT, 
    `USE_login` VARCHAR (50) NOT NULL,
    `USE_psw` VARCHAR (50) NOT NULL,
    `USE_role_fk` INT NOT NULL,
    PRIMARY KEY (`USE_id`),
    KEY (`USE_role_fk`), CONSTRAINT `USER_ROLE` FOREIGN KEY (`USE_role_fk`) REFERENCES `ROLE`(`ROL_id`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB CHARSET=utf8mb4; 

CREATE TABLE IF NOT EXISTS `DETIENT` (
    `DET_aut_fk` INT NOT NULL , 
    `DET_role_fk` INT NOT NULL , 
    PRIMARY KEY (`DET_aut_fk`, `DET_role_fk`),
    KEY (`DET_aut_fk`), CONSTRAINT `DETIENT_AUT` FOREIGN KEY (`DET_aut_fk`) REFERENCES `AUTORISATION`(`AUT_id`) ON UPDATE CASCADE ON DELETE RESTRICT,
    KEY (`DET_role_fk`), CONSTRAINT `DETIENT_ROLE` FOREIGN KEY (`DET_role_fk`) REFERENCES `ROLE`(`ROL_id`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB CHARSET=utf8mb4; 



