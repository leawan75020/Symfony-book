Skip to content
Search or jump to…
Pulls
Issues
Codespaces
Marketplace
Explore

@leawan
Djeg
/
formation-symfony
Public
Fork your own copy of Djeg/formation-symfony
Code
Issues
Pull requests
Actions
Projects
1
Security
Insights
Ajout de l'exercice des cruds
session/20-03-23/24-03-23
@Djeg
Djeg committed 24 minutes ago
1 parent 800488c
commit a08bd11
Show file tree Hide file tree
Showing 2 changed files with 63 additions and 8 deletions.
17  
README.md
Comment on this file
@@ -33,11 +33,12 @@ avant de commencer le code :

1. [Le controller et les routes](./assets/exos/controller.md) 1. [Le controller et les routes](./assets/exos/controller.md)
2. [Le CRUD de Livre](./assets/exos/crud-book.md) 2. [Le CRUD de Livre](./assets/exos/crud-book.md)
3. [Le design](./assets/exos/le-design.md) 3. [Le CRUD des maisons d'éditions et des auteurs](./assets/exos/crud-edition-author.md)
4. [Le CRUD des users](./assets/exos/crud-user.md) 4. [Le design](./assets/exos/le-design.md)
5. [Les annonces](./assets/exos/les-annonces.md) 5. [Le CRUD des users](./assets/exos/crud-user.md)
6. [Rechercher des annonces](./assets/exos/search-form.md) 6. [Les annonces](./assets/exos/les-annonces.md)
7. [Créer un compte](./assets/exos/account.md) 7. [Rechercher des annonces](./assets/exos/search-form.md)
8. [Autorisation](./assets/exos/authorization.md) 8. [Créer un compte](./assets/exos/account.md)
9. [La panier](./assets/exos/cart.md) 9. [Autorisation](./assets/exos/authorization.md)
10. [Rest et les URI](./assets/exos/rest.md) 10. [La panier](./assets/exos/cart.md)
11. [Rest et les URI](./assets/exos/rest.md)
    54  
    assets/exos/crud-edition-author.md
    Comment on this file
    @@ -0,0 +1,54 @@

# CRUD des maisons d'éditions et des auteurs

## 1. Générer les entitié

Avec la commande `symfony console make:entity`, générez les entités suivante :

### PublishingHouse

| champ       | type     | nullable |
| ----------- | -------- | -------- |
| title       | string   | no       |
| description | string   | yes      |
| createdAt   | datetime | no       |
| updatedAt   | datetime | no       |

### Author

| champ       | type     | nullable |
| ----------- | -------- | -------- |
| title       | string   | no       |
| description | string   | yes      |
| nationality | string   | yes      |
| createdAt   | datetime | no       |
| updatedAt   | datetime | no       |

## 2. La génération des formulaires

Avec la commande `symfony console make:form` créer les formulaires suivants :

### PublishingHouseType

| champ       | type         |
| ----------- | ------------ |
| title       | TextType     |
| description | TextareaType |
| submit      | SubmitType   |

### AuthorType

| champ       | type         |
| ----------- | ------------ |
| title       | TextType     |
| description | TextareaType |
| nationality | ChoiceType   |
| submit      | SubmitType   |

## 3. Les controllers !

En répétant le même principe que pour les livres, créer 2 controller (`AdminPublishingHouseController`, `AdminAuthorController`) avec chacun 4 routes :

- Une pour la création
- Une pour la liste
- Une pour la mise à jour
- Une pour la suppression :)
  0 comments on commit a08bd11
  @leawan

Add heading textAdd bold text, <Ctrl+b>Add italic text, <Ctrl+i>
Add a quote, <Ctrl+Shift+.>Add code, <Ctrl+e>Add a link, <Ctrl+k>
Add a bulleted list, <Ctrl+Shift+8>Add a numbered list, <Ctrl+Shift+7>Add a task list, <Ctrl+Shift+l>
Directly mention a user or team
Reference an issue, pull request, or discussion
Add saved reply
Leave a comment
Aucun fichier choisi
Attach files by dragging & dropping, selecting or pasting them.
Styling with Markdown is supported
You’re not receiving notifications from this thread.
Footer
© 2023 GitHub, Inc.
Footer navigation
Terms
Privacy
Security
Status
Docs
Contact GitHub
Pricing
API
Training
Blog
About
formation-symfony/README.md at a08bd11cc1b90bca5a153ee753891ffc1a1b48ea · Djeg/formation-symfony
