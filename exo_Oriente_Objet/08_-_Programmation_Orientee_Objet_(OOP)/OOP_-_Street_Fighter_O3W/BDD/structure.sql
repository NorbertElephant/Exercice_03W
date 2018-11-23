--/***************************************************************************************/
-- TABLE PERSONNAGE
--/***************************************************************************************/
CREATE TABLE IF NOT EXISTS `PERSONNAGE`(
    `PER_id` INT(11) NOT NULL AUTO_INCREMENT,
    `PER_name` VARCHAR(50) NOT NULL,
    `PER_hp` INT(3) NOT NULL,

    PRIMARY KEY (`PER_id`)
)ENGINE=InnoDB CHARSET=utf8mb4;
