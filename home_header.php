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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="css/home.css">
</head>
<body>
   
    <header>
        <a href="home.php" class="logo"><span class="letter1">U</span><span class="letter2">J</span><span class="letter3">S</span></a>

        <nav class="user_navigation">
                <a href="home.php#trips"><?php echo $translations['nav1']; ?></a>
                <a href="home.php#kontakt"><?php echo $translations['Contact'];?></a>
                <a href="home.php#contact"><?php echo $translations['Message'];?></a>

            </nav>

            <div class="user_icons">
                <div class="fas fa-search" id="search_icon"></div>
                <div class="fas fa-bars" id="menu_icon"></div>
                <div class="fas fa-user" id="user_icon"><span id="logged_user"> <?php echo $_SESSION['user_firstname'] .' '. $_SESSION['user_lastname']; ?></span></div>
            </div>


            <form action="home_results.php" method="post" class="search_form_form">
                <input type="search" name="searchdest" id="search_trip" placeholder="keressen itt..." autocomplete="off" required>
                <button type="submit" class="fas fa-search" name="trip_search"></button>
            </form>
       



            <select name="language" id="language" onchange="ChangeLanguage()">
                    <option value="en" <?php  if($lang == 'en') echo 'selected';?> >ENG</option>
                    <option value="hu" <?php  if($lang == 'hu') echo 'selected';?> >HU</option>
                    <option value="sk" <?php  if($lang == 'sk') echo 'selected';?> >SVK</option>
                </select>

            <div class="user_profile">
                <a href="logout.php" class="admin_logout_btn">Logout</a>
            </div>
    </header>

   
    

</body>

<script>

    
        function ChangeLanguage() {
            var select = document.getElementById("language");
            var selectedLanguage = select.options[select.selectedIndex].value;

            window.location.href = "?lang=" + selectedLanguage;
        };

        let UserICon = document.getElementById('user_icon');
        let Profile = document.querySelector('.user_profile');

        UserICon.addEventListener('click', () => {
            Profile.classList.toggle('active');
            UserICon.classList.toggle('fa-times');

            Navigation.classList.remove('active');
            MenuICon.classList.remove('fa-times');

            SearchForm.classList.remove('active');
            SearchIcon.classList.remove('fa-times');
    });


        let MenuICon = document.getElementById('menu_icon');
        let Navigation = document.querySelector('.user_navigation');

        MenuICon.addEventListener('click', () => {
            Navigation.classList.toggle('active');
            MenuICon.classList.toggle('fa-times');

            Profile.classList.remove('active');
            UserICon.classList.remove('fa-times');

            SearchForm.classList.remove('active');
            SearchIcon.classList.remove('fa-times');
       
    });


    let SearchIcon = document.getElementById('search_icon');
    let SearchForm = document.querySelector('.search_form_form');

    SearchIcon.addEventListener('click', () => {
        SearchForm.classList.toggle('active');
        SearchIcon.classList.toggle('fa-times');


        Navigation.classList.remove('active');
        MenuICon.classList.remove('fa-times');

        Profile.classList.remove('active');
        UserICon.classList.remove('fa-times');
    });




    window.onscroll = () =>{
            Navigation.classList.remove('active');
            MenuICon.classList.remove('fa-times');
        
            Profile.classList.remove('active');
            UserICon.classList.remove('fa-times');
        }


 


      
    </script>
</html>