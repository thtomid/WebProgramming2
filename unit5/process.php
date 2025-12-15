<?php
// Include all vehicle classes
require_once 'Vehicle.php';
require_once 'Car.php';
require_once 'Truck.php';
require_once 'Motorcycle.php';

// Start the HTML output
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Added - Car Dealership</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>🚗 Vehicle Successfully Added!</h1>
            <p>Your new vehicle has been added to the dealership inventory</p>
        </header>
        
        <div class="content">
            <div class="result-container">
                <?php
                // Check if form was submitted
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Get form data
                    $vehicleType = $_POST['vehicleType'] ?? '';
                    $brand = $_POST['brand'] ?? '';
                    $model = $_POST['model'] ?? '';
                    $year = $_POST['year'] ?? '';
                    $price = $_POST['price'] ?? '';
                    
                    // Validate required fields
                    if (empty($vehicleType) || empty($brand) || empty($model) || empty($year) || empty($price)) {
                        echo "<div class='error'>Please fill in all required fields.</div>";
                        echo "<a href='index.php' class='btn-back'>Go Back to Form</a>";
                        exit();
                    }
                    
                    // Create the appropriate vehicle object based on type
                    $newVehicle = null;
                    
                    switch ($vehicleType) {
                        case 'car':
                            $numberOfDoors = $_POST['numberOfDoors'] ?? 4;
                            $newVehicle = new Car($brand, $model, $year, $price, $numberOfDoors);
                            break;
                            
                        case 'truck':
                            $cargoCapacity = $_POST['cargoCapacity'] ?? 5.0;
                            $newVehicle = new Truck($brand, $model, $year, $price, $cargoCapacity);
                            break;
                            
                        case 'motorcycle':
                            $handlebarType = $_POST['handlebarType'] ?? 'Standard';
                            $newVehicle = new Motorcycle($brand, $model, $year, $price, $handlebarType);
                            break;
                            
                        default:
                            echo "<div class='error'>Invalid vehicle type selected.</div>";
                            echo "<a href='index.php' class='btn-back'>Go Back to Form</a>";
                            exit();
                    }
                    
                    // Display the newly created vehicle
                    echo "<h2>New Vehicle Details</h2>";
                    echo "<div class='vehicle-details'>";
                    echo $newVehicle->displayInfo();
                    echo "</div>";
                    
                    // Display total vehicle count
                    echo "<div class='vehicle-count'>";
                    echo "<h3>Inventory Updated</h3>";
                    echo "<p>Total vehicles in the system now: <strong>" . Vehicle::getTotalVehicles() . "</strong></p>";
                    echo "</div>";
                    
                    // Comparison with a sample vehicle
                    echo "<div class='comparison'>";
                    echo "<h3>Comparison with Sample Vehicle</h3>";
                    
                    // Create a sample vehicle for comparison
                    $sampleVehicle = new Car("Toyota", "Camry", 2022, 28500.00, 4);
                    
                    echo "<p><strong>Price Comparison:</strong> " . $newVehicle->compare($sampleVehicle, 'price') . "</p>";
                    echo "<p><strong>Year Comparison:</strong> " . $newVehicle->compare($sampleVehicle, 'year') . "</p>";
                    echo "</div>";
                    
                } else {
                    echo "<div class='error'>No form data submitted.</div>";
                }
                ?>
                
                <div class="action-buttons">
                    <a href="index.php" class="btn-back">Add Another Vehicle</a>
                    <a href="index.php#sample-vehicles" class="btn-view">View All Vehicles</a>
                </div>
            </div>
        </div>
        
        <footer>
            <p>Car Dealership Vehicle Management System &copy; 2023</p>
        </footer>
    </div>
</body>
</html>