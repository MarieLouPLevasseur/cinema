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

## DONE

## A explorer

### Fixtures

- [NelmioAliceFixtures](https://github.com/nelmio/alice) qui permet d'utiliser du markdown pour générer des fixtures. cf [la fiche récap sur Kourou](https://kourou.oclock.io/ressources/fiche-recap/fixtures-avancees-avec-nelmio-alice/)

### Custom Queries

- [Le QueryBuilder](https://symfony.com/doc/current/doctrine.html#querying-with-the-query-builder) qui permet de faire des requêtes custom en utilisant une notation objet plutôt que du DQL.