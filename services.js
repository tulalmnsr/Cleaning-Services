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

    // Initialize DataTable
    var dataTable = $('table').DataTable({
        "paging": false, // disable pagination since you have a custom one
        "info": false, // disable showing information
        "order": [], // disable initial sorting
        "columnDefs": [{
            "targets": 'no-sort', // columns with class 'no-sort' will not be sortable
            "orderable": false
        }]
    });
    
    
    // Pagination logic
    var table = $("table");
    var tbody = table.find("tbody");
    var rowsPerPage = 5;
    var currentPage = 1;

    function generatePaginationHtml(numPages) {
        var paginationContainer = $('<ul class="pagination"></ul>');

        paginationContainer.append('<li class="page-item"><a href="#" class="page-link" data-page="prev">Previous</a></li>');

        for (var i = 1; i <= numPages; i++) {
            var pageItem = $('<li class="page-item"></li>');
            var pageLink = $('<a href="#" class="page-link" data-page="' + i + '">' + i + '</a>');
            pageItem.append(pageLink);
            paginationContainer.append(pageItem);
        }

        paginationContainer.append('<li class="page-item"><a href="#" class="page-link" data-page="next">Next</a></li>');

        return paginationContainer;
    }

    function initPagination() {
        var numRows = tbody.find("tr").length;
        var numPages = Math.ceil(numRows / rowsPerPage);

        var paginationHtml = generatePaginationHtml(numPages);
        $(".pagination-container").html(paginationHtml);

        showPage(currentPage);
    }

    function showPage(page) {
        var start = (page - 1) * rowsPerPage;
        var end = start + rowsPerPage;

        tbody.find("tr").hide().slice(start, end).show();

        currentPage = page;

        $(".pagination a").removeClass("active");
        $(".pagination a[data-page='" + page + "']").addClass("active");
    }

    function changePage(page) {
        showPage(page);
    }

    function prevPage() {
        if (currentPage > 1) {
            showPage(currentPage - 1);
        }
    }

    function nextPage() {
        var numRows = tbody.find("tr").length;
        var numPages = Math.ceil(numRows / rowsPerPage);

        if (currentPage < numPages) {
            showPage(currentPage + 1);
        }
    }

    $(".pagination-container").on("click", ".pagination a", function (event) {
        event.preventDefault();

        var clickedPage = $(this).data("page");

        if (clickedPage === "prev") {
            prevPage();
        } else if (clickedPage === "next") {
            nextPage();
        } else {
            changePage(clickedPage);
        }
    });
    initPagination();

    
    
    
    initPagination();
    window.closeEditModal = function (editServiceId) {
        $("#editServiceModal").modal("hide");
        // Redirect to the current page
        window.location.href = window.location.href;
    };
    function closeAddServiceModal() {
        $("#addServiceModal").modal("hide");
        location.reload();

    }

    $("#addServiceForm").submit(function (e) {
        e.preventDefault(); // Prevent the default form submission behavior
    
        // Disable the submit button to prevent multiple submissions
        $("#submitBtn").prop("disabled", true);
    
        var serviceName = $("#serviceName").val();
        var serviceDesc = $("#servicedesc").val();
        var servicePrice = $("#servicePrice").val();
        var serviceTest = $("#servicetest").val();
    
        closeAddServiceModal();
        location.reload();
    
        $.ajax({
            type: "POST",
            url: "servicesadmin.php",
            data: {
                submit: true,
                serviceName: serviceName,
                servicedesc: serviceDesc,
                servicePrice: servicePrice,
                servicetest: serviceTest
            },
            success: function (response) {
                console.log(response);
        
                if (response && response.success) {
                    // Close the modal using Bootstrap's modal method
                    $('#addServiceModal').modal('hide');
        
                    // Scroll to the last page
                    var table = $('.table').DataTable();
                    var lastPage = table.page('last').draw('page');
        
                    // Reload the page after successful operation
                    location.reload();
                } else {
                    // Enable the submit button in case of failure
                    $("#submitBtn").prop("disabled", false);
        
                    // Handle errors if needed
                    console.log("Submission failed. Check the server response.");
                }
            },
            error: function (error) {
                // Enable the submit button in case of failure
                $("#submitBtn").prop("disabled", false);
        
                // Handle errors if needed
                console.log("Error submitting the form: " + error.responseText);
            }
        });
        $.ajax({
            type: "POST",
            url: "servicesadmin.php",
            data: {
                submit: true,
                serviceName: serviceName,
                servicedesc: serviceDesc,
                servicePrice: servicePrice,
                servicetest: serviceTest
            },
            success: function (response) {
                console.log(response);
        
                if (response && response.success) {
                    // Close the modal using Bootstrap's modal method
                    $('#addServiceModal').modal('hide');
        
                    // Scroll to the last page
                    var table = $('.table').DataTable();
                    var lastPage = table.page('last').draw('page');
        
                    // Reload the page after successful operation
                    location.reload();
                } else {
                    // Enable the submit button in case of failure
                    $("#submitBtn").prop("disabled", false);
        
                    // Handle errors if needed
                    console.log("Submission failed. Check the server response:", response);
                }
            },
            error: function (error) {
                // Enable the submit button in case of failure
                $("#submitBtn").prop("disabled", false);
        
                // Log the error to the console
                console.log("Error submitting the form:", error);
        
                // Handle errors if needed
                // You can display an alert or other user-friendly error message here
            }
        });
    });s
   

    window.toggleEditability = function (element) {
        console.log("toggleEditability called");
        var row = $(element).closest('tr');
        var cells = row.find('td.edit');
    
        if (!cells.hasClass('editing')) {
            cells.addClass('editing');
    
            var editServiceId = row.find('input[type="checkbox"]').val(); // Use val() instead of attr('value')
            var editServiceName = cells.eq(0).text();
            var editServiceDesc = cells.eq(1).text();
            var editServicePrice = cells.eq(2).text();
            var editServiceTest = cells.last().text();  // Update this line
    
            // Set data-edit-service-id attribute for the Save Changes button
            $("#editSubmitBtn").attr("data-edit-service-id", editServiceId);
    
            $("#editServiceId").val(editServiceId);
            $("#editServiceName").val(editServiceName);
            $("#editServiceDesc").val(editServiceDesc);
            $("#editServicePrice").val(editServicePrice);
            $("#editServiceTest").val(editServiceTest);
    
            $("#editServiceModal").modal("show");
        }
    };

   window.saveChanges = function () {
    var editServiceId = $("#editSubmitBtn").attr("data-edit-service-id");

    var editServiceName = $("#editServiceName").val();
    var editServiceDesc = $("#editServiceDesc").val();
    var editServicePrice = $("#editServicePrice").val();
    var editServiceTest = $("#editServiceTest").val();  // Assuming this is a text field
    var editServiceComment = $("#editServiceComment").val();  // Add this line

    closeEditModal(editServiceId);

    $.ajax({
        type: "POST",
        url: "servicesadmin.php",
        data: {
            save: true,
            editServiceId: editServiceId,
            editServiceName: editServiceName,
            editServiceDesc: editServiceDesc,
            editServicePrice: editServicePrice,
            editServiceTest: editServiceTest,
            editServiceComment: editServiceComment  // Add this line
        },
        success: function (response) {
            console.log(response);

            if (response && response.success) {
                var editedRow = $("table tbody tr").find('input[type="checkbox"][value="' + editServiceId + '"]').closest('tr');
                editedRow.find('td.edit:eq(0)').text(editServiceName);
                editedRow.find('td.edit:eq(1)').text(editServiceDesc);
                editedRow.find('td.edit:eq(2)').text(editServicePrice);
                editedRow.find('td.edit:eq(3)').text(editServiceTest);
                editedRow.find('td.edit:eq(4)').text(editServiceComment);  // Add this line

                editedRow.find('td.edit').removeClass('editing');

                // Reload the page after successful save changes
                location.reload();
            } else {
                console.log("Edit failed. Check the server response.");
            }
        },
    });
};

    $(".delete").click(function () {
        var selectedRows = [];
        var checkbox = $('table tbody input[type="checkbox"]');
        checkbox.each(function () {
            if (this.checked) {
                selectedRows.push($(this).closest('tr'));
            }
        });

        if (selectedRows.length > 0) {
            $("#deleteServiceModal").modal("show");
        }
    });

    window.confirmDelete = function () {
        var selectedRows = [];
        var checkbox = $('table tbody input[type="checkbox"]');
        checkbox.each(function () {
            if (this.checked) {
                selectedRows.push($(this).closest('tr'));
            }
        });
    
        selectedRows.forEach(function (row) {
            var serviceId = row.find('input[type="checkbox"]').val();
            deleteService(serviceId, row);
        });
    
        // Note: Remove the initPagination() call from here
    
        $("#deleteServiceModal").modal("hide");
    };
    
    function deleteService(serviceId, row) {
        $.ajax({
            type: "POST",
            url: "servicesadmin.php",
            data: {
                hide: true, // Indicate that it's a request to hide, not delete
                serviceId: serviceId
            },
            success: function (response) {
                console.log(response);
    
                if (response && response.success) {
                    // Remove the row after successful deletion
                    row.remove();
    
                    // Reload the page after successful operation if needed
                    // location.reload();
                } else {
                    console.log("Deletion failed. Check the server response:", response);
                }
            },
            error: function (error) {
                console.error("Error hiding service:", error);
    
                // Handle errors if needed
            }
        });
    }
    

});
