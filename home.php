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

    <title>Home</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <style>
        .panel-body {
            height: 100px;
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
                    <div class="col-lg-6">
                        <h1 class="page-header">Summary </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <?php
                    $query = mysqli_query($con, "select * from income where userid='$userid'");
                    $result = mysqli_fetch_array($query);
                    ?>
                    <!-- <div class="col-lg-3">
                        <div class="panel panel-info" onclick="location.href='tree.php';">
                            <div class="panel-heading">
                                <h4 class="panel-title">Total Planted Tree</h4>
                            </div>
                            <div class="panel-body">
                                5
                                <?php
                                // echo $result['day_bal']
                                ?>
                                <br />
                            </div>
                        </div>
                    </div> -->
                    <div class="col-lg-3 col-md-6" data-reactid="309">
                        <div class="panel-primary panel panel-default" data-reactid="310">
                            <div class="panel-heading" data-reactid="311">
                                <div class="row panel-title" data-reactid="312">
                                    <div class="col-xs-3" data-reactid="313"><i class="fa fa-tree fa-5x" data-reactid="314"></i></div>
                                    <div class="col-xs-9 text-right" data-reactid="315">
                                        <div class="huge" data-reactid="316"> 5</div>
                                        <div data-reactid="317">Total Planted Tree</div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer" data-reactid="318"><a href="tree.php" data-reactid="319"><span class="pull-left" data-reactid="320">View Details</span><span class="pull-right" data-reactid="321"><i class="fa fa-arrow-circle-right" data-reactid="322"></i></span>
                                    <div class="clearfix" data-reactid="323"></div>
                                </a></div>
                        </div>
                    </div>
                    <!-- <div class="col-lg-3">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h4 class="panel-title">Today's Planted Tree</h4>
                            </div>
                            <div class="panel-body">
                               
                            </div>
                        </div>
                    </div> -->
                    <div class="col-lg-3 col-md-6" data-reactid="324">
                        <div class="panel-green panel panel-default" data-reactid="325">
                            <div class="panel-heading" data-reactid="326">
                                <div class="row panel-title" data-reactid="327">
                                    <div class="col-xs-3" data-reactid="328"><i class="fa fa-tachometer fa-5x" data-reactid="329"></i></div>
                                    <div class="col-xs-9 text-right" data-reactid="330">
                                        <div class="huge" data-reactid="331"> 5
                                            <?php
                                            echo $result['current_bal']
                                            ?>
                                        </div>
                                        <div data-reactid="332">Today's Planted Tree</div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer" data-reactid="333"><a href="/" data-reactid="334"><span class="pull-left" data-reactid="335">View Details</span><span class="pull-right" data-reactid="336"><i class="fa fa-arrow-circle-right" data-reactid="337"></i></span>
                                    <div class="clearfix" data-reactid="338"></div>
                                </a></div>
                        </div>
                    </div>
                    <!-- <div class="col-lg-3">
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <h4 class="panel-title">Total Member Joined</h4>
                            </div>
                            <div class="panel-body">
                                
                            </div>
                        </div>
                    </div> -->
                    <div class="col-lg-3 col-md-6" data-reactid="339">
                        <div class="panel-yellow panel panel-default" data-reactid="340">
                            <div class="panel-heading" data-reactid="341">
                                <div class="row panel-title" data-reactid="342">
                                    <div class="col-xs-3" data-reactid="343"><i class="fa fa-users fa-5x" data-reactid="344"></i></div>
                                    <div class="col-xs-9 text-right" data-reactid="345">
                                        <div class="huge" data-reactid="346">
                                            <?php
                                            // SELECT COUNT(users.id)
                                            // FROM users
                                            //     INNER JOIN online
                                            //         ON online.ID = users.ID
                                            // WHERE users.id = 'myuser';
                                            // $query = mysqli_query($con,"select * from users inner join users on users.id = users.under_id where users.id = '$userid'; ");
                                            $query = mysqli_query($con, "select * from users where under_user = (select id from users where users.email = '$userid')");
                                            $result = mysqli_fetch_array($query);
                                            echo mysqli_num_rows($query);
                                            ?></div>
                                        <div data-reactid="347">Total Member Joined</div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer" data-reactid="348"><a href="/" data-reactid="349"><span class="pull-left" data-reactid="350">View Details</span><span class="pull-right" data-reactid="351"><i class="fa fa-arrow-circle-right" data-reactid="352"></i></span>
                                    <div class="clearfix" data-reactid="353"></div>
                                </a></div>
                        </div>
                    </div>
                    <!-- <div class="col-lg-3">
                        <div class="panel panel-warning">
                            <div class="panel-heading">
                                <h4 class="panel-title">Total Members Uncompleted</h4>
                            </div>
                            <div class="panel-body">
                                
                            </div>
                        </div>
                    </div> -->
                    <div class="col-lg-3 col-md-6" data-reactid="354">
                        <div class="panel-red panel panel-default" data-reactid="355">
                            <div class="panel-heading" data-reactid="356">
                                <div class="row panel-title" data-reactid="357">
                                    <div class="col-xs-3" data-reactid="358"><i class="fa fa-minus-circle fa-5x" data-reactid="359"></i></div>
                                    <div class="col-xs-9 text-right" data-reactid="360">
                                        <div class="huge" data-reactid="361">
                                            <?php
                                            echo  mysqli_num_rows(mysqli_query($con, "select * from pin_list where userid='$userid' and status='open'"));
                                            ?></div>
                                        <div data-reactid="362">Pending Member Task</div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer" data-reactid="363"><a href="/" data-reactid="364"><span class="pull-left" data-reactid="365">View Details</span><span class="pull-right" data-reactid="366"><i class="fa fa-arrow-circle-right" data-reactid="367"></i></span>
                                    <div class="clearfix" data-reactid="368"></div>
                                </a></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12 col">
                        <div class="panel panel-primary" id="chartPanelChart">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Tree Plantation Chart</h3>
                            </div>
                            <div class="panel-body">
                                <div class="flot-chart">
                                    <div id="chartContainer"></div>
                                </div>
                                <!-- <div class="text-right">
                                    <a href="#">View Details <i class="fa fa-arrow-circle-right"></i></a>
                                </div> -->
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-6 col-sm-12 col-xs-12 col">
                    <div class="panel panel-primary" id="chartPanelPie">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Completed/Pending Tasks</h3>
                            </div>
                            <div class="panel-body">
                                <div class="flot-chart">
                                     <div id="pieChartContainer"></div>
                                </div>
                                <!-- <div class="text-right">
                                    <a href="#">View Details <i class="fa fa-arrow-circle-right"></i></a>
                                </div> -->
                            </div>
                        </div>
                    </div>


                    <style>
                        @media (min-width: 768px) {
                            #chartContainer {
                                height: 400px;
                                width: 100%;
                                float: left;
                            }

                            #pieChartContainer {
                                height: 400px;
                                width: 100%;
                                float: left;
                            }
                            #chartPanelChart{
                                height: 500px;
                            }
                            #chartPanelPie{
                                height: 500px;
                            }
                        }

                        @media (max-width: 768px) {
                            #chartContainer {
                                height: 300px;
                                width: 100%;
                                float: left;
                            }

                            #pieChartContainer {
                                height: 350px;
                                width: 100%;
                                float: left;
                            }
                            #chartPanelChart{
                                height: 370px;
                            }
                            #chartPanelPie{
                                height: 420px;
                            }
                        }
                    </style>


                    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                    <script type="text/javascript">
                        var chart = new CanvasJS.Chart("pieChartContainer", {
                            animationEnabled: true,
                            title: {
                                text: "Completed/Pending Tasks"
                            },
                            data: [{
                                radius: 100,
                                type: "pie",
                                startAngle: 240,
                                yValueFormatString: "##0.00\"%\"",
                                indexLabel: "{label} {y}",
                                dataPoints: [{
                                        y: 79,
                                        label: "Completed",
                                        color: "lightgreen",
                                    },
                                    {
                                        y: 21,
                                        label: "Pending",
                                        color: "red",
                                    },
                                ]
                            }]
                        });
                        chart.render();
                    </script>
                    <script type="text/javascript">
                        window.onload = function() {
                            var chart = new CanvasJS.Chart("chartContainer", {
                                animationEnabled: true,
                                title: {
                                    text: "Tree Plantation Chart"
                                },
                                axisX: {
                                    title: "Date",
                                    gridThickness: 2
                                },
                                axisY: {
                                    title: "Total Plants"
                                },
                                data: [{
                                    type: "area",
                                    dataPoints: [{
                                            x: new Date(2012, 01, 1),
                                            y: 26
                                        },
                                        {
                                            x: new Date(2012, 01, 3),
                                            y: 38
                                        },
                                        {
                                            x: new Date(2012, 01, 5),
                                            y: 43
                                        },
                                        {
                                            x: new Date(2012, 01, 7),
                                            y: 29
                                        },
                                        {
                                            x: new Date(2012, 01, 11),
                                            y: 41
                                        },
                                        {
                                            x: new Date(2012, 01, 13),
                                            y: 54
                                        },
                                        {
                                            x: new Date(2012, 01, 20),
                                            y: 66
                                        },
                                        {
                                            x: new Date(2012, 01, 21),
                                            y: 60
                                        },
                                        {
                                            x: new Date(2012, 01, 25),
                                            y: 53
                                        },
                                        {
                                            x: new Date(2012, 01, 27),
                                            y: 60
                                        }

                                    ]
                                }]
                            });

                            chart.render();
                        }
                    </script>
                    <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
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