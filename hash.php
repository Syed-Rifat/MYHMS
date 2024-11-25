<?php
// Sample password (could be from user input, e.g., $_POST['password'])
$password = 'password';

// Hash the password using bcrypt (the default algorithm)
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Output the hashed password
echo $hashedPassword;
?>
