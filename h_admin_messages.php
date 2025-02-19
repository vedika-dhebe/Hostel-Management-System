<?php

@include 'confg.php';
session_start();

if(isset($_POST['submit'])){
    $admin_name = $_POST['admin_name'];
    $sent_date = $_POST['sent_date'];
    $message = $_POST['message'];

            $insert = "INSERT INTO admin_messages(admin_name, sent_date, message) VALUES('$admin_name','$sent_date','$message')";
            mysqli_query($conn, $insert);
            // header('location:login_form.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <link rel="stylesheet" href="style.css">
    <style>
        form::-webkit-scrollbar{
            width: 0;
        }
    </style>
</head>
<body>
    <!-- NAVIGATION BAR -->
    <?php include 'h_header.php'?>

    <!-- Main Page -->
    
    <div class="form-container">
        <form action="" method=""  style="width: 100%; max-height: 400px; overflow-y: scroll;">
        <center><h3>Notifications</h3></center>

            <ul>
            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM admin_messages") or die('query failed');
            if(mysqli_num_rows($select_products) > 0){
                while($fetch_products = mysqli_fetch_assoc($select_products)){
            ?>
            <li><span>Sent By: <?php echo $fetch_products['admin_name']; ?></span><br>
                <span>Sent On: <?php echo $fetch_products['sent_date']; ?></span><br>
                <span>Message: <?php echo $fetch_products['message']; ?></span></li>
            
                <?php        
                }
            }
            ?>
        </form>
    </div>
</body>
</html>