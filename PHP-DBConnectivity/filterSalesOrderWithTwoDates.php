<?php

error_reporting(E_ERROR|E_PARSE);

$date_of_order1 = $_POST['date_of_order1'];
$date_of_order2 = $_POST['date_of_order2'];
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_db";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT * FROM sales_orders_list where date_of_order BETWEEN '$date_of_order1' AND '$date_of_order2';";
$response = array();
$result = $conn->query($sql);
if(mysqli_num_rows($result)>0){
	$response['sales_orders_list'] = array();
	while($row=mysqli_fetch_array($result)){
		array_push($response['sales_orders_list'], $row);
	}
	$response['success']=1;
 	$response['message']="Records retrieved successfully!";
}else{
 	$response['success']=0;
 	$response['message']="No records found!";
 }
 echo json_encode($response);
?>