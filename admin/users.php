<?php include "includes/admin_header.php" ?>

<div id="wrapper">
    
    <?php include "includes/admin_navigation.php" ?>

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">

                        <h1 class="page-header">Users <small>administration</small></h1>
                        <!-- First column -->
                        <div class="col-lg-12">

                            <!-- Estableciendo condición para cargar tabla -->
                            <?php

                                if(isset($_GET['source'])){
                                    $source = $_GET['source'];
                                }else{
                                    $source = "";
                                }

                                switch ($source) {

                                    case 'add_user':
                                    include "includes/add_user.php";
                                    break;

                                    case 'edit_user':
                                    include "includes/edit_user.php";
                                    break;
                                        
                                    //Mostrar la vista de todos los usuarios.
                                    default:
                                        include "includes/view_all_users.php";
                                        break;
                                }   
                                
                            ?>
                        </div>
                </div>
            </div>
</div>



<?php include "includes/admin_footer.php" ?>