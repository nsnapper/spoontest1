<?php 
$your_email ='service@spoontiques.com';// <<=== update to your email address

session_start();
$errors = '';
$name = '';
$visitor_email = '';
$user_message = '';

$post_data = array();

$recip = "svc"; // XXX: change to wds for testing so service@ (svc) doesn't get all the email

// WDS: Check for the present of the hidden variable "obs", standing for
//      Old Browsers SUCK!  IE and Firefox have some inconsistencies...
if(isset($_POST['obs']))
{
//  error_log("****** POST: Checking for post errors...");
  
  // Setup form vars in case we need to correct...
    addParam("req_store_name");
    addParam('req_first_name');
    addParam('req_last_name');
    addParam('req_address_1');
    addParam('address_2');
    addParam('req_city');
    addParam('req_state');
    addParam('req_zip');
    addParam('req_phone_no');
    addParam('fax_no');
    addParam('req_email_addr');
    addParam('req_Where_Hear');
    addParam('req_What_Products');
    addParam('req_Type_Business');
    addParam('req_Num_Years');
    addParam('business_url');
    addParam('additional_comments');


  if(empty($_SESSION['6_letters_code'] ) ||
    strcasecmp($_SESSION['6_letters_code'], $_POST['6_letters_code']) != 0)
  {
  //Note: the captcha code is compared case insensitively.
  //if you want case sensitive match, update the check above to
  // strcmp()
    $errors .= "The image code does not match.  Try again.";
//    error_log("ERROR matching up captcha!!!");
  }
  else
  {
//    error_log("NO ERROR matching captcha!!!");
  }

  if (empty($errors))
  {
  // Fill in a form and submit it
    $ua = $_SERVER['HTTP_USER_AGENT'];
    $curl_connection = curl_init("http://spoontiques.com/cgi-bin/formmail.pl");
    curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($curl_connection, CURLOPT_POST, 1);
    curl_setopt($curl_connection, CURLOPT_HEADER, 0);
    curl_setopt($curl_connection, CURLOPT_FRESH_CONNECT, 1);
    curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl_connection, CURLOPT_FORBID_REUSE, 1);
    curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, 1);

//error_log("PostData contains: " . count($post_data) . " elements.");
    $post_string = "";
    foreach ( $post_data as $key => $value) 
    {
      $post_string .= $key . '=' . $value . "&";
    }
    $post_string .= "recipient=" . $recip;
    $post_string .= "&subject=Spoontiques Buyer Registration";
    $post_string .= "&email=user email address";
    $post_string .= "&realname=Spoontiques.com Contact Form";

/*    $post_string = implode ('&', $post_items);*/
//error_log("PostString: " . $post_string);
    curl_setopt($curl_connection, CURLOPT_POSTFIELDS, $post_string);
/*    curl_setopt($curl_connection, CURLOPT_HTTPHEADER, array("Location", "http://www.spoontiques.com"));*/
    $result = curl_exec($curl_connection);
    curl_close($curl_connection);

    header("Location: http://www.spoontiques.com");
    die();
  }
}

function addParam($paramName)
{
  global $post_data;
  if (!empty($_POST[$paramName])) {
//    error_log("Logging " . $paramName . "=" . $_POST[$paramName]);
    $post_data[$paramName] = $_POST[$paramName];
  }
}

function param($paramName)
{
  global $post_data;
  if (empty($post_data[$paramName]) === true) {
//    error_log("*** " . $paramName . " is empty ***");
    return "";
  } else {
//    error_log("*** " . $paramName . " is NOT empty ***");
    return $post_data[$paramName];
  }
}
// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Contact Spoontiques :: Wholesale Giftware, Drinkware, Outdoor Garden Décor, Licensed Items</title>
<meta name="description" content="Learn how to contact Spoontiques">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" src="scripts/gen_validatorv31.js" type="text/javascript"></script>  

<script language="JavaScript" type="text/JavaScript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<SCRIPT language=JavaScript>
<!--
function verifyAndProcess(f, doAll) {
//alert("Verifying form...");
//return false;
    result = verify(f, doAll);
//alert("Verify done...");
    if (result == true) {
//alert("Passed!!!");
        emailValue = f.req_email_addr.value;
        f.email.value = emailValue;
        realName = f.req_first_name.value + " " + 
                   f.req_last_name.value;
//alert(email + " " + realName);
//        document.buyer_info.realname.value = realName;
        f.realname.value = realName;
    } else {
//        alert("whoops...");
    }
    return result;
}
function resetting(){

document.getElementById("req_store_name").value = "";
document.getElementById("req_first_name").value = "";
document.getElementById("req_last_name").value = "";
document.getElementById("req_address_1").value = "";
document.getElementById("address_2").value = "";
document.getElementById("req_city").value = "";
document.getElementById("req_state").value = "";
document.getElementById("req_zip").value = "";
document.getElementById("req_phone_no").value = "";
document.getElementById("fax_no").value = "";
document.getElementById("req_email_addr").value = "";
document.getElementById("req_Where_Hear").value = "";
document.getElementById("req_What_Products").value = "";
document.getElementById("req_Type_Business").value = "";
document.getElementById("req_Num_Years").value = "";
document.getElementById("business_url").value = "";
document.getElementById("additional_comments").value = "";



}

-->
function refreshCaptcha()
{
  var img = document.images['captchaimg'];
  img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}

</SCRIPT>

<link href="../../styles/style1.css" rel="stylesheet" type="text/css">
</head>
<!--
<?php
var_dump($_POST);
?>
-->

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('../images/but-submit-o.jpg','../images/but-reset-o.jpg','../../images/common/button-retailer-mouse-over.jpg','../../images/common/button-home-mouse-over.jpg','../../images/common/button-about-us-mouse-over.jpg','../../images/common/button-faq-mouse-over.jpg','../../images/common/button-contact-mouse-over.jpg')">
<table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%">
  <tr>
    <td align="center" valign="middle"><table width="778" border="0" align="center" cellpadding="0" cellspacing="0" class="tableborder">
        <tr class="tableborder-blue">
          <td height="100" valign="top"><img src="../../images/common/Spoontiques-logo-tagline.jpg" alt="Spoontiques,inc." width=614 height=100 border="0"></a><a href="http://spoontiques.cameoez.com/Scripts/PublicSite/?template=Login" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('RetailerLogin','','../../images/common/button-retailer-mouse-over.jpg',1)"><img src="../../images/common/button-retailer.jpg" alt="Retailer Login" name="RetailerLogin" width="164" height="100" border="0"></a></td>
        </tr>
        <tr> 
          <td valign="top"><table width="778" border="0" cellpadding="0" cellspacing="0" background="../../images/common/top-piece-blue-2.jpg">
            <tr valign="top">
              <td width="40" height="99">&nbsp;</td>
              <td width="114"><a href="../../index.htm" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('home','','../../images/common/button-home-mouse-over.jpg',1)"><img src="../../images/common/button-home.jpg" alt="Home" name="home" width="136" height="99" border="0"></a></td>
              <td width="112"><a href="../main/about_us.htm" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('about_us','','../../images/common/button-about-us-mouse-over.jpg',1)"><img src="../../images/common/button-about-us.jpg" alt="About Us" name="about_us" width="136" height="99" border="0"></a></td>
              <td width="110"><a href="../main/faq.htm" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('faq','','../../images/common/button-faq-mouse-over.jpg',1)"><img src="../../images/common/button-faq.jpg" alt="FAQ" name="faq" width="136" height="99" border="0"></a></td>
              <td width="109"><a href="../main/contactus.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('contact_us','','../../images/common/button-contact-mouse-over.jpg',1)"><img src="../../images/common/button-contact.jpg" alt="Contact Us" name="contact_us" width="136" height="99" border="0"></a></td>
            </tr>
          </table></td>
        </tr>
        <tr> 
          <td height="319" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr valign="top">
                <td width="190" background="../../images/common/top-piece-blue.jpg"><table width="190" border="0" cellpadding="0" cellspacing="0" background="../../images/common/product-name-blue-bar.jpg">
                  <tr>
                    <td height="12"><img src="../../images/common/top-piece-blue.jpg" width="225" height="12"></td>
                    <td bgcolor="#7998D8"><img src="../../images/common/spacer.gif" width="8" height="8"></td>
                  </tr>
                  <tr>
                    <td height="20">&nbsp;&nbsp;<img src="../../images/common/blue-arrow.jpg" name="bullet1" width="16" height="16" align="absmiddle" id="six">&nbsp;&nbsp;<a href="../newitems/spoon_new1.htm" class="leftmenu" onMouseOver="six.src='../../images/common/bullet-o.gif'" onMouseOut="six.src='../../images/common/blue-arrow.jpg'">New Items </a></td>
                    <td width="8" bgcolor="#7998D8">&nbsp;</td>
                  </tr>
                  <tr >
                    <td bgcolor="#9E927B"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
                    <td bgcolor="#7998D8"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td height="20">&nbsp;&nbsp;<img src="../../images/common/blue-arrow.jpg" name="bullet3" width="16" height="16" align="absmiddle" id="six">&nbsp;&nbsp;<a href="../aprons/aprons1.htm" class="leftmenu" onMouseOver="six.src='../../images/common/bullet-o.gif'" onMouseOut="six.src='../../images/common/blue-arrow.jpg'">Aprons</a></td>
                    <td bgcolor="#7998D8">&nbsp;</td>
                  </tr>
                  <tr >
                    <td bgcolor="#9E927B"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
                    <td bgcolor="#7998D8"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td height="20">&nbsp;&nbsp;<img src="../../images/common/blue-arrow.jpg" name="six" width="16" height="16" align="absmiddle" id="six">&nbsp;&nbsp;<a href="../birdfeeders/birdfeeders1.htm" class="leftmenu" onMouseOver="six.src='../../images/common/bullet-o.gif'" onMouseOut="six.src='../../images/common/blue-arrow.jpg'">Birdhouses</a> </td>
                    <td bgcolor="#7998D8">&nbsp;</td>
                  </tr>
                  <tr >
                    <td bgcolor="#9E927B"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
                    <td bgcolor="#7998D8"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td height="20">&nbsp;&nbsp;<img src="../../images/common/blue-arrow.jpg" name="six" width="16" height="16" align="absmiddle" id="six">&nbsp;&nbsp;<a href="../bracelets/bracelets1.htm" class="leftmenu" onMouseOver="six.src='../../images/common/bullet-o.gif'" onMouseOut="six.src='../../images/common/blue-arrow.jpg'">Bracelets</a></td>
                    <td bgcolor="#7998D8">&nbsp;</td>
                  </tr>
                  <tr >
                    <td bgcolor="#9E927B"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
                    <td bgcolor="#7998D8"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td height="20">&nbsp;&nbsp;<img src="../../images/common/blue-arrow.jpg" name="six" width="16" height="16" align="absmiddle" id="six">&nbsp;&nbsp;<a href="../cups/cups1.htm" class="leftmenu" onMouseOver="six.src='../../images/common/bullet-o.gif'" onMouseOut="six.src='../../images/common/blue-arrow.jpg'">Cups</a></td>
                    <td bgcolor="#7998D8">&nbsp;</td>
                  </tr>
                  <tr >
                    <td bgcolor="#9E927B"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
                    <td bgcolor="#7998D8"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td height="20">&nbsp;&nbsp;<img src="../../images/common/blue-arrow.jpg" name="bullet6" width="16" height="16" align="absmiddle" id="six">&nbsp;&nbsp;<a href="../signs/signs1.htm" class="leftmenu" onMouseOver="six.src='../../images/common/bullet-o.gif'" onMouseOut="six.src='../../images/common/blue-arrow.jpg'">Decorative Signs</a></td>
                    <td bgcolor="#7998D8">&nbsp;</td>
                  </tr>
                  <tr >
                    <td bgcolor="#9E927B"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
                    <td bgcolor="#7998D8"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td height="20">&nbsp;&nbsp;<img src="../../images/common/blue-arrow.jpg" name="bullet6" width="16" height="16" align="absmiddle" id="six">&nbsp;&nbsp;<a href="../eyeglasscases/eyeglasscases1.htm" class="leftmenu" onMouseOver="six.src='../../images/common/bullet-o.gif'" onMouseOut="six.src='../../images/common/blue-arrow.jpg'">Eyeglass Cases </a></td>
                    <td bgcolor="#7998D8">&nbsp;</td>
                  </tr>
                  <tr >
                    <td bgcolor="#9E927B"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
                    <td bgcolor="#7998D8"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td height="20">&nbsp;&nbsp;<img src="../../images/common/blue-arrow.jpg" alt="" name="six" width="16" height="16" align="absmiddle" id="six3">&nbsp;&nbsp;<a href="../flasks/flasks1.htm" class="leftmenu" onMouseOver="six.src='../../images/common/bullet-o.gif'" onMouseOut="six.src='../../images/common/blue-arrow.jpg'">Flasks</a></td>
                    <td bgcolor="#7998D8">&nbsp;</td>
                  </tr>
                  <tr >
                    <td bgcolor="#9E927B"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
                    <td bgcolor="#7998D8"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
                  </tr>
  <td height="20">&nbsp;&nbsp;<img src="../../images/common/blue-arrow.jpg" alt="" name="six" width="16" height="16" align="absmiddle" id="six13">&nbsp;&nbsp;<a href="../wallets/wallets1.htm" class="leftmenu" onMouseOver="six.src='../../images/common/bullet-o.gif'" onMouseOut="six.src='../../images/common/blue-arrow.jpg'">Flat Wallets</a></td>
      <td bgcolor="#7998D8">&nbsp;</td>
  </tr>
  <tr >
    <td bgcolor="#9E927B"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
    <td bgcolor="#7998D8"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
  </tr>
  <td height="20">&nbsp;&nbsp;<img src="../../images/common/blue-arrow.jpg" alt="" name="six" width="16" height="16" align="absmiddle" id="six3">&nbsp;&nbsp;<a href="../hairwraps/hairwraps1.htm" class="leftmenu" onMouseOver="six.src='../../images/common/bullet-o.gif'" onMouseOut="six.src='../../images/common/blue-arrow.jpg'">Hair Wraps</a></td>
      <td bgcolor="#7998D8">&nbsp;</td>
  </tr>
  <tr >
    <td bgcolor="#9E927B"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
    <td bgcolor="#7998D8"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
  </tr>
  <td height="20">&nbsp;&nbsp;<img src="../../images/common/blue-arrow.jpg" alt="" name="six" width="16" height="16" align="absmiddle" id="six5">&nbsp;&nbsp;<a href="../licensed/licensed1.htm" class="leftmenu" onMouseOver="six.src='../../images/common/bullet-o.gif'" onMouseOut="six.src='../../images/common/blue-arrow.jpg'">Licensed Items</a></td>
      <td bgcolor="#7998D8">&nbsp;</td>
  </tr>
  <tr >
    <td bgcolor="#9E927B"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
    <td bgcolor="#7998D8"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td height="20">&nbsp;&nbsp;<img src="../../images/common/blue-arrow.jpg" alt="" name="six" width="16" height="16" align="absmiddle" id="six6">&nbsp;&nbsp;<a href="../masonjars/masonjars1.htm" class="leftmenu" onMouseOver="six.src='../../images/common/bullet-o.gif'" onMouseOut="six.src='../../images/common/blue-arrow.jpg'">Mason Jars</a></td>
    <td bgcolor="#7998D8">&nbsp;</td>
  </tr>
  <tr >
    <td bgcolor="#9E927B"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
    <td bgcolor="#7998D8"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td height="20">&nbsp;&nbsp;<img src="../../images/common/blue-arrow.jpg" alt="" name="six" width="16" height="16" align="absmiddle" id="six7">&nbsp;&nbsp;<a href="../mugs/mugs1.htm" class="leftmenu" onMouseOver="six.src='../../images/common/bullet-o.gif'" onMouseOut="six.src='../../images/common/blue-arrow.jpg'">Mugs</a></td>
    <td bgcolor="#7998D8">&nbsp;</td>
  </tr>
  <tr >
    <td bgcolor="#9E927B"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
    <td bgcolor="#7998D8"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td height="20">&nbsp;&nbsp;<img src="../../images/common/blue-arrow.jpg" alt="" name="six" width="16" height="16" align="absmiddle" id="six7">&nbsp;&nbsp;<a href="../ornaments/ornaments1.htm" class="leftmenu" onMouseOver="six.src='../../images/common/bullet-o.gif'" onMouseOut="six.src='../../images/common/blue-arrow.jpg'">Ornaments and Keepsakes</a></td>
    <td bgcolor="#7998D8">&nbsp;</td>
  </tr>
  <tr >
    <td bgcolor="#9E927B"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
    <td bgcolor="#7998D8"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td height="20">&nbsp;&nbsp;<img src="../../images/common/blue-arrow.jpg" alt="" name="six" width="16" height="16" align="absmiddle" id="six9">&nbsp;&nbsp;<a href="../phonewristlets/phonewristlets1.htm" class="leftmenu" onMouseOver="six.src='../../images/common/bullet-o.gif'" onMouseOut="six.src='../../images/common/blue-arrow.jpg'">Phone Wristlets</a></td>
    <td bgcolor="#7998D8">&nbsp;</td>
  </tr>
  <tr >
    <td bgcolor="#9E927B"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
    <td bgcolor="#7998D8"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td height="20">&nbsp;&nbsp;<img src="../../images/common/blue-arrow.jpg" alt="" name="six" width="16" height="16" align="absmiddle" id="six10">&nbsp;&nbsp;<a href="../pillows/pillows1.htm" class="leftmenu"  onMouseOut="sixteen.src='../../images/common/blue-arrow.jpg'">Pillows</a></td>
    <td bgcolor="#7998D8">&nbsp;</td>
  </tr>
  <tr >
    <td bgcolor="#9E927B"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
    <td bgcolor="#7998D8"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td height="20">&nbsp;&nbsp;<img src="../../images/common/blue-arrow.jpg" alt="" name="six" width="16" height="16" align="absmiddle" id="six11">&nbsp;&nbsp;<a href="../pinart/pinart1.htm" class="leftmenu" onMouseOver="six.src='../../images/common/bullet-o.gif'" onMouseOut="six.src='../../images/common/blue-arrow.jpg'">Pin Art&trade;</a></td>
    <td bgcolor="#7998D8">&nbsp;</td>
  </tr>
  <tr >
    <td bgcolor="#9E927B"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
    <td bgcolor="#7998D8"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td height="20">&nbsp;&nbsp;<img src="../../images/common/blue-arrow.jpg" alt="" name="six" width="16" height="16" align="absmiddle" id="six12">&nbsp;&nbsp;<a href="../stainless/stainless1.htm" class="leftmenu" onMouseOver="six.src='../../images/common/bullet-o.gif'" onMouseOut="six.src='../../images/common/blue-arrow.jpg'">Stainless Drinkware</a></td>
    <td bgcolor="#7998D8">&nbsp;</td>
  </tr>
  <tr >
    <td bgcolor="#9E927B"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
    <td bgcolor="#7998D8"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td height="20">&nbsp;&nbsp;<img src="../../images/common/blue-arrow.jpg" alt="" name="six" width="16" height="16" align="absmiddle" id="six14">&nbsp;&nbsp;<a href="../steppingstones/stepping_stones1.htm" class="leftmenu" onMouseOver="six.src='../../images/common/bullet-o.gif'" onMouseOut="six.src='../../images/common/blue-arrow.jpg'">Stepping 
      Stones</a></td>
    <td bgcolor="#7998D8">&nbsp;</td>
  </tr>
  <tr >
    <td bgcolor="#9E927B"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
    <td bgcolor="#7998D8"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td height="20">&nbsp;&nbsp;<img src="../../images/common/blue-arrow.jpg" alt="" name="six" width="16" height="16" align="absmiddle" id="six16">&nbsp;&nbsp;<a href="../waterbottles/waterbottles1.htm" class="leftmenu" onMouseOut="thirteen.src='../../images/common/blue-arrow.jpg'">Water Bottles</a></td>
    <td bgcolor="#7998D8">&nbsp;</td>
  </tr>
  <tr >
    <td bgcolor="#9E927B"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
    <td bgcolor="#7998D8"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td height="20">&nbsp;&nbsp;<img src="../../images/common/blue-arrow.jpg" alt="" name="six" width="16" height="16" align="absmiddle" id="six17">&nbsp;&nbsp;<a href="../windchimes/wind_chimes1.htm" class="leftmenu"  onMouseOut="sixteen.src='../../images/common/blue-arrow.jpg'">Wind 
      Chimes</a></td>
    <td bgcolor="#7998D8">&nbsp;</td>
  </tr>
  <tr >
    <td bgcolor="#9E927B"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
    <td bgcolor="#7998D8"><img src="../../images/common/spacer.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td height="116">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../../images/common/and-much-more.jpg" alt="and many more..." width="110" height="55" border="0"></td>
    <td bgcolor="#7998D8">&nbsp;</td>
  </tr>
                </table></td> 
                <td align="center"><table width="90%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td width="100%" height="30">&nbsp;</td>
                    </tr>

                    <tr> 
                      <td class="heading2">Contact us</td>
                    </tr>
                    <tr> 
                      <td bgcolor="#999999"><img src="../images/common/spacer.gif" width="1" height="1"></td>
                    </tr>
                    <tr> 
                      <td height="13">&nbsp;</td>
                    </tr>

                    <tr> 
                      <td height="20" class="runningtextblack">Please note: We 
                        sell only to approved retailers with a valid resale certificate.</td>
                    </tr>

                    <tr> 
                      <td>&nbsp;</td>
                    </tr>
                    <tr> 
                      <td class="runningtextblack"><span class="productheading">Buyer 
                        Contact Information</span><br> <br>

                        (<font color="#FF0000">*</font> indicates a required field)</td>
                    </tr>
<?php
if(!empty($errors)){
//  error_log("ADDING ERROR MESSAGE!!!  Errors: " . $errors);
 ?>
<script>
  setTimeout(function() {sfm_set_focus(MM_findObj("6_letters_code"));}, 500);
</script>
 <tr>
  <td class="runningtextblack" style="color: red">
    <?= $errors ?>  </td>
 </tr>
<?php
} else {
//  error_log("*** NO ERRORS FOUND ***");
}
?>


                    <tr> 
                      <td align="center"><form  name="buyer_info"  method="post" action="contactus.php">
                          <table width="90%" border="0" cellspacing="0" cellpadding="3">
                            <tr> 
                              <td colspan="3" align="right"><img src="../images/common/spacer.gif" width="1" height="8"></td>
                            </tr>
                            <tr> 
                              <td width="48%" align="right"><font color="#FF0000">*</font>&nbsp;Store 
                                Name</td>
                              <td width="4%" align="center">:</td>

                              <td width="48%" align="left"><INPUT size=25 name=req_store_name value="<?=param('req_store_name')?>" class="textfeild"></td>
                            </tr>
                            <tr> 
                              <td width="48%" align="right"><font color="#FF0000">*</font>&nbsp;Buyer 
                                First Name</td>

                              <td width="4%" align="center">:</td>
                              <td width="48%" align="left"><INPUT size=25 name=req_first_name value="<?=param('req_first_name')?>" class="textfeild"></td>
                            </tr>
                            <tr> 
                              <td width="48%" align="right"><font color="#FF0000">*</font>&nbsp;Buyer 
                                Last Name</td>

                              <td width="4%" align="center">:</td>
                              <td width="48%" align="left"><INPUT size=25 name=req_last_name value="<?=param('req_last_name')?>" class="textfeild"></td>
                            </tr>
                            <tr> 
                              <td width="48%" align="right"><font color="#FF0000">*</font>&nbsp;Address 
                                1</td>
                              <td width="4%" align="center">:</td>
                              <td width="48%" align="left"><INPUT size=25 name=req_address_1 value="<?=param('req_address_1')?>" class="textfeild"></td>
                            </tr>
                            <tr> 
                              <td width="48%" align="right">Address 2</td>

                              <td width="4%" align="center">:</td>
                              <td width="48%" align="left"><INPUT size=25 name=address_2 value="<?=param('address_2')?>" class="textfeild"></td>
                            </tr>
                            <tr> 
                              <td width="48%" align="right"><font color="#FF0000">*</font>&nbsp;City</td>

                              <td width="4%" align="center">:</td>
                              <td width="48%" align="left"><INPUT size=25 name=req_city value="<?=param('req_city')?>" class="textfeild"></td>
                            </tr>
                            <tr> 
                              <td width="48%" align="right"><font color="#FF0000">*</font>&nbsp;State</td>
                              <td width="4%" align="center">:</td>
                              <td width="48%" align="left"><INPUT size=25 name=req_state value="<?=param('req_state')?>" class="textfeild"></td>
                            </tr>
                            <tr> 
                              <td width="48%" align="right"><font color="#FF0000">*</font>&nbsp;Zip</td>

                              <td width="4%" align="center">:</td>
                              <td width="48%" align="left"><INPUT size=25 name=req_zip value="<?=param('req_zip')?>" class="textfeild"></td>
                            </tr>
                            <tr> 
                              <td width="48%" align="right"><font color="#FF0000">*</font>&nbsp;Phone</td>

                              <td width="4%" align="center">:</td>
                              <td width="48%" align="left"><INPUT size=16 name=req_phone_no value="<?=param('req_phone_no')?>" class="textfeild"></td>
                            </tr>
                            <tr> 
                              <td width="48%" align="right">Fax</td>
                              <td width="4%" align="center">:</td>
                              <td width="48%" align="left"><INPUT size=16 name=fax_no value="<?=param('fax_no')?>" class="textfeild"></td>
                            </tr>

                            <tr> 
                              <td width="48%" align="right"><font color="#FF0000">*</font>&nbsp;email 
                                address</td>

                              <td width="4%" align="center">:</td>
                              <td width="48%" align="left"><INPUT size=25 name=req_email_addr value="<?=param('req_email_addr')?>" class="textfeild"></td>
                            </tr>
                            <tr>
                              <td align="right"><font color="#FF0000">*</font>&nbsp;Where did you hear of us?</td>
                              <td align="center">:</td>
                              <td width="48%" align="left"><INPUT size=25 name=req_Where_Hear value="<?=param('req_Where_Hear')?>" class="textfeild" id="req_Where_Hear"></td>
                            </tr>
                            <tr>
                              <td align="right"><font color="#FF0000">*</font>&nbsp;What products are you interested in?</td>
                              <td align="center">:</td>
                              <td width="48%" align="left"><INPUT size=25 name=req_What_Products value="<?=param('req_What_Products')?>" class="textfeild" id="req_What_Products"></td>
                            </tr>
                            <tr>
                              <td align="right"><font color="#FF0000">*</font> What type of business do you have?</td>
                              <td align="center">&nbsp;</td>
                              <td align="left"><INPUT size=25 name=req_Type_Business value="<?=param('req_Type_Business')?>" class="textfeild" id="req_Type_Business"></td>
                            </tr>
                            <tr>
                              <td align="right"><font color="#FF0000">*</font> How many years have you been in business?</td>
                              <td align="center">&nbsp;</td>
                              <td align="left"><INPUT size=25 name=req_Num_Years value="<?=param('req_Num_Years')?>" class="textfeild" id="req_Num_Years"></td>
                            </tr>
                            <tr> 
                              <td width="48%" align="right">Business Homepage</td>
                              <td width="4%" align="center">:</td>

                              <td width="48%" align="left"><INPUT size=25 name=business_url value="<?=param('business_url')?>" class="textfeild"></td>
                            </tr>
                            <tr> 
                              <td width="48%" align="right">Additional Comments</td>
                              <td width="4%" align="center">:</td>
                                                                                            <td width="48%" align="left"><TEXTAREA name=additional_comments cols=25 class="textfeild"><?=param('additional_comments')?></TEXTAREA></td>
                            </tr>
                            <tr> 
                              <td colspan="3" align="right"><img src="../images/common/spacer.gif" width="1" height="8"></td>
                            </tr>
<?php
if(!empty($errors)){
 ?>
                            <tr>
                             <td align = "center" colspan="3" class="runningtextblack" style="color: red">
                               <?= $errors ?>                             </td>
                            </tr>
<?php
} else {
//  error_log("*** NO ERRORS FOUND ***");
}
?>

                            <tr>
                              <td width="48%" align="right">&nbsp;                              </td>
                              <td width="4%" align="center">&nbsp;</td>
                              <td width="48%" align="left">
                                <img src="captcha_code_file.php?rand=<?php echo rand(); ?>" id='captchaimg' ><br>                              </td>
                            </tr>
                            <tr>
                              <td width="48%" align="right">
                                <label for='message'>Enter the image code above here</label>                              </td>
                              <td width="4%" align="center">:</td>
                              <td width="48%" align="left">
                                <input id="6_letters_code" name="6_letters_code" type="text">                              </td>
                            </tr>
                            <tr>
                              <td colspan=3 _width="48%" align="center">
                                <small>Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh</small>                              </td>
                            </tr>
                            <tr align="center"> 
                              <td colspan="3"><input type="image" value="submit" name="submit"  src="../../images/common/button-submit.jpg" onMouseOver="this.src='../../images/common/button-submit-mouse-over.jpg'" onMouseOut="this.src='../../images/common/button-submit.jpg'">
                                &nbsp; <a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('button-reset','','../../images/common/button-reset-mouse-over.jpg',1)" onClick="resetting()"><img src="../../images/common/button-reset.jpg" alt="Reset" name="button-reset" width="63" height="27" border="0"></a>                              </td>
                            </tr>
                          </table>
      <input type="hidden" name="subject" value="Spoontiques Buyer Registration" >
                          <input type=hidden name="redirect" value="http://www.spoontiques.com/">

                          <input name=success type=hidden value="http://www.spoontiques.com/">
      <input type="hidden" name="recipient" value="wds">
                          <input type="hidden" name="missing_fields_redirect" value="http://www.spooontiques.com/pages/contactus.htm">
      <input type="hidden" name="email" value="user email addr">
      <input type="hidden" name="realname" value="User Real Name">
      <input type="hidden" name="obs" value="1">
                        </form></td>
                    </tr>
                    <tr> 
                      <td height="170" align="center"><table width="60%" border="0" cellpadding="10" cellspacing="0" class="textfeild">

                          <tr> 
                            <td bgcolor="#F5F2E7" class="heading2">Spoontiques Contact Info</td>
                          </tr>
                          <tr>
                            <td><p style="margin-top: 0; margin-bottom: 0">Spoontiques, 
                                Inc.<br>
                                111 Island St<br>
                                Stoughton, Ma. 02072<br>

                                Phone: (781) 344-9530</p>
                              <p style="margin-top: 0; margin-bottom: 0;">Toll 
                                Free: (800) 225-5826</p>
                              <p style="margin-top: 0; margin-bottom: 0;">Fax: 
                                (781) 344-1576<br>
                                <br>
                                Email Address: <a href="mailto:service@spoontiques.com">service@spoontiques.com</a></p></td>
                          </tr>

                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="39" valign="middle" class="copyright">Copyright &copy; 2015 
            Spoontiques. All Rights Reserved.</td>
        </tr>
    </table></td>
  </tr>
</table>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-40090286-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

  var frmValidator = new Validator("buyer_info");

  frmValidator.addValidation("req_store_name", "req", "Please provide store name");
    frmValidator.addValidation('req_first_name', "req", "Please provide first name");
    frmValidator.addValidation('req_last_name', "req", "Please provide last name");
    frmValidator.addValidation('req_address_1', "req", "Please provide street address");
//    frmValidator.addValidation('address_2', "alpha", "Please provide additional street address info");
    frmValidator.addValidation('req_city', "req", "Please provide city.");
    frmValidator.addValidation('req_state', "req", "Please provide state");
    frmValidator.addValidation('req_zip', "req", "Please provide zipcode");
    frmValidator.addValidation('req_phone_no', "req", "Please provide phone number");
    frmValidator.addValidation('fax_no', "fax", "Please provide fax number");
    frmValidator.addValidation('req_email_addr', "email", "Please provide a valid email address.");
    frmValidator.addValidation('req_Where_Hear', "req", "Please tell us where you heard of us.");
    frmValidator.addValidation('req_What_Products', "req", "Please let us know what products you're interested in.");
    frmValidator.addValidation('req_Type_Business', "req", "Please provide your type of business.");
    frmValidator.addValidation('req_Num_Years', "req", "Please provide the number of years you've been in business.");
    frmValidator.addValidation('business_url', "url", "Please provide your business' URL if applicable.");
    frmValidator.addValidation('additional_comments', "comments", "Please provide any additional comments you might have.");
</script>
</body>
</html>
