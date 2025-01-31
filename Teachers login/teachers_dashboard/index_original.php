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



$sql = "SELECT T_ID, FNAME, SNAME, AGE, ID_NUM, EMAIL, PHONE_NUMBER, WHATSAPP_NUMBER, EDU_LEVEL, UNIVERSITY, GARDUATED_YEAR, TEACHING_SINCE, AMOUNT_SUBJECTS, PASSWORD, CONFIRM_PASSWORD, ADDITIONAL_DETAILS, CLASS_TYPE_INPUT,REGISTERED_TIME, JOINED_YEAR, JOINED_TIME, IMAGE_NAME, GENDER, SUBJECTS_ON_DATABASE
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
	$gender = $datas[0]['GENDER'];
	$subjects_on_database = $datas[0]['SUBJECTS_ON_DATABASE'];
	// $facebook_link = $datas[0]['FACEBOOK_LINK'];
	// $youtube_link = $datas[0]['YOUTUBE_LINK'];
	// $website_link = $datas[0]['WEBSITE_LINK'];
	// $teach_in_school = $datas[0]['TEACH_IN_SCHOOL'];
	// $languages = $datas[0]['LANGUAGES'];
	// $motto = $datas[0]['MOTTO'];
	

	$sql2 = "SELECT IMAGE_NAME 
				FROM teachers 
				WHERE EMAIL = '$email_from_cookie' and PASSWORD = '$password_from_cookie'";

	$result2 = mysqli_query($conn,$sql2);
	$row2 = mysqli_fetch_array($result2);

	$image = $row2['IMAGE_NAME'];
	$image_src = "../../uploads/".$image;


	$rest_of_subjects = intval($amount_subjects) - intval($subjects_on_database);



?>




<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <title>Teachers Dashboard | Edupara.lk</title>
	<link rel="shortcut icon" href="../../index/img/core-img/favicon.ico" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="description" content="Teachers Dashboard | Edupara.lk">
    

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
	<!-- Sending a notification if profile is not completed -->
	<?php
			if($gender == null){
				echo"<script>window.onload = function(){
					document.getElementById('notify').click();
				  }</script>";
			}
		?>
		<div class="col-xs-3" style="display: none;">
			<button class="btn btn-default btn-block" id="notify" onclick="PNotify.desktop.permission(); (new PNotify({
				title: 'Importent Nortice!',
				text: 'You have\'t completed your profile. Please complete it first. Click here to redirect there',
				type: 'info',
				desktop: {
					desktop: true
				},
				icon: 'ti ti-info-alt',
				styling: 'fontawesome'
			})).get().click(function(e){
				if ($('.ui-pnotify-closer, .ui-pnotify-sticker, .ui-pnotify-closer *, .ui-pnotify-sticker *').is(e.target))
					return;
				//alert('Hey! You clicked the desktop notification!');
				window.location.replace('extras-profile.php?');
			});">Desktop Notification Info</button>
		</div>
        <!-- Sending a notification if profile is not completed Ends here-->
        
		
		
		<header id="topnav" class="navbar navbar-default navbar-fixed-top" role="banner">

	<div class="logo-area">
		<span id="trigger-sidebar" class="toolbar-trigger toolbar-icon-bg">
			<a data-toggle="tooltips" data-placement="right" title="Toggle Sidebar">
				<span class="icon-bg">
					<i class="ti ti-menu"></i>
				</span>
			</a>
			
		</span>
		
		<!-- <a class="navbar-brand" href="./index_original.php?">Edupara</a> -->
		
			

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
		$("#sub-prog-bar").width(100 * 2.5);
	});
</script>


                    </div>
                </div>
                <div class="static-content-wrapper">
                    <div class="static-content">
                        <div class="page-content">
                            <ol class="breadcrumb">
                                
<li class=""><a href="index_original.php?">Home</a></li>
<li class="active"><a href="index_original.php?">Dashboard</a></li>

                            </ol>
                            <div class="container-fluid">
                                

<!-- Tiles Starts here -->
<?php
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
	
?>

<div class="row">
	<div class="col-md-3">
		<div class="info-tile tile-orange">
			<div class="tile-icon"><i class="ti  ti-book"></i></div>
			<div class="tile-heading"><span>Subjects / Classes conducting</span></div>
			<div class="tile-body"><span><?php echo $amount_subjects; ?></span></div>
			<div class="tile-footer"><span class='text-success'> Change subject amount in your profile </span></div>
			
		</div>
	</div>
	<div class="col-md-3">
		<div class="info-tile tile-success">
			<div class="tile-icon"><i class="ti ti-server"></i></div>
			<div class="tile-heading"><span>How many subjects has added</span></div>
			<div class="tile-body"><span><?php echo $subjects_on_database; ?></span></div>
			<div class="tile-footer"><?php if($rest_of_subjects != 0){echo "<span class='text-danger'> Please complete your TimeTable </span>";}else{echo "<span class='text-success'> You've completed your timetable </span>";}?></div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="info-tile tile-info">
			<div class="tile-icon"><i class="ti ti-user"></i></div>
			<div class="tile-heading"><span>Profile Completed</span></div>
			<div class="tile-body"><span id="presentage"><?php echo $presentage; ?>%</span></div>
			<div class="tile-footer"><span class="text-danger"><?php if($presentage != 100){echo "<span class='text-danger'> Please complete your profile </span>";}else{echo "<span class='text-success'> Your profile is completed </span>";}?></span></div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="info-tile tile-success">
			<div class="tile-icon"><i class="ti ti-bar-chart-alt"></i></div>
			<div class="tile-heading"><span>Students</span></div>
			<div class="tile-body"><span>90 +</span></div>
			<div class="tile-footer"><span class="text-success">Already registed with us</span></div>
		</div>
	</div>
</div>
<!-- Tiles Ends here -->




<div data-widget-group="group1">
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-info" data-widget='{"id" : "wiget9", "draggable": "false"}'>
				<div class="panel-heading">
					<h2>Sponser Advertisments</h2>
					<div class="panel-ctrls button-icon-bg" 
						data-actions-container="" 
						data-action-collapse='{"target": ".panel-body"}'
						data-action-colorpicker=''
						data-action-refresh-demo='{"type": "circular"}'
						>
					</div>
				</div>
				<div class="panel-editbox"></div>
				<div class="panel-body">
					<div style="height: 272px;" class="mt-sm mb-sm">
						<video autoplay loop muted width="100%" height="272px">
							<source src="../../main_ads_grid/Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/Ads/ad1.mp4" type="video/mp4">
						</video>
							
					</div>
				</div
			</div>
		</div>

		<div class="col-md-6">
			<div class="panel panel-bluegray" data-widget='{"draggable": "false"}'>
				<div class="panel-heading">
					<h2>Privacy pollicy</h2>
					<div class="panel-ctrls button-icon-bg" 
						data-actions-container="" 
						data-action-collapse='{"target": ".panel-body"}'
						data-action-colorpicker=''
						data-action-refresh-demo='{"type": "circular"}'
						>
					</div>
				</div>
				<div class="panel-body">
					<div id="earnings" style="height: 240px; overflow-x:scroll;" class="mt-sm mb-sm">Edupara is taking the whole responsibility of a teacher registered in edupara.lk. Because of that, we might need some certificates to prove some information you provide. All of these things we are doing, because of the child scammers.<br/><br/>Students' accounts could be blocked if they provide some bad words as their usernames. But we will contact you before we block your account.<br/><br/>If a student request to reset their password more than 5 times, he/she will be added to the red list. Doesn't matter if you entered a fake email to log in. But please keep it in your mind.</div>
				</div>
			</div>
		</div><div class="col-md-6">
			<div class="panel panel-bluegray" data-widget='{"draggable": "false"}'>
				<div class="panel-heading">
					<h2>Terms & Conditions</h2>
					<div class="panel-ctrls button-icon-bg" 
						data-actions-container="" 
						data-action-collapse='{"target": ".panel-body"}'
						data-action-colorpicker=''
						data-action-refresh-demo='{"type": "circular"}'
						>
					</div>
				</div>
				<div class="panel-body">
					<div id="earnings" style="height: 240px;overflow-x:scroll;" class="mt-sm mb-sm">Your data is 100% safe with us. We won't provide your email, contact numbers, or any other sensitive and valuable data to anyone.<br/><br/>We don't need any third-party cookies. So your browser, internet connection as well as virus guard is friendly with our website.</div>
				</div>
			</div>
		</div>

	</div>

	<div class="col-md-6">
			<div class="panel panel-teal" data-widget='{"draggable": "false"}'>
				<div class="panel-heading">
					<h2>Your Informations</h2>
					<div class="panel-ctrls button-icon-bg" 
						data-actions-container="" 
						data-action-collapse='{"target": ".panel-body"}'
						data-action-colorpicker=''
						data-action-refresh-demo='{"type": "circular"}'
						>
					</div>
				</div>
				<div class="panel-body no-padding">
					<table class="table browsers m-n">
						<tbody>
							<tr>
								<td>Full Name</td>
								<td class="text-right"><?php echo "$fname $sname"; ?></td>
								<td class="vam">
									<td class="text-success"><b>[OK]</b></td>
	                            </td>
							</tr>
							<tr>
								<td>Phone Number</td>
								<td class="text-right"><?php echo "$phone_number"; ?></td>
								<td class="vam">
									<?php if($phone_number != NULL || $phone_number != ''){echo "<td class='text-success'><b>[OK]</b></td>"; }else{echo "<td class='text-danger'><b>[NOT ADDED]</b></td>";} ?>
	                            </td>
							</tr>
							<tr>
								<td>Whatsapp Number</td>
									<td class="text-right"><?php if($whatsapp_number != NULL || $whatsapp_number != ''){echo $whatsapp_number; }else{echo '';} ?></td>
									<td class="vam">
										<?php if($whatsapp_number != NULL || $whatsapp_number != ''){echo "<td class='text-success'><b>[OK]</b></td>"; }else{echo "<td class='text-danger'><b>[NOT ADDED]</b></td>";} ?>
									</td>
							</tr>
							<tr>
								<td>Univeristy</td>
									<td class="text-right"><?php if($university != NULL || $university != ''){echo $university; }else{echo '';} ?></td>
									<td class="vam">
										<td class="text-success"><b></b></td>
									</td>
							</tr>
							<tr>
								<td>Social Media Accounts</td>
									<td class="text-right"><?php if(($facebook_link || $youtube_link) != NULL || ($facebook_link || $youtube_link) != ''){echo "Done"; }else{echo '';} ?></td>
									<td class="vam">
										<?php if(($facebook_link || $youtube_link) != NULL || ($facebook_link || $youtube_link) != ''){echo "<td class='text-success'><b>[OK]</b></td>"; }else{echo "<td class='text-danger'><b>[NOT ADDED]</b></td>";} ?>
									</td>
							</tr>
							<tr>
								<td>How many subjects you teach</td>
									<td class="text-right"><?php echo $amount_subjects; ?></td>
									<td class="vam">
										<td class="text-success"><b>[OK]</b></td>
								</td>
							</tr>
							<tr>
								<td>Languages (Mediums)</td>
									<td class="text-right"><?php if($languages != NULL || $languages != ''){echo $languages; }else{echo '';} ?></td>
									<td class="vam">
										<?php if($languages != NULL || $languages != ''){echo "<td class='text-success'><b>[OK]</b></td>"; }else{echo "<td class='text-danger'><b>[NOT ADDED]</b></td>";} ?>
								</td>
							</tr>
							<tr>
								<td>Email</td>
									<td class="text-right"><?php echo $email; ?></td>
									<td class="vam">
										<td class='text-success'><b>[OK]</b></td>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>


	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-gray" data-widget='{"draggable": "false"}'>
                <div class="panel-heading">
                	<h2>Logs</h2>
	                <div class="panel-ctrls button-icon-bg" 
						data-actions-container="" 
						data-action-collapse='{"target": ".panel-body"}'
						data-action-colorpicker=''
						data-action-refresh-demo='{"type": "circular"}'
						>
					</div>
				</div>
				<div class="panel-body">
					<ul class="mini-timeline">
						<li class="mini-timeline-lime">
							<div class="timeline-icon"></div>
							<div class="timeline-body">
								<div class="timeline-content">
									<a href="#/" class="name"><?php echo "$fname $sname"; ?></a> Account added to reviewing teachers list <a href="#/"></a>
									<span class="time"><?php $datetime = new DateTime($registerd_time); echo $datetime->format('Y-m-d');?></span>
								</div>
							</div>
						</li>

						<li class="mini-timeline-deeporange">
							<div class="timeline-icon"></div>
							<div class="timeline-body">
								<div class="timeline-content">
									<a href="#/" class="name"><?php echo "$fname $sname"; ?></a> account accepted as a Teacher by<a href="#/" class="name"> Janith Dewapriya (Dierector)</a> and <a href="#/" class="name">Admin panel.</a> Registration was successful.
									<span class="time"><?php $datetime = new DateTime($joined_time); echo $datetime->format('Y-m-d');?></span>
								</div>
							</div>
						</li>

						<li class="mini-timeline-info">
							<div class="timeline-icon"></div>
							<div class="timeline-body">
								<div class="timeline-content">
									<a href="#/" class="name">You can Add subjects</a> by clicking this link <a href="./ui-tables.php?">Add Subjects/ Classes</a>
									
								</div>
							</div>
						</li>

						<li class="mini-timeline-indigo">
							<div class="timeline-icon"></div>
							<div class="timeline-body">
								<div class="timeline-content">
								<a href="#/" class="name">You can complete your profile</a> by clicking this link. Don't forget to fill all the details, Your details will appear to students. <a href="./extras-profile.php?">Complete profile</a>
									
								</div>
							</div>
						</li>

						<li class="mini-timeline-info">
							<div class="timeline-icon"></div>
							<div class="timeline-body">
								<div class="timeline-content">
									<a href="#/" class="name">Note:</a> &nbsp; Anytime you can change the amount of subjects / classes via your profile.
									
								</div>
							</div>
						</li>

						<!-- <li class="mini-timeline-default">
							<div class="timeline-body ml-n">
								<div class="timeline-content">
									<button type="button" data-loading-text="Loading..." class="loading-example-btn btn btn-sm btn-default">See more</button>
								</div>
							</div>
						</li> -->
					</ul>
				</div> 
				<!-- <div class="panel-body scroll-pane" style="height: 320px;">
					<div class="scroll-content">
						<ul class="mini-timeline">
							<li class="mini-timeline-lime">
								<div class="timeline-icon"></div>
								<div class="timeline-body">
									<div class="timeline-content">
										<a href="#/" class="name">Pawan Vikasitha</a> account acceped by Admins <a href="#/">Admin Dashboard UI</a>
										<span class="time">4 mins ago</span>
									</div>
								</div>
							</li>

							<li class="mini-timeline-deeporange">
								<div class="timeline-icon"></div>
								<div class="timeline-body">
									<div class="timeline-content">
										<a href="#/" class="name">Shawna Owen</a> added <a href="#/" class="name">Alonzo Keller</a> and <a href="#/" class="name">Mario Bailey</a> to project <a href="#/">Wordpress eCommerce Template</a>
										<span class="time">6 mins ago</span>
									</div>
								</div>
							</li>

							<li class="mini-timeline-info">
								<div class="timeline-icon"></div>
								<div class="timeline-body">
									<div class="timeline-content">
										<a href="#/" class="name">Christian Delgado</a> commented on thread <a href="#/">Frontend Template PSD</a>
										<span class="time">12 mins ago</span>
									</div>
								</div>
							</li>

							<li class="mini-timeline-indigo">
								<div class="timeline-icon"></div>
								<div class="timeline-body">
									<div class="timeline-content">
										<a href="#/" class="name">Jonathan Smith</a> added <a href="#/" class="name">Frend Pratt</a> and <a href="#/" class="name">Robin Horton</a> to project <a href="#/">Material Design Admin Template</a>
										<span class="time">6 hours ago</span>
									</div>
								</div>
							</li>

							<li class="mini-timeline-lime">
								<div class="timeline-icon"></div>
								<div class="timeline-body">
									<div class="timeline-content">
										<a href="#/" class="name">Vincent Keller</a> added new task <a href="#/">Admin Dashboard UI</a>
										<span class="time">4 mins ago</span>
									</div>
								</div>
							</li>

							<li class="mini-timeline-deeporange">
								<div class="timeline-icon"></div>
								<div class="timeline-body">
									<div class="timeline-content">
										<a href="#/" class="name">Shawna Owen</a> added <a href="#/" class="name">Alonzo Keller</a> and <a href="#/" class="name">Mario Bailey</a> to project <a href="#/">Wordpress eCommerce Template</a>
										<span class="time">6 mins ago</span>
									</div>
								</div>
							</li>

							<li class="mini-timeline-info">
								<div class="timeline-icon"></div>
								<div class="timeline-body">
									<div class="timeline-content">
										<a href="#/" class="name">Christian Delgado</a> commented on thread <a href="#/">Frontend Template PSD</a>
										<span class="time">12 mins ago</span>
									</div>
								</div>
							</li>

							<li class="mini-timeline-indigo">
								<div class="timeline-icon"></div>
								<div class="timeline-body">
									<div class="timeline-content">
										<a href="#/" class="name">Jonathan Smith</a> added <a href="#/" class="name">Frend Pratt</a> and <a href="#/" class="name">Robin Horton</a> to project <a href="#/">Material Design Admin Template</a>
										<span class="time">6 hours ago</span>
									</div>
								</div>
							</li>
							<li class="mini-timeline-indigo">
								<div class="timeline-icon"></div>
								<div class="timeline-body">
									<div class="timeline-content">
										<a href="#/" class="name">Pawan Vikasitha</a> added <a href="#/" class="name">Frend Pratt</a> and <a href="#/" class="name">Robin Horton</a> to project <a href="#/">Material Design Admin Template</a>
										<span class="time">6 hours ago</span>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel panel-white" data-widget='{"draggable": "false"}'>
                <div class="panel-heading">
                	<h2>New Members</h2>
	                <div class="panel-ctrls button-icon-bg" 
						data-actions-container="" 
						data-action-refresh-demo='{"type": "circular"}'
						>
					</div>
				</div>
				<div class="panel-body">
					<ul class="widget-avatar">
						<li><img src="http://placehold.it/300&text=Placeholder" alt=""/></li>
						<li><img src="http://placehold.it/300&text=Placeholder" alt=""/></li>
						<li><img src="http://placehold.it/300&text=Placeholder" alt=""/></li>
						<li><img src="http://placehold.it/300&text=Placeholder" alt=""/></li>
						<li><img src="http://placehold.it/300&text=Placeholder" alt=""/></li>
					</ul>
					<button class="btn btn-block btn-primary">View More</button>
				</div>
			</div>

			<div class="panel panel-white" data-widget='{"draggable": "false"}'>
                <div class="panel-heading">
                	<h2>Online Now</h2>
	                <div class="panel-ctrls button-icon-bg" 
						data-actions-container="" 
						data-action-refresh-demo='{"type": "circular"}'
						>
					</div>
				</div>
				<div class="panel-body">
					<ul class="widget-avatar">
						<li data-status="online"><img src="http://placehold.it/300&text=Placeholder" alt=""/></li>
						<li data-status="online"><img src="http://placehold.it/300&text=Placeholder" alt=""/></li>
						<li data-status="online"><img src="http://placehold.it/300&text=Placeholder" alt=""/></li>
						<li data-status="away"><img src="http://placehold.it/300&text=Placeholder" alt=""/></li>
						<li data-status="busy"><img src="http://placehold.it/300&text=Placeholder" alt=""/></li>
					</ul>
					<button class="btn btn-block btn-success">Contact List</button>
				</div>
			</div>
		</div>
		<div class="col-md-3">

			<div class="panel panel-midnightblue widget-progress" data-widget='{"draggable": "false"}'>
                <div class="panel-heading">
                    <h2>Progress</h2>
                    <div class="panel-ctrls button-icon-bg" 
						data-actions-container="" 
						data-action-refresh-demo='{"type": "circular"}'
						>
					</div>
                </div>
                <div class="panel-body">
					<div class="easypiechart mb-md" id="progress" data-percent="37">
						<span class="percent-non"></span>
					</div>
                </div>
                <div class="panel-footer">
					<div class="tabular">
						<div class="tabular-row">
							<div class="tabular-cell">
								<span class="status-total">Total</span>
								<span class="status-value">100</span>
							</div>
							<div class="tabular-cell">
								<span class="status-pending">Pending</span>
								<span class="status-value">63</span>
							</div>
						</div>
					</div>
				</div>
            </div>

			<div class="widget-weather">
				<div class="pull-left">
					<span class="weather-location">Toronto, CA</span>
					<span class="weather-desc">Sunny</span>
				</div>
				<div class="pull-right">
					<span class="weather-temp">16<span>ºC</span></span>
				</div>
			</div>
		</div>
	</div>


	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-default" data-widget='{"draggable": "false"}'>
				<div class="panel-heading">
					<h2>Visitor Stats</h2>
					<div class="panel-ctrls button-icon-bg" 
						data-actions-container="" 
						data-action-collapse='{"target": ".panel-body"}'
						data-action-colorpicker=''
						data-action-refresh-demo='{"type": "circular"}'
						>
					</div>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-6">
							<div class="spark-container mb-xl">
								<div class="pull-left">
									<h2 class="title" style="color: #cddc39">Pageviews</h2>
									<h3 class="number">19,600</h3>
								</div>
								<div class="pull-right">
									<h2 class="title" style="color: #ff5722; text-align: right;">Sessions</h2>
									<h3 class="number">1,200</h3>
								</div>

								<div class="spark-pageviews"></div>
							</div>
						</div>
						<div class="col-md-6">
							<div id="newvsreturning" style="height: 144px" class="mt-md mb-md"></div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="spark-container">
								<h2 class="title">Users</h2>
								<h3 class="number">700</h3>
								<div class="spark-users"></div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="spark-container">
								<h2 class="title">Avg. Duration</h2>
								<h3 class="number">00:04:36</h3>
								<div class="spark-avgduration"></div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="spark-container">
								<h2 class="title">Page/Session</h2>
								<h3 class="number">4.20</h3>
								<div class="spark-pagesession"></div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="spark-container">
								<h2 class="title">Bounce Rate</h2>
								<h3 class="number">52.10%</h3>
								<div class="spark-bouncerate"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>

	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-realtime" data-widget='{"draggable": "false"}'>
                <div class="panel-heading">
                    <h2>Real-Time</h2>
                    <div class="panel-ctrls mr-n">
                    	<div class="mt-md mb-md">
                    		<input type="checkbox" class="js-switch-success switchery-xs" checked />
						</div>
                    </div>
                </div>
                <div class="panel-body">
                	<span class="rightnow">Right Now</span>
					<span class="number">20</span>
					<span class="activeuser">active Users right now</span>
                    <div id="realtime-updates" style="height: 112px" class="centered"></div>
                </div>
            </div>
		</div>
		<div class="col-md-8">
			<div class="panel panel-white" data-widget='{"draggable": "false"}'>
                <div class="panel-heading">
                    <h2>World Map</h2>
                    <div class="panel-ctrls button-icon-bg" 
						data-actions-container="" 
						data-action-collapse='{"target": ".panel-body"}'
						data-action-colorpicker=''
						data-action-refresh-demo='{"type": "circular"}'
						>
					</div>
                </div>
                <div class="panel-body">
					<div id="worldmap" style="height: 272px; width: 100%;" class="mt-sm mb-sm"></div>
                </div>
            </div>
		</div>
		
	</div> -->

</div>

                            </div> <!-- .container-fluid -->
                        </div> <!-- #page-content -->
                    </div>
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
        <div class="demo-heading">Appearance</div>

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
    
<!-- Charts -->
<script type="text/javascript" src="assets/plugins/charts-flot/jquery.flot.min.js"></script>             	<!-- Flot Main File -->
<script type="text/javascript" src="assets/plugins/charts-flot/jquery.flot.pie.min.js"></script>             <!-- Flot Pie Chart Plugin -->
<script type="text/javascript" src="assets/plugins/charts-flot/jquery.flot.stack.min.js"></script>       	<!-- Flot Stacked Charts Plugin -->
<script type="text/javascript" src="assets/plugins/charts-flot/jquery.flot.orderBars.min.js"></script>   	<!-- Flot Ordered Bars Plugin-->
<script type="text/javascript" src="assets/plugins/charts-flot/jquery.flot.resize.min.js"></script>          <!-- Flot Responsive -->
<script type="text/javascript" src="assets/plugins/charts-flot/jquery.flot.tooltip.min.js"></script> 		<!-- Flot Tooltips -->
<script type="text/javascript" src="assets/plugins/charts-flot/jquery.flot.spline.js"></script> 				<!-- Flot Curved Lines -->

<script type="text/javascript" src="assets/plugins/sparklines/jquery.sparklines.min.js"></script> 			 <!-- Sparkline -->

<script type="text/javascript" src="assets/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>       <!-- jVectorMap -->
<script type="text/javascript" src="assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>   <!-- jVectorMap -->

<script type="text/javascript" src="assets/plugins/switchery/switchery.js"></script>     					<!-- Switchery -->
<script type="text/javascript" src="assets/plugins/easypiechart/jquery.easypiechart.js"></script>
<script type="text/javascript" src="assets/plugins/fullcalendar/moment.min.js"></script> 		 			<!-- Moment.js Dependency -->
<script type="text/javascript" src="assets/plugins/fullcalendar/fullcalendar.min.js"></script>   			<!-- Calendar Plugin -->

<script type="text/javascript" src="assets/demo/demo-index.js"></script> 									<!-- Initialize scripts for this page-->
<script type="text/javascript" src="assets/plugins/pines-notify/pnotify.min.js"></script> 		<!-- PNotify -->
    <!-- End loading page level scripts-->

    </body>
</html>








