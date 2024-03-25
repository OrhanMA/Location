<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Page index vehicules</title>
</head>

<body>
  <h1>Page index vehicules!!!</h1>
  <?php

  if (isset($data) && !empty($data)) {
    $vehicules = $data;

    foreach ($vehicules as $vehicule) {
      # code...
      print_r($vehicule);
      echo "<div>";
      echo
      "
        <p>brand: $vehicule->brand</p>
        <p>model: $vehicule->model</p>
        <p>horsepower: $vehicule->horsepower ch</p>
        <p>daily price: $vehicule->daily_price €</p>
        <p>plate: $vehicule->plate</p>
        ";
      echo "<div>";
      foreach ($vehicule->categories as $category) {
        echo "<p> $category </p>";
      }
      echo "</div>";
      echo "<a href='/location/public/vehicules/rent/$vehicule->id'>Réserver</a>";
      echo "</div>";
    }
  }
  ?>
</body>

</html>