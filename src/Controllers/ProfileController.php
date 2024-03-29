<?php

class ProfileController
{
  use View;
  use FormValidation;
  private $userRepository;

  public function __construct()
  {
    $this->userRepository = new UserRepository();
  }

  public function get_update($id)
  {
    if (session_status() !== PHP_SESSION_ACTIVE) session_start();

    if (isset($_SESSION['authenticated_user']) && !empty($_SESSION['authenticated_user'])) {
      $email = $_SESSION['authenticated_user'];
      $user = $this->userRepository->getById($id);
      $auth_user = $this->userRepository->getByEmail($email);


      if (!$user['id'] == $auth_user['id']) {
        $message = 'Connectez-vous à votre compte pour accéder à cette page.';
        echo $this->renderView('login', ['message' => $message]);
        exit();
      }

      echo $this->renderView('profile/update/index', ['user' => $user]);
      exit();
    } else {
      $message = 'Connectez-vous à votre compte pour accéder à cette page.';
      echo $this->renderView('login', ['message' => $message]);
      exit();
    }
  }
  public function get_delete($id)
  {
    if (session_status() !== PHP_SESSION_ACTIVE) session_start();

    if (isset($_SESSION['authenticated_user']) && !empty($_SESSION['authenticated_user'])) {
      $email = $_SESSION['authenticated_user'];
      $user = $this->userRepository->getById($id);
      $auth_user = $this->userRepository->getByEmail($email);


      if (!$user['id'] == $auth_user['id']) {
        $message = 'Connectez-vous à votre compte pour accéder à cette page.';
        echo $this->renderView('login', ['message' => $message]);
        exit();
      }

      echo $this->renderView('profile/delete/index', ['user' => $user]);
      exit();
    } else {
      $message = 'Connectez-vous à votre compte pour accéder à cette page.';
      echo $this->renderView('login', ['message' => $message]);
      exit();
    }
  }

  public function post_update()
  {
    if (!isset($_POST) || empty($_POST)) {
      $message = "Les données du formulaire n'ont pas pu être récupérées. Veuillez recommencer.";
      echo $this->renderView('profile/update/index', ['message' => $message]);
      exit();
    }

    $fields = [
      'first_name' => '/^[a-zA-ZÀ-ÿ\s]{3,50}$/',
      'last_name' => '/^[a-zA-ZÀ-ÿ\s]{3,50}$/',
      'phone' => '/^\d{10}$/',
      'email' => '/^[^\s@]+@[^\s@]+\.[^\s@]+$/',
      'current_password' => '/^.{7,}$/',
      'new_password' => '/^.{7,}$/'
    ];

    $this->validate_form_fields($fields, 'profile/update/index');

    $id = htmlspecialchars($_POST['id']);
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $current_password = htmlspecialchars($_POST['current_password']);
    $new_password = htmlspecialchars($_POST['new_password']);


    $user = $this->userRepository->getById($id);


    if ($current_password == $new_password) {
      $message = "Vous devez mettre un nouveau mot de passe différent du précédent.";
      echo $this->renderView('profile/update/index', ['message' => $message, 'user' => $user]);
      exit();
    }

    if (!$user) {
      if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
      }
      $_SESSION['authenticated_user'] = null;
      $message = "Aucun user correspondant à cet email n'a été trouvé, veuillez vous identifier.";
      echo $this->renderView('login', ['message' => $message]);
      exit();
    }

    $password_hash = $user['password'];

    if (!password_verify($current_password, $password_hash)) {
      $message = 'Valeur incorrecte dans mot de passe actuel';
      echo $this->renderView("profile/update/index", ['message' => $message, 'user' => $user]);
      exit();
    }

    $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
    $this->userRepository->update($id, $first_name, $last_name, $email, $phone, $new_password_hash);
    $message = 'Le profil a correctement été mis à jour';
    echo $this->renderView("profile/update/index", ['message' => $message, 'user' => $user]);
    exit();
  }

  public function post_delete()
  {
    if (!isset($_POST) || empty($_POST)) {
      $message = "Les données du formulaire n'ont pas pu être récupérées. Veuillez recommencer.";
      echo $this->renderView('profile/delete/index', ['message' => $message]);
      exit();
    }

    $id = htmlspecialchars($_POST['id']);

    $password = htmlspecialchars($_POST['password']);

    $user = $this->userRepository->getById($id);

    if (!$user) {
      if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
      }
      $_SESSION['authenticated_user'] = null;
      $message = "Aucun user correspondant n'a été trouvé, veuillez vous identifier pour réaliser cette action.";
      echo $this->renderView('login', ['message' => $message]);
      exit();
    }

    $password_hash = $user['password'];

    if (!password_verify($password, $password_hash)) {
      $message = 'Valeur incorrecte dans mot de passe';
      echo $this->renderView("profile/delete/index", ['message' => $message, 'user' => $user]);
      exit();
    }

    $this->userRepository->delete($id);
    session_destroy();
    // je refresh et redirige avec header pour que le header soit aussi mis à jour
    header('Refresh:0; url=/location/public/register/index.php');
    exit();
  }

  public function index()
  {
    if (session_status() !== PHP_SESSION_ACTIVE) session_start();

    if (isset($_SESSION['authenticated_user']) && !empty($_SESSION['authenticated_user'])) {
      $email = $_SESSION['authenticated_user'];
      $user = $this->userRepository->getByEmail($email);
      echo $this->renderView('profile/index', ['user' => $user]);
      exit();
    } else {
      $message = 'Connectez-vous à votre compte pour accéder à cette page.';
      echo $this->renderView('login', ['message' => $message]);
      exit();
    }
  }
}
