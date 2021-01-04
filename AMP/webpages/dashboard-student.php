<?php
session_start();
include("header.php");
  include("menu.php");
  if(!array_key_exists("id" , $_SESSION) ){
    header("Location: login-student.php");
  }
  else{
    include("connection.php");
    $msg="";
    $error="";
    $query="SELECT * FROM student_registration WHERE id='$_SESSION[id]'";
          $result=mysqli_query($link , $query);
          $row=mysqli_fetch_array($result);
          $name=$row['name'];
          $admno=$row['adm_no'];
          $dob=$row['dob'];
          $mobile=$row['mobile'];
          $branch=$row['branch'];
          $section=$row['section'];
          $sub1=$row['subject_1'];
          $sub2=$row['subject_2'];
          $sub3=$row['subject_3'];
          $sub4=$row['subject_4'];
          $sub5=$row['subject_5'];
          $sub6=$row['subject_6'];
          $notif=$row['notification'];
          $arr=str_split($row['attendance']);
    
          $total=sizeof($arr);
          if($arr[0]==""){
            $total-=1;
          }
          $att=0;
          foreach($arr as $value){
            if($value=="p"){
              $att+=1;
            }
          }
          if($total!=0){
            $a=($att/$total)*100;
          $per= number_format((float)$a , 2 , "." , "");
          }
          

    if(array_key_exists("oldPassword", $_POST)){
      if($row['password']==md5($_POST['oldPassword'])){
        $query1="UPDATE student_registration SET password = '".md5($_POST['newPassword'])."' WHERE adm_no ='$admno' ";
        $query2="UPDATE student_login SET password = '".md5($_POST['newPassword'])."' WHERE adm_no ='$admno' ";
        if(mysqli_query($link,$query2)  && mysqli_query($link,$query1) ){?>
          <script>
            alert("Password Changed Successfully");
          </script><?php
          
        }
        else{?>
          <script>
            alert("Couldn't Change Password");
          </script><?php
        }
      }
    }

    if(array_key_exists("new_name" , $_POST)){
      $query="UPDATE student_registration 
              SET name='$_POST[new_name]',
              dob='$_POST[new_dob]',
              mobile='$_POST[new_mobile]'
              WHERE adm_no ='$admno'
              ";
      $name=$_POST['new_name'];
      $dob=$_POST['new_dob'];
      $mobile=$_POST['new_mobile'];

      if(mysqli_query($link , $query)){?>
        <script>
            alert("Profile Updated Successfully");
          </script><?php
      }
      else{?>
        <script>
          alert("Couldn't Update Profile");
        </script><?php
      }

    }

        
  }
  
?>

        <div class="row">
          <!--dashboard menu-->
            <div class="col-sm-2">
                <nav class=" navbar-expand-sm  dashboard-menu stu-dash-menu navbar-dark sticky-top">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#SupportedContent" aria-controls="SupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon "></span>
                    </button>
                    <div class="collapse navbar-collapse"  id="SupportedContent">
                        <ul class="nav flex-sm-column  ">
                            <li class="nav-item border border-dark rounded dashboard-menu-hover">
                                
                                <div id="view-profile-menu" >
                                <a class="nav-link " href="#" >View Profile <span class="sr-only">(current)</span></a>
                                </div>
                            </li>
                            <li class="nav-item border border-dark rounded dashboard-menu-hover">
                                
                                <div id="edit-profile-menu" >
                                <a class="nav-link " href="#" >Edit Profile</a>
                                </div>
                            </li>
                            <li class="nav-item border border-dark rounded dashboard-menu-hover">
                                
                                <div id="view-attendance-menu" >
                                <a class="nav-link " href="#">View Attendance</a>
                                </div>
                            </li>
                            <li class="nav-item border border-dark rounded dashboard-menu-hover">
                                
                                <div id="notification-menu">
                                <a class="nav-link " href="#">Notifications</a>
                                </div>
                            </li>
                            <li class="nav-item border border-dark rounded dashboard-menu-hover">
                                
                                <div id="change-password-menu" >
                                <a class="nav-link " href="#">Change Password</a>
                                </div>
                            </li>
                            <li class="nav-item border border-dark rounded dashboard-menu-hover">
                                
                                <div id="logout" >
                                <a class="nav-link " href="login-student.php?logout=1">Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <!--dashboard area-->
            <div class="col-sm-10">
                <div class="dashboard text-center white-font " id="student-profile" >
                  <h2  >Profile</h2><br>
                  <div class="col-sm-12 ">
                    <div class="row" >
                      <h4 > NAME : <?php echo $name?> </h4>
                      <h4 > Admission No : <?php echo $admno?> </h4><br><br>
                    </div>
                    <div class="row ">
                      <h4 > Date Of Birth : <?php echo $dob?> </h4>
                      <h4  > Mobile No : <?php echo $mobile?> </h4><br><br>
                    </div>
                    <div class="row ">
                      <h4  > Branch : <?php echo $branch?> </h4>
                      <h4 > Section : <?php echo $section?> </h4><br><br>
                    </div>
                    <div class="row ">
                      <h4  >Subject 1 : <?php echo $sub1?> </h4>
                      <h4 > Subject 2 : <?php echo $sub2?> </h4><br><br>
                    </div>
                    <div class="row ">
                      <h4  > Subject 3 : <?php echo $sub3?> </h4>
                      <h4 > Subject 4 : <?php echo $sub4?> </h4><br><br>
                    </div>
                    <div class="row ">
                      <h4  > Subject 5 : <?php echo $sub5?> </h4>
                      <h4 > Subject 6 : <?php echo $sub6?> </h4><br><br>
                    </div>
                    
  
                  </div>
                </div>
                <div class="dashboard " id="edit-student-profile" >
                  <h2 class="white-font text-center" >Edit Profile</h2><br><br>
                  <form method="POST" >
                    <div class="col-sm-6 form-group ml-auto mr-auto">
                      <label for="new_name" class="white-font">Name :</label>
                      <input type="text" name= "new_name" class="form-control" value=<?php echo $name; ?> >
                    </div>

                    <div class="col-sm-6 form-group ml-auto mr-auto">
                      <label for="new_dob" class="white-font">Date Of Birth :</label>
                      <input type="date" name= "new_dob" class="form-control" value=<?php echo $dob; ?> >
                    </div>

                    <div class="col-sm-6 form-group ml-auto mr-auto">
                      <label for="new_mobile" class="white-font">Mobile</label>
                      <input type="text" name= "new_mobile" class="form-control"  value=<?php echo $mobile; ?> >
                    </div>

                    <div class="col-sm-6 form-group ml-auto mr-auto">
                      <input type="submit" value="Save" class="btn btn-primary ">
                    </div>

                  </form>





                  
              </div>
              <div class="dashboard" id="student-attendance" >
                <h2 class="white-font text-center" >Attendance</h2><br><br>
                <div class="white-font ml-5">
                    <p>Name : <?php echo $name; ?><p>
                    <p>Total Lectures : <?php echo $total;?></p>
                    <p>Lectures Attended : <?php echo $att;?></p>
                    <p>Attendance Percentage : <?php echo $per;?> %</p>

                  </div>
              </div>  
              <div class="dashboard" id="student-notification" >
                <h2 class="white-font text-center" >Notifications</h2><br><br>
                <div class="text-muted" style="margin:25px;">
                <?php echo $notif;?>
                </div>
              </div>
              <div class="dashboard" id="student-change-password" >
                <h2 class="white-font text-center" >Change Password</h2><br><br>
                

                <form class="ml-auto mr-auto col-sm-8  white-font p-change" method="POST" onsubmit="return validateChangePassword()">
                  <div class="form-group col-sm-6 ml-auto mr-auto">
                      <label for="oldPassword">Old Password</label>
                      <input type="password"  class="form-control"  name="oldPassword" placeholder="Enter Your Password ">
                  </div>
                  <div class="form-group col-sm-6 ml-auto mr-auto">
                      <label for="newPassword">New Password</label>
                      <input type="password" id="npassword" class="form-control"  name="newPassword" placeholder="Enter New Password ">
                  </div>
                  <div class="form-group col-sm-6 ml-auto mr-auto">
                      <label for="confirmPassword">Confirm New Password</label>
                      <input type="password" id="cpassword" class="form-control"  name="confirmPassword" placeholder="Confirm Your Password ">
                      <p class="error" id="error-cpassword"></p>
                  </div>
                  <div class="form-group col-sm-6 ml-auto mr-auto">
                    <input type="submit" name="changePassword" class="btn btn-primary" value="Change Password">
                  </div>



                </form>



              </div>
              
              
            </div>
        </div>





        
    <!--javascript code here-->
        <script>

          function menuHide(){
            $("#student-profile").css("display","none");
            $("#edit-student-profile").css("display","none");
            $("#student-attendance").css("display","none");
            $("#student-notification").css("display","none");
            $("#student-change-password").css("display","none");
          }


          $("#view-profile-menu").click(function(){
            menuHide()
            $("#student-profile").css("display","block");
          });
          $("#edit-profile-menu").click(function(){
            menuHide()
            $("#edit-student-profile").css("display","block");
          });
          $("#view-attendance-menu").click(function(){
            menuHide()
            $("#student-attendance").css("display","block");
          });
          $("#notification-menu").click(function(){
            menuHide()
            $("#student-notification").css("display","block");
          });
          $("#change-password-menu").click(function(){
            menuHide()
            $("#student-change-password").css("display","block");
          });
          $(".dashboard-menu-hover").hover(
          function() {
            
            $(this).css("background-color","rgb(48,70,95)")

          }, function() {
            $(this).css("background-color","rgb(9, 23, 39)")
          }
        );


        function validateChangePassword(){
          var np=$("#npassword").val();
          var cp=$("#cpassword").val();
          if(cp!=np){

            $("#error-cpassword").html("Confirmed Password didn't matched");
            return false;
          }
          else{
            return true;
          }
        }

        </script>


    </body>
</html>