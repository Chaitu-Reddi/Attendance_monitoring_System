<?php
$host = "103.21.58.5";
$user = "reactphp";
$password = "Project@2025";
$database = "reactphp";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed: " . $conn->connect_error]));
}
?>
