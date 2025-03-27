<?php 
    include 'conn.php';

    session_start();

    error_reporting(0);
    
    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)){
        header('location: login.php');
    }

    $message = "";

    if(isset($_POST['new'])){
        $name = $_POST['name'];
        $trip = $_POST['trip_type'];
        $description = $_POST['text'];
        $place = $_POST['place'];
        $region = $_POST['region'];
        
    
        mysqli_query($conn, "INSERT INTO destinations (place_name, place, region, type, description) VALUES ('$name', '$place', '$region', '$trip', '$description')");
        
        $destination_id = mysqli_insert_id($conn);
    
        if(isset($_FILES['images'])){
            $file_names = $_FILES['images']['name'];
            $file_tmps = $_FILES['images']['tmp_name'];
    
            foreach($file_names as $key => $file_name){
                $ImageFolder = 'trip_image/' . $file_name;
                mysqli_query($conn, "INSERT INTO images (destination_id, filename) VALUES ('$destination_id', '$file_name')");
                move_uploaded_file($file_tmps[$key], $ImageFolder);
                $message = "Added successfully";
                header("refresh:2; url=admin_dashboard.php");
            }
        }else{
            $message = "Something wrong!";
        }
       
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <div class="add_new">
        <form action="" method="post" enctype="multipart/form-data">
            <h1>Add new trip</h1>
            <?php echo '<div id="message1">'.$message.'</div>'; ?>
            <input type="text" name="name" id="name" placeholder="place name" required>
            <input type="text" name="place" id="name" placeholder="place" required>

            <select name="region" id="trip" required>
                <option value="" disabled="disable" selected>Region</option>
                <option value="Košický">Košický</option>
                <option value="Prešovský">Prešovský</option>
                <option value="Banskobystrický">Banskobystrický</option>
                <option value="Žilinský">Žilinský</option>
                <option value="Nitriansky">Nitriansky</option>
                <option value="Trenčiansky">Trenčiansky</option>
                <option value="Trnavský">Trnavský</option>
                <option value="Bratislavský">Bratislavský</option>
            </select>
            <select name="trip_type" id="trip" required>
                <option value="" disabled="disable" selected>Trip Type</option>
                <option value="turistika">Turistika</option>
                <option value="varak">Várak</option>
                <option value="barlangok">Barlangok</option>
                <option value="sieles">Sielés</option>
            </select>

            <input type="file" name="images[]" id="image" accept="image/jpg, image/png, image/jpeg" multiple >

            <textarea name="text" id="text" cols="30" rows="3" minlength="" maxlength="" placeholder="enter trip description" required></textarea>

            <input type="submit" value="add new" name="new" class="add_btn">
        </form>
    </div>
</body>
</html>