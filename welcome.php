<!DOCTYPE html>
<?php
    require 'functions/functions.php';
?>
<html>
<head>
    <title>Welcome to Shopping Cart</title>

    <link rel="stylesheet" href="styles/style.css" media="all" />
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
                        Welcome Guest! <b style="color: #ffff00;">Shopping Cart -</b> Total Items: <?php total_items();?> Total
                        Price: <?php total_price(); ?> <a
                        href="cart.php" style="color: #ffff00;">Go to Cart</a>

                    </span>

            </div>


            <div style="text-align:center; color: #000000; height: 450px;">
                <h2 style="margin-top: 100px;">Welcome to our Shopping Cart</h2>
                <h3 style="margin-top: 50px;">Registration successfully completed!</h3>
            </div>

        </div>

    </div>

    <!--Content ends here -->

    <?php include 'footer.php'; ?>


</div>
<!--Main container ends here -->

</body>

</html>