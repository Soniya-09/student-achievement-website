<!DOCTYPE html>
<html>
<head>
    <title>Class</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="view_student_style.css">
    <script src="admin_script.js"></script>


</head>

<body>
    <div class="header">
        <div class="header-title">Dashboard</div>
        <div class="logout">
            <a href="../login.html" class="button">Logout</a>
        </div>
    </div>
    <div class="container">
        <div class="sidebar-toggle">
            <i class="fa fa-bars"></i>
        </div>
        <div class="sidebar">
        <div class="sidebar-header">
                <img src="avatar.png" alt="Avatar" class="sidebar-avatar">
                <h3 class="sidebar-username">Teacher</h3>
            </div>
            <div class="sidebar-item">
                <i class="fas fa-users count-icon"></i><a href="class.php">Class</a>
            </div>
            <div class="sidebar-item">
                <i class="fas fa-user-graduate count-icon"></i><a href="student.html">Student</a>
            </div>
            <div class="sidebar-item">
                <i class="far fa-calendar-alt count-icon"></i><a href="../Achieve/main.php">Achievement</a>
            </div>
        </div>

                    <div id="studentDetailsContent">
                        <div class="content" id="detailsModal">
                            <div class="search-container">
                                <form onsubmit="searchStudents(); return false;">
                                    <input type="text" id="searchInput" placeholder="Search for names...">
                                    <button type="submit">Search</button>
                                </form>
                            </div>
                                <table class="student-table">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Name</th>
                                            <th>Register No</th>
                                            <th>Roll No</th>
                                            <th>Mail ID</th>
                                            <th>Year</th>
                                            <th>Details</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            include 'db.php';
                                            $sql = "SELECT * FROM student where year='II'";
                                            $result = $conn->query($sql);
                                
                                            if ($result->num_rows > 0) {
                                                $count = 1;
                                                while($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td>".$count."</td>";
                                                    echo "<td>".$row['first_name']." ".$row['last_name']."</td>";
                                                    echo "<td>".$row['register_no']."</td>";
                                                    echo "<td>".$row['roll_no']."</td>";
                                                    echo "<td>".$row['email']."</td>";
                                                    echo "<td>".$row['year']."</td>";
                                                    echo "<td><button class='view-button' onclick='viewDetails(".$row['student_id'].")'><i class='fas fa-eye'></i></button></td>";
                                                    echo "<td><button class='delete-button' onclick='deleteStudent(".$row['student_id'].")'><i class='fas fa-trash'></i></button></td>";
                                                    echo "</tr>";
                                                    $count++;
                                                }
                                            } else {
                                                echo "<tr><td colspan='8'>No students found</td></tr>";
                                            }
                                
                                            $conn->close();
                                        ?>
                                    </tbody>
                                </table>
                                <div class="export-container">
                                                <button onclick="exportData()">Export Data</button>
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

    <script>
      function getStudentDetails($student_id) {
            $query = "SELECT * FROM student WHERE student_id = $student_id";
            $result = mysqli_query($conn, $query);
            if ($result && mysqli_num_rows($result) > 0) {
                return mysqli_fetch_assoc($result);
            } else {
                return false;
            }
        }

        function viewDetails(student_id) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var modalContent = document.getElementById("studentDetailsContent");
                    modalContent.innerHTML = this.responseText;
                    var modal = document.getElementById("detailsModal");
                    modal.style.display = "block";
                }
            };
            xhttp.open("GET", "get_student_details.php?student_id=" + student_id, true);
            xhttp.send();
        }

        function closeDetailsModal() {
            var modal = document.getElementById("detailsModal");
            location.reload();
        }

        function deleteStudent(student_id) {
            var confirmation = confirm("Are you sure you want to delete this student?");
            
            if (confirmation) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        if (this.responseText.trim() === 'success') {
                            alert('Student deleted successfully.');
                            location.reload();
                        } else {
                            alert('Error deleting student.');
                        }
                    }
                };
                xhttp.open("GET", "delete_student.php?student_id=" + student_id, true);
                xhttp.send();
            }
        }

        function searchStudents() {
            var input, filter, table, tr, td, i, j, txtValue, found;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementsByClassName("student-table")[0];
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) { // Start from 1 to skip the header row
                found = false;
                for (j = 0; j < tr[i].getElementsByTagName("td").length; j++) {
                    td = tr[i].getElementsByTagName("td")[j];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            found = true;
                            break;
                        }
                    }
                }
                if (found) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }


                function exportData() {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var blob = new Blob([this.responseText], {type: 'application/vnd.ms-excel'});
                        var url = URL.createObjectURL(blob);
                        var a = document.createElement('a');
                        a.href = url;
                        a.download = 'student_data.xls';
                        document.body.appendChild(a);
                        a.click();
                        document.body.removeChild(a);
                    }
                };
                xhttp.open("GET", "export_data.php", true);
                xhttp.send();
            }


    </script>

</body>
</html>
