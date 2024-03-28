<title>Home page</title>
<div class='home page'>
  <?php
  if (isset($message) && !empty($message)) {
    echo "<p>$message</p>";
  }
  ?>
  <div class="presentation">
    <h1 class="red">Le véhicule de vos rêves à portée de main</h1>
    <p>Que ce soit pour une heure ou une semaine, repartez avec le véhicule de votre choix parmi notre sélection et revenez les yeux remplis d’étoiles.
    </p>
    <div class="links-container">
      <a class="button bg-accent" href="/location/public/register/index.php">Inscription</a>
      <a class="button bg-night" href="/location/public/login/index.php">Connexion</a>
    </div>
  </div>
  <div class="image-container">
    <img class='tokyo' src="./images/tokyo.jpg" alt="Street car meeting">
  </div>
</div>