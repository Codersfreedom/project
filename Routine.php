<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

  <title>Routine</title>
  <?php

  include 'partials/_header.php';
  if (!isset($_SESSION['logedin'])) {
    header("location: index.php");
  }
  include 'partials/_nav.php';
  ?>
</head>

<body>

  <style>
    tbody tr:nth-child(odd) {
      background-color: #fff;
    }

    tbody tr:nth-child(even) {
      background-color: #eee;
    }
  </style>
  <div class="container d-flex justify-content-center my-4 p-4">
    <form class="form-inline" action="Routine.php" method="post">
      <div class="form-group mb-2">
        <label for="type" class="mx-3">Department</label>
        <select class="form-control" id="course" name="course">
          <option>CSE</option>
        </select>
      </div>
      <div class="form-group mx-sm-3 mb-2">
        <label for="type" class="mx-3">Year</label>
        <select class="form-control" id="year" name="year" value="">
          <option>2</option>
          <option>3</option>
          <option>4</option>
        </select>
      </div>
      <div class="form-group mx-sm-3 mb-2">
        <label for="type" class="mx-3">Semester</label>
        <select class="form-control" id="sem" name="sem" value="">
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
          <option>6</option>
          <option>7</option>
          <option>8</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary mb-2">Confirm</button>
    </form>

  </div>


  <?php


function updateWorkload($workLoad,$year,$conn){

  foreach($workLoad as $fac=>$wl){
    $updateWlSql="UPDATE Workload SET workLoad=$wl WHERE year=$year AND facId='$fac'";
    $upwlRes=mysqli_query($conn,$updateWlSql);
  }
}





  function updateStatus($facRoutine,$year, $conn)
  {

    // foreach ($days as $day) {
    //   for ($i = 1; $i < 8; $i++) {
    //     $data = $facRoutine[$day]['slot' . $i];
    //     $updateSql = "UPDATE status SET slot$i=0 WHERE year=$year AND day='$day' AND fac_id='$data'";
    //     $updateRes = mysqli_query($conn, $updateSql);
    //   }
    // }
    foreach($facRoutine as $days => $slots){
      foreach($slots as $slot=>$fa){
        $updateSql="UPDATE status SET $slot=0 WHERE day='$days' AND fac_id='$fa' AND year=$year";
        $updateRes = mysqli_query($conn, $updateSql);
        echo $days." ".$slot."=>".$fa."<br/>";
      }
    }
  }

  function checkLab($allotedLab, $lab)
  {
    $labCount = 0;
    foreach ($allotedLab as $al) {
      if ($al == $lab) {
        $labCount++;
      }
    }
    if ($labCount == 0) {
      return true;
    } else {
      return false;
    }
  }

  function checkSub($allotedSubjects, $sub, $allotPerSub)
  {
    $subCount = 0;
    foreach ($allotedSubjects as $as) {
      if ($as == $sub) {
        $subCount++;
      }
    }
    if ($subCount < $allotPerSub) {
      return true;
    } else {
      return false;
    }
  }

  function checkSubAllot($sub, &$allotedSubjects, &$routine, $FacSub, $allotPerSub, $day, $sem, $i, $year, $faculty_id, $conn)
  {
    $sCount = 0;
    $subCount = count($sub);
    static $poppedFac = array();

    for ($j = 1; $j < $subCount; $j++) {
      foreach ($allotedSubjects as $allotedSub) {
        if ($allotedSub == $sub[$j]) {
          $sCount++;
        }
      }
      if ($sCount < $allotPerSub) {
        $routine[$day]['slot' . $i] = $sub[$j];
        if ($day != 'Monday') {
          array_push($allotedSubjects, $sub[$j]);
        }
        return;
      } else {
        array_push($poppedFac, $faculty_id);
        $pf = join("','", $poppedFac);
        $newSql = "SELECT `fac_id` FROM `status` WHERE `slot$i` = 1 and `day` = '$day' and `year` = $year and fac_id NOT IN ('$pf')";
        $newRes = mysqli_query($conn, $newSql);
        $newFac = mysqli_fetch_assoc($newRes);
        // echo $newFac['fac_id'];
        $num = mysqli_num_rows($newRes);
        // echo "Number of rows: ".$num;
        if ($num > 0) {
          $ct = 0;
          foreach ($allotedSubjects as $allotedSub) {
            if ($allotedSub == $FacSub[$newFac['fac_id']][0]) {
              $ct++;
            }
          }

          if ($ct < $allotPerSub) {
            echo $allotPerSub;
            $routine[$day]['slot' . $i] = $FacSub[$newFac['fac_id']][0];
            if ($day != 'Monday') {
              array_push($allotedSubjects, $FacSub[$newFac['fac_id']][0]);
            }
            return;
          } else {
            echo "run check sub <br>";
            // checkSubAllot($sub, $allotedSubjects, $routine, $FacSub, $allotPerSub, $day, $sem, $i, $year, $faculty_id, $conn);
          }
        } else {
          echo "Returning";
          return;
        }
      }
      print_r($poppedFac);
    }
  }


  function routine($year, $sem)
  {

    require 'partials/dbconnect.php';



    $trSql = "Truncate TABLE " . $year . "year_routine";
    $result1 = mysqli_query($conn, $trSql);
    $days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];

    //? Subject Allotment calculate
    // $theorySql = "SELECT assign FROM sub_allot WHERE sem=$sem and assign NOT LIKE '%Lab%'";
    // $labSql = "SELECT assign FROM sub_allot where sem=$sem AND assign LIKE '%Lab%'";
    // $totalTheory = mysqli_num_rows(mysqli_query($conn, $theorySql));
    // $totalLab = mysqli_num_rows(mysqli_query($conn, $labSql));
    // $allotLabDay = $totalLab * 4;
    // $allotTheoryDay = 35 - $allotLabDay;
    // $allotPerSub = round(($allotTheoryDay) / ($totalTheory));



    //? Array for tracking alloted Subjects...
    $allotedSubjects = array();
    //? Array for Routine....
    $routine = array(
      'Monday' => array('slot1' => '', 'slot2' => '', 'slot3' => '', 'slot4' => '', 'slot5' => '', 'slot6' => '', 'slot7' => ''),
      'Tuesday' => array('slot1' => '', 'slot2' => '', 'slot3' => '', 'slot4' => '', 'slot5' => '', 'slot6' => '', 'slot7' => ''),
      'Wednesday' => array('slot1' => '', 'slot2' => '', 'slot3' => '', 'slot4' => '', 'slot5' => '', 'slot6' => '', 'slot7' => ''),
      'Thursday' => array('slot1' => '', 'slot2' => '', 'slot3' => '', 'slot4' => '', 'slot5' => '', 'slot6' => '', 'slot7' => ''),
      'Friday' => array('slot1' => '', 'slot2' => '', 'slot3' => '', 'slot4' => '', 'slot5' => '', 'slot6' => '', 'slot7' => '')
    );

    //? Array for storing FacultyId in routine....
    $facRoutine = array(
      'Monday' => array('slot1' => '', 'slot2' => '', 'slot3' => '', 'slot4' => '', 'slot5' => '', 'slot6' => '', 'slot7' => ''),
      'Tuesday' => array('slot1' => '', 'slot2' => '', 'slot3' => '', 'slot4' => '', 'slot5' => '', 'slot6' => '', 'slot7' => ''),
      'Wednesday' => array('slot1' => '', 'slot2' => '', 'slot3' => '', 'slot4' => '', 'slot5' => '', 'slot6' => '', 'slot7' => ''),
      'Thursday' => array('slot1' => '', 'slot2' => '', 'slot3' => '', 'slot4' => '', 'slot5' => '', 'slot6' => '', 'slot7' => ''),
      'Friday' => array('slot1' => '', 'slot2' => '', 'slot3' => '', 'slot4' => '', 'slot5' => '', 'slot6' => '', 'slot7' => '')
    );

    //? Array for faculty's Subjects
    $FacSub = array();
    //? Array for semester Faculty..
    $semFac = array();
    $semFacSql = "SELECT DISTINCT(fac_id)FROM sub_allot WHERE sem=$sem ";
    $semRes = mysqli_query($conn, $semFacSql);

    while ($semFacRow = mysqli_fetch_assoc($semRes)) {
      array_push($semFac, $semFacRow['fac_id']);
    }

    foreach ($semFac as $sf) {
      $facSubSql = "SELECT assign FROM sub_allot WHERE sem=$sem AND fac_id='$sf' AND assign NOT LIKE '%Lab%'";
      $facRes = mysqli_query($conn, $facSubSql);
      $key = 0;
      while ($facSubRow = mysqli_fetch_assoc($facRes)) {
        $FacSub[$sf][$key] = $facSubRow['assign'];
        $key++;
      }
    }

    //? array for status of faculty from database
    $status = array();

    foreach ($semFac as $sf) {
      foreach ($days as $day) {
        for ($i = 1; $i <= 7; $i++) {
          $statusSql = "SELECT slot$i FROM status WHERE fac_id='$sf' AND day='$day' and year=$year";
          $statusValue = mysqli_fetch_assoc(mysqli_query($conn, $statusSql));
          $status[$sf][$day]['slot' . $i] = $statusValue['slot' . $i];
        }
      }
    }


    //? array for tracking alloted lab..
    $allotedLab = array();

    //? array for faculty's Labs...
    $labFac = array();
    foreach ($semFac as $sf) {
      $labFacSql = "SELECT assign FROM sub_allot WHERE sem=$sem AND fac_id='$sf' AND assign LIKE '%Lab%'";
      $labFacRes = mysqli_query($conn, $labFacSql);
      $lkey = 0;
      while ($labFacRow = mysqli_fetch_assoc($labFacRes)) {
        $labFac[$sf][$lkey] = $labFacRow['assign'];
        $lkey++;
      }
    }


    //?array for Faculty WorkLoad...
    $workLoad=array();
    foreach($semFac as $sf){
      $wlSql="SELECT workLoad FROM workload WHERE facId='$sf' AND year=$year";
      $wlRow=mysqli_fetch_assoc(mysqli_query($conn, $wlSql));
      $workLoad[$sf]=$wlRow['workLoad'];

    }

    //? calculate hours per subject
    $hpw=array();
    $hpwSql="SELECT assign,h_per_w FROM subject,sub_allot WHERE subject.subject_code=sub_allot.sub_code AND sem=$sem";
    $hpwRes=mysqli_query($conn, $hpwSql);
    while($hpwRow=mysqli_fetch_assoc($hpwRes)){
      $hpw[$hpwRow['assign']]=$hpwRow['h_per_w'];
    }

    echo "<pre>";
    print_r($hpw);
    echo "</pre>";
    


    //! -----------------------------------------
    foreach ($days as $day) {
      $daySql = "Insert into " . $year . "year_routine (day) values ('$day')";
      $result1 = mysqli_query($conn, $daySql);


      for ($i = 1; $i < 8; $i++) {
        $sub = array();
        $lab = array();
        $sql = "SELECT `fac_id` FROM `status` WHERE `slot$i` = 1 and `day` = '$day' and `year` = $year";

        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $faculty_id = $row['fac_id'];
        $subjectQuery = "SELECT sub_allot.assign from `subject` INNER join  sub_allot on subject.subject_code = sub_allot.sub_code where sub_allot.fac_id='$faculty_id' and `sem` = $sem and subject.subject_type = 'Theory'";
        $subjectResult = mysqli_query($conn, $subjectQuery);
        while ($subjectRow = mysqli_fetch_assoc($subjectResult)) {
          array_push($sub, $subjectRow['assign']);
        }
        $lab_query = "SELECT assign from `subject` INNER join  sub_allot on subject.subject_code = sub_allot.sub_code where sub_allot.fac_id='$faculty_id' and `sem` = $sem and subject.subject_type = 'Lab'";
        $lab_result = mysqli_query($conn, $lab_query);
        // $subject_row = mysqli_fetch_assoc($subject_result); 
        while ($lab_row = mysqli_fetch_assoc($lab_result)) {
          array_push($lab, $lab_row['assign']);
        }
        //? checking already lab assigned...

        $labFlag = true;
        $labCount = count($lab);
        for ($r = 0; $r < $labCount; $r++) {
          if (checkLab($allotedLab, $lab[$r])) {
            break;
          } else {
            if ($r == $labCount - 1) {
              foreach ($semFac as $sf) {
                if ($faculty_id != $sf) {
                  if (isset($labFac[$sf])) {
                    $lCount = count($labFac[$sf]);
                    
                    for ($q = 0; $q < $lCount; $q++) {
                      if (checkLab($allotedLab, $labFac[$sf][$q])){
                        
                        break 2;
                      }
                      else{
                        if($q==$lCount-1){
                          $labFlag = false;
                        }
                      }
                    }
                  }
                }
              }
              
            }
          }
        }

        //? Condition for Lab allocation.

        if ($i == 1 && $labFlag && $status[$faculty_id][$day]['slot1'] == 1 && $status[$faculty_id][$day]['slot2'] == 1 && $status[$faculty_id][$day]['slot3'] == 1 && $status[$faculty_id][$day]['slot4'] == 1) {
          $labCount = count($lab);
          echo "Tul6e ".$day."<br>";
          if ($labCount == 1) {
            //? Only one lab....
            foreach($semFac as $sf){
              if($faculty_id==$sf){
                echo $sf;
                if (checkLab($allotedLab, $lab[0])&& $workLoad[$faculty_id]>0) {
                  $routine[$day]['slot1'] = $routine[$day]['slot2'] = $routine[$day]['slot3'] = $routine[$day]['slot4'] = $lab[0];
                  $facRoutine[$day]['slot1'] = $facRoutine[$day]['slot2'] = $facRoutine[$day]['slot3'] = $facRoutine[$day]['slot4'] = $faculty_id;
                  $workLoad[$faculty_id]=$workLoad[$faculty_id]-4;
                  array_push($allotedLab, $lab[0]);
                  break;
                }
                //! to implement if the faculty is available and lab already assigned.
              }
              elseif(isset($labFac[$sf]) && $status[$sf][$day]['slot1'] == 1 && $status[$sf][$day]['slot2'] == 1 && $status[$sf][$day]['slot3'] == 1 && $status[$sf][$day]['slot4'] == 1){
                $lbcount=count($labFac[$sf]);
                for($t=0;$t<$lbcount;$t++){
                  if($workLoad[$sf]>0 && checkLab($allotedLab, $labFac[$sf][$t])){$routine[$day]['slot1'] = $routine[$day]['slot2'] = $routine[$day]['slot3'] = $routine[$day]['slot4'] = $labFac[$sf][$t];
                    $facRoutine[$day]['slot1'] = $facRoutine[$day]['slot2'] = $facRoutine[$day]['slot3'] = $facRoutine[$day]['slot4'] = $sf;
                    $workLoad[$sf]=$workLoad[$sf]-4;
                    array_push($allotedLab, $labFac[$sf][$t]);
                    break 2;}
                }
              }
              //! to be implement if faculty available but first slot not available......
            }
          } elseif ($labCount > 1) {
            //? More than One Lab....
            foreach($semFac as $sf){
              if($faculty_id==$sf){
                for ($j = 0; $j < $labCount; $j++) {
                  if ($workLoad[$faculty_id]>0 && checkLab($allotedLab, $lab[$j])) {
                    $routine[$day]['slot1'] = $routine[$day]['slot2'] = $routine[$day]['slot3'] = $routine[$day]['slot4'] = $lab[$j];
                    $facRoutine[$day]['slot1'] = $facRoutine[$day]['slot2'] = $facRoutine[$day]['slot3'] = $facRoutine[$day]['slot4'] = $faculty_id;
                    $workLoad[$faculty_id]=$workLoad[$faculty_id]-4;
                    array_push($allotedLab, $lab[$j]);
                    break 2;
                  }
                }
              }
              elseif(isset($labFac[$sf]) && $status[$sf][$day]['slot1'] == 1 && $status[$sf][$day]['slot2'] == 1 && $status[$sf][$day]['slot3'] == 1 && $status[$sf][$day]['slot4'] == 1){
                $lbcount=count($labFac[$sf]);
                for($t=0;$t<$lbcount;$t++){
                  if($workLoad[$sf]>0 && checkLab($allotedLab, $labFac[$sf][$t])){$routine[$day]['slot1'] = $routine[$day]['slot2'] = $routine[$day]['slot3'] = $routine[$day]['slot4'] = $labFac[$sf][$t];
                    $facRoutine[$day]['slot1'] = $facRoutine[$day]['slot2'] = $facRoutine[$day]['slot3'] = $facRoutine[$day]['slot4'] = $sf;
                    $workLoad[$sf]=$workLoad[$sf]-4;
                    array_push($allotedLab, $labFac[$sf][$t]);
                    break 2;}
                }
              }
            }
            
          } else {
            //? Don't have lab...
            $sCount = count($sub);
            for ($k = 0; $k < $sCount; $k++) {
              if ($workLoad[$faculty_id]>0 && checkSub($allotedSubjects, $sub[$k], $hpw[$sub[$k]])) {
                $routine[$day]['slot' . $i] = $sub[$k];
                $facRoutine[$day]['slot' . $i] = $faculty_id;
                $workLoad[$faculty_id]=$workLoad[$faculty_id]-1;
                array_push($allotedSubjects, $sub[$k]);
                break;
              }
            }
          }
        }
        //? After assigning lab remaining subject allot...
        elseif ($i > 4 && str_contains($routine[$day]['slot1'], 'Lab')) {
          if ($facRoutine[$day]['slot1'] == $faculty_id && $i != 7) {
            foreach ($semFac as $sf) {
              if ($sf != $faculty_id && $status[$sf][$day]['slot' . $i] == 1) {
                $newSub = $FacSub[$sf];
                $sCnt = count($newSub);
                for ($m = 0; $m < $sCnt; $m++) {
                  if ($workLoad[$sf]>0 && checkSub($allotedSubjects, $newSub[$m], $hpw[$newSub[$m]])) {
                    $routine[$day]['slot' . $i] = $newSub[$m];
                    $facRoutine[$day]['slot' . $i] = $sf;
                    $workLoad[$sf]=$workLoad[$sf]-1;
                    array_push($allotedSubjects, $newSub[$m]);
                    break;
                  }
                }
                break;
              }
            }
          } elseif ($i == 7) {
            if ($facRoutine[$day]['slot1'] == $faculty_id && $status[$faculty_id][$day]['slot' . $i] == 1) {
              $sCount = count($sub);
              for ($k = 0; $k < $sCount; $k++) {
                if ($workLoad[$faculty_id]>0 && checkSub($allotedSubjects, $sub[$k],$hpw[$sub[$k]])) {
                  $routine[$day]['slot' . $i] = $sub[$k];
                  $facRoutine[$day]['slot' . $i] = $faculty_id;
                  $workLoad[$faculty_id]=$workLoad[$faculty_id]-1;
                  array_push($allotedSubjects, $sub[$k]);
                  break;
                } else {
                  if ($sCount - 1 == $k) {
                    foreach ($semFac as $sf) {
                      if ($facRoutine[$day]['slot1'] != $sf && $status[$sf][$day]['slot' . $i] == 1) {
                        $newSub = $FacSub[$sf];
                        $sCnt = count($newSub);
                        for ($m = 0; $m < $sCnt; $m++) {
                          if ($workLoad[$sf]>0 && checkSub($allotedSubjects, $newSub[$m], $hpw[$newSub[$m]])) {
                            if ($i > 2 && $routine[$day]['slot' . ($i - 2)] == $routine[$day]['slot' . ($i - 1)] && $routine[$day]['slot' . ($i - 1)] == $newSub[$m]) {
                              continue;
                            } else {
                              echo $day . " in the else part slot " . $i . "<br>";
                              $routine[$day]['slot' . $i] = $newSub[$m];
                              $facRoutine[$day]['slot' . $i] = $sf;
                              $workLoad[$sf]=$workLoad[$sf]-1;
                              array_push($allotedSubjects, $newSub[$m]);
                              break 2;
                            }
                          }
                        }
                      }
                    }
                  }
                }
              }
            } else {
              foreach ($semFac as $sf) {
                if ($facRoutine[$day]['slot1'] != $sf && $status[$sf][$day]['slot' . $i] == 1) {
                  $newSub = $FacSub[$sf];
                  $sCnt = count($newSub);
                  for ($m = 0; $m < $sCnt; $m++) {
                    if ($workLoad[$sf]>0 && checkSub($allotedSubjects, $newSub[$m], $hpw[$newSub[$m]])) {
                      if ($i > 2 && $routine[$day]['slot' . ($i - 2)] == $routine[$day]['slot' . ($i - 1)] && $routine[$day]['slot' . ($i - 1)] == $newSub[$m]) {
                        continue;
                      } else {
                        echo $day . " in the else part slot " . $i . "<br>";
                        $routine[$day]['slot' . $i] = $newSub[$m];
                        $facRoutine[$day]['slot' . $i] = $sf;
                        $workLoad[$sf]=$workLoad[$sf]-1;
                        array_push($allotedSubjects, $newSub[$m]);
                        break 2;
                      }
                    }
                  }
                }
              }
            }
          } else {
            foreach ($semFac as $sf) {
              if ($sf != $facRoutine[$day]['slot1'] && $status[$sf][$day]['slot' . $i] == 1) {
                $newSub = $FacSub[$sf];
                $sCnt = count($newSub);
                for ($m = 0; $m < $sCnt; $m++) {
                  if ($workLoad[$sf]>0 && checkSub($allotedSubjects, $newSub[$m], $hpw[$newSub[$m]])) {
                    $routine[$day]['slot' . $i] = $newSub[$m];
                    $facRoutine[$day]['slot' . $i] = $sf;
                    $workLoad[$sf]=$workLoad[$sf]-1;
                    array_push($allotedSubjects, $newSub[$m]);
                    break 2;
                  }
                }
                // break;
              }
            }
          }
        } elseif (!str_contains($routine[$day]['slot1'], 'Lab')) {

          foreach ($semFac as $sf) {
            if ($status[$sf][$day]['slot' . $i] == 1) {
              $newSub = $FacSub[$sf];
              $sCnt = count($newSub);
              for ($o = 0; $o < $sCnt; $o++) {
                if ($workLoad[$sf]>0 && checkSub($allotedSubjects, $newSub[$o], $hpw[$newSub[$o]])) {
                  if ($i > 2 && $routine[$day]['slot' . ($i - 2)] == $routine[$day]['slot' . ($i - 1)] && $routine[$day]['slot' . ($i - 1)] == $newSub[$o]) {
                    if ($sCnt == 1 && $i == 6) {
                      $routine[$day]['slot' . $i] = $newSub[$o];
                      $facRoutine[$day]['slot' . $i] = $sf;
                      $workLoad[$sf]=$workLoad[$sf]-1;
                      array_push($allotedSubjects, $newSub[$o]);
                      break 2;
                    } else {
                      continue;
                    }
                  } else {
                    $routine[$day]['slot' . $i] = $newSub[$o];
                    $facRoutine[$day]['slot' . $i] = $sf;
                    $workLoad[$sf]=$workLoad[$sf]-1;
                    array_push($allotedSubjects, $newSub[$o]);
                    break 2;
                  }
                }
              }
              // break;
            }
          }
        }

        $data = $routine[$day]['slot' . $i];
        $routineSql = "UPDATE " . $year . "year_routine SET slot$i ='$data' WHERE day='$day'";
        $routineRes = mysqli_query($conn, $routineSql);
      }
    }







    echo "<pre>";
    print_r($routine);
    echo "</pre>";
    // echo "<pre>";
    // // echo $FacSub['E3'];
    // print_r($facRoutine);
    // // print_r($status['C1']);
    // echo "</pre>";
    echo "<pre>";
    print_r($allotedSubjects);
    echo "</pre>";
    echo "<hr>";
    echo "<pre>";
    print_r($allotedLab);
    echo "</pre>";
    echo "<pre>";
    print_r($labFac);
    echo "</pre>";

    // $fa=array_unique($fac);
    // print_r($sub);
    // print_r($fa);
    // for($p=1;$p<5;$p++){
    //   if($year==$p){
    //    continue; 
    //   }
    //   else{
    //     updateStatus($facRoutine,$days,$p,$conn);
    //   }
    // }
    echo "<pre>";
    print_r($workLoad);
    echo "</pre>";
    if ($year == '3') {
      updateWorkload($workLoad,4,$conn);
      updateStatus($facRoutine, 4, $conn);
    } elseif ($year == '4') {
      updateWorkload($workLoad,3,$conn);
      updateStatus($facRoutine, 3, $conn);
    }
  }


  ?>






  <div class="container">
    <h1 class="text-center my-3">Generated Class Schedule</h1>

    <table class="table" id="myTable">
      <thead>
        <tr>

          <th scope="col">Days</th>
          <th scope="col">Period 1 (09:20-10:20)</th>
          <th scope="col">Period 2 (10:20-11:20)</th>
          <th scope="col">Period 3 (11:20-12:20)</th>
          <th scope="col">Period 4 (12:20-13:20)</th>
          <th scope="col">Period 5 (14:10-15:10)</th>
          <th scope="col">Period 6 (15:10-16:10)</th>
          <th scope="col">Period 7 (16:10-17:10)</th>

        </tr>
      </thead>
      <tbody>
  </div>


  <?php


  // function for display routine from table
  function Generate_routine($year)
  {

    require 'partials/dbconnect.php';

    $sql = "SELECT * FROM " . $year . "year_routine order by id asc";


    $result = mysqli_query($conn, $sql);



    while ($row = mysqli_fetch_assoc($result)) {

      echo "  <tr>   
      <th scope='row'>" . $row['day'] . "</th>
  <td>" . $row['slot1'] . "</td>
  <td>" . $row['slot2'] . "</td>
  <td>" . $row['slot3'] . "</td>
  <td>" . $row['slot4'] . "</td>
  <td>" . $row['slot5'] . "</td>
  <td>" . $row['slot6'] . "</td>
  <td>" . $row['slot7'] . "</td>

  </tr>";
    }
  }

  // Getting post request from dropdown menu
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {




    $dept = $_POST['course'];
    $year = $_POST['year'];
    $sem = $_POST['sem'];
    routine($year, $sem);
    Generate_routine($year);
  }




  ?>
</body>
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
  integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
  integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
  integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->

<!-- Datatables -->
<script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


<!-- Initialize Data tables -->
<script>
  // $(document).ready(function () {
  //   $('#myTable').DataTable();
  //   "order": [];
  // });


  const year = document.querySelector('#year');
  const sem = document.querySelector('#sem');
  // if(year.value=='3'){
  sem.getElementsByTagName('option')[0].style.display = "none";
  sem.getElementsByTagName('option')[1].style.display = "none";
  sem.getElementsByTagName('option')[2].setAttribute('selected', 'true');

  sem.getElementsByTagName('option')[6].style.display = "none";
  sem.getElementsByTagName('option')[5].style.display = "none";
  sem.getElementsByTagName('option')[7].style.display = "none";
  sem.getElementsByTagName('option')[4].style.display = "none";
  // }
  year.addEventListener('change', () => {
    if (year.value == '4') {
      console.log(year.value);
      sem.getElementsByTagName('option')[6].style.display = "inline";
      sem.getElementsByTagName('option')[6].setAttribute('selected', 'true');
      sem.getElementsByTagName('option')[7].style.display = "inline";
      sem.getElementsByTagName('option')[2].style.display = "none";
      sem.getElementsByTagName('option')[3].style.display = "none";
      sem.getElementsByTagName('option')[4].style.display = "none";
      sem.getElementsByTagName('option')[5].style.display = "none";
      sem.getElementsByTagName('option')[4].removeAttribute('selected');
      sem.getElementsByTagName('option')[2].removeAttribute('selected');
    } else if (year.value == '3') {
      console.log(year.value);
      sem.getElementsByTagName('option')[4].style.display = "inline";
      sem.getElementsByTagName('option')[4].setAttribute('selected', 'true');
      sem.getElementsByTagName('option')[5].style.display = "inline";
      sem.getElementsByTagName('option')[6].style.display = "none";
      sem.getElementsByTagName('option')[7].style.display = "none";
      sem.getElementsByTagName('option')[2].style.display = "none";
      sem.getElementsByTagName('option')[3].style.display = "none";
      sem.getElementsByTagName('option')[6].removeAttribute('selected');
      sem.getElementsByTagName('option')[2].removeAttribute('selected');
    } else if (year.value == '2') {
      console.log(year.value);
      sem.getElementsByTagName('option')[2].style.display = "inline";
      sem.getElementsByTagName('option')[2].setAttribute('selected', 'true');
      sem.getElementsByTagName('option')[3].style.display = "inline";
      sem.getElementsByTagName('option')[4].style.display = "none";
      sem.getElementsByTagName('option')[6].style.display = "none";
      sem.getElementsByTagName('option')[7].style.display = "none";
      sem.getElementsByTagName('option')[5].style.display = "none";
      sem.getElementsByTagName('option')[4].removeAttribute('selected');
      sem.getElementsByTagName('option')[6].removeAttribute('selected');
    }
  })
</script>