<?php

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "facultyeval";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if (isset($_FILES['csvFile']) && $_FILES['csvFile']['error'] == UPLOAD_ERR_OK) {
    // Get the uploaded file
    $csvFile = $_FILES['csvFile']['tmp_name'];

    // Open the file for reading
    $file = fopen($csvFile, 'r');

    // Skip the header row
    fgetcsv($file);

    // Prepare and execute statements to insert data into the database
    $stmt = $conn->prepare("INSERT INTO faculty (facidno, facultyname, email, eval_type) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $facidno, $facultyname, $email, $eval_type);

    while (($data = fgetcsv($file)) !== false) {
        list($facidno, $facultyname, $email, $eval_type) = $data;

        // Check if the data already exists in the database based on facultyname and facidno
        $checkStmt = $conn->prepare("SELECT facultyid FROM faculty WHERE facultyname = ? AND facidno = ?");
        $checkStmt->bind_param("ss", $facultyname, $facidno);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows == 0) {
            // Data does not exist, insert it
            $query = "INSERT INTO `useraccount` (`idno`,`name`,`username`,`password`,`usertype`)
                VALUES ('".$facidno."','".$facultyname."','".$facidno."','123','Faculty')";
                mysqli_query($conn,$query)or die (mysqli_error($conn));
            $stmt->execute();
        } else {
            // Data already exists, you can handle this case as needed

            echo '<script>alert("Data with facultyname '.$facultyname.' and facidno '.$facidno.' already exists in the database. Skipping insertion.");
            window.location = "faculty.php";</script>';
        }

        // Close the check statement
        $checkStmt->close();
    }

    // Close the prepared statement
    $stmt->close();

    // Close the file
    fclose($file);

    echo '<script>alert("Data added successfully.");
    window.location = "faculty.php";</script>';
} else {
   echo '<script>alert("Error in adding.");
   window.location = "faculty.php";</script>';
}

// Close the database connection
$conn->close();

?>