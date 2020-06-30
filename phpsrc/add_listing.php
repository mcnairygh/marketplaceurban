<?php

 include("../include/config.php");
   session_start();
      
      // username and password sent from form 
        
        $mybname = mysqli_real_escape_string($db,$_POST['bname']);
        $mybtype = mysqli_real_escape_string($db,$_POST['btype']);
       	$mybcategory = mysqli_real_escape_string($db,$_POST['bcategory']);
        $mybdesc = mysqli_real_escape_string($db,$_POST['bdescription']);
        $mybwebsite = mysqli_real_escape_string($db,$_POST['bwebsite']);
        $mybfname = mysqli_real_escape_string($db,$_POST['bfname']);
        $myblname = mysqli_real_escape_string($db,$_POST['blname']);
        $mybemail = mysqli_real_escape_string($db,$_POST['bemail']);
        $mybcontact = mysqli_real_escape_string($db,$_POST['bcontact']);
        $mybaddr1 = mysqli_real_escape_string($db,$_POST['baddr1']);
        $mybaddr2 = mysqli_real_escape_string($db,$_POST['baddr2']);
        $mybcity = mysqli_real_escape_string($db,$_POST['bcity']);
        $mybstate = mysqli_real_escape_string($db,$_POST['bstate']);
        $mybzipcd = mysqli_real_escape_string($db,$_POST['bzipcd']);
        $myblogo = 'comingsoon.jpeg';

       
      
     $sql = "INSERT INTO tbllistings (bname, btype, bcategory, bdescription, bwebsite, bfname, blname, bemail, bcontact, baddr1, baddr2, bcity, bstate, bzipcode, blogo) 
     VALUES ('$mybname', '$mybtype', '$mybcategory', '$mybdesc', '$mybwebsite', '$mybfname','$myblname','$mybemail','$mybcontact','$mybaddr1','$mybaddr2','$mybcity','$mybstate','$mybzipcd','$myblogo' )";
      
      
      if ($db->query($sql) === TRUE) {
          
             sendackl($mybfname,$myblname,$mybname,$$mybemail);
          
             echo "Your business listing was successfully created!";
       } else {

             echo "Error Duplicate Business Name: " . mysqli_error($db);
        }
        
        mysqli_close($db);
  
            function sendackl($fname,$lname,$bname,$bemail) {
     
            $to = "$bemail";
            $subject = "Market Place Urban - Business Listing Acknowledgement";
            
            $message = "
            <html>
            <head>
            <title>Market Place Urban</title>
            </head>
            <body>Hello $fname' '$lname
            
            <p>Thanks you for submitting your business (<b>$bname</b>) listing to Market Place Urban.We generally approve business listings within the next business day. We look forward to reviewing your business and posting 
            your business to the Market Place Urban Directory. Please email us your business logo image (jpg, jpeg, png). Maxium image size is (300px x 300px). </p>
            
            <p>Our is to add value by generating exposure and new customer acquistions for your business. We are finalizing offerings to provide opportunities to showcase your business</p> 
            <br>
            <p>Your Support IS Greatly Appreciated!</p>
            <p>
            CEO Eric D. McNairy, MBA <br>
            info@bdreventsandtours.com
            </p>
            </body>
            </html>
            ";
            
            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            
            // More headers
            $headers .= 'From: Market Place Urban<info@bdreventsandtours.com>' . "\r\n";
            $headers .= 'Bcc: mcnairye@yahoo.com' . "\r\n";
            
            mail($to,$subject,$message,$headers);
                    
            }
      
?>