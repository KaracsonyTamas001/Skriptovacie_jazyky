<?php
function displayFoodsByCategory($category)
{
    // Hozzáférés az adatbázishoz és lekérdezés az ételek kategóriája szerint
    include('config.php');

    // Adatbázis kapcsolat létrehozása
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Ellenőrizze a kapcsolatot
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM foods WHERE category = '$category'";
    $result = $conn->query($sql);

    // Az ételek megjelenítése
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Az ételek megjelenítése az adott kategóriában
            echo '<div class="tm-gallery-item">';
            echo '<img src="' . $row['image'] . '" alt="' . $row['name'] . '" class="tm-gallery-img" />';
            echo '<p class="tm-gallery-title">' . $row['name'] . '</p>';
            echo '<p class="tm-gallery-description">' . $row['description'] . '</p>';
            echo '<p class="tm-gallery-price">' . $row['price'] . '</p>';
            echo '</div>';
        }
    } else {
        echo '<p>No foods in this category.</p>';
    }

    // Adatbázis kapcsolat bezárása
    $conn->close();
}
?>
