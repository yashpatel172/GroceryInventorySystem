<?php
    session_start();
    if(isset($_SESSION["email"]))
    {
        //=========== Database Connection ===========
        $database = new mysqli("localhost", "ynp062", "yash123", "ynp062");
        if($database->connect_error)
        {
            die("Connection failed: ". $database->connect_error);
        }
        $active_email = $_SESSION["email"];

        //Getting active user username
        $getUserQuery2 = "SELECT username, fid FROM Users WHERE email = '$active_email'";
        $user_result = $database->query($getUserQuery2);
        $row_get = $user_result->fetch_array(MYSQLI_NUM);
        $usernameActive = $row_get[0];
        $fidActive = $row_get[1];

        //Getting active user family
        $getUserQuery3 = "SELECT family_name FROM Families WHERE fid = '$fidActive'";
        $family_result = $database->query($getUserQuery3);
        $row_get = $family_result->fetch_array(MYSQLI_NUM);
        $familyActive = $row_get[0];

        //Create Family
        if($_POST["submit_1"]) 
        {   
            $validate = true;
            $error = "";
            $reg_FamilyName = "/^[^\s\d!@£$%^&*()+=]+$/";
            $familyName = trim($_POST["createfamily"]);

            //=========== Find User with entered email ===========
            $checkFamilyQuery = "SELECT * FROM Families WHERE family_name = '$familyName'";
            $query = $database->query($checkFamilyQuery);

            if($query->num_rows > 0){
                $error = $error . "Family already exists. ";
                $validate = false;
            }
            else
            {
                //=========== Checking familyName =========== 
                $familyMatch = preg_match($reg_FamilyName, $familyName);
                if($familyName == null || $familyName == "" || $familyMatch == false)
                {
                    $error = $error . "Invalid Family Name. ";
                    $validate = false;
                }
            }

            //=========== If everything is validated ===========
            if($validate == TRUE){
                $insertFamilyQuery = "INSERT INTO Families (family_name) VALUES ('$familyName')";
                $query = $database->query($insertFamilyQuery);
                
                if ($query === TRUE){
                    header("Location: family.php");
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
        //Join Family
        else if($_POST["submit_2"])
        {
            //Getting the data from HTML inputs
            $family_selected = "";

            if(isset($_POST["family_list"]))
            {
                $family_selected_string = $_POST["family_list"];

                //=========== Getting Family Joined =========== 
                $findFamilyQuery = "SELECT fid FROM Families WHERE family_name = '$family_selected_string'";
                $result = $database->query($findFamilyQuery);
                $row = $result->fetch_array(MYSQLI_NUM);
                $family_id = $row[0];

                //=========== Getting Logged In User =========== 
                $active_email = $_SESSION["email"];
                $getUserQuery = "SELECT uid FROM Users WHERE email = '$active_email'";
                $result = $database->query($getUserQuery);
                $row = $result->fetch_array(MYSQLI_NUM);
                $user_id = $row[0];

                $checkJoinQuery = "UPDATE Users SET fid = '$family_id' WHERE uid = '$user_id'";
                $result = $database->query($checkJoinQuery);
                
                if ($result === TRUE){
                    echo "<span class='error' style='background-color: mediumseagreen;'>You have successfully joined: $family_selected_string</span>";
                    header("Location: family.php");
                    $database->close();
                    exit();
                }
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
        <title>GIS Family</title>
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
            .style_option
            {
                font-size : 15px;
                outline : none;
                background-color : #36393f;
                color : white;
                border : 2px solid white;
                height : 50px;
	            width : 325px;
                border-radius : 1px;
            }
            .h1_style
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
        <script src="Javascript/family_validate.js"></script>
    </head>

    <body style="margin: 0;">
        <!-- HEADER SECTION -->
        <header>
            <div class="container">
                <h2 class="logo"><i class="fas fa-user"></i>User: <?=$usernameActive?> <i class="fas fa-user-friends" style="margin-left: 20px; margin-top: 10px;"></i>Family: <?=$familyActive?> </h2>
                <nav>
                    <ul>
                        <li><i style="margin-right: 10px;" class="fas fa-shopping-cart"></i><a href="http://www2.cs.uregina.ca/~ynp062/Assignments/Assignment_6/groceryList.php">Grocery-List</a></li>
                        <li><i style="margin-right: 10px;" class="fas fa-plus-square"></i><a href="http://www2.cs.uregina.ca/~ynp062/Assignments/Assignment_6/postGrocery.php">Post-Grocery</a></li>
                        <li><i style="margin-right: 10px;" class="fas fa-power-off"></i><a href="http://www2.cs.uregina.ca/~ynp062/Assignments/Assignment_6/logout.php">Logout</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <hr class="h1_style">

        <!-- FORM SECTION -->
        <div style="margin-top: 50px;">

            <!-- CREATE FAMILY FORM SECTION -->
            <div class="decor" style="text-align: center;">
                <h1 style="color: white; font-family: arial;"><i class="fas fa-user-plus"></i>Create Family</h1>

                <form id="createfamilyform" action="family.php" method="post">
                    <input type="text" name="createfamily" placeholder="Family Name">
                    <label id="label_createFamily" class="err_msg">*To create family this is required</label>
                    <input type="submit" name="submit_1" value="Create">
                </form>

            </div>
            
            <hr class="h1_style">

            <!-- JOIN FAMILY FORM SECTION -->
            <div class="decor spacer_family" style="text-align: center;">
                <h1 style="color: white; font-family: arial;"><i class="fas fa-users"></i>Join Family</h1>

                <form id="joinfamilyform" action="family.php" method="post">
                    <?php
                        $database = new mysqli("localhost", "ynp062", "yash123", "ynp062");
                        if ($database->connect_error)
                        {
                            die ("Connection failed: " . $database->connect_error);
                        }

                        $familyListQuery = "SELECT family_name FROM Families ORDER BY family_name";
                        $result = $database->query($familyListQuery);

                        echo "<select name='family_list'>";
                        while ($row = $result->fetch_array()) {
                            echo "<option class='style_option' value='" . $row['family_name'] . "'>" . $row['family_name'] . "</option>";
                        }
                        echo "</select>";
                    ?>
                    <input type="submit" name="submit_2" value="Join">
                </form>
            </div>

        </div>
        <script src="Javascript/family_validate-r.js"></script>   
    </body>
</html>