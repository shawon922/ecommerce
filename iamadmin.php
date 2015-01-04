<?php session_start(); ?>

<?php
    require 'admin_area/includes/db_connection.php';

if(isset($_POST['submit'])){

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $admin_name = htmlspecialchars($_POST['admin_name']);

        $admin_pass = md5(htmlspecialchars(($_POST['admin_pass'])));


        $check_admin = "select * from admins where admin_name='$admin_name' and admin_pass='$admin_pass'";

        $q = $con->query($check_admin);

        $admin_count = $q->rowCount();

        if($admin_count==0){
            echo "<script>alert('Admin name or password wrong!');</script>";


        }else{
            //echo "<script>window.open('welcome.php','_self');</script>";
            $_SESSION['admin_name']=$admin_name;
            header('Location: admin_area/index.php');
        }



    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Admin Sign In Form</title>

</head>

<body>

            <div style="color: #000000; height: 450px; margin-top: 50px;">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <table width="700" height="250" border="2" align="center" cellspacing="5" cellpadding="5"
                           style="background: url('images/admin_log.jpg');">
                        <tr>
                            <th colspan="2" align="center">Admin Sign In Form</th>
                        </tr>

                        <tr>
                            <td align="right">Admin Name :</td>
                            <td>
                                <input type="text" name="admin_name" required>

                            </td>
                        </tr>

                        <tr>
                            <td align="right">Admin Password :</td>
                            <td><input type="password" name="admin_pass" required></td>
                        </tr>

                        <tr>
                            <td></td>
                            <td><input type="submit" name="submit" value="Sign In"></td>
                        </tr>
                    </table>
                </form>

            </div>

</body>

</html>