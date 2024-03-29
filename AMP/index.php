<!DOCTYPE html>
<html lang="en">

    <head>

        <title>Attendance Management Portal</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        
      <!--bootstarp files-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="files/styles.css">
        
    </head>

    <body >
        <!--top header-->
      <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="col-sm-2">
        <img src="images/logo/amp logo1.png" alt="amp logo" width="140px">
        </div>
        <div class="col-sm-8 header">
            <h1 >Attendance &nbsp;  Management &nbsp; Portal</h1>
        </div>
        <div class="col-sm-2 ">
            <img src="images/logo/abes logo.png" alt="abes logo" width="60px" class="abes-logo">
        </div>
    </nav>

      <!--home page menu-->
      <div class="container-fluid col-sm-6 right  home-page-menu">
        <div class="circle left">
          <div class="hm-link" >
          
            <a href="webpages/login-student.php">login</a><br><hr class="rule">
            <a href="webpages/register-student.php">Register</a>
          </div>
          <div  id="student">
            <img src="images/student.png" width="257px">
          </div>
        </div>


        <div class="circle left">
          <div class="hm-link">
            <a href="webpages/login-faculty.php">login</a><br><hr class="rule">
            <a href="webpages/register-faculty.php">Register</a>
          </div>
          <div  id="faculty">
            <img src="images/faculty.png" width="257px">
          </div>
        </div>
        <br>

        <div class="circle left"  >
          <div class="hm-link" id="hml-single">
            <a href="webpages/login-hod.php">login</a><br>
          </div>
          <div  id="hod">
            <img src="images/hod.png" width="210px">
          </div>


        </div>
        <div class="circle left" >
          <div class="hm-link" id="hml-single">
            <a href="webpages/team.php">View<br>our team</a><br>
            
          </div>
          <div  id="team">
            <img src="images/team.png" width="257px">
          </div>
        </div>
      </div>
    
      <!--javascript files-->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
      
      <!--javascript code-->
        <script>
        $( "#hod" ).hover(
          function() {
            
            $("#hod").animate({left:"-200px"},1000)

          }, function() {
            $("#hod").animate({left:"-10px"},4000)
          }
        );
        $( "#student" ).hover(
          function() {
            
            $("#student").animate({left:"-240px"},1000)

          }, function() {
            $("#student").animate({left:"-38px"},4000)
          }
        );
        $( "#faculty" ).hover(
          function() {
            
            $("#faculty").animate({left:"150px"},1000)

          }, function() {
            $("#faculty").animate({left:"-38px"},4000)
          }
        );
        $( "#team" ).hover(
          function() {
            
            $("#team").animate({left:"150px"},1000)

          }, function() {
            $("#team").animate({left:"-38px"},4000)
          }
        );
          
        </script>
        
    </body>

</html>