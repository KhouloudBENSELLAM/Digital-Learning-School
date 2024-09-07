<?php 
session_start();
    require("connexion.php");

    $TD=$connexion->prepare("SELECT cours.titre, cours.sigle, resources.type, resources.url, cours.description, cours.Image_cours
        FROM cours 
        INNER JOIN resources ON cours.idcours = resources.idcours 
        WHERE resources.type = 'exercise'");
    $TD->execute();
    // var_dump($TD->fetch());

    $coursesBySigle = [];
    while ($data = $TD->fetch()) {
        $coursesBySigle[$data['sigle']][] = $data;
    }

    $reqe=$connexion->prepare("SELECT stagiaire.nom,stagiaire.numeroInscription,stagiaire.prenom,stagiaire.PhotoProfil,stagiaire.idFiliere FROM Compte
    INNER JOIN stagiaire ON Compte.email = stagiaire.email ");
    $reqe->execute();
    $dataa= $reqe->fetch();
    // var_dump($dataa);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Courses Cards.css">
    <link rel="stylesheet" href="menu.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./assets/css/formateur-styles.css">
    <title>TPs</title>
    <style>
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

    <?php foreach ($coursesBySigle as $sigle => $courses){ ?>
        <h1 style="margin-top:30px;">TD of modul <?php echo $sigle; ?></h1>
        <main>
            <div class="slider" style="margin-top:40px;">
                <?php foreach ($courses as $data){ ?>
                    <div class="course">
                        <div class="image">
                            <img src="icons/<?php echo $data['Image_cours']; ?>" alt="">
                        </div>
                        <div class="informations">
                            <div class="title">
                                <h2><?php echo $data['titre']; ?></h2>
                            </div>
                            <div class="description">
                                <?php echo $data['description']; ?>
                            </div>
                            <button>
                                <a style="color: white; text-decoration: none;" href="documents/<?php echo $data['url']; ?>">Show Full Course</a>
                            </button>
                        </div>
                    </div>
                <?php } ?>
                <div class="arrow">
                    <button class="left" onclick="left()">&lt;</button>
                    <button class="right" onclick="right()">&gt;</button>
                </div>
            </div>
        </main>
    <?php } ?>

    <script src="CoursesCards.js"></script>
    <script src="./assets/js/jquery-3.7.1.min.js"></script>
    <script src="./assets/js/formateur-script.js"></script>
</body>
</html>
