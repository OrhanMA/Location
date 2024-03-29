<title>Supprimer mon compte</title>
<div class="page">
  <h1>Supprimer mon compte</h1>
  <?php
  $user = (isset($data) && !empty($data)) ? $data['user'] : null;
  $message = (isset($data['message']) && !empty($data['message'])) ? $data['message'] : null;
  ?>
  <p class="accent">Attention, cette action est irréversible!</p>
  <p>Entrez votre mot de passe pour valider la suppression.</p>
  <form action="./" method="post">
    <div>
      <input hidden aria-hidden="true" readonly required type="text" name="id" id="id" value="<?php echo $user['id']; ?>">
      <div class="form-field">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password">
        <?php if (isset($message) && !empty($message)) : ?>
          <p class='accent'><?php echo $message ?></p>
        <?php endif; ?>
      </div>
      <input class="button bg-accent" type="submit" value="Supprimer mon compte">
  </form>
  </body>

  </html>