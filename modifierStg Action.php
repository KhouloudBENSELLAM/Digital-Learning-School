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
    $requetModifier=$connexion->prepare("UPDATE stagiaire set nom=?,prenom=?,DateNaissance=?,DateInscription=?,PhotoProfil=?,
    numero_telephone=?,email=?,cin=?,address=?,city=?,idFiliere=? where numeroInscription=?");
    $requetModifier->execute(array($_POST['nom'],$_POST['prenom'],$_POST['dateN'],$_POST['dateEm'],$originalNom,$_POST['phone'],$_POST['mail'],$_POST['cin'],$_POST['adrs'],$_POST['city'],$_POST['filiere'],$_POST['nbrReg']));

?>