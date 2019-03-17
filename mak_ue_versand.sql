-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema Versand
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `Versand` ;

-- -----------------------------------------------------
-- Schema Versand
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Versand` ;
USE `Versand` ;

-- -----------------------------------------------------
-- Table `Versand`.`Person`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Versand`.`Person` (
  `per_id` INT NULL AUTO_INCREMENT,
  `per_nname` VARCHAR(20) NOT NULL,
  `per_vname` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`per_id`));


-- -----------------------------------------------------
-- Table `Versand`.`Artikel`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Versand`.`Artikel` (
  `art_id` INT NOT NULL AUTO_INCREMENT,
  `art_name` VARCHAR(45) NOT NULL,
  `art_preis` FLOAT NOT NULL,
  PRIMARY KEY (`art_id`));


-- -----------------------------------------------------
-- Table `Versand`.`Bestellung`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Versand`.`Bestellung` (
  `bes_id` FLOAT NOT NULL,
  `per_id` INT NOT NULL,
  `art_id` INT NOT NULL,
  `bes_menge` INT NOT NULL,
  INDEX `fk_{8ED501DA-4999-448D-8BD0-A91AEB17A323}` (`per_id` ASC),
  INDEX `fk_{F09FAF15-60DE-424B-B996-99E8B0497CE3}` (`art_id` ASC),
  PRIMARY KEY (`bes_id`),
  CONSTRAINT `fk_{8ED501DA-4999-448D-8BD0-A91AEB17A323}`
    FOREIGN KEY (`per_id`)
    REFERENCES `Versand`.`Person` (`per_id`)
    ON DELETE cascade
    ON UPDATE cascade,
  CONSTRAINT `fk_{F09FAF15-60DE-424B-B996-99E8B0497CE3}`
    FOREIGN KEY (`art_id`)
    REFERENCES `Versand`.`Artikel` (`art_id`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `Versand`.`Person`
-- -----------------------------------------------------
START TRANSACTION;
USE `Versand`;
INSERT INTO `Versand`.`Person` (`per_id`, `per_nname`, `per_vname`) VALUES (NULL, 'Angler', 'Thomas');
INSERT INTO `Versand`.`Person` (`per_id`, `per_nname`, `per_vname`) VALUES (NULL, 'Fischer', 'Renate');
INSERT INTO `Versand`.`Person` (`per_id`, `per_nname`, `per_vname`) VALUES (NULL, 'Gruber', 'Maria');
INSERT INTO `Versand`.`Person` (`per_id`, `per_nname`, `per_vname`) VALUES (NULL, 'Angora', 'Wilhelm');
INSERT INTO `Versand`.`Person` (`per_id`, `per_nname`, `per_vname`) VALUES (NULL, 'Brad', 'Robert');

COMMIT;


-- -----------------------------------------------------
-- Data for table `Versand`.`Artikel`
-- -----------------------------------------------------
START TRANSACTION;
USE `Versand`;
INSERT INTO `Versand`.`Artikel` (`art_id`, `art_name`, `art_preis`) VALUES (1372, 'Sektkuehler MyDesign', 15.7);
INSERT INTO `Versand`.`Artikel` (`art_id`, `art_name`, `art_preis`) VALUES (2968, 'Waschmaschine Bobble', 299.99);
INSERT INTO `Versand`.`Artikel` (`art_id`, `art_name`, `art_preis`) VALUES (3454, 'Kaffeemaschine Free', 25.5);
INSERT INTO `Versand`.`Artikel` (`art_id`, `art_name`, `art_preis`) VALUES (4780, 'Kuechenmaschinen Big', 78.25);

COMMIT;


-- -----------------------------------------------------
-- Data for table `Versand`.`Bestellung`
-- -----------------------------------------------------
START TRANSACTION;
USE `Versand`;
INSERT INTO `Versand`.`Bestellung` (`bes_id`, `per_id`, `art_id`, `bes_menge`) VALUES (987654, 1, 4780, 2);
INSERT INTO `Versand`.`Bestellung` (`bes_id`, `per_id`, `art_id`, `bes_menge`) VALUES (987655, 3, 1372, 4);
INSERT INTO `Versand`.`Bestellung` (`bes_id`, `per_id`, `art_id`, `bes_menge`) VALUES (987656, 3, 2968, 1);
INSERT INTO `Versand`.`Bestellung` (`bes_id`, `per_id`, `art_id`, `bes_menge`) VALUES (987657, 4, 3454, 1);
INSERT INTO `Versand`.`Bestellung` (`bes_id`, `per_id`, `art_id`, `bes_menge`) VALUES (987658, 1, 4780, 1);
INSERT INTO `Versand`.`Bestellung` (`bes_id`, `per_id`, `art_id`, `bes_menge`) VALUES (987659, 1, 1372, 2);

COMMIT;

use versand; 


select per_nname as "Nachname", per_vname as "Vorname", art_name as "Artikel", 
bes_menge as "Bestellmenge"
from person left outer join bestellung using (per_id)
left outer join artikel using (art_id)
where bes_menge > 1

select per_nname as "Nachname", per_vname as "Vorname" from Bestellung 
right  join person using (per_id)
where bes_id is null;




use tankstelle;

select sum(preis) from verbrauch;

select kunde_id as "Kundennummer", vorname as "Vorname",
                    nachname as "Nachname",
                    strasse as "Straße", plz as "PLZ", ort as "Ort",geburtsdatum as "Geburtsdatum", sum(preis)
                    from kunde
				    where kunde_id like 62123 
                    natural join verbrauch using (kunde_id)
                    group by kunde_id
                    
                    
select sum(preis) from verbrauch where kunde_id = 62123;


use bibliothek;


select buc_isbn as "ISBN", buch_titel as "Titel",
kat_name as "Kategorie", concat(aut_vorname, " ", aut_nachname) as "Autor" 
from buch ver_name as "Verlag" inner join 
kategorie on buch.kat_id = kategorie.kat_id
inner join verlag on buch.ver_id = verlag.ver_id
inner join autor on buch.aut_id = autor.aut_id;       

select buc_isbn as "ISBN", buch_titel as "Titel",
        kat_name as "Kategorie", concat(aut_vorname, " ", aut_nachname) as "Autor",
        ver_name as "Verlag"
        from buch 
        inner join kategorie on buch.kat_id = kategorie.kat_id
        inner join verlag on buch.ver_id = verlag.ver_id
        inner join autor on buch.aut_id = autor.aut_id;

use bibliothek;
select * from buch;

update buch set buch_titel = "Lo bandolero" 
where buc_ISBN = 123456;

select * from sys.databases;

select * from kunde;
use tankstelle;
select concat(vorname, " ", nachname) as "Name", Bezeichnung as "Treibstoff"
from Verbrauch 
inner join Treibstoff on treibstoff.treibstoff_id = Verbrauch.treibstoff_id
inner join Kunde on kunde.kunde_id = Verbrauch.kunde_id
where kunde.kunde_id = 62124;


show databases;
use versand;
select versand;