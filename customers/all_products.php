
<?php

session_start();

if(!isset($_SESSION['name'])){
    //echo "<script>alert('Please sign in to access this page.');</script>";
    header('Location: ../signin.php');

}


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

                <?php cart(); ?>

                <div id="shopping_cart">

                    <span style="float: right; line-height: 35px; font-size: 18px; padding: 5px;">
                        Welcome <?php echo $_SESSION['name'];?>! <b style="color: #ffff00;">Shopping Cart -</b> Total Items: <?php
                        total_items();?>
                        Total Price: <?php
                        total_price(); ?> <a
                            href="cart.php" style="color: #ffff00;">Go to Cart</a>

                    </span>

                </div>


                <div id="products_box">

                    <?php

                            $show_pro = "select * from products";
                            $q = $con->query($show_pro);

                            $row_count_pro = $q->rowCount();

                            if($row_count_pro==0){
                                echo "<h2 style='padding: 20px;'>No product found!!</h2>";
                            }


                        //$q = $con->query($show_pro);

                        if(isset($row_count_cat) || isset($row_count_brand) || isset($row_count_pro)){
                            $q->setFetchMode(PDO::FETCH_ASSOC);

                            while ($row_pro = $q->fetch()) {
                                $pro_id = $row_pro['product_id'];
                                $pro_cat = $row_pro['product_cat'];
                                $pro_brand = $row_pro['product_brand'];
                                $pro_title = $row_pro['product_title'];
                                $pro_price = $row_pro['product_price'];
                                $pro_image = $row_pro['product_image'];

                                echo "
                                    <div id='single_product'>
                                        <h3>$pro_title</h3>

                                        <img src='../admin_area/product_images/$pro_image' width='180'
                                         height='180'>

                                        <p><b>Price: $ $pro_price</b></p>

                                        <a href='details.php?pro_id=$pro_id' style='float: left;'>Details</a>
                                        <a href='index.php?add_cart=$pro_id'><button style
                                        ='float: right;'>Add to Cart</button></a>
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