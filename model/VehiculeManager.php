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
  // checks if a vehicule exists - id is sent
  public function vehiculeExists($id)
  {
      $query = $this->_db->query('SELECT * FROM vehicules WHERE id = '.$id);
      $data = $query->fetch();
      if ($data) {
          return true;
      } else {
          return false;
      }
  }

  // returns one vehicule if it exists (depending on its id) and creates a new instance depending on its type
  public function getVehicule($id)
  {
      if ($this->vehiculeExists($id)) {
          $query = $this->_db->query('SELECT id, type, license_plate, brand, model, price, description FROM vehicules WHERE id = '.$id);
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
      $query = $this->_db->query('SELECT * FROM vehiculesœ');
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

}


 ?>
