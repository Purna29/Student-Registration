<?php
session_start();
include('config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {



?>

    <!DOCTYPE html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <title>Enroll History</title>
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <link href="assets/css/style.css" rel="stylesheet" />
    </head>

    <body>
        <?php include('adminheader.php'); ?>
        <?php if ($_SESSION['alogin'] != "") {
            include('adminmenubar.php');
        }
        ?>
        <div class="content-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Enroll History </h1>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Enroll History
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive table-bordered">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Student Name </th>
                                                <th>Student Reg no </th>
                                                <th>Course Name </th>
                                                <th>Status</th>
                                                <th>Enrollment Date</th>
                                                <th>Failed Date</th>
                                                <th>Completed Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = mysqli_query($con, "select courseenrolls.course as cid, course.courseName as courname,courseenrolls.status as status,courseenrolls.enrollDate as edate ,courseenrolls.failedDate as fdate, courseenrolls.completedDate as cdate ,students.studentName as sname,students.StudentRegno as sregno from courseenrolls join course on course.id=courseenrolls.course join students on students.StudentRegno=courseenrolls.studentRegno ");
                                            $cnt = 1;
                                            while ($row = mysqli_fetch_array($sql)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $cnt; ?></td>
                                                    <td><?php echo htmlentities($row['sname']); ?></td>
                                                    <td><?php echo htmlentities($row['sregno']); ?></td>
                                                    <td><?php echo htmlentities($row['courname']); ?></td>
                                                    <td><?php if($row['status'] == 'C'){ 
                                                                echo "<font color='green'><b>Completed</b></font>"; 
                                                            }else if($row['Status'] == 'F'){ 
                                                                echo "<font color='red'><b>Failed</b></font>";     
                                                            }else{
                                                                echo "<font color='blue'><b>Enrolled</b></font>"; 
                                                            }
                                                        ?></td>
                                                    <td><?php echo htmlentities($row['edate']); ?></td>
                                                    <td><?php echo htmlentities($row['fdate']); ?></td>
                                                    <td><?php echo htmlentities($row['cdate']); ?></td>
                                                </tr>
                                            <?php
                                                $cnt++;
                                            } ?>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>





            </div>
        </div>
        <script src="assets/js/jquery-1.11.1.js"></script>
        <script src="assets/js/bootstrap.js"></script>
    </body>

    </html>
<?php } ?>