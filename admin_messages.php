<?php

@include 'confg.php';
session_start();

if(isset($_POST['submit'])){
    $admin_name = $_POST['admin_name'];
    $sent_date = $_POST['sent_date'];
    $message = $_POST['message'];

            $insert = "INSERT INTO admin_messages(admin_name, sent_date, message) VALUES('$admin_name','$sent_date','$message')";
            mysqli_query($conn, $insert);
            // header('location:login_form.php');
};


// ----------------DELETE-----------------
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    // $select_delete_image = mysqli_query($conn, "SELECT image FROM `admin_messages` WHERE id = $delete_id") or die('query failed');
    // $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
    // unlink('image/'.$fetch_delete_image['image']);

    mysqli_query($conn, "DELETE FROM `admin_messages` WHERE id = '$delete_id'") or die('query failed');
};

/*---------------update products---------------*/
if(isset($_POST['update_product'])){
    $update_id = $_POST['update_id'];
    $update_name = $_POST['update_name'];
    $update_sent_date = $_POST['update_sent_date'];
    $update_message = $_POST['update_message'];
    
    // $update_p_img = $_FILES['update_p_image']['name'];
    // $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
    // $update_p_image_folder = 'image/'.$update_p_img;

    $update_query = mysqli_query($conn, "UPDATE `admin_messages` SET id='$update_id', admin_name='$update_name', sent_date='$update_sent_date', message='$update_message' WHERE id='$update_id'") or die('query failed');


    if($update_query){
        // move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
        $message[]='product updated successfully';
        header('location:admin_messages.php');
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
    
    <?php
        if(isset($error)){
            foreach($error as $error){
                echo '<span class="error-msg">'.$error.'</span>';
            };
        };
    ?>

    <div class="form-container">
        <form action="" method="post" style="width: 60%;">
            <center><h3>Important Notification</h3></center>

            <input type="hidden" name="admin_name" value="<?php echo $_SESSION['admin_name']?>" required>
            <!-- <h5>Today's Date</h5> -->
            <input type="hidden" name="sent_date" id="current-date" required>
            <!-- <input type="hidden" name="submittedon" id="current-date" disabled> -->
            <!-- <h5>Message</h5> -->
            <textarea name="message" rows="3" placeholder="Message to be sent" required></textarea>
            <input type="submit" name="submit" value="Submit" class="form-btn">
        </form>

        <form action="" method="" style="width: 100%; overflow-y: scroll;">
        <center><h3>Notifications</h3></center>

            <ul>
            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM admin_messages") or die('query failed');
            if(mysqli_num_rows($select_products) > 0){
                while($fetch_products = mysqli_fetch_assoc($select_products)){
            ?>
            <li><span>Sent By: <?php echo $fetch_products['admin_name']; ?></span><br>
                <span>Sent On: <?php echo $fetch_products['sent_date']; ?></span><br>
                <span>Message: <?php echo $fetch_products['message']; ?></span><br>
                <a href="admin_messages.php?edit=<?php echo $fetch_products['id'] ?>" class="edit">edit</a>
                <a href="admin_messages.php?delete=<?php echo $fetch_products['id'] ?>" class="delete" onclick="return conform('delete this product')">delete</a>
            </li>
            
                <?php        
                }
            }
            ?>
        </form>

    </div>
    
    <section class="update-container">
            <?php
                if(isset($_GET['edit'])){
                    $edit_id = $_GET['edit'];
                    $edit_query = mysqli_query($conn, "SELECT * FROM `admin_messages` WHERE id= $edit_id ") or die('query failed');
                    if(mysqli_num_rows($edit_query) > 0){
                        while($fetch_edit = mysqli_fetch_assoc($edit_query)){
                            
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <!-- <img src="image/<-?php echo $fetch_edit['image']; ?>"> -->
                <input type="hidden" name="update_id" value="<?php echo $fetch_edit['id']; ?>">
                <input type="text" name="update_name" value="<?php echo $fetch_edit['admin_name']; ?>">
                <input type="text" min="0" name="update_sent_date" value="<?php echo $fetch_edit['sent_date']; ?>">
                <textarea name="update_message"><?php echo $fetch_edit['message']; ?></textarea>
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

    <script type="text/javascript" src="script.js"></script>
    <script>
    document.getElementById("current-date").value = new Date().toLocaleDateString();
    </script>
</body>
</html>