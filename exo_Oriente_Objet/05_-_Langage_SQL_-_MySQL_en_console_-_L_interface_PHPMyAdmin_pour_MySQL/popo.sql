CREATE TABLE IF NOT EXISTS `conversation` (
    `c_id` INT(11) NOT NULL AUTO_INCREMENT, 
    `c_date` DATETIME NOT NULL,
    `c_termine` TINYINT(1) NOT NULL DEFAULT 0, 
    PRIMARY KEY (`c_id`)
) ENGINE=InnoDB CHARSET=utf8mb4; 

CREATE TABLE IF NOT EXISTS `rang` (
    `r_id` INT(11) NOT NULL AUTO_INCREMENT, 
    `r_libelle` VARCHAR(255) NOT NULL, 
    PRIMARY KEY (`r_id`)
) ENGINE=InnoDB CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `user` (
    `u_id` INT(11) NOT NULL AUTO_INCREMENT, 
    `u_login` VARCHAR(30) NOT NULL,
    `u_prenom` VARCHAR(255) NULL DEFAULT NULL ,
    `u_nom` VARCHAR(255) NULL DEFAULT NULL,
    `u_date_naissance` DATE NULL DEFAULT NULL,
    `u_date_inscription` DATETIME NOT NULL, 
    `u_rang_fk` INT(11) NOT NULL, 
    PRIMARY KEY (`u_id`),
    KEY (`u_rang_fk`), CONSTRAINT `fk_u_rang_r_id` FOREIGN KEY (`u_rang_fk`) REFERENCES `rang`(`r_id`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB CHARSET=utf8mb4; 

CREATE TABLE IF NOT EXISTS `message` (
    `m_id` INT(11) NOT NULL AUTO_INCREMENT, 
    `m_contenu` VARCHAR(2040) NOT NULL,
    `m_date`DATETIME NOT NULL,
    `m_auteur_fk` INT(11) NOT NULL, 
    `m_conversation_fk` INT(11) NOT NULL, 
    PRIMARY KEY (`m_id`),
    KEY (`m_conversation_fk`),CONSTRAINT `fk_m_conversation_c_id` FOREIGN KEY (`m_conversation_fk`) REFERENCES `conversation`(`c_id`) ON UPDATE CASCADE ON DELETE RESTRICT,
    KEY (`m_auteur_fk`), CONSTRAINT `fk_mauteur_uid` FOREIGN KEY (`m_auteur_fk`) REFERENCES `user`(`u_id`) ON UPDATE CASCADE ON DELETE RESTRICT 
) ENGINE=InnoDB CHARSET=utf8mb4; 
