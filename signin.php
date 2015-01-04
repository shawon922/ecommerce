<?php session_start(); ?>

<!DOCTYPE html>

<?php
require 'admin_area/includes/db_connection.php';
require 'functions/functions.php';

if(isset($_POST['submit'])){

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $name = $_POST["name"];

        $pass = md5($_POST['pass']);


        $check_user = "select * from customers where user_name='$name' and user_pass='$pass'";

        $q = $con->query($check_user);

        $user_count = $q->rowCount();

        if($user_count==0){
            echo "<script>alert('Username or Password wrong!');</script>";
            //header('Location: signin.php');

        }else{
            //echo "<script>window.open('welcome.php','_self');</script>";
            $_SESSION['name']=$name;
            header('Location: customers/index.php');
        }



    }
}
?>



<html>
<head>
    <title>User Sign In Form</title>

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


            <div style="color: #000000; height: 450px;">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <table width="700" height="250" border="2" align="center" cellspacing="5" cellpadding="5">
                        <tr>
                            <th colspan="2" align="center">Sign In Form</th>
                        </tr>

                        <tr>
                            <td align="right">User Name :</td>
                            <td>
                                <input type="text" name="name" required>
                                <?php
                                /*if(isset($_POST['submit'])){
                                    if (!preg_match("/^[a-zA-Z]*$/", $name)) {
                                        $nameErr = "Only letters and numbers allowed";
                                        echo $nameErr;
                                    }

                                }*/
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td align="right">Password :</td>
                            <td><input type="password" name="pass" required></td>
                        </tr>

                        <tr>
                            <td></td>
                            <td><input type="submit" name="submit" value="Sign In"></td>
                        </tr>
                    </table>
                </form>
                <h4 style="text-align: center;">Not registered yet ?
                    <a href="registration.php" style="text-decoration: none;">Sign Up</a></h4>
            </div>

        </div>

    </div>

    <!--Content ends here -->

    <?php include 'footer.php'; ?>


</div>
<!--Main container ends here -->

</body>

</html>