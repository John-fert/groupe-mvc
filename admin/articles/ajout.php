<?php
   $titre = "Ajouter un articles";
//ON TRAITE LE FORMULAIRE
if(!empty($_POST)){
  //POST N EST PAS VIDE, IL FAUT VERIFIER QUE TOUS LES CHAMP SOIT REMPLIS
    if(
        isset($_POST["titre"], $_POST["contenu"])
        && !empty($_POST["titre"]) && !empty ($_POST["contenu"]) 
    ){ 
      //LE FORMULAIRE ET COMPLET
      //ON RECUPERE LES DONNEES EN LES PROTEGENT (FAILLE XSS)
      //ON RETIRE TOUTE BALISE DU TITRE 
      $titre = strip_tags($_POST["titre"]);
      
      
      //ON MES EN SECURITER LE CONTENU(EN NETRALISENT LES BALISE)
      $contenu = htmlspecialchars($_POST["contenu"]);


      //ON PEUT LES ENREGISTRER
      //ON SE CONNECTE A LA BASE
      require_once "../../includes/connect.php";
      
      //ON ECRIT LA REQUETE
      $sql = "INSERT INTO `articles`(`title`, `content`) VALUES 
      (:title, :content)";

      //ON PREPARE LA REQUETE 
      $query = $db->prepare($sql); 
        //var_dump($query); debug :3
       //ON INJECTE LES VALEURS
      $query->bindValue(":title", $titre, PDO::PARAM_STR);
      $query->bindValue(":content", $contenu, PDO::PARAM_STR);
      

      //ON EXECUTE LA REQUETE
      if(!$query->execute()){
        var_dump($query);
        die("une erreur est survenue tintin!");
      }

   
        //ON RECUPERE L ID DE L ARTICLE
        $id = $db->lastInsertId();

        die("article ajouter sous le numero $id");

    }else{ 
        die("Le formulaire et imcomplet");
     }
}

$titre ="Ajouter un article";
//ON INCLU LE HEADER
@include_once "../../includes/header.php";

include_once "../../includes/navbar.php";
?>
<h1>Ajouter un article</h1>

<form method="post">

<div>
    <label for="titre">Titre</label>
    <input type="text" name="titre"id="titre">
</div>

<div>
    <label for="contenu">Contenu</label>
    <textarea name="contenu" id="contenu" cols="30" rows="10"></textarea>
</div>
<button type="submit">Enregistrer</button>
</form>

<?php
include_once "../../includes/footer.php";