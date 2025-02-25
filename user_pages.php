<?php

@include 'confg.php';
session_start();

if(!isset($_SESSION['user_name'])){
    header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="header.css">
        <link rel="stylesheet" href="home_pages.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">


        <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
        <!-- or -->
        <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <style>       
        .user-box{
            position: absolute;
            top: 70%;
            right: 10%%;
            width: 18rem;
            padding: .7rem 1rem;
            background: #0080ff;
            border-radius: 5px;
            text-transform: capitalize;
            color: #fff;
            font-size: 12px;
            display: none;
            transition: .5s;
        }
        .main .user-box.active{
            display: block;
        }
        .user-box .span{
            text-transform: capitalize;
            color: #704ff3;
            font-size: 14px;
        }
        #item-list .item{
          background-image: url(img/bg.png);
        }
</style>
</head>
<body>
        <!-- NAVIGATION BAR -->
        <?php include 'h_header.php'?>


    <!-- MAIN PAGE -->
<div class="slideshow-container">

<div class="mySlides fade">
  <img src="img/slider.jpg" style="width:100%">
</div>

<div class="mySlides fade">
  <img src="img/slider_mess.png" style="width:100%">
</div>

<div class="mySlides fade">
  <div class="numbertext">Reading room</div>
  <img src="img/gym.jpg" style="width:100%"> 
</div>

</div>
<img src="img/overlay1.png" class="overlay" alt="">

<br>

<div style="text-align:center">
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
</div>

<script>
let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 2000); // Change image every 2 seconds
}
</script>


    <!-- MAIN PAGE -->

    <div class="rulinfo">
   <div class="item-list" id="item-list">
        <div class="item">
            <a href="h_hostel_rules.php">
            <!-- <i class="fa-solid fa-notebook"></i> -->
            <div class="p-details">
                <span>Hostel Rules</span>
            </div>
            </a>
        </div>
    
        <div class="item"><a href="h_hostel_information.php">
            <!-- <img src="images/bag2.jpg" alt=""> -->
            <div class="p-details">
                    <span>Hostel Information</span>
            </div>
            </a>
        </div>  
    </div>
   </div>

   <div class="contact">
   <div style="text-align:center">
    <h2>Hostel Admins</h2>
  </div>
   <div class="row" style="background: #fff; flex-wrap:wrap;">
  <?php
            $select_products = mysqli_query($conn, "SELECT * FROM admins") or die('query failed');
            if(mysqli_num_rows($select_products) > 0){
                while($fetch_products = mysqli_fetch_assoc($select_products)){
            ?>
    <div class="column" style="width: calc(100% / 3 - 5px);">

    <img style="width: 80px; height: 80px;" src="<?php echo $fetch_products['image']; ?>" alt=""><br>
    <span>Admin Name: <?php echo $fetch_products['name']; ?></span><br>
                <span>Contact: <?php echo $fetch_products['email']; ?></span><br>
                <span>Position: <?php echo isset($fetch_products['position']) ? $fetch_products['position'] : 'Not specified'; ?></span><br>
    </div>
    <?php        
                }
            }
            ?>
    
  </div></div>


   <div class="contact">
  <div style="text-align:center">
    <h2>Contact Us</h2>
  </div>
  <div class="row">
    <div class="column">
      <img src="img/slider3.2.jpg" style="width:100%">
    </div>
    <div class="column">
      <form action="/action_page.php">
        <label>Contact</label><br>
        <span>124567890</span><br>
        <span>9876543210</span><br>
        <br>
        <label>E-mail</label>
        <p>dreamhostel@mail.com</p>
      </form>
    </div>
  </div>
</div>
    </div>
    </body>
</html>