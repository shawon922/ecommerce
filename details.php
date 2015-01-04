<!DOCTYPE html>

<?php
require 'functions/functions.php';
?>

<html>
<head>
    <title>My Online Shop</title>

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

                    <span style="float: right; line-height: 35px; font-size: 18px; padding: 5px;">
                        Welcome Guest! <b style="color: #ffff00;">Shopping Cart -</b> Total Items: Total Price: <a
                            href="cart.php" style="color: #ffff00;">Go to Cart</a>

                    </span>

            </div>


                <div id="products_box">

                    <?php

                    if(isset($_GET['pro_id'])){

                        $p_id = $_GET['pro_id'];

                        $show_pro = "select * from products where product_id = $p_id";

                        $q = $con->query($show_pro);

                        $q->setFetchMode(PDO::FETCH_ASSOC);

                        while($row_pro = $q->fetch()){
                            $pro_id = $row_pro['product_id'];
                            $pro_title = $row_pro['product_title'];
                            $pro_price = $row_pro['product_price'];
                            $pro_image = $row_pro['product_image'];
                            $pro_desc = $row_pro['product_desc'];
                            echo "
                                <div id='single_product'>
                                    <h3>$pro_title</h3>

                                    <img src='admin_area/product_images/$pro_image' width='400' height='300'>

                                    <p><b>$ $pro_price</b></p>
                                    <p>$pro_desc</p>

                                    <a href='index.php' style='float: left;'>Go Back</a>
                                    <a href='index.php?product_id=$pro_id'><button style='float: right;'>Add to Cart</button></a>
                                </div>
                            ";

                        }
                    }
                    ?>

                </div>

            </div>

        </div>

        <!--Content ends here -->

    <?php include 'footer.php'; ?>

    </div>
    <!--Main container ends here -->

</body>

</html>