<?php
include('php-includes/connect.php');
include('php-includes/check-login.php');
$userid = $_SESSION['userid'];
$search = $userid;
?>
<?php

$current_user_query = mysqli_query($con, "select * from users where users.email = '$userid';");
$under_user_query = mysqli_query($con, "select * from users where under_user = (select id from users where users.email = '$userid')");
if ($current_user_query) {
    $current_user_query_array = mysqli_fetch_array($current_user_query);
} else {
    echo "<script>alert('not login')</script>";
    exit();
}
$taskdone = false;


// function tree_data($userid)
// {
//     global $con;
//     $data = array();
//     $query = mysqli_query($con, "select * from tree where userid='$userid'");
//     $result = mysqli_fetch_array($query);
//     $data['left'] = $result['left'];
//     $data['right'] = $result['right'];
//     $data['leftcount'] = $result['leftcount'];
//     $data['rightcount'] = $result['rightcount'];
//     return $data;
// }
?>
<?php
// if (isset($_GET['search-id'])) {
//     $search_id = mysqli_real_escape_string($con, $_GET['search-id']);
//     if ($search_id != "") {
//         $query_check = mysqli_query($con, "select * from user where email='$search_id'");
//         if (mysqli_num_rows($query_check) > 0) {
//             $search = $search_id;
//         } else {
//             echo '<script>alert("Access Denied");window.location.assign("tree.php");</script>';
//         }
//     } else {
//         echo '<script>alert("Access Denied");window.location.assign("tree.php");</script>';
//     }
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Mlml Website - Tree</title>
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
                        <h1 class="page-header">Tree</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table" align="center" border="0" style="text-align:center">
                                <tr height="150">
                                    <td> </td>
                                    <td colspan="2"><i class="fa fa-user fa-4x" style="<?php if ($current_user_query_array['status'] == 'pending') {
                                                                                            echo "color:#1430B1";
                                                                                            $taskdone = false;
                                                                                        } else {
                                                                                            echo "color:#42f548";
                                                                                            $taskdone = true;
                                                                                        } ?>"></i>
                                        <p><?php echo $current_user_query_array['name']; ?></p>
                                    </td>
                                    <td> </td>
                                </tr>
                                <?php if ($taskdone) { ?>
                                    <tr height="150">
                                        <?php
                                            $row = mysqli_num_rows($under_user_query);
                                            while ($under_user = $under_user_query->fetch_array()) {
                                                if ($under_user['status'] == 'pending') {
                                                    $status_color = "color:#1430B1";
                                                } else {
                                                    $status_color = "color:#42f548";
                                                }
                                                echo "<td colspan='2'><i class='fa fa-user fa-4x' style='" . $status_color . "'></i> <p> " . $under_user['name'] . " </p>";
                                            }
                                            ?>
                                    </tr>
                                <?php } else { ?>
                                    <tr height="150">
                                        <td> </td>
                                        <td colspan="2"><a href="complete-task.php" class="btn btn-success">Complete Your Task</a></td>
                                        <td> </td>
                                    </tr>
                                <?php } ?>

                            </table>
                        </div>
                    </div>
                </div> -->
            </div>
            <style>
                .flex-tree-container ul {
                    display: flex;
                    list-style: none;
                    padding-left: 0;
                    text-align: center;
                }

                .flex-tree-container ul>li {
                    box-sizing: border-box;
                    flex: 1;
                    padding: 0 5px;
                }

                .flex-tree-container ul>li>*:not(ul):not(li) {
                    border: 1px solid green;
                    display: inline-block;
                    margin: 0px auto;
                    padding: 4px 21px;
                    position: relative;
                    border-radius: 52%;
                }

                .flex-tree-container ul>li>*:not(ul):not(li):not(:last-child):after {
                    border-left: 1px solid green;
                    bottom: -30px;
                    content: "";
                    height: 30px;
                    left: 50%;
                    position: absolute;
                }

                .flex-tree-container ul>li ul {
                    margin-top: 59px;
                    position: relative;
                }

                .flex-tree-container ul>li ul li {
                    position: relative;
                }

                .flex-tree-container ul>li ul li:after,
                .flex-tree-container ul>li ul li:before {
                    border-top: 1px solid green;
                    content: "";
                    position: absolute;
                    top: -30px;
                    width: 50%;
                }

                .flex-tree-container ul>li ul li:before {
                    border-left: 1px solid green;
                    height: 30px;
                    left: 50%;
                }

                .flex-tree-container ul>li ul li:after {
                    right: 50%;
                }

                .flex-tree-container ul>li ul li:first-child:before,
                .flex-tree-container ul>li ul li:last-child:before {
                    border-top: 1px solid green;
                    border-top-left-radius: 10px;
                    top: -30px;
                }

                .flex-tree-container ul>li ul li:first-child:after,
                .flex-tree-container ul>li ul li:last-child:after {
                    border: none;
                }

                .flex-tree-container ul>li ul li:last-child:before {
                    border-left: 0;
                    border-right: 1px solid green;
                    border-top-left-radius: 0;
                    border-top-right-radius: 10px;
                    left: 0;
                    right: 50%;
                }

                .flex-tree-container ul>li ul li:only-child:before {
                    border-top: none;
                    border-top-right-radius: 0;
                }
            </style>
            <div class="container-fluid">
                <!-- Flexbox Testing -->
                <div class="flex-tree-container" style="overflow-x: scroll;">
                    <?php
                    $tree = "<ul>";
                    function generateTree($rootid)
                    {
                        global $con;
                        global $tree;
                        $root_user_array = mysqli_query($con, "select * from users where users.id = '$rootid';")->fetch_array();
                        $name = substr($root_user_array['name'], 0, 6);
                        if ($root_user_array['status'] == 'pending') {
                            $color = "#1430B1";
                            $viewother = "";
                        } else if ($root_user_array['status'] == 'done') {
                            $color = "#42f548";
                            $viewother = "onclick=viewOtherTask('" . $root_user_array['id'] . "')";
                        }
                        $tree .= "<li><p " . $viewother . "><i class='fa fa-user fa-4x' style='color:$color'></i><br><span>$name</span></p>";
                        $id = $root_user_array['id'];
                        $under_user_query = mysqli_query($con, "select * from users where under_user = $id ");

                        if (mysqli_num_rows($under_user_query) > 0) {
                            $tree .= "<ul>";
                        }
                        while ($row = mysqli_fetch_array($under_user_query)) {
                            generateTree($row['id']);
                        }
                        if (mysqli_num_rows($under_user_query) > 0) {
                            $tree .= "</ul>";
                        }

                        $tree .= "</li>";
                    }
                    generateTree($current_user_query_array['id']);
                    $tree .= "</ul>";
                    echo $tree;
                    ?>
                    <!-- <ul>
                        <li>
                            <p><i class="fa fa-user fa-4x" style="color:#42f548"></i><br><span>pankaj0</span></p>
                            <ul>
                                <li>
                                    <p><i class="fa fa-user fa-4x" style="color:#42f548"></i><br><span>pankaj11</span></p>
                                    <ul>
                                        <li>
                                            <p><i class="fa fa-user fa-4x" style="color:#42f548"></i><br><span>pankaj21</span></p>
                                        </li>

                                        <li>
                                            <p><i class="fa fa-user fa-4x" style="color:#42f548"></i><br><span>pankaj22</span></p>
                                        </li>
                                        <li>
                                            <p><i class="fa fa-user fa-4x" style="color:#42f548"></i><br><span>pankaj23</span></p>
                                            <ul>
                                                <li>
                                                    <p><i class="fa fa-user fa-4x" style="color:#42f548"></i><br><span>pankaj31</span></p>
                                                </li>
                                                <li>
                                                    <p><i class="fa fa-user fa-4x" style="color:#42f548"></i><br><span>pankaj32</span></p>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <p><i class="fa fa-user fa-4x" style="color:#42f548"></i><br><span>pankaj0</span></p>
                                    <ul>
                                        <li>
                                            <p><i class="fa fa-user fa-4x" style="color:#42f548"></i><br><span>pankaj11</span></p>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <p><i class="fa fa-user fa-4x" style="color:#42f548"></i><br><span>pankaj</span></p>
                                    <ul>
                                        <li>
                                            <p><i class="fa fa-user fa-4x" style="color:#42f548"></i><br><span>pankaj</span></p>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <p><i class="fa fa-user fa-4x" style="color:#42f548"></i><br><span>pankaj</span></p>
                                    <ul>
                                        <li>
                                            <p><i class="fa fa-user fa-4x" style="color:#42f548"></i><br><span>pankaj</span></p>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <p><i class="fa fa-user fa-4x" style="color:#42f548"></i><br><span>pankaj</span></p>
                                    <ul>
                                        <li>
                                            <p><i class="fa fa-user fa-4x" style="color:#42f548"></i><br><span>pankaj</span></p>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <p><i class="fa fa-user fa-4x" style="color:#42f548"></i><br><span>pankaj</span></p>
                                    <ul>
                                        <li>
                                            <p><i class="fa fa-user fa-4x" style="color:#42f548"></i><br><span>pankaj</span></p>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <p><i class="fa fa-user fa-4x" style="color:#42f548"></i><br><span>pankaj</span></p>
                                    <ul>
                                        <li>
                                            <p><i class="fa fa-user fa-4x" style="color:#42f548"></i><br><span>pankaj</span></p>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <p><i class="fa fa-user fa-4x" style="color:#42f548"></i><br><span>pankaj</span></p>
                                    <ul>
                                        <li>
                                            <p><i class="fa fa-user fa-4x" style="color:#42f548"></i><br><span>pankaj</span></p>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <p><i class="fa fa-user fa-4x" style="color:#42f548"></i><br><span>pankaj</span></p>
                                    <ul>
                                        <li>
                                            <p><i class="fa fa-user fa-4x" style="color:#42f548"></i><br><span>pankaj</span></p>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul> -->

                    <!-- Other -->
                    <!-- <ul>
                        <li>
                            <p><i class="fa fa-user fa-4x" style="color:#1430B1"></i><br><span>Pankaj</span></p>
                            <ul>
                                <li>
                                    <p><i class="fa fa-user fa-4x" style="color:#1430B1"></i><br><span>Cesar </span></p>
                                    <ul>
                                        <li>
                                            <p><i class="fa fa-user fa-4x" style="color:#1430B1"></i><br><span>Cesar </span></p>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li>
                                            <p><i class="fa fa-user fa-4x" style="color:#1430B1"></i><br><span>Pankaj</span></p>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <p><i class="fa fa-user fa-4x" style="color:#42f548"></i><br><span>Verma</span></p>
                                    <ul>
                                        <li>
                                            <p><i class="fa fa-user fa-4x" style="color:#42f548"></i><br><span>Nikki </span></p>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul> -->

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

    <script>
        function viewOtherTask(userid) {
            window.location = "view-others.php?userid=" + userid;
        }
    </script>
</body>

</html>