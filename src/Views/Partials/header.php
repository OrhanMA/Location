<head>
  <link rel="stylesheet" href="/location/src/styles.css">
  <script type="module" src="/location/src/script.js" defer></script>
</head>
<div class="header">
  <p><a href="/location/public/index.php">Racers</a></p>
  <button class="menu-icon-container bg-salt">
    <img class="menu-icon" src="./images/menu.png" alt="menu icon">
  </button>
  <div class="mobile-menu hidden">
    <button class="button close-mobile-menu bg-night">fermer</button>
    <?php
    if (session_status() !== PHP_SESSION_ACTIVE) {
      session_start();
    }
    if (isset($_SESSION['authenticated_user']) && !empty($_SESSION['authenticated_user'])) {
      // var_dump($_SESSION['authenticated_user']);
      // si quelqu'un est connecté
      echo "<a href='/location/public/profile/rentals/index.php'>Mes locations</a>";
      echo "<a href='/location/public/profile/index.php'>Profil</a>";
      echo "<a href='/location/public/logout'>Déconnexion</a>";
    } else {
      // // si pas connecté 
      // echo 'pas de user connecté';
      echo "<a href='/location/public/login/index.php'>Connexion</a>";
      echo "<a href='/location/public/register/index.php'>Inscription</a>";
    }
    ?>
  </div>
  <div class="large-links">
    <a href="/location/public/vehicules/index.php">Véhicules</a>
    <?php
    if (session_status() !== PHP_SESSION_ACTIVE) {
      session_start();
    }
    if (isset($_SESSION['authenticated_user']) && !empty($_SESSION['authenticated_user'])) {
      // var_dump($_SESSION['authenticated_user']);
      // si quelqu'un est connecté
      echo "<a href='/location/public/profile/rentals/index.php'>Mes locations</a>";
      echo "<a href='/location/public/profile/index.php'>Profil</a>";
      echo "<a href='/location/public/logout'>Déconnexion</a>";
    } else {
      // // si pas connecté 
      // echo 'pas de user connecté';
      echo "<a href='/location/public/login/index.php'>Connexion</a>";
      echo "<a href='/location/public/register/index.php'>Inscription</a>";
    }
    ?>
  </div>
</div>