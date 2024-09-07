<?php 
session_start();
    require("connexion.php");
    $coursWeb=$connexion->prepare("SELECT cours.titre, resources.type, resources.url, cours.description, cours.Image_cours
        FROM cours 
        INNER JOIN resources ON cours.idcours = resources.idcours 
        WHERE resources.type = 'pageWeb'");
    $coursWeb->execute();
    // var_dump($cours->fetch());

    $cours=$connexion->prepare("SELECT cours.titre, resources.type, resources.url, cours.description, cours.Image_cours
        FROM cours 
        INNER JOIN resources ON cours.idcours = resources.idcours 
        WHERE resources.type = 'pdf'");
    $cours->execute();

    $coursVideo=$connexion->prepare("SELECT cours.titre, resources.type, resources.url, cours.description, cours.Image_cours
        FROM cours 
        INNER JOIN resources ON cours.idcours = resources.idcours 
        WHERE resources.type = 'video'");
    $coursVideo->execute();

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
    <link rel="stylesheet" href="Courses Cards.css">
    <link rel="stylesheet" href="menu.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./assets/css/formateur-styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Courses</title>
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

    <h1><img src="icons/landing-page.png" width="40px" height="40px"  alt=""> Courses (Web Pages)</h1>
    <main>
        <div class="slider" style="width:1160px;">
            <?php while ($data=$coursWeb->fetch()){ ?>
            <div class="course">

                <div class="image">
                    <img src=<?php echo 'icons/'.$data['Image_cours']; ?> alt="" width="350px" height="250px">
                </div>

                <div class="informations">

                    <div class="title"><h2 Style="font-size: 19px;color: #7aaeb4;margin-left:100%;margin-bottom:20px;"><?php echo $data['titre'] ;?></h2></div>

                    <div class="description"><?php echo $data['description']; ?></div>
                    
                        <button><a style="color: white;text-decoration:none;" href="<?php echo $data['url'] ?>">Show Full Course</a></button>
                </div>
            </div>
            <?php } ?>

        <div class="arrow">
            <button class="left" onclick="left()"><</button>
            <button class="right" onclick="right()">></button>
        </div>
</div>
    </main>


    <h1><img src="icons/file.png" width="40px" height="40px"  alt=""> Courses (PDF Format)</h1>
    <main>
        <div class="slider" style="width:1160px;">
            <?php while ($data=$cours->fetch()){ ?>
            <div class="course">

                <div class="image">
                    <img src=<?php echo 'icons/'.$data['Image_cours']; ?> alt="" width="350px" height="250px">
                </div>

                <div class="informations">

                    <div class="title"><h2 Style="font-size: 19px;color: #7aaeb4;margin-left:100%;margin-bottom:20px;"><?php echo $data['titre'] ;?></h2></div>

                    <div class="description"><?php echo $data['description']; ?></div>
                    
                    <button><a style="color: white;text-decoration:none;" href="documents/<?php echo $data['url'] ?>">Show Full Course</a></button>

                </div>
            </div>
            <?php } ?>

        <div class="arrow">
            <button class="left" onclick="left()"><</button>
            <button class="right" onclick="right()">></button>
        </div>
</div>
    </main>

    <h1><img src="icons/video.png" width="40px" height="40px"  alt=""> Courses (VIDEO Format)</h1>
    <main>
        <div class="slider" style="width:1160px;height:400px;">
            <?php while ($data=$coursVideo->fetch()){ ?>
            <div class="course">

                <div class="image">
                    <img src=<?php echo 'icons/'.$data['Image_cours']; ?> alt="" width="350px" height="250px">
                </div>

                <div class="informations">

                    <div class="title"><h2 Style="font-size: 19px;color: #7aaeb4;margin-left:100%;margin-bottom:20px;"><?php echo $data['titre'] ;?></h2></div>

                    <div class="description"><?php echo $data['description']; ?></div>
                    
                    <button><a style="color: white;text-decoration:none;" href="documents/<?php echo $data['url'] ?>">Show Full Course</a></button>

                </div>
            </div>
            <?php } ?>

        <div class="arrow">
            <button class="left" onclick="left()"><</button>
            <button class="right" onclick="right()">></button>
        </div>
</div>
    </main>
    <script src="Courses Cards.js"></script>
    <script src="./assets/js/jquery-3.7.1.min.js"></script>
    <script src="./assets/js/formateur-script.js"></script>
</body>
</html>