<?php  
    require("connexion.php");
    session_start();
    $mail=$_GET['email'];
    $mp=$_GET['mp'];
    if(empty($mail) || empty($mp)){
        header("location: login .php?msg=Fields are required !");
        exit();
    }
    else{
        $req=$connexion->prepare("SELECT * FROM Compte WHERE email=? and password=?");
        $req->execute(array($mail,$mp));
        if($req->rowCount()>0){
            $donne=$req->fetch();
            $_SESSION['email']=$donne['email'];
            $_SESSION['nom']=$donne['nom'];
            $_SESSION['prenom']=$donne['prenom'];
            $_SESSION['role'] = $donne['role'];

            if($donne['role']=='ADMINISTRATEUR'){
                header("location: espace administrateur.php");
            }
            else if($donne['role']=='FORMATEUR'){
                header("location: espace formateur.php");
            }
            else{
                header("location: espace stagiaire.php");
            }
        }
        else{
            header("location: login .php?msg=The information provided is incorrect !");
            exit();
        }

    }


?>