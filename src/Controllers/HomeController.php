<?php

class HomeController
{
  use View;
  use Assertion;
  private $userRepository;

  public function __construct()
  {
    $this->userRepository = new UserRepository();
  }

  public function index()
  {
    if ($this->sne($_SESSION) && $this->sne($_SESSION['authenticated_user'])) {
      $user = $this->userRepository->getByEmail($_SESSION['authenticated_user']);
      echo $this->renderView('home', ['user' => $user]);
    } else {
      echo $this->renderView('home');
    }
    exit();
  }

  public function not_found_404()
  {
    echo $this->renderView('404');
    exit();
  }
}
