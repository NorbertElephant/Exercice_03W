-- CREATE DATABASE IF NOT EXISTS `popo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- CREATE TABLE IF NOT EXISTS `conversation` (
--     `c_id` INT(11) NOT NULL,
--     `c_date` DATETIME NOT NULL,
--     `c_termine` TINYINT(1) NOT NULL DEFAULT 0
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- -- ALTER TABLE `conversation` ADD PRIMARY KEY (`c_id`);
-- -- ALTER TABLE `conversation` CHANGE `c_id` `c_id` INT(11) NOT NULL AUTO_INCREMENT;
-- ALTER TABLE `conversation` ADD PRIMARY KEY (`c_id`), CHANGE `c_id` `c_id` INT(11) NOT NULL AUTO_INCREMENT;
CREATE TABLE IF NOT EXISTS `conversation` (
    `c_id` INT(11) NOT NULL AUTO_INCREMENT,
    `c_date` DATETIME NOT NULL,
    `c_termine` TINYINT(1) NOT NULL DEFAULT 0,
    PRIMARY KEY (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- CREATE TABLE IF NOT EXISTS `message` (
--     `m_id` INT(11) NOT NULL AUTO_INCREMENT,
--     `m_contenu` VARCHAR(2040) NOT NULL,
--     `m_date` DATETIME NOT NULL,
--     `m_auteur_fk` INT(11) NOT NULL,
--     `m_conversation_fk` INT(11) NOT NULL,
--     PRIMARY KEY (`m_id`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- ALTER TABLE `message` ADD KEY (`m_auteur_fk`), ADD KEY (`m_conversation_fk`);
-- CREATE TABLE IF NOT EXISTS `message` (
--     `m_id` INT(11) NOT NULL AUTO_INCREMENT,
--     `m_contenu` VARCHAR(2040) NOT NULL,
--     `m_date` DATETIME NOT NULL,
--     `m_auteur_fk` INT(11) NOT NULL,
--     `m_conversation_fk` INT(11) NOT NULL,
--     PRIMARY KEY (`m_id`),
--     KEY (`m_auteur_fk`),
--     KEY (`m_conversation_fk`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- CREATE TABLE IF NOT EXISTS `rang` (
--     `r_id` INT(11) NOT NULL AUTO_INCREMENT,
--     `r_libelle` VARCHAR(255) NOT NULL,
--     PRIMARY KEY (`r_id`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- -- CREATE TABLE IF NOT EXISTS `user` (
-- --     `u_id` INT(11) NOT NULL AUTO_INCREMENT,
-- --     `u_login` VARCHAR(30) NOT NULL,
-- --     `u_prenom` VARCHAR(255) DEFAULT NULL,
-- --     `u_nom` VARCHAR(255) DEFAULT NULL,
-- --     `u_date_naissance` DATE DEFAULT NULL,
-- --     `u_date_inscription` DATETIME NOT NULL,
-- --     `u_rang_fk` INT(11) NOT NULL,
-- --     PRIMARY KEY (`u_id`),
-- --     KEY (`u_rang_fk`)
-- -- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- -- ALTER TABLE `user` ADD CONSTRAINT `constr_user_rang` FOREIGN KEY (`u_rang_fk`) REFERENCES `rang` (`r_id`) ON UPDATE CASCADE ON DELETE RESTRICT;
-- CREATE TABLE IF NOT EXISTS `user` (
--     `u_id` INT(11) NOT NULL AUTO_INCREMENT,
--     `u_login` VARCHAR(30) NOT NULL,
--     `u_prenom` VARCHAR(255) DEFAULT NULL,
--     `u_nom` VARCHAR(255) DEFAULT NULL,
--     `u_date_naissance` DATE DEFAULT NULL,
--     `u_date_inscription` DATETIME NOT NULL,
--     `u_rang_fk` INT(11) NOT NULL,
--     PRIMARY KEY (`u_id`),
--     KEY (`u_rang_fk`),
--     CONSTRAINT `constr_user_rang` FOREIGN KEY (`u_rang_fk`) REFERENCES `rang` (`r_id`) ON UPDATE CASCADE ON DELETE RESTRICT
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- ALTER TABLE `message` ADD CONSTRAINT `constr_message_user` FOREIGN KEY (`m_auteur_fk`) REFERENCES `user` (`u_id`) ON UPDATE CASCADE ON DELETE RESTRICT;
-- ALTER TABLE `message` ADD CONSTRAINT `constr_message_conversation` FOREIGN KEY (`m_conversation_fk`) REFERENCES `conversation` (`c_id`) ON UPDATE CASCADE ON DELETE RESTRICT;
CREATE TABLE IF NOT EXISTS `rang` (
    `r_id` INT(11) NOT NULL AUTO_INCREMENT,
    `r_libelle` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`r_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `user` (
    `u_id` INT(11) NOT NULL AUTO_INCREMENT,
    `u_login` VARCHAR(30) NOT NULL,
    `u_prenom` VARCHAR(255) DEFAULT NULL,
    `u_nom` VARCHAR(255) DEFAULT NULL,
    `u_date_naissance` DATE DEFAULT NULL,
    `u_date_inscription` DATETIME NOT NULL,
    `u_rang_fk` INT(11) NOT NULL,
    PRIMARY KEY (`u_id`),
    KEY (`u_rang_fk`),
    CONSTRAINT `constr_user_rang` FOREIGN KEY (`u_rang_fk`) REFERENCES `rang` (`r_id`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `message` (
    `m_id` INT(11) NOT NULL AUTO_INCREMENT,
    `m_contenu` VARCHAR(2040) NOT NULL,
    `m_date` DATETIME NOT NULL,
    `m_auteur_fk` INT(11) NOT NULL,
    `m_conversation_fk` INT(11) NOT NULL,
    PRIMARY KEY (`m_id`),
    KEY (`m_auteur_fk`),
    KEY (`m_conversation_fk`),
    CONSTRAINT `constr_message_user` FOREIGN KEY (`m_auteur_fk`) REFERENCES `user` (`u_id`) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT `constr_message_conversation` FOREIGN KEY (`m_conversation_fk`) REFERENCES `conversation` (`c_id`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;