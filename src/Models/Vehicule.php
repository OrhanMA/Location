<?php

class Vehicule
{
  public $id;
  public $brand;
  public $model;
  public $horsepower;
  public $category_id;
  public $license_id;
  public $daily_price;

  public function __construct()
  {
  }

  public function getId()
  {
    return $this->id;
  }
  public function setId($value)
  {
    $this->id = $value;
  }

  public function getBrand()
  {
    return $this->brand;
  }
  public function setBrand($value)
  {
    $this->brand = $value;
  }

  public function getModel()
  {
    return $this->model;
  }
  public function setModel($value)
  {
    $this->model = $value;
  }

  public function getHorsepower()
  {
    return $this->horsepower;
  }
  public function setHorsepower($value)
  {
    $this->horsepower = $value;
  }

  public function getCategoryId()
  {
    return $this->category_id;
  }
  public function setCategoryId($value)
  {
    $this->category_id = $value;
  }

  public function getLicenseId()
  {
    return $this->license_id;
  }
  public function setLicenseId($value)
  {
    $this->license_id = $value;
  }

  public function getDailyPrice()
  {
    return $this->daily_price;
  }
  public function setDailyPrice($value)
  {
    $this->daily_price = $value;
  }
}
