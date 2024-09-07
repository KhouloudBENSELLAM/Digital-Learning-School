<?php 
    require("connexion.php");
    $reqset=$connexion->prepare("SELECT * FROM formateur WHERE matricule_formateur=? ");
    $reqset->execute(array($_GET['MF']));
    $donne=$reqset->fetch();

    $reqt=$connexion->prepare("SELECT * from filiere");
    $reqt->execute();

    $reqte=$connexion->prepare("SELECT administrateur.nom,administrateur.prenom,administrateur.Photoprofil FROM Compte
INNER JOIN administrateur ON Compte.email = administrateur.email");
 
$reqte->execute();
$data = $reqte->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            margin-left: 310%;
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
            margin-left: 82%;
            margin-top: 4%;
            border: 2px solid lightgray;
            padding-left: 0.7%;
            padding-right: 0.7%;
            padding-top: 0.3%;
            padding-bottom: 0.3%;
        }
        form{
            margin-left: 4%;
        }
        form div{
            display: flex;
            margin-left: -19%;
        }
        form div span:not(#fileinp){
            margin-left: 22%;
            margin-bottom: 14px;
        }
        form div span input{
            width: 220%;
            height: 60px;
            border: 1px solid lightgray;
            border-radius: 10px;
            padding-left: 6.5%;
        }
        label{
            font-weight: 400;
            font-size: 18px;
            margin: 4px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        fieldset {
            border: 1px solid #ccc;
            padding-top: 15px;
            margin-left: 14%;
            margin-right: 13%;
        
        }
        legend {
            font-weight: 500;
            color: gray;
            padding: 2px 4px;
            display: block;
            visibility: visible;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            margin-left: 3%;
            margin-bottom: 16px;
        }
        #fileinp input{
            margin-left: 7%;
            border: 1px solid lightgray;
            border-radius: 10px;
            padding: 1.2%;
            width: 38%;
            height: 60px;
        }
        #fileinp label{
            margin-left: 7%;
        }
        input[type="date"]:not(#datem){
            width:290%;
            border: 1px solid lightgray;
            border-radius: 10px;
            padding-left: 8.5%;
        }
        #datem{
            width: 181%;
            margin-left: 4%;
            height: 51px;
            border: 1px solid lightgray;
            border-radius: 10px;
            padding-left: 1.5%;
        }
        select{
            height: 60px;
            width: 245%;
            border: 1px solid lightgray;
            border-radius: 10px;
            padding-left: 3.5%;
            margin-top: 8px;
            margin-left: -28%;

        }
        h2{
            font-weight: lighter;
            font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            color: white;
            background: #4ADDEC;
            padding: 1%;
            width: 70%;
            margin-left: 17.5%;
            margin-bottom: -1px;
        }
        footer{
            margin-left: 14%;
            background: #f8f9fa;
            margin-right: 13%;
            padding-top: 1%;
            margin-top: -23px;

        }
        footer div{
            display: flex;
            margin-left: 75%;
            margin-bottom: 45px;
            margin-top: 8px;
            
        }
        footer div button{
            width: 40%;
            margin-left: 6%;
            font-size: 20px;
            font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            height: 45px;
            border: 1px solid lightgray;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        footer div button:nth-child(1){
            color: #4ADDEC;
        }
        footer button:nth-child(2){
            background: #4ADDEC;
            color: white;
        }
        .retour a {
            text-decoration: none;
            color: #18A3B7;
            font-weight: bold;
            align-items: center;
            display: flex;
            margin-left: 17%;
            margin-bottom: 13px;
            font-size: 18px;
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
    <div class="retour">
            <a href="<?php echo "List of Trainers.php" ?>">
                    &#8592; back </a>
    </div>    <br>
    <br>
    <h2><img src="icons/edit (1).png" alt=""  style="width: 32px;height:33px;" > Edit Trainer Informations</h2>
    <form action="modifierFormateur Action.php" enctype="multipart/form-data" method="post">
        <fieldset>
            <legend><img src="Users pic/user.png" alt="" width="25px" height="25px" style="margin-top:-5px;"> Personnal  Informations</legend>
            <div>
                <span>
                    <label for="">Last Name:</label><br>
                    <input type="text" name="nom" id="" value="<?php echo $donne['nom']; ?>"><br>
                </span>

                <span>
                    <label for="">First Name:</label><br>
                    <input type="text" name="prenom" id="" value="<?php echo $donne['prenom']; ?>"><br>
                </span>
            </div>
            
            <div>
                <span>
                    <label for="">Cin:</label><br>
                    <input type="text" name="cin" id="" value="<?php echo $donne['cin']; ?>"><br>
                </span>

                <span>
                    <label for="">Date of Birth: </label><br>
                    <input type="date" name="dateN" id="" value="<?php echo $donne['DateNaissance']; ?>"><br>
                </span>
            </div>
            
            <div>
                <span>
                    <label for="">Phone Number: </label><br>
                    <input type="tel" name="phone" id="" value="<?php echo $donne['numero_telephone']; ?>"><br>
                </span>
                
                <span>
                    <label for="">Email: </label><br>
                    <input type="email" name="mail" id="" value="<?php echo $donne['email']; ?>"><br>
                </span>
            </div>

            <div>
                <span>
                    <label for="">Adress: </label><br>
                    <input type="text" name="adrs" id="" value="<?php echo $donne['adress']; ?>"><br>
                </span>
                
                <span>
                    <label for="">City: </label><br>
                    <input type="text" name="city" id="" value="<?php echo $donne['city']; ?>"><br>
                </span>
            </div>
            
            <span id="fileinp">
                <input type="hidden" name="p1" value="<?php echo $donne['Photoprofil']; ?>">
                <label for="">Picture: </label><br>
                <input type="file" name="photo" id=""placeholder="Select a picture"><br>
            </span>
            
            <br><br>
            <legend><img src="Users pic/businessman.png" alt="" width="25px" height="25px" style="margin-top:-5px;"> Professional Informations</legend>
            <div>
                <span>
                    <label for=""style="margin-bottom:12px;">Registration Number of Trainer: </label><br>
                    <input type="text" name="matriculeF" disabled id="" value="<?php echo $donne['matricule_formateur']; ?>" style="width:157%;height:60px;"><br>
                </span>
                
                <span>
                    <label for="">Speciality: </label><br>
                    <select name="filiere" id="" placeholder="Select a field of study">
                        <?php 
                            while($ligne=$reqt->fetch()){ ?>
                                <option value="<?php echo $ligne['idFiliere']; ?>" <?php  if($ligne['idFiliere']==$donne['idFiliere']) echo "selected";       ?>></option>><?php echo $ligne['libelle'] ?></option>
                            <?php } ?>
                    </select><br>
                </span>
            </div>
            <div>
                <span >
                    <label for="">Hiredate: </label><br>
                    <input type="date" name="dateEmb" id="datem" style="width: 298%;height:60px;" value="<?php echo $donne['DATE_Embauche']; ?>"><br>
                </span>
                <span style="margin-left: 28.5%;">
                    <label for="">Assignment: </label><br>
                    <input type="text" name="ecole" value="<?php echo $donne['Affectaion']; ?>" disabled><br>
                </span>
            </div>
                
            <br>
            <br>
        </fieldset>
        <br>
        <footer>
            <div>
                <button type="reset" name="cancel">Cancel</button>
                <button type="submit" name="edit">Edit</button>
            </div>
        </footer>

    </form>
</body>
</html>