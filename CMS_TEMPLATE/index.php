<?php include 'header.php';?>

    <!-- Page Content -->
    <div class="container">
        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <?php

                $query_pager = "SELECT * FROM posts ";
                $query_pager_conn = mysqli_query($conn,$query_pager);
                $count = mysqli_num_rows($query_pager_conn);
                $count = $count / 5 ;


                $query="SELECT * FROM posts;";
                $postFetch = mysqli_query($conn,$query);

            while($row=mysqli_fetch_assoc($postFetch)){
                $post_id=$row['post_id'];
                $post_title=$row['post_title'];
                $post_author=$row['post_author'];
                $post_date=$row['post_date'];
                $post_image=$row['post_image'];
                $post_content=$row['post_content'];

                

                ?>
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id; ?>">
                <img class="img-responsive" src="./assets/<?php echo $post_image?> ">
                </a>
                <hr>
                <p><?php echo $post_content?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

              <?php } ?>

                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <?php
                        for($i = 1;$i<=$count ; $i++){
                            echo "<li><a href='index.php?count={$i}'>{$i}</a></li>";
                        }
                    ?>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>
            
        <?php include 'sidebar.php';?>


        <?php include 'footer.php';?>