<script type="text/javascript">
	$(function(){
		window.scrollTo(0,500);
		$('#interest option').each(function() {
			if($(this).is(':selected')){
				if($(this).val()==$("#o7").val()){
					alert("Yphoi");
				}
			}
		});

		// if($("#o1").attr("selected")||$("#o2").attr("selected")||$("#o3").attr("selected")||$("#o4").attr("selected")||$("#o5").attr("selected")||$("#o6").attr("selected")||$("#o7").attr("selected")||$("#o8").attr("selected")||$("#o9").attr("selected")||$("#o10").attr("selected")||$("#o11").attr("selected")||$("#o12").attr("selected")||$("#o13").attr("selected")){
		// 	alert("atleast here");
		// }
	});
</script> 
	<div class="search-banner">
	<div class="container">
<?php
	if($_SESSION["id"]){
		$preload=" SELECT users.name, info.career, info.further,info.organisation,address.lat,address.lng,address.city,address.state
					FROM `users`
					INNER JOIN `info` ON users.id=info.userId 
					INNER JOIN `address` ON info.userId = address.userId
					WHERE users.id=".$_SESSION['id'];
		$preloadResult=mysqli_query($link,$preload);
		$preloadRow=mysqli_fetch_all($preloadResult);
		if($preloadRow>0){
			if(empty($preloadRow)){
				$sql="SELECT `email` FROM `users` WHERE `id`='".mysqli_real_escape_string($link,$_SESSION['id'])."' LIMIT 1";
				$sqlResult=mysqli_query($link,$sql);
				$sqlRow=mysqli_fetch_all($sqlResult);
				$userEmail=$sqlRow[0][0];
				print_r("<div class='alert alert-info container' role='alert'>
						Hey <strong>".mysqli_real_escape_string($link,$userEmail)."</strong> , try filling up <button type='button' class='btn btn-light'><a href='index.php?page=profile' style='text-decoration:none'>My Profile</a></button> section first ..! We aim to provide personalised localised Search Results for You 🙂
						</div>");
			}else{
				$name=$preloadRow[0][0];
				$career=$preloadRow[0][1];
				$further=$preloadRow[0][2];
				$organisation=$preloadRow[0][3];
				$lat=$preloadRow[0][4];
				$lng=$preloadRow[0][5];
				$address=$preloadRow[0][6].' , '.$preloadRow[0][7];
				print_r('<div class="alert alert-primary container" role="alert">
							Hey <strong>'.mysqli_real_escape_string($link,$name).'</strong> , We have got Personalised Search Results for you keeping in mind Your Location and Your interests viz. <strong>');  
				if($_SESSION['query']){
					print_r('</strong></div>');
				}else{
					print_r(mysqli_real_escape_string($link,$career).' '); 
					if($further!=""){
						print_r(', '.mysqli_real_escape_string($link,$further).' '); 
						if($organisation!=""){
							print_r(', '.mysqli_real_escape_string($link,$organisation).' ');
						}else{
							print_r('');
						}
					}else{
						if($organisation!=""){
							print_r(', '.mysqli_real_escape_string($link,$organisation).' ');
						}else{
							print_r('');
						}
					}
				    print_r('</strong>.</div>');
				}
			}
		}else{	 	
			echo '<div class="alert alert-danger container" role="alert">
					Unable to Fetch Data.This is not you ..Please try again later 
				  </div>';
		}
?>	
		
		<div class="row">
			<div class="col-md-6">
			<h1><strong>Neighbour In Need</strong></h1>
			<h2>Modify Filters :: </h2>
			<form class="form-inline">
				<div class="form-check mb-2 mr-sm-2">
					<input class="form-check-input" type="checkbox" id="location" checked> 
					<label class="form-check-label" for="location">
					Location <pre>            </pre> :
					</label>
				</div>

				<div class="input-group mb-2 mr-sm-2">
					<input type="text" class="form-control" id="loc" name="loc" value="<?php
						if(!(isset($address))){
							print_r("");
						}else{
							print_r($address);
						} ?>" placeholder="City, State, PIN">
				</div>
			</form>
			<form class="form-inline">
				<div class="form-check mb-2 mr-sm-2">
					<input class="form-check-input" type="checkbox" id="career" <?php if(isset($career)) echo "checked"; ?> > 
					<label class="form-check-label" for="career">
					Major Career Interest : 
					</label>
				</div>

				<div class="input-group mb-2 mr-sm-2">
				<select class="form-control" id="interest" name="interest">
					<option value="<?php if(isset($career)) print_r($career); else print_r("Choose Career Field"); ?>"><?php if(isset($career)) print_r($career); else print_r("Choose Career Field");  ?></option>
					<option id="o1" value="Architecture and Engineering">Architecture and Engineering</option>
					<option id="o2" value="Arts,Culture and Entertainment">Arts,Culture and Entertainment</option>
					<option id="o3" value="Business,Management and Administration">Business,Management and Administration</option>
					<option id="o4" value="Communications">Communications</option>
					<option id="o5" value="Community and Social Services">Community and Social Services</option>
					<option id="o6" value="Education">Education</option>
					<option id="o7" value="Science and Technology">Science and Technology</option>
					<option id="o8" value="Installation,Repair and Maintenance">Installation,Repair and Maintenance</option>
					<option id="o9" value="Farming,Fishing and Forestry">Farming,Fishing and Forestry</option>
					<option id="o10" value="Government">Government</option>
					<option id="o11" value="Health and Medicine">Health and Medicine</option>
					<option id="o12" value="Law and Public Policy">Law and Public Policy</option>
					<option id="o13" value="Sales">Sales</option>
				</select>
				</div>
			</form>
			<form class="form-inline">
				<div class="form-check mb-2 mr-sm-2">
					<input class="form-check-input" type="checkbox" id="further" name="further" <?php if(isset($further)) echo "checked"; ?> > 
					<label class="form-check-label" for="further">
					Refining Area <pre>        </pre>: 
					</label>
				</div>
				<div class="input-group mb-2 mr-sm-2" id="op1">
				<select class="form-control" id="archEngg" name="archEngg">
					<option value="<?php if(isset($further)) print_r($further); else print_r("Choose further Field"); ?>"><?php if(isset($further)) print_r($further); else print_r("Choose further Field"); ?></option>
					<option value="Architect">Architect</option>
					<option value="Civil engineer">Civil engineer</option>
					<option value="Landscape Architect">Landscape Architect</option>
					<option value="Interior Designer">Interior Designer</option>
					<option value="Sustainable Designer">Sustainable Designer</option>
					<option class="student" value="Pursuing B.Arch">Pursuing B.Arch</option>    
				</select>
				</div>
				<div class="input-group mb-2 mr-sm-2" id="op2">
				<select class="form-control" id="arts" name="arts">
					<option value="<?php if(isset($further)) print_r($further); else print_r("Choose further Field"); ?>"><?php if(isset($further)) print_r($further); else print_r("Choose further Field"); ?></option>
					<option value="Singer/Songwriter/Music Producer">Singer/Songwriter/Music Producer</option>
					<option value="Art curator">Art curator</option>
					<option value="Graphic designer">Graphic Designer</option>
					<option value="Fashion Designer">Fashion Designer</option>
					<option value="Photographer">Photographer</option>
					<option value="Animator">Animator</option>  
					<option class="student" value="Pursuing Arts">Pursuing Arts</option>    
				</select>
				</div>
				<div class="input-group mb-2 mr-sm-2" id="op3">
				<select class="form-control" id="BBA" name="BBA">
					<option value="<?php if(isset($further)) print_r($further); else print_r("Choose further Field"); ?>"><?php if(isset($further)) print_r($further); else print_r("Choose further Field"); ?></option>
					<option value="Human resources Manager">Human resources Manager</option>
					<option value="Marketing assistant">Marketing assistant</option>
					<option value="Accountant">Accountant</option>
					<option value="Secretary">Secretary</option>
					<option value="Real estate agent">Real estate agent</option>
					<option value="Business development manager">Business development manager</option>  
					<option class="student" value="Pursuing BBA/MBA">Pursuing BBA/MBAh</option>    
				</select>
				</div>
				<div class="input-group mb-2 mr-sm-2" id="op4">
				<select class="form-control" id="comm" name="comm">
					<option value="<?php if(isset($further)) print_r($further); else print_r("Choose further Field"); ?>"><?php if(isset($further)) print_r($further); else print_r("Choose further Field"); ?></option>
					<option value="Journalist">Journalist</option>
					<option value="Copy Writer">Copy Writer</option>
					<option value="Public relations specialist">Public relations specialist</option>
					<option value="Meeting/event planner">Meeting/event planner</option>
					<option value="Social media manager">Social media manager</option>
					<option class="student" value="Pursuing Mass Comm.">Pursuing Mass Comm.</option>    
				</select>
				</div>
				<div class="input-group mb-2 mr-sm-2" id="op5">
				<select class="form-control" id="SSer" name="SSer">
					<option value="<?php if(isset($further)) print_r($further); else print_r("Choose further Field"); ?>"><?php if(isset($further)) print_r($further); else print_r("Choose further Field"); ?></option>
					<option value="School counselor">School counselor</option>
					<option value="Speech pathologist">Speech pathologist</option>
					<option value="Rehabilitation counselor">Rehabilitation counselor</option>
					<option value="Licensed clinical social worker">Licensed clinical social worker</option>
					<option value="Child welfare social worker">Child welfare social worker</option>
					<option value="Palliative and hospice care worker">Palliative and hospice care worker</option>
					<option class="student" value="Part of NCC/NSS">Part of NCC/NSS</option>    
				</select>
				</div>
				<div class="input-group mb-2 mr-sm-2" id="op6">
				<select class="form-control" id="Edu" name="Edu">
					<option value="<?php if(isset($further)) print_r($further); else print_r("Choose further Field"); ?>"><?php if(isset($further)) print_r($further); else print_r("Choose further Field"); ?></option>
					<option value="School teacher">School teacher</option>
					<option value="College professor">College professor</option>
					<option value="Coaching teacher">Coaching teacher</option>
					<option value="Sports Teacher">Sports Teacher</option>
					<option value="Home Tutor">Home Tutor</option>
					<option class="student" value="Student">Student</option>    
				</select>
				</div>
				<div class="input-group mb-2 mr-sm-2" id="op7">
				<select class="form-control" id="SciTech" name="SciTech">
					<option value="<?php if(isset($further)) print_r($further); else print_r("Choose further Field"); ?>"><?php if(isset($further)) print_r($further); else print_r("Choose further Field"); ?></option>
					<option value=""></option>
					<option value="Archeologist">Archeologist</option>
					<option value="Software engineer">Software engineer</option>
					<option value="Laboratory technician">Laboratory technician</option>
					<option value="Microbiologist">Microbiologist</option>
					<option value="Physicist">Physicist</option>
					<option class="student" value="Pursuing B.Arch">Pursuing Technical Courses</option>    
				</select>
				</div>
				<div class="input-group mb-2 mr-sm-2" id="op8">
				<select class="form-control" id="mech" name="mech">
					<option value="<?php if(isset($further)) print_r($further); else print_r("Choose further Field"); ?>"><?php if(isset($further)) print_r($further); else print_r("Choose further Field"); ?></option>
					<option value="Auto mechanic">Auto mechanic</option>
					<option value="Landscaper and groundskeeper">Landscaper and groundskeeper</option>
					<option value="Plumber">Plumber</option>    
				</select>
				</div>
				<div class="input-group mb-2 mr-sm-2" id="op9">
				<select class="form-control" id="farm" name="farm">
					<option value="<?php if(isset($further)) print_r($further); else print_r("Choose further Field"); ?>"><?php if(isset($further)) print_r($further); else print_r("Choose further Field"); ?></option>
					<option value="Agricultural worker">Agricultural worker</option>
					<option value="Animal breeder">Animal breeder</option>
					<option value="Nursery worker">Nursery worker</option>
					<option value="Forest and conservation worker">Forest and conservation worker</option>
					<option class="student" value="Pursuing Agro-Engineering">Pursuing Agro-Engineering</option>
		    	</select>
				</div>
				<div class="input-group mb-2 mr-sm-2" id="op10">
				<select class="form-control" id="govt" name="govt">
					<option value="<?php if(isset($further)) print_r($further); else print_r("Choose further Field"); ?>"><?php if(isset($further)) print_r($further); else print_r("Choose further Field"); ?></option>
					<option value="Research Associate">Research Associate</option>
					<option value="IT Consultant">IT Consultant</option>
					<option value="Government school staff">Government school staff</option>
				</select>
				</div>
				<div class="input-group mb-2 mr-sm-2" id="op11">
				<select class="form-control" id="med" name="med">
					<option value="<?php if(isset($further)) print_r($further); else print_r("Choose further Field"); ?>"><?php if(isset($further)) print_r($further); else print_r("Choose further Field"); ?></option>
					<option value="Anesthesiologist">Anesthesiologist</option>
					<option value="Dental assistant">Dental assistant</option>
					<option value="Nurse">Nurse</option>
					<option value="Veterinarian">Veterinarian</option>
					<option value="Physical therapist">Physical therapist</option>
					<option class="student" value="Pursuing MBBS">Pursuing MBBS</option>    
				</select>
				</div>
				<div class="input-group mb-2 mr-sm-2" id="op12">
				<select class="form-control" id="law" name="law">
					<option value="<?php if(isset($further)) print_r($further); else print_r("Choose further Field"); ?>"><?php if(isset($further)) print_r($further); else print_r("Choose further Field"); ?></option>
					<option value="Public administrator">Public administrator</option>
					<option value="Paralegal">Paralegal</option>
					<option value="Lawyer">Lawyer</option>
					<option value="Labor relations specialist">Labor relations specialist</option>
					<option class="student" value="Pursuing LLB">Pursuing LLB</option>    
				</select>
				</div>
				<div class="input-group mb-2 mr-sm-2" id="">
				<select class="form-control" id="sales" name="sales">
					<option value="<?php if(isset($further)) print_r($further); else print_r("Choose further Field"); ?>"><?php if(isset($further)) print_r($further); else print_r("Choose further Field"); ?></option>
					<option value="Sales associate">Sales associate</option>
					<option value="Sales development rep">sales development rep</option>
					<option value="Account executive">Account executive</option>
					<option value="Regional sales manager">Regional sales manager</option>
					<option value="VP of sales">VP of sales</option>
					<option value="Trainee">Trainee</option>
				</select>
				</div>
			</form>
			<form class="form-inline">
				<div class="form-check mb-2 mr-sm-2">
					<input class="form-check-input" type="checkbox" id="organisation" name="organisation" <?php if(isset($organisation)) echo "checked"; ?> > 
					<label class="form-check-label" for="organisation">
					Organisation<pre>        </pre>:
					</label>
				</div>

				<div class="input-group mb-2 mr-sm-2">
					<input type="text" class="form-control" id="org" name="org" value="<?php if(isset($organisation)) print_r($organisation); else print_r("Choose Organisation") ?>" >
				</div>
			</form>
			<button type="button" id="search" name="search" class="btn btn-outline-dark">Search</button>
			</div>
			<div class="col-md-4 ml-auto">
				<img class="mt-2" width="100%" src="../images/Banner.png" />
			</div>
		</div>
	</div>
	


<?php
	}else{
?>
	<!-- <div class="search-banner">
		<div class="container"> -->
		<div class="row">
			<div class="col-md-6">
			<h1><strong>Neighbour In Need</strong></h1>
			<form>
			<!-- <form  id='search' name="search" action="search_user.php" method="post"> -->
				<input type="text" name="location" autocomplete="off" placeholder="Enter Area" id="loc" name="loc" class="col-md-5 col-sm-12" required />
				<br/><br/>
				<input type="text" name="course" autocomplete="off" placeholder="Enter Your Interest" id="interest" name="interest" class="col-md-5 col-sm-12" required />
				<br/><br/>
				<button type="button" id="search" name="search" class="btn btn-outline-dark">Search</button>
				<!-- <input type="submit" value="Search" class="btn btn-outline-dark"> -->
			</form>
			</div>
			<div class="col-md-4 ml-auto">
				<img class="mt-2" width="100%" src="../images/Banner.png" />
			</div>
		</div>
		</div>
	</div>

<?php
	}


	if (!isset($_SESSION['searched'])){
		// print_r($_SESSION["searched"]);

		echo'
		<div id="search-tag">
			<center><span class="fas fa-search"></span>  SEARCH RESULT WILL APPEAR HERE</center>
		</div>';
	}
	else{
		// print_r($_SESSION["searched"]);
		$arraylength=$_SESSION["num"];
		echo '
		<div id="search-result">
			<div class="map">';


				for ($i=0; $i <$arraylength; $i++) {
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
						<h5 class="modal-title" id="ModalLabel"> ';
						$info="SELECT * FROM `info` WHERE userId=".$_SESSION['searched'][$i][1];
						$resultInfo=mysqli_query($link,$info);
						$rowInfo=mysqli_fetch_all($resultInfo);			
						
						// print_r($rowInfo);
						echo $rowInfo[0][2],' ',$rowInfo[0][3],'</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				        ',$rowInfo[0][9],'
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
	unset($_SESSION['searched']);
?>


