<?php
ob_start(); // Initiate the output buffer
?>


<?php

if (isset($_COOKIE['EmailFromLogin']) && isset($_COOKIE['PasswordFromLogin'])) {
  $student_email_from_cookie = $_COOKIE["EmailFromLogin"];
  $student_password_from_cookie = $_COOKIE['PasswordFromLogin'];
}else{
  echo "<script>window.location.replace('../Register and login as a student/login.php?')</script>";
}



$server_db = file_get_contents("../database details/server.txt", "r") or die("Unable to open file!");
$username_db = file_get_contents("../database details/username.txt", "r") or die("Unable to open file!");
$password_db = file_get_contents("../database details/password.txt", "r") or die("Unable to open file!");
$database_name_db = file_get_contents("../database details/dbname.txt", "r") or die("Unable to open file!");



//Connect the Database'
//Change to the server database
//$conn = new mysqli($server,$username,$password,$database);
$conn = new mysqli($server_db,$username_db,$password_db,$database_name_db);


//Check the Connection was Sussesfull
if ($conn->connect_error) {
  die . "Connection Interuppted";
}

//echo "Connection Successful";							//Eneble this if Database not Successfuly Connected






$sql = "SELECT FULL_NAME, GRADE, DISTRICT, CITY FROM students WHERE EMAIL = '$student_email_from_cookie' and PASSWORD = '$student_password_from_cookie';";
$resalt = mysqli_query($conn, $sql);                   //get the resalt between $conn and, run $sql	
$resaltcheck = mysqli_num_rows($resalt);
$datas = array();
if ($resaltcheck > 0) {
  while ($row = mysqli_fetch_assoc($resalt)) {
    //echo $row['Image'];
    $datas[] = $row;
  }

  $students_full_name = $datas[0]['FULL_NAME'];
  $students_distrcict = $datas[0]['DISTRICT'];
  $students_city = $datas[0]['CITY'];
  $students_grade = $datas[0]['GRADE'];
}



//Get the values from cookies. Cookie handling Starts over here.
if (isset($_COOKIE['students_grade'])) {
  $students_grade = $_COOKIE['students_grade'];
}
if (isset($_COOKIE['how_classes_do'])) {
  //$how_classes_do = $_COOKIE['how_classes_do'];
}
if (isset($_COOKIE['district']) && isset($_COOKIE['city'])) {
  $students_distrcict = $_COOKIE['district'];
  $students_city = $_COOKIE['city'];
}
if (isset($_COOKIE['class_type'])) {
  $class_type = $_COOKIE['class_type'];
}
// if(isset($_COOKIE['searched_query']) && isset($_COOKIE['selected_category_by_user'])){
//   $searched_query = $_COOKIE['searched_query'];
//   $selected_category_by_user = $_COOKIE['selected_category_by_user'];

//   if($searched_query == 'subject'){
//     $subject = $searched_query;
//   }
// }






if (isset($_GET['students_new_grade_from_filter'])) {
  $students_new_grade = $_GET['students_new_grade_from_filter'];
  $students_grade = $students_new_grade;

  setcookie("students_grade", $students_grade, time() + 3600, '/');
}




if (isset($_GET['students_new_grade_from_filter_2'])) {
  if (isset($_GET['how_classes_do_from_filter'])) {
    $students_new_grade_from_filter_2 = $_GET['students_new_grade_from_filter_2'];
    $how_class_do_from_filter = $_GET['how_classes_do_from_filter'];

    $students_grade = $students_new_grade_from_filter_2;
    $how_classes_do = $how_class_do_from_filter;

    setcookie("students_grade", $students_grade, time() + 3600, '/');
    setcookie("how_classes_do", $how_classes_do, time() + 3600, '/');
  }
}

//NOTE- Wanna add new filter? Then add if statement here and down the database filters


if (isset($_GET['Subject_from_filter']) && isset($_GET['Grade_from_filer'])) {
  $subject_from_filter =  $_GET['Subject_from_filter'];
  $grade_from_filter = $_GET['Grade_from_filer'];

  $students_grade = $grade_from_filter;
  $subject = $subject_from_filter;

  setcookie("students_grade", $students_grade, time() + 3600, '/');
}



if (isset($_GET['students_grade_from_filter']) && isset($_GET['How_classes_do']) && isset($_GET['subject']) && isset($_GET['City']) && $_GET['District']) {
  $student_grade_from_filter = $_GET['students_grade_from_filter'];
  $how_class_do_from_filter = $_GET['How_classes_do'];
  $subject_from_filter = $_GET['subject'];
  $district = $_GET['District'];
  $city_from_filter = $_GET['City'];



  $students_distrcict = $district;
  $students_city = $city_from_filter;

  setcookie("district", $students_distrcict, time() + 3600, '/');
  setcookie("city", $students_city, time() + 3600, '/');
}




if (isset($_GET['class_type_from_filter'])) {
  $class_type = $_GET['class_type_from_filter'];

  setcookie("class_type", $class_type, time() + 3600, '/');
}





                    
if(isset($_GET['Search_bar']) && isset($_GET['selected_category'])){
    
    $searched_query = $_GET['Search_bar'];
    $selected_category_by_user = $_GET['selected_category'];
    
    
    if($selected_category_by_user == 'subject'){
      $subject = $searched_query;
    
    }elseif($selected_category_by_user == 'teacher'){
      $teachers_full_name = $searched_query;
    
    }elseif($selected_category_by_user == 'grade'){
      $students_grade = $searched_query;
    
    }elseif($selected_category_by_user == 'institute'){
      $selected_institute = $searched_query;
    }

    

  setcookie("searched_query",$searched_query,time()+3600,'/');
  setcookie("selected_category_by_user",$selected_category_by_user,time()+3600,'/');
}

                    
             

//Counting the amount of subject columns
$sql8 = "SELECT COUNT(COLUMN_NAME) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = N'time_table_of_teachers' and COLUMN_NAME LIKE 'GRADE__%';";
$resalt8 = mysqli_query($conn, $sql8);                 
$resaltcheck8 = mysqli_num_rows(mysqli_query($conn, $sql8));
$datas8 = array();
if ($resaltcheck8 > 0) {
  while ($row8 = mysqli_fetch_assoc($resalt8)) {
    $datas8[] = $row8;
  }
  $count_of_subject_columns = $datas8[0]['COUNT(COLUMN_NAME)'];
}

?>



<!DOCTYPE html>

<html lang="en" class="js-focus-visible" data-js-focus-visible="">

<head>
  
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    
    
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">


    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->
    <!--<meta http-equiv="x-dns-prefetch-control" content="on">-->
    <!--<link rel="dns-prefetch" href="https://www.google-analytics.com/">-->
    <!--<link rel="preconnect" href="https://www.google-analytics.com/">-->
    <!--<link rel="dns-prefetch" href="https://www.edupara.lk/">-->
    <!--<link rel="preconnect" href="https://www.edupara.lk/">-->
    <!--<link rel="dns-prefetch" href="https://www.edupara.lk/">-->
    <!--<link rel="preconnect" href="https://www.edupara.lk/">-->
    <!--<link rel="dns-prefetch" href="www.edupara.lk">-->
    <!--<link rel="preconnect" href="www.edupara.lk">-->
    
  
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/picture zoom plugin/dist/cp-lightimg.min.js"></script>
  <script src="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/Tooltip plugin/easyTooltip.min.js"></script>
  <link rel="stylesheet" href="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/cookie accept plugin/public/css/cookit.min.css" />
  <script src="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/cookie accept plugin/src/js/cookit.js"></script>
  
  





  <script src="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/rating_plugin_assets/scripts/jquery.rateit.min.js"></script>
  <link href="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/rating_plugin_assets/scripts/rateit.css" rel="stylesheet" type="text/css">
  <script src="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/rating_plugin_assets/scripts/jquery.rateit.js"></script>

  <title>Best teachers in Sri Lanka to brighten your future | Edupara.lk</title>
  <!-- <link data-react-helmet="true" rel="shortcut icon" href="https://static1.teacherspayteachers.com/tpt-frontend/releases/production/current/fbf2fa4d283a37a435dde24f48537e7d.ico"> -->
  <!-- <link data-react-helmet="true" rel="shortcut icon" href="./Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php/shortcut_icon.ico"> -->
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <style data-react-helmet="true">
    body {
      margin: 0;
      padding: 0;
    }
  </style>
  <style>
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

    #Cities_colombo_mb,
    #Cities_mathara_mb,
    #Cities_gampha_mb,
    #Cities_jaffna_mb,
    #Cities_kilinochchi_mb,
    #Cities_Mannar_mb,
    #Cities_Mullaitivu_mb,
    #Cities_Vavuniya_mb,
    #Cities_Puttalam_mb,
    #Cities_Kurunegala_mb,
    #Cities_Kalutara_mb,
    #Cities_Anuradhapura_mb,
    #Cities_Polonnaruwa_mb,
    #Cities_Matale_mb,
    #Cities_Kandy_mb,
    #Cities_Nuwara_Eliya_mb,
    #Cities_Kegalle_mb,
    #Cities_Ratnapura_mb,
    #Cities_Trincomalee_mb,
    #Cities_Batticaloa_mb,
    #Cities_Ampara_mb,
    #Cities_Badulla_mb,
    #Cities_Monaragala_mb,
    #Cities_Hambantota_mb,
    #Cities_Galle_mb{
      display: none;
    }
  </style>
  

  <style>
    .container {
      margin: 150px auto;
    }

    .hg-loading {
      background: rgba(0, 0, 0, .3);
      width: 100%;
      height: 100%;
      position: fixed;
      top: 0;
      left: 0;
      z-index: 10000000;
      opacity: 0;
      transition: opacity .2s;

    }

    .hg-loading.fade {
      opacity: 1;
      transition: opacity .2s;
    }

    .loading-body {
      position: absolute;
      left: 50%;
      top: 50%;
      width: 75px;
      height: 75px;
      margin-left: -35px;
      margin-top: -35px;
    }
  </style>
  
  <style>
      .new{
          width: 100px;
      }
  </style>


  <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <!-- <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"> -->
  <link href="buttonLoader.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">






  <meta data-react-helmet="true" name="viewport" content="width=device-width, initial-scale=1">
  <meta data-react-helmet="true" name="description" content="Find the best teacher for any subject in Sri Lanka. We coverd all subjects">
  
  <link data-react-helmet="true" rel="icon" href="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/favicon.png">
  <link data-react-helmet="true" rel="apple-touch-icon-precomposed" href="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/favicon.png">
  <link data-react-helmet="true" rel="stylesheet" href="./Mathamatics Worksheets &amp; Teaching Resources _ Teachers Pay Teachers_files/tpt-frontend.main.0c835c578060288c0860.css">
  <link data-react-helmet="true" rel="stylesheet" href="./Mathamatics Worksheets &amp; Teaching Resources _ Teachers Pay Teachers_files/tpt-frontend.responsiveGrid.20881bbea4ee18cc3a50.css">
  <link rel="icon" href="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/favicon.png" type="image/png" sizes="16x16">
  <!-- <link rel="preload" href="./Mathamatics Worksheets &amp; Teaching Resources _ Teachers Pay Teachers_files/tpt-frontend.SearchProductsPage-jsx.1ba9d532bfc208ad19a4.js.download" as="script" crossorigin="anonymous"> -->

  <script async="" src="./Mathamatics Worksheets &amp; Teaching Resources _ Teachers Pay Teachers_files/gtm.js.download"></script>
  <script type="text/javascript" async="" src="./Mathamatics Worksheets &amp; Teaching Resources _ Teachers Pay Teachers_files/heap-3064244106.js.download"></script>
  <script type="text/javascript">
    window.heap = window.heap || [], heap.load = function(e, t) {
      window.heap.appid = e, window.heap.config = t = t || {};
      var r = document.createElement("script");
      r.type = "text/javascript", r.async = !0, r.src = "https://cdn.heapanalytics.com/js/heap-" + e + ".js";
      var a = document.getElementsByTagName("script")[0];
      a.parentNode.insertBefore(r, a);
      for (var n = function(e) {
          return function() {
            heap.push([e].concat(Array.prototype.slice.call(arguments, 0)))
          }
        }, p = ["addEventProperties", "addUserProperties", "clearEventProperties", "identify", "resetIdentity", "removeEventProperty", "setEventProperties", "track", "unsetEventProperty"], o = 0; o < p.length; o++) heap[p[o]] = n(p[o])
    };
    heap.load("3064244106");
  </script>










  <script src="./Mathamatics Worksheets &amp; Teaching Resources _ Teachers Pay Teachers_files/11000223989.js.download" async=""></script>


  



  <link rel="stylesheet" href="./Mathamatics Worksheets &amp; Teaching Resources _ Teachers Pay Teachers_files/tpt-frontend.SearchProductsPage-jsx.a7b2eeff92609ea033fc.css" type="text/css">


  <script charset="utf-8" src="./Mathamatics Worksheets &amp; Teaching Resources _ Teachers Pay Teachers_files/tpt-frontend.SearchProductsPage-jsx.1ba9d532bfc208ad19a4.js.download" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="./Mathamatics Worksheets &amp; Teaching Resources _ Teachers Pay Teachers_files/tpt-frontend.Drawer.cab800b4d950d7929732.css">
  <script charset="utf-8" src="./Mathamatics Worksheets &amp; Teaching Resources _ Teachers Pay Teachers_files/tpt-frontend.Drawer.cf93c9139790e6e0a040.js.download" crossorigin="anonymous"></script>
  <style data-jss="" data-meta="MuiModal">
    .jss13 {
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      z-index: 1300;
      position: fixed;
    }

    .jss14 {
      visibility: hidden;
    }
  </style>
  <style data-jss="" data-meta="MuiDrawer">
    .jss2 {
      flex: 0 0 auto;
    }

    .jss3 {
      top: 0;
      flex: 1 0 auto;
      height: 100vh;
      display: flex;
      z-index: 1200;
      outline: none;
      position: fixed;
      overflow-y: auto;
      flex-direction: column;
      -webkit-overflow-scrolling: touch;
    }

    .jss4 {
      left: 0;
      right: auto;
    }

    .jss5 {
      left: auto;
      right: 0;
    }

    .jss6 {
      top: 0;
      left: 0;
      right: 0;
      bottom: auto;
      height: auto;
      max-height: 100vh;
    }

    .jss7 {
      top: auto;
      left: 0;
      right: 0;
      bottom: 0;
      height: auto;
      max-height: 100vh;
    }

    .jss8 {
      border-right: 1px solid rgba(0, 0, 0, 0.12);
    }

    .jss9 {
      border-bottom: 1px solid rgba(0, 0, 0, 0.12);
    }

    .jss10 {
      border-left: 1px solid rgba(0, 0, 0, 0.12);
    }

    .jss11 {
      border-top: 1px solid rgba(0, 0, 0, 0.12);
    }
  </style>
  <style data-jss="">
    .jss1 {
      max-width: 80vw;
      min-width: 240px;
    }

    @media (min-width:768px) {
      .jss1 {
        min-width: 300px;
      }
    }
  </style>
  <script async="" src="./Mathamatics Worksheets &amp; Teaching Resources _ Teachers Pay Teachers_files/modules.855de5fca5328f4d913a.js.download" charset="utf-8"></script>
  <style type="text/css">
    iframe#_hjRemoteVarsFrame {
      display: none !important;
      width: 1px !important;
      height: 1px !important;
      opacity: 0 !important;
      pointer-events: none !important;
    }
  </style>
  <script src="./Mathamatics Worksheets &amp; Teaching Resources _ Teachers Pay Teachers_files/5601677.js.download" type="text/javascript" async="" data-ueto="ueto_55ad59f91c"></script>
  <link rel="next" href="https://www.teacherspayteachers.com/Browse/Search:mathamatics/Core-Standard/CCRA.R.3/Page:2" data-react-helmet="true">



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>




<!-- pretty dropdown starts here -->
  <link href="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/pretty dropdown plugin/dist/css/prettydropdowns.css" rel="stylesheet" type="text/css">
<!-- pretty dropdown ends here -->




<!-- site tour starts here -->
  <link href="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/Site tour plugin/package/introjs.css" rel="stylesheet" />
  <script src="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/Site tour plugin/package/intro.js"></script>
  <link href="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/Site tour plugin/package/themes/introjs-flattener.css" rel="stylesheet">
  <!-- <a href="javascript:void(0);" onclick="javascript:introJs().start();">Show me how</a> -->
<!-- site tour ends here -->


<!-- chatbot crisp stars here -->
  <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="9b60cb55-8248-4adf-a1fd-e7664671c711";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
<!-- chatbot crisp ends here -->

<!-- typehead css starts here -->
  <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
  <link href="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/Typeahead/jquery.flexdatalist.css" rel="stylesheet" type="text/css">
<!-- typehead css ends here -->


<!-- font awesome starts here -->
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
<!-- font awesome ends here -->


<!-- flipbox plugin starts here -->
  <style>
      .box {width: 100%; height: 280px; margin: 30px 0; font-size: initial;}
      .box .side {line-height: 280px; font-size: 80px; font-weight: 700; color: #fff; text-align: center; user-select: none;}
      .box .side.side1 {background: #3366CC;}
      .box .side.side2 {background: #DC3912;}
      .box .side.side3 {background: #FF9900;}
      .box .side.side4 {background: #109618;}
      .box .side.side5 {background: #990099;}
      .box .side.side6 {background: #3B3EAC;}
      .box .side.side7 {background: #0099C6;}
      .box .side.side8 {background: #DD4477;}
      
  </style>
  <link rel="stylesheet" href="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/Flipbox plugin/src/jquery.flipbox.css">
<!-- flipbox plugin ends here -->


<!-- beautified dropdown nearby search css starts here -->
  <style>
    /* Dropdown Button */
    button[onclick="myFunction()"] {
          background-color: #017BFF;
          /* background-color: #0BA96C; */
          color: #fff;
          padding: 16px;
          font-size: 16px;
          border: none;
          cursor: pointer;
          width: 120px;
          position : relative;
          margin-top : -150px;
          margin-right : -30px;
          height : 45px;
          
          }

          /* Dropdown button on hover & focus */
          button[onclick="myFunction()"]:hover, .center:focus {
          background-color: #2980B9;
          }

          /* The container <div> - needed to position the dropdown content */
          .dropdown {
          position: relative;
          display: inline-block;
          }

          /* Dropdown Content (Hidden by Default) */
          .dropdown-content {
          display: none;
          position: absolute;
          background-color: #fff;
          min-width: 160px;
          box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
          z-index: 1;
          }

          /* Links inside the dropdown */
          .dropdown-content a {
          color: black;
          padding: 12px 16px;
          text-decoration: none;
          display: block;
          }

          /* Change color of dropdown links on hover */
          .dropdown-content a:hover {background-color: #ddd}

          /* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
          .show {display:block;}

          
  </style>
  <style>
    /* Dropdown Button */
    button[onclick="myFunction2()"] {
          background-color: #017BFF;
          /* background-color: #0BA96C; */
          color: #fff;
          padding: 16px;
          font-size: 16px;
          border: none;
          cursor: pointer;
          width: 120px;
          position : relative;
          margin-top : -150px;
          margin-right : -30px;
          height : 45px;
          
          }

          /* Dropdown button on hover & focus */
          button[onclick="myFunction2()"]:hover, .center:focus {
          background-color: #2980B9;
          }

          /* The container <div> - needed to position the dropdown content */
          .dropdown2 {
          position: relative;
          display: inline-block;
          }

          /* Dropdown Content (Hidden by Default) */
          .dropdown-content2 {
          display: none;
          position: absolute;
          background-color: #fff;
          min-width: 160px;
          box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
          z-index: 1;
          }

          /* Links inside the dropdown */
          .dropdown-content2 a {
          color: black;
          padding: 12px 16px;
          text-decoration: none;
          display: block;
          }

          /* Change color of dropdown links on hover */
          .dropdown-content2 a:hover {background-color: #ddd}

          /* Show the dropdown menu (use JS to add this class to the .dropdown-content2 container when the user clicks on the dropdown button) */
          .show {display:block;}

          
  </style>
<!-- beautified dropdown nearby search css ends here -->



<!-- Themify Icons Plugin Stars here -->
  <link rel="stylesheet" href="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/Themefy icons plugin/themify-icons.css">
<!-- Themify Icons Plugin Stars here -->




<!-- Mobile Version Drawer Starts Here -->
  <link href="sandbox.css" rel="stylesheet">
  <link href="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/drawer plugin/dist/css/drawer.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!-- Mobile Version Drawer Ends Here -->






<!-- lunar models starts here -->
  <link href="https://fonts.googleapis.com/css?family=Work+Sans:600" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Overpass:300,400,600,700,800,900" rel="stylesheet">


  <link rel="stylesheet" href="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/lunar models/assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/lunar models/assets/css/lunar.css">
  <link rel="stylesheet" href="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/lunar models/assets/css/demo.css">
  <link rel="stylesheet" href="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/lunar models/assets/css/animate.min.css">
  <!-- <link rel="icon" type="image/x-icon" href="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/lunar models/assets/img/lunar.png"/> -->
  





<!-- lunar models ends here -->

</head>



<script>
  $(function() {
    $.cookit({
      messageText: "<b>We have to use some cookies.</b> To enhance the experience, we may use it.",
      linkText: "Learn more",
      linkUrl: "/privacy/",
      buttonText: "I accept"
    });
  });
</script>

<!-- lunar model showing settings starts here -->
  <script>
    var new_comer_state = "<?php if($_GET['new_comer_state']=='true'){echo true;}else{echo false;}?>";
    if(new_comer_state ==  true){
      setTimeout(function () {
        $(".modal:not(.auto-off)").modal("show");
      },2000);
    }
    
  </script>



  <!-- Modal -->
  <div class="modal fade "   id="demoModal"  tabindex="-1" role="dialog"
          aria-labelledby="demoModal" aria-hidden="true">
          <div class="modal-dialog  modal-dialog-centered" role="document">
              <div class="modal-content bg-rhino">
                  <button type="button" class="close light" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
                  <div class="text-center py-3 rounded-top">
                      <img src="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/lunar models/assets/img/mockup.png" class="mw-100" alt="">
                  </div>
                  <div class="modal-body pb-sm-5">
                      <div class=" text-center text-white">
                          <h3 class="pt-3">Welcome to Edupara <br/> <?php echo $students_full_name; ?></h3><br/>
                          <p class="text-white-50">
                          You are welcome to Edupara.Thanks for choosing us to boost your career. We hope you will enjoy our main features and add them to your life and make it bright. If you have any questions, just call our hotline. We are looking forward to helping you out.
                          </p><br>
                          <a href="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?" class="btn btn-cstm-danger btn-cta" data-dismiss="modal" aria-label="Close" >Find the best teacher for me</a>

                      </div>
                  </div>

              </div>
          </div>
      </div>
    <!-- Modal Ends -->
<!-- lunar model showing settings starts here -->



<script src="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/lunar models/assets/js/popper.min.js"></script>
<script src="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/lunar models/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/lunar models/assets/js/lunar.js"></script>
<script src="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/lunar models/assets/js/demo.js"></script>
    <!-- Modal Ends -->


<script>
  function showTelegramModel(){
      $("#demoModal").remove();
      var telegram_model = 
              `<div class="modal fade modal-bottom-right"      id="demoModal"  tabindex="-1" role="dialog"
                aria-labelledby="demoModal" aria-hidden="true">

                <div class="modal-dialog modal-sm " role="document">

                    <div class="modal-dialog   modal-sm" role="document">
                        <div class="modal-content bg-rhino">

                            <div class="modal-body">

                                <div class="text-white text-center pb-3">

                                    <div class="pull-up-sm">

                                            <img width="50" src="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/lunar models/assets/img/telegram.svg" class="rounded" >
                                    </div>
                                    <h5 class="pt-2" >Join the Group on telegram now</h5>
                                    <p class="text-white-50">
                                        Get support and talk with our admin panel please join with our telegram group today.
                                    </p>
                                </div>
                                <div class="">
                                    <button data-dismiss="modal" class="btn btn-block btn-cstm-light">  <a href="https://t.me/+FgFtJHnZFN05YTI1">Join Team on telegram</a></button>
                                    <div class=" pt-2 text-center"><a data-dismiss="modal" class="text-white-50">Dismiss</a></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
              </div>`;
      $('body').before(telegram_model);
      
      
        setTimeout(function () {
          $(".modal:not(.auto-off)").modal("show");
        },2000);
        
  }

  setTimeout(showTelegramModel,90000);
</script>

<!-- If annonymous is logged then show register as a student model -->
<script>
  function showRegisterModel(){
      $("#demoModal").remove();
      
    var register_model = `<div class="modal fade modal-bottom-right"   id="demoModal"  tabindex="-1" role="dialog"
                        aria-labelledby="demoModal" aria-hidden="true">
                        <div class="modal-dialog   modal-sm " role="document">
                            <div class="modal-content">
                                <button type="button" class="close close-pinned" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <div class="modal-body bg-img" style="background-image: url('https://images.unsplash.com/photo-1511556820780-d912e42b4980?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=634&q=80')">
                                    <div  >
                                        <div class="px-sm-2 py-sm-2 ">
                                            <div class=" bg-light rounded px-4 py-4">
                                                <div class="text-center" >
                                                    <img src="assets/img/megaphone.png" alt="">
                                                </div>
                                                <h4 class="pt-sm-3 text-center">Register as a Student</h4>
                                                <p class="text-muted text-center">
                                                    Register as a student to save your search, Grades and much more. It won't take more than minute.
                                                </p>

                                                <a href="../Register and login as a student/login.php?"  class="btn btn-cstm-dark btn-block btn-cta" data-dismiss="modal" aria-label="Close">Register Now</a>
                                                <div class="pt-3 ">
                                                    <small  ><a href="#" data-dismiss="modal" aria-label="Close" class="text-muted">No, I'll skip for Now.</a></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>`;

        $('body').before(register_model);
        setTimeout(function () {
          $(".modal:not(.auto-off)").modal("show");
        },2000);
      
    }
    
</script>
<script>
  var students_full_name = "<?php echo $students_full_name; ?>";
  var students_email = "<?php echo $student_email_from_cookie;?>";
  var students_password = "<?php echo $student_password_from_cookie; ?>";
  
  if(students_full_name.includes('ANONYMOUS') && students_password.includes('ANONYMOUS') && students_email.includes('ANONYMOUS')){
      setTimeout(showRegisterModel,300);
  }
</script>


      



<body data-new-gr-c-s-check-loaded="14.1049.0" data-gr-ext-installed="" cz-shortcut-listen="true">
  <div data-tpt-mount="" class="tpt-frontend">
    <div>
      <div>
        <div class="responsive">
          <div class="container container-lg-padded">
            <div class="HeaderLayout--responsive">
              <div class="row PrimaryHeaderLayout align-items-center">
                <div class="col-auto d-lg-none">
                  <div><span><button class="Button Button--small Button--primaryOutline drawer-toggle" type="button" id="mobile_menu_button">Menu</button></span></div>
                </div>
                <div class="col">
                  <div class="PrimaryHeaderLayout__Logo">
                    <!-- <div class="Logo"><a class="Anchor Anchor--green" href="www.edupara.lk"><img class="Logo__img" style="width:250px;height:38px" src="./Mathamatics Worksheets &amp; Teaching Resources _ Teachers Pay Teachers_files/logo.arduooz1ai.svg" alt="Teachers Pay Teachers"></a></div> -->
                    <div class="Logo"><a class="Anchor Anchor--green" href="../index.html"><img class="Logo__img"  src="../index/img/core-img/logo.png" alt="edupara.lk"></a></div>
                  </div>
                </div>
                <div class="col-lg-8 d-none d-lg-block">
                  <ul class="HeaderLayout__linkList">
                    <li class="HeaderLayout__link"><a class="Anchor Anchor--gray" href="../index.html">Home</a></li>
                    <li class="HeaderLayout__link"><a class="Anchor Anchor--gray" href="../Teachers login/Teachers_login.php?">Teachers Login</a></li>
                    <li class="HeaderLayout__link"><a class="Anchor Anchor--gray" href="#">Institute Login</a></li>
                    <li class="HeaderLayout__link"><a class="Anchor Anchor--gray" href="javascript:void(0);" onclick="javascript:introJs().start();">Help</a></li>
                    <li class="HeaderLayout__link"><span><a class="Anchor Anchor--gray" href="../index/contact.php?">Contact Us</a></span></li>
                  </ul>
                </div>

                
              </div>

              

              


              <!-- Mobile Slide Menu Starts Here -->
                <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
                <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/flatly/bootstrap.min.css"> -->
                <link href="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/sidebar plugin/dist/css/slide-out-panel.css" rel="stylesheet">

                <!-- <button class="btn btn-primary" id="mobile_menu_button">Open Panel 2</button> -->




                <div id="slide-out-panel_2" class="slide-out-panel_2">
                  <header>Main Menu</header>
                  <section>
                        <p style="font-size:1.1rem" class="col-auto">Select a category</p><br>
                        
                        <div class="dropdown2 col-2">
                        <button onclick="myFunction2()" class="center2">Subject &nbsp <i class="ti-angle-down"></i></button>
                        <div id="myDropdown2" class="dropdown-content2">
                          <a href="#" value="subject" id="subject" class="dropitems2" HiddenValue="Subject"><i class="ti-book">&nbsp</i>Subject</a>
                          <a href="#" value="teacher" id="teacher" class="dropitems2"><i class="ti-user">&nbsp</i>Teacher</a>
                          <a href="#" value="grade" id="grade" class="dropitems2"><i class="ti-medall-alt">&nbsp</i>Grade</a>
                          <a href="#" value="institute" id="institute" class="dropitems2"><i class="ti-flag">&nbsp</i>Institute</a>
                        </div>
                      </div>
                      
                      <br><br><hr><br>

                      <h4 class="col-auto" style="font-size:1.1rem; cursor:pointer; margin:20px"><a href="../index.html">Home</a>            </p>
                      <h4 class="col-auto" style="font-size:1.1rem; cursor:pointer; margin:20px"><a href="../Teachers login/Teachers_login.php?">Teachers Login</a>         </p>
                      <h4 class="col-auto" style="font-size:1.1rem; cursor:pointer; margin:20px"><a href="#">Institutes Login</a>               </p>
                      <h4 class="col-auto" style="font-size:1.1rem; cursor:pointer; margin:20px"><a href="#">Help</a> </p>
                      <h4 class="col-auto" style="font-size:1.1rem; cursor:pointer; margin:20px"><a href="../index/contact.php?">Contact Us</a>      </p>
                      <h4 class="col-auto" style="font-size:1.1rem; cursor:pointer; margin:20px"><a href="../Register and login as a student/login.php?">Logout</a>      </p>


                      
                  </section>
                  <footer><?php echo $students_full_name; ?> </footer>
                </div>

                <script>
                  /* When the user clicks on the button,
                    toggle between hiding and showing the dropdown content */
                    function myFunction2() {
                    document.getElementById("myDropdown2").classList.toggle("show");
                    }

                    // Close the dropdown menu if the user clicks outside of it
                    window.onclick = function(event) {
                    if (!event.target.matches('.center2')) {
                        var dropdowns = document.getElementsByClassName("dropdown-content2");
                        var i;
                        for (i = 0; i < dropdowns.length; i++) {
                        var openDropdown = dropdowns[i];
                        if (openDropdown.classList.contains('show')) {
                            openDropdown.classList.remove('show');
                        }
                        }
                    }
                }

                $(document).ready(function(){
                        $(".dropitems2").click(function(){
                            var selected_value_from_dropdown = $(this).text();
                            $(".center2").text(selected_value_from_dropdown);
                            
                        });
                });
              </script>
                    
                
                <script src="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/sidebar plugin/dist/js/slide-out-panel.js"></script>
                
                <script>
                  const slideOutPanel_2 = $('#slide-out-panel_2').SlideOutPanel({
                                          slideFrom: 'left',
                                          enableEscapeKey: true,
                                          width: '240px',
                                        });
                                          

                  $('body').on('click', '#mobile_menu_button', () => {
                    slideOutPanel_2.open();
                  });
                </script>  

               
                <script>
                    $(".dropitems2").click(function(){
                          var selected_value_from_dropdown = $(this).attr('value');
                          
                          $("#SearchBar").attr('value','');
                          $("#SearchBar").prop("readonly",false);
                          $("label[for='SearchBar']").hide();

                          if(selected_value_from_dropdown == 'subject'){
                              $("#SearchBar").attr("placeholder","Search a subject");
                              category('subject'); // Calling function category and pass the value 'Subject'
                              
                              var students_grade = "<?php echo $students_grade; ?>";
                              
                              if(students_grade == 'grade_6'){
                                  grade_6_datalist();
                              
                              }else if(students_grade == 'grade_7'){
                                  grade_7_datalist();

                              }else if(students_grade == 'grade_8'){
                                  grade_8_datalist();

                              }else if(students_grade == 'grade_9'){
                                  grade_9_datalist();

                              }else if(students_grade == 'OL'){
                                  OL_datalist();

                              }else if(students_grade == 'AL'){
                                  AL_datalist();

                              }
                          
                          }else if(selected_value_from_dropdown == "teacher"){
                           $("#SearchBar").attr("placeholder","Search a teacher by name");
                           Teachers_datalist();
                           category('teacher');

                          }else if(selected_value_from_dropdown == "grade"){
                              $("#SearchBar").attr("placeholder","Search the grade");
                              Grades_datalist()
                              category('grade');

                          }else if(selected_value_from_dropdown == "institute"){
                              $("#SearchBar").attr("placeholder","Search a institute");
                              Institute_datalist()
                              category('institute');

                          }
                    });
                          
                          
                          
                              
                </script>
                
                
              <!-- Mobile Slide Menu Ends Here -->             

              
              
              
              
              
              
              
              
              <div class="row SecondaryHeaderLayout" data-step="1" data-intro="This is the 2nd nav bar. You can find, Subjects, Teachers, Institutes over here.">
                <div class="col-auto d-none d-lg-flex" data-step="2" data-intro="This is the option dropdown. Select a category from here before you perform a search">
                <div class="CategoryMenu__buttonContent"><span class="label">
              
                <div class="dropdown">
                  <button onclick="myFunction()" class="center">Subject &nbsp <i class="ti-angle-down"></i></button>
                  <div id="myDropdown" class="dropdown-content">
                    <a href="#" value="subject" id="subject" class="dropitems" HiddenValue="Subject"><i class="ti-book">&nbsp</i>Subject</a>
                    <a href="#" value="teacher" id="teacher" class="dropitems"><i class="ti-user">&nbsp</i>Teacher</a>
                    <a href="#" value="grade" id="grade" class="dropitems"><i class="ti-medall-alt">&nbsp</i>Grade</a>
                    <a href="#" value="institute" id="institute" class="dropitems"><i class="ti-flag">&nbsp</i>Institute</a>
                  </div>
                </div>

                <script>
                    /* When the user clicks on the button,
                      toggle between hiding and showing the dropdown content */
                      function myFunction() {
                      document.getElementById("myDropdown").classList.toggle("show");
                      }

                      // Close the dropdown menu if the user clicks outside of it
                      window.onclick = function(event) {
                      if (!event.target.matches('.center')) {
                          var dropdowns = document.getElementsByClassName("dropdown-content");
                          var i;
                          for (i = 0; i < dropdowns.length; i++) {
                          var openDropdown = dropdowns[i];
                          if (openDropdown.classList.contains('show')) {
                              openDropdown.classList.remove('show');
                          }
                          }
                      }
                  }

                  $(document).ready(function(){
                          
                          $(".dropitems").click(function(){
                              var selected_value_from_dropdown = $(this).text();
                              $(".center").text(selected_value_from_dropdown);
                              
                          });
                  });
                </script>

                
                
                
                
               
                

                

                
                  
                  
                  
                
                
              
                  
              
              
                </span>
                <span class="Dropdown__icon"></span></div>
                
                
                
            
                
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                <script src="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/pretty dropdown plugin/dist/js/jquery.prettydropdowns.js"></script>
                
                <script>
                    $('.new2').prettyDropdown();
                </script>
                <!-- <div class="CategoryMenu--responsive CategoryMenu bubbleLabel"><span class="Dropdown__button Dropdown__target CategoryMenu__button" aria-label="Category Menu" aria-pressed="false" tabindex="0" role="button">
                      <div class="CategoryMenu__buttonContent"><span class="label">Browse</span><span class="Dropdown__icon"><span class="tpticon tpticon-angle-down"></span></span></div>
                    </span>
                    <div class="CategoryMenu__content CategoryMenu--hidden">
                      <div class="ignore-react-onclickoutside">
                        <ul class="Menu">
                          <div class="SubMenuPrefab"><span class="Dropdown__button Dropdown__target SubMenuPrefab__button" aria-pressed="false" tabindex="0" role="button">
                              <div class="SubMenuPrefab__buttonContent"><span class="label">
                                  <div class="SubMenuPrefabLabelLayout" data-testid="SubMenuPrefabLabelLayout"><span class="label">Grade Level</span><span class="SubMenuPrefab__icon"><span class="tpticon tpticon-angle-right"></span></span></div>
                                </span><span class="Dropdown__icon"><span class="tpticon tpticon-angle-down"></span></span></div>
                            </span>
                            <div class="SubMenuPrefab__content SubMenuPrefab--hidden">
                              <div class="ignore-react-onclickoutside">
                                <ul class="Menu">
                                  <li class="MenuItem"><span class="MenuItem__label"><a class="Anchor Anchor--inherit Anchor--undecorated" href="https://www.teacherspayteachers.com/Browse/Grade-Level/PreK-K">Pre-K -
                                        K</a></span></li>
                                  <li class="MenuItem"><span class="MenuItem__label"><a class="Anchor Anchor--inherit Anchor--undecorated" href="https://www.teacherspayteachers.com/Browse/Grade-Level/1-2">1 -
                                        2</a></span></li>
                                  <li class="MenuItem"><span class="MenuItem__label"><a class="Anchor Anchor--inherit Anchor--undecorated" href="https://www.teacherspayteachers.com/Browse/Grade-Level/3-5">3 -
                                        5</a></span></li>
                                  <li class="MenuItem"><span class="MenuItem__label"><a class="Anchor Anchor--inherit Anchor--undecorated" href="https://www.teacherspayteachers.com/Browse/Grade-Level/6-8">6 -
                                        8</a></span></li>
                                  <li class="MenuItem"><span class="MenuItem__label"><a class="Anchor Anchor--inherit Anchor--undecorated" href="https://www.teacherspayteachers.com/Browse/Grade-Level/9-12">9 -
                                        12</a></span></li>
                                  <li class="MenuItem"><span class="MenuItem__label"><a class="Anchor Anchor--inherit Anchor--undecorated" href="https://www.teacherspayteachers.com/Browse/Grade-Level/Other">Other</a></span>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </div> -->

                </div>
                
                <!-- Search Starts Here -->
                <div class="col-lg-5 col" data-step="3" data-intro="After selecting the category from the dropdon, You can Search anything.">
                  <div class="SearchAutosuggestBespoke">
                    
                      <div class="react-autosuggest__container">
                        <input type="search" list="skills"  id="SearchBar" autocomplete="off" role="combobox" aria-autocomplete="list" aria-owns="react-autowhatever-1" aria-expanded="false" aria-haspopup="false" class="react-autosuggest__input flexdatalist form-control" aria-label="Search" inputmode="text" placeholder="Select a category" name = "Search_bar"> 
                        <label for="SearchBar">Click Menu --> Select category to change the Search category</label>
                        <div id="react-autowhatever-1" class="react-autosuggest__suggestions-container"></div>
                      </div>
                    <button type="submit" aria-label="Search" class="SearchAutosuggestBespoke__button" name="Search_button"><span class="tpticon tpticon-search SearchAutosuggestBespoke__buttonIcon"></span></button>
                    
                  </div>
                </div>
                
                <script>
                    function category(e){
                      window.selected_category = e;
                      //document.writeln(selected_category);
                    }

                    $("button[name = 'Search_button']").click(function(){
                        var search_query = encodeURIComponent($("#SearchBar").val());
                        window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?selected_category="+selected_category+"&Search_bar="+search_query);

                    });
                </script>
                

                        
              <script>
                  var searched_query = "<?php echo $searched_query; ?>";
                  var selected_category_by_user = "<?php echo $selected_category_by_user; ?>";
                  

                  if(searched_query.length > 0 && selected_category_by_user.length > 0){
                      $("#SearchBar").attr('value',searched_query);
                    }
                    
              </script>

                      

                  

                  

                
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                <script src="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/Typeahead/jquery.flexdatalist.js"></script>
                
                

                <!-- Assign Defaults -->
                <script>
                    
                    var selected_category = "<?php 
                                                  if(isset($_GET['selected_category'])){
                                                    echo $_GET['selected_category'];
                                                    }else{
                                                    echo "val_didnot_parsed";
                                                    }
                                              ?>";
                    
                    $("#SearchBar").prop("readonly",false);
                    $("label[for='SearchBar']").hide();
                    
                    switch (selected_category) {
                      case 'subject':
                        $(".center").text("Subject");
                        break;

                      case 'teacher':
                        $(".center").text("Teacher");
                        break;

                      case 'grade':
                        $(".center").text("Grade");
                        break;

                      case 'institute':
                        $(".center").text("Institute");
                        break;
                    
                      
                    }
                    
                    if(selected_category == 'subject' || selected_category == 'val_didnot_parsed'){
                        $(function(){
                              $("#SearchBar").attr("placeholder","Search a subject");
                                  category('subject'); // Calling function category and pass the value 'Subject'
                                  
                                  var students_grade = "<?php echo $students_grade; ?>";
                                  
                                  if(students_grade == 'grade_6'){
                                      grade_6_datalist();
                                  
                                  }else if(students_grade == 'grade_7'){
                                      grade_7_datalist();

                                  }else if(students_grade == 'grade_8'){
                                      grade_8_datalist();

                                  }else if(students_grade == 'grade_9'){
                                      grade_9_datalist();

                                  }else if(students_grade == 'OL'){
                                      OL_datalist();

                                  }else if(students_grade == 'AL'){
                                      AL_datalist();

                                  }
                              });
                      
                        
                      }else if(selected_category == 'teacher'){
                            $(function(){
                              $("#SearchBar").attr("placeholder","Search a teacher by name");
                              Teachers_datalist();
                              category('teacher');
                                
                          });


                      }else if(selected_category == 'grade'){
                            $(function(){
                              $("#SearchBar").attr("placeholder","Search the grade");
                              Grades_datalist()
                              category('grade');
                                
                          });


                      }else if(selected_category == 'institute'){
                            $(function(){
                              $("#SearchBar").attr("placeholder","Search a institute");
                              Institute_datalist()
                              category('institute');
                            });
  
                        }
                         
                  </script>
                                

                  
                <script>

                    $('.dropitems').click(function(){
                      var selected_value_from_dropdown = $(this).attr('value');
                      
                      $("#SearchBar").attr('value','');
                      $("#SearchBar").prop("readonly",false);
                      $("label[for='SearchBar']").hide();

                      if(selected_value_from_dropdown == 'subject'){
                          $("#SearchBar").attr("placeholder","Search a subject");
                          category('subject'); // Calling function category and pass the value 'Subject'
                          
                          var students_grade = "<?php echo $students_grade; ?>";
                          
                          if(students_grade == 'grade_6'){
                              grade_6_datalist();
                          
                          }else if(students_grade == 'grade_7'){
                              grade_7_datalist();

                          }else if(students_grade == 'grade_8'){
                              grade_8_datalist();

                          }else if(students_grade == 'grade_9'){
                              grade_9_datalist();

                          }else if(students_grade == 'OL'){
                              OL_datalist();

                          }else if(students_grade == 'AL'){
                              AL_datalist();

                          }
                      
                      
                      }else if(selected_value_from_dropdown == "teacher"){
                           $("#SearchBar").attr("placeholder","Search a teacher by name");
                           Teachers_datalist();
                           category('teacher');

                      }else if(selected_value_from_dropdown == "grade"){
                          $("#SearchBar").attr("placeholder","Search the grade");
                          Grades_datalist()
                          category('grade');

                      }else if(selected_value_from_dropdown == "institute"){
                          $("#SearchBar").attr("placeholder","Search a institute");
                          Institute_datalist()
                          category('institute');

                      }
                      
                    });
                    
                  </script>
                  
                  
                  <script>
                      function grade_6_datalist(){
                        $('#SearchBar').attr('list','grade_6_list');
                      }

                      function grade_7_datalist(){
                        $('#SearchBar').attr('list','grade_7_list');
                      }

                      function grade_8_datalist(){
                        $('#SearchBar').attr('list','grade_8_list');
                      }

                      function grade_9_datalist(){
                        $('#SearchBar').attr('list','grade_9_list');
                      }

                      function OL_datalist(){
                        $('#SearchBar').attr('list','OL_list');
                      }

                      function AL_datalist(){
                        $('#SearchBar').attr('list','AL_list');
                      }

                      function Teachers_datalist(){
                        $('#SearchBar').attr('list','teachers_list');
                      }

                      function Grades_datalist(){
                          $('#SearchBar').attr('list','grades_list');
                      }

                      function Institute_datalist(){
                          $('#SearchBar').attr('list','institutes_list');
                      }
                  </script>


                <datalist id="grade_6_list">
                    <option  value='Buddhism'>Buddhism</option>
                    <option  value='Christianity'>Christianity</option>
                    <option  value='Catholic'>Catholic</option>
                    <option  value='English Language'>English Language</option>
                    <option  value='Science'>Science</option>
                    <option  value='Geography'>Geography</option>
                    <option  value='Dancing'>Dancing</option>
                    <option  value='Western Music'>Western Music</option>
                    <option  value='Drama & Theatre'>Drama & Theatre</option>
                    <option  value='Health & Physical Education'>Health & Physical Education</option>
                    <option  value='Shivenary'>Shivenary</option>
                    <option  value='Sinhala Language'>Sinhala Language</option>
                    <option  value='Mathematics'>Mathematics</option>
                    <option  value='History'>History</option>
                    <option  value='Life skills & Citizenshipn Education'>Life skills & Citizenshipn Education</option>
                    <option  value='Eastern Music'>Eastern Music</option>
                    <option  value='Art'>Art</option>
                    <option  value='Practical & Technical Studies'>Practical & Technical Studies</option>
                    <option  value='Tamil Language'>Tamil Language</option>
                </datalist>

                <datalist id="grade_7_list">
                    <option value='Buddhism'>Buddhism</option>
                    <option value='Christianity'>Christianity</option>
                    <option value='Catholic'>Catholic</option>
                    <option value='English Language'>English Language</option>
                    <option value='Science'>Science</option>
                    <option value='Geography'>Geography</option>
                    <option value='Dancing'>Dancing</option>
                    <option value='Western Music'>Western Music</option>
                    <option value='Drama & Theatre'>Drama & Theatre</option>
                    <option value='Health & Physical Education'>Health & Physical Education</option>
                    <option value='Shivenary'>Shivenary</option>
                    <option value='Sinhala Language'>Sinhala Language</option>
                    <option value='Mathematics'>Mathematics</option>
                    <option value='History'>History</option>
                    <option value='Life skills & Citizenshipn Education'>Life skills & Citizenshipn Education</option>
                    <option value='Eastern Music'>Eastern Music</option>
                    <option value='Art'>Art</option>
                    <option value='Practical & Technical Studies'>Practical & Technical Studies</option>
                    <option value='Tamil Language'>Tamil Language</option>
                </datalist>

                <datalist id="grade_8_list">
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
                </datalist>

                <datalist id="grade_9_list">
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
                </datalist>

                <datalist id="OL_list">
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
                </datalist>

                <datalist id="AL_list">
                    <option value='Information Communication Technology'>ICT - All Streams</option>
                    <option value='Science For Technology'>SFT - Technology Stream</option> 
                    <option value='Engineering Technology'>ET - Technology Stream</option> 
                    <option value='Bio System Technology'>BST - Technology Stream</option>
                    
                    <option value='Business Studies'>BS - Commerce Stream</option> 
                    <option value='Accountancy'>Accountancy - Commerce Stream</option> 
                    <option value='Economics'> Econ - Commerce Stream</option>
                    <option value='Business Statistics'>Business Statistics - 'Commerce Stream</option>
                    <option value='The logic and the scientific method'>Logic - Commerce Stream</option>

                    <option value='Combined mathematics'>Combined Maths - Physical Science Stream</option> 
                    <option value='Physics'>Physics - Physical Science Stream</option> 
                    <option value='Chemistry'> Chemistry - Physical Science Stream</option>


                    <option value='Biology'>Biology - Biological Science Stream</option> 
                    <option value='Physics'>Physics - Biological Science stream</option> 
                    <option value='Chemistry'>Chemistry - Biological Science stream</option>
                </datalist>
                
                
                
                <datalist id='teachers_list'>
                    <?php
                          $need_columns = "";
                          for ($p=1; $p <= $count_of_subject_columns; $p++) { 
                            $need_columns = $need_columns . "time_table_of_teachers.GRADE__$p, time_table_of_teachers.SUBJECT__$p";
                            if($p != $count_of_subject_columns){$need_columns = $need_columns.', ';}
                          }
                          
                          $sql5 = "SELECT T_ID,teachers.FNAME, teachers.SNAME, $need_columns
                                  FROM time_table_of_teachers
                                  JOIN teachers USING (T_ID);";
                          
                          $resalt5 = mysqli_query($conn, $sql5);                   //get the resalt between $conn and, run $sql 
                          $resaltcheck5 = mysqli_num_rows($resalt5);
                          $datas5 = array();
                          
                          if ($resaltcheck5 > 0) {
                            while ($row5 = mysqli_fetch_assoc($resalt5)) {
                              $datas5[] = $row5;
                            }
                            
                           
                            for ($k=0; $k < count($datas5); $k ++) { 
                                $teachers_fname_select = $datas5[$k]['FNAME'];
                                $teachers_sname_select = $datas5[$k]['SNAME'];

                                $all_subjects_unedited = "";
                                $all_grades_unedited = "";
                                for ($q=1; $q <= $count_of_subject_columns; $q++) { 
                                  $all_subjects_unedited = $all_subjects_unedited . $datas5[$k]["SUBJECT__$q"] . ",";
                                  $all_grades_unedited = $all_grades_unedited . $datas5[$k]["GRADE__$q"]. ",";
                                }
                                
                                                                
                                
                                $subjects_without_repeting = "$all_subjects_unedited";
                                $subjects_without_repeting = implode(',',array_unique(explode(',', $subjects_without_repeting)));
                                str_replace(',' , '  ', $subjects_without_repeting);
                                
                                $grades_without_repeting = "$all_grades_unedited";
                                $grades_without_repeting = implode(',',array_unique(explode(',', $grades_without_repeting)));

                                if(strstr($grades_without_repeting,$students_grade)){
                                  echo " <option value='$teachers_fname_select $teachers_sname_select'>$subjects_without_repeting</option>";
                                }
                                
                                
                                //echo "<option value='$subjects_without_repeting'>$teachers_fname_select $teachers_sname_select</option>";
                                
                            }
                          }

                          
                    ?>
                      
                </datalist>
                
                
                
                <datalist id="grades_list">
                      <option value="grade_6">Grade 6</option>
                      <option value="grade_7">Grade 7</option>
                      <option value="grade_8">Grade 8</option>
                      <option value="grade_9">Grade 9</option>
                      <option value="OL">Ordinary Level</option>
                      <option value="AL">Advanced Level</option>
                </datalist>

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
                                  if($datas6[$c]["GRADE__$d"] == $students_grade){
                                    array_push($all_institutes,$datas6[$c]["INSTITUTE__$d"]);
                                  }
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
                
                      
                
                <!-- Search Ends Here -->
                

                
      
               
                <div class="col d-lg-flex d-none justify-content-end align-content-center">
                  <div class="LoggedOutHeaderLayout">
                    <div class="LoggedOutHeaderLayout__easelContainer">
                      <div class="EaselHeaderLayout">
                        <div class="EaselHeaderBespoke"><span class="Dropdown__button Dropdown__target EaselHeaderBespoke__button" aria-label="Easel" aria-pressed="false" tabindex="0" role="button">
                            <div class="EaselHeaderBespoke__buttonContent"><span class="label">
                                <div class="EaselHeaderBespoke__label"><a class="Anchor Anchor--green text-decoration-none" href="#" rel="noopener"><font style="font-size:18px;"><?php echo $students_full_name; ?>  &nbsp |</font></a></div>
                              </span></span></div>
                          </span>
                          <div class="EaselHeaderBespoke__content EaselHeaderBespoke--hidden">
                            <div class="ignore-react-onclickoutside">
                              <div class="EaselHeaderMenu">
                                <div class="EaselHeaderMenu__col EaselHeaderMenu__col--overview">
                                  <div class="EaselHeaderMenu__col--header">
                                    <div class="Text Text--bodySmall Text--colorTextPrimary">OVERVIEW</div>
                                    <div class="Divider Divider--gray">
                                      <div class="Divider__innerLine"></div>
                                      <div class="Divider__innerLine"></div>
                                    </div>
                                  </div>
                                  <div class="EaselHeaderMenu__col--body"><img src="./Mathamatics Worksheets &amp; Teaching Resources _ Teachers Pay Teachers_files/easel-by-tpt-logo.4hjhpy8bkc.svg" alt="edupara.lk" height="34" class="EaselHeaderMenu__easelLogo">
                                    <div class="Text Text--body Text--colorTextPrimary EaselHeaderMenu__col--text">
                                      Interactive resources you can assign in your digital classroom from TpT.</div><a class="Button-module__button--1wrl3 Button-module__kindPrimarySolid--10ZHm" target="_blank" href="#">
                                      <div class="Button-module__content--2Nnsd">
                                        <div class="">
                                          <div class="Button-module__center--3GGvH">Learn about Easel</div>
                                        </div>
                                      </div>
                                    </a>
                                  </div>
                                </div>
                                <div class="EaselHeaderMenu__col EaselHeaderMenu__col--tools">
                                  <div class="EaselHeaderMenu__col--header">
                                    <div class="Text Text--bodySmall Text--colorTextPrimary">TOOLS</div>
                                    <div class="Divider Divider--gray">
                                      <div class="Divider__innerLine"></div>
                                      <div class="Divider__innerLine"></div>
                                    </div>
                                  </div>
                                  <div class="EaselHeaderMenu__col--bodyTools">
                                    <div class="EaselHeaderMenu__subcol">
                                      <div class="EaselHeaderMenu__subcol--activities"><img src="./Mathamatics Worksheets &amp; Teaching Resources _ Teachers Pay Teachers_files/easel_activities_boxes.quhu4thi9k.svg" alt="" class="EaselHeaderMenu__icon">
                                        <div class="Text Text--bodyLarge Text--colorTextPrimary Text--strong EaselHeaderMenu__subcol--title">
                                          Easel Activities</div>
                                        <div class="Text Text--body Text--colorTextPrimary">Pre-made digital activities.
                                          Add highlights, virtual manipulatives, and more.</div>
                                      </div>
                                      <div class="EaselHeaderMenu__link"><a class="Anchor Anchor--green" href="https://www.teacherspayteachers.com/Browse/Format/Easel-Activity">Browse
                                          Easel Activities&nbsp;<span class="tpticon tpticon-long-arrow-right"></span></a></div>
                                    </div>
                                    <div class="EaselHeaderMenu__subcol">
                                      <div class="EaselHeaderMenu__subcol--assessments"><img src="./Mathamatics Worksheets &amp; Teaching Resources _ Teachers Pay Teachers_files/easel_assessments_boxes.putz37lmfo.svg" alt="" class="EaselHeaderMenu__icon">
                                        <div class="Text Text--bodyLarge Text--colorTextPrimary Text--strong EaselHeaderMenu__subcol--title">
                                          Easel Assessments</div>
                                        <div class="Text Text--body Text--colorTextPrimary">Quizzes with auto-grading,
                                          and real-time student data.</div>
                                      </div>
                                      <div class="EaselHeaderMenu__subcol--assessments EaselHeaderMenu__link"><a class="Anchor Anchor--green" target="_blank" href="https://www.teacherspayteachers.com/Browse/Format/Easel-Assessment" rel="noopener">Browse Easel Assessments&nbsp;<span class="tpticon tpticon-long-arrow-right"></span></a></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="LoggedOutHeaderLayout__linkContainer">
                    <span class="LoggedOutHeaderLayout__link"><a class="Anchor Anchor--black" href="../Register and login as a student/login.php?">Log out</a></span></div>
                    <div class="LoggedOutHeaderLayout__cartContainer">
                      <div class="HeaderCartBespoke"><span class="Dropdown__button Dropdown__target HeaderCartBespoke__button" aria-label="Cart" aria-pressed="false" tabindex="0" role="button">
                          
                            </span></span>
                          </div>
                        </span>
                        <div class="HeaderCartBespoke__content HeaderCartBespoke--hidden">
                          <div class="ignore-react-onclickoutside">
                            <div class="HeaderCartBespoke__dropdown">
                              <ul class="Menu HeaderCartBespoke__items"><span>Cart is empty</span></ul>
                              <div class="HeaderCartBespoke__total">Total:<div class="HeaderCartBespoke__totalPrice">
                                  <span>$0.00</span>
                                </div>
                              </div>
                              <div class="HeaderCartBespoke__footer"><a class="HeaderCartBespoke__viewWishList underlined" href="https://www.teacherspayteachers.com/Wish-List">View Wish List</a><span class="tpticon tpticon-angle-right HeaderCartBespoke__viewWishListIcon"></span><a class="Button-module__button--1wrl3 Button-module__kindPrimarySolid--10ZHm Button-module__xsmall--2aYDq HeaderCartBespoke__viewCart green cta" href="https://www.teacherspayteachers.com/Cart">
                                  <div class="Button-module__content--2Nnsd">
                                    <div class="Button-module__withTextCrop--2sotd">
                                      <div class="Button-module__center--3GGvH">View Cart</div>
                                    </div>
                                  </div>
                                </a></div>
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
        </div><img src="./Mathamatics Worksheets &amp; Teaching Resources _ Teachers Pay Teachers_files/tr" alt="" style="visibility:hidden" height="1" width="1">

        <!-- Your Location Begins -->
        <div class="NextSearchPage" data-testid="SearchPage">
          <div class="responsive">
            <div class="container container-lg-padded">
              <div class="row NextSearchPage__mainRow">
                <div class="col-xs-0 col-lg-3">
                  <div role="button" tabindex="0" class="d-lg-none" aria-label="Close"></div>
                  <div class="MobileSearchMenu MobileSearchMenu--withFlyout" data-testid="MobileSearchMenu">
                    <div class="MobileSearchMenu__menu">
                      <div class="SearchBreadcrumbsBox col-xs-12" data-step="4" data-intro="This is your location. All the ads will display according to this values." data-position="right">
                        <p class="SearchBreadcrumbsBox__title">Your Location:</p>
                        <div class="SearchBreadcrumbsBox__keywordSection">
                          <p class="SearchBreadcrumbsBox__keywordSectionTitle">District</p>
                          <p class="SelectedKeyword">

                            <select name="#" id="#" style="width:150px">
                              <option value=''>
                                  <?php
                                    echo $students_distrcict;
                                  ?>
                                </option>
                            </select>
                                      
                                     
                              
                            

                            <a aria-label="Remove" class="Anchor Anchor--green"></a>
                          </p>
                        </div>
                        <div class="SearchBreadcrumbsCoreStandardsContainer">
                          <p class="SearchBreadcrumbsCoreStandardsContainer__title">City</p>
                          <div class="SearchBreadcrumbsCoreStandardsContainer__grades"><a class="Anchor Anchor--black">
                              <p class="SelectedFacet">

                                <select name="#" id="#" style="width:150px">
                                  <option value="">
                                      <?php 
                                        if($students_city != NULL){
                                            echo $students_city;
                                          
                                          }else if($students_city == NULL){
                                            echo "All Cities in $students_distrcict";
                                          }
                                      ?>
                                           
                                  </option>
                                </select>


                              </p>
                            </a></div>
                        </div><button id="clear_location_filters" style="width: 150px; height:30px; background-color:#017BFF; color:white; font-size:.9rem; border-radius:5px" data-tooltip="Clear location filters to see all ads.">Clear Location Filters</button>&nbsp;&nbsp;<i class="fa fa-spinner fa-spin" style="display: none;" id="loading_animtion"></i>
                      </div>
                      <div class="d-md-none">
                        <div class="FilterMenuLayout">
                          <h4 class="Text-module__root--3lnrt Text-module__h6--3hkb0 FilterMenuLayout__title">Sort by
                          </h4>
                          <div class="MobileSearchMenu__sortOption"><label id="label_sort-Relevance" class="Label Label--inline Label--inlineAfter" for="sort-Relevance"><input type="radio" class="Radio" id="sort-Relevance" name="sortOrder" value="Relevance" checked=""><span class="Label__title">Relevance</span></label></div>
                          <div class="MobileSearchMenu__sortOption"><label id="label_sort-Rating" class="Label Label--inline Label--inlineAfter" for="sort-Rating"><input type="radio" class="Radio" id="sort-Rating" name="sortOrder" value="Rating"><span class="Label__title">Rating</span></label></div>
                          <div class="MobileSearchMenu__sortOption"><label id="label_sort-Price-Asc" class="Label Label--inline Label--inlineAfter" for="sort-Price-Asc"><input type="radio" class="Radio" id="sort-Price-Asc" name="sortOrder" value="Price-Asc"><span class="Label__title">Price (Ascending)</span></label></div>
                          <div class="MobileSearchMenu__sortOption"><label id="label_sort-Most-Recent" class="Label Label--inline Label--inlineAfter" for="sort-Most-Recent"><input type="radio" class="Radio" id="sort-Most-Recent" name="sortOrder" value="Most-Recent"><span class="Label__title">Most Recent</span></label></div>
                        </div>
                      </div>

                      <script>
                          var currunt_district = "<?php echo $students_distrcict; ?>";
                          var current_city = "<?php echo $students_city; ?>";
                          var original_district = "<?php echo $datas[0]['DISTRICT']; ?>";
                          var original_city = "<?php echo $datas[0]['CITY']; ?>";

                          if((currunt_district == original_district) && (current_city == original_city)){
                            $('#clear_location_filters').hide();
                          }
                          
                      </script>
                      <script>
                        $('#clear_location_filters').click(function() {
                          var students_distrcict = "<?php echo $datas[0]['DISTRICT']; ?>";
                          var student_city = "<?php echo $datas[0]['CITY']; ?>";
                          window.location.replace('Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?students_grade_from_filter=&How_classes_do=&subject=&City='+student_city+'&District='+students_distrcict);

                        });
                      </script>
                      <script>
                        $('#clear_location_filters').click(function(){
                          $('#loading_animtion').show();
                        });
                      </script>
                      
                      <!-- Your Location section ends  -->


                      <!-- video ad start here -->
                        <video id="video_src" width="100%" height="200" autoplay loop muted preload>
                          <source type="video/mp4" />
                        </video><br/><br><br>

                        <script>
                          function changeAd(){
                            var num = Math.floor((Math.random() * 3) + 1);
                            $(function(){
                              var a = $("#video_src").attr('src',"Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/Ads/ad"+num+".mp4");
                              
                            })
                            
                          }
                          setInterval(changeAd, 10000);

                        </script>
                      <!-- video ad ends here -->


                          



                      <!-- Formats Stars -->
                      <div class="SearchMenuFormatLayout" data-step="5" data-intro="Select the format you want to see ads. But we are still maintaining some filds at this moment">
                        <div class="FilterMenuLayout">
                          <h4 class="Text-module__root--3lnrt Text-module__h6--3hkb0 FilterMenuLayout__title">Formats
                          </h4>
                          <div class="SearchMenuCheckboxLayout">

                            <div class="SearchMenuCheckboxLayout__item"><label id="label_Format_Easel" class="Label Label--inline Label--inlineAfter" for="Format_Easel"><input type="checkbox" class="Checkbox" id="Format_Easel" name="Format_Easel" value="false" autocomplete="off" checked><span class="Label__title">Teachers</span></label></div>


                            <div class="SearchMenuCheckboxLayout__item"><label id="label_Format_Google" class="Label Label--inline Label--inlineAfter" for="Format_Google"><input type="checkbox" class="Checkbox" id="Format_Google" name="Format_Google" value="false" autocomplete="off"><span class="Label__title">Courses</span></label></div>


                            <div class="SearchMenuCheckboxLayout__item"><label id="label_Format_Pdf" class="Label Label--inline Label--inlineAfter" for="Format_Pdf"><input type="checkbox" class="Checkbox" id="Format_Pdf" name="Format_Pdf" value="false" autocomplete="off"><span class="Label__title">Institutes</span></label></div>
                          </div>
                          <div class="d-none d-lg-block SearchMenuFormatLayout__cols SearchMenuFormatLayout__cols200">
                            <div class="SubMenuPrefab SearchMenuFormatLayoutFlyout"><span class="Dropdown__button Dropdown__target SubMenuPrefab SearchMenuFormatLayoutFlyout__button" aria-pressed="false" tabindex="0" role="button">
                                <div class="SubMenuPrefab SearchMenuFormatLayoutFlyout__buttonContent"><span class="label">
                                    <div class="SubMenuPrefabLabelLayout" data-testid="SubMenuPrefabLabelLayout"><span class="label"></span><span class="SubMenuPrefab__icon"></div>
                                  </span></div>
                              </span>
                              <div class="SubMenuPrefab SearchMenuFormatLayoutFlyout__content SubMenuPrefab SearchMenuFormatLayoutFlyout--hidden">
                                <div class="ignore-react-onclickoutside">
                                  <div class="SearchMenuCheckboxLayout">
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_Format_Easel" class="Label Label--inline Label--inlineAfter" for="Format_Easel"><input type="checkbox" class="Checkbox" id="Format_Easel" name="Format_Easel" value="false" autocomplete="off"><span class="Label__title"><img src="./Mathamatics Worksheets &amp; Teaching Resources _ Teachers Pay Teachers_files/easel-by-tpt-black.ar8sgqb9xn.svg" alt="edupara.lk" style="height:14px"></span></label></div>
                                    <div class="SearchMenuCheckboxLayout__item SearchMenuCheckboxLayout__item--indent">
                                      <label id="label_Format_Easel_Activity" class="Label Label--inline Label--inlineAfter" for="Format_Easel_Activity"><input type="checkbox" class="Checkbox" id="Format_Easel_Activity" name="Format_Easel_Activity" value="false" autocomplete="off"><span class="Label__title">
                                          <div class="DigitalActivityBadge DigitalActivityBadge--small">
                                            <div class="Box Box--display-flex FlexBox--flexDirection-row FlexBox--flexWrap DigitalActivityBadge__flexWrapper">
                                              <div class="DigitalActivityBadge__section"><span class="Text Text--bodySmall Text--colorTextPrimary Text--inline Text--strong TpTEaselBadge" data-testid="tpt-easel-badge"><img class="TpTEaselLogo TpTEaselLogo__icon TpTEaselBadge__logo--withText" src="./Mathamatics Worksheets &amp; Teaching Resources _ Teachers Pay Teachers_files/tpt-easel-icon.atx6cuo0bp.svg" alt="edupara.lk"> <!-- -->Activities</span></div>
                                            </div>
                                          </div>
                                        </span></label>
                                    </div>
                                    <div class="SearchMenuCheckboxLayout__item SearchMenuCheckboxLayout__item--indent">
                                      <label id="label_Format_Easel_Assessment" class="Label Label--inline Label--inlineAfter" for="Format_Easel_Assessment"><input type="checkbox" class="Checkbox" id="Format_Easel_Assessment" name="Format_Easel_Assessment" value="false" autocomplete="off"><span class="Label__title">
                                          <div class="DigitalActivityBadge DigitalActivityBadge--small">
                                            <div class="Box Box--display-flex FlexBox--flexDirection-row FlexBox--flexWrap DigitalActivityBadge__flexWrapper">
                                              <div class="DigitalActivityBadge__section"><span class="Text Text--bodySmall Text--colorTextPrimary Text--inline Text--strong TpTEaselBadge" data-testid="tpt-easel-badge"><img class="TpTEaselLogo TpTEaselLogo__icon TpTEaselBadge__logo--withText" src="./Mathamatics Worksheets &amp; Teaching Resources _ Teachers Pay Teachers_files/tpt-easel-icon.atx6cuo0bp.svg" alt="edupara.lk"> <!-- -->Assessments</span></div>
                                            </div>
                                          </div>
                                        </span></label>
                                    </div>
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_Format_Google" class="Label Label--inline Label--inlineAfter" for="Format_Google"><input type="checkbox" class="Checkbox" id="Format_Google" name="Format_Google" value="false" autocomplete="off"><span class="Label__title">All Google
                                          Apps</span></label></div>
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_Format_Microsoft" class="Label Label--inline Label--inlineAfter" for="Format_Microsoft"><input type="checkbox" class="Checkbox" id="Format_Microsoft" name="Format_Microsoft" value="false" autocomplete="off"><span class="Label__title">All
                                          Microsoft</span></label></div>
                                    <div class="SearchMenuCheckboxLayout__item SearchMenuCheckboxLayout__item--indent">
                                      <label id="label_Format_Microsoft_Powerpoint" class="Label Label--inline Label--inlineAfter" for="Format_Microsoft_Powerpoint"><input type="checkbox" class="Checkbox" id="Format_Microsoft_Powerpoint" name="Format_Microsoft_Powerpoint" value="false" autocomplete="off"><span class="Label__title">Microsoft
                                          PowerPoint</span></label>
                                    </div>
                                    <div class="SearchMenuCheckboxLayout__item SearchMenuCheckboxLayout__item--indent">
                                      <label id="label_Format_Microsoft_Word" class="Label Label--inline Label--inlineAfter" for="Format_Microsoft_Word"><input type="checkbox" class="Checkbox" id="Format_Microsoft_Word" name="Format_Microsoft_Word" value="false" autocomplete="off"><span class="Label__title">Microsoft Word</span></label>
                                    </div>
                                    <div class="SearchMenuCheckboxLayout__item SearchMenuCheckboxLayout__item--indent">
                                      <label id="label_Format_Microsoft_Excel" class="Label Label--inline Label--inlineAfter" for="Format_Microsoft_Excel"><input type="checkbox" class="Checkbox" id="Format_Microsoft_Excel" name="Format_Microsoft_Excel" value="false" autocomplete="off"><span class="Label__title">Microsoft Excel</span></label>
                                    </div>
                                    <div class="SearchMenuCheckboxLayout__item SearchMenuCheckboxLayout__item--indent">
                                      <label id="label_Format_Microsoft_Publisher" class="Label Label--inline Label--inlineAfter" for="Format_Microsoft_Publisher"><input type="checkbox" class="Checkbox" id="Format_Microsoft_Publisher" name="Format_Microsoft_Publisher" value="false" autocomplete="off"><span class="Label__title">Microsoft
                                          Publisher</span></label>
                                    </div>
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_Format_Whiteboards" class="Label Label--inline Label--inlineAfter" for="Format_Whiteboards"><input type="checkbox" class="Checkbox" id="Format_Whiteboards" name="Format_Whiteboards" value="false" autocomplete="off"><span class="Label__title">All Interactive Whiteboards</span></label></div>
                                    <div class="SearchMenuCheckboxLayout__item SearchMenuCheckboxLayout__item--indent SearchMenuCheckboxLayout__item--caption">
                                      <label id="label_Format_Whiteboards_Notebook" class="Label Label--inline Label--inlineAfter" for="Format_Whiteboards_Notebook"><input type="checkbox" class="Checkbox" id="Format_Whiteboards_Notebook" name="Format_Whiteboards_Notebook" value="false" autocomplete="off"><span class="Label__title">SMART
                                          Notebook</span><span class="Label__caption">For SMART Board</span></label>
                                    </div>
                                    <div class="SearchMenuCheckboxLayout__item SearchMenuCheckboxLayout__item--indent SearchMenuCheckboxLayout__item--caption">
                                      <label id="label_Format_Whiteboards_Flipchart" class="Label Label--inline Label--inlineAfter" for="Format_Whiteboards_Flipchart"><input type="checkbox" class="Checkbox" id="Format_Whiteboards_Flipchart" name="Format_Whiteboards_Flipchart" value="false" autocomplete="off"><span class="Label__title">ActiveInspire
                                          Flipchart</span><span class="Label__caption">For Promethean
                                          Board</span></label>
                                    </div>
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_Format_Pdf" class="Label Label--inline Label--inlineAfter" for="Format_Pdf"><input type="checkbox" class="Checkbox" id="Format_Pdf" name="Format_Pdf" value="false" autocomplete="off"><span class="Label__title">PDF</span></label>
                                    </div>
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_Format_Images" class="Label Label--inline Label--inlineAfter" for="Format_Images"><input type="checkbox" class="Checkbox" id="Format_Images" name="Format_Images" value="false" autocomplete="off"><span class="Label__title">Image</span></label></div>
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_Format_Video" class="Label Label--inline Label--inlineAfter" for="Format_Video"><input type="checkbox" class="Checkbox" id="Format_Video" name="Format_Video" value="false" autocomplete="off"><span class="Label__title">Video</span></label></div>
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_Format_Audio" class="Label Label--inline Label--inlineAfter" for="Format_Audio"><input type="checkbox" class="Checkbox" id="Format_Audio" name="Format_Audio" value="false" autocomplete="off"><span class="Label__title">Audio</span></label></div>
                                    <div class="SearchMenuCheckboxLayout__item SearchMenuCheckboxLayout__item--caption">
                                      <label id="label_Format_Internetactivities" class="Label Label--inline Label--inlineAfter" for="Format_Internetactivities"><input type="checkbox" class="Checkbox" id="Format_Internetactivities" name="Format_Internetactivities" value="false" autocomplete="off"><span class="Label__title">Internet Activities</span><span class="Label__caption">e.g. Boom Cards</span></label>
                                    </div>
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_Format_Prezi" class="Label Label--inline Label--inlineAfter" for="Format_Prezi"><input type="checkbox" class="Checkbox" id="Format_Prezi" name="Format_Prezi" value="false" autocomplete="off"><span class="Label__title">Prezi</span></label></div>
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_Format_EBooks" class="Label Label--inline Label--inlineAfter" for="Format_EBooks"><input type="checkbox" class="Checkbox" id="Format_EBooks" name="Format_EBooks" value="false" autocomplete="off"><span class="Label__title">eBook</span></label></div>
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_Format_Fonts" class="Label Label--inline Label--inlineAfter" for="Format_Fonts"><input type="checkbox" class="Checkbox" id="Format_Fonts" name="Format_Fonts" value="false" autocomplete="off"><span class="Label__title">Fonts</span></label></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="SearchMenuSeeAll d-lg-none" role="button" tabindex="0" aria-label="See All Formats">
                            <div>See All Formats</div><span class="tpticon tpticon-angle-right"></span>
                          </div>
                        </div>
                        <div class="SearchMenuFormatLayout__sub d-lg-none">
                          <div class="FilterMenuLayout">
                            <h4 class="Text-module__root--3lnrt Text-module__h6--3hkb0 FilterMenuLayout__title">
                              <div class="SearchMenuBack" role="button" tabindex="0" aria-label="All Formats"><span class="tpticon tpticon-angle-left SearchMenuBack__icon"></span>
                                <div>All Formats</div>
                              </div>
                            </h4>
                            <div class="SearchMenuCheckboxLayout">
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_Format_Easel" class="Label Label--inline Label--inlineAfter" for="Format_Easel"><input type="checkbox" class="Checkbox" id="Format_Easel" name="Format_Easel" value="false" autocomplete="off"><span class="Label__title"><img src="./Mathamatics Worksheets &amp; Teaching Resources _ Teachers Pay Teachers_files/easel-by-tpt-black.ar8sgqb9xn.svg" alt="edupara.lk" style="height:14px"></span></label></div>
                              <div class="SearchMenuCheckboxLayout__item SearchMenuCheckboxLayout__item--indent"><label id="label_Format_Easel_Activity" class="Label Label--inline Label--inlineAfter" for="Format_Easel_Activity"><input type="checkbox" class="Checkbox" id="Format_Easel_Activity" name="Format_Easel_Activity" value="false" autocomplete="off"><span class="Label__title">
                                    <div class="DigitalActivityBadge DigitalActivityBadge--small">
                                      <div class="Box Box--display-flex FlexBox--flexDirection-row FlexBox--flexWrap DigitalActivityBadge__flexWrapper">
                                        <div class="DigitalActivityBadge__section"><span class="Text Text--bodySmall Text--colorTextPrimary Text--inline Text--strong TpTEaselBadge" data-testid="tpt-easel-badge"><img class="TpTEaselLogo TpTEaselLogo__icon TpTEaselBadge__logo--withText" src="./Mathamatics Worksheets &amp; Teaching Resources _ Teachers Pay Teachers_files/tpt-easel-icon.atx6cuo0bp.svg" alt="edupara.lk"> <!-- -->Activities</span></div>
                                      </div>
                                    </div>
                                  </span></label></div>
                              <div class="SearchMenuCheckboxLayout__item SearchMenuCheckboxLayout__item--indent"><label id="label_Format_Easel_Assessment" class="Label Label--inline Label--inlineAfter" for="Format_Easel_Assessment"><input type="checkbox" class="Checkbox" id="Format_Easel_Assessment" name="Format_Easel_Assessment" value="false" autocomplete="off"><span class="Label__title">
                                    <div class="DigitalActivityBadge DigitalActivityBadge--small">
                                      <div class="Box Box--display-flex FlexBox--flexDirection-row FlexBox--flexWrap DigitalActivityBadge__flexWrapper">
                                        <div class="DigitalActivityBadge__section"><span class="Text Text--bodySmall Text--colorTextPrimary Text--inline Text--strong TpTEaselBadge" data-testid="tpt-easel-badge"><img class="TpTEaselLogo TpTEaselLogo__icon TpTEaselBadge__logo--withText" src="./Mathamatics Worksheets &amp; Teaching Resources _ Teachers Pay Teachers_files/tpt-easel-icon.atx6cuo0bp.svg" alt="edupara.lk"> <!-- -->Assessments</span></div>
                                      </div>
                                    </div>
                                  </span></label></div>
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_Format_Google" class="Label Label--inline Label--inlineAfter" for="Format_Google"><input type="checkbox" class="Checkbox" id="Format_Google" name="Format_Google" value="false" autocomplete="off"><span class="Label__title">All Google
                                    Apps</span></label></div>
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_Format_Microsoft" class="Label Label--inline Label--inlineAfter" for="Format_Microsoft"><input type="checkbox" class="Checkbox" id="Format_Microsoft" name="Format_Microsoft" value="false" autocomplete="off"><span class="Label__title">All
                                    Microsoft</span></label></div>
                              <div class="SearchMenuCheckboxLayout__item SearchMenuCheckboxLayout__item--indent"><label id="label_Format_Microsoft_Powerpoint" class="Label Label--inline Label--inlineAfter" for="Format_Microsoft_Powerpoint"><input type="checkbox" class="Checkbox" id="Format_Microsoft_Powerpoint" name="Format_Microsoft_Powerpoint" value="false" autocomplete="off"><span class="Label__title">Microsoft PowerPoint</span></label>
                              </div>
                              <div class="SearchMenuCheckboxLayout__item SearchMenuCheckboxLayout__item--indent"><label id="label_Format_Microsoft_Word" class="Label Label--inline Label--inlineAfter" for="Format_Microsoft_Word"><input type="checkbox" class="Checkbox" id="Format_Microsoft_Word" name="Format_Microsoft_Word" value="false" autocomplete="off"><span class="Label__title">Microsoft Word</span></label></div>
                              <div class="SearchMenuCheckboxLayout__item SearchMenuCheckboxLayout__item--indent"><label id="label_Format_Microsoft_Excel" class="Label Label--inline Label--inlineAfter" for="Format_Microsoft_Excel"><input type="checkbox" class="Checkbox" id="Format_Microsoft_Excel" name="Format_Microsoft_Excel" value="false" autocomplete="off"><span class="Label__title">Microsoft Excel</span></label></div>
                              <div class="SearchMenuCheckboxLayout__item SearchMenuCheckboxLayout__item--indent"><label id="label_Format_Microsoft_Publisher" class="Label Label--inline Label--inlineAfter" for="Format_Microsoft_Publisher"><input type="checkbox" class="Checkbox" id="Format_Microsoft_Publisher" name="Format_Microsoft_Publisher" value="false" autocomplete="off"><span class="Label__title">Microsoft Publisher</span></label>
                              </div>
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_Format_Whiteboards" class="Label Label--inline Label--inlineAfter" for="Format_Whiteboards"><input type="checkbox" class="Checkbox" id="Format_Whiteboards" name="Format_Whiteboards" value="false" autocomplete="off"><span class="Label__title">All Interactive
                                    Whiteboards</span></label></div>
                              <div class="SearchMenuCheckboxLayout__item SearchMenuCheckboxLayout__item--indent SearchMenuCheckboxLayout__item--caption">
                                <label id="label_Format_Whiteboards_Notebook" class="Label Label--inline Label--inlineAfter" for="Format_Whiteboards_Notebook"><input type="checkbox" class="Checkbox" id="Format_Whiteboards_Notebook" name="Format_Whiteboards_Notebook" value="false" autocomplete="off"><span class="Label__title">SMART Notebook</span><span class="Label__caption">For SMART Board</span></label>
                              </div>
                              <div class="SearchMenuCheckboxLayout__item SearchMenuCheckboxLayout__item--indent SearchMenuCheckboxLayout__item--caption">
                                <label id="label_Format_Whiteboards_Flipchart" class="Label Label--inline Label--inlineAfter" for="Format_Whiteboards_Flipchart"><input type="checkbox" class="Checkbox" id="Format_Whiteboards_Flipchart" name="Format_Whiteboards_Flipchart" value="false" autocomplete="off"><span class="Label__title">ActiveInspire Flipchart</span><span class="Label__caption">For Promethean Board</span></label>
                              </div>
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_Format_Pdf" class="Label Label--inline Label--inlineAfter" for="Format_Pdf"><input type="checkbox" class="Checkbox" id="Format_Pdf" name="Format_Pdf" value="false" autocomplete="off"><span class="Label__title">PDF</span></label></div>
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_Format_Images" class="Label Label--inline Label--inlineAfter" for="Format_Images"><input type="checkbox" class="Checkbox" id="Format_Images" name="Format_Images" value="false" autocomplete="off"><span class="Label__title">Image</span></label>
                              </div>
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_Format_Video" class="Label Label--inline Label--inlineAfter" for="Format_Video"><input type="checkbox" class="Checkbox" id="Format_Video" name="Format_Video" value="false" autocomplete="off"><span class="Label__title">Video</span></label></div>
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_Format_Audio" class="Label Label--inline Label--inlineAfter" for="Format_Audio"><input type="checkbox" class="Checkbox" id="Format_Audio" name="Format_Audio" value="false" autocomplete="off"><span class="Label__title">Audio</span></label></div>
                              <div class="SearchMenuCheckboxLayout__item SearchMenuCheckboxLayout__item--caption"><label id="label_Format_Internetactivities" class="Label Label--inline Label--inlineAfter" for="Format_Internetactivities"><input type="checkbox" class="Checkbox" id="Format_Internetactivities" name="Format_Internetactivities" value="false" autocomplete="off"><span class="Label__title">Internet Activities</span><span class="Label__caption">e.g. Boom Cards</span></label></div>
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_Format_Prezi" class="Label Label--inline Label--inlineAfter" for="Format_Prezi"><input type="checkbox" class="Checkbox" id="Format_Prezi" name="Format_Prezi" value="false" autocomplete="off"><span class="Label__title">Prezi</span></label></div>
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_Format_EBooks" class="Label Label--inline Label--inlineAfter" for="Format_EBooks"><input type="checkbox" class="Checkbox" id="Format_EBooks" name="Format_EBooks" value="false" autocomplete="off"><span class="Label__title">eBook</span></label>
                              </div>
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_Format_Fonts" class="Label Label--inline Label--inlineAfter" for="Format_Fonts"><input type="checkbox" class="Checkbox" id="Format_Fonts" name="Format_Fonts" value="false" autocomplete="off"><span class="Label__title">Fonts</span></label></div>
                            </div>
                          </div>
                        </div>

                      </div>




                      <!--Grades Stars Over Here-->
                      <div class="SpecificGradesSearchContainer">
                        <div class="FilterMenuLayout">
                          <h4 class="Text-module__root--3lnrt Text-module__h6--3hkb0 FilterMenuLayout__title">Grades &nbsp  <i class="fa fa-spinner fa-pulse fa-3x fa-fw" style="visibility:hidden;" id="grades_loading_icon"></i>
                          </h4>
                          <div class="SpecificGradesMenuLayout">
                            <div class="SpecificGradesMenuLayout__mainGrades" data-step="6" data-intro="You can change your grade in here. BTW We have saved your grade in your account.">
                              <div class="SpecificGradesMenuLayout__mainGradeColumn" data-testid="SpecificGradesMenuLayout__mainGradeColumn">
                                <div class="SpecificGradeCheckbox">


                                  <div><label id="label_specific-grade-checkbox-Grades_Pre_K" class="Label Label--inline Label--inlineAfter" for="specific-grade-checkbox-Grades_Pre_K">

                                      <?php
                                      if ($students_grade == 'grade_1') {
                                        echo "<input type='radio' class='Checkbox' id='grade_1' name='specific-grade-checkbox' value='false' autocomplete='off' checked><span class='Label__title'><span>Grade 1</span></span>";
                                      } else {
                                        echo "<input type='radio' class='Checkbox' id='grade_1' name='specific-grade-checkbox' value='false' autocomplete='off'><span class='Label__title'><span>Grade 1</span></span>";
                                      }
                                      ?>

                                    </label>
                                  </div>

                                  <div><label id="label_specific-grade-checkbox-Grades_Kindergarten" class="Label Label--inline Label--inlineAfter" for="specific-grade-checkbox-Grades_Kindergarten">

                                      <?php
                                      if ($students_grade == 'grade_3') {
                                        echo "<input type='radio' class='Checkbox' id='grade_3' name='specific-grade-checkbox' value='false' autocomplete='off' checked><span class='Label__title'><span>Grade 3</span></span>";
                                      } else {
                                        echo "<input type='radio' class='Checkbox' id='grade_3' name='specific-grade-checkbox' value='false' autocomplete='off'><span class='Label__title'><span>Grade 3</span></span>";
                                      }
                                      ?>
                                    </label>
                                  </div>



                                  <div><label id="label_specific-grade-checkbox-Grades_First" class="Label Label--inline Label--inlineAfter" for="specific-grade-checkbox-Grades_First">
                                      <?php
                                      if ($students_grade == 'grade_5') {
                                        echo "<input type='radio' class='Checkbox' id='grade_5' name='specific-grade-checkbox' value='false' autocomplete='off' checked><span class='Label__title'><span>Grade 5</span></span>";
                                      } else {
                                        echo "<input type='radio' class='Checkbox' id='grade_5' name='specific-grade-checkbox' value='false' autocomplete='off'><span class='Label__title'><span>Grade 5</span></span>";
                                      }
                                      ?>
                                    </label>
                                  </div>


                                  <div><label id="label_specific-grade-checkbox-Grades_Second" class="Label Label--inline Label--inlineAfter" for="specific-grade-checkbox-Grades_Second">
                                      <?php
                                      if ($students_grade == 'grade_7') {
                                        echo "<input type='radio' class='Checkbox' id='grade_7' name='specific-grade-checkbox' value='false' autocomplete='off' checked><span class='Label__title'><span>Grade 7</span></span>";
                                      } else {
                                        echo "<input type='radio' class='Checkbox' id='grade_7' name='specific-grade-checkbox' value='false' autocomplete='off'><span class='Label__title'><span>Grade 7</span></span>";
                                      }
                                      ?>
                                    </label>
                                  </div>


                                  <div><label id="label_specific-grade-checkbox-Grades_Third" class="Label Label--inline Label--inlineAfter" for="specific-grade-checkbox-Grades_Third">
                                      <?php
                                      if ($students_grade == 'grade_9') {
                                        echo "<input type='radio' class='Checkbox' id='grade_9' name='specific-grade-checkbox' value='false' autocomplete='off' checked><span class='Label__title'><span>Grade 9</span></span>";
                                      } else {
                                        echo "<input type='radio' class='Checkbox' id='grade_9' name='specific-grade-checkbox' value='false' autocomplete='off'><span class='Label__title'><span>Grade 9</span></span>";
                                      }
                                      ?>
                                    </label>
                                  </div>


                                  <div><label id="label_specific-grade-checkbox-Grades_Fourth" class="Label Label--inline Label--inlineAfter" for="specific-grade-checkbox-Grades_Fourth">
                                      <?php
                                      if ($students_grade == 'AL') {
                                        echo "<input type='radio' class='Checkbox' id='AL' name='specific-grade-checkbox' value='false' autocomplete='off' checked><span class='Label__title'><span>A/L</span></span>";
                                      } else {
                                        echo "<input type='radio' class='Checkbox' id='AL' name='specific-grade-checkbox' value='false' autocomplete='off'><span class='Label__title'><span>A/L</span></span>";
                                      }
                                      ?>
                                    </label>
                                  </div>



                                </div>
                              </div>

                              


                              <div class="SpecificGradesMenuLayout__mainGradeColumn" data-testid="SpecificGradesMenuLayout__mainGradeColumn">
                                <div class="SpecificGradeCheckbox">


                                  <div><label id="label_specific-grade-checkbox-Grades_Sixth" class="Label Label--inline Label--inlineAfter" for="specific-grade-checkbox-Grades_Sixth">
                                      <?php
                                      if ($students_grade == 'grade_2') {
                                        echo "<input type='radio' class='Checkbox' id='grade_2' name='specific-grade-checkbox' value='false' autocomplete='off' checked><span class='Label__title'><span>Grade 2</span></span>";
                                      } else {
                                        echo "<input type='radio' class='Checkbox' id='grade_2' name='specific-grade-checkbox' value='false' autocomplete='off'><span class='Label__title'><span>Grade 2</span></span>";
                                      }
                                      ?>
                                    </label>
                                  </div>


                                  <div><label id="label_specific-grade-checkbox-Grades_Seventh" class="Label Label--inline Label--inlineAfter" for="specific-grade-checkbox-Grades_Seventh">
                                      <?php
                                      if ($students_grade == 'grade_4') {
                                        echo "<input type='radio' class='Checkbox' id='grade_4' name='specific-grade-checkbox' value='false' autocomplete='off' checked><span class='Label__title'><span>Grade 4</span></span>";
                                      } else {
                                        echo "<input type='radio' class='Checkbox' id='grade_4' name='specific-grade-checkbox' value='false' autocomplete='off'><span class='Label__title'><span>Grade 4</span></span>";
                                      }
                                      ?>
                                    </label>
                                  </div>


                                  <div><label id="label_specific-grade-checkbox-Grades_Eighth" class="Label Label--inline Label--inlineAfter" for="specific-grade-checkbox-Grades_Eighth">
                                      <?php
                                      if ($students_grade == 'grade_6') {
                                        echo "<input type='radio' class='Checkbox' id='grade_6' name='specific-grade-checkbox' value='false' autocomplete='off' checked><span class='Label__title'><span>Grade 6</span></span>";
                                      } else {
                                        echo "<input type='radio' class='Checkbox' id='grade_6' name='specific-grade-checkbox' value='false' autocomplete='off'><span class='Label__title'><span>Grade 6</span></span>";
                                      }
                                      ?>
                                    </label>
                                  </div>


                                  <div><label id="label_specific-grade-checkbox-Grades_Ninth" class="Label Label--inline Label--inlineAfter" for="specific-grade-checkbox-Grades_Ninth">
                                      <?php
                                      if ($students_grade == 'grade_8') {
                                        echo "<input type='radio' class='Checkbox' id='grade_8' name='specific-grade-checkbox' value='false' autocomplete='off' checked><span class='Label__title'><span>Grade 8</span></span>";
                                      } else {
                                        echo "<input type='radio' class='Checkbox' id='grade_8' name='specific-grade-checkbox' value='false' autocomplete='off'><span class='Label__title'><span>Grade 8</span></span>";
                                      }
                                      ?>
                                    </label>
                                  </div>

                                  <div><label id="label_specific-grade-checkbox-Grades_Tenth" class="Label Label--inline Label--inlineAfter" for="specific-grade-checkbox-Grades_Tenth">
                                      <?php
                                      if ($students_grade == 'OL') {
                                        echo "<input type='radio' class='Checkbox' id='OL' name='specific-grade-checkbox' value='false' autocomplete='off' checked><span class='Label__title'><span>O/L</span></span>";
                                      } else {
                                        echo "<input type='radio' class='Checkbox' id='OL' name='specific-grade-checkbox' value='false' autocomplete='off'><span class='Label__title'><span>O/L</span></span>";
                                      }
                                      ?>
                                    </label>
                                  </div>


                                  <div><label id="label_specific-grade-checkbox-Grades_Eleventh" class="Label Label--inline Label--inlineAfter" for="specific-grade-checkbox-Grades_Eleventh">
                                      <?php
                                      if ($students_grade == 'Other') {
                                        echo "<input type='radio' class='Checkbox' id='Other' name='specific-grade-checkbox' value='false' autocomplete='off' checked><span class='Label__title'><span>Other</span></span>";
                                      } else {
                                        echo "<input type='radio' class='Checkbox' id='Other' name='specific-grade-checkbox' value='false' autocomplete='off'><span class='Label__title'><span>Other</span></span>";
                                      }
                                      ?>
                                    </label>
                                  </div>
                                  



                                  <script>
                                    $('.Checkbox').change(function() {
                                      $("#grades_loading_icon").css('visibility','visible');
                                      if ($('#Other').is(':checked')) {
                                        alert('Other');

                                      } else if ($('#grade_1').is(':checked')) {
                                        window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?students_new_grade_from_filter=grade_1");

                                      } else if ($('#grade_2').is(':checked')) {
                                        window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?students_new_grade_from_filter=grade_2");

                                      } else if ($('#grade_3').is(':checked')) {
                                        window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?students_new_grade_from_filter=grade_3");

                                      } else if ($('#grade_4').is(':checked')) {
                                        window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?students_new_grade_from_filter=grade_4");

                                      } else if ($('#grade_5').is(':checked')) {
                                        window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?students_new_grade_from_filter=grade_5");

                                      } else if ($('#grade_6').is(':checked')) {
                                        window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?students_new_grade_from_filter=grade_6");

                                      } else if ($('#grade_7').is(':checked')) {
                                        window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?students_new_grade_from_filter=grade_7");

                                      } else if ($('#grade_8').is(':checked')) {
                                        window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?students_new_grade_from_filter=grade_8");

                                      } else if ($('#grade_9').is(':checked')) {
                                        window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?students_new_grade_from_filter=grade_9");

                                      } else if ($('#OL').is(':checked')) {
                                        window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?students_new_grade_from_filter=OL");

                                      } else if ($('#AL').is(':checked')) {
                                        window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?students_new_grade_from_filter=AL");

                                      }
                                    });
                                  </script>

                                  <!--End of Grades-->




                                </div>
                              </div>
                            </div>

                            <!-- Start of How_do_classes --><br/><br/>
                            <div class="SpecificGradesSearchContainer" style="width: 100%;" data-step="7" data-intro="If you want to Online classes only, Or Physical Classes only, Or Both only, Then use how class do filter.">
                              <div class="FilterMenuLayout">
                                <h4 class="Text-module__root--3lnrt Text-module__h6--3hkb0 FilterMenuLayout__title">How Class Do &nbsp <i class="fa fa-spinner fa-pulse fa-3x fa-fw" style="visibility:hidden;" id="how_do_class_loader"></i>
                                </h4>
                                <div class="SpecificGradesMenuLayout">
                                  <div class="SpecificGradesMenuLayout__mainGrades">
                                    <div class="SpecificGradesMenuLayout__mainGradeColumn" data-testid="SpecificGradesMenuLayout__mainGradeColumn">
                                      <div class="SpecificGradeCheckbox">


                                        <div><label class="Label Label--inline Label--inlineAfter" for="online">

                                            <input type='radio' class='Checkbox' id='online' name='how_do_class' value='false' autocomplete='off'><span class='Label__title'><span>Online</span></span>
                                          </label>
                                        </div>

                                        
                                        
                                        <div><label class="Label Label--inline Label--inlineAfter" for="physical">

                                            <input type='radio' class='Checkbox' id='physical' name='how_do_class' value='false' autocomplete='off'><span class='Label__title'><span>Physical</span></span>
                                          </label>
                                        </div>

                                        
                                        
                                        <div><label class="Label Label--inline Label--inlineAfter" for="both" data-tooltip="Note: If you apply both filter you only see the teachers who do classes Online as well as Physical.">

                                            <input type='radio' class='Checkbox' id='both' name='how_do_class' value='false' autocomplete='off'><span class='Label__title' style="width: 200px;"><span>Both (Online & Physical)</span></span>
                                          </label>
                                        </div>
                                    
                                    </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div></div></div></div>
                            <!-- I added more 3 div here. Delete them if you faced a trouble -->


                      <!-- <script>
                        $(document).ready(function(){
                            $("input[name='how_do_class']").change(function() {
                              if ($('#online').is(':checked')) {
                                alert('Online');
                                window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?students_new_grade_from_filter_2=<?php echo $students_new_grade; ?>&how_classes_do_from_filter=online");


                              } else if ($('#physical').is(':checked')) {
                                alert('physical');
                                window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?students_new_grade_from_filter_2=<?php echo $students_new_grade; ?>&how_classes_do_from_filter=physical");

                              } else if ($('#both').is(':checked')) {
                                alert('Both');
                                window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?students_new_grade_from_filter_2=<?php echo $students_new_grade; ?>&how_classes_do_from_filter=both");
                              }

                            });
                        });
                      </script> -->
                      <script>
                        var how_classes_do = "<?php echo $_GET['how_classes_do_from_filter']; ?>";

                        if (how_classes_do == 'online') {
                          $('#online').prop('checked', true);
                        } else if (how_classes_do == 'physical') {
                          $('#physical').prop('checked', true);
                        } else if (how_classes_do == 'both') {
                          $('#both').prop('checked', true);
                        }
                      </script>
                      <script>
                          
                          $("input[name='how_do_class']").click(function(){
                            $("#how_do_class_loader").css('visibility','visible');
                              if($('#online').is(':checked')) { 
                                //alert("it's online");
                                window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?students_new_grade_from_filter_2=<?php echo $students_grade; ?>&how_classes_do_from_filter=online");
                              
                              }else if($('#physical').is(':checked')){
                                window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?students_new_grade_from_filter_2=<?php echo $students_grade; ?>&how_classes_do_from_filter=physical"); 
                              
                              }else if($('#both').is(':checked')){
                                window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?students_new_grade_from_filter_2=<?php echo $students_grade; ?>&how_classes_do_from_filter=both");
                              }
                          });

                      </script>
                      <script>
                        $("input[name='how_do_class']").click(function(){
                            if($('#online').is(':checked')) { 
                              findout_If_A_SearchQuery_Is_Available_Or_Not_For_Online();
                            }else if($('#physical').is(':checked')){
                              findout_If_A_SearchQuery_Is_Available_Or_Not_For_Physical();
                            
                            }else if($('#both').is(':checked')){
                              findout_If_A_SearchQuery_Is_Available_Or_Not_For_Both();
                            }
                          });
                              
                            

                        
                        function findout_If_A_SearchQuery_Is_Available_Or_Not_For_Online(){
                            var searched_query = "<?php echo $_GET['Search_bar']?>";
                            var selected_category = "<?php echo $_GET['selected_category']?>";
                            if((searched_query != '') && (selected_category != '')){
                              window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?students_new_grade_from_filter_2=<?php echo $students_grade; ?>&how_classes_do_from_filter=online&selected_category="+ encodeURIComponent(selected_category) + "&Search_bar="+ encodeURIComponent(searched_query));
                            }
                        }

                        function findout_If_A_SearchQuery_Is_Available_Or_Not_For_Physical(){
                            var searched_query = "<?php echo $_GET['Search_bar']?>";
                            var selected_category = "<?php echo $_GET['selected_category']?>";
                            if((searched_query != '') && (selected_category != '')){
                              window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?students_new_grade_from_filter_2=<?php echo $students_grade; ?>&how_classes_do_from_filter=physical&selected_category="+ encodeURIComponent(selected_category) + "&Search_bar="+ encodeURIComponent(searched_query));
                            }
                        }

                        function findout_If_A_SearchQuery_Is_Available_Or_Not_For_Both(){
                            var searched_query = "<?php echo $_GET['Search_bar']?>";
                            var selected_category = "<?php echo $_GET['selected_category']?>";
                            if((searched_query != '') && (selected_category != '')){
                              window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?students_new_grade_from_filter_2=<?php echo $students_grade; ?>&how_classes_do_from_filter=both&selected_category="+ encodeURIComponent(selected_category) + "&Search_bar="+ encodeURIComponent(searched_query));
                            }
                        
                        }
                        


                      </script>
                      <!--End of How_do_classes-->

                      
                      <!-- Start of Subject Accoding to grade -->
                      <div class="EducationStandardsSearchContainer" data-step="8" data-intro="If you can't remember the subject, Then choose the Grade first and select subject secondly.">
                        <div class="FilterMenuLayout">
                          <h4 class="Text-module__root--3lnrt Text-module__h6--3hkb0 FilterMenuLayout__title">Subject According To Grade &nbsp <i class="fa fa-spinner fa-pulse fa-3x fa-fw" style="visibility:hidden;" id="subject_grade_loader"></i></h4>
                          <div class="EducationStandardsPickerLayout">
                            <div class="EducationStandardsPickerLayout__label"></div>
                            <div class="EducationStandardsPickerLayout__select">
                              <div class="EducationStandardsPickerLayout__selectGrade"><label class="visually-hidden" for="ELA-commonCoreGrade">Grade</label>
                                <div class="NativeSelectWrapper">

                                  <select name='grades' id='selectgrade' data-toggle='dropdown' class="NativeSelect">
                                    <!-- <option value='grade_5'>Grade 5</option> -->
                                    <option value="">Grade</option>
                                    <option value='grade_6'>Grade 6</option>
                                    <option value='grade_7'>Grade 7</option>
                                    <option value='grade_8'>Grade 8</option>
                                    <option value='grade_9'>Grade 9</option>
                                    <option value='OL'>O/L</option>
                                    <option value='AL'>A/L</option>

                                  </select>

                                </div>
                              </div>
                              <div class="EducationStandardsPickerLayout__selectDomain"><label class="visually-hidden" for="ELA-commonCoreDomain">Domain</label>
                                <div class="NativeSelectWrapper">
                                  <select name='Subject' id='selectSubjects' class="NativeSelect" disabled>
                                    <option value=""></option>
                                    <option data-value='grade_6' value='Buddhism'>Buddhism</option>
                                    <option data-value='grade_6' value='Christianity'>Christianity</option>
                                    <option data-value='grade_6' value='Catholic'>Catholic</option>
                                    <option data-value='grade_6' value='English Language'>English Language</option>
                                    <option data-value='grade_6' value='Science'>Science</option>
                                    <option data-value='grade_6' value='Geography'>Geography</option>
                                    <option data-value='grade_6' value='Dancing'>Dancing</option>
                                    <option data-value='grade_6' value='Western Music'>Western Music</option>
                                    <option data-value='grade_6' value='Drama & Theatre'>Drama & Theatre</option>
                                    <option data-value='grade_6' value='Health & Physical Education'>Health & Physical Education</option>
                                    <option data-value='grade_6' value='Shivenary'>Shivenary</option>
                                    <option data-value='grade_6' value='Sinhala Language'>Sinhala Language</option>
                                    <option data-value='grade_6' value='Mathematics'>Mathematics</option>
                                    <option data-value='grade_6' value='History'>History</option>
                                    <option data-value='grade_6' value='Life skills & Citizenshipn Education'>Life skills & Citizenshipn Education</option>
                                    <option data-value='grade_6' value='Eastern Music'>Eastern Music</option>
                                    <option data-value='grade_6' value='Art'>Art</option>
                                    <option data-value='grade_6' value='Practical & Technical Studies'>Practical & Technical Studies</option>
                                    <option data-value='grade_6' value='Tamil Language'>Tamil Language</option>



                                    <option data-value='grade_7' value='Buddhism'>Buddhism</option>
                                    <option data-value='grade_7' value='Christianity'>Christianity</option>
                                    <option data-value='grade_7' value='Catholic'>Catholic</option>
                                    <option data-value='grade_7' value='English Language'>English Language</option>
                                    <option data-value='grade_7' value='Science'>Science</option>
                                    <option data-value='grade_7' value='Geography'>Geography</option>
                                    <option data-value='grade_7' value='Dancing'>Dancing</option>
                                    <option data-value='grade_7' value='Western Music'>Western Music</option>
                                    <option data-value='grade_7' value='Drama & Theatre'>Drama & Theatre</option>
                                    <option data-value='grade_7' value='Health & Physical Education'>Health & Physical Education</option>
                                    <option data-value='grade_7' value='Shivenary'>Shivenary</option>
                                    <option data-value='grade_7' value='Sinhala Language'>Sinhala Language</option>
                                    <option data-value='grade_7' value='Mathematics'>Mathematics</option>
                                    <option data-value='grade_7' value='History'>History</option>
                                    <option data-value='grade_7' value='Life skills & Citizenshipn Education'>Life skills & Citizenshipn Education</option>
                                    <option data-value='grade_7' value='Eastern Music'>Eastern Music</option>
                                    <option data-value='grade_7' value='Art'>Art</option>
                                    <option data-value='grade_7' value='Practical & Technical Studies'>Practical & Technical Studies</option>
                                    <option data-value='grade_7' value='Tamil Language'>Tamil Language</option>


                                    <option data-value='grade_8' value='Buddhism'>Buddhism</option>
                                    <option data-value='grade_8' value='Christianity'>Christianity</option>
                                    <option data-value='grade_8' value='Catholic'>Catholic</option>
                                    <option data-value='grade_8' value='English Language'>English Language</option>
                                    <option data-value='grade_8' value='Science'>Science</option>
                                    <option data-value='grade_8' value='Geography'>Geography</option>
                                    <option data-value='grade_8' value='Dancing'>Dancing</option>
                                    <option data-value='grade_8' value='Western Music'>Western Music</option>
                                    <option data-value='grade_8' value='Drama & Theatre'>Drama & Theatre</option>
                                    <option data-value='grade_8' value='Health & Physical Education'>Health & Physical Education</option>
                                    <option data-value='grade_8' value='Shivenary'>Shivenary</option>
                                    <option data-value='grade_8' value='Sinhala Language'>Sinhala Language</option>
                                    <option data-value='grade_8' value='Mathematics'>Mathematics</option>
                                    <option data-value='grade_8' value='History'>History</option>
                                    <option data-value='grade_8' value='Life skills & Citizenshipn Education'>Life skills & Citizenshipn Education</option>
                                    <option data-value='grade_8' value='Eastern Music'>Eastern Music</option>
                                    <option data-value='grade_8' value='Art'>Art</option>
                                    <option data-value='grade_8' value='Practical & Technical Studies'>Practical & Technical Studies</option>
                                    <option data-value='grade_8' value='Tamil Language'>Tamil Language</option>



                                    <option data-value='grade_9' value='Buddhism'>Buddhism</option>
                                    <option data-value='grade_9' value='Christianity'>Christianity</option>
                                    <option data-value='grade_9' value='Catholic'>Catholic</option>
                                    <option data-value='grade_9' value='English Language'>English Language</option>
                                    <option data-value='grade_9' value='Science'>Science</option>
                                    <option data-value='grade_9' value='Geography'>Geography</option>
                                    <option data-value='grade_9' value='Dancing'>Dancing</option>
                                    <option data-value='grade_9' value='Western Music'>Western Music</option>
                                    <option data-value='grade_9' value='Drama & Theatre'>Drama & Theatre</option>
                                    <option data-value='grade_9' value='Health & Physical Education'>Health & Physical Education</option>
                                    <option data-value='grade_9' value='Shivenary'>Shivenary</option>
                                    <option data-value='grade_9' value='Sinhala Language'>Sinhala Language</option>
                                    <option data-value='grade_9' value='Mathematics'>Mathematics</option>
                                    <option data-value='grade_9' value='History'>History</option>
                                    <option data-value='grade_9' value='Life skills & Citizenshipn Education'>Life skills & Citizenshipn Education</option>
                                    <option data-value='grade_9' value='Eastern Music'>Eastern Music</option>
                                    <option data-value='grade_9' value='Art'>Art</option>
                                    <option data-value='grade_9' value='Practical & Technical Studies'>Practical & Technical Studies</option>
                                    <option data-value='grade_9' value='Tamil Language'>Tamil Language</option>



                                    <option data-value='OL' value='Buddhism'>Buddhism</option>
                                    <option data-value='OL' value='Christianity'>Christianity</option>
                                    <option data-value='OL' value='Catholism'>Catholism</option>
                                    <option data-value='OL' value='Islam'>Islam</option>
                                    <option data-value='OL' value='Sinhala Language & Literature'>Sinhala Language & Literature</option>
                                    <option data-value='OL' value='English'>English</option>
                                    <option data-value='OL' value='Mathematics'>Mathematics</option>
                                    <option data-value='OL' value='History'>History</option>
                                    <option data-value='OL' value='Science'>Science</option>
                                    <option data-value='OL' value='Geography'>Geography</option>
                                    <option data-value='OL' value='Citizenship Education'>Citizenship Education</option>
                                    <option data-value='OL' value='Enterpreneurial Education'>Enterpreneurial Education</option>
                                    <option data-value='OL' value='Business Studies & Accounts'>Business Studies & Accounts</option>
                                    <option data-value='OL' value='Eastern Music'>Eastern Music</option>
                                    <option data-value='OL' value='Western Music'>Western Music</option>
                                    <option data-value='OL' value='Art'>Art</option>
                                    <option data-value='OL' value='Traditional Dancing'>Traditional Dancing</option>
                                    <option data-value='OL' value='Sinhala Literature'>Sinhala Literature</option>
                                    <option data-value='OL' value='English Literature'>English Literature</option>
                                    <option data-value='OL' value='Information & Communication Technology'>Information & Communication Technology</option>
                                    <option data-value='OL' value='Agriculture & Food Technology'>Agriculture & Food Technology</option>
                                    <option data-value='OL' value='Art & Craft'>Art & Craft</option>
                                    <option data-value='OL' value='Home Economics'>Home Economics</option>
                                    <option data-value='OL' value='Health & Physical Education'>Health & Physical Education</option>





                                    <optgroup label='Technology stream' data-value='AL'>
                                      <option data-value='AL' value='SFT'>Science For Technology</option>
                                      <option data-value='AL' value='ET'>Engineering Technology</option>
                                      <option data-value='AL' value='ICT'>Information Communication Technology</option>
                                      <option data-value='AL' value='BST'>Bio System Technology</option>

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
                                </div>
                              </div>
                            </div>


                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

                            <script>
                              $(document).ready(function() {
                                var selectors = ['selectgrade', 'selectSubjects', 'selectSubjects2']
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

                            <script>
                              $('#selectgrade > option').click(function() {
                                $('#selectSubjects').prop('disabled', false);
                              });



                              $(document).ready(function() {
                                $('#selectSubjects').change(function() {
                                  var subject_name = $('#selectSubjects').find(":selected").val();
                                  var grade = $('#selectgrade').find(":selected").val();


                                  if (subject_name != '') {
                                    $("#subject_grade_loader").css('visibility','visible');
                                    var subject_name_encoded = encodeURIComponent(subject_name); //In here we are encoding the subject name because, when a subject name comes like "Sinhala & Lititure" because of the '&' mark, php thinks this is anoter variable too.
                                    window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?Grade_from_filer=" + grade + "&Subject_from_filter=" + subject_name_encoded);
                                  }

                                });
                              });
                            </script>

                            <script>
                              var already_selected_grade = "<?php echo $students_grade; ?>";
                              var already_selected_subject = "<?php echo $subject; ?>";


                              if ((already_selected_grade.length) && (already_selected_subject.length) > 0) {
                                for (var i = 1; i < $('#selectgrade > option').length + 1; i++) {
                                  //alert($('#selectgrade >option:nth-child(' +i +  ')').val());
                                  if ($('#selectgrade >option:nth-child(' + i + ')').val() == already_selected_grade) {
                                    $('#selectgrade >option:nth-child(' + i + ')').prop("selected", true);
                                  }
                                }
                                for (var j = 0; j < $('#selectSubjects > option').length; j++) {
                                  if ($('#selectSubjects >option:nth-child(' + j + ')').val() == already_selected_subject) {
                                    $('#selectSubjects >option:nth-child(' + j + ')').prop("selected", true);
                                  }
                                }
                              }
                            </script>
                            <br><br>
                          </div>
                        </div>
                      </div>







                      <!-- District and City Starts Here -->
                      <div class="EducationStandardsSearchContainer" data-step="9" data-intro="Chnage your district and city over here. But don't worry, You always can reset it to defults.">
                        <div class="FilterMenuLayout">
                          <h4 class="Text-module__root--3lnrt Text-module__h6--3hkb0 FilterMenuLayout__title">District And City </h4>
                          <div class="EducationStandardsPickerLayout">
                            <div class="EducationStandardsPickerLayout__label"></div>
                            <div class="EducationStandardsPickerLayout__select">
                              <div class="EducationStandardsPickerLayout__selectGrade"><label class="visually-hidden" for="ELA-commonCoreGrade">Grade</label>
                                <div class="NativeSelectWrapper">
                                  <form action="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?" method="POST">
                                    <select class="NativeSelect" id="Math-commonCoreGrade" name="district">

                                      <option value=''>District</option>
                                      <!-- <option data-value='online' value='Whole country'>Whole country</option> -->
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





                                    </select>
                                </div>
                              </div>
                              <div class="EducationStandardsPickerLayout__selectDomain"><label class="visually-hidden" for="Math-commonCoreDomain">Domain</label>
                                <div class="NativeSelectWrapper">
                                  <select name='' id='selected_nothing' class="NativeSelect">
                                    <option value='Everywhere'>Everywhere</option>
                                  </select>
                                  <select name='colombo' id='Cities_colombo' class="NativeSelect">
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

                                  <select name='mathara' id='Cities_mathara' class="NativeSelect">
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

                                  <select name='gampaha' id='Cities_gampha' class="NativeSelect">
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




                                  <select name='jaffna' id='Cities_jaffna' class="NativeSelect">
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

                                  <select name='kilinochchi' id='Cities_kilinochchi' class="NativeSelect">
                                    <option value='All Cities'>All Cities</option>
                                    <option value='Karadippokku'>Karadippokku</option>
                                    <option value='Kilinochchi'>Kilinochchi</option>
                                    <option value='Poonakary'>Poonakary</option>
                                  </select>
                                  </select>

                                  <select name='mannar' id='Cities_Mannar' class="NativeSelect">
                                    <option value='All Cities'>All Cities</option>
                                    <option value='Mannar'>Mannar</option>
                                    <option value='Murunkan'>Murunkan</option>
                                    <option value='Nanattan'>Nanattan</option>
                                  </select>

                                  <select name='mullativu' id='Cities_Mullaitivu' class="NativeSelect">
                                    <option value='1000117'>All Cities</option>
                                    <option value='Mankulam'>Mankulam</option>
                                    <option value='Pudukudiyirippu'>Pudukudiyirippu</option>
                                  </select>

                                  <select name='vavuniya' id='Cities_Vavuniya' class="NativeSelect">
                                    <option value='All Cities'>All Cities</option>
                                    <option value='Vavuniya'>Vavuniya</option>
                                  </select>
                                  </select>

                                  <select name='puttalam' id='Cities_Puttalam' class="NativeSelect">
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

                                  <select name='kurunegala' id='Cities_Kurunegala' class="NativeSelect">
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

                                  <select name='kaluthara' id='Cities_Kalutara' class="NativeSelect">
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

                                  <select name='anuradhapura' id='Cities_Anuradhapura' class="NativeSelect">
                                    <option value='All Cities'>All Cities</option>
                                    <option value='Anuradhapura'>Anuradhapura</option>
                                    <option value='Awukana'>Awukana</option>
                                    <option value='Kahatagasdigiliya'>Kahatagasdigiliya</option>
                                  </select>

                                  <select name='polonnaruwa' id='Cities_Polonnaruwa' class="NativeSelect">
                                    <option value='All Cities'>All Cities</option>
                                    <option value='Hingurakgoda'>Hingurakgoda</option>
                                    <option value='Polonnaruwa'>Polonnaruwa</option>
                                  </select>

                                  <select name='mathale' id='Cities_Matale' class="NativeSelect">
                                    <option value='All Cities'>All Cities</option>
                                    <option value='Dambulla'>Dambulla</option>
                                    <option value='Kaikawala'>Kaikawala</option>
                                    <option value='Matale'>Matale</option>
                                  </select>

                                  <select name='kandy' id='Cities_Kandy' class="NativeSelect">
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

                                  <select name='nuwaraeliya' id='Cities_Nuwara_Eliya' class="NativeSelect">
                                    <option value='All Cities'>All Cities</option>
                                    <option value='Bogawantalawa'>Bogawantalawa</option>
                                    <option value='Ginigathena'>Ginigathena</option>
                                    <option value='Hatton'>Hatton</option>
                                    <option value='Kotagala'>Kotagala</option>
                                    <option value='Kotmale'>Kotmale</option>
                                    <option value='Nuwara Eliya'>Nuwara Eliya</option>
                                  </select>

                                  <select name='kagalle' id='Cities_Kegalle' class="NativeSelect">
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

                                  <select name='ranthnapura' id='Cities_Ratnapura' class="NativeSelect">
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

                                  <select name='trincomalee' id='Cities_Trincomalee' class="NativeSelect">
                                    <option value='All Cities'>All Cities</option>
                                    <option value='Trincomalee'>Trincomalee</option>
                                  </select>

                                  <select name='batticaloa' id='Cities_Batticaloa' class="NativeSelect">
                                    <option value='All Cities'>All Cities</option>
                                    <option value='Batticaloa'>Batticaloa</option>
                                    <option value='Eravur'>Eravur</option>
                                    <option value='Kattankudi'>Kattankudi</option>
                                    <option value='Oddamavadi'>Oddamavadi</option>
                                    <option value='Pasikudah'>Pasikudah</option>
                                    <option value='Valaichenai'>Valaichenai</option>
                                  </select>

                                  <select name='ampara' id='Cities_Ampara' class="NativeSelect">
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

                                  <select name='badulla' id='Cities_Badulla' class="NativeSelect">
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

                                  <select name='monaragala' id='Cities_Monaragala' class="NativeSelect">
                                    <option value='All Cities'>All Cities</option>
                                    <option value='Bibile'>Bibile</option>
                                    <option value='Monaragala'>Monaragala</option>
                                  </select>

                                  <select name='hambanthota' id='Cities_Hambantota' class="NativeSelect">
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

                                  <select name='galle' id='Cities_Galle' class="NativeSelect">
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
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                          <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block" style="height: 30px; background-color:#017BFF; color:white; font-size:1.2rem; padding-bottom:25px;" data-tooltip="You need to press this button to apply filter" id="apply_location_filters_button"><i class="fa fa-spinner fa-pulse fa-3x fa-fw" style="display:none;" id="district_city_loader"></i> &nbsp Apply location filters</button>

                        </div>
                      </div>
                      </form>

                      <script>
                        $('#Math-commonCoreGrade').change(function() {
                          var seleted_option = $('#Math-commonCoreGrade :selected').val();

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


                          } else if (seleted_option == 'Mathara') {
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


                          } else if (seleted_option == 'Gampaha') {
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

                          } else if (seleted_option == 'Jaffna') {
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
                          } else if (seleted_option == 'Kilinochchi') {
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

                          } else if (seleted_option == 'Mannar') {
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

                          } else if (seleted_option == 'Mullaitivu') {
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

                          } else if (seleted_option == 'Vavuniya') {
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

                          } else if (seleted_option == 'Puttalam') {
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
                          } else if (seleted_option == 'Kurunegala') {
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
                          } else if (seleted_option == 'Kalutara') {
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
                          } else if (seleted_option == 'Anuradhapura') {
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
                          } else if (seleted_option == 'Polonnaruwa') {
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
                          } else if (seleted_option == 'Matale') {
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
                          } else if (seleted_option == 'Kandy') {
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
                          } else if (seleted_option == 'Nuwara Eliya') {
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
                          } else if (seleted_option == 'Kegalle') {
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
                          } else if (seleted_option == 'Ratnapura') {
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
                          } else if (seleted_option == 'Trincomalee') {
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
                          } else if (seleted_option == 'Batticaloa') {
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
                          } else if (seleted_option == 'Ampara') {
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
                          } else if (seleted_option == 'Badulla') {
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
                          } else if (seleted_option == 'Monaragala') {
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
                          } else if (seleted_option == 'Hambantota') {
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
                          } else if (seleted_option == 'Galle') {
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
                          } else if (seleted_option == 'Whole Country') {

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


                      <script>
                        $(document).ready(function() {
                          $('#Math-commonCoreGrade').change(function() {
                            var district = $('#Math-commonCoreGrade').find(":selected").val();
                            var city = $('#selectgrade').find(":selected").val();


                            // if(district != ''){
                            //     var subject_name_encoded = encodeURIComponent(subject_name); //In here we are encoding the subject name because, when a subject name comes like "Sinhala & Lititure" because of the '&' mark, php thinks this is anoter variable too.
                            //     window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?Grade_from_filer=" + grade + "&Subject_from_filter=" + subject_name_encoded);
                            // }

                          });
                        });
                      </script>

                      <!-- <script>
                            var student_district = "<?php echo $students_distrcict; ?>";
                            var student_city = "<?php echo $students_city; ?>";

                            if((student_district.length) && (student_city.length) > 0){
                              for(var i = 0; i < $('#Math-commonCoreGrade > option').length + 1; i++){
                                if($('#Math-commonCoreGrade > option:nth-child(' +i +  ')').text() == student_district){
                                    $('#Math-commonCoreGrade >option:nth-child(' +i +  ')').prop("selected", true);
                                }
                              }

                              for(var m = 0; m < $('.NativeSelect > option').length+1; m++){
                                if($('.NativeSelect > option:nth-child(' +i +  ')').val() == student_city){
                                    $('.NativeSelect >option:nth-child(' +i +  ')').prop("selected", true);
                                    alert(student_city);
                                }
                              }
                            }
                      </script> -->

                      <script>
                          $("#apply_location_filters_button").click(function(){
                              $("#district_city_loader").show();
                          });
                      </script>

                      <?php

                      if (isset($_POST['submit'])) {
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


                        $district = $_POST['district'];


                        $city = array();

                        array_push(
                          $city,
                          $colombo,
                          $mathara,
                          $gampaha,
                          $jaffna,
                          $kilinochchi,
                          $mannar,
                          $mullativu,
                          $vavuniya,
                          $puttalam,
                          $kurunegala,
                          $kaluthara,
                          $anuradhapura,
                          $polonnaruwa,
                          $mathale,
                          $kandy,
                          $nuwaraeliya,
                          $kagalle,
                          $ranthnapura,
                          $trincomalee,
                          $batticaloa,
                          $ampara,
                          $badulla,
                          $monaragala,
                          $hambanthota,
                          $galle
                        );

                        $city = array_diff($city, ['1000117', 'All Cities']);

                        $key = 0;
                        while ($element = current($city)) {
                          $key = key($city);
                          next($city);
                        }

                        //echo "<h2>".$city[$key];
                        $subject_encoded = urlencode($subject);
                        echo "<script>window.location.replace('Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?students_grade_from_filter=$students_grade&How_classes_do=$how_classes_do&subject=$subject_encoded&District=$district&City=$city[$key]');</script>";

                      }
                        
                  ?>







                      <!--class type Stars Over Here--><br /><br />
                      <div class="SpecificGradesSearchContainer" style="width: 100%;" data-step="10" data-intro="Change the class type here. Note : If you filter class type, Classes nearby your city and district only will appear.">
                        <div class="FilterMenuLayout">
                          <h4 class="Text-module__root--3lnrt Text-module__h6--3hkb0 FilterMenuLayout__title">Class Type &nbsp <i class="fa fa-spinner fa-pulse fa-3x fa-fw" style="visibility:hidden;" id="class_type_loader"></i>
                          </h4>
                          <div class="SpecificGradesMenuLayout">
                            <div class="SpecificGradesMenuLayout__mainGrades">
                              <div class="SpecificGradesMenuLayout__mainGradeColumn" data-testid="SpecificGradesMenuLayout__mainGradeColumn">
                                <div class="SpecificGradeCheckbox">


                                  <div><label class="Label Label--inline Label--inlineAfter" for="small_class">

                                      <input type='radio' class='Checkbox' id='small_class' name='class_type' value='false' autocomplete='off'><span class='Label__title' data-tooltip="Also known as Mass Class"><span>Small Class</span></span>
                                    </label>
                                  </div>


                                  <div><label class="Label Label--inline Label--inlineAfter" for="medium_class">

                                      <input type='radio' class='Checkbox' id='medium_class' name='class_type' value='false' autocomplete='off'><span class='Label__title' data-tooltip="Also known as Medium Group Class"><span>Group Class</span></span>
                                    </label>
                                  </div>


                                  <div><label class="Label Label--inline Label--inlineAfter" for="home_visit">

                                      <input type='radio' class='Checkbox' id='home_visit' name='class_type' value='false' autocomplete='off'><span class='Label__title'><span>Home Visit</span></span>
                                    </label>
                                  </div>

                                  <div><label class="Label Label--inline Label--inlineAfter" for="individual">

                                      <input type='radio' class='Checkbox' id='individual' name='class_type' value='false' autocomplete='off'><span class='Label__title'><span>Individual</span></span>
                                    </label>
                                  </div>

                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <script>
                        $('input[name=class_type]').change(function() {$("#class_type_loader").css('visibility','visible');

                          if ($('#small_class').is(':checked')) {
                            window.location.replace('Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?class_type_from_filter=Small Class (Mass Class)');

                          } else if ($('#medium_class').is(':checked')) {
                            window.location.replace('Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?class_type_from_filter=Medium Class (Group Class)');

                          } else if ($('#home_visit').is(':checked')) {
                            window.location.replace('Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?class_type_from_filter=Home Visit');

                          } else if ($('#individual').is(':checked')) {
                            window.location.replace('Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?class_type_from_filter=Individual');

                          }

                        });
                      </script>
                      
                      <script>
                              
                              $('input[name=class_type]').change(function() {
                                if ($('#small_class').is(':checked')) {
                                    findout_If_A_SearchQuery_Is_Available_Or_Not_For_small_class();
                                
                                }else if ($('#medium_class').is(':checked')) {
                                    findout_If_A_SearchQuery_Is_Available_Or_Not_For_meduim_class()
                                
                                }else if ($('#home_visit').is(':checked')) {
                                    findout_If_A_SearchQuery_Is_Available_Or_Not_For_home_visit();


                                }else if ($('#individual').is(':checked')) {
                                    findout_If_A_SearchQuery_Is_Available_Or_Not_For_individual();
                                
                                }

                              });
                                

                          
                              
                              function findout_If_A_SearchQuery_Is_Available_Or_Not_For_small_class(){
                                  var searched_query = "<?php echo $_GET['Search_bar']?>";
                                  var selected_category = "<?php echo $_GET['selected_category']?>";

                                  if((searched_query != '') && (selected_category != '')){
                                      window.location.replace('Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?class_type_from_filter=Small Class (Mass Class)&selected_category='+encodeURIComponent(selected_category)+'&Search_bar='+encodeURIComponent(searched_query));
                                    }
                              }

                              
                              function findout_If_A_SearchQuery_Is_Available_Or_Not_For_meduim_class(){
                                  var searched_query = "<?php echo $_GET['Search_bar']?>";
                                  var selected_category = "<?php echo $_GET['selected_category']?>";

                                  if((searched_query != '') && (selected_category != '')){
                                      window.location.replace('Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?class_type_from_filter=Medium Class (Group Class)&selected_category='+encodeURIComponent(selected_category)+'&Search_bar='+encodeURIComponent(searched_query));
                                    }
                              }

                              
                              function findout_If_A_SearchQuery_Is_Available_Or_Not_For_home_visit(){
                                  var searched_query = "<?php echo $_GET['Search_bar']?>";
                                  var selected_category = "<?php echo $_GET['selected_category']?>";

                                  if((searched_query != '') && (selected_category != '')){
                                      window.location.replace('Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?class_type_from_filter=Home Visit&selected_category='+encodeURIComponent(selected_category)+'&Search_bar='+encodeURIComponent(searched_query));
                                    }
                              }

                              
                              function findout_If_A_SearchQuery_Is_Available_Or_Not_For_individual(){
                                  var searched_query = "<?php echo $_GET['Search_bar']?>";
                                  var selected_category = "<?php echo $_GET['selected_category']?>";

                                  if((searched_query != '') && (selected_category != '')){
                                      window.location.replace('Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?class_type_from_filter=Individual&selected_category='+encodeURIComponent(selected_category)+'&Search_bar='+encodeURIComponent(searched_query));
                                    }
                              }
                                    
                                      

                                
                                      
                                      
                        </script>

                      <?php
                        if(isset($_GET['class_type_from_filter'])){
                          echo "<script>
                                      var class_type = '$class_type';
                                      if (class_type.length > 0) {
                                        if (class_type == 'Small Class (Mass Class)') {
                                          $('#small_class').prop('checked', true);
              
                                        } else if (class_type == 'Medium Class (Group Class)') {
                                          $('#medium_class').prop('checked', true);
              
                                        } else if (class_type == 'Home Visit') {
                                          $('#home_visit').prop('checked', true);
              
                                        } else if (class_type == 'Individual') {
                                          $('#individual').prop('checked', true);
                                        }
                                      }
                                </script>";
                        }
                        
                      ?>
                      

                      <!--End of Class Types-->





                      <!-- Languages Stars Here -->
                      <div class="FilterMenuLayout" data-step="11" data-intro="Change the Medium(Languages) You'd prefer to choose.">
                        <h4 class="Text-module__root--3lnrt Text-module__h6--3hkb0 FilterMenuLayout__title">Languages (Medium) &nbsp <i class="fa fa-spinner fa-pulse fa-3x fa-fw" style="visibility:hidden;" id="languages_loader"></i></h4>
                        <div class="SearchMenuCheckboxLayout" id="all_languages">
                        <form id="search_query_get_request" action="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?" method="GET">
                          <div class="SearchMenuCheckboxLayout__item"><label id="label_free" class="Label Label--inline Label--inlineAfter" for="Sinhala">
                          <input type="checkbox" class="Checkbox" id="sinhala" name="language[]" value="Sinhala"><span class="Label__title">Sinhala</span></label></div>
                          
                          <div class="SearchMenuCheckboxLayout__item"><label id="label_under_5" class="Label Label--inline Label--inlineAfter" for="English">
                          <input type="checkbox" class="Checkbox" id="english" name="language[]" value="English"><span class="Label__title">English</span></label></div>
                          
                          <div class="SearchMenuCheckboxLayout__item"><label id="label_5_to_10" class="Label Label--inline Label--inlineAfter" for="Tamil">
                          <input type="checkbox" class="Checkbox" id="tamil" name="language[]" value="Tamil"><span class="Label__title">Tamil</span></label></div>
                        </div><button type="submit" name = "apply_language_filters" class="btn btn-primary btn-lg btn-block" style="height: 30px; background-color:#017BFF; color:white; display:none;" id="main_language_filter_button">Apply Language filters</button>
                            
                        <input type="text" value="" name="selected_category" id="SelectedCategoryBypass" style="display: none;">
                        <input type="text" value="" name="Search_bar" id="SearchQueryBypass" style="display: none;">
                            
                      </form>
                      </div>

                      <script>
                          var sinhala_checked = false;
                          var english_checked = false;
                          var tamil_checked = false;
                          
                          
                          
                        $("#all_languages").change(function(){
                          $('#sinhala').click(function(){
                            if('#sinhala :checked'){
                                if(sinhala_checked === false){
                                  window.sinhala_checked = true;
                                  Checked_Languages(sinhala_checked,english_checked,tamil_checked);
                                  
                                  
                                }else{
                                  sinhala_checked = false;
                                }
                                
                                
                                
                            }
                          });

                          
                          $('#english').click(function(){
                            if('#english :checked'){
                                if(english_checked === false){
                                    english_checked = true;
                                    Checked_Languages(sinhala_checked,english_checked,tamil_checked);
                                  
                                  }else{
                                    english_checked = false;
                                  }
                                  
                              }
                          });

                          
                          
                          
                          $('#tamil').click(function(){
                            if('#tamil :checked'){
                                if(tamil_checked === false){
                                    tamil_checked = true;
                                    Checked_Languages(sinhala_checked,english_checked,tamil_checked);
                                  
                                  }else{
                                    tamil_checked = false;
                                  }
                                  
                              }
                          });

                          
                          function Checked_Languages(sinhala,english,tamil){
                              //window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?language="+sinhala+"&english="+english+"&tamil="+tamil);
                              // alert(sinhala);
                              // alert(english);
                              // alert(tamil);
                          }


                          
                          });
                      
                            
                      </script>
                      
                      <script>

                          function ClickFilterButton(){
                              $("#languages_loader").css('visibility','visible');
                              $("#main_language_filter_button").click();

                            }
                              
                            
                            $('#all_languages').change(function(){
                                setTimeout(ClickFilterButton,1000);
                            });
                        </script>
                        <script>
                              
                              $('#all_languages').change(function(){
                                  findout_If_A_SearchQuery_Is_Available_Or_Not();
                              });
                              
                              function findout_If_A_SearchQuery_Is_Available_Or_Not(){
                                  var searched_query = "<?php echo $_GET['Search_bar']?>";
                                  var selected_category = "<?php echo $_GET['selected_category']?>";

                                  if((searched_query != '') && (selected_category != '')){
                                    
                                        $("#SearchQueryBypass").attr('value',searched_query);
                                        $("#SelectedCategoryBypass").attr('value',selected_category);
                                      }
                                }
                                      
                                      
                                      
                        </script>

                              
                      <?php
                          if(isset($_GET['apply_language_filters']) && isset($_GET['language'])){
                              $languages = $_GET['language'];
                            
                              if(count($languages) > 0){

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


                                  
                                  $language_string = "$languages[0] / $languages[1] / $languages[2]";
                                  //echo $language_string;
                              }
                          }
                      
                      ?>
                      
                      <script>
                          var selectedLanguages = "<?php echo $language_string ?>";
                          

                          if(selectedLanguages != ''){
                              if(selectedLanguages.includes("Sinhala")){
                                  $('#sinhala').prop('checked',true);
                              }
                              
                              if(selectedLanguages.includes("English")){
                                  $('#english').prop('checked',true);
                              }

                              if(selectedLanguages.includes("Tamil")){
                                  $('#tamil').prop('checked',true);
                              }
                          }

                      </script>
                      <!-- Languages (Medium) Ends Here -->

                      <!-- Sponsers Advertisements Starts Here -->
                      <div class="SearchMenuResourceTypeLayout">
                        <div class="FilterMenuLayout">
                          <h4 class="Text-module__root--3lnrt Text-module__h6--3hkb0 FilterMenuLayout__title">Sponsers Advertisements</h4>
                          <div class="SearchMenuCheckboxLayout">
                              <!-- flipbox plugin starts here -->
                              <div class="item">
                                <div class="box" id="box5">
                                    <div class="side side1">&nbsp;</div>
                                    <div class="side side2">&nbsp;</div>
                                </div>
                              </div>  
                               
                              <script src="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/Flipbox plugin/src/jquery.flipbox.js"></script>
                              <script>
                                  // Dynamic content
                                    $('#box5').flipbox();
                                    var index = 0;
                                    var lorem = 'We Open For Ads'.split(' ');
                                    setInterval(function() {
                                        $('#box5').flipbox('replace', '<div class="side side1">' + (lorem[index % lorem.length]) + '</div>', 0);
                                        $('#box5').flipbox('replace', '<div class="side side2">' + (lorem[index % lorem.length]) + '</div>', 1);
                                        index++;
                                        if (index % lorem.length === 0) {
                                            $('#box5').flipbox('next');
                                        }
                                    }, 1000);
                            </script>
                              
                          </div>
                          
                          <!-- flipbox plugin ends here -->
                          <!-- Sponsers Advertisements Ends Here -->
                          
                          
                          <div class="d-none d-lg-block SearchMenuResourceTypeLayout__cols SearchMenuResourceTypeLayout__cols200">
                            <div class="SubMenuPrefab SearchMenuResourceTypeLayoutFlyout"><span class="Dropdown__button Dropdown__target SubMenuPrefab SearchMenuResourceTypeLayoutFlyout__button" aria-pressed="false" tabindex="0" role="button">
                                <div class="SubMenuPrefab SearchMenuResourceTypeLayoutFlyout__buttonContent"><span class="label">
                                    <div class="SubMenuPrefabLabelLayout" data-testid="SubMenuPrefabLabelLayout"><span class="label">See All Resource Types</span><span class="SubMenuPrefab__icon"><span class="tpticon tpticon-angle-right"></span></span></div>
                                  </span><span class="Dropdown__icon"><span class="tpticon tpticon-angle-down"></span></span></div>
                              </span>
                              <div class="SubMenuPrefab SearchMenuResourceTypeLayoutFlyout__content SubMenuPrefab SearchMenuResourceTypeLayoutFlyout--hidden">
                                <div class="ignore-react-onclickoutside">
                                  <div class="SearchMenuCheckboxLayout">
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Activities" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Activities"><input type="checkbox" class="Checkbox" id="ResourceTypes_Activities" name="ResourceTypes_Activities" value="false" autocomplete="off"><span class="Label__title">Activities</span></label></div>
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Assessment" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Assessment"><input type="checkbox" class="Checkbox" id="ResourceTypes_Assessment" name="ResourceTypes_Assessment" value="false" autocomplete="off"><span class="Label__title">Assessment</span></label></div>
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Classroom_Forms" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Classroom_Forms"><input type="checkbox" class="Checkbox" id="ResourceTypes_Classroom_Forms" name="ResourceTypes_Classroom_Forms" value="false" autocomplete="off"><span class="Label__title">Classroom
                                          Forms</span></label></div>
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_English_UK" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_English_UK"><input type="checkbox" class="Checkbox" id="ResourceTypes_English_UK" name="ResourceTypes_English_UK" value="false" autocomplete="off"><span class="Label__title">English (UK)</span></label>
                                    </div>
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_For_Parents" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_For_Parents"><input type="checkbox" class="Checkbox" id="ResourceTypes_For_Parents" name="ResourceTypes_For_Parents" value="false" autocomplete="off"><span class="Label__title">For Parents</span></label></div>
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_For_Principals_Administrators" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_For_Principals_Administrators"><input type="checkbox" class="Checkbox" id="ResourceTypes_For_Principals_Administrators" name="ResourceTypes_For_Principals_Administrators" value="false" autocomplete="off"><span class="Label__title">For Principals &amp;
                                          Administrators</span></label></div>
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Fun_Stuff" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Fun_Stuff"><input type="checkbox" class="Checkbox" id="ResourceTypes_Fun_Stuff" name="ResourceTypes_Fun_Stuff" value="false" autocomplete="off"><span class="Label__title">Fun Stuff</span></label></div>
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_GATE" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_GATE"><input type="checkbox" class="Checkbox" id="ResourceTypes_GATE" name="ResourceTypes_GATE" value="false" autocomplete="off"><span class="Label__title">GATE</span></label></div>
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Graphic_Organizers" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Graphic_Organizers"><input type="checkbox" class="Checkbox" id="ResourceTypes_Graphic_Organizers" name="ResourceTypes_Graphic_Organizers" value="false" autocomplete="off"><span class="Label__title">Graphic
                                          Organizers</span></label></div>
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Guided_Reading_Books" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Guided_Reading_Books"><input type="checkbox" class="Checkbox" id="ResourceTypes_Guided_Reading_Books" name="ResourceTypes_Guided_Reading_Books" value="false" autocomplete="off"><span class="Label__title">Guided Reading
                                          Books</span></label></div>
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Handouts" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Handouts"><input type="checkbox" class="Checkbox" id="ResourceTypes_Handouts" name="ResourceTypes_Handouts" value="false" autocomplete="off"><span class="Label__title">Handouts</span></label></div>
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Homeschool_Curricula" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Homeschool_Curricula"><input type="checkbox" class="Checkbox" id="ResourceTypes_Homeschool_Curricula" name="ResourceTypes_Homeschool_Curricula" value="false" autocomplete="off"><span class="Label__title">Homeschool
                                          Curricula</span></label></div>
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Homework" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Homework"><input type="checkbox" class="Checkbox" id="ResourceTypes_Homework" name="ResourceTypes_Homework" value="false" autocomplete="off"><span class="Label__title">Homework</span></label></div>
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Independent_Work_Packet" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Independent_Work_Packet"><input type="checkbox" class="Checkbox" id="ResourceTypes_Independent_Work_Packet" name="ResourceTypes_Independent_Work_Packet" value="false" autocomplete="off"><span class="Label__title">Independent Work
                                          Packet</span></label></div>
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Interactive_Notebooks" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Interactive_Notebooks"><input type="checkbox" class="Checkbox" id="ResourceTypes_Interactive_Notebooks" name="ResourceTypes_Interactive_Notebooks" value="false" autocomplete="off"><span class="Label__title">Interactive
                                          Notebooks</span></label></div>
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Lesson_Plans_Bundled" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Lesson_Plans_Bundled"><input type="checkbox" class="Checkbox" id="ResourceTypes_Lesson_Plans_Bundled" name="ResourceTypes_Lesson_Plans_Bundled" value="false" autocomplete="off"><span class="Label__title">Lesson Plans
                                          (Bundled)</span></label></div>
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Lesson_Plans_Individual" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Lesson_Plans_Individual"><input type="checkbox" class="Checkbox" id="ResourceTypes_Lesson_Plans_Individual" name="ResourceTypes_Lesson_Plans_Individual" value="false" autocomplete="off"><span class="Label__title">Lesson Plans
                                          (Individual)</span></label></div>
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Literacy_Center_Ideas" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Literacy_Center_Ideas"><input type="checkbox" class="Checkbox" id="ResourceTypes_Literacy_Center_Ideas" name="ResourceTypes_Literacy_Center_Ideas" value="false" autocomplete="off"><span class="Label__title">Literacy Center
                                          Ideas</span></label></div>
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Math_Centers" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Math_Centers"><input type="checkbox" class="Checkbox" id="ResourceTypes_Math_Centers" name="ResourceTypes_Math_Centers" value="false" autocomplete="off"><span class="Label__title">Math
                                          Centers</span></label></div>
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Minilessons" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Minilessons"><input type="checkbox" class="Checkbox" id="ResourceTypes_Minilessons" name="ResourceTypes_Minilessons" value="false" autocomplete="off"><span class="Label__title">Minilessons</span></label></div>
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Nonfiction_Book_Study" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Nonfiction_Book_Study"><input type="checkbox" class="Checkbox" id="ResourceTypes_Nonfiction_Book_Study" name="ResourceTypes_Nonfiction_Book_Study" value="false" autocomplete="off"><span class="Label__title">Nonfiction Book
                                          Study</span></label></div>
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Novel_Study" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Novel_Study"><input type="checkbox" class="Checkbox" id="ResourceTypes_Novel_Study" name="ResourceTypes_Novel_Study" value="false" autocomplete="off"><span class="Label__title">Novel Study</span></label></div>
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Printables" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Printables"><input type="checkbox" class="Checkbox" id="ResourceTypes_Printables" name="ResourceTypes_Printables" value="false" autocomplete="off"><span class="Label__title">Printables</span></label></div>
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Professional_Development" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Professional_Development"><input type="checkbox" class="Checkbox" id="ResourceTypes_Professional_Development" name="ResourceTypes_Professional_Development" value="false" autocomplete="off"><span class="Label__title">Professional
                                          Development</span></label></div>
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Professional_Documents" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Professional_Documents"><input type="checkbox" class="Checkbox" id="ResourceTypes_Professional_Documents" name="ResourceTypes_Professional_Documents" value="false" autocomplete="off"><span class="Label__title">Professional
                                          Documents</span></label></div>
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Projects" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Projects"><input type="checkbox" class="Checkbox" id="ResourceTypes_Projects" name="ResourceTypes_Projects" value="false" autocomplete="off"><span class="Label__title">Projects</span></label></div>
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Research" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Research"><input type="checkbox" class="Checkbox" id="ResourceTypes_Research" name="ResourceTypes_Research" value="false" autocomplete="off"><span class="Label__title">Research</span></label></div>
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Task_Cards" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Task_Cards"><input type="checkbox" class="Checkbox" id="ResourceTypes_Task_Cards" name="ResourceTypes_Task_Cards" value="false" autocomplete="off"><span class="Label__title">Task Cards</span></label></div>
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Test_Prep" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Test_Prep"><input type="checkbox" class="Checkbox" id="ResourceTypes_Test_Prep" name="ResourceTypes_Test_Prep" value="false" autocomplete="off"><span class="Label__title">Test Prep</span></label></div>
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Unit_Plans" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Unit_Plans"><input type="checkbox" class="Checkbox" id="ResourceTypes_Unit_Plans" name="ResourceTypes_Unit_Plans" value="false" autocomplete="off"><span class="Label__title">Unit Plans</span></label></div>
                                    <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Worksheets" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Worksheets"><input type="checkbox" class="Checkbox" id="ResourceTypes_Worksheets" name="ResourceTypes_Worksheets" value="false" autocomplete="off"><span class="Label__title">Worksheets</span></label></div>
                                  </div>
                                  <div class="Box SearchMenuResourceTypeLayout__note">
                                    <div class="Text Text--bodySmall Text--colorTextPrimary Text--strong">Don't see what
                                      you looking for?</div>
                                    <div class="Text Text--bodySmall Text--colorTextPrimary">Some filters moved to
                                      Formats filters, which is at the top of the page.</div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="SearchMenuSeeAll d-lg-none" role="button" tabindex="0" aria-label="See All Resource Types">
                            <div>See All Resource Types</div><span class="tpticon tpticon-angle-right"></span>
                          </div>
                        </div>
                        <div class="SearchMenuResourceTypeLayout__sub d-lg-none">
                          <div class="FilterMenuLayout">
                            <h4 class="Text-module__root--3lnrt Text-module__h6--3hkb0 FilterMenuLayout__title">
                              <div class="SearchMenuBack" role="button" tabindex="0" aria-label="All Resource Types">
                                <span class="tpticon tpticon-angle-left SearchMenuBack__icon"></span>
                                <div>All Resource Types</div>
                              </div>
                            </h4>
                            <div class="SearchMenuCheckboxLayout">
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Activities" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Activities"><input type="checkbox" class="Checkbox" id="ResourceTypes_Activities" name="ResourceTypes_Activities" value="false" autocomplete="off"><span class="Label__title">Activities</span></label></div>
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Assessment" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Assessment"><input type="checkbox" class="Checkbox" id="ResourceTypes_Assessment" name="ResourceTypes_Assessment" value="false" autocomplete="off"><span class="Label__title">Assessment</span></label></div>
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Classroom_Forms" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Classroom_Forms"><input type="checkbox" class="Checkbox" id="ResourceTypes_Classroom_Forms" name="ResourceTypes_Classroom_Forms" value="false" autocomplete="off"><span class="Label__title">Classroom
                                    Forms</span></label></div>
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_English_UK" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_English_UK"><input type="checkbox" class="Checkbox" id="ResourceTypes_English_UK" name="ResourceTypes_English_UK" value="false" autocomplete="off"><span class="Label__title">English (UK)</span></label></div>
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_For_Parents" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_For_Parents"><input type="checkbox" class="Checkbox" id="ResourceTypes_For_Parents" name="ResourceTypes_For_Parents" value="false" autocomplete="off"><span class="Label__title">For Parents</span></label></div>
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_For_Principals_Administrators" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_For_Principals_Administrators"><input type="checkbox" class="Checkbox" id="ResourceTypes_For_Principals_Administrators" name="ResourceTypes_For_Principals_Administrators" value="false" autocomplete="off"><span class="Label__title">For Principals &amp;
                                    Administrators</span></label></div>
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Fun_Stuff" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Fun_Stuff"><input type="checkbox" class="Checkbox" id="ResourceTypes_Fun_Stuff" name="ResourceTypes_Fun_Stuff" value="false" autocomplete="off"><span class="Label__title">Fun Stuff</span></label></div>
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_GATE" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_GATE"><input type="checkbox" class="Checkbox" id="ResourceTypes_GATE" name="ResourceTypes_GATE" value="false" autocomplete="off"><span class="Label__title">GATE</span></label>
                              </div>
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Graphic_Organizers" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Graphic_Organizers"><input type="checkbox" class="Checkbox" id="ResourceTypes_Graphic_Organizers" name="ResourceTypes_Graphic_Organizers" value="false" autocomplete="off"><span class="Label__title">Graphic
                                    Organizers</span></label></div>
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Guided_Reading_Books" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Guided_Reading_Books"><input type="checkbox" class="Checkbox" id="ResourceTypes_Guided_Reading_Books" name="ResourceTypes_Guided_Reading_Books" value="false" autocomplete="off"><span class="Label__title">Guided Reading
                                    Books</span></label></div>
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Handouts" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Handouts"><input type="checkbox" class="Checkbox" id="ResourceTypes_Handouts" name="ResourceTypes_Handouts" value="false" autocomplete="off"><span class="Label__title">Handouts</span></label></div>
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Homeschool_Curricula" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Homeschool_Curricula"><input type="checkbox" class="Checkbox" id="ResourceTypes_Homeschool_Curricula" name="ResourceTypes_Homeschool_Curricula" value="false" autocomplete="off"><span class="Label__title">Homeschool
                                    Curricula</span></label></div>
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Homework" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Homework"><input type="checkbox" class="Checkbox" id="ResourceTypes_Homework" name="ResourceTypes_Homework" value="false" autocomplete="off"><span class="Label__title">Homework</span></label></div>
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Independent_Work_Packet" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Independent_Work_Packet"><input type="checkbox" class="Checkbox" id="ResourceTypes_Independent_Work_Packet" name="ResourceTypes_Independent_Work_Packet" value="false" autocomplete="off"><span class="Label__title">Independent Work Packet</span></label></div>
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Interactive_Notebooks" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Interactive_Notebooks"><input type="checkbox" class="Checkbox" id="ResourceTypes_Interactive_Notebooks" name="ResourceTypes_Interactive_Notebooks" value="false" autocomplete="off"><span class="Label__title">Interactive
                                    Notebooks</span></label></div>
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Lesson_Plans_Bundled" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Lesson_Plans_Bundled"><input type="checkbox" class="Checkbox" id="ResourceTypes_Lesson_Plans_Bundled" name="ResourceTypes_Lesson_Plans_Bundled" value="false" autocomplete="off"><span class="Label__title">Lesson Plans
                                    (Bundled)</span></label></div>
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Lesson_Plans_Individual" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Lesson_Plans_Individual"><input type="checkbox" class="Checkbox" id="ResourceTypes_Lesson_Plans_Individual" name="ResourceTypes_Lesson_Plans_Individual" value="false" autocomplete="off"><span class="Label__title">Lesson Plans (Individual)</span></label></div>
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Literacy_Center_Ideas" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Literacy_Center_Ideas"><input type="checkbox" class="Checkbox" id="ResourceTypes_Literacy_Center_Ideas" name="ResourceTypes_Literacy_Center_Ideas" value="false" autocomplete="off"><span class="Label__title">Literacy Center
                                    Ideas</span></label></div>
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Math_Centers" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Math_Centers"><input type="checkbox" class="Checkbox" id="ResourceTypes_Math_Centers" name="ResourceTypes_Math_Centers" value="false" autocomplete="off"><span class="Label__title">Math Centers</span></label></div>
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Minilessons" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Minilessons"><input type="checkbox" class="Checkbox" id="ResourceTypes_Minilessons" name="ResourceTypes_Minilessons" value="false" autocomplete="off"><span class="Label__title">Minilessons</span></label></div>
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Nonfiction_Book_Study" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Nonfiction_Book_Study"><input type="checkbox" class="Checkbox" id="ResourceTypes_Nonfiction_Book_Study" name="ResourceTypes_Nonfiction_Book_Study" value="false" autocomplete="off"><span class="Label__title">Nonfiction Book
                                    Study</span></label></div>
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Novel_Study" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Novel_Study"><input type="checkbox" class="Checkbox" id="ResourceTypes_Novel_Study" name="ResourceTypes_Novel_Study" value="false" autocomplete="off"><span class="Label__title">Novel Study</span></label></div>
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Printables" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Printables"><input type="checkbox" class="Checkbox" id="ResourceTypes_Printables" name="ResourceTypes_Printables" value="false" autocomplete="off"><span class="Label__title">Printables</span></label></div>
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Professional_Development" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Professional_Development"><input type="checkbox" class="Checkbox" id="ResourceTypes_Professional_Development" name="ResourceTypes_Professional_Development" value="false" autocomplete="off"><span class="Label__title">Professional Development</span></label></div>
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Professional_Documents" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Professional_Documents"><input type="checkbox" class="Checkbox" id="ResourceTypes_Professional_Documents" name="ResourceTypes_Professional_Documents" value="false" autocomplete="off"><span class="Label__title">Professional Documents</span></label></div>
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Projects" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Projects"><input type="checkbox" class="Checkbox" id="ResourceTypes_Projects" name="ResourceTypes_Projects" value="false" autocomplete="off"><span class="Label__title">Projects</span></label></div>
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Research" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Research"><input type="checkbox" class="Checkbox" id="ResourceTypes_Research" name="ResourceTypes_Research" value="false" autocomplete="off"><span class="Label__title">Research</span></label></div>
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Task_Cards" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Task_Cards"><input type="checkbox" class="Checkbox" id="ResourceTypes_Task_Cards" name="ResourceTypes_Task_Cards" value="false" autocomplete="off"><span class="Label__title">Task Cards</span></label></div>
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Test_Prep" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Test_Prep"><input type="checkbox" class="Checkbox" id="ResourceTypes_Test_Prep" name="ResourceTypes_Test_Prep" value="false" autocomplete="off"><span class="Label__title">Test Prep</span></label></div>
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Unit_Plans" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Unit_Plans"><input type="checkbox" class="Checkbox" id="ResourceTypes_Unit_Plans" name="ResourceTypes_Unit_Plans" value="false" autocomplete="off"><span class="Label__title">Unit Plans</span></label></div>
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_ResourceTypes_Worksheets" class="Label Label--inline Label--inlineAfter" for="ResourceTypes_Worksheets"><input type="checkbox" class="Checkbox" id="ResourceTypes_Worksheets" name="ResourceTypes_Worksheets" value="false" autocomplete="off"><span class="Label__title">Worksheets</span></label></div>
                            </div>
                            <div class="Box SearchMenuResourceTypeLayout__note">
                              <div class="Text Text--bodySmall Text--colorTextPrimary Text--strong">Don't see what you
                                looking for?</div>
                              <div class="Text Text--bodySmall Text--colorTextPrimary">Some filters moved to Formats
                                filters, which is at the top of the page.</div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                <!-- how many results starts here (jquey code below to main ad grid)-->
                <div class="col-xs-12 col-lg-9">
                  <div class="Box Box--margin-bottom-md">
                    <div class="SearchResultsHeader">
                      <div class="ResultsForSearchResultHeader">
                        <span class="ResultsForSearchResultHeader__result">Results for
                          <h1 class="ResultsForSearchResultHeader__keywords" id="keyword"></h1></span>
                          <span class="ResultsForSearchResultHeader__count" id="results_shower"></h1></span>
                        </span></div>
                        

                <script>
                    if(searched_query.length > 0){
                      $("#keyword").text(searched_query);
                    }
                </script>
                <script>
                  $(function(){
                    
                  });
                </script>
                <?php
                    if(empty($_GET['selected_category']) && empty($_GET['Search_bar'])){
                      echo "<script>$('.ResultsForSearchResultHeader__result').text('All Relavance');</script>";
                      
                    }
                ?>
            <!-- how many results ends here    -->



                    
                    

                      
                        
                      
                      
                      
                      
                      <div class="SearchResultsHeader__sort">
                        <div class="SearchResultsHeader__headerSort d-none d-md-inline"><span class="SearchResultsHeader__headerLabel">Sort By:</span>
                          <!-- <div class="SearchResultsHeader__headerSortDropdown"><span class="Dropdown__button Dropdown__target SearchResultsHeader__headerSortDropdown__button" aria-label="Sort by" aria-pressed="false" tabindex="0" role="button">
                              <div class="SearchResultsHeader__headerSortDropdown__buttonContent"><span class="label">Relevance</span><span class="Dropdown__icon"><span class="tpticon tpticon-angle-down"></span></span></div>
                            </span>
                            <div class="SearchResultsHeader__headerSortDropdown__content SearchResultsHeader__headerSortDropdown--hidden">
                              <div class="ignore-react-onclickoutside">
                                <ul class="Menu">
                                  <li role="button" tabindex="0" aria-pressed="true" data-value="Relevance" class="MenuItem selected" selected=""><span class="MenuItem__label">Relevance</span><span class="tpticon tpticon-check MenuItem__check"></span></li>
                                  <li role="button" tabindex="0" aria-pressed="false" data-value="Rating" class="MenuItem"><span class="MenuItem__label">Rating</span></li>
                                  <li role="button" tabindex="0" aria-pressed="false" data-value="Price-Asc" class="MenuItem"><span class="MenuItem__label">Price (Ascending)</span></li>
                                  <li role="button" tabindex="0" aria-pressed="false" data-value="Most-Recent" class="MenuItem"><span class="MenuItem__label">Most Recent</span></li>
                                </ul>
                              </div>
                              
                              
                            
                            </div>
                          </div> -->
                          
                          <select disabled name="" id="sort_by_dropdown" class="Menu" style="width: 120px; padding: 12px 16px;  background-color: #f9f9f9; ">
                              <option value="optimized" class="MenuItem" id="optimized">Optimized</option>
                              <option value="ascending" class="MenuItem" id="ascending">ascending</option>
                              <option value="descending" class="MenuItem" id="descending">descending</option>
                              <option value="" class="MenuItem">option 04</option>
                              <option value="" class="MenuItem">option 05</option>
                              <option value="" class="MenuItem">option 06</option>
                          </select>
                              
                        </div>

                        <script>
                            
                              $("#sort_by_dropdown").change(function(){
                                if($("#optimized").is(':selected')){
                                    $sorting = "";
                                
                                }else if($("#ascending").is(':selected')){
                                    window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?SubjectAsc=true");
                                
                                }else if($("#descending").is(':selected')){
                                    $sorting = "ORDER BY SUBJECT__1 DESC";
                                }
                                    
                                  
                              });
                            
                        </script>


                        <div class="SearchResultsHeader__headerView d-none d-lg-inline"><span class="SearchResultsHeader__headerLabel">Filters:</span><button type="button" class="Button-module__button--1wrl3 Button-module__kindTertiaryLink--1nAl9 Button-module__xsmall--2aYDq IconButton-module__iconButton--cSZFS" aria-label="Clear All Filters" title="Clear All Filters" data-testid="thumbview" aria-pressed="true" >
                            <div class="Button-module__content--2Nnsd">
                              <div class="Button-module__withTextCrop--2sotd">
                                <div class="Button-module__center--3GGvH" id="clear_filters"> <i class="ti-cut" style="font-size: 18px;"></i></div>
                              </div>
                            </div>
                          </button><button type="button" class="Button-module__button--1wrl3 Button-module__kindTertiaryLink--1nAl9 Button-module__xsmall--2aYDq IconButton-module__iconButton--cSZFS" aria-label="grid view" title="Reload results" data-testid="gridview" aria-pressed="false">
                            <div class="Button-module__content--2Nnsd">
                              <div class="Button-module__withTextCrop--2sotd">
                                <div class="Button-module__center--3GGvH" onclick="if(confirm('page will refresh now')){window.location.reload();}"> <i class="ti-reload" style="font-size: 16px;"></i></div>
                              </div>
                            </div>
                          </button></div>
                        <div class="SearchResultsHeader__headerFilter d-lg-none"><button class="Button Button--medium Button--primary" type="button" id="OpenSidePanelButton">Filter</button></div>
                      </div>
                    </div>
                    <div class="Box Box--margin-top-sm"></div>
                  </div>
                  
                  
                  
                  <!-- slide bar stars here -->
                  
                  <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
                  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/flatly/bootstrap.min.css"> -->
                  <link href="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/sidebar plugin/dist/css/slide-out-panel.css" rel="stylesheet">

                  <!-- <button class="btn btn-primary" id="OpenSidePanelButton">Open Panel</button> -->
                  <div id="slide-out-panel" class="slide-out-panel">
                    <header>Filter Results</header>
                    
                    <section>

                                <!-- Your Location Begins -->
                        <div class="NextSearchPage" data-testid="SearchPage" style="width: 1000px; margin-left: -20px; margin-bottom:-30px">
                          <div class="responsive">
                            <div class="container">
                              <div class="row NextSearchPage__mainRow">
                                <div class="col-xs-2 col-lg-3">
                                  <div role="button" tabindex="0" class="d-lg-none" aria-label="Close"></div>
                                  <div class="MobileSearchMenu " data-testid="MobileSearchMenu">
                                    <div class="MobileSearchMenu__menu">
                                      <div class="SearchBreadcrumbsBox col-xs-12">
                                        <p class="SearchBreadcrumbsBox__title">Your Location:</p>
                                        <div class="SearchBreadcrumbsBox__keywordSection">
                                          <p class="SearchBreadcrumbsBox__keywordSectionTitle">District</p>
                                          <p class="SelectedKeyword">

                                            <select name="#" id="#" style="width:150px">
                                              <option value=''>
                                                  <?php
                                                    echo $students_distrcict;
                                                  ?>
                                                </option>
                                            </select>
                                                      
                                                    
                                              
                                            

                                            <a aria-label="Remove" class="Anchor Anchor--green"></a>
                                          </p>
                                        </div>
                                        <div class="SearchBreadcrumbsCoreStandardsContainer">
                                          <p class="SearchBreadcrumbsCoreStandardsContainer__title">City</p>
                                          <div class="SearchBreadcrumbsCoreStandardsContainer__grades"><a class="Anchor Anchor--black">
                                              <p class="SelectedFacet">

                                                <select name="#" id="#" style="width:150px">
                                                  <option value="">
                                                      <?php 
                                                        if($students_city != NULL){
                                                            echo $students_city;
                                                          
                                                          }else if($students_city == NULL){
                                                            echo "All Cities in $students_distrcict";
                                                          }
                                                      ?>
                                                          
                                                  </option>
                                                </select>


                                              </p>
                                            </a></div>
                                        </div><button id="clear_location_filters_mb" style="width: 150px; height:30px; background-color:#017BFF; color:white; font-size:.9rem; border-radius:5px" data-tooltip="Clear location filters to see all ads.">Clear Location Filters</button>&nbsp;&nbsp;<i class="fa fa-spinner fa-spin" style="display: none;" id="loading_animtion_mb"></i>
                                      </div>
                                      
                                
                                    
                                      
                                      
                                      

                                      <script>
                                          var currunt_district = "<?php echo $students_distrcict; ?>";
                                          var current_city = "<?php echo $students_city; ?>";
                                          var original_district = "<?php echo $datas[0]['DISTRICT']; ?>";
                                          var original_city = "<?php echo $datas[0]['CITY']; ?>";

                                          if((currunt_district == original_district) && (current_city == original_city)){
                                            $('#clear_location_filters_mb').hide();
                                          }
                                          
                                      </script>
                                      <script>
                                        $('#clear_location_filters_mb').click(function() {
                                          var students_distrcict = "<?php echo $datas[0]['DISTRICT']; ?>";
                                          var student_city = "<?php echo $datas[0]['CITY']; ?>";
                                          window.location.replace('Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?students_grade_from_filter=&How_classes_do=&subject=&City='+student_city+'&District='+students_distrcict);

                                        });
                                      </script>
                                      <script>
                                        $('#clear_location_filters_mb').click(function(){
                                          $('#loading_animtion_mb').show();
                                        });
                                      </script>
                        <!-- Your Location Ends Here --></div></div></div></div></div></div></div>
                        


                                      

                                    <!--Grades Stars Over Here-->
                          <div class="SpecificGradesSearchContainer">
                            <div class="FilterMenuLayout">
                              <h4 class="Text-module__root--3lnrt Text-module__h6--3hkb0 FilterMenuLayout__title">Grades &nbsp  <i class="fa fa-spinner fa-pulse fa-3x fa-fw" style="visibility:hidden;" id="grades_loading_icon_mb"></i>
                              </h4>
                              <div class="SpecificGradesMenuLayout">
                                <div class="SpecificGradesMenuLayout__mainGrades">
                                  <div class="SpecificGradesMenuLayout__mainGradeColumn" data-testid="SpecificGradesMenuLayout__mainGradeColumn">
                                    <div class="SpecificGradeCheckbox">


                                      <div><label id="label_specific-grade-checkbox-Grades_Pre_K" class="Label Label--inline Label--inlineAfter" for="specific-grade-checkbox-Grades_Pre_K">

                                      <?php
                                          if ($students_grade == 'grade_1') {
                                            echo "<input type='radio' class='Checkbox_mb' id='grade_1_mb' name='specific-grade-checkbox_mb' value='false' autocomplete='off' checked><span class='Label__title'><span>Grade 1</span></span>";
                                          } else {
                                            echo "<input type='radio' class='Checkbox_mb' id='grade_1_mb' name='specific-grade-checkbox_mb' value='false' autocomplete='off'><span class='Label__title'><span>Grade 1</span></span>";
                                          }
                                          ?>

                                        </label>
                                      </div>

                                      <div><label id="label_specific-grade-checkbox-Grades_Kindergarten" class="Label Label--inline Label--inlineAfter" for="specific-grade-checkbox-Grades_Kindergarten">

                                          <?php
                                          if ($students_grade == 'grade_3') {
                                            echo "<input type='radio' class='Checkbox_mb' id='grade_3_mb' name='specific-grade-checkbox_mb' value='false' autocomplete='off' checked><span class='Label__title'><span>Grade 3</span></span>";
                                          } else {
                                            echo "<input type='radio' class='Checkbox_mb' id='grade_3_mb' name='specific-grade-checkbox_mb' value='false' autocomplete='off'><span class='Label__title'><span>Grade 3</span></span>";
                                          }
                                          ?>
                                        </label>
                                      </div>



                                      <div><label id="label_specific-grade-checkbox-Grades_First" class="Label Label--inline Label--inlineAfter" for="specific-grade-checkbox-Grades_First">
                                          <?php
                                          if ($students_grade == 'grade_5') {
                                            echo "<input type='radio' class='Checkbox_mb' id='grade_5_mb' name='specific-grade-checkbox_mb' value='false' autocomplete='off' checked><span class='Label__title'><span>Grade 5</span></span>";
                                          } else {
                                            echo "<input type='radio' class='Checkbox_mb' id='grade_5_mb' name='specific-grade-checkbox_mb' value='false' autocomplete='off'><span class='Label__title'><span>Grade 5</span></span>";
                                          }
                                          ?>
                                        </label>
                                      </div>


                                      <div><label id="label_specific-grade-checkbox-Grades_Second" class="Label Label--inline Label--inlineAfter" for="specific-grade-checkbox-Grades_Second">
                                          <?php
                                          if ($students_grade =='grade_7') {
                                            echo "<input type='radio' class='Checkbox_mb' id='grade_7_mb' name='specific-grade-checkbox_mb' value='false' autocomplete='off' checked><span class='Label__title'><span>Grade 7</span></span>";
                                          } else {
                                            echo "<input type='radio' class='Checkbox_mb' id='grade_7_mb' name='specific-grade-checkbox_mb' value='false' autocomplete='off'><span class='Label__title'><span>Grade 7</span></span>";
                                          }
                                          ?>
                                        </label>
                                      </div>


                                      <div><label id="label_specific-grade-checkbox-Grades_Third" class="Label Label--inline Label--inlineAfter" for="specific-grade-checkbox-Grades_Third">
                                          <?php
                                          if ($students_grade == 'grade_9') {
                                            echo "<input type='radio' class='Checkbox_mb' id='grade_9_mb' name='specific-grade-checkbox_mb' value='false' autocomplete='off' checked><span class='Label__title'><span>Grade 9</span></span>";
                                          } else {
                                            echo "<input type='radio' class='Checkbox_mb' id='grade_9_mb' name='specific-grade-checkbox_mb' value='false' autocomplete='off'><span class='Label__title'><span>Grade 9</span></span>";
                                          }
                                          ?>
                                        </label>
                                      </div>


                                      <div><label id="label_specific-grade-checkbox-Grades_Fourth" class="Label Label--inline Label--inlineAfter" for="specific-grade-checkbox-Grades_Fourth">
                                          <?php
                                          if ($students_grade == 'AL') {
                                            echo "<input type='radio' class='Checkbox_mb' id='AL_mb' name='specific-grade-checkbox_mb' value='false' autocomplete='off' checked><span class='Label__title'><span>A/L</span></span>";
                                          } else {
                                            echo "<input type='radio' class='Checkbox_mb' id='AL_mb' name='specific-grade-checkbox_mb' value='false' autocomplete='off'><span class='Label__title'><span>A/L</span></span>";
                                          }
                                          ?>
                                        </label>
                                      </div>



                                    </div>
                                  </div>

                                  


                                  <div class="SpecificGradesMenuLayout__mainGradeColumn" data-testid="SpecificGradesMenuLayout__mainGradeColumn">
                                    <div class="SpecificGradeCheckbox">


                                      <div><label id="label_specific-grade-checkbox-Grades_Sixth" class="Label Label--inline Label--inlineAfter" for="specific-grade-checkbox-Grades_Sixth">
                                          <?php
                                          if ($students_grade == 'grade_2') {
                                            echo "<input type='radio' class='Checkbox_mb' id='grade_2_mb' name='specific-grade-checkbox_mb' value='false' autocomplete='off' checked><span class='Label__title'><span>Grade 2</span></span>";
                                          } else {
                                            echo "<input type='radio' class='Checkbox_mb' id='grade_2_mb' name='specific-grade-checkbox_mb' value='false' autocomplete='off'><span class='Label__title'><span>Grade 2</span></span>";
                                          }
                                          ?>
                                        </label>
                                      </div>


                                      <div><label id="label_specific-grade-checkbox-Grades_Seventh" class="Label Label--inline Label--inlineAfter" for="specific-grade-checkbox-Grades_Seventh">
                                          <?php
                                          if ($students_grade == 'grade_4') {
                                            echo "<input type='radio' class='Checkbox_mb' id='grade_4_mb' name='specific-grade-checkbox_mb' value='false' autocomplete='off' checked><span class='Label__title'><span>Grade 4</span></span>";
                                          } else {
                                            echo "<input type='radio' class='Checkbox_mb' id='grade_4_mb' name='specific-grade-checkbox_mb' value='false' autocomplete='off'><span class='Label__title'><span>Grade 4</span></span>";
                                          }
                                          ?>
                                        </label>
                                      </div>


                                      <div><label id="label_specific-grade-checkbox-Grades_Eighth" class="Label Label--inline Label--inlineAfter" for="specific-grade-checkbox-Grades_Eighth">
                                          <?php
                                          if ($students_grade == 'grade_6') {
                                            echo "<input type='radio' class='Checkbox_mb' id='grade_6_mb' name='specific-grade-checkbox_mb' value='false' autocomplete='off' checked><span class='Label__title'><span>Grade 6</span></span>";
                                          } else {
                                            echo "<input type='radio' class='Checkbox_mb' id='grade_6_mb' name='specific-grade-checkbox_mb' value='false' autocomplete='off'><span class='Label__title'><span>Grade 6</span></span>";
                                          }
                                          ?>
                                        </label>
                                      </div>


                                      <div><label id="label_specific-grade-checkbox-Grades_Ninth" class="Label Label--inline Label--inlineAfter" for="specific-grade-checkbox-Grades_Ninth">
                                          <?php
                                          if ($students_grade == 'grade_8') {
                                            echo "<input type='radio' class='Checkbox_mb' id='grade_8_mb' name='specific-grade-checkbox_mb' value='false' autocomplete='off' checked><span class='Label__title'><span>Grade 8</span></span>";
                                          } else {
                                            echo "<input type='radio' class='Checkbox_mb' id='grade_8_mb' name='specific-grade-checkbox_mb' value='false' autocomplete='off'><span class='Label__title'><span>Grade 8</span></span>";
                                          }
                                          ?>
                                        </label>
                                      </div>

                                      <div><label id="label_specific-grade-checkbox-Grades_Tenth" class="Label Label--inline Label--inlineAfter" for="specific-grade-checkbox-Grades_Tenth">
                                          <?php
                                          if ($students_grade == 'OL') {
                                            echo "<input type='radio' class='Checkbox_mb' id='OL_mb' name='specific-grade-checkbox_mb' value='false' autocomplete='off' checked><span class='Label__title'><span>O/L</span></span>";
                                          } else {
                                            echo "<input type='radio' class='Checkbox_mb' id='OL_mb' name='specific-grade-checkbox_mb' value='false' autocomplete='off'><span class='Label__title'><span>O/L</span></span>";
                                          }
                                          ?>
                                        </label>
                                      </div>


                                      <div><label id="label_specific-grade-checkbox-Grades_Eleventh" class="Label Label--inline Label--inlineAfter" for="specific-grade-checkbox-Grades_Eleventh">
                                          <?php
                                          if ($students_grade == 'Other') {
                                            echo "<input type='radio' class='Checkbox_mb' id='Other' name='specific-grade-checkbox_mb' value='false' autocomplete='off' checked><span class='Label__title'><span>Other</span></span>";
                                          } else {
                                            echo "<input type='radio' class='Checkbox_mb' id='Other' name='specific-grade-checkbox_mb' value='false' autocomplete='off'><span class='Label__title'><span>Other</span></span>";
                                          }
                                          ?>
                                        </label>
                                      </div>
                                      



                                      <script>
                                        $('.Checkbox_mb').change(function() {
                                          $("#grades_loading_icon_mb").css('visibility','visible');
                                          if ($('#Other').is(':checked')) {
                                            alert('Other');

                                          } else if ($('#grade_1_mb').is(':checked')) {
                                            window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?students_new_grade_from_filter=grade_1");

                                          } else if ($('#grade_2_mb').is(':checked')) {
                                            window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?students_new_grade_from_filter=grade_2");

                                          } else if ($('#grade_3_mb').is(':checked')) {
                                            window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?students_new_grade_from_filter=grade_3");

                                          } else if ($('#grade_4_mb').is(':checked')) {
                                            window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?students_new_grade_from_filter=grade_4");

                                          } else if ($('#grade_5_mb').is(':checked')) {
                                            window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?students_new_grade_from_filter=grade_5");

                                          } else if ($('#grade_6_mb').is(':checked')) {
                                            window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?students_new_grade_from_filter=grade_6");

                                          } else if ($('#grade_7_mb').is(':checked')) {
                                            window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?students_new_grade_from_filter=grade_7");

                                          } else if ($('#grade_8_mb').is(':checked')) {
                                            window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?students_new_grade_from_filter=grade_8");

                                          } else if ($('#grade_9_mb').is(':checked')) {
                                            window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?students_new_grade_from_filter=grade_9");

                                          } else if ($('#OL_mb').is(':checked')) {
                                            window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?students_new_grade_from_filter=OL");

                                          } else if ($('#AL_mb').is(':checked')) {
                                            window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?students_new_grade_from_filter=AL");

                                          }
                                        });
                                      </script>
                                        </div>
                                        </div>
                                      </div>

                                      <!--End of Grades-->

                                      <!-- Start of How_do_classes --><br/><br/>
                                      <div class="SpecificGradesSearchContainer" style="width: 100%;">
                                  <div class="FilterMenuLayout">
                                    <h4 class="Text-module__root--3lnrt Text-module__h6--3hkb0 FilterMenuLayout__title">How Class Do &nbsp <i class="fa fa-spinner fa-pulse fa-3x fa-fw" style="visibility:hidden;" id="how_do_class_loader_mb"></i>
                                    </h4>
                                    <div class="SpecificGradesMenuLayout">
                                      <div class="SpecificGradesMenuLayout__mainGrades">
                                        <div class="SpecificGradesMenuLayout__mainGradeColumn" data-testid="SpecificGradesMenuLayout__mainGradeColumn">
                                          <div class="SpecificGradeCheckbox">


                                            <div><label class="Label Label--inline Label--inlineAfter" for="online">

                                                <input type='radio' class='Checkbox' id='online_mb' name='how_do_class_mb' value='false' autocomplete='off'><span class='Label__title'><span>Online</span></span>
                                              </label>
                                            </div>

                                            
                                            
                                            <div><label class="Label Label--inline Label--inlineAfter" for="physical">

                                                <input type='radio' class='Checkbox' id='physical_mb' name='how_do_class_mb' value='false' autocomplete='off'><span class='Label__title'><span>Physical</span></span>
                                              </label>
                                            </div>

                                            
                                            
                                            <div><label class="Label Label--inline Label--inlineAfter" for="both" data-tooltip="Note: If you apply both filter you only see the teachers who do classes Online as well as Physical.">

                                                <input type='radio' class='Checkbox' id='both_mb' name='how_do_class_mb' value='false' autocomplete='off'><span class='Label__title' style="width: 200px;"><span>Both (Online & Physical)</span></span>
                                              </label>
                                            </div>
                                        
                                        </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div></div></div></div>
                                <!-- I added more 3 div here. Delete them if you faced a trouble -->


                          
                          <script>
                            var how_classes_do_mb = "<?php echo $_GET['how_classes_do_from_filter']; ?>";

                            if (how_classes_do_mb == 'online') {
                              $('#online_mb').prop('checked', true);
                            } else if (how_classes_do_mb == 'physical') {
                              $('#physical_mb').prop('checked', true);
                            } else if (how_classes_do_mb == 'both') {
                              $('#both_mb').prop('checked', true);
                            }
                          </script>
                          <script>
                              
                              $("input[name='how_do_class_mb']").click(function(){
                                $("#how_do_class_loader_mb").css('visibility','visible');
                                  if($('#online_mb').is(':checked')) { 
                                    //alert("it's online");
                                    window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?students_new_grade_from_filter_2=<?php echo $students_grade; ?>&how_classes_do_from_filter=online");
                                  
                                  }else if($('#physical_mb').is(':checked')){
                                    window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?students_new_grade_from_filter_2=<?php echo $students_grade; ?>&how_classes_do_from_filter=physical"); 
                                  
                                  }else if($('#both_mb').is(':checked')){
                                    window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?students_new_grade_from_filter_2=<?php echo $students_grade; ?>&how_classes_do_from_filter=both");
                                  }
                              });

                          </script>
                          <script>
                            $("input[name='how_do_class_mb']").click(function(){
                                if($('#online_mb').is(':checked')) { 
                                  findout_If_A_SearchQuery_Is_Available_Or_Not_For_Online();
                                }else if($('#physical_mb').is(':checked')){
                                  findout_If_A_SearchQuery_Is_Available_Or_Not_For_Physical();
                                
                                }else if($('#both_mb').is(':checked')){
                                  findout_If_A_SearchQuery_Is_Available_Or_Not_For_Both();
                                }
                              });
                          </script>
                          <!--End of How_do_classes-->
                                  
                                

                            
                            
                            

                          <!-- Subject According To Grade  Starts Here -->
                          <div class="EducationStandardsSearchContainer">
                            <div class="FilterMenuLayout">
                              <h4 class="Text-module__root--3lnrt Text-module__h6--3hkb0 FilterMenuLayout__title">Subject According To Grade &nbsp <i class="fa fa-spinner fa-pulse fa-3x fa-fw" style="visibility:hidden;" id="subject_grade_loader_mb"></i></h4>
                              <div class="EducationStandardsPickerLayout">
                                <div class="EducationStandardsPickerLayout__label"></div>
                                <div class="EducationStandardsPickerLayout__select">
                                  <div class="EducationStandardsPickerLayout__selectGrade"><label class="visually-hidden" for="ELA-commonCoreGrade">Grade</label>
                                    <div class="NativeSelectWrapper">

                                      <select name='grades' id='selectgrade_mb' data-toggle='dropdown' class="NativeSelect">
                                        <!-- <option value='grade_5'>Grade 5</option> -->
                                        <option value="">Grade</option>
                                        <option value='grade_6'>Grade 6</option>
                                        <option value='grade_7'>Grade 7</option>
                                        <option value='grade_8'>Grade 8</option>
                                        <option value='grade_9'>Grade 9</option>
                                        <option value='OL'>O/L</option>
                                        <option value='AL'>A/L</option>

                                      </select>

                                    </div>
                                  </div>
                                  <div class="EducationStandardsPickerLayout__selectDomain"><label class="visually-hidden" for="ELA-commonCoreDomain">Domain</label>
                                    <div class="NativeSelectWrapper">
                                      <select name='Subject' id='selectSubjects_mb' class="NativeSelect" disabled>
                                        <option value=""></option>
                                        <option data-value='grade_6' value='Buddhism'>Buddhism</option>
                                        <option data-value='grade_6' value='Christianity'>Christianity</option>
                                        <option data-value='grade_6' value='Catholic'>Catholic</option>
                                        <option data-value='grade_6' value='English Language'>English Language</option>
                                        <option data-value='grade_6' value='Science'>Science</option>
                                        <option data-value='grade_6' value='Geography'>Geography</option>
                                        <option data-value='grade_6' value='Dancing'>Dancing</option>
                                        <option data-value='grade_6' value='Western Music'>Western Music</option>
                                        <option data-value='grade_6' value='Drama & Theatre'>Drama & Theatre</option>
                                        <option data-value='grade_6' value='Health & Physical Education'>Health & Physical Education</option>
                                        <option data-value='grade_6' value='Shivenary'>Shivenary</option>
                                        <option data-value='grade_6' value='Sinhala Language'>Sinhala Language</option>
                                        <option data-value='grade_6' value='Mathematics'>Mathematics</option>
                                        <option data-value='grade_6' value='History'>History</option>
                                        <option data-value='grade_6' value='Life skills & Citizenshipn Education'>Life skills & Citizenshipn Education</option>
                                        <option data-value='grade_6' value='Eastern Music'>Eastern Music</option>
                                        <option data-value='grade_6' value='Art'>Art</option>
                                        <option data-value='grade_6' value='Practical & Technical Studies'>Practical & Technical Studies</option>
                                        <option data-value='grade_6' value='Tamil Language'>Tamil Language</option>



                                        <option data-value='grade_7' value='Buddhism'>Buddhism</option>
                                        <option data-value='grade_7' value='Christianity'>Christianity</option>
                                        <option data-value='grade_7' value='Catholic'>Catholic</option>
                                        <option data-value='grade_7' value='English Language'>English Language</option>
                                        <option data-value='grade_7' value='Science'>Science</option>
                                        <option data-value='grade_7' value='Geography'>Geography</option>
                                        <option data-value='grade_7' value='Dancing'>Dancing</option>
                                        <option data-value='grade_7' value='Western Music'>Western Music</option>
                                        <option data-value='grade_7' value='Drama & Theatre'>Drama & Theatre</option>
                                        <option data-value='grade_7' value='Health & Physical Education'>Health & Physical Education</option>
                                        <option data-value='grade_7' value='Shivenary'>Shivenary</option>
                                        <option data-value='grade_7' value='Sinhala Language'>Sinhala Language</option>
                                        <option data-value='grade_7' value='Mathematics'>Mathematics</option>
                                        <option data-value='grade_7' value='History'>History</option>
                                        <option data-value='grade_7' value='Life skills & Citizenshipn Education'>Life skills & Citizenshipn Education</option>
                                        <option data-value='grade_7' value='Eastern Music'>Eastern Music</option>
                                        <option data-value='grade_7' value='Art'>Art</option>
                                        <option data-value='grade_7' value='Practical & Technical Studies'>Practical & Technical Studies</option>
                                        <option data-value='grade_7' value='Tamil Language'>Tamil Language</option>


                                        <option data-value='grade_8' value='Buddhism'>Buddhism</option>
                                        <option data-value='grade_8' value='Christianity'>Christianity</option>
                                        <option data-value='grade_8' value='Catholic'>Catholic</option>
                                        <option data-value='grade_8' value='English Language'>English Language</option>
                                        <option data-value='grade_8' value='Science'>Science</option>
                                        <option data-value='grade_8' value='Geography'>Geography</option>
                                        <option data-value='grade_8' value='Dancing'>Dancing</option>
                                        <option data-value='grade_8' value='Western Music'>Western Music</option>
                                        <option data-value='grade_8' value='Drama & Theatre'>Drama & Theatre</option>
                                        <option data-value='grade_8' value='Health & Physical Education'>Health & Physical Education</option>
                                        <option data-value='grade_8' value='Shivenary'>Shivenary</option>
                                        <option data-value='grade_8' value='Sinhala Language'>Sinhala Language</option>
                                        <option data-value='grade_8' value='Mathematics'>Mathematics</option>
                                        <option data-value='grade_8' value='History'>History</option>
                                        <option data-value='grade_8' value='Life skills & Citizenshipn Education'>Life skills & Citizenshipn Education</option>
                                        <option data-value='grade_8' value='Eastern Music'>Eastern Music</option>
                                        <option data-value='grade_8' value='Art'>Art</option>
                                        <option data-value='grade_8' value='Practical & Technical Studies'>Practical & Technical Studies</option>
                                        <option data-value='grade_8' value='Tamil Language'>Tamil Language</option>



                                        <option data-value='grade_9' value='Buddhism'>Buddhism</option>
                                        <option data-value='grade_9' value='Christianity'>Christianity</option>
                                        <option data-value='grade_9' value='Catholic'>Catholic</option>
                                        <option data-value='grade_9' value='English Language'>English Language</option>
                                        <option data-value='grade_9' value='Science'>Science</option>
                                        <option data-value='grade_9' value='Geography'>Geography</option>
                                        <option data-value='grade_9' value='Dancing'>Dancing</option>
                                        <option data-value='grade_9' value='Western Music'>Western Music</option>
                                        <option data-value='grade_9' value='Drama & Theatre'>Drama & Theatre</option>
                                        <option data-value='grade_9' value='Health & Physical Education'>Health & Physical Education</option>
                                        <option data-value='grade_9' value='Shivenary'>Shivenary</option>
                                        <option data-value='grade_9' value='Sinhala Language'>Sinhala Language</option>
                                        <option data-value='grade_9' value='Mathematics'>Mathematics</option>
                                        <option data-value='grade_9' value='History'>History</option>
                                        <option data-value='grade_9' value='Life skills & Citizenshipn Education'>Life skills & Citizenshipn Education</option>
                                        <option data-value='grade_9' value='Eastern Music'>Eastern Music</option>
                                        <option data-value='grade_9' value='Art'>Art</option>
                                        <option data-value='grade_9' value='Practical & Technical Studies'>Practical & Technical Studies</option>
                                        <option data-value='grade_9' value='Tamil Language'>Tamil Language</option>



                                        <option data-value='OL' value='Buddhism'>Buddhism</option>
                                        <option data-value='OL' value='Christianity'>Christianity</option>
                                        <option data-value='OL' value='Catholism'>Catholism</option>
                                        <option data-value='OL' value='Islam'>Islam</option>
                                        <option data-value='OL' value='Sinhala Language & Literature'>Sinhala Language & Literature</option>
                                        <option data-value='OL' value='English'>English</option>
                                        <option data-value='OL' value='Mathematics'>Mathematics</option>
                                        <option data-value='OL' value='History'>History</option>
                                        <option data-value='OL' value='Science'>Science</option>
                                        <option data-value='OL' value='Geography'>Geography</option>
                                        <option data-value='OL' value='Citizenship Education'>Citizenship Education</option>
                                        <option data-value='OL' value='Enterpreneurial Education'>Enterpreneurial Education</option>
                                        <option data-value='OL' value='Business Studies & Accounts'>Business Studies & Accounts</option>
                                        <option data-value='OL' value='Eastern Music'>Eastern Music</option>
                                        <option data-value='OL' value='Western Music'>Western Music</option>
                                        <option data-value='OL' value='Art'>Art</option>
                                        <option data-value='OL' value='Traditional Dancing'>Traditional Dancing</option>
                                        <option data-value='OL' value='Sinhala Literature'>Sinhala Literature</option>
                                        <option data-value='OL' value='English Literature'>English Literature</option>
                                        <option data-value='OL' value='Information & Communication Technology'>Information & Communication Technology</option>
                                        <option data-value='OL' value='Agriculture & Food Technology'>Agriculture & Food Technology</option>
                                        <option data-value='OL' value='Art & Craft'>Art & Craft</option>
                                        <option data-value='OL' value='Home Economics'>Home Economics</option>
                                        <option data-value='OL' value='Health & Physical Education'>Health & Physical Education</option>





                                        <optgroup label='Technology stream' data-value='AL'>
                                          <option data-value='AL' value='SFT'>Science For Technology</option>
                                          <option data-value='AL' value='ET'>Engineering Technology</option>
                                          <option data-value='AL' value='ICT'>Information Communication Technology</option>
                                          <option data-value='AL' value='BST'>Bio System Technology</option>

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
                                    </div>
                                  </div>
                                </div>


                            

                                <script>
                                  $(document).ready(function() {
                                    var selectors = ['selectgrade_mb', 'selectSubjects_mb', 'selectSubjects_mb']
                                    $('#selectgrade_mb').on('change', function() {
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

                                <script>
                                  $('#selectgrade_mb > option').click(function() {
                                    $('#selectSubjects_mb').prop('disabled', false);
                                  });



                                  $(document).ready(function() {
                                    $('#selectSubjects_mb').change(function() {
                                      var subject_name = $('#selectSubjects_mb').find(":selected").val();
                                      var grade = $('#selectgrade_mb').find(":selected").val();


                                      if (subject_name != '') {
                                        $("#subject_grade_loader_mb").css('visibility','visible');
                                        var subject_name_encoded = encodeURIComponent(subject_name); //In here we are encoding the subject name because, when a subject name comes like "Sinhala & Lititure" because of the '&' mark, php thinks this is anoter variable too.
                                        window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?Grade_from_filer=" + grade + "&Subject_from_filter=" + subject_name_encoded);
                                      }

                                    });
                                  });
                                </script>

                                <script>
                                  var already_selected_grade = "<?php echo $students_grade; ?>";
                                  var already_selected_subject = "<?php echo $subject; ?>";


                                  if ((already_selected_grade.length) && (already_selected_subject.length) > 0) {
                                    for (var i = 1; i < $('#selectgrade_mb > option').length + 1; i++) {
                                      //alert($('#selectgrade_mb >option:nth-child(' +i +  ')').val());
                                      if ($('#selectgrade_mb >option:nth-child(' + i + ')').val() == already_selected_grade) {
                                        $('#selectgrade_mb >option:nth-child(' + i + ')').prop("selected", true);
                                      }
                                    }
                                    for (var j = 0; j < $('#selectSubjects_mb > option').length; j++) {
                                      if ($('#selectSubjects_mb >option:nth-child(' + j + ')').val() == already_selected_subject) {
                                        $('#selectSubjects_mb >option:nth-child(' + j + ')').prop("selected", true);
                                      }
                                    }
                                  }
                                </script>
                                <br><br>
                              </div>
                            </div>
                          </div>  
                          <!-- Subject Accrding to grade ends here -->




                          <div class="EducationStandardsSearchContainer">
                            <div class="FilterMenuLayout">
                              <h4 class="Text-module__root--3lnrt Text-module__h6--3hkb0 FilterMenuLayout__title">District And City </h4>
                              <div class="EducationStandardsPickerLayout">
                                <div class="EducationStandardsPickerLayout__label"></div>
                                <div class="EducationStandardsPickerLayout__select">
                                  <div class="EducationStandardsPickerLayout__selectGrade"><label class="visually-hidden" for="ELA-commonCoreGrade">Grade</label>
                                    <div class="NativeSelectWrapper">
                                      <form action="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?" method="POST">

                                        <select class="NativeSelect" id="Math-commonCoreGrade_mb" name="district">
                                          <option value=''>District</option>
                                          <!-- <option data-value='online' value='Whole country'>Whole country</option> -->
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





                                        </select>
                                    </div>
                                  </div>
                                  <div class="EducationStandardsPickerLayout__selectDomain"><label class="visually-hidden" for="Math-commonCoreDomain">Domain</label>
                                    <div class="NativeSelectWrapper">
                                      <select name='' id='selected_nothing_mb' class="NativeSelect">
                                        <option value='Everywhere'>Everywhere</option>
                                      </select>
                                      <select name='colombo' id='Cities_colombo_mb' class="NativeSelect">
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

                                      <select name='mathara' id='Cities_mathara_mb' class="NativeSelect">
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

                                      <select name='gampaha' id='Cities_gampha_mb' class="NativeSelect">
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




                                      <select name='jaffna' id='Cities_jaffna_mb' class="NativeSelect">
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

                                      <select name='kilinochchi' id='Cities_kilinochchi_mb' class="NativeSelect">
                                        <option value='All Cities'>All Cities</option>
                                        <option value='Karadippokku'>Karadippokku</option>
                                        <option value='Kilinochchi'>Kilinochchi</option>
                                        <option value='Poonakary'>Poonakary</option>
                                      </select>
                                      </select>

                                      <select name='mannar' id='Cities_Mannar_mb' class="NativeSelect">
                                        <option value='All Cities'>All Cities</option>
                                        <option value='Mannar'>Mannar</option>
                                        <option value='Murunkan'>Murunkan</option>
                                        <option value='Nanattan'>Nanattan</option>
                                      </select>

                                      <select name='mullativu' id='Cities_Mullaitivu_mb' class="NativeSelect">
                                        <option value='1000117'>All Cities</option>
                                        <option value='Mankulam'>Mankulam</option>
                                        <option value='Pudukudiyirippu'>Pudukudiyirippu</option>
                                      </select>

                                      <select name='vavuniya' id='Cities_Vavuniya_mb' class="NativeSelect">
                                        <option value='All Cities'>All Cities</option>
                                        <option value='Vavuniya'>Vavuniya</option>
                                      </select>
                                      </select>

                                      <select name='puttalam' id='Cities_Puttalam_mb' class="NativeSelect">
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

                                      <select name='kurunegala' id='Cities_Kurunegala_mb' class="NativeSelect">
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

                                      <select name='kaluthara' id='Cities_Kalutara_mb' class="NativeSelect">
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

                                      <select name='anuradhapura' id='Cities_Anuradhapura_mb' class="NativeSelect">
                                        <option value='All Cities'>All Cities</option>
                                        <option value='Anuradhapura'>Anuradhapura</option>
                                        <option value='Awukana'>Awukana</option>
                                        <option value='Kahatagasdigiliya'>Kahatagasdigiliya</option>
                                      </select>

                                      <select name='polonnaruwa' id='Cities_Polonnaruwa_mb' class="NativeSelect">
                                        <option value='All Cities'>All Cities</option>
                                        <option value='Hingurakgoda'>Hingurakgoda</option>
                                        <option value='Polonnaruwa'>Polonnaruwa</option>
                                      </select>

                                      <select name='mathale' id='Cities_Matale_mb' class="NativeSelect">
                                        <option value='All Cities'>All Cities</option>
                                        <option value='Dambulla'>Dambulla</option>
                                        <option value='Kaikawala'>Kaikawala</option>
                                        <option value='Matale'>Matale</option>
                                      </select>

                                      <select name='kandy' id='Cities_Kandy_mb' class="NativeSelect">
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

                                      <select name='nuwaraeliya' id='Cities_Nuwara_Eliya_mb' class="NativeSelect">
                                        <option value='All Cities'>All Cities</option>
                                        <option value='Bogawantalawa'>Bogawantalawa</option>
                                        <option value='Ginigathena'>Ginigathena</option>
                                        <option value='Hatton'>Hatton</option>
                                        <option value='Kotagala'>Kotagala</option>
                                        <option value='Kotmale'>Kotmale</option>
                                        <option value='Nuwara Eliya'>Nuwara Eliya</option>
                                      </select>

                                      <select name='kagalle' id='Cities_Kegalle_mb' class="NativeSelect">
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

                                      <select name='ranthnapura' id='Cities_Ratnapura_mb' class="NativeSelect">
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

                                      <select name='trincomalee' id='Cities_Trincomalee_mb' class="NativeSelect">
                                        <option value='All Cities'>All Cities</option>
                                        <option value='Trincomalee'>Trincomalee</option>
                                      </select>

                                      <select name='batticaloa' id='Cities_Batticaloa_mb' class="NativeSelect">
                                        <option value='All Cities'>All Cities</option>
                                        <option value='Batticaloa'>Batticaloa</option>
                                        <option value='Eravur'>Eravur</option>
                                        <option value='Kattankudi'>Kattankudi</option>
                                        <option value='Oddamavadi'>Oddamavadi</option>
                                        <option value='Pasikudah'>Pasikudah</option>
                                        <option value='Valaichenai'>Valaichenai</option>
                                      </select>

                                      <select name='ampara' id='Cities_Ampara_mb' class="NativeSelect">
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

                                      <select name='badulla' id='Cities_Badulla_mb' class="NativeSelect">
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

                                      <select name='monaragala' id='Cities_Monaragala_mb' class="NativeSelect">
                                        <option value='All Cities'>All Cities</option>
                                        <option value='Bibile'>Bibile</option>
                                        <option value='Monaragala'>Monaragala</option>
                                      </select>

                                      <select name='hambanthota' id='Cities_Hambantota_mb' class="NativeSelect">
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

                                      <select name='galle' id='Cities_Galle_mb' class="NativeSelect">
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
                                      </select>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block" style="height: 30px; background-color:#017BFF; color:white; font-size:0.9rem; padding-bottom:25px;" data-tooltip="You need to press this button to apply filter" id="apply_location_filters_button_mb"><i class="fa fa-spinner fa-pulse fa-3x fa-fw" style="display:none;" id="district_city_loader_mb"></i> &nbsp Apply location filters</button>

                            </div>
                          </form>
                        </div>
                          

                        <script>
                            $('#Math-commonCoreGrade_mb').change(function() {
                              var seleted_option = $('#Math-commonCoreGrade_mb :selected').val();

                              if (seleted_option == 'Colombo') {
                                $('#Cities_colombo_mb').show();

                                $('#selected_nothing_mb').hide();
                                //$('#Cities_colombo_mb').hide();
                                $('#Cities_mathara_mb').hide();
                                $('#Cities_gampha_mb').hide();
                                $('#Cities_jaffna_mb').hide();
                                $('#Cities_kilinochchi_mb').hide();
                                $('#Cities_Mannar_mb').hide();
                                $('#Cities_Mullaitivu_mb').hide();
                                $('#Cities_Vavuniya_mb').hide();
                                $('#Cities_Puttalam_mb').hide();
                                $('#Cities_Kurunegala_mb').hide();
                                $('#Cities_Kalutara_mb').hide();
                                $('#Cities_Anuradhapura_mb').hide();
                                $('#Cities_Polonnaruwa_mb').hide();
                                $('#Cities_Matale_mb').hide();
                                $('#Cities_Kandy_mb').hide();
                                $('#Cities_Nuwara_Eliya_mb').hide();
                                $('#Cities_Kegalle_mb').hide();
                                $('#Cities_Ratnapura_mb').hide();
                                $('#Cities_Trincomalee_mb').hide();
                                $('#Cities_Batticaloa_mb').hide();
                                $('#Cities_Ampara_mb').hide();
                                $('#Cities_Badulla_mb').hide();
                                $('#Cities_Monaragala_mb').hide();
                                $('#Cities_Hambantota_mb').hide();
                                $('#Cities_Galle_mb').hide();


                              } else if (seleted_option == 'Mathara') {
                                $('#Cities_mathara_mb').show();

                                $('#selected_nothing_mb').hide();
                                $('#Cities_colombo_mb').hide();
                                //$('#Cities_mathara_mb').hide();
                                $('#Cities_gampha_mb').hide();
                                $('#Cities_jaffna_mb').hide();
                                $('#Cities_kilinochchi_mb').hide();
                                $('#Cities_Mannar_mb').hide();
                                $('#Cities_Mullaitivu_mb').hide();
                                $('#Cities_Vavuniya_mb').hide();
                                $('#Cities_Puttalam_mb').hide();
                                $('#Cities_Kurunegala_mb').hide();
                                $('#Cities_Kalutara_mb').hide();
                                $('#Cities_Anuradhapura_mb').hide();
                                $('#Cities_Polonnaruwa_mb').hide();
                                $('#Cities_Matale_mb').hide();
                                $('#Cities_Kandy_mb').hide();
                                $('#Cities_Nuwara_Eliya_mb').hide();
                                $('#Cities_Kegalle_mb').hide();
                                $('#Cities_Ratnapura_mb').hide();
                                $('#Cities_Trincomalee_mb').hide();
                                $('#Cities_Batticaloa_mb').hide();
                                $('#Cities_Ampara_mb').hide();
                                $('#Cities_Badulla_mb').hide();
                                $('#Cities_Monaragala_mb').hide();
                                $('#Cities_Hambantota_mb').hide();
                                $('#Cities_Galle_mb').hide();


                              } else if (seleted_option == 'Gampaha') {
                                $('#Cities_gampha_mb').show();

                                $('#selected_nothing_mb').hide();
                                $('#Cities_colombo_mb').hide();
                                $('#Cities_mathara_mb').hide();

                                $('#Cities_jaffna_mb').hide();
                                $('#Cities_kilinochchi_mb').hide();
                                $('#Cities_Mannar_mb').hide();
                                $('#Cities_Mullaitivu_mb').hide();
                                $('#Cities_Vavuniya_mb').hide();
                                $('#Cities_Puttalam_mb').hide();
                                $('#Cities_Kurunegala_mb').hide();
                                $('#Cities_Kalutara_mb').hide();
                                $('#Cities_Anuradhapura_mb').hide();
                                $('#Cities_Polonnaruwa_mb').hide();
                                $('#Cities_Matale_mb').hide();
                                $('#Cities_Kandy_mb').hide();
                                $('#Cities_Nuwara_Eliya_mb').hide();
                                $('#Cities_Kegalle_mb').hide();
                                $('#Cities_Ratnapura_mb').hide();
                                $('#Cities_Trincomalee_mb').hide();
                                $('#Cities_Batticaloa_mb').hide();
                                $('#Cities_Ampara_mb').hide();
                                $('#Cities_Badulla_mb').hide();
                                $('#Cities_Monaragala_mb').hide();
                                $('#Cities_Hambantota_mb').hide();
                                $('#Cities_Galle_mb').hide();

                              } else if (seleted_option == 'Jaffna') {
                                $('#Cities_jaffna_mb').show();

                                $('#selected_nothing_mb').hide();
                                $('#Cities_colombo_mb').hide();
                                $('#Cities_mathara_mb').hide();
                                $('#Cities_gampha_mb').hide();

                                $('#Cities_kilinochchi_mb').hide();
                                $('#Cities_Mannar_mb').hide();
                                $('#Cities_Mullaitivu_mb').hide();
                                $('#Cities_Vavuniya_mb').hide();
                                $('#Cities_Puttalam_mb').hide();
                                $('#Cities_Kurunegala_mb').hide();
                                $('#Cities_Kalutara_mb').hide();
                                $('#Cities_Anuradhapura_mb').hide();
                                $('#Cities_Polonnaruwa_mb').hide();
                                $('#Cities_Matale_mb').hide();
                                $('#Cities_Kandy_mb').hide();
                                $('#Cities_Nuwara_Eliya_mb').hide();
                                $('#Cities_Kegalle_mb').hide();
                                $('#Cities_Ratnapura_mb').hide();
                                $('#Cities_Trincomalee_mb').hide();
                                $('#Cities_Batticaloa_mb').hide();
                                $('#Cities_Ampara_mb').hide();
                                $('#Cities_Badulla_mb').hide();
                                $('#Cities_Monaragala_mb').hide();
                                $('#Cities_Hambantota_mb').hide();
                                $('#Cities_Galle_mb').hide();
                              } else if (seleted_option == 'Kilinochchi') {
                                $('#Cities_kilinochchi_mb').show();

                                $('#selected_nothing_mb').hide();
                                $('#Cities_colombo_mb').hide();
                                $('#Cities_mathara_mb').hide();
                                $('#Cities_gampha_mb').hide();
                                $('#Cities_jaffna_mb').hide();

                                $('#Cities_Mannar_mb').hide();
                                $('#Cities_Mullaitivu_mb').hide();
                                $('#Cities_Vavuniya_mb').hide();
                                $('#Cities_Puttalam_mb').hide();
                                $('#Cities_Kurunegala_mb').hide();
                                $('#Cities_Kalutara_mb').hide();
                                $('#Cities_Anuradhapura_mb').hide();
                                $('#Cities_Polonnaruwa_mb').hide();
                                $('#Cities_Matale_mb').hide();
                                $('#Cities_Kandy_mb').hide();
                                $('#Cities_Nuwara_Eliya_mb').hide();
                                $('#Cities_Kegalle_mb').hide();
                                $('#Cities_Ratnapura_mb').hide();
                                $('#Cities_Trincomalee_mb').hide();
                                $('#Cities_Batticaloa_mb').hide();
                                $('#Cities_Ampara_mb').hide();
                                $('#Cities_Badulla_mb').hide();
                                $('#Cities_Monaragala_mb').hide();
                                $('#Cities_Hambantota_mb').hide();
                                $('#Cities_Galle_mb').hide();

                              } else if (seleted_option == 'Mannar') {
                                $('#Cities_Mannar_mb').show();

                                $('#selected_nothing_mb').hide();
                                $('#Cities_colombo_mb').hide();
                                $('#Cities_mathara_mb').hide();
                                $('#Cities_gampha_mb').hide();
                                $('#Cities_jaffna_mb').hide();
                                $('#Cities_kilinochchi_mb').hide();

                                $('#Cities_Mullaitivu_mb').hide();
                                $('#Cities_Vavuniya_mb').hide();
                                $('#Cities_Puttalam_mb').hide();
                                $('#Cities_Kurunegala_mb').hide();
                                $('#Cities_Kalutara_mb').hide();
                                $('#Cities_Anuradhapura_mb').hide();
                                $('#Cities_Polonnaruwa_mb').hide();
                                $('#Cities_Matale_mb').hide();
                                $('#Cities_Kandy_mb').hide();
                                $('#Cities_Nuwara_Eliya_mb').hide();
                                $('#Cities_Kegalle_mb').hide();
                                $('#Cities_Ratnapura_mb').hide();
                                $('#Cities_Trincomalee_mb').hide();
                                $('#Cities_Batticaloa_mb').hide();
                                $('#Cities_Ampara_mb').hide();
                                $('#Cities_Badulla_mb').hide();
                                $('#Cities_Monaragala_mb').hide();
                                $('#Cities_Hambantota_mb').hide();
                                $('#Cities_Galle_mb').hide();

                              } else if (seleted_option == 'Mullaitivu') {
                                $('#selected_nothing_mb').hide();
                                $('#Cities_colombo_mb').hide();
                                $('#Cities_mathara_mb').hide();
                                $('#Cities_gampha_mb').hide();
                                $('#Cities_jaffna_mb').hide();
                                $('#Cities_kilinochchi_mb').hide();
                                $('#Cities_Mannar_mb').hide();
                                $('#Cities_Mullaitivu_mb').show();
                                $('#Cities_Vavuniya_mb').hide();
                                $('#Cities_Puttalam_mb').hide();
                                $('#Cities_Kurunegala_mb').hide();
                                $('#Cities_Kalutara_mb').hide();
                                $('#Cities_Anuradhapura_mb').hide();
                                $('#Cities_Polonnaruwa_mb').hide();
                                $('#Cities_Matale_mb').hide();
                                $('#Cities_Kandy_mb').hide();
                                $('#Cities_Nuwara_Eliya_mb').hide();
                                $('#Cities_Kegalle_mb').hide();
                                $('#Cities_Ratnapura_mb').hide();
                                $('#Cities_Trincomalee_mb').hide();
                                $('#Cities_Batticaloa_mb').hide();
                                $('#Cities_Ampara_mb').hide();
                                $('#Cities_Badulla_mb').hide();
                                $('#Cities_Monaragala_mb').hide();
                                $('#Cities_Hambantota_mb').hide();
                                $('#Cities_Galle_mb').hide();

                              } else if (seleted_option == 'Vavuniya') {
                                $('#selected_nothing_mb').hide();
                                $('#Cities_colombo_mb').hide();
                                $('#Cities_mathara_mb').hide();
                                $('#Cities_gampha_mb').hide();
                                $('#Cities_jaffna_mb').hide();
                                $('#Cities_kilinochchi_mb').hide();
                                $('#Cities_Mannar_mb').hide();
                                $('#Cities_Mullaitivu_mb').hide();
                                $('#Cities_Vavuniya_mb').show();
                                $('#Cities_Puttalam_mb').hide();
                                $('#Cities_Kurunegala_mb').hide();
                                $('#Cities_Kalutara_mb').hide();
                                $('#Cities_Anuradhapura_mb').hide();
                                $('#Cities_Polonnaruwa_mb').hide();
                                $('#Cities_Matale_mb').hide();
                                $('#Cities_Kandy_mb').hide();
                                $('#Cities_Nuwara_Eliya_mb').hide();
                                $('#Cities_Kegalle_mb').hide();
                                $('#Cities_Ratnapura_mb').hide();
                                $('#Cities_Trincomalee_mb').hide();
                                $('#Cities_Batticaloa_mb').hide();
                                $('#Cities_Ampara_mb').hide();
                                $('#Cities_Badulla_mb').hide();
                                $('#Cities_Monaragala_mb').hide();
                                $('#Cities_Hambantota_mb').hide();
                                $('#Cities_Galle_mb').hide();

                              } else if (seleted_option == 'Puttalam') {
                                $('#selected_nothing_mb').hide();
                                $('#Cities_colombo_mb').hide();
                                $('#Cities_mathara_mb').hide();
                                $('#Cities_gampha_mb').hide();
                                $('#Cities_jaffna_mb').hide();
                                $('#Cities_kilinochchi_mb').hide();
                                $('#Cities_Mannar_mb').hide();
                                $('#Cities_Mullaitivu_mb').hide();
                                $('#Cities_Vavuniya_mb').hide();
                                $('#Cities_Puttalam_mb').show();
                                $('#Cities_Kurunegala_mb').hide();
                                $('#Cities_Kalutara_mb').hide();
                                $('#Cities_Anuradhapura_mb').hide();
                                $('#Cities_Polonnaruwa_mb').hide();
                                $('#Cities_Matale_mb').hide();
                                $('#Cities_Kandy_mb').hide();
                                $('#Cities_Nuwara_Eliya_mb').hide();
                                $('#Cities_Kegalle_mb').hide();
                                $('#Cities_Ratnapura_mb').hide();
                                $('#Cities_Trincomalee_mb').hide();
                                $('#Cities_Batticaloa_mb').hide();
                                $('#Cities_Ampara_mb').hide();
                                $('#Cities_Badulla_mb').hide();
                                $('#Cities_Monaragala_mb').hide();
                                $('#Cities_Hambantota_mb').hide();
                                $('#Cities_Galle_mb').hide();
                              } else if (seleted_option == 'Kurunegala') {
                                $('#selected_nothing_mb').hide();
                                $('#Cities_colombo_mb').hide();
                                $('#Cities_mathara_mb').hide();
                                $('#Cities_gampha_mb').hide();
                                $('#Cities_jaffna_mb').hide();
                                $('#Cities_kilinochchi_mb').hide();
                                $('#Cities_Mannar_mb').hide();
                                $('#Cities_Mullaitivu_mb').hide();
                                $('#Cities_Vavuniya_mb').hide();
                                $('#Cities_Puttalam_mb').hide();
                                $('#Cities_Kurunegala_mb').show();
                                $('#Cities_Kalutara_mb').hide();
                                $('#Cities_Anuradhapura_mb').hide();
                                $('#Cities_Polonnaruwa_mb').hide();
                                $('#Cities_Matale_mb').hide();
                                $('#Cities_Kandy_mb').hide();
                                $('#Cities_Nuwara_Eliya_mb').hide();
                                $('#Cities_Kegalle_mb').hide();
                                $('#Cities_Ratnapura_mb').hide();
                                $('#Cities_Trincomalee_mb').hide();
                                $('#Cities_Batticaloa_mb').hide();
                                $('#Cities_Ampara_mb').hide();
                                $('#Cities_Badulla_mb').hide();
                                $('#Cities_Monaragala_mb').hide();
                                $('#Cities_Hambantota_mb').hide();
                                $('#Cities_Galle_mb').hide();
                              } else if (seleted_option == 'Kalutara') {
                                $('#selected_nothing_mb').hide();
                                $('#Cities_colombo_mb').hide();
                                $('#Cities_mathara_mb').hide();
                                $('#Cities_gampha_mb').hide();
                                $('#Cities_jaffna_mb').hide();
                                $('#Cities_kilinochchi_mb').hide();
                                $('#Cities_Mannar_mb').hide();
                                $('#Cities_Mullaitivu_mb').hide();
                                $('#Cities_Vavuniya_mb').hide();
                                $('#Cities_Puttalam_mb').hide();
                                $('#Cities_Kurunegala_mb').hide();
                                $('#Cities_Kalutara_mb').show();
                                $('#Cities_Anuradhapura_mb').hide();
                                $('#Cities_Polonnaruwa_mb').hide();
                                $('#Cities_Matale_mb').hide();
                                $('#Cities_Kandy_mb').hide();
                                $('#Cities_Nuwara_Eliya_mb').hide();
                                $('#Cities_Kegalle_mb').hide();
                                $('#Cities_Ratnapura_mb').hide();
                                $('#Cities_Trincomalee_mb').hide();
                                $('#Cities_Batticaloa_mb').hide();
                                $('#Cities_Ampara_mb').hide();
                                $('#Cities_Badulla_mb').hide();
                                $('#Cities_Monaragala_mb').hide();
                                $('#Cities_Hambantota_mb').hide();
                                $('#Cities_Galle_mb').hide();
                              } else if (seleted_option == 'Anuradhapura') {
                                $('#selected_nothing_mb').hide();
                                $('#Cities_colombo_mb').hide();
                                $('#Cities_mathara_mb').hide();
                                $('#Cities_gampha_mb').hide();
                                $('#Cities_jaffna_mb').hide();
                                $('#Cities_kilinochchi_mb').hide();
                                $('#Cities_Mannar_mb').hide();
                                $('#Cities_Mullaitivu_mb').hide();
                                $('#Cities_Vavuniya_mb').hide();
                                $('#Cities_Puttalam_mb').hide();
                                $('#Cities_Kurunegala_mb').hide();
                                $('#Cities_Kalutara_mb').hide();
                                $('#Cities_Anuradhapura_mb').show();
                                $('#Cities_Polonnaruwa_mb').hide();
                                $('#Cities_Matale_mb').hide();
                                $('#Cities_Kandy_mb').hide();
                                $('#Cities_Nuwara_Eliya_mb').hide();
                                $('#Cities_Kegalle_mb').hide();
                                $('#Cities_Ratnapura_mb').hide();
                                $('#Cities_Trincomalee_mb').hide();
                                $('#Cities_Batticaloa_mb').hide();
                                $('#Cities_Ampara_mb').hide();
                                $('#Cities_Badulla_mb').hide();
                                $('#Cities_Monaragala_mb').hide();
                                $('#Cities_Hambantota_mb').hide();
                                $('#Cities_Galle_mb').hide();
                              } else if (seleted_option == 'Polonnaruwa') {
                                $('#selected_nothing_mb').hide();
                                $('#Cities_colombo_mb').hide();
                                $('#Cities_mathara_mb').hide();
                                $('#Cities_gampha_mb').hide();
                                $('#Cities_jaffna_mb').hide();
                                $('#Cities_kilinochchi_mb').hide();
                                $('#Cities_Mannar_mb').hide();
                                $('#Cities_Mullaitivu_mb').hide();
                                $('#Cities_Vavuniya_mb').hide();
                                $('#Cities_Puttalam_mb').hide();
                                $('#Cities_Kurunegala_mb').hide();
                                $('#Cities_Kalutara_mb').hide();
                                $('#Cities_Anuradhapura_mb').hide();
                                $('#Cities_Polonnaruwa_mb').show();
                                $('#Cities_Matale_mb').hide();
                                $('#Cities_Kandy_mb').hide();
                                $('#Cities_Nuwara_Eliya_mb').hide();
                                $('#Cities_Kegalle_mb').hide();
                                $('#Cities_Ratnapura_mb').hide();
                                $('#Cities_Trincomalee_mb').hide();
                                $('#Cities_Batticaloa_mb').hide();
                                $('#Cities_Ampara_mb').hide();
                                $('#Cities_Badulla_mb').hide();
                                $('#Cities_Monaragala_mb').hide();
                                $('#Cities_Hambantota_mb').hide();
                                $('#Cities_Galle_mb').hide();
                              } else if (seleted_option == 'Matale') {
                                $('#selected_nothing_mb').hide();
                                $('#Cities_colombo_mb').hide();
                                $('#Cities_mathara_mb').hide();
                                $('#Cities_gampha_mb').hide();
                                $('#Cities_jaffna_mb').hide();
                                $('#Cities_kilinochchi_mb').hide();
                                $('#Cities_Mannar_mb').hide();
                                $('#Cities_Mullaitivu_mb').hide();
                                $('#Cities_Vavuniya_mb').hide();
                                $('#Cities_Puttalam_mb').hide();
                                $('#Cities_Kurunegala_mb').hide();
                                $('#Cities_Kalutara_mb').hide();
                                $('#Cities_Anuradhapura_mb').hide();
                                $('#Cities_Polonnaruwa_mb').hide();
                                $('#Cities_Matale_mb').show();
                                $('#Cities_Kandy_mb').hide();
                                $('#Cities_Nuwara_Eliya_mb').hide();
                                $('#Cities_Kegalle_mb').hide();
                                $('#Cities_Ratnapura_mb').hide();
                                $('#Cities_Trincomalee_mb').hide();
                                $('#Cities_Batticaloa_mb').hide();
                                $('#Cities_Ampara_mb').hide();
                                $('#Cities_Badulla_mb').hide();
                                $('#Cities_Monaragala_mb').hide();
                                $('#Cities_Hambantota_mb').hide();
                                $('#Cities_Galle_mb').hide();
                              } else if (seleted_option == 'Kandy') {
                                $('#selected_nothing_mb').hide();
                                $('#Cities_colombo_mb').hide();
                                $('#Cities_mathara_mb').hide();
                                $('#Cities_gampha_mb').hide();
                                $('#Cities_jaffna_mb').hide();
                                $('#Cities_kilinochchi_mb').hide();
                                $('#Cities_Mannar_mb').hide();
                                $('#Cities_Mullaitivu_mb').hide();
                                $('#Cities_Vavuniya_mb').hide();
                                $('#Cities_Puttalam_mb').hide();
                                $('#Cities_Kurunegala_mb').hide();
                                $('#Cities_Kalutara_mb').hide();
                                $('#Cities_Anuradhapura_mb').hide();
                                $('#Cities_Polonnaruwa_mb').hide();
                                $('#Cities_Matale_mb').hide();
                                $('#Cities_Kandy_mb').show();
                                $('#Cities_Nuwara_Eliya_mb').hide();
                                $('#Cities_Kegalle_mb').hide();
                                $('#Cities_Ratnapura_mb').hide();
                                $('#Cities_Trincomalee_mb').hide();
                                $('#Cities_Batticaloa_mb').hide();
                                $('#Cities_Ampara_mb').hide();
                                $('#Cities_Badulla_mb').hide();
                                $('#Cities_Monaragala_mb').hide();
                                $('#Cities_Hambantota_mb').hide();
                                $('#Cities_Galle_mb').hide();
                              } else if (seleted_option == 'Nuwara Eliya') {
                                $('#selected_nothing_mb').hide();
                                $('#Cities_colombo_mb').hide();
                                $('#Cities_mathara_mb').hide();
                                $('#Cities_gampha_mb').hide();
                                $('#Cities_jaffna_mb').hide();
                                $('#Cities_kilinochchi_mb').hide();
                                $('#Cities_Mannar_mb').hide();
                                $('#Cities_Mullaitivu_mb').hide();
                                $('#Cities_Vavuniya_mb').hide();
                                $('#Cities_Puttalam_mb').hide();
                                $('#Cities_Kurunegala_mb').hide();
                                $('#Cities_Kalutara_mb').hide();
                                $('#Cities_Anuradhapura_mb').hide();
                                $('#Cities_Polonnaruwa_mb').hide();
                                $('#Cities_Matale_mb').hide();
                                $('#Cities_Kandy_mb').hide();
                                $('#Cities_Nuwara_Eliya_mb').show();
                                $('#Cities_Kegalle_mb').hide();
                                $('#Cities_Ratnapura_mb').hide();
                                $('#Cities_Trincomalee_mb').hide();
                                $('#Cities_Batticaloa_mb').hide();
                                $('#Cities_Ampara_mb').hide();
                                $('#Cities_Badulla_mb').hide();
                                $('#Cities_Monaragala_mb').hide();
                                $('#Cities_Hambantota_mb').hide();
                                $('#Cities_Galle_mb').hide();
                              } else if (seleted_option == 'Kegalle') {
                                $('#selected_nothing_mb').hide();
                                $('#Cities_colombo_mb').hide();
                                $('#Cities_mathara_mb').hide();
                                $('#Cities_gampha_mb').hide();
                                $('#Cities_jaffna_mb').hide();
                                $('#Cities_kilinochchi_mb').hide();
                                $('#Cities_Mannar_mb').hide();
                                $('#Cities_Mullaitivu_mb').hide();
                                $('#Cities_Vavuniya_mb').hide();
                                $('#Cities_Puttalam_mb').hide();
                                $('#Cities_Kurunegala_mb').hide();
                                $('#Cities_Kalutara_mb').hide();
                                $('#Cities_Anuradhapura_mb').hide();
                                $('#Cities_Polonnaruwa_mb').hide();
                                $('#Cities_Matale_mb').hide();
                                $('#Cities_Kandy_mb').hide();
                                $('#Cities_Nuwara_Eliya_mb').hide();
                                $('#Cities_Kegalle_mb').show();
                                $('#Cities_Ratnapura_mb').hide();
                                $('#Cities_Trincomalee_mb').hide();
                                $('#Cities_Batticaloa_mb').hide();
                                $('#Cities_Ampara_mb').hide();
                                $('#Cities_Badulla_mb').hide();
                                $('#Cities_Monaragala_mb').hide();
                                $('#Cities_Hambantota_mb').hide();
                                $('#Cities_Galle_mb').hide();
                              } else if (seleted_option == 'Ratnapura') {
                                $('#selected_nothing_mb').hide();
                                $('#Cities_colombo_mb').hide();
                                $('#Cities_mathara_mb').hide();
                                $('#Cities_gampha_mb').hide();
                                $('#Cities_jaffna_mb').hide();
                                $('#Cities_kilinochchi_mb').hide();
                                $('#Cities_Mannar_mb').hide();
                                $('#Cities_Mullaitivu_mb').hide();
                                $('#Cities_Vavuniya_mb').hide();
                                $('#Cities_Puttalam_mb').hide();
                                $('#Cities_Kurunegala_mb').hide();
                                $('#Cities_Kalutara_mb').hide();
                                $('#Cities_Anuradhapura_mb').hide();
                                $('#Cities_Polonnaruwa_mb').hide();
                                $('#Cities_Matale_mb').hide();
                                $('#Cities_Kandy_mb').hide();
                                $('#Cities_Nuwara_Eliya_mb').hide();
                                $('#Cities_Kegalle_mb').hide();
                                $('#Cities_Ratnapura_mb').show();
                                $('#Cities_Trincomalee_mb').hide();
                                $('#Cities_Batticaloa_mb').hide();
                                $('#Cities_Ampara_mb').hide();
                                $('#Cities_Badulla_mb').hide();
                                $('#Cities_Monaragala_mb').hide();
                                $('#Cities_Hambantota_mb').hide();
                                $('#Cities_Galle_mb').hide();
                              } else if (seleted_option == 'Trincomalee') {
                                $('#selected_nothing_mb').hide();
                                $('#Cities_colombo_mb').hide();
                                $('#Cities_mathara_mb').hide();
                                $('#Cities_gampha_mb').hide();
                                $('#Cities_jaffna_mb').hide();
                                $('#Cities_kilinochchi_mb').hide();
                                $('#Cities_Mannar_mb').hide();
                                $('#Cities_Mullaitivu_mb').hide();
                                $('#Cities_Vavuniya_mb').hide();
                                $('#Cities_Puttalam_mb').hide();
                                $('#Cities_Kurunegala_mb').hide();
                                $('#Cities_Kalutara_mb').hide();
                                $('#Cities_Anuradhapura_mb').hide();
                                $('#Cities_Polonnaruwa_mb').hide();
                                $('#Cities_Matale_mb').hide();
                                $('#Cities_Kandy_mb').hide();
                                $('#Cities_Nuwara_Eliya_mb').hide();
                                $('#Cities_Kegalle_mb').hide();
                                $('#Cities_Ratnapura_mb').hide();
                                $('#Cities_Trincomalee_mb').show();
                                $('#Cities_Batticaloa_mb').hide();
                                $('#Cities_Ampara_mb').hide();
                                $('#Cities_Badulla_mb').hide();
                                $('#Cities_Monaragala_mb').hide();
                                $('#Cities_Hambantota_mb').hide();
                                $('#Cities_Galle_mb').hide();
                              } else if (seleted_option == 'Batticaloa') {
                                $('#selected_nothing_mb').hide();
                                $('#Cities_colombo_mb').hide();
                                $('#Cities_mathara_mb').hide();
                                $('#Cities_gampha_mb').hide();
                                $('#Cities_jaffna_mb').hide();
                                $('#Cities_kilinochchi_mb').hide();
                                $('#Cities_Mannar_mb').hide();
                                $('#Cities_Mullaitivu_mb').hide();
                                $('#Cities_Vavuniya_mb').hide();
                                $('#Cities_Puttalam_mb').hide();
                                $('#Cities_Kurunegala_mb').hide();
                                $('#Cities_Kalutara_mb').hide();
                                $('#Cities_Anuradhapura_mb').hide();
                                $('#Cities_Polonnaruwa_mb').hide();
                                $('#Cities_Matale_mb').hide();
                                $('#Cities_Kandy_mb').hide();
                                $('#Cities_Nuwara_Eliya_mb').hide();
                                $('#Cities_Kegalle_mb').hide();
                                $('#Cities_Ratnapura_mb').hide();
                                $('#Cities_Trincomalee_mb').hide();
                                $('#Cities_Batticaloa_mb').show();
                                $('#Cities_Ampara_mb').hide();
                                $('#Cities_Badulla_mb').hide();
                                $('#Cities_Monaragala_mb').hide();
                                $('#Cities_Hambantota_mb').hide();
                                $('#Cities_Galle_mb').hide();
                              } else if (seleted_option == 'Ampara') {
                                $('#selected_nothing_mb').hide();
                                $('#Cities_colombo_mb').hide();
                                $('#Cities_mathara_mb').hide();
                                $('#Cities_gampha_mb').hide();
                                $('#Cities_jaffna_mb').hide();
                                $('#Cities_kilinochchi_mb').hide();
                                $('#Cities_Mannar_mb').hide();
                                $('#Cities_Mullaitivu_mb').hide();
                                $('#Cities_Vavuniya_mb').hide();
                                $('#Cities_Puttalam_mb').hide();
                                $('#Cities_Kurunegala_mb').hide();
                                $('#Cities_Kalutara_mb').hide();
                                $('#Cities_Anuradhapura_mb').hide();
                                $('#Cities_Polonnaruwa_mb').hide();
                                $('#Cities_Matale_mb').hide();
                                $('#Cities_Kandy_mb').hide();
                                $('#Cities_Nuwara_Eliya_mb').hide();
                                $('#Cities_Kegalle_mb').hide();
                                $('#Cities_Ratnapura_mb').hide();
                                $('#Cities_Trincomalee_mb').hide();
                                $('#Cities_Batticaloa_mb').hide();
                                $('#Cities_Ampara_mb').show();
                                $('#Cities_Badulla_mb').hide();
                                $('#Cities_Monaragala_mb').hide();
                                $('#Cities_Hambantota_mb').hide();
                                $('#Cities_Galle_mb').hide();
                              } else if (seleted_option == 'Badulla') {
                                $('#selected_nothing_mb').hide();
                                $('#Cities_colombo_mb').hide();
                                $('#Cities_mathara_mb').hide();
                                $('#Cities_gampha_mb').hide();
                                $('#Cities_jaffna_mb').hide();
                                $('#Cities_kilinochchi_mb').hide();
                                $('#Cities_Mannar_mb').hide();
                                $('#Cities_Mullaitivu_mb').hide();
                                $('#Cities_Vavuniya_mb').hide();
                                $('#Cities_Puttalam_mb').hide();
                                $('#Cities_Kurunegala_mb').hide();
                                $('#Cities_Kalutara_mb').hide();
                                $('#Cities_Anuradhapura_mb').hide();
                                $('#Cities_Polonnaruwa_mb').hide();
                                $('#Cities_Matale_mb').hide();
                                $('#Cities_Kandy_mb').hide();
                                $('#Cities_Nuwara_Eliya_mb').hide();
                                $('#Cities_Kegalle_mb').hide();
                                $('#Cities_Ratnapura_mb').hide();
                                $('#Cities_Trincomalee_mb').hide();
                                $('#Cities_Batticaloa_mb').hide();
                                $('#Cities_Ampara_mb').hide();
                                $('#Cities_Badulla_mb').show();
                                $('#Cities_Monaragala_mb').hide();
                                $('#Cities_Hambantota_mb').hide();
                                $('#Cities_Galle_mb').hide();
                              } else if (seleted_option == 'Monaragala') {
                                $('#selected_nothing_mb').hide();
                                $('#Cities_colombo_mb').hide();
                                $('#Cities_mathara_mb').hide();
                                $('#Cities_gampha_mb').hide();
                                $('#Cities_jaffna_mb').hide();
                                $('#Cities_kilinochchi_mb').hide();
                                $('#Cities_Mannar_mb').hide();
                                $('#Cities_Mullaitivu_mb').hide();
                                $('#Cities_Vavuniya_mb').hide();
                                $('#Cities_Puttalam_mb').hide();
                                $('#Cities_Kurunegala_mb').hide();
                                $('#Cities_Kalutara_mb').hide();
                                $('#Cities_Anuradhapura_mb').hide();
                                $('#Cities_Polonnaruwa_mb').hide();
                                $('#Cities_Matale_mb').hide();
                                $('#Cities_Kandy_mb').hide();
                                $('#Cities_Nuwara_Eliya_mb').hide();
                                $('#Cities_Kegalle_mb').hide();
                                $('#Cities_Ratnapura_mb').hide();
                                $('#Cities_Trincomalee_mb').hide();
                                $('#Cities_Batticaloa_mb').hide();
                                $('#Cities_Ampara_mb').hide();
                                $('#Cities_Badulla_mb').hide();
                                $('#Cities_Monaragala_mb').show();
                                $('#Cities_Hambantota_mb').hide();
                                $('#Cities_Galle_mb').hide();
                              } else if (seleted_option == 'Hambantota') {
                                $('#selected_nothing_mb').hide();
                                $('#Cities_colombo_mb').hide();
                                $('#Cities_mathara_mb').hide();
                                $('#Cities_gampha_mb').hide();
                                $('#Cities_jaffna_mb').hide();
                                $('#Cities_kilinochchi_mb').hide();
                                $('#Cities_Mannar_mb').hide();
                                $('#Cities_Mullaitivu_mb').hide();
                                $('#Cities_Vavuniya_mb').hide();
                                $('#Cities_Puttalam_mb').hide();
                                $('#Cities_Kurunegala_mb').hide();
                                $('#Cities_Kalutara_mb').hide();
                                $('#Cities_Anuradhapura_mb').hide();
                                $('#Cities_Polonnaruwa_mb').hide();
                                $('#Cities_Matale_mb').hide();
                                $('#Cities_Kandy_mb').hide();
                                $('#Cities_Nuwara_Eliya_mb').hide();
                                $('#Cities_Kegalle_mb').hide();
                                $('#Cities_Ratnapura_mb').hide();
                                $('#Cities_Trincomalee_mb').hide();
                                $('#Cities_Batticaloa_mb').hide();
                                $('#Cities_Ampara_mb').hide();
                                $('#Cities_Badulla_mb').hide();
                                $('#Cities_Monaragala_mb').hide();
                                $('#Cities_Hambantota_mb').show();
                                $('#Cities_Galle_mb').hide();
                              } else if (seleted_option == 'Galle') {
                                $('#selected_nothing_mb').hide();
                                $('#Cities_colombo_mb').hide();
                                $('#Cities_mathara_mb').hide();
                                $('#Cities_gampha_mb').hide();
                                $('#Cities_jaffna_mb').hide();
                                $('#Cities_kilinochchi_mb').hide();
                                $('#Cities_Mannar_mb').hide();
                                $('#Cities_Mullaitivu_mb').hide();
                                $('#Cities_Vavuniya_mb').hide();
                                $('#Cities_Puttalam_mb').hide();
                                $('#Cities_Kurunegala_mb').hide();
                                $('#Cities_Kalutara_mb').hide();
                                $('#Cities_Anuradhapura_mb').hide();
                                $('#Cities_Polonnaruwa_mb').hide();
                                $('#Cities_Matale_mb').hide();
                                $('#Cities_Kandy_mb').hide();
                                $('#Cities_Nuwara_Eliya_mb').hide();
                                $('#Cities_Kegalle_mb').hide();
                                $('#Cities_Ratnapura_mb').hide();
                                $('#Cities_Trincomalee_mb').hide();
                                $('#Cities_Batticaloa_mb').hide();
                                $('#Cities_Ampara_mb').hide();
                                $('#Cities_Badulla_mb').hide();
                                $('#Cities_Monaragala_mb').hide();
                                $('#Cities_Hambantota_mb').hide();
                                $('#Cities_Galle_mb').show();
                              } else if (seleted_option == 'Whole Country') {

                                $('#selected_nothing_mb').show();
                                $('#Cities_colombo_mb').hide();
                                $('#Cities_mathara_mb').hide();
                                $('#Cities_gampha_mb').hide();
                                $('#Cities_jaffna_mb').hide();
                                $('#Cities_kilinochchi_mb').hide();
                                $('#Cities_Mannar_mb').hide();
                                $('#Cities_Mullaitivu_mb').hide();
                                $('#Cities_Vavuniya_mb').hide();
                                $('#Cities_Puttalam_mb').hide();
                                $('#Cities_Kurunegala_mb').hide();
                                $('#Cities_Kalutara_mb').hide();
                                $('#Cities_Anuradhapura_mb').hide();
                                $('#Cities_Polonnaruwa_mb').hide();
                                $('#Cities_Matale_mb').hide();
                                $('#Cities_Kandy_mb').hide();
                                $('#Cities_Nuwara_Eliya_mb').hide();
                                $('#Cities_Kegalle_mb').hide();
                                $('#Cities_Ratnapura_mb').hide();
                                $('#Cities_Trincomalee_mb').hide();
                                $('#Cities_Batticaloa_mb').hide();
                                $('#Cities_Ampara_mb').hide();
                                $('#Cities_Badulla_mb').hide();
                                $('#Cities_Monaragala_mb').hide();
                                $('#Cities_Hambantota_mb').hide();
                                $('#Cities_Galle_mb').hide();
                              }

                            });
                          </script>


                          <script>
                            $(document).ready(function() {
                              $('#Math-commonCoreGrade_mb').change(function() {
                                var district = $('#Math-commonCoreGrade_mb').find(":selected").val();
                                var city = $('#selectgrade_mb').find(":selected").val();


                                // if(district != ''){
                                //     var subject_name_encoded = encodeURIComponent(subject_name); //In here we are encoding the subject name because, when a subject name comes like "Sinhala & Lititure" because of the '&' mark, php thinks this is anoter variable too.
                                //     window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?Grade_from_filer=" + grade + "&Subject_from_filter=" + subject_name_encoded);
                                // }

                              });
                            });
                          </script>

                          <!-- <script>
                                var student_district = "<?php echo $students_distrcict; ?>";
                                var student_city = "<?php echo $students_city; ?>";

                                if((student_district.length) && (student_city.length) > 0){
                                  for(var i = 0; i < $('#Math-commonCoreGrade > option').length + 1; i++){
                                    if($('#Math-commonCoreGrade > option:nth-child(' +i +  ')').text() == student_district){
                                        $('#Math-commonCoreGrade >option:nth-child(' +i +  ')').prop("selected", true);
                                    }
                                  }

                                  for(var m = 0; m < $('.NativeSelect > option').length+1; m++){
                                    if($('.NativeSelect > option:nth-child(' +i +  ')').val() == student_city){
                                        $('.NativeSelect >option:nth-child(' +i +  ')').prop("selected", true);
                                        alert(student_city);
                                    }
                                  }
                                }
                          </script> -->

                          <script>
                              $("#apply_location_filters_button_mb").click(function(){
                                  $("#district_city_loader_mb").show();
                              });
                          </script>

                      <!-- District And City Ends Here -->


                      
                      
                      <!--class type Stars Over Here--><br /><br />
                      <div class="SpecificGradesSearchContainer" style="width: 120%;">
                            <div class="FilterMenuLayout">
                              <h4 class="Text-module__root--3lnrt Text-module__h6--3hkb0 FilterMenuLayout__title">Class Type &nbsp <i class="fa fa-spinner fa-pulse fa-3x fa-fw" style="visibility:hidden;" id="class_type_loader_mb"></i>
                              </h4>
                              <div class="SpecificGradesMenuLayout">
                                <div class="SpecificGradesMenuLayout__mainGrades">
                                  <div class="SpecificGradesMenuLayout__mainGradeColumn" data-testid="SpecificGradesMenuLayout__mainGradeColumn">
                                    <div class="SpecificGradeCheckbox">


                                    <div><label class="Label Label--inline Label--inlineAfter" for="small_class">

                                        <input type='radio' class='Checkbox' id='small_class_mb' name='class_type_mb' value='false' autocomplete='off'><span class='Label__title' data-tooltip="Also known as Mass Class"><span>Small Class</span></span>
                                        </label>
                                        </div>


                                        <div><label class="Label Label--inline Label--inlineAfter" for="medium_class">

                                        <input type='radio' class='Checkbox' id='medium_class_mb' name='class_type_mb' value='false' autocomplete='off'><span class='Label__title' data-tooltip="Also known as Medium Group Class"><span>Group Class</span></span>
                                        </label>
                                        </div>


                                        <div><label class="Label Label--inline Label--inlineAfter" for="home_visit">

                                        <input type='radio' class='Checkbox' id='home_visit_mb' name='class_type_mb' value='false' autocomplete='off'><span class='Label__title'><span>Home Visit</span></span>
                                        </label>
                                        </div>

                                        <div><label class="Label Label--inline Label--inlineAfter" for="individual">

                                        <input type='radio' class='Checkbox' id='individual_mb' name='class_type_mb' value='false' autocomplete='off'><span class='Label__title'><span>Individual</span></span>
                                        </label>
                                        </div>

                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <script>
                            $('input[name=class_type_mb]').change(function() {
                              $("#class_type_loader_mb").css('visibility','visible');

                              if ($('#small_class_mb').is(':checked')) {
                                window.location.replace('Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?class_type_from_filter=Small Class (Mass Class)');

                              } else if ($('#medium_class_mb').is(':checked')) {
                                window.location.replace('Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?class_type_from_filter=Medium Class (Group Class)');

                              } else if ($('#home_visit_mb').is(':checked')) {
                                window.location.replace('Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?class_type_from_filter=Home Visit');

                              } else if ($('#individual_mb').is(':checked')) {
                                window.location.replace('Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?class_type_from_filter=Individual');

                              }

                            });
                          </script>
                          
                          <script>
                                  
                                  $('input[name=class_type_mb]').change(function() {
                                    if ($('#small_class_mb').is(':checked')) {
                                        findout_If_A_SearchQuery_Is_Available_Or_Not_For_small_class();
                                    
                                    }else if ($('#medium_class_mb').is(':checked')) {
                                        findout_If_A_SearchQuery_Is_Available_Or_Not_For_meduim_class()
                                    
                                    }else if ($('#home_visit_mb').is(':checked')) {
                                        findout_If_A_SearchQuery_Is_Available_Or_Not_For_home_visit();


                                    }else if ($('#individual_mb').is(':checked')) {
                                        findout_If_A_SearchQuery_Is_Available_Or_Not_For_individual();
                                    
                                    }

                                  });
                                    
                            </script>

                          <?php
                            if(isset($_GET['class_type_from_filter'])){
                              echo "<script>
                                          var class_type = '$class_type';
                                          if (class_type.length > 0) {
                                            if (class_type == 'Small Class (Mass Class)') {
                                              $('#small_class_mb').prop('checked', true);
                  
                                            } else if (class_type == 'Medium Class (Group Class)') {
                                              $('#medium_class_mb').prop('checked', true);
                  
                                            } else if (class_type == 'Home Visit') {
                                              $('#home_visit_mb').prop('checked', true);
                  
                                            } else if (class_type == 'Individual') {
                                              $('#individual_mb').prop('checked', true);
                                            }
                                          }
                                    </script>";
                            }
                            
                          ?>
                          

                          <!--End of Class Types-->

                              
                                  
                                  
                        <!-- Languages Stars Here -->
                        <div class="FilterMenuLayout">
                            <h4 class="Text-module__root--3lnrt Text-module__h6--3hkb0 FilterMenuLayout__title">Languages (Medium) &nbsp <i class="fa fa-spinner fa-pulse fa-3x fa-fw" style="visibility:hidden;" id="languages_loader_mb"></i></h4>
                            <div class="SearchMenuCheckboxLayout" id="all_languages_mb">
                            <form id="search_query_get_request" action="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?" method="GET">
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_free" class="Label Label--inline Label--inlineAfter" for="Sinhala">
                              <input type="checkbox" class="Checkbox" id="sinhala_mb" name="language[]" value="Sinhala"><span class="Label__title">Sinhala</span></label></div>
                              
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_under_5" class="Label Label--inline Label--inlineAfter" for="English">
                              <input type="checkbox" class="Checkbox" id="english_mb" name="language[]" value="English"><span class="Label__title">English</span></label></div>
                              
                              <div class="SearchMenuCheckboxLayout__item"><label id="label_5_to_10" class="Label Label--inline Label--inlineAfter" for="Tamil">
                              <input type="checkbox" class="Checkbox" id="tamil_mb" name="language[]" value="Tamil"><span class="Label__title">Tamil</span></label></div>
                            </div><button type="submit" name = "apply_language_filters" class="btn btn-primary btn-lg btn-block" style="height: 30px; background-color:#017BFF; color:white; display:none;" id="languagesfilterbutton">Apply Language filters</button>
                                
                            <input type="text" value="" name="selected_category" id="SelectedCategoryBypass_mb" style="display: none;">
                            <input type="text" value="" name="Search_bar" id="SearchQueryBypass_mb" style="display: none;">
                                
                          </form>
                          </div>

                          <script>
                              var sinhala_checked_mb = false;
                              var english_checked_mb = false;
                              var tamil_checked_mb = false;
                              
                              
                              
                            $("#all_languages_mb").change(function(){
                              $('#sinhala_mb').click(function(){
                                if('#sinhala_mb :checked'){
                                  if(sinhala_checked_mb === false){
                                      window.sinhala_checked_mb = true;
                                      Checked_Languages(sinhala_checked_mb,english_checked_mb,tamil_checked_mb);
                                      
                                      
                                    }else{
                                      sinhala_checked_mb = false;
                                    }
                                    
                                    
                                    
                                }
                              });

                              
                              $('#english_mb').click(function(){
                                if('#english_mb :checked'){
                                    if(english_checked_mb === false){
                                        english_checked_mb = true;
                                        Checked_Languages(sinhala_checked_mb,english_checked_mb,tamil_checked_mb);
                                      
                                      }else{
                                        english_checked_mb = false;
                                      }
                                      
                                  }
                              });

                              
                              
                              
                              $('#tamil_mb').click(function(){
                                if('#tamil_mb :checked'){
                                    if(tamil_checked_mb === false){
                                        tamil_checked_mb = true;
                                        Checked_Languages(sinhala_checked_mb,english_checked_mb,tamil_checked_mb);
                                      
                                      }else{
                                        tamil_checked_mb = false;
                                      }
                                      
                                  }
                              });

                              
                              function Checked_Languages(sinhala,english,tamil){
                                  //window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?language="+sinhala+"&english="+english+"&tamil="+tamil);
                                  // alert(sinhala);
                                  // alert(english);
                                  // alert(tamil);
                              }


                              
                              });
                          
                                
                          </script>
                          
                          <script>

                              function ClickFilterButton_mb(){
                                  $("#languages_loader_mb").css('visibility','visible');
                                  $("#languagesfilterbutton").click();

                                }
                                  
                                
                                $('#all_languages_mb').change(function(){
                                    setTimeout(ClickFilterButton_mb,1000);
                                });
                            </script>
                            <script>
                                  
                                  $('#all_languages_mb').change(function(){
                                      findout_If_A_SearchQuery_Is_Available_Or_Not_2();
                                  });
                                  
                                  function findout_If_A_SearchQuery_Is_Available_Or_Not_2(){
                                      var searched_query = "<?php echo $_GET['Search_bar']?>";
                                      var selected_category = "<?php echo $_GET['selected_category']?>";

                                      if((searched_query != '') && (selected_category != '')){
                                        
                                            $("#SearchQueryBypass_mb").attr('value',searched_query);
                                            $("#SelectedCategoryBypass_mb").attr('value',selected_category);
                                          }
                                    }
                              </script>
                                          
                                          
                                          

                            <script>
                                var selectedLanguages = "<?php echo $language_string ?>";
                                

                                if(selectedLanguages != ''){
                                    if(selectedLanguages.includes("Sinhala")){
                                        $('#sinhala_mb').prop('checked',true);
                                    }
                                    
                                    if(selectedLanguages.includes("English")){
                                        $('#english_mb').prop('checked',true);
                                    }

                                    if(selectedLanguages.includes("Tamil")){
                                        $('#tamil_mb').prop('checked',true);
                                    }
                                }

                            </script>   

                            <!-- Languages Ends Here -->
                              
                     
                     
                         
                    
                    

                                
                                      
                                      




                    </section>
                    
                    <footer>Edupara & tpt copyright &copy; <?php echo date("Y");?></footer>
                  </div>

                  
                              
                      

                  <script src="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/sidebar plugin/dist/js/slide-out-panel.js"></script>
                  
                  <script>
                    const slideOutPanel = $('#slide-out-panel').SlideOutPanel({
                                            slideFrom: 'right',
                                            enableEscapeKey: true,
                                            width: '250px',
                                            
                                          });
                                            

                    $('body').on('click', '#OpenSidePanelButton', () => {
                      slideOutPanel.open();
                    });
                  </script>
                  
                  <!-- slide bar ends here -->




                      

                              




                  
                  <div class="d-xs-none d-md-block" data-testid="PromoProductsContainer"></div>
                  
                  <!-- Alret Plugin Stars Here -->
                  <link rel="stylesheet" href="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/confimation message plugin/jquery.alertable.css">
                  <script src="Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/confimation message plugin/jquery.alertable.min.js"></script>
                  <script>
                      $(function() {
                        
                        $('#clear_filters').on('click', function() {
                          $.alertable.confirm('All the filters you applied lately, Including Search Results will be removed.').then(function() {
                            window.location.replace("Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?ClearAllFilters=true");
                          }, function() {
                            console.log('Confirmation canceled');
                          });
                        });
                      
                      });
                    
                  </script>
                  <!-- Alret Plugin ends Here -->
                
                  
                  <?php
                      if(isset($_GET['ClearAllFilters']) && $_GET['ClearAllFilters'] == 'true'){
                          if(isset($_COOKIE['how_classes_do'])){
                            setcookie("how_classes_do",'',time(),'/');
                          }
                          if(isset($_COOKIE['district']) && isset($_COOKIE['city'])){
                            setcookie("district",'',time(),'/');
                            setcookie("city",'',time(),'/');
                            echo "<script>location.reload();</script>";
                          }
                          if(isset($_COOKIE['class_type'])){
                            setcookie("class_type",'',time(),'/');
                          }
                          
                          
                        }
                    ?>

                          
            


                  

                  <?php
                  
                  $counting_array = array();
                  
                  //Stop overlapping same ID in the fav_button
                  $stop_overlap = 1;
                  
                  for ($q = 2; $q <= 4; $q++) { //datas2,datas3,datas4 loop 2


                    for ($m = 1; $m <= $count_of_subject_columns; $m++) { //1

                      //Students Grade and How do classes filter
                      if (isset($_GET['students_new_grade_from_filter_2'])) {
                        if (isset($_GET['how_classes_do_from_filter'])) {
                          $students_new_grade_from_filter_2 = $_GET['students_new_grade_from_filter_2'];
                          $how_class_do_from_filter = $_GET['how_classes_do_from_filter'];

                          $students_grade = $students_new_grade_from_filter_2;
                          $how_classes_do = "'$how_class_do_from_filter'";
                        }
                      } else {
                        $how_classes_do = "(time_table_of_teachers.HOW_CLASS_DO__$m <=> NULL)";
                      }



                      //Students Grade and Subject filter
                      if (isset($_GET['Subject_from_filter']) && isset($_GET['Grade_from_filer'])) {
                        $subject_from_filter =  $_GET['Subject_from_filter'];
                        $grade_from_filter = $_GET['Grade_from_filer'];


                        $subject = "'$subject_from_filter'";
                      } else {
                        $subject = "(time_table_of_teachers.SUBJECT__$m <=> NULL)";
                      }



                      



                      //Class Type filter
                      if (isset($_GET['class_type_from_filter'])) {
                        $class_type_from_filter = $_GET['class_type_from_filter'];
                        $class_type = "'$class_type_from_filter'";
                      } else {
                        $class_type = "(time_table_of_teachers.CLASS_TYPE__$m <=> NULL)";
                      }

                      

                      //Language Filter
                      if(isset($_GET['language'])){
                          
                          $languages_or_medium = "'$language_string'";
                          if(strstr($languages_or_medium,'Sinhala')){
                              $languages_or_medium = " '%Sinhala%' ";
                          }
                          if(strstr($languages_or_medium,'English')){
                              $languages_or_medium = " '%English%' ";
                          }
                          if(strstr($languages_or_medium,'Tamil')){
                              $languages_or_medium = " '%Tamil%' ";
                          }
                          
                      }else{
                          //$languages_or_medium = "(time_table_of_teachers.LANGUAGES__$m <=> NULL)"; Uncommect this if you are not working with LIKE clause
                            $languages_or_medium = "'%'";
                      }



                    //Subject Search Query Filter
                    if(isset($_GET['selected_category']) && isset($_GET['Search_bar'])){
                      if($_GET['selected_category'] == 'subject' && $_GET['Search_bar'] != NULL){
                            $subject_from_search_query = $_GET['Search_bar'];

                            if($searched_query == 'Information Communication Technology'){
                              $subject_from_search_query = 'ICT';
                            
                            }elseif($searched_query == 'Science For Technology'){
                              $subject_from_search_query = 'SFT';
                            
                            }elseif($searched_query == 'Engineering Technology'){
                              $subject_from_search_query = 'ET';
                            
                            }elseif($searched_query == 'Bio System Technology'){
                              $subject_from_search_query = 'BST';
                            
                            }

                            $subject = " '$subject_from_search_query' ";
                      }else{
                            $subject = "(time_table_of_teachers.SUBJECT__$m <=> NULL)";
                      }
                    }


                    //Teachers Search Query Filter
                    if(isset($_GET['selected_category']) && isset($_GET['Search_bar'])){
                      if($_GET['selected_category'] == 'teacher' && $_GET['Search_bar'] != NULL){
                          $teachers_full_name = $_GET['Search_bar'];

                          $sql7 = "SELECT FNAME, SNAME
                                    FROM teachers;";
                            
                          $resalt7 = mysqli_query($conn, $sql7);                   //get the resalt between $conn and, run $sql 
                          $resaltcheck7 = mysqli_num_rows($resalt7);
                          $datas7 = array();
                          
                          if ($resaltcheck7 > 0) {
                            while ($row7 = mysqli_fetch_assoc($resalt7)) {
                              $datas7[] = $row7;
                            }
                          }   

                          $how_many_teachers_found_from_the_query = 0;

                          for ($f=0; $f < count($datas7); $f++) {
                              $teachers_fname_from_array = $datas7[$f]['FNAME'];
                              $teachers_sname_from_array = $datas7[$f]['SNAME'];
                              $teachers_full_name_string = "$teachers_fname_from_array $teachers_sname_from_array";

                              if($teachers_full_name == $teachers_full_name_string){
                                $teachers_fname = "'$teachers_fname_from_array'";
                                $teachers_sname = "'$teachers_sname_from_array'";
                                $how_many_teachers_found_from_the_query = 1;
                              }
                              
                          }

                          if($how_many_teachers_found_from_the_query == 0){
                              $teachers_fname = "'$teachers_full_name'";
                              $teachers_sname = "'$teachers_full_name'";
                              $how_many_teachers_found_from_the_query = 0;
                          }
                          
                      }else{
                        $teachers_fname = "(teachers.FNAME <=> NULL)";
                        $teachers_sname = "(teachers.SNAME <=> NULL)";
                      }
                    
                    }


                    //Grades Search Query Filter
                    if(isset($_GET['selected_category']) && isset($_GET['Search_bar'])){
                      if($_GET['selected_category'] == 'grade' && $_GET['Search_bar'] != NULL){
                         $selected_grade = $_GET['Search_bar'];
                         $students_grade = $selected_grade;
                      }
                    }


                    //Institute Search Query Filter
                    if(isset($_GET['selected_category']) && isset($_GET['Search_bar'])){
                      if($_GET['selected_category'] == 'institute' && $_GET['Search_bar'] != NULL){
                        $institute_from_get = $_GET['Search_bar'];
                        $institute_name = "'$institute_from_get'";

                      }else{
                          $institute_name = "(time_table_of_teachers.INSTITUTE__$m <=> NULL)";
                      }
                    }


                    //Nothing Search Query filter
                    if((isset($_GET['selected_category']) === false) && (isset($_GET['Search_bar']) === false)){
                        $teachers_fname = "(teachers.FNAME <=> NULL)"; 
                        $teachers_sname = "(teachers.SNAME <=> NULL)";
                        $institute_name = "(time_table_of_teachers.INSTITUTE__$m <=> NULL)";
                    }
                    
                    

                     
                    
                    
                    
                    
                    
                    //Ad slot 1 - Accoding to the student's city and grade

                      $sql2 = "SELECT T_ID, GRADE__$m, SUBJECT__$m, BATCH__$m, CLASS_DATE__$m, CLASS_BEGIN__$m, CLASS_END__$m, HOW_CLASS_DO__$m, DISTRICT__$m , CITY__$m, INSTITUTE__$m, LANGUAGES__$m, CLASS_TYPE__$m, teachers.FNAME, teachers.SNAME, teachers.MOTTO, teachers.IMAGE_NAME
                        FROM time_table_of_teachers
                        JOIN teachers USING (T_ID)
                        WHERE CITY__$m = '$students_city' 
                        and GRADE__$m ='$students_grade'
                        and HOW_CLASS_DO__$m = $how_classes_do
                        and SUBJECT__$m = $subject
                        and CLASS_TYPE__$m = $class_type
                        and LANGUAGES__$m LIKE $languages_or_medium
                        and teachers.FNAME = $teachers_fname
                        and teachers.SNAME = $teachers_sname
                        and INSTITUTE__$m = $institute_name;";

                      $resalt2 = mysqli_query($conn, $sql2);                   //get the resalt between $conn and, run $sql	
                      $resaltcheck2 = mysqli_num_rows($resalt2);
                      $datas2 = array();
                      if ($resaltcheck2 > 0) {
                        while ($row2 = mysqli_fetch_assoc($resalt2)) {

                          $datas2[] = $row2;
                        }
                      }





                      //If Ad slot 1 is empty? -> Ad slot 2 Accoding to student's district and grade

                      $sql3 = "SELECT T_ID, GRADE__$m, SUBJECT__$m, BATCH__$m, CLASS_DATE__$m, CLASS_BEGIN__$m, CLASS_END__$m, HOW_CLASS_DO__$m, DISTRICT__$m , CITY__$m, INSTITUTE__$m, LANGUAGES__$m, CLASS_TYPE__$m, teachers.FNAME, teachers.SNAME, teachers.MOTTO, teachers.IMAGE_NAME
                      FROM time_table_of_teachers
                      JOIN teachers USING (T_ID)
                      WHERE DISTRICT__$m = '$students_distrcict' 
                      and GRADE__$m ='$students_grade' and CITY__$m != '$students_city'
                      and HOW_CLASS_DO__$m = $how_classes_do
                      and SUBJECT__$m = $subject
                      and CLASS_TYPE__$m = $class_type
                      and LANGUAGES__$m LIKE $languages_or_medium
                      and teachers.FNAME = $teachers_fname
                      and teachers.SNAME = $teachers_sname
                      and INSTITUTE__$m = $institute_name;";




                      $resalt3 = mysqli_query($conn, $sql3);                   //get the resalt between $conn and, run $sql	
                      $resaltcheck3 = mysqli_num_rows($resalt3);
                      $datas3 = array();
                      if ($resaltcheck3 > 0) {
                        while ($row3 = mysqli_fetch_assoc($resalt3)) {
                          $datas3[] = $row3;
                        }
                      }







                      //If Ad slot 2 is empty? -> Ad slot 3 Accoding to student's grade only

                      $sql4 = "SELECT T_ID, GRADE__$m, SUBJECT__$m, BATCH__$m, CLASS_DATE__$m, CLASS_BEGIN__$m, CLASS_END__$m, HOW_CLASS_DO__$m, DISTRICT__$m , CITY__$m, INSTITUTE__$m, LANGUAGES__$m, CLASS_TYPE__$m, teachers.FNAME, teachers.SNAME, teachers.MOTTO, teachers.IMAGE_NAME
                      FROM time_table_of_teachers
                      JOIN teachers USING (T_ID)
                      WHERE GRADE__$m ='$students_grade'
                      and  DISTRICT__$m != '$students_distrcict'
                      and HOW_CLASS_DO__$m = $how_classes_do
                      and SUBJECT__$m = $subject
                      and CLASS_TYPE__$m = $class_type
                      and LANGUAGES__$m LIKE $languages_or_medium
                      and teachers.FNAME = $teachers_fname
                      and teachers.SNAME = $teachers_sname
                      and INSTITUTE__$m = $institute_name;";



                      $resalt4 = mysqli_query($conn, $sql4);                   //get the resalt between $conn and, run $sql	
                      $resaltcheck4 = mysqli_num_rows($resalt4);
                      $datas4 = array();
                      if ($resaltcheck4 > 0) {
                        while ($row4 = mysqli_fetch_assoc($resalt4)) {
                          $datas4[] = $row4;
                        }
                      }


                      
                      //print_r($datas3);
                      //echo $sql4;
                      
                      
                      
                      //District and City Filters. This is a special filter. First check, Students_city in database is not equel to the value of Students_city now. If it's not. Then it means filter has applyed. Because of that, Ad slot 2 and 3 make empty
                      if ($students_distrcict != $datas[0]['DISTRICT'] && $students_city != NULL || 
                          $students_city != $datas[0]['CITY'] && $students_city != NULL) {
                        $datas3 = array();
                        $datas4 = array();
                      }

                      

                      if(isset($_GET['District']) && isset($_GET['City'])){
                        if($_GET['City'] == NULL){ //It means user selected all city
                          $datas2 = array();
                          $datas4 = array();
                        }
                      }

                      
                      //Class Type filter
                      if(isset($_GET['class_type_from_filter']) ){
                        // $datas3 = array(); //Beyond the district ads won't appear
                        $datas4 = array();
                      }


                      
                      

                      
                      

                      for ($n = 0; $n < count(${'datas' . $q}); $n++) {
                        $subject = ${'datas' . $q}[$n]["SUBJECT__$m"]; //datas2[0][SUBJECT__7]
                        $teachers_fname = ${'datas' . $q}[$n]["FNAME"];
                        $teachers_sname =  ${'datas' . $q}[$n]["SNAME"];
                        $teachers_motto = ${'datas' . $q}[$n]["MOTTO"];
                        $how_classes_do = ${'datas' . $q}[$n]["HOW_CLASS_DO__$m"];
                        $class_type = ${'datas' . $q}[$n]["CLASS_TYPE__$m"]; //datas3[0][CLASS_TYPE__5]
                        $institute = ${'datas' . $q}[$n]["INSTITUTE__$m"];
                        $institute = ${'datas' . $q}[$n]["INSTITUTE__$m"];
                        $subject_teaching_district = ${'datas' . $q}[$n]["DISTRICT__$m"];
                        $subject_teaching_city = ${'datas' . $q}[$n]["CITY__$m"];
                        $image = ${'datas' . $q}[$n]["IMAGE_NAME"];
                        $batch = ${'datas' . $q}[$n]["BATCH__$m"];
                        $languages = ${'datas' . $q}[$n]["LANGUAGES__$m"];
                        $grade = ${'datas' . $q}[$n]["GRADE__$m"];
                        $class_date = ${'datas' . $q}[$n]["CLASS_DATE__$m"];
                        $class_begin = ${'datas' . $q}[$n]["CLASS_BEGIN__$m"];
                        $class_end = ${'datas' . $q}[$n]["CLASS_END__$m"];


                        //Prettyfing subject data
                        if ($subject == 'SFT') {
                          $subject = 'Science For Technology';
                        } elseif ($subject == 'ICT') {
                          $subject = 'Information Commucation Technology';
                        } elseif ($subject == 'BST') {
                          $subject = 'Bio Systems Technology';
                        } elseif ($subject == 'ET') {
                          $subject = 'Engeneering Technology';
                        }


                        //Prettyfing grade data
                        switch ($grade) {
                          case 'AL':
                            $grade = 'A/L';
                            break;
                          
                          case 'OL':
                            $grade = 'GCE O/L';
                            break;

                          case 'grade_9':
                            $grade = 'Grade 9';
                            break;

                          case 'grade_8':
                            $grade = 'Grade 8';
                            break;

                          case 'grade_7':
                            $grade = 'Grade 7';
                            break;


                          case 'grade_6':
                            $grade = 'Grade 6';
                            break;


                          case 'grade_5':
                            $grade = 'Grade 5';
                            break;


                          case 'grade_4':
                            $grade = 'Grade 4';
                            break;

                          case 'grade_3':
                            $grade = 'Grade 3';
                            break;

                          case 'grade_2':
                            $grade = 'Grade 2';
                            break;

                          case 'grade_1':
                            $grade = 'Grade 1';
                            break;
                          
                        }
                          
                          
                        
                        //Prettyfing batch data
                        switch($batch){
                          case 'All':
                            $batch = '';
                        }

                        
                        
                        //Prettyfing how_classes_do data
                        $how_classes_do_icon = '';
                        $how_classes_do_icon_2 = '';
                        $nbsp = '';
                        if($how_classes_do == 'online'){
                          $how_classes_do_icon = "class = 'ti-rss-alt'";
                          $how_classes_do_icon_2 = '';
                          $nbsp = '';
                        
                        }else if($how_classes_do == 'physical'){
                          $how_classes_do_icon = "class = 'ti-pin-alt'";
                          $how_classes_do_icon_2 = '';
                          $nbsp = '';
                          
                        
                        }else if($how_classes_do == 'both'){
                          $how_classes_do_icon = "class = 'ti-rss-alt'";
                          $how_classes_do_icon_2 = "class = 'ti-pin-alt'";
                          $nbsp = '&nbsp';
                        }


                        //Prettyfing district and city data
                        switch ($subject_teaching_district){
                            case 'Whole country':
                              $subject_teaching_city = 'online';
                              break;
                        }


                        //Prettyfing class_begin and class_end data
                        $class_begin =  date('h:i a ', strtotime($class_begin));
                        $class_end = date('h:i a ', strtotime($class_end));
                        
                        
                        //prettyfing institute
                        if($institute == NULL){
                          $institute = "Not available";
                        }

                        //prettyfing languages
                        $languages = str_replace("/", "",$languages);
                        
                        
                        

                        echo

                        "<div class='NextSearchResultView__rowLayout' data-testid='SearchResultView'>
                  <div class='SearchProductRowLayout' data-testid='ProductRow' data-crometrics-resourceid='4408047'
                    data-crometrics-isonlineresource='false' data-crometrics-isavailablefordigital='false'
                    data-crometrics-issellerpublisheddigital='false'
                    data-crometrics-isavailableonschoolaccess='false'>
                    <div>
                      <div class='NextSearchProductRowLayout__thumbnailContainer'>
                        <div class='SearchProductRowLayout__image'>
                          <div class='ProductRowImageBespoke'><a aria-hidden='true' tabindex='-1'
                              class='Anchor Anchor--green'
                              >
                              <div class='ImageMagnifier'>
                                
                              <img data-testid='ImageMagnifier__baseImage' class='ProductImage ProductImage--medium' src='../uploads/$image' id='image_expanner' class='images'>
                                <img data-testid='ImageMagnifier__largeImage' class='ImageMagnifier__largeImage' src='./Mathamatics Worksheets &amp; Teaching Resources _ Teachers Pay Teachers_files/original-4408047-1.jpg'>
                              </div>
                            </a></div>
                              
                              <script>
                                $(function () {
                                    $(document).on('click', '.images', function () {
                                        $(this).cpLightimg();
                                    });
                                    });
                                x</script>


                        </div>
                      </div>
                      <div class='NextSearchProductRowLayout__titleContainer'>
                        <div>
                          <div class='ProductRowTitleBespoke'>
                            <h2><a data-testid='ProductRowTitleBespoke__link' class='Anchor Anchor--black'>
                              $subject ($grade) $batch</a></h2>
                          </div>
                          <div class='NextSearchProductRowLayout__store'>
                            <div class='ProductRowStoreBespoke'><a class='Avatar ProductRowStoreBespoke__avatar'
                                ><img
                                  alt='Little Footsteps Big Learning' class='Avatar__img Avatar__img--small'
                                  src='../uploads/$image'
                                  data-pin-nopin='true' loading='auto'></a>by <div
                                class='ProductRowStoreBespoke__storeName'>$teachers_fname $teachers_sname </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class='NextSearchProductRowLayout__ratingPriceMetadata'>
                        <div class='NextSearchProductRowLayout__ratingPriceContainer align-items-center  d-lg-block' style='width:100%'>
                          <div class='NextSearchProductRowLayout__ratingsContainer'>
                            <div class='ProductRowRatingBespoke'></div>
                          </div>
                          <div class='NextSearchProductRowLayout__priceContainer'>
                            <div class='ProductRowPriceAndBundleText'>
                              <div class='ProductRowPriceBespoke'>
                                <div
                                  class='ProductRowPriceBespoke__priceRow ProductRowPriceBespoke__discountPriceToTheRight d-none d-md-block'>
                                  <div data-testid='productrow-price-original' style='font-size: .9rem;'>$subject_teaching_district - $subject_teaching_city</div>
                                </div>
                                <div
                                  class='ProductRowPriceBespoke__priceRow ProductRowPriceBespoke__priceRow__noBottomMargin d-flex justify-content-center'>
                                  <i $how_classes_do_icon>&nbsp</i> <i $how_classes_do_icon_2>$nbsp</i> $how_classes_do</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class='DigitalBadgeMobileWrapper'>
                          <div class='ProductRowFileInfoBespoke'>

                          </div>
                        </div>
                      </div>
                      <div class='NextSearchProductRowLayout__descriptionContainer'>
                        <div data-testid='SearchProductRowLayoutDescription' class='d-block justify-content-center align-items-center'>
                          <div>
                            <br>
                          </div>
                          <div>
                            <div class='ProductRowFacetsBespoke'>
                              <div class='LabeledSection row'>
                                <div class='LabeledSection__title col-xs-2 col-sm-3 col-md-2'>Class :</div>
                                <div data-testid='LabeledSectionContent' class='col-xs-10 col-sm-9 col-md-10'>
                                  <div class='TruncatedTextBox LabeledSection__content'
                                    style='-webkit-line-clamp: 2; max-height: 2.75em; line-height: 1.375;'>
                                    <div><span> $class_type</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class='LabeledSection row'>
                                <div class='LabeledSection__title col-xs-2 col-sm-3 col-md-2'>Institute :</div>
                                <div data-testid='LabeledSectionContent' class='col-xs-10 col-sm-9 col-md-10'>
                                  <div class='TruncatedTextBox LabeledSection__content'
                                    style='-webkit-line-clamp: 2; max-height: 2.75em; line-height: 1.375;'>
                                    <div class='NotLinkedSection'><span><span>@ $institute</span></span>
                                    </div>
                                  </div>
                                </div>
                              
                              </div><div class='LabeledSection row'>
                              <div class='LabeledSection__title col-xs-2 col-sm-3 col-md-2'>Medium :</div>
                              <div data-testid='LabeledSectionContent' class='col-xs-10 col-sm-9 col-md-10'>
                                <div class='TruncatedTextBox LabeledSection__content'
                                  style='-webkit-line-clamp: 2; max-height: 2.75em; line-height: 1.375;'>
                                  <div class='NotLinkedSection'><span><span>$languages</span></span>
                                  </div>
                                </div>
                              </div>
                            </div>
                              
                            
                            <div class='LabeledSection row'>

                                <div data-testid='LabeledSectionContent' class='col-xs-10 col-sm-9 col-md-10'>
                                  <div class='TruncatedTextBox LabeledSection__content'
                                    style='-webkit-line-clamp: 2; max-height: 2.75em; line-height: 1.375;'>

                                  </div>
                                </div>
                              </div>
                              <div>
                                <div class=''>
                                  <div class='StandardRowFacets'>
                                    <div class='LabeledSection row'>
                                      <div class='LabeledSection__title col-xs-2 col-sm-3 col-md-2'>Time:</div>
                                      <div data-testid='LabeledSectionContent' class='col-xs-10 col-sm-9 col-md-10'>
                                        <div class='AnchorList'><span><a label='K.CC.A.1' tooltiptext=''
                                              class='Anchor Anchor--gray'
                                              >$class_date $class_begin - $class_end</span></div> 
                                      </div>
                                    </div>
                                  </div>
                                </div><br/><br/><div class='d-xs-flex d-lg-none d-sm-none card flex-column align-items-center justify-content-center' style='font-size:.8rem;'><span><b>$subject_teaching_district - $subject_teaching_city</b></span><span> </span></div>
                              </div>
                            </div>
                            
                            <div class='d-xs-none d-sm-block'></div>
                          </div>
                        </div>
                        
                      </div>
                      <div class='NextSearchProductRowLayout__actionsContainer'>
                        <div class='CartButtonContainer'>
                        
                            <button
                                class='CartButton legacyButton Button Button--small Button--fullWidth Button--primary '
                                type='button' style='background-color: #DC3545; border-radius: 25px; color:#fff; ' 
                                id='fav_button_$stop_overlap' onclick='btn_animation($stop_overlap)'>Favourites
                                  
                                <link rel='stylesheet' href='Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers_files/like svg button animation/like svg button animation.css'>
                                  <input type='checkbox' class='checkbox' id='checkbox_$stop_overlap'/>
                                    <label for='checkbox'>
                                        <svg id='heart-svg' viewBox='467 392 58 57' xmlns='http://www.w3.org/2000/svg'>
                                            <g id='Group' fill='none' fill-rule='evenodd' transform='translate(467 392)'>
                                                <path
                                                    d='M29.144 20.773c-.063-.13-4.227-8.67-11.44-2.59C7.63 28.795 28.94 43.256 29.143 43.394c.204-.138 21.513-14.6 11.44-25.213-7.214-6.08-11.377 2.46-11.44 2.59z'
                                                    id='heart' fill='#AAB8C2' />
                                                <circle id='main-circ' fill='#E2264D' opacity='0' cx='29.5' cy='29.5' r='1.5' />

                                                <g id='grp7' opacity='0' transform='translate(7 6)'>
                                                    <circle id='oval1' fill='#9CD8C3' cx='2' cy='6' r='2' />
                                                    <circle id='oval2' fill='#8CE8C3' cx='5' cy='2' r='2' />
                                                </g>

                                                <g id='grp6' opacity='0' transform='translate(0 28)'>
                                                    <circle id='oval1' fill='#CC8EF5' cx='2' cy='7' r='2' />
                                                    <circle id='oval2' fill='#91D2FA' cx='3' cy='2' r='2' />
                                                </g>

                                                <g id='grp3' opacity='0' transform='translate(52 28)'>
                                                    <circle id='oval2' fill='#9CD8C3' cx='2' cy='7' r='2' />
                                                    <circle id='oval1' fill='#8CE8C3' cx='4' cy='2' r='2' />
                                                </g>

                                                <g id='grp2' opacity='0' transform='translate(44 6)'>
                                                    <circle id='oval2' fill='#CC8EF5' cx='5' cy='6' r='2' />
                                                    <circle id='oval1' fill='#CC8EF5' cx='2' cy='2' r='2' />
                                                </g>

                                                <g id='grp5' opacity='0' transform='translate(14 50)'>
                                                    <circle id='oval1' fill='#91D2FA' cx='6' cy='5' r='2' />
                                                    <circle id='oval2' fill='#91D2FA' cx='2' cy='2' r='2' />
                                                </g>

                                                <g id='grp4' opacity='0' transform='translate(35 50)'>
                                                    <circle id='oval1' fill='#F48EA7' cx='6' cy='5' r='2' />
                                                    <circle id='oval2' fill='#F48EA7' cx='2' cy='2' r='2' />
                                                </g>

                                                <g id='grp1' opacity='0' transform='translate(24)'>
                                                    <circle id='oval1' fill='#9FC7FA' cx='2.5' cy='3' r='2' />
                                                    <circle id='oval2' fill='#9FC7FA' cx='7.5' cy='2' r='2' />
                                                </g>
                                            </g>
                                        </svg>
                                    </label>
                            </button>
                            
                            <script>
                                add_to_favourites = 0;

                                function btn_animation(order){
                                      

                                    if(add_to_favourites == 0){
                                        $('#checkbox_' + order).attr('checked',true);
                                        add_to_favourites = 1;


                                    }else if(add_to_favourites == 1){
                                        $('#checkbox_' + order).attr('checked',false);
                                        add_to_favourites = 0;
                                    }
                                }
                            </script>
                              
                              
                        </div>
                        <div class='SearchProductRowLayout__wishListLink'><button
                          class='CartButton legacyButton Button Button--medium Button--fullWidth Button--primary'
                          type='button' style='background-color: #0BA96C; border-radius: 25px;'>Contact Teacher</button></div>


                                    
                      



                      </div>
                      
                    </div>
                    
                  </div>
                  <div class='Box Box--margin-top-sm'></div>
                </div>";

                array_push($counting_array,1); //Counting the amount of results
                $stop_overlap++;
                
                    
                
              }
              
            
            }
            
            
            
          }

                  
          //echo count($counting_array);
          $count_of_results = count($counting_array);
          

          














                  ?>

                
              <!--  Starts Change the value of the Result Shower element -->
              <script>
              $(document).ready(function() {
                var count_of_results = "<?php echo $count_of_results; ?>";
                
                if((count_of_results >= 0)){
                  $("#results_shower").text(count_of_results + " results");
                }
              });
              </script>
              <!--  Ends Change the value of the Result Shower element -->

              
              <!-- Image Enlarger plugin Starts here-->
              <script>
                $(function() {
                  $(document).on("click", "#image_expanner", function() {
                    $(this).cpLightimg();
                  });
                });
                x
              </script>
              <!-- Image Enlarger plugin ends here-->
                  

              
              


                  <!--Starts New informations-->
                  <!-- <div class="d-xs-none d-md-block" data-testid="PromoProductsContainer"></div>



                  <div class="NextSearchResultView__rowLayout" data-testid="SearchResultView">
                    <div class="SearchProductRowLayout" data-testid="ProductRow" data-crometrics-resourceid="4408047" data-crometrics-isonlineresource="false" data-crometrics-isavailablefordigital="false" data-crometrics-issellerpublisheddigital="false" data-crometrics-isavailableonschoolaccess="false">
                      <div>
                        <div class="NextSearchProductRowLayout__thumbnailContainer">
                          <div class="SearchProductRowLayout__image">
                            <div class="ProductRowImageBespoke"><a aria-hidden="true" tabindex="-1" class="Anchor Anchor--green">
                                <div class="ImageMagnifier">

                                  <img data-testid="ImageMagnifier__baseImage" class="ProductImage ProductImage--medium" src="ErJ4ucjXcBI2qzZ.jpg" id="image_expanner">
                                  <img data-testid="ImageMagnifier__largeImage" class="ImageMagnifier__largeImage" src="./Mathamatics Worksheets &amp; Teaching Resources _ Teachers Pay Teachers_files/original-4408047-1.jpg">
                                </div>
                              </a></div>

                            <script>
                              $(function() {
                                $(document).on("click", "#image_expanner", function() {
                                  $(this).cpLightimg();
                                });
                              });
                              x
                            </script>


                          </div>
                        </div>
                        <div class="NextSearchProductRowLayout__titleContainer">
                          <div>
                            <div class="ProductRowTitleBespoke">
                              <h2><a data-testid="ProductRowTitleBespoke__link" class="Anchor Anchor--black">
                                  Logics</a></h2>
                            </div>
                            <div class="NextSearchProductRowLayout__store">
                              <div class="ProductRowStoreBespoke"><a class="Avatar ProductRowStoreBespoke__avatar" href="https://www.teacherspayteachers.com/Store/Little-Footsteps-Big-Learning"><img alt="Little Footsteps Big Learning" class="Avatar__img Avatar__img--small" src="./Mathamatics Worksheets &amp; Teaching Resources _ Teachers Pay Teachers_files/6020101.jpg" data-pin-nopin="true" loading="auto"></a>by <div class="ProductRowStoreBespoke__storeName"><a class="Anchor Anchor--green" href="https://www.teacherspayteachers.com/Store/Little-Footsteps-Big-Learning">Wasantha
                                    Karunathilaka</a></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="NextSearchProductRowLayout__ratingPriceMetadata">
                          <div class="NextSearchProductRowLayout__ratingPriceContainer">
                            <div class="NextSearchProductRowLayout__ratingsContainer">
                              <div class="ProductRowRatingBespoke"></div>
                            </div>
                            <div class="NextSearchProductRowLayout__priceContainer">
                              <div class="ProductRowPriceAndBundleText">
                                <div class="ProductRowPriceBespoke">
                                  <div class="ProductRowPriceBespoke__priceRow ProductRowPriceBespoke__discountPriceToTheRight">
                                    <div data-testid="productrow-price-original" style="font-size: .9rem;">⭐️ VIP MEMBER
                                      ⭐️</div>
                                  </div>
                                  <div class="ProductRowPriceBespoke__priceRow ProductRowPriceBespoke__priceRow__noBottomMargin">
                                    124 Followers</div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="DigitalBadgeMobileWrapper">
                            <div class="ProductRowFileInfoBespoke">

                            </div>
                          </div>
                        </div>
                        <div class="NextSearchProductRowLayout__descriptionContainer">
                          <div data-testid="SearchProductRowLayoutDescription" class="d-sm-block d-xs-none">
                            <div>
                              <div class="SearchProductRowLayout__description">
                                <div class="TruncatedTextBox" style="-webkit-line-clamp: 3; max-height: 4.125em; line-height: 1.375; min-height: 4.125em; height: 4.125em;">
                                  මහනුවර ධර්මරාජ විදුහලේ එකම සහ හොඳම තර්ක ශාස්ත්‍ර ආචාර්ය විසින් මෙහෙයවන පන්තියට සහභාගීවන්න.</div>
                              </div>
                            </div>
                            <div>
                              <div class="ProductRowFacetsBespoke">
                                <div class="LabeledSection row">
                                  <div class="LabeledSection__title col-xs-2 col-sm-3 col-md-2">Class Type:</div>
                                  <div data-testid="LabeledSectionContent" class="col-xs-10 col-sm-9 col-md-10">
                                    <div class="TruncatedTextBox LabeledSection__content" style="-webkit-line-clamp: 2; max-height: 2.75em; line-height: 1.375;">
                                      <div><span>&nbsp; Online</span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="LabeledSection row">
                                  <div class="LabeledSection__title col-xs-2 col-sm-3 col-md-2">Institute :</div>
                                  <div data-testid="LabeledSectionContent" class="col-xs-10 col-sm-9 col-md-10">
                                    <div class="TruncatedTextBox LabeledSection__content" style="-webkit-line-clamp: 2; max-height: 2.75em; line-height: 1.375;">
                                      <div class="NotLinkedSection"><span><span>@ Rotary - Nugegoda</span></span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="LabeledSection row">

                                  <div data-testid="LabeledSectionContent" class="col-xs-10 col-sm-9 col-md-10">
                                    <div class="TruncatedTextBox LabeledSection__content" style="-webkit-line-clamp: 2; max-height: 2.75em; line-height: 1.375;">

                                    </div>
                                  </div>
                                </div>
                                <div>
                                  <div class="">
                                    <div class="StandardRowFacets">
                                      <div class="LabeledSection row">
                                        <div class="LabeledSection__title col-xs-2 col-sm-3 col-md-2">Where:</div>
                                        <div data-testid="LabeledSectionContent" class="col-xs-10 col-sm-9 col-md-10">
                                          <div class="AnchorList"><span><a label="K.CC.A.1" tooltiptext="" class="Anchor Anchor--gray" href="https://www.teacherspayteachers.com/Browse/Core-Standard/K.CC.A.1">Colombo
                                                - Nugegoda</span></div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <div class="d-xs-none d-sm-block"></div>
                            </div>
                          </div>
                          <br />
                        </div>
                        <div class="NextSearchProductRowLayout__actionsContainer">
                          <div class="CartButtonContainer"><button class="CartButton legacyButton Button Button--medium Button--fullWidth Button--primary" type="button" style="background-color: #D30104; border-radius: 25px;">FOLLOW</button>
                          </div>
                          <div class="SearchProductRowLayout__wishListLink"><button class="CartButton legacyButton Button Button--medium Button--fullWidth Button--primary" type="button" style="background-color: #0BA96C; border-radius: 25px;">Contact Teacher</button></div>

                        </div>
                      </div>
                    </div> -->
                    <!--Ends New informations-->

                    



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

  

  <script nomodule="" src="./Mathamatics Worksheets &amp; Teaching Resources _ Teachers Pay Teachers_files/tpt-frontend.polyfills.8a04fa49638edb462e84.js.download" crossorigin="anonymous"></script>

  <script data-tpt="" src="./Mathamatics Worksheets &amp; Teaching Resources _ Teachers Pay Teachers_files/tpt-frontend.init.9913f03a48be5c81ccad.js.download" crossorigin="anonymous"></script>
  <script data-tpt="" src="./Mathamatics Worksheets &amp; Teaching Resources _ Teachers Pay Teachers_files/tpt-frontend.responsiveGrid.47222f7782c2ebff28b8.js.download" crossorigin="anonymous"></script>
  <script data-tpt="" src="./Mathamatics Worksheets &amp; Teaching Resources _ Teachers Pay Teachers_files/tpt-frontend.legacyGrid.1770dd8c6a23639f39d2.js.download" crossorigin="anonymous"></script>
  <script data-tpt="" src="./Mathamatics Worksheets &amp; Teaching Resources _ Teachers Pay Teachers_files/tpt-frontend.vendor.bc5858f8d0a14d26fcf4.js.download" crossorigin="anonymous"></script>
  <script data-tpt="" src="./Mathamatics Worksheets &amp; Teaching Resources _ Teachers Pay Teachers_files/tpt-frontend.main.527a4bd9e67d73bc3e7b.js.download" crossorigin="anonymous"></script>
  <script data-tpt="">
    __TPT__.init(window.__TPT_s)
      .catch(function(e) {
        console.log('Unhandled Promise Rejection:', e);
        if (window.Bugsnag) {

          Bugsnag.notify(e);
        }
      });
    delete window.__TPT_s;
  </script>


  <iframe src="./Mathamatics Worksheets &amp; Teaching Resources _ Teachers Pay Teachers_files/a11000223989.html" hidden="" tabindex="-1" title="Optimizely Internal Frame" height="0" width="0" style="display: none;"></iframe>
  <div style="width:0px; height:0px; display:none; visibility:hidden;" id="batBeacon214063504519"><img style="width:0px; height:0px; display:none; visibility:hidden;" id="batBeacon588557211956" width="0" height="0" alt="" src="./Mathamatics Worksheets &amp; Teaching Resources _ Teachers Pay Teachers_files/0"></div><iframe name="_hjRemoteVarsFrame" title="_hjRemoteVarsFrame" id="_hjRemoteVarsFrame" src="./Mathamatics Worksheets &amp; Teaching Resources _ Teachers Pay Teachers_files/box-acca23410e696f2ca3087d947271c3d0.html" style="display: none !important; width: 1px !important; height: 1px !important; opacity: 0 !important; pointer-events: none !important;"></iframe>
  <script src="./Mathamatics Worksheets &amp; Teaching Resources _ Teachers Pay Teachers_files/s.js.download"></script>
</body>







    






 
</html>






<?php
ob_end_flush(); // Flush the output from the buffer
?>


<html>
  <body>
   

  </body>
</html>