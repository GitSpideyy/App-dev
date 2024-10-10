
<?php

if (isset($_SESSION['userid'])) {
    // Retrieve the userid from the session
    $userid = $_SESSION['userid'];
} else {
    // Redirect to login page if no session found
    header("Location: login.php");
    exit();
}
try {
    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    // Retrieve the logged-in user's ID from session
    $userid = $_SESSION['userid'];


    // SQL Query to get the count of tasks that are 'Completed'
    $sql_completed = "SELECT COUNT(*) AS task_count 
  FROM task t
  JOIN staff s ON t.staff_id = s.staff_id
  WHERE s.user_id = :userid
  AND t.status = 'Completed'";
    // Prepare and execute the query for completed tasks
    $stmt_completed = $pdo->prepare($sql_completed);
    $stmt_completed->bindParam(':userid', $userid, PDO::PARAM_INT);
    $stmt_completed->execute();
    $result_completed = $stmt_completed->fetch(PDO::FETCH_ASSOC);
    $task_count_completed = $result_completed['task_count']; // Completed tasks count


 // SQL Query to get the count of tasks that are 'On Going'
 $sql_onGoing = "SELECT COUNT(*) AS task_countOngoing
 FROM task t
 JOIN staff s ON t.staff_id = s.staff_id
 WHERE s.user_id = :userid
 AND t.status = 'On going'";
   // Prepare and execute the query for onGoing tasks
   $stmt_onGoing = $pdo->prepare($sql_onGoing);
   $stmt_onGoing->bindParam(':userid', $userid, PDO::PARAM_INT);
   $stmt_onGoing->execute();
   $result_onGoing = $stmt_onGoing->fetch(PDO::FETCH_ASSOC);
   $task_count_onGoing = $result_onGoing['task_countOngoing']; // onGoing tasks count


   // SQL Query to get the count of tasks that are 'Not Started'
 $sql_NotStarted = "SELECT COUNT(*) AS task_countNotStarted
 FROM task t
 JOIN staff s ON t.staff_id = s.staff_id
 WHERE s.user_id = :userid
 AND t.status = 'Not Started'";

   // Prepare and execute the query for NotStarted tasks
   $stmt_NotStarted = $pdo->prepare($sql_NotStarted);
   $stmt_NotStarted->bindParam(':userid', $userid, PDO::PARAM_INT);
   $stmt_NotStarted->execute();
   $result_NotStarted = $stmt_NotStarted->fetch(PDO::FETCH_ASSOC);
   $task_count_NotStarted = $result_NotStarted['task_countNotStarted']; // onGoing tasks count


 // SQL Query to get tasks that are near the due date (within the next 3 days)
 $sql_near_due = "SELECT *
 FROM task t
 JOIN staff s ON t.staff_id = s.staff_id
 WHERE s.user_id = :userid
 AND t.due_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 3 DAY)";

// Prepare and execute the query for tasks near the due date
$stmt_near_due = $pdo->prepare($sql_near_due);
$stmt_near_due->bindParam(':userid', $userid, PDO::PARAM_INT);
$stmt_near_due->execute();
$near_due_tasks = $stmt_near_due->fetchAll(PDO::FETCH_ASSOC); // Fetch all tasks near the due date

// Count of near due tasks (optional)
$count_near_due_tasks = count($near_due_tasks); // Count of tasks that are near the due date




} catch (PDOException $e) {
    // Handle any errors
    echo "Connection failed: " . $e->getMessage();
    exit();
}
?>

<!-- Main content -->
<div class="row">
    
    <!-- Projects box -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?php echo $task_count_completed; ?><sup style="font-size: 20px"></sup></h3>
                <p>Finished Task</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3><?php echo $task_count_onGoing; ?><sup style="font-size: 20px"></sup></h3>
                <p>On Going</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
        </div>
    </div>
    <!-- Users box -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?php echo $task_count_NotStarted; ?></h3>
                <p>Not Started Task</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
        </div>
    </div>
    <!-- Staff box -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?php echo $count_near_due_tasks; ?></h3>
                <p>Due In 3 Days</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
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
                                    <th>Project Name</th>
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
