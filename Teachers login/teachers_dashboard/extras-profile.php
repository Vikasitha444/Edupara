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

	$rest_of_subjects = intval($amount_subjects) - intval($subjects_on_database); //rest_of_subject means, How many subjects still can add to the database




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
    <title>Teachers Dashabord - Profile | Edupara.lk</title>
	<link rel="shortcut icon" href="../../index/img/core-img/favicon.ico" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="description" content="Profile | Edupara.lk">
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
		.maindiv {
			display: flex;
			align-items: center;
			justify-content: center;
			flex-direction: column;
			min-height: 25vh;
			
			}

			.container {
			max-width: 650px;
			width: 100%;
			padding: 30px;
			background: #fff;
			border-radius: 20px;
			box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
			}

			.drag-area {
			height: 400px;
			border: 3px dashed #e0eafc;
			display: flex;
			align-items: center;
			justify-content: center;
			flex-direction: column;
			margin: 10px auto;
			}

			h3 {
			margin-bottom: 20px;
			font-weight: 500;
			}

			.drag-area .icon {
			font-size: 50px;
			color: #1683ff;
			}

			.drag-area .header {
			font-size: 20px;
			font-weight: 500;
			color: #34495e;
			}

			.drag-area .support {
			font-size: 12px;
			color: gray;
			margin: 10px 0 15px 0;
			}

			.drag-area .button {
			font-size: 20px;
			font-weight: 500;
			color: #1683ff;
			cursor: pointer;
			}

			.drag-area.active {
			border: 2px solid #1683ff;
			}

			.drag-area img {
			width: 100%;
			height: 100%;
			object-fit: cover;
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

		<div class="" style="width:10%; height:100%; text-align:center; margin-top:15px; ">
			<img src="../../index/img/core-img/logo.png" width="170px" >
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
<li class="active"><a href="./extras-profile.php?">Profile</a></li>

                            </ol>
                            <div class="container-fluid">
<?php

		
		

	echo
	"<div data-widget-group='group1'>
    <div class='row'>
      <div class='col-sm-3'>
        <div class='panel panel-profile'>
        <div class='panel-body'>
		<img src='$image_src' class='img-circle' height='100px'>
          <div class='name'>$fname $sname</div>
          <div class='info'>$email_from_cookie</div>";

				
				
					$sql = "SELECT FACEBOOK_LINK, YOUTUBE_LINK, WEBSITE_LINK
					FROM teachers
					WHERE EMAIL = '$email_from_cookie' and PASSWORD = '$password_from_cookie'";

					$resalt = mysqli_query($conn,$sql);					         //get the resalt between $conn and, run $sql	
					$resaltcheck = mysqli_num_rows($resalt);
					$datas = array();


					if ($resaltcheck > 0) {
						while ($row = mysqli_fetch_assoc($resalt)){
						$datas[] = $row;  }
						
						

						$facebook_link = $datas[0]['FACEBOOK_LINK'];
						$website_link = $datas[0]['WEBSITE_LINK'];
						$youtube_link = $datas[0]['YOUTUBE_LINK'];




						echo "<ul class='list-inline text-center'>
								<li><a href='$facebook_link' class='profile-facebook-icon'><i class='ti ti-facebook'></i></a></li>
								<li><a href='$website_link' class='profile-twitter-icon'><i class='ti ti-desktop'></i></a></li>
								<li><a href='$youtube_link' class='profile-dribbble-icon'><i class='ti ti-youtube'></i></a></li>
							</ul>";
					
					}
				?>

			    
			  </div>
			</div><!-- panel -->
			<div class="list-group list-group-alternate mb-n nav nav-tabs">
				<a href="#tab-about" 	role="tab" data-toggle="tab" class="list-group-item active"><i class="ti ti-user"></i> About <span class="badge badge-primary"></span></a>
				<!-- <a href="#tab-timeline" role="tab" data-toggle="tab" class="list-group-item"><i class="ti ti-time"></i> Timeline</a> -->
				<!-- <a href="#tab-projects" role="tab" data-toggle="tab" class="list-group-item"><i class="ti ti-view-list-alt"></i> Projects</a> -->
				<!-- <a href="#tab-photos" 	role="tab" data-toggle="tab" class="list-group-item"><i class="ti ti-view-grid"></i> Photos</a> -->
				<a href="#tab-edit" 	role="tab" data-toggle="tab" class="list-group-item"><i class="ti ti-pencil"></i> Edit</a>
				<a href="#" 	 class="list-group-item show-alert" id="remove_profile_pic_button"><i class="ti ti-trash"></i> Remove Profile Photo</a>
			</div>
			
			<!-- bootbox confimation plugin starts here -->
			<link rel="stylesheet" type="text/css" href="./assets/bootbox/bootstrap.min.css">
			<!-- <p>Content here. <a class="show-alert" href=#>Alert!</a></p> -->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
			
			<script src="popper.min.js"></script>
			<script src="bootstrap.min.js"></script>

			
			<script src="./assets/bootbox/bootbox.min.js"></script>
			<script src="./assets/bootbox/bootbox.locales.min.js"></script>
			<script>
				$(document).on("click", ".show-alert", function(e) {
					bootbox.confirm({ 
						size: "large",
						message: "Are you sure?",
						callback: function(result){ /* result is a boolean; true = OK, false = Cancel*/ 
							if(result === true){
								window.location.replace('./extras-profile.php?removeProfilePhoto=true');
								
							}
						}
					})
					
				});
				
			</script>

			<script>
				$(function(){
					var remove_profile_pic_state = "<?php if($image == 'no user.png'){echo "true";}else{echo "false";} ?>";
					if(remove_profile_pic_state == 'true'){
						$("#remove_profile_pic_button").hide();
						
					}else{
						$("#dropzone").hide();
					}
				});
			</script>

			<?php
				if(isset($_GET['removeProfilePhoto'])){
					$sql4 = "UPDATE teachers
							SET IMAGE_NAME = 'no user.png'
							WHERE EMAIL = '$email_from_cookie' and PASSWORD = '$password_from_cookie';";
					
					if (mysqli_query($conn, $sql4)) {
						echo "<script>window.location.replace('extras-profile.php?');</script>";
					  }


				}
			?>
			<!-- bootbox confimation plugin starts here -->


		</div><!-- col-sm-3 -->
		<div class="col-sm-9">
			<div class="tab-content">
				<div class="tab-pane" id="tab-projects">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h2>Projects</h2>
						</div>
						<div class="panel-body">
							<div class="table-responsive">
								<table class="table m-n">
									<thead>
										  <tr>
										    <th>#</th>
										    <th>Project Title</th>
										    <th>Description</th>
										    <th>Progress</th>
										  </tr>
									</thead>
									<tbody>
										  <tr>
										    <th scope="row">1.</th>
										    <td><strong>Avenxo</strong></td>
										    <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit</td>
										    <td class="vam">
												<div class="progress m-n">
				                                  <div class="progress-bar progress-bar-success" style="width: 20%"></div>
				                                </div>
				                            </td>
										  </tr>
										  <tr>
										    <th scope="row">2.</th>
										    <td><strong>Phoenix</strong></td>
										    <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit</td>
										    <td class="vam">
												<div class="progress m-n">
				                                  <div class="progress-bar progress-bar-success" style="width: 50%"></div>
				                                </div>
				                            </td>
										  </tr>
										  <tr>
										    <th scope="row">3.</th>
										    <td><strong>Arvin</strong></td>
										    <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit</td>
										    <td class="vam">
												<div class="progress m-n">
				                                  <div class="progress-bar progress-bar-success" style="width: 10%"></div>
				                                </div>
				                            </td>
										  </tr>
										  <tr>
										    <th scope="row">4.</th>
										    <td><strong>Flip3</strong></td>
										    <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit</td>
										    <td class="vam">
												<div class="progress m-n">
				                                  <div class="progress-bar progress-bar-success" style="width: 75%"></div>
				                                </div>
				                            </td>
										  </tr>
										  <tr>
										    <th scope="row">5.</th>
										    <td><strong>Appboom</strong></td>
										    <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit</td>
										    <td class="vam">
												<div class="progress m-n">
				                                  <div class="progress-bar progress-bar-success" style="width: 25%"></div>
				                                </div>
				                            </td>
										  </tr>
										  <tr>
										    <th scope="row">6.</th>
										    <td><strong>Xavant</strong></td>
										    <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit</td>
										    <td class="vam">
												<div class="progress m-n">
				                                  <div class="progress-bar progress-bar-success" style="width: 15%"></div>
				                                </div>
				                            </td>
										  </tr>
									</tbody>
								</table>
							</div><!-- /.table-responsive -->
						</div> <!-- /.panel-body -->
					</div>
				</div> <!-- #tab-projects -->




				<?php
					



					$sql = "SELECT FNAME, SNAME, PHONE_NUMBER, WHATSAPP_NUMBER, EDU_LEVEL, UNIVERSITY, FACEBOOK_LINK, YOUTUBE_LINK, WEBSITE_LINK, GENDER, AMOUNT_SUBJECTS, TEACH_IN_SCHOOL, LANGUAGES, MOTTO
							FROM teachers
							WHERE EMAIL = '$email_from_cookie' and PASSWORD = '$password_from_cookie'";

					$resalt = mysqli_query($conn,$sql);					         //get the resalt between $conn and, run $sql	
					$resaltcheck = mysqli_num_rows($resalt);
					$datas = array();


					if ($resaltcheck > 0) {
                        while ($row = mysqli_fetch_assoc($resalt)){
                        $datas[] = $row;  }
					
						

						$fname = $datas[0]['FNAME'];
						$sname = $datas[0]['SNAME'];
						$phone_number = $datas[0]['PHONE_NUMBER'];
						$whatsapp_number = $datas[0]['WHATSAPP_NUMBER'];
						$edu_level = $datas[0]['EDU_LEVEL'];
						$university = $datas[0]['UNIVERSITY'];
						$facebook_link = $datas[0]['FACEBOOK_LINK'];
						$youtube_link = $datas[0]['YOUTUBE_LINK'];
						$website_link = $datas[0]['WEBSITE_LINK'];
						$gender = $datas[0]['GENDER'];
						$amount_subjects = $datas[0]['AMOUNT_SUBJECTS'];
						$teach_in_school = $datas[0]['TEACH_IN_SCHOOL'];
						$languages = $datas[0]['LANGUAGES'];
						$motto = $datas[0]['MOTTO'];
					}
			
			echo 
			"<div class='tab-pane active' id='tab-about'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <h2>About</h2>
                        </div>
                        <div class='panel-body'>
                            <div class='about-area'>
                                <h4>Motto (Discription)</h4>
                                <p><i>$motto</i></p> 
                                <p></p>
                            </div>
                            <div class='about-area'>
                                <h4>Basic Information</h4>
                                    <div class='table-responsive'>
                                      <table class='table'>
                                        <tbody>
                                          <tr>
                                            <th>Web</th>
                                            <td><a href='#'>$website_link</a></td>
                                          </tr>
                                          <tr>
                                            <th>Email</th>
                                            <td><a href='#'>$email_from_cookie</a></td>
                                          </tr>
                                          <tr>
                                            <th>Phone</th>
                                            <td>$phone_number</td>
                                          </tr>
										  <tr>
                                            <th>Whatsapp number</th>
                                            <td>$whatsapp_number</td>
                                          </tr>
										  <tr>
                                            <th>Degree (Education Level)</th>
                                            <td>$edu_level</td>
                                          </tr>
										  <tr>
                                            <th>University</th>
                                            <td>$university</td>
                                          </tr>
										  <tr>
                                            <th>Amount of subjects I'm teaching</th>
                                            <td>$amount_subjects &nbsp &nbsp <i>(You always can change this value)</i></td>
                                          </tr>
										  <tr>
                                            <th>Facebook Link</th>
                                            <td>$facebook_link &nbsp <a href='http://$facebook_link' target='_blank' class='open-newtab-icon'><i class='ti ti-new-window text-primary'></i></a> </td>
                                          </tr>
										  <tr>
                                            <th>Youtube Link</th>
                                            <td>$youtube_link &nbsp <a href='http://$youtube_link' target='_blank' class='open-newtab-icon'><i class='ti ti-new-window text-primary'></i></a> </td>
                                          </tr>
										  <tr>
                                            <th>Website Link</th>
                                            <td>$website_link &nbsp <a href='http://$website_link' target='_blank' class='open-newtab-icon'><i class='ti ti-new-window text-primary'></i></a> </td>
                                          </tr>
                                        	
										  
                                          
                                        </tbody>
                                      </table>
                                    </div>
                            </div>
                            <div class='about-area'>
                                <h4>Personal Information</h4>
                                    <div class='table-responsive'>
                                      <table class='table about-table'>
                                        <tbody>
                                          <tr>
                                            <th>Full Name</th>
                                            <td>$fname $sname</td>
                                          </tr>
                                          <tr>
                                            <th>Gender</th>
                                            <td>$gender</td>
                                          </tr>
                                          <tr>
                                            <th>Teach in a school</th>
                                            <td>$teach_in_school</td>
                                          </tr>
                                          <tr>
                                            <th>Languages (Medium)</th>
                                            <td>$languages</td>
                                          </tr>
                                          
                                        </tbody>
                                      </table>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>";

				?>

				<!-- <div class="tab-pane" id="tab-timeline">
					<div class="panel">
						<div class="panel-heading">
							<h2>Timeline</h2>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-12">
									<ul class="timeline">
										<li class="timeline-primary">
											<div class="timeline-icon"><i class="ti ti-pencil"></i></div>
											<div class="timeline-body">
												<div class="timeline-header">
													<span class="author">Posted by <a href="#">David Tennant</a></span>
													<span class="date">Monday, November 21, 2013</span>
												</div>
												<div class="timeline-content">
													<h4>Consectetur Adipisicing Elit</h4>
													<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia, officiis, molestiae, deserunt asperiores architecto ut vel repudiandae dolore inventore nesciunt necessitatibus doloribus ratione facere consectetur suscipit!</p>
												</div>
											</div>
										</li>
										<li class="timeline-info">
											<div class="timeline-icon"><i class="ti ti-heart"></i></div>
											<div class="timeline-body">
												<div class="timeline-header">
													<span class="author">Posted by <a href="#">David Tennant</a></span>
													<span class="date">Monday, November 21, 2013</span>
												</div>
												<div class="timeline-content">
													<h4>Consectetur Adipisicing Elit</h4>
													<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia, officiis, molestiae, deserunt asperiores architecto ut vel repudiandae dolore inventore nesciunt necessitatibus doloribus ratione facere consectetur suscipit!</p>
												</div>
											</div>
										</li>
										<li class="timeline-warning">
											<div class="timeline-icon"><i class="ti ti-camera"></i></div>
											<div class="timeline-body">
												<div class="timeline-header">
													<span class="author">Posted by <a href="#">David Tennant</a></span>
													<span class="date">Monday, November 21, 2013</span>
												</div>
												<div class="timeline-content">
													<h4>Consectetur Adipisicing Elit</h4>
													<ul class="list-inline">
														<li><img src="http://placehold.it/300&text=Placeholder" alt="" class="pull-left img-thumbnail img-responsive clearfix" width="200"></li>
														<li><img src="http://placehold.it/300&text=Placeholder" alt="" class="pull-left img-thumbnail img-responsive clearfix" width="200"></li>
													</ul>
												</div>
											</div>
										</li>
										<li class="timeline-danger">
											<div class="timeline-icon"><i class="ti ti-home"></i></div>
											<div class="timeline-body">
												<div class="timeline-header">
													<span class="author">Posted by <a href="#">David Tennant</a></span>
													<span class="date">Monday, November 21, 2013</span>
												</div>
												<div class="timeline-content">
													<h4>Consectetur Adipisicing Elit</h4>
													<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia, officiis, molestiae, deserunt asperiores architecto ut vel repudiandae dolore inventore nesciunt necessitatibus doloribus ratione facere consectetur suscipit!</p>
												</div>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div> -->

				<!-- <div class="tab-pane" id="tab-photos">
					<div class="panel">
						<div class="panel-heading">
							<h2>Photos</h2>
						</div>
						<div class="panel-body profile-photos">
							<div class="row">
								<div class="col-md-3">
									<img src="http://placehold.it/300&text=Placeholder" alt="" class="img-thumbnail img-responsive mb-xl">
								</div>
								<div class="col-md-3">
									<img src="http://placehold.it/300&text=Placeholder" alt="" class="img-thumbnail img-responsive mb-xl">
								</div>
								<div class="col-md-3">
									<img src="http://placehold.it/300&text=Placeholder" alt="" class="img-thumbnail img-responsive mb-xl">
								</div>
								<div class="col-md-3">
									<img src="http://placehold.it/300&text=Placeholder" alt="" class="img-thumbnail img-responsive mb-xl">
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<img src="http://placehold.it/300&text=Placeholder" alt="" class="img-thumbnail img-responsive mb-xl">
								</div>
								<div class="col-md-3">
									<img src="http://placehold.it/300&text=Placeholder" alt="" class="img-thumbnail img-responsive mb-xl">
								</div>
								<div class="col-md-3">
									<img src="http://placehold.it/300&text=Placeholder" alt="" class="img-thumbnail img-responsive mb-xl">
								</div>
								<div class="col-md-3">
									<img src="http://placehold.it/300&text=Placeholder" alt="" class="img-thumbnail img-responsive mb-xl">
								</div>
							</div>
						</div>
					</div>
				</div> -->


				
				
					
				
			<?php
				echo	
				"<div class='tab-pane' id='tab-edit'>
                    <div class='panel'>
                        <div class='panel-heading'>
                            <h2>Edit</h2>
                        </div>
                        <div class='panel-body'>
                            <div class='row'>
                                <div class='col-md-12'>
                                    <form class='form-horizontal tabular-form' method='post' action='extras-profile.php?' enctype='multipart/form-data' onsubmit='return handleData()'>

                                        
                                        <div class='form-group'>
                                            <label for='form-name' class='col-sm-2 control-label'>First Name</label>
                                            <div class='col-sm-8 tabular-border'>
                                                <input type='text' class='form-control' id='form-name' placeholder='First name' value= '$fname' name='fname' maxlenth='255' required >
                                            </div>
                                        </div>

                                        
                                        <div class='form-group'>
                                            <label for='form-name' class='col-sm-2 control-label'>Second Name</label>
                                            <div class='col-sm-8 tabular-border'>
                                                <input type='text' class='form-control' id='form-name' placeholder='Second Name' value='$sname' name='sname' maxlenth='255' required >
                                            </div>
                                        </div>



                                        <div class='form-group'>
                                            <label for='form-name' class='col-sm-2 control-label'>Email</label>
                                            <div class='col-sm-8 tabular-border'>
                                            <input type='text' class='form-control' readonly='readonly' value='$email'>
                                            </div>
                                        </div>
                                    
                                    
                                        
                                        <div class='form-group'>
                                            <label for='form-name' class='col-sm-2 control-label'>Phone Number</label>
                                            <div class='col-sm-8 tabular-border'>
                                                <input type='tel' class='form-control' id='form-name' pattern='{0-9}10' maxlength='10' placeholder='Phone number' value='$phone_number' name='phone_number' required >
                                            </div>
                                        </div>

                                        <div class='form-group'>
                                            <label for='form-name' class='col-sm-2 control-label'>Whatsapp Number</label>
                                            <div class='col-sm-8 tabular-border'>
                                                <input type='tel' class='form-control' id='form-name' pattern='{0-9}10' maxlength='10' placeholder='Phone number' value='$whatsapp_number' name='whatsapp_number'>
                                            </div>
                                        </div>

                                        

                                        
                                        <div class='form-group'>
                                            <label for='form-name' class='col-sm-2 control-label'>Degree (Education Level)</label>
                                            <div class='col-sm-8 tabular-border'>
                                                <input type='text' class='form-control' id='form-name' placeholder='Degree or Education level' value='$edu_level' name='edu_level' maxlenth='255'>
                                            </div>
                                        </div>


                                        <div class='form-group'>
                                            <label for='form-name' class='col-sm-2 control-label'>Univeristy</label>
                                            <div class='col-sm-8 tabular-border'>
                                                <input type='text' class='form-control' id='form-name' placeholder='University' value='$university' name='university' maxlenth='255'>
                                            </div>
                                        </div>


                                        <div class='form-group'>
                                            
                                            <label for='form-name' class='col-sm-2 control-label'>facebook</label>
                                            <div class='input-group'>                           
                                                <span class='input-group-addon'>
                                                <i class='ti ti-facebook'></i>
                                                </span>
                                                <input type='text' class='form-control' placeholder='Facebook Page or profile link' maxlenth='255' name='facebook_link' value='$facebook_link'>
                                            </div>
                                        </div>


										<div class='form-group'>
                                            
                                            <label for='form-name' class='col-sm-2 control-label'>Youtube</label>
                                            <div class='input-group'>                           
                                                <span class='input-group-addon'>
                                                <i class='ti ti-youtube'></i>
                                                </span>
                                                <input type='text' class='form-control' placeholder='Youtube Channel link' maxlenth='255' name='youtube_link' value='$youtube_link'>
                                            </div>
                                        </div>
                                        
                                        
        
                                        

                                        
                                        
                                        <div class='form-group'>
                                            <label for='form-website' class='col-sm-2 control-label'>Website</label>
                                            <div class='col-sm-8 tabular-border'>
                                                <input type='text' class='form-control' id='form-website' placeholder='http://' name='website_link' maxlenth='255' value='$website_link'>
                                            </div>
                                        </div>
                                        
										
										
										<div class='form-group'>
                                            <label for='radio' class='col-sm-2 control-label'><font color='red' size='5'><big> *</big></font>Gender</label>
                                            <div class='col-sm-8 tabular-border'>
                                                <div class='radio block icheck'><label><input type='radio' name='gender' value='Male' required> Male</label></div>
                                                <div class='radio block icheck'><label><input type='radio' name='gender' value='Female'> Female</label></div>
                                            </div>
                                        </div>
                                        


                                        <div class='form-group'>
                                            <label for='form-name' class='col-sm-2 control-label'>How many subjects do you teach?</label>
                                            <div class='col-sm-8 tabular-border'>
                                                <input type='number' class='form-control' id='form-name' placeholder='Amount of Subjects' value='$amount_subjects' name='amount_subjects' maxlenth='255' min='1'> <br/> 
												<font id='max_subject_amount_error_shower' class='text-danger' style='display:none;'>At this moment, You only can add $count_of_subject_columns subjects / Classes only</font>
                                            </div>
                                        </div>


										


										<div class='form-group'>
											<label class='col-sm-2 control-label'><font color='red' size='5'><big> *</big></font>Do you teach in a school?</label>
											<div class='col-sm-8'>
												<label class='radio-inline icheck'>
													<input type='radio' id='inlineradio1' value='Yes' name='teach_in_school' required> Yes
												</label>
												<label class='radio-inline icheck'>
													<input type='radio' id='inlineradio2' value='No' name='teach_in_school' required> No
												</label>
												
											</div>
										</div>



										<div class='form-group' >
											<label class='col-sm-2 control-label'><font color='red' size='5'><big> *</big></font>Languages you teach (Medium)</label>
											<div class='col-sm-8'>

													<label class='checkbox icheck'>
														<input type='checkbox' value='Sinhala' name='language[]' >
														Sinhala
													</label>
													
													<label class='checkbox icheck'>
														<input type='checkbox' value='English' name='language[]'>
														English
													</label>
													<label class='checkbox icheck'>
														<input type='checkbox' value='Tamil' name='language[]'>
														Tamil
													</label>
													

											</div>
										</div>

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


                                        
                                        
                                        <div class='form-group'>
                                            <label class='col-sm-2 control-label'>Motto (Discription)</label>
                                            <div class='col-sm-8'>
                                                <textarea class='form-control fullscreen' maxlength='255' name='motto' value='$motto'>$motto</textarea>
                                            </div>
                                        </div>

                                        <div class='form-group' id='dropzone'>
                                                <div class='maindiv'>
                                                    <div class='container'>
                                                        <h3>Upload your Profile photo :</h3>
                                                        <div class='drag-area'>
                                                            <div class='icon'>
                                                            <i class='fas fa-images'></i>
                                                            </div>

                                                            <span class='header'>Drag & Drop</span>
                                                            <span class='header'>or <span class='button'>browse</span></span>
                                                            <input type='file' name='file' accept='image/*'onchange='readURL(this);'/>
															<img id='blah' src='#' alt='Upload a file' style='display:none;' />
															<span class='support'>Supports: JPEG, JPG, PNG</span>
															<h1 id='size_txt'>Recommend Size: 640 x 640</h1>


															<script>
																function readURL(input) {
																if (input.files && input.files[0]) {
																	var reader = new FileReader();

																	reader.onload = function (e) {
																	$('#blah').attr('src', e.target.result).width(300).height(300);
																	document.getElementById( 'blah' ).style.display = 'block';
																	document.getElementById( 'size_txt' ).style.display = 'none';
																	};

																	reader.readAsDataURL(input.files[0]);
																}
																}
															</script>
                                                        
														</div>
                                                    </div>
                                                </div>
                                        </div>

                                        
                                        
                                     
                                </div>
                            </div>
                        </div>
                        <div class='panel-footer'>
                            <div class='row'>
                                <div class='col-sm-8 col-sm-offset-2'>
                                    <button class='btn-primary btn' type='submit' name='save'>Save</button>
                                    <button class='btn-default btn' onClick='document.location.reload(true)'>Reset</button><br/>
									<font id='chk_option_error' style='visibility:hidden; color:red;'>Please select the languages you are teaching!</font>
                                </div>
								
                            </div>
                        </div>
                    </div>
					</form>
                </div>";
			?>

			</div><!-- .tab-content -->
		</div><!-- col-sm-8 -->
	</div>
</div>

                            </div> <!-- .container-fluid -->
                        </div> <!-- #page-content -->
                    </div>

				<!-- If subject amount is higher than 10 please change this -->
				<script>
					$(function(){
						$("input[name = amount_subjects]").keyup(function(){
							var subject_amount_input = $("input[name = amount_subjects]").val();
							var count_of_subject_columns = parseInt("<?php echo $count_of_subject_columns; ?>");
							
							if(subject_amount_input > count_of_subject_columns){ 
								$("#max_subject_amount_error_shower").show();
								$("input[name = amount_subjects]").val(count_of_subject_columns);
							
							}else{
								$("#max_subject_amount_error_shower").hide();
							}
						});
					});
				</script>
				<!-- If subject amount is higher than 10 please change this -->
				<script>
					$(function(){
						var facebook_link = "<?php echo ($facebook_link != '')? $facebook_link : ''; ?>";
						var youtube_link = "<?php echo($youtube_link != '')? $youtube_link : '' ?>";
						var website_link = "<?php echo($website_link != '')? $website_link : '' ?>";
						
						
						facebook_link == ''?	
							$(".open-newtab-icon").children().eq(0).hide():
							$(".open-newtab-icon").children().eq(0).show();
						
						youtube_link == ''?	
							$(".open-newtab-icon").eq(1).hide():
							$(".open-newtab-icon").children().eq(1).show();

						website_link == ''?	
							$(".open-newtab-icon").eq(2).hide():
							$(".open-newtab-icon").children().eq(2).show();
						
						
												
						
					});
				</script>
								
								


	
                    <footer role="contentinfo">
    <div class="clearfix">
        <ul class="list-unstyled list-inline pull-left">
            <li><h6 style="margin: 0;"></h6></li>
        </ul>
        <button class="pull-right btn btn-link btn-xs hidden-print" id="back-to-top"><i class="ti ti-arrow-up"></i></button>
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
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script> -->

<script type="text/javascript" src="assets/js/jquery-1.10.2.min.js"></script> 							<!-- Load jQuery -->
<script type="text/javascript" src="assets/js/jqueryui-1.10.3.min.js"></script> 							<!-- Load jQueryUI -->
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script> 								<!-- Load Bootstrap -->
<script type="text/javascript" src="assets/js/enquire.min.js"></script> 									<!-- Load Enquire -->

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
    
<script type="text/javascript" src="assets/plugins/form-fseditor/jquery.fseditor-min.js"></script>            			<!-- Fullscreen Editor -->
<script type="text/javascript" src="assets/plugins/bootbox/bootbox.js"></script> 	<!-- Bootbox -->

<script type="text/javascript" src="assets/demo/demo-profile.js"></script>

    <!-- End loading page level scripts-->




    </body>
</html>




<?php


if(isset($_POST['save'])){
	$fname = $_POST['fname'];
	$sname = $_POST['sname'];
	$phone_number = $_POST['phone_number'];
	$whattsapp_number = $_POST['whatsapp_number'];
	$edu_level = $_POST['edu_level'];
	$university = $_POST['university'];
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

	
	
	
	
		$sql = "UPDATE teachers 
			SET  FNAME = '$fname', SNAME = '$sname', PHONE_NUMBER = '$phone_number', WHATSAPP_NUMBER = '$whatsapp_number', EDU_LEVEL = '$edu_level', UNIVERSITY = '$university', FACEBOOK_LINK = '$facebook_link', AMOUNT_SUBJECTS = '$amount_subjects' ,YOUTUBE_LINK = '$youtube_link', WEBSITE_LINK = '$website_link', GENDER = '$gender', TEACH_IN_SCHOOL = '$teach_in_school', LANGUAGES = '$languages[0] / $languages[1] / $languages[2]', MOTTO = '$motto'
			WHERE EMAIL = '$email_from_cookie' and PASSWORD = '$password_from_cookie';";



		$resultInsert = mysqli_query($conn, $sql) ;
		
		if($resultInsert === TRUE){
		//If something went error uncomment this and see the error   
			//echo"<script>alert('Data Insert');</script>";
			echo "<script>window.location.replace('extras-profile.php?');</script>";
		}
		else{
			//echo "Error : ". $sql . "<br>" . $conn -> error;
				}

		
		
		
		
		
		
		
		
		//Image Handling PART

		$image_name = $_FILES['file']['name'];
		$target_dir = "../../uploads/";
		$target_file = $target_dir . basename($_FILES["file"]["name"]);
	  
		// Select file type
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	  
		// Valid file extensions
		$extensions_arr = array("jpg","jpeg","png","gif");
	  
		// Check extension
		if( in_array($imageFileType,$extensions_arr) ){
		   // Upload file
		   if(move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$image_name)){
			  // Insert record
			  $query = "UPDATE teachers SET IMAGE_NAME = '".$image_name."' WHERE EMAIL = '$email_from_cookie' and PASSWORD = '$password_from_cookie';";
			  mysqli_query($conn,$query);
		   }
	  
		}
                                                            	


			
			
			
			
			
			
			
		
		











			}





?>
