<?php

class VehiculeController
{
  use View;
  use FormValidation;
  use Assertion;
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
    $vehicules = $this->vehiculeRepository->getAll();
    foreach ($vehicules as $vehicule) {
      // je récupère un string avec les catégories séparées par virgule donc je dois transformer ça en tableau avec explode
      $categories = explode(",", $vehicule->categories);
      // puise je réassigne categories en lui donnant le tableau
      $vehicule->categories = $categories;
    }

    echo $this->renderView('vehicules/index', $vehicules);
    exit();
  }

  public function get_rent($vehicule_id)
  {
    $vehicule = $this->vehiculeRepository->getById($vehicule_id);

    $user_email = '';

    if ($this->sne($_SESSION) && $this->sne($_SESSION['authenticated_user'])) {
      $user_email = $_SESSION['authenticated_user'];
      echo $this->renderView('vehicules/rent', ['vehicule' => $vehicule, 'user_email' => $user_email]);
      exit();
    } else {
      echo $this->renderView('login', ["message" => 'connectez-vous pour pouvoir louer un véhicule']);
      exit();
    }
  }

  public function post_rent()
  {
    if ($this->not_se($_POST)) {
      echo $this->renderView('vehicules/index', ['message' => "Les données du formulaire n'ont pas pu être récupérées. Veuillez recommencer."]);
      exit();
    }

    $fields = [
      'start_date' => '/^\d{4}-\d{2}-\d{2}$/',
      'end_date' => '/^\d{4}-\d{2}-\d{2}$/'
    ];

    $this->validate_form_fields($fields, 'vehicules/index');

    $sanitized_start_date = htmlspecialchars($_POST['start_date']);
    $sanitized_end_date = htmlspecialchars($_POST['end_date']);

    $user = $this->userRepository->getByEmail($_POST['email']);

    if (!$user) {
      echo $this->renderView('login', ['message' => "Vous devez être connecté pour réserver un véhicule"]);
      exit();
    }

    $start_date = date("Y-m-d", strtotime($sanitized_start_date));
    $end_date = date("Y-m-d", strtotime($sanitized_end_date));

    $this->rentalRepository->create($start_date, $end_date, $_POST['vehicule_id'], $user['id']);

    $rentals = $this->rentalRepository->getUserRentals($user['id']);

    echo $this->renderView('profile/rentals/index', ['user' => $user, 'rentals' => $rentals]);
    exit();
  }
}
