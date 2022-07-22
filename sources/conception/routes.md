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

| URL | Méthode HTTP | Contrôleur       | Méthode | Titre HTML           | Commentaire    |
| --- | ------------ | ---------------- | ------- | -------------------- | -------------- |
| `/api/movies/{id}` | `GET` | `FavoriteController` | `favoriteAdd`  |  | ajoute en session et redirige |

## Sandbox

On a un controller pour faire des tests, dedans c'est en mode YOLO !!! 
![](https://img.wattpad.com/4454f9faf5799ae831bf57c1416ba15dffd8f1f5/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f776174747061642d6d656469612d736572766963652f53746f7279496d6167652f6843574d714c7332565a304a4b413d3d2d3339333538383833352e313462316561336531376334383536613930333930343834353039332e706e67?s=fit&w=720&h=720)