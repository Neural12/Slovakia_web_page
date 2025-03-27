<?php 
    include 'conn.php';

    $lang = 'hu';

    if(isset($_GET['lang']) && $_GET['lang'] == 'en') {
        $lang = 'en';
    }else if(isset($_GET['lang']) && $_GET['lang'] == 'sk'){
        $lang = 'sk';
    }

    $query = "SELECT * FROM translations WHERE lang = '$lang'";
    $result = mysqli_query($conn, $query);

    $translations = array();

    while($row = mysqli_fetch_assoc($result)) {
       $translations[$row['key_name']] = $row['value'];

    }
?>