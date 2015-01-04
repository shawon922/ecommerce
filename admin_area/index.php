<?php

    session_start();

    if(!isset($_SESSION['admin_name'])){
        header('Location: ../index.php');
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <title>
            Welcome to Admin Panel
        </title>

        <link rel="stylesheet" href="styles/style.css" media="all" />
    </head>

    <body>


    </body>
</html>