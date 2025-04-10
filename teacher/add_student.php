<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate inputs
    $first_name = validateInput($_POST["first_name"], "/^[a-zA-Z ]+$/");
    $last_name = validateInput($_POST["last_name"], "/^[a-zA-Z ]+$/");
    $register_no = validateInput($_POST["register_no"], "/^[a-zA-Z0-9]{10}$/");
    $roll_no = validateInput($_POST["roll_no"], "/^[a-zA-Z0-9]{7}$/");
    $year = validateInput($_POST["year"], "/^(I|II|III|IV|V)$/");
    $email = validateInput($_POST["email"], "/^\S+@\S+\.\S+$/");
    $phone = validateInput($_POST["phone"], "/^\d{10}$/");
    $address = validateInput($_POST["address"], "/^.+$/");
    $father = validateInput($_POST["father"], "/^[a-zA-Z ]+$/");
    $mother = validateInput($_POST["mother"], "/^[a-zA-Z ]+$/");
    $aadhar = validateInput($_POST["aadhar"], "/^\d{12}$/");
    $dob = validateInput($_POST["dob"], "/^\d{4}-\d{2}-\d{2}$/");
    $gender = validateInput($_POST["gender"], "/^(Male|Female|Other)$/i");
    $dist = validateInput($_POST["dist"], "/^[a-zA-Z ]+$/");
    $pincode = validateInput($_POST["pincode"], "/^\d{6}$/");

    // File upload paths
    $target_dir = __DIR__ . "/../uploads/";
    $image_path = $target_dir . basename($_FILES["image"]["name"]);
    $file_path = $target_dir . basename($_FILES["file"]["name"]);

    // Save relative paths for DB
    $image = "uploads/" . basename($_FILES["image"]["name"]);
    $file = "uploads/" . basename($_FILES["file"]["name"]);

    // Move uploaded image
    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $image_path)) {
        die("Error uploading image.");
    }

    // Move uploaded document
    if (!move_uploaded_file($_FILES["file"]["tmp_name"], $file_path)) {
        die("Error uploading document.");
    }

    $uploaded = date('Y-m-d H:i:s');

    // Insert into database
    $sql = "INSERT INTO student (
        first_name, last_name, register_no, roll_no, email, phone_number, address, 
        father_name, mother, aadhar, birthday, gender, dist, pincode, file, image, uploaded, year
    ) VALUES (
        '$first_name', '$last_name', '$register_no', '$roll_no', '$email', '$phone_number', '$address',
        '$father_name', '$mother', '$aadhar', '$birthday', '$gender', '$dist', '$pincode', '$file', '$image', '$uploaded', '$year'
    )";
    

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("New student record created successfully");</script>';
        echo '<script>window.location.href = "view_students.php";</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

// Input validation function
function validateInput($input, $pattern) {
    if (preg_match($pattern, $input)) {
        return htmlspecialchars(trim($input));
    } else {
        die("Invalid input.");
    }
}
?>
