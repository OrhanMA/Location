<?php


class VehiculeController
{
  protected $studentRepository;

  public function __construct($studentRepository)
  {
    $this->studentRepository = $studentRepository;
  }

  public function index()
  {
    $data = ['id' => 1];
    // Changer le lien vers la vue.
    require_once __DIR__ . './../Views/vehicules/index.php';
  }
}
