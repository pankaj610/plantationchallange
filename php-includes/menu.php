<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="home.php"><img src="dist/images/logo.png"  /></a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right"> 
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-message">
                <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="home.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>

                <li>
                    <a href="pin.php"><i class="fa fa-adjust fa-fw"></i>My Tasks</a>
                </li>
                <li>
                    <a href="all-tasks.php"><i class="fa fa-adjust fa-fw"></i>All Tasks</a>
                </li>
                <li>
                    <a href="pin-request.php"><i class="fa fa-adjust fa-fw"></i> People Joined</a>
                </li>
                <!-- <li>
                    <a href="join.php"><i class="fa fa-adjust fa-fw"></i>Add Member</a>
                </li> -->
                <li>
                    <a href="tree.php"><i class="fa fa-adjust fa-hub"></i>Tree View</a>
                </li>
                <!-- <li>
                            <a href="payment-received-history.php"><i class="fa fa-adjust fa-hub"></i>Payment Received History</a>
                        </li> -->

            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>