<?php

@include 'confg.php';
session_start();

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $roomno = $_POST['roomno'];
    $reason = $_POST['reason'];
    $address = $_POST['address'];
    $numofdays = $_POST['numofdays'];
    $leavedate = $_POST['leavedate'];
    $returndate = $_POST['returndate'];
    $selfcontact = $_POST['selfcontact'];
    $parentcontact = $_POST['parentcontact'];

            $insert = "INSERT INTO leave_request(name, roomno, reason, address, numofdays, leavedate, returndate, selfcontact, parentcontact) 
            VALUES('$name','$roomno','$reason','$address','$numofdays','$leavedate','$returndate','$selfcontact', 'parentcontact')";
            mysqli_query($conn, $insert);
};

// ----------------DELETE-----------------
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];

    mysqli_query($conn, "DELETE FROM `leave_request` WHERE id = '$delete_id'") or die('query failed');
};

/*---------------update products---------------*/
if(isset($_POST['update_product'])){
    $update_id = $_POST['update_id'];
    $update_name = $_POST['update_name'];
    $update_roomno = $_POST['update_roomno'];
    $update_reason = $_POST['update_reason'];
    $update_address = $_POST['update_address'];
    $update_numofdays = $_POST['update_numofdays'];
    $update_leavedate = $_POST['update_leavedate'];
    $update_returndate = $_POST['update_returndate'];
    $update_selfcontact = $_POST['update_selfcontact'];
    $update_parentcontact = $_POST['update_parentcontact'];
    $update_status = $_POST['update_status'];

    $update_query = mysqli_query($conn, "UPDATE `leave_request` SET id='$update_id', name='$update_name', roomno='$update_roomno', reason='$update_reason', address='$update_address', numofdays='$update_numofdays', leavedate='$update_leavedate', returndate='$update_returndate', selfcontact='$update_selfcontact', parentcontact='$update_parentcontact', status='$update_status' WHERE id='$update_id'") or die('query failed');

    if($update_query){
        $message[]='product updated successfully';
        header('location:leaverequest.php');
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
        <form action="" method="post" style="width: 90%;">
            <center><h3>Leave Request Application</h3></center>
            <h5>Full Name</h5>
            <input type="text" name="name" placeholder="Enter Your Name" required>
            <h5>Room Number</h5>
            <input type="number" name="roomno" placeholder="Enter Your Room Number" required>
            <h5>Reason For Visit</h5>
            <textarea name="reason"  placeholder="Reason For Visit" rows="5" required></textarea>
            <h5>Address of place to be visited</h5>
            <textarea name="address"  placeholder="Address of the Place to be Visited" rows="5" required></textarea>
            <h5>number of days leave is claimed for </h5>
            <input type="number" name="numofdays" placeholder="number of days claimed for leave" required>
            <h5>Date of leaving</h5>
            <input type="date" name="leavedate" placeholder="leaving date" required>
            <h5>Date of returning</h5>
            <input type="date" name="returndate" placeholder="returning date" required>
            <h5>Your contact number</h5>
            <input type="number" name="selfcontact" placeholder="your contact number" required>
            <h5>Parent's contact</h5>
            <input type="number" name="parentcontact" placeholder="your parent's contact number" required>

            <input type="submit" name="submit" value="Submit" class="form-btn">
        </form>

        <form class="abc" style="width: 60%;">
            <input type="text" name="" id="search-item" style="width: 95%;" placeholder="Search complaints" onkeyup="search()">
            <i class="fas fa-search"> </i>
        </form>


        <form action="" method="post" style="width: 100%; max-height: 400px; overflow-y: scroll;">
            <center><h3>Requested Leaves</h3></center>
            <ul class="item-list" id="item-list">
            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM leave_request WHERE status='pending' ORDER BY id DESC") or die('query failed');
            if(mysqli_num_rows($select_products) > 0){
                while($fetch_products = mysqli_fetch_assoc($select_products)){
            ?>
                <li class="item" id="item"><span>Hosteller Name: <?php echo $fetch_products['name']; ?></span><br>
                <span>Room No.: <?php echo $fetch_products['roomno']; ?></span><br>
                <span>Reason to leave: <?php echo $fetch_products['reason']; ?></span><br>
                <span>Address: <?php echo $fetch_products['address']; ?></span><br>
                <span>Leave requested for days: <?php echo $fetch_products['numofdays']; ?></span><br>
                <span>Return Date: <?php echo $fetch_products['returndate']; ?></span><br>
                <span>Leave Date: <?php echo $fetch_products['leavedate']; ?></span><br>
                <span>Self Contact: <?php echo $fetch_products['selfcontact']; ?></span><br>
                <span>Parent's Contact: <?php echo $fetch_products['parentcontact']; ?></span><br>
                <a href="leaverequest.php?edit=<?php echo $fetch_products['id'] ?>" class="edit">Take Action</a>
                <a href="leaverequest.php?delete=<?php echo $fetch_products['id'] ?>" class="delete" onclick="return conform('delete this product')">delete</a>
                <b><a><?php echo $fetch_products['status']; ?></a></b><br>
                </li>
                <?php        
                }
            }
            ?>
            </ul>
        </form>

        <form action="" method="post" style="width: 100%; max-height: 400px; overflow-y: scroll;">
            <center><h3>Accepted Leave Requests</h3></center>

            <ul class="item-list" id="item-list">
            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM leave_request WHERE status='approved' ORDER BY id DESC") or die('query failed');
            if(mysqli_num_rows($select_products) > 0){
                while($fetch_products = mysqli_fetch_assoc($select_products)){
            ?>
                <li class="item" id="item"><span>Hosteller Name: <?php echo $fetch_products['name']; ?></span><br>
                <span>Room No.: <?php echo $fetch_products['roomno']; ?></span><br>
                <span>Reason to leave: <?php echo $fetch_products['reason']; ?></span><br>
                <span>Address: <?php echo $fetch_products['address']; ?></span><br>
                <span>Leave requested for days: <?php echo $fetch_products['numofdays']; ?></span><br>
                <span>Return Date: <?php echo $fetch_products['returndate']; ?></span><br>
                <span>Leave Date: <?php echo $fetch_products['leavedate']; ?></span><br>
                <span>Self Contact: <?php echo $fetch_products['selfcontact']; ?></span><br>
                <span>Parent's Contact: <?php echo $fetch_products['parentcontact']; ?></span><br>
                <a href="leaverequest.php?edit=<?php echo $fetch_products['id'] ?>" class="edit">Take Action</a>
                <a href="leaverequest.php?delete=<?php echo $fetch_products['id'] ?>" class="delete" onclick="return conform('delete this product')">delete</a>
                <b><a><?php echo $fetch_products['status']; ?></a></b><br>
                </li>
                <?php        
                }
            }
            ?>
            </ul>
        </form>

        <form action="" method="post" style="width: 100%; max-height: 400px; overflow-y: scroll;">
            <center><h3>Rejected Leave Requests</h3></center>

            <ul class="item-list" id="item-list">
            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM leave_request WHERE status='rejected' ORDER BY id DESC") or die('query failed');
            if(mysqli_num_rows($select_products) > 0){
                while($fetch_products = mysqli_fetch_assoc($select_products)){
            ?>
                <li class="item" id="item"><span>Hosteller Name: <?php echo $fetch_products['name']; ?></span><br>
                <span>Room No.: <?php echo $fetch_products['roomno']; ?></span><br>
                <span>Reason to leave: <?php echo $fetch_products['reason']; ?></span><br>
                <span>Address: <?php echo $fetch_products['address']; ?></span><br>
                <span>Leave requested for days: <?php echo $fetch_products['numofdays']; ?></span><br>
                <span>Return Date: <?php echo $fetch_products['returndate']; ?></span><br>
                <span>Leave Date: <?php echo $fetch_products['leavedate']; ?></span><br>
                <span>Self Contact: <?php echo $fetch_products['selfcontact']; ?></span><br>
                <span>Parent's Contact: <?php echo $fetch_products['parentcontact']; ?></span><br>
                <a href="leaverequest.php?edit=<?php echo $fetch_products['id'] ?>" class="edit">Take Action</a>
                <a href="leaverequest.php?delete=<?php echo $fetch_products['id'] ?>" class="delete" onclick="return conform('delete this product')">delete</a>
                <b><a><?php echo $fetch_products['status']; ?></a></b><br>
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
                    $edit_query = mysqli_query($conn, "SELECT * FROM `leave_request` WHERE id= $edit_id ") or die('query failed');
                    if(mysqli_num_rows($edit_query) > 0){
                        while($fetch_edit = mysqli_fetch_assoc($edit_query)){
                            
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <!-- <img src="image/<-?php echo $fetch_edit['image']; ?>"> -->
                <input type="hidden" name="update_id" value="<?php echo $fetch_edit['id']; ?>">
                <input type="text" name="update_name" value="<?php echo $fetch_edit['name']; ?>">
                <input type="number" min=0 name="update_roomno" value="<?php echo $fetch_edit['roomno']; ?>">
                <textarea style="width:80%; padding: 10px 15px; font-size: 17px; margin: 8px 0; background: #eee; border-radius: 5px;" name="update_reason"><?php echo $fetch_edit['reason']; ?></textarea>
                <textarea style="width:80%; padding: 10px 15px; font-size: 17px; margin: 8px 0; background: #eee; border-radius: 5px;" name="update_address"><?php echo $fetch_edit['address']; ?></textarea>
                
                <input type="number" name="update_numofdays" value="<?php echo $fetch_edit['numofdays']; ?>">
                <input type="date" name="update_leavedate" value="<?php echo $fetch_edit['leavedate']; ?>">
                <input type="date" name="update_returndate" value="<?php echo $fetch_edit['returndate']; ?>">
                <input type="number" min="0" name="update_selfcontact" value="<?php echo $fetch_edit['selfcontact']; ?>">
                <input type="number" min="0" name="update_parentcontact" value="<?php echo $fetch_edit['parentcontact']; ?>">
                <select name="update_status">
                <option value="pending">none</option>
                <option value="approved">approve</option>
                <option value="rejected">reject</option>
                </select>
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
</body>
</html>