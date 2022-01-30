<?php include "include/admin_header.php";
//   include "functions.php";  
?>

<div id="wrapper">
    <!-- Navigation -->

    <?php include "include/admin_navigation.php";   ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to BABA's admin
                        <small><?php echo $_SESSION['username']; ?></small>
                    </h1>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                    <?php
                                    $query = "SELECT * FROM posts ";
                                    $query_post = mysqli_query($conn, $query);
                                    $post_count = mysqli_num_rows($query_post);

                                    echo "<div class='huge'>{$post_count}</div>";
                                    ?>



                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="admin_posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM comments ";
                                    $query_post = mysqli_query($conn, $query);
                                    $comment_count = mysqli_num_rows($query_post);

                                    echo "<div class='huge'>{$comment_count}</div>";
                                    ?>
                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM users ";
                                    $query_post = mysqli_query($conn, $query);
                                    $users_count = mysqli_num_rows($query_post);

                                    echo "<div class='huge'>{$users_count}</div>";
                                    ?>
                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM category ";
                                    $query_post = mysqli_query($conn, $query);
                                    $categories_count = mysqli_num_rows($query_post);

                                    echo "<div class='huge'>{$categories_count}</div>";
                                    ?>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <?php
            $query = "SELECT * FROM posts WHERE post_status = 'draft' ";
            $query_drafted_posts = mysqli_query($conn, $query);
            $post_draft_count = mysqli_num_rows($query_drafted_posts);

            $query = "SELECT * FROM comments WHERE comment_status = 'unapproved' ";
            $query_unnaproved_comments = mysqli_query($conn, $query);
            $unnaproved_comment_count = mysqli_num_rows($query_unnaproved_comments);

            $query = "SELECT * FROM users WHERE user_role = 'subscriber' ";
            $query_role_users = mysqli_query($conn, $query);
            $users_role_count = mysqli_num_rows($query_role_users);

            ?>


            <div class="row">
                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['bar']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Data', 'Count'],
                            <?php

                            $element_text = ['Posts', 'Drafted Posts', 'Comments', 'Unapproved Comments', 'Users', 'Subscribers', 'Categories'];
                            $element_count = [$post_count, $post_draft_count, $comment_count, $unnaproved_comment_count, $users_count, $users_role_count, $categories_count];

                            for ($i = 0; $i < 7; $i++) {
                                echo "['{$element_text[$i]}'" . " , " . "{$element_count[$i]}],";
                            }

                            ?>
                        ]);

                        var options = {
                            chart: {
                                title: '',
                                subtitle: '',
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>

            </div>
            <div id="columnchart_material" style="width: auto; height: 500px;"></div>
        </div>
        <!-- /.container-fluid -->


        <?php include "include/admin_footer.php";
