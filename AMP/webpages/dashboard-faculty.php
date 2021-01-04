<?php
  session_start();
  if(!array_key_exists("fac_id" , $_SESSION) ){
    header("Location: login-faculty.php");
  }
  else{
    include("connection.php");
    $msg="";
    $error="";$r=false;$c=0;
    $sub1="";$sub2="";$sub3="";$sub1_sem="";$sub2_sem="";$sub3_sem="";
    $query ="SELECT * FROM faculty_registration WHERE fac_id='$_SESSION[fac_id]'";
    $row=mysqli_fetch_array(mysqli_query($link , $query));
    $f_id=$row['fac_id'];
    $name=$row['name'];
    $dob=$row['dob'];
    $mail=$row['mail'];
    $mobile=$row['mobile'];
    $dep=$row['department'];
    $notice=$row['notification'];
    if($row['sub_1']!="Select Subject"){
      $sub1=$row['sub_1'];
      $sub1_sem=$row['sub1_sem'];
    }
    if($row['sub_2']!="Select Subject"){
      $sub2=$row['sub_2'];
      $sub2_sem=$row['sub2_sem'];
    }
    if($row['sub_2']!="Select Subject"){
      $sub3=$row['sub_3'];
      $sub3_sem=$row['sub3_sem'];
    }

    if(array_key_exists("oldPassword", $_POST)){
      if($row['password']==md5($_POST['oldPassword'])){
        $query1="UPDATE faculty_registration SET password = '".md5($_POST['newPassword'])."' WHERE fac_id ='$f_id' ";
        $query2="UPDATE faculty_login SET password = '".md5($_POST['newPassword'])."' WHERE fac_id ='$f_id' ";
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

    
    
    

    if(array_key_exists('notif-content' , $_POST)){
      $query= "SELECT notification FROM student_registration where adm_no = '".$_POST['admno']."'";
      $row=mysqli_fetch_array(mysqli_query($link , $query));
      $msg=$row['notification'];
      $msg.="# ".$_POST['notif-content']."&nbsp;&nbsp;&nbsp;&nbsp;-       ".date("y/m/d")."<br>";

      $query="UPDATE student_registration SET notification = '$msg' WHERE adm_no = '".$_POST['admno']."'";
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
    $total=0;$att=0;$per=0;$n="";
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

    if(array_key_exists("new_name_fac" , $_POST)){
      $name=$_POST['new_name_fac'];
      $dob=$_POST['new_dob_fac'];
      $mobile=$_POST['new_mobile_fac'];
      $mail=$_POST['new_mail_fac'];


      $query="UPDATE faculty_registration 
              SET name='$_POST[new_name_fac]',
              dob='$_POST[new_dob_fac]',
              mobile='$_POST[new_mobile_fac]',
              mail='$_POST[new_mail_fac]'
              WHERE fac_id ='$f_id'
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
            <div class="col-sm-2">
              <!--dashboard menu-->
                <nav class=" navbar-expand-sm  dashboard-menu fac-dash-menu navbar-dark sticky-top">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#SupportedContent" aria-controls="SupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon "></span>
                    </button>
                    <div class="collapse navbar-collapse"  id="SupportedContent">
                        <ul class="nav flex-sm-column  ">
                            <li class="nav-item border border-dark rounded dashboard-menu-hover py-2">
                                
                                <div id="mark-attendance" >
                                <a class="nav-link " href="#" >Mark Attendance </a>
                                </div>
                            </li>
                            <li class="nav-item border border-dark rounded dashboard-menu-hover py-2">
                                
                                <div id="view-attendance" >
                                <a class="nav-link " href="#" >View Attendance </a>
                                </div>
                            </li>
                            
                            <li class="nav-item border border-dark rounded dashboard-menu-hover py-2">
                                
                                <div id="upload-notice" >
                                <a class="nav-link " href="#" >Upload Notice</a>
                                </div>
                            </li>
                            <li class="nav-item border border-dark rounded dashboard-menu-hover py-2">
                                
                                <div id="notification-faculty">
                                <a class="nav-link " href="#">Notifications</a>
                                </div>
                            </li>
                            
                            <li class="nav-item border border-dark rounded dashboard-menu-hover py-2">
                                
                                <div id="view-profile-faculty" >
                                <a class="nav-link " href="#" >View Profile </a>
                                </div>
                            </li>
                            <li class="nav-item border border-dark rounded dashboard-menu-hover py-2">
                                
                                <div id="edit-profile-faculty" >
                                <a class="nav-link " href="#" >Edit Profile</a>
                                </div>
                            </li>
                            
                            
                            <li class="nav-item border border-dark rounded dashboard-menu-hover py-2">
                                
                                <div id="change-password-faculty" >
                                <a class="nav-link " href="#">Change Password</a>
                                </div>
                            </li>
                            <li class="nav-item border border-dark rounded dashboard-menu-hover py-2">
                                
                                <div id="logout" >
                                <a class="nav-link " href="login-faculty.php?logout=1">Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="col-sm-10">
                <div class="dashboard " id="mark-attendance-section" style="display: block;" >
                    <h2 class="white-font text-center" >Mark Attendance</h2>
                    <form method="POST" >
                      <div class="row white-font">
                        <div class="form-group ml-5">
                          <label for="subject1" ><?php echo $sub1 ?><label>&nbsp;&nbsp;&nbsp;
                          <input type="radio"  name="subject" value="<?php echo $sub1 ?>" >
                          
                        </div>
                        <div class="form-group ml-5">
                          <label for="subject2" ><?php echo $sub2 ?><label>&nbsp;&nbsp;&nbsp;
                          <input type="radio"  name=subject value="<?php echo $sub2 ?>" >
                        </div>
                        <div class="form-group ml-5">
                          <label for="subject3" ><?php echo $sub3 ?><label>&nbsp;&nbsp;&nbsp;
                          <input type="radio"  name=subject value="<?php echo $sub3 ?>" >
                        </div>
                        <div class="form-group ml-5">
                          <label for="sem" >Semseter :<label>&nbsp;&nbsp;&nbsp;
                          <input type="number" min="1" max="8" name="sem" placeholder="sem">
                        </div>
                        
                      </div>
                      <div class="form-group ml-5">
                        <input type="submit" class="btn btn-primary" value="Select">
                      </div>

                    </form>
                    <table class="mx-auto " >
                      <tr class="white-font" >
                        <th>Admission No.</th><th>Name</th><th>Attendance</th>
                      </tr>
                      <?php

                        if(array_key_exists('subject' , $_POST)){
                          $c=1;
                          $q="SELECT adm_no , name FROM student_registration WHERE 
                          (subject_1 = '$_POST[subject]' OR
                          subject_2 = '$_POST[subject]' OR
                          subject_3 = '$_POST[subject]' OR
                          subject_4 = '$_POST[subject]' OR
                          subject_5 = '$_POST[subject]' OR
                          subject_6 = '$_POST[subject]' ) and
                          semester='$_POST[sem]' ";

                          $r=mysqli_query($link , $q);
                          while($r1=mysqli_fetch_array($r)){?>
                            <tr class="text-light">
                              
                              <td><?php echo $r1['adm_no'];?></td>
                              <td><?php echo $r1['name'];?></td>
                              <td>
                              <form method="POST"  >
                                <div class="form-group">
                                    <label >Attendance :</label>
                                    <select  id=<?php echo $r1['adm_no'];?> style="width:20%">
                                      <option value=""></option>
                                      <option value="p">P</option>
                                      <option value="a">A</option>

                                    </select>
                                    
                                </div>
                              </form>
                                
                              </td>
                              <script type="text/javascript">
                                $("#<?php echo $r1['adm_no'];?>").bind('input propertychange', function() {
                                  var adm="<?php echo $r1['adm_no'];?>";
                                  
                                $.ajax({
                                method: "POST",
                                url: "attendance_saver.php",
                                data: { attendance: $(this).val(),
                                      admno: adm
                                }
                                });
                              });


                            </script><?php
                              
                              
                            }
                          
                        
                        }  
                      ?>






                    </table>

                </div>
                <div class="dashboard" id="view-attendance-section" >
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
                
                <div class="dashboard" id="notice-section" >
                    <h2 class="white-font text-center" >Upload Notice</h2><br><br>
                    <form style="width:70%;" method="POST" class="ml-auto mr-auto">
                      <div class="form-group" >
                        <input type=text class="form-control" name="admno"  placeholder=" Enter Admission Number">
                      </div><br>
                      <div class="form-group" >
                      
                        <textarea id="my-textarea" class="form-control" name="notif-content" rows="8" placeholder="Write message here...!"></textarea>
                      </div><br>
                      <div class="form-group" >
                        <input class=" btn btn-primary" type="submit" name="submit" value="Send Notice">
                      </div>
                    </form>

                </div>
                <div class="dashboard" id="notification-section" >
                    <h2 class="white-font text-center" >Notificaions</h2><br><br>
                <div class="text-muted" style="margin:25px;">
                <?php echo $notice;?>
                </div>
                </div>
                
              <div class="dashboard" id="view-profile-section" >
                <h2 class="white-font text-center" >Profile</h2><br>
                <div class="col-sm-12 white-font ">
                    <div class="row" >
                      <h4 > NAME : <?php echo $name?> </h4>
                      <h4 > Faculty Id : <?php echo $f_id?> </h4><br><br>
                    </div>
                    <div class="row ">
                      <h4 > Date Of Birth : <?php echo $dob?> </h4>
                      <h4  > Mobile No : <?php echo $mobile?> </h4><br><br>
                    </div>
                    <div class="row ">
                      <h4  >Mail : <?php echo $mail?> </h4>
                      <h4 > Department : <?php echo $dep?> </h4><br><br>
                    </div>
                    <div class="row ">
                      <h4  >Subject 1 : <?php echo $sub1?> </h4>
                      <h4 > Subject 1 Semester : <?php echo $sub1_sem?> </h4><br><br>
                    </div>
                    <div class="row ">
                      <h4  > Subject 2 : <?php echo $sub2?> </h4>
                      <h4 > Subject 2 Semester : <?php echo $sub2_sem?> </h4><br><br>
                    </div>
                    <div class="row ">
                      <h4  > Subject 3 : <?php echo $sub3?> </h4>
                      <h4 > Subject 3 Semester : <?php echo $sub3_sem?> </h4><br><br>
                    </div>
                    
  
                  </div>
            </div>
            <div class="dashboard" id="edit-profile-section" >
              <h2 class="white-font text-center" >Edit Profile</h2><br>
              <form method="POST" >
                    <div class="col-sm-6 form-group ml-auto mr-auto">
                      <label for="new_name_fac" class="white-font">Name :</label>
                      <input type="text" name= "new_name_fac" class="form-control" value=<?php echo $name; ?> >
                    </div>

                    <div class="col-sm-6 form-group ml-auto mr-auto">
                      <label for="new_dob_fac" class="white-font">Date Of Birth :</label>
                      <input type="date" name= "new_dob_fac" class="form-control" value=<?php echo $dob; ?> >
                    </div>

                    <div class="col-sm-6 form-group ml-auto mr-auto">
                      <label for="new_mobile_fac" class="white-font">Mobile</label>
                      <input type="text" name= "new_mobile_fac" class="form-control"  value=<?php echo $mobile; ?> >
                    </div>
                    <div class="col-sm-6 form-group ml-auto mr-auto">
                      <label for="new_mail_fac" class="white-font">Email</label>
                      <input type="text" name= "new_mail_fac" class="form-control"  value=<?php echo $mail; ?> >
                    </div>

                    <div class="col-sm-6 form-group ml-auto mr-auto">
                      <input type="submit" value="Save" class="btn btn-primary ">
                    </div>

                  </form>
            </div>
            <div class="dashboard" id="change-password-section" >
              <h2 class="white-font text-center" >Change Password</h2><br>
                

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
          <div class="dashboard" id="logout-section" >
            
        </div>


                
            </div>
        </div>





        <!--including js files -->
        
      
      <!--js code-->
        <script>

          function menuHide(){
            $("#mark-attendance-section").css("display","none");
            $("#view-attendance-section").css("display","none");
          
            $("#notice-section").css("display","none");
            $("#notification-section").css("display","none");
            
            $("#view-profile-section").css("display","none");
            $("#edit-profile-section").css("display","none");
            $("#change-password-section").css("display","none");
          }


          
          $("#mark-attendance").click(function(){
             menuHide();
            $("#mark-attendance-section").css("display","block");
          });
          $("#view-attendance").click(function(){
             menuHide();
            $("#view-attendance-section").css("display","block");
          });
          
          $("#upload-notice").click(function(){
             menuHide();
            $("#notice-section").css("display","block");
          });
          $("#notification-faculty").click(function(){
             menuHide();
            $("#notification-section").css("display","block");
          });
          
          $("#view-profile-faculty").click(function(){
             menuHide();
            $("#view-profile-section").css("display","block");
          });
          $("#edit-profile-faculty").click(function(){
             menuHide();
            $("#edit-profile-section").css("display","block");
          });
          $("#change-password-faculty").click(function(){
             menuHide();
            $("#change-password-section").css("display","block");
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