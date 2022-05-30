<?
    session_start();
    if (!isset($_SESSION["email"])){
        header("Location: login.php");
        exit();
    }
    else 
    {
        //=========== Database Connection ===========
        $database = new mysqli("localhost", "ynp062", "yash123", "ynp062");
        if($database->connect_error)
        {
            die("Connection failed: ". $database->connect_error);
        }
        $active_email = $_SESSION["email"];

        //Getting logged in user
        $getUserQuery = "SELECT uid FROM Users WHERE email = '$active_email'";
        $uid_result = $database->query($getUserQuery);
        $row_get = $uid_result->fetch_array(MYSQLI_NUM);
        $user_id = $row_get[0];

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

        //Post Retrival Query
        $getDataQuery = "SELECT Posts.title, Posts.description, Posts.quantity, Users.avatar, Users.username, Posts.pid, Posts.pdate, Posts.uid 
                         FROM Posts INNER JOIN Users ON Posts.uid = Users.uid ORDER BY quantity ASC, pdate DESC";
        $resultList = $database->query($getDataQuery);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=devive-width">
        <title>GIS GroceryList</title>
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
            .box
            {
                transition: box-shadow .3s;
                color: white;
                margin: auto;
                max-width: 450px;
                text-align: center;
            }
            .box:hover {
                box-shadow: 0 0 10px 2px rgba(255, 255, 255, 0.4); 
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
            input[type=text]
            {
                text-align: center;
                pointer-events: none;
                user-select: none;
                font-size : 15px;
                outline : none;
                border : 2px solid white;
                background-color : rgba(5,4,2,0.1);
                color : white;

                border-radius : 1px;
                padding : 10px;
                height : 10px;
                width : 300px;
                margin : 10px auto;
                display : block;
            }
            td{
                	padding-left: 14px;
	                padding-right: 14px;
            }
        </style>
        <script src="https://kit.fontawesome.com/ec20cfd790.js" crossorigin="anonymous"></script>
        <script src="Javascript/groceryList_calculate.js"></script>
    </head>

    <body style="margin: 0;">
        <!-- HEADER SECTION -->
        <header>
            <div class="container">
                <h2 class="logo"><i class="fas fa-user"></i>User: <?=$usernameActive?> <i class="fas fa-user-friends" style="margin-left: 20px; margin-top: 10px;"></i>Family: <?=$familyActive?> </h2>
                <nav>
                    <ul>
                        <li><i style="margin-right: 10px;" class="fas fa-plus-square"></i><a href="http://www2.cs.uregina.ca/~ynp062/Assignments/Assignment_6/postGrocery.php">Post-Grocery</a></li>
                        <li><i style="margin-right: 10px;" class="fas fa-history"></i><a href="http://www2.cs.uregina.ca/~ynp062/Assignments/Assignment_6/family.php">Change-Family</a></li>
                        <li><i style="margin-right: 10px;" class="fas fa-power-off"></i><a href="http://www2.cs.uregina.ca/~ynp062/Assignments/Assignment_6/logout.php">Logout</a></li>
                    </ul>
                </nav>
            </div>
        </header>
        <hr class="h1_style">
        
        <div id="main">
            <?while($row = $resultList->fetch_assoc())
            {?>        
                <div class="box" id="box-<?=$row['pid']?>">
                    <h1><?=$row["title"]?></h1>
                    <p class="description"><?=$row["description"]?></p>
                    <p class="unitcount">- Quantity - <input type="text" id="textbox-<?=$row['pid']?>" value="<?=$row["quantity"]?>"/></p>
                    <p><img src="<?=$row["avatar"]?>" alt="Avatar" style="width:5%"> <i>User: <?=$row["username"]?> / Posted on: <?=$row["pdate"]?></i></p>
                    <p>
                        <button class="buy" id="buy-<?=$row['pid']?>">Buy</button>
                        <?if($row['quantity']<=0)
                        {?>
                            <button class="consume" id="consume-<?=$row['pid']?>" style="visibility:hidden">Consume</button>  
                        <?}
                        else 
                        {?>
                            <button class="consume" id="consume-<?=$row['pid']?>" style="visibility:visible">Consume</button> 
                        <?}
                        ?>  

                        <?if($user_id == $row['uid'])
                        {?>
                            <button class="delete" id="delete-<?=$row['pid']?>">Delete</button>
                        <?}?>
                    </p>
                </div>
            <?}?>
        </div>
        <script src="Javascript/ajax.js"></script>
        <!-- <script src="Javascript/groceryList_calculate-r.js"></script> -->
    </body>
</html>