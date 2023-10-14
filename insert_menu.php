<?php
   // Database connection code
   $servername = "adrianhost";
   $username = "adrian";
   $password = "adrian"; // Replace with the actual password you set for the "adrian" user
   $dbname = "addmenudb";

   $conn = new mysqli($servername, $username, $password, $dbname);
   if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
   }

   // Execute a separate query to grant privileges to adrian user
   $conn->query("GRANT ALL PRIVILEGES ON *.* TO `adrian`@`localhost` IDENTIFIED BY PASSWORD '*F036BB934FE78FFF7E2BC7F478426C530183336C' WITH GRANT OPTION");
   $conn->query("GRANT ALL PRIVILEGES ON `adrian`.* TO `adrian`@`localhost`");
   $conn->query("GRANT ALL PRIVILEGES ON `adrian\_%`.* TO `adrian`@`localhost`");

   // Form data validation
   $menuName = $_POST["menuName"];
   $menuDescription = $_POST["menuDescription"];

   if (empty($menuName) || empty($menuDescription)) {
     // Display an error message
   } else {
     // SQL query to insert data into database
     $sql = "INSERT INTO menu (menuName, menuDescription) VALUES ('$menuName', '$menuDescription')";

     if ($conn->query($sql) === TRUE) {
       // Display a success message
     } else {
       // Display an error message
     }
   }

   $conn->close();
?>