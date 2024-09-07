<?php

session_start();

//this must be assigned on the login page after authentication
//just doing it here because I don't have login page here but it should be integrated with it later
$_SESSION['email'] = "formateur1@gmail.com";

//redirect to authetication page if the user is not logged in 
if ($_SESSION['email'] == "") {
    header("location:login.php"); 
}

require ("connexion.php");

$user = $connexion->prepare("SELECT formateur.nom,formateur.prenom,formateur.Photoprofil,formateur.matricule_formateur FROM Compte
    INNER JOIN formateur ON Compte.email = formateur.email");
$user->execute();
$user = $user->fetch();
// var_dump($user);

//redirect to home page if the user is not a formateur
// if ($user['role'] != "FORMATEUR") {
//     header("location:home.php");
// }

$filiers = $connexion->prepare("SELECT DISTINCT f.idFiliere, f.libelle FROM filiere f INNER JOIN module m ON f.idFiliere = m.idFiliere WHERE m.matricule_formateur = ?");
$filiers->execute(array($user['matricule_formateur']));

$idFiliere = 0;
if(isset($_GET['idFiliere']) && $_GET['idFiliere'] > 0){
    $idFiliere = $_GET['idFiliere'];
}

$modules = $connexion->prepare("SELECT sigle FROM module WHERE matricule_formateur = ?");
$modules->execute(array($user['matricule_formateur']));

$sigle = "0";
if(isset($_GET['sigle']) && $_GET['sigle'] != "0" && $_GET['sigle'] != ""){
    $sigle = $_GET['sigle'];
}

// $cours = $connexion->prepare("SELECT c.idCours, c.titre, c.description, c.sigle, m.idFiliere FROM cours c INNER JOIN module m ON c.sigle = m.sigle WHERE m.matricule_formateur = ? AND ".($idFiliere > 0? " m.idFiliere":" 0")." = ? AND ".($sigle != "0"? " c.sigle":" '0'")." = ?;");
// $cours->execute();
// var_dump($cours->fetch());

// Prepare the SQL query with placeholders
$sql = "
    SELECT c.idCours, c.titre, c.description, c.sigle, m.idFiliere 
    FROM cours c 
    INNER JOIN module m ON c.sigle = m.sigle 
    WHERE m.matricule_formateur = ? 
    AND (m.idFiliere = ? OR ? = 0) 
    AND (c.sigle = ? OR ? = '0');
";

$cours = $connexion->prepare($sql);

// Execute the query with appropriate parameters
$cours->execute(array($user['matricule_formateur'], $idFiliere, $idFiliere, $sigle, $sigle));
// var_dump($cours->fetch());

function ressources($idCourss, $connexionn) {
    $res = $connexionn->prepare("SELECT type, title, url FROM resources WHERE idcours = ? ");
    $res->execute(array($idCourss));
    return $res;
}
  
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
        <div class="containerr">
            <div class="dflex">
                <select id="cours-filiere" class="frm-selectt">
                    <option value="0" <?php echo $idFiliere == 0? "selected":"" ?> >Field</option>
                    <?php while($ligne=$filiers->fetch()){ ?>
                    <option value="<?php echo $ligne['idFiliere']; ?>" <?php echo $idFiliere == $ligne['idFiliere']? "selected":"" ?> >
                        <?php echo $ligne['libelle']; ?>
                        
                    </option>
                    <?php } ?>
                </select>
                <select id="cours-modules" class="frm-selectt">
                    <option value="0" <?php echo $sigle == "0"? "selected":"" ?> >Modul</option>
                    <?php while($ligne=$modules->fetch()){ ?>
                    <option value="<?php echo $ligne['sigle']; ?>" <?php echo $sigle == $ligne['sigle']? "selected":"" ?> >
                        <?php echo $ligne['sigle']; ?>
                    </option>
                    <?php } ?>
                </select>
            </div>
            <div class="btn-add0">
                <a class="btn-add <?php echo $sigle == "0"?"add-disactive":"add-active" ?>" 
                    href="<?php echo $sigle != "0"?"formateurCoursAdd.php?idFiliere=".$idFiliere."&sigle=".$sigle."&idf=".$user['matricule_formateur']:"" ?>">Add +</a>
            </div>
            <div class="cardds">
                <?php if($cours->rowCount() > 0){ while($ligne=$cours->fetch()){ ?>
                    <div class="cardd">
                        <div class="title">
                            <strong><?php echo $ligne['titre']; ?></strong>
                        </div>
                        <div class="description"><?php echo $ligne['description']; ?></div>
                        <div class="docs">
                            <?php $dt = ressources($ligne['idCours'], $connexion); while($res = $dt->fetch()){ ?>
                                <div class="doc">
                                    <img src="<?php echo './assets/images/'.($res['type'] == "pdf"?'pdf.png':($res['type'] == "vide"?"video.png":"doc.png")); ?>" alt="document" /> <div> <a target="_blank" href="<?php echo "./documents/".$res['url']?>"><?php echo $res['title'] ?></a></div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="buttons">
                            <a href="<?php echo "formateurCoursUpdate.php?idFiliere=".$idFiliere."&sigle=".$sigle."&idCours=".$ligne['idCours']; ?>">Edit </a>
                            <a class="bg-red" href="<?php echo "formateurCoursDelete.php?idFiliere=".$idFiliere."&sigle=".$sigle."&idCours=".$ligne['idCours']; ?>">Delete</a>
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
    <?php if(isset($_GET['msg'])){ ?>
        <p class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $_GET['msg']; ?>
        </p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <?php }?>

    <!-- <script>
        $(document).ready(function() {
        $(".profile-img").click(function(event) {
            $(".profile-click").css("display", $(".profile-click").css("display") == "flex" ? "none" : "flex");
        });

        $(".menu-toggle").click(function(event) {
            $(".menu-items").css("display", $(".menu-items").css("display") == "flex" ? "none" : "flex");
        });

        $('#modules-filiere').on('change', function(event) {
            location.href = "formateurModules.php?idFiliere=" + this.value;
        });
        
        $('#cours-filiere').on('change', function(event) {
            location.href = "espace formateur.php?idFiliere=" + encodeURIComponent(this.value);
        });
        
        $('#cours-modules').on('change', function(event) {
            location.href = "espace formateur.php?idFiliere=" + $('#cours-filiere').val() + "&sigle=" + this.value;
        });

        $('#notes-filiere').on('change', function(event) {
            location.href = "formateurNotes.php?idFiliere=" + this.value + "&search=" + $('#notesSearch').val();
        });
        
        $('#notes-modules').on('change', function(event) {
            location.href = "formateurNotes.php?idFiliere=" + $('#notes-filiere').val() + "&sigle=" + this.value + "&search=" + $('#notesSearch').val();
        });

        $("#notesSearchClick").click(function(event) {
            location.href = "formateurNotes.php?idFiliere=" + $('#notes-filiere').val() + "&sigle=" + $('#notes-modules').val() + "&search=" + $('#notesSearch').val();
        });

        $("#notesSearch").on('keyup', function(e) {
            if (e.key === 'Enter' || e.keyCode === 13) {
                location.href = "formateurNotes.php?idFiliere=" + $('#notes-filiere').val() + "&sigle=" + $('#notes-modules').val() + "&search=" + $('#notesSearch').val();
            }
        });
    });
    </script> -->

</body>

</html>