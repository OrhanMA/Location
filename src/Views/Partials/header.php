<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}
$authenticated = isset($_SESSION['authenticated_user']) && !empty($_SESSION['authenticated_user']);
?>

<head>
  <link rel="stylesheet" href="/location/src/styles.css">
  <script type="module" src="/location/src/script.js" defer></script>
</head>

<div class="header">
  <p><a href="/location/public/index.php">Racers</a></p>
  <button class="menu-icon-container bg-salt">
    <img class="menu-icon" src="/location/public/images/menu.png" alt="menu icon">
  </button>
  <div class="mobile-menu ">
    <button class="button close-mobile-menu bg-night">fermer</button>
    <?php if ($authenticated) : ?>
      <a href='/location/public/profile/rentals/index.php'>Mes locations</a>
      <a href='/location/public/profile/index.php'>Profil</a>
      <a href='/location/public/logout'>Déconnexion</a>
    <?php else : ?>
      <a href='/location/public/login/index.php'>Connexion</a>
      <a href='/location/public/register/index.php'>Inscription</a>
    <?php endif; ?>
  </div>
  <div class="large-links">
    <a href="/location/public/vehicules/index.php">Véhicules</a>
    <?php if ($authenticated) : ?>
      <a href='/location/public/profile/rentals/index.php'>Mes locations</a>
      <a href='/location/public/profile/index.php'>Profil</a>
      <a href='/location/public/logout'>Déconnexion</a>
    <?php else : ?>
      <a href='/location/public/login/index.php'>Connexion</a>
      <a href='/location/public/register/index.php'>Inscription</a>
    <?php endif; ?>
  </div>
</div>