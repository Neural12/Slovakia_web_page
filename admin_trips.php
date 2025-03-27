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
    $delete_trip_id = $_GET['delete'];

   
    $select_images_query = mysqli_query($conn, "SELECT filename FROM images WHERE destination_id = '$delete_trip_id'");
    while($fetch_image = mysqli_fetch_assoc($select_images_query)) {
        $image_path = 'trip_image/'.$fetch_image['filename'];
        if(file_exists($image_path)) {
            unlink($image_path); 
        }
    }

    mysqli_query($conn, "DELETE FROM images WHERE destination_id = '$delete_trip_id'");

    mysqli_query($conn, "DELETE FROM destinations WHERE id = '$delete_trip_id'");

    $message = 'Ajánlat törölve!';
    header("refresh:5; url=admin_dashboard.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trips</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    

<div class="show_trips" style="margin-top: 5rem;">
    <div class="title">
        <div class="back">
            <h1>Aktív ajánlatok</h1>

            <?php echo '<div id="message1">'.$message.'</div>' ?>
        </div>
    </div>
    <div class="box">
        <?php 
            $select_dest_from_database = mysqli_query($conn, "SELECT * FROM `destinations`") or die('select failed');
            if(mysqli_num_rows($select_dest_from_database) > 0){
                while($fetch_dest = mysqli_fetch_assoc($select_dest_from_database)){
                    
                    $destination_id = $fetch_dest['id'];
                    $select_images_query = mysqli_query($conn, "SELECT * FROM `images` WHERE `destination_id` = $destination_id") or die('image select failed');
        ?>
      <form action="" method="post" class="image-slider">
    <div class="image-container">
        <?php 
            
            while($fetch_image = mysqli_fetch_assoc($select_images_query)){
        ?>
        <img src="trip_image/<?php echo $fetch_image['filename']; ?>" alt="destination image">
        <?php } ?>
    </div>
    <button class="prev" onclick="plusSlides(-1)">&#10094;</button>
    <button class="next" onclick="plusSlides(1)">&#10095;</button>

            <table style="width:100%">
                <tr> 
                    <th>Id:</th>
                    <td><div class="id"><?php echo $fetch_dest['id']; ?></div></td>
                </tr>
                <tr> 
                    <th>név:</th>
                    <td><div class="name"><?php echo $fetch_dest['place_name']; ?></div></td>
                </tr>
                <tr> 
                    <th>típus:</th>
                    <td><div class="mode"><?php echo $fetch_dest['type']; ?></div></td>
                </tr>
            </table>
            <textarea class="description" id="textarea" cols="30" rows="5"><?php echo $fetch_dest['description']; ?></textarea>
            <div class="buttons">
                <a href="admin_trips.php?delete=<?php echo $fetch_dest['id']; ?>" class="delete_btn" onclick="return confirm('Törli ezt az ajánlatot?')">törlés</a>
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
