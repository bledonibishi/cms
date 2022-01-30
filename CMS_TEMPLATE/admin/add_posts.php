<?php

if(isset($_POST['create_post'])){

        $post_category_id = escape($_POST['post_category']);
        $post_title = escape($_POST['title']);
        $post_user = escape($_POST['post_user']);
        $post_date = date('d-m-y');

        $post_image = $_FILES['post_image']['name'];
        $post_image_temp=$_FILES['post_image']['tmp_name'];

        $post_content =escape( $_POST['post_content']);
        $post_tags = escape($_POST['post_tags']);
        // $post_comment_count = $_POST['post_comment_count'];
        $post_status = escape($_POST['post_status']);

        move_uploaded_file($post_image_temp,"../assets/$post_image");


        $query ="INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_status) ";
        $query .=" VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}'
        ,'{$post_status}')";

        $query_posts=mysqli_query($conn,$query);
        echo "<h4 class='bg-success'>Post Created Succesfuly </h4>";
        
}


?>

<form action="" method="post" enctype="multipart/form-data">


    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
        <label for="">Categories: </label>
    <select name="post_category"  id="post_category">
                        <?php 
                           $query = "SELECT * FROM category";
                           $query_category= mysqli_query($conn,$query);
                           
                           while($row = mysqli_fetch_assoc($query_category)){  
                               $cat_id = $row['cat_id'];
                               $cat_title = $row['cat_title'];
                               
                               echo "<option value='$cat_id'>{$cat_title}</option>";
                        
                           } ?>

                    </select>
    </div>
<!-- 

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author">
    </div> -->
    <div class="form-group">
        <label for="">Users: </label>
    <select name="post_user"  id="post_user">
                        <?php 
                           $query = "SELECT * FROM users";
                           $query_category= mysqli_query($conn,$query);
                           
                           while($row = mysqli_fetch_assoc($query_category)){  
                               $user_id = $row['user_id'];
                               $username = $row['username'];
                               
                               echo "<option value='$user_id'>{$username}</option>";
                        
                           } ?>

                    </select>
    </div>
    <div class="form-group">
    <label for="">Status</label>
    <select name="post_status"id="post_status" value="Post status">  
           <option value='published'>Published</option>
           <option value='draft'>Draft</option>
    </select>
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" class="form-control" name="post_image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
   
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea id="editor" cols="30" rows="10" type="text" class="form-control" name="post_content"></textarea>
    </div>
    <script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
    console.error( error );
    } );
    </script>
   
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish">
    </div>





</form>

</div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
    <?php include "include/admin_footer.php";