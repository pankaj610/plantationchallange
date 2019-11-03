<?php
require('php-includes/connect.php');
include('php-includes/check-login.php');
$user_email = $_SESSION['userid'];
function check_task_completed() {
    global $con, $user_email;
    $query = mysqli_query($con,"select id from users where users.email = '$user_email' and status='done' ");
    if(mysqli_num_rows($query)>0){
        echo "<script>alert('You already have completed your task.');window.location.assign('tree.php');</script>";
    }
}
check_task_completed();

if (isset($_GET['complete'])) {
    $query = mysqli_query($con,"select * from tasks where user_id= (select id from users where users.email = '$user_email') ");
    if(mysqli_num_rows($query)>0){
        $sql = "UPDATE users SET status='done' WHERE users.email='$user_email' ";
        if (mysqli_query($con, $sql)) {
            echo "<script>alert('Task Completed');window.location.assign('tree.php');</script>";
        } else {
            echo "<script>alert('Could Not Complete Task');window.location.assign('complete-task.php');</script>";
        }
    }
    else{
        echo '<script>alert("Upload at least one photo of your task.");window.location.assign("index.php");</script>';
    }
    
}

if (isset($_GET['deleteimage'])) {
    $taskid = $_GET['deleteimage'];
    $query = mysqli_query($con,"delete from tasks where user_id= (select id from users where users.email = '$user_email') and id='$taskid' ");
    if($query){
            echo "<script>alert('Image deleted');window.location.assign('complete-task.php');</script>";
    } 
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Members Joined</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="dist/css/style.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">



</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include('php-includes/menu.php'); ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Complete Task</h1>
                    </div>
                </div>

                <div class="col-md-12">
                    <hr>
                    <form class="form-inline" id="form" action="ajaxupload.php" method="post" enctype="multipart/form-data">
                        <div class="mx-0 d-inline">
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Upload Images</label>
                                <input class="form-control-file" id="uploadImage" type="file" accept="image/*" name="image" />
                            </div>

                            <input class="btn btn-success" type="submit" value="Upload">
                            <input class="btn btn-info" type="submit" onclick="return confirm_complete();">
                        </div>
                        <div id="preview">
                            <?php
                            $tasks_list = mysqli_query($con, "select * from tasks where user_id = (select id from users where users.email = '$user_email')");
                            while ($task_row = $tasks_list->fetch_array()) {
                                echo "<a onclick='return confirm_delete();' href='complete-task.php?deleteimage=".$task_row['id']."'>"."<img width='200' class='preview_image' height='200' src='php-includes/" . $task_row['image_url'] . "' /></a>";
                            }
                            ?>
                        </div>
                        <br>

                    </form>


                    <div id="err"></div>

                </div>

                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="vendor/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="vendor/metisMenu/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="dist/js/sb-admin-2.js"></script>

        <script>
            function confirm_delete(){
                return confirm("Do you want to delete this image?");
            }
            function confirm_complete(){
                if(confirm("Do you want to submit all images and complete the challange?")){
                    location.href='complete-task.php?complete'; 
                } else {
                    return false;
                }
            }
            $(document).ready(function(e) {
                $("#form").on('submit', (function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: "php-includes/ajaxupload.php",
                        type: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function() {
                            //$("#preview").fadeOut();
                            $("#err").fadeOut();
                        },
                        success: function(data) {
                            if (data == 'invalid') {
                                // invalid file format.
                                $("#err").html("Invalid File !").fadeIn();
                            } else {
                                // view uploaded file.
                                $("#preview").append(data).fadeIn();
                                $("#form")[0].reset();
                            }
                        },
                        error: function(e) {
                            $("#err").html(e).fadeIn();
                        }
                    });
                }));
            });
        </script>

</body>

</html>