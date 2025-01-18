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
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">

  <link rel="stylesheet" href="teachers_registration.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register as a teacher | Edupara.lk</title>
  <link rel="icon" href="../index/img/core-img/favicon.ico" type="image/x-icon">

</head>

<body>


  <img src="../index/img/core-img/logo.png" alt="">
  <h1>Register as a Teacher</h1>

  <div class="container">
    <div class="title">Registration</div>
    <div class="content">
      <form enctype="multipart/form-data" action="review submitions.php?" method="POST">
        <div class="user-details">


          <div class="input-box">
            <span class="details">First Name<font color='red'><big> *</big></font></span>

            <input type="text" placeholder="Enter your first name" required name="fname">
          </div>

          <div class="input-box">
            <span class="details">Second Name<font color='red'><big> *</big></font></span>
            <input type="text" placeholder="Enter your second name" required name='sname'>
          </div>


          <div class="input-box">
            <span class="details">Identity card number<font color='red'><big> *</big></font></span>
            <input type="text" name='ID_num' placeholder='Enter your ID Number' maxlength="12" required id="idnum">
          </div>



          <div class="input-box">
            <span class="details">Age<font color='red'><big> *</big></font></span>
            <input type="number" name='age' placeholder='Age will generate automatically' min="16" required readonly>
          </div>

          <div class="input-box">
            <span class="details">Email<font color='red'><big> *</big></font></span>
            <input type="email" placeholder="Enter your email" name='email' id="email" required>
          </div>

          <div class="input-box">
            <span class="details">Confirm Email<font color='red'><big> *</big></font></span>
            <input type="email" placeholder="Enter your email" name='email' id="email_confirm" required>
          </div>

          <div class="input-box">
            <span class="details">Phone Number (07......)<font color='red'><big> *</big></font></span>
            <input type="tel" pattern="[0-9]{10}" maxlength="10" placeholder="Enter your number" required name='phone_number'>
          </div>

          <div class="input-box">
            <span class="details">Whatsapp number</span>
            <input type="tel" pattern="[0-9]{10}" maxlength="10" placeholder="Enter your Whatsapp number" name='whatsapp_number'>
          </div>


          <div class="input-box">
            <span class="details">Degree (Education Level)</span>
            <input type="text" name='edu_level' placeholder='Bachelor/Masters/Doctorate'>
          </div>


          <div class="input-box">
            <span class="details">University</span>
            <input type="text" name='university' placeholder='Enter your university'>
          </div>

          <div class="input-box">
            <span class="details">Graduated Year</span>
            <input type="year" maxlength="4" pattern="{0-9}4" name='graduated_year' placeholder='Enter your graduated year'>
          </div>

          <div class="input-box">
            <span class="details">I'm teaching since?</span>
            <input type="year" maxlength="4" name='teaching_since' placeholder='Enter the year you stared teaching'>
          </div>

          <div class="input-box">
            <span class="details">Password<font color='red'><big> *</big></font><small>&nbsp;(minimum 8 characters)</small></span>
            <input type="text" placeholder="Enter your password" required name='password' id="password" minlength="8">
          </div>

          <div class="input-box">
            <span class="details">Confirm Password<font color='red'><big> *</big></font></span>
            <input type="password" placeholder="Confirm your password" required name='confirm_password' id="confirm_password" minlength="8">
          </div>

          <div class="input-box">
            <span class="details">How many subjects do you teach?</span>
            <input type="number" min="1" name='amount_subjects' placeholder='Enter your amount of subjects' required>
            <font id="message_4" style="font-size: .9rem; font-weight: bolder; color:crimsom;"></font>
          </div>
          







          <!-- <div class="input-box">
            <span class="details">Profile Image<font color='red'><big> *</big></font></span>
            <span class="details"><i>Click on the upload icon and upload a photo.</i></span>
                <div class="image-upload">
                    <label for="file-input">
                        <img src="https://img.icons8.com/external-kiranshastry-lineal-color-kiranshastry/64/000000/external-upload-interface-kiranshastry-lineal-color-kiranshastry.png" style="cursor: pointer;" required/>
                    </label>
                    <input id="file-input" type="file" accept = "image/*" style="display: none;" name="profile">
                </div>
          </div> -->


          <div class="input-box">
            <span class="details">Upload your certificates</span>

            <input type="file" id="file-upload" style="display:none;" accept="image/*" / name="file">
            <label for="file-upload" style="cursor: pointer;">
              <h5 style="outline: 1px solid; width: 200px; text-align:center;">Upload File</h4><br />
                <font color="red">Uploading certificates is not necessary!</font>
            </label>
            <br>
            <div id="file-upload-filename" style="width: 100%; height:auto;"></div>

            <script>
              var input = document.getElementById('file-upload');
              var infoArea = document.getElementById('file-upload-filename');

              input.addEventListener('change', showFileName);

              function showFileName(event) {

                // the change event gives us the input it occurred in 
                var input = event.srcElement;

                // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
                var fileName = input.files[0].name;

                // use fileName however fits your app best, i.e. add it into a div
                infoArea.textContent = 'File name: ' + fileName;
              }
            </script>
          </div>


          <div class="input-box">
            <span class="details">Additional details</span>
            <textarea name="additional_details" id="" cols="45" rows="10" placeholder="Discribe about you briefly" maxlength="255"></textarea>
          </div>





        </div>
        <div class="class_type">
          <input type="radio" name="class_type_input" id="dot-1" required="required" value="Online">
          <input type="radio" name="class_type_input" id="dot-2" value="Physical">
          <input type="radio" name="class_type_input" id="dot-3" value="Both">
          <span class="class_title">Class type <font color='red'><big> *</big></font></span>
          <div class="category">
            <label for="dot-1">
              <span class="dot one"></span>
              <span class="gender">Online</span>
            </label>
            <label for="dot-2">
              <span class="dot two"></span>
              <span class="gender">Physical</span>
            </label>
            <label for="dot-3">
              <span class="dot three"></span>
              <span class="gender">I'm doing both</span>
            </label>
          </div>
        </div>
        <div class="button">
          <input type="submit" value="Register" name='register_button' id="reg_button" disabled>
          <font id="message" style="font-size: 1.1rem; font-weight: bolder;"></font><br>
          <font id="message_2" style="font-size: 1.1rem; font-weight: bolder;"></font>
          <font id="message_3" style="font-size: 1.1rem; font-weight: bolder; color:red"></font>
          


        </div>
    </div>
  </div>

  </form>



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script>
    $('#password, #confirm_password').on('keyup', function() {
      if ($('#password').val() == $('#confirm_password').val() && $('#password').val().length >= 8 && $('#confirm_password').val().length >= 8) {
        $('#message').html('').css('color', 'green');


      } else
        $('#message').html('Passwords are not matching').css('color', 'red');





    });
  </script>


  <script>
    $("#idnum").keyup(function() {
      if ($("#idnum").val().length >= 10) {
        resultDisplay();

        $("input[name='gender']").attr('value', gender);
        $("input[name='age']").attr('value', age);




      }
    });
  </script>


  <script>
    $('#email, #email_confirm').on('keyup', function() {
      if ($('#email').val() == $('#email_confirm').val()) {
        $('#message_2').html('').css('color', 'green');










      } else
        $('#message_2').html('Emails are not matching').css('color', 'red');

    });
  </script>

  <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>

  <!-- Prevent submit form if emails are mismatch -->
  <script>
    $(function() {
      $('#email, #email_confirm,#password, #confirm_password').on('keyup', function() {
        if ($('#email').val() == $('#email_confirm').val() &&
          ($('#password').val() == $("#confirm_password").val())) {
          document.getElementById("reg_button").disabled = false;


        } else {
          document.getElementById("reg_button").disabled = true;

        }
      });
    });
  </script>
  <!-- <script>
  $('#password, #confirm_password').on('keyup', function () {
      if ($('#password').val() == $('#confirm_password').val() && $('#password').val().length >=8 && $('#confirm_password').val().length >=8) {
          document.getElementById("reg_button").disabled = false;
          
          
      } else 
          document.getElementById("reg_button").disabled = true;
      });
</script> -->



  <script>
    $("#reg_button").click(function() {
      $("input[required]").each(function() {


        if ($(this).val() == '') {
          var requied_names = $(this).attr('name');


          switch (requied_names) {
            case 'amount_subjects':
              $("#message_3").text('Please insert how many subjects you teach');
              break;

            case 'ID_num':
              $("#message_3").text('Please insert your ID number');
              break;

            case 'sname':
              $("#message3").text('Please insert your second name');
              break;

            case 'fname':
              $("#message_3").text('Please insert your first name');
              break;

          }
        }

      });
    });
  </script>
            

            

            




  

  <script>
      $("input[name=amount_subjects]").keyup(function(){
        var amount_subject_value = $(this).val();
        var count_of_subject_columns = parseInt("<?php echo $count_of_subject_columns; ?>");
        
        if(amount_subject_value > count_of_subject_columns){
            $("#message_4").text("Max amount of subject is "+count_of_subject_columns).css('color','red'); 
            $("input[name=amount_subjects]").attr('max',count_of_subject_columns);
            $("input[name=amount_subjects]").val(count_of_subject_columns);
        }else{
            $("#message_4").text("");
        }
        
      });
  </script>







  <script>
    //Variable declaration======================================================================
    //Number of dates in months
    var totalDates = [31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

    //Names of Months
    var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];


    //Validation Part======================================================================
    function resultDisplay() {

      //Get the user input NIC card number
      var idNumber = document.getElementById("idnum").value;

      //Check the 3 digits for use month & day
      var checkThreeOld = idNumber.substring(2, 5);
      var checkThreeNew = idNumber.substring(4, 7);

      //Check the last digit of the OLD NIC
      var checkV = idNumber.endsWith('V');
      var checkv = idNumber.endsWith('v');

      //Check the first digit of the NEW NIC
      var checkOne = idNumber.startsWith('1');
      var checkTow = idNumber.startsWith('2');


      //Validation start here
      if (idNumber.length == 10 && (checkV == true || checkv == true) && (checkThreeOld <= 366 || (checkThreeOld >= 501 && checkThreeOld <= 866))) {

        oldNIC(idNumber);
      } else if (idNumber.length == 12 && (checkOne == true || checkTow == true) && (checkThreeNew <= 366 || (checkThreeNew >= 501 && checkThreeNew <= 866))) {

        newNIC(idNumber);
      }

    }


    //OLD NIC Functionality=================================================================
    function oldNIC(idNumber) {

      //Get the First 2 digits(Birth year)
      var str = idNumber;
      var year = str.substring(0, 2);

      //Get the Next 3 digits in NIC(Birth month & day)
      var nextThreeDigits = parseInt(str.substring(2, 5));

      //Validate gender
      var gender = "Male";
      if (nextThreeDigits > 500) {
        nextThreeDigits -= 500;
        gender = "Female"; //If day value > 500 it means NIC owner is a female.
      }





      var year_with_prefix = parseInt("19" + year);
      var age = new Date().getFullYear() - year_with_prefix;

      window.gender = gender;
      window.age = age;





    }


    //NEW NIC Functionality=================================================================
    function newNIC(idNumber) {

      //Get the First 4 digits(Birth year)
      var str = idNumber;
      var year = str.substring(0, 4);

      //Get the Next 3 digits in NIC(Birth month & day)
      var nextThreeDigits = parseInt(str.substring(4, 7));

      //Validate gender
      var gender = "Male";
      if (nextThreeDigits > 500) {
        nextThreeDigits -= 500;
        gender = "Female"; //If day value > 500 it means NIC owner is a female.
      }

      var age = new Date().getFullYear() - year;
      window.gender = gender;
      window.age = age;

    }
  </script>


</body>

</html>