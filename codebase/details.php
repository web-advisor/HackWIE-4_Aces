<head>
    <link rel="stylesheet" href="details.css" />  
    <style type="text/css">
        /* body{
            background-color:#14b7ee;
        } */
        .centered{
            margin:auto;
        }
        #org{
            display:none;
        }
        #alertDivSet{
            display:none;
        }
    </style>
</head>


<?php 
    // Preloaded Values of Input field
    $check="SELECT * FROM `info`,`address` 
    WHERE info.userId=".$_SESSION['id']." AND `address`.userId=".$_SESSION['id']." LIMIT 1";

    // $check="SELECT * FROM `info` 
    // WHERE info.userId=".$_SESSION['id']." LIMIT 1";
    $resultcheck=mysqli_query($link,$check);
    if($resultcheck){
        // print_r($resultcheck);
        $rowcheck=mysqli_fetch_assoc($resultcheck);
        // print_r($rowcheck);
        if(!(isset($rowcheck['fname']))){
            $fname="";
        }else{
            $fname=$rowcheck['fname'];
        }

        if(!(isset($rowcheck['lname']))){
            $lname="";
        }else{
            $lname=$rowcheck['lname'];
        }

        if(!(isset($rowcheck['career']))){
            $career="";
        }else{
            $career=$rowcheck['career'];
        }
        
        if(!(isset($rowcheck['further']))){
            $further="";
        }else{
            $further=$rowcheck['further'];
        }

        if(!(isset($rowcheck['organisation']))){
            $organisation="";
        }else{
            $organisation=$rowcheck['organisation'];
        }
        
        if(!(isset($rowcheck['phone']))){
            $phone="";
        }else{
            $phone=$rowcheck['phone'];
        }

        if(!(isset($rowcheck['dob']))){
            $dob="";
        }else{
            $dob=$rowcheck['dob'];
        }

        if(!(isset($rowcheck['city']))){
            $city="";
        }else{
            $city=$rowcheck['city'];
        }

        if(!(isset($rowcheck['state']))){
            $state="";
        }else{
            $state=$rowcheck['state'];
        }

        if(!(isset($rowcheck['pin']))){
            $pin="";
        }else{
            $pin=$rowcheck['pin'];
        }

        if(!(isset($rowcheck['bio']))){
            $bio="";
        }else{
            $bio=$rowcheck['bio'];
        }
        
    }
    // Deduced from username
    $query="SELECT `name` FROM `users` WHERE `id`=".$_SESSION['id']." LIMIT 1";
    $result=mysqli_query($link,$query);
    if($result){
        $row=mysqli_fetch_assoc($result);
        $nameArray = str_split($row['name']);
    }
    $reverseName=array_reverse($nameArray);
    $firstName="";
    $lastName="";
    foreach($nameArray as $char){
        if($char==" "){
            break;
        }else{
            $firstName.=$char;
        }
    }

    foreach($reverseName as $char){
        if($char==" "){
            break;
        }else{
            $lastName.=$char;
            if(strrev($lastName)==$firstName){
                $lastName="";
            }
        }
    }
?>


<div class="row">
        <div class="col-sm-6">
            <img src="img/undraw_connection_b38q.svg" class="image2 mt-2"
                alt="I'll be there for you ('Cause you're there for me too)"
                style="transform: translate(100px,200px); width: 80%;" />
        </div>
        <div class="col-sm-6">
        <div class="container">
            <div class="alert alert-danger" type="alert" id="alertDivSet"></div>
            <form action="actions.php?process=profileSetUp" method="post" class="sign-in-form">
                <h2 class="title"><u>Profile</u></h2>
                <div class="input-field">
                    <i class="centered fas fa-user"></i>
                    <input type="text" id="fname" name="fname" placeholder="First Name" value="<?php            
                    $nameCheck="SELECT `userId` FROM `info` WHERE `userId`='".mysqli_real_escape_string($link,$_SESSION['id'])."' LIMIT 1";
                    $resultNC=mysqli_query($link,$nameCheck);
                    if($resultNC && mysqli_num_rows($resultNC)>0){
                        echo $fname;
                    }else{
                        echo $firstName;
                    } ?> " />
                </div>

                <div class="input-field">
                    <i class="centered fas fa-user"></i>
                    <input type="text" id="lname" name="lname" placeholder="Last Name" value="<?php 
                    if($resultNC && mysqli_num_rows($resultNC)>0){
                        echo $lname;
                    }else{
                        echo strrev($lastName);
                    } ?>" />
                </div>
                <?php include("careerlist.php"); ?>

                
                <div id="org" class="input-field">
                    <i class="centered far fa-building"></i>
                    <input type="text" id="organisation" name="organisation" placeholder="Organisation" value="<?php echo $organisation; ?>" />
                </div>

                
                <div class="input-field">
                    <i class="centered fas fa-phone-alt"></i>
                    <input type="tel" placeholder="Phone Number" id="phone" name="phone" value="<?php echo $phone; ?>" />
                </div>
                
                <div class="input-field">
                    <i class="centered far fa-calendar-alt"></i>
                    <input type="text" id="dob" name="dob" placeholder="Date Of Birth" onfocus="this.type='date'    "
                        onblur="this.type='text'" value="<?php echo $dob; ?>" />
                </div>


                <div class="input-field">
                    <i class="centered fas fa-map-marked-alt"></i>
                    <input type="text" placeholder="City" id="city" name="city" value="<?php echo $city; ?>" />
                </div>

                <div class="input-field">
                    <i class="centered fas fa-map-marked-alt"></i>
                    <input type="text" placeholder="State" id="state" name="state" value="<?php echo $state; ?>" />
                </div>

                <div class="input-field">
                    <i class="centered fas fa-map-marker-alt"></i>
                    <input type="number" placeholder="Pincode" id="pin" name="pin" value="<?php echo $pin; ?>" />
                </div>

                <div class="input-field">
                    <i class="centered fas fa-award"></i>
                    <input type="text" placeholder="Your Bio" id="bio" name="bio" value="<?php echo $bio; ?>" />
                </div>

                <div class="input-field">
                    <i class="centered far fa-image"></i>
                    <input class="file" type="text" placeholder="Profile Image(jpeg/png)" onfocus="this.type='file'"
                        onblur="this.type='text'" accept="image/jpeg, image/png" id="image" name="image" />
                    
                </div>
                <button type="button" id="profileSubmit" class="btn solid">Submit</button>
                <!-- <input type="submit" value="submit" class="btn solid" /> -->
            </form>
            <!-- <img src="img/undraw_connection_b38q.svg" class="image2" alt="I'll be there for you ('Cause you're there for me too)" style="transform: translate(-100px,-750px);" /> -->
                </div>
            </div>
    </div>
    
    <script src="script.js"></script>
<!-- </body>

</html> -->