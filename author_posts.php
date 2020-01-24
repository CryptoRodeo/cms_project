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

                if(isset($_GET['author']))
                {
                    $post_author = $_GET['author'];
                }
            $query = "SELECT * FROM posts WHERE post_author = '{$post_author}'";

                $select_all_posts = mysqli_query($connection, $query);

                if($select_all_posts)
                {
                    while($row = mysqli_fetch_assoc($select_all_posts))
                    {
                        $id = $row["post_id"];
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
                    <a href="./post.php?p_id=<?php echo $id; ?>"><?php echo $title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $date ?></p>
                <hr>
                <img class="img-responsive" src="./images/<?php echo $image; ?>" alt="">
                <hr>
                <p><?php echo $content ?></p>

                <hr>

            <?php } //end of loop
                } // End of if
                
                else
                {
            ?>

                    <h1 class="page-header">No posts for this author <?php echo $_GET['author']; ?></h1>
                <?php

                }

                ?> <!-- END OF ELSE -->
        </div>
        <!-- /.row -->
        <hr>
        <?php include "./includes/footer.php";?>
    </div>