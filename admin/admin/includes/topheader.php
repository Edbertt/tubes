<div class="topbar">

<!-- LOGO -->
<div class="topbar-left">
    <a href="../../test/user.php" class="logo"><span style="color:#B8E4F0;">Alam Indonesia</span><i class="mdi mdi-layers"></i></a>
    <!-- Image logo -->
    <!--<a href="index.html" class="logo">-->
        <!--<span>-->
            <!--<img src="assets/images/logo.png" alt="" height="30">-->
        <!--</span>-->
        <!--<i>-->
            <!--<img src="assets/images/logo_sm.png" alt="" height="28">-->
        <!--</i>-->
    <!--</a>-->
</div>

<!-- Button mobile view to collapse sidebar menu -->
<div class="navbar navbar-default" role="navigation">
    <div class="container">

        <!-- Navbar-left -->
        <ul class="nav navbar-nav navbar-left">
            <li>
                <button class="button-menu-mobile open-left waves-effect">
                    <i class="mdi mdi-menu"></i>
                </button>
            </li>
     
    
        </ul>

        <!-- Right(Notification) -->
        <ul class="nav navbar-nav navbar-right">
          

            <li class="dropdown user-box">
                <a href="" class="dropdown-toggle waves-effect user-link" data-toggle="dropdown" aria-expanded="true">
                    <img src="assets/images/users/avatar-1.jpg" alt="user-img" class="img-circle user-img">
                </a>

                <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
                    <li>
                        <h5>Hi, <?php echo $_SESSION['nama_depan']; ?> <?php echo" "?> <?php echo $_SESSION['nama_belakang'];?> </h5>
                    </li>
           
                    <li><a href="../../login/logout.php"><i class="ti-power-off m-r-5"></i> Logout</a></li>
                </ul>
            </li>

        </ul> <!-- end navbar-right -->

    </div><!-- end container -->
</div><!-- end navbar -->
</div>