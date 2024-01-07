$(document).ready(function () {
    
    // Initialize DataTable
    var tableSettings = {
        "order": [[2, 'desc']], // Default sorting by the third column (Date Created)
        "pageLength": 5, // Maximum 5 rows per page
        "searching": true, // Enable search bar
        "paging": true, // Enable pagination
        "deferRender": true, // Improve performance with large tables
        "stateSave": true, // Enable state saving
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
        
        
    };
   
    var dataTable = $('#teamTable').DataTable(tableSettings);
    
    // Handle radio button change for status filter
    $('input[name="status"]').on('change', function () {
        var status = $(this).val();
        if (status === 'Expired') {
            $(this).find('td:eq(4) span').removeClass('badge-warning').addClass('badge-danger');
        }
        // Use DataTables API to filter the table
        if (status === 'all') {
            dataTable.columns(4).search('').draw();
        } else {
            dataTable.columns(4).search(status, true, false).draw();
        }
    });

    // Custom filter for exact match
    $.fn.dataTable.ext.search.push(function (settings, searchData) {
        var statusFilter = $('input[name="status"]:checked').val();

        if (statusFilter === 'all') {
            return true;
        }

        var statusColumn = searchData[4];
        return statusColumn === statusFilter;
    });

    // Debugging - Log DataTable search value and data after each draw
    $('#teamTable').on('search.dt draw.dt', function () {
        console.log('DataTable search value: ', dataTable.search());
        console.log('DataTable data: ', dataTable.data().toArray());
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
    // Handle "Manage" button click
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

    // Check if the application is 30 days old
    var currentDate = new Date();
    var applicationDate = new Date(dateCreated);
    var daysDifference = Math.floor((currentDate - applicationDate) / (1000 * 60 * 60 * 24));

    // Open the modal with member details
    var manageMemberModal = $('#manageMemberModal');
    manageMemberModal.modal('show');

    // Update modal content with member details
    manageMemberModal.find('#memberId').text(memberId);
    manageMemberModal.find('#memberName').text(memberName);
    manageMemberModal.find('#dateCreated').text(dateCreated);
    manageMemberModal.find('#role').text(role);
    manageMemberModal.find('#status').text(status);

    // Additional: Update member photo
    manageMemberModal.find('#memberPhoto').attr('src', memberPhotoSrc);

    // Display a more professional alert for expired applications
    if (daysDifference >= 30) {
        updateMemberStatus('Expired');
        updateMemberInDatabase('Expired');
    }

    // ... rest of your code
});
    // Handle "Accept" button click
    $('#acceptApplication').on('click', function () {
        updateMemberStatus('Active');
        updateMemberInDatabase('Active');
        $('#manageMemberModal').modal('hide');
    });

    // Handle "Reject" button click
    $('#rejectApplication').on('click', function () {
        updateMemberStatus('Inactive');
        updateMemberInDatabase('Inactive');
        $('#manageMemberModal').modal('hide');
    });
    $('#expireApplication').on('click', function () {
        updateMemberStatus('Expired');
        updateMemberInDatabase('Expired');
        $('#manageMemberModal').modal('hide');
    });

    // Function to update member status in the table
    function updateMemberStatus(status) {
        var memberId = $('#manageMemberModal #memberId').text();
        $('#teamTableBody').find('tr').each(function () {
            var rowMemberId = $(this).find('td:first').text();
            if (rowMemberId === memberId) {
                var badgeClass;
                switch (status) {
                    case 'Active':
                        badgeClass = 'badge-success';
                        break;
                    case 'Inactive':
                        badgeClass = 'badge-warning';
                        break;
                    case 'Expired':
                        badgeClass = 'badge-danger';
                        break;
                    default:
                        badgeClass = '';
                }
                $(this).find('td:eq(4) span').removeClass().addClass('badge ' + badgeClass).text(status);
                
                // Explicitly set the class for 'Expired' status
                
                if (status === 'Expired') {
                    $(this).find('td:eq(4) span').removeClass('badge-warning').addClass('badge-danger');
                }
                return false; // Break out of the loop
            }
        });
    }
    
    
    

    // Function to update member status in the database
    function updateMemberInDatabase(status) {
        var memberId = $('#manageMemberModal #memberId').text();
        $.ajax({
            type: 'POST',
            url: 'team.php',
            data: { memberId: memberId, status: status },
            success: function (response) {
                console.log('AJAX Success:', response);
                // Update member status in the table
                updateMemberStatus(status);
            },
            error: function (error) {
                console.error('AJAX Error:', error);
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
    var initialStatus = $('input[name="status"]:checked').val();
if (initialStatus !== 'all') {
    dataTable.columns(4).search(initialStatus, true, false).draw();
}
});
