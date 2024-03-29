<title>Register</title>
<div class="page">
  <h1>Register page</h1>
  <a href="/location/public/login/index.php">Cliquez ici pour vous connecter</a>
  <?php if (isset($message) && !empty($message)) : ?>
    <p class='accent'> <?php echo $message ?> </p>
  <?php endif; ?>
  <form action="/location/public/register" method="post">
    <div class='form-field'>
      <label for="first_name">First name</label>
      <input type="text" minlength="3" maxlength="50" name="first_name" id="first_name" value="Orhan">
    </div>
    <div class='form-field'>
      <label for="last_name">Last name</label>
      <input required type="text" minlength="3" maxlength="50" name="last_name" id="last_name" value="Madi Assani">
    </div>
    <div class='form-field'>
      <label for="phone">Phone</label>
      <input required type="phone" name="phone" id="phone" minlength="10" maxlength=10 value="0123456789">
    </div>
    <div class='form-field'>
      <label for="email">Email</label>
      <input required type="email" minlength="5" maxlength="80" name="email" id="email" value="test@test.com">
    </div>
    <div class='form-field'>
      <label for="password">Password</label>
      <input required type="password" minlength="7" name="password" id="password" value="test1234">
    </div>
    <div class='form-field'>
      <label for="confirm_password">Confirm Password</label>
      <input required type="password" minlength="7" name="confirm_password" id="confirm_password" value="test1234">
    </div>
    <input class="button bg-accent" type="submit" value="Inscription">
  </form>
</div>

</html>