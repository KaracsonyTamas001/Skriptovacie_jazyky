<?php
// Elindítjuk a munkamenetet
session_start();

// Kiléptetjük a felhasználót
session_unset();
session_destroy();

// Átirányítjuk a felhasználót a bejelentkezési oldalra (index.php)
header("Location: index.php");
exit();
?>
