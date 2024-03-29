<title>Louer ce véhicule</title>
<div class="page">
  <h1>Réservation</h1>
  <p>Remplissez le formulaire suivant pour louer ce véhicule</p>
  <?php
  echo "<div class='car-card'>";
  echo
  "
    <img class='car-card-image' src='/location/public/images/$vehicule[image_name]' alt='image of the $vehicule[model] car'/>
    <p>Brand: $vehicule[brand]</p>
    <p>Model: $vehicule[model]</p>
    <p>Horsepower: $vehicule[horsepower] ch</p>
    <p>Price: $vehicule[daily_price] €/day</p>
  ";
  echo "</div>";
  ?>
  <form action="/location/public/rent" method="post">

    <div class="form-field">
      <label for="start_date">Date de début</label>
      <input required type="date" name="start_date" id="start_date" value="<?php echo date("Y-m-d") ?>" min="<?php echo date("Y-m-d") ?>">
    </div>
    <div class="form-field">
      <label for="end_date">Date de fin</label>
      <input required type="date" name="end_date" id="end_date" value="<?php echo date("Y-m-d") ?>" min="<?php echo date("Y-m-d") ?>" max="<?php
                                                                                                                                            $date = date("Y-m-d");
                                                                                                                                            $date = strtotime($date);
                                                                                                                                            // Limite de la location à 14 jours. Pas de dates dans le passé.
                                                                                                                                            $date = strtotime("+14 day", $date);

                                                                                                                                            echo date('Y-m-d', $date);
                                                                                                                                            ?>">
    </div>
    <input required readonly hidden aria-hidden="true" name="email" value="<?php echo $user_email ?>" type="email">
    <input required readonly hidden aria-hidden="true" name="vehicule_id" type="text" value="<?php echo $vehicule['id'] ?>">
    <input class="button bg-accent" type="submit" value="Valider la location">
  </form>
</div>

</html>