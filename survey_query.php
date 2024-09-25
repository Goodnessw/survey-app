<?php
session_start();
require_once 'config.php';

if(ISSET($_POST['submit'])) {
    if ($_POST['full_name'] != "" || $_POST['email'] != "") {
        try {
            $id = 'id';
            $full_name = $_POST['full_name'];
            $email = $_POST['email'];
            $age = date("Y") - $_POST['age'];
            $option = $_POST['option'];
            $recommend = $_POST['recommend'];

            // Check if 'language' is set, otherwise prompt to select one
            if (isset($_POST['language'])) {
                $language = implode(' , ', $_POST['language']);

                // If "Other" is selected, append the other language
                if (in_array('Other', $_POST['language']) && !empty($_POST['other_language'])) {
                    $other_language = $_POST['other_language'];
                    $language .= ', ' . $other_language;
                }
            } else {
                $_SESSION['message'] = array("text" => "Please select at least one language.", "alert" => "error");
                header('location:index.php');
                exit();
            }

            $comment = $_POST['comment'];
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO `surveys` VALUES ('', '$full_name', '$email', '$age', '$option', '$recommend', '$language', '$comment')";
            $conn->exec($sql);

        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        $_SESSION['message'] = array("text" => "Survey Complete.", "alert" => "info");
        $conn = null;
        header('location:index.php');
    } else {
        echo "
            <script>alert('Please fill up the required field!')</script>
            <script>window.location = 'index.php'</script>
        ";
    }
}
?>
