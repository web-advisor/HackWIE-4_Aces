<head>
<style>

@media(max-width: 991px){
    .Contact-body{
    	margin-top: 20px !important;
    }

    .Contact-body a{
    	color: #3a4149 !important;
    }

    .Contact-body heading{
    	color: black !important;
    }
}

.Contact-body{
    	margin-top: 64px;
    	margin-bottom: 65px;
    }

.symbol{
    border-radius: 100%;
    color: white;
    background: #dc3545;
    padding: 18px 17px;
    width: 55px;
    height: 55px;
}

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

.sub-btn{
    background: #dc3545;
    color: white;
}

.sub-btn:hover{
    background: black;
    color: white;
}

body{
    background:-webkit-linear-gradient(#007bff,#00ffa1);    
}

</style>
</head>
<!-- <body style="background: -webkit-linear-gradient(#007bff,#00ffa1);">

<header>
	<nav class="navbar navbar-light navbar-expand-lg bg-danger" style="padding: 0;">
    <div class="container-fluid">
        <div class="navbar-brand">
            <img class="logo" src="images/logo.png" style="margin-left: 10px; width: 67px;">
        </div>
        <button class="nav-btn navbar-toggler" type="button" data-toggle="collapse" data-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav ml-auto ">
                <li class="nav-item"><a class="nav-link navbar-link" href="#">HOME</a></li>
                <li class="nav-item"><a class="nav-link navbar-link nav-active" href="#">CONTACT</a></li>
                <li class="nav-item"><a class="nav-link navbar-link" href="search.php">SEARCH</a></li>
                <li class="nav-item"><a class="nav-link navbar-link login px-4" href="#">LOGIN</a></li>
            </ul>
        </div>
    </div>
	</nav>
</header> -->

<div class="container Contact-body">
    <div class="row">
        <div class="col-lg-7 col-sm-7 col-xs-12 mt-5">
            <form action="sendmail.php" method="post" />
              <div class="row">
                <div class="col-md-6 pr-4 pb-3">
                  <input type="text" class="form-control bg-dark text-light p-4" name="Cname" placeholder="Name" required data-error="Please enter">
                </div>
                <div class="col-md-6 pr-4 pb-3">
                  <input type="email" class="form-control bg-dark text-light p-4" name="Cemail" placeholder="Your Email" required data-error="Please enter">
                </div>
                <div class="col-md-12 pr-4 pb-3">
                  <input type="Number" class="form-control bg-dark text-light p-4" name="Cnumber" placeholder="Your Number" required data-error="Please enter">
                </div>
                <div class="col-md-12 pr-4 pb-3">
                  <textarea class="form-control bg-dark text-light p-4" placeholder="Your Message" name="Cmessage" rows="5" required></textarea>
                </div>
                <div class="col-md-12 pr-4 pb-3">
                  <center>
                      <input type="submit" value="SEND MESSAGE" class="sub-btn btn btn-default">
                  </center>
                </div>
              </div>
            </form>
        </div>
        <div class="col-lg-5 col-sm-5 col-xs-12 mt-5">
            <div style="display:flex;">
                <div class="symbol">
                    <span class="fa fa-location-arrow fa-lg"></span>
                </div>
                <div class="ml-2">
                  <heading style="font-size:16px; color:#3a4149">Address</font><br>
                  <a style="font-size: 14px; color:#fff">MSIT Janakpuri, New Delhi, Delhi 110058</font>
                </div>
            </div>
            <div style="display:flex; margin-top: 30px;">
                <div class="symbol">
                    <span class="fa fa-envelope fa-lg"></span>
                </div>
                <div class="ml-2">
                  <heading style="font-size:16px; color:#3a4149">Email</font><br>
                  <a style="font-size: 14px; color:#fff">help@thefouraces.com</a>
                </div>
            </div>
            <div style="display:flex; margin-top: 20px;">
                <div class="symbol" style="padding-top: 14px;">
                    <span style="width: 25px; height: 30px;" class="fa fa-phone-volume"></span>
                </div>
                <div class="ml-2">
                  <heading style="font-size:16px; color:#3a4149">Phone Number</font><br>
                  <a style="font-size: 14px; color:#fff">12345 67890</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 
<footer class="bg-dark py-2 text-light">
	<small><center>© All Rights Reserved</center></small>
</footer>

</body>
</html> -->