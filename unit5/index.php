<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Dealership Vehicle Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>🚗 Car Dealership Vehicle Management System</h1>
            <p>Manage your diverse fleet of vehicles efficiently</p>
        </header>
        
        <div class="content">
            <section class="form-section">
                <h2>Add New Vehicle to Inventory</h2>
                <form action="process.php" method="POST">
                    <div class="form-group">
                        <label for="vehicleType">Vehicle Type:</label>
                        <select id="vehicleType" name="vehicleType" required onchange="toggleFields()">
                            <option value="">Select a vehicle type</option>
                            <option value="car">Car</option>
                            <option value="truck">Truck</option>
                            <option value="motorcycle">Motorcycle</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="brand">Brand:</label>
                        <input type="text" id="brand" name="brand" required placeholder="e.g., Toyota, Ford, Honda">
                    </div>
                    
                    <div class="form-group">
                        <label for="model">Model:</label>
                        <input type="text" id="model" name="model" required placeholder="e.g., Camry, F-150, Civic">
                    </div>
                    
                    <div class="form-group">
                        <label for="year">Year:</label>
                        <input type="number" id="year" name="year" required min="1900" max="2024" value="2023">
                    </div>
                    
                    <div class="form-group">
                        <label for="price">Price ($):</label>
                        <input type="number" id="price" name="price" required min="0" step="0.01" placeholder="e.g., 25000.00">
                    </div>
                    
                    <!-- Car-specific field (hidden by default) -->
                    <div class="form-group car-field" style="display: none;">
                        <label for="numberOfDoors">Number of Doors:</label>
                        <select id="numberOfDoors" name="numberOfDoors">
                            <option value="2">2 Doors</option>
                            <option value="4" selected>4 Doors</option>
                            <option value="5">5 Doors (including hatch)</option>
                        </select>
                    </div>
                    
                    <!-- Truck-specific field (hidden by default) -->
                    <div class="form-group truck-field" style="display: none;">
                        <label for="cargoCapacity">Cargo Capacity (tons):</label>
                        <input type="number" id="cargoCapacity" name="cargoCapacity" min="0.5" max="50" step="0.1" value="5.0">
                    </div>
                    
                    <!-- Motorcycle-specific field (hidden by default) -->
                    <div class="form-group motorcycle-field" style="display: none;">
                        <label for="handlebarType">Handlebar Type:</label>
                        <select id="handlebarType" name="handlebarType">
                            <option value="Standard">Standard</option>
                            <option value="Cruiser">Cruiser</option>
                            <option value="Sport">Sport</option>
                            <option value="Ape Hanger">Ape Hanger</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn-submit">Add Vehicle to Inventory</button>
                        <button type="reset" class="btn-reset">Reset Form</button>
                    </div>
                </form>
            </section>
            
            <section class="sample-vehicles">
                <h2>Sample Vehicles in Inventory</h2>
                <p>Below are sample vehicles demonstrating inheritance and method overriding:</p>
                
                <div class="sample-container">
                    <?php
                    // Include the vehicle classes
                    require_once 'Vehicle.php';
                    require_once 'Car.php';
                    require_once 'Truck.php';
                    require_once 'Motorcycle.php';
                    
                    // Reset the vehicle counter for demo purposes
                    Vehicle::$totalVehicles = 0;
                    
                    // Instantiate sample objects for each subclass
                    $sampleCar = new Car("Toyota", "Camry", 2022, 28500.00, 4);
                    $sampleTruck = new Truck("Ford", "F-150", 2023, 42000.00, 3.5);
                    $sampleMotorcycle = new Motorcycle("Harley-Davidson", "Sportster", 2021, 12999.00, "Cruiser");
                    
                    // Display sample vehicle information
                    echo "<div class='sample-vehicle'>";
                    echo "<h3>Sample Car</h3>";
                    echo $sampleCar->displayInfo();
                    echo "</div>";
                    
                    echo "<div class='sample-vehicle'>";
                    echo "<h3>Sample Truck</h3>";
                    echo $sampleTruck->displayInfo();
                    echo "</div>";
                    
                    echo "<div class='sample-vehicle'>";
                    echo "<h3>Sample Motorcycle</h3>";
                    echo $sampleMotorcycle->displayInfo();
                    echo "</div>";
                    
                    // Demonstrate vehicle comparison
                    echo "<div class='comparison-demo'>";
                    echo "<h3>Vehicle Comparison Demo</h3>";
                    echo "<p><strong>Price Comparison:</strong> " . $sampleCar->compare($sampleTruck, 'price') . "</p>";
                    echo "<p><strong>Year Comparison:</strong> " . $sampleTruck->compare($sampleMotorcycle, 'year') . "</p>";
                    echo "</div>";
                    
                    // Display total vehicle count
                    echo "<div class='vehicle-count'>";
                    echo "<h3>Inventory Statistics</h3>";
                    echo "<p>Total vehicles in the system: <strong>" . Vehicle::getTotalVehicles() . "</strong></p>";
                    echo "</div>";
                    ?>
                </div>
            </section>
            
            <section class="instructions">
                <h2>How the System Works</h2>
                <div class="features">
                    <div class="feature">
                        <h3>1. Inheritance Structure</h3>
                        <p>The <code>Vehicle</code> base class contains common properties (brand, model, year, price) and methods that all vehicle types share.</p>
                    </div>
                    <div class="feature">
                        <h3>2. Method Overriding</h3>
                        <p>Each subclass (Car, Truck, Motorcycle) overrides the <code>displayInfo()</code> method to include its unique properties.</p>
                    </div>
                    <div class="feature">
                        <h3>3. Static Property</h3>
                        <p>The <code>$totalVehicles</code> static property tracks all vehicle instances created across all subclasses.</p>
                    </div>
                    <div class="feature">
                        <h3>4. Vehicle Comparison</h3>
                        <p>The <code>compare()</code> method allows comparing vehicles based on price or year criteria.</p>
                    </div>
                </div>
            </section>
        </div>
        
        <footer>
            <p>Car Dealership Vehicle Management System &copy; 2023</p>
        </footer>
    </div>
    
    <script>
        // Function to toggle visibility of vehicle-specific fields
        function toggleFields() {
            const vehicleType = document.getElementById('vehicleType').value;
            
            // Hide all vehicle-specific fields
            document.querySelectorAll('.car-field, .truck-field, .motorcycle-field').forEach(field => {
                field.style.display = 'none';
            });
            
            // Show the relevant field based on vehicle type
            if (vehicleType === 'car') {
                document.querySelector('.car-field').style.display = 'block';
            } else if (vehicleType === 'truck') {
                document.querySelector('.truck-field').style.display = 'block';
            } else if (vehicleType === 'motorcycle') {
                document.querySelector('.motorcycle-field').style.display = 'block';
            }
        }
        
        // Initialize fields on page load
        document.addEventListener('DOMContentLoaded', toggleFields);
    </script>
</body>
</html>