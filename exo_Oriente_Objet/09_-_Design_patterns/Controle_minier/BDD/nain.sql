-------- Créer la BDD ------------------------------------
CREATE DATABASE IF NOT EXISTS `Nain_tunnel` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ; 

------- Créer les tables -----------------------------

CREATE TABLE IF NOT EXISTS `VILLE` (
    `v_id` INT NOT NULL AUTO_INCREMENT, 
    `v_nom` VARCHAR (255) NOT NULL,
    `v_superficie` INT NOT NULL,
    PRIMARY KEY (`v_id`)
) ENGINE=InnoDB CHARSET=utf8mb4; 


CREATE TABLE IF NOT EXISTS `TAVERNE`(
    `t_id` INT NOT NULL  Auto_increment   ,
    `t_nom` VARCHAR (255) NOT NULL ,
    `t_chambres` INT NOT NULL ,
    `t_blonde` BOOL NOT NULL ,
    `t_brune` BOOL NOT NULL ,
    `t_rousse` BOOL NOT NULL ,
    `t_ville_fk` Int NOT NULL,
	PRIMARY KEY (`t_id`),
    KEY (`t_ville_fk`), CONSTRAINT `ville_taverne` FOREIGN KEY (`t_ville_fk`) REFERENCES `VILLE`(`v_id`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB CHARSET=utf8mb4; 


CREATE TABLE IF NOT EXISTS `TUNNEL`(
    `t_id` INT NOT NULL AUTO_INCREMENT, 
    `t_progres` FLOAT NOT NULL,
    `t_villedepart_fk` INT NOT NULL,
    `t_villearrivee_fk` INT NOT NULL,
    PRIMARY KEY (`t_id`),
    KEY (`t_villedepart_fk`), CONSTRAINT `ville_tunnel` FOREIGN KEY (`t_villedepart_fk`) REFERENCES `VILLE`(`v_id`) ON UPDATE CASCADE ON DELETE RESTRICT,
    KEY (`t_villearrivee_fk`), CONSTRAINT `ville2_tunnel2` FOREIGN KEY (`t_villearrivee_fk`) REFERENCES `VILLE`(`v_id`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB CHARSET=utf8mb4; 


CREATE TABLE IF NOT EXISTS `GROUPE`(
    `g_id` INT NOT NULL  Auto_increment,
    `g_debuttravail` TIME NOT NULL,
    `g_fintravail` TIME NOT NULL,
    `g_taverne_fk` INT NULL,
    `g_tunnel_fk` INT NULL,
    PRIMARY KEY(`g_id`), 
    KEY (`g_taverne_fk`),
    KEY (`g_tunnel_fk`),
    CONSTRAINT `groupe_taverne` FOREIGN KEY (`g_taverne_fk`) REFERENCES `TAVERNE`(`t_id`) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT `groupe_tunnel` FOREIGN KEY (`g_tunnel_fk`) REFERENCES `TUNNEL`(`t_id`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB CHARSET=utf8mb4; 


CREATE TABLE IF NOT EXISTS `NAIN`(
    `n_id` INT NOT NULL  Auto_increment,
    `n_nom` VARCHAR (255) NOT NULL ,
    `n_barbe` FLOAT NOT NULL,
    `n_ville_fk` INT(11) NOT NULL,
    `n_groupe_fk` INT(11) NULL,
    PRIMARY KEY (`n_id`),
    KEY (`n_ville_fk`), CONSTRAINT `nain_ville` FOREIGN KEY (`n_ville_fk`) REFERENCES `VILLE`(`v_id`) ON UPDATE CASCADE ON DELETE RESTRICT,
    KEY (`n_groupe_fk`), CONSTRAINT `nain_groupe` FOREIGN KEY (`n_groupe_fk`) REFERENCES `GROUPE`(`g_id`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB CHARSET=utf8mb4; 


---- Importer la BDD ----------------

mysql -h 127.0.0.1 -u root -p Nain_tunnel < C:\_xampp\htdocs\www\05_-_Langage_SQL_-_MySQL_en_console_-_L_interface_PHPMyAdmin_pour_MySQL\TP\03_-_SQL_-_Gestion_De_Personnel_Minier_En_Zone_De_Creusement_Intensif\dump_datas.sql


----- REQUETE DES NAINS ----------------


-- #1 Trouver toutes les tavernes servant de la bière brune

SELECT * FROM `TAVERNE`
WHERE `t_brune` = 1;

-- #2 Trouver tous les nains du groupe 2

SELECT * FROM `NAIN`
WHERE `n_groupe_fk`=2;

-- #3 Trouver les horaires de travail du nain Kapabl (nain 13)

SELECT DATE_FORMAT(`GROUPE`.`g_debuttravail`, "%r") AS `g_debuttravail`, DATE_FORMAT(`GROUPE`.`g_fintravail`, "%r") AS `g_fintravail` FROM `GROUPE`
JOIN `NAIN` ON `GROUPE`.`g_id`=`NAIN`.`n_groupe_fk`
WHERE `n_nom`= "Kapabl";
-- AND `n_id` = 13;


-- #4 Trouver tout les nains qui boivent dans les tavernes de Svakungor (ville 1)

SELECT `NAIN`.* FROM `NAIN`
JOIN `GROUPE` ON `NAIN`.`n_groupe_fk` = `GROUPE`.`g_id`
JOIN `TAVERNE` ON `GROUPE`.`g_taverne_fk` = `TAVERNE`.`t_id`
WHERE `t_ville_fk` = 1
ORDER BY `n_id`;


-- #5 Trouver, pour toutes les tavernes, le nom de leur ville

SELECT `TAVERNE`.* , `VILLE`.`v_nom` FROM `TAVERNE`
JOIN `VILLE` ON `TAVERNE`.`t_ville_fk` = `VILLE`.`v_id`;


-- #6 Trouver tout les nains en vacances

SELECT * FROM `NAIN`
WHERE `n_groupe_fk` IS NULL ;
 
-- #7 Trouver tout les nains qui viennent de la ville où La bonne pioche (taverne 7) est située

SELECT `NAIN`.* FROM `NAIN`
JOIN `VILLE` ON `NAIN`.`n_ville_fk` = `VILLE`.`v_id`
JOIN `TAVERNE` ON `TAVERNE`.`t_ville_fk` = `VILLE`.`v_id`
WHERE `TAVERNE`.`t_id` = 7; 

-- #8 Trouver tout les tunnels dont les travailleurs peuvent boire de la bière blonde

SELECT `TUNNEL`.* FROM `TUNNEL`
JOIN `GROUPE` ON `TUNNEL`.`t_id` = `GROUPE`.`g_tunnel_fk`
JOIN `TAVERNE` ON `TAVERNE`.`t_id` = `GROUPE`.`g_taverne_fk`
WHERE `TAVERNE`.`t_blonde`=1
GROUP BY `TUNNEL`.`t_id`;

-- #9 Trouver, pour toutes les tavernes, le nombre de nains y logeant

SELECT `TAVERNE`.* , COUNT(`n_id`) AS `nbNains` FROM `TAVERNE`
LEFT JOIN `GROUPE` ON `TAVERNE`.`t_id`= `GROUPE`.`g_taverne_fk`
LEFT JOIN `NAIN` ON `GROUPE`.`g_id` = `NAIN`.`n_groupe_fk`
GROUP BY `TAVERNE`.`t_id`;


-- #10 Trouver, pour toutes les tavernes, le nombre de chambres libres

SELECT `TAVERNE`.* , `t_chambres`- COUNT(`n_id`) AS`chambresLibres` FROM `TAVERNE`
LEFT JOIN `GROUPE` ON `TAVERNE`.`t_id`= `GROUPE`.`g_taverne_fk`
LEFT JOIN `NAIN` ON `GROUPE`.`g_id` = `NAIN`.`n_groupe_fk`
GROUP BY `TAVERNE`.`t_id`;
