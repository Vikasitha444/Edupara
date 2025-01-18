<?php 
    
    
    if(isset($_COOKIE['email']) && isset($_COOKIE['password'])){
        setcookie("email","",-1,'/','',true, true);
        setcookie("password","",-1,'/','',true, true);
    }
    
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        
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


        $sql = "SELECT PASSWORD FROM teachers WHERE EMAIL = '$email';";
        error_reporting(E_ERROR | E_PARSE);

        $resalt = mysqli_query($conn,$sql);					         //get the resalt between $conn and, run $sql	
        $resaltcheck = mysqli_num_rows($resalt);
        $datas = array();

        if ($resaltcheck > 0) {
            while ($row = mysqli_fetch_assoc($resalt)){
            $datas[] = $row;  }
        

        
        
        if($password == $datas[0]['PASSWORD']){
            
            //echo $email;
            setcookie("email", $email, time()+86400,'/','',true,true);
            setcookie("password",$password,time()+86400,'/','',true,true);
            echo "<script>window.location.replace('teachers_dashboard/index_original.php?');</script>";
            
            
            
                                  
            
            }else{
                
                }

        }
        
            
     }
    
        



    ?>






<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teachers login | Edupara.lk</title>
    <link rel="shortcut icon" href="../index/img/core-img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="Teachers_login.css">
</head>

<body>
<div class='login-clean'>
        <form method='post' action='Teachers_login.php?'>
            <img src="../index/img/core-img/logo.png" alt=""><br><br>
            <h2><center>Teacher's Login</center></h2>
            <div class='illustration'><img src='https://img.icons8.com/external-vitaliy-gorbachev-flat-vitaly-gorbachev/50/000000/external-teacher-online-learning-vitaliy-gorbachev-flat-vitaly-gorbachev.png'/></div>
            <div class='form-group'><input class='form-control' type='email' name='email' placeholder='Email'></div>
            <div class='form-group'><input class='form-control' type='password' name='password' placeholder='Password'></div>
            <div class='form-group'><button class='btn btn-primary btn-block' type='submit' name='login'>Log In</button></div>

            

            <?php if((isset($password)) && ($password != $datas[0]['PASSWORD'])){echo '<h6><center><font color="red">Your Email or password is incorrect</h6><center></font color="red"><br/><br/>';}?>
            <a href='forget email or password.php?' class='forgot text-danger h6'><big>Forgot your email or password?</big></a>
            <a href='../Register as a teacher/teachers_registration.php?' class='forgot text-primary h6'><big>Register as a new teacher<big></a>
            
        </form>
        
        <br><a href="../index.html" class="h6 text-mute">Back to Home</font>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>


