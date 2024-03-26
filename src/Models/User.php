<?php

class User
{
  private $id;
  private $first_name;
  private $last_name;
  private $email;
  private $phone;
  private $password;

  public function __construct($id, $first_name, $last_name, $email, $phone, $password)
  {
    $this->id = $id;
    $this->first_name = $first_name;
    $this->last_name = $last_name;
    $this->email = $email;
    $this->phone = $phone;
    $this->password = $password;
  }


  public function getId()
  {
    return $this->id;
  }
  public function setId($value)
  {
    $this->id = $value;
  }

  public function getFirstname()
  {
    return $this->first_name;
  }
  public function setFirstname($value)
  {
    $this->first_name = $value;
  }
  public function getLastname()
  {
    return $this->last_name;
  }
  public function setLastname($value)
  {
    $this->last_name = $value;
  }

  public function getEmail()
  {
    return $this->email;
  }
  public function setEmail($value)
  {
    $this->email = $value;
  }

  public function getPhone()
  {
    return $this->phone;
  }
  public function setPhone($value)
  {
    $this->phone = $value;
  }

  public function getPassword()
  {
    return $this->password;
  }
  public function setPassword($value)
  {
    $this->password = $value;
  }
}
