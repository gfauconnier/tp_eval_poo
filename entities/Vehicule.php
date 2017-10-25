<?php

/**
 *
 */
class Vehicule
{
    protected $id;
    protected $type;
    protected $license_plate;
    protected $brand;
    protected $model;
    protected $price;
    protected $description;

// constructor
    public function __construct($data)
    {
        $this->hydrate($data);
        $this->type = static::class;
    }

// hydratation
    public function hydrate(array $data)
    {
      foreach ($data as $key => $value) {
          $method = 'set'.ucfirst($key);
          if (method_exists($this, $method)) {
              $this->$method($value);
          }
      }
    }

// GETTERS and SETTERS
    /**
     * Get the value of Id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }    /**
     * Set the value of Id
     *
     * @param mixed id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get the value of Type
     *
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }    /**
     * Set the value of Type
     *
     * @param mixed type
     *
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Get the value of License Plate
     *
     * @return mixed
     */
    public function getLicensePlate()
    {
        return $this->license_plate;
    }    /**
     * Set the value of License Plate
     *
     * @param mixed license_plate
     *
     * @return self
     */
    public function setLicensePlate($license_plate)
    {
        $this->license_plate = $license_plate;
    }

    /**
     * Get the value of Brand
     *
     * @return mixed
     */
    public function getBrand()
    {
        return $this->brand;
    }    /**
     * Set the value of Brand
     *
     * @param mixed brand
     *
     * @return self
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    /**
     * Get the value of Model
     *
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }    /**
     * Set the value of Model
     *
     * @param mixed model
     *
     * @return self
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * Get the value of Price
     *
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }    /**
     * Set the value of Price
     *
     * @param mixed price
     *
     * @return self
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * Get the value of Description
     *
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }    /**
     * Set the value of Description
     *
     * @param mixed description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
}
