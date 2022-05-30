<?php
    session_start();
    if (isset($_SESSION["email"])){
        header("Location: groceryList.php");
        die();
    }
    else{
        $validate = true;
        $reg_Email = "/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/";
        $reg_Pswd = "/^(?=.*[^A-Za-z])[A-Za-z\S]{6,}$/";

        $email = "";
        $password = "";
        $error = "";

        if (isset($_POST["submitted"]) && $_POST["submitted"])
        {
            $email = trim($_POST["email"]);
            $password = trim($_POST["password"]);
            
            //=========== Database Connection ===========
            $database = new mysqli("localhost", "ynp062", "yash123", "ynp062");
            if ($database->connect_error)
            {
                die ("Connection failed: " . $database->connect_error);
            }

            $checkUserQuery = "SELECT * FROM Users WHERE email = '$email' AND password = '$password'";
            
            $query = $database->query($checkUserQuery);
            $users_array = $query->fetch_assoc();

            //Check email and password
            if($email != $users_array["email"] && $password != $users_array["password"])
            {
                $error = $error . "Email and password doesn't match with any of our users. Try Again!";
                $validate = false;
            }
            else
            {
                $emailMatch = preg_match($reg_Email, $email);
                if($email == null || $email == "" || $emailMatch == false)
                {
                    $error = $error . "Invalid Email. ";
                    $validate = false;
                }
                
                $pswdLen = strlen($password);
                $passwordMatch = preg_match($reg_Pswd, $password);
                if($password == null || $password == "" || $passwordMatch == false)
                {
                    $error = $error . "Invalid Password. ";
                    $validate = false;
                }
            }
            
            //=========== If everything is validated ===========
            if($validate == TRUE)
            {
                session_start();
                $_SESSION["email"] = $users_array["email"];
                header("Location: groceryList.php");
                $database->close();
                exit();
            }
            else 
            {
                $final_error = "Error Occured: " . $error;
                echo "<span class='error'>$final_error</span>";
            }

            $database->close();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=devive-width">
        <title>GIS Login</title>
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
                margin-top: 17%;
                margin-left: 70px;
            }
        </style>
        <script src="https://kit.fontawesome.com/ec20cfd790.js" crossorigin="anonymous"></script>
        <script src="Javascript/login_validate.js"></script>
    </head>

    <body style="margin: 0;">
        <!-- HEADER SECTION -->
        <header>
            <div class="container">
                <h2 class="logo"><i class="fas fa-seedling"></i>Grocery Inventory System</h2>
                <nav>
                    <ul>
                        <li><i style="margin-right: 10px;" class="fas fa-user-plus"></i><a href="http://www2.cs.uregina.ca/~ynp062/Assignments/Assignment_6/signup.php">Sign-Up</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <!-- LOGIN FORM SECTION -->
        <div class="decor spacer" style="text-align: center;">
            <h1 style="color: white; font-family: arial;">Grocery Portal</h1>

            <form id="loginform" action="login.php" method="post">

                <input type="hidden" name="submitted" value="1"/>
                
                <input type="text" id="email_field" name="email" placeholder="Email"/>
                <label id="label_email" class="err_msg">Example: 'word@word.XYZ' Restrictions: No Space & smaller then 60 characters.</label>

                <input type="password" id="password_field" name="password" placeholder="Password"/>
                <label id="label_password" class="err_msg">Restrictions: No Spaces, 6 characters or longer.</label>

                <input type="submit" value="Login"/>
                
            </form>

            <script src="Javascript/login_validate-r.js"></script>

            <p class="textFonts">Not yet a user? <a style="color:white; text-decoration: underline;" href="signup.php">Sign Up Now!</a></p>
        </div>
    </body>
</html>