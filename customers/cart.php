
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

                <div id="shopping_cart">

                    <?php cart(); ?>

                    <span style="float: right; line-height: 35px; font-size: 18px; padding: 5px;">
                        Welcome <?php echo $_SESSION['name'];?>! <b style="color: #ffff00;">Shopping Cart -</b> Total Items: <?php total_items();?> Total
                        Price: <?php total_price(); ?> <a
                            href="cart.php" style="color: #ffff00;">Go to Cart</a>

                    </span>

                </div>


                <div id="products_box">

                    <form action="" method="post" enctype="multipart/form-data">

                        <table align="center" width="730px" bgcolor="#87ceeb">

                            <tr align="center">
                                <th>Edit</th>
                                <th>Product(s)</th>
                                <th>Quantity</th>
                                <th>Total Price</th>

                            </tr>

                            <?php

                            global $con;

                            $price = 0.0;

                            $ip = getIp();

                            $sel_price = "select * from cart where ip_add = '$ip'";

                            $q = $con->query($sel_price);

                            $q->setFetchMode(PDO::FETCH_ASSOC);

                            while($row = $q->fetch()){
                                $id = $row['p_id'];
                                $cart_qty = $row['qty'];
                                $sql_pro = "select * from products where product_id = '$id'";

                                $qry = $con->query($sql_pro);

                                $qry->setFetchMode(PDO::FETCH_ASSOC);

                                while($r=$qry->fetch()){

                                    //$pr_array = array($r['product_price']);
                                    $pro_title = $r['product_title'];
                                    $pro_image = $r['product_image'];
                                    $pro_price = $r['product_price'];

                                    /*$value = array_sum($pr_array);

                                    $price+=$value;*/

                                    //$price+=$pro_price;
                                    $price += $pro_price * $cart_qty;

                            //echo "$".$price;

                            ?>

                            <tr align="center">
                                <td><input type="checkbox" name="edit[]" value="<?php echo $id; ?>" /></td>
                                <td>
                                    <?php echo $pro_title; ?><br>
                                    <img src="../admin_area/product_images/<?php echo $pro_image; ?>" width="80"
                                         height="80" />
                                </td>
                                <td>
                                    <?php echo "<b>".$cart_qty."</b>";?>
                                </td>


                                <td><?php echo "$". $pro_price * $cart_qty; ?></td>

                            </tr>



                            <?php }} ?>


                            <tr>
                                <td colspan="4" align="right"><b>Sub Total: </b></td>
                                <td align="left"><?php echo "$".$price; ?></td>
                            </tr>

                            <tr>
                                <td><input type="submit" name="update_item" value="Update" /></td>
                                <td><input type="submit" name="delete_item" value="Delete Item" /></td>
                                <td><input type="submit" name="continue" value="Continue Shopping" /></td>
                                <td>
                                    <button style="cursor: hand;"><a href="checkout.php" style="text-decoration:none; color: #000000;">Checkout</a></button>
                                </td>

                            </tr>
                        </table>



                    </form>

                    <?php

                    /*$ip = getIp();


                    if(isset($_POST['update_item'])){
                        if(isset($_POST['edit'])) {
                            foreach ($_POST['edit'] as $edit_id) {
                                if(isset($_POST['qty'])){
                                    foreach($_POST['qty'] as $qty){
                                        $update_product = "update cart set qty = $qty where p_id = '$edit_id' and ip_add = '$ip'";

                                        $qry_run = $con->query($update_product);

                                        if ($qry_run) {
                                            echo "<script>window.open('cart.php', '_self');</script>";
                                        }
                                    }

                                }

                            }
                        }
                    }*/

                        if(isset($_POST['delete_item'])){
                            if(isset($_POST['edit'])) {
                                foreach ($_POST['edit'] as $edit_id) {
                                    $delete_product = "delete from cart where p_id = '$edit_id' and ip_add = '$ip'";

                                    $qry_run = $con->query($delete_product);

                                    if ($qry_run) {
                                        echo "<script>window.open('cart.php', '_self');</script>";
                                    }
                                }
                            }
                        }




                        if(isset($_POST['continue'])){
                            echo "<script>window.open('index.php', '_self');</script>";
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