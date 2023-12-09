<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "skripto_project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ellenőrizzük, hogy a felhasználó be van-e jelentkezve
if (isset($_SESSION["username"])) {
    // Ha be van jelentkezve, akkor a "Log out" gombra kattintva kijelentkezik
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Kiléptetjük a felhasználót
        session_unset();
        session_destroy();
        header("Location: index.php"); // Átirányítjuk a kezdőoldalra
        exit();
    }

    // Ha be van jelentkezve, megjelenítjük a "Log out" gombot
    echo '<h2>Hello, ' . $_SESSION["username"] . '!</h2>';
    echo '<form action="" method="post"><input type="submit" value="Log out"></form>';
} else {
    // Ha nincs bejelentkezve, a bejelentkezési űrlapot jelenítjük meg
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result === FALSE) {
            die("Query failed: " . $stmt->error);
        }

        if ($result->num_rows > 0) {
            // Sikeres bejelentkezés esetén elmentjük a felhasználónevet a munkamenetben
            $_SESSION["username"] = $username;
            header("Location: index.php");
            exit();
        } else {
            echo "Invalid credentials";
        }
    }

    // Bejelentkezési űrlap megjelenítése, ha nincs bejelentkezve
    echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
    </head>
    <body>
        <h2>Login</h2>
        <form action="" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>
            <input type="submit" value="Login">
        </form>
        <p>Don\'t have an account? <a href="registration.php">Register here</a></p>
    </body>
    </html>';
}

$conn->close();
?>
