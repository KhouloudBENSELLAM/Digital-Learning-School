<?php
    session_start();

    //redirect to login page if the user is not logged in 
    if ($_SESSION['email'] == "") {
        header("location:login .php");
    }
    
    require ("connexion.php");
    
    $user = $connexion->prepare("SELECT c.role, c.nom, c.prenom, f.matricule_formateur, f.photoProfil FROM compte c INNER JOIN formateur f ON c.email = f.email WHERE c.email = ?;");
    $user->execute(array($_SESSION['email']));
    $user = $user->fetch();
    
    if(isset($_POST['titre']) && $_POST['titre'] != "" 
            && isset($_POST['description']) && $_POST['description'] != "" 
            && isset($_POST['sigle']) && $_POST['sigle'] != ""){
    
        $requete=$connexion->prepare("UPDATE cours SET titre = ?, description = ? WHERE idCours = ?");
        $requete->execute(array($_POST['titre'],$_POST['description'],$_POST['idCours']));
    
        $idCours = $_POST['idCours'];
        $total = count($_FILES['docs']['name']);
        for( $i=0 ; $i < $total ; $i++ ) {
            $tmpFilePath = $_FILES['docs']['tmp_name'][$i];
            if ($tmpFilePath != ""){
                $name = "IdCours_".$idCours."_".$_FILES['docs']['name'][$i];
                $newFilePath = "./documents/".$name;
                $type = $_FILES["docs"]["type"][$i];
                if (strpos($type, 'video') !== false) {
                    $type = "video";
                } else if (strpos($type, 'pdf') !== false) {
                    $type = "pdf";
                } else {
                    $type = "exercise";
                }
                if(!file_exists($newFilePath)){
                    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                        $requete2=$connexion->prepare("INSERT INTO resources(idcours, type, title, url) values(?,?,?,?)");
                        $requete2->execute(array($idCours,$type,$_FILES['docs']['name'][$i],$name));
                    }
                }
            }
        }
        header("location:./espace formateur.php?idFiliere=".$_POST['idFiliere0']."&sigle=".$_POST['sigle0']);
    } else {
        header("location:./formateurCoursUpdate.php?idFiliere=".$_POST['idFiliere']."&sigle=".$_POST['sigle']."&idCours=".$_POST['idCours']."&msg=All fields are mandatory !");
    }
    
    ?>