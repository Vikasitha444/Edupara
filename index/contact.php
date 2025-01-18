<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
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
                                <li><a href="../Register and login as a student/login.php?">Student's Login</a></li>
                                <li><a href="../Teachers login/Teachers_login.php?">Teacher's Login</a></li>
                                <li><a href="#">Institute's Login</a></li>
                                <li><a href="contact.php">Contact us</a></li>
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
    <div class="container w-100 h-100 text-center">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63359.963472751726!2d79.92501554348969!3d7.009550253730186!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2f86bd75870f7%3A0xee362e29dbc079a6!2sKadawatha%2C%20Sri%20Lanka!5e0!3m2!1sen!2ssg!4v1647026531345!5m2!1sen!2ssg" width="1000" height="500" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>

    <!-- ##### Contact Area Start ##### -->
    <section class="contact-area">
        <div class="container">
            <div class="row">
                <!-- Contact Info -->
                <div class="col-12 col-lg-6">
                    <div class="contact--info mt-50 mb-100">
                        <h4>Hotline</h4>
                        <ul class="contact-list">
                            <li>
                                <h6><i class="fa fa-clock-o" aria-hidden="true"></i> Business Hours</h6>
                                <h6>24 HOURS</h6>
                            </li>
                            <li>
                                <h6><i class="fa fa-phone" aria-hidden="true"></i> Number</h6>
                                <h6>071 623 1345</h6>
                            </li>
                            <li>
                                <h6><i class="fa fa-envelope" aria-hidden="true"></i> Email</h6>
                                <h6>contact@edupara.lk</h6>
                            </li>
                            <li>
                                <h6><i class="fa fa-map-pin" aria-hidden="true"></i> Address</h6>
                                <h6>384/4, Biyanwila, Pinthaliya RD, Kadawatha</h6>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-12 col-lg-6">
                    <div class="contact-form">
                        <h4>Send Us a Message</h4>
                        
                        <form action="contact.php?" method="POST" id="insertform">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="text" placeholder="Name" name="name" style="color:black; font-size:.8rem">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email" placeholder="Email" name="email" style="color:black; font-size:.8rem">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <input type="tel" class="form-control" id="phone_number" placeholder="Phone Number" name="phone_number" style="color:black; font-size:.8rem">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <input type="tel" class="form-control" id="whatsapp_number" placeholder="Whatsapp Number (Opt)" name="whatsapp_number" style="color:black; font-size:.8rem">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea name="message" class="form-control" id="message" cols="30" rows="10" placeholder="Message" style="color:black; font-size:.8rem"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn clever-btn w-100" id="insert">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
        error_reporting(0);

        $server_db = file_get_contents("../database details/server.txt", "r") or die("Unable to open file!");
        $username_db = file_get_contents("../database details/username.txt", "r") or die("Unable to open file!");
        $password_db = file_get_contents("../database details/password.txt", "r") or die("Unable to open file!");
        $database_name_db = file_get_contents("../database details/dbname.txt", "r") or die("Unable to open file!");



        $conn = mysqli_connect($server_db,$username_db,$password_db,$database_name_db);
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $whatsapp_number = $_POST['whatsapp_number'];
        $message_content = $_POST['message'];

        

        $sql = "insert into contact_us_messages (Name,Email,Phone_number,whatsapp_number,message_content,recived_date,recived_time) values ('$name','$email','$phone_number','$whatsapp_number','$message_content',now(),now());";
        if(mysqli_query($conn, $sql)){} 
            
    ?>


        

    <script>
        
       // Gets a reference to the form element
        var form = document.getElementById('insertform');

        // Adds a listener for the "submit" event.
        form.addEventListener('submit', function(e) {

        return false;

        });
        
    </script>
    
    <script>
        $(function(){
            $('#insert').click(function(){
                $.post(		
                    $('#insertform').attr('action'),            //URL
                    $('#insertform :input').serializeArray(),   //Data
                    function(result){                           //onSuccess
                        // $('#result').html(result);
                    }
                );
            });
        });
    </script>
        
    <!-- ##### Contact Area End ##### -->

    <!-- ##### Contact Area Start ##### -->
    <section class="contact-area">
        <div class="container">
            <div class="row">
                <!-- Contact Info -->
                <div class="col-sm-12 col-lg-6">
                    <div class="contact--info mt-50 mb-100">
                        <h4>Janith Dewapriya <small>&nbsp (Director)</small></h4>
                        <ul class="contact-list">
                            <li>
                                <h6><i class="fa fa-clock-o" aria-hidden="true"></i> Business Hours</h6>
                                <h6>9:00 AM - 18:00 PM</h6>
                            </li>
                            <li>
                                <h6><i class="fa fa-phone" aria-hidden="true"></i> Number</h6>
                                <h6>071 623 1345</h6>
                            </li>
                            <li>
                                <h6><i class="fa fa-envelope" aria-hidden="true"></i> Email</h6>
                                <h6>dewapriyajanith@gmail.com</h6>
                            </li>
                            <li>
                                <h6><i class="fa fa-map-pin" aria-hidden="true"></i> Address</h6>
                                <h6>384/4, Biyanwila, Pinthaliya RD, Kadawatha</h6>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-sm-12 col-lg-6">
                    <div class="contact--info mt-50 mb-100">
                        <h4>Pawan Vikasitha <small>&nbsp; (Developer)</small></h4>
                        <ul class="contact-list">
                            <li>
                                <h6><i class="fa fa-clock-o" aria-hidden="true"></i> Business Hours</h6>
                                <h6>24 HOURS</h6>
                            </li>
                            <li>
                                <h6><i class="fa fa-phone" aria-hidden="true"></i> Number</h6>
                                <h6>071 1323 889</h6>
                            </li>
                            <li>
                                <h6><i class="fa fa-envelope" aria-hidden="true"></i> Email</h6>
                                <h6>pawanvikasitha2001@gmail.com</h6>
                            </li>
                            <li>
                                <h6><i class="fa fa-map-pin" aria-hidden="true"></i> Address</h6>
                                <h6>81/3, Ramya mw., Kalapaluwawa, Rajagiriya</h6>
                            </li>
                        </ul>
                    </div>
                </div>
                    
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Contact Area End ##### -->

    <!-- ##### Contact Area Start ##### -->
    <section class="contact-area">
        <div class="container">
            <div class="row">
                <!-- Contact Info -->
                <div class="col-sm-12 col-lg-6">
                    <div class="contact--info mt-50 mb-100">
                        <h4>Aravinda Sampath <small>&nbsp; (Designer)</small></h4>
                        <ul class="contact-list">
                            <li>
                                <h6><i class="fa fa-clock-o" aria-hidden="true"></i> Business Hours</h6>
                                <h6>24 HOURS</h6>
                            </li>
                            <li>
                                <h6><i class="fa fa-phone" aria-hidden="true"></i> Number</h6>
                                <h6>075 645 6740</h6>
                            </li>
                            <li>
                                <h6><i class="fa fa-envelope" aria-hidden="true"></i> Email</h6>
                                <h6>aravindajayawrdhna@gmail.com</h6>
                            </li>
                            <li>
                                <h6><i class="fa fa-map-pin" aria-hidden="true"></i> Address</h6>
                                <h6>101A, Mihidu Mw, Athurugiya, Colombo</h6>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-sm-12 col-lg-6">
                    <div class="contact--info mt-50 mb-100">
                        <h4>Dhananjaya Dewapriya</h4>
                        <ul class="contact-list">
                            <li>
                                <h6><i class="fa fa-clock-o" aria-hidden="true"></i> Business Hours</h6>
                                <h6>9:00 AM - 18:00 PM</h6>
                            </li>
                            <li>
                                <h6><i class="fa fa-phone" aria-hidden="true"></i> Number</h6>
                                <h6>071 315 6842</h6>
                            </li>
                            <li>
                                <h6><i class="fa fa-envelope" aria-hidden="true"></i> Email</h6>
                                <h6>dewapriyadhananjaya@gmail.com</h6>
                            </li>
                            <li>
                                <h6><i class="fa fa-map-pin" aria-hidden="true"></i> Address</h6>
                                <h6>384/4, Biyanwila, Pinthaliya RD, Kadawatha</h6>
                            </li>
                        </ul>
                    </div>
                </div>
                    
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Contact Area End ##### -->


    

                
                

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
                        <p><a href="#"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        <script>document.write(new Date().getFullYear());</script> Best Thanks to Colorlib
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Footer Area -->
        <div class="bottom-footer-area d-flex justify-content-between align-items-center">
            <!-- Contact Info -->
            <div class="contact-info">
                <a href="#"><span>Phone:</span> 071 1323 889</a>
                <a href="#"><span>Email:</span> contact@edupara.lk</a>
            </div>
            <!-- Follow Us -->
            <div class="follow-us">
                <span>Follow us</span>
                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
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
    <!-- Google Maps -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAwuyLRa1uKNtbgx6xAJVmWy-zADgegA2s"></script>
    <script src="js/google-map/map-active.js"></script>
</body>

</html>