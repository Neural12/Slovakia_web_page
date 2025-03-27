<?php 
    include 'conn.php';

    include 'translations.php';

    include 'index_header.php';
    
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


    <p style="visibility:hidden;" id="trips"></p>
    <form action="" >
        <div class="card_contain" >

        <div class="card" id="card1">
                <img src="map.png" alt="" style="filter: brightness(0) invert(1);">
                <h2><a href="#"  id="blurbg" onclick="background()"><?php echo $translations['card1']; ?></a></h2>
            </div>

            <div class="card" id="card1">
                <img src="skii.png" alt="" style="filter: brightness(0) invert(1);">
                <h2><a href="#"  id="blurbg" onclick="background()"><?php echo $translations['card2']; ?></a></h2>
            </div>

            <div class="card" id="card2">
                <img src="icon5.png"  alt="" style="filter: brightness(0) invert(1);">
                <h2><a href="#"  id="blurbg" onclick="background()"><?php echo $translations['card3']; ?></a></h2>
            </div>

            <div class="card" id="card3">
                <img src="walk2.png" alt="" style="filter: brightness(0) invert(1);">
                <h2><a href="#"  id="blurbg" onclick="background()"><?php echo $translations['card4']; ?></a></h2>
            </div>

            <div class="card" id="card4">
                <img src="cave.png" alt="" style="filter: brightness(0) invert(1);">
                <h2><a href="#"  id="blurbg" onclick="background()"><?php echo $translations['card5']; ?></a></h2>
            </div>
        </div>
    </form>



   
    <div class="contact_form" >
        <form action="" id="contact">
            <h1><?php echo $translations['contact_h1']; ?></h1>
            <p><?php echo $translations['contact_warning']; ?></p>

            <div class="input_box" id="contact_k">
                <div class="input_field">
                    <input type="text" name="firstname" id="firstname" placeholder="<?php echo $translations['placeholder1']; ?>" oninput="this.value = this.value.replace(/\s/g, '', )" pattern="^([a-zA-Z0-9áéíóöúüýčďěňšôľťžÁÉÍÓÖÚÜÝČĎĚŇŠŤŽÄÔ]{1,20})$" disabled >
                    <i class="fa fa-user" id="user_icon_one"></i>
                </div>

                <div class="input_field">
                    <input type="text" name="lastname" id="lastname" placeholder="<?php echo $translations['placeholder2']; ?>" oninput="this.value = this.value.replace(/\s/g, '', )" pattern="^([a-zA-Z0-9áéíóöúüýčďěňšôľťžÁÉÍÓÖÚÜÝČĎĚŇŠŤŽÄÔ]{1,20})$" disabled >
                    <i class="fa fa-user" id="user_icon_two"></i>
                </div>
            </div>


            <div class="input_box">
                <div class="input_field">
                    <input type="email" name="email"  id="email" placeholder="e-mail" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" disabled >
                    <i class="fa fa-envelope" id="email_icon"></i>
                </div>

                <div class="input_field">
                    <input type="tel" name="subject" id="mobile" placeholder="<?php echo $translations['placeholder3']; ?>" disabled>
                    <i class="fa fa-pencil" id="pencil_icon"></i>
                </div>
            </div>

                <div class="input_field">
                    <textarea name="message" id="" cols="30" rows="8" placeholder="<?php echo $translations['placeholder4']; ?>" disabled ></textarea>
                    <i class="fa fa-message" id="message_icon"></i>
                </div>
           
            <input type="submit" value="<?php echo $translations['placeholder5']; ?>" name="send" class="register_btn" id="blurbg" disabled>
        </form>
    </div>



    <div class="popup-message">
            <h2><?php echo $translations['popup_h1']; ?></h2>
            <p><?php echo $translations['popup_p']; ?></p>
            <p class="t2"><a href="login.php"><?php echo $translations['popup_login']; ?></a> </p>
            <!-- <input type="button" value="mégse"  > -->
            <div class="fas fa-x" id="close"></div>
        </div>
    
 



    <?php 
        if(!is_file('click/index.txt')){
            file_put_contents('click.txt', 0);
        }

        $clickCounter = file_get_contents('click/index.txt');
        file_put_contents('click/index.txt', ++$clickCounter);
     ?>


        <?php include 'index_footer.php'; ?>
</body>
    <script>
        function background() {
            let blurBg = document.getElementById('blurbg');
            blurBg.classList.toggle('active');

            let popup = document.querySelector('.popup-message');
            popup.classList.toggle('active');

            let Close = document.getElementById('close');
            Close.addEventListener('click', () => {
                popup.classList.remove('active');
                blurBg.classList.remove('active');
            })
        }
    </script>
</html>