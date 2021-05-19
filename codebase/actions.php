<?php 
    include("functions.php");
    $error="";

    // Sign In Section
    if($_GET["process"]=="signIn"){
        if(!$_POST["usernameIn"]){
            $error="A Username is required. ";
        }else if(!$_POST["passwordIn"]){
            $error="A Password is required. ";
        }
        if($error!=""){
            echo $error;
            exit();
        }
        // Signing in the user after checking
        $query="SELECT * FROM `users` WHERE `email` = '".mysqli_real_escape_string($link,$_POST['usernameIn'])."' OR `name`='".mysqli_real_escape_string($link,$_POST['usernameIn'])."' LIMIT 1";
        $result=mysqli_query($link,$query);
        if($result){
            $row=mysqli_fetch_assoc($result);
            if($row['password']==md5(md5($row['id']).$_POST['passwordIn'])){
                echo 1;
                $_SESSION['id']=$row['id'];
            }else{
                $error="Could not find that Username-Password Combination ! Please try Again !";
            }
        }
        if($error!=""){
            echo $error;
            exit();
        }
        
    }


    // Sign Up Section
    if($_GET["process"]=="signUp"){
        if(!$_POST["usernameUp"]){
            $error="A Username is required. ";
        }else if(!$_POST["email"]){
            $error="An Email is required. ";
        }else if(!$_POST["passwordUp"]){
            $error="A Password is required. ";
        }else if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)===false){
            $error= "Please enter a Valid email address";
        }

        
        if($error!=""){
            echo $error;
            exit();
        }
        
        // Checking if the Signing Up input email is already taken
        $query="SELECT * FROM `users` WHERE `email` = '".mysqli_real_escape_string($link,$_POST['email'])."' LIMIT 1";
        $result=mysqli_query($link,$query);
        
        if($result && mysqli_num_rows($result)>0){
            $error="This Email id is already taken !";
        }else{
            // Siging up if no errors found
            $query="INSERT INTO `users` (`name`,`email`,`password`) VALUES ('".mysqli_real_escape_string($link,$_POST['usernameUp'])."','".mysqli_real_escape_string($link,$_POST['email'])."','".mysqli_real_escape_string($link,$_POST['passwordUp'])."')";
            if(mysqli_query($link,$query)){
                $_SESSION['id']=mysqli_insert_id($link);
                // Password Hashing
                $query="UPDATE `users` SET `password` = '".md5(md5($_SESSION['id']).$_POST['passwordUp'])."' WHERE `id`=".$_SESSION['id']." LIMIT 1";
                mysqli_query($link,$query);
                echo 1;
            }else{
                $error="Couldn't Create User - Please try again later ";
            }
        }
        if($error!=""){
            echo $error;
            exit();
        }

    }

    // Profile Set Up ::
    if($_GET["process"]=="profileSetUp"){
        // print_r($_POST);
        // echo $_SESSION['id'];

        // Managing Prsnl Info ::
        
            $existCheck="SELECT `userId` FROM `info` WHERE `userId` = '".mysqli_real_escape_string($link,$_SESSION['id'])."' LIMIT 1";
            $resultEC=mysqli_query($link,$existCheck);
            if($resultEC && mysqli_num_rows($resultEC)>0){
                $updatingInfo="UPDATE `info`
                    SET `fname`='".mysqli_real_escape_string($link,$_POST['fname'])."',
                        `lname`='".mysqli_real_escape_string($link,$_POST['lname'])."',
                        `career`='".mysqli_real_escape_string($link,$_POST['career'])."',
                        `further`='".mysqli_real_escape_string($link,$_POST['further'])."',
                        `organisation`='".mysqli_real_escape_string($link,$_POST['organisation'])."',
                        `phone`='".mysqli_real_escape_string($link,$_POST['phone'])."',
                        `dob`='".mysqli_real_escape_string($link,$_POST['dob'])."',
                        `bio`='".mysqli_real_escape_string($link,$_POST['bio'])."'
                    WHERE `userId`='".mysqli_real_escape_string($link,$_SESSION['id'])."'";
                $resultInfo=mysqli_query($link,$updatingInfo);
                echo "1"; 
            }else{
                $insertingInfo="INSERT into `info` (`userId`,`fname`,`lname`,`career`,`further`,`organisation`,`phone`,`dob`,`bio`) 
                VALUES ('".mysqli_real_escape_string($link,$_SESSION['id'])."',
                        '".mysqli_real_escape_string($link,$_POST['fname'])."',
                        '".mysqli_real_escape_string($link,$_POST['lname'])."',
                        '".mysqli_real_escape_string($link,$_POST['career'])."',
                        '".mysqli_real_escape_string($link,$_POST['further'])."',
                        '".mysqli_real_escape_string($link,$_POST['organisation'])."',
                        '".mysqli_real_escape_string($link,$_POST['phone'])."',
                        '".mysqli_real_escape_string($link,$_POST['dob'])."',
                        '".mysqli_real_escape_string($link,$_POST['bio'])."')";
                $resultInfo=mysqli_query($link,$insertingInfo);
                echo "1";          
            }

        // Address Geocoding :: 
        require "vendor/autoload.php";
        
        $geocoder = new \OpenCage\Geocoder\Geocoder($key);
        $result = $geocoder->geocode($_POST["city"] .','.$_POST["state"].','.$_POST["pin"]);
        if ($result['total_results'] > 0) {
            $first = $result['results'][0];
            # print $first['geometry']['lng'] . ';' . $first['geometry']['lat'] . ';' .$_SESSION['id'] ."\n";
            # 4.360081;43.8316276;6 Rue Massillon, 30020 Nîmes, Frankreich

            $existAdd="SELECT `userId` FROM `address` WHERE `userId` = '".mysqli_real_escape_string($link,$_SESSION['id'])."' LIMIT 1";
            $resultAdd=mysqli_query($link,$existAdd);
            if($resultAdd && mysqli_num_rows($resultAdd)>0){    
                $updatingLatLng="UPDATE `address` 
                SET `city`='".mysqli_real_escape_string($link,$_POST['city'])."',
                    `state`='".mysqli_real_escape_string($link,$_POST['state'])."',
                    `pin`='".mysqli_real_escape_string($link,$_POST['pin'])."',
                    `lat`='".mysqli_real_escape_string($link,$first['geometry']['lat'])."',
                    `lng`='".mysqli_real_escape_string($link,$first['geometry']['lng'])."'
                WHERE `userId`=".$_SESSION['id'];
                $resultLatLng=mysqli_query($link,$updatingLatLng);
                echo "1"; 
            }else{
                $insertingLatLng="INSERT into `address` (`userId`,`city`,`state`,`pin`,`lat`,`lng`) 
                VALUES ('".mysqli_real_escape_string($link,$_SESSION['id'])."',
                        '".mysqli_real_escape_string($link,$_POST['city'])."',
                        '".mysqli_real_escape_string($link,$_POST['state'])."',
                        '".mysqli_real_escape_string($link,$_POST['pin'])."',
                        '".mysqli_real_escape_string($link,$first['geometry']['lat'])."',
                        '".mysqli_real_escape_string($link,$first['geometry']['lng'])."')";
                $resultLatLng=mysqli_query($link,$insertingLatLng);
                echo "1";          
            }
        }else{
            $error="Couldn't Access Location Info - Please try again later ";
        }    
        if($error!=""){
            echo $error;
            exit();
        }
    }

    // // Searching 
    if($_GET["process"]=="search"){
        // print_r($_POST); 
        // Geoding Entered Area
        require "vendor/autoload.php"; 
        print_r($_POST["loc"]);
        $geocoder = new \OpenCage\Geocoder\Geocoder($key);
        $result = $geocoder->geocode($_POST["loc"]);
        if ($result && $result['total_results'] > 0) {
            $first = $result['results'][0];
            $lat=$first['geometry']['lat'];
            $lng=$first['geometry']['lng'];
            // print_r($result);
            $sql ="SELECT * FROM (SELECT *, 
                        (
                            (
                                (
                                    acos(
                                        sin(( $lat * pi() / 180))
                                        *
                                        sin(( `lat` * pi() / 180)) + cos(( $lat * pi() /180 ))
                                        *
                                        cos(( `lat` * pi() / 180)) * cos((( $lng - `lng`) * pi()/180)))
                                ) * 180/pi()
                            ) * 60 * 1.1515 * 1.609344
                        )
                    as distance FROM `address`
                ) `address`
                WHERE distance <= 50 
                ORDER BY distance LIMIT 200";
                $resultNear=mysqli_query($link,$sql);     
                $rowNear=mysqli_fetch_all($resultNear);
                if(mysqli_num_rows($resultNear)>0){
                    $_SESSION["num"]=mysqli_num_rows($resultNear);
                }
                    // print_r($rowNear);
                if($rowNear>0){
                    session_start();
                    $_SESSION["searched"]=$rowNear;
                    echo "1";
                }      

               
                //     // session_start();
                //     // $_SESSION['search_id'] = array(1,2,3,4,5,6,7);   
                 
                // //  header('Location:index.php?page=search'); 
                                    
                //     echo '
                //         <div id="search-result">
                //             <div class="map">';


                //                 for ($i=0; $i <=$arraylength; $i++) {
                //                     $x=rand(0,90);
                //                     $r=(int)sqrt(2025-pow($x-45,2));
                //                     $y=rand(-1*$r,$r)+42;
                //                     echo '
                //                     <i class="fas fa-map-marker-alt" alt="mark" data-toggle="modal" data-target="#Modal',$i,'"
                //                     style="color: #c73cc7; font-size: 30px; position: absolute; top:',$y,'%; left:',$x,'%; cursor: pointer;" >
                                    
                //                 </i>
                //                 <div class="modal fade" id="Modal',$i,'" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                //                 <div class="modal-dialog" role="document">
                //                     <div class="modal-content">
                //                     <div class="modal-header">
                //                         <h5 class="modal-title" id="ModalLabel">Name',$i,'</h5>
                //                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                //                         <span aria-hidden="true">&times;</span>
                //                         </button>
                //                     </div>
                //                     <div class="modal-body">
                //                         ...
                //                     </div>
                //                     <div class="modal-footer">
                //                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                //                         <a href="';
                //                             if(isset($_SESSION['id'])){
                //                                 echo "#";
                //                             }
                //                             else
                //                                 echo "index.php?page=login";
                //                         echo '">
                //                             <button type="button" class="btn btn-primary">View Profile</button>
                //                         </a>
                //                     </div>
                //                     </div>
                //                 </div>
                //                 </div>	
                //             ';}
                //             echo '
                //             </div>
                //         </div>';
                // }

                  
	                
                // echo "1";               
        }else{
            $error="Couldn't Access Location Info - Please try again later ";  
        }
        if($error!=""){
            echo $error;
            exit();
        }
    }

?>