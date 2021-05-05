<?php
session_start();
include('config.php');
error_reporting(0);
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {



    if (isset($_GET['del'])) {
        mysqli_query($con, "delete from students where StudentRegno = '" . $_GET['id'] . "'");
        $_SESSION['delmsg'] = "Student record deleted !!";
    }
?>

    <!DOCTYPE html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <title>Admin | Students</title>
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
                        <h1 class="page-head-line">Manage Students </h1>
                    </div>
                </div>
                <div class="row">

                    <font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']); ?><?php echo htmlentities($_SESSION['delmsg'] = ""); ?></font>
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Manage Students
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive table-bordered">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Reg No </th>
                                                <th>Student Name </th>
                                                <th> Email</th>
                                                <th> Mobile</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = mysqli_query($con, "select * from students");
                                            $cnt = 1;
                                            while ($row = mysqli_fetch_array($sql)) {
                                            ?>


                                                <tr>
                                                    <td><?php echo $cnt; ?></td>
                                                    <td><?php echo htmlentities($row['StudentRegno']); ?></td>
                                                    <td><?php echo htmlentities($row['studentName']); ?></td>
                                                    <td><?php echo htmlentities($row['studentEmail']); ?></td>
                                                    <td><?php echo htmlentities($row['studentMobile']); ?></td>
                                                    <td>
                                                        <a href="edit-student.php?id=<?php echo $row['StudentRegno'] ?>">
                                                            <button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button> </a>
                                                        <a href="manage-students.php?id=<?php echo $row['StudentRegno'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">
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