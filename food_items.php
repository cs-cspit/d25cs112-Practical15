<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "foodies";
     
    $con=mysqli_connect($servername,$username,$password,$database);

    function getData($con)
    {
        $sql = "SELECT * FROM food_items";

        $result = mysqli_query($con, $sql);

        if(mysqli_num_rows($result) > 0){
            return $result;
        }
        else
        {
            return [];
        }
    }

    $data = getData($con);
?>