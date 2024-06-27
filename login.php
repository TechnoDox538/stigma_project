<?php

$getpass = trim($_POST['password']);
  $getpass = md5($getpass);
  
  $username = trim($_POST['username']);
  
  	include('Connections/dbconnect.php');
 	$select = "SELECT * FROM authentication WHERE username = \"".$username."\" AND password = \"".$getpass."\" AND status = \"".activated."\"";
 	$query = mysqli_query($con, $select);
 	$userArray = mysqli_fetch_array($query);
 	$rows = mysqli_num_rows($query);
 	
 	$time = "20".date("y-m-d h:i:s");
	
	if ($rows == 0) 
 		{
	
		
		 $err = "Wrong username or password";
		
		 }
		 
		 else
		 {
		     
		 
		 	$_SESSION['login'] = true;
 		
 		$_SESSION['username'] = $userArray['username'];
 		$_SESSION['password'] = $userArray['password'];
		$_SESSION['role'] = $userArray['role'];
		$_SESSION['campus'] = $userArray['campus'];
		$_SESSION['fname'] = $userArray['fname'];
		$_SESSION['lname'] = $userArray['lname'];
		
		$sql = mysqli_query($con, "INSERT INTO activity_log VALUES ('".$userArray['username']."', '".$userArray['role']."', 'Logged in', '$time') ");
		
		include('included/home_dashbord.php');
		
		header('Location: included/index.php?pg=home'.$parameters.'');//admin form
 		exit();
		
		 

	}
	
  ?>
