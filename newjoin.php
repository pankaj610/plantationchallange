<?php 
include('php-includes/connect.php');  
?>

<?php 
    if(isset($_GET['getrefername'])){
        $code = $_GET['getrefername'];
        echo $refer_name = mysqli_query($con, "select * from users where users.id = '$code';")->fetch_array()['name'];
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
                        <h3 class="panel-title">Signup</h3>
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
                        <form method="post" action="createuser.php">
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
                                    <input type="text" name="mobile" maxlength="11" placeholder="Enter Your Mobile Number/Whatsapp Number" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="address" placeholder="Enter Your Address" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>User Description</label>
                                    <select type="text" name="occupation" placeholder="Enter Your Description/Occupation" class="form-control" required>
                                        <option value="Student">Student</option>
                                        <option value="Job">Job</option>
                                        <option value="Business">Business</option>
                                        <option value="Professional">Professional</option>
                                        <option value="Other">Other</option>
                                        <!-- <option value="jobgorp">Job Govt/Public Sector</option> -->
                                        <!-- <option value=""></option> -->
                                        <!-- <option></option> -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" placeholder="Enter Your Password" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Refer Id</label>
                                    <?php  
                                        
                                        // $refer_name = mysqli_query($con, "select * from users where users.id = '$refer';")->fetch_array()[0]['name'];
                                    ?>
                                    <input type="text" onchange="checkReferal(this.value)" name="refer" <?php if(isset($_GET['refer'])) {echo "disabled='true'";}?> value="<?php if(isset($_GET['refer'])){ $refer = $_GET['refer']; echo $refer; } else { echo '';} ?>" placeholder="Enter Referal Id" class="form-control">
                                    <script>
                                        function checkReferal(code){
                                            // $.post("newjoin.jsp", {suggest: txt}, function(result){
                                            //     $("span").html(result);
                                            //     });
                                                $.ajax({
                                                url: "newjoin.php?getrefername="+code,
                                                type: "GET",
                                                // data: new FormData(this),
                                                contentType: false,
                                                cache: false,
                                                processData: false,
                                                beforeSend: function() { 
                                                    document.getElementById('hidden_refer_id').value = code;
                                                },
                                                success: function(data) {
                                                    document.getElementById('refer_name').innerText = data; 
                                                    // if (data == 'invalid') {
                                                    //     // invalid file format.
                                                    //     $("#err").html("Invalid File !").fadeIn();
                                                    // } else {
                                                    //     // view uploaded file.
                                                    //     $("#preview").append(data).fadeIn();
                                                    //     $("#form")[0].reset();
                                                    // }
                                                },
                                                error: function(e) {
                                                    // $("#err").html(e).fadeIn();
                                                }
                                            });
                                        }
                                    </script>
                                </div>
                                <span>Refered By: <b id="refer_name"><?php if(isset($_GET['refer'])){   $refer = $_GET['refer'];
                                     echo $refer_name = mysqli_query($con, "select * from users where users.id = '$refer';")->fetch_array()['name']; 
                                     } else { echo 'Padchinh';} ?></b></span>
                                <div class="form-group text-right">
                                    <input type="hidden" id="hidden_refer_id" name="underuser" value="<?php if(isset($_GET['refer'])){ echo $_GET['refer'];} else { echo 'padchinh';} ?>">
                                    <input type="submit" name="join_user" class="btn btn-primary" value="join">
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