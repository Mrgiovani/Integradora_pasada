        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">[ ADMINISTRATION ]</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">

                <li><a href="../index.php"><i class="fas fa-home fa-fw"></i> Home</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['user_nickname'] ?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>


            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">

                    <li class="active">
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>

                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#first-drop"><i class="fas fa-users fa-fw"></i>

 Users <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="first-drop" class="collapse">
                            <li>
                                <a href="users.php?source=add_user"><i class="fas fa-fw fa-plus"></i> Add user</a>
                            </li>
                            <li>
                                <a href="users.php"><i class="fas fa-fw fa-eye"></i> View users</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#second-drop"><i class="far fa-sticky-note fa-fw"></i>

  Posts <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="second-drop" class="collapse">
                            <li>
                                <a href="posts.php?source=add_post"><i class="fas fa-fw fa-plus"></i> Add posts</a>
                            </li>
                            <li>
                                <a href="posts.php"><i class="fas fa-fw fa-eye"></i> View all posts</a>
                            </li>
                        </ul>
                    </li>

                    <li class="">
                        <a href="categories.php"><i class="fas fa-list fa-fw"></i> Categories</a>
                    </li>

                    <li>
                    <li class="">
                        <a href="comments.php"><i class="fas fa-comments fa-fw"></i> Comments</a>
                    </li>

                    <li>
                        <a href="profile.php"><i class="fas fa-user-circle fa-fw"></i> Profile</a>
                    </li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

        <!-- FA -->
        <script src="https://kit.fontawesome.com/357b0eedc9.js" crossorigin="anonymous"></script>