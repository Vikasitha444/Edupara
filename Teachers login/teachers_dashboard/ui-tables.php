<?php

use Twig\Node\PrintNode;

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
    <title>Teachers Dashbaord - Add Subjects / Classes | Edupara.lk</title>
	<link rel="shortcut icon" href="../../index/img/core-img/favicon.ico" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="description" content="Add Subjects / Classes | Edupara.lk">
    

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
        @import '~pretty-checkbox/src/pretty-checkbox.scss';
        select:focus {
            background:"red";
            color:"yellow";}

        select{
            font-size: 1.3rem;
        }

        #dropdowns{
            font-size: 1.5rem;
            text-align: center;
            width: 100%;
            overflow: scroll;
        }

        input[type=text]{
            width: 1px !important;
        }
        

        #selectgrade:focus option:checked {
                background: red linear-gradient(0deg, #3887FE 0%, #3887FE 100%);
				
            }
            #selectSubjects:focus option:checked {
                background: red linear-gradient(0deg, #3887FE 0%, #3887FE 100%);
            }
            #selectSubjects2:focus option:checked {
                background: red linear-gradient(0deg, #3887FE 0%, #3887FE 100%);
            }
            #days:focus option:checked {
                background: red linear-gradient(0deg, #3887FE 0%, #3887FE 100%);
            }

            option{
                cursor: pointer;
            }

			select:focus{
				border-radius: 2px;
			}

			select::-webkit-scrollbar{
				scrollbar-width: thin;
			}


			#Cities_colombo,
			#Cities_mathara,
			#Cities_gampha,
			#Cities_jaffna,
			#Cities_kilinochchi,
			#Cities_Mannar,
			#Cities_Mullaitivu,
			#Cities_Vavuniya,
			#Cities_Puttalam,
			#Cities_Kurunegala,
			#Cities_Kalutara,
			#Cities_Anuradhapura,
			#Cities_Polonnaruwa,
			#Cities_Matale,
			#Cities_Kandy,
			#Cities_Nuwara_Eliya,
			#Cities_Kegalle,
			#Cities_Ratnapura,
			#Cities_Trincomalee,
			#Cities_Batticaloa,
			#Cities_Ampara,
			#Cities_Badulla,
			#Cities_Monaragala,
			#Cities_Hambantota,
			#Cities_Galle {
				display: none;
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



                <div class="static-content-wrapper" >
                    <div class="static-content">
                        <div class="page-content">
                            <ol class="breadcrumb">
                                <li><a href="./index_original.php?">Home</a></li>
								<li><a href="./index_original.php?">Dashboard</a></li>
								<li class="active"><a href="ui-tables.php?">Add Subjects</a></li>
							</ol>


<div class="container-fluid"  >
		
	
			





		
				

	<!-- Variations -->





<?php



	
	$subjects_on_database_sync = intval($subjects_on_database) + 1; //sync means we need to add +1 to subjects_on_database
	$year = date('Y');
	$next_year = $year + 1;
	$next_next_year = $year + 2;

	
	if($rest_of_subjects == 0){
		echo "<div class='alert alert-dismissable alert-info'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
		<h2>You've added all the subjects / classes !</h4> 

		<h3>If you want to add more subjects or classes, Please change the amount of <i>How many subjects you do teach?</i> in your profile. Click on, Profile --> Edit</p>
		
		
	  </div>";
	}

	
	
	if($rest_of_subjects != 0){

		echo "<div class='list-group list-group-alternate'>  
			<a href='#' class='list-group-item'><span class='badge badge-primary'><big>$amount_subjects</big></span> <i class='ti ti-layout-sidebar-none'></i> How many subjects / classes you teach </a> 
			<a href='#' class='list-group-item'><span class='badge'><big>$subjects_on_database</big></span> <i class='ti ti-bookmark'></i> How many subjects / classes added already</a> 
			<a href='#' class='list-group-item'><span class='badge badge-danger'><big>$rest_of_subjects</big></span> <i class='ti ti-widget'></i> How many subjects / classes still can you add </a> 
		</div>";


		echo "<div class='alert alert-dismissable alert-success'>
		<i class='ti ti-check'></i>&nbsp; <strong>Choose items from the table shown below.</strong> &nbsp; Select your subject or class details and click <i>ADD SUBJECT/ CLASS</i> to save changes. And all your subjects will visible to students. <br/>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
	  </div>
				  
									
	  <div data-widget-group='group1''>
		<div class='row'>
		  <div class='col-xs-12'>
			<div class='panel panel-default' data-widget='{'draggable': 'false'}'>
	";
	
	
	
	
			echo
			"<div class='col-md-50'>
			<div class='panel panel-info' data-widget='{'draggable': 'false'}' >
				<div class='panel-heading'>
				<h2>Schedule Your Class / Subject</h2>
				<div class='panel-ctrls' data-actions-container='' ></div>
				<div class='options'>

				</div>
				</div>
				<div class='panel-body no-padding table-responsive'>
				<table class='table' id='dropdowns'>
				<thead> 
					<tr class='info table-responsive'>
					<th>Grade</th>
					<th>Subject</th>
					<th>Batch</th>
					<th>Class Conducting date</th>
					<th>Class Conducting time</th>
					<th>Where classes are available</th>
					<th>Medium</th>
					<th>Class type</th>
					</tr>
					</thead>
					<tbody>

					</tr>



					

						
					<tr>
					<td class='dropdown'>
					<form action='ui-tables.php?' name='FILTER' method='POST' onsubmit='return handleData()'>
						<select name='grades' id='selectgrade' size='15' data-toggle='dropdown' style='width: 100px; overflow:scroll;' required>
							<!-- <option value='grade_5'>Grade 5</option> -->
							<option value='grade_6'>Grade 6</option>
							<option value='grade_7'>Grade 7</option>
							<option value='grade_8'>Grade 8</option>
							<option value='grade_9'>Grade 9</option>
							<option value='OL'>O/L</option>
							<option value='AL'>A/L</option>
							
						</select>
						
					</td>
					
					
					
					<td class='dropdown'>
						
						<select name='Subject' id='selectSubjects' size = ' 15'style='width: 130px; height: auto;' required>
						<option data-value = 'grade_6' value='Buddhism'>Buddhism</option>
						<option data-value = 'grade_6' value='Christianity'>Christianity</option>
						<option data-value = 'grade_6' value='Catholic'>Catholic</option>
						<option data-value = 'grade_6' value='English Language'>English Language</option>
						<option data-value = 'grade_6' value='Science'>Science</option>
						<option data-value = 'grade_6' value='Geography'>Geography</option>
						<option data-value = 'grade_6' value='Dancing'>Dancing</option>
						<option data-value = 'grade_6' value='Western Music'>Western Music</option>
						<option data-value = 'grade_6' value='Drama & Theatre'>Drama & Theatre</option>
						<option data-value = 'grade_6' value='Health & Physical Education'>Health & Physical Education</option>
						<option data-value = 'grade_6' value='Shivenary'>Shivenary</option>
						<option data-value = 'grade_6' value='Sinhala Language'>Sinhala Language</option>
						<option data-value = 'grade_6' value='Mathematics'>Mathematics</option>
						<option data-value = 'grade_6' value='History'>History</option>
						<option data-value = 'grade_6' value='Life skills & Citizenshipn Education'>Life skills & Citizenshipn Education</option>
						<option data-value = 'grade_6' value='Eastern Music'>Eastern Music</option>
						<option data-value = 'grade_6' value='Art'>Art</option>
						<option data-value = 'grade_6' value='Practical & Technical Studies'>Practical & Technical Studies</option>
						<option data-value = 'grade_6' value='Tamil Language'>Tamil Language</option>



						<option data-value = 'grade_7' value='Buddhism'>Buddhism</option>
						<option data-value = 'grade_7' value='Christianity'>Christianity</option>
						<option data-value = 'grade_7' value='Catholic'>Catholic</option>
						<option data-value = 'grade_7' value='English Language'>English Language</option>
						<option data-value = 'grade_7' value='Science'>Science</option>
						<option data-value = 'grade_7' value='Geography'>Geography</option>
						<option data-value = 'grade_7' value='Dancing'>Dancing</option>
						<option data-value = 'grade_7' value='Western Music'>Western Music</option>
						<option data-value = 'grade_7' value='Drama & Theatre'>Drama & Theatre</option>
						<option data-value = 'grade_7' value='Health & Physical Education'>Health & Physical Education</option>
						<option data-value = 'grade_7' value='Shivenary'>Shivenary</option>
						<option data-value = 'grade_7' value='Sinhala Language'>Sinhala Language</option>
						<option data-value = 'grade_7' value='Mathematics'>Mathematics</option>
						<option data-value = 'grade_7' value='History'>History</option>
						<option data-value = 'grade_7' value='Life skills & Citizenshipn Education'>Life skills & Citizenshipn Education</option>
						<option data-value = 'grade_7' value='Eastern Music'>Eastern Music</option>
						<option data-value = 'grade_7' value='Art'>Art</option>
						<option data-value = 'grade_7' value='Practical & Technical Studies'>Practical & Technical Studies</option>
						<option data-value = 'grade_7' value='Tamil Language'>Tamil Language</option>


						<option data-value = 'grade_8' value='Buddhism'>Buddhism</option>
						<option data-value = 'grade_8' value='Christianity'>Christianity</option>
						<option data-value = 'grade_8' value='Catholic'>Catholic</option>
						<option data-value = 'grade_8' value='English Language'>English Language</option>
						<option data-value = 'grade_8' value='Science'>Science</option>
						<option data-value = 'grade_8' value='Geography'>Geography</option>
						<option data-value = 'grade_8' value='Dancing'>Dancing</option>
						<option data-value = 'grade_8' value='Western Music'>Western Music</option>
						<option data-value = 'grade_8' value='Drama & Theatre'>Drama & Theatre</option>
						<option data-value = 'grade_8' value='Health & Physical Education'>Health & Physical Education</option>
						<option data-value = 'grade_8' value='Shivenary'>Shivenary</option>
						<option data-value = 'grade_8' value='Sinhala Language'>Sinhala Language</option>
						<option data-value = 'grade_8' value='Mathematics'>Mathematics</option>
						<option data-value = 'grade_8' value='History'>History</option>
						<option data-value = 'grade_8' value='Life skills & Citizenshipn Education'>Life skills & Citizenshipn Education</option>
						<option data-value = 'grade_8' value='Eastern Music'>Eastern Music</option>
						<option data-value = 'grade_8' value='Art'>Art</option>
						<option data-value = 'grade_8' value='Practical & Technical Studies'>Practical & Technical Studies</option>
						<option data-value = 'grade_8' value='Tamil Language'>Tamil Language</option>



						<option data-value = 'grade_9' value='Buddhism'>Buddhism</option>
						<option data-value = 'grade_9' value='Christianity'>Christianity</option>
						<option data-value = 'grade_9' value='Catholic'>Catholic</option>
						<option data-value = 'grade_9' value='English Language'>English Language</option>
						<option data-value = 'grade_9' value='Science'>Science</option>
						<option data-value = 'grade_9' value='Geography'>Geography</option>
						<option data-value = 'grade_9' value='Dancing'>Dancing</option>
						<option data-value = 'grade_9' value='Western Music'>Western Music</option>
						<option data-value = 'grade_9' value='Drama & Theatre'>Drama & Theatre</option>
						<option data-value = 'grade_9' value='Health & Physical Education'>Health & Physical Education</option>
						<option data-value = 'grade_9' value='Shivenary'>Shivenary</option>
						<option data-value = 'grade_9' value='Sinhala Language'>Sinhala Language</option>
						<option data-value = 'grade_9' value='Mathematics'>Mathematics</option>
						<option data-value = 'grade_9' value='History'>History</option>
						<option data-value = 'grade_9' value='Life skills & Citizenshipn Education'>Life skills & Citizenshipn Education</option>
						<option data-value = 'grade_9' value='Eastern Music'>Eastern Music</option>
						<option data-value = 'grade_9' value='Art'>Art</option>
						<option data-value = 'grade_9' value='Practical & Technical Studies'>Practical & Technical Studies</option>
						<option data-value = 'grade_9' value='Tamil Language'>Tamil Language</option>



						<option data-value = 'OL' value='Buddhism'>Buddhism</option>
						<option data-value = 'OL' value='Christianity'>Christianity</option>
						<option data-value = 'OL' value='Catholism'>Catholism</option>
						<option data-value = 'OL' value='Islam'>Islam</option>
						<option data-value = 'OL' value='Sinhala Language & Literature'>Sinhala Language & Literature</option>
						<option data-value = 'OL' value='English'>English</option>
						<option data-value = 'OL' value='Mathematics'>Mathematics</option>
						<option data-value = 'OL' value='History'>History</option>
						<option data-value = 'OL' value='Science'>Science</option>
						<option data-value = 'OL' value='Geography'>Geography</option>
						<option data-value = 'OL' value='Citizenship Education'>Citizenship Education</option>
						<option data-value = 'OL' value='Enterpreneurial Education'>Enterpreneurial Education</option>
						<option data-value = 'OL' value='Business Studies & Accounts'>Business Studies & Accounts</option>
						<option data-value = 'OL' value='Eastern Music'>Eastern Music</option>
						<option data-value = 'OL' value='Western Music'>Western Music</option>
						<option data-value = 'OL' value='Art'>Art</option>
						<option data-value = 'OL' value='Traditional Dancing'>Traditional Dancing</option>
						<option data-value = 'OL' value='Sinhala Literature'>Sinhala Literature</option>
						<option data-value = 'OL' value='English Literature'>English Literature</option>
						<option data-value = 'OL' value='Information & Communication Technology'>Information & Communication Technology</option>
						<option data-value = 'OL' value='Agriculture & Food Technology'>Agriculture & Food Technology</option>
						<option data-value = 'OL' value='Art & Craft'>Art & Craft</option>
						<option data-value = 'OL' value='Home Economics'>Home Economics</option>
						<option data-value = 'OL' value='Health & Physical Education'>Health & Physical Education</option>
						




						<optgroup label='Technology stream' data-value='AL'>
							<option data-value='AL' value='SFT'>SFT</option> 
							<option data-value='AL' value='ET'>ET</option> 
							<option data-value='AL' value='ICT'>ICT</option>
							<option data-value='AL' value='BST'>BST</option>

						<optgroup label='Commerce Stream' data-value='AL'>
							<option data-value='AL' value='Business Studies'>Business Studies</option> 
							<option data-value='AL' value='Accountancy'>Accountancy</option> 
							<option data-value='AL' value='Economics'> Economics</option>
							<option data-value='AL' value='Business Statistics'>Business Statistics</option>
							<option data-value='AL' value='The logic and the scientific method'>The logic and the scientific method</option>



						<optgroup label='Physical Science stream' data-value='AL'>
							<option data-value='AL' value='Combined mathematics'>Combined mathematics</option> 
							<option data-value='AL' value='Physics'>Physics</option> 
							<option data-value='AL' value='Chemistry'> Chemistry</option>
							


						<optgroup label='Biological Science stream ' data-value='AL'>
							<option data-value='AL' value='Biology'>Biology</option> 
							<option data-value='AL' value='Physics'>Physics</option> 
							<option data-value='AL' value='chemistry'> Chemistry</option>
							
							
						</select>
						

						
						
					</td>
					
					<td>
						
						
						<select name='Batch' id='selectSubjects2' size='15' data-toggle='dropdown' style='width: 100px;' required>
							
							<option value='$year Theory'>$year Theory</option>
							<option value='$year Revision'>$year Revision</option>
							<option value='$year Papers'>$year Papers</option>
							<option value='$next_year Theory'>$next_year Theory</option>
							<option value='$next_year Revision'>$next_year Revision</option>
							<option value='$next_year Papers'>$next_year Papers</option>
							<option value='$next_next_year Theory'>$next_next_year Theory</option>
							<option value='$next_next_year Revision'>$next_next_year Revision</option>
							<option value='$next_next_year Papers'>$next_next_year Papers</option>
							<option value='All'>All </option>     
						</select>


						<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'></script>  
						
						<script>
						$(document).ready(function() {
						var selectors = ['selectgrade', 'selectSubjects','selectSubjects2']
						$('#selectgrade').on('change', function() {
							var index = selectors.indexOf(this.id)
							var value = this.value

							// check if is the last one or not
							if (index < selectors.length - 1) {
							var next = $('#' + selectors[index + 1])

							// Show all the options in next select
							$(next).find('option').show()
							if (value != '') {
							// if this select's value is not empty
							// hide some of the options 
							$(next).find('option[data-value!=' + value + ']').hide()
							}
							
							// set next select's value to be the first option's value 
							// and trigger change()
							$(next).val($(next).find('option:first').val()).change()
							}
							})
							});
						

						
						</script>

						
						
					</td>

					<td class='dropdown'>
						
						<select name='class_conducting_date' id ='days' size='15' data-toggle='dropdown' style='width: 100px;' required>
							<option value='Monday'>Monday</option>
							<option value='Tuesday'>Tuesday</option>
							<option value='Wednesday'>Wednesday</option>
							<option value='Thursday'>Thursday</option>
							<option value='Friday'>Friday</option>
							<option value='Saturday'>Saturday</option>
							<option value='Sunday'>Sunday</option>
							
						</select>
						
					</td>
					<td>
						<p style='font-size: 17px;'>Class begin at</p>
						<input type='time' style='width: 100%;' name='Begin_time' required>
						
						<p style='font-size: 17px;'>Class end at</p>
						<input type='time' style='width: 100%;' name='end_time' required>
					</td>
					
					<td>
						<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'></script>
						
						<h4>How do you do classes</h4>
						
						<select name='how_do_you_do_class' id='selectLevel' data-toggle='dropdown' style='width: 120px; height:30px;' required>
						<option value=''></option>
						<option value='online'>Online</option>
						<option value='physical'>Physical</option>
						<option value='both'>Both</option>
						<!-- <option value='tertiary'>Online</option> -->
						</select>



						<h4>Select the district</h4>

						<select name='district' id='selectSubject' data-toggle='dropdown' style='width: 120px; height:30px;' required>
						<option value=''> -- Select the district -- </option>
						<option data-value='online' value='Whole country'>Whole country</option>
						<option data-value='physical' value='Colombo'>Colombo</option>
						<option data-value='physical' value='Mathara'>Mathara</option>
						<option data-value='physical' value='Jaffna'>Jaffna</option>
						<option data-value='physical' value='Kilinochchi'>Kilinochchi</option>
						<option data-value='physical' value='Mannar'>Mannar</option>
						<option data-value='physical' value='Mullaitivu'>Mullaitivu</option>
						<option data-value='physical' value='Vavuniya'>Vavuniya</option>
						<option data-value='physical' value='Puttalam'>Puttalam</option>
						<option data-value='physical' value='Kurunegala'>Kurunegala</option>
						<option data-value='physical' value='Gampaha'>Gampaha</option>
						<option data-value='physical' value='Kalutara'>Kalutara</option>
						<option data-value='physical' value='Anuradhapura'>Anuradhapura</option>
						<option data-value='physical' value='Polonnaruwa'>Polonnaruwa</option>
						<option data-value='physical' value='Matale'>Matale</option>
						<option data-value='physical' value='Kandy'>Kandy</option>
						<option data-value='physical' value='Nuwara Eliya'>Nuwara Eliya</option>
						<option data-value='physical' value='Kegalle'>Kegalle</option>
						<option data-value='physical' value='Ratnapura'>Ratnapura</option>
						<option data-value='physical' value='Trincomalee'>Trincomalee</option>
						<option data-value='physical' value='Batticaloa'>Batticaloa</option>
						<option data-value='physical' value='Ampara'>Ampara</option>
						<option data-value='physical' value='Badulla'>Badulla</option>
						<option data-value='physical' value='Monaragala'>Monaragala</option>
						<option data-value='physical' value='Hambantota'>Hambantota</option>
						<option data-value='physical' value='Galle'>Galle</option>
						
						
						
						
						<option data-value='both' value='whole country'>Whole Country</option>
						<option data-value='both' value='Colombo'>Colombo</option>
						<option data-value='both' value='Mathara'>Mathara</option>
						<option data-value='both' value='Jaffna'>Jaffna</option>
						<option data-value='both' value='Kilinochchi'>Kilinochchi</option>
						<option data-value='both' value='Mannar'>Mannar</option>
						<option data-value='both' value='Mullaitivu'>Mullaitivu</option>
						<option data-value='both' value='Vavuniya'>Vavuniya</option>
						<option data-value='both' value='Puttalam'>Puttalam</option>
						<option data-value='both' value='Kurunegala'>Kurunegala</option>
						<option data-value='both' value='Gampaha'>Gampaha</option>
						<option data-value='both' value='Kalutara'>Kalutara</option>
						<option data-value='both' value='Anuradhapura'>Anuradhapura</option>
						<option data-value='both' value='Polonnaruwa'>Polonnaruwa</option>
						<option data-value='both' value='Matale'>Matale</option>
						<option data-value='both' value='Kandy'>Kandy</option>
						<option data-value='both' value='Nuwara Eliya'>Nuwara Eliya</option>
						<option data-value='both' value='Kegalle'>Kegalle</option>
						<option data-value='both' value='Ratnapura'>Ratnapura</option>
						<option data-value='both' value='Trincomalee'>Trincomalee</option>
						<option data-value='both' value='Batticaloa'>Batticaloa</option>
						<option data-value='both' value='Ampara'>Ampara</option>
						<option data-value='both' value='Badulla'>Badulla</option>
						<option data-value='both' value='Monaragala'>Monaragala</option>
						<option data-value='both' value='Hambantota'>Hambantota</option>
						<option data-value='both' value='Galle'>Galle</option>
						
						</select>

						<br/><br/>
						<select name='' id='selected_nothing' style='width: 120px; height:30px;' required>
							<option value='Everywhere'>- Everywhere -</option>
						</select>
						<select name='colombo' id='Cities_colombo' style='width: 120px; height:30px;' required>
							<option value='1000117'>All Cities</option>
							<option value='Akuregoda'>Akuregoda</option>
							<option value='Ambuldeniya'>Ambuldeniya</option>
							<option value='Angulana'>Angulana</option>
							<option value='Arangala'>Arangala</option>
							<option value='Arawwala'>Arawwala</option>
							<option value='Athurugiriya'>Athurugiriya</option>
							<option value='Attidiya'>Attidiya</option>
							<option value='Avissawella'>Avissawella</option>
							<option value='Batawala'>Batawala</option>
							<option value='Battaramulla'>Battaramulla</option>
							<option value='Batugampola'>Batugampola</option>
							<option value='Beddagana'>Beddagana</option>
							<option value='Bellanthara'>Bellanthara</option>
							<option value='Bellanwila'>Bellanwila</option>
							<option value='Bokundara'>Bokundara</option>
							<option value='Bomiriya'>Bomiriya</option>
							<option value='Bope'>Bope</option>
							<option value='Boralesgamuwa'>Boralesgamuwa</option>
							<option value='Borupana'>Borupana</option>
							<option value='Buthgamuwa'>Buthgamuwa</option>
							<option value='Colombo'>Colombo</option>
							<option value='Colombo 01'>Colombo 01</option>
							<option value='Colombo 02'>Colombo 02</option>
							<option value='Colombo 03'>Colombo 03</option>
							<option value='Colombo 04'>Colombo 04</option>
							<option value='Colombo 05'>Colombo 05</option>
							<option value='Colombo 06'>Colombo 06</option>
							<option value='Colombo 07'>Colombo 07</option>
							<option value='Colombo 08'>Colombo 08</option>
							<option value='Colombo 09'>Colombo 09</option>
							<option value='Colombo 10'>Colombo 10</option>
							<option value='Colombo 11'>Colombo 11</option>
							<option value='Colombo 12'>Colombo 12</option>
							<option value='Colombo 13'>Colombo 13</option>
							<option value='Colombo 14'>Colombo 14</option>
							<option value='Colombo 15'>Colombo 15</option>
							<option value='Dedigamuwa'>Dedigamuwa</option>
							<option value='Dehiwala'>Dehiwala</option>
							<option value='Delkanda'>Delkanda</option>
							<option value='Deltara'>Deltara</option>
							<option value='Egoda Uyana'>Egoda Uyana</option>
							<option value='Ethul Kotte'>Ethul Kotte</option>
							<option value='Gangodawilla'>Gangodawilla</option>
							<option value='Godagama'>Godagama</option>
							<option value='Gonapola'>Gonapola</option>
							<option value='Gothatuwa'>Gothatuwa</option>
							<option value='Habarakada'>Habarakada</option>
							<option value='Handapangoda'>Handapangoda</option>
							<option value='Hanwella'>Hanwella</option>
							<option value='Hewagama'>Hewagama</option>
							<option value='Himbutana'>Himbutana</option>
							<option value='Hokandara'>Hokandara</option>
							<option value='Homagama'>Homagama</option>
							<option value='Idama'>Idama</option>
							<option value='Indibedda'>Indibedda</option>
							<option value='Kaduwela'>Kaduwela</option>
							<option value='Kahathuduwa'>Kahathuduwa</option>
							<option value='Kalubowila'>Kalubowila</option>
							<option value='Karagampitiya'>Karagampitiya</option>
							<option value='Katubedda'>Katubedda</option>
							<option value='Katuwawala'>Katuwawala</option>
							<option value='Kesbewa'>Kesbewa</option>
							<option value='Kohuwela'>Kohuwela</option>
							<option value='Kolonnawa'>Kolonnawa</option>
							<option value='Koralawella'>Koralawella</option>
							<option value='Kosgama'>Kosgama</option>
							<option value='Koswatta'>Koswatta</option>
							<option value='Kotikawatta'>Kotikawatta</option>
							<option value='Kottawa'>Kottawa</option>
							<option value='Kotuwila'>Kotuwila</option>
							<option value='Lunawa'>Lunawa</option>
							<option value='Madapatha'>Madapatha</option>
							<option value='Madiwela'>Madiwela</option>
							<option value='Maharagama'>Maharagama</option>
							<option value='Makumbura'>Makumbura</option>
							<option value='Malabe'>Malabe</option>
							<option value='Mattegoda'>Mattegoda</option>
							<option value='Meegoda'>Meegoda</option>
							<option value='Meepe'>Meepe</option>
							<option value='Mirihana'>Mirihana</option>
							<option value='Moragahahena'>Moragahahena</option>
							<option value='Moratuwa'>Moratuwa</option>
							<option value='Mount Lavinia'>Mount Lavinia</option>
							<option value='Mullegama'>Mullegama</option>
							<option value='Mulleriyawa'>Mulleriyawa</option>
							<option value='Nawagamuwa'>Nawagamuwa</option>
							<option value='Nawala'>Nawala</option>
							<option value='Nawinna'>Nawinna</option>
							<option value='Nedimala'>Nedimala</option>
							<option value='Nugegoda'>Nugegoda</option>
							<option value='Orugodawatta'>Orugodawatta</option>
							<option value='Oruwala'>Oruwala</option>
							<option value='Padukka'>Padukka</option>
							<option value='Pamankada'>Pamankada</option>
							<option value='Panagoda'>Panagoda</option>
							<option value='Pannipitiya'>Pannipitiya</option>
							<option value='Pelawatta'>Pelawatta</option>
							<option value='Pepiliyana'>Pepiliyana</option>
							<option value='Piliyandala'>Piliyandala</option>
							<option value='Pita Kotte'>Pita Kotte</option>
							<option value='Pitipana Homagama'>Pitipana Homagama</option>
							<option value='Polgasowita'>Polgasowita</option>
							<option value='Puwakpitiya'>Puwakpitiya</option>
							<option value='Rajagiriya'>Rajagiriya</option>
							<option value='Ranala'>Ranala</option>
							<option value='Raththanapitiya'>Raththanapitiya</option>
							<option value='Ratmalana'>Ratmalana</option>
							<option value='Rawathawatte'>Rawathawatte</option>
							<option value='Rukmalgama'>Rukmalgama</option>
							<option value='Siddamulla'>Siddamulla</option>
							<option value='Soysapura'>Soysapura</option>
							<option value='Talawatugoda'>Talawatugoda</option>
							<option value='Thalahena'>Thalahena</option>
							<option value='Thalangama'>Thalangama</option>
							<option value='Thalapathpitiya'>Thalapathpitiya</option>
							<option value='Tummodara'>Tummodara</option>
							<option value='Udahamulla'>Udahamulla</option>
							<option value='Waga'>Waga</option>
							<option value='Watareka'>Watareka</option>
							<option value='1000091'>Welivita</option>
							<option value='Wellampitiya'>Wellampitiya</option>
							<option value='Werahara'>Werahara</option>
							<option value='Wijerama'>Wijerama</option>
						</select>

						<select name='mathara' id='Cities_mathara' style='width: 120px; height:30px;' required>
							<option value='1000117'>All Cities</option>
							<option value='Akuressa'>Akuressa</option>
							<option value='Bengamuwa'>Bengamuwa</option>
							<option value='Deiyandara'>Deiyandara</option>
							<option value='Deniyaya'>Deniyaya</option>
							<option value='Dikwella'>Dikwella</option>
							<option value='Hakmana'>Hakmana</option>
							<option value='Horapawita'>Horapawita</option>
							<option value='Kamburupitiya'>Kamburupitiya</option>
							<option value='Kekanadura'>Kekanadura</option>
							<option value='Kumbalgama'>Kumbalgama</option>
							<option value='Matara'>Matara</option>
							<option value='Mirissa'>Mirissa</option>
							<option value='Morawaka'>Morawaka</option>
							<option value='Mulatiyana'>Mulatiyana</option>
							<option value='Pahala Millawa'>Pahala Millawa</option>
							<option value='Thihagoda'>Thihagoda</option>
							<option value='Urubokka'>Urubokka</option>
							<option value='Urumutta'>Urumutta</option>
							<option value='Weligama'>Weligama</option>
						</select>

						<select name='gampaha' id='Cities_gampha' style='width: 120px; height:30px;' required>
							<option value='1000117'>All Cities</option>
							<option value='Aldeniya'>Aldeniya</option>
							<option value='Ambepussa'>Ambepussa</option>
							<option value='Attanagalla'>Attanagalla</option>
							<option value='Balummahara'>Balummahara</option>
							<option value='Bandigoda'>Bandigoda</option>
							<option value='Batuwatta'>Batuwatta</option>
							<option value='Bemmulla'>Bemmulla</option>
							<option value='Biyagama'>Biyagama</option>
							<option value='Bollatha'>Bollatha</option>
							<option value='Bopitiya'>Bopitiya</option>
							<option value='Bulugahagoda'>Bulugahagoda</option>
							<option value='Buthpitiya'>Buthpitiya</option>
							<option value='Dagonna'>Dagonna</option>
							<option value='Dalugama'>Dalugama</option>
							<option value='Dekatana'>Dekatana</option>
							<option value='Delathura'>Delathura</option>
							<option value='Delgoda'>Delgoda</option>
							<option value='Dewalapola'>Dewalapola</option>
							<option value='Divulapitiya'>Divulapitiya</option>
							<option value='Dompe'>Dompe</option>
							<option value='Dungalpitiya'>Dungalpitiya</option>
							<option value='Ekala'>Ekala</option>
							<option value='Enderamulla'>Enderamulla</option>
							<option value='Galahitiyawa'>Galahitiyawa</option>
							<option value='Gampaha'>Gampaha</option>
							<option value='Ganemulla'>Ganemulla</option>
							<option value='Gonawala'>Gonawala</option>
							<option value='Heiyanthuduwa'>Heiyanthuduwa</option>
							<option value='Hekitta'>Hekitta</option>
							<option value='Hendala'>Hendala</option>
							<option value='Hunupitiya'>Hunupitiya</option>
							<option value='Imbulgoda'>Imbulgoda</option>
							<option value='Ja-Ela'>Ja-Ela</option>
							<option value='Kadawatha'>Kadawatha</option>
							<option value='Kadirana'>Kadirana</option>
							<option value='Kalagedihena'>Kalagedihena</option>
							<option value='Kaleliya'>Kaleliya</option>
							<option value='Kaluaggala'>Kaluaggala</option>
							<option value='Kandana'>Kandana</option>
							<option value='Kandawala'>Kandawala</option>
							<option value='Kanuwana'>Kanuwana</option>
							<option value='Kapuwatta'>Kapuwatta</option>
							<option value='Katana'>Katana</option>
							<option value='Katunayake'>Katunayake</option>
							<option value='Kelaniya'>Kelaniya</option>
							<option value='Kimbulapitiya'>Kimbulapitiya</option>
							<option value='Kiribathgoda'>Kiribathgoda</option>
							<option value='Kirillawala'>Kirillawala</option>
							<option value='Kirindiwela'>Kirindiwela</option>
							<option value='Kochchikade'>Kochchikade</option>
							<option value='Kotadeniyawa'>Kotadeniyawa</option>
							<option value='Kotugoda'>Kotugoda</option>
							<option value='Kurana'>Kurana</option>
							<option value='Mabima'>Mabima</option>
							<option value='Mabodale'>Mabodale</option>
							<option value='Mabole'>Mabole</option>
							<option value='Mahabage'>Mahabage</option>
							<option value='Mahara'>Mahara</option>
							<option value='Makewita'>Makewita</option>
							<option value='Makola'>Makola</option>
							<option value='Malwana'>Malwana</option>
							<option value='Marandagahamula'>Marandagahamula</option>
							<option value='Mawaramandiya'>Mawaramandiya</option>
							<option value='Minuwangoda'>Minuwangoda</option>
							<option value='Mirigama'>Mirigama</option>
							<option value='Miriswatta'>Miriswatta</option>
							<option value='Mudungoda'>Mudungoda</option>
							<option value='Nagoda'>Nagoda</option>
							<option value='Nayakkanda'>Nayakkanda</option>
							<option value='Negombo'>Negombo</option>
							<option value='Nittambuwa'>Nittambuwa</option>
							<option value='Nivasipura'>Nivasipura</option>
							<option value='Niwandama'>Niwandama</option>
							<option value='Pamunugama'>Pamunugama</option>
							<option value='Pannala'>Pannala</option>
							<option value='Pasyala'>Pasyala</option>
							<option value='Peliyagoda'>Peliyagoda</option>
							<option value='Pethiyagoda'>Pethiyagoda</option>
							<option value='Pugoda'>Pugoda</option>
							<option value='Raddolugama'>Raddolugama</option>
							<option value='Ragama'>Ragama</option>
							<option value='Rillaulla'>Rillaulla</option>
							<option value='Sapugaskanda'>Sapugaskanda</option>
							<option value='Seeduwa'>Seeduwa</option>
							<option value='Siyambalape'>Siyambalape</option>
							<option value='Thihariya'>Thihariya</option>
							<option value='Thudella'>Thudella</option>
							<option value='Udugampola'>Udugampola</option>
							<option value='Udupila'>Udupila</option>
							<option value='Uswetakeiyawa'>Uswetakeiyawa</option>
							<option value='Veyangoda'>Veyangoda</option>
							<option value='Watinapaha'>Watinapaha</option>
							<option value='Wattala'>Wattala</option>
							<option value='Weligampitiya'>Weligampitiya</option>
							<option value='Welipillewa'>Welipillewa</option>
							<option value='Welisara'>Welisara</option>
							<option value='Weliveriya'>Weliveriya</option>
							<option value='Wewala'>Wewala</option>
						</select>




						<select name='jaffna' id='Cities_jaffna' style='width: 120px; height:30px;' required>
							<option value='1000117'>All Cities</option>
							<option value='Chavakachcheri'>Chavakachcheri</option>
							<option value='Chundikuli'>Chundikuli</option>
							<option value='Chunnakam'>Chunnakam</option>
							<option value='Jaffna'>Jaffna</option>
							<option value='Kaitadi'>Kaitadi</option>
							<option value='Kokuvil'>Kokuvil</option>
							<option value='Nallur'>Nallur</option>
							<option value='Nelliady'>Nelliady</option>
							<option value='Point Pedro'>Point Pedro</option>
							<option value='Sandilipay'>Sandilipay</option>
							<option value='Uduvil'>Uduvil</option>
							<option value='Urumpirai'>Urumpirai</option>
							<option value='Vaddukoddai'>Vaddukoddai</option>
							<option value='Valikamam'>Valikamam</option>
						</select>

						<select name='kilinochchi' id='Cities_kilinochchi' style='width: 120px; height:30px;' required>
							<option value='All Cities'>All Cities</option>
							<option value='Karadippokku'>Karadippokku</option>
							<option value='Kilinochchi'>Kilinochchi</option>
							<option value='Poonakary'>Poonakary</option>
						</select>
						</select>

						<select name='mannar' id='Cities_Mannar' style='width: 120px; height:30px;' required>
							<option value='All Cities'>All Cities</option>
							<option value='Mannar'>Mannar</option>
							<option value='Murunkan'>Murunkan</option>
							<option value='Nanattan'>Nanattan</option>
						</select>

						<select name='mullativu' id='Cities_Mullaitivu' style='width: 120px; height:30px;' required>
							<option value='1000117'>All Cities</option>
							<option value='Mankulam'>Mankulam</option>
							<option value='Pudukudiyirippu'>Pudukudiyirippu</option>
						</select>

						<select name='vavuniya' id='Cities_Vavuniya' style='width: 120px; height:30px;' required>
							<option value='All Cities'>All Cities</option>
							<option value='Vavuniya'>Vavuniya</option>
						</select>
						</select>

						<select name='puttalam' id='Cities_Puttalam' style='width: 120px; height:30px;' required>
							<option value='All Cities'>All Cities</option>
							<option value='Anamaduwa'>Anamaduwa</option>
							<option value='Chilaw'>Chilaw</option>
							<option value='Dankotuwa'>Dankotuwa</option>
							<option value='Kalpitiya'>Kalpitiya</option>
							<option value='Katuneriya'>Katuneriya</option>
							<option value='Madampe'>Madampe</option>
							<option value='Madurankuliya'>Madurankuliya</option>
							<option value='Mahawewa'>Mahawewa</option>
							<option value='Marawila'>Marawila</option>
							<option value='Nainamadama'>Nainamadama</option>
							<option value='Nattandiya'>Nattandiya</option>
							<option value='Nawagattegama'>Nawagattegama</option>
							<option value='Norachcholai'>Norachcholai</option>
							<option value='Puttalam'>Puttalam</option>
							<option value='Waikkal'>Waikkal</option>
							<option value='Wennappuwa'>Wennappuwa</option>
						</select>

						<select name='kurunegala' id='Cities_Kurunegala' style='width: 120px; height:30px;' required>
							<option value='All Cities'>All Cities</option>
							<option value='Alawwa'>Alawwa</option>
							<option value='Bingiriya'>Bingiriya</option>
							<option value='Boyagane'>Boyagane</option>
							<option value='Dambadeniya'>Dambadeniya</option>
							<option value='Dummalasuriya'>Dummalasuriya</option>
							<option value='Galgamuwa'>Galgamuwa</option>
							<option value='Giriulla'>Giriulla</option>
							<option value='Gokaralla'>Gokaralla</option>
							<option value='Hettipola'>Hettipola</option>
							<option value='Ibbagamuwa'>Ibbagamuwa</option>
							<option value='Kobeigane'>Kobeigane</option>
							<option value='Kuliyapitiya'>Kuliyapitiya</option>
							<option value='Kumbukgeta'>Kumbukgeta</option>
							<option value='Kumbukwewa'>Kumbukwewa</option>
							<option value='Kurunegala'>Kurunegala</option>
							<option value='Makandura'>Makandura</option>
							<option value='Malkaduwawa'>Malkaduwawa</option>
							<option value='Mallawapitiya'>Mallawapitiya</option>
							<option value='Mawathagama'>Mawathagama</option>
							<option value='Melsiripura'>Melsiripura</option>
							<option value='Narammala'>Narammala</option>
							<option value='Nikaweratiya'>Nikaweratiya </option>
							<option value='Pannala'>Pannala</option>
							<option value='Paragahadeniya'>Paragahadeniya</option>
							<option value='Polgahawela'>Polgahawela</option>
							<option value='Pothuhera'>Pothuhera</option>
							<option value='Ridigama'>Ridigama</option>
							<option value='Uyandana'>Uyandana</option>
							<option value='Wariyapola'>Wariyapola</option>
						</select>

						<select name='kaluthara' id='Cities_Kalutara' style='width: 120px; height:30px;' required>
							<option value='All Cities'>All Cities</option>
							<option value='Agalawatta'>Agalawatta</option>
							<option value='Alubomulla'>Alubomulla</option>
							<option value='Aluthgama'>Aluthgama</option>
							<option value='Aviththawa'>Aviththawa</option>
							<option value='Bandaragama'>Bandaragama</option>
							<option value='Beruwala'>Beruwala</option>
							<option value='Dharga Town'>Dharga Town</option>
							<option value='Dodangoda'>Dodangoda</option>
							<option value='Horana'>Horana</option>
							<option value='Horawala'>Horawala</option>
							<option value='Ingiriya'>Ingiriya</option>
							<option value='Kalutara'>Kalutara</option>
							<option value='Katukurunda'>Katukurunda</option>
							<option value='Maggona'>Maggona</option>
							<option value='Matugama'>Matugama</option>
							<option value='Meegahatenna'>Meegahatenna</option>
							<option value='Nagoda'>Nagoda</option>
							<option value='Paiyagala'>Paiyagala</option>
							<option value='Panadura'>Panadura</option>
							<option value='Pelawatta'>Pelawatta</option>
							<option value='Pokunuwita'>Pokunuwita</option>
							<option value='Wadduwa'>Wadduwa</option>
							<option value='Walallawita'>Walallawita</option>
							<option value='Waskaduwa'>Waskaduwa</option>
							<option value='Welipenna'>Welipenna</option>
						</select>

						<select name='anuradhapura' id='Cities_Anuradhapura' style='width: 120px; height:30px;' required>
							<option value='All Cities'>All Cities</option>
							<option value='Anuradhapura'>Anuradhapura</option>
							<option value='Awukana'>Awukana</option>
							<option value='Kahatagasdigiliya'>Kahatagasdigiliya</option>
						</select>

						<select name='polonnaruwa' id='Cities_Polonnaruwa' style='width: 120px; height:30px;' required>
							<option value='All Cities'>All Cities</option>
							<option value='Hingurakgoda'>Hingurakgoda</option>
							<option value='Polonnaruwa'>Polonnaruwa</option>
						</select>

						<select name='mathale' id='Cities_Matale' style='width: 120px; height:30px;' required>
							<option value='All Cities'>All Cities</option>
							<option value='Dambulla'>Dambulla</option>
							<option value='Kaikawala'>Kaikawala</option>
							<option value='Matale'>Matale</option>
						</select>

						<select name='kandy' id='Cities_Kandy' style='width: 120px; height:30px;' required>
							<option value='All Cities'>All Cities</option>
							<option value='Akurana'>Akurana</option>
							<option value='Alawatugoda'>Alawatugoda</option>
							<option value='Ambatenna'>Ambatenna</option>
							<option value='Ampitiya'>Ampitiya</option>
							<option value='Aniwatta'>Aniwatta</option>
							<option value='Aruppola'>Aruppola</option>
							<option value='Asgiriya'>Asgiriya</option>
							<option value='Balagolla'>Balagolla</option>
							<option value='Daulagala'>Daulagala</option>
							<option value='Deltota'>Deltota</option>
							<option value='Digana'>Digana</option>
							<option value='Dodanwala'>Dodanwala</option>
							<option value='Galagedara'>Galagedara</option>
							<option value='Gampola'>Gampola</option>
							<option value='Gannoruwa'>Gannoruwa</option>
							<option value='Gelioya'>Gelioya</option>
							<option value='Gomagoda'>Gomagoda</option>
							<option value='Gunnepana'>Gunnepana</option>
							<option value='Handessa'>Handessa</option>
							<option value='Hunnasgiriya'>Hunnasgiriya</option>
							<option value='Kadugannawa'>Kadugannawa</option>
							<option value='Kandy'>Kandy</option>
							<option value='Katugastota'>Katugastota</option>
							<option value='Kengalla'>Kengalla</option>
							<option value='Kiribathkumbura'>Kiribathkumbura</option>
							<option value='Kundasale'>Kundasale</option>
							<option value='Lewella'>Lewella</option>
							<option value='Madawala Bazaar'>Madawala Bazaar</option>
							<option value='Mahaiyawa'>Mahaiyawa</option>
							<option value='Mahakanda'>Mahakanda</option>
							<option value='Mavilmada'>Mavilmada</option>
							<option value='Mulgampola'>Mulgampola</option>
							<option value='Nattarampotha'>Nattarampotha</option>
							<option value='Nawalapitiya'>Nawalapitiya</option>
							<option value='Nugawela'>Nugawela</option>
							<option value='Pallekele'>Pallekele</option>
							<option value='Pallekotuwa'>Pallekotuwa</option>
							<option value='Panideniya'>Panideniya</option>
							<option value='Peradeniya'>Peradeniya</option>
							<option value='Pilimatalawa'>Pilimatalawa</option>
							<option value='Polgolla'>Polgolla</option>
							<option value='Poojapitya'>Poojapitya</option>
							<option value='Talatuoya'>Talatuoya</option>
							<option value='Teldeniya'>Teldeniya</option>
							<option value='Tennekumbura'>Tennekumbura</option>
							<option value='Udahentenna'>Udahentenna</option>
							<option value='Ududumbara'>Ududumbara</option>
							<option value='Watadeniya'>Watadeniya</option>
							<option value='Watapuluwa'>Watapuluwa</option>
							<option value='Wattegama'>Wattegama</option>
						</select>

						<select name='nuwaraeliya' id='Cities_Nuwara_Eliya' style='width: 120px; height:30px;' required>
							<option value='All Cities'>All Cities</option>
							<option value='Bogawantalawa'>Bogawantalawa</option>
							<option value='Ginigathena'>Ginigathena</option>
							<option value='Hatton'>Hatton</option>
							<option value='Kotagala'>Kotagala</option>
							<option value='Kotmale'>Kotmale</option>
							<option value='Nuwara Eliya'>Nuwara Eliya</option>
						</select>

						<select name='kagalle' id='Cities_Kegalle' style='width: 120px; height:30px;' required>
							<option value='All Cities'>All Cities</option>
							<option value='Alawatura'>Alawatura</option>
							<option value='Bulathkohupitiya'>Bulathkohupitiya</option>
							<option value='Dehiowita'>Dehiowita</option>
							<option value='Galapitamada'>Galapitamada</option>
							<option value='Galigamuwa'>Galigamuwa</option>
							<option value='Hemmatagama'>Hemmatagama</option>
							<option value='Hiriwadunna'>Hiriwadunna</option>
							<option value='Kegalle'>Kegalle</option>
							<option value='Mawanella'>Mawanella</option>
							<option value='Rambukkana'>Rambukkana</option>
							<option value='Ruwanwella'>Ruwanwella</option>
							<option value='Warakapola'>Warakapola</option>
							<option value='Yatiyantota'>Yatiyantota</option>
						</select>

						<select name='ranthnapura' id='Cities_Ratnapura' style='width: 120px; height:30px;' required>
							<option value='All Cities'>All Cities</option>
							<option value='Balangoda'>Balangoda</option>
							<option value='Eheliyagoda'>Eheliyagoda</option>
							<option value='Embilipitiya'>Embilipitiya</option>
							<option value='Kahawatta'>Kahawatta</option>
							<option value='Kuruwita'>Kuruwita</option>
							<option value='Nivitigala'>Nivitigala</option>
							<option value='Palmadulla'>Palmadulla</option>
							<option value='Parakaduwa'>Parakaduwa</option>
							<option value='Ratnapura'>Ratnapura</option>
						</select>

						<select name='trincomalee' id='Cities_Trincomalee' style='width: 120px; height:30px;' required>
							<option value='All Cities'>All Cities</option>
							<option value='Trincomalee'>Trincomalee</option>
						</select>

						<select name='batticaloa' id='Cities_Batticaloa' style='width: 120px; height:30px;' required>
							<option value='All Cities'>All Cities</option>
							<option value='Batticaloa'>Batticaloa</option>
							<option value='Eravur'>Eravur</option>
							<option value='Kattankudi'>Kattankudi</option>
							<option value='Oddamavadi'>Oddamavadi</option>
							<option value='Pasikudah'>Pasikudah</option>
							<option value='Valaichenai'>Valaichenai</option>
						</select>

						<select name='ampara' id='Cities_Ampara' style='width: 120px; height:30px;' required>
							<option value='All Cities'>All Cities</option>
							<option value='Addalachchenai'>Addalachchenai</option>
							<option value='Akkaraipaththu'>Akkaraipaththu</option>
							<option value='Alayadivembu'>Alayadivembu</option>
							<option value='Ampara'>Ampara</option>
							<option value='Kalmunai'>Kalmunai</option>
							<option value='Nintavur'>Nintavur</option>
							<option value='Oluvil'>Oluvil</option>
							<option value='Sainthamaruthu'>Sainthamaruthu</option>
							<option value='Samanthurai'>Samanthurai</option>
						</select>

						<select name='badulla' id='Cities_Badulla' style='width: 120px; height:30px;' required>
							<option value='All Cities'>All Cities</option>
							<option value='Badulla'>Badulla</option>
							<option value='Bandarawela'>Bandarawela</option>
							<option value='Diyatalawa'>Diyatalawa</option>
							<option value='Ella'>Ella</option>
							<option value='Gurutalawa'>Gurutalawa</option>
							<option value='Haputale'>Haputale</option>
							<option value='Koslanda'>Koslanda</option>
							<option value='Mahiyanganaya'>Mahiyanganaya</option>
							<option value='Mirahawatta'>Mirahawatta</option>
							<option value='Welimada'>Welimada</option>
						</select>

						<select name='monaragala' id='Cities_Monaragala' style='width: 120px; height:30px;' required>
							<option value='All Cities'>All Cities</option>
							<option value='Bibile'>Bibile</option>
							<option value='Monaragala'>Monaragala</option>
						</select>

						<select name='hambanthota' id='Cities_Hambantota' style='width: 120px; height:30px;' required>
							<option value='All Cities'>All Cities</option>
							<option value='Beliatta'>Beliatta</option>
							<option value='Hambantota'>Hambantota</option>
							<option value='Kirinda'>Kirinda</option>
							<option value='Middeniya'>Middeniya</option>
							<option value='Ranna'>Ranna</option>
							<option value='Sooriyawewa'>Sooriyawewa</option>
							<option value='Tangalla'>Tangalla</option>
							<option value='Tissamaharama'>Tissamaharama</option>
							<option value='Walasmulla'>Walasmulla</option>
							<option value='Weeraketiya'>Weeraketiya</option>
							<option value='Weligatta'>Weligatta</option>
						</select>

						<select name='galle' id='Cities_Galle' style='width: 120px; height:30px;' required>
							<option value='All Cities'>All Cities</option>
							<option value='Ahangama'>Ahangama</option>
							<option value='Ahungalla'>Ahungalla</option>
							<option value='Akmeemana'>Akmeemana</option>
							<option value='Ambalangoda'>Ambalangoda</option>
							<option value='Baddegama'>Baddegama</option>
							<option value='Balapitiya'>Balapitiya</option>
							<option value='Dadalla'>Dadalla</option>
							<option value='Dodanduwa'>Dodanduwa</option>
							<option value='Elpitiya'>Elpitiya</option>
							<option value='Galle'>Galle</option>
							<option value='Gintota'>Gintota</option>
							<option value='Habaraduwa'>Habaraduwa</option>
							<option value='Hapugala'>Hapugala</option>
							<option value='Hikkaduwa'>Hikkaduwa</option>
							<option value='Imaduwa'>Imaduwa</option>
							<option value='Induruwa'>Induruwa</option>
							<option value='Kalegana'>Kalegana</option>
							<option value='Karapitiya'>Karapitiya</option>
							<option value='Mapalagama'>Mapalagama</option>
							<option value='Minuwangoda'>Minuwangoda</option>
							<option value='Pitigala'>Pitigala</option>
							<option value='Thalagaha'>Thalagaha</option>
							<option value='Udugama'>Udugama</option>
							<option value='Unawatuna'>Unawatuna</option>
							<option value='Unenwitiya'>Unenwitiya</option>
							<option value='Wanduramba'>Wanduramba</option>
							<option value='Yakkalamulla'>Yakkalamulla</option>
						</select>




						<script>
							$('#selectSubject').change(function () {
								var seleted_option = $('#selectSubject :selected').val();
					
								if (seleted_option == 'Colombo') {
									$('#Cities_colombo').show();
					
									$('#selected_nothing').hide();
									//$('#Cities_colombo').hide();
									$('#Cities_mathara').hide();
									$('#Cities_gampha').hide();
									$('#Cities_jaffna').hide();
									$('#Cities_kilinochchi').hide();
									$('#Cities_Mannar').hide();
									$('#Cities_Mullaitivu').hide();
									$('#Cities_Vavuniya').hide();
									$('#Cities_Puttalam').hide();
									$('#Cities_Kurunegala').hide();
									$('#Cities_Kalutara').hide();
									$('#Cities_Anuradhapura').hide();
									$('#Cities_Polonnaruwa').hide();
									$('#Cities_Matale').hide();
									$('#Cities_Kandy').hide();
									$('#Cities_Nuwara_Eliya').hide();
									$('#Cities_Kegalle').hide();
									$('#Cities_Ratnapura').hide();
									$('#Cities_Trincomalee').hide();
									$('#Cities_Batticaloa').hide();
									$('#Cities_Ampara').hide();
									$('#Cities_Badulla').hide();
									$('#Cities_Monaragala').hide();
									$('#Cities_Hambantota').hide();
									$('#Cities_Galle').hide();
					
					
								}
					
								else if (seleted_option == 'Mathara') {
									$('#Cities_mathara').show();
					
									$('#selected_nothing').hide();
									$('#Cities_colombo').hide();
									//$('#Cities_mathara').hide();
									$('#Cities_gampha').hide();
									$('#Cities_jaffna').hide();
									$('#Cities_kilinochchi').hide();
									$('#Cities_Mannar').hide();
									$('#Cities_Mullaitivu').hide();
									$('#Cities_Vavuniya').hide();
									$('#Cities_Puttalam').hide();
									$('#Cities_Kurunegala').hide();
									$('#Cities_Kalutara').hide();
									$('#Cities_Anuradhapura').hide();
									$('#Cities_Polonnaruwa').hide();
									$('#Cities_Matale').hide();
									$('#Cities_Kandy').hide();
									$('#Cities_Nuwara_Eliya').hide();
									$('#Cities_Kegalle').hide();
									$('#Cities_Ratnapura').hide();
									$('#Cities_Trincomalee').hide();
									$('#Cities_Batticaloa').hide();
									$('#Cities_Ampara').hide();
									$('#Cities_Badulla').hide();
									$('#Cities_Monaragala').hide();
									$('#Cities_Hambantota').hide();
									$('#Cities_Galle').hide();
					
					
								}
					
					
								else if (seleted_option == 'Gampaha') {
									$('#Cities_gampha').show();
					
									$('#selected_nothing').hide();
									$('#Cities_colombo').hide();
									$('#Cities_mathara').hide();
									
									$('#Cities_jaffna').hide();
									$('#Cities_kilinochchi').hide();
									$('#Cities_Mannar').hide();
									$('#Cities_Mullaitivu').hide();
									$('#Cities_Vavuniya').hide();
									$('#Cities_Puttalam').hide();
									$('#Cities_Kurunegala').hide();
									$('#Cities_Kalutara').hide();
									$('#Cities_Anuradhapura').hide();
									$('#Cities_Polonnaruwa').hide();
									$('#Cities_Matale').hide();
									$('#Cities_Kandy').hide();
									$('#Cities_Nuwara_Eliya').hide();
									$('#Cities_Kegalle').hide();
									$('#Cities_Ratnapura').hide();
									$('#Cities_Trincomalee').hide();
									$('#Cities_Batticaloa').hide();
									$('#Cities_Ampara').hide();
									$('#Cities_Badulla').hide();
									$('#Cities_Monaragala').hide();
									$('#Cities_Hambantota').hide();
									$('#Cities_Galle').hide();
					
								}
					
					
								else if (seleted_option == 'Jaffna') {
									$('#Cities_jaffna').show();
					
									$('#selected_nothing').hide();
									$('#Cities_colombo').hide();
									$('#Cities_mathara').hide();
									$('#Cities_gampha').hide();
									
									$('#Cities_kilinochchi').hide();
									$('#Cities_Mannar').hide();
									$('#Cities_Mullaitivu').hide();
									$('#Cities_Vavuniya').hide();
									$('#Cities_Puttalam').hide();
									$('#Cities_Kurunegala').hide();
									$('#Cities_Kalutara').hide();
									$('#Cities_Anuradhapura').hide();
									$('#Cities_Polonnaruwa').hide();
									$('#Cities_Matale').hide();
									$('#Cities_Kandy').hide();
									$('#Cities_Nuwara_Eliya').hide();
									$('#Cities_Kegalle').hide();
									$('#Cities_Ratnapura').hide();
									$('#Cities_Trincomalee').hide();
									$('#Cities_Batticaloa').hide();
									$('#Cities_Ampara').hide();
									$('#Cities_Badulla').hide();
									$('#Cities_Monaragala').hide();
									$('#Cities_Hambantota').hide();
									$('#Cities_Galle').hide();
								}
					
								else if (seleted_option == 'Kilinochchi') {
									$('#Cities_kilinochchi').show();
					
									$('#selected_nothing').hide();
									$('#Cities_colombo').hide();
									$('#Cities_mathara').hide();
									$('#Cities_gampha').hide();
									$('#Cities_jaffna').hide();
					
									$('#Cities_Mannar').hide();
									$('#Cities_Mullaitivu').hide();
									$('#Cities_Vavuniya').hide();
									$('#Cities_Puttalam').hide();
									$('#Cities_Kurunegala').hide();
									$('#Cities_Kalutara').hide();
									$('#Cities_Anuradhapura').hide();
									$('#Cities_Polonnaruwa').hide();
									$('#Cities_Matale').hide();
									$('#Cities_Kandy').hide();
									$('#Cities_Nuwara_Eliya').hide();
									$('#Cities_Kegalle').hide();
									$('#Cities_Ratnapura').hide();
									$('#Cities_Trincomalee').hide();
									$('#Cities_Batticaloa').hide();
									$('#Cities_Ampara').hide();
									$('#Cities_Badulla').hide();
									$('#Cities_Monaragala').hide();
									$('#Cities_Hambantota').hide();
									$('#Cities_Galle').hide();
					
								}
					
								else if (seleted_option == 'Mannar') {
									$('#Cities_Mannar').show();
					
									$('#selected_nothing').hide();
									$('#Cities_colombo').hide();
									$('#Cities_mathara').hide();
									$('#Cities_gampha').hide();
									$('#Cities_jaffna').hide();
									$('#Cities_kilinochchi').hide();
					
									$('#Cities_Mullaitivu').hide();
									$('#Cities_Vavuniya').hide();
									$('#Cities_Puttalam').hide();
									$('#Cities_Kurunegala').hide();
									$('#Cities_Kalutara').hide();
									$('#Cities_Anuradhapura').hide();
									$('#Cities_Polonnaruwa').hide();
									$('#Cities_Matale').hide();
									$('#Cities_Kandy').hide();
									$('#Cities_Nuwara_Eliya').hide();
									$('#Cities_Kegalle').hide();
									$('#Cities_Ratnapura').hide();
									$('#Cities_Trincomalee').hide();
									$('#Cities_Batticaloa').hide();
									$('#Cities_Ampara').hide();
									$('#Cities_Badulla').hide();
									$('#Cities_Monaragala').hide();
									$('#Cities_Hambantota').hide();
									$('#Cities_Galle').hide();
					
								}
					
								else if (seleted_option == 'Mullaitivu') {
									$('#selected_nothing').hide();
									$('#Cities_colombo').hide();
									$('#Cities_mathara').hide();
									$('#Cities_gampha').hide();
									$('#Cities_jaffna').hide();
									$('#Cities_kilinochchi').hide();
									$('#Cities_Mannar').hide();
									$('#Cities_Mullaitivu').show();
									$('#Cities_Vavuniya').hide();
									$('#Cities_Puttalam').hide();
									$('#Cities_Kurunegala').hide();
									$('#Cities_Kalutara').hide();
									$('#Cities_Anuradhapura').hide();
									$('#Cities_Polonnaruwa').hide();
									$('#Cities_Matale').hide();
									$('#Cities_Kandy').hide();
									$('#Cities_Nuwara_Eliya').hide();
									$('#Cities_Kegalle').hide();
									$('#Cities_Ratnapura').hide();
									$('#Cities_Trincomalee').hide();
									$('#Cities_Batticaloa').hide();
									$('#Cities_Ampara').hide();
									$('#Cities_Badulla').hide();
									$('#Cities_Monaragala').hide();
									$('#Cities_Hambantota').hide();
									$('#Cities_Galle').hide();
					
								}
					
								else if (seleted_option == 'Vavuniya') {
									$('#selected_nothing').hide();
									$('#Cities_colombo').hide();
									$('#Cities_mathara').hide();
									$('#Cities_gampha').hide();
									$('#Cities_jaffna').hide();
									$('#Cities_kilinochchi').hide();
									$('#Cities_Mannar').hide();
									$('#Cities_Mullaitivu').hide();
									$('#Cities_Vavuniya').show();
									$('#Cities_Puttalam').hide();
									$('#Cities_Kurunegala').hide();
									$('#Cities_Kalutara').hide();
									$('#Cities_Anuradhapura').hide();
									$('#Cities_Polonnaruwa').hide();
									$('#Cities_Matale').hide();
									$('#Cities_Kandy').hide();
									$('#Cities_Nuwara_Eliya').hide();
									$('#Cities_Kegalle').hide();
									$('#Cities_Ratnapura').hide();
									$('#Cities_Trincomalee').hide();
									$('#Cities_Batticaloa').hide();
									$('#Cities_Ampara').hide();
									$('#Cities_Badulla').hide();
									$('#Cities_Monaragala').hide();
									$('#Cities_Hambantota').hide();
									$('#Cities_Galle').hide();
					
								}
					
								else if (seleted_option == 'Puttalam') {
									$('#selected_nothing').hide();
									$('#Cities_colombo').hide();
									$('#Cities_mathara').hide();
									$('#Cities_gampha').hide();
									$('#Cities_jaffna').hide();
									$('#Cities_kilinochchi').hide();
									$('#Cities_Mannar').hide();
									$('#Cities_Mullaitivu').hide();
									$('#Cities_Vavuniya').hide();
									$('#Cities_Puttalam').show();
									$('#Cities_Kurunegala').hide();
									$('#Cities_Kalutara').hide();
									$('#Cities_Anuradhapura').hide();
									$('#Cities_Polonnaruwa').hide();
									$('#Cities_Matale').hide();
									$('#Cities_Kandy').hide();
									$('#Cities_Nuwara_Eliya').hide();
									$('#Cities_Kegalle').hide();
									$('#Cities_Ratnapura').hide();
									$('#Cities_Trincomalee').hide();
									$('#Cities_Batticaloa').hide();
									$('#Cities_Ampara').hide();
									$('#Cities_Badulla').hide();
									$('#Cities_Monaragala').hide();
									$('#Cities_Hambantota').hide();
									$('#Cities_Galle').hide();
								}
					
								else if (seleted_option == 'Kurunegala') {
									$('#selected_nothing').hide();
									$('#Cities_colombo').hide();
									$('#Cities_mathara').hide();
									$('#Cities_gampha').hide();
									$('#Cities_jaffna').hide();
									$('#Cities_kilinochchi').hide();
									$('#Cities_Mannar').hide();
									$('#Cities_Mullaitivu').hide();
									$('#Cities_Vavuniya').hide();
									$('#Cities_Puttalam').hide();
									$('#Cities_Kurunegala').show();
									$('#Cities_Kalutara').hide();
									$('#Cities_Anuradhapura').hide();
									$('#Cities_Polonnaruwa').hide();
									$('#Cities_Matale').hide();
									$('#Cities_Kandy').hide();
									$('#Cities_Nuwara_Eliya').hide();
									$('#Cities_Kegalle').hide();
									$('#Cities_Ratnapura').hide();
									$('#Cities_Trincomalee').hide();
									$('#Cities_Batticaloa').hide();
									$('#Cities_Ampara').hide();
									$('#Cities_Badulla').hide();
									$('#Cities_Monaragala').hide();
									$('#Cities_Hambantota').hide();
									$('#Cities_Galle').hide();
								}
					
					
								else if (seleted_option == 'Kalutara') {
									$('#selected_nothing').hide();
									$('#Cities_colombo').hide();
									$('#Cities_mathara').hide();
									$('#Cities_gampha').hide();
									$('#Cities_jaffna').hide();
									$('#Cities_kilinochchi').hide();
									$('#Cities_Mannar').hide();
									$('#Cities_Mullaitivu').hide();
									$('#Cities_Vavuniya').hide();
									$('#Cities_Puttalam').hide();
									$('#Cities_Kurunegala').hide();
									$('#Cities_Kalutara').show();
									$('#Cities_Anuradhapura').hide();
									$('#Cities_Polonnaruwa').hide();
									$('#Cities_Matale').hide();
									$('#Cities_Kandy').hide();
									$('#Cities_Nuwara_Eliya').hide();
									$('#Cities_Kegalle').hide();
									$('#Cities_Ratnapura').hide();
									$('#Cities_Trincomalee').hide();
									$('#Cities_Batticaloa').hide();
									$('#Cities_Ampara').hide();
									$('#Cities_Badulla').hide();
									$('#Cities_Monaragala').hide();
									$('#Cities_Hambantota').hide();
									$('#Cities_Galle').hide();
								}
					
					
								else if (seleted_option == 'Anuradhapura') {
									$('#selected_nothing').hide();
									$('#Cities_colombo').hide();
									$('#Cities_mathara').hide();
									$('#Cities_gampha').hide();
									$('#Cities_jaffna').hide();
									$('#Cities_kilinochchi').hide();
									$('#Cities_Mannar').hide();
									$('#Cities_Mullaitivu').hide();
									$('#Cities_Vavuniya').hide();
									$('#Cities_Puttalam').hide();
									$('#Cities_Kurunegala').hide();
									$('#Cities_Kalutara').hide();
									$('#Cities_Anuradhapura').show();
									$('#Cities_Polonnaruwa').hide();
									$('#Cities_Matale').hide();
									$('#Cities_Kandy').hide();
									$('#Cities_Nuwara_Eliya').hide();
									$('#Cities_Kegalle').hide();
									$('#Cities_Ratnapura').hide();
									$('#Cities_Trincomalee').hide();
									$('#Cities_Batticaloa').hide();
									$('#Cities_Ampara').hide();
									$('#Cities_Badulla').hide();
									$('#Cities_Monaragala').hide();
									$('#Cities_Hambantota').hide();
									$('#Cities_Galle').hide();
								}
					
					
								else if (seleted_option == 'Polonnaruwa') {
									$('#selected_nothing').hide();
									$('#Cities_colombo').hide();
									$('#Cities_mathara').hide();
									$('#Cities_gampha').hide();
									$('#Cities_jaffna').hide();
									$('#Cities_kilinochchi').hide();
									$('#Cities_Mannar').hide();
									$('#Cities_Mullaitivu').hide();
									$('#Cities_Vavuniya').hide();
									$('#Cities_Puttalam').hide();
									$('#Cities_Kurunegala').hide();
									$('#Cities_Kalutara').hide();
									$('#Cities_Anuradhapura').hide();
									$('#Cities_Polonnaruwa').show();
									$('#Cities_Matale').hide();
									$('#Cities_Kandy').hide();
									$('#Cities_Nuwara_Eliya').hide();
									$('#Cities_Kegalle').hide();
									$('#Cities_Ratnapura').hide();
									$('#Cities_Trincomalee').hide();
									$('#Cities_Batticaloa').hide();
									$('#Cities_Ampara').hide();
									$('#Cities_Badulla').hide();
									$('#Cities_Monaragala').hide();
									$('#Cities_Hambantota').hide();
									$('#Cities_Galle').hide();
								}
					
					
								else if (seleted_option == 'Matale') {
									$('#selected_nothing').hide();
									$('#Cities_colombo').hide();
									$('#Cities_mathara').hide();
									$('#Cities_gampha').hide();
									$('#Cities_jaffna').hide();
									$('#Cities_kilinochchi').hide();
									$('#Cities_Mannar').hide();
									$('#Cities_Mullaitivu').hide();
									$('#Cities_Vavuniya').hide();
									$('#Cities_Puttalam').hide();
									$('#Cities_Kurunegala').hide();
									$('#Cities_Kalutara').hide();
									$('#Cities_Anuradhapura').hide();
									$('#Cities_Polonnaruwa').hide();
									$('#Cities_Matale').show();
									$('#Cities_Kandy').hide();
									$('#Cities_Nuwara_Eliya').hide();
									$('#Cities_Kegalle').hide();
									$('#Cities_Ratnapura').hide();
									$('#Cities_Trincomalee').hide();
									$('#Cities_Batticaloa').hide();
									$('#Cities_Ampara').hide();
									$('#Cities_Badulla').hide();
									$('#Cities_Monaragala').hide();
									$('#Cities_Hambantota').hide();
									$('#Cities_Galle').hide();
								}
					
					
								else if (seleted_option == 'Kandy') {
									$('#selected_nothing').hide();
									$('#Cities_colombo').hide();
									$('#Cities_mathara').hide();
									$('#Cities_gampha').hide();
									$('#Cities_jaffna').hide();
									$('#Cities_kilinochchi').hide();
									$('#Cities_Mannar').hide();
									$('#Cities_Mullaitivu').hide();
									$('#Cities_Vavuniya').hide();
									$('#Cities_Puttalam').hide();
									$('#Cities_Kurunegala').hide();
									$('#Cities_Kalutara').hide();
									$('#Cities_Anuradhapura').hide();
									$('#Cities_Polonnaruwa').hide();
									$('#Cities_Matale').hide();
									$('#Cities_Kandy').show();
									$('#Cities_Nuwara_Eliya').hide();
									$('#Cities_Kegalle').hide();
									$('#Cities_Ratnapura').hide();
									$('#Cities_Trincomalee').hide();
									$('#Cities_Batticaloa').hide();
									$('#Cities_Ampara').hide();
									$('#Cities_Badulla').hide();
									$('#Cities_Monaragala').hide();
									$('#Cities_Hambantota').hide();
									$('#Cities_Galle').hide();
								}
					
					
								else if (seleted_option == 'Nuwara Eliya') {
									$('#selected_nothing').hide();
									$('#Cities_colombo').hide();
									$('#Cities_mathara').hide();
									$('#Cities_gampha').hide();
									$('#Cities_jaffna').hide();
									$('#Cities_kilinochchi').hide();
									$('#Cities_Mannar').hide();
									$('#Cities_Mullaitivu').hide();
									$('#Cities_Vavuniya').hide();
									$('#Cities_Puttalam').hide();
									$('#Cities_Kurunegala').hide();
									$('#Cities_Kalutara').hide();
									$('#Cities_Anuradhapura').hide();
									$('#Cities_Polonnaruwa').hide();
									$('#Cities_Matale').hide();
									$('#Cities_Kandy').hide();
									$('#Cities_Nuwara_Eliya').show();
									$('#Cities_Kegalle').hide();
									$('#Cities_Ratnapura').hide();
									$('#Cities_Trincomalee').hide();
									$('#Cities_Batticaloa').hide();
									$('#Cities_Ampara').hide();
									$('#Cities_Badulla').hide();
									$('#Cities_Monaragala').hide();
									$('#Cities_Hambantota').hide();
									$('#Cities_Galle').hide();
								}
					
					
								else if (seleted_option == 'Kegalle') {
									$('#selected_nothing').hide();
									$('#Cities_colombo').hide();
									$('#Cities_mathara').hide();
									$('#Cities_gampha').hide();
									$('#Cities_jaffna').hide();
									$('#Cities_kilinochchi').hide();
									$('#Cities_Mannar').hide();
									$('#Cities_Mullaitivu').hide();
									$('#Cities_Vavuniya').hide();
									$('#Cities_Puttalam').hide();
									$('#Cities_Kurunegala').hide();
									$('#Cities_Kalutara').hide();
									$('#Cities_Anuradhapura').hide();
									$('#Cities_Polonnaruwa').hide();
									$('#Cities_Matale').hide();
									$('#Cities_Kandy').hide();
									$('#Cities_Nuwara_Eliya').hide();
									$('#Cities_Kegalle').show();
									$('#Cities_Ratnapura').hide();
									$('#Cities_Trincomalee').hide();
									$('#Cities_Batticaloa').hide();
									$('#Cities_Ampara').hide();
									$('#Cities_Badulla').hide();
									$('#Cities_Monaragala').hide();
									$('#Cities_Hambantota').hide();
									$('#Cities_Galle').hide();
								}
					
					
								else if (seleted_option == 'Ratnapura') {
									$('#selected_nothing').hide();
									$('#Cities_colombo').hide();
									$('#Cities_mathara').hide();
									$('#Cities_gampha').hide();
									$('#Cities_jaffna').hide();
									$('#Cities_kilinochchi').hide();
									$('#Cities_Mannar').hide();
									$('#Cities_Mullaitivu').hide();
									$('#Cities_Vavuniya').hide();
									$('#Cities_Puttalam').hide();
									$('#Cities_Kurunegala').hide();
									$('#Cities_Kalutara').hide();
									$('#Cities_Anuradhapura').hide();
									$('#Cities_Polonnaruwa').hide();
									$('#Cities_Matale').hide();
									$('#Cities_Kandy').hide();
									$('#Cities_Nuwara_Eliya').hide();
									$('#Cities_Kegalle').hide();
									$('#Cities_Ratnapura').show();
									$('#Cities_Trincomalee').hide();
									$('#Cities_Batticaloa').hide();
									$('#Cities_Ampara').hide();
									$('#Cities_Badulla').hide();
									$('#Cities_Monaragala').hide();
									$('#Cities_Hambantota').hide();
									$('#Cities_Galle').hide();
								}
					
					
								else if (seleted_option == 'Trincomalee') {
									$('#selected_nothing').hide();
									$('#Cities_colombo').hide();
									$('#Cities_mathara').hide();
									$('#Cities_gampha').hide();
									$('#Cities_jaffna').hide();
									$('#Cities_kilinochchi').hide();
									$('#Cities_Mannar').hide();
									$('#Cities_Mullaitivu').hide();
									$('#Cities_Vavuniya').hide();
									$('#Cities_Puttalam').hide();
									$('#Cities_Kurunegala').hide();
									$('#Cities_Kalutara').hide();
									$('#Cities_Anuradhapura').hide();
									$('#Cities_Polonnaruwa').hide();
									$('#Cities_Matale').hide();
									$('#Cities_Kandy').hide();
									$('#Cities_Nuwara_Eliya').hide();
									$('#Cities_Kegalle').hide();
									$('#Cities_Ratnapura').hide();
									$('#Cities_Trincomalee').show();
									$('#Cities_Batticaloa').hide();
									$('#Cities_Ampara').hide();
									$('#Cities_Badulla').hide();
									$('#Cities_Monaragala').hide();
									$('#Cities_Hambantota').hide();
									$('#Cities_Galle').hide();
								}
					
					
								else if (seleted_option == 'Batticaloa') {
									$('#selected_nothing').hide();
									$('#Cities_colombo').hide();
									$('#Cities_mathara').hide();
									$('#Cities_gampha').hide();
									$('#Cities_jaffna').hide();
									$('#Cities_kilinochchi').hide();
									$('#Cities_Mannar').hide();
									$('#Cities_Mullaitivu').hide();
									$('#Cities_Vavuniya').hide();
									$('#Cities_Puttalam').hide();
									$('#Cities_Kurunegala').hide();
									$('#Cities_Kalutara').hide();
									$('#Cities_Anuradhapura').hide();
									$('#Cities_Polonnaruwa').hide();
									$('#Cities_Matale').hide();
									$('#Cities_Kandy').hide();
									$('#Cities_Nuwara_Eliya').hide();
									$('#Cities_Kegalle').hide();
									$('#Cities_Ratnapura').hide();
									$('#Cities_Trincomalee').hide();
									$('#Cities_Batticaloa').show();
									$('#Cities_Ampara').hide();
									$('#Cities_Badulla').hide();
									$('#Cities_Monaragala').hide();
									$('#Cities_Hambantota').hide();
									$('#Cities_Galle').hide();
								}
					
					
								else if (seleted_option == 'Ampara') {
									$('#selected_nothing').hide();
									$('#Cities_colombo').hide();
									$('#Cities_mathara').hide();
									$('#Cities_gampha').hide();
									$('#Cities_jaffna').hide();
									$('#Cities_kilinochchi').hide();
									$('#Cities_Mannar').hide();
									$('#Cities_Mullaitivu').hide();
									$('#Cities_Vavuniya').hide();
									$('#Cities_Puttalam').hide();
									$('#Cities_Kurunegala').hide();
									$('#Cities_Kalutara').hide();
									$('#Cities_Anuradhapura').hide();
									$('#Cities_Polonnaruwa').hide();
									$('#Cities_Matale').hide();
									$('#Cities_Kandy').hide();
									$('#Cities_Nuwara_Eliya').hide();
									$('#Cities_Kegalle').hide();
									$('#Cities_Ratnapura').hide();
									$('#Cities_Trincomalee').hide();
									$('#Cities_Batticaloa').hide();
									$('#Cities_Ampara').show();
									$('#Cities_Badulla').hide();
									$('#Cities_Monaragala').hide();
									$('#Cities_Hambantota').hide();
									$('#Cities_Galle').hide();
								}
					
					
								else if (seleted_option == 'Badulla') {
									$('#selected_nothing').hide();
									$('#Cities_colombo').hide();
									$('#Cities_mathara').hide();
									$('#Cities_gampha').hide();
									$('#Cities_jaffna').hide();
									$('#Cities_kilinochchi').hide();
									$('#Cities_Mannar').hide();
									$('#Cities_Mullaitivu').hide();
									$('#Cities_Vavuniya').hide();
									$('#Cities_Puttalam').hide();
									$('#Cities_Kurunegala').hide();
									$('#Cities_Kalutara').hide();
									$('#Cities_Anuradhapura').hide();
									$('#Cities_Polonnaruwa').hide();
									$('#Cities_Matale').hide();
									$('#Cities_Kandy').hide();
									$('#Cities_Nuwara_Eliya').hide();
									$('#Cities_Kegalle').hide();
									$('#Cities_Ratnapura').hide();
									$('#Cities_Trincomalee').hide();
									$('#Cities_Batticaloa').hide();
									$('#Cities_Ampara').hide();
									$('#Cities_Badulla').show();
									$('#Cities_Monaragala').hide();
									$('#Cities_Hambantota').hide();
									$('#Cities_Galle').hide();
								}
					
					
								else if (seleted_option == 'Monaragala') {
									$('#selected_nothing').hide();
									$('#Cities_colombo').hide();
									$('#Cities_mathara').hide();
									$('#Cities_gampha').hide();
									$('#Cities_jaffna').hide();
									$('#Cities_kilinochchi').hide();
									$('#Cities_Mannar').hide();
									$('#Cities_Mullaitivu').hide();
									$('#Cities_Vavuniya').hide();
									$('#Cities_Puttalam').hide();
									$('#Cities_Kurunegala').hide();
									$('#Cities_Kalutara').hide();
									$('#Cities_Anuradhapura').hide();
									$('#Cities_Polonnaruwa').hide();
									$('#Cities_Matale').hide();
									$('#Cities_Kandy').hide();
									$('#Cities_Nuwara_Eliya').hide();
									$('#Cities_Kegalle').hide();
									$('#Cities_Ratnapura').hide();
									$('#Cities_Trincomalee').hide();
									$('#Cities_Batticaloa').hide();
									$('#Cities_Ampara').hide();
									$('#Cities_Badulla').hide();
									$('#Cities_Monaragala').show();
									$('#Cities_Hambantota').hide();
									$('#Cities_Galle').hide();
								}
					
					
								else if (seleted_option == 'Hambantota') {
									$('#selected_nothing').hide();
									$('#Cities_colombo').hide();
									$('#Cities_mathara').hide();
									$('#Cities_gampha').hide();
									$('#Cities_jaffna').hide();
									$('#Cities_kilinochchi').hide();
									$('#Cities_Mannar').hide();
									$('#Cities_Mullaitivu').hide();
									$('#Cities_Vavuniya').hide();
									$('#Cities_Puttalam').hide();
									$('#Cities_Kurunegala').hide();
									$('#Cities_Kalutara').hide();
									$('#Cities_Anuradhapura').hide();
									$('#Cities_Polonnaruwa').hide();
									$('#Cities_Matale').hide();
									$('#Cities_Kandy').hide();
									$('#Cities_Nuwara_Eliya').hide();
									$('#Cities_Kegalle').hide();
									$('#Cities_Ratnapura').hide();
									$('#Cities_Trincomalee').hide();
									$('#Cities_Batticaloa').hide();
									$('#Cities_Ampara').hide();
									$('#Cities_Badulla').hide();
									$('#Cities_Monaragala').hide();
									$('#Cities_Hambantota').show();
									$('#Cities_Galle').hide();
								}
					
					
								else if (seleted_option == 'Galle') {
									$('#selected_nothing').hide();
									$('#Cities_colombo').hide();
									$('#Cities_mathara').hide();
									$('#Cities_gampha').hide();
									$('#Cities_jaffna').hide();
									$('#Cities_kilinochchi').hide();
									$('#Cities_Mannar').hide();
									$('#Cities_Mullaitivu').hide();
									$('#Cities_Vavuniya').hide();
									$('#Cities_Puttalam').hide();
									$('#Cities_Kurunegala').hide();
									$('#Cities_Kalutara').hide();
									$('#Cities_Anuradhapura').hide();
									$('#Cities_Polonnaruwa').hide();
									$('#Cities_Matale').hide();
									$('#Cities_Kandy').hide();
									$('#Cities_Nuwara_Eliya').hide();
									$('#Cities_Kegalle').hide();
									$('#Cities_Ratnapura').hide();
									$('#Cities_Trincomalee').hide();
									$('#Cities_Batticaloa').hide();
									$('#Cities_Ampara').hide();
									$('#Cities_Badulla').hide();
									$('#Cities_Monaragala').hide();
									$('#Cities_Hambantota').hide();
									$('#Cities_Galle').show();
								}
					
								else if(seleted_option == 'Whole Country'){
					
									$('#selected_nothing').show();
									$('#Cities_colombo').hide();
									$('#Cities_mathara').hide();
									$('#Cities_gampha').hide();
									$('#Cities_jaffna').hide();
									$('#Cities_kilinochchi').hide();
									$('#Cities_Mannar').hide();
									$('#Cities_Mullaitivu').hide();
									$('#Cities_Vavuniya').hide();
									$('#Cities_Puttalam').hide();
									$('#Cities_Kurunegala').hide();
									$('#Cities_Kalutara').hide();
									$('#Cities_Anuradhapura').hide();
									$('#Cities_Polonnaruwa').hide();
									$('#Cities_Matale').hide();
									$('#Cities_Kandy').hide();
									$('#Cities_Nuwara_Eliya').hide();
									$('#Cities_Kegalle').hide();
									$('#Cities_Ratnapura').hide();
									$('#Cities_Trincomalee').hide();
									$('#Cities_Batticaloa').hide();
									$('#Cities_Ampara').hide();
									$('#Cities_Badulla').hide();
									$('#Cities_Monaragala').hide();
									$('#Cities_Hambantota').hide();
									$('#Cities_Galle').hide();
								}
					
							});
					
						</script>
						
						
						<h4>Name the Institute</h4>
						<input type='text' maxlength='255' size='3' name='Institute' placeholder='Rotary - Nugegoda' list='institutes_list'>





						<script>  

						$(document).ready(function() {

						// Save all selects' id in an array 
						// to determine which select's option and value would be changed
						// after you select an option in another select.
						var selectors = ['selectLevel', 'selectSubject', 'selectTopic']

						$('#selectLevel').on('change', function() {
							var index = selectors.indexOf(this.id)
							var value = this.value

						// check if is the last one or not
						if (index < selectors.length - 1) {
						var next = $('#' + selectors[index + 1])

						// Show all the options in next select
						$(next).find('option').show()
						if (value != '') {
							// if this select's value is not empty
							// hide some of the options 
							$(next).find('option[data-value!=' + value + ']').hide()
						}
						
						// set next select's value to be the first option's value 
						// and trigger change()
						$(next).val($(next).find('option:first').val()).change()
						}
						})
						});


						</script>

						
					</td>
					<td>
						<!-- <select name='selectSubject' id='selectSubject' data-toggle='dropdown' style='width: 90px; height:30px;'>
						<option value='Sinhala'>Sinhala</option>
						<option value='English'>English</option>
						<option value='Tamil'>Tamil</option>
						</select> -->

						
						
						
						
						

						<table>
						<tr><td><input type='checkbox' name='language[]' value='Sinhala'></td></tr><td>Sinhala</td></tr>
						<tr><td>&nbsp;</td></tr>
						<tr><td><input type='checkbox' name='language[]' value='English'></tr></td><td>English</td></tr>
						<tr><td>&nbsp;</td></tr>
						<tr><td><input type='checkbox' name='language[]' value='Tamil'></tr></td><td>Tamil</td></tr>
						</table>
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

						
					</td>

					<td>
						<select name='class_type_with_more_info' id='selectSubject' data-toggle='dropdown' style='width: 90px; height:30px;'>
						<option value='Small Class (Mass Class)'>Small Class (Mass Class)</option>
						<option value='Medium Class (Group Class)'>Medium Class (Group Class)</option>
						<option value='Home Visit'>Home Visit</option>
						<option value='Individual'>Individual</option>
						</select>
					</td>

				
					</tr>
					<!-- <tr>
						<td>2</td>
						<td>Jacob</td>
						<td>Thornton</td>
						<td>@fat</td>
					</tr>
					<tr>
						<td>3</td>
						<td>Larry</td>
						<td>the Bird</td>
						<td>@twitter</td>
					</tr> -->
					</tbody>
				</table>
				</div>
				
				
				<br/><br/>
				<button class='btn btn-success btn-label align-items-end' name='Add_Subject'><i class='ti ti-check'></i> Add Subject / Class</button>&nbsp;&nbsp<font id='chk_option_error' style='visibility:hidden; color:red;'>Please select the Medium you are teaching!</font>
			
			</div>
			
			</div>

			
		</form>
		</div>
						
		</div>";
	
		}
?>




	</div> <!-- .container-fluid -->
	</div> <!-- #page-content -->
	</div>
	<footer role='contentinfo'>
<div class='clearfix'>
<ul class='list-unstyled list-inline pull-left'>
<li><h6 style='margin: 0;'></h6></li>
</ul>
<button class='pull-right btn btn-link btn-xs hidden-print' id='back-to-top'><i class='ti ti-arrow-up'></i></button>
</div>
</footer>

</div>

<!-- Showing institues without repeating starts here -->
	<datalist id="institutes_list">
		<?php
			$all_institutes = array();
			for ($d=1; $d <= $count_of_subject_columns; $d++) { //If you incrise the size of database. Please update this

				$sql6 = "SELECT INSTITUTE__$d, GRADE__$d FROM time_table_of_teachers;";
				
				$resalt6 = mysqli_query($conn, $sql6);                   //get the resalt between $conn and, run $sql 
				$resaltcheck6 = mysqli_num_rows($resalt6);
				$datas6 = array();
				
				if ($resaltcheck6 > 0) {
				while ($row6 = mysqli_fetch_assoc($resalt6)) {
					$datas6[] = $row6;
				}
				
				for ($c=0; $c < count($datas6); $c++) { 
					if(($datas6[$c]["INSTITUTE__$d"]) != NULL){
						array_push($all_institutes,$datas6[$c]["INSTITUTE__$d"]);
					
					
					}         
				}
				
				}
			}

			$items_thread = array_unique($all_institutes,SORT_STRING);
			$all_institutes_without_repeating = array_values($items_thread);


			for ($e=0; $e < count($all_institutes_without_repeating); $e++) { 
				echo "<option value='$all_institutes_without_repeating[$e]'>$all_institutes_without_repeating[$e]</option>";
			}
			

		?>


	</datalist>
<!-- Showing institues without repeating ends here -->


<?php
	
	
	if(isset($_POST['Add_Subject'])){
		$grade = $_POST['grades'];
		$subject = $_POST['Subject'];
		$batch = $_POST['Batch'];
		$class_conducting_date = $_POST['class_conducting_date'];
		$begin_time = $_POST['Begin_time'];
		$end_time = $_POST['end_time'];
		$how_do_you_do_class = $_POST['how_do_you_do_class'];
		$district = $_POST['district'];
		$institute = $_POST['Institute'];
		$languages = $_POST['language'];
		$class_type_with_more_info =  $_POST['class_type_with_more_info'];
		
		$colombo = $_POST['colombo'];
		$mathara = $_POST['mathara'];
		$gampaha = $_POST['gampaha'];
		$jaffna = $_POST['jaffna'];
		$kilinochchi = $_POST['kilinochchi'];
		$mannar = $_POST['mannar'];
		$mullativu = $_POST['mullativu'];
		$vavuniya = $_POST['vavuniya'];
		$puttalam = $_POST['puttalam'];
		$kurunegala = $_POST['kurunegala'];
		$kaluthara = $_POST['kaluthara'];
		$anuradhapura = $_POST['anuradhapura'];
		$polonnaruwa = $_POST['polonnaruwa'];
		$mathale = $_POST['mathale'];
		$kandy = $_POST['kandy'];
		$nuwaraeliya = $_POST['nuwaraeliya'];
		$kagalle = $_POST['kagalle'];
		$ranthnapura = $_POST['ranthnapura'];
		$trincomalee = $_POST['trincomalee'];
		$batticaloa = $_POST['batticaloa'];
		$ampara = $_POST['ampara'];
		$badulla = $_POST['badulla'];
		$monaragala = $_POST['monaragala'];
		$hambanthota = $_POST['hambanthota'];
		$galle = $_POST['galle'];
		
		//echo "<h1>".$colombo;
		//echo "<h1>".$mathara;
		//echo "<h1>".$gampaha;

		$city = array();

		array_push($city,$colombo,$mathara,$gampaha,$jaffna,$kilinochchi,$mannar,$mullativu,
					$vavuniya,$puttalam,$kurunegala,$kaluthara,$anuradhapura,
					$polonnaruwa,$mathale,$kandy,$nuwaraeliya,$kagalle,$ranthnapura,
					$trincomalee,$batticaloa,$ampara,$badulla,$monaragala,$hambanthota,$galle);

		$city = array_diff($city,['1000117','All Cities']);
		
		$key = 0;
		while($element = current($city)) {
			$key = key($city);
			next($city);
			
		}
		
		echo "<h2>".$city[$key];

		
		
		
		//if user didn't checked the all values an error will occer, because of that, making, hasn't choosed values empty
		if (array_key_exists('Sinhala',$languages) == 0){
			array_push($languages,'');
		}
		
		if (array_key_exists('English',$languages) == 0){
			array_push($languages,'');
		}
		
		if (array_key_exists('Tamil',$languages) == 0){
			array_push($languages,'');
		}


		
		//in here we checks, User choosed something in checkboxs
		// $error = error_get_last(); //getting currnt error to variable
		
		// print_r($languages);
		// if (array_key_exists("message",$error)){
		// 	if($error["message"]=='array_push() expects parameter 1 to be array, null given'){
		// 			echo 'Please select the medium you are teaching.!';
		// 	}
		// }





		//Clearing Unnecessary data first
		if($subjects_on_database == 0 || $subjects_on_database < 0){
			$sql6 = "DELETE FROM time_table_of_teachers WHERE T_ID = (SELECT T_ID FROM teachers WHERE EMAIL = '$email_from_cookie' and PASSWORD = '$password_from_cookie');";

			$resultInsert6 = mysqli_query($conn, $sql6) ;

			if($resultInsert6 === TRUE){
				//If something went error uncomment this and see the error   
				//echo"<script>alert('Data Insert');</script>";
			}
			else{
				echo "Error : ". $sql6 . "<br>" . $conn -> error;
					}
		}
		
		
			
	
		
		
		if($subjects_on_database == 0){ //INSERT INTO only works with new records
			$sql2 = "INSERT INTO time_table_of_teachers (T_ID, GRADE__$subjects_on_database_sync, SUBJECT__$subjects_on_database_sync, BATCH__$subjects_on_database_sync, CLASS_DATE__$subjects_on_database_sync, CLASS_BEGIN__$subjects_on_database_sync, CLASS_END__$subjects_on_database_sync, HOW_CLASS_DO__$subjects_on_database_sync, DISTRICT__$subjects_on_database_sync, CITY__$subjects_on_database_sync , INSTITUTE__$subjects_on_database_sync, LANGUAGES__$subjects_on_database_sync, CLASS_TYPE__$subjects_on_database_sync) 
						VALUES((SELECT T_ID FROM teachers WHERE EMAIL = '$email_from_cookie' AND PASSWORD = '$password_from_cookie'), '$grade', '$subject', '$batch', '$class_conducting_date', '$begin_time', '$end_time', '$how_do_you_do_class', '$district', '$city[$key]' ,'$institute', '$languages[0] / $languages[1] / $languages[2]', '$class_type_with_more_info');";
		
		
	
		}elseif($subjects_on_database >= 1){

			//Now, we need to choose which fields are empty, Because maybe user deleted some subjects, If that happens, fileds will be empty randomly
			$sql = "SELECT *
					FROM time_table_of_teachers
					WHERE T_ID = (SELECT T_ID FROM teachers WHERE EMAIL='$email_from_cookie' and PASSWORD='$password_from_cookie');";

                             
			$resalt = mysqli_query($conn,$sql);					         //get the resalt between $conn and, run $sql	
			$resaltcheck = mysqli_num_rows($resalt);
			$datas = array();

			if ($resaltcheck > 0) {
				while ($row = mysqli_fetch_assoc($resalt)){
						$datas[] = $row;  
			
						
			
				$min_column_array = array(); //this array used below, btw this array is for find the minium value of column number, you'll see it!
				for ($i=1; $i <= $amount_subjects; $i++) { 
						$GRADE = $datas[0]["GRADE__$i"]; //Select GRADE column from datas
						

						if($GRADE === null){ //Checks if it is null
							array_push($min_column_array,$i); //Add that column number to array
						}
					}

					$minimum_empty_columns_value = min($min_column_array); //find min value of array

					$sql2 = "    UPDATE time_table_of_teachers 
								SET GRADE__$minimum_empty_columns_value = '$grade', SUBJECT__$minimum_empty_columns_value = '$subject', BATCH__$minimum_empty_columns_value = '$batch', CLASS_DATE__$minimum_empty_columns_value = '$class_conducting_date', CLASS_BEGIN__$minimum_empty_columns_value = '$begin_time', CLASS_END__$minimum_empty_columns_value = '$end_time', HOW_CLASS_DO__$minimum_empty_columns_value = '$how_do_you_do_class', DISTRICT__$minimum_empty_columns_value = '$district', CITY__$minimum_empty_columns_value = '$city[$key]' , INSTITUTE__$minimum_empty_columns_value = '$institute', LANGUAGES__$minimum_empty_columns_value = '$languages[0] / $languages[1] / $languages[2]', CLASS_TYPE__$minimum_empty_columns_value = '$class_type_with_more_info'
								WHERE T_ID = (SELECT T_ID FROM teachers WHERE EMAIL = '$email_from_cookie' and PASSWORD = '$password_from_cookie');";


			} 
		}
	}


		$resultInsert2 = mysqli_query($conn, $sql2) ;
		if($resultInsert2 === TRUE){
			//If something went error uncomment this and see the error   
				//echo"<script>alert('Time Table Updated');</script>";
				//echo "<script>window.location.replace('extras-profile.php?');</script>";

				$sql3 = "UPDATE teachers SET SUBJECTS_ON_DATABASE = $subjects_on_database_sync WHERE EMAIL='$email_from_cookie' AND PASSWORD='$password_from_cookie';";
				$resultInsert3 = mysqli_query($conn, $sql3) ;
				if($resultInsert3 === TRUE){
				 
					echo"<script>alert('Time Table Updated');</script>";
					echo "<script>window.location.replace('tables-editable.php?');</script>";
				}
				else{
					echo "Error : ". $sql3 . "<br>" . $conn -> error;
					echo"<script>alert('$conn -> error');</script>";
						}
			}
			
			
			
			else{
				echo "Error : ". $sql2 . "<br>" . $conn -> error;
				echo"<script>alert('$conn -> error');</script>";
				}






	
	}

?>
</div>
</div>

    
    <!-- Switcher -->
    <div class="demo-options">
        
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
    

    <!-- End loading page level scripts-->






    </body>
</html>






