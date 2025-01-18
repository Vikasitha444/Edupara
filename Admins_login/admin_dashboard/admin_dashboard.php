<?php

$server_db = file_get_contents("../../database details/server.txt", "r") or die("Unable to open file!");
$username_db = file_get_contents("../../database details/username.txt", "r") or die("Unable to open file!");
$password_db = file_get_contents("../../database details/password.txt", "r") or die("Unable to open file!");
$database_name_db = file_get_contents("../../database details/dbname.txt", "r") or die("Unable to open file!");


if(isset($_COOKIE['username']) and isset($_COOKIE['password'])){
    $username_from_cookie = $_COOKIE['username'];
    $password_from_cookie = $_COOKIE['password'];
}else{
    echo "<script>window.location.replace('../admins_login.php?');</script>";
}


//Connect the Database'
//Change to the server database
//$conn = new mysqli($server,$username,$password,$database);
$conn = new mysqli($server_db,$username_db,$password_db,$database_name_db);


//Check the Connection was Sussesfull
if ($conn->connect_error){
    die."Connection Interuppted";
}

//echo "Connection Successful";							//Eneble this if Database not Successfuly Connected

?>





<!--Importent notes-->
<!--uncomment refresh meta tag-->

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edupara Admins | Edupara.lk</title>
    <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 11]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
    <!-- Meta -->
    <!-- <meta http-equiv="refresh" content="5;URL='admin_dashboard.php?'"> -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    
    
    

    <!-- Favicon icon -->
    <link rel="icon" href="../../index/img/core-img/favicon.ico" type="image/x-icon">
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <!-- animation css -->
    <link rel="stylesheet" href="assets/plugins/animation/css/animate.min.css">
    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Thimyfy Icons -->
    <link rel="stylesheet" href="./assets/Themefy icons plugin/themify-icons.css">


</head>

<body>
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ navigation menu ] start -->
    <nav class="pcoded-navbar">
        <div class="navbar-wrapper">
            <div class="navbar-brand header-logo">
                <a href="./admin_dashboard.php?" class="b-brand">
                    
                    <div>
                        <img src="../../index/img/core-img/favicon.ico" alt="" width="40" height="40">
                    </div>
                    <span class="b-title">Edupara Admins</span>
                </a>
                <a class="mobile-menu" id="mobile-collapse" href="javascript:"><span></span></a>
            </div>
            <div class="navbar-content scroll-div">
                <ul class="nav pcoded-inner-navbar">
                    <li class="nav-item pcoded-menu-caption">
                        <label>All infomations</label>
                    </li>
                    <li data-username="Everything can see by Admins" class="nav-item active">
                        <a href="admin_dashboard.php?" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                    </li>
                    <li class="nav-item pcoded-menu-caption">
                        <label>Admin Authentications</label>
                    </li>
                    <li data-username="Simply Admin can manage about Teachers and Student and Etc" class="nav-item pcoded-hasmenu">
                        <a href="javascript:" class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Manage</span></a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="bc_button.php?" class="">Teachers under review</a></li>
                            <li class=""><a href="bc_badges.php?" class="">Teachers</a></li>
                            <li class=""><a href="form_elements.php?" class="">Add a teacher <span class="pcoded-badge label label-primary">Risky</span></a></li>
                            <li class=""><a href="bc_tabs.php" class="">Students</a></li>
                            <!-- <li class=""><a href="" class="">Tabs & pills</a></li> -->
                            <!-- <li class=""><a href="bc_typography.html" class="">Typography</a></li> -->
                            <!-- <li class=""><a href="icon-feather.html" class="">Feather</a></li> -->


                        </ul>
                    </li>

                    
                            
                    
                            
                    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
                    <?php
                        $sql15 = "  SELECT COUNT(Readability) FROM contact_us_messages
                                    WHERE Readability = 'unread' and (Name != '' or Email != '' or Phone_number != '' or whatsapp_number != '' or message_content != '');";
                        $resalt15 = mysqli_query($conn, $sql15);                   //get the resalt between $conn and, run $sql
                        $resaltcheck15 = mysqli_num_rows($resalt15);
                        $datas15 = array();
                        if ($resaltcheck15 > 0) {
                        while ($row15 = mysqli_fetch_assoc($resalt15)) {
                            $datas15[] = $row15;
                        }
                            $unreaded_messags_count = $datas15[0]['COUNT(Readability)'];
                            
                            if($unreaded_messags_count == 0){
                                // echo "<script>$(function(){document.getElementsByClassName('unread_shower').style.display = 'none';});</script>";
                                echo "<script>$(function(){hide_counter();});</script>";
                                
                            }
                        }
                    ?>

                    <script>
                        function hide_counter(){
                            $(function(){
                                $('.unread_shower').hide();
                            });
                        }
                    </script>
                        
                        
                    <li class="nav-item pcoded-menu-caption">
                        <label>Emails and Messages</label>
                    </li>
                    <li data-username="" class="nav-item pcoded-hasmenu">
                        <a href="javascript:" class="nav-link "><span class="pcoded-micon"><i class="feather icon-mail"></i></span><span class="pcoded-mtext">Messages</span></a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="./bc_typography.php?" class="">Inbox <span class='pcoded-badge label label-danger unread_shower'><?php echo $unreaded_messags_count; ?></span></a></li>
                           <li class=""><a href="./bc_typography - 3.php?" class="">Compose Email</a></li>
                        </ul>
                    </li>
                    <!-- <li data-username="Table bootstrap datatable footable" class="nav-item">
                        <a href="tbl_bootstrap.html" class="nav-link "><span class="pcoded-micon"><i class="feather icon-server"></i></span><span class="pcoded-mtext">Table</span></a>
                    </li> -->
                    
                    <!-- <li class="nav-item pcoded-menu-caption">
                        <label>Chart & Maps</label>
                    </li>
                    <li data-username="Charts Morris" class="nav-item"><a href="chart-morris.html" class="nav-link "><span class="pcoded-micon"><i class="feather icon-pie-chart"></i></span><span class="pcoded-mtext">Chart</span></a></li>
                    <li data-username="Maps Google" class="nav-item"><a href="map-google.html" class="nav-link "><span class="pcoded-micon"><i class="feather icon-map"></i></span><span class="pcoded-mtext">Maps</span></a></li> -->
                    
                    <li class="nav-item pcoded-menu-caption">
                        <label>Log in Session</label>
                    </li>
                    <li data-username="Authentication Sign up Sign in reset password Change password Personal information profile settings map form subscribe" class="nav-item pcoded-hasmenu">
                        <a href="javascript:" class="nav-link "><span class="pcoded-micon"><i class="feather icon-lock"></i></span><span class="pcoded-mtext">Authentication</span></a>
                        <ul class="pcoded-submenu">
                            <!-- <li class=""><a href="../admins_login.php?" class="" target="_blank">Log in as</a></li> -->
                            <li class=""><a href="../admins_login.php?" class="" target="_blank">Log out</a></li>
                        </ul>
                    </li>
                    <!-- <li data-username="Sample Page" class="nav-item"><a href="sample-page.html" class="nav-link"><span class="pcoded-micon"><i class="feather icon-sidebar"></i></span><span class="pcoded-mtext">Sample page</span></a></li>
                    <li data-username="Disabled Menu" class="nav-item disabled"><a href="javascript:" class="nav-link"><span class="pcoded-micon"><i class="feather icon-power"></i></span><span class="pcoded-mtext">Disabled menu</span></a></li> -->
                </ul>
            </div>
        </div>
    </nav>
    <!-- [ navigation menu ] end -->

    <!-- [ Header ] start -->
    <header class="navbar pcoded-header navbar-expand-lg navbar-light">
        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse1" href="javascript:"><span></span></a>
            <a href="./admin_dashboard.php?" class="b-brand">
                   <div class="b-bg">
                       <i class="feather icon-trending-up"></i>
                   </div>
                   <span class="b-title">Edupara Admins</span>
               </a>
        </div>
        <a class="mobile-menu" id="mobile-header" href="javascript:">
            <i class="feather icon-more-horizontal"></i>
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li><a href="javascript:" class="full-screen" onclick="javascript:toggleFullScreen()"><i class="feather icon-maximize"></i></a></li>
                <!-- <li class="nav-item dropdown">
                    <a class="dropdown-toggle" href="javascript:" data-toggle="dropdown">Dropdown</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="javascript:">Action</a></li>
                        <li><a class="dropdown-item" href="javascript:">Another action</a></li>
                        <li><a class="dropdown-item" href="javascript:">Something else here</a></li>
                    </ul>
                </li> -->
                <li class="nav-item">
                    <div class="main-search">
                        <div class="input-group">
                            <input type="text" id="m-search" class="form-control" placeholder="Search . . .">
                            <a href="javascript:" class="input-group-append search-close">
                                <i class="feather icon-x input-group-text"></i>
                            </a>
                            <span class="input-group-append search-btn btn btn-primary">
                                <i class="feather icon-search input-group-text"></i>
                            </span>
                        </div>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li>
                    <!-- <div class="dropdown">
                        <a class="dropdown-toggle" href="javascript:" data-toggle="dropdown"><i class="icon feather icon-bell"></i></a>
                        <div class="dropdown-menu dropdown-menu-right notification">
                            <div class="noti-head">
                                <h6 class="d-inline-block m-b-0">Notifications</h6>
                                <div class="float-right">
                                    <a href="javascript:" class="m-r-10">mark as read</a>
                                    <a href="javascript:">clear all</a>
                                </div>
                            </div>
                            <ul class="noti-body">
                                <li class="n-title">
                                    <p class="m-b-0">NEW</p>
                                </li>
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="assets/images/user/avatar-1.jpg" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <p><strong>John Doe</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>30 min</span></p>
                                            <p>New ticket Added</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="n-title">
                                    <p class="m-b-0">EARLIER</p>
                                </li>
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="assets/images/user/avatar-2.jpg" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <p><strong>Joseph William</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>30 min</span></p>
                                            <p>Prchace New Theme and make payment</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="assets/images/user/avatar-3.jpg" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <p><strong>Sara Soudein</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>30 min</span></p>
                                            <p>currently login</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="noti-footer">
                                <a href="javascript:">show all</a>
                            </div>
                        </div>
                    </div> -->
                </li>
                <li>
                    <div class="dropdown drp-user">
                        <a href="javascript:" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon feather icon-settings"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-notification">
                            <div class="pro-head">


                            <?php
                                $username = $username_from_cookie;
                                

                                if ($username == 'AN75SnEF'){
                                    $user = "Aravinda Sampath";
                                    $user_img = "admin3";
                                }
                                elseif($username == 'wVgXieSE'){
                                    $user = "Janith Dewapriya";
                                    $user_img = "admin2";
                                }
                                elseif($username == 'gNCLLRvF'){
                                    $user = "Pawan Vikasitha";
                                    $user_img = "admin1";
                                }
                            
                                echo   "<img src='assets/images/user/$user_img.jpg' class='img-radius' alt='User-Profile-Image'>
                                        <span>$user</span>";

                            ?>
                                <a href="../admins_login.php?" class="dud-logout" title="Logout">
                                    <i class="feather icon-log-out"></i>
                                </a>
                            </div>
                            <ul class="pro-body">
                                <!-- <li><a href="javascript:" class="dropdown-item"><i class="feather icon-settings"></i> Settings</a></li> -->
                                <!-- <li><a href="javascript:" class="dropdown-item"><i class="feather icon-user"></i> Profile</a></li> -->
                                <li><a href="./bc_typography.php?" class="dropdown-item"><i class="feather icon-mail"></i>Messages &nbsp&nbsp<span class='pcoded-badge label label-danger unread_shower'><?php echo $unreaded_messags_count; ?></span></a></li>
                                <li><a href="../admins_login.php?" class="dropdown-item"><i class="feather icon-lock"></i> Log out</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </header>
    <!-- [ Header ] end -->

    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <!-- [ breadcrumb ] start -->

                    <!-- [ breadcrumb ] end -->
                    <div class="main-body">
                        <div class="page-wrapper">
                            <!-- [ Main Content ] start -->
                            <div class="row">
                                <!--[ daily sales section ] start-->

                                <!-- getting statics from database starts here -->
                                    <?php
                                        //Get the total Students Count
                                        $sql7 = "SELECT COUNT(*) FROM students;";
                                        $resalt7 = mysqli_query($conn, $sql7);                   //get the resalt between $conn and, run $sql
                                        $resaltcheck7 = mysqli_num_rows($resalt7);
                                        $datas7 = array();
                                        if ($resaltcheck7 > 0) {
                                        while ($row7 = mysqli_fetch_assoc($resalt7)) {
                                            $datas7[] = $row7;
                                            }
                                            $students_count = $datas7[0]['COUNT(*)'];
                                        }

                                        //Get the anonymous Count
                                        $sql8 = "SELECT COUNT(FULL_NAME) from students WHERE FULL_NAME LIKE '%ANONYMOUS%';";
                                        $resalt8 = mysqli_query($conn, $sql8);                   //get the resalt between $conn and, run $sql
                                        $resaltcheck8 = mysqli_num_rows($resalt8);
                                        $datas8 = array();
                                        if ($resaltcheck8 > 0) {
                                        while ($row8 = mysqli_fetch_assoc($resalt8)) {
                                            $datas8[] = $row8;
                                            }
                                            $anonymous_count = $datas8[0]['COUNT(FULL_NAME)'];
                                        }
                                            //Get the registed students Count
                                            $registerd_students_count = $students_count - $anonymous_count;

                                        
                                            //Get the under review Teahcers Count
                                            $sql9 = "SELECT COUNT(*) FROM teachers_under_review;";
                                            $resalt9 = mysqli_query($conn, $sql9);                   //get the resalt between $conn and, run $sql
                                            $resaltcheck9 = mysqli_num_rows($resalt9);
                                            $datas9 = array();
                                            if ($resaltcheck9 > 0) {
                                            while ($row9 = mysqli_fetch_assoc($resalt9)) {
                                                $datas9[] = $row9;
                                                }
                                                $teachers_under_review_count = $datas9[0]['COUNT(*)'];
                                            }

                                            //Get the registerd Teahcers Count
                                            $sql10 = "SELECT COUNT(*) FROM teachers;";
                                            $resalt10 = mysqli_query($conn, $sql10);                   //get the resalt between $conn and, run $sql
                                            $resaltcheck10 = mysqli_num_rows($resalt10);
                                            $datas10 = array();
                                            if ($resaltcheck10 > 0) {
                                            while ($row10 = mysqli_fetch_assoc($resalt10)) {
                                                $datas10[] = $row10;
                                                }
                                                $registerd_teachers_count = $datas10[0]['COUNT(*)'];
                                            }
                                            

                                            //Get the total Teahcers Count
                                            $teachers_count = $registerd_teachers_count + $teachers_under_review_count;


                                            //Get the total ads Count
                                            $count_of_subject_columns = 0;
                                            
                                            
                                                $sql11 = "  SELECT * FROM INFORMATION_SCHEMA.COLUMNS
                                                            WHERE TABLE_NAME = N'time_table_of_teachers';";

                                                $resalt11 = mysqli_query($conn, $sql11);                   //get the resalt between $conn and, run $sql
                                                $resaltcheck11 = mysqli_num_rows($resalt11);
                                                $datas11 = array();
                                                if ($resaltcheck11 > 0) {
                                                while ($row11 = mysqli_fetch_assoc($resalt11)) {
                                                    $datas11[] = $row11;
                                                }
                                                    // print_r($datas11);
                                                    for ($k=0; $k < count($datas11); $k++) { 
                                                        $column_name = $datas11[$k]['COLUMN_NAME'];
                                                        if(strpos($column_name, "GRADE__") !== false){
                                                            $count_of_subject_columns ++;
                                                        }
                                                    }
                                                }
                                                
                                                $count_of_ads = 0;
                                                for ($k=1; $k <= $count_of_subject_columns; $k++) { 
                                                    $sql12 = "  SELECT COUNT(GRADE__$k) from time_table_of_teachers
                                                                WHERE GRADE__$k != '' OR GRADE__$k != NULL;";

                                                    $resalt12 = mysqli_query($conn, $sql12);                   //get the resalt between $conn and, run $sql
                                                    $resaltcheck12 = mysqli_num_rows($resalt12);
                                                    $datas12 = array();
                                                    if ($resaltcheck12 > 0) {
                                                    while ($row12 = mysqli_fetch_assoc($resalt12)) {
                                                        $datas12[] = $row12;
                                                        }
                                                        // print_r($datas12);
                                                        $ads_amount = $datas12[0]["COUNT(GRADE__$k)"];
                                                        $count_of_ads = $count_of_ads + $ads_amount;
                                                    }
                                                    

                                                }
                                                    $count_of_ads;
                                            

                                            
                                        

                                        
 
                                    ?>
                                <!-- getting statics from database ends here -->

                                <div class="col-md-6 col-xl-4">
                                    <div class="card daily-sales">
                                        <div class="card-block">
                                            <h6 class="mb-4">Students</h6>
                                            <div class="row d-flex align-items-center">
                                                <div class="col-6">
                                                    <h3 class="f-w-300 d-flex align-items-center m-b-0"><i class="ti ti-id-badge text-c-green f-50 m-r-10"></i> &nbsp; <?php echo $students_count; ?></h3>
                                                </div>

                                                <div class="col-6 text-right">
                                                    <p class="m-b-0 ">Annonymous : <?php echo $anonymous_count; ?></p>
                                                    <p class="m-b-0 ">Registerd : <?php echo $registerd_students_count; ?></p>
                                                </div>
                                            </div>
                                            
                                            <!-- <div class="progress m-t-30" style="height: 7px;">
                                                <div class="progress-bar progress-c-theme" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                                <!--[ daily sales section ] end-->
                                <!--[ Monthly  sales section ] starts-->
                                <div class="col-md-6 col-xl-4">
                                    <div class="card Monthly-sales">
                                    <div class="card-block">
                                            <h6 class="mb-4">Teachers</h6>
                                            <div class="row d-flex align-items-center">
                                                <div class="col-6">
                                                    <h3 class="f-w-300 d-flex align-items-center m-b-0"><i class="ti ti-user text-c-green f-50 m-r-10"></i> &nbsp; <?php echo $teachers_count; ?></h3>
                                                </div>

                                                <div class="col-6 text-right">
                                                    <p class="m-b-0 ">Unider review : <?php echo $teachers_under_review_count; ?></p>
                                                    <p class="m-b-0 ">Registerd : <?php echo $registerd_teachers_count; ?></p>
                                                </div>
                                            </div>
                                            
                                            <!-- <div class="progress m-t-30" style="height: 7px;">
                                                <div class="progress-bar progress-c-theme" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                                <!--[ Monthly  sales section ] end-->
                                <!--[ year  sales section ] starts-->
                                <div class="col-md-12 col-xl-4">
                                    <div class="card yearly-sales">
                                    <div class="card-block">
                                            <h6 class="mb-4">Institute</h6>
                                            <div class="row d-flex align-items-center">
                                                <div class="col-6">
                                                    <h3 class="f-w-300 d-flex align-items-center m-b-0"><i class="ti ti-map-alt text-c-green f-50 m-r-10"></i> &nbsp; 0</h3>
                                                </div>

                                                <div class="col-6 text-right">
                                                    <!-- <p class="m-b-0 ">Annonymous : 100</p>
                                                    <p class="m-b-0 ">Registerd : 25</p> -->
                                                </div>
                                            </div>
                                            
                                            <!-- <div class="progress m-t-30" style="height: 7px;">
                                                <div class="progress-bar progress-c-theme" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                                <!--[ year  sales section ] end-->
                                <!--[ Recent Users ] start-->
                                <div class="col-xl-8 col-md-6">
                                    <div class="card Recent-Users">
                                        <div class="card-header">
                                            <h5>Teachers Under Review (<?php echo $teachers_under_review_count; ?>)</h5><br/>
                                            <small><i class='fas fa-circle text-c-green f-10 m-r-15'></i>Online</small><br/>
                                            <small><i class='fas fa-circle text-c-red f-10 m-r-15'></i>Physical</small><br/>
                                        </div>
                                        <div class="card-block px-0 py-3">
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    
                                                    
                                                    
                                                    <tbody>
                                                        
                                                    <?php
                                                        
                                                    
                                                        $sql = "SELECT FNAME,SNAME,EMAIL,ID_NUM,CLASS_TYPE_INPUT,DATE_TIME FROM teachers_under_review;";
                                                        $sql2 = "SELECT COUNT(*) FROM teachers_under_review;";

                                                        $resalt = mysqli_query($conn,$sql);					         //get the resalt between $conn and, run $sql	
                                                        $resaltcheck = mysqli_num_rows($resalt);
                                                        $datas = array();

                                                        $resalt2 = mysqli_query($conn,$sql2);					         //get the resalt between $conn and, run $sql	
                                                        $resaltcheck2 = mysqli_num_rows($resalt2);
                                                        $datas2 = array();
                                                      
                                                        if ($resaltcheck > 0) {
                                                          while ($row = mysqli_fetch_assoc($resalt)){
                                                            //echo $row['Image'];
                                                            $datas[] = $row;  }
                                                        }

                                                        if ($resaltcheck2 > 0) {
                                                            while ($row2 = mysqli_fetch_assoc($resalt2)){
                                                              //echo $row['Image'];
                                                              $datas2[] = $row2;  }
                                                          }



                                                        $number_of_columns = intval($datas2[0]['COUNT(*)']);
                                                        $teachers_ID_list = array();

                                                        


                                                        for ($i=0; $i < $number_of_columns ; $i++) { 
                                                              
                                                            $fname = $datas[$i]['FNAME'];
                                                            $sname = $datas[$i]['SNAME'];
                                                            $email = $datas[$i]['EMAIL'];
                                                            $id_num = $datas[$i]['ID_NUM'];
                                                            $class_type = $datas[$i]['CLASS_TYPE_INPUT'];
                                                            $date_time = $datas[$i]['DATE_TIME'];

                                                            if ($class_type == 'Online'){
                                                                $dot = "<i class='fas fa-circle text-c-green f-10 m-r-15'>";
                                                            }
                                                            elseif ($class_type == 'Physical'){
                                                                $dot = "<i class='fas fa-circle text-c-red f-10 m-r-15'>";
                                                            }
                                                            elseif ($class_type == 'Both'){
                                                                $dot = "<i class='fas fa-circle text-c-red f-10 m-r-15'></i><i class='fas fa-circle text-c-green f-10 m-r-15'></i>";
                                                            }
                                                
                                                            
                                                        
                                                        
                                                                echo    "<tr class='unread'>
                                                                            <td><img class='rounded-circle' style='width:40px;' src='assets/images/user/avatar-1.jpg' alt='activity-user'></td>
                                                                            <td>
                                                                                <h6 class='mb-1'><a href='bc_button.php?'>$fname $sname<a></h6>
                                                                                <p class='m-0'>$email</p>
                                                                            </td>
                                                                            <td>
                                                                                <h6 class='text-muted'>$dot</i>$date_time</h6>
                                                                            </td>
                                                                            <td><a href='admin_dashboard.php?getInfo=$id_num' class='label theme-bg2 text-white f-19' onclick='return confirm(`$fname $sname will Reject. Do you want to proceed with this?`)'>Reject</a> <a href='admin_dashboard.php?getInfo2=$id_num' class='label theme-bg text-white f-19'  onclick='return confirm(`$fname $sname will Approve. Are you sure about this?`)'>Approve</a></td>
                                                                        </tr>";

                                                                
                                                                array_push($teachers_ID_list,$id_num);

                                                                
                                                        }
                                                        
                                                            if (isset($_GET['getInfo'])){
                                                                $id_num = urldecode($_GET['getInfo']);
                                                                
                                                                
                                                                $sql3 = "INSERT INTO rejected_teachers SELECT * FROM teachers_under_review WHERE ID_NUM = '$id_num';";
                                                                $resultInsert = mysqli_query($conn, $sql3) ;
                                                                

                                                                if($resultInsert === TRUE){
                                                                    $sql17 = "DELETE FROM teachers_under_review WHERE ID_NUM = '$id_num';";
                                                                    if(mysqli_query($conn, $sql17)){
                                                                        echo "<script>window.location.replace('admin_dashboard.php?')</script>";
                                                                    } 
                                                                    

                                                                    
                                                                }   
                                                                else{
                                                                    echo "Error : ". $sql . "<br>" . $conn -> error;
                                                                        }
                                                                
                                                                
 
                      
                                                                            
                                                                    
                                                                
                                                                //echo "<script>alert('Teacher Removed! Please wait until next page refresh');</script>";
                                            
                                                            }


                                                            if(isset($_GET['getInfo2'])){
                                                                $id_num = urldecode($_GET['getInfo2']);
                                                                
                                                                //Copying Common data from teachers_under_review
                                                                $sql3 = "INSERT INTO teachers (FNAME, SNAME, AGE, ID_NUM, EMAIL, PHONE_NUMBER, WHATSAPP_NUMBER, EDU_LEVEL, UNIVERSITY, GARDUATED_YEAR, TEACHING_SINCE, AMOUNT_SUBJECTS, PASSWORD, CONFIRM_PASSWORD, ADDITIONAL_DETAILS, CLASS_TYPE_INPUT,REGISTERED_TIME) 
                                                                        SELECT FNAME, SNAME, AGE, ID_NUM, EMAIL, PHONE_NUMBER, WHATSAPP_NUMBER, EDU_LEVEL, UNIVERSITY, GARDUATED_YEAR, TEACHING_SINCE, AMOUNT_SUBJECTS, PASSWORD, CONFIRM_PASSWORD, ADDITIONAL_DETAILS, CLASS_TYPE_INPUT,DATE_TIME FROM teachers_under_review WHERE ID_NUM = '$id_num';";
                                                                
                                                                //Deleting the record from teachers_under_review table
                                                                $sql4 = "DELETE FROM teachers_under_review WHERE ID_NUM = '$id_num';";
                                                                
                                                                //Add currunt year to JOINED YEAR Column
                                                                $sql5 = "UPDATE teachers SET JOINED_YEAR = now() WHERE ID_NUM = '$id_num';";
                                                                
                                                                //Add currunt time to JOINED TIME Column
                                                                $sql6 = "UPDATE teachers SET JOINED_TIME = now() WHERE ID_NUM = '$id_num';";
                                                                
                                                                

                                                                $resultInsert = mysqli_query($conn, $sql3) ;
                                                                $resultInsert2 = mysqli_query($conn, $sql4) ;
                                                                $resultInsert3 = mysqli_query($conn, $sql5);
                                                                $resultInsert4 = mysqli_query($conn, $sql6);


                                                                if($resultInsert4 === TRUE){
                                                                    
                                                                    $sql16 = "SELECT FNAME, SNAME, EMAIL, REGISTERED_TIME, PHONE_NUMBER FROM teachers WHERE ID_NUM = '$id_num';";
                                                                    $resalt16 = mysqli_query($conn, $sql16);                   //get the resalt between $conn and, run $sql
                                                                    $resaltcheck16 = mysqli_num_rows($resalt16);
                                                                    $datas16 = array();
                                                                    if ($resaltcheck16 > 0) {
                                                                        while ($row16 = mysqli_fetch_assoc($resalt16)) {
                                                                        $datas16[] = $row16;
                                                                        }
                                                                        $fname_for_email = $datas16[0]['FNAME'];
                                                                        $sname_for_email = $datas16[0]['SNAME'];
                                                                        $email_for_email = $datas16[0]['EMAIL'];
                                                                        $registed_year_for_email = date("Y",strtotime($datas16[0]['REGISTERED_TIME']));
                                                                        $registed_month_for_email = date("m",strtotime($datas16[0]['REGISTERED_TIME']));
                                                                        $registed_day_for_email = date("d",strtotime($datas16[0]['REGISTERED_TIME']));
                                                                        $registed_hour_for_email = date("h",strtotime($datas16[0]['REGISTERED_TIME']));
                                                                        $registed_minute_for_email = date("i",strtotime($datas16[0]['REGISTERED_TIME']));
                                                                        $registed_am_pm_for_email = date("A",strtotime($datas16[0]['REGISTERED_TIME']));
                                                                        $phone_number_for_email = $datas16[0]['PHONE_NUMBER'];
                                                                        // echo $registed_year_for_email ."<br/>".$registed_month_for_email ."<br/>".$registed_day_for_email."<br/>".$registed_hour_for_email."<br/>".$registed_minute_for_email."<br/>".$registed_am_pm_for_email;
                                                                        
                                                                        $to = $email_for_email;
                                                                        $subject = "Edupara - Teachers Registeration";
                                                                        $sender = "contact@edupara.lk";
                                                                        $headers = "From: " . "Edupara Admins" . " <" . "contact@edupara.lk" . ">\n" ;
                                                                        $headers .= "MIME-Version: 1.0\n";
                                                                        $headers .= "Content-type: text/html; charset=utf-8\n";
                                                                        $headers .= "Return-Path: " . $sender . "\n";
                                                                        $headers .= "X-Mailer: PHP/" . phpversion();
                                                                        $txt = 
                                                                                "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
                                                                                <html xmlns='http://www.w3.org/1999/xhtml'>
                                                                                  <head>
                                                                                    <meta name='viewport' content='width=device-width, initial-scale=1.0' />
                                                                                    <meta name='x-apple-disable-message-reformatting' />
                                                                                    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
                                                                                    <meta name='color-scheme' content='light dark' />
                                                                                    <meta name='supported-color-schemes' content='light dark' />
                                                                                    <title></title>
                                                                                    <style type='text/css' rel='stylesheet' media='all'>
                                                                                    /* Base ------------------------------ */
                                                                                    
                                                                                    @import url('https://fonts.googleapis.com/css?family=Nunito+Sans:400,700&display=swap');
                                                                                    body {
                                                                                      width: 100% !important;
                                                                                      height: 100%;
                                                                                      margin: 0;
                                                                                      -webkit-text-size-adjust: none;
                                                                                    }
                                                                                    
                                                                                    a {
                                                                                      color: #3869D4;
                                                                                    }
                                                                                    
                                                                                    a img {
                                                                                      border: none;
                                                                                    }
                                                                                    
                                                                                    td {
                                                                                      word-break: break-word;
                                                                                    }
                                                                                    
                                                                                    .preheader {
                                                                                      display: none !important;
                                                                                      visibility: hidden;
                                                                                      mso-hide: all;
                                                                                      font-size: 1px;
                                                                                      line-height: 1px;
                                                                                      max-height: 0;
                                                                                      max-width: 0;
                                                                                      opacity: 0;
                                                                                      overflow: hidden;
                                                                                    }
                                                                                    /* Type ------------------------------ */
                                                                                    
                                                                                    body,
                                                                                    td,
                                                                                    th {
                                                                                      font-family: 'Nunito Sans', Helvetica, Arial, sans-serif;
                                                                                    }
                                                                                    
                                                                                    h1 {
                                                                                      margin-top: 0;
                                                                                      color: #333333;
                                                                                      font-size: 22px;
                                                                                      font-weight: bold;
                                                                                      text-align: left;
                                                                                    }
                                                                                    
                                                                                    h2 {
                                                                                      margin-top: 0;
                                                                                      color: #333333;
                                                                                      font-size: 16px;
                                                                                      font-weight: bold;
                                                                                      text-align: left;
                                                                                    }
                                                                                    
                                                                                    h3 {
                                                                                      margin-top: 0;
                                                                                      color: #333333;
                                                                                      font-size: 14px;
                                                                                      font-weight: bold;
                                                                                      text-align: left;
                                                                                    }
                                                                                    
                                                                                    td,
                                                                                    th {
                                                                                      font-size: 16px;
                                                                                    }
                                                                                    
                                                                                    p,
                                                                                    ul,
                                                                                    ol,
                                                                                    blockquote {
                                                                                      margin: .4em 0 1.1875em;
                                                                                      font-size: 16px;
                                                                                      line-height: 1.625;
                                                                                    }
                                                                                    
                                                                                    p.sub {
                                                                                      font-size: 13px;
                                                                                    }
                                                                                    /* Utilities ------------------------------ */
                                                                                    
                                                                                    .align-right {
                                                                                      text-align: right;
                                                                                    }
                                                                                    
                                                                                    .align-left {
                                                                                      text-align: left;
                                                                                    }
                                                                                    
                                                                                    .align-center {
                                                                                      text-align: center;
                                                                                    }
                                                                                    /* Buttons ------------------------------ */
                                                                                    
                                                                                    .button {
                                                                                      background-color: #3869D4;
                                                                                      border-top: 10px solid #3869D4;
                                                                                      border-right: 18px solid #3869D4;
                                                                                      border-bottom: 10px solid #3869D4;
                                                                                      border-left: 18px solid #3869D4;
                                                                                      display: inline-block;
                                                                                      color: #FFF;
                                                                                      text-decoration: none;
                                                                                      border-radius: 3px;
                                                                                      box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16);
                                                                                      -webkit-text-size-adjust: none;
                                                                                      box-sizing: border-box;
                                                                                    }
                                                                                    
                                                                                    .button--green {
                                                                                      background-color: #22BC66;
                                                                                      border-top: 10px solid #22BC66;
                                                                                      border-right: 18px solid #22BC66;
                                                                                      border-bottom: 10px solid #22BC66;
                                                                                      border-left: 18px solid #22BC66;
                                                                                    }
                                                                                    
                                                                                    .button--red {
                                                                                      background-color: #FF6136;
                                                                                      border-top: 10px solid #FF6136;
                                                                                      border-right: 18px solid #FF6136;
                                                                                      border-bottom: 10px solid #FF6136;
                                                                                      border-left: 18px solid #FF6136;
                                                                                    }
                                                                                    
                                                                                    @media only screen and (max-width: 500px) {
                                                                                      .button {
                                                                                        width: 100% !important;
                                                                                        text-align: center !important;
                                                                                      }
                                                                                    }
                                                                                    /* Attribute list ------------------------------ */
                                                                                    
                                                                                    .attributes {
                                                                                      margin: 0 0 21px;
                                                                                    }
                                                                                    
                                                                                    .attributes_content {
                                                                                      background-color: #F4F4F7;
                                                                                      padding: 16px;
                                                                                    }
                                                                                    
                                                                                    .attributes_item {
                                                                                      padding: 0;
                                                                                    }
                                                                                    /* Related Items ------------------------------ */
                                                                                    
                                                                                    .related {
                                                                                      width: 100%;
                                                                                      margin: 0;
                                                                                      padding: 25px 0 0 0;
                                                                                      -premailer-width: 100%;
                                                                                      -premailer-cellpadding: 0;
                                                                                      -premailer-cellspacing: 0;
                                                                                    }
                                                                                    
                                                                                    .related_item {
                                                                                      padding: 10px 0;
                                                                                      color: #CBCCCF;
                                                                                      font-size: 15px;
                                                                                      line-height: 18px;
                                                                                    }
                                                                                    
                                                                                    .related_item-title {
                                                                                      display: block;
                                                                                      margin: .5em 0 0;
                                                                                    }
                                                                                    
                                                                                    .related_item-thumb {
                                                                                      display: block;
                                                                                      padding-bottom: 10px;
                                                                                    }
                                                                                    
                                                                                    .related_heading {
                                                                                      border-top: 1px solid #CBCCCF;
                                                                                      text-align: center;
                                                                                      padding: 25px 0 10px;
                                                                                    }
                                                                                    /* Discount Code ------------------------------ */
                                                                                    
                                                                                    .discount {
                                                                                      width: 100%;
                                                                                      margin: 0;
                                                                                      padding: 24px;
                                                                                      -premailer-width: 100%;
                                                                                      -premailer-cellpadding: 0;
                                                                                      -premailer-cellspacing: 0;
                                                                                      background-color: #F4F4F7;
                                                                                      border: 2px dashed #CBCCCF;
                                                                                    }
                                                                                    
                                                                                    .discount_heading {
                                                                                      text-align: center;
                                                                                    }
                                                                                    
                                                                                    .discount_body {
                                                                                      text-align: center;
                                                                                      font-size: 15px;
                                                                                    }
                                                                                    /* Social Icons ------------------------------ */
                                                                                    
                                                                                    .social {
                                                                                      width: auto;
                                                                                    }
                                                                                    
                                                                                    .social td {
                                                                                      padding: 0;
                                                                                      width: auto;
                                                                                    }
                                                                                    
                                                                                    .social_icon {
                                                                                      height: 20px;
                                                                                      margin: 0 8px 10px 8px;
                                                                                      padding: 0;
                                                                                    }
                                                                                    /* Data table ------------------------------ */
                                                                                    
                                                                                    .purchase {
                                                                                      width: 100%;
                                                                                      margin: 0;
                                                                                      padding: 35px 0;
                                                                                      -premailer-width: 100%;
                                                                                      -premailer-cellpadding: 0;
                                                                                      -premailer-cellspacing: 0;
                                                                                    }
                                                                                    
                                                                                    .purchase_content {
                                                                                      width: 100%;
                                                                                      margin: 0;
                                                                                      padding: 25px 0 0 0;
                                                                                      -premailer-width: 100%;
                                                                                      -premailer-cellpadding: 0;
                                                                                      -premailer-cellspacing: 0;
                                                                                    }
                                                                                    
                                                                                    .purchase_item {
                                                                                      padding: 10px 0;
                                                                                      color: #51545E;
                                                                                      font-size: 15px;
                                                                                      line-height: 18px;
                                                                                    }
                                                                                    
                                                                                    .purchase_heading {
                                                                                      padding-bottom: 8px;
                                                                                      border-bottom: 1px solid #EAEAEC;
                                                                                    }
                                                                                    
                                                                                    .purchase_heading p {
                                                                                      margin: 0;
                                                                                      color: #85878E;
                                                                                      font-size: 12px;
                                                                                    }
                                                                                    
                                                                                    .purchase_footer {
                                                                                      padding-top: 15px;
                                                                                      border-top: 1px solid #EAEAEC;
                                                                                    }
                                                                                    
                                                                                    .purchase_total {
                                                                                      margin: 0;
                                                                                      text-align: right;
                                                                                      font-weight: bold;
                                                                                      color: #333333;
                                                                                    }
                                                                                    
                                                                                    .purchase_total--label {
                                                                                      padding: 0 15px 0 0;
                                                                                    }
                                                                                    
                                                                                    body {
                                                                                      background-color: #F4F4F7;
                                                                                      color: #51545E;
                                                                                    }
                                                                                    
                                                                                    p {
                                                                                      color: #51545E;
                                                                                    }
                                                                                    
                                                                                    p.sub {
                                                                                      color: #6B6E76;
                                                                                    }
                                                                                    
                                                                                    .email-wrapper {
                                                                                      width: 100%;
                                                                                      margin: 0;
                                                                                      padding: 0;
                                                                                      -premailer-width: 100%;
                                                                                      -premailer-cellpadding: 0;
                                                                                      -premailer-cellspacing: 0;
                                                                                      background-color: #F4F4F7;
                                                                                    }
                                                                                    
                                                                                    .email-content {
                                                                                      width: 100%;
                                                                                      margin: 0;
                                                                                      padding: 0;
                                                                                      -premailer-width: 100%;
                                                                                      -premailer-cellpadding: 0;
                                                                                      -premailer-cellspacing: 0;
                                                                                    }
                                                                                    /* Masthead ----------------------- */
                                                                                    
                                                                                    .email-masthead {
                                                                                      padding: 25px 0;
                                                                                      text-align: center;
                                                                                    }
                                                                                    
                                                                                    .email-masthead_logo {
                                                                                      width: 94px;
                                                                                    }
                                                                                    
                                                                                    .email-masthead_name {
                                                                                      font-size: 16px;
                                                                                      font-weight: bold;
                                                                                      color: #A8AAAF;
                                                                                      text-decoration: none;
                                                                                      text-shadow: 0 1px 0 white;
                                                                                    }
                                                                                    /* Body ------------------------------ */
                                                                                    
                                                                                    .email-body {
                                                                                      width: 100%;
                                                                                      margin: 0;
                                                                                      padding: 0;
                                                                                      -premailer-width: 100%;
                                                                                      -premailer-cellpadding: 0;
                                                                                      -premailer-cellspacing: 0;
                                                                                      background-color: #FFFFFF;
                                                                                    }
                                                                                    
                                                                                    .email-body_inner {
                                                                                      width: 570px;
                                                                                      margin: 0 auto;
                                                                                      padding: 0;
                                                                                      -premailer-width: 570px;
                                                                                      -premailer-cellpadding: 0;
                                                                                      -premailer-cellspacing: 0;
                                                                                      background-color: #FFFFFF;
                                                                                    }
                                                                                    
                                                                                    .email-footer {
                                                                                      width: 570px;
                                                                                      margin: 0 auto;
                                                                                      padding: 0;
                                                                                      -premailer-width: 570px;
                                                                                      -premailer-cellpadding: 0;
                                                                                      -premailer-cellspacing: 0;
                                                                                      text-align: center;
                                                                                    }
                                                                                    
                                                                                    .email-footer p {
                                                                                      color: #6B6E76;
                                                                                    }
                                                                                    
                                                                                    .body-action {
                                                                                      width: 100%;
                                                                                      margin: 30px auto;
                                                                                      padding: 0;
                                                                                      -premailer-width: 100%;
                                                                                      -premailer-cellpadding: 0;
                                                                                      -premailer-cellspacing: 0;
                                                                                      text-align: center;
                                                                                    }
                                                                                    
                                                                                    .body-sub {
                                                                                      margin-top: 25px;
                                                                                      padding-top: 25px;
                                                                                      border-top: 1px solid #EAEAEC;
                                                                                    }
                                                                                    
                                                                                    .content-cell {
                                                                                      padding: 35px;
                                                                                    }
                                                                                    /*Media Queries ------------------------------ */
                                                                                    
                                                                                    @media only screen and (max-width: 600px) {
                                                                                      .email-body_inner,
                                                                                      .email-footer {
                                                                                        width: 100% !important;
                                                                                      }
                                                                                    }
                                                                                    
                                                                                    @media (prefers-color-scheme: dark) {
                                                                                      body,
                                                                                      .email-body,
                                                                                      .email-body_inner,
                                                                                      .email-content,
                                                                                      .email-wrapper,
                                                                                      .email-masthead,
                                                                                      .email-footer {
                                                                                        background-color: #333333 !important;
                                                                                        color: #FFF !important;
                                                                                      }
                                                                                      p,
                                                                                      ul,
                                                                                      ol,
                                                                                      blockquote,
                                                                                      h1,
                                                                                      h2,
                                                                                      h3,
                                                                                      span,
                                                                                      .purchase_item {
                                                                                        color: #FFF !important;
                                                                                      }
                                                                                      .attributes_content,
                                                                                      .discount {
                                                                                        background-color: #222 !important;
                                                                                      }
                                                                                      .email-masthead_name {
                                                                                        text-shadow: none !important;
                                                                                      }
                                                                                    }
                                                                                    
                                                                                    :root {
                                                                                      color-scheme: light dark;
                                                                                      supported-color-schemes: light dark;
                                                                                    }
                                                                                    </style>
                                                                                    <!--[if mso]>
                                                                                    <style type='text/css'>
                                                                                      .f-fallback  {
                                                                                        font-family: Arial, sans-serif;
                                                                                      }
                                                                                    </style>
                                                                                  <![endif]-->
                                                                                  </head>
                                                                                  <body>
                                                                                    <span class='preheader'></span>
                                                                                    <table class='email-wrapper' width='100%' cellpadding='0' cellspacing='0' role='presentation'>
                                                                                      <tr>
                                                                                        <td align='center'>
                                                                                          <table class='email-content' width='100%' cellpadding='0' cellspacing='0' role='presentation'>
                                                                                            <tr>
                                                                                              <td class='email-masthead'>
                                                                                                <a href='#' class='f-fallback email-masthead_name'>
                                                                                                Teachers Login at Edupara
                                                                                              </a>
                                                                                              </td>
                                                                                            </tr>
                                                                                            <!-- Email Body -->
                                                                                            <tr>
                                                                                              <td class='email-body' width='100%' cellpadding='0' cellspacing='0'>
                                                                                                <table class='email-body_inner' align='center' width='570' cellpadding='0' cellspacing='0' role='presentation'>
                                                                                                  <!-- Body content -->
                                                                                                  <tr>
                                                                                                    <td class='content-cell'>
                                                                                                      <div class='f-fallback'>
                                                                                                        <h1>Hi $fname_for_email $sname_for_email,</h1>
                                                                                                        <p>You've requested at $registed_hour_for_email:$registed_minute_for_email $registed_am_pm_for_email on $registed_year_for_email/$registed_month_for_email/$registed_day_for_email to join as a Teacher at Edupara.<strong>We happily inform you that, we have selected you as a Teacher at Edupara.lk.</strong> Now you can log in to your account</p> 
                                                                                                        
                                                                                                        <!-- Action -->
                                                                                                        <table class='body-action' align='center' width='100%' cellpadding='0' cellspacing='0' role='presentation'>
                                                                                                          <tr>
                                                                                                            <td align='center'>
                                                                                                              <!-- Border based button
                                                                                           https://litmus.com/blog/a-guide-to-bulletproof-buttons-in-email-design -->
                                                                                                              <table width='100%' border='0' cellspacing='0' cellpadding='0' role='presentation'>
                                                                                                                <tr>
                                                                                                                  <td align='center'>
                                                                                                                    <a href='https://www.edupara.lk/Teachers%20login/Teachers_login.php?' class='f-fallback button button--green' target='_blank'>Click here to log in</a>
                                                                                                                  </td>
                                                                                                                </tr>
                                                                                                              </table>
                                                                                                            </td>
                                                                                                          </tr>
                                                                                                        </table>
                                                                                                        <p>To recover the account again, You have to use <i>$phone_number_for_email</i> as your mobile number. If you don't know how to log in to your account or if you have any other issues with the log in, <a href='https://www.edupara.lk/index/contact.php?' target='_blank'>contact us</a></p>
                                                                                                        <p>Thanks,
                                                                                                          <br>The Admin Team of Edupara</p>
                                                                                                        <!-- Sub copy -->
                                                                                                        
                                                                                                      </div>
                                                                                                    </td>
                                                                                                  </tr>
                                                                                                </table>
                                                                                              </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                              <td>
                                                                                                <table class='email-footer' align='center' width='570' cellpadding='0' cellspacing='0' role='presentation'>
                                                                                                  <tr>
                                                                                                    <td class='content-cell' align='center'>
                                                                                                      <p class='f-fallback sub align-center'>&copy; 2022 Edupara. All rights reserved.</p>
                                                                                                      <p class='f-fallback sub align-center'>
                                                                                                        Janith Dewapriya
                                                                                                        <br>Director of Edupara
                                                                                                        <br>&copy; 2022 Edupara Panel
                                                                                                      </p>
                                                                                                    </td>
                                                                                                  </tr>
                                                                                                </table>
                                                                                              </td>
                                                                                            </tr>
                                                                                          </table>
                                                                                        </td>
                                                                                      </tr>
                                                                                    </table>
                                                                                  </body>
                                                                                </html>";
                                                                        $mail_function = mail($to,$subject,$txt,$headers);
                                                                        if($mail_function == true){
                                                                            echo "<script>window.location.replace('admin_dashboard.php?')</script>";
                                                                        }else{
                                                                            echo "<script>alert('something went wrong with the email account');</script>";
                                                                        }
                                                                    }
                                                                }
                                                                  else{
                                                                      //echo "Error : ". $sql . "<br>" . $conn -> error;
                                                                          }
                                                            }
                                                               
                                                        
                                                        
                                                        ?>


                                                        <!-- <tr class="unread">
                                                            <td><img class="rounded-circle" style="width:40px;" src="assets/images/user/avatar-2.jpg" alt="activity-user"></td>
                                                            <td>
                                                                <h6 class="mb-1">Mathilde Andersen</h6>
                                                                <p class="m-0">Lorem Ipsum is simply text of…</p>
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted"><i class="fas fa-circle text-c-red f-10 m-r-15"></i>11 MAY 10:35</h6>
                                                            </td>
                                                            <td><a href="#!" class="label theme-bg2 text-white f-12">Reject</a><a href="#!" class="label theme-bg text-white f-12">Approve</a></td>
                                                        </tr>
                                                        <tr class="unread">
                                                            <td><img class="rounded-circle" style="width:40px;" src="assets/images/user/avatar-3.jpg" alt="activity-user"></td>
                                                            <td>
                                                                <h6 class="mb-1">Karla Sorensen</h6>
                                                                <p class="m-0">Lorem Ipsum is simply…</p>
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted"><i class="fas fa-circle text-c-green f-10 m-r-15"></i>9 MAY 17:38</h6>
                                                            </td>
                                                            <td><a href="#!" class="label theme-bg2 text-white f-12">Reject</a><a href="#!" class="label theme-bg text-white f-12">Approve</a></td>
                                                        </tr>
                                                        <tr class="unread">
                                                            <td><img class="rounded-circle" style="width:40px;" src="assets/images/user/avatar-1.jpg" alt="activity-user"></td>
                                                            <td>
                                                                <h6 class="mb-1">Ida Jorgensen</h6>
                                                                <p class="m-0">Lorem Ipsum is simply text of…</p>
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted f-w-300"><i class="fas fa-circle text-c-red f-10 m-r-15"></i>19 MAY 12:56</h6>
                                                            </td>
                                                            <td><a href="#!" class="label theme-bg2 text-white f-12">Reject</a><a href="#!" class="label theme-bg text-white f-12">Approve</a></td>
                                                        </tr>
                                                        <tr class="unread">
                                                            <td><img class="rounded-circle" style="width:40px;" src="assets/images/user/avatar-2.jpg" alt="activity-user"></td>
                                                            <td>
                                                                <h6 class="mb-1">Albert Andersen</h6>
                                                                <p class="m-0">Lorem Ipsum is simply dummy…</p>
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted"><i class="fas fa-circle text-c-green f-10 m-r-15"></i>21 July 12:56</h6>
                                                            </td>
                                                            <td><a href="#!" class="label theme-bg2 text-white f-12">Reject</a><a href="#!" class="label theme-bg text-white f-12">Approve</a></td>
                                                        </tr> -->
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--[ Recent Users ] end-->

                                <!-- [ statistics year chart ] start -->
                                <div class="col-xl-4 col-md-6">
                                    <div class="card card-event">
                                        <div class="card-block">
                                            <div class="row align-items-center justify-content-center">
                                                <div class="col">
                                                    <h5 class="m-0">Total Ads on Edupara</h5>
                                                </div>
                                                <div class="col-auto">
                                                    <label class="label theme-bg2 text-white f-14 f-w-400 float-right"><?php date_default_timezone_set("Asia/Colombo"); echo date("h:i a"); ?></label>
                                                </div>
                                            </div>
                                            <h2 class="mt-3 f-w-300"><?php echo $count_of_ads; ?><sub class="text-muted f-14"> &nbsp; has posted already</sub></h2>
                                            <h6 class="text-muted mt-4 mb-0">You can see all Analytics </h6>
                                            <i class="fab fa-angellist text-c-purple f-50"></i>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-block border-bottom">
                                            <div class="row d-flex align-items-center">
                                                <div class="col-auto">
                                                    <i class="feather icon-server f-30 text-c-green"></i>
                                                </div>
                                                <div class="col">
                                                    <h3 class="f-w-300">25 +</h3>
                                                    <span class="d-block text-uppercase">TOTAL SUBJETS</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-block">
                                            <div class="row d-flex align-items-center">
                                                <div class="col-auto">
                                                    <i class="feather icon-map-pin f-30 text-c-blue"></i>
                                                </div>
                                                <div class="col">
                                                    <h3 class="f-w-300">200 +</h3>
                                                    <span class="d-block text-uppercase">Districts and Cities</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- [ statistics year chart ] end -->
                                <!--[social-media section] start-->
                                <!-- <div class="col-md-12 col-xl-4">
                                    <div class="card card-social">
                                        <div class="card-block border-bottom">
                                            <div class="row align-items-center justify-content-center">
                                                <div class="col-auto">
                                                    <i class="fab fa-facebook-f text-primary f-36"></i>
                                                </div>
                                                <div class="col text-right">
                                                    <h3>12,281</h3>
                                                    <h5 class="text-c-green mb-0">+7.2% <span class="text-muted">Total Likes</span></h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-block">
                                            <div class="row align-items-center justify-content-center card-active">
                                                <div class="col-6">
                                                    <h6 class="text-center m-b-10"><span class="text-muted m-r-5">Target:</span>35,098</h6>
                                                    <div class="progress">
                                                        <div class="progress-bar progress-c-theme" role="progressbar" style="width:60%;height:6px;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <h6 class="text-center  m-b-10"><span class="text-muted m-r-5">Duration:</span>3,539</h6>
                                                    <div class="progress">
                                                        <div class="progress-bar progress-c-theme2" role="progressbar" style="width:45%;height:6px;" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <div class="card card-social">
                                        <div class="card-block border-bottom">
                                            <div class="row align-items-center justify-content-center">
                                                <div class="col-auto">
                                                    <i class="fab fa-twitter text-c-blue f-36"></i>
                                                </div>
                                                <div class="col text-right">
                                                    <h3>11,200</h3>
                                                    <h5 class="text-c-purple mb-0">+6.2% <span class="text-muted">Total Likes</span></h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-block">
                                            <div class="row align-items-center justify-content-center card-active">
                                                <div class="col-6">
                                                    <h6 class="text-center m-b-10"><span class="text-muted m-r-5">Target:</span>34,185</h6>
                                                    <div class="progress">
                                                        <div class="progress-bar progress-c-green" role="progressbar" style="width:40%;height:6px;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <h6 class="text-center  m-b-10"><span class="text-muted m-r-5">Duration:</span>4,567</h6>
                                                    <div class="progress">
                                                        <div class="progress-bar progress-c-blue" role="progressbar" style="width:70%;height:6px;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <div class="card card-social">
                                        <div class="card-block border-bottom">
                                            <div class="row align-items-center justify-content-center">
                                                <div class="col-auto">
                                                    <i class="fab fa-google-plus-g text-c-red f-36"></i>
                                                </div>
                                                <div class="col text-right">
                                                    <h3>10,500</h3>
                                                    <h5 class="text-c-blue mb-0">+5.9% <span class="text-muted">Total Likes</span></h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-block">
                                            <div class="row align-items-center justify-content-center card-active">
                                                <div class="col-6">
                                                    <h6 class="text-center m-b-10"><span class="text-muted m-r-5">Target:</span>25,998</h6>
                                                    <div class="progress">
                                                        <div class="progress-bar progress-c-theme" role="progressbar" style="width:80%;height:6px;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <h6 class="text-center  m-b-10"><span class="text-muted m-r-5">Duration:</span>7,753</h6>
                                                    <div class="progress">
                                                        <div class="progress-bar progress-c-theme2" role="progressbar" style="width:50%;height:6px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <!--[social-media section] end-->
                                <!-- [ rating list ] starts-->
                                <div class="col-xl-4 col-md-6">
                                    <div class="card user-list">
                                        <div class="card-header">
                                            <h5>cPannel Limitations</h5>
                                        </div>
                                        <div class="card-block">
                                            <div class="row align-items-center justify-content-center m-b-20">
                                                <div class="col-6">
                                                    <h2 class="f-w-300 d-flex align-items-center float-left m-0">2GB</h2>
                                                </div>
                                                <div class="col-6">
                                                    <h6 class="d-flex  align-items-center float-right m-0">v3.0 </h6>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <h6 class="align-items-center float-left">Up Time</h6>
                                                    <h6 class="align-items-center float-right">99.99%</h6>
                                                    <div class="progress m-t-30  m-b-20" style="height: 6px;">
                                                        <div class="progress-bar" role="progressbar" style="width:99%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <h6 class="align-items-center float-left">Databases</h6>
                                                    <h6 class="align-items-center float-right">8</h6>
                                                    <div class="progress m-t-30 m-b-20" style="height: 6px;">
                                                        <div class="progress-bar progress-c-theme" role="progressbar" style="width: 80%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <h6 class="align-items-center float-left">Storage</h6>
                                                    <h6 class="align-items-center float-right">504 MB</h6>
                                                    <div class="progress m-t-30  m-b-20" style="height: 6px;">
                                                        <div class="progress-bar progress-c-theme" role="progressbar" style="width: 25%;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <h6 class="align-items-center float-left">Bandwidth</h6>
                                                    <h6 class="align-items-center float-right">24 Mbps</h6>
                                                    <div class="progress m-t-30  m-b-20" style="height: 6px;">
                                                        <div class="progress-bar progress-c-theme" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <h6 class="align-items-center float-left">Email Per Hour</h6>
                                                    <h6 class="align-items-center float-right">100</h6>
                                                    <div class="progress m-t-30  m-b-20" style="height: 6px;">
                                                        <div class="progress-bar progress-c-theme" role="progressbar" style="width: 0%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- [ rating list ] end-->
                                <div class="col-xl-8 col-md-12 m-b-30">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">Today</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link active show" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">This Week</a>
                                        </li>
                                        <li class="nav-item">
                                            <!-- <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="true">All</a> -->
                                            <a class="nav-link" id="contact-tab"  href="./bc_tabs.php?" role="tab" aria-controls="contact" aria-selected="true">All</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Full Name</th>
                                                        <th>Email</th>
                                                        <th>Time</th>
                                                        <th>City</th>
                                                        <th class="text-right"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                <?php
                                                    $sql13 = "SELECT S_ID, EMAIL, FULL_NAME, GRADE, DISTRICT, CITY, CONTACT_NUMBER, WHATSAPP_NUMBER, PASSWORD, CONFIRM_PASSWORD, RESGISTED_DATE_TIME FROM students;";
                                                    $resalt13 = mysqli_query($conn, $sql13);                   //get the resalt between $conn and, run $sql
                                                    $resaltcheck13 = mysqli_num_rows($resalt13);
                                                    $datas13 = array();
                                                    if ($resaltcheck13 > 0) {
                                                    while ($row13 = mysqli_fetch_assoc($resalt13)) {
                                                        $datas13[] = $row13;
                                                    }
                                                        for ($j=0; $j < count($datas13); $j++) { 
                                                            $students_full_name = $datas13[$j]['FULL_NAME'];
                                                            $students_email = $datas13[$j]['EMAIL'];
                                                            $students_city = $datas13[$j]['CITY'];
                                                            $students_sId = $datas13[$j]['S_ID'];
                                                            
                                                            $student_regiered_time = $datas13[$j]['RESGISTED_DATE_TIME'];
                                                            if($student_regiered_time != NULL){
                                                                $student_regiered_time = strtotime($student_regiered_time);
                                                                $registed_date = date('Y/m/d', $student_regiered_time);
                                                                $registed_time = date('H:i A', $student_regiered_time);

                                                                $FirstDay = date("Y/m/d", strtotime('sunday last week'));  
                                                                $LastDay = date("Y/m/d", strtotime('sunday this week')); 
                                                                
                                                                // echo $registed_date."&nbsp &nbsp".$registed_time."<br/>";
                                                                
                                                                $today = date("Y/m/d");
                                                                if($registed_date == $today){
                                                                    echo 
                                                                        "<tr>
                                                                            <td>
                                                                                <h6 class='m-0'><img class='rounded-circle  m-r-10' style='width:40px;' src='assets/images/user/avatar-2.jpg' alt='activity-user'>$students_full_name</h6>
                                                                            </td>
                                                                            <td>
                                                                                <h6 class='m-0'>$students_email</h6>
                                                                            </td>
                                                                            <td>
                                                                                <h6 class='m-0'>$registed_time</h6>
                                                                            </td>
                                                                            <td>
                                                                                <h6 class='m-0'>$students_city</h6>
                                                                            </td>
                                                                            <td class='text-right'>$students_sId</td>
                                                                        </tr>";
                                                                
                                                                }

                                                                
                                                                
                                                                
                                                            }
                                                            
                                                        }
                                                        
                                                    }
                                                                    
                                                ?>

                                                </tbody>
                                            </table>
                                        </div>
                                                                
                                                                

                                    
                                                                    
                
                                                                    
                
                                        <div class='tab-pane fade active show' id='profile' role='tabpanel' aria-labelledby='profile-tab'>
                                            <table class='table table-hover'>
                                                <thead>
                                                    <tr>
                                                        <th>Full Name</th>
                                                        <th>Email</th>
                                                        <th>Time</th>
                                                        <th>City</th>
                                                        <th class='text-right'></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                    $sql14 = "SELECT S_ID, EMAIL, FULL_NAME, GRADE, DISTRICT, CITY, CONTACT_NUMBER, WHATSAPP_NUMBER, PASSWORD, CONFIRM_PASSWORD, RESGISTED_DATE_TIME FROM students;";
                                                    $resalt14 = mysqli_query($conn, $sql14);                   //get the resalt between $conn and, run $sql
                                                    $resaltcheck14 = mysqli_num_rows($resalt14);
                                                    $datas14 = array();
                                                    if ($resaltcheck14 > 0) {
                                                    while ($row14 = mysqli_fetch_assoc($resalt14)) {
                                                        $datas14[] = $row14;
                                                    }
                                                        for ($j=0; $j < count($datas14); $j++) { 
                                                            $students_full_name = $datas14[$j]['FULL_NAME'];
                                                            $students_email = $datas14[$j]['EMAIL'];
                                                            $students_city = $datas14[$j]['CITY'];
                                                            $students_sId = $datas14[$j]['S_ID'];
                                                            
                                                            $student_regiered_time = $datas14[$j]['RESGISTED_DATE_TIME'];
                                                            if($student_regiered_time != NULL){
                                                                $student_regiered_time = strtotime($student_regiered_time);
                                                                $registed_date = date('Y/m/d', $student_regiered_time);
                                                                $registed_time = date('H:i A', $student_regiered_time);

                                                                $FirstDay = date("Y/m/d", strtotime('sunday last week'));  
                                                                $LastDay = date("Y/m/d", strtotime('sunday this week')); 
                                                                
                                                                // echo $registed_date."&nbsp &nbsp".$registed_time."<br/>";
                                                                
                                                                $today = date("Y/m/d");
                                                                if($today > $FirstDay && $today < $LastDay){
                                                                    echo 
                                                                        "<tr>
                                                                            <td>
                                                                                <h6 class='m-0'><img class='rounded-circle  m-r-10' style='width:40px;' src='assets/images/user/avatar-2.jpg' alt='activity-user'>$students_full_name</h6>
                                                                            </td>
                                                                            <td>
                                                                                <h6 class='m-0'>$students_email</h6>
                                                                            </td>
                                                                            <td>
                                                                                <h6 class='m-0'>$registed_time</h6>
                                                                            </td>
                                                                            <td>
                                                                                <h6 class='m-0'>$students_city</h6>
                                                                            </td>
                                                                            <td class='text-right'>$students_sId</td>
                                                                        </tr>";
                                                                
                                                                }

                                                                
                                                                
                                                                
                                                            }
                                                            
                                                        }
                                                        
                                                    }
                                                                    
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                                                    

                                                     
                                                    

                                                     
                                                     
                                                     
                                                     
                                                     
                                                     
                                                     
                                        
                                    </div>
                                </div>

                            </div>
                            <!-- [ Main Content ] end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->

    <!-- Warning Section Starts -->
    <!-- Older IE warning message -->
    <!--[if lt IE 11]>
        <div class="ie-warning">
            <h1>Warning!!</h1>
            <p>You are using an outdated version of Internet Explorer, please upgrade
               <br/>to any of the following web browsers to access this website.
            </p>
            <div class="iew-container">
                <ul class="iew-download">
                    <li>
                        <a href="http://www.google.com/chrome/">
                            <img src="assets/images/browser/chrome.png" alt="Chrome">
                            <div>Chrome</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.mozilla.org/en-US/firefox/new/">
                            <img src="assets/images/browser/firefox.png" alt="Firefox">
                            <div>Firefox</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://www.opera.com">
                            <img src="assets/images/browser/opera.png" alt="Opera">
                            <div>Opera</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.apple.com/safari/">
                            <img src="assets/images/browser/safari.png" alt="Safari">
                            <div>Safari</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                            <img src="assets/images/browser/ie.png" alt="">
                            <div>IE (11 & above)</div>
                        </a>
                    </li>
                </ul>
            </div>
            <p>Sorry for the inconvenience!</p>
        </div>
    <![endif]-->
    <!-- Warning Section Ends -->

    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>



</body>
</html>



 





<!-------------------------------BOOTBOX------------------------------------------->
<script type='text/javascript' src='assets/js/jquery-1.10.2.min.js'></script>               <!-- Load jQuery -->
<script type='text/javascript' src='assets/js/jqueryui-1.10.3.min.js'></script>               <!-- Load jQueryUI -->
<script type='text/javascript' src='assets/js/bootstrap.min.js'></script>                 <!-- Load Bootstrap -->
<script type='text/javascript' src='assets/js/enquire.min.js'></script> <!-- Load Enquire -->

<script type='text/javascript' src='assets/plugins/bootbox/bootbox.js'></script>  <!-- Bootbox -->
<script type='text/javascript' src='assets/demo/demo-modals.js'></script>

<script>
    var fired_button;
    $("#reject").click(function() {
        fired_button = $(this).val();
        //alert(fired_button);
    });


    $(document).on('click', '.show-alert', function(e) {
        bootbox.confirm('This subject is going to remove from your table!', function(result){ 
            
            if (result === null) {
                //prompt dismiss
            } else {
                if(result === true){
                    window.location.replace('tables-editable.php?delete=' + fired_button);
                    
                    
                    
            }   else{
                //else where
                }
            }
            
            
        
        });
    
        
    });
    </script>