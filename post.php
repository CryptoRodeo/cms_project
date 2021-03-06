<?php include "./includes/db.php"; ?>
<?php include "./includes/header.php"; ?>

    <!-- Navigation -->
    <?php include "./includes/navigation.php"; ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

            <?php

                if(isset($_GET['p_id']))
                {
                    $post_id = $_GET['p_id'];
                }
                $query = "SELECT * FROM posts WHERE post_id = $post_id ";

                $select_all_posts = mysqli_query($connection, $query);


                    while($row = mysqli_fetch_assoc($select_all_posts))
                    {
                        $id = $row['post_id'];
                        $title = $row['post_title'];
                        $author = $row['post_author'];
                        $date = $row['post_date'];
                        $image = $row['post_image'];
                        $content = $row['post_content'];
            ?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $id; ?>"><?php echo $title ?></a>
                </h2>
                <p class="lead">
                    by <a href="./author_posts.php?author=<?php echo $author; ?>"><?php echo $author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $date ?></p>
                <hr>
                <img class="img-responsive" src="./images/<?php echo $image; ?>" alt="">
                <hr>
                <p><?php echo $content ?></p>

                <hr>

            <?php } ?> <!-- END OF LOOP -->


             <!-- Blog Comments -->
             

             <?php
                if(isset($_POST['create_comment']))
                {
                    $post_id = $_GET['p_id'];
                    $comment_author = $_POST['comment_author'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];
                    
                    /**
                     * All comment form inputs must be filled
                     * 
                     */
                    if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content))
                    {
                        $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                        $query .= "VALUES ($post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";

                        $create_comment_query = mysqli_query($connection, $query);
                        if(!$create_comment_query)
                        {
                            die('Query failed ' . mysqli_error($connection));
                        }
                    }

                    else
                    {
                        echo "
                            <script>
                                alert('Fields cannot be empty');
                            </script>
                        ";
                    }
                }

                $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                $query .= "WHERE post_id = $post_id";

                $update_comment_count = mysqli_query($connection, $query);
             ?>

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="post">
                    <div class="form-group">
                            <label for="comment_author">Author</label>
                            <input type="text" class="form-control" name="comment_author">
                        </div>
                        <div class="form-group">
                            <label for="comment_email">Email</label>
                            <input type="text" class="form-control" name="comment_email">
                        </div>
                        <div class="form-group">
                            <label for="comment_author">Your Comment</label>
                            <textarea class="form-control" name="comment_content" rows="3"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <?php
                    $query = "SELECT * FROM comments WHERE comment_post_id = {$post_id} ";
                    $query .= "AND comment_status = 'approved' ";
                    $query .= "ORDER BY comment_id DESC ";
                    $select_comment_query = mysqli_query($connection, $query);
                    if(!$select_comment_query)
                    {
                        die('query failed ' . mysqli_error($connection));
                    }

                    while($row = mysqli_fetch_assoc($select_comment_query))
                    {
                        $comment_date = $row['comment_date'];
                        $comment_content = $row['comment_content'];
                        $comment_author = $row['comment_author'];

                        ?>

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>
            <?php
                    }
            ?>
            </div>

            <!-- Blog Sidebar Widgets Column -->

        </div>
        <!-- /.row -->
        <hr>
        <?php include "./includes/footer.php";?>
    </div>