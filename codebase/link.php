<?php
    # Development Credentials :
    $host="localhost";
    $userName="amar";
    $password="webadvisor@0401";
    $dbName="neighbour";  

    $link=mysqli_connect($host,$userName,$password,$dbName);
    if(mysqli_connect_error()){
        echo "Unable to connect to database .Please try again later .";
    }
    $key='a7ef5fd194eb48c2afcb2a80ba214ed2';
?>
