<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish a database connection (replace with your own database details)
    $db_host = 'localhost';
    $db_user = 'root';
    $db_password = '';
    $db_name = 'addMenuDB';

    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Handle form submission for adding a new menu item or updating an existing menu item
    if (isset($_POST['Menu_Name'], $_POST['Menu_Desc'])) {
        $menuName = $_POST['Menu_Name'];
        $menuDescription = $_POST['Menu_Desc'];

        if (empty($_POST['Menu_ID'])) {
            // If Menu_ID is empty, it's a new menu item
            $sql = "INSERT INTO addMenudb (Menu_Name, Menu_Desc) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $menuName, $menuDescription);
        } else {
            // If Menu_ID is set, it's an update
            $menuID = $_POST['Menu_ID'];
            $sql = "UPDATE addMenudb SET Menu_Name = ?, Menu_Desc = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssi", $menuName, $menuDescription, $menuID);
        }

        if ($stmt->execute()) {
            echo "success"; // Send a success response
        } else {
            echo "error"; // Send an error response
        }

        $stmt->close();
    }

    // Close the database connection
    $conn->close();
}
?>
