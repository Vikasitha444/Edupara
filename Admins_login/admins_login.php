<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$server_db = file_get_contents("../database details/server.txt", "r") or die("Unable to open file!");
$username_db = file_get_contents("../database details/username.txt", "r") or die("Unable to open file!");
$password_db = file_get_contents("../database details/password.txt", "r") or die("Unable to open file!");
$database_name_db = file_get_contents("../database details/dbname.txt", "r") or die("Unable to open file!");


if(isset($_POST['login'])){
  $username = $_POST['username'];
  $password = $_POST['password'];

   //Connect the Database'
  //Change to the server database
  //$conn = new mysqli($server,$username,$password,$database);
  $conn = new mysqli($server_db,$username_db,$password_db,$database_name_db);


  //Check the Connection was Sussesfull
  if ($conn->connect_error){
      die."Connection Interuppted";
  }

  //echo "Connection Successful";							//Eneble this if Database not Successfuly Connected


  $sql = "SELECT password from admins WHERE username = '$username';";


  $resalt = mysqli_query($conn,$sql);					         //get the resalt between $conn and, run $sql	
  $resaltcheck = mysqli_num_rows($resalt);
  $datas = array();

  if ($resaltcheck > 0) {
    while ($row = mysqli_fetch_assoc($resalt)){
      //echo $row['Image'];
      $datas[] = $row;  }
  }
  



    if($datas[0]['password'] == $password){
      setcookie("username",$username,time()+3600,'/');
      setcookie("password",$password,time()+3600,'/');
      echo "<script>window.location.replace('admin_dashboard/admin_dashboard.php?user_name=$username');</script>";
      
    
    }
    else{
      echo 'you are out';
    }
  

     
  

}





?>



<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admins login | Admins only</title>
    <link rel="shortcut icon" href="../index/img/core-img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="admins_login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  </head>
  <body>
    <div class="container">
      <div class="wrapper">
        <div class="title"><span>Login in as an admin</span></div>
        <form action="admins_login.php" method="POST">
          <div class="row">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Username" required name="username">
          </div>
          <div class="row">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" required name="password">
          </div>
          <div class="row button">
            <input type="submit" value="Login" name='login'>
          
        </form>
      </div>
    </div>

  </body>
</html>





