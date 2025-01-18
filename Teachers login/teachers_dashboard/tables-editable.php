<?php

if(isset($_COOKIE["email"]) and isset($_COOKIE["password"])){
	$email_from_cookie = $_COOKIE["email"];
	$password_from_cookie = $_COOKIE['password'];


}else{
	echo "<script>window.location.replace('../Teachers_login.php?');</script>";
}

$server_db = file_get_contents("../../database details/server.txt", "r") or die("Unable to open file!");
$username_db = file_get_contents("../../database details/username.txt", "r") or die("Unable to open file!");
$password_db = file_get_contents("../../database details/password.txt", "r") or die("Unable to open file!");
$database_name_db = file_get_contents("../../database details/dbname.txt", "r") or die("Unable to open file!");


 //Connect the Database'
//Change to the server database
//$conn = new mysqli($server,$username,$password,$database);
$conn = new mysqli($server_db,$username_db,$password_db,$database_name_db);


//Check the Connection was Sussesfull
if ($conn->connect_error){
	die."Connection Interuppted";
}

//echo "Connection Successful";							//Eneble this if Database not Successfuly Connected



$sql = "SELECT T_ID, FNAME, SNAME, AGE, ID_NUM, EMAIL, PHONE_NUMBER, WHATSAPP_NUMBER, EDU_LEVEL, UNIVERSITY, GARDUATED_YEAR, TEACHING_SINCE, AMOUNT_SUBJECTS, PASSWORD, CONFIRM_PASSWORD, ADDITIONAL_DETAILS, CLASS_TYPE_INPUT,REGISTERED_TIME, JOINED_YEAR, JOINED_TIME, IMAGE_NAME,SUBJECTS_ON_DATABASE
				FROM teachers	
				WHERE EMAIL = '$email_from_cookie' and PASSWORD = '$password_from_cookie';";


$resalt = mysqli_query($conn,$sql);					         //get the resalt between $conn and, run $sql	
$resaltcheck = mysqli_num_rows($resalt);
$datas = array();


if ($resaltcheck > 0) {
	while ($row = mysqli_fetch_assoc($resalt)){
		//echo $row['Image'];
		$datas[] = $row;  }
	}

	$t_id = $datas[0]['T_ID'];
	$fname = $datas[0]['FNAME'];
	$sname = $datas[0]['SNAME'];
	$age = $datas[0]['AGE'];
	$id_num = $datas[0]['ID_NUM'];
	$email = $datas[0]['EMAIL'];
	$phone_number = $datas[0]['PHONE_NUMBER'];
	$whatsapp_number = $datas[0]['WHATSAPP_NUMBER'];
	$edu_level = $datas[0]['EDU_LEVEL'];
	$university = $datas[0]['UNIVERSITY'];
	$graduated_year = $datas[0]['GARDUATED_YEAR'];
	$teaching_since = $datas[0]['TEACHING_SINCE'];
	$amount_subjects = $datas[0]['AMOUNT_SUBJECTS'];
	$password = $datas[0]['PASSWORD'];
	$confirm_password = $datas[0]['CONFIRM_PASSWORD'];
	$additional_details = $datas[0]['ADDITIONAL_DETAILS'];
	$class_type = $datas[0]['CLASS_TYPE_INPUT'];
	$registerd_time = $datas[0]['REGISTERED_TIME'];
	$joined_year = $datas[0]['JOINED_YEAR'];
	$joined_time = $datas[0]['JOINED_TIME'];
	$subjects_on_database = $datas[0]['SUBJECTS_ON_DATABASE'];
	

	$sql2 = "SELECT IMAGE_NAME 
				FROM teachers 
				WHERE EMAIL = '$email_from_cookie' and PASSWORD = '$password_from_cookie'";

	$result2 = mysqli_query($conn,$sql2);
	$row2 = mysqli_fetch_array($result2);

	$image = $row2['IMAGE_NAME'];
	$image_src = "../../uploads/".$image;


	$rest_of_subjects = intval($amount_subjects) - intval($subjects_on_database);





//Counting How many subjects has added
    $sql = "SELECT FACEBOOK_LINK, YOUTUBE_LINK, WEBSITE_LINK, TEACH_IN_SCHOOL, LANGUAGES, MOTTO, SUBJECTS_ON_DATABASE
            FROM teachers	
            WHERE EMAIL = '$email_from_cookie' and PASSWORD = '$password_from_cookie';";


    $resalt = mysqli_query($conn,$sql);					         //get the resalt between $conn and, run $sql	
    $resaltcheck = mysqli_num_rows($resalt);
    $datas = array();


    if ($resaltcheck > 0) {
    while ($row = mysqli_fetch_assoc($resalt)){
    //echo $row['Image'];
    $datas[] = $row;  }
    }

    
    $facebook_link = $datas[0]['FACEBOOK_LINK'];
    $youtube_link = $datas[0]['YOUTUBE_LINK'];
    $website_link = $datas[0]['WEBSITE_LINK'];
    $teach_in_school = $datas[0]['TEACH_IN_SCHOOL'];
    $languages = $datas[0]['LANGUAGES'];
    $motto = $datas[0]['MOTTO'];


if(($whatsapp_number && $edu_level && $university && $graduated_year && $teaching_since && $image && $facebook_link &&
    $youtube_link && $website_link && $teach_in_school && $languages
    && $motto) != NULL){
    
}

$table_column_array = [$whatsapp_number, $edu_level, $university, $graduated_year, $teaching_since, $image, $facebook_link,
                        $youtube_link, $website_link, $teach_in_school, 
                        $languages,$motto,$image];

$sum = 0;
for ($k=0; $k < count($table_column_array); $k++) { 
    if(($table_column_array[$k] != NULL) && ($table_column_array[$k] != '') &&
		($table_column_array[$k] != 'no user.png')){
			$sum = $sum + 1;
	}	
}

$presentage = ceil( ( $sum / count($table_column_array) ) * 100 ); //Round number to nearst int


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

    <meta charset="utf-8">
    <title>Teachers Dashboard - My Time Table | Edupara.lk</title>
    <link rel="shortcut icon" href="../../index/img/core-img/favicon.ico" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="description" content="My Time Table | Edupara.lk">
    <meta name="author" content="KaijuThemes">

    <link type='text/css' href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600' rel='stylesheet'>

    <link type="text/css" href="assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">        <!-- Font Awesome -->
    <link type="text/css" href="assets/fonts/themify-icons/themify-icons.css" rel="stylesheet">              <!-- Themify Icons -->
    <link type="text/css" href="assets/css/styles.css" rel="stylesheet">                                     <!-- Core CSS with all styles -->
	
    <link type="text/css" href="assets/plugins/codeprettifier/prettify.css" rel="stylesheet">                <!-- Code Prettifier -->
    <link type="text/css" href="assets/plugins/iCheck/skins/minimal/blue.css" rel="stylesheet">              <!-- iCheck -->
	
    <!--[if lt IE 10]>
        <script type="text/javascript" src="assets/js/media.match.min.js"></script>
        <script type="text/javascript" src="assets/js/respond.min.js"></script>
        <script type="text/javascript" src="assets/js/placeholder.min.js"></script>
    <![endif]-->
    <!-- The following CSS are included as plugins and can be removed if unused-->
	<link type="text/css" href="assets/plugins/dropzone/css/dropzone.css" rel="stylesheet">  							<!-- Dropzone Plugin -->    
	<link type="text/css" href="assets/plugins/form-fseditor/fseditor.css" rel="stylesheet">                      		<!-- FullScreen Editor -->



	<style>
            @import url('https://fonts.googleapis.com/css?family=Amarante');

            
            

            br { display: block; line-height: 1.6em; } 

            article, aside, details, figcaption, figure, footer, header, hgroup, menu, nav, section { display: block; }
            ol, ul { list-style: none; }

            
            blockquote, q { quotes: none; }
            blockquote:before, blockquote:after, q:before, q:after { content: ''; content: none; }
            strong, b { font-weight: bold; } 

            table { border-collapse: collapse; border-spacing: 0; }
            img { border: 0; max-width: 100%; }

            h1 { 
            font-family: 'Amarante', Tahoma, sans-serif;
            font-weight: bold;
            font-size: 3.6em;
            line-height: 1.7em;
            margin-bottom: 10px;
            text-align: center;
            }

            /** page structure **/
            #wrapper {
            display: block;
            overflow: visible;
            background: #fff;
            
            
            -webkit-box-shadow: 2px 2px 3px -1px rgba(0,0,0,0.35);
            }

            #keywords {
            margin: 0 auto;
            font-size: 1.2em;
            margin-bottom: 15px;
            }

            #keywords thead {
            cursor: pointer;
            background: #01BCD4;
            color: white;
            }
            #keywords thead tr th { 
            font-weight: bold;
            padding: 12px 30px;
            padding-left: 42px;
            }
            #keywords thead tr th span { 
            padding-right: 20px;
            background-repeat: no-repeat;
            background-position: 100% 100%;
            }

            #keywords thead tr th.headerSortUp, #keywords thead tr th.headerSortDown {
            background: #acc8dd;
            }

            #keywords thead tr th.headerSortUp span {
            background-image: url('https://i.imgur.com/SP99ZPJ.png');
            }
            #keywords thead tr th.headerSortDown span {
            background-image: url('https://i.imgur.com/RkA9MBo.png');
            }

            #keywords tbody tr { 
            color: #555;
            }
            #keywords tbody tr td {
            text-align: center;
            padding: 15px 10px;
            }
            #keywords tbody tr td.lalign {
            text-align: left;
            }

            @media only screen and (max-width: 800px){
                #wrapper{
                    overflow: scroll;
                }
            }
                
            
        </style>


    

</head>

<body class="animated-content">
	
		
	<!-- presentage will be here -->
    <span id='presentage'><?php echo $presentage; ?>%</span>	

	<header id="topnav" class="navbar navbar-default navbar-fixed-top" role="banner">

	<div class="logo-area">
		<span id="trigger-sidebar" class="toolbar-trigger toolbar-icon-bg">
			<a data-toggle="tooltips" data-placement="right" title="Toggle Sidebar">
				<span class="icon-bg">
					<i class="ti ti-menu"></i>
				</span>
			</a>
		</span>
		
		<!-- <a class="navbar-brand" href="./index_original.php?">Avenxo</a> -->

		<!-- <div class="toolbar-icon-bg hidden-xs" id="toolbar-search">
            <div class="input-group">
            	<span class="input-group-btn"><button class="btn" type="button"><i class="ti ti-search"></i></button></span>
				<input type="text" class="form-control" placeholder="Search...">
				<span class="input-group-btn"><button class="btn" type="button"><i class="ti ti-close"></i></button></span>
			</div>
        </div> -->

        <div class="" style="width:170px; height:100%; text-align:center; margin-top:15px; ">
			<img src="../../index/img/core-img/logo.png" width="1700px">
		</div>

	</div><!-- logo-area -->

	<ul class="nav navbar-nav toolbar pull-right">

		<!-- <li class="toolbar-icon-bg visible-xs-block" id="trigger-toolbar-search">
			<a href="#"><span class="icon-bg"><i class="ti ti-search"></i></span></a>
		</li>
        
		<li class="toolbar-icon-bg hidden-xs">
            <a href="#"><span class="icon-bg"><i class="ti ti-world"></i></span></i></a>
        </li>

        <li class="toolbar-icon-bg hidden-xs">
            <a href="#"><span class="icon-bg"><i class="ti ti-view-grid"></i></span></i></a>
        </li>

        <li class="toolbar-icon-bg hidden-xs" id="trigger-fullscreen">
            <a href="#" class="toggle-fullscreen"><span class="icon-bg"><i class="ti ti-fullscreen"></i></span></i></a>
        </li> -->

        <!-- <li class="dropdown toolbar-icon-bg hidden-xs">
			<a href="#" class="hasnotifications dropdown-toggle" data-toggle='dropdown'><span class="icon-bg"><i class="ti ti-email"></i></span><span
			class="badge badge-deeporange">2</span></a>
			<div class="dropdown-menu notifications arrow">
				<div class="topnav-dropdown-header">
					<span>Messages</span>
				</div>
				<div class="scroll-pane">
					<ul class="media-list scroll-content">
						<li class="media notification-message">
							<a href="#">
								<div class="media-left">
									<img class="img-circle avatar" src="http://placehold.it/300&text=Placeholder" alt="" />
								</div>
								<div class="media-body">
									<h4 class="notification-heading"><strong>Vincent Keller</strong> <span class="text-gray">‒ Design should be ...</span></h4>
									<span class="notification-time">2 mins ago</span>
								</div>
							</a>
						</li>
						<li class="media notification-message">
							<a href="#">
								<div class="media-left">
									<img class="img-circle avatar" src="http://placehold.it/300&text=Placeholder" alt="" />
								</div>
								<div class="media-body">
									<h4 class="notification-heading"><strong>Frend Pratt</strong> <span class="text-gray">‒ I will start with the ...</span></h4>
									<span class="notification-time">40 mins ago</span>
								</div>
							</a>
						</li>
						<li class="media notification-message">
							<a href="#">
								<div class="media-left">
									<img class="img-circle avatar" src="http://placehold.it/300&text=Placeholder" alt="" />
								</div>
								<div class="media-body">
									<h4 class="notification-heading"><strong>Cynthia Hines</strong> <span class="text-gray">‒ Interior bits are ...</span></h4>
									<span class="notification-time">6 hours ago</span>
								</div>
							</a>
						</li>
						<li class="media notification-message">
							<a href="#">
								<div class="media-left">
									<img class="img-circle avatar" src="http://placehold.it/300&text=Placeholder" alt="" />
								</div>
								<div class="media-body">
									<h4 class="notification-heading"><strong>Robin Horton</strong> <span class="text-gray">‒ Are you even ...</span></h4>
									<span class="notification-time">8 days ago</span>
								</div>
							</a>
						</li>
						<li class="media notification-message">
							<a href="#">
								<div class="media-left">
									<img class="img-circle avatar" src="http://placehold.it/300&text=Placeholder" alt="" />
								</div>
								<div class="media-body">
									<h4 class="notification-heading"><strong>Amanda Torrez</strong> <span class="text-gray">‒ The message is ...</span></h4>
									<span class="notification-time">16 hours ago</span>
								</div>
							</a>
						</li>
						<li class="media notification-message">
							<a href="#">
								<div class="media-left">
									<img class="img-circle avatar" src="http://placehold.it/300&text=Placeholder" alt="" />
								</div>
								<div class="media-body">
									<h4 class="notification-heading"><strong>Khan Farhan</strong> <span class="text-gray">‒ Expected the stuff ...</span></h4>
									<span class="notification-time">2 days ago</span>
								</div>
							</a>
						</li>
						<li class="media notification-message">
							<a href="#">
								<div class="media-left">
									<img class="img-circle avatar" src="http://placehold.it/300&text=Placeholder" alt="" />
								</div>
								<div class="media-body">
									<h4 class="notification-heading"><strong>Will Whedon</strong> <span class="text-gray">‒ The movie of this ...</span></h4>
									<span class="notification-time">4 days ago</span>
								</div>
							</a>
						</li>
					</ul>
				</div>
				<div class="topnav-dropdown-footer">
					<a href="#">See all messages</a>
				</div>
			</div>
		</li> -->
		
		<!-- <li class="dropdown toolbar-icon-bg">
			<a href="#" class="hasnotifications dropdown-toggle" data-toggle='dropdown'><span class="icon-bg"><i class="ti ti-bell"></i></span><span class="badge badge-deeporange">2</span></a>
			<div class="dropdown-menu notifications arrow">
				<div class="topnav-dropdown-header">
					<span>Notifications</span>
				</div>
				<div class="scroll-pane">
					<ul class="media-list scroll-content">
						<li class="media notification-success">
							<a href="#">
								<div class="media-left">
									<span class="notification-icon"><i class="ti ti-check"></i></span>
								</div>
								<div class="media-body">
									<h4 class="notification-heading">Update 1.0.4 successfully pushed</h4>
									<span class="notification-time">8 mins ago</span>
								</div>
							</a>
						</li>
						<li class="media notification-info">
							<a href="#">
								<div class="media-left">
									<span class="notification-icon"><i class="ti ti-check"></i></span>
								</div>
								<div class="media-body">
									<h4 class="notification-heading">Update 1.0.3 successfully pushed</h4>
									<span class="notification-time">24 mins ago</span>
								</div>
							</a>
						</li>
						<li class="media notification-teal">
							<a href="#">
								<div class="media-left">
									<span class="notification-icon"><i class="ti ti-check"></i></span>
								</div>
								<div class="media-body">
									<h4 class="notification-heading">Update 1.0.2 successfully pushed</h4>
									<span class="notification-time">16 hours ago</span>
								</div>
							</a>
						</li>
						<li class="media notification-indigo">
							<a href="#">
								<div class="media-left">
									<span class="notification-icon"><i class="ti ti-check"></i></span>
								</div>
								<div class="media-body">
									<h4 class="notification-heading">Update 1.0.1 successfully pushed</h4>
									<span class="notification-time">2 days ago</span>
								</div>
							</a>
						</li>
						<li class="media notification-danger">
							<a href="#">
								<div class="media-left">
									<span class="notification-icon"><i class="ti ti-arrow-up"></i></span>
								</div>
								<div class="media-body">
									<h4 class="notification-heading">Initial Release 1.0</h4>
									<span class="notification-time">4 days ago</span>
								</div>
							</a>
						</li>
					</ul>
				</div>
				<div class="topnav-dropdown-footer">
					<a href="#">See all notifications</a>
				</div>
			</div>
		</li> -->
		
		

		

		<li class="dropdown toolbar-icon-bg">
			<?php
			echo "<a href='#' class='dropdown-toggle username' data-toggle='dropdown'>
					<img class='img-circle' src='$image_src' alt='' />
					</a>";
			?>
			<ul class="dropdown-menu userinfo arrow">
				<li><a href="./extras-profile.php?"><i class="ti ti-user"></i><span>Profile</span><span class="badge badge-info pull-right"></span></a></li>
				<!-- <li><a href="#/"><i class="ti ti-panel"></i><span>Account</span></a></li>
				<li><a href="#/"><i class="ti ti-settings"></i><span>Settings</span></a></li>
				<li class="divider"></li>
				<li><a href="#/"><i class="ti ti-stats-up"></i><span>Earnings</span></a></li>
				<li><a href="#/"><i class="ti ti-view-list-alt"></i><span>Statement</span></a></li>
				<li><a href="#/"><i class="ti ti-money"></i><span>Withdrawals</span></a></li>
				<li class="divider"></li> -->
				<li><a href="../Teachers_login.php?"><i class="ti ti-shift-right"></i><span>Log Out</span></a></li>
			</ul>
		</li>

	</ul>

</header>

        <div id="wrapper">
            <div id="layout-static">
                <div class="static-sidebar-wrapper sidebar-default">
                    <div class="static-sidebar">
                        <div class="sidebar">
	<div class="widget">
        <div class="widget-body">
            <div class="userinfo">
				<?php
					echo
					"<div class='avatar'>
						<img src='$image_src' class='img-responsive img-circle'> 
				  	</div>
				
                
					  <div class='info'>
						<span class='username'>$fname $sname</span>
						<span class='useremail'>$email_from_cookie</span>
				  	</div>
			  </div>";

			?>

        </div>
    </div>
	<div class="widget stay-on-collapse" id="widget-sidebar">
        <nav role="navigation" class="widget-body">
	<ul class="acc-menu">
		<li class="nav-separator"><span>Explore</span></li>
		<li><a href="index_original.php?"><i class="ti ti-home"></i><span>Dashboard</span></a></li>
		<li><a href="./tables-editable.php?"><i class="ti ti-book"></i><span>My Time Table</span></span></a></li>
		<li><a href="./ui-tables.php?"><i class="ti ti-layout"></i><span>Add Subjects</span><span class="badge badge-danger"><?php if($rest_of_subjects != 0){echo '1';}?></span></span></a></li>
		<li><a href="../../index.html"><i class="ti ti-home"></i><span>Go to Home</span></span></a></li>
		<!-- <li><a href="./ui-tables.php?"><i class="ti ti-layout"></i><span>Add Subjects</span><span class="badge badge-danger"></span></a>
			<ul class="acc-menu">
				<li><a href="tables-editable.php?">My Schedule</a></li>
				<li><a href="ui-tables.php?">Add Class / Subject</a></li>
				<li><a href="layout-sidebar-scroll.html">Scroll Sidebar</a></li>
				<li><a href="layout-horizontal.html">Horizontal Nav</a></li>
				<li><a href="layout-boxed.html">Boxed</a></li>	
			</ul>
		</li> -->
		<!-- <li><a href="javascript:;"><i class="ti ti-view-list-alt"></i><span>UI Kit</span></a>
			<ul class="acc-menu">
				<li><a href="ui-typography.html">Typography</a></li>
				<li><a href="ui-buttons.html">Buttons</a></li>
				<li><a href="ui-modals.html">Modal</a></li>
                <li><a href="ui-progress.html">Progress</a></li>
				<li><a href="ui-paginations.html">Paginations</a></li>
				<li><a href="ui-breadcrumbs.html">Breadcrumbs</a></li>
				<li><a href="ui-labelsbadges.html">Labels &amp; Badges</a></li>
                <li><a href="ui-alerts.html">Alerts</a></li>
                <li><a href="ui-tabs.html">Tabs</a></li>
                <li><a href="ui-wells.html">Wells</a></li>
                <li><a href="ui-icons-fontawesome.html">FontAwesome Icons</a></li>
                <li><a href="ui-icons-themify.html">Themify Icons</a></li>
				<li><a href="ui-helpers.html">Helpers</a></li>
        		<li><a href="ui-imagecarousel.html">Images &amp; Carousel</a></li>
			</ul>
		</li>
        <li><a href="javascript:;"><i class="ti ti-control-shuffle"></i><span>Components</span></a>
        	<ul class="acc-menu">
        		<li><a href="ui-tiles.html">Tiles</a></li>
        		<li><a href="custom-skylo.html">Page Progress</a></li>
        		<li><a href="custom-bootbox.html">Bootbox</a></li>
        		<li><a href="custom-pines.html">Pines Notification</a></li>
        		<li><a href="custom-pulsate.html">Pulsate</a></li>
				<li><a href="custom-knob.html">jQuery Knob</a></li>
				<li><a href="custom-ionrange.html">Ion Range Slider</a></li>
        	</ul>
        </li>
		<li><a href="javascript:;"><i class="ti ti-pencil"></i><span>Forms</span></a>
			<ul class="acc-menu">
				<li><a href="ui-forms.html">Form Layout</a></li>
				<li><a href="form-components.html">Form Components</a></li>
				<li><a href="form-pickers.html">Pickers</a></li>
				<li><a href="form-wizard.html">Form Wizard</a></li>
				<li><a href="form-validation.html">Form Validation</a></li>
				<li><a href="form-masks.html">Form Masks</a></li>
				<li><a href="form-dropzone.html">Dropzone Uploader</a></li>
				<li><a href="form-summernote.html">Summernote</a></li>
				<li><a href="form-markdown.html">Markdown Editor</a></li>
				<li><a href="form-xeditable.html">Inline Editor</a></li>
				<li><a href="form-gridforms.html">Grid Forms</a></li>
			</ul>
		</li> -->
        <li class="nav-separator"><span>Account</span></li>
				<li><a href="./extras-profile.php?"><i class="ti ti-user"></i><span id="profile_red_badge">Profile</span></a></li>
				<li><a href="../Teachers_login.php?"><i class="ti ti-shift-right"></i><span>Log out</span></a></li>
			
			<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
			<script>
				$(document).ready(function(){
					var profile_completed_presentage = $("#presentage").text();
					profile_completed_presentage != "100%"? 
						$("#profile_red_badge").html("Profile<span class='badge badge-orange'>1</span>") :
						$("#profile_red_badge").html("Profile") 
				});	
			</script>
		<!-- <li>
			<a href="javascript:;"><i class="ti ti-settings"></i><span>Panels</span></a>
			<ul class="acc-menu">
				<li><a href="ui-panels.html">Panels</a></li>
				<li><a href="ui-advancedpanels.html">Draggable Panels</a></li>
			</ul>
		<li><a href="javascript:;"><i class="ti ti-layout-grid3"></i><span>Tables</span></a>
			<ul class="acc-menu">
				<li><a href="ui-tables.html">Basic Tables</a></li>
				<li><a href="tables-responsive.html">Responsive Tables</a></li>
				<li><a href="tables-editable.html">Editable Tables</a></li>
				<li><a href="tables-data.html">Data Tables</a></li>
				<li><a href="tables-fixedheader.html">Fixed Header Tables</a></li>
			</ul>
		</li>
		<li><a href="javascript:;"><i class="ti ti-stats-up"></i><span>Analytics</span></a>
			<ul class="acc-menu">
				<li><a href="charts-flot.html">Flot</a></li>
				<li><a href="charts-sparklines.html">Sparklines</a></li>
				<li><a href="charts-morris.html">Morris.js</a></li>
				<li><a href="charts-easypiechart.html">Easy Pie Chart</a></li>
			</ul>
		</li>
		<li><a href="javascript:;"><i class="ti ti-map-alt"></i><span>Maps</span></a>
			<ul class="acc-menu">
				<li><a href="maps-google.html">Google Maps</a></li>
				<li><a href="maps-jvectormap.html">jVectorMap</a></li>
				<li><a href="maps-mapael.html">Mapael</a></li>
			</ul>
		</li>
		<li><a href="javascript:;"><i class="ti ti-file"></i><span>Pages</span></a>
			<ul class="acc-menu">
				<li><a href="extras-profile.php?">Profile</a></li>
				<li><a href="extras-invoice.html">Invoice</a></li>
				<li><a href="javascript:;">Email Templates</a>
					<ul class="acc-menu">
						<li><a href="responsive-email/basic.html">Basic</a></li>
						<li><a href="responsive-email/hero.html">Hero</a></li>
						<li><a href="responsive-email/sidebar.html">Sidebar</a></li>
						<li><a href="responsive-email/sidebar-hero.html">Sidebar Hero</a></li>
					</ul>
				</li>
				<li><a href="coming-soon.html">Coming Soon</a></li>
				<li><a href="extras-faq.html">FAQ</a></li>
				<li><a href="extras-registration.html">Registration</a></li>
				<li><a href="extras-forgotpassword.html">Password Reset</a></li>
				<li><a href="extras-login.html">Login</a></li>
				<li><a href="extras-404.html">404 Page</a></li>
				<li><a href="extras-500.html">500 Page</a></li>
			</ul>
		</li> -->

		
	</ul>
</nav>
    </div>
	<br><br><br>
    <div class="widget" id="widget-progress">
        <div class="widget-heading">
            Progress
        </div>
        <div class="widget-body">

            <div class="mini-progressbar">
                <div class="clearfix mb-sm">
                    <div class="pull-left">Profile</div>
                    <div class="pull-right" id="prog-bar-value">50%</div>
                </div>
                
                <div class="progress">    
                    <div class="progress-bar progress-bar-lime" id="prog-bar"></div>
                </div>
            </div>
            <div class="mini-progressbar">
                <div class="clearfix mb-sm">
                    <div class="pull-left">Subjects</div>
                    <div class="pull-right" id="sub-prog-bar-value">25%</div>
                </div>
                
                <div class="progress">    
                    <div class="progress-bar progress-bar-info" id="sub-prog-bar"></div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
<!-- Profile Progress bar  -->
<script>
	$(function(){
		var value_for_prog_bar = $("#presentage").text();
		$("#prog-bar-value").text(value_for_prog_bar);
		$("#prog-bar").width(value_for_prog_bar);
	});
</script>
<!-- Subject Progress bar  -->
<script>
	var AMOUNT_SUBJECTS = "<?php echo $amount_subjects; ?>";
	var subjects_on_database = "<?php echo $subjects_on_database; ?>";
	var subject_presentage = ( (subjects_on_database / AMOUNT_SUBJECTS) ) * 100;

	$(function(){
		$("#sub-prog-bar-value").text(subject_presentage + "%");
		$("#sub-prog-bar").width(subject_presentage * 2.5);
	});
</script>
                    




</div>
                </div>
                <div class="static-content-wrapper">
                    <div class="static-content">
                        <div class="page-content">
                            <ol class="breadcrumb">
                                
<li><a href="./index_original.php?">Home</a></li>
<li><a href="./index_original.php?">Dashboard</a></li>
<li class="active"><a href="./tables-editable.php?">My Time Table</a></li>

                            </ol>
                            <div class="container-fluid">

                            




<?php
    
    

    
    
    
    
    
    if(isset($_GET['delete'])){
        $dcn = intval($_GET['delete']); //dcn = deleting column number

        
        //Setting all values null, accoding to the number of delete
        $sql4 = "UPDATE time_table_of_teachers 
                SET GRADE__$dcn = null,
                    SUBJECT__$dcn = null,
                    BATCH__$dcn = null, 
                    CLASS_DATE__$dcn = null,
                    CLASS_BEGIN__$dcn = null,	
                    CLASS_END__$dcn = null,	
                    HOW_CLASS_DO__$dcn = null,	
                    DISTRICT__$dcn = null,	
                    INSTITUTE__$dcn = null,	
                    LANGUAGES__$dcn = null,	
                    CLASS_TYPE__$dcn = null
                WHERE T_ID = (SELECT T_ID FROM teachers WHERE EMAIL = '$email_from_cookie' and PASSWORD = '$password_from_cookie');";
        

        //do -1 to SUBJECTS_ON_DATABASE value
        $sql5 = "UPDATE teachers
                SET SUBJECTS_ON_DATABASE = $subjects_on_database - 1
                WHERE EMAIL = '$email_from_cookie' and PASSWORD = '$password_from_cookie';";
        
        
        
        
        
        $resultInser4 = mysqli_query($conn, $sql4);
        $resultInsert5 = mysqli_query($conn, $sql5);
        
        if($resultInsert4 === TRUE){
            //If something went error uncomment this and see the error   
            //echo"<script>alert('Data Insert');</script>";
            
        }
        else{
            // echo "Error : ". $sql4 . "<br>" . $conn -> error;
                }

        
        
        
        if($resultInsert5 === TRUE){
            //If something went error uncomment this and see the error   
            //echo"<script>alert('Data Insert');</script>";
            echo "<script>window.location.replace('tables-editable.php?');</script>";
        }
        else{
            // echo "Error : ". $sql5 . "<br>" . $conn -> error;
                }

        
        

        
        
        
    }

?>





<?php

if($subjects_on_database == 0){
    echo "<div class='alert alert-dismissable alert-danger'>
    <h3><i class='ti ti-close'></i>&nbsp; <strong>No Subjects or Classes!</h></strong> You haven't added any subject or class to your schedule. Please add subjects or classes now. Click on, Add Class or Click<a href='./ui-tables.php?' style='color:#00769C;'> Here!</a>
    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
    </div>";
    $show_table = 0;

}elseif($subjects_on_database > 0 and $subjects_on_database < $amount_subjects){
    echo "<div class='alert alert-dismissable alert-warning'>
        <i class='ti ti-alert'></i>&nbsp; <strong>You can add $rest_of_subjects more subjects!</strong> You've added $subjects_on_database subject(s) only. If you want to change the amount of subjects, Click on, Profile 
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
    </div>";
    $show_table = 1;

}elseif($subjects_on_database == $amount_subjects){ 
    $show_table = 1;
}






if($show_table == 1 and $show_table != 0){
echo
    "<div data-widget-group='group1'>
    <div data-widget-group='group1'>
        <div class='row'>
            <div class='col-md-12'> 
                        <div id='wrapper' class='table-responsive'>
                        
                        
                         <table id='keywords' cellspacing='0' cellpadding='0'>
                           <thead>
                             <tr>
                               <th><span>Grade</span></th>
                               <th><span>Subjects</span></th>
                               <th><span>Batch</span></th>
                               <th><span>Date</span></th>
                               <th><span>Time</span></th>
                               <th><span>Category</span></th>
                               <th><span>District</span></th>
                               <th><span>Institute</span></th>
                               <th><span>Mediums</span></th>
                               <th><span>Class type</span></th>
                               <th><span></span></th>
                               
                             </tr>
                           </thead>
                           <tbody>";
                        }

                           ?>

                           <?php


                                //Clearing Unnecessary data first
                                if($subjects_on_database == 0 || $subjects_on_database < 0){
                                    $sql6 = "DELETE FROM time_table_of_teachers WHERE T_ID = (SELECT T_ID FROM teachers WHERE EMAIL = '$email_from_cookie' and PASSWORD = '$password_from_cookie');";

                                    $resultInsert6 = mysqli_query($conn, $sql6) ;

                                    if($resultInsert6 === TRUE){
                                        //If something went error uncomment this and see the error   
                                        //echo"<script>alert('Data Insert');</script>";
                                    }
                                    else{
                                        // echo "Error : ". $sql6 . "<br>" . $conn -> error;
                                            }
                                }
                           
                                
                                
                                
                                $sql = "SELECT *
                                        FROM time_table_of_teachers
                                        WHERE T_ID = (SELECT T_ID FROM teachers WHERE EMAIL='$email_from_cookie' and PASSWORD='$password_from_cookie');";

                                
                                $resalt = mysqli_query($conn,$sql);					         //get the resalt between $conn and, run $sql	
                                $resaltcheck = mysqli_num_rows($resalt);
                                $datas = array();

                                if ($resaltcheck > 0) {
                                    while ($row = mysqli_fetch_assoc($resalt)){
                                        
                                        $datas[] = $row;  }
                                    


                                for ($i=1; $i <= $count_of_subject_columns; $i++) { // 10 --> Number of columns (__1,__2...__5) 
                                        
                                    
                                    
                                        $t_id = $datas[0]['T_ID'];
                                        $grade = $datas[0]["GRADE__$i"];
                                        $subject = $datas[0]["SUBJECT__$i"];
                                        $batch = $datas[0]["BATCH__$i"];
                                        $class_date = $datas[0]["CLASS_DATE__$i"];
                                        $class_begin = $datas[0]["CLASS_BEGIN__$i"];
                                        $class_end = $datas[0]["CLASS_END__$i"];
                                        $how_class_do = $datas[0]["HOW_CLASS_DO__$i"];
                                        $district = $datas[0]["DISTRICT__$i"];
                                        $city = $datas[0]["CITY__$i"];
                                        $institute = $datas[0]["INSTITUTE__$i"];
                                        $languages = $datas[0]["LANGUAGES__$i"];
                                        $class_type_with_more_info = $datas[0]["CLASS_TYPE__$i"];


                                        if($grade===null){
                                            //echo "Grade is: ".$grade;
                                            
                                        }else{
                                            
                                        

                                        
                                            if($how_class_do == 'online'){
                                                $dot = "<span class='logged-in'><big><font color='#1DE9B6'>●</span></big></font>";
                                            }elseif($how_class_do == 'physical'){
                                                $dot = "<span class='logged-in'><big><font color='#F44236'>●</span></big></font>";
                                            }elseif($how_class_do == 'both'){
                                                $dot = "<span class='logged-in'><big><font color='#F44236'>●</span></big></font>&nbsp&nbsp<span class='logged-in'><big><font color='#1DE9B6'>●</span></big></font>";
                                            }
                            
                                            echo
                                            "<tr>
                                            <td class='lalign'>$grade</td>
                                            <td>$subject</td>
                                            <td>$batch</td>
                                            <td>$class_date</td>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td>Since  Until</td>
                                                        <td>$class_begin  $class_end</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td>
                                                $dot $how_class_do
                                            </td>
                                            <td>
                                                $district<br/>
                                                $city
                                            </td>
                                            <td>
                                                $institute
                                            </td>
                                            <td>
                                                $languages
                                            </td>
                                            <td>
                                                $class_type_with_more_info
                                            </td>
                                            <td>
                                                <a class='show-alert'><button type='submit' data-loading-text='Deleting...' class='loading-example-btn btn btn-danger' value='$i'><form action='tables-editable.php?$i methord='GET' '>Delete</form></button></a>
                                            </td>
                                            
                                        </tr>";
                                                }
                                            }
                                        }
                                      
                                    ?>
                                      
                                      
                                      
        



                                      
                             
                                
                             
                            </table>
                        </div> 
                       
                    <!--end table-->


                
                </div>
                <div class="panel-footer"></div>
            </div>
        </div>
    </div>

    
                    <!--end table-->
                    
                </div>
                <div class="panel-footer"></div>
            </div>
        </div>
    </div>
</div>

                            </div> <!-- .container-fluid -->
                        </div> <!-- #page-content -->
                    </div>
                    <footer role="contentinfo">
    <div class="clearfix">
        <ul class="list-unstyled list-inline pull-left">
            <li><h6 style="margin: 0;"></h6></li>
        </ul>
        <!-- <button class="pull-right btn btn-link btn-xs hidden-print" id="back-to-top"><i class="ti ti-arrow-up"></i></button> -->
    </div>
</footer>

                </div>
            </div>
        </div>




    
    <!-- Switcher -->
    <div class="demo-options">
        <div class="demo-options-icon"><i class="ti ti-paint-bucket"></i></div>
        <div class="demo-heading">Demo Settings</div>

        <div class="demo-body">
            <div class="tabular">
                <div class="tabular-row">
                    <div class="tabular-cell">Fixed Header</div>
                    <div class="tabular-cell demo-switches"><input class="bootstrap-switch" type="checkbox" checked data-size="mini" data-on-color="success" data-off-color="default" name="demo-fixedheader" data-on-text="&nbsp;" data-off-text="&nbsp;"></div>
                </div>
                <div class="tabular-row">
                    <div class="tabular-cell">Boxed Layout</div>
                    <div class="tabular-cell demo-switches"><input class="bootstrap-switch" type="checkbox" data-size="mini" data-on-color="success" data-off-color="default" name="demo-boxedlayout" data-on-text="&nbsp;" data-off-text="&nbsp;"></div>
                </div>
                <div class="tabular-row">
                    <div class="tabular-cell">Collapse Leftbar</div>
                    <div class="tabular-cell demo-switches"><input class="bootstrap-switch" type="checkbox" data-size="mini" data-on-color="success" data-off-color="default" name="demo-collapseleftbar" data-on-text="&nbsp;" data-off-text="&nbsp;"></div>
                </div>
            </div>
        </div>

        <div class="demo-body">
            <div class="option-title">Topnav</div>
            <ul id="demo-header-color" class="demo-color-list">
                <li><span class="demo-cyan"></span></li>
                <li><span class="demo-light-blue"></span></li>
                <li><span class="demo-blue"></span></li>
                <li><span class="demo-indigo"></span></li>
                <li><span class="demo-deep-purple"></span></li> 
                <li><span class="demo-purple"></span></li> 
                <li><span class="demo-pink"></span></li> 
                <li><span class="demo-red"></span></li>
                <li><span class="demo-teal"></span></li>
                <li><span class="demo-green"></span></li>
                <li><span class="demo-light-green"></span></li>
                <li><span class="demo-lime"></span></li>
                <li><span class="demo-yellow"></span></li>
                <li><span class="demo-amber"></span></li>
                <li><span class="demo-orange"></span></li>               
                <li><span class="demo-deep-orange"></span></li>
                <li><span class="demo-midnightblue"></span></li>
                <li><span class="demo-bluegray"></span></li>
                <li><span class="demo-bluegraylight"></span></li>
                <li><span class="demo-black"></span></li> 
                <li><span class="demo-gray"></span></li> 
                <li><span class="demo-graylight"></span></li> 
                <li><span class="demo-default"></span></li>
                <li><span class="demo-brown"></span></li>
            </ul>
        </div>

        <div class="demo-body">
            <div class="option-title">Sidebar</div>
            <ul id="demo-sidebar-color" class="demo-color-list">
                <li><span class="demo-cyan"></span></li>
                <li><span class="demo-light-blue"></span></li>
                <li><span class="demo-blue"></span></li>
                <li><span class="demo-indigo"></span></li>
                <li><span class="demo-deep-purple"></span></li> 
                <li><span class="demo-purple"></span></li> 
                <li><span class="demo-pink"></span></li> 
                <li><span class="demo-red"></span></li>
                <li><span class="demo-teal"></span></li>
                <li><span class="demo-green"></span></li>
                <li><span class="demo-light-green"></span></li>
                <li><span class="demo-lime"></span></li>
                <li><span class="demo-yellow"></span></li>
                <li><span class="demo-amber"></span></li>
                <li><span class="demo-orange"></span></li>               
                <li><span class="demo-deep-orange"></span></li>
                <li><span class="demo-midnightblue"></span></li>
                <li><span class="demo-bluegray"></span></li>
                <li><span class="demo-bluegraylight"></span></li>
                <li><span class="demo-black"></span></li> 
                <li><span class="demo-gray"></span></li> 
                <li><span class="demo-graylight"></span></li> 
                <li><span class="demo-default"></span></li>
                <li><span class="demo-brown"></span></li>
            </ul>
        </div>



    </div>
<!-- /Switcher -->
    <!-- Load site level scripts -->

<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>-->

<script type="text/javascript" src="assets/js/jquery-1.10.2.min.js"></script> 							
<script type="text/javascript" src="assets/js/jqueryui-1.10.3.min.js"></script> 							
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script> 								<!-- Load Bootstrap -->
<script type='text/javascript' src='assets/js/enquire.min.js'></script> <!-- Load Enquire -->




<script type="text/javascript" src="assets/plugins/velocityjs/velocity.min.js"></script>					<!-- Load Velocity for Animated Content -->
<script type="text/javascript" src="assets/plugins/velocityjs/velocity.ui.min.js"></script>

<script type="text/javascript" src="assets/plugins/wijets/wijets.js"></script>     						<!-- Wijet -->

<script type="text/javascript" src="assets/plugins/codeprettifier/prettify.js"></script> 				<!-- Code Prettifier  -->
<script type="text/javascript" src="assets/plugins/bootstrap-switch/bootstrap-switch.js"></script> 		<!-- Swith/Toggle Button -->

<script type="text/javascript" src="assets/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js"></script>  <!-- Bootstrap Tabdrop -->

<script type="text/javascript" src="assets/plugins/iCheck/icheck.min.js"></script>     					<!-- iCheck -->

<script type="text/javascript" src="assets/plugins/nanoScroller/js/jquery.nanoscroller.min.js"></script> <!-- nano scroller -->

<script type="text/javascript" src="assets/js/application.js"></script>
<script type="text/javascript" src="assets/demo/demo.js"></script>
<script type="text/javascript" src="assets/demo/demo-switcher.js"></script>

<!-- End loading site level scripts -->
    
    <!-- Load page level scripts-->
    
<script type="text/javascript" src="assets/plugins/datatables/jquery.dataTables.js"></script>                            <!-- Data Tables -->
<script type="text/javascript" src="assets/plugins/datatables/TableTools.js"></script>                                   <!-- TableTools -->
<script type="text/javascript" src="assets/plugins/jquery-editable/jquery.editable.js"></script>                         <!-- jQuery Editable -->
<script type="text/javascript" src="assets/plugins/datatables/dataTables.editor.js"></script>                            <!-- Data Tables Editor-->
<script type="text/javascript" src="assets/plugins/datatables/dataTables.editor.bootstrap.js"></script>                  <!-- Data Tables Editor for Bootstrap-->
<script type="text/javascript" src="assets/plugins/datatables/dataTables.bootstrap.js"></script>                         <!-- Bootstrap Support for Datatables -->

<script type="text/javascript" src="assets/demo/demo-tableeditable.js"></script> 






<!-- <script>
  $('.loading-example-btn').click(function () {
    var btn = $(this)
    btn.button('loading')
    setTimeout(function () {
      
    },3000 )

    
    
  });
</script> -->

    
<script type="text/javascript" src="assets/plugins/bootbox/bootbox.js"></script> 	<!-- Bootbox -->
<script type="text/javascript" src="assets/demo/demo-modals.js"></script>

 <!-- End loading page level scripts-->

    </body>
</html>





<!-------------------------------BOOTBOX------------------------------------------->
<script type='text/javascript' src='assets/js/jquery-1.10.2.min.js'></script>               <!-- Load jQuery -->
<script type='text/javascript' src='assets/js/jqueryui-1.10.3.min.js'></script>               <!-- Load jQueryUI -->
<script type='text/javascript' src='assets/js/bootstrap.min.js'></script>                 <!-- Load Bootstrap -->


<script type='text/javascript' src='assets/plugins/bootbox/bootbox.js'></script>  <!-- Bootbox -->
<script type='text/javascript' src='assets/demo/demo-modals.js'></script>

<script>
    var fired_button;
    $("button").click(function() {
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