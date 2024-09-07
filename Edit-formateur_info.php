<?php 
    require("connexion.php");
    $id = $_GET['id'];


$resq = $connexion->prepare("
    SELECT 
        c.nom,
        c.prenom,
        f.DateNaissance,
        f.Photoprofil,
        f.numero_telephone,
        f.cin,
        f.adress,
        f.city,
        f.Date_Embauche,
        f.email,
        f.idFiliere,
        f.matricule_formateur,
        f.Affectaion,
        c.password
    FROM compte c
    INNER JOIN formateur f ON f.email = c.email
    WHERE f.matricule_formateur = :id
");

$resq->execute(['id' => $id]);
$result = $resq->fetch(PDO::FETCH_ASSOC); 

// var_dump($result); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Trainer informations</title>
    <style>
        form{
            border-radius: 10px;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);
            padding: 10px;
            width: 30%;
            padding-top: 3%;
            margin-left: 34%;
        }
        input{
            width: 70%;
            margin-left: 13%;
            margin-bottom: 18px;
            height: 36px;
            border: 1px solid lightgray;
            border-radius: 10px;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            font-size: 16px;

        }
        #btn{
            background-color: #f9b412;
            color: white;
            width: 22%;
            font-size: 18px;
            margin-top: 5%;
        }
        label{
            margin-bottom: 4px;
            margin-left: 13%;
        }
        h2{
            text-align: center;
            font-weight: lighter;
            margin-bottom: 40px;
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
    <div>
    <form action="Edit_formateur_info_Action.php" method="post" enctype="multipart/form-data">
        <div class="retour">
            <a href="<?php echo "List of Trainers.php" ?>">
                    &#8592; back </a>
        </div>
        <h2>Edit Your Inforamations</h2>
        <label for="">Registration Number of Trainer:</label><br>
        <input type="text" name="nbreg" id="" value="<?php echo $result['matricule_formateur']; ?>" readonly><br>

        <label for="">Last Name:</label><br>
        <input type="text" name="nom" id="" value="<?php echo $result['nom']; ?>"><br>

        <label for="">First Name:</label><br>
        <input type="text" name="prenom" id="" value="<?php echo $result['prenom']; ?>"><br>

        <label for="">Date of Birth:</label><br>
        <input type="date" name="birth" id="" value="<?php echo $result['DateNaissance']; ?>"><br>

        <label for="">Registration Date:</label><br>
        <input type="date" name="regd" id="" value="<?php echo $result['Date_Embauche']; ?>" readonly><br>

        <input type="hidden" name="p1" value="<?php echo $result['Photoprofil']; ?>">
        <label for="">Profil Picture:</label><br>
        <input type="file" name="photo" id=""><br>

        <label for="">CIN:</label><br>
        <input type="text" name="cin" id="" value="<?php echo $result['cin']; ?>"><br>

        <label for="">Address:</label><br>
        <input type="text" name="adrs" id="" value="<?php echo $result['adress']; ?>"><br>

        <label for="">City:</label><br>
        <input type="text" name="city" id="" value="<?php echo $result['city']; ?>"><br>

        <label for="">Phone Number: </label><br>
        <input type="tel" name="phone" id="" value="<?php echo $result['numero_telephone']; ?>"><br>

        <label for="">Email: </label><br>
        <input type="email" name="mail" id="" value="<?php echo $result['email']; ?>" readonly><br>

        <label for="">Speciality:</label><br>
        <input type="text" name="fil" id="" value="<?php echo $result['idFiliere']; ?>" readonly><br>

        <label for="">School:</label><br>
        <input type="text" name="spec" id="" value="<?php echo $result['Affectaion']; ?>" readonly><br>

        <label for="">PassWord:</label><br>
        <input type="text" name="pword" id="" value="<?php echo $result['password']; ?>"><br>

        <input type="submit" value="Edit" id="btn">
    </form>
    </div>
</body>
</html>