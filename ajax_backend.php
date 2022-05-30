<?
    session_start();

    //=========== Database Connection ===========
    $database = new mysqli("localhost", "ynp062", "yash123", "ynp062");
    if($database->connect_error)
    {
        die("Connection failed: ". $database->connect_error);
    }
    
    //Buy Button Function
    if(isset($_GET['buypid']))
    {
        $button_pid = $_GET['buypid'];
        $getDataQuery = "SELECT quantity FROM Posts WHERE pid = '$button_pid'";
        $result = $database->query($getDataQuery);
        $row_temp = $result->fetch_array(MYSQLI_NUM);
        $temp_quantity = $row_temp[0];
        $temp_quantity++;

        $updateQuery = "UPDATE Posts SET quantity = '$temp_quantity' WHERE pid = '$button_pid'";
        $result = $database->query($updateQuery);
    }

    //Consume Button Function
    if(isset($_GET['consumepid']))
    {
        $button_pid = $_GET['consumepid'];
        $getDataQuery = "SELECT quantity FROM Posts WHERE pid = '$button_pid'";
        $result = $database->query($getDataQuery);
        $row_temp = $result->fetch_array(MYSQLI_NUM);
        $temp_quantity = $row_temp[0];

        if($temp_quantity <=0)
        {
            $temp_quantity = 0;
        }
        else
        {
            $temp_quantity--;
        }

        $updateQuery = "UPDATE Posts SET quantity = '$temp_quantity' WHERE pid = '$button_pid'";
        $result = $database->query($updateQuery);
    }

    //Delete Button Function
    if(isset($_GET['deletepid']))
    {
        $button_pid = $_GET['deletepid'];

        $deleteQuery = "DELETE FROM Posts WHERE pid = '$button_pid'";
        $result = $database->query($deleteQuery);
    }

    //Post Retrival Query
    $getDataQuery = "SELECT Posts.title, Posts.description, Posts.quantity, Users.avatar, Users.username, Posts.pid, Posts.pdate, Posts.uid 
    FROM Posts INNER JOIN Users ON Posts.uid = Users.uid ORDER BY quantity ASC, pdate DESC";
    $resultList = $database->query($getDataQuery);

    $dataArray = array();
 
    while($row = $resultList->fetch_assoc())
    {
        $dataArray[] = $row;
    }
    
    $jsonArray = json_encode($dataArray);

    echo $jsonArray;
?>