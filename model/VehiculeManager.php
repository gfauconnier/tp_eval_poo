<?php

class VehiculeManager
{
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
        $query = $this->_db->query('SELECT * FROM vehicules WHERE '.$selector.' = \''.$value.'\'');
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
            $query = $this->_db->query('SELECT * FROM vehicules WHERE '.$selector.' = '.$value);
            $data = $query->fetch(PDO::FETCH_ASSOC);

            switch ($data['type']) {
            case 'Car':
              return new Car($data);
              break;
            case 'Bike':
              return new Bike($data);
              break;
            case 'Truck':
              return new Truck($data);
              break;
            default:
              return 'dafuk';
              break;
          }
        }
        return false;
    }

    // returns a list of all created vehicules
    public function getAllVehicules(array $checked)
    {
        $vehicules = [];
        if (count($checked)!=1) {
            $ischecked = $this->is_checked($checked);
            $query = $this->_db->query('SELECT * FROM vehicules'.$ischecked);
            $data = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($data as $vehicule) {
                switch ($vehicule['type']) {
                  case 'Car':
                    $vehicules[] = new Car($vehicule);
                    break;
                  case 'Bike':
                    $vehicules[] = new Bike($vehicule);
                    break;
                  case 'Truck':
                    $vehicules[] = new Truck($vehicule);
                    break;
                  default:
                    break;
                }
            }
        }

        return $vehicules;
    }

    // inserts a new vehicule in databse if it doesn't exist yet
    public function addVehicule(array $data)
    {
        if (!$this->vehiculeExists($data['license_plate'])) {
            $query = $this->_db->prepare('INSERT INTO vehicules(license_plate, type, brand, model, price) VALUES(:license_plate, :type, :brand, :model, :price)');
            $query->execute(array('license_plate'=>$data['license_plate'], 'type'=>$data['type'], 'brand'=>$data['brand'], 'model'=>$data['model'], 'price'=>$data['price']));
            return 'Vehicule created.';
        }
        return 'A vehicule with this license plate already exists.';
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

    // returns a string to add to get all query
    public function is_checked(array $checked)
    {
      $add_to_query = '';
      switch (count($checked)) {
        case 2:
          $add_to_query = ' WHERE type = \''.$checked[0].'\'';
          break;
        case 3:
          $add_to_query = ' WHERE type = \''.$checked[0].'\' OR type = \''.$checked[1].'\'';
          break;
        case 4:
        default:
          break;
      }
      return $add_to_query;
    }
}
