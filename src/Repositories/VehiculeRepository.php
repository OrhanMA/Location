<?php

class VehiculeRepository extends Database
{

  public function getAll()
  {
    $query = 'SELECT v.id, v.brand, v.model, v.horsepower, v.daily_price, v.image_name, l.id AS license_id, l.plate, 
    GROUP_CONCAT(c.name) AS categories
    FROM vehicule AS v 
    JOIN license AS l ON v.license_id = l.id
    JOIN category_vehicule AS cv ON v.id = cv.vehicule_id
    JOIN category AS c ON cv.category_id = c.id
    GROUP BY v.id';


    $database = $this->getDb();
    $statement = $database->query($query);
    $statement->execute();
    $vehicules = $statement->fetchAll(PDO::FETCH_CLASS);
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
