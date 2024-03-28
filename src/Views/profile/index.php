<title>Mon profil</title>
<div class="page">
  <h1>Mon profil</h1>
  <div class="profil-card">
    <p>Prénom: <?php echo $user['first_name'] ?></p>
    <p>Nom: <?php echo $user['last_name'] ?></p>
    <p>Email: <?php echo $user['email'] ?></p>
    <p>Téléphone: <?php echo $user['phone'] ?></p>
  </div>
  <div class="profil-card-button-container">
    <a class="button bg-night" href="/location/public/profile/update/<?php echo $user['id']; ?>">Mettre à jour profil</a>
    <a class="button bg-accent" href="/location/public/profile/delete/<?php echo $user['id']; ?>">Supprimer mon compte</a>
  </div>
</div>

</html>