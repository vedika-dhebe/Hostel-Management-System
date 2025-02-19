<?php

@include 'confg.php';
session_start();

if(isset($_POST['submit'])){
    $rules = $_POST['rules'];

            $insert = "INSERT INTO hostel_rules(rules) VALUES('$rules')";
            mysqli_query($conn, $insert);
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    
    <link rel="stylesheet" href="hostel_rules.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- NAVIGATION BAR -->
    <?php include 'h_header.php'?>
    
    <!-- Main Page -->

    <?php
        if(isset($error)){
            foreach($error as $error){
                echo '<span class="error-msg">'.$error.'</span>';
            };
        };
    ?>

    <div class="form-container">

        <form action="" method="">
        <center><h3>Hostel Rules</h3></center>
            <ul class="ruleslist">
            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM hostel_rules") or die('query failed');
            if(mysqli_num_rows($select_products) > 0){
                while($fetch_products = mysqli_fetch_assoc($select_products)){
            ?>
                <li class="rulesitem"><span><?php echo $fetch_products['rules']; ?></span><br>
                </li>
                <?php        
                }
            }
            ?>
            </ul>
        </form>
    </div>
    <script type="text/javascript" src="script.js"></script>
    
</body>
</html>