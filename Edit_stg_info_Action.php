<?php 
    require("connexion.php");
    $location=$_POST['p1'];
    if(!empty($_FILES['photo']['name'])){
        $typeSelection=$_FILES['photo']['type'];
        $extensions=["image/png","image/jpeg","image/gif"];
        if(in_array($typeSelection,$extensions)){
            $originalNom = $_FILES['photo']['name'];
            $location= "Users/".$originalNom;
            $tempEmpl= $_FILES['photo']['tmp_name'];
            move_uploaded_file($tempEmpl,$location);
        }
    }



    $req=$connexion->prepare("UPDATE compte c
    JOIN stagiaire s ON c.email = s.email
    SET s.nom = ?,
        s.prenom = ?,
        c.nom = ?,
        c.prenom = ?  ,
        s.DateNaissance = ?,
        s.PhotoProfil = ?,
        s.numero_telephone = ?,
        s.cin = ?,
        s.address = ?,
        s.city = ? ,
        c.password = ?
    WHERE s.numeroInscription = ? AND c.email = ?
    ");
    $req->execute([$_POST['nom'],$_POST['prenom'],$_POST['nom'],$_POST['prenom'],$_POST['birth'],$location,$_POST['phone'],$_POST['cin'],$_POST['adrs'],$_POST['city'],$_POST['pword'],$_POST['nbreg'],$_POST['mail']]);
    // var_dump($req->fetch());
    header("location: espace stagiaire.php?msg=Your informations updated succussfuly !");
?>