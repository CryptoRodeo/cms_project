<?php 

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