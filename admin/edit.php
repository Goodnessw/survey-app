<?php
// configuration
include('config.php');

// new data

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$middlename = $_POST['middlename'];
$email = $_POST['email'];
$password = sha1($_POST['password']);
$fullname = ' ' .  $_POST['firstname'] .' '. $_POST['middlename'] . ' '. $_POST['lastname'];
$id = $_POST['memids'];
// query
$sql = "UPDATE users 
        SET firstname=?, lastname=?, middlename=?, email=?, password=?, fullname=?
		WHERE user_id=?";
$q = $conn->prepare($sql);
$q->execute(array($firstname,$lastname,$middlename,$email,$password,$fullname,$id));
header("location: dashboard.php");


?>