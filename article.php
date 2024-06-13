<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <title>Le Parisien</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

    <?php include 'header.php'; ?>

    <div class="container">

        <?php
        include 'connect.php';
        define('UPLPATH', 'images/');

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            echo "<p style='color:red;'>Greška.";
        }

        $query = "SELECT title, summary, text, picture, date FROM article WHERE id = ?;";

        $stmt = mysqli_stmt_init($dbc);

        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, 'i', $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
        }

        mysqli_stmt_bind_result($stmt, $title, $summary, $text, $picture, $date);
        mysqli_stmt_fetch($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {

            echo "<section>";
            echo "<article>";
            echo "<h2>" . $title . "</h2>";
            echo "<p>Date: " . $date . "</p>";
            echo "<div class='article-img-container'>";
            echo "<img src='" . UPLPATH . $picture . "' alt='" . $title . "'>";
            echo "</div>";
            echo "<p>" . $summary . "</p>";
            echo "<p>" . $text . "</p>";
        } else {
            echo "<p style='color:red;'>Članak nije pronađen.";
        }
        echo "</article>";
        echo "</section>";

        mysqli_close($dbc);

        ?>

    </div>

    <?php include 'footer.php'; ?>

</body>

</html>