<?php

class VehicleManager
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

    // checks if a vehicle exists - id or license_plate is sent
    public function vehicleExists($value)
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

    // returns one vehicle if it exists (depending on its id or license plate) and creates a new instance depending on its type
    public function getVehicle($value)
    {
        $selector = $this->val_type($value);
        if ($this->vehicleExists($value)) {
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

    // returns a list of all created vehicles
    public function getAllVehicles(array $checked)
    {
        $vehicles = [];
        if (count($checked)!=1) {
            $ischecked = $this->is_checked($checked);
            $query = $this->_db->query('SELECT * FROM vehicules'.$ischecked);
            $data = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($data as $vehicle) {
                switch ($vehicle['type']) {
                  case 'Car':
                    $vehicles[] = new Car($vehicle);
                    break;
                  case 'Bike':
                    $vehicles[] = new Bike($vehicle);
                    break;
                  case 'Truck':
                    $vehicles[] = new Truck($vehicle);
                    break;
                  default:
                    break;
                }
            }
        }

        return $vehicles;
    }

    // inserts a new vehicle in databse if it doesn't exist yet
    public function addVehicle($vehicle) // change to objetct
    {
        if (!$this->vehicleExists($vehicle->getLicense_plate())) {
            $query = $this->_db->prepare('INSERT INTO vehicules(license_plate, type, brand, model, price, description) VALUES(:license_plate, :type, :brand, :model, :price, :description)');
            $query->execute(array('license_plate'=>$vehicle->getLicense_plate(),
            'type'=>$vehicle->getType(),
            'brand'=>$vehicle->getBrand(),
            'model'=>$vehicle->getModel(),
            'price'=>$vehicle->getPrice(),
            'description'=>$vehicle->getDescription()));
            return 'Vehicle created.';
        }
        return 'A vehicle with this license plate already exists.';
    }

    // removes the vehicle from the database
    public function deleteVehicle($id)
    {
        if ($this->vehicleExists($id)) {
            $query = $this->_db->query('DELETE FROM vehicules WHERE id = '.$id);
        }
    }

    // changes the value of the character's degats in the database
    public function updateVehicle($vehicle)
    {
        if ($this->vehicleExists($vehicle->getId())) {
            $query = $this->_db->prepare('UPDATE vehicules SET brand = :brand, model = :model, price = :price, description = :description WHERE id = :id');
            $query->execute(array('id'=>$vehicle->getId(),'brand'=>$vehicle->getBrand(),'model'=>$vehicle->getModel(),'price'=>$vehicle->getPrice(),'description'=>$vehicle->getDescription()));
        }
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
