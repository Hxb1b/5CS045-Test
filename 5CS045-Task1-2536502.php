<?php
// Connect to the database (host, username, password, database name)
$mysqli = new mysqli("localhost", "2536502", "p7x8gc", "db2536502");

// Stop the page and show the error if the connection fails
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// Run SQL query to get all movies, oldest release first
$sql = "SELECT * FROM movies ORDER BY Date_of_released";
$results = mysqli_query($mysqli, $sql);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My movies</title>
  <!-- Bootstrap CSS for styling -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container">

    <h1 class="my-4">List of ALL my movies</h1>

    <!-- Table of movies from the database -->
    <table class="table table-striped">

      <!-- Table headings -->
      <tr>
        <th>Movie name</th>
        <th>Genre</th>
        <th>Price</th>
        <th>Date of release</th>
      </tr>

      <!-- Loop through each row returned by the query -->
      <?php while ($a_row = mysqli_fetch_assoc($results)): ?>
      <tr>
        <!-- Movie name and genre shown as stored -->
        <td><?= $a_row['Movie_name'] ?></td>
        <td><?= $a_row['Genre'] ?></td>

        <!-- Price with £ sign, always 2 decimal places -->
        <td>&pound;<?= number_format($a_row['Price'], 2) ?></td>

        <!-- Date converted from YYYY-MM-DD to DD/MM/YYYY -->
        <td><?= date("d/m/Y", strtotime($a_row['Date_of_released'])) ?></td>      </tr>
      <?php endwhile; ?>

    </table>

  </div>
</body>
</html>