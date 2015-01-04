<?php
/**
 * Created by PhpStorm.
 * User: shawon
 * Date: 11/15/2014
 * Time: 9:51 PM
 */

//Database connection

$host = 'localhost';
$db = 'ecommerce';
$user = 'root';
$pass = '';

$con = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

