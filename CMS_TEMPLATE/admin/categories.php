<?php include "include/admin_header.php";   ?>

    <div id="wrapper">

        <!-- Navigation -->

    <?php include "include/admin_navigation.php";   ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to BABA's page
                            <small>Author</small>
                        </h1>


                        <div class="col-xs-6">

            <?php adding_categories(); ?>
            
                            <form action="" method="post">
                                <!--add form -->
                                <div class="form-group">
                                    <label for="cat-title">Add Categories</label>
                                    <input type="text" class="form-control" name="cat_title">
                                    
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                </div>
                            </form>

<!--edit form -->
<?php 
if(isset($_GET['update'])){
    $cat_id=escape($_GET['update']);
    include "include/update-categories.php";
}
?>
                                    
                                    
                        </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="update" value="Update Category">
                                </div>
                            </form>
                            
                         </div>

                         <div class="col-xs-6">
                             <table class="table table-bordered table-hover">
                                 <thead>
                                     <tr>
                                         <th>Id</th>
                                         <th>Category Title</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                
 <?php allCategories(); ?> 

 <?php deleteCategories(); ?>
                                                               
                                 </tbody>
                             </table>
                         </div>
                  </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
    <?php include "include/admin_footer.php"; ?>

