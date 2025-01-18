<?php
error_reporting(E_ERROR | E_PARSE); //Hiding all error messages.




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

//echo "Connection Successful";	

$email_from_post = $_GET['email'];
$password_from_post = $_GET['password'];


//Counting the amount of subject columns
$sql7 = "SELECT COUNT(COLUMN_NAME) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = N'time_table_of_teachers' and COLUMN_NAME LIKE 'GRADE__%';";
$resalt7 = mysqli_query($conn, $sql7);                 
$resaltcheck7 = mysqli_num_rows(mysqli_query($conn, $sql7));
$datas7 = array();
if ($resaltcheck7 > 0) {
  while ($row7 = mysqli_fetch_assoc($resalt7)) {
    $datas7[] = $row7;
  }
  $count_of_subject_columns = $datas7[0]['COUNT(COLUMN_NAME)'];
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edupara Admins |Edupara.lk</title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Datta Able Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords" content="admin templates, bootstrap admin templates, bootstrap 4, dashboard, dashboard templets, sass admin templets, html admin templates, responsive, bootstrap admin templates free download,premium bootstrap admin templates, datta able, datta able bootstrap admin template, free admin theme, free dashboard template"/>
    <meta name="author" content="CodedThemes"/>

    <!-- Favicon icon -->
    <link rel="icon" href="../../index/img/core-img/favicon.ico" type="image/x-icon">
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <!-- animation css -->
    <link rel="stylesheet" href="assets/plugins/animation/css/animate.min.css">
    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link type="text/css" href="assets/fonts/themify-icons/themify-icons.css" rel="stylesheet">              <!-- Themify Icons -->

    




    <style>
        .widget-26 {
            color: #3c4142;
            font-weight: 400;
            }

            .widget-26 tr:first-child td {
            border: 0;
            }

            .widget-26 .widget-26-job-emp-img img {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            }

            .widget-26 .widget-26-job-title {
            min-width: 200px;
            }

            .widget-26 .widget-26-job-title a {
            font-weight: 400;
            font-size: 0.875rem;
            color: #3c4142;
            line-height: 1.5;
            }

            .widget-26 .widget-26-job-title a:hover {
            color: #68CBD7;
            text-decoration: none;
            }

            .widget-26 .widget-26-job-title .employer-name {
            margin: 0;
            line-height: 1.5;
            font-weight: 400;
            color: #3c4142;
            font-size: 0.8125rem;
            color: #3c4142;
            }

            .widget-26 .widget-26-job-title .employer-name:hover {
            color: #68CBD7;
            text-decoration: none;
            }

            .widget-26 .widget-26-job-title .time {
            font-size: 12px;
            font-weight: 400;
            }

            .widget-26 .widget-26-job-info {
            min-width: 100px;
            font-weight: 400;
            }

            .widget-26 .widget-26-job-info p {
            line-height: 1.5;
            color: #3c4142;
            font-size: 0.8125rem;
            }

            .widget-26 .widget-26-job-info .location {
            color: #3c4142;
            }

            .widget-26 .widget-26-job-salary {
            min-width: 70px;
            font-weight: 400;
            color: #3c4142;
            font-size: 0.8125rem;
            }

            .widget-26 .widget-26-job-category {
            padding: .5rem;
            display: inline-flex;
            white-space: nowrap;
            border-radius: 15px;
            }

            .widget-26 .widget-26-job-category .indicator {
            width: 13px;
            height: 13px;
            margin-right: .5rem;
            float: left;
            border-radius: 50%;
            }

            .widget-26 .widget-26-job-category span {
            font-size: 0.8125rem;
            color: #3c4142;
            font-weight: 600;
            }

            .widget-26 .widget-26-job-starred svg {
            width: 20px;
            height: 20px;
            color: #fd8b2c;
            }

            .widget-26 .widget-26-job-starred svg.starred {
            fill: #fd8b2c;
            }
            .bg-soft-base {
            background-color: #e1f5f7;
            }
            .bg-soft-warning {
                background-color: #fff4e1;
            }
            .bg-soft-success {
                background-color: #d1f6f2;
            }
            .bg-soft-danger {
                background-color: #fedce0;
            }
            .bg-soft-info {
                background-color: #d7efff;
            }


            .search-form {
            width: 80%;
            margin: 0 auto;
            margin-top: 1rem;
            }

            .search-form input {
            height: 100%;
            background: transparent;
            border: 0;
            display: block;
            width: 100%;
            padding: 1rem;
            height: 100%;
            font-size: 1rem;
            }

            .search-form select {
            background: transparent;
            
            border: 0;
            padding: .7rem;
            height: 100%;
            font-size: 1rem;
            
            }

            .search-form select:focus {
            border: 0;
            }

            .search-form button {
            height: 100%;
            width: 100%;
            font-size: 1rem;
            }

            .search-form button svg {
            width: 24px;
            height: 24px;
            }

            .search-body {
            margin-bottom: 1.5rem;
            }

            .search-body .search-filters .filter-list {
            margin-bottom: 1.3rem;
            }

            .search-body .search-filters .filter-list .title {
            color: #3c4142;
            margin-bottom: 1rem;
            }

            .search-body .search-filters .filter-list .filter-text {
            color: #727686;
            }

            .search-body .search-result .result-header {
            margin-bottom: 2rem;
            }

            .search-body .search-result .result-header .records {
            color: #3c4142;
            }

            .search-body .search-result .result-header .result-actions {
            text-align: right;
            display: flex;
            align-items: center;
            justify-content: space-between;
            }

            .search-body .search-result .result-header .result-actions .result-sorting {
            display: flex;
            align-items: center;
            }

            .search-body .search-result .result-header .result-actions .result-sorting span {
            flex-shrink: 0;
            font-size: 0.8125rem;
            }

            .search-body .search-result .result-header .result-actions .result-sorting select {
            color: #68CBD7;
            }

            .search-body .search-result .result-header .result-actions .result-sorting select option {
            color: #3c4142;
            }

            @media (min-width: 768px) and (max-width: 991.98px) {
            .search-body .search-filters {
                display: flex;
            }
            .search-body .search-filters .filter-list {
                margin-right: 1rem;
            }
            }

            .card-margin {
                margin-bottom: 1.875rem;
            }

            @media (min-width: 992px){
            .col-lg-2 {
                flex: 0 0 16.66667%;
                max-width: 16.66667%;
            }
            }

            .card-margin {
                margin-bottom: 1.875rem;
            }
            .card {
                border: 0;
                box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
                -webkit-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
                -moz-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
                -ms-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
            }
            .card {
                position: relative;
                display: flex;
                flex-direction: column;
                min-width: 0;
                word-wrap: break-word;
                background-color: #ffffff;
                background-clip: border-box;
                border: 1px solid #e6e4e9;
                border-radius: 8px;
            }
    </style>

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
                    <div class="page-header">
                        <div class="page-block">
                            <div class="row align-items-center">
                                <div class="col-md-12">
                                    <div class="page-header-title">
                                        <h5 class="m-b-10">Teachers</h5>
                                    </div>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                                        <li class="breadcrumb-item"><a href="javascript:">Manage</a></li>
                                        <li class="breadcrumb-item"><a href="javascript:">Teachers</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- [ breadcrumb ] end -->
                    <div class="main-body">
                        <div class="page-wrapper">
                            <!-- [ Main Content ] start -->
                            <div class="row">
                                


                            <?php
                            
                                $sql = "SELECT *
                                        FROM time_table_of_teachers
                                        WHERE T_ID = (SELECT T_ID FROM teachers WHERE EMAIL='$email_from_post' and PASSWORD='$password_from_post');";

                                
                                $sql2 = "SELECT SUBJECTS_ON_DATABASE FROM teachers WHERE EMAIL = '$email_from_post' and PASSWORD = '$password_from_post';";

                                $resalt = mysqli_query($conn,$sql);					         //get the resalt between $conn and, run $sql	
                                $resaltcheck = mysqli_num_rows($resalt);
                                $datas = array();

                                $resalt2 = mysqli_query($conn,$sql2);					         //get the resalt between $conn and, run $sql	
                                $resaltcheck2 = mysqli_num_rows($resalt2);
                                $datas2 = array();


                                if ($resaltcheck > 0) {
                                    while ($row = mysqli_fetch_assoc($resalt)){
                                        
                                        $datas[] = $row;  }
                                    }
                                

                                if ($resaltcheck2 > 0) {
                                    while ($row2 = mysqli_fetch_assoc($resalt2)){
                                        
                                        $datas2[] = $row2;  }
                                    }

                                
                                    
                                    //print_r($datas);
                                    //print_r($datas2);

                                    $subjects_on_database = $datas2[0]['SUBJECTS_ON_DATABASE'];

                                    for ($i=1; $i < $subjects_on_database+1; $i++) { 
                                        
                                    
                                    
                                    $t_id = $datas[0]['T_ID'];
                                    $grade = $datas[0]["GRADE__$i"];
                                    $subject = $datas[0]["SUBJECT__$i"];
                                    $batch = $datas[0]["BATCH__$i"];
                                    $class_date = $datas[0]["CLASS_DATE__$i"];
                                    $class_begin = $datas[0]["CLASS_BEGIN__$i"];
                                    $class_end = $datas[0]["CLASS_END__$i"];
                                    $how_class_do = $datas[0]["HOW_CLASS_DO__$i"];
                                    $district = $datas[0]["DISTRICT__$i"];
                                    $institute = $datas[0]["INSTITUTE__$i"];
                                    $languages = $datas[0]["LANGUAGES__$i"];
                                    $class_type = $datas[0]["CLASS_TYPE__$i"];



                            
                            if($grade != NULL){
                               echo
                                "<div class='col-xl-12'>
                                    <div class='card'>
                                        <div class='card-header'>
                                            <h5>No $i Subject Informations</h5>
                                           
                                        </div>
                                        <div class='card-block table-border-style'>
                                            <div class='table-responsive'>
                                                <table class='table table-striped'>
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Grade</th>
                                                            <th>Subject</th>
                                                            <th>Batch</th>
                                                            <th>Date</th>
                                                            <th>Time</th>
                                                            <th>How classes do</th>
                                                            <th>District</th>
                                                            <th>Institute</th>
                                                            <th>Medium</th>
                                                            <th>Class type</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th scope='row'>$i</th>
                                                            <td>$grade</td>
                                                            <td>$subject</td>
                                                            <td>$batch</td>
                                                            <td>$class_date</td>
                                                            <td>Begin at : $class_begin <br/><br/>End at : $class_end</td>
                                                            <td>$how_class_do</td>
                                                            <td>$district</td>
                                                            <td>$institute</td>
                                                            <td>$languages</td>
                                                            <td>$class_type</td>
                                                            
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>";
                              
                                    }
                            }
                                ?>

                            </div>
                            <!-- [ Main Content ] end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
