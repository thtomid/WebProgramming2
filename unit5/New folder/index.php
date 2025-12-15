<?php
// Start of PHP code (this should be placed at the top of the file, after the HTML header)

// Base Vehicle Class
class Vehicle {
    // Common properties
    protected $brand;
    protected $model;
    protected $year;
    protected $price;
    protected $id;
    
    // Static property to count total vehicle instances
    private static $totalVehicles = 0;
    
    // Constructor
    public function __construct($brand, $model, $year, $price) {
        $this->brand = $brand;
        $this->model = $model;
        $this->year = $year;
        $this->price = $price;
        
        // Increment total vehicles and assign ID
        self::$totalVehicles++;
        $this->id = self::$totalVehicles;
    }
    
    // Getter methods
    public function getBrand() { return $this->brand; }
    public function getModel() { return $this->model; }
    public function getYear() { return $this->year; }
    public function getPrice() { return $this->price; }
    public function getId() { return $this->id; }
    
    // Static method to get total vehicles count
    public static function getTotalVehicles() {
        return self::$totalVehicles;
    }
    
    // Display vehicle information (to be overridden by subclasses)
    public function displayInfo() {
        return "<div class='detail-item'><span class='detail-label'>Brand:</span> <span class='detail-value'>{$this->brand}</span></div>
                <div class='detail-item'><span class='detail-label'>Model:</span> <span class='detail-value'>{$this->model}</span></div>
                <div class='detail-item'><span class='detail-label'>Year:</span> <span class='detail-value'>{$this->year}</span></div>
                <div class='detail-item'><span class='detail-label'>Price:</span> <span class='detail-value'>$" . number_format($this->price, 2) . "</span></div>";
    }
    
    // Method to compare vehicles based on a selected criterion
    public static function compareVehicles($vehicle1, $vehicle2, $criterion) {
        if ($criterion === 'price') {
            if ($vehicle1->price > $vehicle2->price) {
                return "{$vehicle1->brand} {$vehicle1->model} (\${$vehicle1->price}) is more expensive than {$vehicle2->brand} {$vehicle2->model} (\${$vehicle2->price}) by $" . ($vehicle1->price - $vehicle2->price);
            } elseif ($vehicle1->price < $vehicle2->price) {
                return "{$vehicle2->brand} {$vehicle2->model} (\${$vehicle2->price}) is more expensive than {$vehicle1->brand} {$vehicle1->model} (\${$vehicle1->price}) by $" . ($vehicle2->price - $vehicle1->price);
            } else {
                return "Both vehicles have the same price: \${$vehicle1->price}";
            }
        } elseif ($criterion === 'year') {
            if ($vehicle1->year > $vehicle2->year) {
                return "{$vehicle1->brand} {$vehicle1->model} ({$vehicle1->year}) is newer than {$vehicle2->brand} {$vehicle2->model} ({$vehicle2->year}) by " . ($vehicle1->year - $vehicle2->year) . " years";
            } elseif ($vehicle1->year < $vehicle2->year) {
                return "{$vehicle2->brand} {$vehicle2->model} ({$vehicle2->year}) is newer than {$vehicle1->brand} {$vehicle1->model} ({$vehicle1->year}) by " . ($vehicle2->year - $vehicle1->year) . " years";
            } else {
                return "Both vehicles are from the same year: {$vehicle1->year}";
            }
        } else {
            return "Invalid comparison criterion";
        }
    }
}

// Car Subclass
class Car extends Vehicle {
    // Unique property for Car
    private $numberOfDoors;
    
    // Constructor
    public function __construct($brand, $model, $year, $price, $numberOfDoors) {
        parent::__construct($brand, $model, $year, $price);
        $this->numberOfDoors = $numberOfDoors;
    }
    
    // Getter for unique property
    public function getNumberOfDoors() { return $this->numberOfDoors; }
    
    // Override displayInfo method to include car-specific details
    public function displayInfo() {
        $baseInfo = parent::displayInfo();
        $carInfo = "<div class='detail-item'><span class='detail-label'>Doors:</span> <span class='detail-value'>{$this->numberOfDoors}</span></div>";
        
        return "<div class='vehicle-type car-type'>Car</div><div class='vehicle-details'>" . $baseInfo . $carInfo . "</div>";
    }
}

// Truck Subclass
class Truck extends Vehicle {
    // Unique property for Truck
    private $cargoCapacity;
    
    // Constructor
    public function __construct($brand, $model, $year, $price, $cargoCapacity) {
        parent::__construct($brand, $model, $year, $price);
        $this->cargoCapacity = $cargoCapacity;
    }
    
    // Getter for unique property
    public function getCargoCapacity() { return $this->cargoCapacity; }
    
    // Override displayInfo method to include truck-specific details
    public function displayInfo() {
        $baseInfo = parent::displayInfo();
        $truckInfo = "<div class='detail-item'><span class='detail-label'>Cargo Capacity:</span> <span class='detail-value'>" . number_format($this->cargoCapacity) . " lbs</span></div>";
        
        return "<div class='vehicle-type truck-type'>Truck</div><div class='vehicle-details'>" . $baseInfo . $truckInfo . "</div>";
    }
}

// Motorcycle Subclass
class Motorcycle extends Vehicle {
    // Unique property for Motorcycle
    private $handlebarType;
    
    // Constructor
    public function __construct($brand, $model, $year, $price, $handlebarType) {
        parent::__construct($brand, $model, $year, $price);
        $this->handlebarType = $handlebarType;
    }
    
    // Getter for unique property
    public function getHandlebarType() { return $this->handlebarType; }
    
    // Override displayInfo method to include motorcycle-specific details
    public function displayInfo() {
        $baseInfo = parent::displayInfo();
        $motorcycleInfo = "<div class='detail-item'><span class='detail-label'>Handlebar Type:</span> <span class='detail-value'>{$this->handlebarType}</span></div>";
        
        return "<div class='vehicle-type motorcycle-type'>Motorcycle</div><div class='vehicle-details'>" . $baseInfo . $motorcycleInfo . "</div>";
    }
}

// Sample vehicle data and object instantiation
$sampleVehicles = [];

// Create sample car
$sampleCar = new Car("Toyota", "Camry", 2022, 26500, 4);
$sampleVehicles[] = $sampleCar;

// Create sample truck
$sampleTruck = new Truck("Ford", "F-150", 2023, 38500, 3200);
$sampleVehicles[] = $sampleTruck;

// Create sample motorcycle
$sampleMotorcycle = new Motorcycle("Harley-Davidson", "Sportster", 2021, 12500, "Ape Hanger");
$sampleVehicles[] = $sampleMotorcycle;

// Additional sample vehicles
$sampleVehicles[] = new Car("Honda", "Civic", 2023, 24500, 4);
$sampleVehicles[] = new Truck("Chevrolet", "Silverado", 2022, 42000, 3500);
$sampleVehicles[] = new Motorcycle("Yamaha", "YZF-R3", 2023, 5200, "Clip-on");

// Array to store user-added vehicles
$userVehicles = [];

// Process form submission for adding a new vehicle
if (isset($_POST['submit'])) {
    $vehicleType = $_POST['vehicleType'] ?? '';
    $brand = $_POST['brand'] ?? '';
    $model = $_POST['model'] ?? '';
    $year = $_POST['year'] ?? '';
    $price = $_POST['price'] ?? '';
    
    // Validate required fields
    if (!empty($vehicleType) && !empty($brand) && !empty($model) && !empty($year) && !empty($price)) {
        // Create the appropriate vehicle object based on type
        switch ($vehicleType) {
            case 'Car':
                $numberOfDoors = $_POST['numberOfDoors'] ?? 4;
                $newVehicle = new Car($brand, $model, $year, $price, $numberOfDoors);
                break;
            case 'Truck':
                $cargoCapacity = $_POST['cargoCapacity'] ?? 2000;
                $newVehicle = new Truck($brand, $model, $year, $price, $cargoCapacity);
                break;
            case 'Motorcycle':
                $handlebarType = $_POST['handlebarType'] ?? 'Standard';
                $newVehicle = new Motorcycle($brand, $model, $year, $price, $handlebarType);
                break;
            default:
                $newVehicle = null;
                break;
        }
        
        if ($newVehicle) {
            $userVehicles[] = $newVehicle;
            $successMessage = "Successfully added a new {$vehicleType} to the inventory!";
        }
    }
}

// Process vehicle comparison
$comparisonResult = '';
if (isset($_POST['compare'])) {
    $vehicle1Id = $_POST['compareVehicle1'] ?? 0;
    $vehicle2Id = $_POST['compareVehicle2'] ?? 0;
    $criterion = $_POST['comparisonCriterion'] ?? 'price';
    
    // Combine sample and user vehicles
    $allVehicles = array_merge($sampleVehicles, $userVehicles);
    
    // Find the vehicles by ID
    $vehicle1 = null;
    $vehicle2 = null;
    
    foreach ($allVehicles as $vehicle) {
        if ($vehicle->getId() == $vehicle1Id) {
            $vehicle1 = $vehicle;
        }
        if ($vehicle->getId() == $vehicle2Id) {
            $vehicle2 = $vehicle;
        }
    }
    
    // Compare if both vehicles are found
    if ($vehicle1 && $vehicle2) {
        $comparisonResult = Vehicle::compareVehicles($vehicle1, $vehicle2, $criterion);
    } elseif ($vehicle1 || $vehicle2) {
        $comparisonResult = "Please enter valid IDs for both vehicles to compare.";
    } else {
        $comparisonResult = "No vehicles found with the provided IDs.";
    }
}

// Combine all vehicles for display
$allVehicles = array_merge($sampleVehicles, $userVehicles);
?>

<!-- The HTML form code from above goes here, but we need to insert PHP output in specific places -->

<?php
// Now we need to output the PHP-generated content in the appropriate places
// We'll do this by echoing the content where needed in the HTML

// Start output buffering to capture the entire page
ob_start();
?>

<!-- We'll insert the HTML form here, but with PHP code to output dynamic content -->
<!-- The complete HTML is above, but we need to add PHP snippets in strategic locations -->

<?php
// We'll output the sample vehicles
echo '<script>';
echo 'document.addEventListener("DOMContentLoaded", function() {';
echo 'const sampleContainer = document.getElementById("sampleVehiclesContainer");';
echo 'if (sampleContainer) {';
echo 'sampleContainer.innerHTML = `';

foreach ($sampleVehicles as $vehicle) {
    echo '<div class="vehicle-card">';
    echo '<h3>#' . $vehicle->getId() . ' - ' . $vehicle->getBrand() . ' ' . $vehicle->getModel() . '</h3>';
    echo $vehicle->displayInfo();
    echo '</div>';
}

echo '`;';
echo '}';
echo '});';
echo '</script>';

// Output user-added vehicles and inventory
echo '<script>';
echo 'document.addEventListener("DOMContentLoaded", function() {';
echo 'const inventoryContainer = document.getElementById("inventoryResults");';
echo 'if (inventoryContainer) {';
echo 'inventoryContainer.innerHTML = `';

echo '<h2>Vehicle Inventory</h2>';
echo '<p>Total vehicles in inventory: ' . Vehicle::getTotalVehicles() . '</p>';

if (!empty($userVehicles)) {
    echo '<h3>User-Added Vehicles</h3>';
    foreach ($userVehicles as $vehicle) {
        echo '<div class="vehicle-card">';
        echo '<h3>#' . $vehicle->getId() . ' - ' . $vehicle->getBrand() . ' ' . $vehicle->getModel() . '</h3>';
        echo $vehicle->displayInfo();
        echo '</div>';
    }
}

if (isset($successMessage)) {
    echo '<div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin: 15px 0;">';
    echo $successMessage;
    echo '</div>';
}

echo '`;';
echo '}';
echo '});';
echo '</script>';

// Output comparison results
echo '<script>';
echo 'document.addEventListener("DOMContentLoaded", function() {';
echo 'const comparisonContainer = document.getElementById("comparisonResults");';
echo 'if (comparisonContainer && "' . ($comparisonResult ? 'true' : 'false') . '" === "true") {';
echo 'comparisonContainer.innerHTML = `<div style="margin-top: 15px; padding: 15px; background-color: #e8f4fc; border-radius: 5px; border-left: 4px solid #3498db;">';
echo '<h4>Comparison Result</h4>';
echo '<p>' . htmlspecialchars($comparisonResult) . '</p>';
echo '</div>`;';
echo '}';
echo '});';
echo '</script>';

// Output statistics
echo '<script>';
echo 'document.addEventListener("DOMContentLoaded", function() {';
echo 'const statsContainer = document.getElementById("statsContainer");';
echo 'if (statsContainer) {';
echo 'statsContainer.innerHTML = `';
echo '<p>Total Vehicles Created: ' . Vehicle::getTotalVehicles() . '</p>';

// Count vehicles by type
$carCount = 0;
$truckCount = 0;
$motorcycleCount = 0;

foreach ($allVehicles as $vehicle) {
    if ($vehicle instanceof Car) {
        $carCount++;
    } elseif ($vehicle instanceof Truck) {
        $truckCount++;
    } elseif ($vehicle instanceof Motorcycle) {
        $motorcycleCount++;
    }
}

echo '<p>Cars: ' . $carCount . ' | Trucks: ' . $truckCount . ' | Motorcycles: ' . $motorcycleCount . '</p>';

// Calculate average price
$totalPrice = 0;
foreach ($allVehicles as $vehicle) {
    $totalPrice += $vehicle->getPrice();
}
$averagePrice = count($allVehicles) > 0 ? $totalPrice / count($allVehicles) : 0;

echo '<p>Average Vehicle Price: $' . number_format($averagePrice, 2) . '</p>';
echo '`;';
echo '}';
echo '});';
echo '</script>';

// End output buffering and display the page
ob_end_flush();
?>