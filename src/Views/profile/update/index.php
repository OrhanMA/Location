<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Update</title>
</head>

<body>
  <h1>Page profile update user</h1>
  <?php
  if (isset($data) && !empty($data)) {
    $user = $data['user'];
    // var_dump($user);
    if (isset($data['message']) && !empty($data['message'])) {
      $message = $data['message'];
      echo "<p>$message</p>";
    }
  }
  ?>

  <form action="/location/public/profile/update" method="post">
    <div>
      <input hidden aria-hidden="true" readonly required type="text" name="id" id="id" value="<?php echo $user['id']; ?>">
    </div>
    <div>
      <label for="full_name">Nom complet</label>
      <input required type="text" name="full_name" id="full_name" value="<?php echo $user['full_name']; ?>">
    </div>
    <div>
      <label for="email">Email</label>
      <input required type="email" name="email" id="email" value="<?php echo $user['email']; ?>">
    </div>
    <div>
      <label for="phone">Phone</label>
      <input required type="tel" name="phone" id="phone" value="<?php echo $user['phone']; ?>">
    </div>
    <div>
      <label for="current_password">Votre mot de passe actuel</label>
      <input required type="password" name="current_password" id="current_password">
    </div>
    <div>
      <label for="new_password">Votre nouveau mot de passe</label>
      <input required type="password" name="new_password" id="new_password">
    </div>
    <input type="submit" value="Mettre à jour">
  </form>
</body>

</html>