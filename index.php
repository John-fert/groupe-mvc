<?php 
//on définit mon titre
$titre = "Accueil";


//ON INCLUS LE HEADER
@include("includes/header.php");
//ON INCLUS LE NAVBAR
include("includes/navbar.php");
//ON INCLUS LE FOOTER
include("includes/footer.php");

require_once("includes/connect.php");

$username = "Large-brothers";//"Large-brothers'; --"; IL ET POSSIBLE DE FAIRE 
//UNE REQUETE DE COLONE($username) SANS CONNAITRE SON MOT DE PASSE 
//ON APPELLE LA TOTALITE DE CETTE COLONE, DONC SON PASSWORD AUSSI :3
//C UNE INJECTION SQL :3
//C COMME SI ON ECRIVER 
//$sql = "SELECT * FROM `users` WHERE `USERNAME`='$username'; --' AND `pass`='$pass'";
//DANS MYSQL C COMME SI VOUS METTIER TOUS EN COMMENTAIRE A PARTIR DE $username.

$pass = "654321";//OU $pass = "4321' OR 1=1; --"; qui permet de recupere tous les utilisateur de la base.ces comme enlever le WHERE 
//soit j'ai username et pass qui son bon OU 1=1 QUI A UNE VALEUR TOUJOURS TRUE... $sql = "SELECT * FROM `users` WHERE `USERNAME`='$username' AND `pass`='$pass'";  
//C UNE AUTRE INJECTION SQL :3

$sql = "SELECT * FROM `users` WHERE `USERNAME`=:username AND `pass`=:pass";

//DONC POUR EVITER LES INJECTION ON PREPARE LA REQUETE
$requete = $db->prepare($sql);

//ON INJECTE LES VALEURS AVEC  "binValue"
//Le binValue "s'arrete" une fois sa variable de parametre mise dans la requete elle ne prendra pas en compte 
//les modifications de cette variable CONTRAIREMENT au "bindParam".
$requete->bindParam(":username", $username, PDO::PARAM_STR);
$requete->bindParam(":pass", $pass, PDO::PARAM_STR);

//ON EXECUTE LA REQUETE

$username = "Big-brothers";
$pass = "4321";

$requete->execute();
// GRACE A CETTE TECHNIQUE LES GUILLEMER SIMPLE DE L INJECTION SQL SONT PROTEGER ET DEVIENNENT DES GUILLEMET DOUBLE
// ON DIT ALORS QU IL SONT "ECHAPPER"
// IL EXISTE AUSSI bindParam

$user = $requete->fetchALL();

//EXEMPLE BINDPARAM
/*$sex = 'male';
$s = $dbh->prepare('SELECT name FROM students WHERE sex = :sex');
$s->bindParam(':sex', $sex); //use bindParam to bind the variable
$sex = 'female';
$s->execute(); //executed with WHERE sex = 'female'
$user = $requete->fetchALL();*/

//EXEMPLE BINDVALUE
/*$sex = 'male';
$s = $dbh->prepare('SELECT name FROM students WHERE sex = :sex');
$s->bindValue(':sex', $sex); //use bindValue to bind the variable's value
$sex = 'female';
$s->execute(); //executed with WHERE sex = 'male'*/

echo "<pre>";
var_dump($user);
echo "<pre>";

//echo"<pre>";
//var_dump($user);
//echo"<pre>";*/

//AFFICHER LES DONNEE RECUPERE EN STRING
//MARCHE AVEC FETCH()
//et non fetchALL... question a poser
/*$userstring = implode(", ", $user);
echo $userstring;*/


/*var_dump($user);
json_encode($user);
var_dump(json_encode($user));*/

//DIVISER LE CODE

?>
  