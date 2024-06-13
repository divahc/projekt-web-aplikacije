<?php
include 'connect.php';

if (isset($_POST['update'])) {

    $id = $_POST['id'];

    $querySearch = "SELECT title, summary, text, picture, date, archive FROM article WHERE id = ?;";

    $stmt = mysqli_stmt_init($dbc);

    if (mysqli_stmt_prepare($stmt, $querySearch)) {
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
    }

    mysqli_stmt_bind_result($stmt, $title, $summary, $text, $picture, $date, $archive);
    mysqli_stmt_fetch($stmt); 

    if (mysqli_stmt_num_rows($stmt) > 0) {

        // ako ništa nije uneseno, uzmi stare podatke, inače uzmi nove podatke
        $titleNew = (!empty($_POST['title'])) ? $_POST['title'] : $title;
        $summaryNew = (!empty($_POST['summary'])) ? $_POST['summary'] : $summary;
        $contentNew = (!empty($_POST['text'])) ? $_POST['text'] : $text;
        $dateNew = (!empty($_POST['date'])) ? $_POST['date'] : $date;
        $archiveNew = (!empty($_POST['checkbox'])) ? 1 : 0;

        if (isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
            $pictureNew = $_FILES['picture']['name'];
            $target_dir = 'images/' . $pictureNew;
            move_uploaded_file($_FILES["picture"]["tmp_name"], $target_dir);
        } else {
            $pictureNew = $picture;
        }


        $queryUpdate = "UPDATE article SET title = ?, summary = ?, text = ?, picture = ?, date = ?, archive = ? WHERE id = ?;";
        
        $stmt = mysqli_stmt_init($dbc);

        if (mysqli_stmt_prepare($stmt, $queryUpdate)) {
            mysqli_stmt_bind_param($stmt, 'sssssii', $titleNew, $summaryNew, $textNew, $pictureNew, $dateNew, $archiveNew, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            echo "<p style='color:green; text-align:center; font-size: 20px;'>Članak uspješno ažuriran.";
        } else {
            echo "<p style='color:red; text-align:center; font-size: 20px;'>Članak nije pronađen.";
        }
    }


} else if (isset($_POST['delete'])) {

    $id = $_POST['id'];

    $query = "DELETE FROM article WHERE id = ?;";

    $stmt = mysqli_stmt_init($dbc);

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        echo "<p style='color:green; text-align:center; font-size: 20px;'>Članak uspješno izbrisan.";
    }

    else {
        echo "Greška.";
    }
}

mysqli_close($dbc);

// nakon 3 sekunde vraća se na administrator.php
header("refresh:3;url=administrator.php");
exit();

?>