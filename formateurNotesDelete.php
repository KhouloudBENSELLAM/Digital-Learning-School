<?php
session_start();

require ("connexion.php");

$user = $connexion->prepare("SELECT c.role, c.nom, c.prenom, f.matricule_formateur, f.photoProfil FROM compte c INNER JOIN formateur f ON c.email = f.email WHERE c.email = ?;");
$user->execute(array($_SESSION['email']));
$user = $user->fetch();


require ("connexion.php");
$requete = $connexion->prepare("DELETE FROM passerexam WHERE idNote=?");
$requete->execute(array($_GET['idNote']));
header("location:./formateurNotes.php?idFiliere=" . $_GET['idFiliere'] . "&sigle=" . $_GET['sigle']);
