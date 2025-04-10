<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['role'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];

        // Check if the email already exists
        $check_query = "SELECT * FROM user WHERE email='$email'";
        $check_result = $conn->query($check_query);

        if ($check_result->num_rows > 0) {
            echo "<script>alert('Email already registered. Please use a different email.'); window.location.href='login.html';</script>";
            exit();
        }

        $password = $_POST['password'];
        $role = $_POST['role']; 

        $sql = "INSERT INTO user (username, email, password, role) VALUES ('$username', '$email', '$password', '$role')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Registration successful'); window.location.href='login.html';</script>";
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "All fields are required";
    }
}

$conn->close();
?>
