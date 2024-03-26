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
      <label for="first_name">Prénom</label>
      <input type="text" minlength="3" maxlength="50" name="first_name" id="first_name" value="<?php echo $user['first_name']; ?>">
    </div>
    <div>
      <label for="last_name">Nom</label>
      <input required type="text" minlength="3" maxlength="50" name="last_name" id="last_name" value="<?php echo $user['last_name']; ?>">
    </div>
    <div>
      <label for="email">Email</label>
      <input required type="email" name="email" id="email" value="<?php echo $user['email']; ?>">
    </div>
    <div>
      <label for="phone">Phone</label>
      <input required type="tel" minlength="10" maxlength=10 name="phone" id="phone" value="<?php echo $user['phone']; ?>">
    </div>
    <div>
      <label for="current_password">Votre mot de passe actuel</label>
      <input required type="password" minlength="7" name="current_password" id="current_password">
    </div>
    <div>
      <label for="new_password">Votre nouveau mot de passe</label>
      <input required type="password" minlength="7" name="new_password" id="new_password">
    </div>
    <input type="submit" value="Mettre à jour">
  </form>
</body>

</html>