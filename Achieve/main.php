<?php
session_start();
require "dbconnect.php";
require "function.php";

// Handle form actions
$action = $_REQUEST['action'] ?? '';

if ($action == "signup") {
    $mail = $_REQUEST['mail'] ?? '';
    $fname = $_REQUEST['fname'] ?? '';
    $lname = $_REQUEST['lname'] ?? '';
    $age = $_REQUEST['age'] ?? '';
    $gender = $_REQUEST['gender'] ?? '';
    $pass = $_REQUEST['pass'] ?? '';
    $country = $_REQUEST['country'] ?? '';
    $city = $_REQUEST['city'] ?? '';

    if (signup($mail, $fname, $lname, $age, $gender, $pass, $country, $city)) {
        echo "<script>alert('Signup successful!');</script>";
    } else {
        echo "<script>alert('Signup failed.');</script>";
    }
} elseif ($action == "signin") {
    $mail = $_REQUEST['mail'] ?? '';
    $pass = $_REQUEST['pass'] ?? '';

    $user = signin($mail, $pass);
    if ($user) {
        $_SESSION['user'] = $user;
        echo "<script>alert('Sign in successful');</script>";
    } else {
        echo "<script>alert('Invalid credentials');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Network App</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <?php if (isset($_SESSION['user'])): ?>
        <h3>Welcome, <?= htmlspecialchars($_SESSION['user']['firstname']) ?>!</h3>
        <form method="post" action="main.php">
            <input type="hidden" name="action" value="logout">
            <button class="btn btn-danger">Logout</button>
        </form>

        <div class="mt-4">
            <h4>Post something to your network</h4>
            <form>
                <textarea class="form-control mb-3" rows="4" placeholder="What's on your mind?"></textarea>
                <button class="btn btn-outline-info btn-md">Ask your network for advice</button>
            </form>
        </div>
    <?php else: ?>
        <h3>Sign In</h3>
        <form method="post" action="main.php">
            <input type="hidden" name="action" value="signin">
            <div class="form-group">
                <input type="email" name="mail" class="form-control" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" name="pass" class="form-control" placeholder="Password" required>
            </div>
            <button class="btn btn-primary">Sign In</button>
        </form>

        <hr>

        <h3>Sign Up</h3>
        <form method="post" action="main.php">
            <input type="hidden" name="action" value="signup">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                </div>
                <div class="form-group col-md-6">
                    <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                </div>
            </div>
            <div class="form-group">
                <input type="email" name="mail" class="form-control" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="number" name="age" class="form-control" placeholder="Age" required>
            </div>
            <div class="form-group">
                <select name="gender" class="form-control" required>
                    <option value="" disabled selected>Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <input type="password" name="pass" class="form-control" placeholder="Password" required>
            </div>
            <div class="form-group">
                <input type="text" name="country" class="form-control" placeholder="Country" required>
            </div>
            <div class="form-group">
                <input type="text" name="city" class="form-control" placeholder="City" required>
            </div>
            <button class="btn btn-success">Sign Up</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html>
