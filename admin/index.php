<?php include "includes/admin_header.php" ?>

<div id="wrapper">

<?php include "includes/admin_navigation.php" ?>

<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Welcome to administration <?php  echo $_SESSION['user_nickname']; ?>
            </h1>   
        </div>
    </div>

    <div class="row">
        <!-- Hacer consultas, guardar número de filas y guardar en variables -->
        <?php

            //Conteo de posts
            $query_posts = "SELECT * FROM posts";
            $result_posts = mysqli_query($connection, $query_posts);
            $num_posts = mysqli_num_rows($result_posts);

            //conteo de comentarios:
            $query_comments = "SELECT * FROM comments";
            $result_comments = mysqli_query($connection, $query_comments);
            $num_comments = mysqli_num_rows($result_comments);
            
            //conteo de usuarios:
            $query_users = "SELECT * FROM users";
            $result_users = mysqli_query($connection, $query_users);
            $num_users = mysqli_num_rows($result_users);

            //conteo cateogrías:
            $query_categories = "SELECT * FROM categories";
            $result_categories = mysqli_query($connection, $query_categories);
            $num_categories = mysqli_num_rows($result_categories);

            /*
                Considerar la siguiente alternativa de código:

                function displayDash($input){

                    switch($input){
                        case 0:
                            $query = "SELECT*FROM posts";
                            return echo mysqli_num_rows(mysqli_query($connection, $query));
                            break;
                        case 1:
                            $query = "SELECT*FROM comments";
                            return echo mysqli_num_rows(mysqli_query($connection, $query));
                            break;
                        case 2:
                            $query = "SELECT*FROM users";
                            return echo mysqli_num_rows(mysqli_query($connection, $query));
                            break;
                        case 3:
                            $query = "SELECT*FROM categories";
                            return echo mysqli_num_rows(mysqli_query($connection, $query));
                            break;
                        default:
                            return null;
                            break;
                    }

                }


                Sólo se tendría que llamar a la función con el case correspondiente en el div:
                    <div class='huge'><?php displayDash(0) ?></div>
                    <div class='huge'><?php displayDash(1) ?></div>
                    <div class='huge'><?php displayDash(2) ?></div>
                    <div class='huge'><?php displayDash(3) ?></div>

                Posbiles cambios a este código: Prepare statementes SQL.

            */

        ?>  


        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-file-text fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                    <div class='huge'><?php echo $num_posts; ?></div>
                            <div>Posts</div>
                        </div>
                    </div>
                </div>
                <a href="posts.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>



        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-comments fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                        <div class='huge'><?php echo $num_comments; ?></div>
                        <div>Comments</div>
                        </div>
                    </div>
                </div>
                <a href="comments.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>



        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                        <div class='huge'><?php echo $num_users; ?></div>
                            <div> Users</div>
                        </div>
                    </div>
                </div>
                <a href="users.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>



        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-list fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class='huge'><?php echo $num_categories; ?></div>
                            <div>Categories</div>
                        </div>
                    </div>
                </div>
                <a href="categories.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>


    </div>

    <!-- Gráfica de barras -->

    <div class="row">

    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Count'],

            <?php

                $element_text = ['posts', 'comments', 'users', 'categories'];
                $element_count = [$num_posts, $num_comments, $num_users, $num_categories];

                //itero para generar columnas:

                for ($i=0; $i < count($element_text); $i++) { 

                    echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";

                }
            ?>

        ]);

        var options = {
          chart: {
            title: 'Digital [World] stats:',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    <div id="columnchart_material" style="width: auto; height: 500px;"></div>
    </div>

</div>

<?php include "includes/admin_footer.php" ?>