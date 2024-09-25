<?php session_start(); 
$pageTitle = 'Admin Login';


if(isset($_SESSION['user']) && isset($_SESSION['password']))
{
	header('Location: dashboard.php');
	
}?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="Design/css/bootstrap.css"/>
		<link rel="stylesheet" href="Design/fontawesome-free-6.1.2-web/css/all.css">
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="shortcut icon" href="image/logo.jpg" type="image/x-icon">
		<title>Survey Dashboard Login</title>
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
	</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
		</div>
	</nav>
	<div class="col-md-3"></div>
	<div class="col-md-6 well">
		<h3 class="text-primary">Survey Dashboard Login</h3>
		<hr style="border-top:1px dotted #ccc;"/>
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<?php if(isset($_SESSION['message'])): ?>
				<div class="alert alert-<?php echo $_SESSION['message']['alert'] ?> msg"><?php echo $_SESSION['message']['text'] ?></div>
			<script>
				(function() {
					// removing the message 3 seconds after the page load
					setTimeout(function(){
						document.querySelector('.msg').remove();
					},3000)
				})();
			</script>
			<?php 
				endif;
				// clearing the message
				unset($_SESSION['message']);
			?>
			<form action="login_query.php" method="POST">	
				<h4 class="text-success">Login here...</h4>
				<hr style="border-top:1px groovy #000;">
				<div class="form-group">
					<label>firstname</label>
					<input type="text" class="form-control" name="firstname" />
				</div>
				<div class="form-group">
					<label>Password</label>
					<div class="input-icons">
      				<i onclick="myFunction(this)" class="fa fa-eye" id="togglePassword"></i>
					<input type="password" class="form-control" name="password" id="password"/>
			</div>
				</div>
				<br />
				<div class="form-group">
					<button class="btn btn-primary form-control" name="login">Login</button>
				</div>
			</form>
		</div>
	</div>
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
</body>
</html>