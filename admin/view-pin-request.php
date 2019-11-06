<?php
include('php-includes/check-login.php');
include('php-includes/connect.php');
$product_amount = 300;
?>
<?php
//Clicked on send buton
if (isset($_GET['viewtask'])) {
    $unfiltered_userid = $_GET['viewtask'];
    $userid = mysqli_real_escape_string($con, $unfiltered_userid);

    $tasks = mysqli_query($con, "select * from tasks where user_id = '$userid' ");

    while ($task = mysqli_fetch_array($tasks)) {
        echo "<a class='modalTaskImage' target='_blank' href='../php-includes/" . $task['image_url'] . "'>" . "<img width='250' align='center' class='preview_image' height='250' src='../php-includes/" . $task['image_url'] . "' /></a>";
    }
    exit();
    //updae pin request status
    // mysqli_query($con, "update pin_request set status='close' where id='$id' limit 1");

    // echo '<script>alert("Pin send successfully.");window.location.assign("view-pin-request.php");</script>';
}

if (isset($_GET['approve'])) {
    $unfiltered_userid = $_GET['approve'];
    $userid = mysqli_real_escape_string($con, $unfiltered_userid); 
    $tasks = mysqli_query($con, "update users set status='approved' where id = '$userid' and (status='done' or status='disapproved') ");
    if(mysqli_affected_rows($con) > 0){
        echo "approved";
        exit();
    } else {
        echo "User has not completed the task or Alredy approved.";
        exit();
    } 
}
if (isset($_GET['disapprove'])) {
    $unfiltered_userid = $_GET['disapprove'];
    $userid = mysqli_real_escape_string($con, $unfiltered_userid); 
    $tasks = mysqli_query($con, "update users set status='disapproved' where id = '$userid' and (status='done' or status='approved') ");
    if(mysqli_affected_rows($con) > 0){
        echo "disapproved";
        exit();
    } else {
        echo "User not found or has pending task.";
        exit();
    } 
}

//Pin generate
function pin_generate()
{
    global $con;
    $generated_pin = rand(100000, 999999);

    $query = mysqli_query($con, "select * from pin_list where pin = '$generated_pin'");
    if (mysqli_num_rows($query) > 0) {
        pin_generate();
    } else {
        return $generated_pin;
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

    <title>View Pin Request</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <style>
        .modalTaskImage img{
            margin:10px;
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
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Admin - View pin request</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
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
                                            <div class="modal fade" id="viewtaskmodal" role="dialog">
                                                <div class="modal-dialog">

                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">Modal Header</h4>
                                                        </div>
                                                        <div class="modal-body" id='modal-body'>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info">
                                                        <thead>
                                                            <tr role="row">
                                                                <th>S.n.</th>
                                                                <th>Userid</th>
                                                                <th>Name</th>
                                                                <th>Gender</th>
                                                                <th>Email</th>
                                                                <th>Mobile</th>
                                                                <th>Address</th>
                                                                <th>Occupation</th>
                                                                <th>Password</th>
                                                                <th>Refer</th>
                                                                <th>Status</th>
                                                                <th colspan='3' style='text-align:center'>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php
                                                            $query = mysqli_query($con, "select * from users;");
                                                            if (mysqli_num_rows($query) > 0) {
                                                                $i = 1;
                                                                while ($row = mysqli_fetch_array($query)) {
                                                                    $id = $row['id'];
                                                                    if($row['status'] == 'done'){
                                                                        $color = '#FFFFBF';
                                                                    } else if($row['status'] == 'approved'){
                                                                        $color = 'lightgreen';
                                                                    } else if($row['status'] == 'pending'){
                                                                        $color = '#ffcccb';
                                                                    } else if($row['status'] == 'disapproved'){
                                                                        $color = 'red';
                                                                    }
                                                                    ?>
                                                                    <tr id="taskrow<?php echo $id; ?>" style="background-color:<?php echo $color;?>">
                                                                        <td><?php echo $i; ?></td>
                                                                        <td><?php echo $id; ?></td>
                                                                        <td><?php echo $row['name']; ?></td>
                                                                        <td><?php echo $row['gender']; ?></td>
                                                                        <td><?php echo $row['email']; ?></td>
                                                                        <td><?php echo $row['mobile']; ?></td>
                                                                        <td><?php echo $row['address']; ?></td>
                                                                        <td><?php echo $row['occupation']; ?></td>
                                                                        <td><?php echo $row['password']; ?></td>
                                                                        <td><?php echo $row['under_user']; ?></td>
                                                                        <td id='status<?php echo $id; ?>'><?php echo $row['status']; ?></td>
                                                                        <td>
                                                                            <input class="btn btn-info" onclick="viewTask('<?php echo $id; ?>');" type="button" name="view" value="View">
                                                                        </td>
                                                                        <td>
                                                                            <input class="btn btn-success" onclick="approveTask('<?php echo $id; ?>');" type="button" name="approve" value="Approve">
                                                                        </td>
                                                                        <td>
                                                                            <input class="btn btn-danger" onclick="disApproveTask('<?php echo $id; ?>');" type="button" name="deny" value="Deny">
                                                                        </td>

                                                </div>
                                                </td>
                                                </tr>
                                            <?php
                                                    $i++;
                                                }
                                            } else {
                                                ?>
                                            <tr>
                                                <td colspan="6" align="center">You have no pin request.</td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                        </tbody>
                                        </table>
                                            </div>
                                        </div>
                                        <script>
                                            function disApproveTask(id){
                                                $.ajax({
                                                    url: "view-pin-request.php?disapprove=" + id,
                                                    type: "GET",
                                                    contentType: false,
                                                    cache: false,
                                                    processData: false,
                                                    beforeSend: function() {
                                                        // document.getElementById('hidden_refer_id').value = code;
                                                    },
                                                    success: function(data) { 
                                                        if(data.trim() == "disapproved"){
                                                            $("#status"+id).html("disapproved");
                                                            $("#taskrow"+id).css("background-color", "red");
                                                            alert("User Task Dispproved");
                                                        } else {
                                                            alert(data);
                                                        }

                                                    },
                                                    error: function(e) {
                                                        // $("#err").html(e).fadeIn();
                                                    }
                                                });
                                            }
                                            function viewTask(id) {
                                                $.ajax({
                                                    url: "view-pin-request.php?viewtask=" + id,
                                                    type: "GET",
                                                    contentType: false,
                                                    cache: false,
                                                    processData: false,
                                                    beforeSend: function() {
                                                        // document.getElementById('hidden_refer_id').value = code;
                                                    },
                                                    success: function(data) {
                                                        $('#modal-body').html(data);
                                                        $('#viewtaskmodal').modal({
                                                            show: 'true'
                                                        });
                                                    },
                                                    error: function(e) {
                                                        // $("#err").html(e).fadeIn();
                                                    }
                                                });
                                            }
                                            function approveTask(id) {
                                                $.ajax({
                                                    url: "view-pin-request.php?approve=" + id,
                                                    type: "GET",
                                                    contentType: false,
                                                    cache: false,
                                                    processData: false,
                                                    beforeSend: function() {
                                                        // document.getElementById('hidden_refer_id').value = code;
                                                    },
                                                    success: function(data) { 
                                                        if(data.trim() == "approved"){
                                                            $("#status"+id).html("approved");
                                                            $("#taskrow"+id).css("background-color", "lightgreen");
                                                            alert("User Task Approved");
                                                        } else {
                                                            alert(data);
                                                        }

                                                    },
                                                    error: function(e) {
                                                        // $("#err").html(e).fadeIn();
                                                    }
                                                });
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