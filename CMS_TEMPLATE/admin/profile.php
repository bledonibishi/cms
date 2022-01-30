<?php include "include/admin_header.php";   ?>

    <?php 
        if(isset($_SESSION['username'])){
            $username = escape($_SESSION['username']);

            $query ="SELECT * FROM users WHERE username='{$username}' ";
            $query_profile = mysqli_query($conn,$query);

            while($row = mysqli_fetch_array($query_profile)){
                $user_id = $row['user_id'];
                $username = $row['username'];
                $user_password = $row['user_password'];
                $user_firstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];
                $user_email = $row['user_email'];
                // $user_image = $row['user_image'];
                $user_role = $row['user_role'];
            }
        }    
    ?>



    <div id="wrapper">

    <!-- Navigation -->
    <?php include "include/admin_navigation.php";   ?>

        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <h1 class="page-header">
                    Welcome to BABA's page
                    <small>Author</small>
                </h1>

<?php
    if(isset($_POST['edit_profile'])){
        $username = escape($_POST['username']);
        $user_firstname = escape($_POST['user_firstname']);
        $user_lastname = escape($_POST['user_lastname']);
        $user_email = escape($_POST['user_email']);
        $user_role = escape($_POST['user_role']);
        $user_password = escape($_POST['user_password']);
        
        // $post_date = date('d-m-y');
        // $post_image = $_FILES['post_image']['name'];
        // $post_image_temp=$_FILES['post_image']['tmp_name'];
        // $post_comment_count = 4;
        // move_uploaded_file($post_image_temp,"../assets/$post_image");
        $query ="UPDATE users SET ";
        $query .="user_firstname = '{$user_firstname}', ";
        $query .="user_lastname = '{$user_lastname}', ";
        $query .="user_role = '{$user_role}', ";
        $query .="username = '{$username}', ";
        $query .="user_email = '{$user_email}', ";
        $query .="user_password = '{$user_password}' ";
        $query .="WHERE username = '{$username}' ";
        $query_profile_update=mysqli_query($conn,$query);
    }
?>


                <form action="" method="post" enctype="multipart/form-data">


                    <div class="form-group">
                        <label for="user_firstname">Firstname</label>
                        <input type="text" value="<?php if(isset($user_firstname)){echo $user_firstname;} ?>" class="form-control" name="user_firstname">
                    </div>
                    <div class="form-group">
                        <label for="user_lastname">Lastname</label>
                        <input type="text"  value="<?php if(isset($user_lastname)){echo $user_lastname;} ?>" class="form-control" name="user_lastname">
                    </div>
                    <div class="form-group">

                    <select name="user_role" id="">
                    <option value="subscriber"><?php echo $user_role; ?></option>
<?php
    if($user_role == 'admin'){
        echo "<option value='subscriber'>subscriber</option>";
    }else{
    echo " <option value='admin'>admin</option>";
    }
?>
                    </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" value="<?php if(isset($username)){echo $username;} ?>" class="form-control" name="username">
                    </div>
                    <div class="form-group">
                        <label for="user_email">Email</label>
                        <input type="email"  value="<?php if(isset($user_email)){echo $user_email;} ?>" class="form-control" name="user_email">
                    </div>
                    <div class="form-group">
                        <label for="user_password">Password</label>
                        <input type="password"  value="<?php if(isset($user_password)){echo $user_password;} ?>" class="form-control" name="user_password">
                    </div>
                    
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="edit_profile" value="Upgrade Profile">
                    </div>

                </form>
             
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
    <?php include "include/admin_footer.php";

