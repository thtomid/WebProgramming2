<?php
require_once 'Vehicle.php';

/**
 * Truck Class
 * Extends Vehicle with truck-specific properties
 */
class Truck extends Vehicle {
    // Unique property for Truck
    private $cargoCapacity; // in tons
    
    // Constructor
    public function __construct($brand, $model, $year, $price, $cargoCapacity) {
        parent::__construct($brand, $model, $year, $price);
        $this->cargoCapacity = $cargoCapacity;
    }
    
    // Getter for unique property
    public function getCargoCapacity() {
        return $this->cargoCapacity;
    }
    
    // Override displayInfo method to include truck-specific details
    public function displayInfo() {
        $baseInfo = parent::displayInfo();
        return $baseInfo . "<br>
                <strong>Type:</strong> Truck<br>
                <strong>Cargo Capacity:</strong> {$this->cargoCapacity} tons";
    }
}
?>