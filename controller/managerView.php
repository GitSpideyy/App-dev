<?php

if (isset($_SESSION['userid'])) {
    // Retrieve the userid from the session
    $userid = $_SESSION['userid'];
} else {
    // Redirect to login page if no session found
    header("Location: login.php");
    exit();
}
// Function to get the count from a table
function getCount($conn, $table, $column) {
    $sql = "SELECT COUNT($column) AS total FROM $table";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? $result['total'] : 0;
}

// Get the total counts
$total_staff = getCount($conn, 'staff', 'staff_id');
$total_projects = getCount($conn, 'project', 'project_id');
$total_tasks = getCount($conn, 'task', 'task_id');
$total_users = getCount($conn, 'user', 'userid');

// Close the connection
$conn = null;
?>
<!-- Main content -->
<div class="row">
                <!-- Staff box -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $total_staff; ?></h3>
                            <p>Staff</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="../controller/staffList.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- Projects box -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo $total_projects; ?><sup style="font-size: 20px"></sup></h3>
                            <p>Projects</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="../controller/projectList.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- Tasks box -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo $total_tasks; ?></h3>
                            <p>Task</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="../controller/taskList.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- Users box -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?php echo $total_users; ?></h3>
                            <p>User</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="../controller/userList.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Task Information</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Task ID</th>
                                    <th>Task Name</th>
                                    <th>Person ID</th>
                                    <th>Project ID</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include "../connect.php";

                                try {
                                    // Establish database connection
                                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                    // Check if the user is logged in by verifying the existence of the userid
                                    if (isset($_SESSION['userid'])) {
                                        // Retrieve the userid from the session
                                        $userid = $_SESSION['userid'];

                                        // Prepare the SQL statement
                                        $stmt = $conn->prepare("
                                            SELECT 
                                                t.task_id, 
                                                t.task_name, 
                                                t.task_created, 
                                                t.due_date, 
                                                t.status, 
                                                s.staff_id, 
                                                s.firstname, 
                                                s.lastname, 
                                                p.project_id, 
                                                p.project_name 
                                            FROM 
                                                task t
                                            JOIN 
                                                staff s ON t.staff_id = s.staff_id
                                            JOIN 
                                                project p ON t.project_id = p.project_id
                                            JOIN 
                                                user u ON s.staff_id = u.staff_id
                                            WHERE 
                                                u.userid = :userid
                                        ");

                                        // Bind the :userid parameter
                                        $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);

                                        // Execute the query
                                        $stmt->execute();

                                        if ($stmt->rowCount() > 0) {
                                            // Display fetched records
                                            while ($obj = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                $personName = $obj['staff_id'] . ' - ' . $obj['firstname'] . ' ' . $obj['lastname'];
                                                $projectName = $obj['project_id'] . ' - ' . $obj['project_name'];
                                        
                                                echo "<tr>";
                                                echo "<td>" . htmlspecialchars($obj["task_id"]) . "</td>";
                                                echo "<td>" . htmlspecialchars($obj["task_name"]) . "</td>";
                                                echo "<td>" . htmlspecialchars($personName) . "</td>";
                                                echo "<td>" . htmlspecialchars($projectName) . "</td>";
                                                echo "<td>" . htmlspecialchars($obj["task_created"]) . "</td>";
                                                echo "<td>" . htmlspecialchars($obj["due_date"]) . "</td>";
                                                echo "<td>
                                                    <select class='form-control' id='status-" . htmlspecialchars($obj['task_id']) . "'>
                                                        <option value='' disabled selected hidden>" . htmlspecialchars($obj['status']) . "</option>
                                                        <option value='Not Started'" . ($obj["status"] == 'Not Started' ? ' selected' : '') . ">Not Started</option>
                                                        <option value='On Going'" . ($obj["status"] == 'On Going' ? ' selected' : '') . ">On Going</option>
                                                        <option value='Completed'" . ($obj["status"] == 'Completed' ? ' selected' : '') . ">Completed</option>
                                                    </select>
                                                </td>";
                                                echo "<td>
                                                    <button class='btn btn-primary btn-sm' onclick='updateTask(\"" . htmlspecialchars($obj["task_id"]) . "\")'>Update</button>
                                                </td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='8'>No records found</td></tr>";
                                        }
                                    }
                                } catch (PDOException $e) {
                                    echo "<tr><td colspan='8'>Connection failed: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<script>
   function updateTask(taskid) {
    var status = document.getElementById("status-" + taskid).value; 
    
    $.ajax({
        type: "POST",
        url: '../action/staffViewUpdate_action.php',
        data: {
            task_id: taskid,
            status: status,
        },
        success: function (data) {  
          
            const obj = JSON.parse(data);
            if (obj.response === 'success') {
                toastr.success(obj.message);
            } else {
                toastr.error(obj.message);
            }
        },
        error: function (xhr, textStatus, errorThrown) {
            toastr.error("An error occurred. Please try again.");
        
        }
    });
}

</script>