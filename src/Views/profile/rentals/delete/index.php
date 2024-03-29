<title>Supprimer ma location</title>
<div class="page">
  <h1>Supprimer ma location</h1>
  <div>
    <h2>
      Véhicule concerné:
    </h2>
    <div class="car-card">
      <img src="/location/public/images/<?php echo $rental['image_name'] ?>" alt="image of the <?php echo $rental['model'] ?> car">
      <p>Modèle: <?php echo $rental['model']  ?></p>
      <p>Brand: <?php echo $rental['brand']  ?></p>
      <p>Horsepower: <?php echo $rental['horsepower']  ?> ch</p>
    </div>
  </div>
  <p>Êtes-vous sûr de vouloir supprimer votre réservation? Cette action est irréversible.</p>
  <form action="/location/public/rental/delete" method="post">
    <input hidden readonly value="<?php echo $rental['reservation_id']; ?>" type="text" name="reservation_id" id="reservation_id">
    <input class="button bg-accent" type="submit" value="Oui je suis sûr">
  </form>
</div>

</html>