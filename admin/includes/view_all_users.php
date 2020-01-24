
<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email </th>
                                    <th>Image </th>
                                    <th>Role</th>
                                    <th>Change to admin</th>
                                    <th>Change to sub</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    // Find all categories
                                    $query = "SELECT * FROM users"; 
                                    $select_all_users = mysqli_query($connection, $query); 
                                
                                    while($row = mysqli_fetch_assoc($select_all_users)) 
                                    { 
                                            $user_id = $row["user_id"];
                                            $username = $row["username"];
                                            $user_password = $row['user_password']; 
                                            $user_firstname = $row['user_firstname']; 
                                            $user_lastname = $row['user_lastname']; 
                                            $user_email = $row['user_email'];
                                            $user_image = $row['user_image']; 
                                            $user_role = $row['user_role'];
                                            

                                            echo "<tr>";
                                            echo "<td> $user_id</td>";
                                            echo "<td> $username</td>";
                                            echo "<td>$user_firstname</td>";

                                            echo "<td>$user_lastname</td>";
                                            echo "<td>$user_email</td>";
                                            echo "<td>$user_image</td>";
                                            echo "<td>$user_role</td>";

                                            //url parameters are seperated using the ampersand &
                                            echo "<td><a href='./users.php?change_to_admin=admin&user_id={$user_id}'>Change to Admin</a></td>";
                                            echo "<td><a href='./users.php?change_to_sub=subscriber&user_id={$user_id}'>Change to Sub</a></td>";
                                            echo "<td><a href='./users.php?source=edit_user&user_id={$user_id}'>Edit</a></td>";
                                            echo "<td><a href='./users.php?delete={$user_id}'>Delete</a></td>";
                                            echo "</tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
<?php
    if(isset($_GET['delete']))
    {
        $user_id = $_GET['delete'];

        $query = "DELETE FROM users WHERE user_id = {$user_id}";
        $delete_query = mysqli_query($connection, $query);

        confirm_query($delete_query);
        //refresh page
        header("Location: users.php");
    }

    if(isset($_GET['change_to_admin']))
    {
        $user_id = $_GET['user_id'];

        $query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$user_id}";
        $set_to_admin_query = mysqli_query($connection, $query);

        confirm_query($set_to_admin_query);
        //refresh page
        header("Location: users.php");
    }


    if(isset($_GET['change_to_sub']))
    {
        $user_id = $_GET['user_id'];

        $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = {$user_id}";
        $set_to_sub_query = mysqli_query($connection, $query);

        confirm_query($set_to_sub_query);
        //refresh page
        header("Location: users.php");
    }
?>