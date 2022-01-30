<?php  include "include/db.php"; ?>
 <?php  include "header.php"; ?>

 <?php
 
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $email    = $_POST['email'];
        $password = $_POST['password'];

        if(!empty($username) &&!empty($email)&&!empty($password)){

        $username = mysqli_real_escape_string($conn,$username);
        $email    = mysqli_real_escape_string($conn,$email);
        $password = mysqli_real_escape_string($conn,$password);

        $password = password_hash($password,PASSWORD_BCRYPT,array('cost' => 12));

        // $query = " SELECT randSalt FROM users ";
        // $query_randSalt = mysqli_query($conn,$query);
        // if(!$query_randSalt){
        //     die("Query failed " . mysqli_error($conn));
        // }

        // $row = mysqli_fetch_array($query_randSalt);
        // $salt = $row['randSalt'];
        // $hash = '$2a$07$usesomesillystringforsalt$';

        // $password = crypt($password , $hash);

        $query  = " INSERT INTO users(username, user_email, user_password , user_role) ";
        $query .= " VALUES('{$username}' , '{$email}' , '{$password}' , 'subscriber') ";
        $query_register = mysqli_query($conn,$query);
        
        if(!$query_register){
            die("Query failed " . mysqli_error($conn));
        }

        $message = "<h4 class='alert bg-success'>User created successfuly</h4>";
    }else {
        $message = "<h4 class='alert bg-warning'>Fileds cannot be empty</h4>";
    }


    }else{
        $message ="";
    }
    
 
 ?>

     <!-- Page Content -->
<div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                <h5><?php echo $message; ?></h5>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "footer.php";?>
