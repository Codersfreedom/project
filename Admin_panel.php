<?php
session_start();
if (!isset($_SESSION['logedin'])) {
  header("location: index.php");
}
require 'partials/dbconnect.php';
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="keywords"
    content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Matrix lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Matrix admin lite design, Matrix admin lite dashboard bootstrap 5 dashboard template" />
  <meta name="description"
    content="Matrix Admin Lite Free Version is powerful and clean admin dashboard template, inpired from Bootstrap Framework" />
  <meta name="robots" content="noindex,nofollow" />
  <title>Admin Panel</title>
  <!-- Favicon icon -->

  <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon.png" />
  <!-- Custom CSS -->
  <link href="./assets/libs/flot/css/float-chart.css" rel="stylesheet" />
  <!-- Custom CSS -->
  <link href="./dist/css/style.min.css" rel="stylesheet" />

  <link href="./assets/libs/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet" />
  <link href="./assets/extra-libs/calendar/calendar.css" rel="stylesheet" />
  <link href="./dist/css/style.min.css" rel="stylesheet" />
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  <style>
    .custom-tooltip {
      position: relative;
      /* Other styles you want for the element */
      font-weight: 600;
    }

    .custom-tooltip::after {
      content: attr(aria-label);
      position: absolute;
      background-color: #000;
      color: #fff;
      padding: 4px 8px;
      border-radius: 4px;
      /* Other styles for the tooltip */
      /* Adjust positioning as needed */
      top: 100%;
      left: 50%;
      transform: translateX(-50%);
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .custom-tooltip:hover::after {
      opacity: 1;
    }
    input::-webkit-inner-spin-button,
    input::-webkit-outer-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
    input[type="number"]{
      -moz-appearance: textfield
    }
  </style>
</head>

<body>
  <!-- ============================================================== -->
  <!-- Preloader - style you can find in spinners.css -->
  <!-- ============================================================== -->
  <div class="preloader">
    <div class="lds-ripple">
      <div class="lds-pos"></div>
      <div class="lds-pos"></div>
    </div>
  </div>
  <!-- ============================================================== -->
  <!-- Main wrapper - style you can find in pages.scss -->
  <!-- ============================================================== -->
  <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
    data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
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
            <span class="logo-text mt-2 ms-2">
              <!-- dark Logo text -->
              <h2>NITMAS</h2>
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
            <!-- create new -->
            <!-- ============================================================== -->
            <!-- <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <span class="d-none d-md-block">Create New <i class="fa fa-angle-down"></i></span>
                <span class="d-block d-md-none"><i class="fa fa-plus"></i></span>
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li>
                  <hr class="dropdown-divider" />
                </li>
                <li>
                  <a class="dropdown-item" href="#">Something else here</a>
                </li>
              </ul>
            </li> -->
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
                  " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="./assets/images/users/user.png" alt="user" class="rounded-circle" width="31" />
              </a>
              <ul class="dropdown-menu dropdown-menu-end user-dd animated" aria-labelledby="navbarDropdown">
                <?php if (isset($_SESSION['admin'])) {
                  echo '  <a class="dropdown-item" href="Admin_profile.php"><i class="mdi mdi-account me-1 ms-1"></i> My
                  Profile</a>';

                }
                ?>
                <a class="dropdown-item" href="javascript:void(0)"><i class="mdi mdi-email me-1 ms-1"></i> Inbox</a>
                <a class="dropdown-item" href="partials/logout.php"><i class="fa fa-power-off me-1 ms-1"></i> Logout</a>
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
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <aside class="left-sidebar" data-sidebarbg="skin5">
      <!-- Sidebar scroll-->
      <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
          <ul id="sidebarnav" class="pt-4">
            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="Admin_panel.php"
                aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="teacher.php" aria-expanded="false"><i
                  class="mdi mdi-relative-scale"></i><span class="hide-menu">Faculty</span></a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="subject.php" aria-expanded="false"><i
                  class="mdi mdi-collage"></i><span class="hide-menu">Subjects</span></a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="room.php" aria-expanded="false"><i
                  class="mdi mdi-border-inside"></i><span class="hide-menu">Rooms</span></a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="theory.php" aria-expanded="false"><i
                  class="mdi mdi-pencil"></i><span class="hide-menu">Assign Subjects</span></a>
            </li>

            <li class="sidebar-item">
              <a href="admin.php" class="sidebar-link"><i class="mdi mdi-calendar-check"></i><span class="hide-menu">
                  Check Status </span></a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="Routine.php" aria-expanded="false"><i
                  class="mdi mdi-blur-linear"></i><span class="hide-menu">Generate Routine</span></a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="Payroll.php" aria-expanded="false"><i
                  class="mdi mdi-receipt"></i><span class="hide-menu">Payroll</span></a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="Attendance.php"
                aria-expanded="false"><i class="mdi mdi-chart-areaspline"></i><span
                  class="hide-menu">Attendance</span></a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="increament_status.php"
                aria-expanded="false"><i class="mdi mdi-relative-scale"></i><span
                  class="hide-menu">Increament</span></a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="Refund.php" aria-expanded="false"><i
                  class="mdi mdi-receipt"></i><span class="hide-menu">Refund</span></a>
            </li>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">


      <div class="container-fluid">

        <div class="row">
          <!-- Column -->
          <div class="col-md-6 col-lg-2 col-xlg-3">
            <a href="teacher.php">
              <div class="card card-hover">
                <div class="box bg-cyan text-center">
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-view-dashboard"></i>
                  </h1>
                  <h6 class="text-white">Faculty</h6>
                </div>
              </div>
            </a>
          </div>


          <!-- Column -->
          <div class="col-md-6 col-lg-2 col-xlg-3">
            <a href="subject.php">
              <div class="card card-hover">
                <div class="box bg-warning text-center">
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-collage"></i>
                  </h1>
                  <h6 class="text-white">Subjects</h6>
                </div>
              </div>
            </a>
          </div>
          <!-- Column -->
          <div class="col-md-6 col-lg-2 col-xlg-3">
            <a href="room.php">
              <div class="card card-hover">
                <div class="box bg-danger text-center">
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-border-outside"></i>
                  </h1>
                  <h6 class="text-white">Rooms</h6>
                </div>
              </div>
            </a>
          </div>
          <!-- Column -->

          <!-- Column -->
          <div class="col-md-6 col-lg-2 col-xlg-3">
            <a href="theory.php">
              <div class="card card-hover">
                <div class="box bg-cyan text-center">
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-pencil"></i>
                  </h1>
                  <h6 class="text-white">Assign Subjects</h6>
                </div>
              </div>
            </a>
          </div>
          <!-- Column -->
          <div class="col-md-6 col-lg-2 col-xlg-3">
            <a href="admin.php">
              <div class="card card-hover">
                <div class="box bg-success text-center">
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-calendar-check"></i>
                  </h1>
                  <h6 class="text-white">Check Status</h6>
                </div>
              </div>
            </a>
          </div>
          <!-- Column -->

          <!-- Column -->
          <div class="col-md-6 col-lg-2 col-xlg-3">
            <a href="Routine.php">
              <div class="card card-hover">
                <div class="box bg-danger text-center">
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-blur-linear"></i>
                  </h1>
                  <h6 class="text-white">Generate Routine</h6>
                </div>
              </div>
            </a>
          </div>

          <div class="col-md-6 col-lg-2 col-xlg-3">
            <a href="Payroll.php">
              <div class="card card-hover">
                <div class="box bg-danger text-center">
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-receipt"></i>
                  </h1>
                  <h6 class="text-white">Payroll</h6>
                </div>
              </div>
            </a>
          </div>

          <div class="col-md-6 col-lg-2 col-xlg-3">
            <a href="Attendance.php">
              <div class="card card-hover">
                <div class="box bg-success text-center">
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-chart-areaspline"></i>
                  </h1>
                  <h6 class="text-white">Attendance</h6>
                </div>
              </div>
            </a>
          </div>

          <div class="col-md-6 col-lg-2 col-xlg-3">
            <a href="Increment_status.php">
              <div class="card card-hover">
                <div class="box bg-info text-center">
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-relative-scale"></i>
                  </h1>
                  <h6 class="text-white">Increment </h6>
                </div>
              </div>
            </a>
          </div>

          <div class="col-md-6 col-lg-2 col-xlg-3">
            <a href="Refund.php">
              <div class="card card-hover">
                <div class="box bg-cyan text-center">
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-receipt"></i>
                  </h1>
                  <h6 class="text-white">Refund </h6>
                </div>
              </div>
            </a>
          </div>

          <!-- Column -->
        </div>
        <!-- card -->
        <div class="card">
          <div class="card-body">

            <h4 class="card-title mb-0">Workload</h4>
            <?php
            require 'partials/dbconnect.php';

            $sql = "select * from  faculty join  total_wl on faculty.fac_id=total_wl.fac_id";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {


              echo '
           <div class="custom-tooltip" aria-label="Current Workload ' . (26 - $row['totalWL']) . ' hours">
            <div class="mt-3 ">
              <div class="d-flex no-block align-items-center">
                <span>' . $row['name'] . '</span>
                <div class="ms-auto">
                 <span> Remaining </span>  <span> ' . $row['totalWL'] . '</span>
                </div>
              </div>
              <div class="progress " style="height: 10px;">
                <div  class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: ' . ((26 - $row['totalWL']) / 26) * 100 . '%"
                  aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div></div>';
            }
            ?>


          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="card">

            <?php
               
              $sql = "select *from allowance";
              $result = mysqli_query($conn,$sql);
              $row = mysqli_fetch_assoc($result);
            ?>

              <form class="form-horizontal" action="allowance.php" method="post">
                <div class="card-body">
                  <h4 class="card-title">Allowance info</h4>
                  <div class="form-group row" title="It will be in 0% - 100%">
                    <label for="da" class="col-sm-3 text-start control-label col-form-label">Dearness Allowance</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control" min="0" max="100" id="da" name="da" value=" <?php echo $row['Dearness_allowance']  ?> " placeholder="0% - 100%">
                    </div>
                  </div>
                  <div class="form-group row" >
                    <label for="pt" class="col-sm-3 text-start control-label col-form-label">Professional Tax</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control" min="0" value="<?php echo $row['Professional_tax']  ?>"  id="pt" name="pt"
                        placeholder="Amount">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="pf" class="col-sm-3 text-start  control-label col-form-label">Provident Fund</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control" min="0" max="100" id="pf" value="<?php echo $row['Provident_fund']  ?>" name="pf" placeholder="0% - 100%">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="Hrax" class="col-sm-3 text-start  control-label col-form-label">HRA for metropliton</label> 
                    <div class="col-sm-9">
                      <input type="number" class="form-control" title="House Rent allowance for metropliton" value="<?php echo $row['House_rent_allowance_X']  ?>" min="0" max="100" id="hrax" name="hrax" placeholder="0% - 100%">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="Hray" class="col-sm-3 text-start  control-label col-form-label">HRA for Urban</label> 
                    <div class="col-sm-9">
                      <input type="number" class="form-control" title="House Rent allowance for Urban" min="0" value="<?php echo $row['House_rent_allowance_Y'] ?>" max="100" id="hray" name="hray" placeholder="0% - 100%">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="Hraz" class="col-sm-3 text-start  control-label col-form-label">HRA for Rural</label> 
                    <div class="col-sm-9">
                      <input type="number" class="form-control" title="House Rent allowance for Rural" value="<?php echo $row['House_rent_allowance_Z'] ?>"  min="0" max="100" id="hraz" name="hraz" placeholder="0% - 100%">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="ma" class="col-sm-3 text-start control-label col-form-label">Medical Allowance</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control" min="0" value="<?php echo $row['Medical_allowance'] ?>"   id="ma" name="ma" placeholder="Amount">
                    </div>
                  </div>

                </div>
                <div class="border-top">
                  <div class="card-body">
                    <button type="submit" class="btn btn-primary">
                      Submit
                    </button>
                  </div>
                </div>
              </form>
            </div>

          </div>

          <div class="col-md-6">

          <div class="card">

          <?php 

            require 'partials/dbconnect.php';
            $sql = "select * from allowance";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_assoc($result);

            ?>

                <div class="card-body">
                  <h4 class="card-title mb-0">Progress Box</h4>
                  <div class="mt-3">
                    <div class="d-flex no-block align-items-center">
                      <span> Dearness Allowance </span>
                      <div class="ms-auto">
                        <span><?php echo $row['Dearness_allowance']; ?></span>
                      </div>
                    </div>
                    <div class="progress">
                      <div class="progress-bar progress-bar-striped" role="progressbar" <?php echo "style = width:" .($row['Dearness_allowance']) . '%' ?>    aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div>
                    <div class="d-flex no-block align-items-center mt-4">
                      <span>Professional Tax</span>
                      <div class="ms-auto">
                        <span><?php echo $row['Professional_tax'] ?> </span>
                      </div>
                    </div>
                    <div class="progress">
                      <div class="progress-bar progress-bar-striped bg-success" role="progressbar" <?php echo "style = width:" .($row['Professional_tax']) . '%' ?> aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div>
                    <div class="d-flex no-block align-items-center mt-4">
                      <span>Provident Fund</span>
                      <div class="ms-auto">
                        <span><?php echo $row['Provident_fund'] ?></span>
                      </div>
                    </div>
                    <div class="progress">
                      <div class="progress-bar progress-bar-striped bg-info" role="progressbar"  <?php echo "style = width:" .($row['Provident_fund']) . '%' ?> aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div>
                    <div class="d-flex no-block align-items-center mt-4">
                      <span>House Rent Allowance</span>
                      <div class="ms-auto">
                        <span><?php echo $row['House_rent_allowance_X'] ?></span>
                      </div>
                    </div>
                    <div class="progress">
                      <div class="progress-bar progress-bar-striped bg-danger" role="progressbar"  <?php echo "style = width:" .($row['House_rent_allowance_X']) . '%' ?> aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>

                  <div>
                    <div class="d-flex no-block align-items-center mt-4">
                      <span>Medical Allowance</span>
                      <div class="ms-auto">
                        <span><?php echo $row['Medical_allowance'] ?></span>
                      </div>
                    </div>
                    <div class="progress">
                      <div class="progress-bar progress-bar-striped bg-danger" role="progressbar"  <?php echo "style = width:" .($row['Medical_allowance']) . '%' ?> aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>

                </div>
              </div>

          </div>

        </div>


      </div>
      <!-- column -->
    </div>
  </div>
  </div>




  <!-- ============================================================== -->
  <!-- End Container fluid  -->
  <!-- ============================================================== -->
  <!-- ============================================================== -->
  <!-- footer -->
  <!-- ============================================================== -->
  <footer class="footer text-center">
    All Rights Reserved by admin.

  </footer>
  <!-- ============================================================== -->
  <!-- End footer -->
  <!-- ============================================================== -->
  </div>
  <!-- ============================================================== -->
  <!-- End Page wrapper  -->
  <!-- ============================================================== -->
  </div>
  <!-- ============================================================== -->
  <!-- End Wrapper -->
  <!-- ============================================================== -->
  <!-- ============================================================== -->
  <!-- All Jquery -->
  <!-- ============================================================== -->
  <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap tether Core JavaScript -->
  <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
  <script src="./assets/extra-libs/sparkline/sparkline.js"></script>


  <!--Wave Effects -->
  <script src="./dist/js/waves.js"></script>
  <!--Menu sidebar -->
  <script src="./dist/js/sidebarmenu.js"></script>
  <!--Custom JavaScript -->
  <script src="./dist/js/custom.min.js"></script>
  <!--This page JavaScript -->
  <!-- <script src="./dist/js/pages/dashboards/dashboard1.js"></script> -->
  <!-- this page js -->
  <script src="./assets/libs/moment/min/moment.min.js"></script>
  <script src="./assets/libs/fullcalendar/dist/fullcalendar.min.js"></script>
  <script src="./dist/js/pages/calendar/cal-init.js"></script>

</body>

</html>