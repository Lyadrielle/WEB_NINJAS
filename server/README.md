# WEB_NINJAS
A Web Ninjas Studio dashboard production

Hey les ninjas ! Voici les commandes à faire pour faire tourner le programme sur vos machines !
1/ Installer NPM sur vos machines

2/ Soyez sur d'avoir une version à jour de WAMP et PHPmyadmin

3/ Après avoir cloné le repo github : 
  3.1) lancer ensuite cette commande en console depuis le dossier client : npm install (il doit vous créer un dossier /node_modules)
  3.2) lancer ensuite cette commande en console depuis le dossier server : composer install (il doit vous créer un dossier /vendor)

4/ Lancez une nouvelle console toute belle toute propre dans le dossier server et lancez le demon avec la commande suivante : php -S localhost:8000 -t public

5/ Si Chrome ne se lance pas allez sur Chrome et entrez : localhost:8000
  5.1) Si vous voulez voir si ça marche vraiment tapez cette URI : http://localhost:8000/user/id (allez voir le dossier routes pour comprendre)

6/ Pour vous connecter à PHPmyadmin allez à cette adresse : http://localhost/phpmyadmin/
  6.1) L'identifiant est : root
  6.2) Le mot de passe est : Root

7/ Si ça marche pas ben envoyez moi un message avec le log de vos erreurs lorsque vous lancez le serveur