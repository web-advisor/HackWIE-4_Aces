<?php 
	session_start();
?>

<script>
	$(function(){
		window.scrollTo(0,500);
	});
</script>  



	<div class="search-banner">
		<div class="container">
		<div class="row">
			<div class="col-md-6">
			<h1><strong>Neighnour In Need</strong></h1>
			<!-- <form> -->
			<form  id='search' name="search" action="search_user.php" method="post">
				<input type="text" name="location" autocomplete="off" placeholder="Enter Area" id="loc" name="loc" class="col-md-5 col-sm-12" required />
				<br/><br/>
				<input type="text" name="course" autocomplete="off" placeholder="Enter Course" id="interest" name="interest" class="col-md-5 col-sm-12" required />
				<br/><br/>
				<!-- <button type="button" id="search" name="search" class="btn btn-outline-dark">Search</button> -->
				<input type="submit" value="Search" class="btn btn-outline-dark">
			</form>
			</div>
			<div class="col-md-4 ml-auto">
				<img class="mt-2" width="100%" src="../images/Banner.png" />
			</div>
		</div>
		</div>
	</div>
	<?php 
	if (!isset($_SESSION['search_id'])){
		echo'
		<div id="search-tag">
			<center><span class="fas fa-search"></span>  SEARCH RESULT WILL APPEAR HERE</center>
		</div>';
	}
	else{
		echo '
		<div id="search-result">
			<div class="map">';


				for ($i=0; $i <=2; $i++) {
					$x=rand(0,90);
					$r=(int)sqrt(2025-pow($x-45,2));
					$y=rand(-1*$r,$r)+42;
					echo '
					<i class="fas fa-map-marker-alt" alt="mark" data-toggle="modal" data-target="#Modal',$i,'"
					style="color: #c73cc7; font-size: 30px; position: absolute; top:',$y,'%; left:',$x,'%; cursor: pointer;" >
					
				</i>
				<div class="modal fade" id="Modal',$i,'" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="ModalLabel">Name',$_SESSION['search_id'][$i],'</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				        ...
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				        <a href="';
				        	if(isset($_SESSION['id'])){
				        		echo "#";
				        	}
				        	else
				        		echo "index.php?page=login";
				         echo '">
				        	<button type="button" class="btn btn-primary">View Profile</button>
				        </a>
				      </div>
				    </div>
				  </div>
				</div>	
			';}
			echo '
			</div>
		</div>';
	}
	unset($_SESSION['search_id']);
	?>
	