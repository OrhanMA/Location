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
    // 
  }

  public function post_update()
  {
    if (session_status() !== PHP_SESSION_ACTIVE) {
      session_start();
    }

    if (!isset($_SESSION) || empty($_SESSION)) {
      // impossible d'accéder au données d'authentification
      // redirect vers login
    }
    if (!isset($_SESSION['authenticated_user']) || empty($_SESSION['authenticated_user'])) {
      // impossible d'accéder au données d'authentification
      // redirect vers login
    }

    $user_email = $_SESSION['authenticated_user'];

    $user = $this->userRepository->getUserIdByEmail($user_email);

    $reservation_id = htmlspecialchars($_POST['reservation_id']);
    $reservation = $this->rentalRepository->getById($reservation_id);

    $user_id = $user['id'];

    if ($user_id !== $reservation['user_id']) {
      echo 'user trying to modify in not authorized because he does not own the rental';
      // destroy session
      // redirect to login
    } else {
      echo 'user is authorized';
      echo "</br>";
      // continue updating
      if (isset($_POST) && !empty($_POST)) {
        $new_end_date = htmlspecialchars($_POST['end_date']);
        $reservation_id = htmlspecialchars($_POST['reservation_id']);

        $this->rentalRepository->update($reservation_id, $new_end_date);
        $rentals = $this->rentalRepository->getUserRentals($user_id);
        $message = 'La durée de réservation a bien été mise à jour';
        echo $this->renderView('/profile/rentals/index', ['message' => $message, 'rentals' => $rentals]);
      } else {
        // authorized but no data retrieved
        // redirect to profile/rentals
      }
    }
  }
}
