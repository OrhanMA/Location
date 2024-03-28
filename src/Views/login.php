<title>Login</title>
<div class="page">
  <h1>Login page</h1>
  <?php
  if (isset($message) && !empty($message)) {
    echo "<p> $message </p>";
  }
  ?>
  <a href="/location/public/register/index.php">Créer un compte</a>
  <form action="/location/public/login" method="post">
    <div class="form-field">
      <label for="email">Email</label>
      <input required type="email" name="email" id="email" value="test@test.com">
    </div>
    <div class="form-field">
      <label for="password">Password</label>
      <input required type="password" name="password" id="password" value="test1234">
    </div>
    <input class="button bg-accent" type="submit" value="Connexion">
  </form>
</div>