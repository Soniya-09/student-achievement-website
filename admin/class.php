<?php
include 'db.php';

$total_students_by_year = array();

$roman_to_arabic = array('I' => 1, 'II' => 2, 'III' => 3, 'IV' => 4, 'V' => 5);

foreach ($roman_to_arabic as $roman => $arabic) {
    $sql = "SELECT COUNT(student_id) as total_students FROM student WHERE year = '$roman'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $total_students_by_year[$roman] = $row['total_students'];
    } else {
        $total_students_by_year[$roman] = 0;
    }
}
$conn->close();

?>


<!DOCTYPE html>
<html>
<head>
    <title>Class</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="class_style.css">
    <script src="admin_script.js"></script>
</head>

<body>
    <div class="header">
        <div class="header-title">Dashboard</div>
        <div class="logout">
            <a href="login.html" class="button">Logout</a>
        </div>
    </div>
    <div class="container">
        <div class="sidebar-toggle">
            <i class="fa fa-bars"></i>
        </div>
        <div class="sidebar">
        <div class="sidebar-header">
                <img src="avatar.png" alt="Avatar" class="sidebar-avatar">
                <h3 class="sidebar-username">Admin</h3>
            </div>
            <div class="sidebar-item">
                <i class="fas fa-users count-icon"></i><a href="class.php">Class</a>
            </div>
            <div class="sidebar-item">
                <i class="fas fa-user-graduate count-icon"></i><a href="student.html">Student</a>
            </div>
            <div class="sidebar-item">
                <i class="fas fa-chalkboard-teacher count-icon"></i><a href="teacher.html">Teacher</a>
            </div>
            <div class="sidebar-item">
                <i class="far fa-calendar-alt count-icon"></i><a href="../Achieve/main.php">Achievement</a>
            </div>
        </div>

        <div class="content">
            <h2>Class</h2>
            <div class="class-row">
                <div class="class-block" style="background: linear-gradient(to right, #f4611d, #fc8d59f4);">
                    <a href="1st_year_students.php">
                        <i class="fas fa-graduation-cap"></i>
                        <div class="class-info"> 
                            <h3>1st Year</h3> <br>
                            <p>Total Students: <?php echo $total_students_by_year['I']; ?></p>
                        </div>
                    </a>
                </div>
                <div class="class-block" style="background: linear-gradient(to right, #8338ec, #a36cf1);">
                    <a href="2nd_year_students.php">
                        <i class="fas fa-graduation-cap"></i>
                        <div class="class-info"> 
                            <h3>2nd Year</h3> <br>
                            <p>Total Students: <?php echo $total_students_by_year['II']; ?></p>
                        </div>
                    </a>
                </div>
                <div class="class-block" style="background: linear-gradient(to right, #3a86ff, #699ff5);">
                    <a href="3rd_year_students.php">
                        <i class="fas fa-graduation-cap"></i>
                        <div class="class-info">
                            <h3>3rd Year</h3> <br>
                            <p>Total Students: <?php echo $total_students_by_year['III']; ?></p>
                        </div>
                    </a>
                </div>
                <div class="class-block" style="background: linear-gradient(to right, #0be881, #4ff3a7);">
                    <a href="4th_year_students.php">
                        <i class="fas fa-graduation-cap"></i>
                        <div class="class-info">
                            <h3>4th Year</h3> <br>
                            <p>Total Students: <?php echo $total_students_by_year['IV']; ?></p>
                        </div>
                    </a>
                </div>
                <div class="class-block" style="background: linear-gradient(to right, #ff006e, #f05b9c);">
                    <a href="5th_year_students.php">
                        <i class="fas fa-graduation-cap"></i>
                        <div class="class-info">
                            <h3>5th Year</h3> <br>
                            <p>Total Students: <?php echo $total_students_by_year['V']; ?></p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        
        
    </div>

    <div class="footer" style="background-color: #333;">
        <div>
            <div class="circle" style="background-color: #7e7e7b;">
                <a href="https://www.tce.edu/">
                    <i class="fa fa-globe"></i>
                </a>
            </div>
            <div class="circle" style="background-color: #3b5998;">
                <a href="https://www.facebook.com/TheOfficialTCEPage">
                    <i class="fa fa-facebook"></i>
                </a>
            </div>
            <div class="circle" style="background-color: #1da1f2;">
                <a href="https://twitter.com/tceofficialpage">
                    <i class="fa fa-twitter"></i>
                </a>
            </div>
            <div class="circle" style="background-color: #0e76a8;">
                <a href="https://www.linkedin.com/in/tcemadurai">
                    <i class="fa fa-linkedin"></i>
                </a>
            </div>
            <div class="circle" style="background-color: #fa099d;">
                <a href="https://www.instagram.com/tcemadurai/">
                    <i class="fa fa-instagram"></i>
                </a>
            </div>
            <div class="circle" style="background-color: #ff0000;">
                <a href="https://www.youtube.com/ThiagarajarCollegeofEngineeringTCE">
                    <i class="fa fa-youtube"></i>
                </a>
            </div>
        </div>
        <div align="center">
            Made in India <br> Copyright &copy; 2023 TCE
        </div>
    </div>

</body>
</html>
