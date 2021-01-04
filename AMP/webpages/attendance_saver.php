<?php

    session_start();

    if (array_key_exists("attendance", $_POST)) {
        
        include("connection.php");
        $query="SELECT attendance FROM student_registration WHERE adm_no='$_POST[admno]'";
        $row=mysqli_fetch_array(mysqli_query($link , $query));
        $att=$row['attendance'];
        $att.=$_POST['attendance'];
        
        
        $query="UPDATE student_registration SET attendance='$att' WHERE adm_no='$_POST[admno]'";
        mysqli_query($link , $query);
        $_POST=array();
    }
    

?>