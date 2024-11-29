<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are filled
    if(isset($_POST['name'], $_POST['st_id'], $_POST['dept'], $_POST['session'], $_POST['email'], $_POST['username'], $_POST['password'])) {
        // Database connection
        $link = mysqli_connect("localhost", "root", "", "library");
        
        // Check connection
        if($link === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }

        // Sanitize user inputs to prevent SQL injection
        $suser = mysqli_real_escape_string($link, $_SESSION['username']);
        $name = mysqli_real_escape_string($link, $_POST['name']);
        $stid = mysqli_real_escape_string($link, $_POST['st_id']);  
        $dpt = mysqli_real_escape_string($link, $_POST['dept']);              
        $session = mysqli_real_escape_string($link, $_POST['session']);                
        $email = mysqli_real_escape_string($link, $_POST['email']);
        $user = mysqli_real_escape_string($link, $_POST['username']); 
        $pass = mysqli_real_escape_string($link, $_POST['password']);

        // Hash the password
        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

        // Attempt update query execution using prepared statements
        $sql = "UPDATE registration SET name=?, st_id=?, dept=?, session=?, email=?, username=?, password=? WHERE username=?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssss", $name, $stid, $dpt, $session, $email, $user, $hashed_password, $suser);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                echo "Records were updated successfully.";
            } else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
        // Close connection
        mysqli_close($link);
    } else {
        echo "All fields are required.";
    }
} else {
    echo "Form submission error.";
}
?>
<a href="profile.php">Show your profile</a>
