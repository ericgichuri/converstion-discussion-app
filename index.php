<?php

include "connection.php";
session_start();
if(isset($_SESSION['uemail'])){
    $uemail=$_SESSION['uemail'];
    $sql="SELECT photo,CONCAT(fname,' ',lname) AS name FROM users WHERE email='$uemail'";
    $query_run=mysqli_query($conn,$sql);
    if(mysqli_num_rows($query_run)>0){
        while($row=mysqli_fetch_assoc($query_run)){
            $name=$row['name'];
            $photo=$row['photo'];
        }
    }
}else {
    echo "<script>window.location.href='login.php'</script>";
}

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    
    <title>CHATAPP | HOME</title>
</head>
<body style="background:#e6e6e6;">
<div class="container-fluid">
    <div class="row justify-content-center bg-dark">
        
        <h1 class="text-white">Welcome to chatapp</h1>
    </div>
    <div class="row justify-content-center bg-dark">
        <div class="col mr-auto ">
        <img src="<?php echo 'images/uploads/'.$photo; ?>" class="img my-1 rounded-circle" width=100 height=90>
        </div>
        <div class="col">
        <h4 class="text-primary text-right mx-4"><?php echo "Welcome, " .$name; ?></h4><br>
        <a href="logout.php"><h6 class="text-white text-right mx-4">Logout</h6></a>
        </div>
        
        
    </div>
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="formholder">
                <form class="form border border-primary p-3 m-2" action="" method="post">
                    <h3 class="text-center">Message form</h3>
                    <div class="alertholder">
                        
                    </div>
                    <div class="form-group">
                        <label id="name" hidden name="name"><?php echo $name;?></label>
                    </div>
                    <div class="form-group">
                        <label class="text font-weight-bold">Topic</label>
                        <input type="text" class="form-control" name="topic" id="topic" placeholder="Topic to discuss" required>
                    </div>
                    <div class="form-group">
                        <label class="text font-weight-bold">Message</label>
                        <textarea  class="form-control" rows="4" name="message" id="message" placeholder="message" required></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" id="btnsend" type="submit">Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-7">
            <h4 class="text-center">Message post</h4>
            <?php
                $sql="SELECT * FROM messages ORDER BY id DESC";
                $result=mysqli_query($conn,$sql);
                if(mysqli_num_rows($result)>0){
                    while($row=mysqli_fetch_assoc($result)){
                        ?>
                        <div id="mymodal" class="modal " tabindex="-1" role="dialog" aria-hidden="true"  style="background-color: rgba(0, 0, 0, 0.514);">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                <form id="replyform" method="post" action="">
                                    <div class="modal-body">
                                    <h5>Replying</h5>
                                        <div class="form-group">
                                            <label class="text font-weight-bold" id="messageid" name="messageid" hidden><?php echo $row['id'];?></label>
                                            <label class="text font-weight-bold" id="replyname" name="replyname" hidden><?php echo $name;?></label>
                                        </div>
                                        <div class="form-group">
                                            <label class="text font-weight-bold">Message</label>
                                            <textarea  class="form-control" rows="4" name="reply" id="reply" placeholder="message" required></textarea>
                                        </div>

                                            <button class="btn btn-success" id="btnreply" type="submit">Reply</button>
                                            <button class="btn btn-danger" id="btnclose">close</button>

                                    </div>
                                </form>
                                </div>
                
                            </div>
                            </div>
                            <?php
                        $messageid=$row['id'];
                        
                        $msgowner=$row['name'];
                        $topic=$row['topic'];
                        $message=$row['message'];
                        

                        ?>
                        <div class="m-1 col rounded px-2" style="background:lightblue;">
                            <h6 class="p-0 font-weight-bold"><?php echo $row['name']; ?></h6>
                            <h6 class="p-0"><?php echo "Topic: ".$row['topic'];?></h6>
                            <p class="p-0">
                                <?php echo $row['message'];?>
                                <a href="javascript:void(0)" class="font-weight-bold text-right ml-4" onclick="replymodal()"><?php echo "Reply ".$msgowner; ?></a>
                            </p>
                            <div class="row">
                                <div class="col-md-1 font-weight-bold">Replies:</div>
                                <div class="col-md-8">
                                    <p>
                                        <?php
                                            $sql2="SELECT * FROM replys WHERE messageid='$messageid' ORDER BY id DESC";
                                            $result2=mysqli_query($conn,$sql2);
                                            if(mysqli_num_rows($result2)>0){
                                                while($row1=mysqli_fetch_assoc($result2)){

                                                    echo "<span class='font-weight-bold'>".$row1['name']."</span>" ."<br>";
                                                    echo $row1['reply']."<br>"; 
                                                    
                                                }
                                            }
                                        ?>
                                            
                                    </p>
                                    
                                </div>
                                
                            </div>
                        </div>
                            
                        
                        <?php
                    }
                }
            ?>
        </div>
        
    </div>
</div>
<script src="jquery/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('#btnsend').click(function(e){
            e.preventDefault();

            var name=$('#name').html();
            var topic=$('#topic').val();
            var message=$('#message').val();

            $.ajax
            ({
                type:"POST",
                url:"process.php",
                data:{"name":name,"topic":topic,"message":message},

                success:function(data){
                    $('.alertholder').html(data);
                    $('.form')[0].reset();
                }
            });


        });
    });

    $(document).ready(function(){
    $('#btnreply').click(function(e){
        e.preventDefault();
        var messageid=$('#messageid').html();
        var replyname=$('#replyname').html();
        var reply=$('#reply').val();

        

        $.ajax
        ({
            type:"POST",
            url:"replyprocess.php",
            data:{"messageid":messageid,"replyname":replyname,"reply":reply},
            success:function(data){
                
                alert(data);
            }
        });
    });
    });    

    function replymodal(){
        $('#mymodal').show();
    }
    $('#btnclose').click(function(){
        $('#mymodal').hide();
    });
</script>
</body>
</html>