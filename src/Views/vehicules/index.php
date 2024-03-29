<?php
$vehicules = isset($data) && !empty($data) ? $data : [];

function render_categories($categories)
{
  // Pour l'operator .=
  // https://www.php.net/manual/fr/language.operators.php#:~:text=.%3D%20concatenating%20assignment%20operator
  $output = "<div class='categories'>";
  $output .= "<p> Catégorie(s): ";
  $output .= "<div class='categories-container'>";
  foreach ($categories as $category) {
    $output .= "<p> $category </p>";
  }
  $output .= "</div>";
  $output .= "</div>";
  return $output;
}
?>

<title>Véhicules</title>
<div class="page">
  <h1>Notre sélection</h1>
  <p>Voici tous les véhicules que vous pouvez louer. N'attendez plus!</p>
  <div class="cards-container">
    <?php foreach ($vehicules as $vehicule) : ?>
      <div class='car-card'>
        <img class='car-card-image' src='/location/public/images/<?php echo $vehicule->image_name ?>' alt='image of the <?php echo $vehicule->model ?> car' />
        <div>
          <p>Constructeur: <?php echo $vehicule->brand ?></p>
          <p>Modèle: <?php echo $vehicule->model ?></p>
          <p>Puissance (cv): <?php echo $vehicule->horsepower ?> ch</p>
          <p>Immatriculation: <?php echo $vehicule->plate ?></p>
          <?php echo render_categories($vehicule->categories); ?>
          <p>Prix / jour: <?php echo $vehicule->daily_price ?> €</p>
        </div>
        <a class='rent-link button bg-accent' href='/location/public/vehicules/rent/<?php echo $vehicule->id ?>'>Réserver</a>
      </div>
    <?php endforeach; ?>
  </div>
</div>