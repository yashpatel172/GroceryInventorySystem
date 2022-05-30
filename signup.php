<?php

    $validate = true;
    $reg_Username = "/^[^\s\d!@£$%^&*()+=]+$/";
    $reg_Email = "/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/";
    $reg_Pswd = "/^(?=.*[^A-Za-z])[A-Za-z\S]{6,}$/";
    $reg_Bday = "/^([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))$/";
    $error = "";
    
    $username = "";
    $email = "";
    $password = "";
    $dob = "mm/dd/yyyy";
    $target = "Uploads/";

    if (isset($_POST["submitted"]) && $_POST["submitted"])
    {
        //Getting the data from HTML inputs
        $username = trim($_POST["username"]);
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);
        $dob = trim($_POST["dob"]);

        //=========== Database Connection ===========
        $database = new mysqli("localhost", "ynp062", "yash123", "ynp062");
        if($database->connect_error)
        {
            die("Connection failed: ". $database->connect_error);
        }

        //=========== Find User with entered email ===========
        $checkEmailQuery = "SELECT * FROM Users WHERE email = '$email'";
        $query = $database->query($checkEmailQuery);

        //=========== Checking for Email, Password and DOB =========== 
        if($query->num_rows > 0)
        {
            $error = $error . "Email entered is already used. ";
            $validate = false;
        }
        else
        {
            //=========== Checking Username =========== 
            $usernameMatch = preg_match($reg_Username, $username);
            if($username == null || $username == "" || $usernameMatch == false)
            {
                $error = $error . "Invalid Username. ";
                $validate = false;
            }

            //=========== Checking Email =========== 
            $emailMatch = preg_match($reg_Email, $email);
            if($email == null || $email == "" || $emailMatch == false)
            {
                $error = $error . "Invalid Email. ";
                $validate = false;
            }
            
            //=========== Checking Password =========== 
            $pswdLen = strlen($password);
            $pswdMatch = preg_match($reg_Pswd, $password);
            if($password == null || $password == "" || $pswdLen< 6 || $pswdMatch == false)
            {
                $error = $error . "Invalid Password. ";
                $validate = false;
            }

            //=========== Checking DOB =========== 
            $bdayMatch = preg_match($reg_Bday, $dob);
            if($dob == null || $dob == "" || $bdayMatch == false)
            {
                $error = $error . "Invalid DOB. ";
                $validate = false;
            }

            if(isset($_FILES["avatar"]))
            {
                //=========== Checking duplicate avatar =========== 
                $target = $target . $_FILES["avatar"]["name"];

                $checkAvatarQuery = "SELECT * FROM Users WHERE avatar = '$target'";
                $query = $database->query($checkAvatarQuery);
        
                //=========== Checking duplicate avatar names=========== 
                if($query->num_rows > 0){
                    $error = $error . "Duplicate avatar found. ";
                    $validate = false;
                }
                else{
                    if(move_uploaded_file($_FILES["avatar"]["tmp_name"], $target)) {} 
                    else {
                        $error = $error . "Sorry, there was a problem uploading your file. ";
                        $validate = false;
                    }   
                }
            }    
        }

        //=========== If everything is validated ===========
        if($validate == TRUE){
            $dateFormat = date("Y-m-d", strtotime($dob)); 

            $insertUserQuery = "INSERT INTO Users (fid, username, email, password, dob, avatar) VALUES (1, '$username', '$email', '$password', '$dateFormat', '$target')";
            $query = $database->query($insertUserQuery);
            
            if ($query === TRUE){
                header("Location: login.php");
                $database->close();
                exit();
            }
        }
        else{
            $final_error = "Error Occured: " . $error;
            echo "<span class='error'>$final_error</span>";
        }
        $database->close();
    }
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=devive-width">
        <title>GIS Sign-Up</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
        <style>
            html
            {
                font: 15px/1.5 arial;
                margin : 0;
                padding: 0;
                height: 100%;
                background-image: url("Images/BackgroundWall.jpg");
                background-size: 100% 100%;
                background-repeat: no-repeat;
            }
            nav li
            {
                margin-top: 20%;
                margin-left: 70px;
            }
        </style>
        <script src="https://kit.fontawesome.com/ec20cfd790.js" crossorigin="anonymous"></script>
        <script src="Javascript/signup_validate.js"></script>
    </head>

    <body style="margin: 0;">

        <!-- HEADER SECTION -->
        <header>
            <div class="container">
                <h2 class="logo"><i class="fas fa-seedling"></i>Grocery Inventory System</h2>
                <nav>
                    <ul>
                        <li><i style="margin-right: 10px;" class="fas fa-sign-in-alt"></i><a href="http://www2.cs.uregina.ca/~ynp062/Assignments/Assignment_6/login.php">Login</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <!-- SIGNUP FORM SECTION -->
        <div class="decor_signup spacer_signup" style="text-align: center;">

            <h1 style="color: white; font-family: arial;">Be a part of the group!</h1>

            <form  id="signupform" action="signup.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="submitted" value="1"/>

                <input type="text" id="username_field" name="username" placeholder="Username" />
                <label id="label_username" class="err_msg">Restrictions: No Spaces, No digits</label>

                <input type="text" id="email_field" name="email" placeholder="Email" />
                <label id="label_email" class="err_msg">Example: 'word@word.XYZ' Restrictions: No Space & smaller then 60 characters.</label>

                <input type="password" id="password_field" name="password" placeholder="Password" />
                <label id="label_password" class="err_msg">Restrictions: No Spaces, 6 characters long & atleast one non-letter character.</label>

                <input type="password" id="confirmpassword_field" name="confirm_password" placeholder="Confirm Password" />
                <label id="label_confirmpassword" class="err_msg">*Same format as Password</label>
                
                <input type="text" onfocus="(this.type='date')" id="dob_field" name="dob" placeholder="Date of Birth" />
                <label id="label_dob" class="err_msg" style="margin-bottom: 10px;">*Date of Birth Required</label>

                <input type="file" id="avatar_field" accept="image/*" name="avatar" style="display:none;" />
                <label class="textFonts forFile" for="avatar_field"><i style="margin-right: 10px;" class="fas fa-file-upload"></i>Upload Avatar</label>
                <label id="label_avatar" class="err_msg">*Avatar Required</label>
                
                <input type="submit" value="SignUp"/>
            </form>
            <script src="Javascript/signup_validate-r.js"></script>
        </div>
    </body>
</html>