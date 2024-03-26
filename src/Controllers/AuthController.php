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

  public function get_register()
  {
    echo $this->renderView('register', [null]);
    exit();
  }

  public function get_login()
  {
    if (isset($_SESSION['authenticated_user']) && !empty($_SESSION['authenticated_user'])) {
      $user = $this->userRepository->getByEmail($_SESSION['authenticated_user']);
      echo $this->renderView('profile/index', ['user' => $user]);
      exit();
    } else {
      echo $this->renderView('login', [null]);
      exit();
    }
  }


  public function post_login()
  {
    if (isset($_POST) && !empty($_POST)) {

      if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])) {
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);

        $user = $this->userRepository->getByEmail($email);
        if (!$user) {
          // var_dump($user);
          // pas trouvé
          $message = "Auncun compte n'est associé à cet email.";
          echo $this->renderView('login', ['message' => $message]);
          exit();
        }
        // var_dump($user);
        // trouvé 

        $password_hash = $user['password'];

        // $password le mot de passe en clair soumis dans le formulaire
        // $password_hash le hash du password du user trouvé en base de données

        if (session_status() !== PHP_SESSION_ACTIVE) {
          session_start();
        }

        if (password_verify($password, $password_hash)) {
          $_SESSION['authenticated_user'] = $user['email'];
          echo $this->renderView('profile/index', ['user' => $user]);
          header('Location: /location/public/profile/index.php');
          exit();
        } else {
          $_SESSION['authenticated_user'] = null;
          $message = 'Invalid credentials';
          echo $this->renderView('login', ['message' => $message]);
          exit();
        }
      } else {
        $message = "Les données du formulaire n'ont pas pu être récupérée. Veuillez réessayer.";
        echo $this->renderView('login', ['message' => $message]);
        exit();
      }
    } else {
      $message = "Les données du formulaire n'ont pas pu être récupérée. Veuillez réessayer.";
      echo $this->renderView('login', ['message' => $message]);
      exit();
    }
  }


  // POST METHOD
  public function post_register()
  {
    if (isset($_POST) && !empty($_POST)) {

      if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])) {
        $full_name = htmlspecialchars($_POST['full_name']);
        $phone = htmlspecialchars($_POST['phone']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);

        $user = $this->userRepository->getByEmail($email);
        if (!$user) {
          $password_hash = password_hash($password, PASSWORD_DEFAULT);

          $this->userRepository->create($full_name, $email, $phone, $password_hash);

          $user = $this->userRepository->getByEmail($email);

          if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
          }
          $_SESSION['authenticated_user'] = $user['email'];


          echo $this->renderView('profile/index', ['user' => $user]);
          header('Location: /location/public/profile/index.php');
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


  public function logout()
  {
    if (session_status() !== PHP_SESSION_ACTIVE) {
      session_start();
    }
    session_destroy();
    $message = 'Vous avez bien été déconnecté.';
    echo $this->renderView('home', ['message' => $message]);
    header('Location: /location/public/index.php');
    exit();
  }
}
