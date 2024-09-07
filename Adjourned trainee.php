<?php 
    session_start();
    require("connexion.php");
    $rq=$connexion->prepare("SELECT * FROM passerexam
    INNER JOIN stagiaire
    ON passerexam.numeroInscription = stagiaire.numeroInscription
    WHERE passerexam.note <= 10
    ORDER BY passerexam.note DESC ");
    $rq->execute();

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
    <script src="bootstrap-5.2.2-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="bootstrap-5.2.2-dist/css/bootstrap.min.css">
    <script src="bootstrap-5.2.2-dist/js/bootstrap.bundle.min.js"></script>
    <style>
        #user{
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
        .admin{
            text-decoration: none;
            color: gray;
            font-size: 25px;
        }
        .admin::after{
            display: none;
        }
        .admin:hover{
            color: gray;

        }
        nav div ul{
            margin-left: 310%;
            margin-top: -47px;
            border: 1px solid lightgray;
            border-radius: 20px;

        }
        section {
            margin-right: 2%;
            margin-bottom: 4%;
        }
        
        table{
            width: 90%;
        }
        
        table tr:first-child{
            background-color: #f8f9fa; 
            color: #343a40; 
        }
        td {
            background-color: #ffffff; 
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
            <a href="Home.Php">
                <i class="fas fa-home"></i>
                Home
            </a>
            <a href="AjouterStg.php" class="active">
                <i class="fas fa-users"></i>
                trainees
            </a>
            <a href="Admitted trainee.php" >
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
        document.querySelector('.sidebar .toggle-btn').addEventListener('click',function(){
            document.querySelector('.sidebar').classList.toggle("active")
        })
    </script>
    
    <br>
    <table class="table text-center">
        <tr>
            <th>Registration Number</th>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Registration Date </th>
            <th>Picture</th>
            <th>Email</th>
            <th>Grade</th>
            <th>Field of Study</th>
        </tr>
        <?php while($ligne=$rq->fetch()){  ?>
            <tr>
                <td><?php echo $ligne['numeroInscription']; ?></td>
                <td><?php echo $ligne['nom']; ?></td>
                <td><?php echo $ligne['prenom']; ?></td>
                <td><?php echo $ligne['DateInscription']; ?></td>
                <td><img src="<?php echo 'Users/'.$ligne['PhotoProfil']; ?>" width="30px" height="30px" alt=""></td>
                <td><?php echo $ligne['email']; ?></td>
                <td><?php echo $ligne['note']; ?></td>
                <td><?php echo $ligne['idFiliere']; ?></td>
            </tr>
        <?php } ?>
    </table>
    <script src="./assets/js/jquery-3.7.1.min.js"></script>
    <script src="./assets/js/formateur-script.js"></script>
</body>
</html>