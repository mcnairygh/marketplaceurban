<?php
session_start();
$webpage = $_SESSION['currentpage'];


/* PHP Form Mailer - phpFormMailer v2.2, last updated 23rd Jan 2008 - check back often for updates!
   (easy to use and more secure than many cgi form mailers) FREE from:
                  www.TheDemoSite.co.uk
      Should work fine on most Unix/Linux platforms
      for a Windows version see: asp.thedemosite.co.uk
*/
 $mydomain =  strpos($webpage,"http://www.marketplaceurban.com/");
 
// ------- three variables you MUST change below  -------------------------------------------------------
$replyemail="Eric McNairy<info@marketplaceurban.com>";//change to your email address

$valid_ref1="http://www.marketplaceurban.com/"; // chamge "Your--domain" to your domain
$valid_ref2="http://marketplaceurban.com/index.html"; // chamge "Your--domain" to your domain
$valid_ref3="http://www.marketplaceurban.com/#contact";
$valid_ref4="https://www.marketplaceurban.com/"; // chamge "Your--domain" to your domain
$valid_ref5="https://marketplaceurban.com/index.html"; // chamge "Your--domain" to your domain
$valid_ref6="https://www.marketplaceurban.com/#contact";

$webmaster="mcnairye@yahoo.com";//webmaster
// -------- No changes required below here -------------------------------------------------------------
 
 
$sender_email=$_POST['Email'];
// email variable not set - load $valid_ref1 page
if (!isset($_POST['Email']))
{
 echo "<script language=\"JavaScript\"><!--\n alert(\"ERROR - not sent.\\n\\nCheck your email address. \");\n";
 echo $sender_email;
 echo "top.location.href ='http://www.marketplaceurban.com'; \n// --></script>";
  echo $webpage;
exit;
}

$ref_page= $_SERVER["HTTP_REFERER"];
//echo $ref_page;
$valid_referrer=0;

if($ref_page==$valid_ref1) $valid_referrer=1;
elseif($ref_page==$valid_ref2) $valid_referrer=1;
elseif($ref_page==$valid_ref3) $valid_referrer=1;
elseif($ref_page==$valid_ref4) $valid_referrer=1;
elseif($ref_page==$valid_ref5) $valid_referrer=1;
elseif($ref_page==$valid_ref6) $valid_referrer=1;
 
if(!$valid_referrer)
{
  echo $ref_page.' '."<script language=\"JavaScript\"><!--\n alert(\"ERROR - not sent.\\n\\nCheck your 'valid_ref1' and 'valid_ref2' are correct within marketplaceurban.com\");\n";
 echo "top.location.href = \"www.marketplaceurban.com\" \n// --></script>"; 
 exit;
}

//check user input for possible header injection attempts!
function is_forbidden($str,$check_all_patterns = true)
{
 $patterns[0] = 'content-type:';
 $patterns[1] = 'mime-version';
 $patterns[2] = 'multipart/mixed';
 $patterns[3] = 'Content-Transfer-Encoding';
 $patterns[4] = 'to:';
 $patterns[5] = 'cc:';
 $patterns[6] = 'bcc:';
 $forbidden = 0;
 
   
  
 //check for line breaks if checking all patterns
 if ($check_all_patterns AND !$forbidden) $forbidden = preg_match("/(%0a|%0d|\\n+|\\r+)/i", $str);
 if ($forbidden)
 {
  echo "<font color=red><center><h3>STOP! Message not sent.</font></h3><br><b>
        The text you entered is forbidden, it includes one or more of the following:
        <br><textarea rows=9 cols=25>";
  foreach ($patterns as $key => $value) echo $value."\n";
  echo "\\n\n\\r</textarea><br>Click back on your browser, remove the above characters and try again.";
        
  exit();
 }
 else return $str;
}

$name =is_forbidden($_POST["Name"]);
$email = is_forbidden($_POST["Email"]);
 
$comments = is_forbidden($_POST["Message"]);
//$sixtynine = $_POST["nobotName"];

$thesubject = "BDR Events & Tours: Travel Special Quote Request";
$themessage = "Product Questions: '\n Comments: '.$comments";

$success_sent_msg='<p align="center"><strong>&nbsp;</strong></p>
                   <p align="center"><strong>Your message has been successfully sent to us<br>
                   </strong> and we will reply as soon as possible.</p>
                   <p align="center">A copy of your message has been sent to you.</p>
                   <p align="center">Thank you for entering Market Place Urban Free Cruise Vacation Drawing. Winners will be notifed via email.</p>
				   <p align="center">Click Here To Go Back To Webpage:<a href='.$ref_page.'>Market Place Urban Webpage</a>';

$sixtynine_err_msg='<p align="center"><strong>&nbsp;</strong></p>
                   <p align="center"><strong>Your message was not successfully sent to us<br>
                   </strong> and we do not welcome messages from BOTS.</p>
                   
    			   <p align="center">Click Here To Go Back To Webpage: <a href="<? echo $ref_page ?>" >Market Place Urban Webpage</a>';

$replymessage = "Hi $name

Thank you for contacting Market Place Urban

We will respond to your inquiry shortly.

Please DO NOT reply to this email.

Below is a copy of the message you submitted:
--------------------------------------------------
Subject: $thesubject
Message:
$themessage
--------------------------------------------------

Thank you";

    
 // substring is not found in string
$sixtynine=69;

$themessage = "name: $name \nMessage: $themessage";
if($sixtynine ==69){
mail("$replyemail",
     "$thesubject",
     "$themessage",
     "From: $email\nReply-To: $email");
mail("$webmaster",
     "$thesubject",
     "$themessage",
     "From: $email\nReply-To: $email");
mail("$email",
     "Receipt: $thesubject",
     "$replymessage",
     "From: $replyemail\nReply-To: $replyemail");
echo $success_sent_msg;
} else {
echo $sixtynine_err_msg;    

}
?>

