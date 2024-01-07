<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = mysqli_connect("localhost", "root", "root", "cleaning");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to handle adding a new user
function addUser()
{
    global $conn;

    if (isset($_POST['add'])) {
        $fullname = $_POST['userName'];
        $role = $_POST['userRole'];

        // Check for file upload errors
        if ($_FILES["userPhoto"]["error"] > 0) {
            die("File upload error: " . $_FILES["userPhoto"]["error"]);
        }

        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["userPhoto"]["name"]);

        // Move the uploaded file to the target location
        if (move_uploaded_file($_FILES["userPhoto"]["tmp_name"], $target_file)) {
            // Insert data into the database using prepared statement
            $sql = "INSERT INTO team_members (Fullname, Datecreated, Role, Status, Image) VALUES (?, NOW(), ?, 'Inactive', ?)";
            $stmt = $conn->prepare($sql);

            // Bind parameters
            $stmt->bind_param("sss", $fullname, $role, $target_file);

            // Execute the statement
            if ($stmt->execute()) {
                // Close the statement
                $stmt->close();

                // Redirect to the same page after adding a new record
                header("Location: {$_SERVER['PHP_SELF']}");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            die("Error moving uploaded file.");
        }
    }
}

// Function to update member status in the database
function updateMemberStatus()
{
    global $conn;

    if (isset($_POST['memberId'], $_POST['status'])) {
        $memberId = intval($_POST['memberId']);
        $status = $_POST['status'];

        // Validate the status (optional)
        if (!in_array($status, ['Active', 'Inactive', 'Expired'])) {
            echo "Invalid status";
            exit();
        }

        // Update the status in the database
        $sql = "UPDATE team_members SET Status = ? WHERE Member_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $status, $memberId);

        if ($stmt->execute()) {
            echo "Status updated successfully";
        } else {
            echo "Error updating status: " . $stmt->error;
        }

        $stmt->close();
    }
}

// Handle adding a new user
addUser();

// Handle updating member status
updateMemberStatus();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Team Members</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
    <link rel="stylesheet" href="team.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="Team.js"></script>
</head>

<body>
    <h1 class="text-center font-weight-bold m-5">Team Members</h1>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6 p-3">
                            <h3>Team Members</h3>
                        </div>
                        <div class="col-sm-6">
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-info active">
                                    <input type="radio" name="status" value="all" checked="checked"> All
                                </label>
                                <label class="btn btn-success">
                                    <input type="radio" name="status" value="Active"> Active
                                </label>
                                <label class="btn btn-warning">
                                    <input type="radio" name="status" value="Inactive"> Inactive
                                </label>
                                <label class="btn btn-danger">
                                    <input type="radio" name="status" value="Expired"> Expired
                                </label>
                            </div>
                            <div class="col-sm-7 class2">
                                <button type="button" class="btn btn-secondary class1" data-toggle="modal" data-target="#addUserModal">
                                    <i class="material-icons">&#xE147;</i> <span>Add New User</span>
                                </button>
                                <a href="#" class="btn btn-secondary class1" id="exportBtn"><i class="material-icons">&#xE24D;</i> <span>Export to Excel</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <table id="teamTable" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Date Created</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="teamTableBody">

                        <?php
                        $query = "SELECT Member_id, Fullname, Datecreated, Role, Status, Image FROM team_members";
                        $result = $conn->query($query);

                        // Check if the query was successful
                        if ($result) {
                            // Fetch associative array
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr data-status="' . $row["Status"] . '">';
                                echo '<td>' . $row["Member_id"] . '</td>';
                                echo '<td><a href="#"><img src="' . $row["Image"] . '" class="avatar" alt="Avatar"> ' . $row["Fullname"] . '</a></td>';
                                echo '<td>' . $row["Datecreated"] . '</td>';
                                echo '<td>' . $row["Role"] . '</td>';
                                echo '<td><span class="badge badge-' . ($row["Status"] == 'Active' ? 'success' : 'warning') . '">' . $row["Status"] . '</span></td>';
                                echo '<td><a href="#" class="manage btn-sm">Manage</a></td>';
                                echo '</tr>';
                            }
                        } else {
                            // Handle the error if the query fails
                            echo "Error: " . $query . "<br>" . $conn->error;
                        }
                        ?>

                    </tbody>
                </table>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Add New User Modal -->
        <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
            <form id="addUserForm" method="POST" action="team.php" enctype="multipart/form-data" name="add">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Your form content goes here -->
                            <div class="form-group">
                                <label for="userPhoto">Upload Photo</label>
                                <input type="file" class="form-control-file" id="userPhoto" name="userPhoto" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="userName">Name</label>
                                <input type="text" class="form-control" id="userName" name="userName" required>
                            </div>
                            <div class="form-group">
                                <label for="userRole">Role</label>
                                <input type="text" class="form-control" id="userRole" name="userRole" required>
                            </div>
                            <button type="submit" class="btn btn-primary" id="add" name="add">Add User</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Display member details here -->
        <div class="modal fade" id="manageMemberModal" tabindex="-1" role="dialog" aria-labelledby="manageMemberModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="manageMemberModalLabel">Manage Member</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Add more lines to display other member details -->
                        <img id="memberPhoto" class="img-fluid mb-2" alt="Member Photo">
                        <p><b>Member ID: </b><span id="memberId"></span></p>
                        <p><b>Member Name: </b><span id="memberName"></span></p>
                        <p><b>Date Created: </b><span id="dateCreated"></span></p>
                        <p><b>Role: </b><span id="role"></span></p>
                        <p><b>Status: </b><span id="status"></span></p>
                    </div>
                    <!-- Accept and Reject buttons -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="acceptApplication">Accept</button>
                        <button type="button" class="btn btn-danger" id="rejectApplication">Reject</button>
                        <button type="button" class="btn btn-dark" id="expireApplication">Expired</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>