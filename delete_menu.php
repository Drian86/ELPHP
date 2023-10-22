<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish a database connection
    $db_host = 'localhost';
    $db_user = 'root';
    $db_password = '';
    $db_name = 'addMenuDB';

    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve the values to be deleted from the request
    $menuName = $_POST['Menu_Name'];
    $menuDesc = $_POST['Menu_Desc'];

    // Create a SQL query to delete the data
    $deleteSql = "DELETE FROM addMenudb WHERE Menu_Name = ? AND Menu_Desc = ?";
    $deleteStmt = $conn->prepare($deleteSql);
    $deleteStmt->bind_param("ss", $menuName, $menuDesc);

    if ($deleteStmt->execute()) {
        echo "success"; // Send a success response
    } else {
        echo "error"; // Send an error response
    }

    $deleteStmt->close();

    // Close the database connection
    $conn->close();
}
?>
