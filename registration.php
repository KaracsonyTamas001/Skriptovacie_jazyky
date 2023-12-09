<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
    <h2>Registration</h2>

    <!-- Login link -->
    <p>Already have an account? <a href="login.php">Login here</a>.</p>

    <?php
    // Your registration logic here
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Handle registration form submission
        // ...

        // Example success message
        echo "<p>Registration successful!</p>";
    }
    ?>

    <!-- Registration form -->
    <form method="post" action="">
        <!-- Your registration form fields here -->
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>



<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "skripto_project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];  // A jelszó itt nem titkosított

    // SQL parancs a felhasználó hozzáadásához a táblához
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

