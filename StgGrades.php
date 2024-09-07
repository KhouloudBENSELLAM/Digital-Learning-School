<?php 
    require("connexion.php");
    session_start();
    function bonjour_bonsoir(){
        return date("H") > 12? 'Bonsoire':'Bonjour';
    }
    $ret=$connexion->prepare("SELECT * FROM Compte
        INNER JOIN stagiaire ON Compte.email = stagiaire.email");
    $ret->execute();
    $ligne = $ret->fetch();

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
    <title>Espace Administrateur</title>
    <link rel="stylesheet" href="menu.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./assets/css/formateur-styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="bootstrap-5.2.2-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="bootstrap-5.2.2-dist/css/bootstrap.min.css">
    <script src="bootstrap-5.2.2-dist/js/bootstrap.bundle.min.js"></script>
    <style>
        h1{
            text-align: center;
            margin-top: 210px;
            font-size: 44px;
            color: #4b5a6cf7;
        }
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
            margin-left:330%;
            margin-top: 16px;
            border: 1px solid lightgray;
            border-radius: 20px;
        }
        section {
            margin-right: 2%;
        }
        article{
            margin-left: 40%;
            margin-top: 13%;
            display: flex;
            flex-direction: column;
        }
        #div1{
            background-color: #4b5a6cf7;
            width: 42%;
            height: 70px;
            text-align: center;
            padding-bottom: 1%;
            border: none;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 10px 10px 20px rgba(0,0,0,0.5) ;
        }
        #div1 a{
            color: white;
            font-size: 32px;
            text-decoration: none;
        }

        #div2{
            background-color: #4ADDEC;
            width: 42%;
            height: 70px;
            text-align: center;
            padding-bottom: 1%;
            margin-bottom: 20px;
            border: none;
            border-radius: 10px;
            box-shadow: 10px 10px 20px rgba(0,0,0,0.5) ;
        }
        #div2 a{
            color: white;
            font-size: 32px;
            text-decoration: none;
        }

        #div3{
            background-color: #59affaf6;
            width: 42%;
            height: 70px;
            text-align: center;
            padding-bottom: 1%;
            border: none;
            border-radius: 10px;
            box-shadow: 10px 10px 20px rgba(0,0,0,0.5) ;
        }
        #div3 a{
            color: white;
            font-size: 32px;
            text-decoration: none;
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
    <article>
    <button id="div1"><a href="allGrades.php?id=<?php echo $ligne['numeroInscription']; ?>">All grades</a></button>
    <button id="div2"><a href="gradesByModul.php?id=<?php echo $ligne['numeroInscription']; ?>">Grades By Module</a></button>
    <button id="div3"><a href="gradesByTrainer.php?id=<?php echo $ligne['numeroInscription']; ?>">Grades By Trainer</a></button>
    </article>
    

    






    
    
    
    <script src="./assets/js/jquery-3.7.1.min.js"></script>
    <script src="./assets/js/formateur-script.js"></script>
</body>
</html>