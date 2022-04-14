<?php

include "connection.php";
if (isset($_POST)) {
    $name=$_POST['name'];
    $topic=$_POST['topic'];
    $message=$_POST['message'];

    $sql="INSERT INTO messages(name,topic,message) VALUES ('$name','$topic','$message')";
    $query_run=mysqli_query($conn,$sql);
    if ($query_run) {
       echo "<div class='alert alert-success text-dark text-center alert-sm'>message sent $name</div>";
    }else{
        echo "<div class='alert alert-danger'>message not sent $name</div>";
        echo mysqli_error($conn);
    }

    
}

?>