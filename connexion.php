<?php 
    try{
        $connexion=new PDO("mysql:host=localhost;dbname=digital_learning;port=3306","root","");
        return;
    
    }
    catch(Exception $e){
        echo $e;
    }
?>