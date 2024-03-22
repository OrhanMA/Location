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

  <form action="./register" method="post">
    <div>
      <label for="full_name">Full name</label>
      <input required type="text" name="full_name" id="full_name" value="Orhan">
    </div>
    <div>
      <label for="phone">Phone</label>
      <input required type="phone" name="phone" id="phone" minlength="10" maxlength=10 value="0123456789">
    </div>
    <div>
      <label for="email">Email</label>
      <input required type="email" name="email" id="email" value="test@test.com">
    </div>
    <div>
      <label for="password">Password</label>
      <input required type="password" name="password" id="password" value="test">
    </div>
    <input type="submit" value="Inscription">
  </form>
</body>

</html>