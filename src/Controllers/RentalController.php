<?php

require_once __DIR__ . '/../Repositories/RentalRepository.php';


class RentalController
{
  use View;
  use FormValidation;
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
      exit();
    }
    $user = $this->userRepository->getByEmail($auth_email);

    if (!$user) {
      //Redirect 
      $message = 'Connectez-vous pour accéder à cette page';
      echo $this->renderView('login', ['message' => $message]);
      exit();
    }


    $user_id = $user['id'];

    $rentals = $this->rentalRepository->getUserRentals($user_id);

    echo $this->renderView('profile/rentals/index', ['user' => $user, 'rentals' => $rentals]);
    exit();
  }

  public function get_update($id)
  {
    $rental = $this->rentalRepository->getById($id);
    // var_dump($rental);

    echo $this->renderView('profile/rentals/update/index', ['rental' => $rental]);
    exit();
  }

  public function get_delete($id)
  {
    $rental = $this->rentalRepository->getById($id);

    // var_dump($rental);

    echo $this->renderView('profile/rentals/delete/index', ['rental' => $rental]);
    exit();
  }

  public function post_delete()
  {
    if (session_status() !== PHP_SESSION_ACTIVE) {
      session_start();
    }

    if (!isset($_SESSION) || empty($_SESSION)) {
      $message = 'Impossible de vous authentifier pour cette action. Veuillez vous connecter.';
      echo $this->renderView('login', ['message' => $message]);
      exit();
    }
    if (!isset($_SESSION['authenticated_user']) || empty($_SESSION['authenticated_user'])) {
      $message = 'Impossible de vous authentifier pour cette action. Veuillez vous connecter.';
      echo $this->renderView('login', ['message' => $message]);
      exit();
    }

    $user_email = $_SESSION['authenticated_user'];
    $user = $this->userRepository->getUserIdByEmail($user_email);
    $user_id = $user['id'];

    $reservation_id = htmlspecialchars($_POST['reservation_id']);
    $reservation = $this->rentalRepository->getById($reservation_id);


    if ($user_id !== $reservation['user_id']) {
      session_destroy();
      $message = "Vous n'êtes pas autorisé à réaliser cette action. Pour réaliser cette action, veuillez vous connecter.";
      echo $this->renderView('login', ['message' => $message]);
      exit();
    } else {
      $this->rentalRepository->delete($reservation_id);
      $rentals = $this->rentalRepository->getUserRentals($user_id);
      $message = 'La réservation a bien été supprimée';
      echo $this->renderView('/profile/rentals/index', ['message' => $message, 'rentals' => $rentals]);
      exit();
    }
  }

  public function post_update()
  {
    if (session_status() !== PHP_SESSION_ACTIVE) {
      session_start();
    }

    if (!isset($_SESSION) || empty($_SESSION)) {
      $message = 'Impossible de vous authentifier pour cette action. Veuillez vous connecter.';
      echo $this->renderView('login', ['message' => $message]);
      exit();
    }
    if (!isset($_SESSION['authenticated_user']) || empty($_SESSION['authenticated_user'])) {
      $message = 'Impossible de vous authentifier pour cette action. Veuillez vous connecter.';
      echo $this->renderView('login', ['message' => $message]);
      exit();
    }

    $user_email = $_SESSION['authenticated_user'];
    $user = $this->userRepository->getUserIdByEmail($user_email);
    $user_id = $user['id'];

    $reservation_id = htmlspecialchars($_POST['reservation_id']);
    $reservation = $this->rentalRepository->getById($reservation_id);


    if ($user_id !== $reservation['user_id']) {
      session_destroy();
      $message = "Vous n'êtes pas autorisé à réaliser cette action. Pour réaliser cette action, veuillez vous connecter.";
      echo $this->renderView('login', ['message' => $message]);
      exit();
    } else {
      if (isset($_POST) && !empty($_POST)) {
        $fields = [
          'end_date' => '/^\d{4}-\d{2}-\d{2}$/',
        ];
        $this->validate_form_fields($fields, 'profile/index');

        $new_end_date = htmlspecialchars($_POST['end_date']);
        $reservation_id = htmlspecialchars($_POST['reservation_id']);

        $this->rentalRepository->update($reservation_id, $new_end_date);
        $rentals = $this->rentalRepository->getUserRentals($user_id);
        $message = 'La durée de réservation a bien été mise à jour';
        echo $this->renderView('/profile/rentals/index', ['message' => $message, 'rentals' => $rentals]);
        exit();
      } else {
        $message = "Les données permettant la mise à jour n'ont pas pu être récupérées. Veuillez réessayer.";
        echo $this->renderView('profile/index', ['message' => $message]);
        exit();
      }
    }
  }
}
