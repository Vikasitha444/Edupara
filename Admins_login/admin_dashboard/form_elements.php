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

    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js' integrity='sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p' crossorigin='anonymous'></script>
    
    <!-- embed jquery -->
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>

    <style>
        a{text-decoration: none;}
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
                                        <h5 class="m-b-10">Add a teacher</h5>
                                    </div>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="./admin_dashboard.php?"><i class="feather icon-home"></i></a></li>
                                        <li class="breadcrumb-item"><a href="javascript:">Manage</a></li>
                                        <li class="breadcrumb-item"><a href="javascript:">Add a Teacher</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- [ breadcrumb ] end -->
                    <div class="main-body">
                        <div class="page-wrapper">
                            <!-- [ Main Content ] start -->
                            <h3 class="text-danger">Press [Tab] to go through forms and press Enter.</h3><br>
                            <div class="row">
                                <div class="col-sm-12">
                                    
                                    <!-- Grid Form Starts Here -->
                                    <form class="row g-3" action="form_elements.php?" method="POST" onsubmit="">
                                        <!-- The First row -->
                                        <div class="col-md-2">
                                            <label for="t_id" class="form-label">Teacher ID</label>
                                            <input type="email" class="form-control" id="t_id" value="105" readonly>
                                        </div>
                                        <div class="col-md-5">
                                            <label for="fname" class="form-label">First Name</label>
                                            <input type="text" placeholder="Enter your first name" required name="fname" class="form-control">
                                        </div>
                                        <div class="col-md-5">
                                            <label for="" class="form-label">Second Name</label>
                                            <input type="text" placeholder="Enter your second name" required name='sname' class="form-control">
                                        </div>
                                        

                                        <!-- The Second row -->
                                        <div class="col-md-12">
                                            <label for="" class="form-label">Identity Card Number</label>
                                            <input type="text" name='ID_num' placeholder='Enter your ID Number' maxlength="12" required class="form-control" id="idnum">
                                        </div>

                                        
                                        <!-- The eventh row -->
                                        <div class="col-md-6">
                                            <label for="" class="form-label">Gender</label>
                                            <input type="text" class="form-control" name="gender" class="form-control" placeholder="Gender will genarate automaticly" readonly>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="" class="form-label">Age</label>
                                            <input type="number" name='age' placeholder='Age will genarate automaticly' min="16" required class="form-control" readonly>
                                        </div>
                                        

                                        <!-- The third row -->
                                        <div class="col-md-6">
                                            <label for="" class="form-label">Email </font></label>
                                            <input type="email" placeholder="Enter your email"  name='email' required class="form-control" id="email">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="" class="form-label">Confirm Email <font id="message_2" style="font-size: 1.1rem; font-weight: bolder;"></font></label>
                                            <input type="email" placeholder="Enter your email" name='email' required class="form-control" id="email_confirm">
                                        </div>
                                        
                                        <!-- The forth row -->
                                        <div class="col-md-6">
                                            <label for="" class="form-label">Phone Number</label>
                                            <input type="tel" pattern="[0-9]{10}" maxlength="10" placeholder="Enter your number" required name='phone_number' class="form-control">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="" class="form-label">Whatsapp Number</label>
                                            <input type="tel" pattern="[0-9]{10}" maxlength="10" placeholder="Enter your Whatsapp number" name='whatsapp_number' class="form-control">
                                        </div>
                                        

                                        <!-- The fifth row -->
                                        <div class="col-md-12">
                                            <label for="" class="form-label">Education Level (Degree/ Higer Education certificates)</label>
                                            <input type="text" name='edu_level' placeholder='Bachelor/Masters/Doctorate' class="form-control">
                                        </div>

                                        <!-- The sixth row -->
                                        <div class="col-md-8">
                                            <label for="" class="form-label">Univeristy</label>
                                            <input type="text" name='university' placeholder='Enter your university' class="form-control">
                                        </div>

                                        <div class="col-md-4">
                                            <label for="" class="form-label">Graduate Year</label>
                                            <input type="year" maxlength="4" pattern="{0-9}4" name='graduated_year' placeholder='Enter your graduated year' class="form-control">
                                        </div>
                                        

                                        <!-- The seventh row -->
                                        <div class="col-md-6">
                                            <label for="" class="form-label">Teaching Since (In which year you stared to teach)</label>
                                            <input type="year" maxlength="4" name='teaching_since' placeholder='Enter the year you stared teaching' class="form-control">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="" class="form-label">How many subjects do you teach</label>
                                            <input type="number" min="1" name='amount_subjects' placeholder='Enter your amount of subjects' class="form-control">
                                        </div>
                                        
                                        <!-- The eighth row -->
                                        <div class="col-md-6">
                                            <label for="" class="form-label">Password</label>
                                            <input type="text" placeholder="Enter your password" required name='password' id="password" minlength="8" class="form-control">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="" class="form-label">Confirm Password <font id="message" style="font-size: 1.1rem; font-weight: bolder;"></font></label>
                                            <input type="password" placeholder="Confirm your password" required name='confirm_password' id="confirm_password" minlength="8" class="form-control">
                                            
                                        </div>

                                       
                                        
                                        <!-- The nineth row -->
                                        <div class="col-md-6">
                                            <label for="" class="form-label">Class Type</label>
                                            <div class="form-check">
                                                <input type="radio" name="class_type_input" id="dot-1" required="required" value="Online" class="form-check-input">
                                                <label class="form-check-label" for="gridCheck1">Online</label><br>

                                                <input type="radio" name="class_type_input" id="dot-2" value="Physical" class="form-check-input">
                                                <label class="form-check-label" for="gridCheck1">Physical</label><br>

                                                <input type="radio" name="class_type_input" id="dot-3" value="Both" class="form-check-input">
                                                <label class="form-check-label" for="gridCheck1">Both</label><br>
                                              </div>
                                        </div>

                                        <div class="col-md-2">
                                            <label for="" class="form-label">Registred Time</label>
                                            <input type="email" class="form-control" id="reg_time" value="" readonly>
                                        </div>

                                        <div class="col-md-2">
                                            <label for="" class="form-label">Joined Year</label>
                                            <input type="email" class="form-control" id="joined_year" readonly>
                                        </div>

                                        <div class="col-md-2">
                                            <label for="" class="form-label">Joined Time</label>
                                            <input type="email" class="form-control" id="joined_time" readonly>
                                        </div>

                                        <!-- The tenth rows -->
                                        <div class="col-md-12">
                                            <label for="" class="form-label">Facebook link</label>
                                            <input type='text' class='form-control' placeholder='Facebook Page or profile link' maxlenth='255' name='facebook_link'>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="" class="form-label">Youtube link</label>
                                            <input type='text' class='form-control' placeholder='Youtube Channel link' maxlenth='255' name='youtube_link'>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="" class="form-label">Website link</label>
                                            <input type='text' class='form-control' id='form-website' placeholder='http://' name='website_link' maxlenth='255'>
                                        </div>
                                        

                                        
                                        <!-- The twelveth row -->
                                        <div class="col-md-6">
                                            <label for="" class="form-label">Do you teach in School</label>
                                            <div class="form-check">
                                            <input type='radio' id='inlineradio1' value='Yes' name='teach_in_school' required class="form-check-input">
                                                <label class="form-check-label" for="gridRadios1">Yes</label>
                                              </div>
                                              <div class="form-check">
                                              <input type='radio' id='inlineradio2' value='No' name='teach_in_school' required class="form-check-input">
                                                <label class="form-check-label" for="gridRadios2">No</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="" class="form-label">Languages (Medium)</label>
                                            <div class="form-check">
                                                <input type='checkbox' value='Sinhala' name='language[]' class="form-check-input">
                                                <label class="form-check-label">Sinhala</label>
                                            </div>

                                            <div class="form-check">
                                                <input type='checkbox' value='English' name='language[]' class="form-check-input">
                                                <label class="form-check-label">English</label>
                                            </div>

                                            <div class="form-check">
                                                <input type='checkbox' value='Tamil' name='language[]' class="form-check-input">
                                                <label class="form-check-label">Tamil</label>
                                            </div>
                                        </div>


                                        <!-- The therteen row -->
                                        <div class="col-md-6">
                                            <label for="" class="form-label">Discription (Motto)</label>
                                            <textarea class='form-control' maxlength='255' name='motto' cols="45" rows="10"></textarea>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="" class="form-label">Additional Details</label>
                                            <textarea name="additional_details" id="" cols="45" rows="10" placeholder="Discribe about you briefly" maxlength="255" class="form-control"></textarea>
                                        </div>

                                        <!-- Before final row -->
                                        <div class="col-md-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" required>
                                                <label class="form-check-label">
                                                  I know about the risk and other consequences
                                                </label>
                                              </div>
                                        </div>

                                        <!-- final rows -->
                                        <div class="col-md-6">
                                            <button type="submit" name ="add_teacher" class="btn btn-primary btn-lg" id="add_teacher">Add teacher to Database with my own risk</button>
                                        </div>

                                        <div class="col-md-6">
                                            <font id="message_4" style="font-size: 1.1rem;" class="text-danger"></font>
                                        </div>
                                            
                                        
                                            
                                            
                                    </form>
                                        
                                        
                                        <script>
                                            $('#password, #confirm_password').on('keyup', function () {
                                            if ($('#password').val() == $('#confirm_password').val() && $('#password').val().length >=8 && $('#confirm_password').val().length >=8) {
                                                $('#message').html('').css('color', 'green');
                                                
                                            } else 
                                                $('#message').html('Passwords are not matching').css('color', 'red');
                                            });
                                        </script>
                                        
                                        
                                        <script>
                                            $('#email, #email_confirm').on('keyup', function () {
                                            if ($('#email').val() == $('#email_confirm').val()) {
                                                $('#message_2').html('').css('color', 'green');
                                                
                                            } else 
                                                $('#message_2').html('Emails are not matching').css('color', 'red');
                                            });
                                        </script>


                                        <script>
                                            $("input[required]").focusout(function(){
                                                if($(this).val() == ''){
                                                    $("#message_3").text($(this).attr('name')+" is not filed");
                                                }
                                            });
                                        </script>
                                            

                                            
                                            
                                        
                                        <script>
                                            $("#idnum").keyup(function(){
                                                if($("#idnum").val().length >= 10){
                                                    resultDisplay();
                                                    
                                                    $("input[name='gender']").attr('value',gender);
                                                    $("input[name='age']").attr('value',age);
                                                    $("input[name='age']").text(age);

                                                    
                                                    
                                                }
                                            });

                                            
                                            
                                        </script>
                                        

                                        <script>
                                            //Variable declaration======================================================================
                                            //Number of dates in months
                                            var totalDates = [31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
                                            
                                            //Names of Months
                                            var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

                                            
                                            //Validation Part======================================================================
                                            function resultDisplay(){
                                                
                                                //Get the user input NIC card number
                                                var idNumber = document.getElementById("idnum").value;
                                                
                                                //Check the 3 digits for use month & day
                                                var checkThreeOld = idNumber.substring(2, 5);
                                                var checkThreeNew = idNumber.substring(4, 7);

                                                //Check the last digit of the OLD NIC
                                                var checkV = idNumber.endsWith('V');
                                                var checkv = idNumber.endsWith('v');

                                                //Check the first digit of the NEW NIC
                                                var checkOne = idNumber.startsWith('1');
                                                var checkTow = idNumber.startsWith('2');


                                                //Validation start here
                                                if (idNumber.length == 10 && (checkV == true || checkv == true) && (checkThreeOld <= 366 || (checkThreeOld >= 501 && checkThreeOld <= 866))) {
                                                    
                                                    oldNIC(idNumber);
                                                } else if (idNumber.length == 12 && (checkOne == true || checkTow == true) && (checkThreeNew <= 366 || (checkThreeNew >= 501 && checkThreeNew <= 866))) {
                                                    
                                                    newNIC(idNumber);
                                                } 

                                            }


                                            //OLD NIC Functionality=================================================================
                                            function oldNIC(idNumber) {
                                                
                                                //Get the First 2 digits(Birth year)
                                                var str = idNumber;
                                                var year = str.substring(0, 2);

                                                //Get the Next 3 digits in NIC(Birth month & day)
                                                var nextThreeDigits = parseInt(str.substring(2, 5));

                                                //Validate gender
                                                var gender = "Male";
                                                if (nextThreeDigits > 500) {
                                                    nextThreeDigits -= 500;
                                                    gender = "Female"; //If day value > 500 it means NIC owner is a female.
                                                }
                                                
                                               

                                                

                                                var year_with_prefix = parseInt("19"+year);
                                                var age = new Date().getFullYear() - year_with_prefix;
                                                
                                                window.gender = gender;
                                                window.age = age;
                                                
                                                

                                                

                                            }


                                            //NEW NIC Functionality=================================================================
                                            function newNIC(idNumber) {

                                                //Get the First 4 digits(Birth year)
                                                var str = idNumber;
                                                var year = str.substring(0, 4);

                                                //Get the Next 3 digits in NIC(Birth month & day)
                                                var nextThreeDigits = parseInt(str.substring(4, 7));

                                                //Validate gender
                                                var gender = "Male";
                                                if (nextThreeDigits > 500) {
                                                    nextThreeDigits -= 500;
                                                    gender = "Female"; //If day value > 500 it means NIC owner is a female.
                                                }

                                                var age = new Date().getFullYear() - year;
                                                window.gender = gender;
                                                window.age = age;

                                            }


                                        </script>

                                        

                                        <script>
        									function handleData()
													{
														var form_data = new FormData(document.querySelector('form'));
														
														if(!form_data.has('language[]'))
														{
															document.getElementById('chk_option_error').style.visibility = 'visible';
														return false;
														}
														else
														{
															document.getElementById('chk_option_error').style.visibility = 'hidden';
														return true;
														}
														
													}
										
										</script>
                                        

                                        <script>
                                            $(function(){
                                                $('form').submit(function(e){
                                                    if($("input[name='language[] :checked")){
                                                        
                                                    }else{
                                                        alert('not ticked');
                                                        e.preventDefault();
                                                    }
                                                });
                                            });
                                        </script>

                                        <?php
                                            $sql2 = "SELECT T_ID FROM teachers ORDER BY T_ID DESC LIMIT 1;";
                                            $next_TID_number = mysqli_fetch_assoc(mysqli_query($conn, $sql2));
                                            $next_TID_number = (int) $next_TID_number['T_ID'];
                                            $next_TID_number++;

                                            echo "<script>$('#t_id').val($next_TID_number)</script>";


                                        ?>

                                        <script>
                                            var today = new Date();
                                            var dd = String(today.getDate()).padStart(2, '0');
                                            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                                            var yyyy = today.getFullYear();

                                            today = mm + '/' + dd + '/' + yyyy;
                                            $("#reg_time").val(today);
                                            
                                        </script>

                                        <script>
                                            const d = new Date();
                                            let year = d.getFullYear();

                                            $("#joined_year").val(year);
                                        </script>

                                        <script>
                                            var time = new Date().toLocaleTimeString(); // 11:18:48 AM
                                            $("#joined_time").val(time);
                                        </script>


                                        
                                        
                                        
                                        <?php
                                            if(isset($_POST['add_teacher'])){
                                                $fname = $_POST['fname'];
                                                $sname = $_POST['sname'];
                                                $age = $_POST['age'];
                                                $id_num = $_POST['ID_num'];
                                                $email = $_POST['email'];
                                                $phone_number = $_POST['phone_number'];
                                                $whattsapp_number = $_POST['whatsapp_number'];
                                                $edu_level = $_POST['edu_level'];
                                                $university = $_POST['university'];
                                                $graduated_year = $_POST['graduated_year'];
                                                $teaching_since = $_POST['teaching_since'];
                                                $amount_subjects = $_POST['amount_subjects'];
                                                $password = $_POST['password'];
                                                $confirm_password = $_POST['confirm_password'];
                                                $additional_details = $_POST['additional_details'];
                                                $class_type_input = $_POST['class_type_input'];
                                                $facebook_link = $_POST['facebook_link'];
                                                $youtube_link = $_POST['youtube_link'];
                                                $website_link = $_POST['website_link'];
                                                $gender = $_POST['gender'];
                                                $amount_subjects = $_POST['amount_subjects'];
                                                $teach_in_school = $_POST['teach_in_school'];
                                                $languages = $_POST['language'];
                                                $motto = $_POST['motto'];
                                            
                                                if (array_key_exists("0", $languages) == 0){ // 0 = Sinhala
                                                    array_push($languages,'');
                                                
                                                }elseif(array_key_exists("1", $languages) == 0){ //1 = English
                                                    array_push($languages,'');
                                                
                                                }elseif(array_key_exists("2", $languages) == 0){ //2 = Tamil
                                                    array_push($languages,'');
                                                }
                                                

                                                //Adding values to database
                                                $sql = "INSERT INTO teachers(FNAME,SNAME,AGE,ID_NUM,EMAIL,PHONE_NUMBER,WHATSAPP_NUMBER,EDU_LEVEL,UNIVERSITY,GARDUATED_YEAR,TEACHING_SINCE,AMOUNT_SUBJECTS,PASSWORD,CONFIRM_PASSWORD,ADDITIONAL_DETAILS,CLASS_TYPE_INPUT,REGISTERED_TIME,JOINED_YEAR,JOINED_TIME,FACEBOOK_LINK,YOUTUBE_LINK,WEBSITE_LINK,GENDER,TEACH_IN_SCHOOL,LANGUAGES,MOTTO)
                                                VALUES ('$fname','$sname','$age', '$id_num','$email','$phone_number','$whattsapp_number','$edu_level','$university','$graduated_year','$teaching_since','$amount_subjects','$password','$confirm_password','$additional_details','$class_type_input',now(),now(),now(),'$facebook_link','$youtube_link','$website_link','$gender','$teach_in_school','$languages[0] / $languages[1] / $languages[2]','$motto');";     
                                            
                                                
                                                
                                                
                                                $resultInsert = mysqli_query($conn, $sql);

                                                if($resultInsert === TRUE){
                                                      //If something went error uncomment this and see the error   
                                                        echo"<script>alert('Teacher Added to DB');</script>";
                                                         echo "<script>window.location.replace('bc_badges.php?');</script>";
                                                  }
                                                    else{
                                                        echo "Error : ". $sql . "<br>" . $conn -> error;
                                                            }
                                                            
                                                
                                                
                                            
                                            }

                                        ?>
                                            
                                                
                                    <!-- Grid form ends here -->
                                                
                                    




                                        
                                        

                                        
                                        

                                    
                                    
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
