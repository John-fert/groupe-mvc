<?php
date_default_timezone_set('Europe/Amsterdam'); 
$date_du_jour = date ("d-m-Y");
$heure_courante = date ("h:i:s a", time());
echo 'Nous sommes le : ';
echo $date_du_jour;
echo ' Et il est : ';
echo $heure_courante;


//LES VARIABLE PREDEFINIS DE PHP
/*$_SERVER['DOCUMENT_ROOT']	Racine du serveur
$_SERVER['HTTP_ACCEPT_LANGUAGE']	Langage accepté par le navigateur
$_SERVER['HTTP_HOST']	Nom de domaine du serveur
$_SERVER['HTTP_USER_AGENT']	Type de navigateur
$_SERVER['PATH_INFO']	Chemin WEB du script
$_SERVER['PATH_TRANSLATED']	Chemin complet du script
$_SERVER['REQUEST_URI']	Chemin du script
$_SERVER['REMOTE_ADDR']	Adresse IP du client
$_SERVER['REMOTE_PORT']	Port de la requête HTTP
$_SERVER['QUERY_STRING']	Liste des paramètres passés au script
$_SERVER['SERVER_ADDR']	Adresse IP du serveur
$_SERVER['SERVER_ADMIN']	Adresse de l'administrateur du serveur
$_SERVER['SERVER_NAME']	Nom local du serveur
$_SERVER['SERVER_SIGNATURE']	Type de serveur
$_SERVER['REQUEST_METHOD']	Méthode d'appel du script*/


//CONCATENATION

$nom = "LA GLOBULE";
echo 'Bonjour '.$nom.' !';


//LES STRUCTURES DE CONTROLE 

/*Instruction	Signification
if	Si
else	Sinon
elseif	Sinon si
switch	Selon
for	Pour chaque (boucle)
while	Tant que (boucle)
==	Strictement égal
!=	Différent
<	Strictement inférieur
>	Strictement supérieur
<=	Inférieur ou égal
>=	Supérieur ou égal
and ou &&	ET logique
or ou ||	OU logique*/


//Exemple IF ELSE ELESIF:


$nombre = 18.5;
if ($nombre >= 0 && $nombre < 10) {
	// on teste si la valeur de notre variable est comprise entre 0 et 9
	echo $nombre.' est compris entre 0 et 9';
}
elseif ($nombre >= 10 && $nombre < 20) {
	// on teste si la valeur de notre variable est comprise entre 10 et 19
	echo $nombre.' est compris entre 10 et 19';
}
else {
	// si les deux tests précédents n'ont pas aboutis, alors on tombe dans ce cas
	echo $nombre.' est plus grand que 19';
}


//Exemple SWITCH:

/*c'est que sa structure est beaucoup 
moins lourde et nettement plus agréable à lire.*/


$nom = "Titi";

switch ($nom) {
	case 'Jean' :
	echo 'Votre nom est Jean.';
	break;
	case 'Benoît' :
	echo 'Votre nom est Benoît.';
	break;
	case 'LA GLOBULE' :
	echo 'Votre nom est LA GLOBULE.';
	break;
	default :
	echo 'Je ne sais pas qui vous êtes !!!';
}

//Exemple ELSIF:

$nom = "LA GLOBULE";

if ($nom == "Jean") {
	echo 'Votre nom est Jean.';
}
elseif ($nom == "Benoît") {
	echo 'Votre nom est Benoît.';
}
elseif ($nom == "LA GLOBULE") {
	echo 'Votre nom est LA GLOBULE.';
}
else {
	echo 'Je ne sais pas qui vous êtes !!!';
}

//Exemple FOR:

$chiffre = 5;

// Début de la boucle
for ($i=0; $i < $chiffre; $i++) {
	echo 'Notre chiffre est différent de '.$i.'<br />';
}
// Fin de la boucle

echo 'Notre chiffre est égal à '.$i;


//Exemple WHILE:

$chiffre = 5;
$i = 0;

// Début de la boucle
while ($i < $chiffre) {
	echo 'Notre chiffre est différent de '.$i.'<br />';
	$i = $i + 1;
}
// Fin de la boucle

echo 'Notre chiffre est égal à '.$i.'<br>';


//Lire et afficher un fichier txt grace a php:

// Instruction 1
$fp = fopen ("tuto-php-facile.txt", "r");
// Instruction 2
$contenu_du_fichier = fgets ($fp, 255);
// Instruction 3
fclose ($fp);
// Instruction 4
echo 'Notre fichier contient : '.$contenu_du_fichier.'<br>';


//Faire un compteur de nombre de visiteur :


// Instruction 1
$fp = fopen ("Compteur.txt", "r+");
// Instruction 2
$nb_visites = fgets ($fp, 11);
// Instruction 3
$nb_visites = $nb_visites + 1;
// Instruction 4
fseek ($fp, 0);
// Instruction 5
fputs ($fp, $nb_visites);
// Instrcution 6
fclose ($fp);
// Instrcution 7
echo 'Ce site compte '.$nb_visites.' visiteurs !';

/*Instruction 1 : on ouvre le fichier compteur.txt en lecture et en ecriture.
Instruction 2 : on lit le contenu du fichier et on place ce contenu (qui est donc le nombre de visiteurs de notre page) dans la variable $nb_visites.
Instruction 3 : on augmente le nombre de visites de 1.
Instruction 4 : on place le pointeur du fichier à l'offset 0 grâce à l'instruction fseek(). En clair, on se positionne au tout début de notre fichier.
Instruction 5 : grâce à l'instruction fputs(), on écrit dans notre fichier la nouvelle valeur correspondant au nombre de visites.
Instruction 6 : on ferme le fichier.
Instruction 7 : on affiche le nombre de visites de notre page !!!*/

//Autre montage possible :

$filename = 'tuto-php-facile.txt';
$somecontent = "Double zabuza";

// Assurons nous que le fichier est accessible en écriture
if (is_writable($filename)) {

    // Dans notre exemple, nous ouvrons le fichier $filename en mode d'ajout
    // Le pointeur de fichier est placé à la fin du fichier
    // c'est là que $somecontent sera placé
    if (!$fp = fopen($filename, 'a')) {
         echo "Impossible d'ouvrir le fichier ($filename)";
         exit;
    }

    // Ecrivons quelque chose dans notre fichier.
    if (fwrite($fp, $somecontent) === FALSE) {
        echo "Impossible d'écrire dans le fichier ($filename)";
        exit;
    }

    echo "L'écriture de ($somecontent) dans le fichier ($filename) a réussi";

    fclose($fp);

} else {
    echo "Le fichier $filename n'est pas accessible en écriture.";
}

