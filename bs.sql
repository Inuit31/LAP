/* G.Jovanovic, 07.02.2018
	bs.sql */
	
-- Alle DBen anzeigen
show databases;

-- DB löschen falls vorhanden
drop database if exists bs;

/* SQL-Datei über Konsole ausführen: 
	source C:/mysql/bs.sql */

-- DB erstellen
create database if not exists bs;

show databases;

-- DB auswählen
use bs;

--Tabelle erstellen
create table person (per_id int primary key auto_increment, per_vname varchar(50), per_nname varchar(120) not null);

-- Alle Tabellen anzeigen
show tables;

-- Struktur einer Tabelle anzeigen
describe person;

--Aufgabe
-- Erstelle Sie noch folgende Tabellen:
-- Funktion: fun_id PK int, fun_name varchar(45) not null

create table funktion (fun_id int primary key auto_increment, fun_name varchar(45) not null);

-- Zwischentabelle mit FOREIGN KEY
create table person_funktion
(pefu_id int primary key auto_increment,
 per_id int,
 fun_id int,
 foreign key (per_id) references person(per_id)
 on update cascade on delete cascade,
 foreign key (fun_id) references funktion(fun_id)
 on update cascade on delete cascade
);

describe person_funktion;

-- detailierten create-Befehl ausgeben
show create table person_funktion;

-- Tabellen mit Werte füllen
-- Alle Werte "setzen"
insert into person values(null, 'Maria', 'Huber');

-- Nur bestimmte Werte einfügen
insert into person (per_nname) values('Krainer');

insert into person(per_nname, per_vname) values
('Zaun', 'Herta'), ('Kobold', 'Karl');

-- insert into person (per_vname) values ('Heinz');
-- wird trotz NOT NULL per _nname eingefügt ?!?

insert into funktion (fun_name) values
('Schueler'), ('Lehrer'), ('Direktor');

insert into person_funktion (per_id, fun_id) values
(1, 2), (2, 3), (3, 1);

-- Datensätze löschen
-- DELETE FROM
delete from person
where per_id > 4;
-- neuen Datensatz einfügen und Tabelle ausgeben
insert into person values(null, 'Albert', 'Zaun');
select * from person;

-- Datensätze ändern
-- UPDATE
update person set per_nname='Zauner'
where per_id = 5;
select * from person;

update person set per_nname='Zauner', per_vname='Martha'
where per_id = 3;
select * from person;



















































