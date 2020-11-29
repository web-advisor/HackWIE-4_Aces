<?php
	$to='help@thefouraces.com'; 
	$subject='user-help';
	$message=$_POST['Cmessage'];
	$headers='User Details'.'\r\n';
	$headers.='Name: '.$_POST['Cname'].'\r\n';
	$headers.='Email: '.$_POST['Cemail'].'\r\n';
	$headers.='Number: '.$_POST['Cnumber'].'\r\n';
	mail($to,$subject,$message,$headers);
	header('Location: index.php');
?>