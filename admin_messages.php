<?php
    session_start();

    include 'conn.php';

    include 'admin_header.php';

    error_reporting(0);

    $message = "";

    $admin_id = $_SESSION['admin_id'];
    if(!isset($admin_id)){
        header('location: login.php');
    }

    if(isset($_GET['delete_message'])){

        $delete_message = $_GET['delete_message'];
        mysqli_query($conn, "DELETE FROM message WHERE id = '$delete_message' ");
        $message = "Üzenet törölve";
          header("refresh:2; url=admin_dashboard.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin_message</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<style>
    #email{
        text-decoration:none;
        text-transform:none;
    }
</style>
<body>

<div class="show_users">
    <div class="title" style="margin-top: 5rem;">
        <div class="back">
            <h1>Üzenetek</h1>
            <?php echo '<div id="message1">'.$message.'</div>' ?>
        </div>
    </div>

    <div class="box">
        <?php 
            $select_message = mysqli_query($conn, "SELECT * FROM `message`");
            if(mysqli_num_rows($select_message) > 0){
                while($fetch_dest = mysqli_fetch_assoc($select_message)){
        ?>
      <form action="" method="post">
            <table style="width:100%">
                <tr> 
                    <th>Id:</th>
                    <td><div class="id"><?php echo $fetch_dest['id']; ?></div></td>
                </tr>
                <tr> 
                    <th>keresztnév:</th>
                    <td><span><div class="name"><?php echo $fetch_dest['firstname']; ?></div></span></td>
                </tr>
                <tr> 
                    <th>Vezetéknév</th>
                    <td><span><div class="email"><?php echo $fetch_dest['lastname']; ?></div></span></td>
                </tr>
                <tr> 
                    <th>email</th>
                    <td><span><div class="email"><?php echo $fetch_dest['email']; ?></div></span></td>
                </tr>
                <tr> 
                    <th>Tárgy:</th>
                    <td><div class="id"><?php echo $fetch_dest['subject']; ?></div></td>
                </tr>
                <tr> 
                    
                    
                <textarea class="description" id="textarea" cols="30" rows="5"><?php echo $fetch_dest['message']; ?></textarea>
                       
                  
                </tr>
            </table>
            <div class="admin_delete">
                <a href="admin_messages.php?delete_message=<?php echo $fetch_dest['id']; ?>" class="delete_btn" onclick="return confirm('Biztosan törli az ajánlatot?')">törlés</a>
            </div>
        </form>
        <?php 
                }
            } else {
                echo 'No active destination';
            }
        ?>








        
</div>
</body>
</html>