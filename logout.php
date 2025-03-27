<?php
    session_start();

    $user_type = isset($_SESSION['user_type']) ? $_SESSION['user_type'] : "";

    session_unset();
    session_destroy();

    if($user_type == 'user'){
        header('Location: index.php');
    }elseif($user_type == 'admin'){
        header('Location: index.php');
    }
?>