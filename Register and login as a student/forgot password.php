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


?>







<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/register.css">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <!-- title -->
        <title>Password Recovary Section | Edupara.lk</title>
        <!-- favicon -->
        <link rel="icon" href="../index/img/core-img/favicon.ico" type="image/x-icon">

        
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
        </style>
            
            <script>
                $(function(){
                    $("h3").before().html(`<div class="w-100 text-center">
                    <img src="../index/img/core-img/logo.png" alt="" width="250" height="38"><br/><p class="p text-center ">Password recovary section</p><br>
                </div>`);
                });
            </script>
    </head>
    
    
    
   
       


<?php
    
    

    if(isset($_POST['request_password'])){
        $recovary_email = $_POST['recovary_email'];
        $recovary_contact_number = $_POST['recovary_contact_number'];


        
        $sql = "SELECT EMAIL, CONTACT_NUMBER, FULL_NAME
                FROM students 
                WHERE EMAIL = '$recovary_email' and CONTACT_NUMBER = '$recovary_contact_number';";
        

        $resalt = mysqli_query($conn,$sql);					         //get the resalt between $conn and, run $sql	
        $resaltcheck = mysqli_num_rows($resalt);
        $datas = array();

        if ($resaltcheck > 0) {
            while ($row = mysqli_fetch_assoc($resalt)){
            $datas[] = $row;  }
        
        $full_name = $datas[0]['FULL_NAME'];
        

        $random_number = rand(000001,999999);
        $to = "$recovary_email";
        $subject = "Recover Password at Edupara";
        //$txt = "This is your confirmation code! $random_number. Please use this
        //        to proceed next step. This code is only valid for 3 minutes. Your account is getting ready.";

        $txt = "
                <!doctype html>
                <html>
                <head>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
                    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
                    <title>Simple Transactional Email</title>
                    <style>
                    /* -------------------------------------
                        GLOBAL RESETS
                    ------------------------------------- */
                    
                    /*All the styling goes here*/
                    
                    img {
                        border: none;
                        -ms-interpolation-mode: bicubic;
                        max-width: 100%; 
                    }
                
                    body {
                        background-color: #f6f6f6;
                        font-family: sans-serif;
                        -webkit-font-smoothing: antialiased;
                        font-size: 14px;
                        line-height: 1.4;
                        margin: 0;
                        padding: 0;
                        -ms-text-size-adjust: 100%;
                        -webkit-text-size-adjust: 100%; 
                    }
                
                    table {
                        border-collapse: separate;
                        mso-table-lspace: 0pt;
                        mso-table-rspace: 0pt;
                        width: 100%; }
                        table td {
                        font-family: sans-serif;
                        font-size: 14px;
                        vertical-align: top; 
                    }
                
                    /* -------------------------------------
                        BODY & CONTAINER
                    ------------------------------------- */
                
                    .body {
                        background-color: #f6f6f6;
                        width: 100%; 
                    }
                
                    /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
                    .container {
                        display: block;
                        margin: 0 auto !important;
                        /* makes it centered */
                        max-width: 580px;
                        padding: 10px;
                        width: 580px; 
                    }
                
                    /* This should also be a block element, so that it will fill 100% of the .container */
                    .content {
                        box-sizing: border-box;
                        display: block;
                        margin: 0 auto;
                        max-width: 580px;
                        padding: 10px; 
                    }
                
                    /* -------------------------------------
                        HEADER, FOOTER, MAIN
                    ------------------------------------- */
                    .main {
                        background: #ffffff;
                        border-radius: 3px;
                        width: 100%; 
                    }
                
                    .wrapper {
                        box-sizing: border-box;
                        padding: 20px; 
                    }
                
                    .content-block {
                        padding-bottom: 10px;
                        padding-top: 10px;
                    }
                
                    .footer {
                        clear: both;
                        margin-top: 10px;
                        text-align: center;
                        width: 100%; 
                    }
                        .footer td,
                        .footer p,
                        .footer span,
                        .footer a {
                        color: #999999;
                        font-size: 12px;
                        text-align: center; 
                    }
                
                    /* -------------------------------------
                        TYPOGRAPHY
                    ------------------------------------- */
                    h1,
                    h2,
                    h3,
                    h4 {
                        color: #000000;
                        font-family: sans-serif;
                        font-weight: 400;
                        line-height: 1.4;
                        margin: 0;
                        margin-bottom: 30px; 
                    }
                
                    h1 {
                        font-size: 35px;
                        font-weight: 300;
                        text-align: center;
                        text-transform: capitalize; 
                    }
                
                    p,
                    ul,
                    ol {
                        font-family: sans-serif;
                        font-size: 14px;
                        font-weight: normal;
                        margin: 0;
                        margin-bottom: 15px; 
                    }
                        p li,
                        ul li,
                        ol li {
                        list-style-position: inside;
                        margin-left: 5px; 
                    }
                
                    a {
                        color: #3498db;
                        text-decoration: underline; 
                    }
                
                    /* -------------------------------------
                        BUTTONS
                    ------------------------------------- */
                    .btn {
                        box-sizing: border-box;
                        width: 100%; }
                        .btn > tbody > tr > td {
                        padding-bottom: 15px; }
                        .btn table {
                        width: auto; 
                    }
                        .btn table td {
                        background-color: #ffffff;
                        border-radius: 5px;
                        text-align: center; 
                    }
                        .btn a {
                        background-color: #ffffff;
                        border: solid 1px #3498db;
                        border-radius: 5px;
                        box-sizing: border-box;
                        color: #3498db;
                        cursor: pointer;
                        display: inline-block;
                        font-size: 14px;
                        font-weight: bold;
                        margin: 0;
                        padding: 12px 25px;
                        text-decoration: none;
                        text-transform: capitalize; 
                    }
                
                    .btn-primary table td {
                        background-color: #3498db; 
                    }
                
                    .btn-primary a {
                        background-color: #3498db;
                        border-color: #3498db;
                        color: #ffffff; 
                    }
                
                    /* -------------------------------------
                        OTHER STYLES THAT MIGHT BE USEFUL
                    ------------------------------------- */
                    .last {
                        margin-bottom: 0; 
                    }
                
                    .first {
                        margin-top: 0; 
                    }
                
                    .align-center {
                        text-align: center; 
                    }
                
                    .align-right {
                        text-align: right; 
                    }
                
                    .align-left {
                        text-align: left; 
                    }
                
                    .clear {
                        clear: both; 
                    }
                
                    .mt0 {
                        margin-top: 0; 
                    }
                
                    .mb0 {
                        margin-bottom: 0; 
                    }
                
                    .preheader {
                        color: transparent;
                        display: none;
                        height: 0;
                        max-height: 0;
                        max-width: 0;
                        opacity: 0;
                        overflow: hidden;
                        mso-hide: all;
                        visibility: hidden;
                        width: 0; 
                    }
                
                    .powered-by a {
                        text-decoration: none; 
                    }
                
                    hr {
                        border: 0;
                        border-bottom: 1px solid #f6f6f6;
                        margin: 20px 0; 
                    }
                
                    /* -------------------------------------
                        RESPONSIVE AND MOBILE FRIENDLY STYLES
                    ------------------------------------- */
                    @media only screen and (max-width: 620px) {
                        table.body h1 {
                        font-size: 28px !important;
                        margin-bottom: 10px !important; 
                        }
                        table.body p,
                        table.body ul,
                        table.body ol,
                        table.body td,
                        table.body span,
                        table.body a {
                        font-size: 16px !important; 
                        }
                        table.body .wrapper,
                        table.body .article {
                        padding: 10px !important; 
                        }
                        table.body .content {
                        padding: 0 !important; 
                        }
                        table.body .container {
                        padding: 0 !important;
                        width: 100% !important; 
                        }
                        table.body .main {
                        border-left-width: 0 !important;
                        border-radius: 0 !important;
                        border-right-width: 0 !important; 
                        }
                        table.body .btn table {
                        width: 100% !important; 
                        }
                        table.body .btn a {
                        width: 100% !important; 
                        }
                        table.body .img-responsive {
                        height: auto !important;
                        max-width: 100% !important;
                        width: auto !important; 
                        }
                    }
                
                    /* -------------------------------------
                        PRESERVE THESE STYLES IN THE HEAD
                    ------------------------------------- */
                    @media all {
                        .ExternalClass {
                        width: 100%; 
                        }
                        .ExternalClass,
                        .ExternalClass p,
                        .ExternalClass span,
                        .ExternalClass font,
                        .ExternalClass td,
                        .ExternalClass div {
                        line-height: 100%; 
                        }
                        .apple-link a {
                        color: inherit !important;
                        font-family: inherit !important;
                        font-size: inherit !important;
                        font-weight: inherit !important;
                        line-height: inherit !important;
                        text-decoration: none !important; 
                        }
                        #MessageViewBody a {
                        color: inherit;
                        text-decoration: none;
                        font-size: inherit;
                        font-family: inherit;
                        font-weight: inherit;
                        line-height: inherit;
                        }
                        .btn-primary table td:hover {
                        background-color: #34495e !important; 
                        }
                        .btn-primary a:hover {
                        background-color: #34495e !important;
                        border-color: #34495e !important; 
                        } 
                    }
                
                    </style>
                </head>
                <body>
                    <span class='preheader'>This is preheader text. Some clients will show this text as a preview.</span>
                    <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='body'>
                    <tr>
                        <td>&nbsp;</td>
                        <td class='container'>
                        <div class='content'>
                
                            <!-- START CENTERED WHITE CONTAINER -->
                            <table role='presentation' class='main'>
                
                            <!-- START MAIN CONTENT AREA -->
                            
                            <tr>
                                <td class='wrapper'>
                                    
                                    

                                <table role='presentation' border='0' cellpadding='0' cellspacing='0'>
                                    <tr>
                                    <td>
                                        <p>Hi $full_name,</p>
                                        <p>Your request is ready. Now you simply can recover your password. But you have to copy this code and paste it in the verification-code box.</p>
                                        <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='btn btn-primary'>
                                        
                                            <br>
                                            <tbody>
                                            <tr>
                                            <td align='left'>
                                                <table role='presentation' border='0' cellpadding='0' cellspacing='0'>
                                                <tbody>
                                                    <tr>
                                                    <td> <a href='#'>$random_number</a> </td>
                                                    </tr>
                                                </tbody>
                                                </table>
                                            </td>
                                            </tr>
                                        </tbody>
                                        </table>
                                        
                                        <br>
                                        <p>This code is changes all the time and previous codes will be not accepted. If you have any questions please contact our customer service. 071-1323-889</p>
                                        <p>Keep your password safe next time.</p>
                                    </td>
                                    </tr>
                                </table>
                                </td>
                            </tr>
                
                            <!-- END MAIN CONTENT AREA -->
                            </table>
                            <!-- END CENTERED WHITE CONTAINER -->
                
                            <!-- START FOOTER -->
                            <div class='footer'>
                            <table role='presentation' border='0' cellpadding='0' cellspacing='0'>
                                <tr>
                                <td class='content-block'>
                                    <span class='apple-link'>Janith Dewapriya, Director of the edupara coporation</span>
                                    <br> Edupara - Best teachers in Sri Lanka to brighten your future.
                                </td>
                                </tr>
                                <tr>
                                <td class='content-block powered-by'>
                                    Copyright &copy; <script> document.write(new Date().getFullYear());</script> Edupara.lk
                                </td>
                                </tr>
                            </table>
                            </div>
                            <!-- END FOOTER -->
                
                        </div>
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                    </table>";
        

        //Sending Email to the destination
        $sender = "contact@edupara.lk";

        $headers = "From: " . "Edupara Admins" . " <" . "contact@edupara.lk" . ">\n" ;
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=utf-8\n";
        $headers .= "Return-Path: " . $sender . "\n";
        $headers .= "X-Mailer: PHP/" . phpversion();
        
        
        mail($to,$subject,$txt,$headers);

        echo "<div class='d-flex align-items-center' style='height: 100vh;'>
        <div class='container' >
            <div class='d-flex justify-content-center'>
                <div class='col-md-6'>
                    <div class='card rounded-0 shadow'>
                        <div class='card-body'>
                            <h3>Password Recovary Section</h3><br/>
                            <p><i>We have sent a confirmation code to your email account. Please check your email and type the code correctly to proceed to the next step and we are almost there.</i></p><br/><br/>
                            <form action='forgot password.php?' method='POST'>
                                
                                <div class='form-group'>
                                    <label for='exampleInputEmail1'>Enter the confimation code:</label>
                                    <input type='number' min = '1' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Confimation Code' required name='confimation_code' maxlenth='6'>
                                    
                                </div>
                                
                                

                                <button type='submit' class='btn btn-primary' name='next_step'>Proceed to the next step</button>
                                <input type = 'text' value ='$random_number' name = 'rand_num_txt' style='display:none'>
                                <input type = 'text' value ='$recovary_email' name = 'recovary_email' style='display:none'>
                                <input type = 'text' value ='$recovary_contact_number' name = 'recovary_contact_number' style='display:none'>
                            </form>";


                            
    }else{
        echo "<div class='d-flex align-items-center' style='height: 100vh;'>
        <div class='container' >
            <div class='d-flex justify-content-center'>
                <div class='col-md-6'>
                    <div class='card rounded-0 shadow'>
                        <div class='card-body'>
                            <h3>Password Recovary Section</h3><br/>
                            ";
            echo "we can't find your email or phone number. Please try again or contact our help center. 071-1323-889";
        }

    
    
    
    
    
    }elseif(isset($_POST['request_password']) == false && isset($_POST['next_step']) == false){
        echo "<div class='d-flex align-items-center' style='height: 100vh;'>
        <div class='container' >
            <div class='d-flex justify-content-center'>
                <div class='col-md-6'>
                    <div class='card rounded-0 shadow'>
                        <div class='card-body'>
                            <h3>Password Recovary Section</h3><br/>
                            <form action='forgot password.php?' method='POST'>
                                
                                <div class='form-group'>
                                    <label for='exampleInputEmail1'>Email address:</label>
                                    <input type='email' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Enter email' required name='recovary_email'>
                                    
                                </div>
                                
                                <div class='form-group'>
                                    <label for='contact_number'>Contact Number: </label>
                                   <input type='tel' pattern='{0-9}10' maxlength='10' id='contact_number' required class='form-control' name='recovary_contact_number' >
                                </div>

                                <button type='submit' class='btn btn-primary' name='request_password'>Request Password</button> 

                                ";
    }


    
    
    if(isset($_POST['next_step'])){
        $confimation_code = $_POST['confimation_code'];
        $random_number = $_POST['rand_num_txt'];
        $recovary_email = $_POST['recovary_email'];
        $recovary_contact_number = $_POST['recovary_contact_number'];
        
       
        if($confimation_code == $random_number){


            $sql = "SELECT PASSWORD FROM students WHERE EMAIL = '$recovary_email' and CONTACT_NUMBER = '$recovary_contact_number';";



            $resalt = mysqli_query($conn,$sql);					         //get the resalt between $conn and, run $sql	
            $resaltcheck = mysqli_num_rows($resalt);
            $datas = array();

            if ($resaltcheck > 0) {
                while ($row = mysqli_fetch_assoc($resalt)){
                $datas[] = $row;  }
            
           
            $pwd = $datas[0]['PASSWORD'];


            

            echo "<div class='d-flex align-items-center' style='height: 100vh;'>
            <div class='container' >
                <div class='d-flex justify-content-center'>
                    <div class='col-md-6'>
                        <div class='card rounded-0 shadow'>
                            <div class='card-body'>
                                <h3>Password Recovary Section</h3><br/>
                                <form action='forgot password.php?' method='POST'>
                                    
                                    <div class='form-group'>
                                        <label for='exampleInputEmail1'>Your Password is</label>&nbsp&nbsp;&nbsp;
                                        <input type='text' value ='$pwd'>
                                        <br/><br/>

                                        <p>Please keep your password safe next time. If you recover your password more than 5 times, You will add to the red list.
                                        Now go &nbsp <a href='login.php?'>Back to login </a></p>
                                    </div>
                                    
                                    ";
                }

        }else{
            echo "<div class='d-flex align-items-center' style='height: 100vh;'>
                    <div class='container' >
                        <div class='d-flex justify-content-center'>
                            <div class='col-md-6'>
                                <div class='card rounded-0 shadow'>
                                    <div class='card-body'>
                                        <h3>Password Recovary Section</h3><br/>
                                        ";
                    echo "The confirmation code does not match. You have to start this process again or contact our help center for further information. 071-1323-889";
        }
    }

?>


</body>
</html>