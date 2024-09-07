<?php 
    require("connexion.php");
    session_start();
    function bonjour_bonsoir(){
        return date("H") > 12? 'Bonsoire':'Bonjour';
    }
    $reqte=$connexion->prepare("SELECT administrateur.nom,administrateur.prenom,administrateur.Photoprofil,administrateur.matricule_Admin FROM Compte
    INNER JOIN administrateur ON Compte.email = administrateur.email");
     
    $reqte->execute();
    $donne = $reqte->fetch();

    $reqs=$connexion->prepare("SELECT * FROM formateur ");
    $reqs->execute();
    $data= $reqs->fetch();
    // var_dump($data);
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
            margin-top: 100px;
            font-size: 44px;
            color: #4b5a6cf7;
            margin-bottom: -150px;
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
            margin-left: 310%;
            margin-top: 16px;
            border: 1px solid lightgray;
            border-radius: 20px;
        }
        section {
            margin-right: 2%;
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
        #work{
            margin-top: 250px;
            margin-left: -5%;
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
                <i class="fas fa-user"></i>
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
            <a href="List of Trainees.php">
                <i class="fas fa-list"></i>
                List of trainees
            </a>
            <a href="Best grades.php">
                <i class="fas fa-book"></i>
                The best grades
            </a>
            <a href="AjouterFormateur.php?matriculeF=<?php echo $data['matricule_formateur'];?>">
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
    
    <?php 
        echo"<h1>".bonjour_bonsoir()." ".$_SESSION['nom']." ".$_SESSION['prenom']." dans votre espace de travail </h1>";
    ?>

    
    <div id="work"><?php include("workspace.html"); ?></div>





    <?php if(isset($_GET['msg'])){ ?>
        <p class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $_GET['msg']; ?>
        </p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <?php }?>
    
    <script src="./assets/js/jquery-3.7.1.min.js"></script>
    <script src="./assets/js/formateur-script.js"></script>
    
    
</body>
</html>