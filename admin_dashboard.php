<?php 
      session_start();
      include 'conn.php';

      // error_reporting(0);
      $admin_id = $_SESSION['admin_id'];
      if(!isset($admin_id)){
          header('Location: login.php');
      };
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <?php include 'admin_header.php'; ?>

    <div class="title" style="margin-top: 5rem;">
        <div class="header">
            <div class="back">
                <h1>Tartalom</h1>
            </div>
        </div>
    </div>

        <section class="printDatas">
            <div class="form">
                <?php 
                    $select_datas = mysqli_query($conn, "SELECT * FROM users");
                    $get_all_users = mysqli_num_rows($select_datas);
                ?>
                <h3>Felhasználók száma: <span><?php echo $get_all_users; ?></span></h3>
            </div>


            <div class="form">
                <?php 
                    $select_datas_admin = mysqli_query($conn, "SELECT * FROM admins");
                    $get_admin_users = mysqli_num_rows($select_datas_admin);
                ?>
                <h3>Adminok száma: <span><?php echo $get_admin_users; ?></span></h3>
            </div>

            <div class="form">
                <?php 
                    $select_trips = mysqli_query($conn, "SELECT * FROM destinations");
                    $get_all_trips = mysqli_num_rows($select_trips);
                ?>
                <h3>Ajánlatok száma: <span><?php echo $get_all_trips; ?></span></h3>
            </div>

            <div class="form">
                <?php 
                    $select_message = mysqli_query($conn, "SELECT * FROM message");
                    $get_all_message = mysqli_num_rows($select_message);
                ?>
                <h3>Üzenetek száma: <span><?php echo $get_all_message; ?></span></h3>
            </div>


            <div class="form">
                
                <h3>Megtekintések száma: <span><?php include 'click/index.txt'; ?></span></h3>
            </div>

        </section>
    </div>

</body>
</html>
