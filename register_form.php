<?php

@include 'confg.php';

if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $roomno = $_POST['roomno'];
    $contact = $_POST['contact'];
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = $_POST['address'];
    $mothercontact =  $_POST['mothercontact'];
    $fathercontact = $_POST['fathercontact'];
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'img/'.$image;

    $select ="SELECT * FROM registered WHERE email ='$email' && password = '$pass'";
    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){
        $error[] = 'user already exists!';
    }else{
            if($pass != $cpass){
                $error[] = 'password does not match';
            }else{
            $insert = "INSERT INTO registered(image, name, roomno, contact, email, address, mothercontact, fathercontact, password) VALUES('$image','$name', '$roomno', '$contact', '$email', '$address', '$mothercontact', '$fathercontact', '$pass')";
            $insert_query = mysqli_query($conn, $insert);

            if($insert_query){
                if($image_size > 2000000){
                    $error[] = 'product image size is too large';
                }else{
                    move_uploaded_file($image_tmp_name, $image_folder);
                    $error[] = 'registered successfully';
                }
            }
            header('location:login_form.php');
        }
    }
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Form</title>
    <link rel="stylesheet" href="logister.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
	
</head>
<body>
    <div class="form-container">
        <form action="" method="post" style="width: 90%;">
            <center><h3>Hosteller Register</h3></center>

            <?php
            if(isset($error)){
                foreach($error as $error){
                    echo '<span class="error-msg">'.$error.'</span>';
                };
             };
            ?>

            <h5>Your Profile Image</h5>
            <input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/webp" required>

            <h5>Full Name</h5>
            <input type="text" name="name" placeholder="enter your name" required>
            <i class="fas fa-user" id="show-code"></i>
            
            <h5>Room Number</h5>
            <input type="text" name="roomno" placeholder="Enter Your Room Number" required>
            <i class="fa-solid fa-door-closed" id="show-code"></i>

            <h5>Contact Number</h5>
            <input type="number" name="contact" placeholder="Enter Your Contact Number" required>
            <i class="fas fa-phone" id="show-code"></i>
            
            <h5>Your Email</h5>
            <input type="email" name="email" placeholder="enter your email" required>
            <i class="fa fa-envelope" id="show-code"></i>

            
            <h5>Permanent Address</h5>
            <textarea name="address" class="address"  placeholder="Your Permanent Address" rows="5" required></textarea>
            <i class="fas fa-map-marker" id="show-code"></i>
            
            <h5>Mother's/Gaurdian's Contact</h5>
            <input type="number" name="mothercontact" placeholder="Mother's/Gaurdian's Contact" required>
            <i class="fas fa-phone" id="show-code"></i>
            
            <h5>Father's/Gaurdian's Contact</h5>
            <input type="number" name="fathercontact" placeholder="Father's/Gaurdian's Contact" required>
            <i class="fas fa-phone" id="show-code"></i>

            <h5>Create A Password</h5>
            <input type="password" name="password" class="form-control" id="psw" placeholder="enter your password" onclick="myInput.onfocus =function()" required>
            <i class="fa-solid fa-eye" id="show-password"></i> 

            <div id="validation_box">
                <h4>Password Must Contain The Following</h4>
                <p id="letter" class="invalid"><b>Lowecase Letters</b></p>
                <p id="capital" class="invalid"><b>Uppercase Letters</b></p>
                <p id="number" class="invalid"><b>A Number</b></p>
                <p id="characters" class="invalid"><b>At Least 8 Characters</b></p>
            </div>
            
            <h5>Confirm Your Password</h5>
            <input type="password" name="cpassword" id="cpass" placeholder="confirm your password" required>
            <i class="fa-solid fa-eye" id="show-password2"></i>
            <input type="submit" name="submit" value="register now" class="form-btn">

            <center><p>Already have an account? <a href="login_form.php">login now</a></p></center>
            
            
        </form>
    </div>
    <script type="text/javascript" src="registration.js"></script>
</body>
</html>