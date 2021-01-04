<?php

$error="";
$Password="";
session_start();

if(array_key_exists('id-faculty' , $_POST)){
    include("connection.php");
    $query="SELECT * FROM faculty_registration where fac_id = '".$_POST['id-faculty']."'";
     $result=mysqli_query($link , $query);
     $row=mysqli_fetch_array($result);
     
      if(isset($row)){
        if($row['password']!=""){
          $error.="<p>Already Registered..</p>";
        }
        else{
          $query1 = "UPDATE faculty_registration SET
                  name='".mysqli_real_escape_string($link , $_POST['name-faculty'])."',
                  dob='".mysqli_real_escape_string($link , $_POST['dob-faculty'])."',
                  mobile='".mysqli_real_escape_string($link , $_POST['mobile-faculty'])."',
                  mail='".mysqli_real_escape_string($link , $_POST['mail-faculty'])."',
                  department='".mysqli_real_escape_string($link , $_POST['department'])."',
                  password='".mysqli_real_escape_string($link , $_POST['password-faculty'])."'
                  WHERE fac_id = '$row[fac_id]' LIMIT 1";

          $query2="INSERT INTO faculty_login (fac_id , password) VALUES('".mysqli_real_escape_string($link , $_POST['id-faculty'])."' ,  '".md5($_POST['password-faculty'])."' )   ";
          
          if(!mysqli_query($link , $query1)){
            $error .="<p>Couldn't Sign Up ... Please Try Again Later </p>";
          }
          else{
            mysqli_query($link , $query2);
            $query="UPDATE faculty_registration SET password= '".md5($_POST['password-faculty'])."' WHERE fac_id='$row[fac_id]'";
            mysqli_query($link,$query);
            $_SESSION['fac_id']=$row['fac_id'];
            header("Location: dashboard-faculty.php");
          }
        }
      }
      else{
        $error .= "<p>No Record Found For You..Try Again Later</p>";
      }
  
  }

  include("header.php");
  include("menu.php");
?>
          <div class="col-md-7 right container margin-top">
            <!--registarion form-->
            <h1 class="white-font">Faculty Registration</h1><br>
            <?php
              if($error!=""){?>
                <div class="alert alert-danger" role="alert">
                  <h5 class="alert-heading">OOPS There Was An Error..!</h5><hr>
                  <?php echo $error ?>
                </div><?php
              }?>
            <form method="POST"  class="white-font col-sm-6" onsubmit="return validateForm()">
                <div class="form-group " >
                    <label for="name-faculty">Name</label>
                    <input id="name-faculty" class="form-control " type="text" name="name-faculty">
                    <p class="error" id="error-name-faculty"></p>
                </div>
                <div class="form-group ">
                    <label for="id-faculty">Faculty ID</label>
                    <input id="id-faculty" class="form-control" type="text" name="id-faculty">
                    <p class="error" id="error-id-faculty"></p>
                </div>
                <div class="form-group ">
                    <label for="dob-faculty">Date Of Birth</label>
                    <input type="date" id="dob-faculty" class="form-control" type="text" name="dob-faculty">
                </div>
                <div class="form-group ">
                    <label for="mobile-faculty">Mobile Number</label>
                    <input id="mobile-faculty" class="form-control" type="text" name="mobile-faculty">
                    <p class="error" id="error-mobile-faculty"></p>
                </div>
                <div class="form-group ">
                    <label for="email-faculty">E mail</label>
                    <input id="email-faculty" class="form-control" type="email" name="mail-faculty">
                    <p class="error" id="error-mobile-faculty"></p>
                </div>
                <div class="form-group ">
                  <label for="department">Department</label>
                  <select id="department" class="form-control"  name="department" >
                      <option>Select Department</option>
                      <option value="AS&H">AS&H Department</option>
                      <option value="CS">CS Department</option>
                      <option value="CEIT">CEIT  Department</option>
                      <option value="IT">IT  Department</option>
                      <option value="ECE">ECE  Department</option>
                      <option value="EN">EN  Department</option>
                      <option value="ME">ME  Department</option>
                      <option value="CIVIL">Civil  Department</option>
                      <option value="MCA">MCA  Department</option>
                      <option value="MBA">MBA  Department</option>
                  </select>
              </div>
                
                
                <div class="form-group ">
                    <label for="password-faculty">Password</label>
                    <input id="password-faculty" class="form-control" type="password" name="password-faculty" placeholder="minimun 6 characters">
                    <p class="error" id="error-password-faculty"></p>
                </div>
                <div class="form-group ">
                    <label for="confirm-password-faculty">Confirm Password</label>
                    <input id="confirm-password-faculty" class="form-control" type="password" name="confirm-password-faculty" placeholder="re-type your password">
                    <p class="error" id="error-confirm-password-faculty"></p>
                </div>
                &nbsp;&nbsp;<button class="btn btn-primary" type="submit">Register</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button class="btn btn-warning btn-sm " type="reset">Reset</button>
               
            </form>
            <br><br><br>

          </div>
            



          
          <!--javascript code-->
        <script>
          function validateName(name){
            var regName=/^[0-9a-zA-Z' ']{3,}$/i;
            var z1=regName.test(name);
            return z1;
          }
          function validateFacultyID(id){
            var regID= /^[0-9]{3,}$/i
            var z2=regID.test(id);
            return z2;
          }
          function validateMobile(mobile){
            if(($.isNumeric(mobile))&&mobile.length==10){
              return true;
            }
            else{
              return false;
            }
          }
          function validatePassword(password){
            if(password.length<6){
              return false;
            }
            else{
              return true;
            }
          }
          function confirmPassword(password , cpassword){
            if(password!=cpassword){
              return false;
            }
            else{
              return true;
            }
          }

          function validateForm(){
            var c=0;
            var y1= validateName($("#name-faculty").val());
            var y2= validateFacultyID($("#id-faculty").val());
            var y3= validateMobile($("#mobile-faculty").val());
            var y4= validatePassword($("#password-faculty").val());
            var y5= confirmPassword($("#password-faculty").val() , $("#confirm-password-faculty").val());

            $("#error-name-faculty").html("");
            $("#error-id-faculty").html("");
            $("#error-mobile-faculty").html("");
            $("#error-password-faculty").html("");
            $("#error-confirm-password-faculty").html("");

            if(!y1){
              $("#error-name-faculty").html("Invalid Name Credential");
              c++;
            }
            if(!y2){
              $("#error-id-faculty").html("Invalid Faculty Id");
              c++;
            }
            if(!y3){
              $("#error-mobile-faculty").html("Invalid Mobile");
              c++;
            }
            if(!y4){
              $("#error-password-faculty").html("Invalid Password");
              c++;
            }
            if(!y5){
              $("#error-confirm-password-faculty").html("Passwords did not match");
              c++;
            }
            if(c==0){
              return true;
            }
            else{
              return false;
            }


          }

        </script>





    </body>

</html>