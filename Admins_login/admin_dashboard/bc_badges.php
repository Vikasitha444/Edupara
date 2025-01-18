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

//echo "Connection Successful";	

?>



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

    <!-- embeding jquery -->
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>

    <!-- typehead starts here -->
        <link href="assets/plugins/jquery/typehead/jquerysctipttop.css" rel="stylesheet" type="text/css">
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous"> -->
        <link href="assets/plugins/jquery/typehead/jquery.flexdatalist.css" rel="stylesheet" type="text/css">
    <!-- typehead ends here -->

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
                                        <li class="breadcrumb-item"><a href="./admin_dashboard.php?"><i class="feather icon-home"></i></a></li>
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
                                
                            
                            
                            
                            
                            <!-- [ badge ] start -->
                    
                            
                                                    
                                

                            


                          <div class='container'>
                                    <div class='row'>
                                        <div class='col-lg-12 card-margin'>
                                            <div class='card search-form'>
                                                <div class='card-body p-0'>
                                                    <form id='search-form' method="POST" action="bc_badges.php?">
                                                        <div class='row'>
                                                            <div class='col-12'>
                                                                <div class='row no-gutters'>
                                                                    <div class='col-lg-3 col-md-3 col-sm-12 p-0'>
                                                                    <select class="form-control column_list" id="exampleFormControlSelect1" name="column_selection">

                                                                    <?php
                                                                        ini_set('display_errors', '1');
                                                                        ini_set('display_startup_errors', '1');
                                                                        error_reporting(E_ALL);
                                                                        
                                                                        //Connect the Database'
                                                                        //Change to the server database
                                                                        //$conn = new mysqli($server,$username,$password,$database);
                                                                        $conn = new mysqli($server_db,$username_db,$password_db,$database_name_db);


                                                                        //Check the Connection was Sussesfull
                                                                        if ($conn->connect_error){
                                                                            die."Connection Interuppted";
                                                                        }

                                                                        //echo "Connection Successful";							//Eneble this if Database not Successfuly Connected


                                                                        $sql = "SHOW COLUMNS FROM eduparal_MAIN_DATABASE.teachers;";

                                                                        $resalt = mysqli_query($conn,$sql);					   
                                                                        //get the resalt between $conn and, run $sql	
                                                                        $resaltcheck = mysqli_num_rows($resalt);
                                                                        $datas = array();


                                                                        if ($resaltcheck > 0) {
                                                                            while ($row = mysqli_fetch_assoc($resalt)){
                                                                            //echo $row['Image'];
                                                                            $datas[] = $row;  }


                                                                            //print_r($datas);
                                                                            $number_of_columns = count($datas);
                                                                            
                                                                            for ($i=0; $i < $number_of_columns ; $i++) { 
                                                                                $column_name =  $datas[$i]['Field'];
                                                                                echo "<option value='$column_name'>$column_name</option>";

                                                                            }
                                                                        
                                                                        }
                                                                        
                                                                            
                                                                echo "</select>
                                                                        </div>
                                                                        

                                                                        
                                                                        <div class='col-lg-8 col-md-6 col-sm-12 p-0'>
                                                                            <input type='text' placeholder='Search...' class='flexdatalist form-control' data-min-length='1' list='skills' id='search' name='search'>
                                                                    </div>
                                                                            <div class='col-lg-1 col-md-3 col-sm-12 p-0'>
                                                                                <button type='submit' class='btn btn-base' name='search_button'>
                                                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-search'><circle cx='11' cy='11' r='8'></circle><line x1='21' y1='21' x2='16.65' y2='16.65'></line></svg>
                                                                                </button>
                                                                        

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='row'>
                                            <div class='col-12'>
                                                <div class='card card-margin'>
                                                    <div class='card-body'>
                                                        <div class='row search-body'>
                                                            <div class='col-lg-12'>
                                                                <div class='search-result'>
                                                                    <div class='result-header'>
                                                                        <div class='row'>";

                                                                        if(isset($_POST['search_button'])){
                                                                            $column_selection = $_POST['column_selection'];
                                                                            $search_query = $_POST['search'];

                                                                            if($column_selection == "T_ID" || $column_selection == "Age"){
                                                                                $sql = "SELECT T_ID, FNAME, SNAME, AGE, ID_NUM, EMAIL, PHONE_NUMBER, WHATSAPP_NUMBER, EDU_LEVEL, UNIVERSITY, GARDUATED_YEAR, TEACHING_SINCE, AMOUNT_SUBJECTS, PASSWORD, CONFIRM_PASSWORD, ADDITIONAL_DETAILS, CLASS_TYPE_INPUT,REGISTERED_TIME, JOINED_YEAR, JOINED_TIME FROM teachers WHERE $column_selection = '$search_query';";
                                                                            }
    
                                                                            else{
                                                                                $sql = "SELECT T_ID, FNAME, SNAME, AGE, ID_NUM, EMAIL, PHONE_NUMBER, WHATSAPP_NUMBER, EDU_LEVEL, UNIVERSITY, GARDUATED_YEAR, TEACHING_SINCE, AMOUNT_SUBJECTS, PASSWORD, CONFIRM_PASSWORD, ADDITIONAL_DETAILS, CLASS_TYPE_INPUT,REGISTERED_TIME, JOINED_YEAR, JOINED_TIME FROM teachers WHERE $column_selection LIKE '%$search_query%';";
                                                                            }
                                                                        
                                                                        }else{
                                                                            $sql = "SELECT * FROM teachers;";
                                                                        }

                                                                        
                                                                        
                                                                        
                                                                        //$sql = "SELECT COUNT(*) FROM teachers;";

                                                                        $resalt = mysqli_query($conn,$sql);					         //get the resalt between $conn and, run $sql	
                                                                        $resaltcheck = mysqli_num_rows($resalt);
                                                                        $datas = array();

                                                                        if ($resaltcheck > 0) {
                                                                            while ($row = mysqli_fetch_assoc($resalt)){
                                                                              //echo $row['Image'];
                                                                              $datas[] = $row;  }

                                                                              $amount_of_results = count($datas);

                                                                                  echo "<div class='col-lg-6'>
                                                                                            <div class='records'>Showing: <b>$amount_of_results</b> results</div>
                                                                                        </div>";
                                                                        }else{
                                                                            echo "<div class='col-lg-6'>
                                                                                            <div class='records'>Showing: <b>0</b> results</div>
                                                                                        </div>";
                                                                        }  

                                                                            
                                                                            
                                                                            
                                                                        echo"<div class='col-lg-6'>
                                                                                <div class='result-actions'>
                                                                                    <div class='result-sorting'>
                                                                                        <span>Sort By:</span>
                                                                                        <form methord='POST' method='POST' action='bc_badges.php?''>
                                                                                            <select class='form-control border-0' id='exampleOption' name='sort_by_selection'>
                                                                                                <option value='relevance' selected>Relevance</option>
                                                                                                <option value='name_ace'>Names (A-Z)</option>
                                                                                                <option value='name_deace'>Names (Z-A)</option>
                                                                                                <option value='t_id_ace'>T_ID (ACE)</option>
                                                                                                <option value='t_id_deace'>T_ID (DACE)</option>
                                                                                            </select>
                                                                                    </div>

                                                                                    
                                                                                    
                                                                                    
                                                                                    <div class='result-views'>
                                                                                        <button type='button' class='btn btn-soft-base btn-icon'>
                                                                                            <svg
                                                                                                xmlns='http://www.w3.org/2000/svg'
                                                                                                width='24'
                                                                                                height='24'
                                                                                                viewBox='0 0 24 24'
                                                                                                fill='none'
                                                                                                stroke='currentColor'
                                                                                                stroke-width='2'
                                                                                                stroke-linecap='round'
                                                                                                stroke-linejoin='round'
                                                                                                class='feather feather-list'
                                                                                            >
                                                                                                <line x1='8' y1='6' x2='21' y2='6'></line>
                                                                                                <line x1='8' y1='12' x2='21' y2='12'></line>
                                                                                                <line x1='8' y1='18' x2='21' y2='18'></line>
                                                                                                <line x1='3' y1='6' x2='3' y2='6'></line>
                                                                                                <line x1='3' y1='12' x2='3' y2='12'></line>
                                                                                                <line x1='3' y1='18' x2='3' y2='18'></line>
                                                                                            </svg>
                                                                                        </button>
                                                                                        <button type='submit' class='btn btn-soft-base btn-icon' name='filter_button'>
                                                                                        <img src='https://img.icons8.com/external-kiranshastry-lineal-kiranshastry/24/000000/external-filter-advertising-kiranshastry-lineal-kiranshastry-4.png'/>
                                                                                        </button>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>";

                                                                    
                                                                    
                                                                    if(isset($_POST['search_button'])){
                                                                        $column_selection = $_POST['column_selection'];
                                                                        $search_query = $_POST['search'];

                                                                        if($column_selection == "T_ID" || $column_selection == "Age" || $column_selection == "GENDER"){
                                                                            $sql2 = "SELECT T_ID, FNAME, SNAME, AGE, ID_NUM, EMAIL, PHONE_NUMBER, WHATSAPP_NUMBER, EDU_LEVEL, UNIVERSITY, GARDUATED_YEAR, TEACHING_SINCE, AMOUNT_SUBJECTS, PASSWORD, CONFIRM_PASSWORD, ADDITIONAL_DETAILS, CLASS_TYPE_INPUT,REGISTERED_TIME, JOINED_YEAR, JOINED_TIME, IMAGE_NAME, FACEBOOK_LINK, YOUTUBE_LINK, WEBSITE_LINK, GENDER, TEACH_IN_SCHOOL, LANGUAGES, MOTTO FROM teachers WHERE $column_selection = '$search_query';";
                                                                            $sql = "SELECT T_ID, FNAME, SNAME, AGE, ID_NUM, EMAIL, PHONE_NUMBER, WHATSAPP_NUMBER, EDU_LEVEL, UNIVERSITY, GARDUATED_YEAR, TEACHING_SINCE, AMOUNT_SUBJECTS, PASSWORD, CONFIRM_PASSWORD, ADDITIONAL_DETAILS, CLASS_TYPE_INPUT,REGISTERED_TIME, JOINED_YEAR, JOINED_TIME, IMAGE_NAME, FACEBOOK_LINK, YOUTUBE_LINK, WEBSITE_LINK, GENDER, TEACH_IN_SCHOOL, LANGUAGES, MOTTO FROM teachers WHERE $column_selection = '$search_query';";
                                                                            
                                                                        
                                                                        
                                                                            }else{
                                                                                $sql2 = "SELECT T_ID, FNAME, SNAME, AGE, ID_NUM, EMAIL, PHONE_NUMBER, WHATSAPP_NUMBER, EDU_LEVEL, UNIVERSITY, GARDUATED_YEAR, TEACHING_SINCE, AMOUNT_SUBJECTS, PASSWORD, CONFIRM_PASSWORD, ADDITIONAL_DETAILS, CLASS_TYPE_INPUT,REGISTERED_TIME, JOINED_YEAR, JOINED_TIME, IMAGE_NAME, FACEBOOK_LINK, YOUTUBE_LINK, WEBSITE_LINK, GENDER, TEACH_IN_SCHOOL, LANGUAGES, MOTTO FROM teachers WHERE $column_selection LIKE '%$search_query%';";
                                                                                $sql = "SELECT T_ID, FNAME, SNAME, AGE, ID_NUM, EMAIL, PHONE_NUMBER, WHATSAPP_NUMBER, EDU_LEVEL, UNIVERSITY, GARDUATED_YEAR, TEACHING_SINCE, AMOUNT_SUBJECTS, PASSWORD, CONFIRM_PASSWORD, ADDITIONAL_DETAILS, CLASS_TYPE_INPUT,REGISTERED_TIME, JOINED_YEAR, JOINED_TIME, IMAGE_NAME, FACEBOOK_LINK, YOUTUBE_LINK, WEBSITE_LINK, GENDER, TEACH_IN_SCHOOL, LANGUAGES, MOTTO FROM teachers WHERE $column_selection LIKE '%$search_query%';";
                                                                                }
                                                                        

                                                                    }else{
                                                                        $sql = "SELECT T_ID, FNAME, SNAME, AGE, ID_NUM, EMAIL, PHONE_NUMBER, WHATSAPP_NUMBER, EDU_LEVEL, UNIVERSITY, GARDUATED_YEAR, TEACHING_SINCE, AMOUNT_SUBJECTS, PASSWORD, CONFIRM_PASSWORD, ADDITIONAL_DETAILS, CLASS_TYPE_INPUT,REGISTERED_TIME, JOINED_YEAR, JOINED_TIME, IMAGE_NAME, FACEBOOK_LINK, YOUTUBE_LINK, WEBSITE_LINK, GENDER, TEACH_IN_SCHOOL, LANGUAGES, MOTTO FROM teachers;";
                                                                        $sql2 = "SELECT * FROM teachers;";
                                                                    }


                                                                    
                                                                    
                                                                    
                                                                    
                                                                    if(isset($_POST['filter_button'])){
                                                                        $sort_by_selection = $_POST['sort_by_selection'];
                                                                        
                                                                        if($sort_by_selection == "name_ace"){
                                                                            $sql = "SELECT T_ID, FNAME, SNAME, AGE, ID_NUM, EMAIL, PHONE_NUMBER, WHATSAPP_NUMBER, EDU_LEVEL, UNIVERSITY, GARDUATED_YEAR, TEACHING_SINCE, AMOUNT_SUBJECTS, PASSWORD, CONFIRM_PASSWORD, ADDITIONAL_DETAILS, CLASS_TYPE_INPUT,REGISTERED_TIME, JOINED_YEAR, JOINED_TIME, IMAGE_NAME, FACEBOOK_LINK, YOUTUBE_LINK, WEBSITE_LINK, GENDER, TEACH_IN_SCHOOL, LANGUAGES, MOTTO FROM teachers ORDER BY FNAME ASC;";
                                                                        
                                                                        
                                                                        }elseif($sort_by_selection == "name_deace"){
                                                                            $sql = "SELECT T_ID, FNAME, SNAME, AGE, ID_NUM, EMAIL, PHONE_NUMBER, WHATSAPP_NUMBER, EDU_LEVEL, UNIVERSITY, GARDUATED_YEAR, TEACHING_SINCE, AMOUNT_SUBJECTS, PASSWORD, CONFIRM_PASSWORD, ADDITIONAL_DETAILS, CLASS_TYPE_INPUT,REGISTERED_TIME, JOINED_YEAR, JOINED_TIME, IMAGE_NAME, FACEBOOK_LINK, YOUTUBE_LINK, WEBSITE_LINK, GENDER, TEACH_IN_SCHOOL, LANGUAGES, MOTTO FROM teachers ORDER BY FNAME DESC;";
                                                                        
                                                                        }elseif($sort_by_selection == "t_id_ace"){
                                                                            $sql = "SELECT T_ID, FNAME, SNAME, AGE, ID_NUM, EMAIL, PHONE_NUMBER, WHATSAPP_NUMBER, EDU_LEVEL, UNIVERSITY, GARDUATED_YEAR, TEACHING_SINCE, AMOUNT_SUBJECTS, PASSWORD, CONFIRM_PASSWORD, ADDITIONAL_DETAILS, CLASS_TYPE_INPUT,REGISTERED_TIME, JOINED_YEAR, JOINED_TIME, IMAGE_NAME, FACEBOOK_LINK, YOUTUBE_LINK, WEBSITE_LINK, GENDER, TEACH_IN_SCHOOL, LANGUAGES, MOTTO FROM teachers ORDER BY T_ID ASC;";
                                                                        
                                                                        }elseif($sort_by_selection == "t_id_deace"){
                                                                            $sql = "SELECT T_ID, FNAME, SNAME, AGE, ID_NUM, EMAIL, PHONE_NUMBER, WHATSAPP_NUMBER, EDU_LEVEL, UNIVERSITY, GARDUATED_YEAR, TEACHING_SINCE, AMOUNT_SUBJECTS, PASSWORD, CONFIRM_PASSWORD, ADDITIONAL_DETAILS, CLASS_TYPE_INPUT,REGISTERED_TIME, JOINED_YEAR, JOINED_TIME, IMAGE_NAME, FACEBOOK_LINK, YOUTUBE_LINK, WEBSITE_LINK, GENDER, TEACH_IN_SCHOOL, LANGUAGES, MOTTO FROM teachers ORDER BY T_ID DESC;";
                                                                        
                                                                        }else{
                                                                            $sql = "SELECT T_ID, FNAME, SNAME, AGE, ID_NUM, EMAIL, PHONE_NUMBER, WHATSAPP_NUMBER, EDU_LEVEL, UNIVERSITY, GARDUATED_YEAR, TEACHING_SINCE, AMOUNT_SUBJECTS, PASSWORD, CONFIRM_PASSWORD, ADDITIONAL_DETAILS, CLASS_TYPE_INPUT,REGISTERED_TIME, JOINED_YEAR, JOINED_TIME, IMAGE_NAME, FACEBOOK_LINK, YOUTUBE_LINK, WEBSITE_LINK, GENDER, TEACH_IN_SCHOOL, LANGUAGES, MOTTO FROM teachers ORDER BY RAND();";
                                                                    }

                                                                        
                                                                        

                                                                        }

                                                                

                                                                    
                                                                    

                                                                    
                                                                    
                                                                    //$sql = "SELECT T_ID, FNAME, SNAME, AGE, ID_NUM, EMAIL, PHONE_NUMBER, WHATSAPP_NUMBER, EDU_LEVEL, UNIVERSITY, GARDUATED_YEAR, TEACHING_SINCE, AMOUNT_SUBJECTS, PASSWORD, CONFIRM_PASSWORD, ADDITIONAL_DETAILS, CLASS_TYPE_INPUT,REGISTERED_TIME, JOINED_YEAR, JOINED_TIME FROM teachers;";
                                                                    //$sql2 = "SELECT COUNT(*) FROM teachers;";
                                                                    
                                                                    
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

                                                                    $number_of_columns = count($datas2);
                                                                    
                                                                    


                                                                    for ($i=0; $i < $number_of_columns ; $i++) { 
                                                                        $t_id = $datas[$i]['T_ID'];
                                                                        $fname = $datas[$i]['FNAME'];
                                                                        $sname = $datas[$i]['SNAME'];
                                                                        $age = $datas[$i]['AGE'];
                                                                        $id_num = $datas[$i]['ID_NUM'];
                                                                        $email = $datas[$i]['EMAIL'];
                                                                        $phone_number = $datas[$i]['PHONE_NUMBER'];
                                                                        $whatsapp_number = $datas[$i]['WHATSAPP_NUMBER'];
                                                                        $edu_level = $datas[$i]['EDU_LEVEL'];
                                                                        $university = $datas[$i]['UNIVERSITY'];
                                                                        $graduated_year = $datas[$i]['GARDUATED_YEAR'];
                                                                        $teaching_since = $datas[$i]['TEACHING_SINCE'];
                                                                        $amount_subjects = $datas[$i]['AMOUNT_SUBJECTS'];
                                                                        $password = $datas[$i]['PASSWORD'];
                                                                        $confirm_password = $datas[$i]['CONFIRM_PASSWORD'];
                                                                        $additional_details = $datas[$i]['ADDITIONAL_DETAILS'];
                                                                        $class_type = $datas[$i]['CLASS_TYPE_INPUT'];
                                                                        $registerd_time = $datas[$i]['REGISTERED_TIME'];
                                                                        $joined_year = $datas[$i]['JOINED_YEAR'];
                                                                        $joined_time = $datas[$i]['JOINED_TIME'];
                                                                        $image = $datas[$i]['IMAGE_NAME'];
                                                                        $image_src = "../../uploads/".$image;
                                                                        $facebook_link = $datas[$i]['FACEBOOK_LINK'];
                                                                        $youtube_link = $datas[$i]['YOUTUBE_LINK'];
                                                                        $website_link = $datas[$i]['WEBSITE_LINK'];
                                                                        $gender = $datas[$i]['GENDER'];
                                                                        $teach_in_school = $datas[$i]['TEACH_IN_SCHOOL'];
                                                                        $languages = $datas[$i]['LANGUAGES'];
                                                                        $motto = $datas[$i]['MOTTO'];

                                                                        


                                                            echo      "<div class='result-body'>
                                                                        <div class='table-responsive'>
                                                                            <table class='table widget-26'>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div class='widget-26-job-emp-img'>
                                                                                                <img src='$image_src' alt='Company' />
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>


                                                                                        
                                                                                        
                                                                                        <div class='widget-26-job-title'>
                                                                                                <a href='tbl_bootstrap.php?email=$email&password=$password'><b><big>$fname $sname / $t_id<big></b></a>
                                                                                                <p class='m-0'><a href='#' class='employer-name'>$id_num</a> <span class='text-muted time'>$age years old</span></p>
                                                                                                <p><small>Tel: $phone_number</small>&nbsp&nbsp&nbsp<small>WA: $whatsapp_number</small><br/>
                                                                                                <font size='2px'>$email</font></p>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div class='widget-26-job-info'>
                                                                                                <p class='type m-0'>Teaching $amount_subjects Subjects</p>
                                                                                                <p class='text-muted m-0'>Since <span class='location'> $teaching_since <br/>
                                                                                                <small class='text-muted m-0'>$gender</small><br/>
                                                                                                <font size='1px'>Teach in School : $teach_in_school</span></p>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div class='widget-26-job-salary'><font size='2px'>$university</font> <br/>$edu_level <br/>$graduated_year<br/>$languages</div>
                                                                                        </td>
                                                                                        <td>";
                                                                                        
                                                                                        
                                                                                        
                                                                                        if($class_type == 'Online'){
                                                                                            echo"<div class='widget-26-job-category bg-soft-success'>
                                                                                                        <i class='indicator bg-success'></i>
                                                                                                        <span>Online</span>
                                                                                                </div>
                                                                                            </td>";
                                                                                        }elseif($class_type == 'Physical'){
                                                                                            echo "<div class='widget-26-job-category bg-soft-danger'>
                                                                                                        <i class='indicator bg-danger'></i>
                                                                                                        <span>Physical</span>
                                                                                                    </div>
                                                                                                    
                                                                                                    <br/><br/>
                                                                                                    
                                                                                                ";
                                                                                        }elseif($class_type == 'Both'){
                                                                                            echo "<div class='widget-26-job-category bg-soft-warning'>
                                                                                                        <i class='indicator bg-warning'></i>
                                                                                                        <span>Both</span>
                                                                                                    </div>
                                                                                                </td>";
                                                                                        }
                                                                                        
                                                                                        
                                                                                        
                                                                                        
                                                                                        echo "<td>
                                                                                                <p><i>password : $password</i><br/>
                                                                                                <i>Registered time : $registerd_time</i><br/>
                                                                                                <i>Joined year : $joined_year</i><br/>
                                                                                                    <a href='$facebook_link'><img src='https://img.icons8.com/fluency/100/000000/facebook-new.png' width='25px' height='25px'>
                                                                                                    <a href='$youtube_link'><img src='https://img.icons8.com/color/100/000000/youtube-play.png'/ width='25px' height='25px'>
                                                                                                    <a href='$website_link/'><img src='https://img.icons8.com/color/100/000000/internet-explorer.png'/ width='25px' height='25px'>
                                                                                                </td>
                                                                                        </tr>";
                                                                                    
                                                                                    
                                                                                    
                                                                    }        
                                                                      ?>              
                                                                                    
                                                                                    
                                                                                    
                                                                                    
                                                                                    
                                                            </ul>
                                                        </nav>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <!-- [ badge ] end -->
                            
                                
                            
                           

                            </div>
                            <!-- [ Main Content ] end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->

    
    
    <!-- [Typehead starts here] -->
            <datalist id="all_fnames">
                <?php
                    $sql4 = "SELECT FNAME, SNAME from teachers;";
                    $resalt4 = mysqli_query($conn, $sql4);                   //get the resalt between $conn and, run $sql   
                    $resaltcheck4 = mysqli_num_rows($resalt4);
                    $datas4 = array();
                    if ($resaltcheck4 > 0) {
                    while ($row4 = mysqli_fetch_assoc($resalt4)) {
                        $datas4[] = $row4;
                        }

                        
                        for ($a=0; $a <count($datas4) ; $a++) { 
                            $fname_getting_to_var = $datas4[$a]['FNAME'];
                            $sname_getting_to_var = $datas4[$a]['SNAME'];
                            echo " <option value='$fname_getting_to_var'>$fname_getting_to_var $sname_getting_to_var</option>";
                        }

                    }


                
                ?>
            </datalist>

            <datalist id="all_snames_here">
                <?php
                    $sql4 = "SELECT FNAME, SNAME from teachers;";
                    $resalt4 = mysqli_query($conn, $sql4);                   //get the resalt between $conn and, run $sql   
                    $resaltcheck4 = mysqli_num_rows($resalt4);
                    $datas4 = array();
                    if ($resaltcheck4 > 0) {
                    while ($row4 = mysqli_fetch_assoc($resalt4)) {
                        $datas4[] = $row4;
                        }

                        
                        for ($a=0; $a <count($datas4) ; $a++) { 
                            $fname_getting_to_var = $datas4[$a]['FNAME'];
                            $sname_getting_to_var = $datas4[$a]['SNAME'];
                            echo " <option value='$sname_getting_to_var'>$fname_getting_to_var $sname_getting_to_var</option>";
                        }

                    }


                
                ?>
            </datalist>

            <datalist id="all_id_nums">
                <?php
                    $column_to_select = "ID_NUM";
                    
                    $sql4 = "SELECT $column_to_select from teachers;";
                    $resalt4 = mysqli_query($conn, $sql4);                   //get the resalt between $conn and, run $sql   
                    $resaltcheck4 = mysqli_num_rows($resalt4);
                    $datas4 = array();
                    if ($resaltcheck4 > 0) {
                    while ($row4 = mysqli_fetch_assoc($resalt4)) {
                        $datas4[] = $row4;
                        }

                        
                        for ($a=0; $a <count($datas4) ; $a++) { 
                            $option_data = $datas4[$a][$column_to_select];
                            echo " <option value='$option_data'> $option_data </option>";
                        }
                    }
                ?>

            </datalist>

            <datalist id="all_emails">
                <?php
                    $column_to_select = "EMAIL";
                    
                    $sql4 = "SELECT $column_to_select from teachers;";
                    $resalt4 = mysqli_query($conn, $sql4);                   //get the resalt between $conn and, run $sql   
                    $resaltcheck4 = mysqli_num_rows($resalt4);
                    $datas4 = array();
                    if ($resaltcheck4 > 0) {
                    while ($row4 = mysqli_fetch_assoc($resalt4)) {
                        $datas4[] = $row4;
                        }

                        
                        for ($a=0; $a <count($datas4) ; $a++) { 
                            $option_data = $datas4[$a][$column_to_select];
                            echo " <option value='$option_data'> $option_data </option>";
                        }
                    }
                ?>

            </datalist>

            <datalist id="all_phone_numbers">
                <?php
                    $column_to_select = "PHONE_NUMBER";
                    
                    $sql4 = "SELECT $column_to_select from teachers;";
                    $resalt4 = mysqli_query($conn, $sql4);                   //get the resalt between $conn and, run $sql   
                    $resaltcheck4 = mysqli_num_rows($resalt4);
                    $datas4 = array();
                    if ($resaltcheck4 > 0) {
                    while ($row4 = mysqli_fetch_assoc($resalt4)) {
                        $datas4[] = $row4;
                        }

                        
                        for ($a=0; $a <count($datas4) ; $a++) { 
                            $option_data = $datas4[$a][$column_to_select];
                            echo " <option value='$option_data'> $option_data </option>";
                        }
                    }
                ?>

            </datalist>

            <datalist id="all_whatsapp_numbers">
                <?php
                    $column_to_select = "WHATSAPP_NUMBER";
                    
                    $sql4 = "SELECT $column_to_select from teachers;";
                    $resalt4 = mysqli_query($conn, $sql4);                   //get the resalt between $conn and, run $sql   
                    $resaltcheck4 = mysqli_num_rows($resalt4);
                    $datas4 = array();
                    if ($resaltcheck4 > 0) {
                    while ($row4 = mysqli_fetch_assoc($resalt4)) {
                        $datas4[] = $row4;
                        }

                        
                        for ($a=0; $a <count($datas4) ; $a++) { 
                            $option_data = $datas4[$a][$column_to_select];
                            echo " <option value='$option_data'> $option_data </option>";
                        }
                    }
                ?>

            </datalist>


            <datalist id="all_edu_lvls">
                <?php
                    $column_to_select = "EDU_LEVEL";
                    
                    $sql4 = "SELECT $column_to_select from teachers;";
                    $resalt4 = mysqli_query($conn, $sql4);                   //get the resalt between $conn and, run $sql   
                    $resaltcheck4 = mysqli_num_rows($resalt4);
                    $datas4 = array();
                    if ($resaltcheck4 > 0) {
                    while ($row4 = mysqli_fetch_assoc($resalt4)) {
                        $datas4[] = $row4;
                        }

                        
                        for ($a=0; $a <count($datas4) ; $a++) { 
                            $option_data = $datas4[$a][$column_to_select];
                            echo " <option value='$option_data'> $option_data </option>";
                        }
                    }
                ?>

            </datalist>


            <datalist id="all_univeristies">
                <?php
                    $column_to_select = "UNIVERSITY";
                    
                    $sql4 = "SELECT $column_to_select from teachers;";
                    $resalt4 = mysqli_query($conn, $sql4);                   //get the resalt between $conn and, run $sql   
                    $resaltcheck4 = mysqli_num_rows($resalt4);
                    $datas4 = array();
                    if ($resaltcheck4 > 0) {
                    while ($row4 = mysqli_fetch_assoc($resalt4)) {
                        $datas4[] = $row4;
                        }

                        
                        for ($a=0; $a <count($datas4) ; $a++) { 
                            $option_data = $datas4[$a][$column_to_select];
                            echo " <option value='$option_data'> $option_data </option>";
                        }
                    }
                ?>

            </datalist>


            <datalist id="all_passwords">
                <?php
                    $column_to_select = "PASSWORD";
                    
                    $sql4 = "SELECT $column_to_select from teachers;";
                    $resalt4 = mysqli_query($conn, $sql4);                   //get the resalt between $conn and, run $sql   
                    $resaltcheck4 = mysqli_num_rows($resalt4);
                    $datas4 = array();
                    if ($resaltcheck4 > 0) {
                    while ($row4 = mysqli_fetch_assoc($resalt4)) {
                        $datas4[] = $row4;
                        }

                        
                        for ($a=0; $a <count($datas4) ; $a++) { 
                            $option_data = $datas4[$a][$column_to_select];
                            echo " <option value='$option_data'> $option_data </option>";
                        }
                    }
                ?>

            </datalist>

            <datalist id="all_class_type_inputs">
                <option value="Physical">Physical</option>
                <option value="Online">Online</option>
                <option value="Both">Both</option>
            </datalist>

            <datalist id="all_registered_times">
                <?php
                    $column_to_select = "REGISTERED_TIME";
                    
                    $sql4 = "SELECT $column_to_select from teachers;";
                    $resalt4 = mysqli_query($conn, $sql4);                   //get the resalt between $conn and, run $sql   
                    $resaltcheck4 = mysqli_num_rows($resalt4);
                    $datas4 = array();
                    if ($resaltcheck4 > 0) {
                    while ($row4 = mysqli_fetch_assoc($resalt4)) {
                        $datas4[] = $row4;
                        }

                        
                        for ($a=0; $a <count($datas4) ; $a++) { 
                            $option_data = $datas4[$a][$column_to_select];
                            echo " <option value='$option_data'> $option_data </option>";
                        }
                    }
                ?>

            </datalist>

            <datalist id="all_facebook_links">
                <?php
                    $column_to_select = "FACEBOOK_LINK";
                    
                    $sql4 = "SELECT $column_to_select from teachers;";
                    $resalt4 = mysqli_query($conn, $sql4);                   //get the resalt between $conn and, run $sql   
                    $resaltcheck4 = mysqli_num_rows($resalt4);
                    $datas4 = array();
                    if ($resaltcheck4 > 0) {
                    while ($row4 = mysqli_fetch_assoc($resalt4)) {
                        $datas4[] = $row4;
                        }

                        
                        for ($a=0; $a <count($datas4) ; $a++) { 
                            $option_data = $datas4[$a][$column_to_select];
                            echo " <option value='$option_data'> $option_data </option>";
                        }
                    }
                ?>

            </datalist>

            <datalist id="all_youtube_links">
                <?php
                    $column_to_select = "YOUTUBE_LINK";
                    
                    $sql4 = "SELECT $column_to_select from teachers;";
                    $resalt4 = mysqli_query($conn, $sql4);                   //get the resalt between $conn and, run $sql   
                    $resaltcheck4 = mysqli_num_rows($resalt4);
                    $datas4 = array();
                    if ($resaltcheck4 > 0) {
                    while ($row4 = mysqli_fetch_assoc($resalt4)) {
                        $datas4[] = $row4;
                        }

                        
                        for ($a=0; $a <count($datas4) ; $a++) { 
                            $option_data = $datas4[$a][$column_to_select];
                            echo " <option value='$option_data'> $option_data </option>";
                        }
                    }
                ?>

            </datalist>

            <datalist id="all_website_links">
                <?php
                    $column_to_select = "WEBSITE_LINK";
                    
                    $sql4 = "SELECT $column_to_select from teachers;";
                    $resalt4 = mysqli_query($conn, $sql4);                   //get the resalt between $conn and, run $sql   
                    $resaltcheck4 = mysqli_num_rows($resalt4);
                    $datas4 = array();
                    if ($resaltcheck4 > 0) {
                    while ($row4 = mysqli_fetch_assoc($resalt4)) {
                        $datas4[] = $row4;
                        }

                        
                        for ($a=0; $a <count($datas4) ; $a++) { 
                            $option_data = $datas4[$a][$column_to_select];
                            echo " <option value='$option_data'> $option_data </option>";
                        }
                    }
                ?>

            </datalist>

            <datalist id="all_genders">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </datalist>

            <datalist id="all_teach_in_schools">
                <option value="Yes">Teach in School</option>
                <option value="No">Not Teach in School</option>
            </datalist>

            <datalist id="all_languages">
                <option value="Sinhala">Sinhala</option>
                <option value="English">English</option>
                <option value="Tamil">Tamil</option>
            </datalist>
                

            



                
                        

            <!-- Typehead values assign here -->
            <script>
                $(".column_list").change(function(){
                    var selected_value = $(this).find(":selected").attr('value');
                    
                    switch(selected_value){
                        case 'FNAME':
                            $("#search").attr("list","all_fnames");
                            break;

                        case 'SNAME':
                            $("#search").attr("list","all_snames_here");
                            break;

                        case 'ID_NUM':
                            $("#search").attr("list","all_id_nums");
                            break;

                        case 'EMAIL':
                            $("#search").attr("list","all_emails");
                            break;

                        case 'PHONE_NUMBER':
                            $("#search").attr("list","all_phone_numbers");
                            break;

                        case 'WHATSAPP_NUMBER':
                            $("#search").attr("list","all_whatsapp_numbers");
                            break;

                        case 'EDU_LEVEL':
                            $("#search").attr("list","all_edu_lvls");
                            break;

                        case 'UNIVERSITY':
                            $("#search").attr("list","all_univeristies");
                            break;

                        

                        case 'PASSWORD':
                            $("#search").attr("list","all_passwords");
                            break;

                        case 'CLASS_TYPE_INPUT':
                            $("#search").attr("list","all_class_type_inputs");
                            break;

                        case 'REGISTERED_TIME':
                            $("#search").attr("list","all_registered_times");
                            break;

                        case 'FACEBOOK_LINK':
                            $("#search").attr("list","all_facebook_links");
                            break;
                        
                        case 'YOUTUBE_LINK':
                            $("#search").attr("list","all_youtube_links");
                            break;
                            
                        case 'WEBSITE_LINK':
                            $("#search").attr("list","all_website_links");
                            break;

                        case 'GENDER':
                            $("#search").attr("list","all_genders");
                            break;

                        case 'TEACH_IN_SCHOOL':
                            $("#search").attr("list","all_teach_in_schools");
                            break;

                        case 'LANGUAGES':
                            $("#search").attr("list","all_languages");
                            break;


                        default:
                            $("#search").attr("list","nothing");
                            break;

                        }
                    });
                    
            </script>

            
            <!-- If user selected a value before, assign defults here-->
            <script>
                var column_section_jq_var = "<?php echo $column_selection; ?>";
                var searched_query = "<?php echo $search_query; ?>";
                
                var count_of_table_rows = "<?php $sql5='SELECT * FROM teachers'; $query=mysqli_query($conn,$sql5); $num_of_columns =mysqli_num_fields($query);echo $num_of_columns; ?>";
                
                for (let c = 1; c <= count_of_table_rows; c++) {
                    var all_columns = $(".column_list option:nth-child("+ c +")").val();

                    if(column_section_jq_var == all_columns){
                        $(".column_list option:nth-child("+ c +")").prop('selected',true);
                    
                        switch(column_section_jq_var){
                                case 'FNAME':
                                    $("#search").attr("list","all_fnames");
                                    break;

                                case 'SNAME':
                                    $("#search").attr("list","all_snames_here");
                                    break;

                                case 'ID_NUM':
                                    $("#search").attr("list","all_id_nums");
                                    break;

                                case 'EMAIL':
                                    $("#search").attr("list","all_emails");
                                    break;

                                case 'PHONE_NUMBER':
                                    $("#search").attr("list","all_phone_numbers");
                                    break;

                                case 'WHATSAPP_NUMBER':
                                    $("#search").attr("list","all_whatsapp_numbers");
                                    break;

                                case 'EDU_LEVEL':
                                    $("#search").attr("list","all_edu_lvls");
                                    break;

                                case 'UNIVERSITY':
                                    $("#search").attr("list","all_univeristies");
                                    break;

                                

                                case 'PASSWORD':
                                    $("#search").attr("list","all_passwords");
                                    break;

                                case 'CLASS_TYPE_INPUT':
                                    $("#search").attr("list","all_class_type_inputs");
                                    break;

                                case 'REGISTERED_TIME':
                                    $("#search").attr("list","all_registered_times");
                                    break;

                                case 'FACEBOOK_LINK':
                                    $("#search").attr("list","all_facebook_links");
                                    break;
                                
                                case 'YOUTUBE_LINK':
                                    $("#search").attr("list","all_youtube_links");
                                    break;
                                    
                                case 'WEBSITE_LINK':
                                    $("#search").attr("list","all_website_links");
                                    break;

                                case 'GENDER':
                                    $("#search").attr("list","all_genders");
                                    break;

                                case 'TEACH_IN_SCHOOL':
                                    $("#search").attr("list","all_teach_in_schools");
                                    break;

                                case 'LANGUAGES':
                                    $("#search").attr("list","all_languages");
                                    break;


                                default:
                                    $("#search").attr("list","nothing");
                                    break;

                            }
                    }
                }
                $("#search").prop('value',searched_query);  

                
            </script>
                
    <!-- [Typehead Ends Here] -->

    
                
                   
                    
                
               
            
            
            
    
                


                    



    
    


        

        

        
        


    

    
    

    
    
    

    
            

            
    










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






<?php


if(isset($_POST['search_button'])){
    $column_selection = $_POST['column_selection'];
    $search_query = $_POST['search'];

}

if(isset($_POST['filter_button'])){
    $sort_by_selection = $_POST['sort_by_selection'];

}


?>


