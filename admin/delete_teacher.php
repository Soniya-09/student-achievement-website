<?php
include 'db.php'; // Make sure to include your database connection

if(isset($_GET['teacher_id'])) {
    $teacher_id = $_GET['teacher_id'];
    $query = "DELETE FROM teacher WHERE teacher_id = $teacher_id";
    $result = $conn->query($query);

    if ($result === TRUE) {
        echo "success";
    } else {
        echo "error";
    }

    $conn->close();
}
?>
