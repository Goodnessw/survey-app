<?php include '../config.php'; ?>
<?php include '../Includes/functions/functions.php'; ?>


<?php
if(isset($_POST['do']) && $_POST['do'] == "Delete")
{
    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE from surveys where id = ?");
    $stmt->execute(array($id));  
}



