<?php


if (isset($_SERVER) && isset($_SERVER['REQUEST_URI']) && !empty($_SERVER) && $_SERVER['REQUEST_URI']) {

  $uri = parse_url($_SERVER['REQUEST_URI']);
  $uri_path = $uri['path'];

  if (isset($uri['query']) && !empty($uri['query'])) {
    $uri_query = $uri['query'];
    echo "</br>";
  }

  function get_url_dynamic_id(string $routeKey, int $offset)
  {
    if (isset($_SERVER) && !empty($_SERVER) && isset($_SERVER['REQUEST_URI']) && !empty($_SERVER['REQUEST_URI'])) {

      $urlExploded = explode('/', $_SERVER['REQUEST_URI']);
      // casse l'url en morceaux
      $urlRouteKeyIndex = array_search($routeKey, $urlExploded);
      // recherche dans le tableau urlExploded la clé de la route
      $index = $urlRouteKeyIndex + $offset;
      if (array_key_exists($index, $urlExploded)) {
        $id = $urlExploded[$index];
        return $id;
      } else {
        throw new Exception("Error: array key at index $index does not exist in urlExploded");
      }
      // récupère la clé suivante qui contient l'ID grâce à un offset
    } else {
      throw new Exception("Error: SERVER variable is not set or is empty");
    }
  }

  // $id = get_url_dynamic_id('vehicules', 2);
  // print_r($id);

  $baseUri = '/location/public';

  $vehiculeController = new VehiculeController();
  $homeController = new HomeController();
  $rentalController = new RentalController();
  $authController = new AuthController();
  $profileController = new ProfileController();

  // print_r($uri_path);

  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    switch ($uri_path) {
      case $baseUri . '/register':
        $authController->post_register();
        break;
      case $baseUri . '/login':
        $authController->post_login();
        break;
      case $baseUri . '/profile/update':
      case $baseUri . '/profile/update/':
        $profileController->post_update();
        break;
      case $baseUri . '/profile/delete':
      case $baseUri . '/profile/delete/':
        $profileController->post_delete();
        break;
      case $baseUri . '/rent/':
      case $baseUri . '/rent':
        $vehiculeController->post_rent();
        break;
      case $baseUri . '/rental/update':
        $rentalController->post_update();
        break;
      case $baseUri . '/rental/delete':
        $rentalController->post_delete();
        break;
      default:
        $homeController->not_found_404();
        break;
    }
  } else if ($_SERVER['REQUEST_METHOD'] == "GET") {
    switch ($uri_path) {
      case $baseUri . '/index.php':
        $homeController->index();
        break;
      case $baseUri . '/vehicules/index.php':
        $vehiculeController->index();
        break;
      case $baseUri . '/register/index.php':
        $authController->get_register();
        break;

      case $baseUri . '/logout':
        $authController->logout();
      case $baseUri . '/login/index.php':
        $authController->get_login();
        break;
      case $baseUri . '/profile/index.php':
        $profileController->index();
        break;
      case $baseUri . '/profile/rentals/index.php':
        $rentalController->index();
        break;
      case str_contains($uri_path, $baseUri . '/vehicules/rent/'):
        $vehicule_id = get_url_dynamic_id('vehicules', 2);
        $vehiculeController->get_rent($vehicule_id);
        break;
      case str_contains($uri_path, $baseUri . '/profile/update/'):
        $id = get_url_dynamic_id('profile', 2);
        $profileController->get_update($id);
        break;
      case str_contains($uri_path, $baseUri . '/profile/delete/'):
        $id = get_url_dynamic_id('profile', 2);
        $profileController->get_delete($id);
        break;
      case str_contains($uri_path, $baseUri . '/vehicules/show/'):
        // str_contains vérifie dans le string en param #1 la présence d'un sous ensemble string précisé en param #2
        $id = get_url_dynamic_id('vehicules', 2);
        $vehiculeController->show($id);
        break;
      case str_contains($uri_path, $baseUri . '/profile/rentals/update/');
        $id = get_url_dynamic_id('profile', 3);
        $rentalController->get_update($id);
        break;
      case str_contains($uri_path, $baseUri . '/profile/rentals/delete/');
        $id = get_url_dynamic_id('profile', 3);
        $rentalController->get_delete($id);
        break;
        // case str_contains($uri_path, $baseUri . '/rent'):
        //   $id = $_GET['vehicule'];
        //   $rentalController->index($id);
        //   break;
      default:
        $homeController->not_found_404();
        break;
    }
  }
}
