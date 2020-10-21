<?php
/**
 * Short description for code
 * php version 7.2.10
 * 
 * @category Category_Name
 * @package  PackageName
 * @author   Abhishek Singh <author@example.com>
 * @license  http://www.php.net/license/3_01.txt 
 * @link     http://pear.php.net/package/PackageName 
 * 
 * This is a "Docblock Comment," also known as a "docblock." 
 */
session_start();
$errors = array();
require 'config.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <title>
        User-Dashboard
        </title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
<body>
    <div id="min">
    <p>Thank You !!</p>
    </div>
    <div id="max">
    <a href='userdash.php'>Continue Shopping</a>
    <a href='logout.php'>Log out</a>
    </div>

</body>