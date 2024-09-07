<?php
session_start();

//redirect to authetication page if the user is not logged in 
if ($_SESSION['email'] == "") {
    header("location:login .php");
}

require ("connexion.php");

$user = $connexion->prepare("SELECT formateur.nom,formateur.prenom,formateur.Photoprofil,formateur.matricule_formateur FROM Compte
    INNER JOIN formateur ON Compte.email = formateur.email");
$user->execute();
$user = $user->fetch();


$idFiliere = $_GET['idFiliere'];
// var_dump($idFiliere);
$sigle = $_GET['sigle'];
// var_dump($sigle);
$matric_formateur=$_GET['idf'];
// var_dump($matric_formateur);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/formateur-styles.css">
    <title>Trainer Course</title>
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
                    <a href="formateurModules.php" class="btn-menu">Moduls</a>
                    <a href="espace formateur.php" class="btn-menu active">Courses</a>
                    <a href="formateurNotes.php" class="btn-menu">Grades</a>
                </div>
                <div class="relative profile0">
                    <div class="dflex profile">
                        <img class="profile-img img0" src="<?php echo 'Users/' . $user['Photoprofil']; ?>" alt="profile">
                        <div>
                            <div><?php echo $user['nom'] . " " . $user['prenom'] ?></div>
                            <div class="role">Trainer</div>
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
        <div class="containerr0">
            <div class="card">
                <form action="formateurCoursAddAction.php" method="post" enctype="multipart/form-data">
                    <div class="retour">
                        <a href="<?php echo "espace formateur.php?idFiliere=".$idFiliere."&sigle=".$sigle."&idf=".$user['matricule_formateur'] ?>">
                            &#8592; back
                        </a>
                    </div>
                    <div class="title">Add a course</div>
                    <input type="hidden" name="idFiliere" id="idFiliere" value="<?php echo $idFiliere ?>">
                    <input type="hidden" name="sigle" id="sigle" value="<?php echo $sigle ?>">
                    <div class="label">Sigle</div>
                    <input type="text" name="" id="" value="<?php echo $sigle ?>" disabled>
                    <div class="label">Title</div>
                    <input type="text" name="titre" id="titre">
                    <div class="label">Description</div>
                    <textarea name="description" id="description" rows="3"></textarea>
                    <div class="label">Documents</div>
                    <input type="file" name="docs[]" multiple="multiple">
                    <input type="submit" value="Add">

                    <?php if(isset($_GET['msg'])){ ?>
                    <div class="alertd">
                        <?php echo $_GET['msg']; ?>
                        <span class="close" onclick="<?php echo "location.href='formateurCoursAdd.php?idFiliere=".$idFiliere."&sigle=".$sigle."&idf=".$user['matricule_formateur']."'" ?>;"> x </span>
                    </div>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>

    <script src="./assets/js/jquery-3.7.1.min.js"></script>
    <script src="./assets/js/formateur-script.js"></script>
</body>

</html>