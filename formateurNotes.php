<?php
session_start();

require("connexion.php");

// Ensure user is logged in
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    header("location: login.php");
    exit();
}

// Fetch user information
$userQuery = $connexion->prepare("SELECT formateur.nom, formateur.prenom, formateur.Photoprofil, formateur.matricule_formateur FROM Compte INNER JOIN formateur ON Compte.email = formateur.email");
$userQuery->execute();
$user = $userQuery->fetch();

// Fetch filieres
$filiersQuery = $connexion->prepare("SELECT DISTINCT f.idFiliere, f.libelle FROM filiere f INNER JOIN module m ON f.idFiliere = m.idFiliere WHERE m.matricule_formateur = ?");
$filiersQuery->execute([$user['matricule_formateur']]);
// var_dump($filiersQuery->fetch());

$idFiliere = isset($_GET['idFiliere']) && $_GET['idFiliere'] > 0 ? $_GET['idFiliere'] : 0;

// Fetch modules
$modulesQuery = $connexion->prepare("SELECT sigle FROM module WHERE matricule_formateur = ? ");
$modulesQuery->execute([$user['matricule_formateur']]);
// var_dump($modulesQuery->fetch());

$sigle = isset($_GET['sigle']) && $_GET['sigle'] != "0" && $_GET['sigle'] != "" ? $_GET['sigle'] : "0";

$search = isset($_GET['search']) && $_GET['search'] != "0" && $_GET['search'] != "" ? $_GET['search'] : "0";

// Fetch notes
$notesQuery = $connexion->prepare("SELECT p.idNote, p.numeroInscription, p.sigle, CONCAT(p.sigle,' (',m.description,')') AS module, p.natureExam, p.note, m.idFiliere, f.libelle AS filiere, s.nom, s.prenom, s.PhotoProfil FROM passerexam p INNER JOIN module m ON p.sigle = m.sigle INNER JOIN filiere f ON m.idFiliere = f.idFiliere INNER JOIN stagiaire s ON p.numeroInscription = s.numeroInscription WHERE m.matricule_formateur = ? AND (? = 0 OR m.idFiliere = ?) AND (? = '0' OR p.sigle = ?) AND (? = '0' OR p.numeroInscription = ?)");
$notesQuery->execute([$user['matricule_formateur'], $idFiliere, $idFiliere, $sigle, $sigle, $search, $search]);

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
                    <a href="./formateurModules.php" class="btn-menu">Moduls</a>
                    <a href="./espace formateur.php" class="btn-menu">Courses</a>
                    <a href="./formateurNotes.php" class="btn-menu active">Grades</a>
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
        <div class="containerr1">
            <div class="dflex">
                <select id="notes-filiere" class="frm-selectt">
                    <option value="0" <?php echo $idFiliere == 0 ? "selected" : "" ?>>Field</option>
                    <?php while ($ligne = $filiersQuery->fetch()) { ?>
                        <option value="<?php echo $ligne['idFiliere']; ?>" <?php echo $idFiliere == $ligne['idFiliere'] ? "selected" : "" ?>>
                            <?php echo $ligne['libelle']; ?>
                        </option>
                    <?php } ?>
                </select>
                <select id="notes-modules" class="frm-selectt">
                    <option value="0" <?php echo $sigle == "0" ? "selected" : "" ?>>Modul</option>
                    <?php while ($ligne = $modulesQuery->fetch()) { ?>
                        <option value="<?php echo $ligne['sigle']; ?>" <?php echo $sigle == $ligne['sigle'] ? "selected" : "" ?>>
                            <?php echo $ligne['sigle']; ?>
                        </option>
                    <?php } ?>
                </select>
                <div class="notes-search">
                    <input placeholder="Numero d'inscription" type="text" id="notesSearch" value="<?php echo $search != "0" ? $search : "" ?>">
                    <img id="notesSearchClick" class="action" src="./assets/images/search.png">
                </div>
            </div>
            <div class="btn-add0">
                <a class="btn-add <?php echo $sigle == "0" ? "add-disactive" : "add-active" ?>" href="<?php echo $sigle != "0" ? "./formateurNotesAdd.php?idFiliere=" . $idFiliere . "&sigle=" . $sigle . "&search=" . $search : "" ?>">Add +</a>
            </div>

            <div class="cardds">
                <?php if ($notesQuery->rowCount() > 0) { ?>
                    <div class="list">
                        <table width="100%">
                            <thead>
                                <tr>
                                    <th>Registration Number</th>
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Picture</th>
                                    <th>Field</th>
                                    <th>Module</th>
                                    <th>Nature Exam</th>
                                    <th>Grade</th>
                                    <th>Modify</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($ligne = $notesQuery->fetch()) { ?>
                                    <tr>
                                        <td><?php echo $ligne['numeroInscription']; ?></td>
                                        <td><?php echo $ligne['nom']; ?></td>
                                        <td><?php echo $ligne['prenom']; ?></td>
                                        <td class="profile"><img src="<?php echo 'Users/' . $ligne['PhotoProfil']; ?>" alt=""></td>
                                        <td><?php echo $ligne['filiere']; ?></td>
                                        <td><?php echo $ligne['module']; ?></td>
                                        <td><?php echo $ligne['natureExam']; ?></td>
                                        <td><?php echo $ligne['note']; ?></td>
                                        <td>
                                            <a href="<?php echo "formateurNotesUpdate.php?idFiliere=" . $idFiliere . "&sigle=" . $sigle . "&search=" . $search . "&idNote=" . $ligne['idNote']; ?>">
                                                <img class="action" src="./assets/images/pen.png">
                                            </a>
                                        </td>
                                        <td>
                                            <a onclick="return confirm('Are you sure taht you want delete this trainee!?')" href="<?php echo "formateurNotesDelete.php?idFiliere=" . $idFiliere . "&sigle=" . $sigle . "&search=" . $search . "&idNote=" . $ligne['idNote']; ?>">
                                                <img class="action" src="./assets/images/trash.png">
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } else { ?>
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
