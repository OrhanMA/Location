<?php

class Vehicule
{
  private $id;
  private $brand;
  private $model;
  private $horsepower;
  private $category_id;
  private $license_id;
  private $daily_price;

  public function __construct($id, $brand, $model, $horsepower, $category_id, $license_id, $daily_price)
  {
    $this->id = $id;
    $this->brand = $brand;
    $this->model = $model;
    $this->horsepower = $horsepower;
    $this->category_id = $category_id;
    $this->license_id = $license_id;
    $this->daily_price = $daily_price;
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
