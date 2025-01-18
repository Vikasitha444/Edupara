<?php
date_default_timezone_set("Asia/Colombo");


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
                                        <h5 class="m-b-10">Students</h5>
                                    </div>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="./admin_dashboard.php?"><i class="feather icon-home"></i></a></li>
                                        <li class="breadcrumb-item"><a href="javascript:">Manage</a></li>
                                        <li class="breadcrumb-item"><a href="javascript:">Students</a></li>
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
                                <!-- [ tabs ] start -->
                                
                                <div class="col-sm-12">
                                    <h5 class="mt-4"></h5>
                                    <hr>
                                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">All</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Today</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">This week</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-registered-tab" data-toggle="pill" href="#pills-registered" role="tab" aria-controls="pills-registered" aria-selected="false">Registerd</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-anonymous-tab" data-toggle="pill" href="#pills-anonymous" role="tab" aria-controls="pills-anonymous" aria-selected="false">Annonymous</a>
                                        </li>
                                        <!-- <li class="nav-item">
                                            <a class="nav-link" id="pills-anonymous-tab" data-toggle="pill" href="#pills-anonymous" role="tab" aria-controls="pills-anonymous" aria-selected="false">Registerd</a>
                                        </li> -->
                                    </ul>
                                    
                                    <div class="tab-content p-0 m-0" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                            <div class="bg-white">
                                                <table class="table table-hover bg-white">
                                                    <thead>
                                                        <tr>
                                                            <th>S_ID</th>
                                                            <th>Full Name</th>
                                                            <th>Grade</th>
                                                            <th>Email</th>
                                                            <th>Contact No</th>
                                                            <th>Whatsapp No</th>
                                                            <th>Time</th>
                                                            <th>Location</th>
                                                            
                                                            <th>Password</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                                $sql15 = "SELECT S_ID, EMAIL, FULL_NAME, GRADE, DISTRICT, CITY, CONTACT_NUMBER, WHATSAPP_NUMBER, PASSWORD, CONFIRM_PASSWORD, RESGISTED_DATE_TIME FROM students;";
                                                                $resalt15 = mysqli_query($conn, $sql15);                   //get the resalt between $conn and, run $sql
                                                                $resaltcheck15 = mysqli_num_rows($resalt15);
                                                                $datas15 = array();
                                                                if ($resaltcheck15 > 0) {
                                                                while ($row15 = mysqli_fetch_assoc($resalt15)) {
                                                                    $datas15[] = $row15;
                                                                }
                                                                    for ($j=0; $j < count($datas15); $j++) { 
                                                                        $students_sId = $datas15[$j]['S_ID'];
                                                                        $students_email = $datas15[$j]['EMAIL'];
                                                                        $students_full_name = $datas15[$j]['FULL_NAME'];
                                                                        $students_grade = $datas15[$j]['GRADE'];
                                                                        $students_district = $datas15[$j]['DISTRICT'];
                                                                        $students_city = $datas15[$j]['CITY'];
                                                                        $students_contact_number = $datas15[$j]['CONTACT_NUMBER'];
                                                                        $students_whatsapp_number = $datas15[$j]['WHATSAPP_NUMBER'];
                                                                        $students_password = $datas15[$j]['PASSWORD'];
                                                                        if(strpos($students_password," LOGIN_SESSION")){$students_password = 'N/A';}
                                                                        
                                                                        
                                                                        $student_regiered_time = $datas15[$j]['RESGISTED_DATE_TIME'];
                                                                        $student_regiered_time = strtotime($student_regiered_time);
                                                                        $registed_date = date('Y/m/d', $student_regiered_time);
                                                                        $registed_time = date('H:i A', $student_regiered_time);

                                                                        $FirstDay = date("Y/m/d", strtotime('sunday last week'));  
                                                                        $LastDay = date("Y/m/d", strtotime('sunday this week')); 
                                                                        
                                                                        // echo $registed_date."&nbsp &nbsp".$registed_time."<br/>";
                                                                        
                                                                        $today = date("Y/m/d");
                                                                        
                                                                        echo 
                                                                            "<tr>
                                                                            <td>
                                                                                <h6 class='m-0'>$students_sId</h6>
                                                                            </td>
                                                                            <td>
                                                                                <h6 class='m-0'><img class='rounded-circle  m-r-10' style='width:40px;' src='assets/images/user/avatar-2.jpg' alt='activity-user'>$students_full_name</h6>
                                                                            </td>
                                                                            <td>
                                                                                <h6 class='m-0'>$students_grade</h6>
                                                                            </td>
                                                                            
                                                                            <td>
                                                                                <h6 class='m-0'>$students_email</h6>
                                                                            </td>
                                                                            <td>
                                                                                <h6 class='m-0'>$students_contact_number</h6>
                                                                            </td>
                                                                            <td>
                                                                                <h6 class='m-0'>$students_whatsapp_number</h6>
                                                                            </td>
                                                                            <td>
                                                                                <h6 class='m-0'>$registed_time <br/> $registed_date</h6>
                                                                            </td>
                                                                            <td>
                                                                                <h6 class='m-0'>$students_district <br/> $students_city</h6>
                                                                            </td>
                                                                            
                                                                            <td>$students_password</td>
                                                                        </tr>";
                                                                        
                                                                            
                                                                        }
                                                                        
                                                                    
                                                                    
                                                                }
                                                                                
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                            <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>S_ID</th>
                                                            <th>Full Name</th>
                                                            <th>Grade</th>
                                                            <th>Email</th>
                                                            <th>Contact No</th>
                                                            <th>Whatsapp No</th>
                                                            <th>Time</th>
                                                            <th>Location</th>
                                                            
                                                            <th>Password</th>
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
                                                                $students_sId = $datas15[$j]['S_ID'];
                                                                $students_email = $datas15[$j]['EMAIL'];
                                                                $students_full_name = $datas15[$j]['FULL_NAME'];
                                                                $students_grade = $datas15[$j]['GRADE'];
                                                                $students_district = $datas15[$j]['DISTRICT'];
                                                                $students_city = $datas15[$j]['CITY'];
                                                                $students_contact_number = $datas15[$j]['CONTACT_NUMBER'];
                                                                $students_whatsapp_number = $datas15[$j]['WHATSAPP_NUMBER'];
                                                                $students_password = $datas15[$j]['PASSWORD'];
                                                                if(strpos($students_password," LOGIN_SESSION")){$students_password = 'N/A';}
                                                                
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
                                                                                <h6 class='m-0'>$students_sId</h6>
                                                                            </td>
                                                                            <td>
                                                                                <h6 class='m-0'><img class='rounded-circle  m-r-10' style='width:40px;' src='assets/images/user/avatar-2.jpg' alt='activity-user'>$students_full_name</h6>
                                                                            </td>
                                                                            <td>
                                                                                <h6 class='m-0'>$students_grade</h6>
                                                                            </td>
                                                                            
                                                                            <td>
                                                                                <h6 class='m-0'>$students_email</h6>
                                                                            </td>
                                                                            <td>
                                                                                <h6 class='m-0'>$students_contact_number</h6>
                                                                            </td>
                                                                            <td>
                                                                                <h6 class='m-0'>$students_whatsapp_number</h6>
                                                                            </td>
                                                                            <td>
                                                                                <h6 class='m-0'>$registed_time <br/> $registed_date</h6>
                                                                            </td>
                                                                            <td>
                                                                                <h6 class='m-0'>$students_district <br/> $students_city</h6>
                                                                            </td>
                                                                            
                                                                            <td>$students_password</td>
                                                                        </tr>";
                                                                    
                                                                    }

                                                                    
                                                                    
                                                                    
                                                                }
                                                                
                                                            }
                                                            
                                                        }
                                                                        
                                                    ?>

                                                    </tbody>
                                                </table>
                                        </div>
                                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                                <table class='table table-hover'>
                                                        <thead>
                                                            <tr>
                                                                <th>S_ID</th>
                                                                <th>Full Name</th>
                                                                <th>Grade</th>
                                                                <th>Email</th>
                                                                <th>Contact No</th>
                                                                <th>Whatsapp No</th>
                                                                <th>Time</th>
                                                                <th>Location</th>
                                                                
                                                                <th>Password</th>
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
                                                                    $students_sId = $datas15[$j]['S_ID'];
                                                                    $students_email = $datas15[$j]['EMAIL'];
                                                                    $students_full_name = $datas15[$j]['FULL_NAME'];
                                                                    $students_grade = $datas15[$j]['GRADE'];
                                                                    $students_district = $datas15[$j]['DISTRICT'];
                                                                    $students_city = $datas15[$j]['CITY'];
                                                                    $students_contact_number = $datas15[$j]['CONTACT_NUMBER'];
                                                                    $students_whatsapp_number = $datas15[$j]['WHATSAPP_NUMBER'];
                                                                    $students_password = $datas15[$j]['PASSWORD'];
                                                                    if(strpos($students_password," LOGIN_SESSION")){$students_password = 'N/A';}
                                                                    
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
                                                                                    <h6 class='m-0'>$students_sId</h6>
                                                                                </td>
                                                                                <td>
                                                                                    <h6 class='m-0'><img class='rounded-circle  m-r-10' style='width:40px;' src='assets/images/user/avatar-2.jpg' alt='activity-user'>$students_full_name</h6>
                                                                                </td>
                                                                                <td>
                                                                                    <h6 class='m-0'>$students_grade</h6>
                                                                                </td>
                                                                                
                                                                                <td>
                                                                                    <h6 class='m-0'>$students_email</h6>
                                                                                </td>
                                                                                <td>
                                                                                    <h6 class='m-0'>$students_contact_number</h6>
                                                                                </td>
                                                                                <td>
                                                                                    <h6 class='m-0'>$students_whatsapp_number</h6>
                                                                                </td>
                                                                                <td>
                                                                                    <h6 class='m-0'>$registed_time <br/> $registed_date</h6>
                                                                                </td>
                                                                                <td>
                                                                                    <h6 class='m-0'>$students_district <br/> $students_city</h6>
                                                                                </td>
                                                                                
                                                                                <td>$students_password</td>
                                                                            </tr>";
                                                                        
                                                                        }

                                                                        
                                                                        
                                                                        
                                                                    }
                                                                    
                                                                }
                                                                
                                                            }
                                                                            
                                                        ?>
                                                        </tbody>
                                                </table>
                                        </div>
                                        <div class="tab-pane fade" id="pills-registered" role="tabpanel" aria-labelledby="pills-registered">
                                                <table class='table table-hover'>
                                                                <thead>
                                                                    <tr>
                                                                        <th>S_ID</th>
                                                                        <th>Full Name</th>
                                                                        <th>Grade</th>
                                                                        <th>Email</th>
                                                                        <th>Contact No</th>
                                                                        <th>Whatsapp No</th>
                                                                        <th>Time</th>
                                                                        <th>Location</th>
                                                                        
                                                                        <th>Password</th>
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
                                                                            $students_sId = $datas15[$j]['S_ID'];
                                                                            $students_email = $datas15[$j]['EMAIL'];
                                                                            $students_full_name = $datas15[$j]['FULL_NAME'];
                                                                            $students_grade = $datas15[$j]['GRADE'];
                                                                            $students_district = $datas15[$j]['DISTRICT'];
                                                                            $students_city = $datas15[$j]['CITY'];
                                                                            $students_contact_number = $datas15[$j]['CONTACT_NUMBER'];
                                                                            $students_whatsapp_number = $datas15[$j]['WHATSAPP_NUMBER'];
                                                                            $students_password = $datas15[$j]['PASSWORD'];
                                                                            if(strpos($students_password," LOGIN_SESSION")){$students_password = 'N/A';}
                                                                            
                                                                            $student_regiered_time = $datas14[$j]['RESGISTED_DATE_TIME'];
                                                                            if($students_password != "N/A"){
                                                                                $student_regiered_time = strtotime($student_regiered_time);
                                                                                $registed_date = date('Y/m/d', $student_regiered_time);
                                                                                $registed_time = date('H:i A', $student_regiered_time);

                                                                                $FirstDay = date("Y/m/d", strtotime('sunday last week'));  
                                                                                $LastDay = date("Y/m/d", strtotime('sunday this week')); 
                                                                                
                                                                                // echo $registed_date."&nbsp &nbsp".$registed_time."<br/>";
                                                                                
                                                                                $today = date("Y/m/d");
                                                                                
                                                                                    echo 
                                                                                        "<tr>
                                                                                        <td>
                                                                                            <h6 class='m-0'>$students_sId</h6>
                                                                                        </td>
                                                                                        <td>
                                                                                            <h6 class='m-0'><img class='rounded-circle  m-r-10' style='width:40px;' src='assets/images/user/avatar-2.jpg' alt='activity-user'>$students_full_name</h6>
                                                                                        </td>
                                                                                        <td>
                                                                                            <h6 class='m-0'>$students_grade</h6>
                                                                                        </td>
                                                                                        
                                                                                        <td>
                                                                                            <h6 class='m-0'>$students_email</h6>
                                                                                        </td>
                                                                                        <td>
                                                                                            <h6 class='m-0'>$students_contact_number</h6>
                                                                                        </td>
                                                                                        <td>
                                                                                            <h6 class='m-0'>$students_whatsapp_number</h6>
                                                                                        </td>
                                                                                        <td>
                                                                                            <h6 class='m-0'>$registed_time <br/> $registed_date</h6>
                                                                                        </td>
                                                                                        <td>
                                                                                            <h6 class='m-0'>$students_district <br/> $students_city</h6>
                                                                                        </td>
                                                                                        
                                                                                        <td>$students_password</td>
                                                                                    </tr>";
                                                                                
                                                                                

                                                                                
                                                                                
                                                                                
                                                                            }
                                                                            
                                                                        }
                                                                        
                                                                    }
                                                                                    
                                                                ?>
                                                                </tbody>
                                                            </table>
                                                </div>

                                                <div class="tab-pane fade" id="pills-anonymous" role="tabpanel" aria-labelledby="pills-anonymous-tab">
                                                    <table class='table table-hover'>
                                                                    <thead>
                                                                        <tr>
                                                                            <th>S_ID</th>
                                                                            <th>Full Name</th>
                                                                            <th>Grade</th>
                                                                            <th>Email</th>
                                                                            <th>Contact No</th>
                                                                            <th>Whatsapp No</th>
                                                                            <th>Time</th>
                                                                            <th>Location</th>
                                                                            
                                                                            <th>Password</th>
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
                                                                                $students_sId = $datas15[$j]['S_ID'];
                                                                                $students_email = $datas15[$j]['EMAIL'];
                                                                                $students_full_name = $datas15[$j]['FULL_NAME'];
                                                                                $students_grade = $datas15[$j]['GRADE'];
                                                                                $students_district = $datas15[$j]['DISTRICT'];
                                                                                $students_city = $datas15[$j]['CITY'];
                                                                                $students_contact_number = $datas15[$j]['CONTACT_NUMBER'];
                                                                                $students_whatsapp_number = $datas15[$j]['WHATSAPP_NUMBER'];
                                                                                $students_password = $datas15[$j]['PASSWORD'];
                                                                                if(strpos($students_password," LOGIN_SESSION")){$students_password = 'N/A';}
                                                                                
                                                                                $student_regiered_time = $datas14[$j]['RESGISTED_DATE_TIME'];
                                                                                if($students_password == "N/A"){
                                                                                    $student_regiered_time = strtotime($student_regiered_time);
                                                                                    $registed_date = date('Y/m/d', $student_regiered_time);
                                                                                    $registed_time = date('H:i A', $student_regiered_time);

                                                                                    $FirstDay = date("Y/m/d", strtotime('sunday last week'));  
                                                                                    $LastDay = date("Y/m/d", strtotime('sunday this week')); 
                                                                                    
                                                                                    // echo $registed_date."&nbsp &nbsp".$registed_time."<br/>";
                                                                                    
                                                                                    $today = date("Y/m/d");
                                                                                    
                                                                                        echo 
                                                                                            "<tr>
                                                                                            <td>
                                                                                                <h6 class='m-0'>$students_sId</h6>
                                                                                            </td>
                                                                                            <td>
                                                                                                <h6 class='m-0'><img class='rounded-circle  m-r-10' style='width:40px;' src='assets/images/user/avatar-2.jpg' alt='activity-user'>$students_full_name</h6>
                                                                                            </td>
                                                                                            <td>
                                                                                                <h6 class='m-0'>$students_grade</h6>
                                                                                            </td>
                                                                                            
                                                                                            <td>
                                                                                                <h6 class='m-0'>$students_email</h6>
                                                                                            </td>
                                                                                            <td>
                                                                                                <h6 class='m-0'>$students_contact_number</h6>
                                                                                            </td>
                                                                                            <td>
                                                                                                <h6 class='m-0'>$students_whatsapp_number</h6>
                                                                                            </td>
                                                                                            <td>
                                                                                                <h6 class='m-0'>$registed_time <br/> $registed_date</h6>
                                                                                            </td>
                                                                                            <td>
                                                                                                <h6 class='m-0'>$students_district <br/> $students_city</h6>
                                                                                            </td>
                                                                                            
                                                                                            <td>$students_password</td>
                                                                                        </tr>";
                                                                                    
                                                                                    

                                                                                    
                                                                                    
                                                                                    
                                                                                }
                                                                                
                                                                            }
                                                                            
                                                                        }
                                                                                        
                                                                    ?>
                                                                    </tbody>
                                                                </table>
                                                </div>
                                        </div>
                                        
                                    </div>

                                                    

                                
                                <!-- [ tabs ] end -->
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
