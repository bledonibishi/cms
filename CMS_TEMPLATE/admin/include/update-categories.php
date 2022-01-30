<form action="" method="post">
    <div class="form-group">
        <label for="cat-title">Update Categories</label>

        <?php //updating categories
        if (isset($_GET['update'])) {
            $cat_id = escape($_GET['update']);
            $query = "SELECT * FROM category WHERE cat_id = $cat_id ";
            $query_category_edit = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($query_category_edit)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
        ?>
                <input value="<?php if (isset($cat_title)) {
                                    echo $cat_title;
                                } ?>" type="text" class="form-control" name="cat_title">

        <?php    }
        }     ?>

        <?php
        if (isset($_POST['update'])) {
            $the_cat_title = escape($_POST['cat_title']);
            $query = "UPDATE category SET cat_title = '{$the_cat_title}' where cat_id = {$cat_id}";
            $update_query = mysqli_query($conn, $query);
        }

        ?>