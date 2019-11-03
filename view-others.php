<?php
include('php-includes/check-login.php');
include('php-includes/connect.php');
$userid = $_SESSION['userid'];
$result = mysqli_query($con, "select * from users where users.email='$userid' ");
if ($result) {
    $user_row = mysqli_fetch_array($result);
    $under_user_id = $user_row['id'];
} else {
    exit();
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

    <title>View Others</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

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
                        <h1 class="page-header">View Other Task</h1>
                    </div>
                </div>
                <?php
                if (isset($_GET['userid'])) {
                    $user_id = $_GET['userid'];
                    $user_tasks = mysqli_query($con, "select * from tasks where user_id = '$user_id'; ");
                    echo "<h1>Task Completed By:<b>" . $result = mysqli_query($con, "select * from users where users.id='$user_id' ")->fetch_array()['name'] . "</b></h1>";
                    while ($row = mysqli_fetch_array($user_tasks)) {
                        echo  "
                                    <img  width='200' class='preview_image' height='200' src='php-includes/" . $row['image_url'] . "' />
                                ";
                    }
                }
                ?>

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

</body>

</html>