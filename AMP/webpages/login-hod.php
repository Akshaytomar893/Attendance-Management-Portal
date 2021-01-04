<?php
  $error="";
  session_start();
  if(array_key_exists("logout", $_GET)){
    
    unset($_SESSION);
    header('Location: login-hod.php');
    session_destroy();
  }
  
  include("connection.php");
  if(array_key_exists('id' , $_POST)){
      

      $query="SELECT * FROM hod_info where id = '".mysqli_real_escape_string($link , $_POST['id'])."' ";
      $result=mysqli_query($link , $query);
      $row=mysqli_fetch_array($result);
                  
      if(isset($row)){
        $Password= $_POST['password'];
        if($Password==$row['password']){
          $_SESSION['id']=$row['id'];
          header("Location: dashboard-hod.php");
        }
        else{
          $error.="<span>You Entered An Incorrect Password<br></span>";
        }
      }
      else{
        $error.="<span>User Not Found<br></span>";
      }


  }

  if(array_key_exists("n-password", $_POST)){
    $query="SELECT id , dob FROM hod_info WHERE id='".$_POST['h-id']."'";
    $result=mysqli_query($link , $query);
      $row=mysqli_fetch_array($result);
                  
      if(isset($row)){
        $error.="<span>UserFound<br></span>";
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
            <h1 class="white-font">HOD Login </h1><br>
            <form class="col-sm-6" method="POST"  onsubmit="return validate()">

                <div class="form-group ">
                  <label for="hod-id" class="white-font">HOD ID</label>
                  <input type="text" class="form-control" id="id" name="id" >
                  <p class="error" id="err-hod-id"></p>
                  
                </div>
                <div class="form-group">
                  <label for="password-hod" class="white-font">Password</label>
                  <input type="password" class="form-control" id="password-hod" placeholder="minimum 6 characters" name="password">
                  <p class="error" id="err-password-hod"></p>
                </div>
                
                
                <button type="submit" class="btn btn-primary">Login</button>&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="button" class="btn btn-danger btn-sm" id="forgot-password">Forgot Password</button>
              </form>
              <!--forgot password form-->
              <div id="password-reset-form" class=" container " style="height:auto; ">
                  <h3>Forgot Password</h3>
                  <form method="POST"  onsubmit="return fPasswordValidaate();">

                    <div class="form-group">
                      <label for="h-id" class="white-font">HOD ID</label>
                      <input type="text" class="form-control" id="h-id" name="h-id" >
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
              $("#err-hod-id").html("");
              $("#err-password-hod").html("");
              var x=$("#id").val();
              var y=/^[0-9]{3,}$/i;
              var z=y.test(x);

              if(z==false ){
                $("#err-hod-id").html("*Enter A Valid ID  !!");
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