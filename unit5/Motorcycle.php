<?php
require_once 'Vehicle.php';

/**
 * Motorcycle Class
 * Extends Vehicle with motorcycle-specific properties
 */
class Motorcycle extends Vehicle {
    // Unique property for Motorcycle
    private $handlebarType;
    
    // Constructor
    public function __construct($brand, $model, $year, $price, $handlebarType) {
        parent::__construct($brand, $model, $year, $price);
        $this->handlebarType = $handlebarType;
    }
    
    // Getter for unique property
    public function getHandlebarType() {
        return $this->handlebarType;
    }
    
    // Override displayInfo method to include motorcycle-specific details
    public function displayInfo() {
        $baseInfo = parent::displayInfo();
        return $baseInfo . "<br>
                <strong>Type:</strong> Motorcycle<br>
                <strong>Handlebar Type:</strong> {$this->handlebarType}";
    }
}
?>