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

    if(isset($_GET['delete'])){

        $delete_user = $_GET['delete'];
        mysqli_query($conn, "DELETE FROM users WHERE id = '$delete_user' ");
        $message = "Felhasználó törölve";
         
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>users</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>

<div class="show_users">
    <div class="title"style="margin-top: 5rem;">
        <div class="back">
            <h1>Felhasználók</h1>
            <?php echo '<div id="message1">'.$message.'</div>' ?>
        </div>
    </div>

    <div class="box">
        <?php 
            $select_dest_from_database = mysqli_query($conn, "SELECT * FROM `admins`") or die('select failed');
            if(mysqli_num_rows($select_dest_from_database) > 0){
                while($fetch_dest = mysqli_fetch_assoc($select_dest_from_database)){
        ?>
      <form action="" method="post">
            <table style="width:100%">
                <tr> 
                    <th>Id:</th>
                    <td><div class="id"><?php echo $fetch_dest['admin_id']; ?></div></td>
                </tr>
                <tr> 
                    <th>név:</th>
                    <td><span><div class="name"><?php echo $fetch_dest['admin_username']; ?></div></span></td>
                </tr>
                <tr> 
                    <th>email:</th>
                    <td><span><div class="email"><?php echo $fetch_dest['admin_email']; ?></div></span></td>
                </tr>
                <tr> 
                    <th>belépés:</th>
                    <td><div class="mode"><?php echo $fetch_dest['last_login']; ?></div></td>
                </tr>
            </table>
            <div class="admin_delete">
                <!-- <a href="admin_udpate.php?update_destination=<?php echo $fetch_dest['id']; ?>" class="update-btn">frissítés </a> -->
                <a href="#<?php echo $fetch_dest['admin_id']; ?>" class="delete_btn" onclick="return confirm('Az admint nem lehet törölni!')">törlés</a>
            </div>
        </form>
        <?php 
                }
            } else {
                echo '<div class="no-destination" id="no-destination">
                        No active destination 
                      </div>';
            }
        ?>








        <?php 
            $select_dest_from_database = mysqli_query($conn, "SELECT * FROM `users`");
            if(mysqli_num_rows($select_dest_from_database) > 0){
                while($fetch_dest = mysqli_fetch_assoc($select_dest_from_database)){
        ?>
      <form action="" method="post">
            <table style="width:100%">
                <tr> 
                    <th>Id:</th>
                    <td><div class="id"><?php echo $fetch_dest['id']; ?></div></td>
                </tr>
                <tr> 
                    <th>keresztnév:</th>
                    <td><div class="name"><?php echo $fetch_dest['firstname']; ?></div></span></td>
                </tr>
                <tr> 
                    <th>vezetéknév:</th>
                    <td><div class="email"><?php echo $fetch_dest['lastname']; ?></div></span></td>
                </tr>
                <tr> 
                    <th>email:</th>
                    <td><span><div class="email"><?php echo $fetch_dest['email']; ?></div></span></td>
                </tr>
                <tr> 
                    <th>mobil:</th>
                    <td><div class="mode"><?php echo $fetch_dest['mobile']; ?></div></td>
                </tr>
                <tr> 
                    <th>belépés:</th>
                    <td><div class="mode"><?php echo $fetch_dest['last_login']; ?></div></td>
                </tr>
            </table>
            <div class="buttons">
                <a href="admin_users.php?delete=<?php echo $fetch_dest['id']; ?>" class="delete_btn" onclick="return confirm('Törli a felhasználót?')">törlés</a>
            </div>
        </form>
        <?php 
                }
            } else {
                echo '<div class="no-destination" id="no-destination">
                        No active destination 
                      </div>';
            }
        ?>
    </div>
</div>
</body>
</html>