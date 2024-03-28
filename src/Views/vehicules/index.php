<title>Véhicules</title>
<div class="page">
  <h1>Notre sélection</h1>
  <p>Voici tous les véhicules que vous pouvez louer. N'attendez plus!</p>
  <div class="cards-container">
    <?php
    if (isset($data) && !empty($data)) {
      $vehicules = $data;

      foreach ($vehicules as $vehicule) {
        # code...
        echo "<div class='car-card'>";
        echo
        "
      <img class='car-card-image' src='./../images/$vehicule->image_name' alt='image of the $vehicule->model car'/>
      <div>
      <p>Constructeur: $vehicule->brand</p>
      <p>Modèle: $vehicule->model</p>
      <p>Puissance (cv): $vehicule->horsepower ch</p>
      <p>Immatriculation: $vehicule->plate</p>
      ";
        echo "<div class='categories'>";
        echo "<p> Catégorie(s): ";
        echo "<div class='categories-container'>";
        foreach ($vehicule->categories as $category) {
          echo "<p> $category </p>";
        }
        echo "</div>";
        echo "</div>";
        echo "<p>Prix / jour: $vehicule->daily_price €</p>";
        echo "</div>";
        echo "<a class='rent-link button bg-accent'  href='/location/public/vehicules/rent/$vehicule->id'>Réserver</a>";
        echo "</div>";
      }
    }
    ?>
  </div>
</div>