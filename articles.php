<?php 

//On inclus le fichier fonction.php
require_once("includes/function.php");

$titre = "Liste de mes articles";

//ON SE CONNECTE A LA BASE
require_once"includes/connect.php";

// ON ECRIT LA REQUETE
$sql = "SELECT * FROM `articles` ORDER BY `created_at` DESC";

//ON EXECUTE LA REQUETE
$requete = $db->query($sql);

//ON RECUPERE LA DONNEE
$articles = $requete->fetchALL();//APRES UN FETCHALL IL Y A UNE BOUCLE

//ON INCLUS LE HEADER
@include("includes/header.php");
//ON INCLUS LE NAVBAR
include("includes/navbar.php");
?>

<p>Liste des articles</p>
<section>
<?php foreach($articles as $article): ?>

    
        <article>
            <h1><a href="article.php?id=<?= $article["id"]?>"><?= strip_tags
            ($article["titel"]) ?></a></h1>
            <p>Publier le <?= strip_tags($article["created_at"])?></p>
            <div>Contenu:<?= strip_tags($article["content"])?></div>
        </article>
    </section>
   

<?php 
    endforeach;


veriForm();
//ON INCLUS LE FOOTER
include("includes/footer.php");
//DIVISER LE CODE
?>



