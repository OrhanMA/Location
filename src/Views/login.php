<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
</head>

<body>

  <?php
  if (isset($message) && !empty($message)) {
    echo "<p> $message </p>";
  }
  ?>
  <h1>Login page</h1>
  <a href="/location/public/register/index.php">Créer un compte</a>
  <form action="/location/public/login" method="post">
    <div>
      <label for="email">Email</label>
      <input required type="email" name="email" id="email" value="test@test.com">
    </div>
    <div>
      <label for="password">Password</label>
      <input required type="password" name="password" id="password" value="test1234">
    </div>
    <input type="submit" value="Connexion">
  </form>

</body>

</html>