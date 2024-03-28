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

  public function create($first_name, $last_name, $email, $phone, $password)
  {
    $database = $this->getDb();
    $uuid = new UUID();
    $id = $uuid::v4();

    $query = 'INSERT INTO user (id, first_name, last_name, email, phone, password) VALUES (:id, :first_name, :last_name, :email, :phone, :password)';

    $statement = $database->prepare($query);
    $statement->bindParam(':id', $id);
    $statement->bindParam(':first_name', $first_name);
    $statement->bindParam(':last_name', $last_name);
    $statement->bindParam(':email', $email);
    $statement->bindParam(':phone', $phone);
    $statement->bindParam(':password', $password);
    $statement->execute();
  }


  public function update($id, $first_name, $last_name, $email, $phone, $password)
  {
    $database = $this->getDb();
    $query = $query = 'UPDATE user SET first_name=:first_name, last_name=:last_name, email=:email, phone=:phone, password=:password WHERE id=:id';
    $statement = $database->prepare($query);
    $statement->bindParam('id', $id);
    $statement->bindParam('first_name', $first_name);
    $statement->bindParam('last_name', $last_name);
    $statement->bindParam('email', $email);
    $statement->bindParam('phone', $phone);
    $statement->bindParam('password', $password);
    $statement->execute();
  }

  public function delete($id)
  {
    // En ce qui concerne les fonctions suivantes: beginTransaction, commit et rollback: https://www.php.net/manual/fr/pdo.transactions.php
    $database = $this->getDb();
    $database->beginTransaction();

    try {
      // J'ai une relation dans rental qui m'empêche de supprimer mon compte user.
      // Je supprime donc dans la table rental tous les records du user.
      $delete_rental_query = "DELETE FROM rental WHERE user_id = :user_id";
      $rental_statement = $database->prepare($delete_rental_query);
      $rental_statement->bindParam(':user_id', $id);
      $rental_statement->execute();

      $delete_user_query = "DELETE FROM user WHERE id = :id";
      $user_statement = $database->prepare($delete_user_query);
      $user_statement->bindParam(':id', $id);
      $user_statement->execute();

      $database->commit();
    } catch (PDOException $exception) {
      $database->rollBack();
      throw $exception;
    }
  }
}
