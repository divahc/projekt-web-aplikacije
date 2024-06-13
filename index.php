<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Le Parisien</title>
  <link rel="stylesheet"  type="text/css" href="style.css">
</head>

<body>

  <?php include 'header.php'; ?>

  <div class="container">

   <h2 class="title">Parisien</h2>

    <section>
      <?php
      include 'connect.php';
      define('UPLPATH', 'images/');

      $category = "Parisien";
      $archive = 0;

      $query = "SELECT id, title, summary, picture, date, category FROM article WHERE category = ? AND archive = ? LIMIT 3;";
      $stmt = mysqli_stmt_init($dbc);

      if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'si', $category, $archive);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
      }

      mysqli_stmt_bind_result($stmt, $id, $title, $summary, $picture, $date, $category);

      if (mysqli_stmt_num_rows($stmt) > 0) {

        while (mysqli_stmt_fetch($stmt)) {
          echo "<article>";
          echo "<p>" . $id . "</p>";
          echo "<div class=\"img-container\">";
          echo '<img src="' . UPLPATH . $picture . '">';
          echo "</div>";
          echo "<h3><a href='article.php?id=" . $id . "'>" . $title . "</a></h3>";
          echo "</article>";
        }

      } else {
        echo "<p style='color:red'>Nema pronađenih članaka.</p>";
      }

      mysqli_close($dbc);
      ?>

    </section>

    <h2 class="title">Vivre Mieux</h2>

    <section>

      <?php
      include 'connect.php';

      $category = "Vivre";
      $archive = 0;

      $query = "SELECT id, title, summary, picture, date, category FROM article WHERE category = ? AND archive = ? LIMIT 3;";
      $stmt = mysqli_stmt_init($dbc);

      if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'si', $category, $archive);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
      }

      mysqli_stmt_bind_result($stmt, $id, $title, $summary, $image, $date, $category);

      if (mysqli_stmt_num_rows($stmt) > 0) {
        while (mysqli_stmt_fetch($stmt)) {
          echo "<article>";
          echo "<p>" . $id . "</p>";
          echo "<div class=\"img-container\">";
          echo '<img src="' . UPLPATH . $image . '">';
          echo "</div>";
          echo "<h3><a href='article.php?id=" . $id . "'>" . $title . "</a></h3>";
          echo "</article>";
        }

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