<?php

class VehiculeManager{
  private $_db;

  // constructor just calls connection to database
  public function __construct($db)
  {
      $this->setDb($db);
  }

  //SETTER
  private function setDb(PDO $db)
  {
      $this->_db = $db;
  }

  // METHODS

  // checks if a vehicule exists - id or license_plate is sent
  public function vehiculeExists($value)
  {
      $selector = $this->val_type($value);
      $query = $this->_db->query('SELECT * FROM vehicules WHERE '.$selector.' = '.$value);
      $data = $query->fetch(PDO::FETCH_ASSOC);
      if ($data) {
          return true;
      } else {
          return false;
      }
  }

  // returns one vehicule if it exists (depending on its id or license plate) and creates a new instance depending on its type
  public function getVehicule($value)
  {
      $selector = $this->val_type($value);
      if ($this->vehiculeExists($value)) {
          $query = $this->_db->query('SELECT id, type, license_plate, brand, model, price, description FROM vehicules WHERE '.$selector.' = '.$value);
          $data = $query->fetch(PDO::FETCH_ASSOC);

          switch ($data['type']) {
            case 'Voiture':
              return new Voiture($data);
              break;
            case 'Moto':
              return new Moto($data);
              break;
            case 'Camion':
              return new Camion($data);
              break;
            default:
              break;
          }
      }
      return false;
  }

  // returns a list of all created vehicules
  public function getAllVehicules()
  {
      $vehicules = [];
      $query = $this->_db->query('SELECT * FROM vehicules');
      $data = $query->fetchAll(PDO::FETCH_ASSOC);

      foreach ($data as $vehicule) {
        switch ($data['type']) {
          case 'Voiture':
            $vehicules[] = new Voiture($data);
            break;
          case 'Moto':
            $vehicules[] = new Moto($data);
            break;
          case 'Camion':
            $vehicules[] = new Camion($data);
            break;
          default:
            break;
        }
      }
      return $vehicules;
  }

  // inserts a new vehicule in databse if it doesn't exist yet
  public function addVehicule(array $data)
  {
      if (!$this->vehiculeExists($data['license_plate'])) {
          $query = $this->_db->prepare('INSERT INTO vehicules(license_plate, type, brand, model, price) VALUES(:license_plate, type, brand, model, price)');
          $query->execute(array('license_plate'=>$data['license_plate'], 'type'=>$data['type'], 'brand'=>$data['brand'], 'model'=>$data['model'], 'price'=>$data['price']));
          $vehicule = $this->getVehicule($data['license_plate']);
          return $vehicule->getType().' créé.';
      }
      return false;
  }

  // removes the vehicule from the database
  public function deleteVehicule($id)
  {
      if ($this->vehiculeExists($id)) {
          $query = $this->_db->query('DELETE FROM vehicules WHERE id = '.$id);
      }
  }

  // changes the value of the character's degats in the database
  public function updateVehicule($vehicule)
  {
      $query = $this->_db->prepare('UPDATE vehicules SET brand = :brand, model = :model, price = :price, description = :description WHERE id = :id');
      $query->execute(array('id'=>$vehicule->getId(),'brand'=>$vehicule->getBrand(),'model'=>$vehicule->getModel(),'price'=>$vehicule->getPrice(),'description'=>$vehicule->getDescription()));
  }

  // returns the 'type' of sent value
  public function val_type($value)
  {
      return is_numeric($value) ? 'id' : 'license_plate';
  }

}


 ?>
