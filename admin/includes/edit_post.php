<?php

    if(isset($_GET['p_id']))
    {
        $p_id = $_GET['p_id'];
    }

    // Find all categories
    $query = "SELECT * FROM posts WHERE post_id = $p_id"; 
    $select_all_posts_by_id = mysqli_query($connection, $query); 

    while($row = mysqli_fetch_assoc($select_all_posts_by_id)) 
    { 
            $id = $row["post_id"];
            $author = $row['post_author']; 
            $title = $row['post_title']; 
            $category = $row['post_category_id']; 
            $status = $row['post_status']; 
            $image = $row['post_image']; 
            $tags = $row['post_tags']; 
            $comments = $row['post_comment_count']; 
            $date = $row['post_date'];
            $content = $row['post_content'];
    }



    if(isset($_POST['update_post']))
    {
        $post_title = $_POST['title'];
        $post_author = $_POST['author'];
        $post_category_id = $_POST['post_category'];
        $post_status = $_POST['post_status'];

        //superglobal for all files submitted
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name']; //reference to the file that is temporarily saved in the server

        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];


         //move from the temp location to this directory with the correct name of the file
         move_uploaded_file($post_image_temp, "../images/$post_image");

         if(empty($post_image))
         {
             $query = "SELECT * FROM  posts WHERE post_id = $p_id";
             $select_image = mysqli_query($connection,$query);

             while($row=mysqli_fetch_array($select_image))
             {
                $post_image = $row['post_image'];
             }
         }


         $query = "UPDATE posts SET ";
         $query .= "post_category_id = '{$post_category_id}', ";
         $query .= "post_title = '{$post_title}', ";
         $query .= "post_author = '{$post_author}', ";
         $query .= "post_date = now(), ";
         $query .= "post_status = '{$post_status}', ";
         $query .= "post_tags = '{$post_tags}', ";
         $query .= "post_content = '{$post_content}', ";
         $query .= "post_image = '{$post_image}' ";
         $query .= "WHERE post_id = {$p_id} ";

         $update_query = mysqli_query($connection, $query); 

         confirm_query($update_query);

        //  header("Location: posts.php?source=edit_post&p_id={$p_id}");
         echo "
            <div style='background-color: #cce5ff' class='alert alert-primary' role='alert'>
                <p>Post has been updated<p>
                <a href='../post.php?p_id={$p_id}>View Post</a>
            </div>";
    }
?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" value="<?php echo $title; ?>" class="form-control" name="title">
    </div>

    <div class="form-group">
        <select name="post_category" id="post_category">
            <?php
                 $query = "SELECT * FROM categories"; 
                 $select_all_categories_by_id = mysqli_query($connection, $query); 

                 confirm_query($select_all_categories_by_id);

                 while($row = mysqli_fetch_assoc($select_all_categories_by_id)) 
                 { 
                     $id = $row["cat_id"];
                     $title = $row['cat_title'];

                     echo "<option value='{$id}'>{$title}</option>";
                 }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="Author">Post Author</label>
        <input type="text" value="<?php echo $author; ?>" class="form-control" name="author">
    </div>



    <!-- <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" value="<?php echo $status; ?>" class="form-control" name="post_status">
    </div> -->

    <div class="form-group">
        <select name="post_status">
                <option value='<?php echo $status; ?>'><?php echo $status; ?></option>
                <?php
                    if($status == 'published')
                    {
                        echo "<option value='draft'>Draft</option>";
                    }
                    else
                    {
                        echo "<option value='published'>Published</option>";
                    }
                ?>
        </select>
    </div>

    <div class="form-group">
        <img width="100px" src="../images/<?php echo $image; ?>">
        <input type="file" class="form-control" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" value="<?php echo $tags; ?>" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control editor" name="post_content"" cols="3" rows="10">
            <?php echo $content; ?>
        </textarea>
    </div>
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Publish Post">
    </div>
</form>