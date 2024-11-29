<?php

require 'newcon.php'; // Assuming 'newcon.php' contains the database connection code

$name = $_POST['name'];
$designation = $_POST['designation'];
$dept = $_POST['dept'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

// Check if the username is already taken
$select = mysqli_query($link, "SELECT * FROM te_registration WHERE username = '$username'");
if (mysqli_num_rows($select) > 0) {
    echo "Username is Already Taken";
} else {
    // Insert new record if username is not taken
    $stmt = mysqli_query($link, "INSERT INTO te_registration (name, designation, dept, email, username, password) 
        VALUES ('$name', '$designation', '$dept', '$email', '$username', '$password')");
    
    if ($stmt) {
        echo "<script language='javascript'>
                alert('Registered As Teacher');
                window.open('registration.php', '_self');
              </script>";
    } else {
        echo "<script language='javascript'>
                alert('Some Error Occurred');
                window.open('admininsert.php', '_self');
              </script>";
    }
}

?>
