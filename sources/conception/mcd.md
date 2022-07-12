# MCD oflix

https://github.com/O-clock-De-Vinci/symfo-rappels-mcd-sql-gregoclock

MCD créé à partir du brief et des maquettes

```
PERSON: person_code, first_name, last_name, pseudo
review, 0N MOVIE, 0N USER: rating, comment, film_view_date
USER: email, username, password, role

participate in, 0N MOVIE, 0N PERSON: role
MOVIE: ISAN, title, duration, type, published_date, summary, synopsis, country, poster
belongs to, 1N MOVIE, 0N GENRE

SEASON: season_code, episodes_number, season_number
has, 0N MOVIE, 11 SEASON
GENRE: genre_code, name
```
MCD qui correspond à la BDD de l'exo

```
USER: email, username, role
Belongs to, 0N GENRE, 0N MOVIE
GENRE: genre_code, name

Reviews, 0N MOVIE, 0N USER: content, rating
MOVIE: ISAN, title, release_date, duration, summary, synopsis, poster, rating
Has, 0N MOVIE, 11 SEASON

PERSON: person_code, firstname, lastname
Acting in, 0N PERSON, 0N MOVIE: role, credit_order
SEASON: season_code, season_number, episodes_number
```