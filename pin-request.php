<?php
require('php-includes/connect.php');
include('php-includes/check-login.php');
$email = $_SESSION['userid'];
?>
<?php
//pin request 
if (isset($_GET['pin_request'])) {
    $amount = mysqli_real_escape_string($con, $_GET['amount']);
    $date = date("y-m-d");


    if ($amount != '') {
        //Inset the value to pin request
        $query = mysqli_query($con, "insert into pin_request(`email`,`amount`,`date`) values('$email','$amount','$date')");
        if ($query) {
            echo '<script>alert("Pin request sent successfully");window.location.assign("pin-request.php");</script>';
        } else {
            //echo mysqli_error($con);
            echo '<script>alert("Unknown error occure.");window.location.assign("pin-request.php");</script>';
        }
    } else {
        echo '<script>alert("Please fill all the fields");</script>';
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
                        <h1 class="page-header">Members Joined</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- <div class="row">
                	<div class="col-lg-4">
                    	<form method="get">	
                        	<div class="form-group">
                            	<label>Amount</label>
                                <input type="text" name="amount" class="form-control" required>
                            </div>
                            <div class="form-group">
                            	<input type="submit" name="pin_request" class="btn btn-primary" value="Pin Request">
                            </div>
                        </form>
                    </div>
                </div> -->

                <?php
                    $current_user_query_array = mysqli_query($con, "select * from users where users.email = '$email' ")->fetch_array();
                    $tree = array();
                    function generateTree($rootid)
                    {
                        global $con;
                        global $tree;
                        $root_user_array = mysqli_query($con, "select * from users where users.id = '$rootid';")->fetch_array();
                        array_push($tree, $root_user_array); 

                        $id = $root_user_array['id'];
                        $under_user_query = mysqli_query($con, "select * from users where under_user = $id ");
 
                        while ($row = mysqli_fetch_array($under_user_query)) {
                            generateTree($row['id']);
                        } 
                    }
                    generateTree($current_user_query_array['id']);
                ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading"><span class="panel-title">Total Member Joined </span></div>
                            <div class="panel-body">
                                <div>
                                    <div class="dataTable_wrapper" style="overflow:auto">
                                        <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                            <!-- <div class="row">
                                                <div class="col-sm-9">
                                                    <div class="dataTables_length" id="dataTables-example_length"><label for="show"> -->
                                                            <!-- react-text: 1178 --> 
                                                            <!-- Show -->
                                                            <!-- /react-text -->
                                                            <!-- <select name="dataTables-example_length" aria-controls="dataTables-example" class="form-control input-sm" id="show">
                                                                <option value="10">10</option>
                                                                <option value="25">25</option>
                                                                <option value="50">50</option>
                                                                <option value="100">100</option>
                                                            </select> -->
                                                            <!-- react-text: 1184 -->
                                                            <!-- entries -->
                                                            <!-- /react-text -->
                                                        <!-- </label></div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div id="dataTables-example_filter" class="dataTables_filter"><label for="search"> -->
                                                            <!-- react-text: 1188 -->
                                                            <!-- Search: -->
                                                            <!-- /react-text -->
                                                            <!-- <input type="search" class="form-control input-sm" placeholder="" aria-controls="dataTables-example" id="search"></label></div> -->
                                                <!-- </div>
                                            </div> -->
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info">
                                                        <thead>
                                                            <tr role="row">
                                                                <th class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending">Sr.</th>
                                                                <th class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending" style="width: 265px;">Name</th>
                                                                <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 321px;">Gender</th>
                                                                <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 299px;">Mobile</th>
                                                                <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 231px;">Address</th>
                                                                <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 180px;">Occupation</th>
                                                                <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 180px;">Task Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                                                $i=1;
                                                                foreach($tree as $row){
                                                                    $viewother = "";
                                                                    if($row['status'] == 'pending') {$color = "#1430B1";} 
                                                                    else if($row['status'] == "approved") { $color = "#42f548";$viewother = "onclick=viewOtherTask('".$row['id']."')";}
                                                                    else if($row['status'] == "done") { $color = "#00c0ff";}
                                                                    else if($row['status'] == "disapproved") { $color = "red";}
                                                                    
                                                                    echo "<tr ".$viewother.">"
                                                                            ."<td>".$i."</td>"
                                                                            ."<td>".$row['name']."</td>"
                                                                            ."<td>".$row['gender']."</td>"
                                                                            ."<td>".$row['mobile']."</td>"
                                                                            ."<td>".$row['address']."</td>"
                                                                            ."<td>".$row['occupation']."</td>"
                                                                            ."<td style='color: ".$color."'>".$row['status']."</td>"
                                                                        ."</tr>";
                                                                    $i++;
                                                                }
                                                            ?>
                                                           
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <script>
                                                function viewOtherTask(userid){
                                                    window.location = "view-others.php?userid="+userid;
                                                }
                                            </script>
                                            <!-- <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
                                                </div>
                                                <div class="col-sm-6 pullRight ">
                                                    <ul class="pagination">
                                                        <li class="disabled"><a role="button" href="" tabindex="-1" style="pointer-events: none;"><span aria-label="First">«</span></a></li>
                                                        <li class="disabled"><a role="button" href="" tabindex="-1" style="pointer-events: none;"><span aria-label="Previous">‹</span></a></li>
                                                        <li class="active"><a role="button" href="">1</a></li>
                                                        <li class=""><a role="button" href="">2</a></li>
                                                        <li class=""><a role="button" href="">3</a></li>
                                                        <li class=""><a role="button" href="">4</a></li>
                                                        <li class=""><a role="button" href="">5</a></li>
                                                        <li class=""><a role="button" href="">6</a></li>
                                                        <li class=""><a role="button" href=""><span aria-label="Next">›</span></a></li>
                                                        <li class=""><a role="button" href=""><span aria-label="Last">»</span></a></li>
                                                    </ul>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                    <!-- <div class="well">
                                        <h4>DataTables Usage Information</h4>
                                        <p> -->
                                            <!-- react-text: 1293 -->
                                            <!-- DataTables is a very flexible, advanced tables plugin for jQuery. In SB Admin, we are using a specialized version of DataTables built for Bootstrap 3. We have also customized the table headings to use Font Awesome icons in place of images. For complete documentation on DataTables, visit their website at -->
                                            <!-- /react-text -->
                                            <!-- <a target="_blank" rel="noopener noreferrer" href="https://datatables.net/">'https://datatables.net/'</a> -->
                                            <!-- react-text: 1295 -->.
                                            <!-- /react-text -->
                                        <!-- </p><a href="https://datatables.net/" class="btn btn-lg btn-default btn-block">View DataTables Documentation</a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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