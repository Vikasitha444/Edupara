<?php

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
<meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *Must* come first in the head; any other head content must come *after* these tags -->
    

    <!-- Title -->
    <title>Best teachers in Sri Lanka to brighten your future | Edupara.lk</title>

    <!-- Favicon -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="style.css">

    <!-- jquery -->
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>

    <style>
        input[type="search"]{
            height: 60px;
            font-size:17px;
            
          }
      </style>

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
                margin-top : -0px;
                margin-right : 0px;
                height : 60px;
                
                
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
<!-- beautified dropdown nearby search css ends here -->

<!-- Themify Icons Plugin Stars here -->
    <link rel="stylesheet" href="Themefy icons plugin/themify-icons.css">
<!-- Themify Icons Plugin Stars here -->


<!-- jquery -->
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>

<!-- City css starts here -->
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
<!-- City css ends here -->



</head>

  

  
        
      



  



<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner"></div>
    </div>

    <!-- ##### Header Area Start ##### -->
    <header class="header-area">

        

        <!-- Navbar Area -->
        <div class="clever-main-menu">
            <div class="classy-nav-container breakpoint-off">
                <!-- Menu -->
                <nav class="classy-navbar justify-content-between" id="cleverNav">

                    <!-- Logo -->
                    <!-- <a class="nav-brand" href="index.html"><img src="img/core-img/logo.png" alt=""></a> -->
                    <a class="nav-brand" href="index.php?"><img src="img/core-img/logo.png" alt=""></a>

                    <!-- Navbar Toggler -->
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>

                    <!-- Menu -->
                    <div class="classy-menu">

                        <!-- Close Button -->
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>

                        <!-- Nav Start -->
                        <div class="classynav">
                            <ul>
                                <li><a href="index.php?">Home</a></li>
                                <!-- <li><a href="#">Pages</a>
                                    <ul class="dropdown">
                                        <li><a href="#">Home</a></li>
                                        <li><a href="courses.html">Courses</a></li>
                                        <li><a href="single-course.html">Single Courses</a></li>
                                        <li><a href="instructors.html">Instructors</a></li>
                                        <li><a href="blog.html">Blog</a></li>
                                        <li><a href="blog-details.html">Single Blog</a></li>
                                        <li><a href="regular-page.html">Regular Page</a></li>
                                        <li><a href="contact.html">Contact</a></li>
                                    </ul>
                                </li> -->
                                <li><a href="../main_ads_grid/Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?">Student's Login</a></li>
                                <li><a href="../Teachers login/teachers_dashboard/index_original.php?">Teacher's Login</a></li>
                                <li><a href="#">Institute's Login</a></li>
                                <li><a href="contact.php?">Contact us</a></li>
                            </ul>

                            &nbsp &nbsp &nbsp &nbsp

                            <!-- Register / Login -->
                            <div class="register-login-area">
                                <a href="#registration_panel" class="btn">Register As</a>
                                <a href="#login_forms" class="btn active" id="login_as_button">Login As</a>
                            </div>

                        </div>
                        <!-- Nav End -->
                    </div>
                </nav>
            </div>
        </div>
    </header>
    

    <script>
        var clicked_times = 0;
        $(document).ready(function(){
            $("#login_as_button").click(function(){
                clicked_times ++;
                if(clicked_times == 5){
                    clicked_times = 0;
                    window.location.replace('../Admins_login/admins_login.php?');
                } 
            });
        });
    </script>
    <!-- ##### Header Area End ##### -->

    <!-- ##### Hero Area Start ##### -->
    <section class="hero-area bg-img bg-overlay-2by5" style="background-image: url(https://www.adb.org/sites/default/files/styles/content_media/public/content-media/29496-sri-lanka-s-and-t-final.jpg?itok=XxUxcXnI);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <!-- Hero Content -->
                    <div class="hero-content text-center">
                        <h2>You Learn. Let us take care of your teacher !</h2>
                        <a href="#get_started_button_link_here" class="btn clever-btn">Get Started</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Hero Area End ##### -->

    

    

    
    
    
    
    
   <!-- additional detils (Search & dropdown) starts here -->
   <div class="row SecondaryHeaderLayout d-flex flex-column flex-sm-row  p-100 justify-content-center mt-100">
            <div class="col-auto d-lg-flex"> 
                <div class="CategoryMenu__buttonContent"><span class="label">
            
                <div class="dropdown">
                <button onclick="myFunction()" class="center">Subject &nbsp <i class="ti-angle-down"></i></button>
                <div id="myDropdown" class="dropdown-content">
                    <a href="#" value="subject" id="subject" class="dropitems" HiddenValue="Subject"><i class="ti-book">&nbsp</i>Subject</a>
                    <a href="#" value="teacher" id="teacher" class="dropitems"><i class="ti-user">&nbsp</i>Teacher</a>
                    <!-- <a href="#" value="grade" id="grade" class="dropitems"><i class="ti-medall-alt">&nbsp</i>Grade</a> -->
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
            
            
            <script>
                $('.new2').prettyDropdown();
            </script>
            

            </div>
            
            <!-- Search Starts Here -->
            <div class="col-lg-5 col d-flex justify-content-around w-100">
            <div class="SearchAutosuggestBespoke d-flex h-5">
                
                <div class="react-autosuggest__container">
                    <!-- <input type="search" list="skills"  id="SearchBar" autocomplete="off" role="combobox" aria-autocomplete="list" aria-owns="react-autowhatever-1" aria-expanded="false" aria-haspopup="false" class="react-autosuggest__input flexdatalist form-control" aria-label="Search" inputmode="text" placeholder="Select a category" name = "Search_bar">  -->
                    <input type="search" list="skills"  id="SearchBar" autocomplete="off" role="combobox" aria-autocomplete="list" aria-owns="react-autowhatever-1" aria-expanded="false" aria-haspopup="false" class="react-autosuggest__input flexdatalist form-control" aria-label="Search" inputmode="text" placeholder="Select a category" name = "Search_bar">
                            <!-- Do not delete this text  -->
                    <label for="SearchBar" class="invisible">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Praesentium optio perferendis harum reiciendis aliquid non provident expedita similique rem, unde alias culpa odio, impedit beatae natus, obcaecati possimus! Et, inventore.</label> 
                    <div id="react-autowhatever-1" class="react-autosuggest__suggestions-container"></div>
                </div>
                <!-- <button type="submit" aria-label="Search" class="SearchAutosuggestBespoke__button" name="Search_button"><span class="tpticon tpticon-search SearchAutosuggestBespoke__buttonIcon"></span></button> -->
                
                <button class="btn" type="submit" aria-label="Search" name="Search_button" style="height: 60px; width: auto; background-color:#0BA96C"><i class="ti-search" style="color:white"></i></button>
                
            </div>
            </div>
        </div>

            <script>
                    function category(e){
                    window.selected_category = e;
                    //document.writeln(selected_category);
                    }

                    $("button[name = 'Search_button']").click(function(){
                        var search_query = encodeURIComponent($("#SearchBar").val());
                        window.location.replace("info of anno.php?selected_category="+selected_category+"&Search_bar="+search_query+"&nonAL=true");

                    });
            </script>

            <script>
                var searched_query = "<?php echo $searched_query; ?>";
                var selected_category_by_user = "<?php echo $selected_category_by_user; ?>";
                

                if(searched_query.length > 0 && selected_category_by_user.length > 0){
                    $("#SearchBar").attr('value',searched_query);
                    }
            </script>

            
            


            <!-- Assign Defaults -->

            
            <script>
                        
                var selected_category = "<?php 
                                                if(isset($_GET['selected_category'])){
                                                echo $_GET['selected_category'];
                                                }else{
                                                echo "val_didnot_parsed";
                                                }
                                            ?>";
                
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

                            if(selected_category == 'subject'){
                                all_subjects();
                            }
                    });
                
                }
                </script>

                <script>

                    $('.dropitems').click(function(){
                        var selected_value_from_dropdown = $(this).attr('value');
                        
                        $("#SearchBar").attr('value','');

                        if(selected_value_from_dropdown == 'subject'){
                            $("#SearchBar").attr("placeholder","Search a subject");
                            category('subject'); // Calling function category and pass the value 'Subject'

                            if(selected_category == 'subject'){
                                all_subjects();
                            }
                        
                        
                        }else if(selected_value_from_dropdown == "teacher"){
                            $("#SearchBar").attr("placeholder","Search a teacher by name");
                            Teachers_datalist();
                            category('teacher');
                        
                        
                        }else if(selected_value_from_dropdown == "institute"){
                            $("#SearchBar").attr("placeholder","Search a institute");
                            Institute_datalist()
                            category('institute');

                        }


                    });
                
                </script>
                
                
                <script>
                    function all_subjects(){
                        $('#SearchBar').attr('list','all_subjects');
                    }

                    function Teachers_datalist(){
                        $('#SearchBar').attr('list','teachers_list');
                    }

                    function Institute_datalist(){
                        $('#SearchBar').attr('list','institutes_list');
                    }
                </script>

                <datalist id="all_subjects">
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

                        <option data-value = 'OL' value='Catholism'>Catholism</option>
                        <option data-value = 'OL' value='Islam'>Islam</option>
                        <option data-value = 'OL' value='Sinhala Language & Literature'>Sinhala Language & Literature</option>
                        <option data-value = 'OL' value='Citizenship Education'>Citizenship Education</option>
                        <option data-value = 'OL' value='Enterpreneurial Education'>Enterpreneurial Education</option>
                        <option data-value = 'OL' value='Business Studies & Accounts'>Business Studies & Accounts</option>
                        <option data-value = 'OL' value='Traditional Dancing'>Traditional Dancing</option>
                        <option data-value = 'OL' value='Sinhala Literature'>Sinhala Literature</option>
                        <option data-value = 'OL' value='English Literature'>English Literature</option>
                        <option data-value = 'OL' value='Information & Communication Technology'>Information & Communication Technology</option>
                        <option data-value = 'OL' value='Agriculture & Food Technology'>Agriculture & Food Technology</option>
                        <option data-value = 'OL' value='Art & Craft'>Art & Craft</option>
                        <option data-value = 'OL' value='Home Economics'>Home Economics</option>



                        <optgroup label="Technology Stream">
                            <option value='Information Communication Technology'>ICT - All Streams</option>
                            <option value='Science For Technology'>SFT - Technology Stream</option> 
                            <option value='Engineering Technology'>ET - Technology Stream</option> 
                            <option value='Bio System Technology'>BST - Technology Stream</option>
                        </optgroup>

                            <option value='Business Studies'>BS - Commerce Stream</option> 
                            <option value='Accountancy'>Accountancy - Commerce Stream</option> 
                            <option value='Economics'> Econ - Commerce Stream</option>
                            <option value='Business Statistics'>Business Statistics - 'Commerce Stream</option>
                            <option value='The logic and the scientific method'>Logic - Commerce Stream</option>

                            <option value='Combined mathematics'>Combined Maths - Physical Science Stream</option> 
                            <option value='Physics'>Physics - Physical Science Stream</option> 
                            


                            <option value='Biology'>Biology - Biological Science Stream</option> 
                            <option value='Chemistry'>Chemistry - Biological Science stream</option>
                            
                </datalist>

                <datalist id='teachers_list'>
                    <?php

                        $sql5 = "SELECT T_ID,teachers.FNAME, teachers.SNAME
                                FROM time_table_of_teachers
                                JOIN teachers USING (T_ID);";

                        $resalt5 = mysqli_query($conn, $sql5);                   //get the resalt between $conn and, run $sql 
                        $resaltcheck5 = mysqli_num_rows($resalt5);
                        $datas5 = array();

                        if ($resaltcheck5 > 0) {
                        while ($row5 = mysqli_fetch_assoc($resalt5)) {
                            $datas5[] = $row5;
                        }
                        
                        for ($i=0; $i < count($datas5); $i++) { 
                            $teachers_tid = $datas5[$i]['T_ID'];
                            $teachers_fname = $datas5[$i]['FNAME'];
                            $teachers_sname = $datas5[$i]['SNAME'];

                            echo " <option value='$teachers_fname $teachers_sname'>$teachers_fname $teachers_sname</option>";
                        }
                        
                        }


                        ?>
                        
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
                
                
    <!-- additional detils (Search & dropdown) ends here -->
       
        

        

        
          
          
          
        
        
      
          
      
      
        
        
        
    
        
       
        

                
      

              

          

          

        
        
               

          
        

            
          
          
          


        

        
        

        
        

    <!-- ##### Cool Facts Area Start ##### -->
    <section class="cool-facts-area section-padding-100-0" id="get_started_button_link_here">
        <div class="container">
            <div class="row">
                <!-- Single Cool Facts Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single-cool-facts-area text-center mb-100 wow fadeInUp" data-wow-delay="250ms">
                        <div class="icon">
                            <i class="ti-id-badge" style="font-size: 60px; color:#0073b9"></i><br><br><br>
                        </div>
                        <h2 id="students_count"><span class="counter">25</span></h2>
                        <h5>Active Students</h5>
                    </div>
                </div>

                <!-- Single Cool Facts Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single-cool-facts-area text-center mb-100 wow fadeInUp" data-wow-delay="500ms">
                        <div class="icon">
                            <i class="ti-user" style="font-size: 60px; color:#0073b9"></i><br><br><br>
                        </div>
                        <h2 id="teachers_count"><span class="counter">123</span></h2>
                        <h5>Registered Teachers</h5>
                    </div>
                </div>

                <!-- Single Cool Facts Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single-cool-facts-area text-center mb-100 wow fadeInUp" data-wow-delay="750ms">
                        <div class="icon">
                        <i class="ti-map-alt" style="font-size: 60px; color:#0073b9"></i><br><br><br>
                        </div>
                        <h2 id="institutes_count"><span class="counter" >89</span></h2>
                        <h5>Registered Institutes</h5>
                    </div>
                </div>

                <!-- Single Cool Facts Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single-cool-facts-area text-center mb-100 wow fadeInUp" data-wow-delay="1000ms">
                        <div class="icon">
                            <i class="ti-book" style="font-size: 60px; color:#0073b9"></i><br><br><br>
                        </div>
                        <h2><span class="counter">56</span></h2>
                        <h5>Classes And Courses</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
    

    <?php
        //Selecting the amount of teachers
        $result8 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) FROM teachers;"));
        $teachers_amount  = intval($result8['COUNT(*)']);
        
        //Selecting the amount of students
        $resalt9 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) FROM students;"));
        $students_amount  =  intval($resalt9['COUNT(*)']);
        
        //Selecting the amount of institutes
        $sum_of_institutes = 0;
        for ($k=1; $k <= $count_of_subject_columns; $k++) { 
            
        
                $sql10 = "  SELECT COUNT(INSTITUTE__$k)
                            FROM time_table_of_teachers 
                            WHERE INSTITUTE__$k != '' OR INSTITUTE__$k != NULL;";

                $resalt10 = mysqli_query($conn, $sql10);                   //get the resalt between $conn and, run $sql 
                $resaltcheck10 = mysqli_num_rows($resalt10);
                $datas10 = array();

                if ($resaltcheck10 > 0) {
                    while ($row10 = mysqli_fetch_assoc($resalt10)) {
                    $datas10[] = $row10;
                    }
                    
                   //print_r($datas10);
                   //echo $datas10[0]["COUNT(INSTITUTE__$k)"];
                   $sum_of_institutes = $sum_of_institutes + intval($datas10[0]["COUNT(INSTITUTE__$k)"]);
                }   

        }
        $institute_amount = $sum_of_institutes;

        //Passing all values into a JQ function
        echo "<script>$(function(){staticsFunc($teachers_amount,$students_amount,$institute_amount)});</script>";
        
        
        
    ?>

    
    <script>
        
            function staticsFunc(t_amount,s_amount,i_amount){
               $(function(){
                   $("#students_count").html("<span class='counter'>"+s_amount+"</span>");
                   $("#teachers_count").html("<span class='counter'>"+t_amount+"</span>");
                   $("#institutes_count").html("<span class='counter'>"+i_amount+"</span>");
                    
                });
            }
    </script>
    <!-- ##### Cool Facts Area End ##### -->          
                        
                   
                   
                   
       

    <!-- ##### Popular Courses Start ##### -->
    <section class="popular-courses-area section-padding-100-0" style="background-image: url(img/core-img/texture.png);">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading" id="registration_panel">
                        <h3>REGISTER WITH US TO BOOST YOUR CAREIAR</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Single Popular Course -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-popular-course mb-100 wow fadeInUp" data-wow-delay="250ms">
                        <img src="https://rotaryhall.com/wp-content/uploads/2020/11/slider-7.jpg" alt="">
                        <!-- Course Content -->
                        <div class="course-content">
                            <h4>Register as a student</h4>
                            <br><br>
                            <!-- <div class="meta d-flex align-items-center">
                                <a href="#">Sarah Parker</a>
                                <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                                <a href="#">Art &amp; Design</a>
                            </div> -->
                            <p>Register as a student to find the best teacher for your subject. You also can use Facebook login to join us.</p>
                        </div>
                        <!-- Seat Rating Fee -->
                        <div class="seat-rating-fee d-flex justify-content-between">
                            <div class="seat-rating h-100 d-flex align-items-center">
                                <div class="seat">
                                    <i class="fa fa-user" aria-hidden="true"></i> 10
                                </div>
                                <div class="rating">
                                    <i class="fa fa-star" aria-hidden="true"></i> 4.5
                                </div>
                            </div>
                            <div class="course-fee h-100">
                                <a href="../Register and login as a student/login.php?" class="free">Click to Register</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Single Popular Course -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-popular-course mb-100 wow fadeInUp" data-wow-delay="500ms">
                        <img src="https://www.unicef.org/srilanka/sites/unicef.org.srilanka/files/styles/hero_desktop/public/2H2A2259.jpg?itok=gSo2zGfx" alt="">
                        <!-- Course Content -->
                        <div class="course-content">
                            <h4>Register as a Teacher</h4>
                            <br><br>
                            <!-- <div class="meta d-flex align-items-center">
                                <a href="#">Sarah Parker</a>
                                <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                                <a href="#">Art &amp; Design</a>
                            </div> -->
                            <p>Register as a teacher to inform about your classes to students. Our admins contact you after a while to confirm details</p>
                        </div>
                        <!-- Seat Rating Fee -->
                        <div class="seat-rating-fee d-flex justify-content-between">
                            <div class="seat-rating h-100 d-flex align-items-center">
                                <div class="seat">
                                    <i class="fa fa-user" aria-hidden="true"></i> 20 +
                                </div>
                                <div class="rating">
                                    <i class="fa fa-star" aria-hidden="true"></i> 4.5
                                </div>
                            </div>
                            <div class="course-fee h-100">
                                <a href="../Register as a teacher/teachers_registration.php?" class="free" style="background-color: #0BA96C;">Click to Register</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Single Popular Course -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-popular-course mb-100 wow fadeInUp" data-wow-delay="750ms">
                        <img src="https://zeonopera.lk/wp-content/uploads/2020/07/6.jpg" alt="">
                        <!-- Course Content -->
                        <div class="course-content">
                            <h4>Register as a Institute</h4>
                            <br><br>
                            <!-- <div class="meta d-flex align-items-center">
                                <a href="#">Sarah Parker</a>
                                <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                                <a href="#">Art &amp; Design</a>
                            </div> -->
                            <p>Register as institutes to advertise your institute. Also, teachers can add institutes directly to edupara.</p>
                        </div>
                        <!-- Seat Rating Fee -->
                        <div class="seat-rating-fee d-flex justify-content-between">
                            <div class="seat-rating h-100 d-flex align-items-center">
                                <div class="seat">
                                    <i class="fa fa-user" aria-hidden="true"></i> 10
                                </div>
                                <div class="rating">
                                    <i class="fa fa-star" aria-hidden="true"></i> 4.5
                                </div>
                            </div>
                            <div class="course-fee h-100">
                                <a href="#" class="free first_regs">Click to Register</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(function(){
            var curruntScreenWidth = $('body').width();
            if(curruntScreenWidth <= 341){
                $(".free").width('150px');
                $(".free").text('Click to Register');
            }
        });
    </script>
    <!-- ##### Popular Courses End ##### -->

    <!-- ##### Best Tutors Start ##### -->
    <section class="best-tutors-area section-padding-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h3>Ideas of our valuable people</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="tutors-slide owl-carousel wow fadeInUp" data-wow-delay="250ms">

                        <!-- Single Tutors Slide -->
                        <div class="single-tutors-slides">
                            <!-- Tutor Thumbnail -->
                            <div class="tutor-thumbnail">
                                <img src="img/bg-img/t1.png" alt="">
                            </div>
                            <!-- Tutor Information -->
                            <div class="tutor-information text-center">
                                <h5>Janith Dewapriya</h5>
                                <span>Director</span>
                                <p>This site is meant to be to find a teacher or improve your life path. And in edupara, there are no scammers who could ruin your life.</p>
                                <div class="social-info">
                                    <a href="https://www.facebook.com/Janith Dewapriya" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                    <a href="https://www.instagram.com/Janith Dewapriya" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                    <a href="https://www.twitter.com/Janith Dewapriya" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Single Tutors Slide -->
                        <div class="single-tutors-slides">
                            <!-- Tutor Thumbnail -->
                            <div class="tutor-thumbnail">
                                <img src="img/bg-img/t4.png" alt="">
                            </div>
                            <!-- Tutor Information -->
                            <div class="tutor-information text-center">
                                <h5>Nadeeka Halangoda</h5>
                                <span>School Teacher</span>
                                <p>Edupara also has helped with School activities. It made easy lots of my work. Great work Edupara.</p>
                                <div class="social-info">
                                    <a href="https://www.facebook.com/Nadeeka Halangoda" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                    <a href="https://www.instagram.com/Nadeeka Halangoda" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                    <a  href="https://www.twitter.com/Nadeeka Halangoda" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Single Tutors Slide -->
                        <div class="single-tutors-slides">
                            <!-- Tutor Thumbnail -->
                            <div class="tutor-thumbnail">
                                <img src="img/bg-img/t2.png" alt="">
                            </div>
                            <!-- Tutor Information -->
                            <div class="tutor-information text-center">
                                <h5>Gayesh Dewaraja</h5>
                                <span>Student</span>
                                <p>I wanted to find a Language teacher. But I couldn't. Then I tried it in edupara. I got lots of Best Teachers. Thanks, Edupara.</p>
                                <div class="social-info">
                                    <a href="https://www.facebook.com/Gayesh Dewaraja" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                    <a href="https://www.instagram.com/Gayesh Dewaraja" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                    <a href="https://www.twitter.com/Gayesh Dewaraja" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Single Tutors Slide -->
                        <div class="single-tutors-slides">
                            <!-- Tutor Thumbnail -->
                            <div class="tutor-thumbnail">
                                <img src="img/bg-img/t5.png" alt="">
                            </div>
                            <!-- Tutor Information -->
                            <div class="tutor-information text-center">
                                <h5>Gayan Vimukthi</h5>
                                <span>Tution Teahcer</span>
                                <p>Before adding a new teacher to Edupara, They are doing a background check. I've never seen it before. So you will only see Best Teachers. Nice work Edupara.</p>
                                <div class="social-info">
                                    <a href="https://www.facebook.com/Gayan Vimukthi" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                    <a href="https://www.instagram.com/Gayan Vimukthi" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                    <a href="https://www.twitter.com/Gayan Vimukthi" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Single Tutors Slide -->
                        <div class="single-tutors-slides">
                            <!-- Tutor Thumbnail -->
                            <div class="tutor-thumbnail">
                                <img src="img/bg-img/t3.png" alt="">
                            </div>
                            <!-- Tutor Information -->
                            <div class="tutor-information text-center">
                                <h5>Aravinda Sampath</h5>
                                <span>Designer</span>
                                <p>Edupara is not an alternative for finding a teacher. This is the only way to find a teacher with a guarantee. We are happy to inform you, We are the first website which takes the responsibility of a teacher as well as student.</p>
                                <div class="social-info">
                                    <a href="https://www.facebook.com/Aravinda Sampath" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                    <a href="https://www.instagram.com/Aravinda Sampath" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                    <a href="https://www.twitter.com/Aravinda Sampath" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>

                        

                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Best Tutors End ##### -->

    

    <!-- ##### Upcoming Events Start ##### -->
    <section class="upcoming-events section-padding-100-0" id="login_forms">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h3>Log in to your account here</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Single Upcoming Events -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-upcoming-events mb-50 wow fadeInUp" data-wow-delay="250ms">
                        <!-- Events Thumb -->
                        <a href="../main_ads_grid/Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?">
                            <div class="events-thumb" >
                                <img src="https://images5.content-hci.com/commimg/myhotcourses/blog/post/myhc_63245.jpg" alt="">
                                <!-- <h6 class="event-date">August 26</h6> -->
                                <h4 class="event-title">Click this card to <br/> Login as a Student</h4>
                            </div>
                            <!-- Date & Fee -->
                            <div class="date-fee d-flex justify-content-between">
                                <div class="date">
                                    <p><i class="fa fa-clock"></i> Click this card to login as a student</p>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </a>    
                     
                <!-- Single Upcoming Events -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-upcoming-events mb-50 wow fadeInUp" data-wow-delay="250ms">
                        <!-- Events Thumb -->
                        <a href="../Teachers login/teachers_dashboard/index_original.php?">
                        <div class="events-thumb">
                            <img src="https://bmkltsly13vb.compat.objectstorage.ap-mumbai-1.oraclecloud.com/cdn.dailymirror.lk/media/images/image_1538684843-69abe1fcc9.jpg" alt="">
                            <!-- <h6 class="event-date">August 26</h6> -->
                            <h4 class="event-title">Click this card to <br/> Login as a Teacher</h4>
                        </div>
                        <!-- Date & Fee -->
                        <div class="date-fee d-flex justify-content-between">
                            <div class="date">
                                <p><i class="fa fa-clock"></i> Click this card to login as a student</p>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </a>

                <!-- Single Upcoming Events -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-upcoming-events mb-50 wow fadeInUp" data-wow-delay="250ms">
                        <!-- Events Thumb -->
                        <a href="#">
                        <div class="events-thumb">
                            <img src="https://www.dailynews.lk/sites/default/files/styles/large/public/news/2018/12/16/z_bus-pvi-Rotary-I.jpg?itok=BuhVkMwB" alt="">
                            <!-- <h6 class="event-date">August 26</h6> -->
                            <h4 class="event-title">Click this card to <br/> Login as a Institute</h4>
                        </div>
                        <!-- Date & Fee -->
                        <div class="date-fee d-flex justify-content-between">
                            <div class="date">
                                <p><i class="fa fa-clock"></i> Click this card to login as a student</p>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
    </section>
    <!-- ##### Upcoming Events End ##### -->

    <br><br><br><br><br><br>
    <!-- Gurantee Starts Here -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading">
                    <h3>Why we are special?</h3>
                </div>
            </div>
            <div class="col-lg-8  text-lg-left text-center">
                <h5>Edupara is the only website taking the responsibility of the teacher as well as the student. In Edupara you won't find any scammers. All the institutes and teachers are under the admin reviews all the time. <br/><br/> <span class="text-danger">NO SCAMMERS, PRETENDERS, FAKERS CAN RUIN YOUR FUTURE <br/> WHEN YOU ARE SAFE WITH <span class="bg-success text-white">EDUPARA.</p>
            </div>
            <div class="col-lg-4  text-center">
                <img width="200px" height="200px"  src="img\added-img/PngItem_2687658.png" alt="">
            </div>
        </div>
    </div>
    <!-- Gurantee Ends Here -->
            
<br><br><br><br>
            
        

    <!-- ##### Blog Area Start ##### -->
    <section class="blog-area section-padding-100-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h3>Our transparency policies</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Single Blog Area -->
                <div class="col-12 col-md-6">
                    <div class="single-blog-area mb-100 wow fadeInUp" data-wow-delay="250ms">
                        
                        <!-- Blog Content -->
                        <div class="blog-content">
                            <a href="#" class="blog-headline">
                                <h4>Terms And Conditions</h4>
                            </a>
                            <div class="meta d-flex align-items-center">
                                <a href="#">2022/03/11</a>
                                <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                                <a href="#">Admins</a>
                            </div>
                            <p>Edupara is taking the whole responsibility of a teacher registered in edupara.lk. Because of that, we might need some certificates to prove some information you provide. All of these things we are doing, because of the child scammers.
                                    <br><br>
                                    Students' accounts could be blocked if they provide some bad words as their usernames. But we will contact you before we block your account.
                                    <br><br>
                                    If a student request to reset their password more than 5 times, he/she will be added to the red list. Doesn't matter if you entered a fake email to log in. But please keep it in your mind.<br><br> <a class="text-primary cursor-pointer">Read more...</a>
                            </p>
                            
                        </div>
                    </div>
                </div>




                <!-- Single Blog Area -->
                <div class="col-12 col-md-6">
                    <div class="single-blog-area mb-100 wow fadeInUp" data-wow-delay="500ms">
                        
                        <!-- Blog Content -->
                        <div class="blog-content">
                            <a href="#" class="blog-headline">
                                <h4>Privacy Pollicy</h4>
                            </a>
                            <div class="meta d-flex align-items-center">
                                <a href="#">2022/03/11</a>
                                <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                                <a href="#">Admins</a>
                            </div>
                            <p>our data is 100% safe with us. We won't provide your email, contact numbers, or any other sensitive and valuable data to anyone.
                                <br><br>
                                We don't need any third-party cookies. So your browser, internet connection as well as virus guard is friendly with our website.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Blog Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer-area">
        <!-- Top Footer Area -->
        <div class="top-footer-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- Footer Logo -->
                        <div class="footer-logo">
                            <a href="index.php?"><img src="img/core-img/logo2.png" alt=""></a>
                        </div>
                        <!-- Copywrite -->
                        <p><a href="#">Best Thanks to colorlib
                            <script></script>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Footer Area -->
        <div class="bottom-footer-area d-flex justify-content-between align-items-center">
            <!-- Contact Info -->
            <div class="contact-info">
                <a href="#"><span>Phone:</span> 071 623 1345</a>
                <a href="#"><span>Email:</span> contact@edupara.lk</a>
            </div>
            <!-- Follow Us -->
            <div class="follow-us">
                <span>Follow us</span>
                <a href="https://www.facebook.com/groups/334793251924290/"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->

    <!-- ##### All Javascript Script ##### -->
    <!-- jQuery-2.2.4 js -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="js/plugins/plugins.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>
</body>

</html>