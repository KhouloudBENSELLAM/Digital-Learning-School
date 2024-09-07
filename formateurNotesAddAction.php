<?php
    session_start();

    

    require ("connexion.php");

    $user = $connexion->prepare("SELECT c.role, c.nom, c.prenom, f.matricule_formateur, f.photoProfil FROM compte c INNER JOIN formateur f ON c.email = f.email WHERE c.email = ?;");
    $user->execute(array($_SESSION['email']));
    $user = $user->fetch();

    

    if(isset($_POST['numInscr']) && $_POST['numInscr'] != "" 
            && isset($_POST['natureExam']) && $_POST['natureExam'] != "" 
            && isset($_POST['note']) && $_POST['note'] != ""){

        $re=$connexion->prepare("SELECT numeroInscription FROM stagiaire where numeroInscription=?");
        $re->execute(array($_POST['numInscr']));
        if($re->rowCount() == 0){
            header("location:./formateurNotesAdd.php?idFiliere=".$_POST['idFiliere']."&sigle=".$_POST['sigle']."&search=".$_POST['search']."&msg=Numero d'inscription incorrect!");
            return;
        }
        if(!is_numeric($_POST['note']) || $_POST['note'] < 0){
            header("location:./formateurNotesAdd.php?idFiliere=".$_POST['idFiliere']."&sigle=".$_POST['sigle']."&search=".$_POST['search']."&msg=La note n'est pas un numero!");
            return;
        }

        $re1=$connexion->prepare("SELECT numeroInscription FROM passerexam where numeroInscription=? AND sigle = ? AND natureExam = ?");
        $re1->execute(array($_POST['numInscr'], $_POST['sigle'], $_POST['natureExam']));
        if($re1->rowCount() > 0){
            $requete=$connexion->prepare("UPDATE passerexam SET note = ? WHERE numeroInscription=? AND sigle = ? AND natureExam = ?");
            $requete->execute(array($_POST['note'], $_POST['numInscr'],$_POST['sigle'],$_POST['natureExam']));
            header("location:./formateurNotes.php?idFiliere=".$_POST['idFiliere']."&sigle=".$_POST['sigle']."&search=".$_POST['search']);
        } else {
            $requete=$connexion->prepare("INSERT INTO passerexam(numeroInscription, sigle, natureExam, note) values(?,?,?,?)");
            $requete->execute(array($_POST['numInscr'],$_POST['sigle'],$_POST['natureExam'],$_POST['note']));
            header("location:./formateurNotes.php?idFiliere=".$_POST['idFiliere']."&sigle=".$_POST['sigle']."&search=".$_POST['search']);
        }
    }
    else {
        header("location:./formateurNotesAdd.php?idFiliere=".$_POST['idFiliere']."&sigle=".$_POST['sigle']."&search=".$_POST['search']."&msg=Tous les champs sont obligatoires!");
    }