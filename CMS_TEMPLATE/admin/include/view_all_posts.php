<?php 

    if(isset($_POST['checkBoxArray'])){
        
        foreach($_POST['checkBoxArray'] as $checkBoxID){
            $bulk_options =escape( $_POST['bulk_options']);

            switch($bulk_options){
                case 'published':
                    $query = "UPDATE posts SET post_status ='{$bulk_options}' WHERE post_id={$checkBoxID} ";
                    $query_checkBoxes = mysqli_query($conn,$query);
                    queryCheck($query_checkBoxes);
                break;
                case 'draft':
                    $query = "UPDATE posts SET post_status ='{$bulk_options}' WHERE post_id={$checkBoxID} ";
                    $query_checkBoxes = mysqli_query($conn,$query);
                    queryCheck($query_checkBoxes);
                break;
                case 'delete':
                    $query = "DELETE FROM posts WHERE post_id={$checkBoxID} ";
                    $query_checkBoxes = mysqli_query($conn,$query);
                    queryCheck($query_checkBoxes);
                break;
                case 'clone':
                    
                    $query = "SELECT * FROM posts WHERE post_id = {$checkBoxID} ";
                    $query_checkBoxes = mysqli_query($conn,$query);

                    while($row = mysqli_fetch_assoc($query_checkBoxes)){
                        $post_id            = $row['post_id'];
                        $post_category_id   = $row['post_category_id'];
                        $post_title         = $row['post_title'];
                        $post_author        = $row['post_author'];
                        $post_date          = $row['post_date'];
                        $post_image         = $row['post_image'];
                        $post_content       = $row['post_content'];
                        $post_tags          = $row['post_tags'];
                        $post_comment_count = $row['post_comment_count'];
                        $post_status        = $row['post_status'];
                    }


                    $query_clone = "INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_comment_count,post_status) ";
                    $query_clone .="VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}'
                    ,{$post_comment_count},'{$post_status}') ";
                    $query_clone_sql = mysqli_query($conn,$query_clone);

                    break;
            }

        }
    }

?>



<form action="" method="post">
<table class="table table-bordered table-hover">

    <div id="bulkOptions" class="col-xs-4">
    <select name="bulk_options" id="" class="form-control">
        <option value = "">Select Options</option>
        <option value = "draft">Draft</option>
        <option value = "published">Publish</option>
        <option value = "delete">Delete</option>
        <option value = "clone">Clone</option>
    
    </select>
    </div>
    <div class="col-xs-4">
        <input type="submit" name="submit" class="btn btn-success" value="Apply">
        <a class="btn btn-primary" href="add_posts.php">Add New</a>
    </div>




    <thead>
        <tr>
            <td><Input id="selectAllBoxes" type="checkbox" value="true"></Input></td>
            <th>ID</th>
            <th>User</th>
            <!-- <th>User</th> -->
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Content</th>
            <th>TAGS</th>
            <th>Comments</th>
            <th>Date</th>
            <th>Delete</th>
            <th>Edit</th>
            <th>Views</th>
        </tr>
    </thead>
    <tbody>
<?php 
    $query = "SELECT * FROM posts ORDER BY post_id DESC";
    $query_posts = mysqli_query($conn,$query);
    while($row = mysqli_fetch_assoc($query_posts)){  
        $post_id            = $row['post_id'];
        $post_category_id   = $row['post_category_id'];
        $post_title         = $row['post_title'];
        $post_author        = $row['post_author'];
        $post_user          = $row['post_user'];
        $post_date          = $row['post_date'];
        $post_image         = $row['post_image'];
        $post_content       = $row['post_content'];
        $post_tags          = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_status        = $row['post_status'];
        $post_views_count   = $row['post_views_count'];
        echo "<tr>";
        ?>
        <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>''></td>
       
        <?php

        echo "<td>{$post_id}</td>";


        if(isset($post_author) || !empty($post_author)){
            echo "<td>{$post_author}</td>";
        }elseif(isset($post_user) || !empty($post_user)){
            echo "<td>{$post_user}</td>";
        }

        echo "<td>{$post_title}</td>";

        $query = "SELECT * FROM category WHERE cat_id = {$post_category_id} ";
        $query_category_edit= mysqli_query($conn,$query);
          
        while($row = mysqli_fetch_assoc($query_category_edit)){  
            $cat_id    = $row['cat_id'];
            $cat_title = $row['cat_title'];

            echo "<td>$cat_title</td>";
        }

        echo "<td>{$post_status}</td>";
        echo "<td><img width='100' src='../assets/$post_image'></td>";
        echo "<td>{$post_content}</td>";
        echo "<td>{$post_tags}</td>";
        
        
        $query_comment = "SELECT * FROM comments WHERE comment_post_id = $post_id";
        
        $send_comment_query = mysqli_query($conn, $query_comment);

        $row = mysqli_fetch_array($send_comment_query);
        // $comment_id = $row['comment_id'];
        $count_comments = mysqli_num_rows($send_comment_query);


        echo "<td><a href='post_comment.php?id=$post_id'>$count_comments</a></td>";
        
        echo "<td>{$post_date}</td>";
        echo "<td><a onClick=\"javascript:return confirm('Are you sure you want to delete? '); \" href='admin_posts.php?delete_posts={$post_id}'</a>Delete</td>";
        echo "<td><a  href='admin_posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
        echo "<td><a href='posts.php?reset={$post_id}'>{$post_views_count}</a></td>";
        echo "</tr>";
    }  
    ?>
    <?php //delete posts
    if(isset($_GET['delete_posts'])){
        $deleted_id_posts = escape($_GET['delete_posts']);
        echo $deleted_id_posts;
        $query = "DELETE from posts where post_id = {$deleted_id_posts}";
        $delete_query_posts = mysqli_query($conn,$query);
        header("location:admin_posts.php");
     }

     if(isset($_GET['reset'])){
    
        $the_post_id = escape($_GET['reset']);
        
        $query = "UPDATE posts SET post_views_count = 0 WHERE post_id = $the_post_id  ";
        $reset_query = mysqli_query($connection, $query);
        header("Location: posts.php");
        
        
    }
     ?>

    </tbody>
</table>
</form>