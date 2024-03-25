<?php

class LicenseRepository extends Database
{

  public function getAll()
  {
    $query = 'SELECT * FROM license';
    $database = $this->getDb();
    $statement = $database->query($query);
    $statement->execute();
    $licenses = $statement->fetchAll(PDO::FETCH_CLASS, License::class);
    return $licenses;
  }

  public function getById($id)
  {
    $query = 'SELECT * FROM license WHERE id = :id';
    $database = $this->getDb();
    $statement = $database->prepare($query);
    $statement->bindParam('id', $id);
    $statement->execute();
    $license = $statement->fetch(PDO::FETCH_ASSOC);
    return $license;
  }
}
