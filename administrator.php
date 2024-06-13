<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Le Parisien</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

    <?php include 'header.php'; ?>

    <div class="container-center">
        <div class="admin-container">
            <form action="script.php" enctype="multipart/form-data" method="POST">
                <h2>Promijeni/Izbriši članak:</h2>

                <div class="form-group">
                    <label for="id">Article ID:</label>
                    <input type="number" name="id" id="id" required>
                </div>

                <div class="form-group">
                    <label for="title">Naslov:</label>
                    <input type="text" name="title" id="title">
                </div>

                <div class="form-group">
                    <label for="summary">Kratki sadržaj:</label>
                    <textarea name="summary" id="summary"></textarea>
                </div>

                <div class="form-group">
                    <label for="text">Tekst:</label>
                    <textarea name="text" id="text"></textarea>
                </div>

                <div class="form-group">
                    <label for="picture">Slika:</label>
                    <input type="file" name="picture" id="picture">
                </div>

                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date">
                </div>

                <div class="form-group">
                    <label for="checkbox">Archiviraj?</label>
                    <input type="checkbox" name="checkbox" id="checkbox">
                </div>

                <div class="form-group">
                    <input type="submit" name="update" class="update-button" value="Promijeni">
                    <input type="submit" name="delete" class="delete-button" value="Izbriši">
                </div>
                <div class="form-group">
                    <a href="unos.php">DODAJ NOVI ČLANAK</a>
                </div>

            </form>
        </div>
    </div>

    <?php include 'footer.php'; ?>

</body>

</html>