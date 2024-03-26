<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Page rentals user</title>
</head>

<body>
  <?php
  // var_dump($rentals);

  if (isset($message) && !empty($message)) {
    echo "<p> $message </p>";
  }

  foreach ($rentals as $rental) {
    echo "<div>";
    foreach ($rental as $key => $value) {
      # code...
      echo "<p> $key : $value </p>";
    }
    $rental_id = $rental['reservation_id'];
    echo "<a href='/location/public/profile/rentals/update/$rental_id'>Update reservation</a>";
    echo "<a href='/location/public/profile/rentals/delete/$rental_id'>Delete reservation</a>";
    echo "</div>";
  }

  ?>
  <h1>Page user rentals</h1>
</body>

</html>