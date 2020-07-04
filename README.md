# pfa4e
notre projet pfa.
**A demo project based on Symfony 4**

je vais commencer par les choose que je pense vous avez bousoin pour commecer et allez bien


* installer **composer** [https://getcomposer.org/](https://getcomposer.org/)
* installer **git** [https://git-scm.com/](https://git-scm.com/)
* installer **nodejs** [https://nodejs.org/en/](https://nodejs.org/en/)


si vous voulez vous pouvez aussi utiliser **cmder**
mieux que windows cmd
[https://cmder.net/](https://cmder.net/)

utilizer **YouTube** :)

dans cette branche j'ai deja installer -bootstrap -jquery -datatables -select2
les gens qui ne sont pas commencés
vous pouvez commencer de cette point pour sauvegarder un peu de temps et pour que nous tous reste sur la même structure

a cette point je pense que vous avez deja installé tous ce qui est on haut

ouvrir cmder 
aller sur n'import qu'il place
vous étes pas obligé de mettre les fichier dans htdocs ou www.
par example desktop 

```
cd desktop
```

Installation
========================

### 1. Clone or download repository

```
git clone https://github.com/soyaDiallo/pfa4e.git

cd pfa4e
```

### 2. Run composer
```
composer install
```
	
### 3. pour installer les packages des librairies qui on utilize in front (bootstrap, sleect2, jquery ...)

```
yarn install
```

### 4. Run installation script to create database and load fixtures

  * tous les commande sont expliquer ici
  * [https://symfony.com/doc/current/doctrine.html](https://symfony.com/doc/current/doctrine.html)

  #### 4-1 ouvrir votre projet sur nimporte quelle text editor (sublime, vscode ...)
  * allez vers (.env) file vouz pouver voir se line
  * DATABASE_URL=mysql://root:@127.0.0.1:3306/PfaDB?serverVersion=5.7
  * notre database name  === > "PfaDB" on prefer ne pas changer le nom pour que tous reste sur le meme nom
  * maintenant on va utiliser ces commandes pour crée database et les tables

```   
php bin/console doctrine:database:create

php bin/console make:migration

php bin/console doctrine:migrations:migrate 

```

### 5.  demarer server

  - lancer symfony
  
```
symfony server:start
```
    
  - dans une autre (cmd). pour compiler les fichier (css/js) leur de travaille.

```
yarn watch
```
    
### 6. pour les fichier static utilizer folder (assets)
   - assets/scss 
    	* vous pouves ecrire simple css si vous ete pas fimillier avec scss
        * vous trouver un fichier avec le nom assets/scss/_style.scss
      	* ecrire votre code la bas
      
   - assets/js
     	*ecrire votre code dans assets/js/script.js
   - assets/images/
    
 
n'oubliez pas de lancer apache et mysql

Enjoy!
