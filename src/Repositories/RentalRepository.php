<?php

class RentalRepository extends Database
{

  public function getAll()
  {
    $query = 'SELECT * FROM rental';
    $database = $this->getDb();
    $statement = $database->query($query);
    $statement->execute();
    $rentals = $statement->fetchAll(PDO::FETCH_CLASS, Rental::class);
    return $rentals;
  }

  public function getById($id)
  {
    $query = 'SELECT * FROM rental WHERE id = :id';
    $database = $this->getDb();
    $statement = $database->prepare($query);
    $statement->bindParam('id', $id);
    $statement->execute();
    $rental = $statement->fetch(PDO::FETCH_ASSOC);
    return $rental;
  }

  public function create($start_date, $end_date, $vehicule_id, $user_id)
  {
    $database = $this->getDb();
    $uuid = new UUID();
    $id = $uuid::v4();
    $query = 'INSERT INTO rental (id, start_date, end_date, vehicule_id, user_id) VALUES (:id, :start_date, :end_date, :vehicule_id, :user_id)';

    $statement = $database->prepare($query);
    $statement->bindParam('id', $id);
    $statement->bindParam('start_date', $start_date);
    $statement->bindParam('end_date', $end_date);
    $statement->bindParam('vehicule_id', $vehicule_id);
    $statement->bindParam('user_id', $user_id);
    $statement->execute();
  }

  public function update($rental_id, $start_date, $end_date, $vehicule_id, $user_id)
  {
    $database = $this->getDb();
    $query = 'UPDATE rental SET (start_date, end_date, vehicule_id, user_id) VALUES (start_date=:start_date, end_date=:end_date, vehicule_id=:vehicule_id, user_id=:user_id) WHERE id=:id';
    $statement = $database->prepare($query);
    $statement->bindParam('id', $rental_id);
    $statement->bindParam('start_date', $start_date);
    $statement->bindParam('end_date', $end_date);
    $statement->bindParam('vehicule_id', $vehicule_id);
    $statement->bindParam('user_id', $user_id);
    $statement->execute();
  }

  public function delete($id)
  {
    $query = "DELETE FROM rental WHERE id=:id";
    $database = $this->getDb();
    $statement = $database->prepare($query);
    $statement->bindParam('id', $id);
    $statement->execute();
  }
}
