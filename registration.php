<!DOCTYPE html>

<?php
    require 'admin_area/includes/db_connection.php';
    require 'functions/functions.php';

if(isset($_POST['submit'])){

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z0-9]*$/", $name)) {
            echo "<script>alert('Only letters and numbers allowed for user name!!');</script>";
            exit();
        }

        $pass = md5($_POST['pass']);

        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Invalid Email Format!');</script>";
            exit();
        }


        $check_name = "select * from customers where user_name='$name'";

        $q = $con->query($check_name);

        $name_count = $q->rowCount();

        if($name_count!=0){
            echo "<script>alert('Username already exists!!');</script>";
            exit();
        }

        $check_email = "select * from customers where user_email='$email'";

        $q = $con->query($check_email);

        $email_count = $q->rowCount();

        if($email_count!=0){
            echo "<script>alert('Email address already exists!!');</script>";

            exit();
        }

        $insert = "insert into customers (user_name, user_pass, user_email) values ('$name','$pass','$email')";

        $q = $con->query($insert);

        //echo "<script>window.open('welcome.php','_self');</script>";
        header('Location: welcome.php');

    }
}
?>



<html>
<head>
    <title>Registration Form</title>

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
                            <th colspan="2" align="center">Registration Form</th>
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
                            <td align="right">Email :</td>
                            <td>
                                <input type="email" name="email" required>
                                <?php
                                /*if(isset($_POST['submit'])){
                                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                        $emailErr = "Invalid email format";
                                        echo $emailErr;
                                    }

                                }*/
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td><input type="submit" name="submit" value="Sign Up"></td>
                        </tr>
                    </table>
                </form>

                <h4 style="text-align: center;">Already registered ?
                    <a href="signin.php" style="text-decoration: none;">Sign In</a></h4>
            </div>

        </div>

    </div>

    <!--Content ends here -->

    <?php include 'footer.php'; ?>


</div>
<!--Main container ends here -->

</body>

</html>