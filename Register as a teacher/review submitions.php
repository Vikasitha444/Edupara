<?php
    if(isset($_POST['register_button'])){
        $fname = $_POST['fname'];

        
    }
   
    

            
?>




<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="review submitions.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Review submition form | Edupara.lk</title>
     <link rel="icon" href="../index/img/core-img/favicon.ico" type="image/x-icon">
   </head>
<body>
  
  
  
<h1>Register as a Teacher</h1> 


    
    
    
    
    
    
    
    
    <?php


        if(isset($_POST['register_button'])){
            $fname = $_POST['fname'];
            $sname = $_POST['sname'];
            $age = $_POST['age'];
            $id_num = $_POST['ID_num'];
            $email = $_POST['email'];
            $phone_number = $_POST['phone_number'];
            $whattsapp_number = $_POST['whatsapp_number'];
            $edu_level = $_POST['edu_level'];
            $university = $_POST['university'];
            $graduated_year = $_POST['graduated_year'];
            $teaching_since = $_POST['teaching_since'];
            $amount_subjects = $_POST['amount_subjects'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $additional_details = $_POST['additional_details'];
            $class_type_input = $_POST['class_type_input'];


            if($password != $confirm_password){
              echo "<div class='container'><img src='https://img.icons8.com/external-bearicons-flat-bearicons/100/000000/external-error-essential-collection-bearicons-flat-bearicons.png'/><div class='title'>";
              echo "Error!";
              echo "</div><br/>
              <span class='details'><big>Your passwords don't match.</span>";
            }else{

           

        

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

            
            

            //Adding values to database
            $sql = "INSERT INTO teachers_under_review(FNAME,SNAME,AGE,ID_NUM,EMAIL,PHONE_NUMBER,WHATSAPP_NUMBER,EDU_LEVEL,UNIVERSITY,GARDUATED_YEAR,TEACHING_SINCE,AMOUNT_SUBJECTS,PASSWORD,CONFIRM_PASSWORD,ADDITIONAL_DETAILS,CLASS_TYPE_INPUT,DATE_TIME)
            VALUES ('$fname','$sname','$age', '$id_num','$email','$phone_number','$whattsapp_number','$edu_level','$university','$graduated_year','$teaching_since','$amount_subjects','$password','$confirm_password','$additional_details','$class_type_input',now());";     
        
            
            
            
            $resultInsert = mysqli_query($conn, $sql) ;
    
          if($resultInsert === TRUE){
                //If something went error uncomment this and see the error   
                //echo"<script>alert('Data Insert');</script>";
                echo "<div class='container'><img src='https://img.icons8.com/external-itim2101-lineal-color-itim2101/100/000000/external-review-project-management-itim2101-lineal-color-itim2101.png'/><div class='title'>";
                echo "Hello $fname!";
                echo "</div><br/>
                <span class='details'><big>Your submition form is under admins review. They will contact you after a while. Thanks for using our service.</span>";
            
            }
          else{
                  //echo "Error : ". $sql . "<br>" . $conn -> error;
                  $error = $conn -> error;
                    
                  if(strstr($error,'Duplicate')){
                    echo "<div class='container'><img src='https://img.icons8.com/bubbles/100/000000/id-curly-hair-girl.png'/><div class='title'>";
                    echo "Error!";
                    echo "</div><br/>
                    <span class='details'><big>This ID Number has already been used. Our systems detected that this ID number has used by someone else. If that were you, you can simply log in to your account. Or else you can use a different ID number.</span>";
                  }
              }
        }

    }
?>














    
    
    
   
    <div class="content">
      <form action="#">
        <div class="user-details">
        
        <br><br><a href="../index.html">Back to Home</a>

</body>
</html>