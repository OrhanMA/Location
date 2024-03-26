<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update reservation</title>
</head>

<body>
  <h1>Update reservation </h1>
  <?php
  $start_date = $rental['start_date'];
  $end_date = $rental['end_date'];
  ?>
  <div>
    <h2>
      Véhicule concerné:
    </h2>
    <p>Modèle: <?php echo $rental['model']  ?></p>
    <p>Brand: <?php echo $rental['brand']  ?></p>
    <p>Horsepower: <?php echo $rental['horsepower']  ?> ch</p>
  </div>
  <div>
    <p>Pour des raisons de sécurité, il ne vous est pas possible de modifer:</p>
    <ul>
      <li>Le véhicule concerné</li>
      <li>Le prix journalier</li>
      <li>La date de début de location</li>
    </ul>
    <p>Pour cela, rapprochez-vous d'un conseiller ou annuler votre réservation pour en créer une nouvelle.</p>
  </div>
  <form action="/location/public/rental/update" method="post">
    <input readonly value="<?php echo $rental['reservation_id']; ?>" type="text" name="reservation_id" id="reservation_id">
    <div>
      <label>Choisissez une nouvelle date pour rallonger votre location:</label>
      <input type="date" name="end_date" id="end_date" min="<?php echo $start_date ?>" value="<?php echo $end_date ?>">
    </div>
    <input type="submit" value="Confirmer le changement">
  </form>
</body>

</html>