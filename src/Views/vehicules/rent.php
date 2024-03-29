<title>Louer ce véhicule</title>
<div class="page">
  <h1>Réservation</h1>
  <p>Remplissez le formulaire suivant pour louer ce véhicule</p>
  <div class="car-card">
    <div class="car-image-container">
      <img class='car-card-image' src='/location/public/images/<?php echo $vehicule['image_name'] ?>' alt='image of the <?php echo $vehicule['model'] ?> car' />
    </div>
    <p>Constructeur: <?php echo $vehicule['brand'] ?></p>
    <p>Modèle: <?php echo $vehicule['model'] ?></p>
    <p>Puissance (cv): <?php echo $vehicule['horsepower'] ?></p>
    <p>Prix / jour: <?php echo $vehicule['daily_price'] ?> €/day</p>
  </div>
  <form action="/location/public/rent" method="post">
    <div class="form-field">
      <label for="start_date">Date de début</label>
      <input required type="date" name="start_date" id="start_date" value="<?php echo date("Y-m-d") ?>" min="<?php echo date("Y-m-d") ?>">
    </div>
    <div class="form-field">
      <label for="end_date">Date de fin</label>
      <?php
      $today = date("Y-m-d");
      $min_end_date = date("Y-m-d", strtotime("+1 day"));
      $max_end_date = date("Y-m-d", strtotime("+14 day"));
      ?>
      <input required type="date" name="end_date" id="end_date" value="<?php echo $min_end_date ?>" min="<?php echo $min_end_date ?>" max="<?php echo $max_end_date ?>">
    </div>
    <input required readonly hidden aria-hidden="true" name="email" value="<?php echo $user_email ?>" type="email">
    <input required readonly hidden aria-hidden="true" name="vehicule_id" type="text" value="<?php echo $vehicule['id'] ?>">
    <input class="button bg-accent" type="submit" value="Valider la location">
  </form>
</div>

<script>
  document.getElementById('start_date').addEventListener('change', () => {
    // récupère la valeur actuelle du champ start_date et le transforme en date
    const startDate = new Date(this.value);

    // crée une date minimum de fin de location qui débute seulement à j+1 par rapport à start_date
    const minEndDate = new Date(startDate);
    minEndDate.setDate(startDate.getDate() + 1);

    // crée une date maximale de fin de location à j+14 par rapport au minimum de end_date (minEndDate)
    const maxEndDate = new Date(minEndDate);
    maxEndDate.setDate(minEndDate.getDate() + 14);

    // change les attributs correspondants
    document.getElementById('end_date').min = minEndDate.toISOString().slice(0, 10);
    document.getElementById('end_date').max = maxEndDate.toISOString().slice(0, 10);
  });
</script>