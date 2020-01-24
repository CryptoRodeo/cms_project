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
                $query = "SELECT * FROM posts WHERE post_status = 'published' ";

                $select_all_posts = mysqli_query($connection, $query);


                    while($row = mysqli_fetch_assoc($select_all_posts))
                    {
                        $post_id = $row['post_id'];
                        $title = $row['post_title'];
                        $author = $row['post_author'];
                        $date = $row['post_date'];
                        $image = $row['post_image'];
                        //Truncates the text so its only 100 characters showing
                        $content = substr($row['post_content'], 0 , 100); $date = $row['post_date'];
                        $status = $row['post_status'];

                        if($status == 'published')
                        {

            ?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="./post.php?p_id=<?php echo $post_id; ?>"><?php echo $title ?></a>
                </h2>
                <p class="lead">
                    by <a href="./author_posts.php?author=<?php echo $author; ?>"><?php echo $author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $date ?></p>
                <hr>
                <a href="./post.php?p_id=<?php echo $post_id; ?>">
                <img class="img-responsive" src="./images/<?php echo $image; ?>" alt="">
                </a>
                <hr>
                <p><?php echo $content ?>...</p>
                <a class="btn btn-primary" href="./post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

            <?php } //end of else
                    } ?> <!-- END OF LOOP -->

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "./includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->
    </div>
<?php include "./includes/footer.php";?>