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

  // print_r($uri_path);

  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    switch ($uri_path) {
      case $baseUri . '/register':
        $authController->register();
        break;
      default:
        $homeController->not_found_404();
        break;
    }
  } else if ($_SERVER['REQUEST_METHOD'] == "GET") {
    switch ($uri_path) {
      case $baseUri . '/':
        $homeController->index();
        break;
      case $baseUri . '/index.php':
        $homeController->index();
        break;
      case $baseUri . '/vehicules/':
        $vehiculeController->index();
        break;
      case $baseUri . '/vehicules':
        $vehiculeController->index();
        break;
      case $baseUri . '/register':
        $authController->index();
        break;
      case str_contains($uri_path, $baseUri . '/vehicules/show/'):
        // str_contains vérifie dans le string en param #1 la présence d'un sous ensemble string précisé en param #2
        $id = get_url_dynamic_id('vehicules', 2);
        $vehiculeController->show($id);
        break;
      case str_contains($uri_path, $baseUri . '/rent'):
        $id = $_GET['vehicule'];
        $rentalController->index($id);
        break;
      default:
        $homeController->not_found_404();
        break;
    }
  }
}