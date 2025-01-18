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

    <!-- inbox starts here -->
        <style>
            /*
            =================================
            MAIL INBOX
            =================================
        */

            .mail-box {
                border-collapse: collapse;
                border-spacing: 0;
                display: table;
                table-layout: fixed;
                width: 100%;
            }

            .mail-box aside {
                display: table-cell;
                float: none;
                height: 100%;
                padding: 0;
                vertical-align: top;
            }

            .mail-box .sm-side {
                width: 25%;
                background: #ecf0f1;
                border-radius: 4px 0 0 4px;
                -webkit-border-radius: 4px 0 0 4px;
            }

            .mail-box .lg-side {
                width: 75%;
                background: #fff;
                border-radius: 0px 4px 4px 0;
                -webkit-border-radius: 0px 4px 4px 0;
            }

            .mail-box .sm-side .user-head {
                background: #2980b9;
                border-radius: 4px 0px 0px 0;
                -webkit-border-radius: 4px 0px 0px 0;
                padding: 10px;
                color: #fff;
                min-height: 80px;
            }

            .user-head .inbox-avatar {
                width: 65px;
                float: left;
            }

            .user-head .inbox-avatar img {
                border-radius: 4px;
                -webkit-border-radius: 4px;
            }

            .user-head .user-name {
                display: inline-block;
                margin: 0 0 0 10px;
            }

            .user-head .user-name h5 {
                font-size: 14px;
                margin-top: 15px;
                margin-bottom: 0;
                font-weight: 300;
            }

            .user-head .user-name h5 a {
                color: #fff;
            }

            .user-head .user-name span a {
                font-size: 12px;
                color: #87e2e7;
            }

            a.mail-dropdown {
                background: #1abc9c;
                padding: 3px 5px;
                font-size: 10px;
                color: #ddd;
                border-radius: 2px;
                margin-top: 20px;
            }

            .inbox-body {
                padding: 20px;
            }

            .btn-compose {
                background: #9b59b6;
                padding: 12px 0;
                text-align: center;
                width: 100%;
                color: #fff;
            }

            .btn-compose:hover {
                background: #8e44ad;
                color: #fff;
            }

            ul.inbox-nav {
                display: inline-block;
                width: 100%;
                margin: 0;
                padding: 0;
            }

            .inbox-divider {
                border-bottom: 1px solid #d5d8df;
            }

            ul.inbox-nav li {
                display: inline-block;
                line-height: 45px;
                width: 100%;
            }

            ul.inbox-nav li a {
                color: #6a6a6a;
                line-height: 45px;
                width: 100%;
                display: inline-block;
                padding: 0 20px;
            }

            ul.inbox-nav li a:hover,
            ul.inbox-nav li.active a,
            ul.inbox-nav li a:focus {
                color: #6a6a6a;
                background: #d5d7de;
            }

            ul.inbox-nav li a i {
                padding-right: 10px;
                font-size: 16px;
                color: #6a6a6a;
            }

            ul.inbox-nav li a span.label {
                margin-top: 13px;
            }

            ul.labels-info li h4 {
                padding-left: 15px;
                padding-right: 15px;
                padding-top: 5px;
                color: #5c5c5e;
                font-size: 13px;
                text-transform: uppercase;
            }

            ul.labels-info li {
                margin: 0;
            }

            ul.labels-info li a {
                color: #6a6a6a;
                border-radius: 0;
            }

            ul.labels-info li a:hover,
            ul.labels-info li a:focus {
                color: #6a6a6a;
                background: #d5d7de;
            }

            ul.labels-info li a i {
                padding-right: 10px;
            }

            .nav.nav-pills.nav-stacked.labels-info p {
                margin-bottom: 0;
                padding: 0 22px;
                color: #9d9f9e;
                font-size: 11px;
            }

            .inbox-head {
                padding: 20px;
                background: #3498db;
                color: #fff;
                border-radius: 0 4px 0 0;
                -webkit-border-radius: 0 4px 0 0;
                min-height: 80px;
            }

            .inbox-head h3 {
                margin: 0;
                display: inline-block;
                padding-top: 6px;
                font-weight: 300;
            }

            .inbox-head .sr-input {
                height: 40px;
                border: none;
                box-shadow: none;
                padding: 0 10px;
                float: left;
                border-radius: 4px 0 0 4px;
                color: #8a8a8a;
            }

            .inbox-head .sr-btn {
                height: 40px;
                border: none;
                background: #2980b9;
                color: #fff;
                padding: 0 20px;
                border-radius: 0 4px 4px 0;
                -webkit-border-radius: 0 4px 4px 0;
            }

            .table-inbox {
                border: 1px solid #d3d3d3;
                margin-bottom: 0;
            }

            .table-inbox tr td {
                padding: 12px !important;
            }

            .table-inbox tr td:hover {
                cursor: pointer;
            }

            .table-inbox tr td .fa-star.inbox-started,
            .table-inbox tr td .fa-star:hover {
                color: #f78a09;
            }

            .table-inbox tr td .fa-star {
                color: #d5d5d5;
            }

            .table-inbox tr.unread td {
                font-weight: 600;
                background: #f7f7f7;
            }

            ul.inbox-pagination {
                float: right;
                list-style: none;
            }

            ul.inbox-pagination li {
                float: left;
            }

            .mail-option {
                display: inline-block;
                margin-bottom: 10px;
                width: 100%;
            }

            .mail-option .chk-all,
            .mail-option .btn-group {
                margin-right: 5px;
            }

            .mail-option .chk-all,
            .mail-option .btn-group a.btn {
                border: 1px solid #e7e7e7;
                padding: 5px 10px;
                display: inline-block;
                background: #fcfcfc;
                color: #afafaf;
                border-radius: 3px !important;
                -webkit-border-radius: 3px !important;
            }

            .inbox-pagination a.np-btn {
                border: 1px solid #e7e7e7;
                padding: 5px 15px;
                display: inline-block;
                background: #fcfcfc;
                color: #afafaf;
                border-radius: 3px !important;
                -webkit-border-radius: 3px !important;
            }

            .mail-option .chk-all input[type=checkbox] {
                margin-top: 0;
            }

            .mail-option .btn-group a.all {
                padding: 0;
                border: none;
            }

            .inbox-pagination a.np-btn {
                margin-left: 5px;
            }

            .inbox-pagination li span {
                display: inline-block;
                margin-top: 7px;
                margin-right: 5px;
            }

            .fileinput-button {
                border: 1px solid #e6e6e6;
                background: #eeeeee;
            }

            .inbox-body .modal .modal-body input,
            .inbox-body .modal .modal-body textarea {
                border: 1px solid #e6e6e6;
                box-shadow: none;
            }

            .btn-send,
            .btn-send:hover {
                background: #00A8B3;
                color: #fff;
            }

            .btn-send:hover {
                background: #009da7;
            }

            .modal-header h4.modal-title {
                font-weight: 300;
                font-family: 'Open Sans', sans-serif;
            }

            .modal-body label {
                font-weight: 400;
                font-family: 'Open Sans', sans-serif;
            }

            .heading-inbox h4 {
                font-size: 18px;
                color: #444;
                border-bottom: 1px solid #ddd;
                padding-bottom: 10px;
                margin-top: 20px;
            }

            .sender-info {
                margin-bottom: 20px;
            }

            .sender-info img {
                width: 30px;
                height: 30px;
            }

            .sender-dropdown {
                background: #eaeaea;
                padding: 0 3px;
                color: #777;
                font-size: 10px;
            }

            .view-mail a {
                color: #FF6C60;
            }

            .attachment-mail {
                margin-top: 30px;
            }

            .attachment-mail ul {
                width: 100%;
                display: inline-block;
                margin-bottom: 30px;
            }

            .attachment-mail ul li {
                float: left;
                width: 150px;
                margin-right: 10px;
                margin-bottom: 10px;
            }

            .attachment-mail ul li img {
                width: 100%;
            }

            .attachment-mail ul li span {
                float: right;
            }

            .attachment-mail .file-name {
                float: left;
            }

            .attachment-mail .links {
                width: 100%;
                display: inline-block;
            }
        </style>
        <!-- inbox ends here -->

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
                                        <h5 class="m-b-10">Inbox</h5>
                                    </div>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="./admin_dashboard.php"><i class="feather icon-home"></i></a></li>
                                        <li class="breadcrumb-item"><a href="javascript:">Messages</a></li>
                                        <li class="breadcrumb-item"><a href="javascript:">Inbox</a></li>
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
                                <!-- [ Inbox ] start -->
                                
                                



                                <div class="col-sm-12">
                                    <div class="card">
                                        <!-- start:inbox detail -->
                                            <div class="container">
                                        <div class="row">
                                            <div class="col-md-12">
                                            
                                                <div class="box">
                                                    <div class="mail-box">
                                                        
                                                        <aside class="lg-side">
                                                        <div class="inbox-head bg-white">
                                                            <h3>View Mail</h3>
                                                            
                                                        </div>
                                                        <div class="inbox-body">
                                                            <div class="heading-inbox row">
                                                                <div class="col-md-8">
                                                                    <div class="compose-btn">
                                                                        <a class="btn btn-sm btn-primary" href="./bc_typography.php?" data-original-title="" title=""><i class="fa fa-chevron-left"></i> Back</a>
                                                                        <button title="" data-placement="top" data-toggle="tooltip" type="button" data-original-title="Press Ctrl + P" class="btn  btn-sm tooltips"><i class="fa fa-print"></i> </button>
                                                                        <!-- <button title="" data-placement="top" data-toggle="tooltip" data-original-title="Delete" class="btn btn-sm tooltips"><i class="fa fa-trash"></i></button> -->
                                                                    </div>
                                                                </div>
                                                                
                                                                <?php
                                                                    if(isset($_GET['m_id'])){
                                                                        $m_id = $_GET['m_id'];
                                                                        
                                                                        
                                                                        $sql1 = "   SELECT Name, Email, Phone_number, whatsapp_number, message_content, recived_date, recived_time, Readability FROM contact_us_messages
                                                                                    WHERE message_id = $m_id;";
                                                                        $resalt1 = mysqli_query($conn, $sql1);                   //get the resalt between $conn and, run $sql
                                                                        $resaltcheck1 = mysqli_num_rows($resalt1);
                                                                        $datas1 = array();
                                                                        if ($resaltcheck1 > 0) {
                                                                        while ($row1 = mysqli_fetch_assoc($resalt1)) {
                                                                            $datas1[] = $row1;
                                                                        }
                                                                            

                                                                            $contact_us_name = $datas1[0]['Name'];
                                                                            $contact_us_email = $datas1[0]['Email'];
                                                                            $contact_us_phone_number = $datas1[0]['Phone_number'];
                                                                            $contact_us_whatsapp_number = $datas1[0]['whatsapp_number'];
                                                                            $contact_us_message_content = $datas1[0]['message_content'];
                                                                            $contact_us_recived_date = $datas1[0]['recived_date'];
                                                                            $contact_us_recived_time = $datas1[0]['recived_time'];
                                                                            $readability = $datas1[0]['Readability'];

                                                                            echo 
                                                                                "<div class='col-md-4 text-right'>
                                                                                    <p class='date'> $contact_us_recived_time -- $contact_us_recived_date</p>
                                                                                </div>
                                                                                
                                                                                <div class='col-md-12'>
                                                                                    <h4> $contact_us_email</h4>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class='view-mail'>
                                                                                <p class='h3'>$contact_us_message_content</p>
                                                                            </div>
                                                                            
                                                                            <br><br><br><br>
                                                                            <div class='sender-info'>
                                                                                <div class='row'>
                                                                                
                                                                                    <div class='col-md-12 card'>
                                                                                        <b class='f-17'><u>User Contact Details</u></b><br>
                                                                                        <strong>Email :</strong><span>$contact_us_email</span><br/>
                                                                                        <strong>Contact Number :</strong><span>$contact_us_phone_number</span><br/>
                                                                                        <strong>Whatsapp Number :</strong><span>$contact_us_whatsapp_number</span><br/>
                                                                                        
                                                                                        
                                                                                        
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            ";
                                                                            
                                                                        }

                                                                        $sql = "UPDATE contact_us_messages SET Readability = 'read' WHERE message_id = $m_id;";
                                                                        if(mysqli_query($conn, $sql)){} 

                                                                    }
                                                                ?>
                                                                
                                                            
                                                            <div class="compose-btn pull-left">
                                                                <button class="btn btn-sm btn-primary" href="#" data-toggle="tooltip" data-original-title="" title="" id="reply_button"><i class="fa fa-reply"></i> Reply</button>
                                                                <button class="btn btn-sm " data-original-title="" title="" id="forward_button"><i class="fa fa-arrow-right"></i> Forward</button>
                                                                <button title="" data-placement="top" data-toggle="tooltip" type="button" data-original-title="Ctrl + P" class="btn  btn-sm tooltips"><i class="fa fa-print"></i> </button>
                                                                <!-- <button title="" data-placement="top" data-toggle="tooltip" data-original-title="Trash" class="btn btn-sm tooltips"><i class="fa fa-trash-o"></i></button> -->
                                                            </div>
                                                        </div>
                                                    </aside>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
                            <script>
                                $(function(){
                                    // $("#reply_button").click(function(){});
                                        var contact_us_email = "<?php echo($contact_us_email != '')? $contact_us_email: 'no'; ?>";
                                        var contact_us_message_content = "<?php echo($contact_us_message_content != '')? $contact_us_message_content: 'no'; ?>";

                                        if(contact_us_email == 'no'){
                                            $("#reply_button").attr('disabled',true).css('cursor','not-allowed');
                                            $("#forward_button").attr('disabled',true).css('cursor','not-allowed');
                                                                                    
                                        }else{
                                            $(function(){
                                                $("#reply_button").click(function(){
                                                    window.location.replace("bc_typography - 3.php?replying_email=" + contact_us_email);
                                                });

                                                    
                                            });
                                        }
                                    
                                })
                            </script>
                            <script>
                                var contact_us_email = "<?php echo($contact_us_email != '')? $contact_us_email: 'no'; ?>";
                                var contact_us_message_content = "<?php echo($contact_us_message_content != '')? $contact_us_message_content: 'no-content'; ?>";
                                
                                $(function(){
                                    $("#forward_button").click(function(){
                                        window.location.replace("bc_typography - 3.php?replying_email=" + contact_us_email + "&Message=" + encodeURIComponent(contact_us_message_content));
                                       
                                        
                                        
                                    });
                                });
                            </script>

                            <!-- [ Typography ] end -->
                        </div>
                        <!-- [ Main Content ] end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>



 
<!-- end:inbox detail -->
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