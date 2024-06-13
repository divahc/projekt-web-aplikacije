<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Le Parisien</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="provjera_registracija.js" type="text/javascript" defer></script>
</head>

<body>

    <?php include 'header.php'; ?>

    <div class="container-center">
        <div class="verification-container">
            <h2>REGISTRACIJA</h2>
            <form method="POST">
                <div class="form-group">
                    <label for="username">Korisničko ime:</label>
                    <input type="text" id="username" name="username" autocomplete="off" required>
                    <span id="errorUsername"></span>
                </div>
                <div class="form-group">
                    <label for="password">Šifra:</label>
                    <input type="password" id="password" name="password" required>
                    <span id="errorPassword"></span>
                </div>
                <div class="form-group">
                    <label for="passwordCheck">Ponovite šifru:</label>
                    <input type="password" id="passwordCheck" name="passwordCheck" required>
                    <span id="errorPasswordCheck"></span>
                </div>
                <div class="form-group">
                    <input type="submit"  name="submit" id="submit" class="update-button name=" value="Registracija">
                </div>
                <div class="form-group">
                    <a href="login.php">Prijava</a>
                </div>

                <?php
                include 'connect.php';

                if ($dbc) {
                    if (isset($_POST["submit"])) {

                        $username = $_POST["username"];
                        $password = $_POST["password"];
                        $hashedPassword = password_hash($password, CRYPT_BLOWFISH);
                        // level 1 = administrator, level 0 = korisnik
                        $level = 0;
                        $query = "SELECT username FROM users WHERE username = ?;";

                        $stmt = mysqli_stmt_init($dbc);

                        if (mysqli_stmt_prepare($stmt, $query)) {
                            mysqli_stmt_bind_param($stmt, 's', $username);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_store_result($stmt);
                        }

                        mysqli_stmt_fetch($stmt);

                        if (mysqli_stmt_num_rows($stmt) > 0) {

                            echo "<p style='color:red'>Korisničko ime već postoji.</p>";

                        } else {

                            $query = "INSERT INTO users (username, password, level) values (?, ?, ?)";
                            $stmt = mysqli_stmt_init($dbc);

                            if (mysqli_stmt_prepare($stmt, $query)) {
                                mysqli_stmt_bind_param($stmt, 'ssi', $username, $hashedPassword, $level);
                                mysqli_stmt_execute($stmt);

                                echo "<p style='color:green'>Registracija uspješna.</p>";

                            } else {
                                echo "<p style='color:red'>Greška.</p>";
                            }
                        }
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