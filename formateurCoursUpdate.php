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



$donnee = $connexion->prepare("SELECT c.*, m.idFiliere FROM cours c INNER JOIN module m ON c.sigle = m.sigle where idCours=?");
$donnee->execute(array($_GET['idCours']));
$donnee = $donnee->fetch();

$idFiliere = $_GET['idFiliere'];
$sigle = $_GET['sigle'];

$res = $connexion->prepare("SELECT idresource, type, title, url FROM resources WHERE idcours = ? ");
$res->execute(array($_GET['idCours']));

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/formateur-styles.css">
    <title>Trainer Courses</title>
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
                    <a href="./formateurModules.php" class="btn-menu">Moduls</a>
                    <a href="./espace formateur.php" class="btn-menu active">Courses</a>
                    <a href="./formateurNotes.php" class="btn-menu">Grades</a>
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
                <form action="formateurCoursUpdateAction.php" method="post" enctype="multipart/form-data">
                    <div class="retour">
                        <a href="<?php echo "./espace formateur.php?idFiliere=".$idFiliere."&sigle=".$sigle ?>">
                            &#8592; back
                        </a>
                    </div>
                    <div class="title">Edit a course</div>
                    <div class="docs">
                        <?php while($r = $res->fetch()){ ?>
                            <div class="doc">
                                <a href="<?php echo "formateurCoursUpdateResourceDelete.php?idFiliere=".$idFiliere."&sigle=".$sigle."&idCours=".$_GET['idCours']."&idRes=".$r['idresource']; ?>"><img class="action" src="./assets/images/trash.png"></a>
                                <img src="<?php echo './assets/images/'.($r['type'] == "pdf"?'pdf.png':($r['type'] == "vide"?"video.png":"doc.png")); ?>" alt="document" /> <div> <a target="_blank" href="<?php echo "./documents/".$r['url']?>"><?php echo $r['title'] ?></a></div>
                            </div>
                        <?php } ?>
                    </div>
                    <input type="hidden" name="idFiliere0" value="<?php echo $idFiliere ?>">
                    <input type="hidden" name="sigle0"  value="<?php echo $sigle ?>">
                    <input type="hidden" name="idFiliere" id="idFiliere" value="<?php echo $donnee['idFiliere'] ?>">
                    <input type="hidden" name="sigle" id="sigle" value="<?php echo $donnee['sigle'] ?>">
                    <input type="hidden" name="idCours" id="idCours" value="<?php echo $donnee['idcours'] ?>">
                    <div class="label">Sigle</div>
                    <input type="text" name="" id="" value="<?php echo $donnee['sigle'] ?>" disabled>
                    <div class="label">Title</div>
                    <input type="text" name="titre" id="titre" value="<?php echo $donnee['titre'] ?>">
                    <div class="label">Description</div>
                    <textarea name="description" id="description" rows="3"><?php echo $donnee['description'] ?></textarea>
                    <div class="label">Documents</div>
                    <input type="file" name="docs[]" multiple="multiple">
                    <input type="submit" value="Edit">

                    <?php if(isset($_GET['msg'])){ ?>
                    <div class="alertd">
                        <?php echo $_GET['msg']; ?>
                        <span class="close" onclick="<?php echo "location.href='./formateurCoursUpdate.php?idFiliere=".$idFiliere."&sigle=".$sigle."&idCours=".$_GET['idCours']."'" ?>;"> x </span>
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