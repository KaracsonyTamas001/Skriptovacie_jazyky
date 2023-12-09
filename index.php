<?php
include_once("config.php");
session_start();

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve all foods from the database
$sql = "SELECT * FROM foods";
$result = $conn->query($sql);

// Group foods by categories
$foodsByCategory = array();
while ($row = $result->fetch_assoc()) {
    // Convert category names to lowercase and replace spaces with underscores
    $categoryName = strtolower(str_replace(' ', '_', $row["type"]));
    $foodsByCategory[$categoryName][] = $row;
}

// Close the original query
$result->close();

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Simple House - About Page</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <div class="placeholder">
            <div class="parallax-window" data-parallax="scroll">
                <div class="tm-header">
                    <div class="row tm-header-inner">
                        <div class="col-md-6 col-12">
                            <img src="img/simple-house-logo.png" alt="Logo" class="tm-site-logo" />
                            <div class="tm-site-text-box">
                                <h1 class="tm-site-title">Simple House</h1>
                                <h6 class="tm-site-description">new restaurant template</h6>
                            </div>
                        </div>
                        <nav class="col-md-6 col-12 tm-nav">
                            <ul class="tm-nav-ul">
                                <li class="tm-nav-li"><a href="index.php" class="tm-nav-link active">Home</a></li>
                                <li class="tm-nav-li"><a href="about.php" class="tm-nav-link">About</a></li>
                                <?php
                                if (isset($_SESSION["username"])) {
                                    echo '<li class="tm-nav-li"><a href="logout.php" class="tm-nav-link">Log out</a></li>';
                                    echo '<li class="tm-nav-li"><a href="addeditfood.php" class="tm-nav-link">Add/Edit food</a></li>';
                                } else {
                                    echo '<li class="tm-nav-li"><a href="login.php" class="tm-nav-link">Log in</a></li>';
                                }
                                ?>
                                <li class="tm-nav-li"><a href="registration.php" class="tm-nav-link">Registration</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <?php
        if (isset($_SESSION['username'])) {
            echo '<div class="tm-loggedin-section">
                <p>Welcome, ' . $_SESSION['username'] . '!</p>
              </div>';
        }
        ?>

        <main>

            <div class="tm-paging-links">
                <nav>
                    <ul>
                        <li class="tm-paging-item"><a href="#" class="tm-paging-link" onclick="showFoods('all')">All</a></li>
                        <?php
                        foreach ($foodsByCategory as $category => $foods) {
                            echo '<li class="tm-paging-item"><a href="#" class="tm-paging-link" onclick="showFoods(\'' . $category . '\')">' . ucfirst(str_replace('_', ' ', $category)) . '</a></li>';
                        }
                        ?>
                    </ul>
                </nav>
            </div>

            <?php
            foreach ($foodsByCategory as $category => $foods) {
                echo '<div class="tm-gallery-page hidden" id="tm-gallery-page-' . $category . '">';
                foreach ($foods as $food) {
                    echo '<article class="tm-gallery-item">';
                    echo '<figure>';
                    echo '<img src="' . $food["image_link"] . '" alt="' . $food["name"] . '" class="img-fluid tm-gallery-img" />';
                    echo '<figcaption>';
                    echo '<h4 class="tm-gallery-title">' . $food["name"] . '</h4>';
                    echo '<p class="tm-gallery-description">' . $food["description"] . '</p>';
                    echo '<p class="tm-gallery-price">$' . $food["price"] . '</p>';
                    echo '</figcaption>';
                    echo '</figure>';
                    echo '</article>';
                }
                echo '</div>';
            }
            ?>

            <footer class="tm-footer text-center">
                <p>Copyright &copy; 2020 Simple House | Design: <a rel="nofollow" href="https://templatemo.com">TemplateMo</a></p>
            </footer>
        </main>
    </div>

   <script src="js/jquery.min.js"></script>
<script src="js/parallax.min.js"></script>
<script>
    function showFoods(category) {
        document.querySelectorAll('.tm-gallery-page').forEach(page => page.classList.add('hidden'));

        if (category === 'all') {
            document.querySelectorAll('.tm-gallery-page').forEach(page => page.classList.remove('hidden'));
        } else {
            document.getElementById('tm-gallery-page-' + category).classList.remove('hidden');
        }
    }
</script>

</body>

</html>
