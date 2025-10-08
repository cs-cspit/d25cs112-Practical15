<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Debug: Check if database connection exists
include("database.php");

// Add this debug line
if (!isset($con)) {
    echo "Error: Database connection variable \$con is not defined!<br>";
    echo "Check your database.php file.<br>";
    exit();
}

if (!$con) {
    echo "Error: Database connection failed!<br>";
    exit();
}

if (isset($_POST['loginsubmit'])) {
    // Add null check before using mysqli_real_escape_string
    if ($con) {
        $luname = mysqli_real_escape_string($con, $_POST['luname']);
        $lpass = mysqli_real_escape_string($con, $_POST['lpass']);

        $query2 = "SELECT * FROM users WHERE Name='$luname' AND Password='$lpass'";
        $data2 = mysqli_query($con, $query2);

        if (!$data2) {
            die("Error: " . mysqli_error($con));
        }

        $count = mysqli_num_rows($data2);

        if ($count == 1) {
            $row = mysqli_fetch_assoc($data2);
            $_SESSION['username'] = $row['Name'];
            $_SESSION['mobile'] = $row['Mobile_no'];
            $_SESSION['email'] = $row['Email_id'];
            header('Location: index.php?status=success');
            exit;
        } else {
            header('Location: main.php?status=denied');
            exit;
        }
    }
}
?>
