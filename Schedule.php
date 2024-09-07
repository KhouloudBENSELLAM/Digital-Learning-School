<?php 
session_start();
require("connexion.php");
$filiere=$_GET['id'];
$rqt = $connexion->prepare("SELECT * FROM module WHERE idFiliere=?");
$rqt->execute(array($filiere));
$datas = $rqt->fetchAll(PDO::FETCH_ASSOC);


$data1 = $datas[0] ?? null;
$data2 = $datas[1] ?? null;
$data3 = $datas[2] ?? null;
$data4 = $datas[3] ?? null;
$data5 = $datas[4] ?? null;

$reqe=$connexion->prepare("SELECT stagiaire.nom,stagiaire.numeroInscription,stagiaire.prenom,stagiaire.PhotoProfil,stagiaire.idFiliere FROM Compte
    INNER JOIN stagiaire ON Compte.email = stagiaire.email ");
    $reqe->execute();
    $dataa= $reqe->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="menu.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./assets/css/formateur-styles.css">
    <title>Schedule</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 10px;
        }
        th, td {
            text-align: center;
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
                        <img class="profile-img img0" src="<?php echo 'Users/' . $dataa['PhotoProfil']; ?>" alt="profile">
                        <div>
                            <div><?php echo $_SESSION['nom'] . " " . $_SESSION['prenom'] ?></div>
                            <div style="color:#18A3B7;" class="role">Trainee</div>
                        </div>
                        <img class="profile-img img1" src="<?php echo 'Users/' . $dataa['PhotoProfil']; ?>" alt="profile">
                    </div>
                    <div class="profile-click" style="display: none;">
                        <a href="show_Stg_Info.php?idStg=<?php echo $dataa['numeroInscription'] ?>" class="first">Show my informations</a>
                        <a href="Edit_stg_info.php?id=<?php echo $dataa['numeroInscription'] ?>" class="second">Edit my informations</a>
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
                <i><img src="images/logo.png" width="45px" height="45px" alt=""></i>
                Digital&nbsp;Learning&nbsp;School
            </a>
            <a href="Home.Php">
                <i class="fas fa-home"></i>
                Home
            </a>
            <a href="StgGrades.php" class="active">
                <i class="fas fa-graduation-cap"></i>
                My grades
            </a>
            <a href="courses.php" >
                <i class="fas fa-book"></i>
                Courses
            </a>
            <a href="TPs.php">
                <i class="fas fa-tools"></i>
                TPs
            </a>
            <a href="TDs.php">
                <i class="fas fa-chalkboard-teacher"></i>
                TDs
            </a>
            
            <a href="Schedule.php?id=<?php echo $dataa['idFiliere'] ?>">
                <i class="fas fa-calendar-alt"></i>
                Schedule
            </a>

            <a href="Games.php">
                <i class="fas fa-gamepad icon"></i>
                Games
            </a>

            <a href="logout.php">
                <i class="fas fa-sign-out-alt"></i>
                Log out
            </a>

        </div>
    </div>
    <script>
        document.querySelector('.sidebar .toggle-btn').addEventListener('click',function(){
            document.querySelector('.sidebar').classList.toggle("active")
        })
    </script>

    <table width="100%">
        <tr>
            <th>Days</th>
            <th>Info</th>
            <th>08:30 - 10:50</th>
            <th>11:00 - 13:15</th>
            <th>13:30 - 15:50</th>
            <th>16:00 - 18:30</th>
        </tr>
        <?php if ($data1): ?>
        <tr>
            <td rowspan="3">Monday</td>
            <td>Trainer</td>
            <td><?php echo $data1['matricule_formateur']; ?></td>
            <td><?php echo $data1['matricule_formateur']; ?></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Module</td>
            <td><?php echo $data1['sigle']; ?><br><?php echo $data1['description']; ?></td>
            <td><?php echo $data1['sigle']; ?><br><?php echo $data1['description']; ?></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Class</td>
            <td>class 9</td>
            <td>class 9</td>
            <td></td>
            <td></td>
        </tr>
        <?php endif; ?>
        
        <?php if ($data2): ?>
        <tr>
            <td rowspan="3">Tuesday</td>
            <td>Trainer</td>
            <td><?php echo $data2['matricule_formateur']; ?></td>
            <td><?php echo $data2['matricule_formateur']; ?></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Module</td>
            <td><?php echo $data2['sigle']; ?><br><?php echo $data2['description']; ?></td>
            <td><?php echo $data2['sigle']; ?><br><?php echo $data2['description']; ?></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Class</td>
            <td>class 10</td>
            <td>class 10</td>
            <td></td>
            <td></td>
        </tr>
        <?php endif; ?>
        
        <?php if ($data3): ?>
        <tr>
            <td rowspan="3">Wednesday</td>
            <td>Trainer</td>
            <td></td>
            <td></td>
            <td><?php echo $data3['matricule_formateur']; ?></td>
            <td><?php echo $data3['matricule_formateur']; ?></td>
        </tr>
        <tr>
            <td>Module</td>
            <td></td>
            <td></td>
            <td><?php echo $data3['sigle']; ?><br><?php echo $data3['description']; ?></td>
            <td><?php echo $data3['sigle']; ?><br><?php echo $data3['description']; ?></td>
        </tr>
        <tr>
            <td>Class</td>
            <td></td>
            <td></td>
            <td>class 11</td>
            <td>class 11</td>
        </tr>
        <?php endif; ?>

        <?php if ($data4): ?>
        <tr>
            <td rowspan="3">Thursday</td>
            <td>Trainer</td>
            <td><?php echo $data1['matricule_formateur']; ?></td>
            <td><?php echo $data1['matricule_formateur']; ?></td>
            <td><?php echo $data1['matricule_formateur']; ?></td>
            <td><?php echo $data1['matricule_formateur']; ?></td>
        </tr>
        <tr>
            <td>Module</td>
            <td><?php echo $data1['sigle']; ?><br><?php echo $data1['description']; ?></td>
            <td><?php echo $data1['sigle']; ?><br><?php echo $data1['description']; ?></td>
            <td><?php echo $data1['sigle']; ?><br><?php echo $data1['description']; ?></td>
            <td><?php echo $data1['sigle']; ?><br><?php echo $data1['description']; ?></td>
        </tr>
        <tr>
            <td>Class</td>
            <td>class 9</td>
            <td>class 9</td>
            <td>class 5</td>
            <td>class 5</td>
        </tr>
        <?php endif; ?>

        <?php if ($data5): ?>
        <tr>
            <td rowspan="3">Friday</td>
            <td>Trainer</td>
            <td></td>
            <td><?php echo $data1['matricule_formateur']; ?></td>
            <td><?php echo $data1['matricule_formateur']; ?></td>
            <td></td>
        </tr>
        <tr>
            <td>Module</td>
            <td></td>
            <td><?php echo $data1['sigle']; ?><br><?php echo $data1['description']; ?></td>
            <td><?php echo $data1['sigle']; ?><br><?php echo $data1['description']; ?></td>
            <td></td>
        </tr>
        <tr>
            <td>Class</td>
            <td></td>
            <td>class 3</td>
            <td>class 3</td>
            <td></td>
        </tr>
        <?php endif; ?>
    </table>
    <script src="./assets/js/jquery-3.7.1.min.js"></script>
    <script src="./assets/js/formateur-script.js"></script>
</body>
</html>
