/*
	G.Jovanovic, 07.02.2018
	Query, Joins
	DB bs
	source C:/mysql/query_bs.sql
*/

use bs;

-- Alle Datensätze und Attribute der Tabelle person ausgeben
select * from person;

-- Vorname und Nachname aller Personen
select per_vname, per_nname from person;

-- Alias für Attribute (mit Hochkomma definieren)
select per_nname as "Nachname" from person;

-- Alias für Tabellen
select per_vname from person p;

select p.per_vname from person p;

-- Ohne Alias
select pers.per_nname from person;

-- *************************
-- WHERE-Klausel
-- *************************
-- 1) nur per_id 3 ausgeben

select * from person where per_id = 1;

-- wie 1) mit BETWEEN 1 und 3
select * from person where per_id between 1 and 3;

-- nur Personen deren nachnamme mit K beginnt
-- mit LIKE
select * from person where per_nname like 'K%';

-- nur Personen deren Nachname an 2. Stelle ein "a" enthält
select * from person where per_nname like '_a%';
-- %: Joker für beliebige Anzahl beliebiger Zeichen
-- _: Joker für genau ein beliebiges Zeichen

-- AND, OR
-- 2) Personen mit per_id 1 und 3
select * from person where per_id = 1 or per_id = 3;


-- Aufgabe: Alle Personen, wo der Nach- oder Vorname mit K beginnt
select * from person where per_nname like 'K%' or per_vname like 'K%';

-- *************************
-- LIMIT
-- *************************
-- nur 2 Datensätze beginnend beim zweiten Datensatz ausgeben
select * from person limit 1, 2;

-- *************************
-- ORDER BY - Sortieren
-- *************************
-- Personen nach Nachname aufsteigend sortieren

select * from person
order by per_nname;

-- 2) WIE 1) aber aufsteigend explizit angeben"
select * from person
order by per_nname asc;

-- 3) wie 1) aber absteigend
select * from person
order by per_nname desc;

-- 4) Personen aufsteigend nach Nachname,
--    innerhalb absteigend nach Vorname sortieren
-- neuer Insert zuerst

-- insert into person values(null, 'Albert', 'Zaun');
select * from person
order by per_nname asc, per_vname desc;

-- *************************
-- FUNKTIONEN
-- *************************
-- 1) Anzahl der Personen
select count(*) as "Anzahl der Personen" from person;

-- 2) zum Testen: Summe der per_id
select sum(per_id) as "Summe" from person;

-- Letzter Tag des laufenden Monats
select last_day(now());

-- 4) Aktuelles Datum und aktuelle Uhrzeit;
select now();

-- 5) wie 4 nur formatiert ausgeben
select date_format(now(), '%M');

-- 6) wie 5
select date_format(now(), '%d.%M %Y';

-- 7) Personen Vor- u. Nachnamen in einer Spalte ausgeben
select concat(per_vname, ' ', per_nname) as "Person"
from person;

select concat_ws(' ', per_id, per_vname, per_nname) as "Person"
from person;

--mehrfach gleiche Datensätze nicht anzeigen
-- DISTINCT
select distinct fun_id
from person_funktion;

-- Höchsten Wert eines Attributs ermitteln
select max(per_id) from person;
-- Kleinsten Werte eines Attributs ermitteln = min

-- Bezogen auf den letzten Insert (mit auto_increment)
-- den eingetragenen Wert ermitteln
-- Bezieht sich auf die ganze Datenbank
select last_insert_id();

-- *************************
-- GROUP BY
-- *************************
-- 1) Anzahl der Personen je Funktion(fun_id)
select count(per_id) as "Anzahl der Personen", fun_id as "Funktion"
from person_funktion
group by Funktion;

--zusätzlicher INSERT
-- insert into person_funktion (per_id, fun_id) values(5, 2);

-- 2) wie 1) aber sortiert nach Anzal aufsteigend
select count(per_id) as "Anzahl der Personen", fun_id as "Funktion"
from person_funktion
group by Funktion
order by count(per_id) asc;


-- *************************
-- HAVING
-- *************************
-- Ergebnis aus Funktionen einschränken (group by und having)
-- 3) wie 2) aber nur wenn Anzahl > 1
select count(per_id) as "Anzahl der Personen", fun_id as "Funktion"
from person_funktion
group by Funktion
having count(per_id) > 1
order by count(per_id) asc;





















































