<?php require 'partials/dbconnect.php';
session_start();

?>
<style>
    @media (min-width: 768px) {
    #main-wrapper[data-layout=vertical] {
    }

    #main-wrapper[data-layout=vertical][data-sidebartype=full] .topbar .top-navbar .navbar-header {
        width: 150px
    }

    #main-wrapper[data-layout=vertical][data-sidebar-position=fixed][data-sidebartype=full] .topbar .top-navbar .navbar-collapse {
        margin-left: 250px
    }

    #main-wrapper[data-layout=vertical][data-sidebar-position=fixed][data-sidebartype=mini-sidebar] .topbar .top-navbar .navbar-collapse {
        margin-left: 65px
    }

    #main-wrapper[data-layout=vertical][data-sidebartype=mini-sidebar] .topbar .top-navbar .navbar-header {
        width: 65px
    }

    #main-wrapper[data-layout=vertical][data-sidebartype=mini-sidebar] .topbar .top-navbar .navbar-header .logo-text {
        display: none
    }

    #main-wrapper[data-layout=vertical][data-sidebartype=mini-sidebar] .left-sidebar .upgrade-btn {
        display: none
    }

    #main-wrapper[data-layout=vertical][data-sidebar-position=fixed][data-sidebartype=mini-sidebar] .topbar .top-navbar .navbar-collapse {
        margin-left: 65px
    }

    #main-wrapper[data-layout=vertical][data-sidebartype=mini-sidebar] .page-wrapper {
        margin-left: 65px
    }

    #main-wrapper[data-layout=vertical][data-sidebartype=mini-sidebar] .sidebar-nav .has-arrow:after,#main-wrapper[data-layout=vertical][data-sidebartype=mini-sidebar] .sidebar-nav .hide-menu {
        display: none
    }

    #main-wrapper[data-layout=vertical][data-sidebartype=mini-sidebar] .sidebar-nav .nav-small-cap {
        justify-content: center
    }

    #main-wrapper[data-layout=vertical][data-sidebartype=mini-sidebar] .left-sidebar {
        width: 65px
    }





}
</style>
<header class="topbar" data-navbarbg="skin5">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="skin5">
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <a class="navbar-brand" href="index.html">
                <!-- Logo icon -->
                <b class="logo-icon ps-2">
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <img src="./assets/images/logo-icon.png" alt="homepage" class="light-logo" width="25" />
                </b>
                <!--End Logo icon -->
                <!-- Logo text -->
                <span class="logo-text ms-2">
                    <!-- dark Logo text -->
                   
                </span>
                <!-- Logo icon -->
                <!-- <b class="logo-icon"> -->
                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                <!-- Dark Logo icon -->
                <!-- <img src="./assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->

                <!-- </b> -->
                <!--End Logo icon -->
            </a>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Toggle which is visible on mobile only -->
            <!-- ============================================================== -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                    class="ti-menu ti-close"></i></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-start me-auto">
                <li class="nav-item d-none d-lg-block">
                    <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)"
                        data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a>
                </li>
                <!-- ============================================================== -->
                
                <!-- ============================================================== -->
                <!-- Search -->
                <!-- ============================================================== -->
                <li class="nav-item search-box">
                    <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i
                            class="mdi mdi-magnify fs-4"></i></a>
                    <form class="app-search position-absolute">
                        <input type="text" class="form-control" placeholder="Search &amp; enter" />
                        <a class="srh-btn"><i class="mdi mdi-window-close"></i></a>
                    </form>
                </li>
            </ul>
            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-end">
              
            
               
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="
                    nav-link
                    dropdown-toggle
                    text-muted
                    waves-effect waves-dark
                    pro-pic
                  " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="./assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31" />
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end user-dd animated" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="javascript:void(0)"><i class="mdi mdi-account me-1 ms-1"></i> My
                            Profile</a>
                        <a class="dropdown-item" href="javascript:void(0)"><i class="mdi mdi-wallet me-1 ms-1"></i> My
                            Balance</a>
                        <a class="dropdown-item" href="javascript:void(0)"><i class="mdi mdi-email me-1 ms-1"></i>
                            Inbox</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:void(0)"><i class="mdi mdi-settings me-1 ms-1"></i>
                            Account
                            Setting</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-power-off me-1 ms-1"></i>
                            Logout</a>
                        <div class="dropdown-divider"></div>
                        <div class="ps-4 p-10">
                            <a href="javascript:void(0)" class="btn btn-sm btn-success btn-rounded text-white">View
                                Profile</a>
                        </div>
                    </ul>
                </li>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
</header>