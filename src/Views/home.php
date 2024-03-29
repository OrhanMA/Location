<title>Home page</title>
<div class='home page'>
  <?php
  if (isset($message) && !empty($message)) {
    echo "<p>$message</p>";
  }
  ?>
  <div class="presentation">
    <?php if (isset($user) && !empty($user)) {
      $first_name = $user['first_name'];
      $last_name = $user['last_name'];
      echo "<h1>Bon retour parmi nous, $first_name $last_name</h1>";
      echo "<p>Gérez vos locations, votre compte et empruntez d'autres véhicules de rêves...</p>";
    } else {
      echo "<h1>Le véhicule de vos rêves à portée de main</h1>";
      echo " <p>Que ce soit pour une heure ou une semaine, repartez avec le véhicule de votre choix parmi notre sélection et revenez les yeux remplis d’étoiles.
                       </p>";
    } ?>
    <div class="links-container">
      <?php
      if (isset($_SESSION) && !empty($_SESSION) && isset($_SESSION['authenticated_user']) && !empty($_SESSION['authenticated_user'])) {
        echo "<a class='button bg-accent' href='/location/public/vehicules/index.php'>Véhicules</a>";
        echo "<a class='button bg-night' href='/location/public/profile/rentals/index.php'>Mes locations</a>";
      } else {
        echo "<a class='button bg-accent' href='/location/public/register/index.php'>Inscription</a>";
        echo "<a class='button bg-night' href='/location/public/login/index.php'>Connexion</a>";
      }
      ?>

    </div>
  </div>
  <div class="image-container">
    <img class='tokyo' src="./images/tokyo.jpg" alt="Street car meeting">
  </div>
</div>