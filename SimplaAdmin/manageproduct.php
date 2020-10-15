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
$error = array();
if (isset($_POST['submit'])) {
    // echo '<script>alert("ok")</script>';
    $pname = $_POST['pname'];
    $price = $_POST['price'];
    $desc = $_POST['desc'];
    $catname = $_POST['dropdown'];

    $filename = $_FILES["img"]["name"];
        $tempname = $_FILES["img"]["tmp_name"];
        $folder = "image/" . $filename;
    if (move_uploaded_file($tempname, $folder)) {
            $error = array(
                'input' => 'form',
                'msg' => 'Image Added'
            );
    } else {
            $error = array(
                'input' => 'form',
                'msg' => 'Added FAiled'
            );
    }

    $checkbox = $_POST['check'];
        $new = "";
    
    foreach ($checkbox as $values) {
    
        $new .= $values . ",";
    }

    $qur = "INSERT INTO products(`catid`,`name`,`price`,`image`,`descrp`,`tag`) VALUES 
    ('$catname','$pname','$price','$filename','$desc','$new')";

    $run = mysqli_query($conn, $qur);

    if ($run) {
        $errors = array('input'=>'form','msg'=>'Record Inserted Succesfully');
    } else {
        $errors = array('input'=>'form','msg'=>$conn->error);
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
                
                <h3>Products</h3>
                
                <ul class="content-box-tabs">
                    <li><a href="#tab1" class="default-tab">Manage</a></li>
                     <!-- href must be unique and match the id of target div -->
                    <li><a href="#tab2">Add</a></li>
                </ul>
                
                <div class="clear"></div>
                
            </div> <!-- End .content-box-header -->
            
            <div class="content-box-content">
                
                <div class="tab-content default-tab" id="tab1"> 
                <!-- This is the target div. id must
                 match the href of this div's tab -->
                    
                    <div class="notification attention png_bg">
                        <!-- <a href="#" class="close"> -->
                        <!-- <div>
                            This is a Content Box. You can put whatever you want
                            in it.By the way, you can close this notification with 
                            the top-right cross.
                        </div> -->
                    </div>
                    
                    <table>
                        <tr>   
                            <th>ID</th>
                            <th>NAME</th>
                            <th>PRICE</th>
                            <th>IMAGE</th>
                            <th>DESCRIPTION</th>
                            <th>CATEGORY</th>
                            <th>TAGS</th>                            
                            <th>ACTION</th>
                        </tr>                           
                        <?php
                        require 'config.php';
                        $query = "SELECT * FROM products";

                        $run = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($run)) {
                            ?>
                        <tr>
                                    <td><?php echo $row['pid'] ?></td>
                                    <td><?php echo $row['name'] ?></td>
                                    <td><?php echo $row['price'] ?></td>
                 <td><?php echo '<img src="image/' . $row['image'] . '">' ?></td>
                                    <td><?php echo $row['descrp'] ?></td>
                                    <td><?php echo $row['catid'] ?></td>
                                    <td><?php echo $row['tag'] ?></td>
                                    <td><a href="editprod.php?id=<?php echo $row['pid'] ?>"
                                     title="Edit">
                                        <img src="resources/images/icons/pencil.png" 
                                        alt="Edit" /></a>
                <a href="delproduct.php?id=<?php echo $row['pid'] ?>"
                                    title='Delete'>
                                    <img src='resources/images/icons/cross.png'
                                    alt='Delete' /></a></td>
                                </tr>
                                <?php    
                        }
                        ?>
                    </table>
                    
                </div> <!-- End #tab1 -->
                
                <div class="tab-content" id="tab2">

                
                    <form action="" method="POST" 
                    enctype="multipart/form-data">
                        <fieldset>
                        <div id="error">
                    <?php if (sizeof($error)>0) :?>
                        <ul>
                        <?php foreach ($error as $errors):?>
                            <li><?php echo $error['msg'];break?></li>
                        <?php endforeach;?>
                        </ul>
                    <?php endif;?>
                </div>
                        <div class="txt1">  
                            <p>
                                <label for="pname">Product name: <br>
                                <input type="text" name="pname" required></label>
                            </p>
                            </div>
                            <div class="txt1">
                            <p>
                                <label for="price">Price: <br>
                                <input type="price" name="price" required></label>
                            </p>
                            </div>
                            <div class="txt1">
                            <p>
                                <label for="img">Image: <br>
                                <input type="file" name="img" required></label>
                            </p>
                            </div>
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
                                <label for="desc">Description:
                                <textarea class="text-input textarea wysiwyg"
                                id="textarea" name="desc" cols="79"
                                rows="15" required></textarea></label>
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
        
        
        <!-- Start Notifications -->
        <!--
        <div class="notification attention png_bg">
            <a href="#" class="close">
                <img src="resources/images/icons/cross_grey_small.png"
                 title="Close this notification" alt="close" /></a>
            <div>
                Attention notification. Lorem ipsum dolor sit amet,
                 consectetur adipiscing elit. Proin vulputate, 
                 sapien quis fermentum luctus, libero. 
            </div>
        </div>
        
        <div class="notification information png_bg">
            <a href="#" class="close">
                <img src="resources/images/icons/cross_grey_small.png"
                 title="Close this notification" alt="close" /></a>
            <div>
                Information notification. Lorem ipsum dolor sit amet,
                 consectetur adipiscing elit. Proin vulputate,
                  sapien quis fermentum luctus, libero.
            </div>
        </div>
        
        <div class="notification success png_bg">
            <a href="#" class="close">
                <img src="resources/images/icons/cross_grey_small.png"
                 title="Close this notification" alt="close" /></a>
            <div>
                Success notification. Lorem ipsum dolor sit amet,
                 consectetur adipiscing elit. Proin vulputate,
                  sapien quis fermentum luctus, libero.
            </div>
        </div>
        
        <div class="notification error png_bg">
            <a href="#" class="close">
                <img src="resources/images/icons/cross_grey_small.png"
                 title="Close this notification" alt="close" /></a>
            <div>
                Error notification. Lorem ipsum dolor sit amet,
                 consectetur adipiscing elit. Proin vulputate,
                  sapien quis fermentum luctus, libero.
            </div>
        </div> -->
        
        <!-- End Notifications -->
        
        <?php require 'footer.php';?>