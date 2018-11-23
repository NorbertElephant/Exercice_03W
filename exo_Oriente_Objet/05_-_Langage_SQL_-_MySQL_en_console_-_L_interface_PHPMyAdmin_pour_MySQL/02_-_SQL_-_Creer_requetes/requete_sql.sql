-- 1. Les 10 derniers msg de l'utilisateur d'id = 10

SELECT * FROM `message`
WHERE `m_auteur_fk` = 10
ORDER BY `m_date` DESC
LIMIT 10 ;

-- 2. La liste des utilisateurs triés par age

SELECT  `u_prenom`,`u_nom`, `u_date_naissance`  FROM `user`
ORDER BY `u_date_naissance` ASC; 


-- 3. Les 5 derniers inscrits

SELECT  * FROM `user`
ORDER BY `u_date_inscription` DESC
LIMIT 5 ;

--  4. Les 20 derniers messages avec l'utilisateur(login) associé et son rang

SELECT `m_contenu`, `user`.`u_login`, `rang`.`r_libelle` FROM `message`
JOIN `user` ON `m_auteur_fk` = `u_id`
JOIN `rang` ON `u_rang_fk` = `r_id`
ORDER BY `m_date` DESC
LIMIT 20 ;

-- 5.  Les 5 derniers messages des utilisateurs de rang admin de plus de 18 ans 

SELECT `message`.* , `user`.* , `rang`.* FROM `message`
JOIN `user` ON `m_auteur_fk` = `u_id`
JOIN `rang` ON `u_rang_fk` = `r_id`
WHERE `r_libelle` = "admin"
AND  (DATEDIFF( CURDATE(), `u_date_naissance`)/365.25) > 18
ORDER BY `m_date` DESC, `m_id` DESC
LIMIT 5;

-- 6. Les 10 derniers messages avec login+N° de conversation des user agés de 18 à 30 ans // A Refaire

SELECT `message`.`m_contenu`, `message`.`m_conversation_fk` ,`user`.`u_login` FROM `message`
JOIN `user` ON `m_auteur_fk` = `u_id`
JOIN `conversation` ON `m_conversation_fk` = `c_id`
WHERE (DATEDIFF( CURDATE(), `u_date_naissance`)/365.25) BETWEEN 18 AND 30
ORDER BY `m_date` DESC
LIMIT 10;


-- 7. Afficher la conversation c_id=X avec msg + date msg + prenom + nom exemple 
-- exemple : c_id=9

SELECT CONCAT(`message`.`m_contenu`, ' - ',  `message`.`m_date`, ' - ',`user`.`u_prenom`, ' - ',`user`.`u_nom`) FROM `conversation`
JOIN `message` ON `c_id` = `m_conversation_fk`
JOIN `user` ON `m_auteur_fk` = `u_id`
WHERE `c_id`=9;

-- 8. Afficher les n° de conversations auxquelles a participé l'utilisateur u_id=X entre le DATE et le DATE 
-- exemple : u_id = 10 // 2010-12-31 // 2016-01-01
SELECT `message`.`m_conversation_fk` FROM `message`
JOIN `user` ON `m_auteur_fk` = `u_id`
WHERE `u_id`= 10
AND `m_date` BETWEEN  "2010-12-31"  AND "2016-12-31"
GROUP BY `m_conversation_fk`;

-- 9. Afficher tous les contacts qui ont pris part aux meme conversation que l'utilisateur u_id=X // marche pas 
-- exemple : u_id = 8
SELECT `message`.`m_auteur_fk`, `user`.`u_login` FROM `user`
JOIN `message` ON `u_id` = `m_auteur_fk`
WHERE `m_conversation_fk` IN (
    SELECT `m_conversation_fk`
    FROM `message`
    WHERE `m_auteur_fk` =8
    GROUP BY `m_conversation_fk`
)
GROUP BY `m_auteur_fk`
ORDER BY `u_login` ASC;

-- 10. Liste des users avec le total des msg écrits par conversation // Marche pas 

SELECT `message`.`m_auteur_fk`, `message`.`m_conversation_fk`, COUNT( DISTINCT `m_id`) FROM `message`
JOIN `conversation` ON `m_conversation_fk` = `c_id`
JOIN `user` ON `m_auteur_fk` = `u_id`
GROUP BY `m_auteur_fk` ,`m_conversation_fk`
ORDER BY `m_auteur_fk` ASC
;

-- 11. Afficher tous les messages écrits avant la date de conversation

SELECT `message`.* , `conversation`.* FROM `message`
JOIN `conversation` ON `m_conversation_fk` = `c_id`
WHERE `m_date` < `c_date`;

-- 12. Afficher la liste des users qui n'ont jamais pris part à une conversation non terminée 

SELECT `u_login` FROM `user`
WHERE `u_id` NOT IN (
    SELECT `m_auteur_fk` FROM `user`
    JOIN `message` ON `u_id` = `m_auteur_fk`
    JOIN `conversation` ON `m_conversation_fk` = `c_id` 
    WHERE `c_termine` = 0 
)       
GROUP BY `u_id`;

-- 13. Afficher les messages écrits par des admins inscrits en 2010 dans une conversation non terminée

SELECT * FROM `message`
JOIN `conversation` ON `m_conversation_fk` = `c_id`
JOIN `user` ON `m_auteur_fk` = `u_id`
JOIN `rang` ON `r_id` = `u_rang_fk`
WHERE `r_libelle` = "admin"
AND YEAR(`u_date_inscription`) = "2010"
AND `c_termine`= 0;

-- 14. 5 messages au hasard d'utilisateurs de rang 'none' de moins de 18 ans qui ont écrit un message comportant 3 fois la lettre 'o'

SELECT  `message`.*, `user`.*, `rang`.* FROM `message`
JOIN `user` ON `m_auteur_fk` = `u_id`
JOIN `rang` ON `r_id` = `u_rang_fk`
WHERE  `r_libelle` = "none"
AND  (DATEDIFF( CURDATE(), `u_date_naissance`)/365.25) < 18
AND `m_contenu` LIKE "%o%o%o%"
ORDER BY RAND()
LIMIT 5;

SELECT  `message`.*, `user`.*, `rang`.* FROM `message`
JOIN `user` ON `m_auteur_fk` = `u_id`
JOIN `rang` ON `r_id` = `u_rang_fk`
WHERE  `r_libelle` = "none"
AND  (DATEDIFF( CURDATE(), `u_date_naissance`)/365.25) < 18
AND (LENGTH(`m_contenu`) - LENGTH(REPLACE(`m_contenu`, "o",""))) = 3 
ORDER BY RAND()
LIMIT 5;


 -- 15. Afficher les messages écrits après l'écriture du dernier message de l'utilisateur dans les conversations auxquelles il a participé

 