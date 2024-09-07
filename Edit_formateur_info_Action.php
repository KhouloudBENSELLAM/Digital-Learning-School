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
    JOIN foramteur f ON c.email = f.email
    SET f.nom = ?,
        f.prenom = ?,
        c.nom = ?,
        c.prenom = ?  ,
        f.DateNaissance = ?,
        f.Photoprofil = ?,
        f.numero_telephone = ?,
        f.cin = ?,
        f.adress = ?,
        f.city = ? ,
        c.password = ?
    WHERE f.matricule_formateur = ? AND c.email = ?
    ");
    $req->execute([$_POST['nom'],$_POST['prenom'],$_POST['nom'],$_POST['prenom'],$_POST['birth'],$location,$_POST['phone'],$_POST['cin'],$_POST['adrs'],$_POST['city'],$_POST['pword'],$_POST['nbreg'],$_POST['mail']]);
    // var_dump($req->fetch());
    header("location: espace formateur.php?msg=Your informations updated succussfuly !");
?>