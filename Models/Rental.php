<?php

class Rental
{

  private $id;
  private $start_date;
  private $end_date;
  private $vehicule_id;
  private $user_id;

  public function __construct($id, $start_date, $end_date, $vehicule_id, $user_id)
  {
    $this->id = $id;
    $this->start_date = $start_date;
    $this->end_date = $end_date;
    $this->vehicule_id = $vehicule_id;
    $this->user_id = $user_id;
  }

  public function getId()
  {
    return $this->id;
  }
  public function setId($value)
  {
    $this->id = $value;
  }

  public function getStartdate()
  {
    return $this->start_date;
  }
  public function setStartdate($value)
  {
    $this->start_date = $value;
  }

  public function getEnddate()
  {
    return $this->end_date;
  }
  public function setEnddate($value)
  {
    $this->end_date = $value;
  }

  public function getVehiculeId()
  {
    return $this->vehicule_id;
  }
  public function setVehiculeId($value)
  {
    $this->vehicule_id = $value;
  }

  public function getUserId()
  {
    return $this->user_id;
  }
  public function setUserId($value)
  {
    $this->user_id = $value;
  }
}
