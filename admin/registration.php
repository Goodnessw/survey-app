<?php
	session_start();

	$pageTitle = 'Add Admin';
if(isset($_SESSION['user']) && isset($_SESSION['password']))
	{
		include 'config.php';
  		include 'Includes/functions/functions.php'; 
		include 'Includes/templates/header.php';
		include 'Includes/templates/navbar.php'; ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
	</head>
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
<body>
	<div class="col-md-3"></div>
	<div class="col-md-6 well">
		<h3 class="text-primary">Add Admin User</h3>
		<hr style="border-top:1px dotted #ccc;"/>
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<form action="register_query.php" method="POST">	
				<h4 class="text-success">Add here...</h4>
				<hr style="border-top:1px groovy #000;">
				<div class="form-group">
					<label>Firstname</label>
					<input type="text" class="form-control" name="firstname"  />
				</div>
				<div class="form-group">
					<label>lastname</label>
					<input type="text" class="form-control" name="lastname" />
				</div>
				<div class="form-group">
					<label>middlename</label>
					<input type="text" class="form-control" name="middlename" />
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="email" class="form-control" name="email" />
				</div>
				<div class="form-group">
					<label>Password</label>
					<div class="input-icons">
      <i onclick="myFunction(this)" class="fa fa-eye" id="togglePassword"></i>
					<input type="password" class="form-control" name="password" id="password"/>
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
				<div class="form-group">
					<label>Confirm Password</label>
					<div class="input-icons">
					<i onclick="myFunction(this)" class="fa fa-eye" id="toggleCPassword"></i>
					<input type="password" class="form-control" name="cpassword" id="cpassword" />
					<script>
        const toggleCPassword = document.querySelector("#toggleCPassword");
        const Cpassword = document.querySelector("#cpassword");

        toggleCPassword.addEventListener("click", function (e) {
          const type =
            Cpassword.getAttribute("type") === "password" ? "text" : "password";
          Cpassword.setAttribute("type", type);
        });
      </script>
      </div>
				</div>
				<br />
				<div class="form-group">
					<button class="btn btn-primary form-control" name="register">Add User</button>
				</div>
			</form>
		</div>
	</div>
</body>
</html>
	<?php } include 'Includes/templates/footer.php';
	 ?>