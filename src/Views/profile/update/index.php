<title>Mise à jour profil</title>
<div class="page">
  <h1>Mettre à jour mon profil</h1>
  <?php
  if (isset($data) && !empty($data)) {
    $user = $data['user'];
    if (isset($data['message']) && !empty($data['message'])) {
      $message = $data['message'];
      echo "<p>$message</p>";
    }
  }
  ?>
  <form action="/location/public/profile/update" method="post">
    <div class='form-field'>
      <input hidden aria-hidden="true" readonly required type="text" name="id" id="id" value="<?php echo $user['id']; ?>">
    </div>
    <div class='form-field'>
      <label for="first_name">Prénom</label>
      <input type="text" minlength="3" maxlength="50" name="first_name" id="first_name" value="<?php echo $user['first_name']; ?>">
    </div>
    <div class='form-field'>
      <label for="last_name">Nom</label>
      <input required type="text" minlength="3" maxlength="50" name="last_name" id="last_name" value="<?php echo $user['last_name']; ?>">
    </div>
    <div class='form-field'>
      <label for="email">Email</label>
      <input required type="email" name="email" id="email" value="<?php echo $user['email']; ?>">
    </div>
    <div class='form-field'>
      <label for="phone">Phone</label>
      <input required type="tel" minlength="10" maxlength=10 name="phone" id="phone" value="<?php echo $user['phone']; ?>">
    </div>
    <div class='form-field'>
      <label for="current_password">Votre mot de passe actuel</label>
      <input required type="password" minlength="7" name="current_password" id="current_password">
    </div>
    <div class='form-field'>
      <label for="new_password">Votre nouveau mot de passe</label>
      <input required type="password" minlength="7" name="new_password" id="new_password">
    </div>
    <input class="button bg-accent" type="submit" value="Mettre à jour">
  </form>
</div>

</html>