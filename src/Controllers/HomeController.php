<?php

class HomeController
{
  use View;

  public function index()
  {
    echo $this->renderView('home');
    exit();
  }

  public function not_found_404()
  {
    echo $this->renderView('404');
    exit();
  }
}
