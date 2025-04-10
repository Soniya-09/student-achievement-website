<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        session_start();
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];

        // Check the role and redirect accordingly
        if ($row['role'] == 'Admin') {
            echo "<script>alert('Login successful'); window.location.href='./admin/admin_dashboard.html';</script>";
            exit();
        } elseif ($row['role'] == 'Teacher') {
            echo "<script>alert('Login successful'); window.location.href='./teacher/teacher_dashboard.html';</script>";
            exit();
        } elseif ($row['role'] == 'Student') {
            echo "<script>alert('Login successful'); window.location.href='./student/student_dashboard.html';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Invalid email or password'); window.location.href='login.html';</script>";
        exit();
    }
}

$conn->close();
?>
