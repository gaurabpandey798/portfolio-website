<?php
$servername = "localhost"; // Your MySQL server (localhost for most servers)
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "contact_form"; // The name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
