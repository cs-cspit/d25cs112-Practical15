<!DOCTYPE html>
<html>
    <head>
        <script>
            
        </script>
    </head>
</html>
<?php
include("database.php");
if(isset($_POST['signupsubmit'])) {
    $suname = $_POST['Suname'];
    $spass = $_POST['Spass'];
    $smobile = $_POST['SMobile'];
    $semail = $_POST['Semail'];

    $Query = "SELECT * FROM users WHERE Name = '$suname' AND Password = '$spass' AND Mobile_no = '$smobile' AND Email_id = '$semail'";
    $Result = mysqli_query($con, $Query);

    if($Result)
    {
        if(mysqli_num_rows($Result) == 0)
        {
            $query = "INSERT INTO users VALUES ('$suname', '$spass', '$smobile', '$semail')";
            $data = mysqli_query($con, $query);
            session_start();
            $_SESSION['username'] = $suname;
            $_SESSION['mobile'] = $smobile;
            $_SESSION['email'] = $semail;
            header('Location: index.php?status=success');
            exit;
        }
        else
        {
            echo "<script>alert('User Already Exists..!!');</script>";
            header('Location: main.php?status=success');
            exit;
        }
    }
    else
    {
        // Handle the error appropriately
        echo "Error: " . mysqli_error($con);
    }
}

?>
