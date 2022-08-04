# Reste à faire

## TODO

- terminer le tableau de routes
- dynamiser la liste des genres sur la page d'accueil et sur la page de recherche / liste des movies
- implémenter la recherche
- supprimer un movie des favoris
- ajouter un movie aux favoris à partir de la page show
- changer de thème
  - pour cela dans la balise `nav` il doit y avoir les classes :
    - `navbar-dark bg-dark` pour le thème Netflix
    - `navbar-light bg-warning` pour le thème Allociné
  - pensez à changer l'interface au niveau du bouton qui switch le thème
- ajouter la liste des commentaires sur le detail d'un Movie
- modier testConverter pour passer les tests sur les semaines
- dans le formulaire d'ajout de Review, supprimer le champ User du formulaire pour utiliser l'utilisateur qui est connecté
- afficher les flash messages sur les pages qui en ont besoin ( un include peut etre )
- ajouter les AccessControlTest pour les Manager et les Admin
  
- passer les roles en entités
  - modifier le MCD ( avec les relations )
  - modifier les entités
    - supprimer la propriété role
    - utiliser le maker pour faire la relation
  - faire la migration
    - attention à récupérer les roles des utilisateurs
  - vérifier que ca marche
- dans les controller d'API factoriser la fonction prepareResponse


## DONE

## A explorer

### Fixtures

- [NelmioAliceFixtures](https://github.com/nelmio/alice) qui permet d'utiliser du yaml pour générer des fixtures. cf [la fiche récap sur Kourou](https://kourou.oclock.io/ressources/fiche-recap/fixtures-avancees-avec-nelmio-alice/)

### Custom Queries

- [Le QueryBuilder](https://symfony.com/doc/current/doctrine.html#querying-with-the-query-builder) qui permet de faire des requêtes custom en utilisant une notation objet plutôt que du DQL.