<!DOCTYPE html>
<html lang="en">
<head>
<style>
    header .logo .letter1{
    color: var(--red);
}

header .logo .letter2{
    color: yellow;
}

header .logo .letter3{
    color: var(--green);
}
</style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
   
    <header>
    <a href="admin_dashboard.php" class="logo"><span class="letter1">U</span><span class="letter2">J</span><span class="letter3">S</span></a>

        <nav class="admin_navigation">
            <a href="admin_dashboard.php">adatok</a>
            <a href="admin_trips.php">Ajánlatok</a>
            <a href="admin_users.php">Felhasználók</a>
            <a href="admin_messages.php">Üzenetek</a>
            
        </nav>

        <div class="admin_icons">
            <span><a href="admin_new.php" id="new_icon" class="fas fa-plus"></a></span>
            <div class="fas fa-bars" id="menu_icon"></div>
            <div class="fas fa-user" id="user_icon"><span id="logged_user"> <?php echo $_SESSION['admin_username']; ?></span></div>
        </div>

        <div class="admin_profile">
            <a href="logout.php" class="admin_logout_btn">Logout</a>
        </div>
    </header>

    <h1>Welcome <?php echo $_SESSION['admin_username'] .' '. $_SESSION['admin_email']; ?></h1>


</body>

<script>

    let UserICon = document.getElementById('user_icon');
    let Profile = document.querySelector('.admin_profile');

    UserICon.addEventListener('click', () => {
        Profile.classList.toggle('active');
        UserICon.classList.toggle('fa-times');


        AdminNavigation.classList.remove('active');
        MeniIcon.classList.remove('fa-times');
    });



    let MeniIcon = document.getElementById('menu_icon');
    let AdminNavigation = document.querySelector('.admin_navigation');

    MeniIcon.addEventListener('click', () => {
        AdminNavigation.classList.toggle('active');
        MeniIcon.classList.toggle('fa-times');

        Profile.classList.remove('active');
        UserICon.classList.remove('fa-times');
    });



    window.onscroll = () => {
        AdminNavigation.classList.remove('active');
        MeniIcon.classList.remove('fa-times');

        Profile.classList.remove('active');
        UserICon.classList.remove('fa-times');
    }


</script>
</html>