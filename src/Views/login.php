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
  <a href="/location/public/register">Créer un compte</a>
  <form action="./login.php" method="post">
    <div>
      <label for="email">Email</label>
      <input required type="email" name="email" id="email" value="test@test.com">
    </div>
    <div>
      <label for="password">Password</label>
      <input required type="password" name="password" id="password" value="test">
    </div>
    <input type="submit" value="Connexion">
  </form>

</body>

</html>