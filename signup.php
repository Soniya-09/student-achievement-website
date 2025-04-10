<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username'], $_POST['email'], $_POST['password'], $_POST['role'])) {
        // Sanitize inputs
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $role = ucfirst(strtolower(mysqli_real_escape_string($conn, $_POST['role']))); // e.g., "student" -> "Student"

        // Check for duplicate email
        $check_query = "SELECT * FROM user WHERE email='$email'";
        $check_result = $conn->query($check_query);

        if ($check_result && $check_result->num_rows > 0) {
            echo "<script>alert('Email already registered. Please use a different email.'); window.location.href='login.html';</script>";
            exit();
        }

        // Hash password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert into database (no need for user_id due to AUTO_INCREMENT)
        $sql = "INSERT INTO user (username, email, password, role) 
                VALUES ('$username', '$email', '$hashed_password', '$role')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Registration successful'); window.location.href='login.html';</script>";
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "All fields are required";
    }
}

$conn->close();
?>
