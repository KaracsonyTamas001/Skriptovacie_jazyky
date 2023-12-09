<?php
include_once("config.php");

session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["delete"])) {
        $delete_id = $_POST["delete_id"];
        $sql = "DELETE FROM foods WHERE id = $delete_id";

        if ($conn->query($sql) === TRUE) {
            echo "Food deleted successfully";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } elseif (isset($_POST["edit"])) {
        $edit_id = $_POST["edit_id"];
        $new_name = $_POST["new_name"];
        $new_price = $_POST["new_price"];
        $new_description = $_POST["new_description"];
        $new_type = $_POST["new_type"];
        $new_image_link = $_POST["new_image_link"];

        $sql = "UPDATE foods SET name='$new_name', price='$new_price', description='$new_description', type='$new_type', image_link='$new_image_link' WHERE id=$edit_id";

        if ($conn->query($sql) === TRUE) {
            echo "Food updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } elseif (isset($_POST["add"])) {
        $name = $_POST["name"];
        $price = $_POST["price"];
        $description = $_POST["description"];
        $type = $_POST["type"];
        $image_link = $_POST["image_link"];

        $sql = "INSERT INTO foods (name, price, description, type, image_link) VALUES ('$name', '$price', '$description', '$type', '$image_link')";

        if ($conn->query($sql) === TRUE) {
            echo "Food saved successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$sql = "SELECT * FROM foods";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add/Edit Food</title>
    <!-- Add your stylesheets and other head elements here -->
</head>

<body>
    <!-- Your HTML content goes here -->
    <h2>Add New Food</h2>
    <!-- Vissza gomb -->
    <a href="index.php">Back to Home</a><br>

    <!-- Your form goes here -->
    <form method="post" action="addeditfood.php">
        <!-- Add your form fields here (name, price, description, type, image_link) -->
        <input type="text" name="name" placeholder="Name" required><br>
        <input type="number" name="price" placeholder="Price" required><br>
        <textarea name="description" placeholder="Description" required></textarea><br>
        <select name="type" required>
            <option value="Pizza">Pizza</option>
            <option value="Salad">Salad</option>
            <option value="Noodle">Noodle</option>
            <!-- Add more options if needed -->
        </select><br>
        <input type="text" name="image_link" placeholder="Image Link" required><br>
        <button type="submit" name="add">Add Food</button>
    </form>

    <?php
    if ($result && $result->num_rows > 0) {
        echo '<table border="1">';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Name</th>';
        echo '<th>Price</th>';
        echo '<th>Description</th>';
        echo '<th>Type</th>';
        echo '<th>Image Link</th>';
        echo '<th>Action</th>';
        echo '</tr>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row["id"] . '</td>';
            echo '<td>' . $row["name"] . '</td>';
            echo '<td>' . $row["price"] . '</td>';
            echo '<td>' . $row["description"] . '</td>';
            echo '<td>' . $row["type"] . '</td>';
            echo '<td>' . $row["image_link"] . '</td>';
            echo '<td>';
            echo '<button onclick="showEditForm(' . $row["id"] . ', \'' . $row["name"] . '\', \'' . $row["price"] . '\', \'' . $row["description"] . '\', \'' . $row["type"] . '\', \'' . $row["image_link"] . '\')">Edit</button>';
            echo '<form method="post" action="">';
            echo '<input type="hidden" name="delete_id" value="' . $row["id"] . '" />';
            echo '<button type="submit" name="delete">Delete</button>';
            echo '</form>';
            echo '</td>';
            echo '</tr>';
        }

        echo '</table>';

        // Szerkesztés űrlap
        echo '<div id="editForm" style="display:none">';
        echo '<form method="post" action="">';
        echo '<h2>Edit food</h2>';
        echo '<input type="hidden" id="edit_id" name="edit_id" value="" />';
        echo '<label for="new_name">Name:</label>';
        echo '<input type="text" id="new_name" name="new_name" required /><br>';
        echo '<label for="new_price">Price:</label>';
        echo '<input type="text" id="new_price" name="new_price" required /><br>';
        echo '<label for="new_description">Description:</label>';
        echo '<input type="text" id="new_description" name="new_description" required /><br>';
        echo '<label for="new_type">Type:</label>';
        echo '<input type="text" id="new_type" name="new_type" required /><br>';
        echo '<label for="new_image_link">Image Link:</label>';
        echo '<input type="text" id="new_image_link" name="new_image_link" required /><br>';
        echo '<button type="submit" name="edit">Save</button>';
        echo '</form>';
        echo '</div>';
    }
    ?>

    <script>
        function showEditForm(id, name, price, description, type, imageLink) {
            document.getElementById('edit_id').value = id;
            document.getElementById('new_name').value = name;
            document.getElementById('new_price').value = price;
            document.getElementById('new_description').value = description;
            document.getElementById('new_type').value = type;
            document.getElementById('new_image_link').value = imageLink;
            document.getElementById('editForm').style.display = 'block';
        }
    </script>

</body>

</html>
