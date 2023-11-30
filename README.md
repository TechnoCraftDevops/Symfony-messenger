* Creer un fichier `.env` à la racine du projet
* Copier le contenue de  `.env.sample`

* Lancer la commande suivante monter le container de dev:
    ```
    docker compose -f docker-compose.local.yml up --build
    ```

* Lancer la commande suivante pour installer les dépendances :
    ```
    docker exec -ti micro-service-messenger bash -c 'composer install'
    ```

* Lancer la commande suivante pour créer la base de données :
    ```
    docker exec -ti micro-service-messenger bash -c 'php bin/console doctrine:database:create'
    ```

* Lancer la commande suivante pour appliquer les migrations :
    ```
    docker exec -ti micro-service-messenger bash -c 'php bin/console doctrine:migration:migrate'
    ```
* Lancer la commande suivante pour créer des fixtures :
    ```
    docker exec -ti micro-service-messenger bash -c 'php bin/console doctrine:fixtures:load'
    ```
# Environnement de test

* Lancer la commande suivante pour créer la base de données :
    ```
    docker exec -ti micro-service-messenger bash -c 'php bin/console doctrine:database:create --env=test'
    ```

* Lancer la commande suivante pour appliquer les migrations :
    ```
    docker exec -ti micro-service-messenger bash -c 'php bin/console doctrine:migration:migrate --env=test'
    ```

* Lancer la commande suivante pour tester le projet et générer un dossier coverage:
    ```
    docker exec -ti micro-service-messenger bash -c 'php bin/phpunit  --coverage-html coverage'
    ```

* **vérifier les commandes dans composer.json -> balise script**

* **Vérifier le coverage**

Version du projet :

* *version Symfony `6.3`*
* *version docker `24.0.7`*
* *verison php `8.2`*
* *version composer `2.4.2`*
