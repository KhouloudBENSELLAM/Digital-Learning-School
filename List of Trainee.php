<?php 
require("connexion.php");
session_start();
$items_per_page = 5;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

$offset = ($page - 1) * $items_per_page;

$total_items_query = $connexion->query("SELECT COUNT(*) FROM passerexam INNER JOIN stagiaire ON passerexam.numeroInscription = stagiaire.numeroInscription");
$total_items = $total_items_query->fetchColumn();

$total_pages = ceil($total_items / $items_per_page);

$rq = $connexion->prepare("SELECT * FROM passerexam
    INNER JOIN stagiaire
    ON passerexam.numeroInscription = stagiaire.numeroInscription
    ORDER BY stagiaire.idFiliere DESC
    LIMIT :limit OFFSET :offset");
$rq->bindValue(':limit', $items_per_page, PDO::PARAM_INT);
$rq->bindValue(':offset', $offset, PDO::PARAM_INT);
$rq->execute();
$stagiaires = $rq->fetchAll(PDO::FETCH_ASSOC);

$reqte=$connexion->prepare("SELECT administrateur.nom,administrateur.prenom,administrateur.Photoprofil,administrateur.matricule_Admin FROM Compte
INNER JOIN administrateur ON Compte.email = administrateur.email");
 
$reqte->execute();
$donne = $reqte->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adjourned trainees</title>
    <link rel="stylesheet" href="menu.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./assets/css/formateur-styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="bootstrap-5.2.2-dist/css/bootstrap.min.css">
    <style>
        #user {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
        .admin {
            text-decoration: none;
            color: gray;
            font-size: 25px;
        }
        .admin::after {
            display: none;
        }
        .admin:hover {
            color: gray;
        }
        nav div ul {
            margin-left: 310%;
            margin-top: -47px;
            border: 1px solid lightgray;
            border-radius: 20px;
        }
        section {
            margin-right: 2%;
            margin-bottom: 4%;
        }
        ble {
            width: 100%;
        }
        table tr:first-child {
            background-color: #f8f9fa; 
            color: #343a40; 
        }
        td {
            background-color: #ffffff; 
        }
        .pagination {
            justify-content: center;
        }
        .menu-items{
            margin-top: 8px;
            margin-left: 74%;
        }
        .profile-click a.first {
            border-radius: 9px 9px 0px 0px;
        }
        .profile-click a.second {
            border-radius: 9px 9px 0px 0px;
        }
        .profile-click a.last {
            border-radius: 0px 0px 9px 9px;
            border-bottom: unset !important;
        }
    </style>
</head>
<body>
<div style="margin-top:1px;">
        <div class="navbarr">
            <div>
                <a href="./home.php" class="logo">Digital&nbsp;&nbsp;Learning&nbsp;&nbsp;School</a>
            </div>
            <div class="menu-toggle">
                <hr/>
                <hr/>
                <hr/>
            </div>
            <div class="dflex menu-items">
                
                <div class="relative profile0">
                    
                    <div class="dflex profile">
                        <img class="profile-img img0" src="<?php echo 'Users/' . $donne['Photoprofil']; ?>" alt="profile">
                        <div>
                            <div><?php echo $_SESSION['nom'] . " " . $_SESSION['prenom'] ?></div>
                            <div style="color:gray;" class="role">Administrator</div>
                        </div>
                        <img class="profile-img img1" src="<?php echo 'Users/' . $donne['Photoprofil']; ?>" alt="profile">
                    </div>
                    <div class="profile-click" style="display: none;">
                        <a href="showAdministratorInfp.php?idStg=<?php echo $donne['matricule_Admin'] ?>" class="first">Show my informations</a>
                        <a href="Edit_administrator_info.php?id=<?php echo $donne['matricule_Admin'] ?>" class="second">Edit my informations</a>
                        <a href="logout.php" class="last">Log out</a>
                    </div>
                    
                </div>
            </div>
        </div>
        

<div class="sidebar active">
    <div class="toggle-btn">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <div class="links">
    <a href="#">
                <i><img src="images/logo.png" width="50px" height="50px" alt=""></i>
                Digital Learning School
            </a>
        <a href="Home.php">
            <i class="fas fa-home"></i>
            Home
        </a>
        <a href="AjouterStg.php" class="active">
            <i class="fas fa-users"></i>
            Trainees
        </a>
        <a href="Admitted trainee.php">
            <i class="fas fa-user-plus"></i>
            Admitted trainees
        </a>
        <a href="Adjourned trainee.php">
            <i class="fas fa-user-times"></i>
            Adjourned trainees
        </a>
        <a href="List of Trainee.php">
            <i class="fas fa-list"></i>
            List of trainees
        </a>
        <a href="Best grades.php">
            <i class="fas fa-book"></i>
            The best grades
        </a>
        <a href="AjouterFormateur.php">
            <i class="fas fa-user-circle"></i>
            Trainers
        </a>
        <a href="List of Trainers.php">
                <i class="fas fa-list"></i>
                List of trainers
        </a>
        <a href="logout.php">
            <i class="fas fa-sign-out-alt"></i>
            Log out
        </a>
    </div>
</div>
<script>
    document.querySelector('.sidebar .toggle-btn').addEventListener('click', function(){
        document.querySelector('.sidebar').classList.toggle("active")
    })
</script>
<br>

<div class="container">
    <table class="table text-center">
        <thead>
            <tr>
                <th>Registration Number</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Registration Date</th>
                <th>Picture</th>
                <th>Email</th>
                <th>Grade</th>
                <th>Field of Study</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stagiaires as $ligne){ ?>
                <tr>
                    <td><?php echo $ligne['numeroInscription']; ?></td>
                    <td><?php echo $ligne['nom']; ?></td>
                    <td><?php echo $ligne['prenom']; ?></td>
                    <td><?php echo $ligne['DateInscription']; ?></td>
                    <td><img src="<?php echo 'Users/'.$ligne['PhotoProfil']; ?>" width="30px" height="30px" alt=""></td>
                    <td><?php echo $ligne['email']; ?></td>
                    <td><?php echo $ligne['note']; ?></td>
                    <td><?php echo $ligne['idFiliere']; ?></td>
                    <td>
                        <a href="showinfoStg.php?id=<?php echo $ligne['numeroInscription']; ?>"><img src="icons/show.png" alt="" width="20px" height="20px"></a>
                        <a href="modifierStg.php?idstg=<?php echo $ligne['numeroInscription']; ?>" style="margin-left:3%;"><img src="icons/edit.png" alt="" width="20px" height="20px" ></a>
                        <a href="SupprimerStg Action.php?Idstg=<?php echo $ligne['numeroInscription']; ?>" onclick="return confirm('Are you sure that you want delete the selected item?')" style="margin-left:3%;"><img src="icons/bin.png" alt="" width="20px" height="20px"></a>
                    </td>
                    
                </tr>
            <?php }?>
        </tbody>
    </table>

    <!-- Pagination -->
    <div aria-label="Page navigation">
        <ul class="pagination">
            <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php for ($i = 1; $i <= $total_pages; $i++){ ?>
                <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php } ?>
            <li class="page-item <?= $page >= $total_pages ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="bootstrap-5.2.2-dist/js/bootstrap.min.js"></script>
<script src="bootstrap-5.2.2-dist/js/bootstrap.bundle.min.js"></script>
<script src="./assets/js/jquery-3.7.1.min.js"></script>
    <script src="./assets/js/formateur-script.js"></script>
</body>
</html>
