<?php
    class Vehicle {
        // Common properties
        protected $brand;
        protected $model;
        protected $year;
        protected $price;

        private static $vehicleCount = 0;

        // Constructor
        public function __construct($brand, $model, $year, $price)
        {
            $this->brand = $brand;
            $this->model = $model;
            $this->year = $year;
            $this->price = $price;

            // Increment static counter whenever a new vehicle is created
            self::$vehicleCount++;
        }
        // Method to display vehicle info
        public function displayInfo()
        {
            echo "Brand: {$this->brand}, Model: {$this->model}, Year: {$this->year}, Price: {$this->price}\n";
        }
    }
?>