<?php

    function connection(){
        $server_name = 'localhost';
        $username = 'root';
        $password = 'root'; // For Xampp users, password is "".
        $db_name = 'minimart_catalog';

        // Create a connection
        $conn = new mysqli($server_name, $username, $password, $db_name);
        // $conn is an object and mysqli()is a class. You can access the member variables and functions of a class using the object.

        // Check connection
        if($conn -> connect_error){
            die("Connection failed: " . $conn -> connect_error);
        }
        else{
            return $conn;
        }
        //connect_error is a member variable of mysqli(). To access this, you have to state the object ($conn), object operator (->), and the variable name (connect_error). Therefore, $conn->connect_errorholds the description of the last connection error.

        //die() is a built-in PHP functionthat terminates the current script and displays a message stated inside the parenthesis. Below is a snippet if an error is encountered.

    }

?>