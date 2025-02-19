<?php

@include 'confg.php';
session_start();

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $roomno = $_POST['roomno'];
    $reason = $_POST['reason'];
    $address = $_POST['address'];
    $numofdays = $_POST['numofdays'];
    $leavedate = $_POST['leavedate'];
    $returndate = $_POST['returndate'];
    $selfcontact = $_POST['selfcontact'];
    $parentcontact = $_POST['parentcontact'];

            $insert = "INSERT INTO leave_request(name, roomno, reason, address, numofdays, leavedate, returndate, selfcontact, parentcontact, status) 
            VALUES('$name','$roomno','$reason','$address','$numofdays','$leavedate','$returndate','$selfcontact', '$parentcontact', 'pending')";
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
        <form action="" method="post" style="width: 90%;">
        <center><h3>Leave Request Application</h3></center>  
            <input type="hidden" name="name" value="<?php echo $_SESSION['user_name']?>" required>
            <input type="hidden" name="roomno" value="<?php echo $_SESSION['user_roomno'];?>" required>
            <h5>Reason For Visit</h5>
            <textarea name="reason"  placeholder="Reason For Visit" rows="5" required></textarea>
            <h5>Place to be Visited</h5>
            <textarea name="address"  placeholder="Adress of the Place to be Visited" rows="5" required></textarea>
            <h5>Leave Claimed For Days</h5>
            <input type="number" name="numofdays" placeholder="number of days leave is claimed for" required>
            <h5>Date Of Leaving</h5>
            <input type="date" name="leavedate" placeholder="leaving date" required>
            <h5>Date Of Returning</h5>
            <input type="date" name="returndate" placeholder="returning date" required>
            <h5>Your Contact</h5>
            <input type="number" name="selfcontact" placeholder="your contact number" required>
            <h5>Mother's Contact</h5>
            <input type="number" name="parentcontact" placeholder="Contact of person to be visited" required>
<input type="submit" name="submit" value="Submit" class="form-btn">

</form>


<form action="" method="post" style="width: 100%; max-height: 400px; overflow-y: scroll;">
            <center><h3>Your Requested Leaves</h3></center>

            <ul>
            <?php
            $name=$_SESSION['user_name'];
            $roomno=$_SESSION['user_roomno'];
            $select_products = mysqli_query($conn, "SELECT * FROM leave_request WHERE name='$name'") or die('query failed');
            if(mysqli_num_rows($select_products) > 0){
                while($fetch_products = mysqli_fetch_assoc($select_products)){
            ?>
                <li><span>Hosteller Name: <?php echo $fetch_products['name']; ?></span><br>
                <span>Room No.: <?php echo $fetch_products['roomno']; ?></span><br>
                <span>Reason to leave: <?php echo $fetch_products['reason']; ?></span><br>
                <span>Address: <?php echo $fetch_products['address']; ?></span><br>
                <span>Leave requested for days: <?php echo $fetch_products['numofdays']; ?></span><br>
                <span>Return Date: <?php echo $fetch_products['returndate']; ?></span><br>
                <span>Leave Date: <?php echo $fetch_products['leavedate']; ?></span><br>
                <span>Self Contact: <?php echo $fetch_products['selfcontact']; ?></span><br>
                <span>Parent's Contact: <?php echo $fetch_products['parentcontact']; ?></span><br>
                <span>Your application process is: <b><?php echo $fetch_products['status']; ?></b></span><br>
                </li>
                <?php        
                }
            }
            ?>
            </ul>
</form>
    </div>
    
</body>
</html>