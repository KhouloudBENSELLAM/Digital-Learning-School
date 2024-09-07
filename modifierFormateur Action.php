<?php 
    require("connexion.php");
    $location=$_POST['p1'];
    if(!empty($_FILES['photo']['name'])){
        $typeSelection=$_FILES['photo']['type'];
        $extensions=["image/png","image/jpeg","image/gif"];
        if(in_array($typeSelection,$extensions)){
            $originalNom=$_FILES['photo']['name'];
            $location="Users/".$origianlNom;
            $TemEmpl=$_FILES['photo']['tmp_name'];
            move_uploaded_file($TemEmpl,$location);
        }
    }
    $requetModifierF=$connexion->prepare("UPDATE formateur set nom=?,prenom=?,DateNaissance=?,DATE_Embauche=?,Photoprofil=?,
    numero_telephone=?,email=?,cin=?,adress=?,city=?,Affectaion=?,idFiliere=? where matricule_formateur=?");
    $requetModifierF->execute(array($_POST['nom'],$_POST['prenom'],$_POST['dateN'],$_POST['dateEmb'],$originalNom,$_POST['phone'],$_POST['mail'],$_POST['cin'],$_POST['adrs'],$_POST['city'],$_POST['ecole'],$_POST['filiere'],$_POST['matriculeF']));

?>