<?php


    if(isset($_POST['create_post']))
    {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $post_category_id = $_POST['post_category'];
        $post_status = $_POST['post_status'];

        //superglobal for all files submitted
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name']; //reference to the file that is temporarily saved in the server

        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');

        //move from the temp location to this directory with the correct name of the file
        move_uploaded_file($post_image_temp, "../images/$post_image");


        $query = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_image,  post_content, post_tags, post_status) ";

        $query .= "VALUES({$post_category_id}, '{$title}', '{$author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}') ";


        $create_post_query = mysqli_query($connection, $query);

        confirm_query($create_post_query);

        /**
         * 
         * Pull the last created Post and its associated ID
         */

         $p_id = mysqli_insert_id($connection);

        echo "<div style='background-color: #cce5ff' class='alert alert-primary' role='alert'>
                    <p>Post has been created</p>
                    <a href='../post.php?p_id={$p_id}'>View New Post</a>
                </div>
                ";
    }
?>

<!--
    enctype="multipart/form-data"

    The enctype attribute specifies how the form-data should be encoded when submitting it to the server.

    multipart/form-data:

    - No characters are encoded. 
    - This value is required when you are using forms that have a file upload control


    Heres what the $_FILE super global array contains when you use it

    Array
 (
    [image] => Array
     (
        [name] => dummy.txt
        [type] => text/plain
        [tmp_name] => /Applications/MAMP/tmp/php/tempImgName
        [error] => 0
        [size] => 1
     )

    [download_screenshot] => Array
     (
        [name] => dummy.txt
        [type] => text/plain
        [tmp_name] => /Applications/MAMP/tmp/php/phpTncd39
        [error] => 0
        [size] => 1
     ) 
)

    -->
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
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
        <input type="text" class="form-control" name="author">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="post_status" id="">
            <option value="draft">Select Options</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
        </select>
    </div>

    <div class="form-group">
        <label for="image">Post Image</label>
        <input type="file" class="form-control" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control editor" name="post_content" cols="30" rows="10">
    </textarea>
    </div>
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>
</form>
