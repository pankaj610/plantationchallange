<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Create Account</title>

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

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Create New User</h3>
                    </div>
                    <div class="panel-body">
                        <!-- <form method="post" action="login.php">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group  ">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                              
                                <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                            </fieldset>
                        </form> -->
                        <!-- <div class="row"> -->
                        <!-- <div class="col-lg-4"> -->
                        <form method="post" action="createuser.php?">
                            <fieldset>
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input type="text" placeholder="Enter Your Full Name" name="name" class="form-control" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label>Gender</label><br>
                                    <input type="radio" name="gender" value="male" checked> Male
                                    <input type="radio" name="gender" value="female"> Female
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" placeholder="Enter Your Email Address" name="email" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Mobile</label>
                                    <input type="text" name="mobile" placeholder="Enter Your Mobile Number/Whatsapp Number" class="form-control" required>
                                </div>
                                <!-- <div class="form-group">
                                    <label>Whatsapp Number</label>
                                    <input type="text" name="account" placeholder="Enter Your Whatsapp Number" class="form-control" required>
                                </div> -->
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="address" placeholder="Enter Your Address" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>User Description</label>
                                    <select type="text" name="occupation" placeholder="Enter Your Description/Occupation" class="form-control" required>
                                        <option value="student">Student</option>
                                        <!-- <option value="jobgorp">Job Govt/Public Sector</option> -->
                                        <!-- <option value=""></option> -->
                                        <!-- <option></option> -->
                                    </select>
                                </div>

                                <div class="form-group text-right">
                                    <input type="hidden" name="underuser" value="<?php echo '1';?>">
                                    <input type="submit" name="join_user" class="btn btn-primary" value="Join">
                                </div>
                            </fieldset>
                        </form>
                        <!-- </div> -->
                        <!-- </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

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