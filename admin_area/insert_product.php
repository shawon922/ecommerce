<!DOCTYPE html>

<?php require 'includes/db_connection.php';?>

<html>
    <head>
        <title>Inserting Product</title>

        <script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
        <script>tinymce.init({selector:'textarea'});</script>

    </head>

    <body bgcolor="#87ceeb">

        <form action="insert_product.php" method="post" enctype="multipart/form-data">
            <table align="center" width="700px" bgcolor="#b8860b" border="2">

                <tr align="center">
                    <td colspan="2"><h2>Add New Product Here</h2></td>
                </tr>

                <tr>
                    <td align="right"><b>Product Title:</b></td>
                    <td><input type="text" name="product_title" size="60" required/></td>
                </tr>

                <tr>
                    <td align="right"><b>Product Category:</b></td>
                    <td>
                        <select name="product_cat">
                            <option>Select a Category</option>
                            <?php

                            $get_cats = "select * from categories";

                            $q = $con->query($get_cats);

                            $q->setFetchMode(PDO::FETCH_ASSOC);

                            while($row_cats = $q->fetch()){
                                $cat_id = $row_cats['cat_id'];
                                $cat_title = $row_cats['cat_title'];
                                echo "<option value='".$cat_id."'>$cat_title</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td align="right"><b>Product Brand:</b></td>
                    <td>
                        <select name="product_brand">
                            <option>Select a Brand</option>
                            <?php
                            $get_brands = "select * from brands";

                            $q = $con->query($get_brands);

                            $q->setFetchMode(PDO::FETCH_ASSOC);

                            while($row_brands = $q->fetch()){
                                $brand_id = $row_brands['brand_id'];
                                $brand_title = $row_brands['brand_title'];

                                echo "<option value='".$brand_id."'>$brand_title</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td align="right"><b>Product Price:</b></td>
                    <td><input type="text" name="product_price" required/></td>
                </tr>

                <tr>
                    <td align="right"><b>Product Image:</b></td>
                    <td><input type="file" name="product_image" required/></td>
                </tr>

                <tr>
                    <td align="right"><b>Product Description:</b></td>
                    <td><textarea name="product_desc" cols="20" rows="10" ></textarea></td>
                </tr>

                <tr>
                    <td align="right"><b>Product Keywords:</b></td>
                    <td><input type="text" name="product_keywords" size="60" required/></td>
                </tr>

                <tr align="center">
                    <td colspan="2"><input type="submit" name="insert_post" value="Insert Now" /></td>
                </tr>


            </table>

        </form>

    </body>

</html>

<?php

    if(isset($_POST['insert_post'])){

        //Getting the text data from the fields
       $product_title = $_POST['product_title'];
       $product_cat = $_POST['product_cat'];
       $product_brand = $_POST['product_brand'];
       $product_price = $_POST['product_price'];
       $product_desc = $_POST['product_desc'];
       $product_keywords = $_POST['product_keywords'];

        //Getting the image from the field
        $product_image = $_FILES['product_image']['name'];
        $product_image_tmp = $_FILES['product_image']['tmp_name'];

        move_uploaded_file($product_image_tmp, "product_images/$product_image");

        $insert_sql = "insert into products(product_cat, product_brand, product_title, product_price, product_desc, product_image,
product_keywords) values ($product_cat, $product_brand, '$product_title', $product_price, '$product_desc',
'$product_image', '$product_keywords')";


        $q = $con->prepare($insert_sql);

        $q->execute();

        if($q){
            echo "<script>alert('Product Has Been Inserted!')</script>";
            echo "<script>window.open('insert_product.php', '_self')</script>";
        }
    }





?>