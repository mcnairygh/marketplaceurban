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

 
$comments = is_forbidden($_POST["Message"]);
//$sixtynine = $_POST["nobotName"];

$thesubject = "Market Place Urban: Business Listing";

$replymessage = "$bname

Thank you for participating in the Market Place Urban Directory Lisiting. We generally approve listings within the next business day. 

To complete your business listing please email us a (jpg, jpeg, or png) image of your business logo. Size of logo should be no larger than 300 x 300 to ensure quality of the image when displayed. 

Our Goal is business exposure and revenue growth. As the opportunities grow we will offer reasonably priced business showcasing that will increase potential growth even more. 

Many Blessings To You and Your Business, 

Eric D. McNairy
info@marketplaceurban.com

";

    
 // substring is not found in string



mail("$email",
     "Receipt: $thesubject",
     "$replymessage",
     "From: $replyemail\nReply-To: $replyemail");
?>

