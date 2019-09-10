<?php
include('php-includes/connect.php');
include('php-includes/check-login.php');
$userid = $_SESSION['userid'];
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



</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include('php-includes/menu.php'); ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <?php
                if (isset($_REQUEST['viewtask'])) {
                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">My Task</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card" style="width:400px">
                                <img class="card-img-top" src="https://www.w3schools.com/bootstrap4/img_avatar1.png" alt="Card image" style="width:100%">
                                <div class="card-body">
                                    <h4 class="card-title">John Doe</h4>
                                    <p class="card-text">Some example text some example text. John Doe is an architect and engineer</p>
                                    <a href="#" class="btn btn-primary">See Profile</a>
                                </div>
                            </div>
                        </div>
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
                    <div class="row">
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
                                        <td>Completed<?php // echo $i 
                                                            ?></td>
                                        <td>16/Sept/2019<?php // echo $pin 
                                                            ?></td>
                                        <td>
                                            <a href="pin.php?viewtask"><button class="btn btn-success">View Task</button></a>
                                            <a href="pin.php?viewtask"><button class="btn btn-primary">Complete Task</button></a>
                                            <a href="pin.php?challangeothers"><button class="btn btn-info">Challange Others</button></a>
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

</body>

</html>