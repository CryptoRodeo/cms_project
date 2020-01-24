<?php
    if(isset($_POST['checkBoxArray']))
    {
        foreach($_POST['checkBoxArray'] as $postValueId){
            $bulk_options = $_POST['bulk_options'];
            switch($bulk_options)
            {
                case 'published':
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";
                    $update_to_published = mysqli_query($connection, $query);
                break;

                case 'draft':
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";
                    $update_to_draft = mysqli_query($connection, $query);
                break;

                case 'delete':
                    $query = "DELETE FROM posts WHERE post_id = {$postValueId}";
                    $delete_post = mysqli_query($connection, $query);
                break;
            }
        }
    }
?>

<!-- perform bulk changes to the form-->
<form action="" method="POST">
    <table class="table table-bordered table-hover">

        <div id="bulkOptionsContainer" class="col-xs-4">
            <select class="form-control" name="bulk_options" id="">
                <option value="">Select Options</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a href="posts.php?source=add_post" class="btn btn-primary">Add New Post</a>
        </div>
                            <thead>
                                <tr>
                                    <th><input id="selectAllBoxes" type="checkbox"></th>
                                    <th>ID</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Tags</th>
                                    <th>Comments</th>
                                    <th>Date</th>
                                    <th>View Post</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    // Find all categories
                                    $query = "SELECT * FROM posts"; 
                                    $select_all_posts = mysqli_query($connection, $query); 
                                
                                    while($row = mysqli_fetch_assoc($select_all_posts)) 
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

                                            echo "<tr>";

                                            ?>
                                            <td><input class='checkBoxes' type='checkbox' name="checkBoxArray[]" value="<?php echo $id; ?>"></td>
                                            <?php
                                            echo "<td>$id</td>";
                                            echo "<td>$author</td>";
                                            echo "<td>$title</td>";

                                            $query = "SELECT * FROM categories WHERE cat_id = {$category}"; 
                                            $select_all_categories_by_id = mysqli_query($connection, $query); 

                                            while($row = mysqli_fetch_assoc($select_all_categories_by_id)) 
                                            { 
                                                $cat_id = $row["cat_id"];
                                                $cat_title = $row['cat_title']; 

                                                
                                                echo "<td>{$cat_title}</td>";
                                            }
                                                echo "<td>$status</td>";
                                                echo "<td><img width='100px' src='../images/$image' alt='image'/></td>";
                                                echo "<td>$tags</td>";
                                                echo "<td>$comments</td>";
                                                echo "<td>$date</td>";
                                                echo "<td><a href='../post.php?p_id={$id}'>View</a></td>";
                                                //url parameters are seperated using the ampersand &
                                                echo "<td><a href='./posts.php?source=edit_post&p_id={$id}'>Edit</a></td>";
                                                echo "<td><a href='./posts.php?delete={$id}'>Delete</a></td>";
                                            echo "</tr>";
                                    }
                                ?>
                            </tbody>
    </table>
</form>


<?php
    if(isset($_GET['delete']))
    {
        $id = $_GET['delete'];

        $query = "DELETE FROM posts WHERE post_id = {$id} ";

        $delete = mysqli_query($connection, $query);

        confirm_query($delete);

        header("Location: posts.php");
    }
?>