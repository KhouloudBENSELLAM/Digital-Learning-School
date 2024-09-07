<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="slider.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="footer.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="loading.css?v=<?php echo time(); ?>">
    <script src="bootstrap-5.2.2-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="bootstrap-5.2.2-dist/css/bootstrap.min.css">
    <script src="bootstrap-5.2.2-dist/js/bootstrap.bundle.min.js"></script>

    <style>
        
        #content {
            display: none;
        }
        ul li{
            margin-left: 5%;
        }
    </style>
</head>
<body>
    <div id="loading">
    <section>
        <main>
            <div class="conteneur3">
                <div class="ring"></div>
                <div class="ring"></div>
                <div class="ring"></div>
                <p>Loading...</p>
            </div>
        </main>
    </section>
    </div>
    <div id="content">
    <div id="container">
    <nav id="#" class="navbar  navbar-dark navbar-expand-sm nav_bar ">
        <div><img src="images/logo.png" class="navbar-brand" alt=""></div>
        <button class="navbar-toggler"  data-bs-toggle="collapse" data-bs-target="#nav1">
            Menu<span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav1">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="Home.Php" id="home">Home</a></li>
            <li class="nav-item"><a id="ABOUT" class="nav-link" href="#AboutUs">About&nbsp;&nbsp;Us</a></li>
            <li class="nav-item"><a class="nav-link" href="#footer">Contact&nbsp;&nbsp;Us</a></li>
            <li class="nav-item"><a class="nav-link" href="Inscrption.php">Regester</a></li>
            <li  class="nav-item div1 "><a class="nav-link" href="login .php" id="login">Login</a></li>
           
        </ul>
    </nav>
    
        
    </div>
    <h1 id="AboutUs">About Us</h1>
    <aside>
        <span id="pictures">
            <img  src="images/shcool.webp" alt="" width="330px" height="190px">
            <img id="aboutimg" src="images/logo school.png" width="330px" height="190px">
        </span>
        
        <div>
            <p>
                Digital Learning is a school dedicated to teaching essential digital skills in today's world.
                It offers a variety of programs and courses in areas such as   web development, cybersecurity ,UI/UX design  and cloud computing. 
                The school aims to prepare its students to become competent and versatile professionals, capable of adapting to the rapidly changing technology landscape.
                Digital Learning stands out for its practical teaching approach, which includes interactive  workshops, collaborative projects, and internships to provide an immersive and relevant learning experience.
            </p>
        </div>
    </aside>  
    <br><br>
    <br>
    <h1 id="gallery">Gallery</h1>
    <p id="galparag">
        The school gallery features photos of various spaces, including classrooms, labs, the
        library, sports facilities, the auditorium, common areas, and outdoor spaces, offering a 
        visual tour of the school's vibrant environment.
    </p>
    <div id="slider">
        <?php include("slideShow.html"); ?>
    </div>
    
    <br>
    <br>
    <h1>Registration</h1>
    <article>
        <img src="images/register pic.webp" alt="" style="margin-top:40px;">
        <p>
        "Get ready for an exciting digital career with Digital Learning! 
        Enroll today to take advantage of our cutting-edge courses in web 
        development, cybersecurity, UI/UX design, and cloud computing. 
        Our practical, industry-focused programs will prepare you to succeed
        in the ever-evolving digital world. Join us to acquire the skills you
        need to excel in the digital field!"
        </p>
        <div id="btnreg"><a href="Inscrption.php" id="register">Register Now</a></div>
    </article>

    <h1>Review Us</h1>
    <form action="">
        <input type="text" name="fullname" id="" placeholder="Full Name"><br>
        <input type="email" name="mail" id="" placeholder="Email"><br>
        <textarea name="review" id="" placeholder="Write your review here"></textarea>
    </form>
    <br>
    <div id="footer"><?php include("footer.php") ?></div>
    <script src="Slider.js"></script>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.addEventListener('load', function() {
                setTimeout(function () {
            var loader = document.getElementById('loading');
            var content = document.getElementById('content');

            loader.style.display = 'none';

            content.style.display = 'block';
    }, 3000);
            });
        });
    </script>
    
</body>
</html>