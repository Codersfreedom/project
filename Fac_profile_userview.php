<?php
require 'partials/dbconnect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Profile</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <!-- Custom CSS -->
    <link href="./assets/libs/flot/css/float-chart.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="./dist/css/style.min.css" rel="stylesheet" />
    <style>
        .container-1 {
            position: relative;
            height: 300px;
            width: 600px;
            top: 60px;
            left: calc(50% - 300px);
            display: flex;
            margin-bottom: 4rem;
        }

        .card-1 {
            display: flex;
            height: 280px;
            width: 200px;
            background-color: #17141d;
            border-radius: 10px;
            box-shadow: -1rem 0 3rem #000;
            /*   margin-left: -50px; */
            transition: 0.4s ease-out;
            position: relative;
            left: 0px;
        }

        .card-1:not(:first-child) {
            margin-left: -50px;
        }

        .card-1:hover {
            transform: translateY(-20px);
            transition: 0.4s ease-out;
        }

        .card-1:hover~.card-1 {
            position: relative;
            left: 50px;
            transition: 0.4s ease-out;
        }

        .title-1 {
            color: white;
            font-weight: 300;
            position: absolute;
            left: 20px;
            top: 15px;
        }

        .bar {
            position: absolute;
            top: 100px;
            left: 20px;
            height: 5px;
            width: 150px;
        }

        .emptybar {
            background-color: #2e3033;
            width: 100%;
            height: 100%;
        }

        .filledbar {
            position: absolute;
            top: 0px;
            z-index: 3;
            width: 0px;
            height: 100%;
            background: rgb(0, 154, 217);
            background: linear-gradient(90deg, rgba(0, 154, 217, 1) 0%, rgba(217, 147, 0, 1) 65%, rgba(255, 186, 0, 1) 100%);
            transition: 0.6s ease-out;
        }

        .card-1:hover .filledbar {
            width: 120px;
            transition: 0.4s ease-out;
        }

        .circle {
            position: absolute;
            top: 150px;
            left: calc(50% - 60px);
        }

        .stroke {
            stroke: white;
            stroke-dasharray: 360;
            stroke-dashoffset: 360;
            transition: 0.6s ease-out;
        }

        svg {
            fill: #17141d;
            stroke-width: 2px;
        }

        .card-1:hover .stroke {
            stroke-dashoffset: 100;
            transition: 0.6s ease-out;
        }

        .card-1 .text {
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        .card-1:hover .text {
            font-size: 2rem;
            font-weight: 700;
            opacity: 1;
        }

        .list-group>li {
            background-color: #100e17;

        }

        .list-group {
            background-color: #100e17;

        }

        /* End of css  */

        .container-2 {
            background-color: #17141d;
            color: #fff;
            /* box-shadow: -1rem 0 3rem #000 !important; */
            width: 100%;
            padding: 1rem;
        }

        .title-2 {
            font-size: 24px;
            line-height: 28px;
            font-weight: bold;
            color: #fff;
            padding-bottom: 11px;
            border-bottom: 1px solid #d7dbdf;
        }

        .form-group {
            margin-top: 25px;
            display: flex;
            flex-direction: column;
        }



        .textarea-group label,
        .form-group label {
            color: #fff;
            font-size: 16px;
            line-height: 19px;
            margin-bottom: 10px;
        }

        .form-group [type],
        .textarea-group textarea {
            border: 1px solid #d2d6db;
            border-radius: 6px;
            padding: 15px;
        }

        .form-group [type]:hover,
        .textarea-group textarea:hover {
            border-color: #a8afb9;
        }

        input[type='text'],
        input[type='email'],
        input[type='tel'],
        textarea {
            background-color: #17141d !important;
            font-size: 1.1rem;
            color: #fff !important;

        }

        .form-group [type]:focus,
        .textarea-group textarea:focus {
            border-color: #5850eb;
        }

        .textarea-group {
            margin-top: 24px;
        }

        .textarea-group textarea {
            resize: none;
            width: 100%;
            margin-top: 10px;
            height: calc(100% - 59px);
        }



        

        @media screen and (min-width: 768px) {
            /* body {
                align-items: center;
                justify-content: center;
            } */

            .container-2 {
                margin: 2rem;
                box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.1);
                border-radius: 4px;
                max-width: 32rem;
                padding: 2rem;
            }
        }

        @media screen and (min-width: 1024px) {
            .container-2 {
                max-width: 100%;
                width: 100%;
            }



            .grid {
                display: grid;
                grid-gap: 20px;
                grid-template-columns: 1fr 1fr 1fr;
                grid-auto-rows: 1fr;
            }

            .name-group {
                grid-column: span 2;
                grid-row: 1;
            }

            .email-group {
                grid-column: span 2;
                grid-row: 2;
            }

            .fac-group {
                grid-column: 2;
                grid-row: 3;
            }

            .phone-group {
                grid-column: 1;
                grid-row: 3;
            }

            .bt-group {
                grid-column: 3;
                grid-row: 3;
            }

            .textarea-group {
                grid-column: 3;
                grid-row: span 3;
                margin-right: 2rem;
            }

            .button-container {
                /* margin-top: 25px; */
                text-align: right;
            }

            .button {
                /* bon, bon, bon
        c'est pas tout mais j'ai faim moi ^^
        */
                width: auto;
            }
        }

        hr {
            border-top: 2px solid black !important;
        }

        .icon {
            font-size: 1.2rem;
            padding-right: 4px;
        }

        /* dashboard css */
        #dash-bg {
            display: grid;
            grid-template-columns: auto auto;
            grid-template-rows: auto auto;
        }

        .left-menu {
            grid-row: span 2;
        }

        @media(max-width:768px) {
            #dash-bg {
                display: grid;
                grid-template-columns: auto auto;
                grid-template-rows: auto;
            }

            /* .left-menu{
        display: none;
        order: 1;
    } */
            .greet>strong,
            p,
            a {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body style="background-color:#100e17;">
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">

        <?php
       
        

        ?>
        <div class="container">
            <div class="main-body">
                <?php
                $facid = $_GET['fac_id'];
                $sql = "select * from faculty where fac_id = '$facid'";
                $row = mysqli_fetch_assoc(mysqli_query($conn, $sql));

                $totalSubSql = "select Subject_code from subject";
                $totalSub = mysqli_num_rows(mysqli_query($conn, $totalSubSql));


                $subjectSql = "select sub_code from sub_allot where fac_id = '$facid'";
                $subCount = mysqli_num_rows(mysqli_query($conn, $subjectSql));

                $yearSql = "select distinct year from sub_allot where fac_id = '$facid'";
                $yearCount = mysqli_num_rows(mysqli_query($conn, $yearSql));

                $labSql = "select assign from sub_allot where assign like '%Lab%' and fac_id='$facid'";
                $labCount = mysqli_num_rows(mysqli_query($conn, $labSql));

                $theorySql = "select assign from sub_allot where not assign like '%Lab%' and fac_id='$facid'";
                $theoryCount = mysqli_num_rows(mysqli_query($conn, $theorySql));

                $totalWlSql = "select totalWL from total_wl where fac_id = '$facid'";
                $totalWL = mysqli_fetch_assoc(mysqli_query($conn, $totalWlSql));

                

                ?>


                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                        <div class="card" style="background-color:#100e17;">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="./assets/images/users/avatar1.png" alt="Avatar
                                        class= " rounded-circle" width="150">
                                    <div class="mt-3">
                                        <h4 class="text-light">
                                            <?php echo $row['name']; ?>
                                        </h4>
                                       

                                        <h3><span class="badge bg-primary">
                                                <?php echo $row['designation']; ?>
                                            </span></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3 ">
                            <ul class="list-group  list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-globe mr-2 icon-inline">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="2" y1="12" x2="22" y2="12"></line>
                                            <path
                                                d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                                            </path>
                                        </svg>Website</h6>
                                    <span class="text-secondary">Your website</span>

                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-github mr-2 icon-inline">
                                            <path
                                                d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22">
                                            </path>
                                        </svg>Github</h6>
                                    <span class="text-secondary">Your Github</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-twitter mr-2 icon-inline text-info">
                                            <path
                                                d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
                                            </path>
                                        </svg>Twitter</h6>
                                    <span class="text-secondary">@yourid</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-instagram mr-2 icon-inline text-danger">
                                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                        </svg>Instagram</h6>
                                    <span class="text-secondary">Your Instagram</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-facebook mr-2 icon-inline text-primary">
                                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z">
                                            </path>
                                        </svg>Facebook</h6>
                                    <span class="text-secondary">Your facbook</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class=" d-flex align-items-center justify-content-center">
                            <div class="container-2">

                                <h1 class="title-2">Profile Details</h1>

                                <form>
                                    <div class="grid">
                                        <div class="form-group name-group">
                                            <label for="fname">Full Name</label>
                                            <input class="form-control name" id="fname" name="name" type="text" readonly
                                                value="<?= $row['name'] ?? null ?>" required>
                                        </div>

                                        <div class="form-group email-group">
                                            <label for="fname">Email</label>
                                            <input class="form-control name" id="email" name="email" type="email" readonly
                                                value="<?= $row['email'] ?? null ?>" required>
                                        </div>
                                        <div class="form-group fac-group">
                                            <label for="fname">Faculty Id</label>
                                            <input class="form-control name" id="fac_id" name="fac_id" type="text"
                                                readonly value="<?= $row['fac_id'] ?? null ?>" required>
                                        </div>

                                        <div class="textarea-group ">
                                            <label for="bio">Address</label>
                                            <textarea id="bio" readonly name="addr"><?= $row['addr'] ?? null ?></textarea>
                                        </div>

                                        <div class="form-group phone-group">
                                            <label for="phone">Mobile No.</label>
                                            <input class="form-control name" id="phone" name="phone" type="tel" readonly
                                                value="<?= $row['phone'] ?? null ?>">
                                        </div>
                                    </div>
                                    
                                </form>

                            </div>
                        </div>

                    
                    </div>
                </div>

            </div>
        </div>
    </div>


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