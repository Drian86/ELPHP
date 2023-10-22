<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Menu Form</title>
    <!-- Add Bootstrap 5 CSS Link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <form method="post" action="insert_menu.php">
            <div class="form-group">
                <label for="Menu_Name">Menu Name</label>
                <input type="text" class="form-control" id="Menu_Name" name="Menu_Name" required>
            </div>
            <div class="form-group">
                <label for="Menu_Desc">Menu Description</label>
                <textarea class="form-control" id="Menu_Desc" name="Menu_Desc" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-success" id="updateBtn">Update</button>
            <button type="button" class="btn btn-danger" id="deleteBtn">Delete</button>
            <!-- Hidden input field to store the Menu ID for updating and deleting -->
            <input type="hidden" id="Menu_ID" name="Menu_ID">
        </form>
        <hr>
        <div id="menuList">
            <!-- Menu items will be displayed here -->
        </div>
    </div>

    <!-- Modal for Confirming Deletion -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this menu item?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Updating Data -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update Menu Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updateForm">
                        <div class="form-group">
                            <label for="Update_Menu_Name">Menu Name</label>
                            <input type="text" class="form-control" id="Update_Menu_Name" name="Update_Menu_Name" required>
                        </div>
                        <div class="form-group">
                            <label for="Update_Menu_Desc">Menu Description</label>
                            <textarea class="form-control" id="Update_Menu_Desc" name="Update_Menu_Desc" rows="3" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="updateData">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Add Bootstrap 5 JS Link (Popper.js and Bootstrap JS) -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <script>
        // Function to populate the update form fields
        function populateUpdateForm(menuName, menuDesc, menuID) {
            $('#Update_Menu_Name').val(menuName);
            $('#Update_Menu_Desc').val(menuDesc);
            $('#Menu_ID').val(menuID);
        }

        // When an item is clicked for update
        $('#updateBtn').click(function () {
            var menuName = $('#Menu_Name').val();
            var menuDesc = $('#Menu_Desc').val();

            // Use this function to populate the form fields with the existing data
            // You need to determine how to get the menuID, perhaps from a list or a database query
            // Example data:
            var menuID = 123; // Replace with your actual menu ID

            // Populate the update form
            populateUpdateForm(menuName, menuDesc, menuID);

            // Show the update modal
            $('#updateModal').modal('show');
        });

        // When the "Delete" button is clicked
        $('#deleteBtn').click(function () {
            // Show the confirmation modal
            $('#deleteModal').modal('show');
        });

        // When the "Delete" button in the confirmation modal is clicked
        $('#confirmDelete').click(function () {
            // Handle the deletion here (you can use AJAX)
            var menuName = $('#Menu_Name').val();
            var menuDesc = $('#Menu_Desc').val();

            // Send an AJAX request to the server to delete data from the database
            $.ajax({
                type: "POST",
                url: "delete_menu.php",
                data: { Menu_Name: menuName, Menu_Desc: menuDesc },
                success: function (response) {
                    // Handle the response, e.g., display a success message
                    if (response === 'success') {
                        alert('Data deleted successfully.');
                        // Clear the input fields
                        $('#Menu_Name').val('');
                        $('#Menu_Desc').val('');
                    } else {
                        alert('Error: Unable to delete data.');
                    }
                    // Close the confirmation modal
                    $('#deleteModal').modal('hide');
                }
            });
        });

        // When the "Save Changes" button in the update modal is clicked
        $('#updateData').click(function () {
            var updatedMenuName = $('#Update_Menu_Name').val();
            var updatedMenuDesc = $('#Update_Menu_Desc').val();
            var menuID = $('#Menu_ID').val();

            // Send an AJAX request to update the data in the database
            $.ajax({
                type: "POST",
                url: "update_menu.php",
                data: {
                    Update_Menu_Name: updatedMenuName,
                    Update_Menu_Desc: updatedMenuDesc,
                    Menu_ID: menuID
                },
                success: function (response) {
                    // Handle the response, e.g., display a success message
                    if (response === 'success') {
                        alert('Data updated successfully.');
                        // Clear the input fields
                        $('#Update_Menu_Name').val('');
                        $('#Update_Menu_Desc').val('');
                        $('#Menu_ID').val('');
                        // Close the update modal
                        $('#updateModal').modal('hide');
                    } else {
                        alert('Error: Unable to update data.');
                    }
                }
            });
        });
    </script>
</body>
</html>
