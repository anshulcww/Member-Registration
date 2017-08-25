<?php
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Headers: Content-Type');
	header('Access-Control-Allow-Methods: GET, POST, OPTIONS');

    include('db_connect.php');   
    include('random.php');   

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    };
    $user = json_decode(file_get_contents('php://input'), true);
    $arr = array();
    $message = array();
    $query  =  "SELECT *
                FROM product
                WHERE p_status = 'Pending'";
    $result = $conn->query($query);  
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $arr[] = $row;
        }
    }
    $message['products'] = $arr;
    unset($arr);
    $arr = array();
    $query  =  "SELECT *
                FROM agent";
    $result = $conn->query($query);  
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $arr[] = $row;
        }
    }
    $message['agents'] = $arr;
    echo json_encode($message);                                        
    $conn->close();
?>