<?php

@include 'confg.php';

session_start();

if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);

    $select ="SELECT * FROM admins WHERE email ='$email' && password = '$pass'";
    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);

        $_SESSION['admin_name']=$row['name'];
        $_SESSION['admin_email']=$row['email'];
        header('location:admin_pages.php');
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
            <center><h3>Admin Login</h3></center>

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
            <center><p>Register as hosteller? <a href="register_form.php">register now</a></p>
            <p>Login as hosteller? <a href="login_form.php">hosteller login</a></p></center>
            
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