<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = mysqli_connect("localhost", "root", "root", "cleaning");

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
	$serviceName = $_POST['serviceName'];
	$serviceDesc = $_POST['servicedesc'];
	$servicePrice = $_POST['servicePrice'];
	$serviceAbout = $_POST['servicetest'];

	$serviceAbout = nl2br($_POST['servicetest']);
	$sql = "INSERT INTO services_admin (Service_name, Description, Price, About_service) VALUES ('$serviceName','$serviceDesc' ,'$servicePrice', '$serviceAbout')";


	if (mysqli_query($conn, $sql)) {
		header("Location: servicesadmin.php");
	} else {
		echo "Error: " . $sql . "" . mysqli_error($conn);
	}
}
if (isset($_POST['serviceId'])) {
	$serviceId = $_POST['serviceId'];

	// Perform the deletion from the database
	$sql = "DELETE FROM services_admin WHERE Service_id = '$serviceId'";
	if (mysqli_query($conn, $sql)) {
		header("Location: servicesadmin.php");
	} else {
		echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
	}
}
// Handle the form submission for editing
if (isset($_POST['save'])) {
	$editServiceId = $_POST['editServiceId'];
	$editServiceName = $_POST['editServiceName'];
	$editServiceDesc = $_POST['editServiceDesc'];
	$editServicePrice = $_POST['editServicePrice'];
	$editServiceTest = $_POST['editServiceTest'];

	$sql = "UPDATE services_admin SET Service_name = '$editServiceName', Description = '$editServiceDesc', Price = '$editServicePrice', About_service = '$editServiceTest' WHERE Service_id = '$editServiceId'";
	if (mysqli_query($conn, $sql)) {
		header("Location: servicesadmin.php");
	} else {
		echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Services</title>
	<link rel="stylesheet" href="servicesadmin.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.4/css/select.dataTables.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
	<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<script src="services.js"></script>
	<style>
		.dataTable_empty {
			display: none;
		}
	</style>
</head>

<body>
	<h2>Manage Services</h2>
	<div class="container-xl">
		<div class="table-responsive">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row">
						<div class="col-sm-6">
							<h3>Services</h3>
						</div>
						<div class="col-sm-6">
							<a href="#" class="btn btn-success" data-toggle="modal" data-target="#addServiceModal"><i class="material-icons">&#xE147;</i> <span>Add New
									Service</span></a>
							<a href="#deleteServiceModal" class="btn btn-danger" data-toggle="modal" data-target="#deleteServiceModal"><i class="material-icons">&#xE15C;</i>
								<span>Delete</span></a>
						</div>
					</div>
				</div>
				<div class="table-container">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>
									<span class="custom-checkbox resize-handle">
										<input type="checkbox" id="selectAll">
										<label for="selectAll"></label>
									</span>
								</th>
								<th class='resize-handle'>Name</th>
								<th class='resize-handle'>Description</th>
								<th class='resize-handle'>Price$</th>
								<th class="no-sort resize-handle">Comment</th>
								<th class="no-sort resize-handle">Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$sql = "SELECT Service_id, Service_name, Description, Price, About_service FROM services_admin";
							$result = mysqli_query($conn, $sql);

							// Display data in the table
							while ($row = mysqli_fetch_assoc($result)) {
								echo "<tr>";
								echo "<td class='comment-column service-name'><span class='custom-checkbox'><input type='checkbox' id='checkbox{$row['Service_id']}' name='options[]' value='{$row['Service_id']}'><label for='checkbox{$row['Service_id']}'></label></span></td>";
								echo "<td class='edit service-name'>{$row['Service_name']}</td>";
								echo "<td contenteditable='false' class='edit comment-column'>" . nl2br($row['Description']) . "</td>";
								echo "<td contenteditable='false' class='edit'>{$row['Price']}</td>";
								echo "<td contenteditable='false' class='edit comment-column'>" . nl2br($row['About_service']) . "</td>";
								echo "<td>";
								echo "<a href='#editServiceModal' class='edit' data-toggle='modal' onclick='toggleEditability(this)'><i class='material-icons' name='edit' data-toggle='tooltip' title='Edit'>&#xE254;</i></a>";
								echo "</td>";
								echo "</tr>";
							}
							?>

						</tbody>

					</table>
				</div>
				<div class="clearfix">
					<ul class="pagination">
						<div class="pagination-container"></div>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- Add Modal HTML -->
	<div class="modal" id="addServiceModal" tabindex="-1" role="dialog" aria-labelledby="addServiceModalLabel" aria-hidden="true">
		<form id="addServiceForm" method='post' action='servicesadmin.php'>
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Add Service</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="serviceName">Name <span style="color: red;">*</span></label>
							<input type="text" class="form-control" id="serviceName" name="serviceName" required>
						</div>
						<div class="form-group">
							<label for="servicedesc">Description <span style="color: red;">*</span> </label>
							<textarea class="form-control" id="servicedesc" name="servicedesc" required></textarea>
						</div>
						<div class="form-group">
							<label for="servicePrice">Price <span style="color: red;">*</span></label>
							<input type="number" class="form-control" id="servicePrice" name="servicePrice" required>
						</div>
						<div class="form-group">
							<label for="servicetest">Comment</label>
							<textarea class="form-control" id="servicetest" name="servicetest"></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal"></button>
						<input type="submit" id="submitBtn" name="submit" class="btn btn-success" onclick="closeAddServiceModal();">
					</div>
				</div>
			</div>
		</form>
	</div>
	<!-- Delete Modal HTML -->
	<div id="deleteServiceModal" class="modal fade">
		<form method='post' action='servicesadmin.php'>
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Delete Service</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<p>Are you sure you want to delete these Records?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						<button type="button" class="btn btn-danger delete" name="delete" onclick="confirmDelete()">Confirm
							Delete</button>
					</div>
				</div>
			</div>
		</form>
	</div>
	<!-- Edit Modal HTML -->
	<div id="editServiceModal" class="modal fade">
		<form id="editServiceForm" method="post" action="servicesadmin.php">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Edit Service</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="editServiceName">Name</label>
							<input type="text" class="form-control" id="editServiceName" name="editServiceName">
							<div class="form-group">
								<label for="editServiceDesc">Description</label>
								<textarea type="text" class="form-control" id="editServiceDesc" name="editServiceDesc"></textarea>
							</div>
							<!-- Example additional field (Price) -->
							<div class="form-group">
								<label for="editServicePrice">Price $</label>
								<input type="text" class="form-control" id="editServicePrice" name="editServicePrice">
							</div>
							<!-- Example additional field (Test) -->
							<div class="form-group">
								<label for="editServiceTest">Comment</label>
								<textarea class="form-control" id="editServiceTest" name="editServiceTest"></textarea>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" onclick="closeEditModal()">Close</button>
							<button type="button" class="btn btn-success" name="save" id="editSubmitBtn" data-edit-service-id="" onclick="saveChanges()">Save Changes</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</body>
<script>
	document.addEventListener('DOMContentLoaded', function() {
		const tableContainer = document.querySelector('.table-container');
		const resizeHandle = document.querySelector('.resize-handle');
		let isResizing = false;

		resizeHandle.addEventListener('mousedown', function(event) {
			isResizing = true;

			document.addEventListener('mousemove', handleMouseMove);
			document.addEventListener('mouseup', function() {
				isResizing = false;
				document.removeEventListener('mousemove', handleMouseMove);
			});
		});

		function handleMouseMove(event) {
			if (isResizing) {
				const newWidth = event.clientX - tableContainer.getBoundingClientRect().left;
				tableContainer.style.width = `${newWidth}px`;
			}
		}
	});
</script>


</html>