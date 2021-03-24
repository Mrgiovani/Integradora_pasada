<?php include "includes/admin_header.php" ?>

<div id="wrapper">

<?php include "includes/admin_navigation.php" ?>

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                        <h1 class="page-header">Categories</h1>
                        <!-- First column -->
                        <div class="col-md-6">
                        <!-- AGREGAR CATEGORÍAS-->
                        <?php insertCategories(); ?>
                            <!-- Formulario agregar categoría -->
                            <form method="post">
                                <div class="form-group">
                                    <label for="cat_title">Add category:</label>
                                    <input type="text" name="cat_title" id="cat_title" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="submit" id="" value="Add category" class="btn btn-primary">
                                </div>
                            </form>
                            <!-- Agregar formulario actualizar categoría -->
                            <?php

                                if(isset($_GET['edit'])){
                                    include "includes/update_categories.php";
                                }

                            ?>

                        </div>
                        <!-- Second column -->
                        <div class="col-md-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category title</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Función para listar todas las categorías en tabla -->
                                    <?php listCategories(); ?>
                                </tbody>
                            </table>

                        <!-- Función para eliminar -->
                        <?php deleteCategories(); ?>

                        <!-- Función para actualizar -->
                        <?php updateCategories(); ?>

                        </div>
                </div>
            </div>
</div>



<?php include "includes/admin_footer.php" ?>