<?php 
    include 'conn.php';

    $error_msg = "";

    if(isset($_POST['verify'])){

        $email = $_POST['email'];

        $code_db = $_POST['code1'].$_POST['code2'].$_POST['code3'].$_POST['code4'].$_POST['code5'].$_POST['code6'];


        $update_database = "UPDATE users SET activated = NOW() WHERE email = '$email' AND code = '$code_db'";

        $result = mysqli_query($conn, $update_database);

        if(!$result){
            $error_msg = "Error" .mysqli_error($conn);
        }else{
            $rows = mysqli_affected_rows($conn);
        }

        if($rows === 0){
            $error_msg = 'Wrong code!';
        }else{
            header('Location: login.php');
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification</title>
    <link rel="stylesheet" href="css/verificate.css">
</head>
<body>
    <div class="verification">
        <form action="" method="post">
            <h1>your verification code</h1>
            <?php echo '<div id="error_message">'.$error_msg.'</div>' ?>

            <div class="code_input">

            <input type="hidden" name="email" placeholder="email" value="<?php echo isset($_GET['email']) ? $_GET['email'] : ''; ?>" required>
          
                 <input type="tel" name="code1" maxlength="1" pattern="^\d+$" required>
                 <input type="tel" name="code2" maxlength="1" pattern="^\d+$" required>
                 <input type="tel" name="code3" maxlength="1" pattern="^\d+$" required>
                 <input type="tel" name="code4" maxlength="1" pattern="^\d+$" required>
                 <input type="tel" name="code5" maxlength="1" pattern="^\d+$" required>
                 <input type="tel" name="code6" maxlength="1" pattern="^\d+$" required>
            </div>
            

            <input type="submit" value="verify" name="verify" class="verify_button">
        </form>
    </div>

    <script>
        const inputs = document.querySelectorAll('.code_input input');

        inputs.forEach((input, index) => {
            input.addEventListener('input', (event) => {
                let value = event.target.value;
                if (!/^\d$/.test(value)) {
                    event.target.value = '';
                    return;
                }

                if (value.length === 1) {
                    if (index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }
                }
            });

            input.addEventListener('keydown', (event) => {
                if (event.key === 'Backspace' && event.target.value === '') {
                    
                    if (index > 0) {
                        inputs[index - 1].focus();
                    }
                }
            });
        });

    </script>
</body>
</html>