<?php 
    session_start();

    include 'conn.php';

    $error_msg = "";


    if(isset($_POST['login'])){

        $email = $_POST['email'];
        $password = hash('sha512', $_POST['password']);

        $user_sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' AND password = '$password'");

        $admin_sql = mysqli_query($conn, "SELECT * fROM admins WHERE admin_email = '$email' AND admin_password = '$password'");

        if(mysqli_num_rows($user_sql) > 0){
            $user = mysqli_fetch_assoc($user_sql);

            $_SESSION['user_type'] = 'user';
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_firstname'] = $user['firstname'];
            $_SESSION['user_lastname'] = $user['lastname'];
            $_SESSION['user_email'] = $user['email'];

            mysqli_query($conn, "UPDATE users SET last_login = NOW() WHERE id = ".$_SESSION['user_id']);

            header('Location: home.php');
           

           


        }elseif(mysqli_num_rows($admin_sql) > 0){
            $admin = mysqli_fetch_assoc($admin_sql);

            $_SESSION['user_type'] = 'admin';
            $_SESSION['admin_id'] = $admin['admin_id'];
            $_SESSION['admin_username'] = $admin['admin_username'];
            $_SESSION['admin_email'] = $admin['admin_email'];

            mysqli_query($conn, "UPDATE admins SET last_login = NOW() WHERE admin_id = ".$_SESSION['admin_id']);
            header('Location: admin_dashboard.php');
        } else{
            $error_msg = 'Pass or email invalid!';
        }
    }

   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <div class="login">
        <form action="" method="post">
            <h1>login</h1>
            <?php echo '<div id="error_message"> '.$error_msg.'</div>' ?>

            <div class="login_box">
                <div class="login_field">
                    <input type="email" name="email" id="email" placeholder="your email" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" required>
                    <i class="fas fa-envelope" id="email_iconka"></i>
                    <span id="email_error">
                        
                    </span>
                </div>

                <div class="login_field">
                    <input type="password" name="password" id='password' placeholder="your password" pattern="^.{8,}$" required>
                    <i class="fas fa-lock" id="password_iconka"></i>
                </div>
            </div>

            <input type="submit" value="login" name="login" class="login_btn">
            <p>Don't have an account?  <a href="register.php">Register</a></p>
        </form>
    </div>
</body>

<script>
    let EmailForm = document.getElementById('email');
    let EmailError = document.getElementById('email_error');

    let emailiconka = document.getElementById('email_iconka');

    EmailForm.addEventListener('input', ()=>{
        let EmailRegExp = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        if(EmailForm.value.match(EmailRegExp)) {
            EmailForm.style.border='.1rem solid green';
            emailiconka.style.color = '#16e907';

        }else{
            EmailForm.style.border='.1rem solid red';
            emailiconka.style.color = 'red';
        }
    })

// ----------------------------------------------------------------------------------------------

    let passwordForm = document.getElementById('password');
    let passwordIcon = document.getElementById('password_iconka');

    passwordForm.addEventListener('input', ()=>{
        let passwordRegExp = /^.{8,}$/;

        if(passwordForm.value.match(passwordRegExp)){
            passwordForm.style.border='.1rem solid green';
            passwordIcon.style.color = '#16e907';
            
        }else{
            passwordForm.style.border='.1rem solid red';
            passwordIcon.style.color = 'red';
        }
    })

</script>
</html>