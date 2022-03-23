<?php 
$titre = "Inscription";
//ON VERIFIE SI LE FORMULAIRE A ETE ENVOYER
if(!empty($_POST)){ 
    
    if(isset($_POST["nickname"] , $_POST["email"], $_POST["pass"])
        && !empty($_POST["nickname"]) && !empty($_POST["email"]) && !empty($_POST["pass"])
    ){
        // LE FORMULAIRE ET COMPLET
        // ON RECUPERE LES DONNEE EN LES PROTEGENT
        $pseudo = strip_tags($_POST["nickname"]);
        
        if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
            die("l'adress email et incorrecte");
        }

        //ON VA HASHER LE MOT DE PASSE
        $pass = password_hash($_POST["pass"], PASSWORD_ARGON2ID);

        //AJOUTER ICI TOUS LES CONTROLE DES
        
        //ON ENREGISTRE EN BASE DE DONNEE
        
        require_once("includes/connect.php");
        
        //ON ECRIT LA REQUETE
      $sql = "INSERT INTO `users`(`username`, `email`,`pass`, `roles`) VALUES 
      ( :pseudo, :email, '$pass', '[\"ROLE_USER\"]')";

      //ON PREPARE LA REQUETE 
      $query = $db->prepare($sql); 
        //var_dump($query); debug :3
       //ON INJECTE LES VALEURS
      $query->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);
      $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
      
      $query->execute();

        //ON RECUPERE L ID DU NOUVELLE UTILISATEUR
      $id = $db->lastInsertId();

      //on connectera l'utilisateur
       // Ici l'utilisateur et le mot de passe son corrects.
        // ON VA POUVOIR "CONNECTER" L'UTILISATEUR.
        //ON DEMARRE LA SESSION PHP GRACE A session_start();
        session_start();

        // on stocke dans dollar sesion les infos de l'utilisateur
        $_SESSION["user"] = [
            "id" => $user["id"], 
            "pseudo" => $pseudo,
            "email" => $_POST["email"],
            "roles" => $user["ROLES_USER"]
        ];

      //ON EXECUTE LA REQUETE
      if(!$query->execute()){
        var_dump($query);
        die("une erreur est survenue tintin!");
      }
       
       
    }else{
        die("le formulaire est incomplet");
    }
}

//ON INCLUS LE HEADER
include("includes/header.php");

//ON INCLUS LE NAVBAR
include("includes/navbar.php");

?>

<h1>Inscription</h1>

<form  method="post">

    <div>
        <label for="pseudo">Pseudo:</label>
        <input type="text" name="nickname" id="pseudo"><!--sert a se connecter au label,quand on click sur le label le champ pseudo recupere le focus--> 
    </div>

    <div>
        <label for="email">email:</label>
        <input type="email" name="email" id="email">
    </div>

    <div>
        <label for="pass">Mot de passe:</label>
        <input type="password" name="pass" id="pass">
    </div>
    <button type="submit">M'inscrire</button>

</form>

<?php

//ON INCLUS LE FOOTER
include("includes/footer.php");







?>
  