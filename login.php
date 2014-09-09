<?php
	include_once ("config/config.php");
?>
<html>
<head>
<title>On-Line Newspaper Advertisement Submition Agent...</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" title="core css file" charset="utf-8" />
<link rel="stylesheet" href="css/messages.css" type="text/css" media="screen" title="core css file" charset="utf-8" />

<script src="scripts/XMLHTTP.js" type="text/javascript"></script>
<script src="scripts/messages.js" type="text/javascript" charset="utf-8"></script>
<script language="JavaScript">

	function validateLogin(){
		var userName = document.getElementById("user_name").value;
		var password = document.getElementById("password").value;	
		
		if(userName == ""){
			inlineMsg('user_name','<strong>Error</strong><br />Please enter the User Name!',2);
		} else if(password == ""){
			inlineMsg('password','<strong>Error</strong><br />Please enter the Password!',2);
		} else {
			var urlString = "<?php echo $SERVER_URL;?>validate_login.php?chksql=validate&user_name="+userName+"&user_pass="+password;
			//alert(urlString);
			var http = getHTTPObject();
			http.open("POST", urlString , true);
			http.onreadystatechange = function() {
				if (http.readyState == 4){
					if (http.status == 200) {
						var result = http.responseText;		
						//alert(result);	
						if(result.indexOf("ERROR") > -1){
							document.getElementById("user_name").value = "";
							document.getElementById("password").value = "";
							document.getElementById("user_name").focus();						
							inlineMsg('user_name','<strong>Error</strong><br />Invalid Login!',2);						
						}else{
							if(navigator.appName == "Microsoft Internet Explorer"){
								document.location.href("<?php echo $SERVER_URL; ?>index.php");
							}else{
								window.location = "<?php echo $SERVER_URL; ?>index.php";
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
	
	function resetPage(){
		document.location.reload();
	}	
	function loadpage() 
{
    window.location.href = "home.php";
}

</script>
</head>

<body>
<?php include_once("header.php"); ?>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="739">
  <tr>
    <td> 
      <table bgcolor="#FFFFFF" width="950" height="305" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td height="78" colspan="3"></td>
        </tr>
        <tr> 
          <td width="20%" height="50"></td>
          <td width="60%" valign="top"><fieldset>
            <legend class="text"><font color="blue">Login</font></legend>
            <table width="100%" border="0" cellpadding="0" cellspacing="0" class="text">
			  <tr>
				<td align="center" colspan="4" >&nbsp;</td>
			  </tr> 								 
              <tr> 
                <td width="20%">&nbsp;</td>
                <td width="20%">User Name</td>
                <td width="40%"><input type="text" name="user_name" id="user_name" class="text"></td>
                <td width="20%">&nbsp;</td>
              </tr>
              <tr> 
                <td colspan="4">&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td>Password</td>
                <td><input type="password" name="password" id="password" class="text"></td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td colspan="4">&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><input type="button" name="button" id="button" value="Login" class="text" onClick="validateLogin();">
                <input type="button" name="button2" id="button2" value="Reset" class="text" onClick="resetPage();">
				<input type="button" name="button3" id="button3" value="Guest" class="text" onClick="loadpage();"></td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td colspan="4">&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>Forgot the password <a href="forgot_password.php">Click here</a></td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td colspan="4">&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>New User Registration <a href="register.php">Click here</a></td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td colspan="4">&nbsp;</td>
              </tr>
            </table>
            </fieldset>
            &nbsp;</td>
          <td width="20%">&nbsp;</td>
        </tr>
        <tr> 
          <td height="50" colspan="3"></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<?php include_once("footer.php"); ?>
</body>
</html>