<?php 
    require("connexion.php");
    $id=$_GET['id'];
    $reqs=$connexion->prepare("SELECT * FROM stagiaire where numeroInscription= $id");
    $reqs->execute();
    $donne = $reqs->fetch();

    $reqste=$connexion->prepare("SELECT administrateur.nom,administrateur.prenom,administrateur.Photoprofil FROM Compte
    INNER JOIN administrateur ON Compte.email = administrateur.email");
    $reqste->execute();
    $data = $reqste->fetch();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admitted trainees</title>
    <link rel="stylesheet" href="menu.css?v=<?php echo time(); ?>">
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
            margin-left: 484%;
            margin-top: -47px;
            border: 1px solid lightgray;
            border-radius: 20px;

        }
        section {
            margin-right: 2%;
            margin-bottom: 4%;
        }
        #back{
            text-decoration: none;
            color: gray;
            font-size: 23px;
            margin-left: 93%;
            margin-top: 4%;
            border: 2px solid lightgray;
            padding-left: 0.7%;
            padding-right: 0.7%;
            padding-top: 0.3%;
            padding-bottom: 0.3%;
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
         .stagiaire-info {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            width: 28%;
            background: #fff;
        }
        .stagiaire-info img {
            border-radius: 50%;
            border: 3px solid lightgray;
            margin-left: 27%;
            padding: 4px;
            padding-bottom: 7px;
            margin-bottom: 13px;
        } 
        .stagiaire-info h4{
            font-size: 22px;
            font-weight: lighter;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            text-align: center;
        }
        .stagiaire-info h2{
            font-size: 18px;
            word-spacing: 4px;
            letter-spacing: 2px;
            text-align: center;
            
        }
        .stagiaire-info h2 b{
            font-weight: 400;
            word-spacing: 4px;
            letter-spacing: 1px;
            color: #59affa;
        }
        h5{
            font-weight: 400;
            color: lightgray;
            text-align: center;
        }
        body{
            background: #f8f9fa;
            margin-bottom: -20%;
        }
        .info-section {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
            margin-top: 8px;
            margin-left: 5%;
            width: 220%;
            justify-content: space-between;
        }
        .info-section h4 {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 17px;
            
        }
        .info-section p {
            margin-right: -85%;
            margin-bottom: 15px;

        }
        .info-section .row > div {
            display: flex;
            justify-content: space-between;
            margin-left: 5%;
        }
        .nav-tabs{
            margin-left: 6%;
            margin-right: -20%;
        }
        .nav-tabs .nav-link.active {
            background-color: #59affa;
            color: #fff;
        }
        .nav-tabs .nav-link { 
            color: #59affa; 
        }
        .conteneur{
            margin-left: 22%;
        }
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
        }
        #professionnelles{
            width: 19%;
            margin-left: 44%;
            margin-top: -22%;
            height: 350px;
        }
        h3{
            margin-left: 23%;
            margin-bottom: 1%;
        }
        footer{
            background: #f8f9fa;
            height: 250px;
            margin-top: -7%;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-dark navbar-expand-sm justify-content-end">
        
        <button class="navbar-toggler"  data-bs-toggle="collapse" data-bs-target="#nav1" >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav1">
        <ul class="navbar-nav">
            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle admin" data-bs-toggle="dropdown" href="#">Administrator : <img id="user" src="<?php echo 'Users/'.$data['Photoprofil']; ?>" alt="User picture"> <?php echo $data['nom']." ".$data['prenom'] ?></a>
                <ul class="dropdown-menu">
                <li><a href="showAdministratorInfp.php" class="dropdown-item">Show my informations</a></li>
                     <li><a href="editpassword Admin.php" class="dropdown-item">Modifay Password</a></li>
                     <li><a href="logout.php" class="dropdown-item">Log Out</a></li>
                </ul>
            </li>
            
        </ul>
        </div>
        <?php include('toggle.html') ;?>
    </nav>
    
    
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
    <a href="espace administrateur.php" id="back"><img src="images/back.png" style="width: 20px;height:20px;" alt="">Back</a>
    <br>
    <h3>More informations</h3>
    <div class="d-flex conteneur">
    <div class="stagiaire-info">
            <br>
            <img src="<?php echo 'Users/'.$donne['PhotoProfil'];  ?>" alt="" width="120px" height="120px">
            <h4><?php echo $donne['nom']." ".$donne['prenom']; ?></h4>
            <h5>Trainee</h5>
            <hr>
            <h2>School: <b>Digital Learning School</b></h2>
            <hr>
            <h2 style="margin-bottom:13px;margin-left:4%;text-align:start;">Type: <b>Trainee</b></h2>

        </div>
        <div class=""> 
            <ul class="nav nav-tabs d-flex"> 
                <li class="nav-item"> <a class="nav-link active" aria-current= "page" href="#" data-target="#personnelles">Personal</a> </li> 
                <l class="nav-item"> <a class="nav-link" href="#" aria-current="page" data-target="#professionnelles">Professional</a> </li> 
                
            </ul> 
            <div id="personnelles" class="tab-content active">
                    <div class="info-section"> 
                        <div class="row"> 
                            <div class="col-md-6"> 
                                <h4>Last Name :</h4> <p><?php echo $donne['nom']; ?></p> 
                            </div> 
                            
                    </div> 
                    <div class="row"> 
                        <div class="col-md-6"> 
                            <h4>First Name :</h4> <p><?php echo $donne['prenom']; ?></p> 
                        </div> 
                    </div> 
                    <div class="row"> 
                        <div class="col-md-6"> <h4>CIN :</h4> <p><?php echo $donne['cin']; ?></p> 
                    </div> 
            </div> 
            <div class="row"> 
                <div class="col-md-6"> 
                    <h4>Date of Birth :</h4> <p><?php echo $donne['DateNaissance']; ?></p> 
                </div> 
            </div> 
            <div class="row"> 
                <div class="col-md-6"> 
                    <h4>Adress :</h4> <p><?php echo $donne['address']; ?></p> 
                </div> 
            </div>
            <div class="row"> 
                <div class="col-md-6"> 
                    <h4>City :</h4> <p><?php echo $donne['city']; ?></p> 
                </div> 
            </div>
            <div class="row"> 
                <div class="col-md-6"> 
                    <h4>Phone Number :</h4> <p><?php echo $donne['numero_telephone']; ?></p> 
                </div> 
            </div>
            </div> 
        </div> 
                
        </div>
            </div>
            <div id="professionnelles" class="tab-content">
            <div class="info-section">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Registration Number :</h4>
                        <p><?php echo $donne['numeroInscription'] ?></p>
                    </div>
                    <div class="col-md-6">
                        <h4>Field of Study</h4>
                        <p><?php echo $donne['idFiliere']; ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h4>School:</h4>
                        <p>Digital Learning School</p>
                    </div>
                    <div class="col-md-6">
                        <h4>Registration Date:</h4>
                        <p><?php echo $donne['DateInscription'];?></p>
                    </div>
                    <div class="col-md-6">
                        <h4>Email:</h4>
                        <p><?php echo $donne['email'];?></p>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <footer>

        </footer>            
    <script>
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            document.querySelectorAll('.nav-link').forEach(item => {
                item.classList.remove('active');
            });
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });
            this.classList.add('active');
            document.querySelector(this.getAttribute('data-target')).classList.add('active');
        });
    });
</script>
    </body>
    </html>