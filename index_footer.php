<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    

<section class="footer">
            <div class="box_container">
                <div class="box">
                    <h3><?php echo $translations['Link1'];?></h3>
                    <a href="#trips"><?php echo $translations['nav1']; ?></a>
                    <a href="#kontakt"><?php echo $translations['Contact'];?></a>
                    <a href="#contact"><?php echo $translations['Message'];?></a>
                </div>

                <div class="box">
                    <h3 id="kontakt"><?php echo $translations['Contact'];?></h3>
                    <span><a href="mailto: tarvelweb@gmail.com"> <i class="fas fa-envelope"></i> tarvelweb@gmail.com</a></span>
                    <a href="tel: +949 123 456"> <i class="fas fa-phone"></i>+421 123 456</a>
                    <a href="tel: +949 123 456"> <i class="fas fa-mobile"></i> +949 123 456</a>
                    <a href="https://www.google.com/maps/place/Kom%C3%A1rom/@48.0133878,17.3145644,9.72z/data=!4m22!1m16!4m15!1m6!1m2!1s0x476c89360aca6197:0x631f9b82fd884368!2sBratislava!2m2!1d17.1077478!2d48.1485965!1m6!1m2!1s0x476bad5b8f4a1289:0xcca0345f7168099b!2zS29tw6Fyb20!2m2!1d18.1294069!2d47.7625834!5i1!3m4!1s0x476bad5b8f4a1289:0xcca0345f7168099b!8m2!3d47.7625834!4d18.1294069?hl=hu"> <i class="fas fa-map-marker-alt"></i>Komárom, Szlovákia, 94501</a>
                </div>
                
                <div class="box">
                    <h3><?php echo $translations['Follow'];?></h3>
                    <a href="https://www.facebook.com/bookingcom/?locale=hu_HU"><span><i class="fab fa-facebook-f"></i>f</span>acebook</a>
                    <a href="https://twitter.com/bookingcom"><span><i class="fab fa-twitter"></i></span>twitter</a>
                    <a href="https://www.youtube.com/c/bookingcom"><span><i class="fab fa-youtube"></i></span>youtube</a>
                    <a href="https://www.instagram.com/bookingcom/"><span><i class="fab fa-instagram"></i></span>instagram</a>
                </div>

            </div>

            <div class="copyr">&copy; copyright <?php echo date('Y'); ?> by <span class="letter1">U</span><span class="letter2">J</span><span class="letter3">S</span></div>
        </section>

</body>
</html>