<?php
    // Check if the 'page' GET parameter is set and equals 'home'
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        
        // Load and display the content of Register.html
        include('Register.html');  // This outputs the HTML file's content directly
        
    } else {
        // Default content if no matching GET parameter
        echo "<h1>Default Page</h1><p>Page not found</p>";
    }
?>