<?php

require_once __DIR__ . '/../Repositories/VehiculeRepository.php';

class VehiculeController
{
  use View;
  private $vehiculeRepository;

  public function __construct()
  {
    $this->vehiculeRepository = new VehiculeRepository();
  }

  public function index()
  {
    // logique bdd
    $vehicules = $this->vehiculeRepository->getAll();
    // logique vue
    echo $this->renderView('vehicules/index', $vehicules);
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
