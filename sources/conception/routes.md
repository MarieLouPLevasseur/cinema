# Routes de l'application Front

## Coté Front

Ces Controllers sont dans un dossier Front ( attention aux namespaces )

| URL | Méthode HTTP | Contrôleur       | Méthode | Titre HTML           | Commentaire    |
| --- | ------------ | ---------------- | ------- | -------------------- | -------------- |
| `/` | `GET`        | `MainController` | `homepage`  | Bienvenue sur O'flix | Page d'accueil |
| `/favoris/{id}` | `GET` | `FavoriteController` | `add`  |  | ajoute en session et redirige |
| `/favoris/` | `GET` | `FavoriteController` | `list`  | Mes Favoris | liste les films en session |
| `/films/` | `GET` | `MovieController` | `list`  | Nos films et série | Liste tous les films |
| `/films/{id}` | `GET` | `MovieController` | `show`  | Détail du film {titre} | Détail un Movie |
| `/films/{id}/critiques/ajout` | `GET` | `MovieController` | `reviewAdd`  | Critiquer le film {titre} | Formulaire d'ajout de Review |

## Coté Back

Ces Controllers sont dans un dossier Back, toutes les routes commencent par back/

| URL | Méthode HTTP | Contrôleur       | Méthode | Titre HTML           | Commentaire    |
| --- | ------------ | ---------------- | ------- | -------------------- | -------------- |
| `/` | `GET`        | `MainController` | `homepage`  | Bienvenue sur O'flix | DashBoard du backoffice |

### CRUD[L] ou BREAD

Pour chaque entité on aura les routes suivantes ( exemple pour un User )

| URL | Méthode HTTP | Contrôleur       | Méthode | Commentaire    |
| --- | ------------ | ---------------- | ------- | -------------- |
| `/users` | `GET`   | `UserController` | `browse`  | Liste les user |
| `/users/{id}` | `GET` | `UserController` | `read`  | Détail d'un user ( non éditable) |
| `/users/{id}/edit` | `GET`, `POST`     | `UserController` | `edit`  | Edite un user |
| `/users/add` | `GET`, `POST`        | `UserController` | `add`  | Ajoute un user |
| `/users/{id}/delete` | `GET`        | `UserController` | `delete`  | Supprime un user |

Astuce : Sur la page de read, on peut mettre les boutons d'ajouts d'entités associées. Par exemple :

- ajouter un casting sur le read d'un movie ou d'un user !
- ajouter une saison depuis le read d'un movie

On pourrait partir sur un CRUDL avec les pages suivantes :

- Create
- Read
- Update
- Delete
- List

Sur la page de read on peut ajouter des boutons d'actions

## API

Ces Controllers sont dans un dossier Api

> :hand: Convention de nommage : https://restfulapi.net/resource-naming/

| Endpoint                       | Méthode HTTP | Controller | Description                                                                                   | Retour                          |
| ------------------------------ | ------------ | ---------- | --------------------------------------------------------------------------------------------- | ------------------------------- |
| `/api/v1.0/movies`             | `GET`        | `MovieController` | Récupération de tous les films                                                                | 200                             |
| `/api/v1.0/movies/{id}`        | `GET`        | `MovieController` | Récupération du film dont l'id est fourni                                                     | 200 ou 404                      |
| `/api/v1.0/movies/{id}`        | `DELETE`     | `MovieController` | Suppression d'un film dont l'id est fourni                                                    | 200 ou 404                      |
| `/api/v1.0/movies/random`      | `GET`        | `MovieController` | Récupération du film au hasard                                                                | 200 ou 404                      |
| `/api/v1.0/movies`             | `POST`       | `MovieController` | Ajout d'un film _+ la donnée JSON qui représente le nouveau film_                             | 201 + Location: /movies/{newID} |
| `/api/v1.0/movies/{id}`        | `PUT`        | `MovieController` | Modification d'un film dont l'id est fourni _+ la donnée JSON qui représente le film modifié_ | 200, 204 ou 404                 |
| `/api/v1.0/genres`             | `GET`        | `GenreController` | Récupération de tous les genres                                                               | 200                             |
| `/api/v1.0/genres/{id}/movies` | `GET`        | `GenreController` | Récupération de tous les films du genre donné                                                 | 200 ou 404                      |

## Sandbox

On a un controller pour faire des tests, dedans c'est en mode YOLO !!!

![](https://img.wattpad.com/4454f9faf5799ae831bf57c1416ba15dffd8f1f5/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f776174747061642d6d656469612d736572766963652f53746f7279496d6167652f6843574d714c7332565a304a4b413d3d2d3339333538383833352e313462316561336531376334383536613930333930343834353039332e706e67?s=fit&w=720&h=720)
