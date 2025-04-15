<?php 
    include 'conn.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';

    $error_msg = '';

    $succes_msg = '';


    if(isset($_POST['register'])){

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $password = hash('sha512', $_POST['password']);
        $password_again = hash('sha512', $_POST['password_again']);

        $code_db = substr(number_format(time() * rand(), 0, '', ''),0, 6);

        $select_user = mysqli_query($conn, "SELECT * FROM users WHERE firstname = '$firstname' AND lastname = '$lastname' AND email = '$email'");
        
        $select_email = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");

        if(mysqli_num_rows($select_user) > 0){
            $error_msg = 'User already exist!';

        }elseif(mysqli_num_rows($select_email) > 0){
            $error_msg = 'Email already exits, try again!';

        }else
        if($password != $password_again){
            $error_msg = 'Password not matched!';

        }else{
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'your_email';
                $mail->Password = 'your_pass';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;
                $mail->SetFrom('your_email');
                $mail->addAddress($email, $firstname);
                $mail->isHTML(true);
            
                $mail->Subject ='Verification code test';
                $mail->Body = '<p>This is a test email! <br><br> Your verification code is: <b style="font-size: 30px;">' . $code_db . '
                </b><br><br> If you are not the intended recipient, please disregard this email.</p>';
                
                $mail->send();

            mysqli_query($conn, "INSERT INTO users (firstname, lastname, email, mobile, password, code)
            VALUES ('$firstname', '$lastname', '$email', '$mobile', '$password_again', '$code_db')");
            $succes_msg = 'Verification code was sent!';
            header("refresh:5; url=verification.php?email=".$email);
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    
</head>
<body>
    <div class="register">
        <form action="" method="post">
            <h1>register</h1>
            <?php echo '<div id="error_message"> '.$error_msg.'</div>' ?>
            <?php echo '<div id="success_message"> '.$succes_msg.'</div>' ?>

            <div class="input_box">
                <div class="input_field">
                    <input type="text" name="firstname" id="firstname" placeholder="first name" oninput="this.value = this.value.replace(/\s/g, '', )" pattern="^([a-zA-Z0-9áéíóöúüýčďěňšôľťžÁÉÍÓÖÚÜÝČĎĚŇŠŤŽÄÔ]{1,20})$" required>
                    <i class="fa fa-user" id="user_icon"></i>
                </div>


                <div class="input_field">
                    <input type="text" name="lastname" id="lastname" placeholder="last name" oninput="this.value = this.value.replace(/\s/g, '', )" pattern="^([a-zA-Z0-9áéíóöúüýčďěňšôľťžÁÉÍÓÖÚÜÝČĎĚŇŠŤŽÄÔ]{1,20})$" required>
                    <i class="fa fa-user" id="user_icon_two"></i>
                </div>
            </div>

            <div class="input_box">
                <div class="input_field">
                    <input type="email" name="email"  id="email" placeholder="email" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" required>
                    <i class="fa fa-envelope" id="email_icon"></i>
                    <span id="email_error"></span>
                </div>

                <div class="input_field">
                    <input type="tel" name="mobile" id="mobile" placeholder="your number"  maxlength="10" pattern="^\d+$" required>
                    <i class="fa fa-mobile" id="mobile_icon"></i>
                    <span id="mobile_error"></span>
                </div>
            </div>

            <div class="input_box">
                <div class="input_field">
                    <input type="password" name="password" id="password_one" placeholder="your password" oninput="this.value = this.value.replace(/\s/g, '', )" pattern="^.{8,}$" required>
                    <i class="fa fa-lock" id="lock_one" onclick="ShowPasswordOne()"></i>
                    <span id="lock_one_error"></span>
                </div>

                <div class="input_field">
                    <input type="password" name="password_again" id="password_two" placeholder="repeat password" oninput="this.value = this.value.replace(/\s/g, '', )" pattern="^.{8,}$" required>
                    <i class="fa fa-lock" id="lock_two" onclick="ShowPasswordTwo()"></i>
                    <span id="lock_two_error"></span>
                </div>
            </div>

            <input type="submit" value="Register" name="register" class="register_btn">
            <p>Already have an account? <a href="login.php">Login now</a></p>
        </form>
    </div>

    <script>
        let Firstname = document.getElementById('firstname');

        let UserIcon = document.getElementById('user_icon');
    
        Firstname.addEventListener('input', () => {

            let nameRegExp = /^([a-zA-Z0-9áéíóöúüýčďěňšôľťžÁÉÍÓÖÚÜÝČĎĚŇŠŤŽÄÔ]{1,20})$/;

            if(Firstname.value.match(nameRegExp)){
                Firstname.style.border = '.1rem solid green';

                UserIcon.style.color = '#16e907';
            }else{
                Firstname.style.border = '.1rem solid red';

                UserIcon.style.color = 'red';
            }
        });
// ---------------------------------------------------------------------------------------------------

            let Lastname = document.getElementById('lastname');

            let UserIconTwo = document.getElementById('user_icon_two');

            Lastname.addEventListener('input', () => {

                let nameRegExp = /^([a-zA-Z0-9áéíóöúüýčďěňšôľťžÁÉÍÓÖÚÜÝČĎĚŇŠŤŽÄÔ]{1,20})$/;

                if(Lastname.value.match(nameRegExp)){
                    Lastname.style.border = '.1rem solid green';

                    UserIconTwo.style.color = '#16e907';
                }else{
                    Lastname.style.border = '.1rem solid red';

                    UserIconTwo.style.color = 'red';
                }
            });
// -------------------------------------------------------------------------------------------------------

        let EmailInput = document.getElementById('email');
        let EmailError = document.getElementById('email_error');

        let EmailIcon = document.getElementById('email_icon');

        EmailInput.addEventListener('input', () => {

            let EmailRegExp = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

            if(EmailInput.value.match(EmailRegExp)){
                EmailInput.style.border = '.1rem solid green';
                EmailError.style.display = 'none';

                EmailIcon.style.color = '#16e907';

            }else{
                EmailInput.style.border = '.1rem solid red';
                EmailError.innerHTML = 'Enter a valid email address!';
                EmailError.style.color = 'red';
                EmailError.style.display = 'block';

                EmailIcon.style.color = 'red';
            }

        })

// ----------------------------------------------------------------------------------------------------------


        let MobileInput = document.getElementById('mobile');

        let MobileError = document.getElementById('mobile_error');

        let Mobile_Icon = document.getElementById('mobile_icon');

        MobileInput.addEventListener('input', () => {

            let nameRegExp = /^\d+$/;

            if(MobileInput.value.match(nameRegExp)){
                MobileInput.style.border = '.1rem solid green';

                MobileError.style.display = 'none';

                Mobile_Icon.style.color = '#16e907';
            }else{
                MobileInput.style.border = '.1rem solid red';

                MobileError.style.display = 'block';
                MobileError.innerHTML = 'Please enter numbers!';
                MobileError.style.color = 'red';

                Mobile_Icon.style.color = 'red';
            }
        });

// -----------------------------------------------------------------------------------------------------------------------

        let PasswordOne = document.getElementById('password_one');
        let LockIcon = document.getElementById('lock_one');

        let LockErrorOne = document.getElementById('lock_one_error');

        PasswordOne.addEventListener('input', () => {
            
            let nameRegExp = /^.{8,}$/;

            if(PasswordOne.value.match(nameRegExp)){
                PasswordOne.style.border = '.1rem solid green';
                LockIcon.style.color = '#16e907';
                LockErrorOne.style.display = 'none';
            }else{
                PasswordOne.style.border = '.1rem solid red';
                LockIcon.style.color = 'red';
            }


            if(PasswordOne.value.length < 8){
                LockErrorOne.style.display = 'block';
                LockErrorOne.innerHTML = 'Minimum 8 characters!';
                LockErrorOne.style.color = 'red';
            }

        })
// -----------------------------------------------------------------------------------------------------------------------------------


        let PasswordTwo = document.getElementById('password_two');
        let LockIconTwo = document.getElementById('lock_two');

        let LockErrorTwo = document.getElementById('lock_two_error');

        PasswordTwo.addEventListener('input', () => {
            
            let nameRegExp = /^.{8,}$/;

            if(PasswordTwo.value.match(nameRegExp)){
                PasswordTwo.style.border = '.1rem solid green';
                LockIconTwo.style.color = '#16e907';
                LockErrorTwo.style.display = 'none';
            }else{
                PasswordTwo.style.border = '.1rem solid red';
                LockIconTwo.style.color = 'red';
            }


            if(PasswordTwo.value.length < 8){
                LockErrorTwo.style.display = 'block';
                LockErrorTwo.innerHTML = 'Minimum 8 characters!';
                LockErrorTwo.style.color = 'red';
            }

        })
// -------------------------------------------------------------------------------------------------------------------------------------------------

        function ShowPasswordOne() {
            let password1 = document.getElementById('password_one');

            if(password1.type === 'password'){
                password1.type = 'text';
            }else{
                password1.type = 'password';
            }
        }

        function ShowPasswordTwo() {
            let password2 = document.getElementById('password_two');

            if(password2.type === 'password'){
                password2.type = 'text';
            }else{
                password2.type = 'password';
            }
        }

      
    </script>
</body>
</html>
