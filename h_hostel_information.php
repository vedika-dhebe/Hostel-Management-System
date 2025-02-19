<?php

@include 'confg.php';
session_start();

if(isset($_POST['submit'])){
    $hostel_name =  $_POST['name'];
    $hostel_location =  $_POST['location'];
    $hostel_contacts =  $_POST['contacts'];
    $hostel_description =  $_POST['description'];
    $hostel_facilities =  $_POST['facilities'];
    $hostel_roomno =  $_POST['noofrooms'];
    $hostel_wings = $_POST['wings'] ;   

    $insert = "INSERT INTO hostel_info(name, location,contacts, description, facilities, noofrooms, wings) VALUES('$hostel_name', '$hostel_location', '$hostel_contacts', '$hostel_description', $hostel_facilities, '$hostel_roomno', '$hostel_wings')";
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
    <link rel="stylesheet" href="hostelinfo.css">
</head>
<body>
    <!-- NAVIGATION BAR -->
    <?php include 'h_header.php'?>

    <!-- Main Page -->
    <div class="form-container">
<div class="hostelinfobox">
            <center><h3>Hostel Information</h3></center>
            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM hostel_info") or die('query failed');
            if(mysqli_num_rows($select_products) > 0){
                while($fetch_products = mysqli_fetch_assoc($select_products)){
            ?>
                <div class="hostelinfo">
                
                <p><span>Hostel Name:</span><br> <?php echo $fetch_products['name']; ?></p>
                <p><span>Location:</span><br> <?php echo $fetch_products['location']; ?></p>
                <pre><span>Contacts:</span><br> <?php echo $fetch_products['contacts']; ?></pre>
                <p><span>Description:</span><br> <?php echo $fetch_products['description']; ?></p>
                <pre><span>Hostel Facilities:</span><br> <?php echo $fetch_products['facilities']; ?></pre>
                <p><span>Rooms In Hostel:</span><br> <?php echo $fetch_products['noofrooms']; ?></p>
                <p><span>Wings in hostel:</span><br> <?php echo $fetch_products['wings']; ?></p>
                </div>
                <?php        
                }
            }
            ?>

    </div>
   
</body>
</html>