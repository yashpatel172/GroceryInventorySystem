<?php
    session_start();
    if(isset($_SESSION["email"]))
    {
        $validate = true;
        $regex_Title = "/^[^\d!@£$%^&*()+=]+$/";
        $error = "";
        
        //=========== Database Connection ===========
        $database = new mysqli("localhost", "ynp062", "yash123", "ynp062");
        if($database->connect_error)
        {
            die("Connection failed: ". $database->connect_error);
        }
        $active_email = $_SESSION["email"];
        
        //Finding Name and family name
        $getUserQuery2 = "SELECT username, fid FROM Users WHERE email = '$active_email'";
        $user_result = $database->query($getUserQuery2);
        $row_get = $user_result->fetch_array(MYSQLI_NUM);
        $usernameActive = $row_get[0];
        $fidActive = $row_get[1];

        $getUserQuery3 = "SELECT family_name FROM Families WHERE fid = '$fidActive'";
        $family_result = $database->query($getUserQuery3);
        $row_get = $family_result->fetch_array(MYSQLI_NUM);
        $familyActive = $row_get[0];

        if (isset($_POST["submitted"]) && $_POST["submitted"])
        {
            //Getting the data from HTML inputs
            $groceryTitle = trim($_POST["groceryTitle"]);
            $groceryDescription = trim($_POST["groceryDescription"]);
            $quantity = trim($_POST["quantity"]);

            //=========== Getting Logged In User =========== 
            $getUserQuery = "SELECT uid FROM Users WHERE email = '$active_email'";
            $result = $database->query($getUserQuery);
            $row = $result->fetch_array(MYSQLI_NUM);
            $user_id = $row[0];

            //=========== Find User with entered email ===========
            $checkTitleQuery = "SELECT * FROM Posts WHERE title = '$groceryTitle'";
            $query = $database->query($checkTitleQuery);

            //=========== Checking Invalid Post =========== 
            if($query->num_rows > 0)
            {
                $error = $error . "Grocery Title is already in use!";
                $validate = false;
            }
            else
            {
                //=========== Checking Title =========== 
                $titleMatch = preg_match($regex_Title, $groceryTitle);
                if($groceryTitle == null || $groceryTitle == "" || $titleMatch == false)
                {
                    $error = $error . "Invalid Grocery Title. ";
                    $validate = false;
                }
                
                //=========== Checking Description =========== 
                if($groceryDescription == null || $groceryDescription == "")
                {
                    $error = $error . "Invalid Grocery Description. ";
                    $validate = false;
                }
                //=========== Checking Quantity =========== 
                if($quantity == null || $quantity == "")
                {
                    $error = $error . "Invalid Grocery Quantity. ";
                    $validate = false;
                }
            }

            //=========== If everything is validated ===========
            if($validate == TRUE){
                $current_date = date("Y-m-d");

                $insertPostQuery = "INSERT INTO Posts (uid, title, description, quantity, pdate) VALUES ('$user_id', '$groceryTitle', '$groceryDescription', '$quantity', '$current_date')";
                $query = $database->query($insertPostQuery);
                
                if ($query === TRUE){
                    header("Location: groceryList.php");
                    $database->close();
                    exit();
                }
            }
            else{
                $final_error = "Error Occured: " . $error;

                echo "<span class='error'>$final_error</span>";
            }
        }
        $database->close();
    }
    else {
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=devive-width">
        <title>GIS PostGrocery</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
        <style>
            html
            {
                font: 15px/1.5 arial;
                margin : 0;
                padding: 0;
                height: 100%;
                background-color: #36393f;
                background-size: 100% 100%;
                background-repeat: no-repeat;
            }
            div
            {
                text-align: center;
            }
            .h1_stylePost
            {
                height:2px;
                border-width:0;
                background-color:gray; 
                margin-left: 50px; 
                margin-right: 50px;
            }
            nav li
            {
                margin-top: 5%;
                margin-left: 70px;
            }
        </style>
        <script src="https://kit.fontawesome.com/ec20cfd790.js" crossorigin="anonymous"></script>
        <script src="Javascript/postGrocery_validate.js"></script>
    </head>

    <body style="margin: 0;">
        <!-- HEADER SECTION -->
        <header>
            <div class="container">
                <h2 class="logo"><i class="fas fa-user"></i>User: <?=$usernameActive?> <i class="fas fa-user-friends" style="margin-left: 20px; margin-top: 10px;"></i>Family: <?=$familyActive?> </h2>
                <nav>
                    <ul>
                        <li><i style="margin-right: 10px;" class="fas fa-shopping-cart"></i><a href="http://www2.cs.uregina.ca/~ynp062/Assignments/Assignment_6/groceryList.php">Grocery-List</a></li>
                        <li><i style="margin-right: 10px;" class="fas fa-history"></i><a href="http://www2.cs.uregina.ca/~ynp062/Assignments/Assignment_6/family.php">Change-Family</a></li>
                        <li><i style="margin-right: 10px;" class="fas fa-power-off"></i><a href="http://www2.cs.uregina.ca/~ynp062/Assignments/Assignment_6/logout.php">Logout</a></li>
                    </ul>
                </nav>
            </div>
        </header>
        
        <hr class="h1_stylePost">

        <!-- POST GROCERY FORM SECTION -->
        <div class="decorPost">

            <h1 style="color: white; font-family: arial;"><i class="fas fa-cart-plus"></i>Post Grocery</h1>

            <form id="postgroceryform" action="postGrocery.php" method="post">

                <input type="hidden" name="submitted" value="1"/>

                <input type="text" name="groceryTitle" placeholder="Grocery Title"/>
                <label id="label_title" class="err_msg post_label">*Grocery Title Required</label>

                <textarea name="groceryDescription" placeholder="Grocery Description" rows="15" cols="40" style="margin-top: 10px;"></textarea>
                <label id="label_description" class="err_msg post_label">*Grocery Description Required</label>

                <input type="number" min="0" max="1000" name="quantity" placeholder="Quantity"/>
                <label id="label_quantity" class="err_msg post_label">*Quantity Required</label>

                <input type="submit" value="Post">

            </form>

            <script src="Javascript/postGrocery_validate-r.js"></script>

        </div> 
    </body>
</html>