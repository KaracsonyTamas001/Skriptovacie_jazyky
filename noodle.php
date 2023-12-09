<!-- noodle.php -->

<?php
// Include a kapcsolódási fájlt, ha szükséges
include_once("db_connect.php");

// Lekérdezés a tésztákról
$sql = "SELECT * FROM foods WHERE type = 'Noodle'";
$result = $conn->query($sql);

// Ellenőrizd, hogy van-e eredmény
if ($result->num_rows > 0) {
    // Táblázat fejléc
    echo "<table border='1'>";
    echo "<tr><th>Név</th><th>Ár</th><th>Leírás</th><th>Kép</th></tr>";

    // Adatok megjelenítése
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['price'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td><img src='" . $row['image_link'] . "' alt='Étel képe' width='100'></td>";
        echo "</tr>";
    }

    // Táblázat lezárása
    echo "</table>";
} else {
    // Ha nincs eredmény, jelezd a felhasználónak
    echo "Nincs elérhető tészta.";
}

// Adatbázis kapcsolat lezárása
$conn->close();
?>
