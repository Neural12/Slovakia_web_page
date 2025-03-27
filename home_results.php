<?php

    session_start();
    include 'conn.php';

    include 'home_header.php';
    error_reporting(0);

   
?>

<link rel="stylesheet" href="css/home.css">
<link rel="stylesheet" href="home.css">

<section class="show-data" id="skiing" style="padding-top: 8rem";>
    <div class="box"  >
        <?php 
        if(isset($_POST['trip_search'])){
            $search_inDB = $_POST['searchdest'];
            $select_searched_dest = mysqli_query($conn, "SELECT * FROM `destinations` WHERE `place_name` LIKE '%{$search_inDB}%' ");
            if(mysqli_num_rows($select_searched_dest) > 0){
                while($fetch_results = mysqli_fetch_assoc($select_searched_dest)){
        ?>
                    <form action="" method="post">
                        <?php 
                        $destination_id = $fetch_results['id'];
                        $images = mysqli_query($conn, "SELECT * FROM images WHERE destination_id = $destination_id");
                        while($image = mysqli_fetch_assoc($images)) {
                            $image_path = 'trip_image/' . $image['filename'];
                        ?>
                            <img src="<?php echo $image_path; ?>" alt="destination image">
                            <div id="place"><span><?php echo $fetch_results['place_name']; ?></span></div>
                            <div id="place2" class="fas fa-map-marker-alt"><span><?php echo $fetch_results['place']; ?></span></div>
                            <div id="place3" class="fas fa-map"><span><?php echo $fetch_results['region']; ?></span></div>
                            <div class="text">
                                <div class="description"><?php echo $fetch_results['description']; ?></div>
                        <?php } ?>
                            </div>
                    </form>       
        <?php 
                } 
            } else {
                echo '<div id="echo">Nincs találat!</div>';

            }
        } else {
            while($row = mysqli_fetch_assoc($result)) { 
        ?>
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
        <?php 
            } 
        }
        ?>
    </div>
</section>



<?php include 'index_footer.php'; ?>