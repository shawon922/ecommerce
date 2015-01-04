<?php

session_start();

if(!isset($_SESSION['name'])){
    //echo "<script>alert('Please sign in to access this page.');</script>";
    header('Location: ../signin.php');

}
/*  $root = $_SERVER['DOCUMENT_ROOT'];
include($root."/path/to/file.php");*/

require 'functions/functions.php';

?>


<!DOCTYPE html>
<html>
    <head>
        <title>My Online Shop</title>

        <link rel="stylesheet" href="../styles/style.css" media="all" />
    </head>

<body>

    <!--Main container starts here -->
    <div class="main_wrapper">

        <?php include 'header.php'; ?>

        <div class="line"></div>


        <!--Content starts here -->

        <div class="content_wrapper">

            <?php include 'sidebar.php'; ?>



            <div id="content_area" class="floatright">

                <div id="shopping_cart">

                    <?php cart(); ?>

                    <span style="float: right; line-height: 35px; font-size: 18px; padding: 5px;">
                        Welcome <?php echo $_SESSION['name'];?>! <b style="color: #ffff00;">Shopping Cart -</b> Total Items: <?php total_items();?> Total
                        Price: <?php total_price(); ?> <a
                            href="cart.php" style="color: #ffff00;">Go to Cart</a>

                    </span>

                </div>


                <div id="products_box">

                    <?php showProducts(); ?>

                </div>

            </div>

        </div>

        <!--Content ends here -->

        <?php include 'footer.php'; ?>


    </div>
    <!--Main container ends here -->

</body>

</html>