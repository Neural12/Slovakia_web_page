<?php
    session_start();

    include 'conn.php';

    include 'home_header.php';

    include 'translations.php';

    // error_reporting(0);
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';



    $user_id = $_SESSION['user_id'];
    if(!isset($user_id)){
        header('location: login.php');
    };


    $message_succ = '';
    $message_error= '';

    if(isset($_POST['send'])){
        $firstname =$_POST['firstname'];
        $lastname =$_POST['lastname'];

        $email =$_POST['email'];

        $message =$_POST['message'];

        $subject = $_POST['subject'];

        $select_message = mysqli_query($conn, "SELECT * FROM message WHERE subject = '$subject' AND message = '$message'");

        if(mysqli_num_rows($select_message) > 0){
            $message_error = 'Message already sent';
        }else{

             $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'e-mail address';
                $mail->Password = 'passowrd';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;
                $mail->SetFrom('e-mail address');
                $mail->addAddress($email, $firstname);
                $mail->isHTML(true);
            
                $mail->Subject = $subject;
                $mail->Body = '<p>Dear, <div style="text-transform: capitalize; font-weight: bold;">' . $firstname . ' ' . $lastname .'</div> <br>thank you for contacting us.<br><br> 
                If you are not the intended recipient, please disregard this email.</p>';
                
                $mail->send();
        
            mysqli_query($conn, "INSERT INTO message (firstname, lastname, email, subject, message)
            VALUES('$firstname', '$lastname', '$email', '$subject', '$message')");
        
            $message_succ = "Thank you for contacting us.";
            header('location: home.php#contact');
        }
      
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
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


    <p style="visibility:hidden;" id="trips"></p>
    <form action="" >
        <div class="card_contain" >

        <div class="card" id="card1">
                <img src="map.png" alt="" style="filter: brightness(0) invert(1);">
                <h2><a href="home_every.php#every"  id="blurbg" ><?php echo $translations['card1']; ?></a></h2>
            </div>

            <div class="card" id="card1">
                <img src="skii.png" alt="" style="filter: brightness(0) invert(1);">
                <h2><a href="home_skiing.php#skiing"  id="blurbg" ><?php echo $translations['card2']; ?></a></h2>
            </div>

            <div class="card" id="card2">
                <img src="icon5.png"  alt="" style="filter: brightness(0) invert(1);">
                <h2><a href="home_castles.php#castles"  id="blurbg" ><?php echo $translations['card3']; ?></a></h2>
            </div>

            <div class="card" id="card3">
                <img src="walk2.png" alt="" style="filter: brightness(0) invert(1);">
                <h2><a href="home_turistika.php#turistika" id="blurbg"><?php echo $translations['card4']; ?></a></h2>
            </div>

            <div class="card" id="card4">
                <img src="cave.png" alt="" style="filter: brightness(0) invert(1);">
                <h2><a href="home_cave.php#barlangok" id="blurbg"><?php echo $translations['card5']; ?></a></h2>
            </div>
        </div>
    </form>



   
    <div class="contact_form" >
        <form action="" method="post" id="contact">
            <h1><?php echo $translations['contact_h1']; ?></h1>

            <?php echo '<div id="message_succ">'.$message_succ.'</div>'; ?>
            <?php echo '<div id="message_error">'.$message_error.'</div>'; ?>

            <div class="input_box" id="contact_k">
                <div class="input_field">
                    <input type="text" name="firstname" id="firstname" placeholder="<?php echo $translations['placeholder1']; ?>" oninput="this.value = this.value.replace(/\s/g, '', )" pattern="^([a-zA-ZáéíóöúüýčďěňšôőŐľťžÁÉÍÓÖÚÜÝČĎĚŇŠŤŽÄÔ]{1,20})$"  required>
                    <i class="fa fa-user" id="user_icon_one"></i>
                </div>

                <div class="input_field">
                    <input type="text" name="lastname" id="lastname" placeholder="<?php echo $translations['placeholder2']; ?>" oninput="this.value = this.value.replace(/\s/g, '', )" pattern="^([a-zA-ZáéíóöúüýčďěňšôőŐľťžÁÉÍÓÖÚÜÝČĎĚŇŠŤŽÄÔ]{1,20})$" required  >
                    <i class="fa fa-user" id="user_icon_two"></i>
                </div>
            </div>


            <div class="input_box">
                <div class="input_field">
                    <input type="email" name="email"  id="email" placeholder="e-mail" oninput="this.value = this.value.replace(/\s/g, '', )" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" required>
                    <i class="fa fa-envelope" id="email_icon"></i>
                    <span id="email_error_contact"></span>
                </div>

                <div class="input_field">
                    <input type="text" name="subject" id="subject" placeholder="<?php echo $translations['placeholder3']; ?>" oninput="this.value = this.value.replace(/\s/g, '', )" pattern="^([a-zA-ZáéíóöúüýčďěňšôőŐľťžÁÉÍÓÖÚÜÝČĎĚŇŠŤŽÄÔ]{1,30})$" required>
                    <i class="fa fa-pencil" id="pencil_icon"></i>
                    <span id="subject_error"></span>
                </div>
            </div>

                <div class="input_field">
                    <textarea name="message" id="message" cols="30" rows="8" placeholder="<?php echo $translations['placeholder4']; ?>" pattern="^([a-zA-Z0-9áéíóöúüýčďěňšôľťžÁÉÍÓÖÚÜÝČĎĚŇŠŤŽÄÔ,.?!: ]{1,2000})$" required></textarea>
                    
                </div>
           
            <input type="submit" value="<?php echo $translations['placeholder5']; ?>" name="send" class="send_btn" >
        </form>
    </div>



    <script>
        let Firstname = document.getElementById('firstname');

        let UserIcon = document.getElementById('user_icon_one');

        Firstname.addEventListener('input', () => {

            let nameRegExp = /^([a-zA-ZáéíóöúüýčďěňšôőŐľťžÁÉÍÓÖÚÜÝČĎĚŇŠŤŽÄÔ]{1,20})$/;

            if(Firstname.value.match(nameRegExp)){
                Firstname.style.border = '.1rem solid #16e907';

                UserIcon.style.color = '#16e907';
            }else{
                Firstname.style.border = '.1rem solid red';

                UserIcon.style.color = 'red';
            }
        });

// -------------------------------------------------------------------------------------------------


        let Lastname = document.getElementById('lastname');

        let UserIconTwo = document.getElementById('user_icon_two');

        Lastname.addEventListener('input', () => {

            let nameRegExp = /^([a-zA-ZáéíóöúüýčďěňšôőŐľťžÁÉÍÓÖÚÜÝČĎĚŇŠŤŽÄÔ]{1,20})$/;

            if(Lastname.value.match(nameRegExp)){
                Lastname.style.border = '.1rem solid green';

                UserIconTwo.style.color = '#16e907';
            }else{
                Lastname.style.border = '.1rem solid red';

                UserIconTwo.style.color = 'red';
            }
        });

// ----------------------------------------------------------------------------------------------------------

        let EmailInput = document.getElementById('email');

        let EmailIcon = document.getElementById('email_icon');


        let EmailError = document.getElementById('email_error_contact');


            EmailInput.addEventListener('input', () => {

                let EmailRegExp = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

                if(EmailInput.value.match(EmailRegExp)){
                    EmailInput.style.border = '.1rem solid green';
                    EmailIcon.style.color = '#16e907';

                    EmailError.style.display = 'none';

                }else{
                    EmailInput.style.border = '.1rem solid red';

                    EmailError.innerHTML = 'Enter a valid email address!';
                    EmailError.style.color = 'red';
                    EmailError.style.display = 'block';

                    EmailIcon.style.color = 'red';
                }

        });

// ---------------------------------------------------------------------------------------------------


    let Subject = document.getElementById('subject');

    let PencilIcon = document.getElementById('pencil_icon');

    let SubjectError = document.getElementById('subject_error');

        Subject.addEventListener('input', () => {

        let nameRegExp = /^([a-zA-ZáéíóöúüýčďěňšôőŐľťžÁÉÍÓÖÚÜÝČĎĚŇŠŤŽÄÔ]{1,30})$/;

            if(Subject.value.match(nameRegExp)){
                Subject.style.border = '.1rem solid #16e907';

                SubjectError.style.display = 'none';

                PencilIcon.style.color = '#16e907';
            }else{
                Subject.style.border = '.1rem solid red';

                SubjectError.innerHTML = 'Only letters allowed!';
                SubjectError.style.color = 'red';
                SubjectError.style.display = 'block';

                PencilIcon.style.color = 'red';
            }
        });

// -------------------------------------------------------------------------------------------------------------------

        let Message = document.getElementById('message');

            Message.addEventListener('input', () => {

            let nameRegExp = /^([a-zA-Z0-9áéíóöúüýčďěňšôľťžÁÉÍÓÖÚÜÝČĎĚŇŠŤŽÄÔ,.?! ]{1,2000})$/;

                if(Message.value.match(nameRegExp)){
                    Message.style.border = '.1rem solid #16e907';
 
                }else{
                    Message.style.border = '.1rem solid red';
                }
            });

    </script>


    
 

        <?php include 'index_footer.php'; ?>
</body>

</html>