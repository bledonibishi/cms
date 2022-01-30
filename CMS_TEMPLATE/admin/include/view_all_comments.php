<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Comments</th>
            <th>Email</th>
            <th>Status</th>
            <th>In the response</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
<?php 
    $query = "SELECT * FROM comments";
    $query_comments = mysqli_query($conn,$query);
    while($row = mysqli_fetch_assoc($query_comments)){  
        $comment_id = $row['comment_id'];
        $comment_post_id = $row['comment_post_id'];
        $comment_author = $row['comment_author'];
        $comment_content = $row['comment_content'];
        $comment_email = $row['comment_email'];
        $comment_status = $row['comment_status'];
        $comment_date = $row['comment_date'];

        echo "<tr>";
        echo "<td>{$comment_id}</td>";
        echo "<td>{$comment_author}</td>";
        echo "<td>{$comment_content}</td>";

        // $query = "SELECT * FROM category WHERE cat_id = {$post_category_id} ";
        // $query_category_edit= mysqli_query($conn,$query);
          
        // while($row = mysqli_fetch_assoc($query_category_edit)){  
        //     $cat_id = $row['cat_id'];
        //     $cat_title = $row['cat_title'];

        //     echo "<td>$cat_title</td>";
        // }

        echo "<td>{$comment_email}</td>";
        echo "<td>{$comment_status}</td>";

        $query="SELECT * FROM posts where post_id=$comment_post_id";
        $select_post_comment=mysqli_query($conn,$query);
        
        while($row=mysqli_fetch_assoc($select_post_comment)){
            $post_id=$row['post_id'];
            $post_title=$row['post_title'];

            echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
        }

        
        echo "<td>{$comment_date}</td>";
        echo "<td><a href='./comments.php?approve=$comment_id'</a>Approve</td>";
        echo "<td><a href='./comments.php?unapprove=$comment_id'>Unapprove</a></td>";
        echo "<td><a href='./comments.php?delete_comments=$comment_id'</a>Delete</td>";
        echo "</tr>";
    }  
    ?>
    <?php 
    
    
    //approved comments
    if(isset($_GET['approve'])){
        $the_comment_id = escape($_GET['approve']);
        $query="UPDATE comments SET comment_status='approved' WHERE comment_id=$the_comment_id";
        $approved_query= mysqli_query($conn,$query);
        header("location:comments.php");
     }

     //unapproved comments query
     if(isset($_GET['unapprove'])){
        $the_comment_id = escape($_GET['unapprove']);
        $query="UPDATE comments SET comment_status='unapproved' WHERE comment_id=$the_comment_id";
        $unapproved_query= mysqli_query($conn,$query);
        header("location:comments.php");
     }

    
    //delete comments
    if(isset($_GET['delete_comments'])){
        $deleted_id = escape($_GET['delete_comments']);
        $query="DELETE from comments where comment_id = {$deleted_id}";
        $delete_query= mysqli_query($conn,$query);
        header("location:comments.php");
     }
     ?>

    </tbody>
</table>