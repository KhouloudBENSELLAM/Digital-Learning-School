<?php 
    require("connexion.php");
    
    

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/formateur-styles.css">
    <link rel="stylesheet" href="menu.css?v=<?php echo time(); ?>">


    <title>Games </title>
    <style>
        p{
            font-size: 30px;
            color: gray;
            text-align: center;
            margin-left: 10%;
            margin-right: 10%;
            margin-top: 240px;
        }
    </style>
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
                    <a href="./Games with js/Breakout Game/index.html" class="btn-menu">Breakout Game</a>
                    <a href="./Games with js/Memory Game/index.html" class="btn-menu active">Memory Game</a>
                    <a href="./Games with js/Space Invaders Game/index.html" class="btn-menu">Space Invaders Game</a>
                    
                    
                </div>
                <div class="relative profile0">
                    <div class="dflex profile">
                        <img class="profile-img img0" src="<?php echo 'Users/' . $dataa['PhotoProfil']; ?>" alt="profile">
                        <div>
                            <div><?php echo $dataa['nom'] . " " . $dataa['prenom'] ?></div>
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

    <p>
        Hello dear student, I hope you are in the best conditions. 
        On this page we have <br>provided some games for you in order for you to 
        have fun during the weekend and break the school routine a little.
    </p>



        <script>
        document.querySelector('.sidebar .toggle-btn').addEventListener('click',function(){
            document.querySelector('.sidebar').classList.toggle("active")
        })
        </script>
        <script src="./assets/js/jquery-3.7.1.min.js"></script>
        <script src="./assets/js/formateur-script.js"></script>
</body>
</html>