<!--Header starts here -->
<div class="header_wrapper">

    <a href="index.php"></a>
    <img src="../images/header.jpg">

</div>
<!--Header ends here -->

<div class="line"></div>

<!--Navigation Bar starts here -->
<div class="menubar">

    <ul id="menu" class="floatleft">
        <li><a href="index.php">Home</a></li>
        <li><a href="all_products.php">All Products</a></li>
        <li><a href="myaccount.php">My Account</a></li>
        <li><a href="cart.php">Shopping Cart</a></li>
        <li><a href="contact.php">Contact Us</a></li>
        <li><a href="../signout.php">Sign Out</a></li>
    </ul>


    <div id="form" class="floatright">
        <form method="get" action="results.php" enctype="multipart/form-data">
            <input type="text" name="user_query" placeholder="Search a product" />
            <input type="submit" name="search" value="Search" />
        </form>
    </div>

</div>
<!--Navigation Bar ends here -->