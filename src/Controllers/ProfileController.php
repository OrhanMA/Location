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

  public function get_update($id)
  {
    if (session_status() !== PHP_SESSION_ACTIVE) session_start();

    // var_dump($_SESSION);

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

    // var_dump($_SESSION);

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
      // si pas de données
      $message = "Les données du formulaire n'ont pas pu être récupérées. Veuillez recommencer.";
      echo $this->renderView('profile/update/index', ['message' => $message]);
      exit();
    }

    $id = htmlspecialchars($_POST['id']);
    $full_name = htmlspecialchars($_POST['full_name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
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
      // si ce n'est pas le bon user qui fait la requête
      $_SESSION['authenticated_user'] = null;
      $message = "Aucun user correspondant à cet email n'a été trouvé, veuillez vous identifier.";
      echo $this->renderView('login', ['message' => $message]);
      exit();
    }

    $password_hash = $user['password'];

    if (!password_verify($current_password, $password_hash)) {
      // si il n'a pas mis le bon mot de passe 
      $message = 'Valeur incorrecte dans mot de passe actuel';
      echo $this->renderView("profile/update/index", ['message' => $message, 'user' => $user]);
    }

    $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
    $this->userRepository->update($id, $full_name, $email, $phone, $new_password_hash);
    $message = 'Le profil a correctement été mis à jour';
    echo $this->renderView("profile/update/index", ['message' => $message, 'user' => $user]);
  }

  public function post_delete()
  {
    if (!isset($_POST) || empty($_POST)) {
      // si pas de données
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
      // si ce n'est pas le bon user qui fait la requête
      $_SESSION['authenticated_user'] = null;
      $message = "Aucun user correspondant n'a été trouvé, veuillez vous identifier.";
      echo $this->renderView('login', ['message' => $message]);
      exit();
    }

    $password_hash = $user['password'];

    if (!password_verify($password, $password_hash)) {
      // si il n'a pas mis le bon mot de passe 
      $message = 'Valeur incorrecte dans mot de passe';
      echo $this->renderView("profile/delete/index", ['message' => $message, 'user' => $user]);
    }

    $this->userRepository->delete($id);
    $message = 'Votre compte a correctement été supprimé';
    echo $this->renderView("login", ['message' => $message]);
  }

  public function index()
  {
    if (session_status() !== PHP_SESSION_ACTIVE) session_start();

    // var_dump($_SESSION);

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
