<?php

require_once __DIR__ . '/../Repositories/UserRepository.php';


class ProfileController
{
  use View;
  private $userRepository;

  public function __construct()
  {
    $this->userRepository = new UserRepository();
  }

  public function index()
  {
    if (session_status() !== PHP_SESSION_ACTIVE) session_start();

    // var_dump($_SESSION);

    if (isset($_SESSION['authenticated_user']) && !empty($_SESSION['authenticated_user'])) {
      $email = $_SESSION['authenticated_user'];
      $user = $this->userRepository->getByEmail($email);
      echo $this->renderView('profile/index', [$user]);
      exit();
    } else {
      $message = 'Connectez-vous à votre compte pour accéder à cette page.';
      echo $this->renderView('login', [$message]);
      exit();
    }
  }
}
