<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input to avoid SQL injection
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM user WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();

        session_start();
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role']; // Original role stored in session

        // Normalize role to lowercase for comparison
        $role = strtolower($row['role']);

        // Redirect based on normalized role
        if ($role == 'admin') {
            echo "<script>alert('Login successful'); window.location.href='./admin/admin_dashboard.php';</script>";
        } elseif ($role == 'teacher') {
            echo "<script>alert('Login successful'); window.location.href='./teacher/teacher_dashboard.php';</script>";
        } elseif ($role == 'student') {
            echo "<script>alert('Login successful'); window.location.href='./student/student_dashboard.php';</script>";
        } else {
            echo "<script>alert('Unknown role'); window.location.href='login.html';</script>";
        }
        exit();
    } else {
        echo "<script>alert('Invalid email or password'); window.location.href='login.html';</script>";
        exit();
    }
}

$conn->close();
?>
