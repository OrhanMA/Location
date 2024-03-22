<?php

require_once __DIR__ . '/../Repositories/UserRepository.php';

class AuthController
{
  use View;
  private $userRepository;

  public function __construct()
  {
    $this->userRepository = new UserRepository();
  }

  public function index()
  {
    echo $this->renderView('register', [null]);
  }

  // POST METHOD
  public function register()
  {
    if (isset($_POST) && !empty($_POST)) {

      if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])) {
        $full_name = htmlspecialchars($_POST['full_name']);
        $phone = htmlspecialchars($_POST['phone']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);

        $user = $this->userRepository->getByEmail($email);
        if (!$user) {
          $hashed_password = password_hash($password, PASSWORD_DEFAULT);

          $this->userRepository->create($full_name, $email, $phone, $hashed_password);

          $message = 'Vous êtes bien inscrit. Vous devez désormais vous connecter.';
          echo $this->renderView('login', ['message' => $message]);
          exit();
        } else {
          $message = 'Il y a déjà un utilisateur inscrit avec cette adresse email. Connectez-vous.';
          echo $this->renderView('login', ['message' => $message]);
          exit();
        }
      }
    } else {
      $message = "Les données du formulaire n'ont pas pu être récupérée. Veuillez réessayer.";
      echo $this->renderView('register', ['message' => $message]);
      exit();
    }
  }
}
