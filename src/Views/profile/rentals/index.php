<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/location/src/styles.css">
  <script type="module" src="/location/src/script.js" defer></script>
  <title>Mes locations</title>
</head>

<body>
  <div class="page">
    <h1>Page user rentals</h1>

    <?php if (isset($message) && !empty($message)) : ?>
      <p><?php echo $message; ?></p>
    <?php endif; ?>

    <?php if (count($rentals) == 0) : ?>
      <h2>Vous n'avez pas encore loué de véhicule</h2>
      <a href='/location/public/vehicules/index.php'>Voir les véhicules</a>
    <?php else : ?>
      <div class="cards-container">
        <?php foreach ($rentals as $rental) : ?>
          <div class='car-card'>
            <div class="car-image-container">
              <img class='car-card-image' src='/location/public/images/<?php echo $rental['image_name'] ?>' alt='image of the <?php echo $rental['model'] ?> car' />
            </div>
            <div>
              <p>Constructeur: <?php echo $rental['brand'] ?></p>
              <p>Modèle: <?php echo $rental['model'] ?></p>
              <p>Puissance (cv): <?php echo $rental['horsepower'] ?> ch</p>
            </div>
            <p>Prix / jour: <?php echo $rental['daily_price'] ?> €</p>
            <div>
              <p>Début de location: <?php echo $rental['start_date'] ?></p>
              <p>Fin de location: <?php echo $rental['end_date'] ?></p>
            </div>
            <div class='car-card-button-container'>
              <a class='button bg-accent' href='/location/public/profile/rentals/update/<?php echo $rental['reservation_id']; ?>'>Mettre à jour</a>
              <a class='button bg-salt' href='/location/public/profile/rentals/delete/<?php echo $rental['reservation_id']; ?>'>Supprimer</a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</body>

</html>