<?php
    @include 'confg.php';
    // session_start();
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">


    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
 <link rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
  <!-- or -->
  <link rel="stylesheet"
  href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <style>       
        .user-box{
            position: absolute;
            top: 70%;
            right: 10%;
            width: 18rem;
            padding: .7rem 1rem;
            background: #fff;
            border-radius: 5px;
            text-transform: capitalize;
            color: #000;
            font-size: 12px;
            display: none;
            transition: .5s;
        }
        .user-box img{
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
        .main .user-box.active{
            display: block;
        }
        .user-box .span{
            text-transform: capitalize;
            color: #704ff3;
            font-size: 14px;
        }
    </style>
    <title>Document</title>
</head>
<body>
    <img src="img/overlay1.png" id="overlay" alt="">
    <header>
        <a href="#" class="logo"><img src="img/l_o_g_o.png"><span>DREAM</span></a>

        <ul class="navbar" style="list-style: none; text-align: left;">
            <li><a href="user_pages.php">Home</a></li>
            <li><a href="h_admin_messages.php">Admin Messages</a></li>
            <li><a href="h_leaverequest.php">Leave Request</a></li>
            <li><a href="h_complaint.php">Complaint</a></li>
        </ul>

        <div class="main">
            <a href="logout.php" class="user">LogOut</a>
        <i class="ri-user-fill" id="user-btn"></i>
        <div class="user-box">
            <center><img src="img/<?php echo $_SESSION['user_image']; ?>"></center>
            <p>username: <span><?php echo $_SESSION['user_name']?></span></p>
            <p>email: <span><?php echo $_SESSION['user_email']?></span></p>
            <p>contact: <span><?php echo $_SESSION['user_contact']?></span></p>
            <p>room no.: <span><?php echo $_SESSION['user_roomno']?></span></p>
            <p>address: <span><?php echo $_SESSION['user_address']?></span></p>
            <p>Mother's contact: <span><?php echo $_SESSION['user_mothercontact']?></span></p>
            <p>father's contact: <span><?php echo $_SESSION['user_fathercontact']?></span></p></div>
            <div class="bx bx-menu" id="menu-icon"></div>
        </div>
    </header>

    <!-- JS file -->
    <script>let menu = document.querySelector('#menu-icon');
        let navbar = document.querySelector('.navbar');
        menu.onclick = () => {
            menu.classList.toggle('bx-x');
            navbar.classList.toggle('open');
        }
    </script>

    <script>
        let userbtn = document.querySelector('#user-btn');
        userbtn.addEventListener('click', function(){
            let userbox = document.querySelector('.user-box');
            userbox.classList.toggle('active');
        })
    </script>


</body>
</html>