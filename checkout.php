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
$error = array();
$ttl='';
require 'config.php';
// if (empty($_SESSION['userdata']['username'])) {
//     // echo 'Please login first';
// } else {
//     $usrid = $_SESSION['userdata']['userid'];


    $tot = 0;
foreach ($_SESSION['cart'] as $key => $val) {
    $tot = $val['price'] + $tot;
}


    $all = json_encode($_SESSION['cart']);


    $sql = "INSERT INTO ordertab (`cartdata`,`total`,`date`,`status`)
            VALUES('$all','$ttl',NOW(),'sold')";

    $run = mysqli_query($conn, $sql);

if (sizeof($error)==0) {
    if ($run) {
        header('Location: cart.php');
    } else {
        $errors = array('input'=>'form','msg'=>$conn->error);
    }
    $conn->close(); 
    
}


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
<div id="error">
            <?php if (sizeof($error)>0) :?>
                <ul>
                <?php foreach ($errors as $error):?>
                    <li><?php echo $errors['msg'];break?></li>
                <?php endforeach;?>
                </ul>
            <?php endif;?>
    </div>
    <!-- <div id="mint">
    <p>Please Login for Shopping!</p>
    </div>
    <div id="max">
    <a href='login.php'>Log in</a>
    </div> -->
</body>
</html>