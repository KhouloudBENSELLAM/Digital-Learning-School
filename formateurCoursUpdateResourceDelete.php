<?php
session_start();

//redirect to authetication page if the user is not logged in 
if ($_SESSION['email'] == "") {
    header("location:login .php");
}

require ("connexion.php");

$user = $connexion->prepare("SELECT formateur.nom,formateur.prenom,formateur.Photoprofil,formateur.matricule_formateur FROM Compte
    INNER JOIN formateur ON Compte.email = formateur.email");
$user->execute();
$user = $user->fetch();

require ("connexion.php");

$res = $connexion->prepare("SELECT url FROM resources WHERE idresource = ? ");
$res->execute(array($_GET['idRes']));
$r = $res->fetch();
unlink( "./documents/".$r['url']);

$requete2 = $connexion->prepare("DELETE FROM resources WHERE idresource=?");
$requete2->execute(array($_GET['idRes']));

header("location:./formateurCoursUpdate.php?idFiliere=" . $_GET['idFiliere'] . "&sigle=" . $_GET['sigle']. "&idCours=" . $_GET['idCours']);
