<?php 
require 'partials/dbconnect.php';

?>
<style>
    @media (min-width: 768px) {
        #main-wrapper[data-layout=vertical] {}

        #main-wrapper[data-layout=vertical][data-sidebartype=full] .topbar .top-navbar .navbar-header {
            width: 170px
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

        #main-wrapper[data-layout=vertical][data-sidebartype=mini-sidebar] .sidebar-nav .has-arrow:after,
        #main-wrapper[data-layout=vertical][data-sidebartype=mini-sidebar] .sidebar-nav .hide-menu {
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
            <a class="navbar-brand" href="index.php">
                <!-- Logo icon -->
                <b class="logo-icon ps-2">
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <img src="./assets/images/logo-icon.png" alt="homepage" class="light-logo" width="25" />
                </b>
                <!--End Logo icon -->
                <!-- Logo text -->
                <span class="logo-text mt-3 ms-2">
                    <!-- dark Logo text -->
                    <h5>NITMAS</h5>
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
            <!-- Messages -->
            <!-- ============================================================== -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" id="2" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="font-24 mdi mdi-comment-processing"></i>
              </a>
              <ul class="
                    dropdown-menu dropdown-menu-end
                    mailbox
                    animated
                    bounceInDown
                  " aria-labelledby="2">
                <ul class="list-style-none">
                  <li>
                    <div class="">
                      <!-- Message -->
                      <a href="javascript:void(0)" class="link border-top">
                        <div class="d-flex no-block align-items-center p-10">
                          <span class="
                                btn btn-success btn-circle
                                d-flex
                                align-items-center
                                justify-content-center
                              "><i class="mdi mdi-calendar text-white fs-4"></i></span>
                          <div class="ms-2">
                            <h5 class="mb-0">Event today</h5>
                            <span class="mail-desc">Just a reminder that event</span>
                          </div>
                        </div>
                      </a>
                      <!-- Message -->
                      <a href="javascript:void(0)" class="link border-top">
                        <div class="d-flex no-block align-items-center p-10">
                          <span class="
                                btn btn-info btn-circle
                                d-flex
                                align-items-center
                                justify-content-center
                              "><i class="mdi mdi-settings fs-4"></i></span>
                          <div class="ms-2">
                            <h5 class="mb-0">Settings</h5>
                            <span class="mail-desc">You can customize this template</span>
                          </div>
                        </div>
                      </a>
                      <!-- Message -->
                      <a href="javascript:void(0)" class="link border-top">
                        <div class="d-flex no-block align-items-center p-10">
                          <span class="
                                btn btn-primary btn-circle
                                d-flex
                                align-items-center
                                justify-content-center
                              "><i class="mdi mdi-account fs-4"></i></span>
                          <div class="ms-2">
                            <h5 class="mb-0">Pavan kumar</h5>
                            <span class="mail-desc">Just see the my admin!</span>
                          </div>
                        </div>
                      </a>
                      <!-- Message -->
                      <a href="javascript:void(0)" class="link border-top">
                        <div class="d-flex no-block align-items-center p-10">
                          <span class="
                                btn btn-danger btn-circle
                                d-flex
                                align-items-center
                                justify-content-center
                              "><i class="mdi mdi-link fs-4"></i></span>
                          <div class="ms-2">
                            <h5 class="mb-0">Luanch Admin</h5>
                            <span class="mail-desc">Just see the my new admin!</span>
                          </div>
                        </div>
                      </a>
                    </div>
                  </li>
                </ul>
              </ul>
            </li>
            <!-- ============================================================== -->
            <!-- End Messages -->
            <!-- ============================================================== -->


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
                  " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="true">
                        <img src="./assets/images/users/user.png" alt="user" class="rounded-circle" width="31" />
                    </a>


                    <ul class="dropdown-menu dropdown-menu-end user-dd animated" aria-labelledby="navbarDropdown">
                        <?php
                        if (isset($_SESSION['faculty'])) {
                            echo ' <a class="dropdown-item" href="Faculty_profile.php"><i class="mdi mdi-account me-1 ms-1"></i> My
                            Profile</a> ';
                        } elseif (isset($_SESSION['admin'])) {
                            echo ' <a class="dropdown-item" href="Admin_profile.php"><i class="mdi mdi-account me-1 ms-1"></i> My
                            Profile</a> ';
                        }
                        ?>


                        <a class="dropdown-item" href="javascript:void(0)"><i class="mdi mdi-email me-1 ms-1"></i>
                            Inbox</a>

                        <a class="dropdown-item" href="partials/logout.php"><i class="fa fa-power-off me-1 ms-1"></i>
                            Logout</a>
                        <div class="dropdown-divider"></div>

                    </ul>
                </li>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
</header>