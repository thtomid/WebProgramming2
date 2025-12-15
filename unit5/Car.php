<?php
require_once 'Vehicle.php';

/**
 * Car Class
 * Extends Vehicle with car-specific properties
 */
class Car extends Vehicle {
    // Unique property for Car
    private $numberOfDoors;
    
    // Constructor
    public function __construct($brand, $model, $year, $price, $numberOfDoors) {
        parent::__construct($brand, $model, $year, $price);
        $this->numberOfDoors = $numberOfDoors;
    }
    
    // Getter for unique property
    public function getNumberOfDoors() {
        return $this->numberOfDoors;
    }
    
    // Override displayInfo method to include car-specific details
    public function displayInfo() {
        $baseInfo = parent::displayInfo();
        return $baseInfo . "<br>
                <strong>Type:</strong> Car<br>
                <strong>Number of Doors:</strong> {$this->numberOfDoors}";
    }
}
?>