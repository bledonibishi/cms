<?php  include "include/db.php"; ?>
 <?php  include "header.php"; ?>

 <?php
 
    if(isset($_POST['submit'])){


        // $username = $_POST['username'];
        // $email    = $_POST['email'];
        // $password = $_POST['password'];

        $to = "bledonibishi1@gmail.com";
        $subject = wordwrap($_POST['title'],70);
        $body = $_POST['body'];
        $header = $_POST['email'];

        
        ini_set("SMTP","localhost");
        ini_set("smtp_port","25");
        ini_set("sendmail_from","bi47191@ubt-uni.net");
        ini_set("sendmail_path", "C:/xampp/sendmail/sendmail.exe -t");


        mail($to,$subject,$body,$header);
   
    }
    
 
 ?>

     <!-- Page Content -->
<div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact</h1>
                <h5></h5>
                    <form role="form" action="" method="post" id="login-form" autocomplete="off">
                        
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                        <div class="form-group">
                             <label for="username" class="sr-only">Title</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Username">
                        </div>
                         <div class="form-group">
                            <label for="body" class="sr-only">Content</label>
                            <textarea class="form-control" name="body" id="" cols="50" rows="10"></textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "footer.php";?>
