<?php
require 'newcon.php'; // Assuming 'newcon.php' contains the database connection code

$name = $_POST['name'];
$stid = $_POST['st_id'];
$dept = $_POST['dept'];
$session = $_POST['session'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

// Check if the username is already taken
$select = mysqli_query($link, "SELECT * FROM registration WHERE username = '$username'");
if (mysqli_num_rows($select) > 0) {
    echo "Username is Already Taken";
} else {
    // Insert new record if username is not taken
    $stmt = mysqli_query($link, "INSERT INTO registration (name, st_id, dept, session, email, username, password) 
        VALUES ('$name', '$stid', '$dept', '$session', '$email', '$username', '$password')");
    
    if ($stmt) {
        echo "<script language='javascript'>
                alert('Registered As Student');
                window.open('registration.php', '_self');
              </script>";
    } else {
        echo "<script language='javascript'>
                alert('Some Error Occurred');
                window.open('registration.php', '_self');
              </script>";
    }
}
?>
