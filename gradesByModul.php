<?php 
    require('connexion.php');
    $id=$_GET['id'];
    $ret=$connexion->prepare("SELECT p.sigle, p.natureExam, p.note,m.description FROM passerexam p
        INNER JOIN module m ON p.sigle = m.sigle WHERE p.numeroInscription =".$id);
    $ret->execute();
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Grades</title>
    <link rel="stylesheet" href="bootstrap-5.2.2-dist/css/bootstrap.min.css">
    <style>
        table{
            margin-top: 60px;
        }
        table tr:first-child {
            background-color: #f8f9fa; 
            color: #343a40; 
        }
        td {
            background-color: #ffffff; 
        }
        h1{
            font-size: 32px;
            font-weight: lighter;
            text-align: center;
            color: #22D1EE;
            margin-top: 55px;
        }
        a{
            font-size: 22px;
            text-decoration: none;
            color: black;
        }
        a:hover{
            color: #4895EF;
        }
        p{
            text-align: end;
            margin-right: 3%;
        }
        p img {
            width: 25px;
            height: 25px;
            margin-right: 4px;
        }
        .retour a {
            text-decoration: none;
            color: #18A3B7;
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
    <h1>Grades By Modul</h1>
    <div class="retour">
        <a href="<?php echo "espace stagiaire.php" ?>">
                &#8592; back </a>
    </div>
    <table class="table">
        <tr>
            <th>Sigle</th>
            <th>Description</th>
            <th>Nature of Exam</th>
            <th>Grade</th>
            
        </tr>
        <?php  while($ligne = $ret->fetch()){ ?>
            <tr>
                <td><?php echo $ligne['sigle']; ?></td>
                <td><?php echo $ligne['description'] ?></td>
                <td><?php echo $ligne['natureExam']; ?></td>
                <td><?php echo $ligne['note']; ?></td>
            </tr>
        
        <?php } ?>
    </table>
</body>
</html>