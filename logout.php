<?php

include "connection.php";
session_start();
if(isset($_SESSION['uemail'])){
    session_destroy();
    echo "<script>alert('Logout successful')</script>";
    echo "<script>window.location.href='login.php'</script>";
}else{
    echo "<script>window.location.href='login.php'</script>";
}

?>