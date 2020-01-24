<?php
    include "db.php";
?>

<?php
//turns on sessions 
    session_start();
?>

<?php
    if(isset($_POST['login']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        //prevent mysql injection
        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_user_query = mysqli_query($connection, $query);

    if(!$select_user_query)
    {
        die("QUERY FAILED" . mysqli_error($connection));
    }

    while($row = mysqli_fetch_array($select_user_query))
    {
        $dbid = $row['user_id'];
        $db_username = $row['username'];
        $db_password = $row['user_password'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];
    }

    //validation
    if($username === $db_username && $password === $db_password)
    {
        //set session variables
        $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;
        //redirect to admin page
        header("Location: ../admin");
    }
    else
    {
        //take back to the index page
        header("Location: ../index.php");
    }
    }
?>