/*
	G.Jovanovic, 08.02.2018
	Übungen zu Joins
	Datenbank bs
	join_bs.sql
*/

use bs;

-- Inner Joins
-- Cross Join
select * from person, person_funktion, funktion;

-- Equi Joins
-- Join mittels WHERE-Klausel
select * from person, person_funktion, funktion
where
person.per_id = person_funktion.per_id and funktion.fun_id = person_funktion.fun_id;

-- INNER Join
select * from person inner join person_funktion
using(per_id)
inner join funktion on person_funktion.fun_id = funktion.fun_id;

-- verkürzte Schreibweise
select * from person_funktion inner join (person, funktion)
using(per_id, fun_id);

-- NATURAL JOIN
-- vergleicht ALLE Attribute mit gleicher Bezeichnung
select * from person_funktion natural join (person, funktion);

-- Outer Joins
-- bringt auch Ergebnisse, wenn der Wert enies PKs noch nicht als FK in der
-- Beziehungstabelle eingetragen wrude
-- LEFT [OUTER] JOIN
select *
from person left outer join person_funktion
using(per_id);

-- 1) Personen, die noch keine Funktion haben
select * from person left outer join person_funktion
using(per_id)
where fun_id is null;

select *
from person_funktion left outer join person
using(per_id);

-- RIGHT OUTER JOIN
select *
from person right outer join person_funktion
using(per_id);

select *
from person_funktion right outer join person
using(per_id);

-- Aufgabe: Anzahl der Personen je Funktionsbezeichnung
select fun_name as "Funktion", count(*) as "Personenanzahl"
from funktion natural join person_funktion
group by Funktion;







