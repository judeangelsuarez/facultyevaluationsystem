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
    $stmt = $conn->prepare("INSERT INTO subject (subjectname, subjectdesc) VALUES (?, ?)");
    $stmt->bind_param("ss", $subjectname, $subjectdesc);

    while (($data = fgetcsv($file)) !== false) {
        list($subjectname, $subjectdesc) = $data;

        // Check if the data already exists in the database based on facultyname and facidno
        $checkStmt = $conn->prepare("SELECT subjectid FROM subject WHERE subjectname = ? OR subjectdesc = ?");
        $checkStmt->bind_param("ss", $subjectname, $subjectdesc);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows == 0) {
            // Data does not exist, insert it
            $stmt->execute();
        } else {
            // Data already exists, you can handle this case as needed

            echo '<script>alert("Data with subject name '.$subjectname.' and subject description '.$subjectdesc.' already exists in the database. Skipping insertion.");
            window.location = "subject.php";</script>';
        }

        // Close the check statement
        $checkStmt->close();
    }

    // Close the prepared statement
    $stmt->close();

    // Close the file
    fclose($file);

    echo '<script>alert("Data added successfully.");
    window.location = "subject.php";</script>';
} else {
   echo '<script>alert("Error in adding.");
   window.location = "subject.php";</script>';
}

// Close the database connection
$conn->close();

?>