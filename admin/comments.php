<?php include "includes/admin_header.php" ?>

<div id="wrapper">
    
    <?php include "includes/admin_navigation.php" ?>

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">

                        <h1 class="page-header">Comments <small>administration</small></h1>
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

                                    //case 'add_post':
                                    //    include "includes/add_post.php";
                                    //   break;
                                        
                                    
                                    //Mostrar la vista de todos los comentarios.
                                    default:
                                        include "includes/view_all_comments.php";
                                        break;
                                }   
                                
                            ?>
                        </div>
                </div>
            </div>
</div>



<?php include "includes/admin_footer.php" ?>