<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Menu Form</title>
    <!-- Add Bootstrap 5 CSS Link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Add Sweet Alert CSS and JS Links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
</head>
<body>
    <div class="container mt-5">
        <form method="post" action="insert_menu.php">
            <div class="form-group">
                <label for="menuName">Menu Name</label>
                <input type="text" class="form-control" id="menuName" name="menuName" required>
            </div>
            <div class="form-group">
                <label for="menuDescription">Menu Description</label>
                <textarea class="form-control" id="menuDescription" name="menuDescription" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Add Bootstrap 5 JS Link (Popper.js and Bootstrap JS) -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <!-- Add Sweet Alert JS Link -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
</body>
</html>