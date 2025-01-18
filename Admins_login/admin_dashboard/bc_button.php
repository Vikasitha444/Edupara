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
                                        <h5 class="m-b-10">Teachers under review</h5>
                                    </div>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="./admin_dashboard.php?"><i class="feather icon-home"></i></a></li>
                                        <li class="breadcrumb-item"><a href="javascript:">Manage</a></li>
                                        <li class="breadcrumb-item"><a href="javascript:">Teachers under review</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- [ breadcrumb ] end -->
                    <div class="main-body">
                        <div class="page-wrapper">
                            <!-- [ Main Content ] start -->

                            <div class="col-xl-11 col-md-6">
                                    <div class="card Recent-Users">
                                        <div class="card-header">
                                            <h5>Teachers Under Review</h5><br/>
                                            <small><i class='fas fa-circle text-c-green f-10 m-r-15'></i>Online</small><br/>
                                            <small><i class='fas fa-circle text-c-red f-10 m-r-15'></i>Physical</small><br/>
                                        </div>
                                        <div class="card-block px-0 py-3">
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <tbody>
                                                        
                                                    <?php
                                                        
                                                    
                                                        $sql = "SELECT FNAME,SNAME,AGE,ID_NUM,EMAIL,PHONE_NUMBER,WHATSAPP_NUMBER,EDU_LEVEL,UNIVERSITY,GARDUATED_YEAR,TEACHING_SINCE,AMOUNT_SUBJECTS,PASSWORD,CONFIRM_PASSWORD,ADDITIONAL_DETAILS,CLASS_TYPE_INPUT,DATE_TIME FROM teachers_under_review;";
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
                                                                                <h6 class='mb-1'>$fname $sname</h6>
                                                                                <p class='m-0'>$email</p>
                                                                                <td><p class='m-0'>First Name : $fname<br/>Second Name : $sname<br/>Age : $age<br/>ID_Num : $id_num<br/>Telephone : $phone_number<br/>Whatsapp : $whatsapp_number<br/>Edu. Level : $edu_level<br/>University : $university<br/>Graduated year : $graduated_year<br/>Teaching since : $teaching_since<br/>Amount subjects : $amount_subjects<br/>Password : $password<br/>Additional Details : $additional_details</p></td>
                                                                            </td>
                                                                            <td>
                                                                                <h6 class='text-muted'>$dot</i>$date_time</h6>
                                                                            </td>
                                                                            <td><a href='admin_dashboard.php?getInfo=$id_num' class='label theme-bg2 text-white f-25' onclick='return confirm(`$fname $sname will Reject. Do you want to proceed with this?`)'>Reject</a><a href='bc_button.php?getInfo2=$id_num' class='label theme-bg text-white f-25' onclick='return confirm(`$fname $sname will Approve. Are you sure about this?`)'>Approve</a></td>
                                                                        </tr>";

                                                                
                                                                array_push($teachers_ID_list,$id_num);

                                                                
                                                        }
                                                        
                                                            if (isset($_GET['getInfo'])){
                                                                $id_num = urldecode($_GET['getInfo']);
                                                                
                                                                $sql3 = "DELETE FROM teachers_under_review WHERE ID_NUM = '$id_num';";

                                                                $resultInsert = mysqli_query($conn, $sql3) ;
 
                                                                // if($resultInsert === TRUE){
                                                                //     //If something went error uncomment this and see the error   
                                                                //     echo"<script>alert('Data Insert');</script>";
                                                                // }
                                                                // else{
                                                                //     echo "Error : ". $sql . "<br>" . $conn -> error;
                                                                //         }
                                                                
                                                                echo "<script>alert('Teacher Removed! Please wait until next page refresh');</script>";
                                            
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


                                                                 if($resultInsert === TRUE){
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
                                                                                echo "<script>window.location.replace('bc_button.php?')</script>";
                                                                            }else{
                                                                                echo "<script>alert('something went wrong with the email account');</script>";
                                                                            }
                                                                        }
                                                                    }
                                                                   else{
                                                                       //echo "Error : ". $sql . "<br>" . $conn -> error;
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
