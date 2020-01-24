<form action="" method="POST">
    <div class="form-group">
        <label for="cat_title">Edit Category</label>

            <?php //edit query

                if(isset($_GET['edit']))
                    {
                        $id = $_GET['edit'];
                        $query = "SELECT * FROM categories WHERE cat_id = $id"; 
                        $select_all_categories_by_id = mysqli_query($connection, $query); 

                        while($row = mysqli_fetch_assoc($select_all_categories_by_id)) 
                        { 
                            $id = $row["cat_id"];
                            $title = $row['cat_title']; 
                                        
            ?>
                <input value="<?php if(isset($title)){ echo $title; } ?>" type="text" class="form-control" name="cat_title">
            <?php 
                        }
                    }

            ?>

            <?php //update query
                if(isset($_POST['update_category']))
                {
                    $title = $_POST['cat_title'];
                    $query = "UPDATE categories SET cat_title = '{$title}' WHERE cat_id = {$id} ";
                    $update_query = mysqli_query($connection,$query);
                    if(!$update_query)
                    {
                        die('query failed' . mysqli_error($connection));
                    }
                }
            ?>
    </div>


    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_category" value="Update">
    </di>
    </form>