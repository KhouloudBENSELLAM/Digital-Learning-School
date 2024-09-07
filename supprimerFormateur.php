<?php  
    require("connexion.php");
    $requet=$connexion->prepare("DELETE FROM formateur Where matricule_formateur=?");
    $requet->execute(array($_GET['MTF']));

?>