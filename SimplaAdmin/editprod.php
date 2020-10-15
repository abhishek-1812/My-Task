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
$errors = array();
require 'config.php';

$pid =$_REQUEST["id"];

$re = "SELECT * FROM products WHERE pid=$pid";
$res = $conn->query($re);
while ($ress = mysqli_fetch_array($res)) {
       $pid=$ress['pid'];
       $pname = $ress['name'];
       $price = $ress['price'];
       $img = $ress['image'];
       $desc = $ress['descrp'];
}

if (isset($_POST['submit'])) {

    $pname = isset($_POST['pname'])?$_POST['pname']:"";
    $price = isset($_POST['price'])?$_POST['price']:"";
    $img = isset($_POST['image'])?$_POST['image']:"";
    $desc = isset($_POST['desc'])?$_POST['desc']:"";


   
    $result = "UPDATE products SET `name`='$pname',
              `price`='$price',`image`='$img', `descrp`='$desc'  WHERE 
              `pid`='$pid' ";

    if ($conn->query($result) === true) {
        $errors = array('input'=>'form','msg'=>'Record updated Succesfully');
    } else {
        echo "Error updating record: " . $conn->error;
    }
    $conn->close();
}
?>
<?php require 'header.php';?>
<?php require 'sidebar.php';?>

    
    <div id="main-content"> <!-- Main Content Section with everything -->
    
    <noscript> <!-- Show a notification if the user has disabled javascript -->
        <div class="notification error png_bg">
            <div>
            Javascript is or sumit is not supported by your browser.
            Please <a href="http://browsehappy.com/" 
            title="Upgrade to a better browser">upgrade</a>
            your browser or 
            <a href="http://www.google.com/support/bin/answer.py?answer=23852" 
                title="Enable Javascript in your browser">
                enable</a> Javascript to navigate the interface properly.
            </div>
        </div>
        </noscript>
        
        <!-- Page Head -->
        <h2>Welcome Abhishek</h2>
        <p id="page-intro">What would you like to do?</p>
        
        
        <div class="clear"></div> <!-- End .clear -->
        
        <div class="content-box"><!-- Start Content Box -->
            
            <div class="content-box-header">
                
                <h3>update</h3>
                
                <ul class="content-box-tabs">
                    <li><a href="#tab1" class="default-tab">Update</a></li>
                </ul>
                
                <div class="clear"></div>
                
            </div> <!-- End .content-box-header -->
            
        
                <div class="tab-content" id="tab1">

                <div class="content-box-content">

                 <form action="" method="POST" >
                 <fieldset>
                        <div id="error">
                    <?php if (sizeof($errors)>0) :?>
                        <ul>
                        <?php foreach ($errors as $error):?>
                            <li><?php echo $errors['msg'];break?></li>
                        <?php endforeach;?>
                        </ul>
                    <?php endif;?>
                </div>
            <div class="txt1"> 
            <p>
                    <label for="pname">id:</label> <input type="text" 
                    name="pid" value="<?php echo $pid;?>">
                </p>
                <p>
                    <label for="pname">Name:</label> <input type="text" 
                    name="pname" value="<?php echo $pname;?>">
                </p>
            </div>
            <div class="txt1">
                <p>
                    <label for="price">Price:</label> <input type="text" 
                    name="price" value="<?php echo $price;?>">
                </p>
            </div>
            <div class="txt1">
                <p>
                    <label for="image">Image:</label> <input type="file" name="image" 
                    value="<?php echo $img;?>"></label>
                </p>
                <p>
                                <label>Category</label>
                                <select name="dropdown" class="small-input">
                                <?php 
                                require 'config.php';
                                $sql  = "SELECT * FROM category";
                                $result = $conn->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                <option value="<?php echo $row['catid']?>">
                                <?php echo $row['catname']?></option>
                                <?php
                                }
                                ?>
                                </select>
                            </p>
                            <p>
                                <label>Tags</label>
                                <?php 
                                require 'config.php';
                                $sql  = "SELECT * FROM tag";
                                $result = $conn->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                <input type="checkbox" 
                                value="<?php echo $row['tagname']?>" name="check[]" /> 
                                <?php echo $row['tagname']?>
                                <?php
                                }
                                ?>                                   
                            </p>
                            <p>
                                <label for="desc">Description:</label>
                                <textarea class="text-input textarea wysiwyg"
                                id="textarea" name="desc" cols="79"
                                rows="15" required><?php echo $desc;?></textarea>
                            
                            </p>
                            <p>
                                <input class="button" type="submit"
                                name="submit" value="Submit" />
                            </p>
                            
                        </fieldset>
                        
                        <div class="clear"></div><!-- End .clear -->
                        
                    </form>
                    
                </div> <!-- End #tab2 -->        
                
            </div> <!-- End .content-box-content -->
            
        </div> <!-- End .content-box -->
        

        
        <div class="clear"></div>
        
        <?php require 'footer.php';?>