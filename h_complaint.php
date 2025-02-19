<?php

@include 'confg.php';
session_start();

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $roomno = $_POST['roomno'];
    $submittedon = $_POST['submittedon'] ?? '';
    $complaint = $_POST['complaint'];

            $insert = "INSERT INTO complaints(name, roomno, submittedon, complaint) VALUES('$name','$roomno','$submittedon','$complaint')";
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
    <style>
        form::-webkit-scrollbar{
            width: 0;
        }
    </style>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- NAVIGATION BAR -->
    <?php include 'h_header.php'?>
    
    <!-- Main Page -->
    <div class="form-container">
        <form action="" method="post"  style="width: 70%;">
            <center><h3>Complaint registration</h3></center>


            <input type="hidden" name="name" value="<?php echo $_SESSION['user_name'];?>" required>
            <input type="hidden" name="roomno" value="<?php echo $_SESSION['user_roomno'];?>" required>
            <input type="hidden" name="submittedon" value="<?php echo date('d-m-Y'); ?>">

            <h5>Complaint</h5>
            <textarea name="complaint"  placeholder="Enter your complaint" rows="5" required></textarea>
            <input type="submit" name="submit" value="Submit" class="form-btn">
        </form>

        <form action="" method="" style="width: 100%; max-height: 400px; overflow-y: scroll;">
            <center><h3>Your complaints</h3></center>

            <ul class="item-list" id="item-list">
            <?php
            $name=$_SESSION['user_name'];
            $roomno=$_SESSION['user_roomno'];
            $select_products = mysqli_query($conn, "SELECT * FROM complaints WHERE name='$name'") or die('query failed');
            if(mysqli_num_rows($select_products) > 0){
                while($fetch_products = mysqli_fetch_assoc($select_products)){
            ?>
                <li class="item" id="item"><span>Hosteller Name: <b><?php echo $fetch_products['name']; ?></b></span><br>
                <span>Room No.: <b><?php echo $fetch_products['roomno']; ?></b></span><br>
                <span>Submitted On: <b><?php echo $fetch_products['submittedon']; ?></b></span><br>
                <span>Complaint: <b><?php echo $fetch_products['complaint']; ?></b></span><br><br>
                <span> <b><?php echo $fetch_products['feedback']; ?></b></span><br>
                <!-- <a><.-?php echo $fetch_products['status']; ?></a><br> -->
            </li>
                <?php        
                }
            }
            ?>
            </ul>
        </form>
    </div>


    <script>
        document.getElementById("current-date").value = new Date().toISOString();
    </script>
    
</body>
</html>