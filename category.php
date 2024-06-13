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

        $selectedCategory = $_GET['category'];

        echo "<h2>" . strtoupper($selectedCategory) . "</h2>";

        echo "<section>";

        $query = "SELECT id, title, picture FROM article WHERE category = ? LIMIT 30;";

        $stmt = mysqli_stmt_init($dbc);

        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, 's', $selectedCategory);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
        }

        mysqli_stmt_bind_result($stmt, $id, $title, $picture);

        $articleCount = 0;

        if (mysqli_stmt_num_rows($stmt) > 0) {

            while (mysqli_stmt_fetch($stmt)) {

                if ($articleCount % 3 === 0 && $articleCount !== 0) {
                    echo "</section><section>";
                }

                echo "<article>";
                echo "<p>" . $id . "</p>";
                echo "<div class=\"img-container\">";
                echo '<img src="' . UPLPATH . $picture . '">';
                echo "</div>";
                echo "<h3><a href='article.php?id=" . $id . "'>" . $title . "</a></h3>";
                echo "</article>";

                $articleCount++;
            }

            echo "</section>";
        } else {
            echo "<p style='color:red'>Nema pronađenih članaka.</p>";
        }

        mysqli_close($dbc);
        ?>

        </section>

    </div>

    <?php include 'footer.php'; ?>

</body>

</html>