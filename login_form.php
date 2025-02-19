<?php

@include 'confg.php';

session_start();

if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $user_type = $_POST['user_type'];

    $select ="SELECT * FROM registered WHERE email ='$email' && password = '$pass'";
    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
            $_SESSION['user_name']=$row['name'];
            $_SESSION['user_image']=$row['image'];
            $_SESSION['user_email']=$row['email'];
            $_SESSION['user_contact']=$row['contact'];
            $_SESSION['user_roomno']=$row['roomno'];
            $_SESSION['user_address']=$row['address'];
            $_SESSION['user_mothercontact']=$row['mothercontact'];
            $_SESSION['user_fathercontact']=$row['fathercontact'];
            header('location:user_pages.php');
        
    }else{
        $error[]='incorrect email or password';
    }
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="logister.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

</head>
<body>
    <div class="form-container">
        <form action="" method="post">
            <center><h3>Hosteller Login</h3></center>

            <?php
            if(isset($error)){
                foreach($error as $error){
                    echo '<span class="error-msg">'.$error.'</span>';
                };
            };
            ?>

            <input type="email" name="email" placeholder="enter your email" required>
            <i class="fa fa-envelope"></i>
            <input type="password" name="password" id="logpsw" placeholder="enter your password" required>
            <i class="fa-solid fa-eye" id="show-password3"></i> 
            <input type="submit" name="submit" value="login now" class="form-btn">
            <center><p>Don't have an account? <a href="register_form.php">register now</a></p>
            <p>Login as admin? <a href="login_admin.php">admin login</a></p></center>
            
        </form>
    </div>
    <script>
        const logpass = document.querySelector("#show-password3");
        const logpsw = document.querySelector("#logpsw");

        
        logpass.addEventListener("click" , function(){
        this.classList.toggle("fa-eye-slash");
        const type = logpsw.getAttribute("type") === "password" ? "text" : "password";
        logpsw.setAttribute("type", type);
        })

    </script>

</body>
</html>












<!-- <-?php

@include 'confg.php';

session_start();

if(isset($_POST['submit'])){
    // $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);
    // $cpass = md5($_POST['cpassword']);
    // $user_type = $_POST['user_type'];

    $select ="SELECT * FROM registered WHERE email ='$email' && password = '$pass'";
    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);

        // $_SESSION['admin_name']=$row['name'];
        // $_SESSION['admin_roomno']=$row['roomno'];
        // $_SESSION['admin_address']=$row['address'];
        // $_SESSION['admin_contact']=$row['contact'];
        // $_SESSION['admin_email']=$row['email'];
        // $_SESSION['admin_mothercontact']=$row['mothercontact'];
        // $_SESSION['admin_fathercontact']=$row['fathercontact'];
        header('location:user_pages.php');
    }else{
        $error[]='incorrect email or password';
    }
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

</head>
<body>
    <div class="form-container">
        <form action="" method="post">
            <h3>Hosteller Login</h3>

            <-?php
            if(isset($error)){
                foreach($error as $error){
                    echo '<span class="error-msg">'.$error.'</span>';
                };
            };
            ?>

            <input type="email" name="email" placeholder="enter your email" required>
            <i class="fa fa-envelope"></i>
            <input type="password" name="password" id="logpsw" placeholder="enter your password" required>
            <i class="fa-solid fa-eye" id="show-password3"></i> 
            <input type="submit" name="submit" value="login now" class="form-btn">
            <p>Don't have an account? <a href="register_form.php">register now</a></p>
            <p>Login as admin? <a href="login_admin.php">admin login</a></p>
        </form>
    </div>
    <script>
        const logpass = document.querySelector("#show-password3");
        const logpsw = document.querySelector("#logpsw");

        
        logpass.addEventListener("click" , function(){
        this.classList.toggle("fa-eye-slash");
        const type = logpsw.getAttribute("type") === "password" ? "text" : "password";
        logpsw.setAttribute("type", type);
        })

    </script>

</body>
</html> -->