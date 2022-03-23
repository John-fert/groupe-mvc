<?php 
$titre = "Inscription";
//ON VERIFIE SI LE FORMULAIRE A ETE ENVOYER
if (!empty($_POST)){

  if(isset($_POST["email"], $_POST["pass"])
  && !empty($_POST["email"] && !empty($_POST["pass"]))
    ){
        //ON VERIFIE QUE L EMAIL SOIT UN EMAIL
        if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
            die("Votre saisie n'est pas un email");
        }
        //on se connect a la base de donnée
        require_once("includes/connect.php");

        $sql = "SELECT * FROM `users` WHERE `email` = :email ";//APRES UN SELECT ON RECUPERE LES DONNEE AVEC UN FETCH

        $query = $db->prepare($sql);

        $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
        
        $query->execute();

        $user = $query->fetch();

        // Ici on a un user existant, on peut vérifier le mot de passe.
        
        if(!password_verify($_POST["pass"], $user["pass"])) {
           die("l'utilisateur et/ou le mot de passe et incorrect !"); 
        }

        // Ici l'utilisateur et le mot de passe son corrects.
        // ON VA POUVOIR "CONNECTER" L'UTILISATEUR.
        //ON DEMARRE LA SESSION PHP GRACE A session_start();
        session_start();

        // on stocke dans dollar sesion les infos de l'utilisateur
        $_SESSION["user"] = ["id" => $user["id"], 
                            "pseudo" => $user["username"],
                            "email" => $user["email"],
                            "roles" => $user["roles"]
        ];
        
        //ON PEUT REDIRIGER VERS LA PAGE DE PROFIL(PAR EXEMPLE)
        header("location: profil.php");//location = je l'envoye vers...

    }  
}

//ON INCLUS LE HEADER
include("includes/header.php");

//ON INCLUS LE NAVBAR
include("includes/navbar.php");

?>

<h1>Connexion</h1>

<form  method="post">

  

    <div>
        <label for="email">email:</label>
        <input type="email" name="email" id="email">
    </div>

    <div>
        <label for="pass">Mot de passe:</label>
        <input type="password" name="pass" id="pass">
    </div>
    <button type="submit">Me connecter</button>

</form>

<?php

//ON INCLUS LE FOOTER
include("includes/footer.php");







?>
  