<?php
include 'db.php';

$sql_students = "SELECT COUNT(student_id) as total_students FROM student";
$result_students = $conn->query($sql_students);

if ($result_students->num_rows > 0) {
  $row = $result_students->fetch_assoc();
  $total_students = $row['total_students'];
} else {
  $total_students = 0;
}

$sql_teachers = "SELECT COUNT(teacher_id) as total_teachers FROM teacher";
$result_teachers = $conn->query($sql_teachers);

if ($result_teachers->num_rows > 0) {
  $row = $result_teachers->fetch_assoc();
  $total_teachers = $row['total_teachers'];
} else {
  $total_teachers = 0;
}

$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="admin_script.js"></script>

</head>
<body>
    <div class="header">
        <div class="header-title"><b>Dashboard</b></div>
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

            <h2>Welcome to the Dashboard</h2>

            <div class="count-box">
                <i class="fas fa-user-graduate count-icon"></i>
                <h3>Total Students: <?php echo $total_students; ?></h3>
            </div>

            <div class="count-box">
                <i class="fas fa-chalkboard-teacher count-icon"></i>
                <h3>Total Teachers: <?php echo $total_teachers; ?></h3>
            </div>

            <div class="notice">
                <div class="notice-title"><i class="fas fa-bullhorn"></i> New Announcement:</div>
                <div>
                    <marquee class="marquee" direction="left" behavior="scroll" scrollamount="5" onmouseover="this.stop();" onmouseout="this.start();" onclick="window.location.href='../Achieve/main.php';">New achievemets can be viewed here.</marquee>
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
