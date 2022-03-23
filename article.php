<?php 


//On inclus le fichier fonction.php
require_once("includes/function.php");

//ON VA CHERCHER LES ARTICLES DANS LA BASE


//ON VERIFIE SI ON A UN ID
if(!isset($_GET["id"]) && empty($_GET["id"])) {
    //JE N AI PAS ID 
    header("location: articles.php");
    exit;

}
//JE RECUPERE L ID 
$id = $_GET["id"];

//ON SE CONNECTE A LA BASE
require_once"includes/connect.php";

//ON VA CHERCHER LES ARTICLES DANS LA BASE

// ON ECRIT LA REQUETE
$sql = "SELECT * FROM `articles` WHERE `id` = :id";

//ON PREPARE LA REQUETE
$requete = $db->prepare($sql);

//ON INJECTE LES PARAMETRE
$requete->bindValue(":id", $id, PDO::PARAM_INT);

//ON EXECUTE LA REQUETE
$requete->execute();

//ON RECUPERE L ARTICLE
$article = $requete->fetch();

//ON VERIFIE SI L ARTICLE ET VIDE
if(!$article){
  echo "article inexistant ! "; 
  exit; 
}
//UNE FOIS LES CONDITION REUNIS ICI ON A UN ARTICLE
if(!$article) {
    echo "article inexistant ! "; 
    exit; 
  }

  $titre = strip_tags($article["titel"]);

//ON INCLUS LE HEADER
@include("includes/header.php");
//ON INCLUS LE NAVBAR
include("includes/navbar.php");
?>

<article><!--TRIP_TAGS= interdit l'injection de donnée javascripte-->
    <h1><?= strip_tags($article["titel"])?></h1>
    <p>Publier le <?= strip_tags($article["created_at"])?></p>
    <div>Contenu:<?= strip_tags($article["content"])?></div>
</article>

<?php
    
veriForm();
//ON INCLUS LE FOOTER
include("includes/footer.php");
//DIVISER LE CODE
?>



 