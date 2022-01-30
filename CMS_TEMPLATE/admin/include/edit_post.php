
 <?php //update posts
      if(isset($_GET['p_id'])){
          $post_id = escape($_GET['p_id']);

          $query = "SELECT * FROM posts WHERE post_id = $post_id ";
          $query_posts_edit= mysqli_query($conn,$query);

          
          
          while($row = mysqli_fetch_assoc($query_posts_edit)){  
              $post_title = $row['post_title'];
              $post_category_id = $row['post_category_id'];
              $post_author = $row['post_author'];
              $post_status = $row['post_status'];
              $post_image = $row['post_image'];
              $post_tags = $row['post_tags'];
              $post_content = $row['post_content'];
              ?>
    <?php    } 
    }   ?>
  
    <?php 
     if(isset($_POST['create_post'])){

        $post_title = $_POST['title'];
        $post_category_id = $_POST['post_category'];
        $post_author = $_POST['post_author'];
        $post_status = $_POST['post_status'];
        $post_image = $_FILES['post_image']['name'];
        $post_image_temp=$_FILES['post_image']['tmp_name'];
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        move_uploaded_file($post_image_temp,"../assets/$post_image");

        if(empty($post_image)){
            $query="SELECT * FROM posts where post_id=$post_id";
            $query_image=mysqli_query($conn,$query);
            while($row = mysqli_fetch_assoc($query_image)){
                $post_image=$row['post_image'];
            }
        }
        $query="UPDATE posts SET ";
        $query .="post_title='{$post_title}',";
        $query .="post_category_id='{$post_category_id}',";
        $query .="post_author='{$post_author}',";
        $query .="post_date=now() ,";
        $query .="post_status='{$post_status}',";
        $query .="post_image='{$post_image}',";
        $query .="post_tags='{$post_tags}',";
        $query .="post_content='{$post_content}'";
        $query .="WHERE post_id={$post_id}";

        $update_query= mysqli_query($conn,$query);

        echo "<h4 class='bg-success'>Post Updated Succesfuly <a href='../post.php?p_id=$post_id'>View Post</a> or <a href='posts.php'>Edit more</a></h4>";
    }

?> 

            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Post Title</label>
                    <input value="<?php if(isset($post_title)){echo $post_title;} ?>" type="text" class="form-control" name="title">
                </div>
                <div class="form-group">
                    <select name="post_category" id="post_category">
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
                <div class="form-group">
                    <label for="post_author">Post Author</label>
                    <input value="<?php if(isset($post_author)){echo $post_author;} ?>"  type="text" class="form-control" name="post_author">
                </div>

                <div class="form-group">
                    <select name="post_status" id="">
                        <option value=""><?php echo "$post_status"; ?></option>
                        <?php
                            if($post_status == 'published'){
                                echo "<option value='draft'>Draft</option>";
                            }else {
                                echo "<option value='published'>Publish</option>";
                            }
                        
                        ?>
                    
                    </select>
                </div>

                <div class="form-group">
                    <img width="100" src="../assets/<?php echo $post_image; ?>" alt="">
                    <input type="file" class="form-control" name="post_image">
                </div>
                <div class="form-group">
                    <label for="post_tags">Post Tags</label>
                    <input value="<?php if(isset($post_tags)){echo $post_tags;} ?>" type="text" class="form-control" name="post_tags">
                </div>
                <div class="form-group">
                    <label for="post_content">Post Content</label>
                    <textarea id="editor" cols="30" rows="10" type="text" class="form-control" name="post_content"><?php echo $post_content; ?>
                </textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="create_post" value="Publish">
                </div>
            </form>