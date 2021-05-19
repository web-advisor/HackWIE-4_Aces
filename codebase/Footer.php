<footer class="bg-dark py-2 text-light">
	<small><center>© All Rights Reserved</center></small>
</footer>
<script type="text/javascript">
 
    $("#signingIn").click(function () {
	  $.ajax({
       type: "POST",
       url : "actions.php?process=signIn",
       data: "usernameIn=" + $("#usernameIn").val() + "&passwordIn=" + $("#passwordIn").val() +"&loginActive="+$("#loginActive").val(),
       success: function(result){
    //    alert(result);
         if(result=="1"){
            window.location.assign("index.php");
         }else{
           $("#alertDivIn").html(result).show();
         }
      }
     })
	});

	$("#signingUp").click(function () {
	  $.ajax({
       type: "POST",
       url : "actions.php?process=signUp",
       data: "usernameUp=" + $("#usernameUp").val() + "&email=" + $("#email").val() + "&passwordUp=" + $("#passwordUp").val() +"&loginActive="+$("#loginActive").val(),
       success: function(result){
    //    alert(result);
        if(result=="1"){
          window.location.assign("?page=profile");
        }else{
          $("#alertDivUp").html(result).show();
        }
      }
     })
	});

	$("#profileSubmit").click(function(){
	  $.ajax({
       type: "POST",
       url : "actions.php?process=profileSetUp",
	   data: "fname=" + $("#fname").val() + "&lname=" + $("#lname").val() + "&career=" + $("#career").val() +"&further=" + $('input[name^="op"]').val() +"&organisation="+$("#organisation").val() +"&phone=" + $("#phone").val() +"&dob=" + $("#dob").val() +"&city=" + $("#city").val()+"&state=" + $("#state").val()+"&pin=" + $("#pin").val()+"&bio=" + $("#bio").val()+"&image=" + $("#image").val()  ,
       success: function(result){
    //    alert(result);
        if(result=="11"){
          window.location.assign("index.php");
        }else{
          $("#alertDivSet").html(result).show();
        }
      }
     })
	});

  $("#search").click(function () {
	  $.ajax({
       type: "POST",
       url : "actions.php?process=search",
       data: "location="+$("#location").val()+"&loc=" + $("#loc").val() +"&career="+$("#career").val()+"&interest=" + $("#interest").val()+ "&furthergive="+$("#further").val()+"&further=" + $("#further").val() +"&organisation="+$("#organisation").val()+"&org=" + $("#org").val() ,
      // data: "loc="+  $("#location").val() ,
      success: function(result){
      //  console.log(result);
         if(result=="1"){
            window.location.assign("index.php?page=search");
         }else{
           $("#alertDivIn").html(result).show();
         }
      }
     })
	});




</script>

</body>
</html>	