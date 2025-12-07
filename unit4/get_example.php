<?php
// Check if 'message' parameter is in GET
if (isset($_GET['message'])) {
    $message = $_GET['message'];
    // Sanitize for output (XSS prevention)
    $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
    echo "Received message via GET: " . $message;
} else {
    echo "No message provided. Try adding ?message=YourMessage to the URL.";
}
?>

<!-- Optional form to demonstrate GET -->
<form action="get_example.php" method="GET">
    <label for="message">Enter a message:</label>
    <input type="text" id="message" name="message">
    <input type="submit" value="Send via GET">
</form>