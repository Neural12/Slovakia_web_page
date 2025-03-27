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
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
   
    <header>
        <a href="index.php" class="logo"><span class="letter1">U</span><span class="letter2">J</span><span class="letter3">S</span></a>

        <nav class="user_navigation">
                <a href="#trips"><?php echo $translations['nav1']; ?></a>
                <a href="#kontakt"><?php echo $translations['Contact'];?></a>
                <a href="#contact"><?php echo $translations['Message'];?></a>
        </nav>

        <div class="user_icons">
            <div class="fas fa-bars" id="menu_icon"></div>
            <div class="fas fa-user" id="user_icon" onclick="location.href = 'login.php'"></div> 
      

          <div class="language_selector">
            <select name="language" id="language" onchange="ChangeLanguage()">
                    <option value="en" <?php  if($lang == 'en') echo 'selected';?> >ENG</option>
                    <option value="hu" <?php  if($lang == 'hu') echo 'selected';?> >HU</option>
                    <option value="sk" <?php  if($lang == 'sk') echo 'selected';?> >SVK</option>
                </select>
          </div>

        </div>

            <div class="user_profile">
            
        </div>

    </header>
    



</body>



<script>
        function ChangeLanguage() {
            var select = document.getElementById("language");
            var selectedLanguage = select.options[select.selectedIndex].value;

            window.location.href = "?lang=" + selectedLanguage;
        }


        let MenuIcon = document.getElementById('menu_icon');
        let Navigation = document.querySelector('.user_navigation');


        MenuIcon.onclick = function() {
            Navigation.classList.toggle('active');
            MenuIcon.classList.toggle('fa-times');
        }

        window.onscroll = () =>{
            Navigation.classList.remove('active');
            MenuIcon.classList.remove('fa-times');
        }

    </script>
</html>