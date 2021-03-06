<?php 
require 'config/config.php';

require 'includes/form_handlers/register_handler.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=form, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="register.php" method="POST">
        <input type="text" name="reg_fname" placeholder="First Name" value="<?php 
            if (isset($_SESSION['reg_fname'])){
                echo $_SESSION['reg_fname'];
            }
        ?>" required>
        <br>
        <?php if (in_array("Your first name must be between 2 and 25 characters<br>", $error_array)) echo "Your first name must be between 2 and 25 characters<br>"; ?>


        <input type="text" name="reg_lname" placeholder="Last Name" value="<?php 
            if (isset($_SESSION['reg_lname'])){
                echo $_SESSION['reg_lname'];
            }
        ?>" required>
        <br>
        <?php if (in_array("Your last name must be between 2 and 25 characters<br>", $error_array)) echo "Your last name must be between 2 and 25 characters<br>"; ?>

        <input type="email" name="reg_email" placeholder="Email" 
        value="<?php 
            if (isset($_SESSION['reg_email'])){
                echo $_SESSION['reg_email'];
            }
        ?>"
        required>
        <br>

        <input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php 
            if (isset($_SESSION['reg_email2'])){
                echo $_SESSION['reg_email2'];
            }
        ?>" required>
        <br>
        <?php 
            if (in_array("Email already exist<br>", $error_array)) echo "Email already exist<br>";
            else if (in_array("Invalid email format<br>", $error_array)) echo "Invalid email format<br>";
            else if (in_array("Emails don't match<br>", $error_array)) echo "Emails don't match<br>"; 
        ?>

        <input type="password" name="reg_password" placeholder="Password" required>
        <br>
        <input type="password" name="reg_password2" placeholder="Confirm Password" required>
        <?php 
            if (in_array("Password is not same<br>", $error_array)) echo "Password is not same<br>";
            else if (in_array("Your password only English characters or numbers<br>", $error_array)) echo "Your password only English characters or numbers<br>";
            else if (in_array("Your password must be between 5 and 30 characters<br>", $error_array)) echo "Your password must be between 5 and 30 characters<br>"; 
        ?>
        <br>
        <input type="submit" name="register_button" value="Register">
        <br>
        <?php 
            if (in_array("<span style='color: #14C800;'>Registration Successfull!</span><br>", $error_array)) echo "<span style='color: #14C800;'>Registration Successfull!</span><br>";
            ?>
    </form>
</body>
</html>