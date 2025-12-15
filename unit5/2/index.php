<?php

// Base class for all vehicles, containing common properties and methods
class Vehicle {
    // Common properties for all vehicles
    protected $brand;
    protected $model;
    protected $year;
    protected $price;
    
    // Static property to keep track of the total number of vehicle instances created
    public static $count = 0;

    // Constructor to initialize common properties and increment the count
    public function __construct($brand, $model, $year, $price) {
        $this->brand = $brand;
        $this->model = $model;
        $this->year = $year;
        $this->price = $price;
        self::$count++;  // Increment the static counter each time a new vehicle is created
    }

    // Method to display basic vehicle information
    public function displayInfo() {
        echo "Brand: " . $this->brand . ", Model: " . $this->model . ", Year: " . $this->year . ", Price: $" . $this->price;
    }

    // Method to compare this vehicle with another based on a criterion (price or year)
    // Returns -1 if this is less, 0 if equal, 1 if greater
    public function compareTo($other, $criterion = 'price') {
        if ($criterion == 'price') {
            return $this->price <=> $other->price;
        } elseif ($criterion == 'year') {
            return $this->year <=> $other->year;
        }
        return 0;  // Default return if criterion is invalid
    }
}

// Subclass for Cars, extending Vehicle with car-specific properties
class Car extends Vehicle {
    // Unique property for cars: number of doors
    protected $numberOfDoors;

    // Constructor to initialize car-specific properties along with parent
    public function __construct($brand, $model, $year, $price, $numberOfDoors) {
        parent::__construct($brand, $model, $year, $price);
        $this->numberOfDoors = $numberOfDoors;
    }

    // Overridden method to display car info, including parent info and unique details
    public function displayInfo() {
        parent::displayInfo();
        echo ", Number of Doors: " . $this->numberOfDoors;
    }
}

// Subclass for Trucks, extending Vehicle with truck-specific properties
class Truck extends Vehicle {
    // Unique property for trucks: cargo capacity in lbs
    protected $cargoCapacity;

    // Constructor to initialize truck-specific properties along with parent
    public function __construct($brand, $model, $year, $price, $cargoCapacity) {
        parent::__construct($brand, $model, $year, $price);
        $this->cargoCapacity = $cargoCapacity;
    }

    // Overridden method to display truck info, including parent info and unique details
    public function displayInfo() {
        parent::displayInfo();
        echo ", Cargo Capacity: " . $this->cargoCapacity . " lbs";
    }
}

// Subclass for Motorcycles, extending Vehicle with motorcycle-specific properties
class Motorcycle extends Vehicle {
    // Unique property for motorcycles: type of handlebars
    protected $handlebarType;

    // Constructor to initialize motorcycle-specific properties along with parent
    public function __construct($brand, $model, $year, $price, $handlebarType) {
        parent::__construct($brand, $model, $year, $price);
        $this->handlebarType = $handlebarType;
    }

    // Overridden method to display motorcycle info, including parent info and unique details
    public function displayInfo() {
        parent::displayInfo();
        echo ", Handlebar Type: " . $this->handlebarType;
    }
}

// Process form submission if the request method is POST (i.e., form was submitted)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve common form data
    $type = $_POST['type'] ?? '';
    $brand = $_POST['brand'] ?? '';
    $model = $_POST['model'] ?? '';
    $year = $_POST['year'] ?? 0;
    $price = $_POST['price'] ?? 0;

    $vehicle = null;  // Variable to hold the new vehicle object

    // Create the appropriate subclass based on the selected type
    if ($type == 'car') {
        $numberOfDoors = $_POST['numberOfDoors'] ?? 0;
        $vehicle = new Car($brand, $model, $year, $price, $numberOfDoors);
    } elseif ($type == 'truck') {
        $cargoCapacity = $_POST['cargoCapacity'] ?? 0;
        $vehicle = new Truck($brand, $model, $year, $price, $cargoCapacity);
    } elseif ($type == 'motorcycle') {
        $handlebarType = $_POST['handlebarType'] ?? '';
        $vehicle = new Motorcycle($brand, $model, $year, $price, $handlebarType);
    }

    // If a vehicle was created, display its information
    if ($vehicle) {
        echo "<h2>New Vehicle Added:</h2>";
        $vehicle->displayInfo();
        echo "<br><br>";
    }
}

// Sample data instantiation to demonstrate the classes
$sampleCar = new Car('Toyota', 'Camry', 2020, 25000, 4);  // Create a sample Car object
$sampleTruck = new Truck('Ford', 'F-150', 2019, 35000, 2000);  // Create a sample Truck object
$sampleMotorcycle = new Motorcycle('Honda', 'CBR', 2021, 15000, 'Clip-on');  // Create a sample Motorcycle object

// Display sample vehicles
echo "<h2>Sample Vehicles:</h2>";
$sampleCar->displayInfo();
echo "<br>";
$sampleTruck->displayInfo();
echo "<br>";
$sampleMotorcycle->displayInfo();
echo "<br><br>";

// Display the total number of vehicles created (including samples and any added via form)
echo "Total vehicles created: " . Vehicle::$count . "<br><br>";

// Demonstrate the comparison method
echo "Comparing sample car and truck by price: " . $sampleCar->compareTo($sampleTruck, 'price') . "<br>";
echo "Comparing sample car and truck by year: " . $sampleCar->compareTo($sampleTruck, 'year') . "<br><br>";

?>