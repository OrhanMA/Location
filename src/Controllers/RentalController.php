<?php

require_once __DIR__ . '/../Repositories/RentalRepository.php';


class RentalController
{
  use View;
  private $rentalRepository;
  private $userRepository;

  public function __construct()
  {
    $this->rentalRepository = new RentalRepository();
    $this->userRepository = new UserRepository();
  }

  public function index()
  {
    $auth_email = $_SESSION['authenticated_user'];

    if (!isset($auth_email) || empty($auth_email)) {
      // redirect
      $message = 'Connectez-vous pour accéder à cette page';
      echo $this->renderView('login', ['message' => $message]);
    }
    $user = $this->userRepository->getByEmail($auth_email);

    if (!$user) {
      //Redirect 
      $message = 'Connectez-vous pour accéder à cette page';
      echo $this->renderView('login', ['message' => $message]);
    }


    $user_id = $user['user_id'];
    print_r($user_id);
    $rentals = $this->rentalRepository->getUserRentals($user_id);

    var_dump($rentals);

    echo $this->renderView('profile/rentals/index', ['user' => $user, 'rentals' => $rentals]);
  }
}
