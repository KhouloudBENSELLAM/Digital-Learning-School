<?php 
    require("connexion.php");
    $id=$_GET['id'];
    $reqs=$connexion->prepare("SELECT * FROM formateur where matricule_formateur= :id");
    $reqs->bindParam(':id', $id);
    $reqs->execute();
    $donnee = $reqs->fetch();

    $reqste=$connexion->prepare("SELECT administrateur.nom,administrateur.prenom,administrateur.Photoprofil FROM Compte
    INNER JOIN administrateur ON Compte.email = administrateur.email");
    $reqste->execute();
    $donne = $reqste->fetch();


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
            color: #f9b412;
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
            background-color: #f9b412;
            color: #fff;
        }
        .nav-tabs .nav-link { 
            color: #f9b412; 
        }
        .conteneur{
            margin-left: 8%;
        }
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
        }
        #professionnelles{
            width: 23%;
            margin-left: 34%;
            margin-top: -33%;
            height: 350px;
        }
        h3{
            margin-left: 5%;
            margin-bottom: 1%;
        }
        
        #container{
            margin-left: 17%;
            margin-right: 13%;
            margin-top: 60px;
            padding-top: 3%;
            height: 580px;
            border-radius: 10px;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);

        }
        .retour a {
            text-decoration: none;
            color: #f9b412;
            font-weight: bold;
            align-items: center;
            display: flex;
            margin-left: 4%;
            margin-bottom: 13px;
            font-size: 18px;
        }
    </style>
</head>
<body>

    
    
    
    
    <br>
    <div>
    <div id="container">
    <div class="retour">
        <a href="<?php echo "List of Trainers.php" ?>">
                &#8592; back </a>
    </div>
    <h3>More informations</h3>
    <div class="d-flex conteneur">
    <div class="stagiaire-info">
            <br>
            <img src="<?php echo 'Users/'.$donnee['Photoprofil'];  ?>" alt="" width="120px" height="120px">
            <h4><?php echo $donnee['nom']." ".$donnee['prenom']; ?></h4>
            <h5>Trainer</h5>
            <hr>
            <h2>School: <b><?php echo $donnee['Affectaion']; ?></b></h2>
            <hr>
            <h2 style="margin-bottom:13px;margin-left:4%;text-align:start;">Type: <b>Trainer</b></h2>

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
                                <h4>Last Name :</h4> <p><?php echo $donnee['nom']; ?></p> 
                            </div> 
                            
                    </div> 
                    <div class="row"> 
                        <div class="col-md-6"> 
                            <h4>First Name :</h4> <p><?php echo $donnee['prenom']; ?></p> 
                        </div> 
                    </div> 
                    <div class="row"> 
                        <div class="col-md-6"> <h4>CIN :</h4> <p><?php echo $donnee['cin']; ?></p> 
                    </div> 
            </div> 
            <div class="row"> 
                <div class="col-md-6"> 
                    <h4>Date of Birth :</h4> <p><?php echo $donnee['DateNaissance']; ?></p> 
                </div> 
            </div> 
            <div class="row"> 
                <div class="col-md-6"> 
                    <h4>Adress :</h4> <p><?php echo $donnee['adress']; ?></p> 
                </div> 
            </div>
            <div class="row"> 
                <div class="col-md-6"> 
                    <h4>City :</h4> <p><?php echo $donnee['city']; ?></p> 
                </div> 
            </div>
            <div class="row"> 
                <div class="col-md-6"> 
                    <h4>Phone Number :</h4> <p><?php echo $donnee['numero_telephone']; ?></p> 
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
                        <p><?php echo $donnee['matricule_formateur'] ?></p>
                    </div>
                    <div class="col-md-6">
                        <h4>Spécialité</h4>
                        <p><?php echo $donnee['idFiliere']; ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h4>School:</h4>
                        <p>Digital Learning School</p>
                    </div>
                    <div class="col-md-6">
                        <h4>Registration Date:</h4>
                        <p><?php echo $donnee['DATE_Embauche'];?></p>
                    </div>
                    <div class="col-md-6">
                        <h4>Email:</h4>
                        <p><?php echo $donnee['email'];?></p>
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