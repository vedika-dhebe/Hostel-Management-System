<?php

@include 'confg.php';
session_start();

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $roomno = $_POST['roomno'];
    $submittedon = $_POST['submittedon'];
    $complaint = $_POST['complaint'];

            $insert = "INSERT INTO complaints(name, roomno, submittedon, complaint) VALUES('$name','$roomno','$submittedon','$complaint')";
            mysqli_query($conn, $insert);
            // header('location:login_form.php');
};

// ----------------DELETE-----------------
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    // $select_delete_image = mysqli_query($conn, "SELECT image FROM `admin_messages` WHERE id = $delete_id") or die('query failed');
    // $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
    // unlink('image/'.$fetch_delete_image['image']);

    mysqli_query($conn, "DELETE FROM `complaints` WHERE id = '$delete_id'") or die('query failed');
};


    /*---------------update products---------------*/
    if(isset($_POST['update_product'])){
        $update_id = $_POST['update_id'];
        $update_name = $_POST['update_name'];
        $update_roomno = $_POST['update_roomno'];
        $update_submittedon = $_POST['update_submittedon'];
        $update_complaint = $_POST['update_complaint'];
        $update_feedback = $_POST['update_feedback'];
        
        
        // $update_p_img = $_FILES['update_p_image']['name'];
        // $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
        // $update_p_image_folder = 'image/'.$update_p_img;

        $update_query = mysqli_query($conn, "UPDATE `complaints` SET id='$update_id', name='$update_name', roomno='$update_roomno', submittedon='$update_submittedon', complaint='$update_complaint', feedback='$update_feedback' WHERE id='$update_id'") or die('query failed');


        if($update_query){
            // move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
            $message[]='product updated successfully';
            header('location:complaint.php');
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
    <style>
        form::-webkit-scrollbar{
            width: 0;
        }
        .update-container form select{
            width:80%;
            padding: 10px 15px;
            font-size: 17px;
            margin: 8px 0;
            background: #eeeeeed7;
            border-radius: 5px;
        }
    </style>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="update.css">
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
        <form action="" method="post" style="width: 70%;">
            <center><h3>Complaint registration</h3></center>
            <h5>Full Name</h5>
            <input type="text" name="name" placeholder="enter your name" required>
            <h5>Room Number</h5>
            <input type="number" name="roomno" placeholder="enter your room number" required>
            <input type="hidden" name="submittedon" id="current-date" disabled>
            <h5>Complaint</h5>
            <textarea name="complaint"  placeholder="Enter your complaint" rows="5" required></textarea>
            <!-- <input type="text" name="complaint" placeholder="" required> -->
            <input type="submit" name="submit" value="Submit" class="form-btn">
        </form>

        <form class="abc" style="width: 60%;">
            <input type="text" name="" id="search-item" style="width: 95%;" placeholder="Search complaints" onkeyup="search()">
            <i class="fas fa-search"> </i>
        </form>


        <form action="" method="" style="width: 100%; overflow-y: scroll;">
            <center><h3>Registered complaints</h3></center>

            <ul class="item-list" id="item-list">
            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM complaints ORDER BY id DESC") or die('query failed');
            if(mysqli_num_rows($select_products) > 0){
                while($fetch_products = mysqli_fetch_assoc($select_products)){
            ?>
                <li class="item" id="item"><span>Hosteller Name: <?php echo $fetch_products['name']; ?></span><br>
                <span>Room No.: <?php echo $fetch_products['roomno']; ?></span><br>
                <span>Submitted On: <?php echo $fetch_products['submittedon']; ?></span><br>
                <span>Complaint: <?php echo $fetch_products['complaint']; ?></span><br>
                <b><a><?php echo $fetch_products['feedback']; ?></a></b><br>
                <!-- <span style="color: #dd0000;">Your application process is: <-?php echo $fetch_products['status']; ?></span><br> -->
                <a href="complaint.php?edit=<?php echo $fetch_products['id'] ?>" class="edit" name="edit">Take action</a>
                <a href="complaint.php?delete=<?php echo $fetch_products['id'] ?>" class="delete" onclick="return conform('delete this product')">delete</a>
                <!-- <a href="complaint.php?approve=<-?php echo $fetch_products['id'] ?>" class="approve" name="approve">approve</a> -->
                
                <!-- <input type="submit" class="form-btn" name="approve" value="Approve"> -->
                <!-- complaint.php?approve=<-?php echo $fetch_products['id'] ?> -->
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
                    $edit_query = mysqli_query($conn, "SELECT * FROM `complaints` WHERE id= $edit_id ") or die('query failed');
                    if(mysqli_num_rows($edit_query) > 0){
                        while($fetch_edit = mysqli_fetch_assoc($edit_query)){
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <!-- <img src="image/<-?php echo $fetch_edit['image']; ?>"> -->
                <input type="hidden" name="update_id" value="<?php echo $fetch_edit['id']; ?>">
                <input type="text" name="update_name" value="<?php echo $fetch_edit['name']; ?>">
                <input type="number" name="update_roomno" value="<?php echo $fetch_edit['roomno']; ?>">
                <input type="text" min="0" name="update_submittedon" value="<?php echo $fetch_edit['submittedon']; ?>">
                <textarea name="update_complaint"><?php echo $fetch_edit['complaint']; ?></textarea>
                <textarea name="update_feedback" placeholder="Remark"><?php echo $fetch_edit['feedback']; ?></textarea>

                <!-- <select name="update_status">
                <option value="pending">none</option>
                <option value="approved">approve</option>
                <option value="rejected">reject</option>
                </select> -->
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
    <script src="result.js"></script>
    <script>
    document.getElementById("current-date").value = new Date().toLocaleDateString();
</script>

</body>
</html>