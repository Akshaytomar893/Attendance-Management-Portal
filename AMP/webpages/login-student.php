<?php
  $error="";
  $Password="";
  session_start();
  if(array_key_exists("logout", $_GET) ){
    unset($_SESSION);
    header('Location: login-student.php');
    session_destroy();
}
  
  if(array_key_exists('submit' , $_POST)){
      include("connection.php");

      $query="SELECT * FROM student_login where adm_no = '".mysqli_real_escape_string($link , $_POST['adm_no'])."' ";
      $result=mysqli_query($link , $query);
      $row=mysqli_fetch_array($result);
                  
      if(isset($row)){
        $hashedPassword= md5($_POST['password']);
        if($hashedPassword==$row['password']){
          $_SESSION['id']=$row['id'];
          header("Location: dashboard-student.php");
        }
        else{
          $error.="<span>You Entered An Incorrect Password<br></span>";
        }
      }
      else{
        $error.="<span>User Not Found<br></span>";
      }


  }
  include("header.php");
  include("menu.php");
  


?>

       <div class="col-md-7 right container margin-top">
      



          <!--login form-->
            <h1 class="white-font">Student Login </h1><br>
            <?php
              if($error!=""){?>
                <div class="alert alert-danger" role="alert">
                  <h5 class="alert-heading">OOPS There Was An Error..!</h5><hr>
                  <?php echo $error ?>
                </div><?php
              }?>
            <form class="col-sm-6" method="POST"  onsubmit="return validate()">

                <div class="form-group ">
                  <label for="admissionNumber" class="white-font">Admission Number</label>
                  <input type="text" class="form-control" id="admissionNumber"name="adm_no" >
                  <p class="error" id="err-adm-no"></p>
                  
                </div>
                <div class="form-group">
                  <label for="password" class="white-font">Password</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="minimum 6 characters">
                  <p class="error" id="err-password"></p>
                </div>
                
                
                <button type="submit" class="btn btn-primary" name="submit">Login</button>&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="button" class="btn btn-danger btn-sm" id="forgot-password">Forgot Password</button>
              </form>

              <div id="password-reset-form" class=" container " style="height:auto; ">
                  <h3>Forgot Password</h3>
                  <form method="POST"  onsubmit="return fPasswordValidaate();">

                    <div class="form-group">
                      <label for="h-id" class="white-font">Admission No.</label>
                      <input type="text" class="form-control" id="adm" name="adm" >
                      <p class="error" id="err-hod-id"></p>
                      
                    </div>

                    <div class="form-group">
                      <label for="dob" class="white-font">Date Of Birth</label>
                      <input type="date" class="form-control" id="dob" name="dob" >
                      
                    </div>

                    <div class="form-group">
                      <label for="new-password-hod" class="white-font">Enter New Password</label>
                      <input type="password" class="form-control" id="n-password" placeholder="minimum 6 characters" name="n-password">
                      <p class="error" id="err-password-hod"></p>
                    
                    </div>

                    <div class="form-group">
                      <label for="confirm-password" class="white-font">Confirm Password</label>
                      <input type="password" class="form-control" id="c-password" name="c-password" placeholder="minimum 6 characters">
                      <p class="error" id="err"></p>
                      
                    </div>
                  
                    
                    
                    <input type="submit" class="btn btn-primary btn-sm" id="reset" value="Reset Password">
                    <input type="button" class="btn btn-danger btn-sm" id="cancel-reset-password" value="Cancel">

                    
                  </form>
              </div>





        </div>

        
    <!--js code-->
        <script>
            function validate(){
              $("#err-adm-no").html("");
              $("#err-password").html("");
              var x=$("#admissionNumber").val();
              var y=/^[0-9a-zA-Z]{11,}$/i;
              var z=y.test(x);

              if(z==false ){
                $("#err-adm-no").html("*Enter A Valid Admission Number  !!");
                return false;
              }
              else{
                var p=$("#password").val();
                if(p.length<6){
                  $("#err-password").html("*Enter A Valid Password  !!");
                  return false;
                }
                else{
                  return true;
                }
              }
            }
            $("#forgot-password").click(function(){
                $("#password-reset-form").css("display","block");
            });
            $("#cancel-reset-password").click(function(){
                $("#password-reset-form").css("display","none");
            });
            $("#reset").click(function(){
                $("#password-reset-form").css("display","none");
                $("#reset-password").css("display","block");
            });
            function fPasswordValidaate(){
              var n=$("#n-password").val();
              var c=$("#c-password").val();
              if(n.length<6){
                $("#err").html("*Password must have atleast 6 characters..  !!");
                return false;
              }
              else if(n!=c){
                $("#err").html("*Password and Confirm Password Doesn't match..  !!");
                return false; 
              }
              else{
                return true;
              }
            }
        </script>


        
    </body>
    </html>