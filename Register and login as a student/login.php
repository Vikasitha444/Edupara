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
if ($conn->connect_error){
    die."Connection Interuppted";
}

//echo "Connection Successful";							//Eneble this if Database not Successfuly Connected



if(isset($_COOKIE['EmailFromLogin']) && isset($_COOKIE['PasswordFromLogin'])){
    setcookie("EmailFromLogin", '', -1,'/','');
    setcookie("PasswordFromLogin",'',-1,'/','');
    
    if(isset($_COOKIE['district']) && isset($_COOKIE['city']) || isset($_COOKIE['class_type'])
        || isset($_COOKIE['how_classes_do'])){
        
        setcookie("district", '', -1,'/','');
        setcookie("city",'',-1,'/','');
        setcookie("class_type",'',-1,'/','');
        setcookie("how_classes_do",'',-1,'/','');
    }
}


if(isset($_GET['tmpemail']) && isset($_GET['tmppassword']) && isset($_GET['newcomer'])){
    $email_from_login = $_GET['tmpemail'];
    $password_from_login = $_GET['tmppassword'];
    $new_comer_state = $_GET['newcomer'];
    
    
    setcookie("EmailFromLogin", $email_from_login, time()+86400,'/','');
    setcookie("PasswordFromLogin",$password_from_login,time()+86400,'/','');
    header("Location: ../main_ads_grid/Mathamatics Worksheets & Teaching Resources _ Teachers Pay Teachers.php?new_comer_state=$new_comer_state");
}
?>








<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/register.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- title -->
    <title>Login or register as a student | Edupara.lk</title>
    <!-- favicon -->
    <link rel="icon" href="../index/img/core-img/favicon.ico" type="image/x-icon">


    <style>
        body {
               
            }

            .card {
                width: 400px;
                border: none
            }

            .btr {
                border-top-right-radius: 5px !important
            }

            .btl {
                border-top-left-radius: 5px !important
            }

            .btn-dark {
                color: #fff;
                background-color: #0d6efd;
                border-color: #0d6efd
            }

            .btn-dark:hover {
                color: #fff;
                background-color: #0d6efd;
                border-color: #0d6efd
            }

            .nav-pills {
                display: table !important;
                width: 100%
            }

            .nav-pills .nav-link {
                border-radius: 0px;
                border-bottom: 1px solid #0d6efd40
            }

            .nav-item {
                display: table-cell;
                background: #0d6efd2e
            }

            .form {
                padding: 10px;
                height: 300px
            }

            .form input {
                margin-bottom: 12px;
                border-radius: 3px
            }

            .form input:focus {
                box-shadow: none
            }

            .form button {
                margin-top: 20px
            }

            @media only screen and (max-width: 430px) {
                .card {
                    width: auto;
                }
            }
    </style>
     <style>
        @import url(https://fonts.googleapis.com/css?family=Poppins);
        body {
        font-family: "Poppins", sans-serif;
        }
        .light-blue-gradient {
        background: linear-gradient(120deg, #a1c4fd 0%, #c2e9fb 100%);
        }

        

        .box {
        width: 40%;
        margin: 0 auto;
        background: rgba(255,255,255,0.2);
        padding: 35px;
        border: 2px solid #fff;
        border-radius: 20px/50px;
        background-clip: padding-box;
        text-align: center;
        display: none;
        }

        .button {
        font-size: 1em;
        padding: 10px;
        color: #fff;
        border: 2px solid #06D85F;
        border-radius: 20px/50px;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.3s ease-out;
        }
        .button:hover {
        background: #06D85F;
        }

        .overlay {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.7);
        transition: opacity 500ms;
        visibility: hidden;
        opacity: 0;
        }
        .overlay:target {
        visibility: visible;
        opacity: 1;
        }

        .popup {
        margin: 70px auto;
        padding: 20px;
        background: #fff;
        border-radius: 5px;
        width: 30%;
        position: relative;
        transition: all 5s ease-in-out;
        }

        .popup h2 {
        margin-top: 0;
        color: #333;
        font-family: Tahoma, Arial, sans-serif;
        }
        .popup .close {
        position: absolute;
        top: 20px;
        right: 30px;
        transition: all 200ms;
        font-size: 30px;
        font-weight: bold;
        text-decoration: none;
        color: #333;
        }
        .popup .close:hover {
        color: #06D85F;
        }
        .popup .content {
        max-height: 30%;
        overflow: auto;
        }

        @media screen and (max-width: 700px){
        .box{
            width: 70%;
        }
        .popup{
            width: 70%;
        }
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
        #Cities_Galle
         {
            display: none;
        }

        .notmatch_aleat{
            display: none;
            color: red;
        }

        .notmatch_aleat_2{
            display: none;
            color: red;
        }

        #password_error_message{
            display: none;
        }
    </style>
</head>
<body>

    <div id="fb-root">
         <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v13.0&appId=353327906655665&autoLogAppEvents=1" nonce="Bpz7orvT"></script>
    </div>
    

    
    <div class="d-flex justify-content-center align-items-center mt-5">
        <div class="card">
            <div class="w-100 text-center">
                <img src="../index/img/core-img/logo.png" alt="" width="250" height="38"><p class="p text-center">login or register</p><br>
            </div>
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item text-center"> <a class="nav-link active btl" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Login</a> </li>
                <li class="nav-item text-center"> <a class="nav-link btr" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Register</a> </li>
            </ul>
            
            
            
            
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="form px-4 pt-5">
                        <form action="login.php?" method="POST">
                            <h2>Log in as a student</h2><br>
                            <input type="email" name="email_from_login" class="form-control" placeholder="Email"> 
                            <input type="password" name="password_from_login" class="form-control" placeholder="Password">
                            <a href="forgot password.php?">forgot password?</a> 
                            <button class="btn btn-primary w-100" type="submit" name="login">Login</button>
                            
                        </form>
                        <a href="../index.html"><font class="text-primary">Back to Home</a></font>
                        
                        <br><br><div class="fb-login-button w-100 text-center" data-width="" data-size="large" data-button-type="login_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false"></div>
                        <br><br>
                        
                        <!-- If user loged in -->
                        <?php   
                        
                        
                        if(isset($_POST['login'])){
                            $email_from_login = $_POST['email_from_login'];
                            $password_from_login = $_POST['password_from_login'];
                    
                            
                            $sql = "SELECT PASSWORD FROM students WHERE EMAIL = '$email_from_login';";
                            
                    
                            $resalt = mysqli_query($conn,$sql);					         //get the resalt between $conn and, run $sql	
                            $resaltcheck = mysqli_num_rows($resalt);
                            $datas = array();
                    
                            if ($resaltcheck > 0) {
                                while ($row = mysqli_fetch_assoc($resalt)){
                                $datas[] = $row;  }
                    
                    
                                if($password_from_login == $datas[0]['PASSWORD']){
                                    echo "<script>window.location.replace('login.php?tmpemail=$email_from_login&tmppassword=$password_from_login&newcomer=false');</script>";
                                    
                                    
                                }else{
                                    echo "<br/><br/>"."Your Email and Password are not matching. If you can't remember the password, Please recover it.";
                                }
                            }
                        }
                    ?>

                        
                    </div>
                </div>
                
                
                
                
            
                
                
                
                
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" style="height: 100%; margin-top: 10%; margin-bottom:10%;">
                        <div class="d-flex align-items-center" style="height: auto;">
                            <div class="container" >
                                <div class="">
                                    <div class="col-md-6">
                                        <div class="card rounded-0 shadow">
                                            <div class="card-body">
                                                <h3>Register as a Student</h3><br/>
                                                <form action="login.php?" method="POST">
                                                    <div class="form-group">
                                                        <label for="full_name">Full Name: </label>
                                                    <input type="text" id="full_name" name="full_name" required class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Email address:</label>
                                                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required name="email">
                                                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="contact_number">Contact Number: </label>
                                                    <input type="tel" pattern="{0-9}10" maxlength="10" id="contact_number" name="contact_number" required class="form-control">
                                                    </div>
                
                                                    <div class="form-group">
                                                        <label for="whatsapp_number">Whatsapp Number: </label>
                                                    <input type="tel" pattern="{0-9}10" maxlength="10" id="whatsapp_number" name="whatsapp_number" class="form-control">
                                                    </div>
                
                                                    <div class="form-group">
                                                        <label for="grade">Select your grade:</label>
                                                        <div class="dropdown">
                                                            <select class="form-control" id="grade" required name="grade">
                                                                <option value="grade_6">Grade 6</option>
                                                                <option value="grade_7">Grade 7</option>
                                                                <option value="grade_8">Grade 8</option>
                                                                <option value="grade_9">Grade 9</option>
                                                                <option value="OL">O/L</option>
                                                                <option value="AL">A/L</option>
                                                                <option value="OTHER">Other</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="selectSubject">Select your district:</label>
                                                        <div class="dropdown">
                                                            <select class="form-control" id="selectSubject" name="district">
                                                                <option value="">Your district</option>
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
                                                        </div>
                                                    </div>
                
                                                    <div class="form-group">
                                                        <label for="selected_nothing">Select your city:</label>
                                                        <div class="dropdown">
                                                            
                                                            <select class="form-control" id="selected_nothing">
                                                                <option value=""></option>
                                                            </select>
                                                            
                                                            <select name='colombo' id='Cities_colombo'  class="form-control" required>
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
                
                                                            <select name='mathara' id='Cities_mathara' class="form-control" required>
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
                                                        
                                                            <select name='gampaha' id='Cities_gampha' class="form-control" required>
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
                                                        
                                                        
                                                        
                                                        
                                                            <select name='jaffna' id='Cities_jaffna' class="form-control" required>
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
                                                        
                                                            <select name='kilinochchi' id='Cities_kilinochchi' class="form-control" required>
                                                                <option value='All Cities'>All Cities</option>
                                                                <option value='Karadippokku'>Karadippokku</option>
                                                                <option value='Kilinochchi'>Kilinochchi</option>
                                                                <option value='Poonakary'>Poonakary</option>
                                                            </select>
                                                            </select>
                                                        
                                                            <select name='mannar' id='Cities_Mannar' class="form-control" required>
                                                                <option value='All Cities'>All Cities</option>
                                                                <option value='Mannar'>Mannar</option>
                                                                <option value='Murunkan'>Murunkan</option>
                                                                <option value='Nanattan'>Nanattan</option>
                                                            </select>
                                                        
                                                            <select name='mullativu' id='Cities_Mullaitivu' class="form-control" required>
                                                                <option value='1000117'>All Cities</option>
                                                                <option value='Mankulam'>Mankulam</option>
                                                                <option value='Pudukudiyirippu'>Pudukudiyirippu</option>
                                                            </select>
                                                        
                                                            <select name='vavuniya' id='Cities_Vavuniya' class="form-control" required>
                                                                <option value='All Cities'>All Cities</option>
                                                                <option value='Vavuniya'>Vavuniya</option>
                                                            </select>
                                                            </select>
                                                        
                                                            <select name='puttalam' id='Cities_Puttalam' class="form-control" required>
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
                                                        
                                                            <select name='kurunegala' id='Cities_Kurunegala' class="form-control" required>
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
                                                        
                                                            <select name='kaluthara' id='Cities_Kalutara' class="form-control" required>
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
                                                        
                                                            <select name='anuradhapura' id='Cities_Anuradhapura' class="form-control" required>
                                                                <option value='All Cities'>All Cities</option>
                                                                <option value='Anuradhapura'>Anuradhapura</option>
                                                                <option value='Awukana'>Awukana</option>
                                                                <option value='Kahatagasdigiliya'>Kahatagasdigiliya</option>
                                                            </select>
                                                        
                                                            <select name='polonnaruwa' id='Cities_Polonnaruwa' class="form-control" required>
                                                                <option value='All Cities'>All Cities</option>
                                                                <option value='Hingurakgoda'>Hingurakgoda</option>
                                                                <option value='Polonnaruwa'>Polonnaruwa</option>
                                                            </select>
                                                        
                                                            <select name='mathale' id='Cities_Matale' class="form-control" required>
                                                                <option value='All Cities'>All Cities</option>
                                                                <option value='Dambulla'>Dambulla</option>
                                                                <option value='Kaikawala'>Kaikawala</option>
                                                                <option value='Matale'>Matale</option>
                                                            </select>
                                                        
                                                            <select name='kandy' id='Cities_Kandy' class="form-control" required>
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
                                                        
                                                            <select name='nuwaraeliya' id='Cities_Nuwara_Eliya' class="form-control" required>
                                                                <option value='All Cities'>All Cities</option>
                                                                <option value='Bogawantalawa'>Bogawantalawa</option>
                                                                <option value='Ginigathena'>Ginigathena</option>
                                                                <option value='Hatton'>Hatton</option>
                                                                <option value='Kotagala'>Kotagala</option>
                                                                <option value='Kotmale'>Kotmale</option>
                                                                <option value='Nuwara Eliya'>Nuwara Eliya</option>
                                                            </select>
                                                        
                                                            <select name='kagalle' id='Cities_Kegalle' class="form-control" required>
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
                                                        
                                                            <select name='ranthnapura' id='Cities_Ratnapura' class="form-control" required>
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
                                                        
                                                            <select name='trincomalee' id='Cities_Trincomalee' class="form-control" required>
                                                                <option value='All Cities'>All Cities</option>
                                                                <option value='Trincomalee'>Trincomalee</option>
                                                            </select>
                                                        
                                                            <select name='batticaloa' id='Cities_Batticaloa' class="form-control" required>
                                                                <option value='All Cities'>All Cities</option>
                                                                <option value='Batticaloa'>Batticaloa</option>
                                                                <option value='Eravur'>Eravur</option>
                                                                <option value='Kattankudi'>Kattankudi</option>
                                                                <option value='Oddamavadi'>Oddamavadi</option>
                                                                <option value='Pasikudah'>Pasikudah</option>
                                                                <option value='Valaichenai'>Valaichenai</option>
                                                            </select>
                                                        
                                                            <select name='ampara' id='Cities_Ampara' class="form-control" required>
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
                                                        
                                                            <select name='badulla' id='Cities_Badulla' class="form-control" required>
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
                                                        
                                                            <select name='monaragala' id='Cities_Monaragala' class="form-control" required>
                                                                <option value='All Cities'>All Cities</option>
                                                                <option value='Bibile'>Bibile</option>
                                                                <option value='Monaragala'>Monaragala</option>
                                                            </select>
                                                        
                                                            <select name='hambanthota' id='Cities_Hambantota' class="form-control" required>
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
                                                        
                                                            <select name='galle' id='Cities_Galle' class="form-control" required>
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
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="pass">Password: <font class="notmatch_aleat_2" >Password should have more than 8 characters</font> </label>
                                                        <input type="password" class="form-control" id="pass" placeholder="Password" minlength="8" name="password">
                                                    </div>
                
                                                
                
                                                    <div class="form-group">
                                                        <label for="pass2">Confirm Password:</label>
                                                        <input type="password" class="form-control" id="pass2" placeholder="Password" minlength="8" name="confirm_password">
                                                    </div>
                
                                                    <script>
                                                        $(document).ready(function(){
                                                            $('#pass2').keyup(function(){
                                                                var pass = $('#pass').val();
                                                                var pass2 = $('#pass2').val();
                                                                if(pass != pass2){
                                                                    //alert('Aint match');
                                                                    $('.notmatch_aleat').show();
                                                                }else if(pass == pass2){
                                                                    $('.notmatch_aleat').hide();
                                                                }
                
                                                            });
                                                        });
                                                    </script>
                
                                                    <div class="form-group form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                                                        <label class="form-check-label" for="exampleCheck1">I agree with all Terms and Conditions</label>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary" name="submit">Submit</button> 
                                                    <font class="notmatch_aleat" >Password aren't match</font>
                                                
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    
                
                
                
                                
                                
                
                            
                                </script>
                
                                <!-- Optional JavaScript -->
                                <!-- jQuery first, then Popper.js, then Bootstrap JS -->
                                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
                                <script src="assets/js/bootstrap.js"></script>
                            </div>
                
                        
                
                            <div class="box">
                                    <a class="button" href="#popup1" id="popup_button">Let me Pop up</a>
                                </div>
                </div>
            
            </div>
        </div>
    </div>
    

<!-- If user registered -->

    <?php
    
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

if(isset($_POST['submit'])){
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $grade = $_POST['grade'];
    $district = $_POST['district'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $contact_number = $_POST['contact_number'];
    $whatsapp_number = $_POST['whatsapp_number'];
    //echo $contact_number,$whatsapp_number;

    
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
    
    //echo "<h2>".$city[$key];


    if($password == $confirm_password){
           
            //Adding values to database
            $sql = "INSERT INTO students (EMAIL, FULL_NAME, GRADE, DISTRICT, CITY, CONTACT_NUMBER, WHATSAPP_NUMBER, PASSWORD ,CONFIRM_PASSWORD)
            VALUES ('$email','$full_name','$grade','$district','$city[$key]', '$contact_number', '$whatsapp_number', '$password','$confirm_password');";     

            
            
            
            $resultInsert = mysqli_query($conn, $sql) ;

            if($resultInsert === TRUE){
                //If something went error uncomment this and see the error   
                //echo"<script>alert('Data Insert');</script>";
                echo "<script>window.location.replace('login.php?tmpemail=$email&tmppassword=$password&newcomer=true');</script>";
                
            }
            else{
                    //echo "Error : ". $sql . "<br>" . $conn -> error;
                    $error = $conn -> error;
                    
                    if(strstr($error,'Duplicate')){
                       
                        echo "<script>document.getElementById('popup_button').click();</script>";
                        echo "<div id='popup1' class='overlay'>
                                <div class='popup'>
                                    <h2>Email is already used</h2>
                                    <a class='close' href='#'>&times;</a>
                                    <div class='content'>
                                        <br/>
                                        The email address you've enterd before, is using by another user. Please enter a diffrent email address or double check. If you think 
                                        this email is yours, Then recover the password using recover password section.
                                    </div>
                            </div>";
                    }
                }
        
        
        }else{
            echo "<script>document.getElementById('popup_button').click();</script>";
            echo "<div id='popup1' class='overlay'>
                    <div class='popup'>
                        <h2>Passwords do not match.</h2>
                        <a class='close' href='#'>&times;</a>
                        <div class='content'>
                            <br/>
                            Please double-check the passwords you've entered and also make sure that
                            passwords have more than 8 characters. Also please be aware your password is
                            strong. Do not use your sensitive data as your password.
                        </div>
                    </div>";
        }   



    
}

?>









</body>
</html>