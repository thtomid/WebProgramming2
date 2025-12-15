<?php
/**
 * Base Vehicle Class
 * Contains common properties and methods for all vehicles
 */
class Vehicle {
    // Common properties
    protected $brand;
    protected $model;
    protected $year;
    protected $price;
    
    // Static property to count total vehicle instances
    public static $totalVehicles = 0;
    
    // Constructor
    public function __construct($brand, $model, $year, $price) {
        $this->brand = $brand;
        $this->model = $model;
        $this->year = $year;
        $this->price = $price;
        
        // Increment the static counter
        self::$totalVehicles++;
    }
    
    // Getter methods
    public function getBrand() {
        return $this->brand;
    }
    
    public function getModel() {
        return $this->model;
    }
    
    public function getYear() {
        return $this->year;
    }
    
    public function getPrice() {
        return $this->price;
    }
    
    // Method to display vehicle information
    public function displayInfo() {
        return "<strong>Brand:</strong> {$this->brand}<br>
                <strong>Model:</strong> {$this->model}<br>
                <strong>Year:</strong> {$this->year}<br>
                <strong>Price:</strong> $" . number_format($this->price, 2);
    }
    
    // Static method to get total vehicle count
    public static function getTotalVehicles() {
        return self::$totalVehicles;
    }
    
    // Method to compare vehicles based on a criterion
    public function compare(Vehicle $otherVehicle, $criterion = 'price') {
        switch ($criterion) {
            case 'price':
                if ($this->price > $otherVehicle->getPrice()) {
                    return "{$this->brand} {$this->model} is more expensive than {$otherVehicle->getBrand()} {$otherVehicle->getModel()} by $" . number_format($this->price - $otherVehicle->getPrice(), 2);
                } elseif ($this->price < $otherVehicle->getPrice()) {
                    return "{$this->brand} {$this->model} is cheaper than {$otherVehicle->getBrand()} {$otherVehicle->getModel()} by $" . number_format($otherVehicle->getPrice() - $this->price, 2);
                } else {
                    return "{$this->brand} {$this->model} and {$otherVehicle->getBrand()} {$otherVehicle->getModel()} have the same price";
                }
                
            case 'year':
                if ($this->year > $otherVehicle->getYear()) {
                    return "{$this->brand} {$this->model} is newer than {$otherVehicle->getBrand()} {$otherVehicle->getModel()} by " . ($this->year - $otherVehicle->getYear()) . " years";
                } elseif ($this->year < $otherVehicle->getYear()) {
                    return "{$this->brand} {$this->model} is older than {$otherVehicle->getBrand()} {$otherVehicle->getModel()} by " . ($otherVehicle->getYear() - $this->year) . " years";
                } else {
                    return "{$this->brand} {$this->model} and {$otherVehicle->getBrand()} {$otherVehicle->getModel()} are from the same year";
                }
                
            default:
                return "Invalid comparison criterion. Use 'price' or 'year'.";
        }
    }
}
?>