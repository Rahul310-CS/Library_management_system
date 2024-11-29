<?php
session_start();

// Establishing a connection to the MySQL database
$host = "localhost"; // MySQL server hostname
$username = "root"; // MySQL username
$password = ""; // MySQL password (if any)
$database = "library"; // Database name

$link = mysqli_connect($host, $username, $password, $library);

// Checking the connection
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieving the username from the session
$suser = isset($_SESSION['username']) ? $_SESSION['username'] : '';

// Processing the form data and updating the database
if(isset($_POST['name'], $_POST['designation'], $_POST['dept'], $_POST['email'], $_POST['username'], $_POST['password'])) {
    $name = $_POST['name'];
    $designation = $_POST['designation'];  
    $dept = $_POST['dept'];             
    $email = $_POST['email'];
    $user = $_POST['username']; 
    $pass = $_POST['password'];

    // Preparing the SQL query with parameterized statement to prevent SQL injection
    $sql = "UPDATE te_registration SET name=?, designation=?, dept=?, email=?, username=?, password=? WHERE username=?";
    
    // Creating a prepared statement
    $stmt = mysqli_prepare($link, $library);

    // Binding parameters and executing the statement
    mysqli_stmt_bind_param($stmt, "sssssss", $name, $designation, $dept, $email, $user, $pass, $suser);

    // Executing the statement
    if(mysqli_stmt_execute($stmt)) {
        echo "Records were updated successfully.";
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }

    // Closing the statement
    mysqli_stmt_close($stmt);
}

// Closing the database connection
mysqli_close($link);
?>
<a href="teprofile.php">Show your profile</a>
