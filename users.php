<?php
// Kapcsolódás az adatbázishoz
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "your_database_name";

$conn = new mysqli($servername, $username, $password, $dbname);

// Ellenőrizze a kapcsolatot
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Feldolgozás, ha a regisztrációs űrlapot beküldték
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredUsername = $_POST["username"];
    $enteredPassword = $_POST["password"];

    // Jelszó hashelése
    $hashedPassword = password_hash($enteredPassword, PASSWORD_DEFAULT);

    // Beszúrás az adatbázisba
    $sql = "INSERT INTO users (username, password) VALUES ('$enteredUsername', '$hashedPassword')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Bezárja az adatbázis kapcsolatot
$conn->close();
?>