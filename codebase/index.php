<?php
    include("functions.php");
    if(!(isset($_GET['page']))){
        $_GET['page']="";
    }
    if(!(isset($_SESSION['id']))){
        $_SESSION['id']=NULL;
    }
    include("Header.php");
    
    if($_GET['page']=="search"){
        include("search.php");
    }else if($_GET['page']=="login"){
         include("login.php");
    }else if($_GET['page']=="profile"){
        include("details.php");
    }else  if($_GET['page']=="contact"){
        include("contact.php");
    }else {
         include("Home.php");
    }
    include("Footer.php");

?>