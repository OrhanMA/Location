<?php

class License
{
  private $id;
  private $plate;

  public function __construct($id, $plate)
  {
    $this->id = $id;
    $this->plate = $plate;
  }

  public function getId()
  {
    return $this->id;
  }
  public function setId($value)
  {
    $this->id = $value;
  }

  public function getPlate()
  {
    return $this->plate;
  }
  public function setPlate($value)
  {
    $this->plate = $value;
  }
}
