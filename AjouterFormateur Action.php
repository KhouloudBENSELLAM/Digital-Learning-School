<?php 
    require("connexion.php");
    $re=$connexion->prepare("SELECT * FROM formateur WHERE matricule_formateur=?");
    $re->execute(array($_GET['matriculeF']));
    if (empty($_POST['nom']) || !preg_match("/^[A-Za-z\s]+$/", $_POST['nom'])) {
        $msg = "Invalid last name. Only letters and spaces are allowed.";
        header("location: AjouterStg.php?msg=$msg");
        exit();
    }

    if (empty($_POST['prenom']) || !preg_match("/^[A-Za-z\s]+$/", $_POST['prenom'])) {
        $msg = "Invalid first name. Only letters and spaces are allowed.";
        header("location: AjouterStg.php?msg=$msg");
        exit();
    }

    if (empty($_POST['cin']) || !preg_match("/^[A-Za-z0-9]+$/", $_POST['cin'])) {
        $msg = "Invalid CIN. Only letters and numbers are allowed.";
        header("location: AjouterStg.php?msg=$msg");
        exit();
    }

    if (empty($_POST['dateN'])) {
        $msg = "Date of birth is required.";
        header("location: AjouterStg.php?msg=$msg");
        exit();
    } else {
        $dob = new DateTime($_POST['dateN']);
        $now = new DateTime();
        if ($dob >= $now) {
            $msg = "Date of birth must be before today.";
            header("location: AjouterStg.php?msg=$msg");
            exit();
        }
    }

    if (empty($_POST['phone']) || !preg_match("/^\d{10}$/", $_POST['phone'])) {
        $msg = "Invalid phone number. Enter a valid 10-digit phone number.";
        header("location: AjouterStg.php?msg=$msg");
        exit();
    }

    if (empty($_POST['mail']) || !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
        $items_per_page = "Invalid email address.";
        header("location: AjouterStg.php?msg=$msg");
        exit();
    }

    if (empty($_POST['adrs'])) {
        $msg = "Address is required.";
        header("location: AjouterStg.php?msg=$msg");
        exit();
    }

    if (empty($_POST['city'])) {
        $msg = "City is required.";
        header("location: AjouterStg.php?msg=$msg");
        exit();
    }

    if (empty($_POST['matriculeF']) || !preg_match("/^FOM\d{5}/", $_POST['nbrReg'])) {
        $msg = "Invalid registration number. Only numbers and letters  are allowed.";
        header("location: AjouterStg.php?msg=$msg");
        exit();
    }

    if (empty($_POST['filiere'])) {
        $msg = "Field of study is required.";
        header("location: AjouterStg.php?msg=$msg");
        exit();
    }

    if (empty($_POST['dateEmb'])) {
        $msg = "Registration date is required.";
        header("location: AjouterStg.php?msg=$msg");
        exit();
    }

    else if($re->rowCount()>0){
        $msg="DEJA EXIST!!";
        header("location:inscriptionStg.php?msg=$msg");
    }
    else {

    $typeSelection=$_FILES['photo']['type'];
    $extensions=["image/png","image/jpeg","image/gif"];
    if(in_array($typeSelection,$extensions)){
        $location="Users/";
        $originalNom=$_FILES['photo']['name'];
        $temEmpl=$_FILES['photo']['tmp_name'];

        move_uploaded_file($temEmpl,$location.$originalNom);
        $requt=$connexion->prepare("INSERT INTO formateur values(?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $requt->execute(array($_POST['matriculeF'],$_POST['nom'],$_POST['prenom'],$_POST['dateN'],$_POST['dateEmb'],$originalNom,$_POST['phone'],$_POST['mail'],$_POST['cin'],$_POST['adrs'],$_POST['city'],$_POST['ecole'],$_POST['filiere']));
        header("location: AjouterFormateur.php?msg=The trainee is well integrated !");
    }
    else{
        header("location: AjouterFormateur.php?msg=Invalid Form !");
    }
}
?>