<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Delete</title>
</head>

<body>
  <h1>Page profile delete confirmation user</h1>
  <?php
  if (isset($data) && !empty($data)) {
    $user = $data['user'];


    if (isset($data['message']) && !empty($data['message'])) {

      $message = $data['message'];
      // var_dump($user); 
      if (isset($message) && !empty($message)) {
        echo "<p>$message</p>";
      }
    }
  }
  ?>

  <form action="./" method="post">
    <div>
      <input hidden aria-hidden="true" readonly required type="text" name="id" id="id" value="<?php echo $user['id']; ?>">
      <h2>Attention, cette action est irréversible!</h2>
      <p>Entrez votre mot de passe pour valider la suppression.</p>
      <div>
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password">
      </div>
      <input type="submit" value="Supprimer mon compte">
  </form>
</body>

</html>