<?php include "include/admin_header.php";   ?>

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
                
                if(isset($_GET['source'])){
                    $source=escape($_GET['source']);
                }else{
                    $source='';
                }
                
                switch($source){
                    case 'add_user';
                    include "add_user.php";
                    break;

                    case 'edit_user';
                    include "include/edit_user.php";
                    break;

                    case '34';
                    echo "case 34";
                    break;

                    default:
                    include "include/view_all_users.php";
                    break;
                }
                
                ?>

                
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
    <?php include "include/admin_footer.php";

