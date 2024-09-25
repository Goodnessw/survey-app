<?php
	session_start();
	require_once 'config.php';
 
	if(ISSET($_POST['register'])){
		if($_POST['firstname'] != ""  || $_POST['lastname'] != ""  || $_POST['middlename'] != "" || $_POST['email'] != ""  || $_POST['password'] != "" || $_POST['cpassword'] != ""  || $_POST['fullname'] != ""){
			try{
				$user_id = $_POST['user_id'];
				$firstname = $_POST['firstname'];
				$lastname = $_POST['lastname'];
				$middlename = $_POST['middlename'];
				$email = $_POST['email'];
				$password = sha1($_POST['password']);
				$cpassword = sha1($_POST['cpassword']);
				$fullname = ' ' .  $_POST['firstname'] .' '. $_POST['middlename'] . ' '. $_POST['lastname'];
				if($password == $cpassword){
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "INSERT INTO `users` VALUES ('$user_id', '$firstname', '$lastname' ,'$middlename', '$email',  '$password' , '$fullname')";
				$conn->exec($sql);}
			
			}catch(PDOException $e){
				echo $e->getMessage();
			}
			$_SESSION['message']=array("text"=>"User successfully created.","alert"=>"info");
			$con = null;
			header('location:users.php');
		}else{
			echo "
				<script>alert('Please fill up the required field!')</script>
				<script>window.location = 'registration.php'</script>
			";
		}
	}

	
	else{
		$_SESSION['message']=array("text"=>"password not matched","alert"=>"info");
			$con = null;
			header('location:users.php');
	}
?>

