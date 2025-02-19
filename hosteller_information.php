<?php

@include 'confg.php';
session_start();

if(isset($_POST['submit'])){
    $student_name =  $_POST['name'];
    $student_roomno =  $_POST['roomno'];
    $student_contact =  $_POST['contact'];
    $student_email =  $_POST['email'];
    $student_address =  $_POST['address'];
    $student_mothercontact =  $_POST['mothercontact'];
    $student_fathercontact = $_POST['fathercontact'] ;   

    $insert = "INSERT INTO registered(name, roomno, contact, email, address, mothercontact, fathercontact) VALUES('$student_name', '$student_roomno', '$student_contact', '$student_email', '$student_address', '$student_mothercontact', '$student_fathercontact')";
            mysqli_query($conn, $insert);
            // header('location:login_form.php');
};

// ----------------DELETE-----------------
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    // $select_delete_image = mysqli_query($conn, "SELECT image FROM `admin_messages` WHERE id = $delete_id") or die('query failed');
    // $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
    // unlink('image/'.$fetch_delete_image['image']);

    mysqli_query($conn, "DELETE FROM `registered` WHERE id = '$delete_id'") or die('query failed');
};

/*---------------update products---------------*/
if(isset($_POST['update_product'])){
    $update_id = $_POST['update_id'];
    $update_student_name =  $_POST['update_name'];
    $update_student_roomno =  $_POST['update_roomno'];
    $update_student_contact =  $_POST['update_contact'];
    $update_student_email =  $_POST['update_email'];
    $update_student_address =  $_POST['update_address'];
    $update_student_mothercontact =  $_POST['update_mothercontact'];
    $update_student_fathercontact = $_POST['update_fathercontact'] ; 
    $update_p_img = $_FILES['update_p_image']['name'];
    $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
    $update_p_image_folder = 'img/'.$update_p_img;

    $update_query = mysqli_query($conn, "UPDATE `registered` SET id='$update_id', name='$update_student_name', roomno='$update_student_roomno', contact='$update_student_contact', email='$update_student_email', address='$update_student_address', mothercontact='$update_student_mothercontact', fathercontact='$update_student_fathercontact', image='$update_p_img' WHERE id='$update_id'") or die('query failed');


    if($update_query){
        // move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
        $message[]='product updated successfully';
        header('location:hosteller_information.php');
    }else{
        $message[]='product could not update successfully';
    }
}

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
    <link rel="stylesheet" href="update.css">
    
    <style>
        form::-webkit-scrollbar{
            width: 0;
        }
    </style>
</head>
<body>
    <!-- NAVIGATION BAR -->
    <?php include 'header.php'?>

    <!-- Main Page -->
    <div class="form-container">
            
        <form action="" method="post">
            <center><h3>Registered Hostellers</h3></center>
            <ul>
            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM registered") or die('query failed');
            if(mysqli_num_rows($select_products) > 0){
                while($fetch_products = mysqli_fetch_assoc($select_products)){
            ?>
                <li><img src="img/<?php echo $fetch_products['image']; ?>"><br>
                <span>Hosteller Name: <?php echo $fetch_products['name']; ?></span><br>
                <span>Room No.: <?php echo $fetch_products['roomno']; ?></span><br>
                <span>Reason to leave: <?php echo $fetch_products['contact']; ?></span><br>
                <span>Address: <?php echo $fetch_products['email']; ?>r</span><br>
                <span>Leave requested for days: <?php echo $fetch_products['address']; ?></span><br>
                <span>Return Date: <?php echo $fetch_products['mothercontact']; ?></span><br>
                <span>Leave Date: <?php echo $fetch_products['fathercontact']; ?></span><br>
                <a href="hosteller_information.php?edit=<?php echo $fetch_products['id'] ?>" class="edit">edit</a>
                <a href="hosteller_information.php?delete=<?php echo $fetch_products['id'] ?>" class="delete" onclick="return conform('delete this product')">delete</a>
                </li>
                <?php        
                }
            }
            ?>
            </ul>
        </form>

        <section class="update-container">
            <?php
                if(isset($_GET['edit'])){
                    $edit_id = $_GET['edit'];
                    $edit_query = mysqli_query($conn, "SELECT * FROM `registered` WHERE id= $edit_id ") or die('query failed');
                    if(mysqli_num_rows($edit_query) > 0){
                        while($fetch_edit = mysqli_fetch_assoc($edit_query)){
                            
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <img src="img/<?php echo $fetch_edit['image']; ?>">
                <input type="hidden" name="update_id" value="<?php echo $fetch_edit['id']; ?>">
                <input type="file" name="update_p_image" accept="image/jpg, image/jpeg, image/png, image/webp">
                <input type="text" name="update_name" value="<?php echo $fetch_edit['name']; ?>">
                <input type="number" min=0 name="update_roomno" value="<?php echo $fetch_edit['roomno']; ?>">
                <input type="number" min=0 name="update_contact" value="<?php echo $fetch_edit['contact']; ?>">
                <input type="email" name="update_email" value="<?php echo $fetch_edit['email']; ?>">
                <textarea name="update_address"><?php echo $fetch_edit['address']; ?></textarea>
                <input type="number" name="update_mothercontact" value="<?php echo $fetch_edit['mothercontact']; ?>">
                <input type="number" name="update_fathercontact" value="<?php echo $fetch_edit['fathercontact']; ?>">
                <!-- <input type="file" name="update_p_image" accept="image/jpg, image/jpeg, image/png, image/webp"> -->
                <input type="submit" name="update_product" value="update" class="edit">
                <input type="reset" value="cancel" class="option-btn btn" id="close-edit">
            </form>
            <?php
                        }
                    }
                    echo "<script>document.querySelector('.update-container').style.display='block';</script>";
                }
            ?>
    </section>

    </div>
    

    <script type="text/javascript" src="script.js"></script>
</body>
</html>