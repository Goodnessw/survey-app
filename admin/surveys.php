<?php
    ob_start();
	session_start();

	$pageTitle = 'Surveys';

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
                
                vertical_menu.getElementsByClassName('clients_link')[0].className += " active_link";

            </script>

        <?php

            
            $do = 'Manage';

            if($do == "Manage")
            {
                $stmt = $conn->prepare("SELECT * FROM surveys");
                $stmt->execute();
                $surveys = $stmt->fetchAll();
                $count = $stmt->rowCount();
            ?>
                <div class="card">
                    <div class="card-header">
                        <?php echo $pageTitle; ?>
                    </div>
                    <div class="card-body">

                        <!-- CLIENTS TABLE -->
                        
                        <table class="table table-bordered clients-table">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Age</th>
                                    <th scope="col">Option</th>
                                    <th scope="col">Recommend</th>
                                    <th scope="col">Languages</th>
                                    <th scope="col">Comments</th>
                                    <th scope="col">Manage</th>

                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php
                                 if($count == 0)
                                 {

                                     echo "<tr>";
                                         echo "<td colspan='8' style='text-align:center;'>";
                                             echo "When you receive a Survey, it will be presented here";
                                         echo "</td>";
                                     echo "</tr>";
                                 }
                                 else {
                                    foreach($surveys as $survey)
                                    {
                                        echo "<tr>";
                                            echo "<td>";
                                                echo $survey['full_name'];
                                            echo "</td>";
                                            echo "<td>";
                                                echo $survey['email'];
                                            echo "</td>";
                                            echo "<td>";
                                                echo $survey['age'];
                                            echo "</td>";
                                            echo "<td>";
                                                echo $survey['option'];
                                            echo "</td>";
                                            echo "<td>";
                                                echo $survey['recommend'];
                                            echo "</td>";
                                            echo "<td>";
                                                if($survey['languages']==NULL){
                                                    echo "No language was selected";
                                                }
                                                else{
                                                
                                                    echo $survey['languages'];
                                                echo "</td>";
                                                }
                                                echo "<td>";
                                                if($survey['comment']==NULL){
                                                    echo "No Comment was made";
                                                }
                                                else{
                                                echo "<textarea  style='width: 300px; height: 80px; resize:vertical;'>";
                                                echo $survey['comment'];
                                            echo "</textarea>";
                                                echo "</td>";
                                                }
                                            echo "<td>";
                                            $delete_data = "delete_".$survey["id"];
                                            ?>
                                                <ul class="list-inline m-0">
    
                                                    <!-- DELETE BUTTON -->
                                                    <li class="list-inline-item" data-toggle="tooltip" title="Delete">
                                                        <button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="modal" data-target="#<?php echo $delete_data; ?>" data-placement="top">
                                                            <i class="fa fa-trash"></i>
                                                            Delete
                                                        </button>
                                                        <!-- Delete Modal -->
    
                                                        <div class="modal fade" id="<?php echo $delete_data; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $delete_data; ?>" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Delete Survey Data</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Are you sure you want to delete Survey?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                    <a href="surveys.php"><button type="button" data-id = "<?php echo $survey['id']; ?>" class="btn btn-danger delete_user_bttn">Delete</button></a>
                                                                    </div>
                                                                </div>  
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            <?php
                                        echo "</td>";
                                            echo "</tr>";
                                    }}
                                ?>
                            </tbody>
                        </table>  
                    </div>
                </div>
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

<script type="text/javascript">
    // When delete category button is clicked

    $('.delete_user_bttn').click(function()
    {
        var id = $(this).data('id');
        var do_ = "Delete";

        $.ajax(
        {
            url:"ajax_file/surveys_ajax.php",
            method:"POST",
            data:{id:id,do:do_},
            success: function (data) 
            {
                swal("Delete User","The User has been deleted successfully!", "success").then((value) => {
                    window.location.replace("index.php");
                    
                });     
            },
            error: function(xhr, status, error) 
            {
                alert('AN ERROR HAS BEEN ENCOUNTERED WHILE TRYING TO EXECUTE YOUR REQUEST');
            }
          });
    });

</script>