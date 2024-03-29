<title>Home page</title>
<div class='home page'>
  <?php if (isset($message) && !empty($message)) : ?>
    <p class="accent"><?php echo $message; ?></p>
  <?php endif; ?>

  <div class="presentation">
    <?php if (isset($user) && !empty($user)) : ?>
      <?php
      $first_name = $user['first_name'];
      $last_name = $user['last_name'];
      ?>
      <h1>Bon retour parmi nous, <?php echo "$first_name $last_name"; ?></h1>
      <p>Gérez vos locations, votre compte et empruntez d'autres véhicules de rêves...</p>
    <?php else : ?>
      <h1>Le véhicule de vos rêves à portée de main</h1>
      <p>Que ce soit pour une heure ou une semaine, repartez avec le véhicule de votre choix parmi notre sélection et revenez les yeux remplis d’étoiles.</p>
    <?php endif; ?>

    <div class="links-container">
      <?php if (isset($_SESSION['authenticated_user']) && !empty($_SESSION['authenticated_user'])) : ?>
        <a class='button bg-accent' href='/location/public/vehicules/index.php'>Véhicules</a>
        <a class='button bg-night' href='/location/public/profile/rentals/index.php'>Mes locations</a>
      <?php else : ?>
        <a class='button bg-accent' href='/location/public/register/index.php'>Inscription</a>
        <a class='button bg-night' href='/location/public/login/index.php'>Connexion</a>
      <?php endif; ?>
    </div>
  </div>
  <div class="image-container">
    <img class='tokyo' src="./images/tokyo.jpg" alt="Street car meeting">
  </div>
</div>