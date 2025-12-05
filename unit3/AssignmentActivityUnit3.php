<?php 
    echo " ---------------- PART 1 ----------------- \n\n";

    echo "1a. PHP function that calculates the total order price with a 10% sales tax: \n\n";
    function calculateTotal($price, $quantity) {
        $subtotal = $price * $quantity;
        $tax = $subtotal * 0.10;
        return $subtotal + $tax;
    }
    echo "Output (25 * 2 = 50, + 5 tax = 55): ".calculateTotal(25, 2)."\n";  // Output: 55 (25 * 2 = 50, + 5 tax = 55)
    echo "Output (10 * 5 = 50, + 5 tax = 55): ".calculateTotal(10, 5)."\n\n";  // Output: 55 (10 * 5 = 50, + 5 tax = 55)

    // 1b. PHP function that formats product names
    echo "1b. PHP function that formats product names\n\n";
    function formatProductName($name) {
        // Step 1: Trim extra spaces from beginning and end
        $trimmed = trim($name);
        
        // Step 2: Replace multiple spaces with single spaces
        $singleSpaced = preg_replace('/\s+/', ' ', $trimmed);
        
        // Step 3: Capitalize first letter of each word
        $capitalized = ucwords($singleSpaced);
        
        // Step 4: Limit to 50 characters
        if (strlen($capitalized) > 50) {
            $capitalized = substr($capitalized, 0, 50);
        }
        
        return $capitalized;
    }
    echo formatProductName("  apple macbook pro  ")."\n"; 
    // Output: "Apple Macbook Pro"

    echo formatProductName("super long product name that definitely exceeds fifty characters limit test")."\n";
    // Output: "Super Long Product Name That Definitely Exceeds Fif"

    echo formatProductName("  multiple   spaces    between    words  ")."\n";
    // Output: "Multiple Spaces Between Words"
    echo "\n";

    // 1c. PHP function that calculates the final price after applying a discount
    echo "1c. PHP function that calculates the final price after applying a discount\n\n";
    function calculateDiscount($price, $discountPercent) {

        // Convert percentage to decimal and calculate discount amount and Subtract discount from original price       
        return $price - $price * ($discountPercent / 100);
    }
    echo "20% off $100 = ".calculateDiscount(100, 20)."\n";   // Output: 80 (20% off $100 = $80)
    echo "10% off $50 = ".calculateDiscount(50, 10)."\n";    // Output: 45 (10% off $50 = $45)
    echo "15% off $200 = ".calculateDiscount(200, 15)."\n";   // Output: 170 (15% off $200 = $170)
    echo "0% discount = ".calculateDiscount(75, 0)."\n\n";     // Output: 75 (0% discount = same price)

    echo " ---------------- PART 2 ----------------- \n\n";

    // 2a. PHP script that creates a product array, removes duplicates, sorts by price, and displays the products in a structured format
    echo "2a. PHP script that creates a product array, removes duplicates, sorts by \nprice, and displays the products in a structured format\n\n";
    // Create an array of products
    $products = [
        ['name' => 'Laptop', 'price' => 999.99],
        ['name' => 'Mouse', 'price' => 25.50],
        ['name' => 'Keyboard', 'price' => 75.00],
        ['name' => 'Monitor', 'price' => 299.99],
        ['name' => 'Laptop', 'price' => 999.99], // Duplicate
        ['name' => 'Headphones', 'price' => 150.00],
        ['name' => 'Mouse', 'price' => 25.50], // Duplicate
        ['name' => 'Tablet', 'price' => 450.00],
        ['name' => 'Smartphone', 'price' => 699.99],
    ];

    echo "Original Products List:\n";
    echo "=======================\n";
    displayProducts($products);

    // Remove duplicate products
    $uniqueProducts = removeDuplicateProducts1($products);

    echo "\nAfter Removing Duplicates:\n";
    echo "==========================\n";
    displayProducts($uniqueProducts);

    // Sort products by price in ascending order
    $sortedProducts = sortProductsByPrice($uniqueProducts);

    echo "\nSorted by Price (Ascending):\n";
    echo "============================\n";
    displayProducts($sortedProducts);
    /**
     * Remove duplicate products from array
     */
    function removeDuplicateProducts1($products) {
        $serialized = array_map('serialize', $products);
        $unique = array_unique($serialized);
        return array_map('unserialize', $unique);
    }
    /**
     * Sort products by price in ascending order
     */
    function sortProductsByPrice($products) {
        usort($products, function($a, $b) {
            return $a['price'] <=> $b['price'];
        });
        return $products;
    }

    /**
     * Display products in a structured format
     */
    function displayProducts($products) {
        printf("%-15s %-10s\n", "Product Name", "Price");
        echo str_repeat("-", 25) . "\n";
        
        foreach ($products as $product) {
            printf("%-15s $%-9.2f\n", $product['name'], $product['price']);
        }
        
        echo "Total products: " . count($products) . "\n";
    }
    // Alternative method using array_multisort
    function sortProductsByPriceAlternative($products) {
        $prices = array_column($products, 'price');
        array_multisort($prices, SORT_ASC, $products);
        return $products;
    }

    // 2b. PHP script that applies a 10% discount to all Electronics category products and displays the updated list:
    echo "\n2b. PHP script that applies a 10% discount to all Electronics category \nproducts and displays the updated list:\n\n";
    // Sample associative array of products
    $products = [
        ['name' => 'Laptop', 'category' => 'Electronics', 'price' => 999.99],
        ['name' => 'T-Shirt', 'category' => 'Clothing', 'price' => 25.50],
        ['name' => 'Smartphone', 'category' => 'Electronics', 'price' => 699.99],
        ['name' => 'Desk Chair', 'category' => 'Furniture', 'price' => 150.00],
        ['name' => 'Headphones', 'category' => 'Electronics', 'price' => 199.99],
        ['name' => 'Jeans', 'category' => 'Clothing', 'price' => 45.00],
        ['name' => 'Monitor', 'category' => 'Electronics', 'price' => 299.99],
        ['name' => 'Coffee Mug', 'category' => 'Home', 'price' => 12.99],
    ];

    echo "Original Product List:\n";
    echo "======================\n";
    displayProducts($products);

    // Apply 10% discount to Electronics category
    $updatedProducts = applyElectronicsDiscount($products);

    echo "\nUpdated Product List (10% discount on Electronics):\n";
    echo "==================================================\n";
    displayProducts($updatedProducts);

    /**
     * Apply 10% discount to all Electronics category products
     */
    function applyElectronicsDiscount($products) {
        return array_map(function($product) {
            if ($product['category'] === 'Electronics') {
                // Apply 10% discount (reduce price by 10%)
                $product['price'] = $product['price'] * 0.9;
                // Round to 2 decimal places for currency
                $product['price'] = round($product['price'], 2);
            }
            return $product;
        }, $products);
    }

    /**
     * Alternative method using foreach loop
     */
    function applyElectronicsDiscountAlternative($products) {
        foreach ($products as &$product) {
            if ($product['category'] === 'Electronics') {
                $product['price'] = round($product['price'] * 0.9, 2);
            }
        }
        return $products;
    }

    /**
     * Display products in a structured format
     */
    function displayProducts1($products) {
        printf("%-15s %-15s %-10s\n", "Product Name", "Category", "Price");
        echo str_repeat("-", 45) . "\n";
        
        foreach ($products as $product) {
            printf("%-15s %-15s $%-9.2f\n", 
                $product['name'], 
                $product['category'], 
                $product['price']);
        }
    }

    // Bonus: Show only Electronics products with their discounts
    echo "\nElectronics Products After Discount:\n";
    echo "====================================\n";
    $electronicsProducts = array_filter($updatedProducts, function($product) {
        return $product['category'] === 'Electronics';
    });

    displayProducts1($electronicsProducts);

    // 2c. PHP script that merges two supplier inventories, removes duplicates, and displays the combined inventory
    echo "\nPHP script that merges two supplier inventories, removes duplicates, and displays the combined inventory\n\n";

    // Supplier 1 inventory
    $supplier1 = [
        ['id' => 1, 'name' => 'Laptop', 'category' => 'Electronics', 'price' => 999.99],
        ['id' => 2, 'name' => 'Wireless Mouse', 'category' => 'Electronics', 'price' => 25.50],
        ['id' => 3, 'name' => 'Mechanical Keyboard', 'category' => 'Electronics', 'price' => 89.99],
        ['id' => 4, 'name' => 'Office Chair', 'category' => 'Furniture', 'price' => 199.99],
    ];

    // Supplier 2 inventory
    $supplier2 = [
        ['id' => 5, 'name' => 'Smartphone', 'category' => 'Electronics', 'price' => 699.99],
        ['id' => 2, 'name' => 'Wireless Mouse', 'category' => 'Electronics', 'price' => 25.50], // Duplicate product
        ['id' => 6, 'name' => 'Monitor', 'category' => 'Electronics', 'price' => 299.99],
        ['id' => 7, 'name' => 'Desk Lamp', 'category' => 'Home', 'price' => 39.99],
        ['id' => 3, 'name' => 'Mechanical Keyboard', 'category' => 'Electronics', 'price' => 89.99], // Duplicate product
    ];

    echo "Supplier 1 Inventory:\n";
    echo "=====================\n";
    displayProducts2($supplier1);

    echo "\nSupplier 2 Inventory:\n";
    echo "=====================\n";
    displayProducts2($supplier2);

    // Merge and remove duplicates
    $combinedInventory = mergeSupplierInventories($supplier1, $supplier2);

    echo "\nCombined Inventory (No Duplicates):\n";
    echo "==================================\n";
    displayProducts($combinedInventory);

    /**
     * Merge supplier inventories and remove duplicate products
     * Duplicates are identified by product ID and name combination
     */
    function mergeSupplierInventories($supplier1, $supplier2) {
        // Merge both arrays
        $merged = array_merge($supplier1, $supplier2);
        
        // Remove duplicates based on product ID
        $uniqueProducts = removeDuplicateProducts($merged);
        
        return $uniqueProducts;
    }

    /**
     * Remove duplicate products using multiple criteria
     */
    function removeDuplicateProducts($products) {
        $seen = [];
        $unique = [];
        
        foreach ($products as $product) {
            // Create a unique key using ID and name to identify duplicates
            $key = $product['id'] . '|' . $product['name'];
            
            if (!isset($seen[$key])) {
                $seen[$key] = true;
                $unique[] = $product;
            }
        }
        
        return $unique;
    }

    /**
     * Alternative method using array_reduce
     */
    function removeDuplicateProductsAlternative($products) {
        return array_reduce($products, function($carry, $item) {
            $key = $item['id'] . '|' . $item['name'];
            if (!isset($carry[$key])) {
                $carry[$key] = $item;
            }
            return $carry;
        }, []);
        
        return array_values($unique);
    }

    /**
     * Display products in a structured format
     */
    function displayProducts2($products) {
        if (empty($products)) {
            echo "No products available.\n";
            return;
        }
        
        printf("%-4s %-20s %-15s %-10s\n", "ID", "Product Name", "Category", "Price");
        echo str_repeat("-", 55) . "\n";
        
        foreach ($products as $product) {
            printf("%-4d %-20s %-15s $%-9.2f\n", 
                $product['id'],
                $product['name'], 
                $product['category'], 
                $product['price']);
        }
        
        echo "Total products: " . count($products) . "\n";
    }

    // Bonus: Statistics about the merge
    echo "\nMerge Statistics:\n";
    echo "================\n";
    echo "Supplier 1 products: " . count($supplier1) . "\n";
    echo "Supplier 2 products: " . count($supplier2) . "\n";
    echo "Total before merge: " . (count($supplier1) + count($supplier2)) . "\n";
    echo "Total after merge: " . count($combinedInventory) . "\n";
    echo "Duplicates removed: " . ((count($supplier1) + count($supplier2)) - count($combinedInventory)) . "\n";

    // Bonus: Group by category
    echo "\nProducts by Category:\n";
    echo "=====================\n";
    $productsByCategory = groupProductsByCategory($combinedInventory);
    foreach ($productsByCategory as $category => $products) {
        echo "$category: " . count($products) . " products\n";
    }

    /**
     * Group products by category
     */
    function groupProductsByCategory($products) {
        $grouped = [];
        
        foreach ($products as $product) {
            $category = $product['category'];
            if (!isset($grouped[$category])) {
                $grouped[$category] = [];
            }
            $grouped[$category][] = $product;
        }
        
        return $grouped;
    }
?>