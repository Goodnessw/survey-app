<?php
	
	//Start session
    
    session_start();

    //Set page title
    $pageTitle = 'Dashboard';

    //PHP INCLUDES
    include 'config.php';
    include 'Includes/functions/functions.php'; 
    include 'Includes/templates/header.php';

    //TEST IF THE SESSION HAS BEEN CREATED BEFORE

    if(isset($_SESSION['user']) && isset($_SESSION['password']))
    {
    	include 'Includes/templates/navbar.php';

    	?>

            <script type="text/javascript">

                var vertical_menu = document.getElementById("vertical-menu");


                var current = vertical_menu.getElementsByClassName("active_link");

                if(current.length > 0)
                {
                    current[0].classList.remove("active_link");   
                }
                
                vertical_menu.getElementsByClassName('dashboard_link')[0].className += " active_link";

            </script>

            <!-- TOP 4 CARDS -->

            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="panel panel-green ">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-sm-3">
                                    <i class="fa fa-users fa-4x"></i>
                                </div>
                                <div class="col-sm-9 text-right">
                                <div class="huge"><span><?php echo countItems("id","surveys")?></span></div>
                                <div>Total Surveys</div>
                                </div>
                            </div>
                        </div>
                        <a href="surveys.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-sm-3">
                                    <i class="fas fa-user fa-4x"></i>
                                </div>
                                <div class="col-sm-9 text-right">
                                <div class="huge"><span><?php echo countItems("user_id","users")?></span></div>
                                    <div>Total Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
      <div class="clearfix"></div>
                            </div>
                  

            <!-- START ORDERS TABS -->

            <div class="card">

                <!-- TABS BUTTONS -->

                <div class="card-header tab" style="padding:0px;">
                    <button class="tablinks_orders active" onclick="openTab(event, 'recent_orders','tabcontent_orders','tablinks_orders')">Recent Survey</button>
                </div>

                <!-- TABS CONTENT -->
                
                <div class="card-body">
                    <div class='responsive-table'>

                        <!-- RECENT ORDERS -->

                        <table class="table X-table tabcontent_orders" id="recent_orders" style="display:table">
                            <thead>
                                <tr>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Age
                                    </th>
                                    <th>
                                        Option
                                    </th>
                                    <th>
                                        Recommend
                                    </th>
                                    <th>
                                        Languages
                                    </th>
                                    <th>
                                        Comments
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                               
                                    $stmt = $conn->prepare("SELECT *  FROM surveys ORDER BY id DESC LIMIT 1");
                                    $stmt->execute();
                                    $surveys = $stmt->fetchAll();
                                    $count = $stmt->rowCount();
                                
                                    
                                    if($count == 0)
                                    {

                                        echo "<tr>";
                                            echo "<td colspan='5' style='text-align:center;'>";
                                                echo "List of your recent Surveys will be presented here";
                                            echo "</td>";
                                        echo "</tr>";
                                    }
                                    else
                                    {
                                        
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
                                                echo "</tr>";
                                        }}
                                    };
                                    
                                ?>

                            </tbody>
                        </table>
                        </table>  
                    </div>
                </div>
                <?php  include 'Includes/templates/footer.php';?>

                           