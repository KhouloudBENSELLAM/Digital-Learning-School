<?php 
    session_start();
    require("connexion.php");
    $reqt=$connexion->prepare("SELECT * from filiere");
    $reqt->execute();

    
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
    <title>Document</title>
    <link rel="stylesheet" href="menu.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./assets/css/formateur-styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="bootstrap-5.2.2-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="bootstrap-5.2.2-dist/css/bootstrap.min.css">
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
            margin-left: 11%;
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
            height: 51px;
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
            width: 40%;
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
            width: 41%;
            margin-left: 4%;
            height: 51px;
            border: 1px solid lightgray;
            border-radius: 10px;
            padding-left: 1.5%;
        }
        select{
            height: 51px;
            width: 235%;
            border: 1px solid lightgray;
            border-radius: 10px;
            padding-left: 3.5%;

        }
        h2{
            font-weight: lighter;
            font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            color: white;
            background: #509FE4;
            padding: 1%;
            width: 64.9%;
            margin-left: 23.5%;
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
            color: #509FE4;
        }
        footer button:nth-child(2){
            background: #509FE4;
            color: white;
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
    <h2><img src="Users pic/add-user.png" alt=""  style="width: 32px;height:33px;" > Add  A  Trainee</h2>


    <form action="AjouterStgAction.php" enctype="multipart/form-data" method="post" id="traineeForm">
        <fieldset>
            <legend><img src="Users pic/user.png" alt="" width="25px" height="25px" style="margin-top:-5px;"> Personnal  Informations</legend>
            <div>
                <span>
                    <label for="">Last Name:</label><br>
                    <input type="text" name="nom" id="" placeholder="Enter your last name"><br>
                </span>

                <span>
                    <label for="">First Name:</label><br>
                    <input type="text" name="prenom" id="" placeholder="Enter your first name"><br>
                </span>
            </div>
            
            <div>
                <span>
                    <label for="">Cin:</label><br>
                    <input type="text" name="cin" id="" placeholder="Enter your CIN"><br>
                </span>

                <span>
                    <label for="">Date of Birth: </label><br>
                    <input type="date" name="dateN" id=""><br>
                </span>
            </div>
            
            <div>
                <span>
                    <label for="">Phone Number: </label><br>
                    <input type="tel" name="phone" id="" placeholder="Enter your phone number"><br>
                </span>
                
                <span>
                    <label for="">Email: </label><br>
                    <input type="email" name="mail" id="" placeholder="Enter your email"><br>
                </span>
            </div>

            <div>
                <span>
                    <label for="">Adress: </label><br>
                    <input type="text" name="adrs" id="" placeholder="Enter your adress"><br>
                </span>
                
                <span>
                    <label for="">City: </label><br>
                    <input type="text" name="city" id="" placeholder="Enter your city"><br>
                </span>
            </div>
            
            <span id="fileinp">
                <label for="">Picture: </label><br>
                <input type="file" name="photo" id=""placeholder="Select a picture"><br>
            </span>
            
            <br><br>
            <legend><img src="Users pic/businessman.png" alt="" width="25px" height="25px" style="margin-top:-5px;"> Professional Informations</legend>
            <div>
                <span>
                    <label for="">Registration Number: </label><br>
                    <input type="text" name="nbrReg" id="" placeholder="Enter your adress"><br>
                </span>
                
                <span>
                    <label for="">Field of Study: </label><br>
                    <select name="filiere" id="" placeholder="Select a field of study">
                        <?php 
                            while($ligne=$reqt->fetch()){ ?>
                                <option value="<?php echo $ligne['idFiliere']; ?>"><?php echo $ligne['libelle'] ?></option>
                            <?php } ?>
                    </select><br>
                </span>
            </div>
            <span id="fileinp">
                <label for="">Registration date: </label><br>
                <input type="date" name="dateEm" id="datem" ><br>
            </span>
            <br>
            <br>
        </fieldset>
        <br>
        <footer>
            <div>
                <button type="reset" name="cancel">Cancel</button>
                <button type="submit" name="Add" id="addButton">Add</button>
            </div>
            
        </footer>

    </form>
    <script src="bootstrap-5.2.2-dist/js/bootstrap.bundle.min.js"></script>
    <?php 
        if(isset($_GET['msg'])){ ?>
        <script>
            alert("<?php echo $_GET['msg']; ?>")
        </script>
       <?php }?>

    <?php if(isset($_GET['msge'])){ ?>
        <p class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $_GET['msge']; ?>
        </p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <?php }?>
    <script src="./assets/js/jquery-3.7.1.min.js"></script>
    <script src="./assets/js/formateur-script.js"></script>
</body>
</html>