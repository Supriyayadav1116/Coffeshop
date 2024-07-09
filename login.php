<?php
session_start();

$servername = "localhost";
$username1 = "root";
$password = "";
$dbname = "mydatabase";

$conn = new mysqli($servername, $username1, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["loginUsername"];
    $password = $_POST["loginPassword"];

    $sql = "SELECT * FROM users WHERE email='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if ($password == $row["password"]) {
            $_SESSION["email"] = $username;
            header("Location: sample.html");
            exit();
        }
    }
    echo "Invalid credentials. Please try again.";
}

$conn->close();
?>