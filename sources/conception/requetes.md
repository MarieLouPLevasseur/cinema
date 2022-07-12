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

## REQUETES a effectuer en challenge:

### Récupérer les genres associés à un film donné.
```sql

SELECT `genre`.*
FROM `movie` JOIN `movie_genre` 
ON `movie`.`id` = `movie_genre`.`movie_id`
JOIN  `genre`
ON `movie_genre`.`genre_id` = `genre`.`id`
WHERE `movie`.`id` = '(id)'

```


### Récupérer les saisons associées à un film/série donné.

```sql

SELECT `season`.*
FROM `season` 
JOIN `movie` ON  `movie`.`id`= `season`.`movie_id` 
WHERE `movie`.`id` = '(id)'

```

### Récupérer les critiques pour un film donné.


```sql

SELECT `review`.*
FROM `review` 
JOIN `movie` ON  `movie`.`id`= `review`.`movie_id` 
WHERE `movie`.`id` = '(id)'

```


### Récupérer les critiques pour un film donné, ainsi que le nom de l'utilisateur associé

```sql

SELECT `review`.* , `user`.`nickname` AS Author_name
FROM `review` 
JOIN `movie` ON  `movie`.`id`= `review`.`movie_id` 
JOIN `user` ON  `user`.`id`= `review`.`user_id` 
WHERE `movie`.`id` = '(id)'

```

### Calculer, pour chaque film, la moyenne des critiques par film (en une seule requête).

```sql

SELECT `movie`.`title` ,  avg(`review`.`rating`)
FROM `movie` 
INNER JOIN `review` ON  `review`.`movie_id`= `movie`.`id` 
GROUP BY `movie`.`id`

```


### Récupérer tous les films pour une année de sortie donnée.

```sql

SELECT *
FROM `movie` 
WHERE `release_date` LIKE  '(année)%'

```

### Récupérer tous les films pour un tire donné (par ex. 'Epic Movie').

```sql

SELECT *
FROM `movie` 
WHERE `title` =  '(title)'

```

### Récupérer tous les films dont le titre contient une chaîne donnée.

```sql
SELECT *
FROM `movie` 
WHERE `title` LIKE  '%(chaine)%'
```



BONUS

### Récupérer la liste des films de la page 2 (grâce à LIMIT). (exemple Nb fiml par page = 10)
```sql

```

### Testez la requête en faisant varier le nombre de films par page et le numéro de page.

```sql

```