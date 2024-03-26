<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
</head>

<body>
  <?php
  if (isset($message) && !empty($message)) {
    echo "<p> $message </p>";
  }
  ?>
  <h1>Register page</h1>
  <a href="/location/public/login/index.php">Connexion</a>
  <form action="/location/public/register" method="post">
    <div>
      <label for="first_name">First name</label>
      <input type="text" minlength="3" maxlength="50" name="first_name" id="first_name" value="Orhan">
    </div>
    <div>
      <label for="last_name">Last name</label>
      <input required type="text" minlength="3" maxlength="50" name="last_name" id="last_name" value="Madi Assani">
    </div>
    <div>
      <label for="phone">Phone</label>
      <input required type="phone" name="phone" id="phone" minlength="10" maxlength=10 value="0123456789">
    </div>
    <div>
      <label for="email">Email</label>
      <input required type="email" minlength="5" maxlength="80" name="email" id="email" value="test@test.com">
    </div>
    <div>
      <label for="password">Password</label>
      <input required type="password" minlength="7" name="password" id="password" value="test">
    </div>
    <input type="submit" value="Inscription">
  </form>
</body>

</html>