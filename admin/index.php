<?php
	include_once ("config/config.php");
?>
<html>
<head>
<title><?php echo $SYSTEM_NAME; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<link rel="stylesheet" href="css/ebees_1.css" type="text/css" media="screen" title="core css file" charset="utf-8" />
<link rel="stylesheet" href="css/ebees_2.css" type="text/css" media="screen" title="core css file" charset="utf-8" />
<link rel="stylesheet" href="css/messages.css" type="text/css" media="screen" title="core css file" charset="utf-8" />

<script src="javascript/messages.js" type="text/javascript" charset="utf-8"></script>	
<script src="javascript/XMLHTTP.js" type="text/javascript" charset="utf-8"></script>	
<script language="JavaScript" type="text/javascript">  
	
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);

function setCursor(){
	document.getElementById("text_user_name").focus();
}

function validateLogin(){
	var username = document.getElementById("text_user_name").value;
	var password = document.getElementById("text_user_pass").value;		
	var status = true;
	if(username == ""){
		inlineMsg('text_user_name','<strong>Error</strong><br />Please enter the User Name!',2);
		status = false;
	}else if(password == ""){
		inlineMsg('text_user_pass','<strong>Error</strong><br />Please enter the Password!',2);
		status = false;
	}else{					
		var urlString = "<?php echo $SERVER_URL; ?>validate_login.php?chksql=validate&user_name="+username+"&user_pass="+password;
		var http = getHTTPObject();
		http.open("POST", urlString , true);
		http.onreadystatechange = function() {
			if (http.readyState == 4){
				if (http.status == 200) {
					var result = http.responseText;
					if(result.indexOf("ERROR") > -1){
						document.getElementById("text_user_name").value = "";
						document.getElementById("text_user_pass").value = "";
						document.getElementById("text_user_name").focus();						
						inlineMsg('text_user_name','<strong>Error</strong><br />Invalid Login!',2);						
					}else{
						if(navigator.appName == "Microsoft Internet Explorer"){
							document.location.href("<?php echo $SERVER_URL; ?>home.php");
						}else{
							window.location = "<?php echo $SERVER_URL; ?>home.php";
						}						
					}	
				} 
				else{
					alert("Error Occured : " + http.statusText);
				}
			}
		}
		http.send(null);		
	}	
}

function refreshPage(){
	document.location.reload();
}

function searchKeyPress(e){
	if (window.event) { e = window.event; }
    if (e.keyCode == 13){
		validateLogin();
	}
}				
</script> 
</head>				
				
<body onLoad="setCursor();">
<table width="781" height="563" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
      <td height="19">&nbsp;</td>
    </tr>  
    <tr> 
      <td width="781" height="544" valign="top" class="body"> 
        <fieldset class="fieldset">
	    <table width="781" height="549" border="0" cellpadding="0" cellspacing="0">
          <tr> 
            <td width="781" height="499"> 
              <table width="100%" border="0" class="body">				  
				  <tr>
				    <td width="25%" height="242">&nbsp;</td>
				    <td width="50%"><!--   style="background:url(images/login.jpg) no-repeat top left" --> 
                    <fieldset class="fieldset"> 
                    <legend class="legend">Login to PaperNET Backoffice</legend>                 
                    <table width="100%"  border="0">
                      <tr>
                        <td colspan="3">&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="20%" class="body">&nbsp;</td> 
                        <td width="20%" class="body">User Name</td>
                        <td width="60%"><input name="text_user_name" type="text" class="body" id="text_user_name" value="" size="20" maxlength="10"></td>
                      </tr>
                      <tr>
                        <td class="body">&nbsp;</td> 
                        <td class="body">Password</td>
                        <td><input name="text_user_pass" type="password" class="body" id="text_user_pass" value="" size="20" maxlength="10" onKeyPress="searchKeyPress(event);"></td>
                      </tr>
                      <tr>
                        <td class="body">&nbsp;</td> 
                        <td class="body">&nbsp;</td>
                        <td><input name="login_but" type="button" class="body" id="login_but" value="Login" onClick="validateLogin();"> 
                          <input name="reset_but" type="button"  class="body" id="reset_but" value="Reset" onClick="refreshPage();">                          </td>
                      </tr>
                      <tr>
                        <td class="body">&nbsp;</td> 
                        <td class="body">&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                    </table>                    
                     </fieldset>
                    </td>
				    <td width="25%">&nbsp;</td>
			    </tr>
		    </table>	
            </td>
          </tr>
          <tr>
            <td height="21"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="right"><a href="../index.php">Go Back to PaperNET</a>&nbsp;&nbsp;</td>
              </tr>
            </table></td>
          </tr>
		</table>
  		</fieldset>
	  </td>
    </tr>
  </table>
</body>
</html>

