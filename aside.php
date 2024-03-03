<style>
  .left-sidebar {

    width: 170px;

  }
</style>

<aside class=" left-sidebar" data-sidebarbg="skin5">
  <!-- Sidebar scroll-->
  <div class="scroll-sidebar">
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav">
      <ul id="sidebarnav" class="pt-4">

        <?php

        if (isset($_SESSION['faculty'])) {

          echo '

<li class="sidebar-item">
<a class="sidebar-link waves-effect waves-dark sidebar-link" href="Faculty_panel.php" aria-expanded="false"><i
    class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a>
</li>

<li class="sidebar-item">
<a class="sidebar-link waves-effect waves-dark sidebar-link" href="Faculty_workload.php" aria-expanded="false"><i class="mdi mdi-border-inside"></i><span class="hide-menu">Workload</span></a>
</li>

<li class="sidebar-item">
<a class="sidebar-link waves-effect waves-dark sidebar-link" href="Faculty_sub.php" aria-expanded="false"><i class="mdi mdi-collage"></i><span class="hide-menu">Subjects</span></a>
</li>





<li class="sidebar-item">
<a href="Faculty_status.php" class="sidebar-link"><i class="mdi mdi-calendar-check"></i><span
    class="hide-menu"> Check Status </span></a>
</li>
';

        } else if (isset($_SESSION['admin'])) {
          echo '
  <li class="sidebar-item">
          <a class="sidebar-link waves-effect waves-dark sidebar-link" href="Admin_panel.php" aria-expanded="false"><i
              class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a>
        </li>

        <li class="sidebar-item">
          <a class="sidebar-link waves-effect waves-dark sidebar-link" href="teacher.php" aria-expanded="false"><i class="mdi mdi-relative-scale"></i><span class="hide-menu">Faculty</span></a>
        </li>

        <li class="sidebar-item">
          <a class="sidebar-link waves-effect waves-dark sidebar-link" href="subject.php" aria-expanded="false"><i class="mdi mdi-collage"></i><span class="hide-menu">Subjects</span></a>
        </li>

        <li class="sidebar-item">
          <a class="sidebar-link waves-effect waves-dark sidebar-link" href="room.php" aria-expanded="false"><i class="mdi mdi-border-inside"></i><span class="hide-menu">Rooms</span></a>
        </li>


        <li class="sidebar-item">
          <a class="sidebar-link waves-effect waves-dark sidebar-link" href="theory.php" aria-expanded="false"><i class="mdi mdi-pencil"></i
                  ><span class="hide-menu">Assign Subjects</span></a>
        </li>

        <li class="sidebar-item">
          <a href="admin.php" class="sidebar-link"><i class="mdi mdi-calendar-check"></i><span
              class="hide-menu"> Check Status </span></a>
        </li>

        <li class="sidebar-item">
          <a class="sidebar-link waves-effect waves-dark sidebar-link" href="Routine.php" aria-expanded="false"><i class="mdi mdi-blur-linear"></i
                  ><span class="hide-menu">Generate Routine</span></a>
        </li>
        
        <li class="sidebar-item">
        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="Payroll.php" aria-expanded="false"><i class="mdi mdi-receipt"></i
                ><span class="hide-menu">Payroll</span></a>
      </li>
      <li class="sidebar-item">
        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="Attendance.php" aria-expanded="false"><i class="mdi mdi-chart-areaspline"></i
                ><span class="hide-menu">Attendance</span></a>
      </li>
      
      <li class="sidebar-item">
      <a class="sidebar-link waves-effect waves-dark sidebar-link" href="Increament_status.php" aria-expanded="false"><i class="mdi mdi-relative-scale"></i
              ><span class="hide-menu">Increament</span></a>
    </li>
      
    '


          ;



        }
        ?>



      </ul>
    </nav>
    <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->
</aside>