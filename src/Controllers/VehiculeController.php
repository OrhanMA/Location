<?php

require_once __DIR__ . '/../Repositories/VehiculeRepository.php';
require_once __DIR__ . '/../Repositories/LicenseRepository.php';

class VehiculeController
{
  use View;
  private $vehiculeRepository;
  private $licenseRepository;

  public function __construct()
  {
    $this->vehiculeRepository = new VehiculeRepository();
    $this->licenseRepository = new LicenseRepository();
  }

  public function index()
  {
    // logique bdd
    $vehicules = $this->vehiculeRepository->getAll();
    foreach ($vehicules as $vehicule) {
      // je récupère un string avec les catégories séparées par virgule donc je dois transformer ça en tableau avec explode
      $categories = explode(",", $vehicule->categories);
      // print_r($categories);
      // puise je réassigne categories en lui donnant le tableau
      $vehicule->categories = $categories;
      // print_r($vehicule);
      // echo "<br/>";
    }

    // logique vue
    echo $this->renderView('vehicules/index', $vehicules);
  }

  public function get_rent($vehicule_id)
  {
    // print_r($vehicule_id);
    $vehicule = $this->vehiculeRepository->getById($vehicule_id);



    echo $this->renderView('vehicules/rent', ['vehicule' => $vehicule]);
  }

  // 9be97396-e5f4-11ee-95c9-db561d8c665e

  public function show($id)
  {
    $vehicule = $this->vehiculeRepository->getById($id);
    if ($vehicule == 0) {
      echo $this->renderView('vehicules/show/failure', [$id]);
      exit();
    } else {
      echo $this->renderView('vehicules/show/index', $vehicule);
    }
  }
}
