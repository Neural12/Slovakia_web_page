<?php
    session_start();

    include 'conn.php';

    include 'home_header.php';
    error_reporting(0);

    $user_id = $_SESSION['user_id'];
    if(!isset($user_id)){
        header('Location: login.php');
    }



    $result = mysqli_query($conn, "SELECT * FROM destinations WHERE type = 'varak'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home_castles</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="home.css">

 

</head>
<body>
<div class="back_image">
        <div class="setimage">
            <div class="image">
                <div class="class">
                    <h3><?php echo $translations['index_title']; ?></h3>
                    <p><?php echo $translations['index_paragraph']; ?></p>
                </div>
                <img src="back_image/strbske.jpg" alt="">
            </div>
        </div>
    </div>
    




    <section class="show-data" id="castles" style="padding-top: 4rem";>
    

        <div class="box"  >
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <form action="" method="post">
             
                <?php 
                        $destination_id = $row['id'];
                        $images = mysqli_query($conn, "SELECT * FROM images WHERE destination_id = $destination_id");
                        while($image = mysqli_fetch_assoc($images)) {
                            $image_path = 'trip_image/' . $image['filename'];
                        ?>
                         <img src="<?php echo $image_path; ?>" alt="destination image">
                         <div id="place"><span><?php echo $row['place_name']; ?></span></div>

                         <div id="place2" class="fas fa-map-marker-alt"><span><?php echo $row['place']; ?></span></div>
                         <div id="place3" class="fas fa-map"><span><?php echo $row['region']; ?></span></div>
                    <div class="text">
                   
                        <div class="description"><?php echo $row['description']; ?></div>
                   
                <?php } ?>
    
                    </div>
            </form>       
            <?php } ?>
    </div>
        </section>


     

    <?php include 'index_footer.php'; ?>

  
</body>

</html>
