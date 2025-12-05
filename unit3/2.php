<?php
    // Task 1: Format product descriptions
    echo "=== TASK 1: PRODUCT DESCRIPTION FORMATTING ===\n";

    $productData = [
        ['name' => 'Premium_Laptop', 'description' => 'A_HIGH-QUALITY Laptop with 16GB_RAM and 512GB_SSD. #BestSeller!'],
        ['name' => 'Wireless_Headphones®', 'description' => 'Noise_Cancelling Headphones with 30-hour battery. @2023Model'],
        ['name' => 'Organic_Coffee', 'description' => '100%_ORGANIC Coffee Beans from Colombia. *Fresh_Roasted*']
    ];

    function formatProductDescription($productName, $description) {
        // Remove special characters from product name (keep only alphanumeric and spaces)
        $sanitizedName = preg_replace('/[^A-Za-z0-9\s]/', '', $productName);
        
        // Convert description to lowercase and replace underscores with spaces
        $lowercaseDesc = strtolower($description);
        $formattedDesc = str_replace('_', ' ', $lowercaseDesc);
        
        // Remove unnecessary special characters from description (keep only letters, numbers, spaces, and basic punctuation)
        $cleanedDesc = preg_replace('/[^A-Za-z0-9\s.,!?]/', '', $formattedDesc);
        
        return [
            'sanitized_name' => trim($sanitizedName),
            'formatted_description' => trim($cleanedDesc)
        ];
    }

    foreach ($productData as $product) {
        $result = formatProductDescription($product['name'], $product['description']);
        echo "Original Name: {$product['name']}\n";
        echo "Sanitized Name: {$result['sanitized_name']}\n";
        echo "Original Description: {$product['description']}\n";
        echo "Formatted Description: {$result['formatted_description']}\n";
        echo str_repeat("-", 50) . "\n";
    }

    // Task 2: Product Description Analysis
    echo "\n=== TASK 2: PRODUCT DESCRIPTION ANALYSIS ===\n";

    function analyzeProductDescription($description) {
        echo "Description: \"$description\"\n";
        
        // Calculate total number of characters
        $charCount = strlen($description);
        echo "Total characters: $charCount\n";
        
        // Count total number of words
        $wordCount = str_word_count($description);
        echo "Total words: $wordCount\n";
        
        // Check if "leather" appears in the description (case-insensitive)
        if (stripos($description, 'leather') !== false) {
            echo "Keyword found: 'leather' appears in the description\n";
        } else {
            echo "Keyword not found: 'leather' does not appear\n";
        }
        
        // Additional analysis: Find positions of all occurrences
        $keyword = 'leather';
        $positions = [];
        $offset = 0;
        
        while (($pos = stripos($description, $keyword, $offset)) !== false) {
            $positions[] = $pos;
            $offset = $pos + 1;
        }
        
        if (!empty($positions)) {
            echo "Keyword appears at position(s): " . implode(', ', $positions) . "\n";
        }
        
        echo str_repeat("-", 50) . "\n";
    }

    // Test with different descriptions
    $descriptions = [
        "This is a high-quality leather wallet with RFID protection.",
        "Genuine leather jacket with premium stitching.",
        "Cotton t-shirt with screen print design.",
        "Leather boots with leather laces and waterproof membrane."
    ];

    foreach ($descriptions as $desc) {
        analyzeProductDescription($desc);
    }

    // Task 3: Customer Review Processing
    echo "\n=== TASK 3: CUSTOMER REVIEW PROCESSING ===\n";

    function processCustomerReview($review) {
        echo "Original Review: \"$review\"\n";
        
        // Extract first 20 characters for preview
        $preview = substr($review, 0, 20);
        if (strlen($review) > 20) {
            $preview .= "...";
        }
        echo "Preview: \"$preview\"\n";
        
        // Search for "excellent" (case-insensitive)
        $position = stripos($review, 'excellent');
        if ($position !== false) {
            echo "Word 'excellent' found at position: $position\n";
            
            // Also show the context around the word
            $contextStart = max(0, $position - 10);
            $context = substr($review, $contextStart, 30);
            echo "Context: \"...$context...\"\n";
        } else {
            echo "Word 'excellent' not found\n";
        }
        
        // Concatenate with thank you message
        $updatedReview = $review . " Thank you for your feedback!";
        echo "Updated Review: \"$updatedReview\"\n";
        
        echo str_repeat("-", 50) . "\n";
    }

    // Test with different reviews
    $reviews = [
        "Great product! Fast delivery and excellent service.",
        "Average product. Could be better.",
        "Excellent quality! Highly recommended.",
        "The packaging was excellent and the product arrived in perfect condition."
    ];

    foreach ($reviews as $review) {
        processCustomerReview($review);
    }

    // BONUS: Combined Function for All Tasks
    echo "\n=== BONUS: COMBINED FUNCTION ===\n";

    function processProductContent($productName, $description, $review) {
        echo "=== PRODUCT CONTENT PROCESSING ===\n";
        
        // Task 1: Format product details
        $formatted = formatProductDescription($productName, $description);
        echo "Product: {$formatted['sanitized_name']}\n";
        echo "Description: {$formatted['formatted_description']}\n";
        
        // Task 2: Analyze description
        echo "\nDescription Analysis:\n";
        analyzeProductDescription($description);
        
        // Task 3: Process review
        echo "\nReview Processing:\n";
        processCustomerReview($review);
        
        echo str_repeat("=", 50) . "\n";
    }

    // Test the combined function
    processProductContent(
        "Premium_Leather®_Wallet#2023",
        "This is a GENUINE_LEATHER wallet with RFID protection. *High_Quality*",
        "Excellent leather quality! The wallet is perfect and the craftsmanship is excellent."
    );
?>