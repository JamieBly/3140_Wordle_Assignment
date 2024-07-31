<?php
require_once('_config.php');
header("Content-Type: application/json");
echo json_encode(["version" => "0.9"]);

// Get the raw POST data
$data = file_get_contents("php://input");

// Decode the JSON data
$json_data = json_decode($data, true);

if ($json_data !== null) {
    $receivedData = $json_data['data'];
    // Do something with the data
    echo json_encode(['received' => $receivedData]);
} else {
    echo json_encode(['error' => 'No data received']);
}
