<?php
include('check-login.php');
include('../php-includes/connect.php');
$userid = $_SESSION['userid'];
$result = mysqli_query($con, "select * from users where users.email='$userid' ");
$row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<!-- Created by pdf2htmlEX (https://github.com/coolwanglu/pdf2htmlex) -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="stylesheet" href="base.min.css" />
    <link rel="stylesheet" href="fancy.min.css" />
    <link rel="stylesheet" href="main.css" />
    <script src="compatibility.min.js"></script>
    <script src="theViewer.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <script>
        try {
            theViewer.defaultViewer = new theViewer.Viewer({});
        } catch (e) {}
    </script>
    <title></title>
</head>

<body>
    <div id="sidebar">
        <div id="outline">
        </div>
    </div>
    <div id="page-container">
        <div id="pf1" class="pf w0 h0" data-page-no="1">
            <div class="pc pc1 w0 h0"><img class="bi x0 y0 w0 h0" alt="" src="bg1.png" />
                <div class="t m0 x1 h1 y1 ff1 fs0 fc0 sc0 ls0 ws0">#PLANTATION_CHALLENGE</div>
                <div class="t m0 x2 h2 y2 ff1 fs1 fc1 sc0 ls0 ws0">THIS�CERTIFICATE�IS�PROUDLY�PRESENTED�TO�</div>
                <div class="t m0 x3 h3 y3 ff2 fs2 fc0 sc0 ls0 ws0">Thanks for accepting Plantation challenge with PLANT -A-TREE and helping this will planet we all</div>
                <div class="t m0 x4 h3 y4 ff2 fs2 fc0 sc0 ls0 ws0">Share with your contribute we are able to help with global reforestation Efforts</div>
                <div class="t m0 x3 h3 y5 ff2 fs2 fc0 sc0 ls0 ws0"> <span class="_ _0"> </span>Which are helping clean the air we breath cleaning the water we drink reducing </div>
                <div class="t m0 x3 h3 y6 ff2 fs2 fc0 sc0 ls0 ws0">Biodiversity loss and reducing pollution from our atmosphere and having a posotive social impact</div>
                <div class="t m0 x5 h4 y7 ff1 fs3 fc1 sc0 ls0 ws0"><?php echo $row['name']; ?></div>
                <div class="t m0 x6 h5 y8 ff1 fs2 fc1 sc0 ls0 ws0">DATE</div>
                <div class="t m0 x7 h3 y9 ff2 fs2 fc1 sc0 ls0 ws0">DIRECTOR</div>
                <div class="t m0 x8 h3 ya ff2 fs2 fc0 sc0 ls0 ws0"><?php echo date("M d,Y"); ?></div>
            </div>
            <div class="pi" data-data='{"ctm":[1.000000,0.000000,0.000000,1.000000,0.000000,0.000000]}'></div>
        </div>
    </div>
    <div class="loading-indicator">

    </div>

</body>

</html>