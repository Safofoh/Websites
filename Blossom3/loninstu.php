<?php

error_reporting(E_ALL ^ E_NOTICE);  
error_reporting(0); 
 
#include('config.php');


session_start();
include 'dbh.php';




#$email="";
#$password ="";
$errors = array();

#echo "kkkkkkk";

if (isset($_POST['email']) && isset($_POST['password'])){

#echo "kkkkkkk";

$email = mysqli_real_escape_string($con , $_POST['email']);
$password = mysqli_real_escape_string($con , $_POST['password']);


error_reporting(E_ERROR | E_PARSE);


#$_POST[password]=md5($_POST[password]);
$password=md5($_POST[password]);
		
	 $sql = "SELECT * FROM `student` WHERE `email` = '$email' AND `pssword` = '$password'";
		
		$result = mysqli_query($con, $sql);
 #mysqli_num_rows($result);
	
	

		if (mysqli_num_rows($result) > 0) 
		{
		
				$row = $result->fetch_assoc();
				$_SESSION['id'] = $row['id'];
				$_SESSION['type'] = "student";
				$_SESSION['mode'] = "view";
		  	#$_SESSION["email"] =  $row["email"];
		}  
 		else{
			$_SESSION["message"]= "user with this email does not exist" ;
		}

	




if (empty($password)){array_push($errors, "password is required"); }
if (empty($email)){array_push($errors, "email is required"); }
#if (empty($Speciality)){array_push($errors, "Speciality is required"); }

#echo "=====".$_SESSION['id'];

 if(isset($_SESSION['id']) && $_SESSION['type'] == "student") { 
 
 
   header('location: StudentHomePage.php');
}else
{
echo count($error);

foreach($errors as $error) {
    echo $error. " " ; }
}
header('location: index.php');

}

?>