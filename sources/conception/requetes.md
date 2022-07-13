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

## REQUETE DE PAGE

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

CORRECTION: 
inutile de faire la jointure  de movie vers movie_genre car movie_genre a déjà l'id movie (à movie_id) et il n'y a pas de récupération de donnée de movie: 

        ```sql
        SELECT g.name
        FROM genre g
        INNER JOIN movie_genre mg ON mg.genre_id = g.id
        WHERE mg.movie_id = 5

        ```



### Récupérer les saisons associées à un film/série donné.

```sql

SELECT `season`.*
FROM `season` 
JOIN `movie` ON  `movie`.`id`= `season`.`movie_id` 
WHERE `movie`.`id` = '(id)'

```

Correction : la demande ne précisait pas les infos films, uniquement les infos saison. La saison contient déjà le movie_id donc pas de jointure nécessaire: 

        ```sql

        SELECT * 
        FROM season 
        WHERE movie_id = 5
        ```

### Récupérer les critiques pour un film donné.


```sql

SELECT `review`.*
FROM `review` 
JOIN `movie` ON  `movie`.`id`= `review`.`movie_id` 
WHERE `movie`.`id` = '(id)'

```
Correction : idem review contient déjà movie_id: jointure pas nécessaire

        ```sql
        SELECT * 
        FROM `review`
        WHERE `movie_id` = 5

        ```


### Récupérer les critiques pour un film donné, ainsi que le nom de l'utilisateur associé

```sql

SELECT `review`.* , `user`.`nickname` AS Author_name
FROM `review` 
JOIN `movie` ON  `movie`.`id`= `review`.`movie_id` 
JOIN `user` ON  `user`.`id`= `review`.`user_id` 
WHERE `movie`.`id` = '(id)'

```

CORRECTION: meme principe movie_id déjà dans review donc inutile d'aller le récupérer dans la table movie

        ```sql

        SELECT r.*, u.nickname 
        from review r
        INNER JOIN user u ON u.id = r.user_id
        where r.movie_id = 5
        ```



### Calculer, pour chaque film, la moyenne des critiques par film (en une seule requête).

```sql

SELECT `movie`.`title` ,  avg(`review`.`rating`)
FROM `movie` 
INNER JOIN `review` ON  `review`.`movie_id`= `movie`.`id` 
GROUP BY `movie`.`id`

```

### idem pour un film donné
        CORRECTION: 

        ```sql
        SELECT `movie`.`title` ,  AVG(`review`.`rating`) -- @MarieLou
        FROM `movie` 
        INNER JOIN `review` ON  `review`.`movie_id`= `movie`.`id` 
        WHERE movie.id = 5
        -- GROUP BY `movie`.`id` -- @Steve A puisque l'on a qu'une movie le group by est facultatif
        ```

## REQUETE DE RECHERCHE
### Récupérer tous les films pour une année de sortie donnée.

```sql

SELECT *
FROM `movie` 
WHERE `release_date` LIKE  '(année)%'

```

CORRECTION: il existe des fonction qui permettent de récupérer que l'année: 

        ```sql
        SELECT *
        FROM movie
        WHERE YEAR(release_date) = 2014
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

CORRECTION: Pour comparer des chaines de caractère une bonne astuce est de tout mettre en majuscule (ou minuscule) grâce à la fontion `UPPER` avant la comparaison

        ```sql

        SELECT *
        FROM `movie`
        WHERE UPPER(title) LIKE "%EPIC%"
        ```


BONUS

### Récupérer la liste des films de la page 2 (grâce à LIMIT). (exemple Nb fiml par page = 10)
    (Testez la requête en faisant varier le nombre de films par page et le numéro de page.)

CORRECTION: Testez la requête en faisant varier le nombre de films par page et le numéro de page.


```sql

SELECT * 
FROM movie
ORDER BY `title`
LIMIT 10 -- limite le nombre de résultats
OFFSET 10 -- on veut à partir du 10eme élément ( car les 10 premiers sont sur la première) le offset commence à 0
```

## CONTRAINTES

### Ne pas avoir 2 genres identiques: 
- On ajoute "alter index" avec "unique" et "le nom du champs" qui doit etre unique
- case sensitive (E ou e sera évincé)

Ajouter une contrainte d'unicité sur une colonne

```sql
ALTER TABLE `genre`
ADD UNIQUE `unique_name` (`name`);
```

### on peut faire des contraintes d'unicité sur plusieurs colonnes: ne pas vouloir que le titre et la date de sortie soit identique (car alors c'est le meme film)
  
```sql

ALTER TABLE `movie`
ADD UNIQUE `title_release_date` (`title`, `release_date`);
```

### si on supprime un id user, on peut toujours afficher la critique: 

on supprime l'id en le mettant null possible 
on pense à faire le LEFT join
pour afficher l'auteur anonyme
    - soit on le fait en php avec un IF
    - soit on le fait en requete SQL

-- du coup il faut utiliser un LEFT JOIN
```sql
SELECT r.* 
FROM review r
LEFT JOIN user u ON u.id = r.user_id
WHERE r.movie_id = 5;
```

-- on peut meme remplacer le NULL par du texte grace au "switch case" de MYSQL
```sql
SELECT 
CASE 
    WHEN u.nickname is Null then 'anonyme' 
    ELSE u.nickname 
END  as username
, r.* 
FROM review r
LEFT JOIN user u ON u.id = r.user_id
WHERE r.movie_id = 5;
```

### La suppression d'un film implique la suppression de l'intégralité de son contenu

```sql
-- requête récupérée d'adminer
ALTER TABLE `movie_genre`
DROP FOREIGN KEY `movie_genre_ibfk_1`,
ADD FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT

-- @steve a
ALTER TABLE `season` ADD CONSTRAINT `season_movie_id` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`) ON DELETE CASCADE;
ALTER TABLE `review` ADD CONSTRAINT `review_movie_id` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`) ON DELETE CASCADE;
ALTER TABLE `casting` ADD CONSTRAINT `casting_movie_id` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`) ON DELETE CASCADE;
```

### La suppression d'un utilisateur conserve ses critiques
Lorsque l'on supprime un user les review liés passent le user_id à null

```sql
ALTER TABLE `review` ADD CONSTRAINT `user_movie_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL;
```