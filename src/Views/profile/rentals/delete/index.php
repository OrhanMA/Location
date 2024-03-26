<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Delete reservation</title>
</head>

<body>
  <h1>Delete reservation </h1>
  <div>
    <h2>
      Véhicule concerné:
    </h2>
    <p>Modèle: <?php echo $rental['model']  ?></p>
    <p>Brand: <?php echo $rental['brand']  ?></p>
    <p>Horsepower: <?php echo $rental['horsepower']  ?> ch</p>
  </div>
  <p>Êtes-vous sûr de vouloir supprimer votre réservation? Cette action est irréversible.</p>
  <form action="/location/public/rental/delete" method="post">
    <input hidden readonly value="<?php echo $rental['reservation_id']; ?>" type="text" name="reservation_id" id="reservation_id">
    <input type="submit" value="Oui je suis sûr">
  </form>
</body>

</html>