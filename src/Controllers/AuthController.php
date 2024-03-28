<?php

require_once __DIR__ . '/../Repositories/UserRepository.php';

class AuthController
{
  use View;
  use FormValidation;
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
          $message = "Auncun compte n'est associé à cet email.";
          echo $this->renderView('login', ['message' => $message]);
          exit();
        }

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


  public function post_register()
  {
    if (isset($_POST) && !empty($_POST)) {

      $fields = [
        'first_name' => '/^[a-zA-ZÀ-ÿ\s]{3,50}$/',
        'last_name' => '/^[a-zA-ZÀ-ÿ\s]{3,50}$/',
        'phone' => '/^\d{10}$/',
        'email' => '/^[^\s@]+@[^\s@]+\.[^\s@]+$/',
        'password' => '/^.{7,}$/'
      ];

      $this->validate_form_fields($fields, 'register');

      if ($_POST['password'] !== $_POST['confirm_password']) {
        $message = "Les deux mots de passe ne correspondent pas. Veuillez recommencer.";
        echo $this->renderView('register', ['message' => $message]);
        exit();
      }


      $first_name = htmlspecialchars($_POST['first_name']);
      $last_name = htmlspecialchars($_POST['last_name']);
      $phone = htmlspecialchars($_POST['phone']);
      $email = htmlspecialchars($_POST['email']);
      $password = htmlspecialchars($_POST['password']);


      $user = $this->userRepository->getByEmail($email);

      if (!$user) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $this->userRepository->create($first_name, $last_name, $email, $phone, $password_hash);

        // j'utilise pas PDO::lastInsertedId parce que j'utilise des UUID v4
        $user = $this->userRepository->getByEmail($email);

        if (session_status() !== PHP_SESSION_ACTIVE) {
          session_start();
        }
        $_SESSION['authenticated_user'] = $user['email'];

        // redirection directement au profil au lieu de la page de connexion
        echo $this->renderView('profile/index', ['user' => $user]);
        header('Location: /location/public/profile/index.php');
        exit();
      } else {
        $message = 'Il y a déjà un utilisateur inscrit avec cette adresse email. Connectez-vous.';
        echo $this->renderView('login', ['message' => $message]);
        exit();
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
