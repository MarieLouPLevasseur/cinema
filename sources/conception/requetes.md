# Requetes

## SELECT

La structure d'une requête SELECT ressemble à cela :

```sql
SELECT -- obligatoire : liste les colonnes que l'on veut récupérer ( * pour toutes les colonnes)
FROM -- pour spécifier la table à partir de laquelle récupérer les colonnes
[INNER|LEFT] JOIN -- pour spécifier les jointures éventuelles avec d'autres tables
WHERE -- pour spécifier des conditions sur les lignes à sélectionner
GROUP BY -- si on a utiliser une fonction d'aggrégation ( SUM ou AVG ) alors il faut dire par quelle colonne on veut regrouper les information 
HAVING -- pour ajouter des conditions lorsque l'on a des fonctions d'aggrégation
ORDER BY -- pour spécifier comment ordonner les données récupérées
LIMIT -- pour limiter le nombre d'éléments à afficher
OFFSET -- pour préciser à quel élément commencer l'affichage ( pratique pour la pagination )
```

Nous listons ici les requêtes dont nous aurons besoin pour les différentes pages (cf [révisions SQL](https://github.com/O-clock-De-Vinci/symfo-rappels-mcd-sql-gregoclock#requ%C3%AAtes-sql-pour-le-projet))

```sql
-- Récupérer tous les films
SELECT * FROM `movie` -- @steve A

-- Récupérer les acteurs et leur(s) rôle(s) pour un film donné
SELECT `person`.`firstname`,  `person`.`lastname`,  `casting`.`role`
FROM `person`
INNER JOIN `casting` ON `person`.`id` =  `casting`.`person_id`
WHERE `casting`.`movie_id` = 1;

-- Pleins de requetes du challenge

-- Calculer, pour chaque film, la moyenne des critiques par film (en une seule requête).

```