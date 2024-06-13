<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Le Parisien</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="provjera_unos.js" type="text/javascript" defer></script>
</head>

<body>

    <?php include 'header.php'; ?>

    <div class="container-center">

        <div class="admin-container">

            <h2>Stvori novi članak:</h2>

            <form enctype="multipart/form-data" method="POST">

                <div class="form-group">
                    <label for="title">Naslov:</label>
                    <input type="text" name="title" id="title">
                    <span id="errorTitle"></span>
                </div>

                <div class="form-group">
                    <label for="summary">Kratak sadržaj:</label>
                    <textarea name="summary" id="summary"></textarea>
                    <span id="errorSummary"></span>
                </div>

                <div class="form-group">
                    <label for="text">Tekst:</label>
                    <textarea name="text" id="text"></textarea>
                    <span id="errorText"></span>
                </div>

                <div class="form-group">
                    <label for="category">Kategorija:</label>
                    <select name="category" id="category">
                        <option value="">Odaberite kategoriju:</option>
                        <option value="Parisien">PARISIEN</option>
                        <option value="Vivre">VIVRE MIEUX</option>
                    </select>
                    <span id="errorCategory"></span>
                </div>

                <div class="form-group">
                    <label for="image">Slika:</label>
                    <input type="file" name="picture" id="picture">
                    <span id="errorPicture"></span>
                </div>

                <div class="form-group">
                    <label for="date">Datum:</label>
                    <input type="date" name="date" id="date">
                    <span id="errorDate"></span>
                </div>

                <div class="form-group">
                    <label for="checkbox">Arhiviraj?</label>
                    <input type="checkbox" name="checkbox" id="checkbox">
                </div>

                <div class="form-group">
                    <input type="submit" class="create-button" name="submit" id="submit" value="Stvori članak">
                </div>

                <div class="form-group">
                    <a href="administrator.php">PROMIJENI/IZBRIŠI ČLANAK</a>
                </div>

                <?php

                include 'connect.php';
                define('UPLPATH', 'images/');

                if (isset($_POST['submit'])) {

                    $title = $_POST['title'];
                    $summary = $_POST['summary'];
                    $text = $_POST['text'];
                    $category = $_POST['category'];
                    $date = $_POST['date'];

                    // ako je stavljena kvačica onda 1, inace 0
                    // 1 = arhivirano, 0 = nije arhivirano
                    $archive = isset($_POST['checkbox']) ? 1 : 0;

                    if (isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
                        $picture = $_FILES['picture']['name'];
                        $target_dir = 'images/' . $picture;
                        move_uploaded_file($_FILES["picture"]["tmp_name"], $target_dir);
                    } else {
                        $picture = '';
                    }

                    $query = "INSERT INTO article (title, summary, text, category, picture, date, archive) VALUES (?, ?, ?, ?, ?, ?, ?);";

                    $stmt = mysqli_stmt_init($dbc);

                    if (mysqli_stmt_prepare($stmt, $query)) {

                        mysqli_stmt_bind_param($stmt, 'ssssssi', $title, $summary, $text, $category, $picture, $date, $archive);

                        mysqli_stmt_execute($stmt);

                        echo "<p style='color:green'>Članak uspješno dodan.</p>";
                    }
                }

                mysqli_close($dbc);
                ?>

            </form>
        </div>

    </div>

    <?php include 'footer.php'; ?>

</body>

</html>