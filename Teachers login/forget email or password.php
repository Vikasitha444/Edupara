
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Recovary Section | Edupara.lk</title>
    <link rel="shortcut icon" href="../index/img/core-img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="Teachers_login.css">
</head>

<body>
<div class='login-clean'>
        <form method='post' action='forget email or password.php?'>
            <h2><center>Teacher's Login</h2>
            <big><center>Forgot your password?</center></big>
            <div class='illustration'><img src="https://img.icons8.com/color/48/000000/forgot-password.png"/></div>
            
            <div class='form-group'><input class='form-control' type='text' name='fname' placeholder='First name' required></div>
            <div class='form-group'><input class='form-control' type='text' name='sname' placeholder='Second name' required></div>
            <div class='form-group'><input class='form-control' type='email' name='email' placeholder='Email'></div>
            <div class='form-group'><input class='form-control' type='text' maxlength="12" name='id_num' placeholder='Identity card number' required></div>
            <div class='form-group'><input class='form-control' type='tel' pattern="[0-9]{10}" placeholder="Phone number" name='phone_number' required></div>
            <div class='form-group'><input class='form-control' type='password' name='password_can_remember' placeholder='Password you can remember'></div>
            
            
            
            <div class='form-group'><button class='btn btn-primary btn-block' type='submit' name='Request_Password'>Request Password</button></div>
            <a href="../index.html">Back to home</a>

            <?php



                    if(isset($_POST['Request_Password'])){
                            $fname = $_POST['fname'];
                            $sname = $_POST['sname'];
                            $email = $_POST['email'];
                            $id_num = $_POST['id_num'];
                            $phone_number = $_POST['phone_number'];
                            $password_can_remember = $_POST['password_can_remember'];
                            
                            
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


                            $sql = "SELECT FNAME, PASSWORD FROM teachers WHERE FNAME='$fname' and SNAME = '$sname' and EMAIL = '$email' and ID_NUM = '$id_num' and PHONE_NUMBER = '$phone_number';";
                            

                            $resalt = mysqli_query($conn,$sql);					         //get the resalt between $conn and, run $sql	
                            $resaltcheck = mysqli_num_rows($resalt);
                            $datas = array();

                            if ($resaltcheck > 0) {
                                while ($row = mysqli_fetch_assoc($resalt)){
                                //echo $row['Image'];
                                $datas[] = $row;  }
                            
            
                            $rpw = $datas[0]['PASSWORD'];
                            $fname = $datas[0]['FNAME'];


                            $message = "Hello $fname, We saw that you had a trouble with login to your account. This is your password : $rpw. Keep it safe next time :)";

                            mail($email,'REQEST YOUR PASSWORD',$message,"FROM: contact@edupara.lk");
                            echo '<h3><center><font color="red">Check your emails<center><font><h3>';
                            
                        }else{
                            echo '<h3><center><font color="red">We have some issues with your details. Please contact our customer care to recover your password.<br/>071-1323-889<center><font><h3>';
                        }  
                    }         

                    ?>
            
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>







</html>