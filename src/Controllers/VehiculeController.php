<?php

require_once __DIR__ . '/../Repositories/VehiculeRepository.php';
require_once __DIR__ . '/../Repositories/LicenseRepository.php';
require_once __DIR__ . '/../Repositories/RentalRepository.php';
require_once __DIR__ . '/../Repositories/UserRepository.php';

class VehiculeController
{
  use View;
  private $vehiculeRepository;
  private $licenseRepository;
  private $rentalRepository;
  private $userRepository;

  public function __construct()
  {
    $this->vehiculeRepository = new VehiculeRepository();
    $this->licenseRepository = new LicenseRepository();
    $this->rentalRepository = new RentalRepository();
    $this->userRepository = new UserRepository();
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
    exit();
  }

  public function get_rent($vehicule_id)
  {
    // print_r($vehicule_id);
    $vehicule = $this->vehiculeRepository->getById($vehicule_id);

    // print_r($vehicule);

    if (isset($_SESSION) && !empty($_SESSION)) {
      if (isset($_SESSION['authenticated_user']) && !empty($_SESSION['authenticated_user'])) {
        $user_email = $_SESSION['authenticated_user'];
      }
    }
    echo $this->renderView('vehicules/rent', ['vehicule' => $vehicule, 'user_email' => $user_email]);
    exit();
  }

  public function post_rent()
  {
    if (!isset($_POST) || empty($_POST)) {
      $message = "Les données du formulaire n'ont pas pu être récupérées. Veuillez recommencer.";
      echo $this->renderView('vehicules/index', ['message' => $message]);
      exit();
    }
    $form_data = [];
    foreach ($_POST as $key => $value) {
      if (!isset($_POST[$key]) || empty($_POST[$key])) {
        $message = "Le champ $key du formulaire n'a pas pu être récupéré. Veuillez recommencer.";
        echo $this->renderView('vehicules/index', ['message' => $message]);
        exit();
      }
      $form_data[$key] = htmlspecialchars($value);
    }

    $user = $this->userRepository->getByEmail($form_data['email']);

    if (!$user) {
      $message = "Vous devez être connecté pour réserver un véhicule";
      echo $this->renderView('login', ['message' => $message]);
      exit();
    }

    $start_date = date("Y-m-d", strtotime($form_data['start_date']));
    $end_date = date("Y-m-d", strtotime($form_data['end_date']));

    $this->rentalRepository->create($start_date, $end_date, $form_data['vehicule_id'], $user['id']);
    echo $this->renderView('profile/rentals/index', ['user' => $user]);
    exit();
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
      exit();
    }
  }
}
