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
        <div class="verification-container">
            <h2>PRIJAVA</h2>
            <form method="POST">
                <div class="form-group">
                    <label for="username">Korisničko ime:</label>
                    <input type="text" id="username" name="username" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="password">Šifra:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <input type="submit" class="update-button" name="submit" value="Prijava">
                </div>
                <div class="form-group">
                    <a href="registracija.php">Registracija</a>
                </div>

                <?php
                include 'connect.php';

                if (isset($_SESSION['username']) && isset($_SESSION['level'])) {
                    $username = $_SESSION['username'];
                    $level = $_SESSION['level'];

                    if ($level == 1) {
                        header("Location:administrator.php");
                    }
                }

                if ($dbc) {
                    if (isset($_POST["submit"])) {

                        $username = $_POST["username"];
                        $password = $_POST["password"];

                        $query = "SELECT username, password, level FROM users WHERE username = ?;";

                        $stmt = mysqli_stmt_init($dbc);

                        if (mysqli_stmt_prepare($stmt, $query)) {
                            mysqli_stmt_bind_param($stmt, 's', $username);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_store_result($stmt);
                        }

                        mysqli_stmt_bind_result($stmt, $usernameCheck, $hashedPassword, $level);

                        mysqli_stmt_fetch($stmt);

                        if (mysqli_stmt_num_rows($stmt) > 0) {

                            if (password_verify($password, $hashedPassword)) {
                                echo "Prijava uspješna!";

                                $_SESSION['username'] = $username;
                                $_SESSION['level'] = $level;

                                if ($level == 1) {
                                    mysqli_close($dbc);
                                    header("Location: administrator.php");
                                    exit();
                                } else {
                                    mysqli_close($dbc);
                                    header("Location: index.php");
                                    exit();
                                }
                            } else {
                                echo "<p style='color:red'>Krivo korisničko ime ili šifra.</p>";
                            }
                        } else {
                            echo "<p style='color:red'>Korisničko ime ne postoji.</p>";
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