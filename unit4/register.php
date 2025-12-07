<?php
// Initialize variables and error array
$username = $email = $password = $confirm_password = "";
$errors = [];

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture and sanitize inputs
    $username = trim($_POST["username"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";
    $confirm_password = $_POST["confirm_password"] ?? "";

    // Validation: All fields filled
    if (empty($username)) {
        $errors[] = "Username is required.";
    }
    if (empty($email)) {
        $errors[] = "Email is required.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    }
    if (empty($confirm_password)) {
        $errors[] = "Confirm password is required.";
    }

    // Validation: Email format
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Validation: Password criteria (min 8 chars, 1 upper, 1 lower, 1 number, 1 special)
    if (!empty($password)) {
        if (strlen($password) < 8) {
            $errors[] = "Password must be at least 8 characters long.";
        }
        if (!preg_match("/[A-Z]/", $password)) {
            $errors[] = "Password must contain at least one uppercase letter.";
        }
        if (!preg_match("/[a-z]/", $password)) {
            $errors[] = "Password must contain at least one lowercase letter.";
        }
        if (!preg_match("/[0-9]/", $password)) {
            $errors[] = "Password must contain at least one number.";
        }
        if (!preg_match("/[^A-Za-z0-9]/", $password)) {
            $errors[] = "Password must contain at least one special character.";
        }
    }

    // Validation: Passwords match
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    // If no errors, process securely (simulate success; in real app, hash and store in DB)
    if (empty($errors)) {
        // Sanitize for output (XSS prevention)
        $username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');

        // In a real system: Use password_hash() and PDO prepared statements for SQL injection prevention
        // Example: $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        // Then insert: $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        // $stmt->execute([$username, $email, $hashed_password]);

        echo "Registration successful for user: " . $username;
    } else {
        // Display user-friendly errors
        echo "<h2>Registration Errors:</h2><ul>";
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . "</li>";
        }
        echo "</ul>";
    }
} else {
    echo "Invalid request method.";
}
?>