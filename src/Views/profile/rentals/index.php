<head>
  <link rel="stylesheet" href="/location/src/styles.css">
  <script type="module" src="/location/src/script.js" defer></script>
  <title>Mes locations</title>
</head>

<div class="page">
  <h1>Page user rentals</h1>
  <?php
  if (isset($message) && !empty($message)) {
    echo "<p> $message </p>";
  }
  if (count($rentals) == 0) {
    echo "<h2> Vous n'avez pas encore loué de véhicule</h2>";
    echo "<a href='/location/public/vehicules/index.php'>Voir les véhicules</a>";
  } else {
    foreach ($rentals as $rental) {
      echo "<div class='car-card'>";
      echo " <img class='car-card-image' src='/location/public/images/$rental[image_name]' alt='image of the $rental[model] car'/>";
      foreach ($rental as $key => $value) {
        # code...
        echo "<p> $key : $value </p>";
      }

      $rental_id = $rental['reservation_id'];
      echo "<div class='car-card-button-container'>";
      echo "<a class='button bg-accent' href='/location/public/profile/rentals/update/$rental_id'>Update reservation</a>";
      echo "<a class='button bg-salt' href='/location/public/profile/rentals/delete/$rental_id'>Delete reservation</a>";
      echo '</div>';
      echo "</div>";
    }
  }

  ?>
</div>

</html>