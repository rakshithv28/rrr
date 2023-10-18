<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "employees";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Query the database to check if an employee with the provided email and password exists
    $sql = "SELECT id, email, password FROM employee_info WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $_SESSION["user_id"] = $row["id"];
        // Redirect to the employee information page or wherever you want
        header("Location: indexuser.html");
    } else {
        // Incorrect email or password
        echo "<script>alert('Incorrect email or password. Please try again.');</script>";
    }
}

// Close the database connection
$conn->close();
?>
