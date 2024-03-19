<?php

require_once "./init.php";

$vehiculeRepository = new VehiculeRepository();
$vehiculeController = new VehiculeController($vehiculeRepository);
$homeController = new HomeController();
// print_r($vehiculeRepository->test());
// print_r($vehiculeController);

// test du fonctionnement de la connexion à la base de données
// $database = new Database();
// $result = $database->getDb()->query('SELECT * FROM vehicule')->fetchAll();
// print_r($result);

$route = getRoute() || '';


switch ($route) {
  case "vehicules";
    $vehiculeController->index();
    break;
  default:
    $homeController->index();
    break;
}

// index.php file -> check route -> controller handles business logic (use repository + fetch db / model) + redirect to route with data


function getRoute()
{
  if (isset($_GET) && !empty($_GET)) {
    return $_GET['route'];
  }
}
