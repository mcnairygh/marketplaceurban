<?php

  $mybemail = 'mcnairye@yahoo.com';
  $myfname = 'Eric';
  $mylname = 'McNairy';
  $mybname = 'Test Business';
  
            echo "Send Message" ;
            
            sendackl($myfname,$mylname,$mybname,$mybemail);
            
            echo "Message Sent";
            
            function sendackl($fname,$lname,$bname,$bemail) {
            echo "sending Message".' '.$bemail;
            
            $to = $bemail;
            $subject = "Market Place Urban - Business Listing Acknowledgement";
            
            $message = "
            <html>
            <head>
            <title>Market Place Urban</title>
            </head>
            <body>$fname".' '." $lname
            
            <p>Thanks you for submitting your business($bname) listing to Market Place Urban.We generally approve business listings within the next business day. We look forward to reviewing your business and posting 
            your business to the Market Place Urban Directory. Please email us your business logo image (jpg, jpeg, png). Maxium image size is 300px x 300px. </p>
            
            <p>Our is to add value by generating exposure and new customer acquistions for your business. We are finalizing offerings to provide opportunities to showcase your business</p> 
            <br>
            <p>Your Support Is Greatly Appreciated!</p>
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
            $headers .= 'From: <info@bdreventsandtours.com>' . "\r\n";
            $headers .= 'Bcc: e_mc43@yahoo.com' . "\r\n";
            
            mail($to,$subject,$message,$headers);
                    
            }
?>      