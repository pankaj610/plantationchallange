<?php
require('php-includes/connect.php');
include('php-includes/check-login.php');
$user_email = $_SESSION['userid'];
function check_task_completed()
{
    global $con, $user_email;
    $query = mysqli_query($con, "select id from users where users.email = '$user_email' and status='done' ");
    if (mysqli_num_rows($query) > 0) {
        echo "<script>alert('You already have completed your task.');window.location.assign('tree.php');</script>";
    }
}
check_task_completed();

if (isset($_GET['complete'])) {
    $query = mysqli_query($con, "select * from tasks where user_id= (select id from users where users.email = '$user_email') ");
    if (mysqli_num_rows($query) > 0) {
        $sql = "UPDATE users SET status='done' WHERE users.email='$user_email' ";
        if (mysqli_query($con, $sql)) {
            echo "<script>alert('Task Completed');window.location.assign('tree.php');</script>";
        } else {
            echo "<script>alert('Could Not Complete Task');window.location.assign('complete-task.php');</script>";
        }
    } else {
        echo '<script>alert("Upload at least one photo of your task.");window.location.assign("index.php");</script>';
    }
}

if (isset($_GET['deleteimage'])) {
    $taskid = $_GET['deleteimage'];
    $query = mysqli_query($con, "delete from tasks where user_id= (select id from users where users.email = '$user_email') and id='$taskid' ");
    if ($query) {
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
                        <h4 class="page-header">Upload at least 3 photos of your task</h4>
                    </div>
                </div>

                <div class="col-md-12"> 
                    <form class="form-inline" id="uploadform" method="post" enctype="multipart/form-data">
                        <div class="row mx-0 d-inline">
                            <div class="form-group" style="float:left">
                                <div class="file-upload">
                                    <div class="file-select">
                                        <div class="file-select-button" id="fileName">Choose File</div>
                                        <div class="file-select-name" id="noFile">No file chosen...</div>
                                        <input type="file" id="uploadImage" accept="image/*" name="image">
                                    </div>
                                </div>

                                <!-- <label for="uploadImage">Upload Images</label> -->
                                 
                               
                                <!-- <input class="form-control-file custom-file-upload" id="uploadImage" type="file" accept="image/*" name="image" /> -->
                            </div>
                            <img id="spinner" src="dist/images/spinner.gif" style="width:40px;float:left;">

                            <input style="float:left;margin-top: 2px;margin-left: 12px;" class="btn btn-success" type="submit" value="Upload">
                            <input style="float:right" class="btn btn-info" type="submit" onclick="return confirm_complete();">
                        </div>
                        <br>
                        <div class="row" id="preview">
                            <?php
                            $tasks_list = mysqli_query($con, "select * from tasks where user_id = (select id from users where users.email = '$user_email')");
                            while ($task_row = $tasks_list->fetch_array()) {
                                echo "<a onclick='return confirm_delete();' href='complete-task.php?deleteimage=" . $task_row['id'] . "'>" . "<img width='200' class='preview_image' height='200' src='php-includes/" . $task_row['image_url'] . "' /></a>";
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
            function confirm_delete() {
                return confirm("Do you want to delete this image?");
            }

            function confirm_complete() {
                if (confirm("Do you want to submit all images and complete the challange?")) {
                    location.href = 'complete-task.php?complete';
                } else {
                    return false;
                }
            }
            $(document).ready(function(e) {
                $('#spinner').hide();
                $("#uploadform").on('submit', (function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: "php-includes/ajaxupload.php",
                        type: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function() {
                            $('#spinner').show();
                            //$("#preview").fadeOut();
                            $("#err").fadeOut();
                        },
                        success: function(data) {
                            $('#spinner').hide();
                            if (data == 'invalid') {
                                // invalid file format.
                                $("#err").html("Invalid File !").fadeIn();
                            } else {
                                // view uploaded file.
                                $("#preview").append(data).fadeIn();
                                $("#form")[0].reset();
                            }
                        },
                        complete: function(xhr) {
                            status.html(xhr.responseText);
                        },
                        error: function(e) {
                            $("#err").html(e).fadeIn();
                        }
                    });
                }));
            });
            $('#uploadImage').bind('change', function() {
                                        var filename = $("#uploadImage").val();
                                        if (/^\s*$/.test(filename)) {
                                            $(".file-upload").removeClass('active');
                                            $("#noFile").text("No file chosen...");
                                        } else {
                                            $(".file-upload").addClass('active');
                                            $("#noFile").text(filename.replace("C:\\fakepath\\", ""));
                                        }
                                    });
        </script>
     <style>
                                    .file-upload {
                                        display: block;
                                        text-align: center;
                                        font-family: Helvetica, Arial, sans-serif;
                                        font-size: 12px;
                                    }

                                    .file-upload .file-select {
                                        display: block;
                                        border: 2px solid #dce4ec;
                                        color: #34495e;
                                        cursor: pointer;
                                        height: 40px;
                                        line-height: 40px;
                                        text-align: left;
                                        background: #FFFFFF;
                                        overflow: hidden;
                                        position: relative;
                                    }

                                    .file-upload .file-select .file-select-button {
                                        background: #dce4ec;
                                        padding: 0 10px;
                                        display: inline-block;
                                        height: 40px;
                                        line-height: 40px;
                                    }

                                    .file-upload .file-select .file-select-name {
                                        line-height: 40px;
                                        display: inline-block;
                                        padding: 0 10px;
                                    }

                                    .file-upload .file-select:hover {
                                        border-color: #34495e;
                                        transition: all .2s ease-in-out;
                                        -moz-transition: all .2s ease-in-out;
                                        -webkit-transition: all .2s ease-in-out;
                                        -o-transition: all .2s ease-in-out;
                                    }

                                    .file-upload .file-select:hover .file-select-button {
                                        background: #34495e;
                                        color: #FFFFFF;
                                        transition: all .2s ease-in-out;
                                        -moz-transition: all .2s ease-in-out;
                                        -webkit-transition: all .2s ease-in-out;
                                        -o-transition: all .2s ease-in-out;
                                    }

                                    .file-upload.active .file-select {
                                        border-color: #3fa46a;
                                        transition: all .2s ease-in-out;
                                        -moz-transition: all .2s ease-in-out;
                                        -webkit-transition: all .2s ease-in-out;
                                        -o-transition: all .2s ease-in-out;
                                    }

                                    .file-upload.active .file-select .file-select-button {
                                        background: #3fa46a;
                                        color: #FFFFFF;
                                        transition: all .2s ease-in-out;
                                        -moz-transition: all .2s ease-in-out;
                                        -webkit-transition: all .2s ease-in-out;
                                        -o-transition: all .2s ease-in-out;
                                    }

                                    .file-upload .file-select input[type=file] {
                                        z-index: 100;
                                        cursor: pointer;
                                        position: absolute;
                                        height: 100%;
                                        width: 100%;
                                        top: 0;
                                        left: 0;
                                        opacity: 0;
                                        filter: alpha(opacity=0);
                                    }

                                    .file-upload .file-select.file-select-disabled {
                                        opacity: 0.65;
                                    }

                                    .file-upload .file-select.file-select-disabled:hover {
                                        cursor: default;
                                        display: block;
                                        border: 2px solid #dce4ec;
                                        color: #34495e;
                                        cursor: pointer;
                                        height: 40px;
                                        line-height: 40px;
                                        margin-top: 5px;
                                        text-align: left;
                                        background: #FFFFFF;
                                        overflow: hidden;
                                        position: relative;
                                    }

                                    .file-upload .file-select.file-select-disabled:hover .file-select-button {
                                        background: #dce4ec;
                                        color: #666666;
                                        padding: 0 10px;
                                        display: inline-block;
                                        height: 40px;
                                        line-height: 40px;
                                    }

                                    .file-upload .file-select.file-select-disabled:hover .file-select-name {
                                        line-height: 40px;
                                        display: inline-block;
                                        padding: 0 10px;
                                    }
                                </style>
</body>

</html>