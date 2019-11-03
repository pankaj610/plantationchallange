<?php
include('php-includes/connect.php');
include('php-includes/check-login.php');
$userid = $_SESSION['userid'];
$base_url = "network";
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Mlml Website - Pin</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <style>
        .preview_image {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin: 3px;
        }
    </style>


</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include('php-includes/menu.php'); ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <?php
                if (isset($_GET['viewtask'])) {
                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">My Task</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <div id="preview">
                            <?php
                                $tasks_list = mysqli_query($con, "select * from tasks where user_id = (select id from users where users.email = '$userid')");
                                while ($task_row = $tasks_list->fetch_array()) {
                                    echo "<a href='php-includes/" . $task_row['image_url'] . "' ><img  class='preview_image' style='width:300px;height:300px;'  src='php-includes/" . $task_row['image_url'] . "' /></a>";
                                }
                                ?>
                        </div>

                        <!-- <div class="col-lg-12">
                            <div class="card" style="width:400px">
                                <img class="card-img-top" src="https://www.w3schools.com/bootstrap4/img_avatar1.png" alt="Card image" style="width:100%">
                                <div class="card-body">
                                    <h4 class="card-title">John Doe</h4>
                                    <p class="card-text">Some example text some example text. John Doe is an architect and engineer</p>
                                    <a href="#" class="btn btn-primary">See Profile</a>
                                </div>
                            </div>
                        </div> -->
                    </div>
                <?php
                } else if (isset($_GET['completetask'])) {
                    ?>


                <?php
                } else {
                    ?>


                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">My Task</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <!-- <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Task Status</th>
                                        <th>Task Date</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php
                                        // $i=1;
                                        // $query = mysqli_query($con,"select * from pin_list where userid='$userid' and status='open'");
                                        // if(mysqli_num_rows($query)>0){
                                        // 	while($row=mysqli_fetch_array($query)){
                                        // 		$pin = $row['pin'];
                                        ?>
                                    <tr>
                                        <td><?php
                                                $current_user_query = mysqli_query($con, "select * from users where users.email = '$userid';");
                                                while ($user_row = $current_user_query->fetch_array()) {
                                                    if ($user_row['status'] == 'done')
                                                        echo "<span style='color:green'>Completed</span>";
                                                    else if ($user_row['status'] == 'pending')
                                                        echo "<span style='color:red'>Pending</span>";
                                                }
                                                ?></td>
                                        <td>16/Sept/2019<?php // echo $pin 
                                                            ?></td>
                                        <td>
                                            <?php
                                                $current_user_query = mysqli_query($con, "select * from users where users.email = '$userid';");
                                                while ($user_row = $current_user_query->fetch_array()) {
                                                    if ($user_row['status'] == 'done')
                                                        echo "<a href='pin.php?viewtask'><button class='btn btn-success'>View Task</button></a>";
                                                    else if ($user_row['status'] == 'pending')
                                                        echo "<a href='complete-task.php'><button class='btn btn-primary'>Complete Task</button></a>";
                                                }
                                                ?>
                                            <?php
                                                $_SERVER;
                                                echo '<button class="btn btn-info" onclick="shareFunction()">Challange Others</button>';
                                                $share_url = 'whatsapp://send?text=http://' . $_SERVER['HTTP_HOST'] . '/' . $base_url . '/newjoin.php';
                                                echo '<script>
                                                        function shareFunction() { 
                                                            window.location.replace("' . $share_url . '");
                                                        }
                                                    </script>';

                                                ?>

                                            <?php // echo $pin 
                                                ?></td>
                                    </tr>
                                    <?php
                                        // 		$i++;
                                        // 	}
                                        // }
                                        // else{
                                        ?>
                                    <tr>
                                        <td colspan="3">Sorry you have no pin.</td>
                                    </tr>
                                    <?php
                                        // }
                                        ?>
                                </table>

                            </div>
                        </div>
                    </div> -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading"><span class="panel-title">Tasks <span style="color:red">Pending</span>/<span style="color:green">Completed</span></span></div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Task Name</th>
                                                    <th>Task Status</th>
                                                    <th>Task Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                    // $i=1;
                                                    // $query = mysqli_query($con,"select * from pin_list where userid='$userid' and status='open'");
                                                    // if(mysqli_num_rows($query)>0){
                                                    // 	while($row=mysqli_fetch_array($query)){
                                                    // 		$pin = $row['pin'];
                                                    ?>
                                                <tr>
                                                    <td>
                                                        Plantation Challange
                                                    </td>
                                                    <td><?php
                                                            $current_user_query = mysqli_query($con, "select * from users where users.email = '$userid';");
                                                            while ($user_row = $current_user_query->fetch_array()) {
                                                                if ($user_row['status'] == 'done')
                                                                    echo "<span style='color:green'>Completed</span>";
                                                                else if ($user_row['status'] == 'pending')
                                                                    echo "<span style='color:red'>Pending</span>";
                                                            }
                                                            ?></td>
                                                    <td>16/Sept/2019<?php // echo $pin 
                                                                        ?></td>
                                                    <td>
                                                        <?php
                                                            $current_user_query = mysqli_query($con, "select * from users where users.email = '$userid';");
                                                            while ($user_row = $current_user_query->fetch_array()) {
                                                                if ($user_row['status'] == 'done')
                                                                    echo "<a href='pin.php?viewtask'><button class='btn btn-success'>View Task</button></a>";
                                                                else if ($user_row['status'] == 'pending')
                                                                    echo "<a href='complete-task.php'><button class='btn btn-primary'>Complete Task</button></a>";
                                                            }
                                                            ?>
                                                        <?php
                                                            $_SERVER;
                                                            echo '<button class="btn btn-info" onclick="shareFunction()">Challange Others</button>';
                                                            $user_id = mysqli_query($con, "select * from users where users.email = '$userid';")->fetch_array()['id'];
                                                            $share_url = 'whatsapp://send?text=http://' . $_SERVER['HTTP_HOST'] . '/' . $base_url . '/newjoin.php?refer='.$user_id;
                                                            echo '<script>
                                                                    function shareFunction() { 
                                                                        window.location.replace("' . $share_url . '");
                                                                    }
                                                                </script>';

                                                            ?>

                                                        <?php // echo $pin 
                                                            ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
                <!--/.row-->
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
        function show_image() {
            alert("Show Image");
        }
    </script>
</body>

</html>