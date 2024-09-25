<?php
    ob_start();
	session_start();

	$pageTitle = 'Users';

	if(isset($_SESSION['user']) && isset($_SESSION['password']))
	{
		include 'config.php';
  		include 'Includes/functions/functions.php'; 
		include 'Includes/templates/header.php';
		include 'Includes/templates/navbar.php';

        ?>

            <script type="text/javascript">

                var vertical_menu = document.getElementById("vertical-menu");


                var current = vertical_menu.getElementsByClassName("active_link");

                if(current.length > 0)
                {
                    current[0].classList.remove("active_link");   
                }
                
                vertical_menu.getElementsByClassName('users_link')[0].className += " active_link";

            </script>

			<?php if(isset($_SESSION['message'])): ?>
				<div class="alert alert-<?php echo $_SESSION['message']['alert'] ?> msg"><?php echo $_SESSION['message']['text'] ?></div>
			<script>
				(function() {
					// removing the message 3 seconds after the page load
					setTimeout(function(){
						document.querySelector('.msg').remove();
					},5000)
				})();
			</script>
			<?php 
				endif;
				// clearing the message
				unset($_SESSION['message']);
			?>


        <?php

            
            $do = 'Manage';

            if($do == "Manage")
            {
                $stmt = $conn->prepare("SELECT * FROM users");
                $stmt->execute();
                $users = $stmt->fetchAll();

            ?>
                <div class="card">
                    <div class="card-header">
                        <?php echo $pageTitle; ?>
                    </div>
                    <div class="card-body">

                    <a href="registration.php"><button>Add admin users</button></a>
                        <!-- USERS TABLE -->
                        <table class="table table-bordered users-table" border="1" cellspacing="0" >
                            <thead>
                                <tr>
                                    <th scope="col">Fullname</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Password</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($users as $user)
                                    {
                                        echo "<tr>";
                                            echo "<td>";
                                                echo $user['fullname'];
                                            echo "</td>";
                                            echo "<td>";
                                                echo $user['email'];
                                            echo "</td>";
                                            echo "<td>";
                                                echo $user['password'];
                                            echo "</td>";
                                        echo "</tr>";
                                    }?>

                            </tbody>
                        </table>  
                    </div>
                </div>

                <br>
                





            <?php
            }


        /* FOOTER BOTTOM */

        include 'Includes/templates/footer.php';

    }
    else
    {
        header('Location: index.php');
        exit();
    }
?>

<!-- JS SCRIPTS -->


</script>
