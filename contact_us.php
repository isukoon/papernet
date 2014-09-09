<?php 
	include_once ("config/config.php");
?>
<html>
<head>
<title>On-Line Newspaper Advertisement Submition Agent...</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" title="core css file" charset="utf-8" />

<script language="JavaScript">

function processEntry(){
	alert("Thank you for contacting us! We will get back to you soon.");
	resetEntry();
}

function resetEntry(){
	document.getElementById("userName").value = "";
	document.getElementById("userEmail").value = "";	
	document.getElementById("subject").value = "";
	document.getElementById("message").value = "";
}
</script>
</head>

<body>
<?php include_once("header.php"); ?>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="739">
  <tr>
    <td> 
      <table bgcolor="#FFFFFF" width="950" height="362" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td height="57" colspan="3"><img src="images/spacer.gif" width="87" height="57"></td>
        </tr>
        <tr> 
          <td width="10%" height="225"></td>
          <td width="80%" valign="top" class="text">
		  	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="51%" valign="top"><fieldset><legend class="text"><font color="blue">Contact Details</font></legend>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="text">
                    <tr> 
                      <td width="12%" colspan="3">&nbsp;</td>
                    </tr>
                    <tr> 
                      <td width="12%">&nbsp;</td>
                      <td width="76%" height="20">PaperNET Advertiesments (pvt) Ltd.</td>
                      <td width="12%">&nbsp;</td>
                    </tr>
                    <tr> 
                      <td>&nbsp;</td>
                      <td>R A De Mel Road,</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr> 
                      <td>&nbsp;</td>
                      <td>Colombo 03</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr> 
                      <td>&nbsp;</td>
                      <td></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr> 
                      <td>&nbsp;</td>
                      <td></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr> 
                      <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr> 
                      <td>&nbsp;</td>
                      <td></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr> 
                      <td>&nbsp;</td>
                      <td><p>Tel : 0112 435657 FAX : 0112 345684</p></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr> 
                      <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr> 
                      <td>&nbsp;</td>
                      <td>Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:- papernet_admin@gmail.com
                         </td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr> 
                      <td colspan="3">&nbsp;</td>
                    </tr>
                  </table>
                  <p>&nbsp;</p>
                  </fieldset>&nbsp;</td>
                <td width="49%" valign="top">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="text">
                    <tr> 
                      <td width="9%">&nbsp;</td>
                      <td width="34%">&nbsp;</td>
                      <td width="57%">&nbsp;</td>
                    </tr>
                    <tr> 
                      <td>&nbsp;</td>
                      <td>Your Name</td>
                      <td><input type="text" name="userName" id="userName" size="20" maxlength="20" class="text"></td>
                    </tr>
                    <tr> 
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr> 
                      <td>&nbsp;</td>
                      <td>Your Email</td>
                      <td><input type="text" name="userEmail" id="userEmail" size="20" maxlength="20" class="text"></td>
                    </tr>
                    <tr> 
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr> 
                      <td>&nbsp;</td>
                      <td>Subject</td>
                      <td><input type="text" name="subject" id="subject" size="20" maxlength="20" class="text"></td>
                    </tr>
                    <tr> 
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr> 
                      <td>&nbsp;</td>
                      <td>Message</td>
                      <td rowspan="4"><textarea name="message" rows="5" class="text"></textarea></td>
                    </tr>
                    <tr> 
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr> 
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr> 
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr> 
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td><input type="button" name="button" id="button" value="Send" class="text" onClick="processEntry();">
                      <input type="button" name="button2" id="button2" value="Reset" class="text" onClick="resetEntry();"></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                  </html:form>
                  </td>
              </tr>
            </table> </td>
          <td width="10%">&nbsp;</td>
        </tr>
        <tr> 
          <td height="80" colspan="3"> </td>
        </tr>
      </table>
	</td>
  </tr>
</table>
<?php include_once("footer.php"); ?>
</body>
</html>