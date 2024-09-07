<?php
session_start();



require ("connexion.php");

$user = $connexion->prepare("SELECT formateur.nom,formateur.prenom,formateur.Photoprofil,formateur.matricule_formateur FROM Compte
    INNER JOIN formateur ON Compte.email = formateur.email");
$user->execute();
$user = $user->fetch();



$donnee = $connexion->prepare("SELECT * FROM passerexam where idNote=?");
$donnee->execute(array($_GET['idNote']));
$donnee = $donnee->fetch();

$idFiliere = $_GET['idFiliere'];
$sigle = $_GET['sigle'];
$search = $_GET['search'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/formateur-styles.css">
    <title>Trainer Grades</title>
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
                    <a href="./formateurModules.php" class="btn-menu">Modules</a>
                    <a href="./espace formateur.php" class="btn-menu">Cours</a>
                    <a href="./formateurNotes.php" class="btn-menu active">Notes</a>
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
                <form action="formateurNotesUpdateAction.php" method="post" enctype="multipart/form-data">
                    <div class="retour">
                        <a href="<?php echo "./formateurNotes.php?idFiliere=".$idFiliere."&sigle=".$sigle."&search=".$search ?>">
                            &#8592; back
                        </a>
                    </div>
                    <div class="title">Edit A Grade</div>
                    <input type="hidden" name="idFiliere0" value="<?php echo $idFiliere ?>">
                    <input type="hidden" name="sigle0"  value="<?php echo $sigle ?>">
                    <input type="hidden" name="sigle" id="sigle" value="<?php echo $donnee['sigle'] ?>">
                    <input type="hidden" name="numInscr" id="numInscr" value="<?php echo $donnee['numeroInscription'] ?>">
                    <input type="hidden" name="idNote" id="idNote" value="<?php echo $donnee['idNote'] ?>">
                    <div class="label">Sigle</div>
                    <input type="text" name="" id="" value="<?php echo $donnee['sigle'] ?>" disabled>
                    <div class="label">Registration Number</div>
                    <input type="text" name="" id="" value="<?php echo $donnee['numeroInscription'] ?>" disabled>
                    <div class="label">Nature of exam</div>
                    <input type="text" name="natureExam" id="natureExam" value="<?php echo $donnee['natureExam'] ?>">
                    <div class="label">Grade</div>
                    <input type="number" name="note" id="note" value="<?php echo $donnee['note'] ?>">
                    <input type="submit" value="Edit">

                    <?php if(isset($_GET['msg'])){ ?>
                    <div class="alertd">
                        <?php echo $_GET['msg']; ?>
                        <span class="close" onclick="<?php echo "location.href='./formateurNotesUpdate.php?idFiliere=".$idFiliere."&sigle=".$sigle."&search=".$search."&idNote=".$_GET['idNote']."'" ?>;"> x </span>
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