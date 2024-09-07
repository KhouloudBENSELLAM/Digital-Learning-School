<?php
session_start();

//this must be assigned on the login page after authentication
//just doing it here because I don't have login page here but it should be integrated with it later
// $_SESSION['email'] = "formateur1@gmail.com";

// //redirect to authetication page if the user is not logged in 
// if ($_SESSION['email'] == "") {
//     header("location:authentifier.php");
// }

require ("connexion.php");

$user = $connexion->prepare("SELECT formateur.nom,formateur.prenom,formateur.Photoprofil,formateur.matricule_formateur FROM Compte
    INNER JOIN formateur ON Compte.email = formateur.email");
$user->execute();
$user = $user->fetch();


$filiers = $connexion->prepare("SELECT DISTINCT f.idFiliere, f.libelle FROM filiere f INNER JOIN module m ON f.idFiliere = m.idFiliere WHERE m.matricule_formateur = ?;");
$filiers->execute(array($user['matricule_formateur']));

$idFiliere = 0;
if(isset($_GET['idFiliere']) && $_GET['idFiliere'] > 0){
    $idFiliere = $_GET['idFiliere'];
}

$modules = $connexion->prepare("SELECT sigle, description, masseHoraire, f.idFiliere, f.libelle, f.nombreGroup FROM module m INNER JOIN filiere f ON m.idFiliere = f.idFiliere WHERE matricule_formateur = ? AND ".($idFiliere > 0? " f.idFiliere":" 0")." = ?;");
$modules->execute(array($user['matricule_formateur'], $idFiliere));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/formateur-styles.css">
    <title>Trainer Moduls</title>
</head>

<body>
    <div>
        <div class="navbarr">
            <div>
                <a href="./home.php" class="logo">Digital Learning School</a>
            </div>
            <div class="menu-toggle">
                <hr/>
                <hr/>
                <hr/>
            </div>
            <div class="dflex menu-items">
                <div class="dflex items">
                    <a href="./formateurModules.php" class="btn-menu active">Moduls</a>
                    <a href="./espace formateur.php" class="btn-menu">Courses</a>
                    <a href="./formateurNotes.php" class="btn-menu">Grades</a>
                </div>
                <div class="relative profile0">
                    <div class="dflex profile">
                        <img class="profile-img img0" src="<?php echo 'Users/' . $user['Photoprofil']; ?>" alt="profile">
                        <div>
                            <div><?php echo $user['nom'] . " " . $user['prenom'] ?></div>
                            <div class="role">trainer</div>
                        </div>
                        <img class="profile-img img1" src="<?php echo 'Users/' . $user['Photoprofil']; ?>" alt="profile">
                    </div>
                    <div class="profile-click" style="display: none;">
                        <a href="showinfoFormateur.php?id=<?php echo $user['matricule_formateur'] ?>" class="first">Show my informations</a>
                        <a href="Edit-formateur_info.php?id=<?php echo $user['matricule_formateur'] ?>" class="second">Edit my informations</a>
                        <a href="logout.php" class="last">Log out</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="containerr">
            <select id="modules-filiere" class="frm-selectt">
                <option value="0" <?php echo $idFiliere == 0? "selected":"" ?> >Field</option>
                <?php while($ligne=$filiers->fetch()){ ?>
                <option value="<?php echo $ligne['idFiliere']; ?>" <?php echo $idFiliere == $ligne['idFiliere']? "selected":"" ?> >
                    <?php echo $ligne['libelle']; ?>
                </option>
                <?php } ?>
            </select>
            <div class="cardds">
                <?php if($modules->rowCount() > 0){ while($ligne=$modules->fetch()){ ?>
                    <div class="cardd">
                        <div class="title">
                            <strong><?php echo $ligne['sigle']; ?></strong>
                        </div>
                        <div class="description"><?php echo $ligne['description']; ?></div>
                        <div class="massHoraire">Hourly mass : <strong><?php echo $ligne['masseHoraire']; ?></strong> hr</div>
                        <div class="filiere">Field : <?php echo $ligne['libelle']; ?></div>
                        <div class="nbrGrp">Number of groups : <?php echo $ligne['nombreGroup']; ?></div>
                        <div class="buttons">
                            <a href="espace formateur.php?idFiliere=<?php echo $ligne['idFiliere']; ?>&sigle=<?php echo $ligne['sigle']; ?>">Courses</a>
                            <a href="formateurNotes.php?idFiliere=<?php echo $ligne['idFiliere']; ?>&sigle=<?php echo $ligne['sigle']; ?>">Grades</a>
                        </div>
                    </div>
                <?php }} else { ?>
                <div class="alertt">
                    No data found matching your search criteria!
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <script src="./assets/js/jquery-3.7.1.min.js"></script>
    <script src="./assets/js/formateur-script.js"></script>
</body>


</html>