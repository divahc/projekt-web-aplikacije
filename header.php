<header>

  <?php
  session_start();

  if (isset($_SESSION['username']) && isset($_SESSION['level'])) {
    $username = $_SESSION['username'];
    $level = $_SESSION['level'];

    if ($level == 1) {
      echo "<p style='color:green'>Dobrodošli $username.</p>";
      echo "<p style='color:green'>Imate administratorske ovlasti.";
    }

    if ($level == 0) {
      echo "<p style='color:green'>Dobrodošli $username.</p>";
      echo "<p style='color:red'>Nemate administratorske ovlasti.";
    }

  }
  ?>

  <h1><img class="logo" src="images/logo.png" alt="logo"></h1>
  <hr>
  <nav class="navigation">
    <ul>
      <li><a href="index.php">HOME</a></li>
      <li><a href="category.php?category=parisien">PARISIEN</a></li>
      <li><a href="category.php?category=vivre">VIVRE</a></li>
      <li><a href="login.php">ADMINISTRACIJA</a></li>

      <?php

      if (isset($_SESSION['username']) && isset($_SESSION['level'])) {
        echo "<li><a href='logout.php'>ODJAVA</a></li>";
      }
      
      ?>

    </ul>
  </nav>
</header>