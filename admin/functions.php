<?php 


function getUsersOnline()
    {
        if(isset($_GET['online_users']))
        {
            global $connection;

            //if the connection is not available, due to the way the files are important
            if(!$connection)
            {
                session_start();
                include('../includes/db.php');

                //catch session
                $session = session_id();
                
                //holds the time measured in seconds
                $time = time();
        
                //amount of time available until the user is marked offline.
                $time_out_in_seconds = 60; //
        
                //The current time minus the time out limit
                $time_out = $time - $time_out_in_seconds;
                
                //select the user in the current session.
                $query = "SELECT * FROM users_online WHERE session = '{$session}'";
        
                $send_query = mysqli_query($connection, $query);
                
                //checks to see if there is a user with a session id or if its a new user
                $count = mysqli_num_rows($send_query);
        
                //if a new user is online
                if($count == null)
                {
                    //insert the current user into the table.
                    mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES ('$session','$time')");
                }
                //user is not new, update their time if theyre actively using the site.
                else
                {
                    mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session' ");
                }
        
        
                //gets all the current users logged in and not timed out. 
                $users_online = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out' ");
                echo $online_user_count = mysqli_num_rows($users_online); //what is returned to the GET request
            }
         
        }
        
    }

    getUsersOnline();

    function confirm_query($query)
    {
        global $connection;
        if(!$query)
        {
            die("Query Failed " . mysqli_error($query));
        }
    }
    function insert_categories()
    {
        global $connection; //allows the function to use the outer connecton variable
        if(isset($_POST['submit']))
        {
            $title = $_POST['cat_title'];
        
            if($title == "" || empty($title))
            {
                echo "This field should not be empty";
            }
        
            else
            {
                $query = "INSERT INTO categories(cat_title) VALUE('{$title}') ";
        
                $create_query = mysqli_query($connection, $query);
        
                if(!$create_query)
                {
                    die('QUERY FAILED' . mysqli_error($connection));
                }
                else
                {
                    echo "succed.";
                }
            }
        }
    }

    function find_all_categories()
    {
        global $connection;
    
        // Find all categories
        $query = "SELECT * FROM categories"; 
        $select_all_categories = mysqli_query($connection, $query); 
    
        while($row = mysqli_fetch_assoc($select_all_categories)) 
        { 
                $id = $row["cat_id"];
                $title = $row['cat_title']; 
                echo "<tr>";
                echo "<td>{$id}</td>"; 
                echo "<td>{$title}</td>"; 
                echo "<td><a href='categories.php?delete={$id}'>Delete</a></td>"; 
                echo "<td><a href='categories.php?edit={$id}'>Edit</a></td>"; 
                echo "</tr>";
        } 
    }

    function delete_category()
    {

        global $connection;
        //DELETE QUERY
        if(isset($_GET['delete']))
        {
            $id = $_GET['delete'];
            $query = "DELETE FROM categories WHERE cat_id = {$id} ";
            $delete_query = mysqli_query($connection,$query);
    
            //refreshes page
            header("Location:categories.php");
    
        }
    }
?>