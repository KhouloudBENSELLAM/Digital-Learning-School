<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        article{
            margin-left: 36%;
            margin-top: 13%;
        }
        #div1{
            background-color: #4b5a6cf7;
            width: 42%;
            height: 60px;
            text-align: center;
            padding-top: 1.4%;
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
            height: 60px;
            text-align: center;
            padding-top: 1.4%;
            margin-bottom: 20px;
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
            height: 60px;
            text-align: center;
            padding-top: 1.4%;
            border-radius: 10px;
            box-shadow: 10px 10px 20px rgba(0,0,0,0.5) ;
        }
        #div3 a{
            color: white;
            font-size: 32px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <?php include('menu.html');  ?>
    <?php include('toggle.html') ;?>
    <article>
        <div id="div1"><a href="login administrator.php">Administrator</a></div>
        <div id="div2"><a href="login trainer.php">Trainer</a></div>
        <div id="div3"><a href="login  trainee.php">Trainee</a></div>
    </article>
</body>
</html>