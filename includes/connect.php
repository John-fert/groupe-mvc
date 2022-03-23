 
<?php

    //CONSTANTE D ENVIRONNEMENT
    define("DBHOST", "localhost");
    define("DBUSER", "root");
    define("DBPASS", "");
    define("DBNAME", "tutos-php");


    //DSN DE CONNECTION
    $dsn = "mysql:dbname=".DBNAME.";host=".DBHOST;
    
    //SE CONNECTER A LA BASE
    //PDO VA LEVER UNE EXEPTION
    //TRY = ESSEYE DE FAIRE LES INSTRUCTION TRY
    //ET SI TU N Y ARRIVE PAS TU ATTRAPE L EXEPTION 
    //CATCH ET TU FAIT LES INSTRUCTION DEMANDER
    try{
        // ON INSTANCIE PDO
        $db = new PDO($dsn, DBUSER, DBPASS);
        
        //ON S ASSURE D ENVOYER LES DONNEES UTF8
        //permet de prendre en charge les accents des donées envoyer
        $db->exec("SET NAMES utf8");

        echo "on et connecter ! ";

        //On definit le mode de "fetch"par défaut
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,
        PDO::FETCH_ASSOC);

    } catch(PDOException $e) {
            die("erreur:".$e->getMessage());
    }

    //Crud//ICI on et connecter a la base (partie Connection du Crud)

    //cRud// On peut recuperer la liste des utilisateurs (parti Read du cRud)
    $sql = "SELECT * FROM `users`";

    //ON execute directement la requete
    $requete = $db->query($sql);
    
    // On recupere les donnée(Fetch(recupere un seul utilisateur) ou Feetch all(recupere tous les utilisateur de la bdd bonome))
    $user = $requete->fetchALL();//apres un fetchALL il y a une boucle

   //AJOUTER UN UTILISATEUR
   $sql = "INSERT INTO `users` (`id`,`email`,`pass`,`roles`) VALUES 
   ('23','demo@nouvelle-techno.fr', 'azerty','[\"ROLE_USER\"]')";

    $requete = $db->query($sql);

    //crUd// On peut modifier un user de la liste des utilisateurs (parti update du crUd)
    //MODIFIER UN UTILISATEUR
   $sql = "UPDATE `users` SET `pass`= 'Aa654321' WHERE 
   `id`= 1";

    $requete = $db->query($sql);

    //cruD// On peut supprimer un user de la liste des utilisateurs (parti delete du cruD)
    //SUPPRIMER UN UTILISATEUR
    $sql = "DELETE FROM `users` WHERE `id`< 30"; 
   
    $requete = $db->query($sql);

    //Savoir cb de ligne ont ete supprimer.
    //echo $requete->rowCount();

    //CR2ATION NOUVELLE COLONNES
    $sql = "ALTER TABLE `users` ADD `username`"; 
   
    $requete = $db->query($sql);
?>