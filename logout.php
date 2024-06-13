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
            <h2>ODJAVA</h2>
            <form method="POST">
                <div class="form-group">
                    <input type="submit" value="Odjavite se" class="delete-button" id="logout" name="logout">

                    <?php

                    if (isset($_POST['logout'])) {
                        logout();
                    }

                    function logout()
                    {
                        $_SESSION = array();
                        session_destroy();
                        echo "<p style='color:green; font-size:15px'>Odjavljeni ste. Preusmjeravam za 3 sekunde.;</p>";
                        // nakon 3 sekunde vraća se na index.php
                        header("refresh:3;url=index.php");
                    }

                    ?>

                </div>
            </form>
        </div>
    </div>

    <?php include 'footer.php'; ?>

</body>

</html>