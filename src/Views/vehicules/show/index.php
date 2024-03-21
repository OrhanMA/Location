<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Page show vehicules</title>
</head>

<body>
  <h1>Page show vehicules!!!</h1>
  <?php

  $vehicule = $data;

  echo "<a href='/rent?vehicule=" . $vehicule['id'] . "'>Louer ce véhicule</a>";
  ?>
</body>


</html>