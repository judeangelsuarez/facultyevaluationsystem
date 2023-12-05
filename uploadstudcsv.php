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
    $stmt = $conn->prepare("INSERT INTO student (idno, studentname, coursename, yearlevel, section, status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssi", $idno, $studentname, $coursename, $yearlevel, $section, $status);

    while (($data = fgetcsv($file)) !== false) {
        list($idno, $studentname, $coursename, $yearlevel, $section, $status) = $data;

        // Check if the data already exists in the database based on idno and studentname
        $checkStmt = $conn->prepare("SELECT studentid FROM student WHERE idno = ? AND studentname = ?");
        $checkStmt->bind_param("ss", $idno, $studentname);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows == 0) {
            // Data does not exist, insert it
            $query = "INSERT INTO `useraccount` (`idno`,`name`,`username`,`password`,`usertype`)
                VALUES ('".$idno."','".$studentname."','".$idno."','123','Student')";
                mysqli_query($conn,$query)or die (mysqli_error($conn));
            $stmt->execute();
        } else {
            // Data already exists, you can handle this case as needed
            echo '<script>alert("Data with student name '.$studentname.' and idno '.$idno.' already exists in the database. Skipping insertion.");
            window.location = "student.php";</script>';
        }

        // Close the check statement
        $checkStmt->close();
    }

    // Close the prepared statement
    $stmt->close();

    // Close the file
    fclose($file);

   echo '<script>alert("Data added successfully.");
    window.location = "student.php";</script>';
} else {
    echo '<script>alert("Error in adding.");
   window.location = "student.php";</script>';
}

// Close the database connection
$conn->close();

?>
