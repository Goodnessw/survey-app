<?php

	session_start();
	include('config.php');

	$id=$_GET['id'];
	$result = $conn->prepare("SELECT * FROM users WHERE user_id= :user_id");
	$result->bindParam(':user_id', $id);
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){

		if(isset($_SESSION['user']) && isset($_SESSION['password']))
	{
		include 'config.php';
  		include 'Includes/functions/functions.php'; 
		include 'Includes/templates/header.php';
		include 'Includes/templates/navbar.php';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<style>
      .input-icons i {
        position: absolute;
        margin-top: 12px;
        margin-left: 90%;
      }
      .fa:hover {
        cursor: pointer;
      }
    </style>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
	</head>
<body>
	<div class="col-md-3"></div>
	<div class="col-md-6 well">
		<h3 class="text-primary">Edit Admin User</h3>
		<hr style="border-top:1px dotted #ccc;"/>
		<div class="col-md-2"></div>
		<div class="col-md-8">
<form action="edit.php" method="POST">
<input type="hidden" name="memids" value="<?php echo $id; ?>" />
<hr style="border-top:1px groovy #000;">
				<div class="form-group">
					<label>Firstname</label>
					<input type="text" class="form-control" name="firstname" value="<?php echo $row['firstname']; ?>"  />
				</div>
				<div class="form-group">
					<label>Lastname</label>
					<input type="text" class="form-control" name="lastname" value="<?php echo $row['lastname']; ?>" />
				</div>
				<div class="form-group">
					<label>Middlename</label>
					<input type="text" class="form-control" name="middlename" value="<?php echo $row['middlename']; ?>"/>
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>"/>
				</div>
				<div class="form-group">
					<label>Password</label>
					<div class="input-icons">
      <i onclick="myFunction(this)" class="fa fa-eye" id="togglePassword"></i>
	  <input type="password" class="form-control" name="password" id="password"  value="<?php echo passthru($row['password']);?>" required/>
      <script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");

        togglePassword.addEventListener("click", function (e) {
          const type =
            password.getAttribute("type") === "password" ? "text" : "password";
          password.setAttribute("type", type);
        });
      </script>
      <script>
        function myFunction(x) {
          x.classList.toggle("fa-eye-slash");
        }
      </script>
    </div>
					
				</div>
<input type="submit" value="Save" />
</form>
</div>
	</div><br/>
</body>
</html>
<?php
	}};   include 'Includes/templates/footer.php';
?>

