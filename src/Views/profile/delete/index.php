<title>Supprimer mon compte</title>
<div class="page">
  <h1>Supprimer mon compte</h1>
  <?php
  if (isset($data) && !empty($data)) {
    $user = $data['user'];


    if (isset($data['message']) && !empty($data['message'])) {
      $message = $data['message'];
      if (isset($message) && !empty($message)) {
        echo "<p>$message</p>";
      }
    }
  }
  ?>

  <h2>Attention, cette action est irréversible!</h2>
  <p>Entrez votre mot de passe pour valider la suppression.</p>
  <form action="./" method="post">
    <div>
      <input hidden aria-hidden="true" readonly required type="text" name="id" id="id" value="<?php echo $user['id']; ?>">
      <div class="form-field">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password">
      </div>
      <input class="button bg-accent" type="submit" value="Supprimer mon compte">
  </form>
  </body>

  </html>