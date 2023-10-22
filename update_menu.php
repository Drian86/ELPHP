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

    // Retrieve the values to be updated from the request
    $menuName = $_POST['Update_Menu_Name'];
    $menuDesc = $_POST['Update_Menu_Desc'];
    $menuID = $_POST['Menu_ID'];

    // Create a SQL query to update the data
    $updateSql = "UPDATE addMenudb SET Menu_Name = ?, Menu_Desc = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("ssi", $menuName, $menuDesc, $menuID);

    if ($updateStmt->execute()) {
        echo "success"; // Send a success response
    } else {
        echo "error"; // Send an error response
    }

    $updateStmt->close();

    // Close the database connection
    $conn->close();
}
?>
