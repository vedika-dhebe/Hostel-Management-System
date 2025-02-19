<?php

@include 'confg.php';
session_start();

    
if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $user_type = $_POST['user_type'];

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="hostelinfo.css">
</head>
<body>
    <!-- NAVIGATION BAR -->
    <?php include 'h_header.php'?>

    <!-- Main Page -->
<div class="form-container">
<h3>Your Profile</h3>
            <?php
                if(isset($_SESSION['user_name'])){
                    $user_name =$_SESSION['user_name'];
                    $edit_query = mysqli_query($conn, "SELECT * FROM `registered` WHERE name= '$user_name' ") or die('query failed');
                    $res = mysqli_fetch_assoc($edit_query);
                    if(ls_array($res) > 0){
                        $_SESSION['email']
                        while($fetch_edit = mysqli_fetch_assoc($edit_query)){
                            
            ?>
                <form>
                <!-- <div class="hostelinfo"> -->
                <p><span>Full Name:</span><br> <?php echo $res['name']; ?></p>
                <p><span>Room number:</span><br> <?php echo $res['roomno']; ?></p>
                <p><span>Contact:</span><br> <?php echo $res['contact']; ?></p>
                <p><span>Email:</span><br> <?php echo $res['email']; ?></p>
                <p><span>Address:</span><br> <?php echo $res['address']; ?></p>
                <p><span>Mother's Contact:</span><br> <?php echo $res['mothercontact']; ?></p>
                <p><span>Father's Contact:</span><br> <?php echo $res['fathercontact']; ?></p>
                <!-- </div> -->
                <input type="reset" value="cancel" class="option-btn btn" id="close-edit">
                </form>
                <?php
                        }
                    }
                    echo "<script>document.querySelector('.update-container').style.display='block';</script>";
                }
            ?>
            
    </div>
    <script type="text/javascript" src="script.js"></script>
    
</body>
</html>