<?php
session_start();
$webpage = $_SESSION['currentpage'];


/* PHP Form Mailer - phpFormMailer v2.2, last updated 23rd Jan 2008 - check back often for updates!
   (easy to use and more secure than many cgi form mailers) FREE from:
                  www.TheDemoSite.co.uk
      Should work fine on most Unix/Linux platforms
      for a Windows version see: asp.thedemosite.co.uk
*/
 $mydomain =  strpos($webpage,"https://www.marketplaceurban.com/");
https://www.marketplaceurban.com
// ------- three variables you MUST change below  -------------------------------------------------------
$replyemail="Eric McNairy<info@marketplaceurban.com>";//change to your email address

$valid_ref1="https://www.marketplaceurban.com/draft.php";// chamge "Your--domain" to your domain
$valid_ref2="http://www.marketplaceurban.com/";// chamge "Your--domain" to your domain
$valid_ref3="https://www.marketplaceurban.com/draft.php";// 
$valid_ref4="https://www.marketplaceurban.com/beach_vacation.php";//
$valid_ref5="https://www.marketplaceurban.com/index.html";//
$valid_ref6="https://www.marketplaceurban.com/blogposts.php";//
$valid_ref7="https://www.marketplaceurban.com/ski_vacation.php";//
$valid_ref8="http://marketplaceurban.com/";//

$webmaster="mcnairye@yahoo.com";//webmaster
// -------- No changes required below here -------------------------------------------------------------
 
 
$sender_email=$_POST['email'];
// email variable not set - load $valid_ref1 page
if (!isset($_POST['email']))
{
 echo "<script language=\"JavaScript\"><!--\n alert(\"ERROR - not sent.\\n\\nCheck your email address. \");\n";

 echo "top.location.href = $valid_ref1; \n// --></script>";
  echo $webpage;
exit;
}

$ref_page=$_SERVER["HTTP_REFERER"];
//echo $ref_page;
$valid_referrer=0;

if($ref_page==$valid_ref1) $valid_referrer=1;
elseif($ref_page==$valid_ref2) $valid_referrer=1;
elseif($ref_page==$valid_ref3) $valid_referrer=1;
elseif($ref_page==$valid_ref4) $valid_referrer=1;
elseif($ref_page==$valid_ref5) $valid_referrer=1;
elseif($ref_page==$valid_ref6) $valid_referrer=1;
elseif($ref_page==$valid_ref7) $valid_referrer=1;
elseif($ref_page==$valid_ref8) $valid_referrer=1;
 
elseif($webpage == 'quoterequest')$valid_referrer=1;
elseif($webpage == 'bdrhome')$valid_referrer=1;
 elseif($webpage == 'mainpage')$valid_referrer=1;
 elseif($webpage == 'reservation')$valid_referrer=1;
 elseif($mydomain > 0 )$valid_referrer=1;
 
if(!$valid_referrer)
{
  echo $ref_page.' '."<script language=\"JavaScript\"><!--\n alert(\"ERROR - not sent.\\n\\nCheck your 'valid_ref1' and 'valid_ref2' are correct within specials2.php.\");\n";
 echo "top.location.href = \"$ref_page\"; \n// --></script>";
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
  //for ($i=0; $i<count($patterns); $i++)
  // {
   // $forbidden = eregi($patterns[$i], strtolower($str));
   if ($forbidden) break;
  // }*/
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

$name = is_forbidden($_POST["name"]);
$email = is_forbidden($_POST["email"]);
 
$comments = is_forbidden($_POST["comments"]);
$sixtynine = $_POST["nobotName"];

$thesubject = "Market Place Urban : Subscriber";
$themessage = "Vacation Questions: '\n Comments: '.$comments";

$success_sent_msg='<p align="center"><strong>&nbsp;</strong></p>
                   <p align="center"><strong>Your enter in to the Market Place Urban  vacation drawing was successful.<br>
                   </strong>. If you are the Market Place Urban Drawing WINNER you will be contacted via this email address.</p>
                   <p align="center">A copy of your message has been sent to you.</p>
                   <p align="center">Thank you for subscribing to Market Place Urban Distribution List</p>
        		   <p align="center">Click Here To Go Back To Webpage:<a href='.$ref_page.'>BDR Events &amp;Tours Webpage</a>';

$sixtynine_err_msg='<p align="center"><strong>&nbsp;</strong></p>
                   <p align="center"><strong>Your message was not successfully sent to us<br>
                   </strong> and we do not welcome messages from BOTS.</p>
                   
    			   <p align="center">Click Here To Go Back To Webpage: <a href="<? echo $ref_page ?>" >BDR Events &amp;Tours Webpage</a>';

$replymessage = "Hi,

Your enter in to the Market Place Urban vacation drawing was successful.

If you are the Cruise Vacation Drawing WINNER you will be contacted via this email address.

Please DO NOT reply to this email.

Thank you";
 
    
 // substring is not found in string

$sixtynine = 69;
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


 

// Create connection
 include("../include/busiconnection.php");

$sql = "INSERT INTO newsletter (customer, emailaddr)
VALUES ('Subscriber' , '$email')";

if ($dbCon->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $dbCon->error;
}

$dbCon->close();
 

} else {
echo $sixtynine_err_msg;    

}
?>