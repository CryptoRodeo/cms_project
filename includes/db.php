<?php ob_start();

    $db['host'] = 'localhost';
    $db['user'] = 'root';
    $db['pass'] = '';
    $db['name'] = 'cms';

    //convert to a constant

    foreach($db as $key => $value)
    {
        //convert to constant
        //uppercase key since constants need to be in all uppercase
        // host = HOST
        define(strtoupper($key), $value);
    }
    

    $connection = mysqli_connect(HOST, USER, PASS, NAME);

    // if($connection)
    // {
    //     echo "We are connected";
    // }
?>