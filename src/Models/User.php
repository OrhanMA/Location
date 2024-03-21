<?php

class User
{
  private $id;
  private $full_name;
  private $email;
  private $phone;
  private $password;

  public function __construct($id, $full_name, $email, $phone, $password)
  {
    $this->id = $id;
    $this->full_name = $full_name;
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

  public function getFullname()
  {
    return $this->full_name;
  }
  public function setFullname($value)
  {
    $this->full_name = $value;
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
