<?php
// session_start();
// require('php-includes/connect.php');
// $email = mysqli_real_escape_string($con,$_POST['email']);
// $password = mysqli_real_escape_string($con,$_POST['password']);

// $query = mysqli_query($con,"select * from user where email='$email' and password='$password'");
// if(mysqli_num_rows($query)>0){
// 	$_SESSION['userid'] = $email;
// 	$_SESSION['id'] = session_id();
// 	$_SESSION['login_type'] = "user";

// 	echo '<script>alert("Login Success.");window.location.assign("home.php");</script>';

// }
// else{
// 	echo '<script>alert("Email id or password is worng.");window.location.assign("index.php");</script>';
// }
?>

<?php
include('php-includes/connect.php');
// include('php-includes/check-login.php');
// $userid = $_SESSION['userid']; 

function checkUnderUser($underuserid)
{
    global $con;
    if($underuserid == 'padchinh'){ return true;}
    $query = mysqli_query($con, "select * from users where id='$underuserid'");
    if (mysqli_num_rows($query) > 0) {
        return true;
    } else {
        return false;
    }
}

function email_check($email)
{
    global $con;

    $query = mysqli_query($con, "select * from users where email='$email'");
    if (mysqli_num_rows($query) > 0) {
        return false;
    } else {
        return true;
    }
}
if (isset($_POST)) {
    if ($_POST['join_user'] ==  'join' && isset($_POST['underuser'])) {
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $gender = mysqli_real_escape_string($con, $_POST['gender']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
        $address = mysqli_real_escape_string($con, $_POST['address']);
        $occupation = mysqli_real_escape_string($con, $_POST['occupation']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $underuserid = mysqli_real_escape_string($con, $_POST['underuser']);
        $flag = 0;

        if ($name != '' && $gender != '' && $email != '' && $mobile != '' && $address != '' && $occupation != '' && $password != '' && $underuserid != '') {
            //User filled all the fields. 
            if (checkUnderUser($underuserid)) {
                //Pin is ok
                if (email_check($email)) {
                    $flag = 1;
                    //Email is ok
                    // if (!email_check($under_userid)) {
                    //     //Under userid is ok
                    //     if (side_check($under_userid, $side)) {
                    //         //Side check
                    //     } else {
                    //         echo '<script>alert("The side you selected is not available.");</script>';
                    //     }
                    // } else {
                    //     //check under userid
                    //     echo '<script>alert("Invalid Under userid.");</script>';
                    // }
                } else {
                    //check email
                    echo '<script>alert("This Email already registered.");</script>';
                    echo "<script>location.replace('newjoin.php')</script>";
                }
            } else {
                //check pin
                echo '<script>alert("Invalid Under User Id");</script>';
                echo "<script>location.replace('newjoin.php')</script>";
            }
        } else {
            //check all fields are fill
            echo '<script>alert("Please fill all the fields.");</script>';
            echo "<script>location.replace('newjoin.php')</script>";

        }
        if (isset($_POST['join_user'])) {
            if ($flag == 1) {

                //Insert into User profile
                $userid = uniqid();
                $query = mysqli_query($con, "insert into users(`id`,`doj`,`name`,`gender`,`email`,`mobile`,`address`,`occupation`,`password`,`under_user`, `status`) values('$userid',CURRENT_TIMESTAMP,'$name','$gender','$email','$mobile','$address','$occupation','$password', '$underuserid', 'pending')");

                //Insert into Tree
                //So that later on we can view tree.
                // $query = mysqli_query($con, "insert into tree(`userid`) values('$email')");

                //Insert to side
                // $query = mysqli_query($con, "update tree set `$side`='$email' where userid='$under_userid'");

                //Update pin status to close
                // $query = mysqli_query($con, "update pin_list set status='close' where pin='$pin'");

                //Inset into Icome
                // $query = mysqli_query($con, "insert into income (`userid`) values('$email')");
                echo mysqli_error($con);
                //This is the main part to join a user\
                //If you will do any mistake here. Then the site will not work.

                //Update count and Income.
                // $temp_under_userid = $under_userid;
                // $temp_side_count = $side . 'count'; //leftcount or rightcount

                // $temp_side = $side;
                // $total_count = 1;
                // $i = 1;
                // while ($total_count > 0) {
                //     $i;
                //     $q = mysqli_query($con, "select * from tree where userid='$temp_under_userid'");
                //     $r = mysqli_fetch_array($q);
                //     $current_temp_side_count = $r[$temp_side_count] + 1;
                //     $temp_under_userid;
                //     $temp_side_count;
                //     mysqli_query($con, "update tree set `$temp_side_count`=$current_temp_side_count where userid='$temp_under_userid'");

                //     //income
                //     if ($temp_under_userid != "") {
                //         $income_data = income($temp_under_userid);
                //         //check capping
                //         //$income_data['day_bal'];
                //         if ($income_data['day_bal'] < $capping) {
                //             $tree_data = tree($temp_under_userid);

                //             //check leftplusright
                //             //$tree_data['leftcount'];
                //             //$tree_data['rightcount'];
                //             //$leftplusright;

                //             $temp_left_count = $tree_data['leftcount'];
                //             $temp_right_count = $tree_data['rightcount'];
                //             //Both left and right side should at least 1 user
                //             if ($temp_left_count > 0 && $temp_right_count > 0) {
                //                 if ($temp_side == 'left') {
                //                     $temp_left_count;
                //                     $temp_right_count;
                //                     if ($temp_left_count <= $temp_right_count) {

                //                         $new_day_bal = $income_data['day_bal'] + 100;
                //                         $new_current_bal = $income_data['current_bal'] + 100;
                //                         $new_total_bal = $income_data['total_bal'] + 100;

                //                         //update income
                //                         mysqli_query($con, "update income set day_bal='$new_day_bal', current_bal='$new_current_bal', total_bal='$new_total_bal' where userid='$temp_under_userid' limit 1");
                //                     }
                //                 } else {
                //                     if ($temp_right_count <= $temp_left_count) {

                //                         $new_day_bal = $income_data['day_bal'] + 100;
                //                         $new_current_bal = $income_data['current_bal'] + 100;
                //                         $new_total_bal = $income_data['total_bal'] + 100;
                //                         $temp_under_userid;
                //                         //update income
                //                         if (mysqli_query($con, "update income set day_bal='$new_day_bal', current_bal='$new_current_bal', total_bal='$new_total_bal' where userid='$temp_under_userid'")) { }
                //                     }
                //                 }
                //             } //Both left and right side should at least 1 user

                //         }
                //         //change under_userid
                //         $next_under_userid = getUnderId($temp_under_userid);
                //         $temp_side = getUnderIdPlace($temp_under_userid);
                //         $temp_side_count = $temp_side . 'count';
                //         $temp_under_userid = $next_under_userid;

                //         $i++;
                //     }

                //     //Chaeck for the last user
                //     if ($temp_under_userid == "") {
                //         $total_count = 0;
                //     }
                // } //Loop




                // echo mysqli_error($con);     
                session_start();
                $_SESSION['userid'] = $email;
                $_SESSION['id'] = session_id();
                $_SESSION['login_type'] = "user";

                echo '<script>alert("Account Created");</script>';
                echo "<script>location.replace('home.php')</script>";
            }


            //Now we are heree
            //It means all the information is correct
            //Now we will save all the information

        }
    }
}
$capping = 500;
?>
<?php
//User cliced on join

?>
<!--/join user-->
<?php
//functions


// function pin_check($pin)
// {
//     global $con, $userid;

//     $query = mysqli_query($con, "select * from pin_list where pin='$pin' and userid='$userid' and status='open'");
//     if (mysqli_num_rows($query) > 0) {
//         return true;
//     } else {
//         return false;
//     }
// }

// function side_check($email, $side)
// {
//     global $con;

//     $query = mysqli_query($con, "select * from tree where userid='$email'");
//     $result = mysqli_fetch_array($query);
//     $side_value = $result[$side];
//     if ($side_value == '') {
//         return true;
//     } else {
//         return false;
//     }
// }
// function income($userid)
// {
//     global $con;
//     $data = array();
//     $query = mysqli_query($con, "select * from income where userid='$userid'");
//     $result = mysqli_fetch_array($query);
//     $data['day_bal'] = $result['day_bal'];
//     $data['current_bal'] = $result['current_bal'];
//     $data['total_bal'] = $result['total_bal'];

//     return $data;
// }
// function tree($userid)
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
// function getUnderId($userid)
// {
//     global $con;
//     $query = mysqli_query($con, "select * from user where email='$userid'");
//     $result = mysqli_fetch_array($query);
//     return $result['under_userid'];
// }
// function getUnderIdPlace($userid)
// {
//     global $con;
//     $query = mysqli_query($con, "select * from user where email='$userid'");
//     $result = mysqli_fetch_array($query);
//     return $result['side'];
// }

?>