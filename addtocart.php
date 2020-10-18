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
require "config.php";
session_start();

if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
    $query = "SELECT * FROM products WHERE pid=$pid";

    $ru = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($ru)) {
        $pesa = $row['price'];
        if (!empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $key=>$val) {
                if ($row['pid'] == $val['pid']) {
                    $pid = $val['pid'];
                    $pname = $val['pname'];
                    $image = $val['image'];
                    $price = $val['price']; 
                    $quant = $val['quant']+1;
                    $prod = [
                        "pid" => $pid,
                        "image" => $image,
                        "pname" => $pname,
                        "price" => $pesa* $quant,
                        "quant" => $quant
                    ];
                    $_SESSION['cart'][ $pid] = $prod;
                    header("Refresh:0; url=product.php");
                    return;
                }
            }
        }
        $pid = $row['pid'];
        $image = $row['image'];
        $pname = $row['name'];
        $price = $row['price'];
        $prod = [
            "pid" => $pid,
            "image" => $image,
            "pname" => $pname,
            "price" => $price,
            "quant" => 1
        ];
        $_SESSION['cart'][ $pid] = $prod;
        header("Refresh:0; url=product.php");
    }
  }
    // session_destroy();
    ?>