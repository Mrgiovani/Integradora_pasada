<?php include "includes/admin_header.php" ?>

<div id="wrapper">

<?php include "includes/admin_navigation.php" ?>

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">

                        <h1 class="page-header">Posts <small>administration</small></h1>
                        <!-- First column -->
                        <div class="col-12 col-lg-12">

                            <!-- Estableciendo condición para cargar tabla -->
                            <?php

                                if(isset($_GET['source'])){
                                    $source = $_GET['source'];
                                }else{
                                    $source = "";
                                }

                                switch ($source) {

                                    case 'add_post':
                                        include "includes/add_post.php";
                                        break;
                                        
                                        
                                    case 'edit_post':
                                        include "includes/edit_post.php";
                                        break;

                                    default:
                                        include "includes/view_all_posts.php";
                                        break;
                                }   
                                
                            ?>
                        </div>
                </div>
            </div>
</div>



<?php include "includes/admin_footer.php" ?>