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

            $query="SELECT * FROM posts;";
            $postFetch = mysqli_query($conn,$query);

            if(isset($_POST['submit'])){

                $search = $_POST['input-search'];

                $query = "SELECT * FROM posts where post_tags like '%$search%' ";
                $search_fetch= mysqli_query($conn,$query);

                if(!$search_fetch){
                    die('ERRROR'.mysqli_error($conn));
                }
                $num = mysqli_num_rows($search_fetch);
                if($num==0){
                    echo'NO RESULT';
                }else {
                    
                    while($row=mysqli_fetch_assoc($search_fetch)){
                        $post_title=$row['post_title'];
                        $post_author=$row['post_author'];
                        $post_date=$row['post_date'];
                        $post_image=$row['post_image'];
                        $post_content=$row['post_content'];
        
                        ?>
                        <h2>
                            <a href="#"><?php echo $post_title?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $post_author?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date?></p>
                        <hr>
                        <img class="img-responsive" src="./assets/<?php echo $post_image?> ">
                        <hr>
                        <p><?php echo $post_content?></p>
                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
        
                        <hr>
        
                        <?php } 
            
            }
            
            }
            
            ?>
              

                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>
            
        <?php include 'sidebar.php';?>


        <?php include 'footer.php';?>