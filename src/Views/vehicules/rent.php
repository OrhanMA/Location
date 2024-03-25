<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Page rent vehicule</title>
</head>

<body>
  <h1>Page rent vehicule!!!</h1>
  <?php

  if (isset($vehicule) && !empty($vehicule)) {
    print_r($vehicule);
  }

  ?>

  <p>Remplissez le formulaire suivant pour louer ce véhicule</p>

  <form action="/location/public/rent" method="post">
    <div>
      <label for="start_date">Date de début</label>
      <input required type="date" name="start_date" id="start_date">
    </div>
    <div>
      <label for="end_date">Date de fin</label>
      <input required type="date" name="end_date" id="end_date">
    </div>
    <input required readonly hidden aria-hidden="true" type="text" value="<?php echo $vehicule['id'] ?>">
    <input type="submit" value="Valider la location">
  </form>

</body>

</html>