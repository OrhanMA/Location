<?php

require_once __DIR__ . './../Classes/UUID.php';

class UserRepository extends Database
{

  public function getAll()
  {
    $query = 'SELECT * FROM user';
    $database = $this->getDb();
    $statement = $database->query($query);
    $statement->execute();
    $users = $statement->fetchAll(PDO::FETCH_CLASS, User::class);
    return $users;
  }

  public function getById($id)
  {
    $query = 'SELECT * FROM user WHERE id = :id';
    $database = $this->getDb();
    $statement = $database->prepare($query);
    $statement->bindParam('id', $id);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    return $user;
  }

  public function getByEmail($email)
  {
    $query = 'SELECT * FROM user WHERE email = :email';
    $database = $this->getDb();
    $statement = $database->prepare($query);
    $statement->bindParam('email', $email);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    return $user;
  }

  public function getUserIdByEmail($email)
  {
    $query = 'SELECT id FROM user WHERE email = :email';
    $database = $this->getDb();
    $statement = $database->prepare($query);
    $statement->bindParam('email', $email);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    return $user;
  }

  public function create($full_name, $email, $phone, $password)
  {
    $database = $this->getDb();
    $uuid = new UUID();
    $id = $uuid::v4();

    $query = 'INSERT INTO user (id, full_name, email, phone, password) VALUES (:id, :full_name, :email, :phone, :password)';

    $statement = $database->prepare($query);
    $statement->bindParam(':id', $id);
    $statement->bindParam(':full_name', $full_name);
    $statement->bindParam(':email', $email);
    $statement->bindParam(':phone', $phone);
    $statement->bindParam(':password', $password);
    $statement->execute();
  }


  public function update($id, $full_name, $email, $phone, $password)
  {
    // print_r($password);
    $database = $this->getDb();
    $query = $query = 'UPDATE user SET full_name=:full_name, email=:email, phone=:phone, password=:password WHERE id=:id';
    $statement = $database->prepare($query);
    $statement->bindParam('id', $id);
    $statement->bindParam('full_name', $full_name);
    $statement->bindParam('email', $email);
    $statement->bindParam('phone', $phone);
    $statement->bindParam('password', $password);
    $statement->execute();
  }

  public function delete($id)
  {
    $query = "DELETE FROM user WHERE id=:id";
    $database = $this->getDb();
    $statement = $database->prepare($query);
    $statement->bindParam('id', $id);
    $statement->execute();
  }
}
