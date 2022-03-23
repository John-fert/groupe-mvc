<?php
session_start();
//ON INCLUS LE HEADER
include("includes/header.php");

//ON INCLUS LE NAVBAR
include("includes/navbar.php");

?>

<h1>profil de <?= $_SESSION["user"]["pseudo"]?> </h1>

<p>Pseudo : <?= $_SESSION["user"]["pseudo"]?></p>
<p>email : <?= $_SESSION["user"]["email"]?></p>

<?php
//ON INCLUT LE FOOTER
include ("includes/footer.php");