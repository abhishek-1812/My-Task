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
    $category = $_POST['category'];

    $qur="INSERT INTO category(`catname`)VALUE('$category')";
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
            Javascript is disabled or is not supported by your browser.
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
                
                <h3>Content box</h3>
                
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
                        <a href="#" class="close">
                            <img src="resources/images/icons/cross_grey_small.png"
                         title="Close this notification" alt="close" /></a>
                        <div>
                            This is a Content Box. You can put whatever you want
                            in it.By the way, you can close this notification with 
                            the top-right cross.
                        </div>
                    </div>
                    
                    <table>
                        
                        <thead>
                            <tr>
                                <th>Category ID</th>
                                <th>Category Name</th>
                                <th>Action</th>
                            </tr>
                            
                        </thead>
                        
                        <tfoot>
                            <tr>
                                <td colspan="6">
                                    <div class="bulk-actions align-left">
                                        <select name="dropdown">
                                            <option value="option1">
                                                Choose an action...</option>
                                            <option value="option2">Edit</option>
                                            <option value="option3">Delete</option>
                                        </select>
                                        <a class="button" href="#">
                                            Apply to selected</a>
                                    </div>
                                    
                                    <div class="pagination">
                                        <a href="#" title="First Page">&laquo;
                                             First</a><a href="#" 
                                             title="Previous Page">
                                             &laquo; Previous</a>
                                        <a href="#" class="number" title="1">1</a>
                                        <a href="#" class="number" title="2">2</a>
                                        <a href="#" class="number current" 
                                        title="3">3</a>
                                        <a href="#" class="number" title="4">4</a>
                                        <a href="#" title="Next Page">Next &raquo;

                                        </a><a href="#" title="Last Page">
                                            Last &raquo;</a>
                                    </div> <!-- End .pagination -->
                                    <div class="clear"></div>
                                </td>
                            </tr>
                        </tfoot>
                        
                        <tbody>
                           
                            <tr>
                            <?php
                            require 'config.php';
                            $query = "SELECT * FROM category";

                            $run = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($run)) {
                            ?>
                                <td><?php echo $row['catid'] ?></td>
                                <td><?php echo $row['catname'] ?></td>
                                <td>
                                <a href="editpro.php?id=
            <?php echo $row['catid'] ?>" title="Edit"><img src="resources/images/icons/pencil.png" alt="Edit" /></a>
                                <a href="del.php?id=<?php $row['catid'] ?>"
                                title='Delete'>
                                <img src='resources/images/icons/cross.png'
                                alt='Delete' /></a>
                                </td>
                                </tr> 
                                <?php
                            }
?>
         
                        </tbody>
                        
                    </table> 
                    
                </div> <!-- End #tab1 -->
                
                <div class="tab-content" id="tab2">
                
                    <form action="#" method="post">
                        
                        <fieldset> <!-- Set class to "column-left" 
                        or "column-right" on fieldsets to divide the
                         form into columns -->
                         <p>
                                <label for="category">Category: <br>
                                <input type="text" name="category" required></label>
                            </p>
                            
                            <p>
                                <input class="button" name ="submit"type="submit" 
                                value="Submit" />
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