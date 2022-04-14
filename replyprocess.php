<?php

include "connection.php";
if (isset($_POST)) {
    $messageid=$_POST['messageid'];
    $replyname=$_POST['replyname'];
    $reply=$_POST['reply'];

    echo $messageid;

   /* $sql="INSERT INTO replys(messageid,name,reply) VALUES('$messageid','$replyname','$reply')";
    $query_run=mysqli_query($conn,$sql);
    if($query_run){
        echo "<div class='alert alert-success text-dark text-center alert-sm'>reply sent $replyname</div>";
    }else{
        echo "<div class='alert alert-danger'>message not sent $replyname</div>";
        echo mysqli_error($conn);
    }*/

    
}

?>