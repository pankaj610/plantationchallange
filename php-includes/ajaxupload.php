
<?php
require('connect.php');
include('check-login.php');
$user_email = $_SESSION['userid'];

$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp', 'pdf', 'doc', 'ppt'); // valid extensions
$path = 'uploads/'; // upload directory
if ( $_FILES['image']) {
    $img = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];
    // get uploaded file's extension
    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
    // can upload same image using rand function
    $final_image = rand(1000, 1000000) . $img;
    // check's valid format
    if (in_array($ext, $valid_extensions)) {
        $path = $path . strtolower($final_image);
        if (move_uploaded_file($tmp, $path)) {
            //include database configuration file
            include_once 'connect.php';
            $user_id = mysqli_query($con, "select * from users where users.email = '$user_email';")->fetch_array()['id'];
            //insert form data in the database
            $query = mysqli_query($con, "insert into tasks(`user_id`,`image_url`,`task_name`) values('$user_id','$path','Plantation Challange')");

            $tasks_list = mysqli_query($con, "select * from tasks where user_id = (select id from users where users.email = '$user_email') and image_url='$path'");
            while ($task_row = $tasks_list->fetch_array()) {
                echo "<a onclick='return confirm_delete();' href='complete-task.php?deleteimage=".$task_row['id']."'>"."<img width='200' class='preview_image' height='200' src='php-includes/" . $task_row['image_url'] . "' /></a>";
            }
            // $insert = $con->query("INSERT INTO tasks ('user_id','image_url', 'task_name') VALUES ('1','" . $path . "','plant a tree')");
            //echo $insert?'ok':'err';
        }
    } else {
        echo 'invalid';
    }
}
