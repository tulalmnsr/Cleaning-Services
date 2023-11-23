$(document).ready(function () {

    // Activate tooltip
    $('[data-toggle="tooltip"]').tooltip();

    // Select/Deselect checkboxes
    var checkbox = $('table tbody input[type="checkbox"]');
    $("#selectAll").click(function () {
        if (this.checked) {
            checkbox.each(function () {
                this.checked = true;
            });
        } else {
            checkbox.each(function () {
                this.checked = false;
            });
        }
    });
    checkbox.click(function () {
        if (!this.checked) {
            $("#selectAll").prop("checked", false);
        }
    });

    var table = $('.table').DataTable();
if (table !== 'undefined' && table !== null) {
    table.destroy();
}



 
// Define the toggleVisibility function
window.toggleVisibility = function (element) {
    var icon = $(element).find('i');
    if (icon.text() === 'visibility') {
        icon.text('visibility_off');
        element.title="Publish";
        // Add your logic to hide the content or perform any other action
    } else {
        icon.text('visibility');
        element.title="Unpublish";
        // Add your logic to show the content or perform any other action
    }
};
    // Pagination
    var table = $("table");
    var tbody = table.find("tbody");
    var rowsPerPage = 5;
    var currentPage = 1;

    // Initialize pagination
    function initPagination() {
        var numRows = tbody.find("tr").length;
        var numPages = Math.ceil(numRows / rowsPerPage);

        // Add pagination links
        var paginationHtml = '<ul class="pagination">';
        paginationHtml += '<li class="page-item"><a href="#" class="page-link" onclick="prevPage()">Previous</a></li>';
        for (var i = 1; i <= numPages; i++) {
            paginationHtml += '<li class="page-item"><a href="#" class="page-link" onclick="changePage(' + i + ')">' + i + '</a></li>';
        }
        paginationHtml += '<li class="page-item"><a href="#" class="page-link" onclick="nextPage()">Next</a></li>';
        paginationHtml += '</ul>';
        $(".pagination-container").html(paginationHtml);

        // Show the first page
        showPage(currentPage);
    }

    // Show the specified page
    function showPage(page) {
        var start = (page - 1) * rowsPerPage;
        var end = start + rowsPerPage;

        // Hide all rows
        tbody.find("tr").hide();

        // Show the rows for the current page
        tbody.find("tr").slice(start, end).show();

        // Update current page
        currentPage = page;

        // Update active class for pagination links
        $(".pagination a").removeClass("active");
        $(".pagination a:contains(" + page + ")").addClass("active");
    }

    // Change to the specified page
    window.changePage = function (page) {
        showPage(page);
    };

    // Move to the previous page
    window.prevPage = function () {
        if (currentPage > 1) {
            showPage(currentPage - 1);
        }
    };

    // Move to the next page
    window.nextPage = function () {
        var numRows = tbody.find("tr").length;
        var numPages = Math.ceil(numRows / rowsPerPage);

        if (currentPage < numPages) {
            showPage(currentPage + 1);
        }
    };
    
    // Initialize pagination
    initPagination();
    $('table').DataTable({
        "paging": false, // disable pagination since you have a custom one
        "info": false, // disable showing information
        "order": [], // disable initial sorting
        "columnDefs": [{
            "targets": 'no-sort', // columns with class 'no-sort' will not be sortable
            "orderable": false
        }]
    });
    // Add new row and redirect to the last page
    function addNewRowAndRedirect() {
        // Add your logic to add a new row here

        // Reinitialize pagination
        initPagination();

        // Calculate the new number of pages
        var numRows = tbody.find("tr").length;
        var numPages = Math.ceil(numRows / rowsPerPage);

        // Redirect to the last page
        showPage(numPages);
    }

    // Delete button click event
    $(".delete").click(function () {
        var selectedRows = [];
        var checkbox = $('table tbody input[type="checkbox"]');
        checkbox.each(function () {
            if (this.checked) {
                selectedRows.push($(this).closest('tr'));
            }
        });

        // Show the delete confirmation modal if at least one row is selected
        if (selectedRows.length > 0) {
            $("#deleteServiceModal").modal("show");
        }
    });

    // Confirm delete function
    window.confirmDelete = function () {
        var selectedRows = [];
        var checkbox = $('table tbody input[type="checkbox"]');
        checkbox.each(function () {
            if (this.checked) {
                selectedRows.push($(this).closest('tr'));
            }
        });
        // Remove selected rows from the table
        selectedRows.forEach(function (row) {
            row.remove();
        });
        // Reinitialize pagination
        initPagination();

        // Hide the delete confirmation modal
        $("#deleteServiceModal").modal("hide");
    };
// Add this function to your existing JavaScript code
function toggleEditability(icon) {
    // Find the closest <tr> element
    var row = $(icon).closest('tr');

    // Find all <td> elements within the row, excluding the last two columns
    var cellsToEdit = row.find('td:lt(' + (row.children('td').length - 2) + ')');

    // Toggle the contenteditable attribute for each cell
    cellsToEdit.each(function () {
        var isEditable = $(this).attr('contenteditable') === 'true';
        $(this).attr('contenteditable', !isEditable);
    });
}

// Function to toggle visibility of the column
function toggleVisibility(icon) {
    var columnIndex = 4; // Index of the column to toggle (zero-based index)
    var rows = $("table tbody tr");

    rows.each(function () {
        var cell = $(this).find("td").eq(columnIndex);
        cell.toggle();
    });

    // Toggle the icon for visibility on/off
    var currentIcon = $(icon).find("i");
    if (currentIcon.text() === "visibility") {
        currentIcon.text("visibility_off");
    } else {
        currentIcon.text("visibility");
    }
}
// Add new service
$("#addServiceForm").submit(function (e) {
    e.preventDefault();
    var serviceName = $("#serviceName").val();
    var serviceDesc = $("#servicedesc").val();
    var servicePrice = $("#servicePrice").val();
    var serviceTest = $("#servicetest").val();

    // Add your logic to add a new row here
    var newRow = '<tr>' +
        '<td><span class="custom-checkbox">' +
        '<input type="checkbox" id="checkboxNew" name="options[]" value="1">' +
        '<label for="checkboxNew"></label>' +
        '</span></td>' +
        '<td contenteditable="false">' + serviceName + '</td>' +
        '<td contenteditable="false">' + serviceDesc + '</td>' +
        '<td contenteditable="false">' + servicePrice + '</td>' +
        '<td contenteditable="false">' +serviceTest + '</td>' +
        '<td>' +
        '<a href="#editServiceModal" class="edit" data-toggle="modal" onclick="toggleEditability(this)"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>' +
        '<a href="#" class="view" title="View" onclick="toggleVisibility(this)"><i class="material-icons" data-toggle="tooltip" title="Publish">&#xE8F4;</i></a>' +
        '</td>' +
        '</tr>';$(document).ready(function () {
            // Initialize DataTable only if not already initialized
            if (!$.fn.dataTable.isDataTable('.table')) {
                $('.table').DataTable({
                    "paging": false, // disable default pagination since you have a custom one
                    "info": false, // disable showing information
                    "order": [], // disable initial sorting
                    "columnDefs": [{
                        "targets": 'no-sort', // columns with class 'no-sort' will not be sortable
                        "orderable": false
                    }]
                });
            }
        
            // Activate tooltip
            $('[data-toggle="tooltip"]').tooltip();
        
            // Select/Deselect checkboxes
            var checkbox = $('table tbody input[type="checkbox"]');
            $("#selectAll").click(function () {
                checkbox.prop("checked", this.checked);
            });
        
            checkbox.click(function () {
                if (!this.checked) {
                    $("#selectAll").prop("checked", false);
                }
            });
        
            // Function to toggle contenteditable attribute for cells
            function toggleEditability(icon) {
                var row = $(icon).closest('tr');
                var cellsToEdit = row.find('td:lt(' + (row.children('td').length - 2) + ')');
                cellsToEdit.prop('contenteditable', function (_, value) {
                    return value === 'false';
                });
            }
        
            // Define the toggleVisibility function
            window.toggleVisibility = function (element) {
                var icon = $(element).find('i');
                if (icon.text() === 'visibility') {
                    icon.text('visibility_off');
                } else {
                    icon.text('visibility');
                }
            };
        
            // Pagination
            var table = $('.table').DataTable();
            var tbody = table.body($('tbody'));
        
            var rowsPerPage = 5;
            var currentPage = 1;
        
            // Initialize pagination
            function initPagination() {
                var numRows = tbody[0].childNodes.length;
                var numPages = Math.ceil(numRows / rowsPerPage);
        
                // Add pagination links
                var paginationHtml = '<ul class="pagination">';
                paginationHtml += '<li class="page-item"><a href="#" class="page-link" onclick="prevPage()">Previous</a></li>';
                for (var i = 1; i <= numPages; i++) {
                    paginationHtml += '<li class="page-item"><a href="#" class="page-link" onclick="changePage(' + i + ')">' + i + '</a></li>';
                }
                paginationHtml += '<li class="page-item"><a href="#" class="page-link" onclick="nextPage()">Next</a></li>';
                paginationHtml += '</ul>';
                $(".pagination-container").html(paginationHtml);
        
                // Show the first page
                showPage(currentPage);
            }
        
            // Show the specified page
            function showPage(page) {
                var start = (page - 1) * rowsPerPage;
                var end = start + rowsPerPage;
        
                // Hide all rows
                tbody.find("tr").hide();
        
                // Show the rows for the current page
                tbody.find("tr").slice(start, end).show();
        
                // Update current page
                currentPage = page;
        
                // Update active class for pagination links
                $(".pagination a").removeClass("active");
                $(".pagination a:contains(" + page + ")").addClass("active");
            }
        
            // Change to the specified page
            window.changePage = function (page) {
                showPage(page);
            };
        
            // Move to the previous page
            window.prevPage = function () {
                if (currentPage > 1) {
                    showPage(currentPage - 1);
                }
            };
        
            // Move to the next page
            window.nextPage = function () {
                var numRows = tbody.find("tr").length;
                var numPages = Math.ceil(numRows / rowsPerPage);
        
                if (currentPage < numPages) {
                    showPage(currentPage + 1);
                }
            };
        
            // Initialize pagination
            initPagination();
        
            // Add new row and redirect to the last page
            function addNewRowAndRedirect() {
                // Add your logic to add a new row here
        
                // Reinitialize pagination
                initPagination();
        
                // Calculate the new number of pages
                var numRows = tbody.find("tr").length;
                var numPages = Math.ceil(numRows / rowsPerPage);
        
                // Redirect to the last page
                showPage(numPages);
            }
        
            // Delete button click event
            $(".delete").click(function () {
                var selectedRows = [];
                var checkbox = $('table tbody input[type="checkbox"]');
                checkbox.each(function () {
                    if (this.checked) {
                        selectedRows.push($(this).closest('tr'));
                    }
                });
        
                // Show the delete confirmation modal if at least one row is selected
                if (selectedRows.length > 0) {
                    $("#deleteServiceModal").modal("show");
                }
            });
        
            // Confirm delete function
            window.confirmDelete = function () {
                var selectedRows = [];
                var checkbox = $('table tbody input[type="checkbox"]');
                checkbox.each(function () {
                    if (this.checked) {
                        selectedRows.push($(this).closest('tr'));
                    }
                });
                // Remove selected rows from the table
                selectedRows.forEach(function (row) {
                    table.row(row).remove().draw(false);
                });
                // Reinitialize pagination
                initPagination();
        
                // Hide the delete confirmation modal
                $("#deleteServiceModal").modal("hide");
            };
        
            // Add this function to your existing JavaScript code
            window.toggleEditability = function (icon) {
                // Find the closest <tr> element
                var row = $(icon).closest('tr');
        
                // Find all <td> elements within the row, excluding the last two columns
                var cellsToEdit = row.find('td:lt(' + (row.children('td').length - 2) + ')');
        
                // Toggle the contenteditable attribute for each cell
                cellsToEdit.prop('contenteditable', function (_, value) {
                    return value === 'false';
                });
            };
        
            // Function to toggle visibility of the column
            window.toggleVisibility = function (icon) {
                var columnIndex = 4; // Index of the column to toggle (zero-based index)
                var rows = table.rows().nodes();
        
                rows.forEach(function (row) {
                    var cell = $(row).find("td").eq(columnIndex);
                    cell.toggle();
                });
        
                // Toggle the icon for visibility on/off
                var currentIcon = $(icon).find("i");
                if (currentIcon.text() === "visibility") {
                    currentIcon.text("visibility_off");
                } else {
                    currentIcon.text("visibility");
                }
            };
        
            // Add new service
            $("#addServiceForm").submit(function (e) {
                e.preventDefault();
                var serviceName = $("#serviceName").val();
                var serviceDesc = $("#servicedesc").val();
                var servicePrice = $("#servicePrice").val();
                var serviceTest = $("#servicetest").val();
        
                // Add your logic to add a new row here
                var newRow = [
                    '<span class="custom-checkbox">',
                    '<input type="checkbox" id="checkboxNew" name="options[]" value="1">',
                    '<label for="checkboxNew"></label>',
                    '</span>',
                    serviceName,
                    serviceDesc,
                    servicePrice,
                    serviceTest,
                    '<a href="#editServiceModal" class="edit" data-toggle="modal" onclick="toggleEditability(this)"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>' +
                    '<a href="#" class="view" title="View" onclick="toggleVisibility(this)"><i class="material-icons" data-toggle="tooltip" title="Publish">&#xE8F4;</i></a>'
                ];
        
                // Add the new row to DataTable
                table.row.add(newRow).draw(false);
        
                // Hide the modal
                $("#addServiceModal").modal("hide");
            });
        });
        
    tbody.append(newRow);
    initPagination();
    var numRows = tbody.find("tr").length;
    var numPages = Math.ceil(numRows / rowsPerPage);
    showPage(numPages);
    $("#addServiceModal").modal("hide");
});
});