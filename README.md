# WEB_NINJAS
A Web Ninjas Studio dashboard production

Hey les ninjas ! Voici les commandes à faire pour faire tourner le programme sur vos machines !
1/ Vérifiez que <b>NPM</b> est sur vos machines (normalement il est installé avec node.js)

2/ Soyez sur d'avoir une version à jour de <b>WAMP</b> et <b>PHPmyadmin</b>

3/ Après avoir cloné le repo github :<br/>
&emsp; 3.1) Placez vous impérativement dans le dossier server avec la commande : <b>git checkout server</b><br/>
&emsp; 3.2) Pour toute nouvelle tache qui vous est propre et ou vous ne travaillez pas en commun<br/>
&emsp;&emsp;&emsp;dessus créez une nouvelle branche avec la commande suivante : git branch nomDeMaBranche<br/>
&emsp; 3.3) Lancez la commande pour que votre branche existe vraiment sur le repo github :<br/>
&emsp;&emsp;&emsp;<b>git push --set-upstream origin nomDeMaBranche</b><br/>
&emsp; 3.4) Lancez la commande en console depuis le dossier client : <b>npm install</b> (il doit vous créer un dossier /node_modules)<br/>
&emsp; 3.5) Lancez la commande en console depuis le dossier server : <b>composer install</b> (il doit vous créer un dossier /vendor)<br/>

4/ Lancez une nouvelle console toute belle toute propre dans le dossier server et lancez le demon avec la commande suivante : <b>php -S localhost:8000 -t public</b>

5/ Si Chrome ne se lance pas allez sur Chrome et entrez : <b>localhost:8000</b>
  5.1) Si vous voulez voir si ça marche vraiment tapez cette URI : <b>http://localhost:8000/user/id (allez voir le dossier routes pour comprendre)</b>

6/ Pour vous connecter à PHPmyadmin allez à cette adresse : <b>http://localhost/phpmyadmin/</b>
  6.1) L'identifiant est : <b>root</b>
  6.2) Le mot de passe est : <b>Root</b>

7/ Si ça marche pas ben envoyez moi un message avec le log de vos erreurs lorsque vous lancez le serveur
