<?php

class VehiculeRepository extends Database
{
  public function test()
  {
    return 'test';
  }

  public function getAll()
  {
    $query = 'SELECT * FROM vehicule';
    $database = $this->getDb();
    $statement = $database->query($query);
    $statement->execute();
    $vehicules = $statement->fetchAll(PDO::FETCH_CLASS, Vehicule::class);
    return $vehicules;
  }

  public function getById($id)
  {
    $query = 'SELECT * FROM vehicule WHERE id = :id';
    $database = $this->getDb();
    $statement = $database->prepare($query);
    $statement->bindParam('id', $id);
    $statement->execute();
    $vehicule = $statement->fetch(PDO::FETCH_ASSOC);
    return $vehicule;
  }
}
