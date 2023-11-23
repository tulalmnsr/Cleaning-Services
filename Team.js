$(document).ready(function () {
    var dataTable = $('#teamTable').DataTable({
        "order": [[2, 'desc']], // Default sorting by the third column (Date Created)
        "pageLength": 5, // Maximum 5 rows per page
        "searching": true, // Enable search bar
        "paging": true, // Enable pagination
        "deferRender": true, // Improve performance with large tables
        "columnDefs": [
            {
                targets: 2, // Index of the Date Created column
                type: 'datetime', // Use the datetime type for sorting
                render: function (data, type, row) {
                    var date = new Date(data);
                    return moment(date).format('YYYY-MM-DD');
                }
            }
        ]
    });

    // Export button click event
    $('#exportBtn').on('click', function () {
        exportToExcel();
    });

    // Function to export data to Excel
    function exportToExcel() {
        // Get the table data
        var table = $('#teamTable')[0];
        var ws = XLSX.utils.table_to_sheet(table);

        // Create a workbook with a single sheet
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Sheet1");

        // Save the workbook as an Excel file
        var fileName = 'team_data_' + getCurrentDate() + '.xlsx';
        XLSX.writeFile(wb, fileName);
    }


    // Clear form fields when the modal is shown
    $('#userName').val('');
    $('#userRole').val('');
    $('#userPhoto').val('');

    // Handle form submission
    $('#addUserForm').submit(function (e) {
        e.preventDefault();

        // Get form values
        var name = $('#userName').val();
        var role = $('#userRole').val();

        // Add a new row to the table (prepend instead of append)
        var newRow = '<tr data-status="active">' +
            '<td>' + ($('#teamTableBody tr').length + 1) + '</td>' +
            '<td><a href="#"><img src="avatar-placeholder.png" class="avatar" alt="Avatar">' + name + '</a></td>' +
            '<td>' + getCurrentDate() + '</td>' +
            '<td>' + role + '</td>' +
            '<td><span class="badge badge-success">Active</span></td>' +
            '<td><a href="#" class="manage btn-sm">Manage</a></td>' +
            '</tr>';

        // Prepend the new row to the table
        $('#teamTableBody').prepend(newRow);

        // Close the modal
        $('#addUserModal').modal('hide');
    });

    // Handle "Manage" button click
    $('#teamTableBody').on('click', '.manage', function (e) {
        e.preventDefault();

        // Retrieve member details from the row
        var memberId = $(this).closest('tr').find('td:first').text();
        var memberName = $(this).closest('tr').find('td:eq(1)').text();
        var dateCreated = $(this).closest('tr').find('td:eq(2)').text();
        var role = $(this).closest('tr').find('td:eq(3)').text();
        var status = $(this).closest('tr').find('td:eq(4)').text();

        // Additional: Get the member's photo source
        var memberPhotoSrc = $(this).closest('tr').find('img').attr('src');

        // Open a modal with member details
        $('#manageMemberModal').modal('show');

        // Update modal content with member details
        $('#manageMemberModal #memberId').text(memberId);
        $('#manageMemberModal #memberName').text(memberName);
        $('#manageMemberModal #dateCreated').text(dateCreated);
        $('#manageMemberModal #role').text(role);
        $('#manageMemberModal #status').text(status);

        // Additional: Update member photo
        $('#manageMemberModal #memberPhoto').attr('src', memberPhotoSrc);
    });

    // Handle "Accept" button click
    $('#acceptApplication').on('click', function () {
        // Add logic to update member status to "Active" and close the modal
        // You may want to make an AJAX request to update the status on the server
        updateMemberStatus('Active');
        $('#manageMemberModal').modal('hide');
    });

    // Handle "Reject" button click
    $('#rejectApplication').on('click', function () {
        // Add logic to update member status to "Inactive" and close the modal
        // You may want to make an AJAX request to update the status on the server
        updateMemberStatus('Inactive');
        $('#manageMemberModal').modal('hide');
    });

    // Handle radio button change for status filter
    $('input[name="status"]').on('change', function () {
        var status = $(this).val();

        // Show all rows by default
        $('#teamTable tbody tr').show();

        // If a specific status is selected, hide rows with other statuses
        if (status !== 'all') {
            $('#teamTable tbody tr').filter('[data-status!="' + status + '"]').hide();
        }
    });

    // Reset filter when modal is closed
    $('#addUserModal, #manageMemberModal').on('hidden.bs.modal', function () {
        // Show all rows
        $('#teamTable tbody tr').show();

        // Reset radio button to show all
        $('input[name="status"][value="all"]').prop('checked', true);
    });

    // Function to update member status
    function updateMemberStatus(status) {
        // Get the memberId from the modal
        var memberId = $('#manageMemberModal #memberId').text();

        // Update the status in the table
        $('#teamTableBody').find('tr').each(function () {
            var rowMemberId = $(this).find('td:first').text();
            if (rowMemberId === memberId) {
                // Assuming the status column is the fifth column
                var badgeColor = (status === 'Active') ? 'success' : 'warning';
                $(this).find('td:eq(4)').html('<span class="badge badge-' + badgeColor + '">' + status + '</span>');
                return false; // Break out of the loop
            }
        });
    }

    // Function to get the current date in 'MM/DD/YYYY' format
    function getCurrentDate() {
        var currentDate = new Date();
        var month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
        var day = currentDate.getDate().toString().padStart(2, '0');
        var year = currentDate.getFullYear();
        return year + '-' + month + '-' + day;
    }
});
