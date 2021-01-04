<?php
  session_start();
  if(!array_key_exists("id" , $_SESSION) ){
    header("Location: login-hod.php");
  }
  else{
    include("connection.php");
    $error="";
    $total=0;$att=0;$per=0;$n="";
    $query="SELECT * FROM hod_info WHERE id='$_SESSION[id]'";
          $result=mysqli_query($link , $query);
          $row=mysqli_fetch_array($result);
          $name=$row['name'];
          $hod_id=$row['id'];
          $dob=$row['dob'];
          $mobile=$row['mobile'];
          $department=$row['department'];
          $email=$row['email'];

  if(array_key_exists("oldPassword", $_POST)){
    if($row['password']==$_POST['oldPassword']){
      $query1="UPDATE hod_info SET password = '$_POST[newPassword]' WHERE id ='$hod_id' ";
              
      if( mysqli_query($link,$query1) ){?>
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

  if(array_key_exists("add_admno", $_POST)){
    $query="INSERT INTO student_registration (adm_no , semester , subject_1 ,subject_2 ,subject_3 , subject_4 , subject_5 , subject_6)
     VALUES('$_POST[add_admno]' , '$_POST[semester]' , '$_POST[subject1]' , '$_POST[subject2]' , '$_POST[subject3]' , '$_POST[subject4]' , '$_POST[subject5]' , '$_POST[subject6]'  )";
    if(mysqli_query($link , $query)){?>
      <script>
        alert("Student Added Successfully");
      </script><?php
              
    }
    else{?>
      <script>
        alert("Couldn't Add Student");
      </script><?php
    }
  }

  if(array_key_exists("delete" , $_POST)){
    $query1="DELETE FROM student_registration WHERE adm_no='$_POST[delete]' LIMIT 1";
    $query2="DELETE FROM student_login WHERE adm_no='$_POST[delete]' LIMIT 1";
    if(mysqli_query($link , $query1) && mysqli_query($link , $query2)){?>
      <script>
        alert("Student Deleted Successfully");
      </script><?php
    }
    else{?>
      <script>
        alert("Couldn't Delete Student");
      </script><?php
    }
  }

  if(array_key_exists("fac_id", $_POST)){
    $query="INSERT INTO faculty_registration (fac_id , sub_1 , sub_2 ,sub_3 ,sub1_sem , sub2_sem , sub3_sem )
     VALUES('$_POST[fac_id]' , '$_POST[fac_sub1]' , '$_POST[fac_sub2]' , '$_POST[fac_sub3]' , '$_POST[sub1_sem]' , '$_POST[sub2_sem]' , '$_POST[sub3_sem]'  )";
    if(mysqli_query($link , $query)){?>
      <script>
        alert("Faculty Added Successfully");
      </script><?php
              
    }
    else{?>
      <script>
        alert("Couldn't Add Faculty");
      </script><?php
    }
  }

  if(array_key_exists("delete_fac" , $_POST)){
    $query1="DELETE FROM faculty_registration WHERE fac_id='$_POST[delete_fac]' LIMIT 1";
    $query2="DELETE FROM faculty_login WHERE fac_id='$_POST[delete_fac]' LIMIT 1";
    if(mysqli_query($link , $query1) && mysqli_query($link , $query2)){?>
      <script>
        alert("Faculty Deleted Successfully");
      </script><?php
    }
    else{?>
      <script>
        alert("Couldn't Delete Faculty");
      </script><?php
    }
  }

  if(array_key_exists("adm" , $_POST)){
    $query="SELECT name , attendance from student_registration where adm_no='$_POST[adm]'";
    $row=mysqli_fetch_array(mysqli_query($link , $query));
    $n=$row['name'];
    $arr=str_split($row['attendance']);
    
    $total=sizeof($arr);
    if($arr[0]==""){
      $total-=1;
    }
    foreach($arr as $value){
      if($value=="p"){
        $att+=1;
      }
    }
    if($total!=0){
      $a=($att/$total)*100;
    $per= number_format((float)$a , 2 , "." , "");
    }
  }

  if(array_key_exists('notif-content-fac' , $_POST)){
    $query= "SELECT notification FROM faculty_registration where fac_id = '".$_POST['fid']."'";
    $row=mysqli_fetch_array(mysqli_query($link , $query));
    $msg=$row['notification'];
    $msg.="# ".$_POST['notif-content-fac']."&nbsp;&nbsp;&nbsp;&nbsp;-       ".date("y/m/d")."<br>";

    $query="UPDATE faculty_registration SET notification = '$msg' WHERE fac_id = '".$_POST['fid']."'";
    if(mysqli_query($link , $query)){?>
      <script>
        alert("Notice Sent Successfully");
      </script><?php
    }
    else{?>
      <script>
        alert("Couldn't Send Notice");
      </script><?php

    }
  }
  if(array_key_exists("new_name_hod" , $_POST)){
    $query="UPDATE hod_info 
            SET name='$_POST[new_name_hod]',
            dob='$_POST[new_dob_hod]',
            mobile='$_POST[new_mobile_hod]',
            email='$_POST[new_mail_hod]'
            WHERE id ='$hod_id'
            ";
    

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
  


  include("header.php");
  include("menu.php");
?>

        <div class="row">
          <!--dashboard menu-->
            <div class="col-sm-2">
                <nav class=" navbar-expand-sm  dashboard-menu hod-dash-menu navbar-dark ">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#SupportedContent" aria-controls="SupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon "></span>
                    </button>
                    <div class="collapse navbar-collapse"  id="SupportedContent">
                        <ul class="nav flex-sm-column  ">
                            <li class="nav-item border border-dark rounded dashboard-menu-hover">
                                
                                <div id="view-menu-hod" >
                                <a class="nav-link " href="#" >View Attendance </a>
                                </div>
                            </li>
                            <li class="nav-item border border-dark rounded dashboard-menu-hover">
                                
                                <div id="add-menu-hod" >
                                <a class="nav-link " href="#" >Add Student</a>
                                </div>
                            </li>
                            <li class="nav-item border border-dark rounded dashboard-menu-hover">
                                
                                <div id="remove-menu-hod" >
                                <a class="nav-link " href="#" >Remove Student </a>
                                </div>
                            </li>
                            <li class="nav-item border border-dark rounded dashboard-menu-hover">
                                
                                <div id="add-f-menu-hod" >
                                <a class="nav-link " href="#" >Add Faculty</a>
                                </div>
                            </li>
                            <li class="nav-item border border-dark rounded dashboard-menu-hover">
                                
                                <div id="remove-f-menu-hod">
                                <a class="nav-link " href="#">Remove Faculty</a>
                                </div>
                            </li>
                            <li class="nav-item border border-dark rounded dashboard-menu-hover">
                                
                                <div id="notice-menu-hod" >
                                <a class="nav-link " href="#" >Upload Notice</a>
                                </div>
                            </li>
                            <li class="nav-item border border-dark rounded dashboard-menu-hover">
                                
                                <div id="profile-menu-hod" >
                                <a class="nav-link " href="#" >Profile</a>
                                </div>
                            </li>
                            <li class="nav-item border border-dark rounded dashboard-menu-hover">
                                
                                <div id="edit-menu-hod" >
                                <a class="nav-link " href="#" >Edit Profile</a>
                                </div>
                            </li>
                            
                            <li class="nav-item border border-dark rounded dashboard-menu-hover">
                                
                                <div id="change-password-menu-hod" >
                                <a class="nav-link " href="#" >Change Password </a>
                                </div>
                            </li>
                            
                            
                            <li class="nav-item border border-dark rounded dashboard-menu-hover">
                                
                                <div id="logout-menu-hod" >
                                <a class="nav-link " href="login-hod.php?logout=1">Logout</a>
                                </div>
                            </li>
                            
                        </ul>
                    </div>
                </nav>
            </div>
            <!--dashboard main area-->
            <div class="col-sm-10">
                <div class="dashboard" id="view-attendance-hod" style="display: block;">
                  <h2 class="white-font text-center" >View Attendance</h2><br><br>
                  <form method="POST">
                    <div class="form-group ml-5 white-font">
                    <label>Enter Admission No. :</label>
                    <input type="text" name="adm" >

                    </div>
                    <div class="form-group ml-5">
                      <input type=submit class="btn btn-primary" value="View Attendance">
                    </div>

                  </form><br>
                  <div class="white-font ml-5">
                    <p>Name : <?php echo $n; ?><p>
                    <p>Total Lectures : <?php echo $total;?></p>
                    <p>Lectures Attended : <?php echo $att;?></p>
                    <p>Attendance Percentage : <?php echo $per;?> %</p>

                  </div>
                  

                </div>

                <div class="dashboard" id="add-student-hod" >
                  <h2 class="white-font text-center" >Add Student</h2><br><br><br>
                  <form class="ml-auto mr-auto col-sm-8  white-font" method="POST" >
                    <div class="row" >
                      <div class="form-group col-sm-6 ml-auto mr-auto">
                          <label for="admono">Enter Admission Number</label>
                          <input type="text" id="add-admno" class="form-control"  name="add_admno" placeholder="Enter Admission Number ">
                          
                      </div>
                      <div class="form-group col-sm-6 ml-auto mr-auto">
                          <label for="semester">Semester</label>
                          <input type="number" id="semester" class="form-control"  name="semester" placeholder="Semester" min="1" max="8">
                          
                      </div>
                    </div>
                    <div class="row" >
                      <div class="form-group col-sm-6 ml-auto mr-auto">
                          <label for="subject1">Subject 1</label>
                          <select  id="subject1" class="form-control"  name="subject1" >
                            <?php include("subject.php"); ?>
                          </select>
                      </div>
                      <div class="form-group col-sm-6 ml-auto mr-auto">
                          <label for="subject2">Subject 2</label>
                          <select  id="subject2" class="form-control"  name="subject2" >
                            <?php include("subject.php"); ?>
                          </select>
                      </div>
                    </div>
                    <div class="row" >
                      <div class="form-group col-sm-6 ml-auto mr-auto">
                          <label for="subject3">Subject 3</label>
                          <select  id="subject3" class="form-control"  name="subject3" >
                            <?php include("subject.php"); ?>
                          </select>
                      </div>
                      <div class="form-group col-sm-6 ml-auto mr-auto">
                          <label for="subject4">Subject 4</label>
                          <select  id="subject4" class="form-control"  name="subject4" >
                            <?php include("subject.php"); ?>
                          </select>
                      </div>
                    </div>
                    <div class="row" >
                      <div class="form-group col-sm-6 ml-auto mr-auto">
                          <label for="subject5">Subject 5</label>
                          <select  id="subject5" class="form-control"  name="subject5" >
                            <?php include("subject.php"); ?>
                          </select>
                      </div>
                      <div class="form-group col-sm-6 ml-auto mr-auto">
                          <label for="subject6">Subject 6</label>
                          <select  id="subject6" class="form-control"  name="subject6" >
                            <?php include("subject.php"); ?>
                          </select>
                      </div>
                    </div>

                    


                    <div class="form-group col-sm-6 ml-auto mr-auto">
                      <input type="submit" name="add_student" class="btn btn-primary" value="Add Student">
                    </div>



                  </form>

                </div>
                
                <div class="dashboard" id="remove-student-hod" >
                    <h2 class="white-font text-center" >Remove Student</h2><br><br><BR>
                    <form class="ml-auto mr-auto col-sm-10  white-font" method="POST" >
                      <div class="form-group col-sm-6 ml-auto mr-auto">
                          <label for="delete">Enter Admission Number</label>
                          <input type="text" id="delete" class="form-control"  name="delete" placeholder="Enter Admission Number ">
                          
                      </div><br><br>
                      <div class="form-group col-sm-6 ml-auto mr-auto">
                      <input type="submit" name="delete_student" class="btn btn-primary" value="Delete Student">
                    </div>



                  </form>


                </div>
                <div class="dashboard" id="add-faculty-hod" >
                    <h2 class="white-font text-center" >Add Faculty</h2><br><br>

                    <form class="ml-auto mr-auto col-sm-8  white-font" method="POST" >
                    <div class="row" >
                      <div class="form-group col-sm-6 ml-auto mr-auto">
                          <label for="fac_id">Enter Faculty ID</label>
                          <input type="text" id="fac_id" class="form-control"  name="fac_id" placeholder="Enter Faculty ID">
                          
                      </div>
                      
                    </div>
                    <div class="row" >
                      <div class="form-group col-sm-6 ml-auto mr-auto">
                          <label for="fac_sub1">Subject 1</label>
                          <select   class="form-control"  name="fac_sub1" >
                            <?php include("subject.php"); ?>
                          </select>
                      </div>
                      <div class="form-group col-sm-6 ml-auto mr-auto">
                          <label for="sub1_sem">Semester For Subject 1</label><br>
                          <input type="number" min="1" max="8" name="sub1_sem" placeholder="Semester">
                      </div>
                    </div>
                    <div class="row" >
                      <div class="form-group col-sm-6 ml-auto mr-auto">
                          <label for="fac_sub2">Subject 2</label>
                          <select   class="form-control"  name="fac_sub2" >
                            <?php include("subject.php"); ?>
                          </select>
                      </div>
                      <div class="form-group col-sm-6 ml-auto mr-auto">
                          <label for="sub2_sem">Semester For Subject 2</label><br>
                          <input type="number" min="1" max="8" name="sub2_sem" placeholder="Semester">
                      </div>
                    </div>
                    <div class="row" >
                      <div class="form-group col-sm-6 ml-auto mr-auto">
                          <label for="fac_sub3">Subject 3</label>
                          <select   class="form-control"  name="fac_sub3" >
                            <?php include("subject.php"); ?>
                          </select>
                      </div>
                      <div class="form-group col-sm-6 ml-auto mr-auto">
                          <label for="sub3_sem">Semester For Subject 3</label><br>
                          <input type="number" min="1" max="8" name="sub3_sem" placeholder="Semester">
                      </div>
                    </div>

                    


                    <div class="form-group col-sm-6 ml-auto mr-auto">
                      <input type="submit" name="add_faculty" class="btn btn-primary" value="Add Faculty">
                    </div>



                  </form>



                </div>
                <div class="dashboard" id="remove-faculty-hod" >
                    <h2 class="white-font text-center" >Remove Faculty</h2>br><br><BR>
                    <form class="ml-auto mr-auto col-sm-10  white-font" method="POST" >
                      <div class="form-group col-sm-6 ml-auto mr-auto">
                          <label for="delete_fac">Enter Faculty ID</label>
                          <input type="text"  class="form-control"  name="delete_fac" placeholder="Enter Faculty ID">
                          
                      </div><br><br>
                      <div class="form-group col-sm-6 ml-auto mr-auto">
                      <input type="submit" name="delete_faculty" class="btn btn-primary" value="Delete Faculty">
                    </div>



                  </form>
                </div>

                <div class="dashboard" id="upload-notice-hod" >
                    <h2 class="white-font text-center" >Upload Notice</h2><br>
                    <form style="width:70%;" method="POST" class="ml-auto mr-auto">
                      <div class="form-group" >
                        <input type=text class="form-control" name="fid"  placeholder=" Enter Faculty ID">
                      </div><br>
                      <div class="form-group" >
                      
                        <textarea id="my-textarea" class="form-control" name="notif-content-fac" rows="8" placeholder="Write message here...!"></textarea>
                      </div><br>
                      <div class="form-group" >
                        <input class=" btn btn-primary" type="submit" name="submit" value="Send Notice">
                      </div>
                    </form>
                </div>

                <div class="dashboard white-font" id="view-profile-hod" >
                  <h2 class=" text-center" >View Profile</h2>
                  <div class="col-sm-12">
                    <div class="row" >
                      <h4 > NAME : <?php echo $name?> </h4>
                      <h4 > HOD ID : <?php echo $hod_id?> </h4><br><br>
                    </div>
                    <div class="row ">
                      <h4 > Date Of Birth : <?php echo $dob?> </h4>
                      <h4  > Department : <?php echo $department?> </h4><br><br>
                    </div>
                    <div class="row ">
                      <h4  > Mobile : <?php echo $mobile?> </h4>
                      <h4 > Email : <?php echo $email?> </h4><br><br>
                    </div>
  
                  </div>

                </div>
                <div class="dashboard" id="edit-profile-hod" >
                  <h2 class="white-font text-center" >Edit Profile</h2><br><br>
                  <form method="POST" >
                    <div class="col-sm-6 form-group ml-auto mr-auto">
                      <label for="new_name_hod" class="white-font">Name :</label>
                      <input type="text" name= "new_name_hod" class="form-control" value=<?php echo $name; ?> >
                    </div>

                    <div class="col-sm-6 form-group ml-auto mr-auto">
                      <label for="new_dob_hod" class="white-font">Date Of Birth :</label>
                      <input type="date" name= "new_dob_hod" class="form-control" value=<?php echo $dob; ?> >
                    </div>

                    <div class="col-sm-6 form-group ml-auto mr-auto">
                      <label for="new_mobile_hod" class="white-font">Mobile</label>
                      <input type="text" name= "new_mobile_hod" class="form-control"  value=<?php echo $mobile; ?> >
                    </div>
                    <div class="col-sm-6 form-group ml-auto mr-auto">
                      <label for="new_mail_hod" class="white-font">Mobile</label>
                      <input type="text" name= "new_mail_hod" class="form-control"  value=<?php echo $email; ?> >
                    </div>

                    <div class="col-sm-6 form-group ml-auto mr-auto">
                      <input type="submit" value="Save" class="btn btn-primary ">
                    </div>

                  </form>


                </div>  
                <div class="dashboard white-font" id="change-password-hod" >
                  <h2 class=" text-center" >Change Password</h2>
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
                <div  id="student-logout" >
                  
                </div>
              </div>
        </div>





        
      <!--javascript code-->
        <script>

          function menuHide(){
            $("#view-attendance-hod").css("display","none");
            $("#add-student-hod").css("display","none");
            $("#remove-student-hod").css("display","none");
            $("#add-faculty-hod").css("display","none");
            $("#remove-faculty-hod").css("display","none");
            $("#upload-notice-hod").css("display","none");
            $("#view-profile-hod").css("display","none");
            $("#edit-profile-hod").css("display","none");
            $("#change-password-hod").css("display","none");
          }


          $("#view-menu-hod").click(function(){
            menuHide()
            $("#view-attendance-hod").css("display","block");
          });
          $("#add-menu-hod").click(function(){
            menuHide()
            $("#add-student-hod").css("display","block");
          });
          $("#remove-menu-hod").click(function(){
            menuHide()
            $("#remove-student-hod").css("display","block");
          });
          $("#add-f-menu-hod").click(function(){
            menuHide()
            $("#add-faculty-hod").css("display","block");
          });
          $("#remove-f-menu-hod").click(function(){
            menuHide()
            $("#remove-faculty-hod").css("display","block");
          });
          $("#notice-menu-hod").click(function(){
            menuHide()
            $("#upload-notice-hod").css("display","block");
          });
          $("#profile-menu-hod").click(function(){
            menuHide()
            $("#view-profile-hod").css("display","block");
          });
          $("#edit-menu-hod").click(function(){
            menuHide()
            $("#edit-profile-hod").css("display","block");
          });
          $("#change-password-menu-hod").click(function(){
            menuHide()
            $("#change-password-hod").css("display","block");
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