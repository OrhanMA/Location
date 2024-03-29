<?php


class RentalController
{
  use View;
  use FormValidation;
  use Assertion;
  private $rentalRepository;
  private $userRepository;

  public function __construct()
  {
    $this->rentalRepository = new RentalRepository();
    $this->userRepository = new UserRepository();
  }

  public function index()
  {
    if (session_status() !== PHP_SESSION_ACTIVE) {
      session_start();
    }
    if ($this->sne($_SESSION) && $this->sne($_SESSION['authenticated_user'])) {
      $auth_email = $_SESSION['authenticated_user'];
      $user = $this->userRepository->getByEmail($auth_email);

      if (!$user) {
        echo $this->renderView('login', ['message' => 'Connectez-vous pour accéder à cette page']);
        exit();
      }

      $rentals = $this->rentalRepository->getUserRentals($user['id']);

      echo $this->renderView('profile/rentals/index', ['user' => $user, 'rentals' => $rentals]);
    } else {
      echo $this->renderView('login', ['message' => 'Connectez-vous pour accéder à cette page']);
    }
    exit();
  }

  public function get_update($id)
  {
    $rental = $this->rentalRepository->getById($id);
    echo $this->renderView('profile/rentals/update/index', ['rental' => $rental]);
    exit();
  }

  public function get_delete($id)
  {
    $rental = $this->rentalRepository->getById($id);
    echo $this->renderView('profile/rentals/delete/index', ['rental' => $rental]);
    exit();
  }

  public function post_delete()
  {
    if (session_status() !== PHP_SESSION_ACTIVE) {
      session_start();
    }

    if ($this->not_se($_SESSION) || $this->not_se($_SESSION['authenticated_user'])) {
      echo $this->renderView('login', ['message' => 'Impossible de vous authentifier pour cette action. Veuillez vous connecter.']);
      exit();
    }

    $user_email = $_SESSION['authenticated_user'];
    $user = $this->userRepository->getUserIdByEmail($user_email);
    $user_id = $user['id'];

    $reservation_id = htmlspecialchars($_POST['reservation_id']);
    $reservation = $this->rentalRepository->getById($reservation_id);

    if ($user_id !== $reservation['user_id']) {
      session_destroy();
      echo $this->renderView('login', ['message' => "Vous n'êtes pas autorisé à réaliser cette action. Pour réaliser cette action, veuillez vous connecter."]);
    } else {
      $this->rentalRepository->delete($reservation_id);
      $rentals = $this->rentalRepository->getUserRentals($user_id);
      echo $this->renderView('/profile/rentals/index', ['message' => 'La réservation a bien été supprimée', 'rentals' => $rentals]);
    }
    exit();
  }

  public function post_update()
  {
    if (session_status() !== PHP_SESSION_ACTIVE) {
      session_start();
    }

    if ($this->not_se($_SESSION) || $this->not_se($_SESSION['authenticated_user'])) {
      echo $this->renderView('login', ['message' => 'Impossible de vous authentifier pour cette action. Veuillez vous connecter.']);
      exit();
    }

    $user_email = $_SESSION['authenticated_user'];
    $user = $this->userRepository->getUserIdByEmail($user_email);
    $user_id = $user['id'];

    $reservation_id = htmlspecialchars($_POST['reservation_id']);
    $reservation = $this->rentalRepository->getById($reservation_id);

    if ($user_id !== $reservation['user_id']) {
      session_destroy();
      echo $this->renderView('login', ['message' => "Vous n'êtes pas autorisé à réaliser cette action. Pour réaliser cette action, veuillez vous connecter."]);
      exit();
    } else {
      if ($this->sne($_POST)) {
        $fields = [
          'end_date' => '/^\d{4}-\d{2}-\d{2}$/',
        ];
        $this->validate_form_fields($fields, 'profile/index');

        $new_end_date = htmlspecialchars($_POST['end_date']);
        $reservation_id = htmlspecialchars($_POST['reservation_id']);

        $this->rentalRepository->update($reservation_id, $new_end_date);
        $rentals = $this->rentalRepository->getUserRentals($user_id);
        echo $this->renderView('/profile/rentals/index', ['message' => 'La durée de réservation a bien été mise à jour', 'rentals' => $rentals]);
      } else {
        echo $this->renderView('profile/index', ['message' => "Les données permettant la mise à jour n'ont pas pu être récupérées. Veuillez réessayer."]);
      }
      exit();
    }
    exit();
  }
}
