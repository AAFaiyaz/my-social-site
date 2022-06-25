<?php
//Declaring variables to prevent errors
$fname = ""; //First Name
$lname = ""; //Last Name
$em = ""; //Email
$em2 = ""; //Email2
$password = ""; //passowrd
$password2 = ""; //passowrd2
$date = ""; //Sign up date
$error_array = array(); //Holds Error Messages


if(isset($_POST['register_button'])){

    //Registraton from values

    //First Name
    $fname = strip_tags($_POST['reg_fname']); // strip_tags = get rid of html tags
    $fname = str_replace(' ', '', $fname); // remove spaces
    $fname = ucfirst(strtolower($fname)); //Uppercase First Letter
    $_SESSION['reg_fname'] = $fname; //Stores first name into sesson variable

    //Last Name
    $lname = strip_tags($_POST['reg_lname']); // strip_tags = get rid of html tags
    $lname = str_replace(' ', '', $lname); // remove spaces
    $lname = ucfirst(strtolower($lname)); //Uppercase First Letter
    $_SESSION['reg_lname'] = $lname; //Stores last name into sesson variable

    //Email
    $em = strip_tags($_POST['reg_email']); // strip_tags = get rid of html tags
    $em = str_replace(' ', '', $em); // remove spaces
    $em = ucfirst(strtolower($em)); //Uppercase First Letter
    $_SESSION['reg_email'] = $em; //Stores email into sesson variable

    //Email 2
    $em2 = strip_tags($_POST['reg_email2']); // strip_tags = get rid of html tags
    $em2 = str_replace(' ', '', $em2); // remove spaces
    $em2 = ucfirst(strtolower($em2)); //Uppercase First Letter
    $_SESSION['reg_email2'] = $em2; //Stores email2 into sesson variable

    //Password
    $password = strip_tags($_POST['reg_password']); // strip_tags = get rid of html tags

    //Password2
    $password2 = strip_tags($_POST['reg_password2']); // strip_tags = get rid of html tags

    $date = date("Y-m-d"); // Current date

    if ($em == $em2){
        //Check email is in valid format
        if(filter_var($em, FILTER_VALIDATE_EMAIL)){

            $em = filter_var($em, FILTER_VALIDATE_EMAIL);

            //Check if email already exist
            $e_check = mysqli_query($con, "SELECT email FROM users where email='$em'");

            //Count the number of rows
            $num_rows = mysqli_num_rows($e_check);

            if ($num_rows > 0){
                // echo "Email already exist";
                array_push($error_array, "Email already exist<br>");
            }

        } else {
            // echo "Invalid format";
            array_push($error_array, "Invalid email format<br>");
        }
    } else {
        // echo "Emails don't match";
        array_push($error_array, "Emails don't match<br>");
    }

    if(strlen($fname) > 25 || strlen($fname) < 2){
        // echo "Your first name must be between 2 and 25 characters";
        array_push($error_array, "Your first name must be between 2 and 25 characters<br>");
    }

    if(strlen($lname) > 25 || strlen($lname) < 2){
        // echo "Your last name must be between 2 and 25 characters";
        array_push($error_array, "Your last name must be between 2 and 25 characters<br>");
    }

    if ($password != $password2){
        // echo "Password is not same<br>";
        array_push($error_array, "Password is not same<br>");
    } else {
        if (preg_match('/[^A-Za-z0-9]/', $password)){ //it checks A-Z, a-z, 0-9 characters
            // echo "Your password only English characters or numbers";
            array_push($error_array, "Your password only English characters or numbers<br>");
        }
    }

    if (strlen($password) > 30 || strlen($password) < 5){
        // echo "Your password must be between 5 and 30 characters";
        array_push($error_array, "Your password must be between 5 and 30 characters<br>");
    }

    if (empty($error_array)) {
        $password = md5($password); //Encrypt password before sending to database

        //Generate username by concatenation first name and last name
        $username = strtolower($fname . "_" . $lname);
        $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");

        $i = 0;
        //If username exist add number to username
        while(mysqli_num_rows($check_username_query) != 0){
            $i++;
            $username = $username . "_" . $i;
            $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
        }

        // for ($i = 0; mysqli_num_rows($check_username_query) != 0; $i++){
        //     $username = $username . "_" . $i;
        //     $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
        // }

        //Profile picture assignment
        $rand = rand(1,2); //Random number between 1 and 2
        if ($rand == 1){
            $profile_pic = "assets/images/profile_pics/defaults/head_deep_blue.png";
        } else if ($rand == 2){
            $profile_pic = "assets/images/profile_pics/defaults/head_emerald.png";
        }

        $query = mysqli_query($con, "INSERT INTO users VALUES ('', '$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic', '0', '0', 'no', ',')");
        
        array_push($error_array,"<span style='color: #14C800;'>Registration Successfull!</span><br>");

        //Clear sesion variables
        $_SESSION['reg_fname'] = "";
        $_SESSION['reg_lname'] = "";
        $_SESSION['reg_email'] = "";
        $_SESSION['reg_email2'] = "";
        
    }


}