<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script src="jquery/jquery.min.js"></script>
    <title>CHAT APP | LOGIN</title>
</head>
<body>
<div class="container-fluid">
    <div class="row justify-content-center">
        <h1>Welcome to chatapp</h1>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-7">
            <button class="btn btn-primary" id="btntologin">Login</button>
            <button class="btn btn-warning" id="btntoregister">Register</button>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="formholder">
                
                <form class="form border border-primary p-4 m-2" action="" method="post">
                <h3 class="text-center">Login Form</h3>
                    <div class="form-group">
                        <label class="text font-weight-bold">Email</label>
                        <input type="email" name="email" placeholder="email@email.com" id="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="text font-weight-bold">Password</label>
                        <input type="password" name="password" placeholder="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="rememberme">
                        <label class="text font-weight-bold">Remember me</label>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" type="submit" name="login">Login</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('#btntologin').click(function(){
        $("#email").focus();
    });
    $('#btntoregister').click(function(){
        window.location.href='register.php';
    });
</script>
</body>
</html>
<?php
include "connection.php";
session_start();
if (isset($_POST['login'])) {
    if(isset($_POST['rememberme'])){
        setcookie("uemail",$_POST['email'],time()+3600);
        setcookie("upass",$_POST['password'],time()+3600);
    }

    $email=$_POST['email'];
    $password=$_POST['password'];

    $sanemail=mysqli_real_escape_string($conn,$email);
    $sanpass=mysqli_real_escape_string($conn,$password);

    $sql="SELECT email,password FROM users WHERE email='$sanemail'";
    $query_run=mysqli_query($conn,$sql);
    if(mysqli_num_rows($query_run)>0){
        while($row=mysqli_fetch_assoc($query_run)){
            $uemail=$row['email'];
            $upass=$row['password'];

            if($uemail===$sanemail && $upass===$sanpass){
                $_SESSION['uemail']=$uemail;
                echo "<script>window.location.href='http://localhost/chatapp/'</script>";
            }else{
                echo "<script>alert('password is incorrect')</script>";
                echo "<script>window.location.href='login.php'</script>";
            }
        }
    }else{
        echo "<script>alert('wrong email or not registered')</script>";
    }




}

?>