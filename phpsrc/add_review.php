<?php

 include("../include/config.php");
   session_start();
      
      // username and password sent from form 
        
        $mybid = mysqli_real_escape_string($db,$_POST['rid']);
        $mycustomer = mysqli_real_escape_string($db,$_POST['rcust']);
       	$myreview = mysqli_real_escape_string($db,$_POST['rcomments']);
       	$myrstars = mysqli_real_escape_string($db,$_POST['rrating']);
        $myrdate = date("y-m-d");
        

      
     $sql = "INSERT INTO tblreviews (rbid, rbreview, rbcustomer, rbstars, rbdate) 
     VALUES ('$mybid', '$myreview', '$mycustomer', '$myrstars', '$myrdate' )";
      
      
      if ($db->query($sql) === TRUE) {
          
             echo "pass";
       } else {

             echo "fail "  ;
        }
        
        mysqli_close($db);
  
      
?>