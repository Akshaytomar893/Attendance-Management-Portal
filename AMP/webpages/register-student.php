<?php

    $error="";
    $Password="";
    session_start();
  
    if(array_key_exists('adm_no' , $_POST)){
        include("connection.php");
        $query="SELECT * FROM student_registration where adm_no = '".mysqli_real_escape_string($link , $_POST['adm_no'])."' ";
         $result=mysqli_query($link , $query);
         $row=mysqli_fetch_array($result);
         
          if(isset($row)){
            if($row['password']!=""){
              $error.="<p>Already Registered..</p>";
            }
            else{
              $query1 = "UPDATE student_registration SET
                      name='".mysqli_real_escape_string($link , $_POST['name'])."',
                      dob='".mysqli_real_escape_string($link , $_POST['dob'])."',
                      mobile='".mysqli_real_escape_string($link , $_POST['mobile'])."',
                      branch='".mysqli_real_escape_string($link , $_POST['branch'])."',
                      section='".mysqli_real_escape_string($link , $_POST['section'])."',
                      password='".mysqli_real_escape_string($link , $_POST['password'])."'
                      WHERE id = '$row[id]' LIMIT 1";

              $query2="INSERT INTO student_login (adm_no , password) VALUES('".mysqli_real_escape_string($link , $_POST['adm_no'])."' ,  '".md5($_POST[password])."' )   ";
              
              if(!mysqli_query($link , $query1)){
                $error .="<p>Couldn't Sign Up ... Please Try Again Later </p>";
              }
              else{
                mysqli_query($link , $query2);
                $query="UPDATE student_registration SET password= '".md5($_POST['password'])."' WHERE id='$row[id]'";
                mysqli_query($link,$query);
                $_SESSION['id']=$row[id];
                header("Location: dashboard-student.php");
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
            <!--registraion form-->
            <h1 class="white-font">Student Registration</h1><br>
            <?php
              if($error!=""){?>
                <div class="alert alert-danger" role="alert">
                  <h5 class="alert-heading">OOPS There Was An Error..!</h5><hr>
                  <?php echo $error ?>
                </div><?php
              }?>
            <form method="POST"  class="white-font col-sm-6" onsubmit="return validateForm()">
                <div class="form-group " >
                    <label for="name">Name</label>
                    <input id="name" class="form-control " type="text" name="name">
                    <p class="error" id="error-name"></p>
                </div>
                <div class="form-group ">
                    <label for="adm-no">Admission Number</label>
                    <input id="adm-no" class="form-control" type="text" name="adm_no">
                    <p class="error" id="error-admno"></p>
                </div>
                <div class="form-group ">
                    <label for="dob">Date Of Birth</label>
                    <input type="date" id="dob" class="form-control" type="text" name="dob">
                </div>
                <div class="form-group ">
                    <label for="mobile">Mobile Number</label>
                    <input id="mobile" class="form-control" type="text" name="mobile">
                    <p class="error" id="error-mobile"></p>
                </div>
                <div class="form-group ">
                    <label for="branch">Branch</label>
                    <select id="branch" class="form-control"  name="branch" >
                        <option>SELECT BRANCH</option>
                        <option value="cse">CSE</option>
                        <option value="ceit">CEIT</option>
                        <option value="it">IT</option>
                        <option value="ece">ECE</option>
                        <option value="en">EN</option>
                        <option value="me">ME</option>
                        <option value="civil">Civil</option>
                        <option value="mca">MCA</option>
                        <option value="mba">MBA</option>
                    </select>
                </div>
                <div class="form-group ">
                    <label for="section">Section</label>
                    <select id="section" class="form-control"  name="section" >
                        <option>Select Section</option>
                        <option value="a">A</option>
                        <option value="b">B</option>
                        <option value="c">C</option>
                        <option value="na">Not Applicable</option>
                    </select>
                </div>
                <div class="form-group ">
                    <label for="password">Password</label>
                    <input id="password" class="form-control" type="password" name="password" placeholder="minimun 6 characters">
                    <p class="error" id="error-password"></p>
                </div>
                <div class="form-group ">
                    <label for="confirm-password">Confirm Password</label>
                    <input id="confirm-password" class="form-control" type="password" name="cpassword" placeholder="re-type your password">
                    <p class="error" id="error-confirm-password"></p>
                </div>
                &nbsp;&nbsp;
                <div class="form-group ">
                  <input class="btn btn-primary" type="submit" value="Register"></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <button class="btn btn-warning btn-sm " type="reset">Reset</button>
                </div>
               
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
          function validateAdmNo(admNo){
            var regAdmNo= /^[0-9a-zA-Z]{11,}$/i
            var z2=regAdmNo.test(admNo);
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
            var y1= validateName($("#name").val());
            var y2= validateAdmNo($("#adm-no").val());
            var y3= validateMobile($("#mobile").val());
            var y4= validatePassword($("#password").val());
            var y5= confirmPassword($("#password").val() , $("#confirm-password").val());

            $("#error-name").html("");
            $("#error-admno").html("");
            $("#error-mobile").html("");
            $("#error-password").html("");
            $("#error-confirm-password").html("");

            if(!y1){
              $("#error-name").html("Invalid Name Credential");
              c++;
            }
            if(!y2){
              $("#error-admno").html("Invalid Admission Number");
              c++;
            }
            if(!y3){
              $("#error-mobile").html("Invalid Mobile");
              c++;
            }
            if(!y4){
              $("#error-password").html("Invalid Password");
              c++;
            }
            if(!y5){
              $("#error-confirm-password").html("Passwords did not match");
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