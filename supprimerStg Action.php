<?php  
    require("connexion.php");
    $requet=$connexion->prepare("DELETE FROM stagiaire Where numeroInscription=?");
    $requet->execute(array($_GET['Idstg']));

?>