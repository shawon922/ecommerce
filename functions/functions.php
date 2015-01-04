<?php
/**
 * Created by PhpStorm.
 * User: shawon
 * Date: 11/9/2014
 * Time: 7:14 PM
 */

//Database connection

$host = 'localhost';
$db = 'ecommerce';
$user = 'root';
$pass = '';



$con = new PDO("mysql:host=$host;dbname=$db", $user, $pass);



//Getting IP address

function getIp() {

    $ip = $_SERVER['REMOTE_ADDR'];

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {

        $ip = $_SERVER['HTTP_CLIENT_IP'];

    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {

        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];

    }

    return $ip;
}

function cart(){

    global $con;

    if(isset($_GET['add_cart'])){

        $ip = getIp();

        $pro_id = $_GET['add_cart'];

        $check_pro = "select * from cart where ip_add = '$ip' and p_id = '$pro_id'";

        $q = $con->query($check_pro);

        $row_count_cart = $q->rowCount();

        if($row_count_cart > 0){
            echo "<script>alert('Already added this product!!')</script>";
        }else{

            $get_pro_price = "select product_price from products where product_id = $pro_id";

            $run_pro_price = $con->query($get_pro_price);

            $run_pro_price->setFetchMode(PDO::FETCH_ASSOC);

            $row = $run_pro_price->fetch();

            $pro_price = $row['product_price'];

            $insert_pro = "insert into cart (p_id, ip_add, qty, price) values ($pro_id, '$ip', 1, $pro_price)";

            $q_insert = $con->query($insert_pro);

            echo "<script>window.open('index.php', '_self');</script>";
        }
    }
}


//total items in shopping cart

function total_items(){
    global $con;

    if(isset($_GET['add_cart'])){

        $ip = getIp();

        $get_items = "select * from cart where ip_add = '$ip'";

        $q = $con->query($get_items);

        $row_count = $q->rowCount();

    }else{
        $ip = getIp();

        $get_items = "select * from cart where ip_add = '$ip'";

        $q = $con->query($get_items);

        $row_count = $q->rowCount();
    }

    echo $row_count;
}


//total price function

function total_price(){
    global $con;

    $price = 0.0;

    $ip = getIp();

    $sel_price = "select * from cart where ip_add = '$ip'";

    $q = $con->query($sel_price);

    $q->setFetchMode(PDO::FETCH_ASSOC);

    while($row = $q->fetch()){
        $id = $row['p_id'];
        $sql_pro = "select product_price from products where product_id = '$id'";

        $qry = $con->query($sql_pro);

        $qry->setFetchMode(PDO::FETCH_ASSOC);

        while($r=$qry->fetch()){

            $pr_array = array($r['product_price']);
            $value = array_sum($pr_array);

            $price+=$value;

            //$price+=$r['product_price'];
        }
    }

    echo "$".$price;

}


//Update cart function




//getting the categories

function getCats(){
    global $con;

    $get_cats = "select * from categories";

    $q = $con->query($get_cats);

    $q->setFetchMode(PDO::FETCH_ASSOC);

    while($row_cats = $q->fetch()){
        $cat_id = $row_cats['cat_id'];
        $cat_title = $row_cats['cat_title'];

        echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
    }
}

function getBrands(){

    global $con;

    $get_brands = "select * from brands";

    $q = $con->query($get_brands);

    $q->setFetchMode(PDO::FETCH_ASSOC);

    while($row_brands = $q->fetch()){
        $brand_id = $row_brands['brand_id'];
        $brand_title = $row_brands['brand_title'];

        echo "<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";
    }
}

function showProducts()
{
    global $con;

    if (isset($_GET['cat'])) {
        $cat_id = $_GET['cat'];

        $show_pro = "select * from products where product_cat=$cat_id order by RAND() LIMIT 0, 6";
        $q = $con->query($show_pro);

        $row_count_cat = $q->rowCount();

        if($row_count_cat==0){
            echo "<h2 style='padding: 20px;'>Nothing found in this category !!</h2>";
        }

    } elseif (isset($_GET['brand'])) {

        $brand_id = $_GET['brand'];
        $show_pro = "select * from products where product_brand=$brand_id order by RAND() LIMIT 0, 6";
        $q = $con->query($show_pro);

        $row_count_brand = $q->rowCount();

        if($row_count_brand==0){
            echo "<h2 style='padding: 20px;'>Nothing found in this brand !!</h2>";
        }
    }else{
        $show_pro = "select * from products order by RAND() LIMIT 0, 6";
        $q = $con->query($show_pro);

        $row_count_pro = $q->rowCount();

        if($row_count_pro==0){
            echo "<h2 style='padding: 20px;'>No product found!!</h2>";
        }
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

                <img src='admin_area/product_images/$pro_image' width='180' height='180'>

                <p><b>Price: $ $pro_price</b></p>

                <a href='details.php?pro_id=$pro_id' style='float: left;'>Details</a>
                <a href='index.php?add_cart=$pro_id'><button style='float: right;'>Add to Cart</button></a>
            </div>
        ";

        }
    }

}