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

    $insert = "INSERT INTO hostel_info(name, location, contacts, description, facilities, noofrooms, wings) VALUES('$hostel_name', '$hostel_location', '$hostel_contacts', '$hostel_description', '$hostel_facilities', '$hostel_roomno', '$hostel_wings')";
            mysqli_query($conn, $insert);
            // header('location:login_form.php');
};

// ----------------DELETE-----------------
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    // $select_delete_image = mysqli_query($conn, "SELECT image FROM `admin_messages` WHERE id = $delete_id") or die('query failed');
    // $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
    // unlink('image/'.$fetch_delete_image['image']);

    mysqli_query($conn, "DELETE FROM `hostel_info` WHERE id = '$delete_id'") or die('query failed');
};

/*---------------update products---------------*/
if(isset($_POST['update_product'])){
    $update_id = $_POST['update_id'];
    $update_name =  $_POST['update_name'];
    $update_location =  $_POST['update_location'];
    $update_contacts =  $_POST['update_contacts'];
    $update_description =  $_POST['update_description'];
    $update_facilities =  $_POST['update_facilities'];
    $update_roomno =  $_POST['update_noofrooms'];
    $update_wings = $_POST['update_wings'] ;
    
    
    // $update_p_img = $_FILES['update_p_image']['name'];
    // $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
    // $update_p_image_folder = 'image/'.$update_p_img;

    $update_query = mysqli_query($conn, "UPDATE `hostel_info` SET id='$update_id', name='$update_name', location='$update_location', contacts='$update_contacts', description='$update_description', facilities='$update_facilities', noofrooms='$update_wings', wings='$update_roomno' WHERE id='$update_id'") or die('query failed');


    if($update_query){
        // move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
        $message[]='product updated successfully';
        header('location:hostel_information.php');
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
</head>
<body>
    <!-- NAVIGATION BAR -->
    <?php include 'header.php'?>

    <!-- Main Page -->
    <div class="form-container">
        <form action="" method="post">
        <center><h3>Hostel Information</h3></center>

        <!-- IMAGE UPLOAD -->
        <!-- <div class="c">
            <div class="wrapper">
                <div class="image">
                    <img src="" alt="">
                </div>
            </div>
        </div> -->

<input type="text" name="name" placeholder="enter hostel name" required>
<input type="text" name="location" placeholder="Location of hostel" required>
<textarea name="contacts" class="contacts"  placeholder="Hostel Contacts" rows="5" required></textarea>
<!-- <input type="text" name="description" placeholder="Description About Hostel" rowspan="5" required> -->
<textarea name="description" class="description"  placeholder="Description About Hostel" rows="5" required></textarea>
<textarea name="facilities" class="facilities"  placeholder="Facilities Provided In Hostel" rows="5" required></textarea>
<input type="number" name="noofrooms" placeholder="Rooms In Hostel" required>
<input type="text" name="wings" placeholder="Wings in hostel" required>

<input type="submit" name="submit" value="Submit" class="form-btn">

</form>
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
                
                <a href="hostel_information.php?edit=<?php echo $fetch_products['id'] ?>" class="edit">edit</a>
                <a href="hostel_information.php?delete=<?php echo $fetch_products['id'] ?>" class="delete" onclick="return conform('delete this product')">delete</a>
                </div>
                <?php        
                }
            }
            ?>
        </div>

    </div>
    <section class="update-container">
            <?php
                if(isset($_GET['edit'])){
                    $edit_id = $_GET['edit'];
                    $edit_query = mysqli_query($conn, "SELECT * FROM `hostel_info` WHERE id= $edit_id ") or die('query failed');
                    if(mysqli_num_rows($edit_query) > 0){
                        while($fetch_edit = mysqli_fetch_assoc($edit_query)){
                            
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <!-- <img src="image/<-?php echo $fetch_edit['image']; ?>"> -->
                <input type="hidden" name="update_id" value="<?php echo $fetch_edit['id']; ?>">
                <input type="text" name="update_name" value="<?php echo $fetch_edit['name']; ?>">
                <textarea name="update_location"><?php echo $fetch_edit['location']; ?></textarea>
                <textarea name="update_contacts"><?php echo $fetch_edit['contacts']; ?></textarea>
                <textarea name="update_description"><?php echo $fetch_edit['description']; ?></textarea>
                <textarea name="update_facilities"><?php echo $fetch_edit['facilities']; ?></textarea>
                <input type="text" min="0" name="update_noofrooms" value="<?php echo $fetch_edit['noofrooms']; ?>">
                <input type="text" min="0" name="update_wings" value="<?php echo $fetch_edit['wings']; ?>">
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
    
</body>
</html>