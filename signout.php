<?php
/**
 * Created by PhpStorm.
 * User: shawon
 * Date: 12/10/2014
 * Time: 5:21 PM
 */

session_start();
//unset($_SESSION['name']);
session_destroy();

header('Location: signin.php');