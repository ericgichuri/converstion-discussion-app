<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script src="jquery/jquery.min.js"></script>
    <title>CHAT APP | REGISTER</title>
</head>
<body>
<div class="container-fluid">
    <div class="row justify-content-center">
        <h1>Welcome to chatapp</h1>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-7">
            <button class="btn btn-primary">Login</button>
            <button class="btn btn-warning">Register</button>
        </div>
    </div>
    <div class="row justify-content-center">
    <div class="col-md-7">
        <div class="formholder">
            <form class="form border border-primary p-4 m-2" action="" method="post" enctype="multipart/form-data">
                <h3 class="text-center">Registration Form</h3>
                <div class="form-group">
                    <label class="text font-weight-bold">Photo</label>
                    <input type="file" name="photo" class="form-control form-control-sm">
                </div>
                <div class="form-inline">
                    <label class="text font-weight-bold">First Name</label>
                    <input type="text" name="fname" class="form-control form-control-sm mx-2">
                    <label class="text font-weight-bold">Last Name</label>
                    <input type="text" name="lname" class="form-control form-control-sm mx-2">
                </div>
                <div class="form-group my-2">
                    <label class="text font-weight-bold">Phone No.</label>
                    <input type="text" name="phoneno" class="form-control form-control-sm">
                </div>
                <div class="form-group my-2">
                    <label class="text font-weight-bold">Email</label>
                    <input type="email" name="email" class="form-control form-control-sm">
                </div>
                <div class="form-group my-2">
                    <label class="text font-weight-bold">Username</label>
                    <input type="text" name="username" class="form-control form-control-sm">
                </div>
                <div class="form-inline">
                    <label class="text font-weight-bold">Password</label>
                    <input type="password" name="password" class="form-control form-control-sm mx-2" id='ps'>
                    <label class="text font-weight-bold">Repeat Password</label>
                    <input type="password" name="password" class="form-control form-control-sm mx-2" id='rps'>
                </div>
                <div class="form-group my-2">
                    <button class="btn btn-success" type="submit" name="register" id="register">Register</button>
                </div>

            </form>
        </div>
    </div>
    </div>
</div>
<script>
    $('#register').click(function(e){
        var ps=$('#ps').val();
        var rps=$('#rps').val();
        if(ps!==rps){
            alert("password does not match");
            e.preventDefault();
        }
    })
</script>
</body>
</html>
<?php

include "connection.php";
mysqli_select_db($conn,"users");
if(isset($_POST['register'])){

    $photo=$_FILES['photo']['name'];
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $phoneno=$_POST['phoneno'];
    $email=$_POST['email'];
    $username=$_POST['username'];
    $password=$_POST['password'];

    $sql="INSERT INTO users(photo,fname,lname,phoneno,email,username,password) VALUES('$photo','$fname','$lname','$phoneno','$email','$username','$password')";
    $query_run=mysqli_query($conn,$sql);
    if($query_run){
        echo "<script>alert('registered successful')</script>";
        echo "<script>window.location.href='login.php'</script>";

    }else{
        echo mysqli_error($conn);
        echo "<script>alert('unable to register try again')</script>";
        return false;
    }


    $targetdir="images/uploads/";
    $targetfile=$targetdir.basename($_FILES['photo']['name']);
    $uploadok=1;

    $imagefiletype=pathinfo($targetfile,PATHINFO_EXTENSION);
    $check=getimagesize($_FILES['photo']['tmp_name']);
    if ($check!==false) {
        $uploadok=1;
    }else {
        $uploadok=0;
    }

    //check if file exists
    if (file_exists($targetfile)) {
        $uploadok=0;
    }

    if($uploadok==0){
        echo "<script>alert('error in uploading your image')</script>";
    }else{
        move_uploaded_file($_FILES['photo']['tmp_name'],$targetfile);
    }

    

}


?>