<?php
session_start();
include('config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_GET['del'])) {
        mysqli_query($con, "delete from course where id = '" . $_GET['id'] . "'");
        $_SESSION['delmsg'] = "Course deleted !!";
    }
?>

    <!DOCTYPE html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <title>Admin | Course</title>
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
        
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-head-line"> Manage Courses </h1>
                </div>
            </div>

            <font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']); ?><?php echo htmlentities($_SESSION['delmsg'] = ""); ?></font>
            <div class="col-md-12">
                
                <div class="panel panel-default">
                    <div class="panel-heading">
                        List of Courses
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive table-bordered">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>CRN</th>
                                        <th>Course</th>
                                        <th>Course Name </th>
                                        <th>No. Of Credits</th>
                                        <th>Location</th>
                                        <th>Level</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Instructor</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = mysqli_query($con, "select * from course");
                                    $cnt = 1;
                                    while ($row = mysqli_fetch_array($sql)) {
                                    ?>


                                        <tr>
                                            <td><?php echo $cnt; ?></td>
                                            <td><?php echo htmlentities($row['CRN']); ?></td>
                                            <td><?php echo htmlentities($row['course']); ?></td>
                                            <td><?php echo htmlentities($row['courseName']); ?></td>
                                            <td><?php echo htmlentities($row['noofCredits']); ?></td>
                                            <td><?php echo htmlentities($row['location']); ?></td>
                                            <td><?php echo htmlentities($row['level']); ?></td>
                                            <td><?php echo htmlentities($row['startDate']); ?></td>
                                            <td><?php echo htmlentities($row['endDate']); ?></td>
                                            <td><?php echo htmlentities($row['instructor']); ?></td>
                                            <td style="padding:0px;">
                                                <a href="edit-course.php?id=<?php echo $row['id'] ?>">
                                                    <button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button> </a>
                                                <a href="manage-courses.php?id=<?php echo $row['id'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">
                                                    <button class="btn btn-danger">Delete</button>
                                                </a>
                                            </td>
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