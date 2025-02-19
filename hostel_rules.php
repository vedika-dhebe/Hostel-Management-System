<?php

@include 'confg.php';
session_start();

if(isset($_POST['submit'])){
    $rules = $_POST['rules'];

            $insert = "INSERT INTO hostel_rules(rules) VALUES('$rules')";
            mysqli_query($conn, $insert);
            // header('location:login_form.php');
};

// ----------------DELETE-----------------
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    // $select_delete_image = mysqli_query($conn, "SELECT image FROM `admin_messages` WHERE id = $delete_id") or die('query failed');
    // $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
    // unlink('image/'.$fetch_delete_image['image']);

    mysqli_query($conn, "DELETE FROM `hostel_rules` WHERE id = '$delete_id'") or die('query failed');
};

/*---------------update products---------------*/
if(isset($_POST['update_product'])){
    $update_id = $_POST['update_id'];
    $update_rules = $_POST['update_rules'];
    
    // $update_p_img = $_FILES['update_p_image']['name'];
    // $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
    // $update_p_image_folder = 'image/'.$update_p_img;

    $update_query = mysqli_query($conn, "UPDATE `hostel_rules` SET id='$update_id', rules='$update_rules' WHERE id='$update_id'") or die('query failed');


    if($update_query){
        // move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
        $message[]='product updated successfully';
        header('location:hostel_rules.php');
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
    
    <link rel="stylesheet" href="hostel_rules.css">
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
        <form action="" method="post">
            <center><h3>Hostel Rules</h3></center>

            <input type="text" name="rules" class="rules" placeholder="Enter New Hostel Rule" required>
            <!-- <select name="user_type">
                <option value="user">Mess</option>
                <option value="user">Hostel</option>
            </select> -->
            <input type="submit" name="submit" value="Submit" class="form-btn">
        </form>

        <form action="" method="">
            

            <ul class="ruleslist">
            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM hostel_rules") or die('query failed');
            if(mysqli_num_rows($select_products) > 0){
                while($fetch_products = mysqli_fetch_assoc($select_products)){
            ?>
                <li class="rulesitem"><div class="rule"><span><?php echo $fetch_products['rules']; ?></span><br></div>
                <div class="butonbox">

                <a href="hostel_rules.php?edit=<?php echo $fetch_products['id'] ?>" class="edite"><ion-icon name="pencil"></ion-icon></a>
                <a href="hostel_rules.php?delete=<?php echo $fetch_products['id'] ?>" class="deletee" onclick="return conform('delete this product')"><ion-icon name="trash-outline"></ion-icon></a>
                <!-- <a href="hostel_rules.php?edit=<-?php echo $fetch_products['id'] ?>" class="edite">edit</a> -->
                <!-- <a href="hostel_rules.php?delete=<-?php echo $fetch_products['id'] ?>" class="deletee" onclick="return conform('delete this product')">delete</a> -->
                </div>
                </li>
                <?php        
                }
            }
            ?>
            </ul>
        </form>
    </div>
    
    <section class="update-container">
            <?php
                if(isset($_GET['edit'])){
                    $edit_id = $_GET['edit'];
                    $edit_query = mysqli_query($conn, "SELECT * FROM `hostel_rules` WHERE id= $edit_id ") or die('query failed');
                    if(mysqli_num_rows($edit_query) > 0){
                        while($fetch_edit = mysqli_fetch_assoc($edit_query)){
                            
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="update_id" value="<?php echo $fetch_edit['id']; ?>">
                <textarea name="update_rules"><?php echo $fetch_edit['rules']; ?></textarea>
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

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    
</body>
</html>