<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home page</title>
</head>
<?php

if (isset($message) && !empty($message)) {
  echo "<p>$message</p>";
}

?>

<body>
  <div>
    <div>
      <h1>Le véhicule de vos rêves à portée de main</h1>
      <h2>Que ce soit pour une heure ou une semaine, repartez avec le véhicule de votre choix parmi notre sélection et revenez les yeux remplis d’étoiles.
      </h2>
    </div>
    <div>
      <img src="../images/tokyo.jpg" alt="Street car meeting">
    </div>
  </div>
</body>

</html>