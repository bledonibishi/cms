
           <!-- Blog Sidebar Widgets Column -->
           <div class="col-md-4">

<!-- Blog Search Well -->
<div class="well">
    <h4>Blog Search</h4>
    <div class="input-group">
        <form action="search.php" method="post">
        <input type="text" class="form-control" name="input-search">
        <span class="input-group-btn">
            <button class="btn btn-default" name="submit" type="submit">
                <span class="glyphicon glyphicon-search"></span>
        </button>
        </span>
        </form>
    </div>
</div>


<!--Login-->
<div class="well">
    <h4>Login</h4>
    <form action="include/login.php" method="post">
    <div class="form-group">
        <input type="text" class="form-control" name="username" placeholder="Enter Username">  
    </div>
    <div class="input-group">
        <input type="password" class="form-control" name="password" placeholder="Enter Password"> 
        <span class="input-group-btn">
            <button class="btn btn-primary" type="submit" name="login" >Login</button>
        </span> 
    </div>
    </form>
</div>

<!-- Blog Categories Well -->
<div class="well">
    <h4>Blog Categories</h4>
    <div class="row">
        <div class="col-lg-6">
            <ul class="list-unstyled">
            <?php
            

$query="SELECT * FROM category";

$category_sidebar = mysqli_query($conn,$query);

while($row=mysqli_fetch_assoc($category_sidebar)){
    $category_title=$row['cat_title'];
    $category_id=$row['cat_id'];
    echo "<li><a href='category.php?category=$category_id'>{$category_title}</a></li>";
}
?> 
            </ul>
        </div>

    </div>
    <!-- /.row -->
</div>

<!-- Side Widget Well -->
<div class="well">
    <h4>Side Widget Well</h4>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
</div>

</div>

</div>
<!-- /.row -->

<hr>