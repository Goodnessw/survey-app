<?php
	session_start();
	
	require_once 'config.php';
	
	if(ISSET($_POST['login'])){
		if($_POST['firstname'] != "" || $_POST['password'] != ""){
			$firstname = $_POST['firstname'];
			// md5 encrypted
			// $password = md5($_POST['password']);
			$password = sha1($_POST['password']);
			$sql = "SELECT * FROM `users` WHERE `firstname`=? AND `password`=? ";
			$query = $conn->prepare($sql);
			$query->execute(array($firstname,$password));
			$row = $query->rowCount();
			$fetch = $query->fetch();
			if($row > 0) {
				$_SESSION['user'] = $fetch['user_id'];
				$_SESSION['password'] = $fetch['password'];
				header("location: dashboard.php");
			} else{
				echo "
				<script>alert('Invalid firstname or password')</script>
				<script>window.location = 'index.php'</script>
				";
			}
		}else{
			echo "
				<script>alert('Please complete the required field!')</script>
				<script>window.location = 'index.php'</script>
			";
		}
	}
?>