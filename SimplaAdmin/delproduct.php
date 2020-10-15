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

require 'config.php';

$id = $_REQUEST['id'];

$sql = "DELETE FROM products WHERE `pid`='$id'";

$rec = mysqli_query($conn, $sql);

if ($rec) {
    echo "Record deleted successfully";
    header('Location: manageproduct.php'); 
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>