<?php include "./includes/admin_header.php" ?>

<?php
    //check if session is set
    if(isset($_SESSION['username']))
    {
        $username = $_SESSION['username'];

    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_user_profile = mysqli_query($connection, $query);

    while($row = mysqli_fetch_array($select_user_profile))
    {
        $user_id = $row["user_id"];
        $username = $row["username"];
        $user_password = $row['user_password']; 
        $user_firstname = $row['user_firstname']; 
        $user_lastname = $row['user_lastname']; 
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];
    }
    }
?>

<?php
    if(isset($_POST['update_user']))
    {
        $username = $_POST["username"];
        $user_password = $_POST['user_password']; 
        $user_firstname = $_POST['user_firstname']; 
        $user_lastname = $_POST['user_lastname']; 
        $user_email = $_POST['user_email'];
        $user_role = $_POST['user_role'];
        // $user_image = $_POST['user_image']; 
        $user_role = $_POST['user_role'];


         $query = "UPDATE users SET ";
         $query .= "username = '{$username}', ";
         $query .= "user_password = '{$user_password}', ";
         $query .= "user_firstname = '{$user_firstname}', ";
         $query .= "user_lastname = '{$user_lastname}', ";
         $query .= "user_email = '{$user_email}', ";
         $query .= "user_role = '{$user_role}' ";
        //  $query .= "user_image = '{$user_image}' ";
         $query .= "WHERE username = '{$username}' ";

         $update_query = mysqli_query($connection, $query); 
    }
?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "./includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                    <h1 class="page-header">
                            Welcome to Admin
                            <small><?php echo $username; ?></small>
                    </h1>
                    <form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
        <label for="Author">Firstname</label>
        <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="Author">Lastname</label>
        <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname">
     </div>

    <div class="form-group">
        <select name="user_role" id="">
        <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option> <!-- default -->
        <?php
            if($user_role == 'admin')
            {
                 echo "<option value='subscriber'>Subscriber</option>";
            }
            else
            {
                echo "<option value='admin'>Admin</option>";
            }
        ?>
     </select>
    </div>

    <div class="form-group">
        <label for="image">Username</label>
        <input type="text" value="<?php echo $username; ?>" class="form-control" name="username">
    </div>

    <!-- <div class="form-group">
        <label for="image">User Image</label>
        <input type="file" class="form-control" name="user_image">
    </div> -->

    <div class="form-group">
        <label for="post_tags">Email</label>
        <input type="text" value="<?php echo $user_email; ?>" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="post_tags">Password</label>
        <input type="password" value="<?php echo $user_password; ?>" class="form-control" name="user_password">
    </div>
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_user" value="Update Profile">
    </div>
</form>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "./includes/admin_footer.php" ?>