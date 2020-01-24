<?php


    if(isset($_POST['create_user']))
    {
        $username = $_POST["username"];
        $user_password = $_POST['user_password']; 
        $user_firstname = $_POST['user_firstname']; 
        $user_lastname = $_POST['user_lastname']; 
        $user_email = $_POST['user_email'];
        // $user_image = $_POST['user_image']; 
        $user_role = $_POST['user_role'];


        $query = "INSERT INTO users (user_firstname, user_lastname, user_role, username,  user_email, user_password) ";

        $query .= "VALUES('{$user_firstname}', '{$user_lastname}', '{$user_role}', '{$username}', '{$user_email}', '{$user_password}') ";


        $create_user_query = mysqli_query($connection, $query);

        confirm_query($create_user_query);

        echo "
        <div style='background-color: #cce5ff' class='alert alert-primary' role='alert'>
            <p>User Created:<p> <a href='users.php'>View Users</a>
        </div>";
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
        <label for="Author">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="Author">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
     </div>

    <div class="form-group">
        <select name="user_role" id="">
        <option value="subscriber">Select options</option> <!-- default -->
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
     </select>
    </div>

    <div class="form-group">
        <label for="image">Username</label>
        <input type="text" class="form-control" name="username">
    </div>

    <!-- <div class="form-group">
        <label for="image">User Image</label>
        <input type="file" class="form-control" name="user_image">
    </div> -->

    <div class="form-group">
        <label for="post_tags">Email</label>
        <input type="text" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="post_tags">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Add User">
    </div>
</form>
