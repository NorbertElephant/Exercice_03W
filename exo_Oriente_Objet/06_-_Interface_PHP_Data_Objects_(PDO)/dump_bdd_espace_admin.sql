------ Insertion De Donnees  ---------------- 

/** contenu de la table ROLE */ 
INSERT INTO `ROLE` (`ROL_name`) VALUES 
("SuperAdmin"),
("Admin"),
("Invité");

/** contenu de la table AUTORISATION */ 
INSERT INTO `AUTORISATION` (`AUT_name`) VALUES 
("Ajout"),
("Suppression"),
("Modification"),
("Edition"),
("Approbation");

/** contenu de la table DETIENT */ 
INSERT INTO `DETIENT` ( `DET_role_fk` , `DET_aut_fk` ) VALUES 
(1,1),
(1,2),
(1,3),
(1,4),
(1,5);

/** contenu de la table USER */ 
INSERT INTO `USER` (`USE_login`, `USE_psw`,`USE_role_fk`) VALUES 
("Superman", "azerty",1);
