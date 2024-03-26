<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>
</head>

<body>
  <h1>Page profile user</h1>
  <?php
  $user = $data['user'];
  var_dump($user);
  ?>
  <a href="/location/public/profile/update/<?php echo $user['id']; ?>">Mettre à jour profile</a>
  <a href="/location/public/profile/delete/<?php echo $user['id']; ?>">Supprimer mon compte</a>
</body>

</html>