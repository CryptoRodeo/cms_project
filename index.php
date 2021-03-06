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

            $limit_per_page = 4;
            if(isset($_GET['page']))
            {
                $page_index = $_GET['page'];
            }
            else
            {
                $page_index="";
            }

            //if @ homepage
            if($page_index == "" || $page_index == 1)
            {
                $offset = 0; //retrieve the first row
            }
            else
            {
                //offset is (current_page_index * 5) - 5
                /**
                 * This gives us the distance away from the beginning
                 * 
                 * example:
                 * 
                 * if page = 2
                 * 
                 * offset = (2 * 5) - 5 = 5
                 * 
                 * So now we're retrieving 5 values/pages from starting at index 5 
                 */
                $offset = ($page_index * $limit_per_page) - $limit_per_page; 
            }
                $post_query_count = "SELECT * FROM posts";
                $find_count = mysqli_query($connection, $post_query_count);
                $count = mysqli_num_rows($find_count);

                //get the ceiling value of the amount of posts in the db / the limit set per page.
                /**
                 * So if theres 15 posts and the limit is 3 then the result will be 5
                 * 
                 * If theres 15 posts and the limit is 4 then the result will be 4 and etc.
                 */
                $count = ceil($count / $limit_per_page);


                $query = "SELECT * FROM posts WHERE post_status = 'published' LIMIT $offset, $limit_per_page";

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
                <h1><?php echo $count; ?></h1>
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


    <ul class="pager">
        <?php
            for($i = 1; $i <= $count; $i++)
            {
                if($i == $page_index)
                {
                    echo 
                    "
                        <li>
                            <a class='active_link' href='index.php?page={$i}'>{$i}</a>
                        </li>
                    ";
                }
                else
                {
                    echo 
                    "
                        <li>
                            <a href='index.php?page={$i}'>{$i}</a>
                        </li>
                    ";
                }
            }
        ?>
    </ul>
<?php include "./includes/footer.php";?>