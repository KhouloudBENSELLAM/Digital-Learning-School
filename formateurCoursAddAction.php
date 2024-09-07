<?php
session_start();

// Redirect to authentication page if the user is not logged in 
if (empty($_SESSION['email'])) {
    header("location:login .php");
    exit();
}

require ("connexion.php");

// Fetch user information
$user = $connexion->prepare("SELECT formateur.nom,formateur.prenom,formateur.Photoprofil,formateur.matricule_formateur FROM Compte
    INNER JOIN formateur ON Compte.email = formateur.email");
$user->execute();
$user = $user->fetch();

// Check if form data is set and not empty
if (!empty($_POST['titre']) && !empty($_POST['description']) && !empty($_POST['sigle'])) {
    // Insert course information
    $requete = $connexion->prepare("INSERT INTO cours(titre, description, sigle) VALUES (?, ?, ?)");
    $requete->execute(array($_POST['titre'], $_POST['description'], $_POST['sigle']));
    $idCours = $connexion->lastInsertId();

    // Handle document uploads
    $total = count($_FILES['docs']['name']);
    for ($i = 0; $i < $total; $i++) {
        $tmpFilePath = $_FILES['docs']['tmp_name'][$i];
        if ($tmpFilePath != "") {
            $name = "IdCours_" . $idCours . "_" . $_FILES['docs']['name'][$i];
            $newFilePath = "./documents/" . $name;
            $type = $_FILES["docs"]["type"][$i];

            // Determine the document type
            if (strpos($type, 'video') !== false) {
                $type = "video";
            } elseif (strpos($type, 'pdf') !== false) {
                $type = "pdf";
            } else {
                $type = "exercise";
            }

            // Check if file already exists and move uploaded file
            if (!file_exists($newFilePath)) {
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $requete2 = $connexion->prepare("INSERT INTO resources(idcours, type, title, url) VALUES (?, ?, ?, ?)");
                    $requete2->execute(array($idCours, $type, $_FILES['docs']['name'][$i], $name));
                }
            }
        }
    }

    // Redirect to the formateurCours page
    header("location:espace formateur.php?idFiliere=" . $_POST['idFiliere'] . "&sigle=" . $_POST['sigle']);
    exit();
} else {
    // Redirect back to form with error message if fields are missing
    header("location:formateurCoursAdd.php?idFiliere=" . $_POST['idFiliere'] . "&sigle=" . $_POST['sigle'] . "&msg=Tous les champs sont obligatoires!");
    exit();
}
?>
