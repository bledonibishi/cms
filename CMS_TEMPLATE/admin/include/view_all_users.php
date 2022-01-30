<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
<?php 
    $query = "SELECT * FROM users";
    $query_users = mysqli_query($conn,$query);
    while($row = mysqli_fetch_assoc($query_users)){  
        $user_id        = $row['user_id'];
        $username       = $row['username'];
        $user_password  = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname  = $row['user_lastname'];
        $user_email     = $row['user_email'];
        $user_image     = $row['user_image'];
        $user_role      = $row['user_role'];

        echo "<tr>";
        echo "<td>{$user_id}</td>";
        echo "<td>{$username}</td>";
        echo "<td>{$user_firstname}</td>";

        // $query = "SELECT * FROM category WHERE cat_id = {$post_category_id} ";
        // $query_category_edit= mysqli_query($conn,$query);
          
        // while($row = mysqli_fetch_assoc($query_category_edit)){  
        //     $cat_id = $row['cat_id'];
        //     $cat_title = $row['cat_title'];

        //     echo "<td>$cat_title</td>";
        // }

        echo "<td>{$user_lastname}</td>";
        echo "<td>{$user_email}</td>";

        // $query="SELECT * FROM posts where post_id=$comment_post_id";
        // $select_post_comment=mysqli_query($conn,$query);
        
        // while($row=mysqli_fetch_assoc($select_post_comment)){
        //     $post_id=$row['post_id'];
        //     $post_title=$row['post_title'];

        //     echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
        // }

        
        echo "<td>{$user_role}</td>";
        echo "<td><a href='./users.php?change_to_admin=$user_id'</a>admin</td>";
        echo "<td><a href='./users.php?change_to_sub=$user_id'>Subscriber</a></td>";
        echo "<td><a href='users.php?source=edit_user&edit_users=$user_id'>Edit</a></td>";
        echo "<td><a onClick=\"javascript:return confirm('Are you sure you want to delete? '); \" href='./users.php?delete_users=$user_id'</a>Delete</td>";
        echo "</tr>";
    }  
    ?>
    <?php 
    
    
    //approved comments
    if(isset($_GET['change_to_admin'])){
        $the_user_id = escape($_GET['change_to_admin']);
        $query="UPDATE users SET user_role='admin' WHERE user_id=$the_user_id";
        $change_admin_query= mysqli_query($conn,$query);
        header("location:users.php");
     }

     //unapproved comments query
     if(isset($_GET['change_to_sub'])){
        $the_user_id = escape($_GET['change_to_sub']);
        $query="UPDATE users SET user_role='subscriber' WHERE user_id=$the_user_id";
        $change_subsriber_query= mysqli_query($conn,$query);
        header("location:users.php");
     }

    //delete comments
    if(isset($_GET['delete_users'])){
        if(isset($_SESSION['user_role'])){
            if($_SESSION['user_role']=='admin'){
                $deleted_id_users = mysqli_real_escape_string($conn,$_GET['delete_users']);
                $query="DELETE from users where user_id = {$deleted_id_users}";
                $delete_query_users= mysqli_query($conn,$query);
                header("location:users.php");
            }
        }
    }
     ?>

    </tbody>
</table>