<?php

require_once __DIR__ . '/../Repositories/RentalRepository.php';


class RentalController
{
  private $rentalRepository;

  public function __construct()
  {
    $this->rentalRepository = new RentalRepository();
  }
}
