<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "lab10db";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$parameter = isset($_GET['parameter']) ? $_GET['parameter'] : '';

// for daalgavar 1
// $sql = "SELECT * FROM itemlocation WHERE itemno = ? OR roomno = ?";

// for daalgavar 2
$sql = "SELECT h.itemname as itemno, r.roomname as roomno, il.quantity as quantity, il.condition1 as condition1 FROM itemlocation il inner join householditems h on h.itemno = il.itemno inner join room r on r.roomno = il.roomno WHERE il.itemno = ? OR il.roomno = ?";



$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $parameter, $parameter);
$stmt->execute();

$result = $stmt->get_result();

$response = [];

if ($result->num_rows > 0) {
    // get results
    while ($row = $result->fetch_assoc()) {
        $response[] = [
            'itemno' => $row['itemno'],
            'roomno' => $row['roomno'],
            'quantity' => $row['quantity'],
            'condition' => $row['condition1']
        ];
    }
} else {
    $response['message'] = "No results found.";
}

$stmt->close();
$conn->close();

// set json, turn to comment if json is not necessary
header('Content-Type: application/json');
echo json_encode($response);

?>