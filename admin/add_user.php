<?php
	ob_start();
	include_once ("config/config.php");
	if($_SESSION["ses_user_name"] == null || $_SESSION["ses_user_name"] == "" || !isset($_SESSION["ses_user_name"])){
		session_destroy();
		header("Location:".$SERVER_URL."index.php");
		die();
	}

	if($_SESSION["ses_user_level"] == "DOCTOR" || $_SESSION["ses_user_level"] == "EDITOR"){ 
		header("Location:".$SERVER_URL."edit_user.php");
		die();
	}
	ob_end_flush();
?>
<html>
<head>
<title><?php echo $SYSTEM_NAME; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="css/ebees_1.css" type="text/css" media="screen" title="core css file" charset="utf-8" />
<link rel="stylesheet" href="css/ebees_2.css" type="text/css" media="screen" title="core css file" charset="utf-8" />
<link rel="stylesheet" href="css/cssverticalmenu.css" type="text/css" media="screen" title="core css file" charset="utf-8" />
<link rel="stylesheet" href="css/messages.css" type="text/css" media="screen" title="core css file" charset="utf-8" />

<script src="javascript/XMLHTTP.js" type="text/javascript" charset="utf-8"></script>	
<script src="javascript/common.js" type="text/javascript" charset="utf-8"></script>
<script src="javascript/cssverticalmenu.js" type="text/javascript" charset="utf-8"></script>	
<script src="javascript/jquery.js" type="text/javascript" charset="utf-8"></script>	
<script src="javascript/messages.js" type="text/javascript" charset="utf-8"></script>

<script language="JavaScript" type="text/javascript">  

function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);

function get_user_id()
{
	var urlString = "<?php echo $SERVER_URL; ?>load_values.php?chksql=get_user_id";
	var http = getHTTPObject();
	http.open("POST", urlString , true);
	http.onreadystatechange = function() 
	{
		if (http.readyState == 4)
		{
			if (http.status == 200) 
			{
				document.getElementById("user_id_text").value = http.responseText;
				document.getElementById("user_id_text").disabled = true;
				document.getElementById("user_name_text").focus();
			} 
			else
			{
				alert("Error Occured : " + http.statusText);
			}
		}
	}
	http.send(null); 	
}

function get_edit_newspapers()
{
	var urlString = "<?php echo $SERVER_URL; ?>load_values.php?chksql=load_newspapers_edit";
	var http = getHTTPObject();
	http.open("POST", urlString , true);
	http.onreadystatechange = function() 
	{
		if (http.readyState == 4)
		{
			if (http.status == 200) 
			{
				document.getElementById("newspapers_div").innerHTML = http.responseText;
			} 
			else
			{
				alert("Error Occured : " + http.statusText);
			}
		}
	}
	http.send(null); 	
}

function validate_user_entry()
{
	if(document.getElementById("user_name_text").value == "")
	{
		document.getElementById("div_user_name").innerHTML = "Please Enter the User Name";
	}
	else if(document.getElementById("user_pass_text").value == "")
	{
		document.getElementById("div_user_pass").innerHTML = "Please Enter the Password";
	}
	else if(document.getElementById("user_repass_text").value == "")
	{
		document.getElementById("div_user_repass").innerHTML = "Please Retype the Password";
	}
	else if(document.getElementById("act_name_text").value == "")
	{
		document.getElementById("div_act_name").innerHTML = "Please Enter the Actual Name";
	}
	else if(document.getElementById("email_text").value == "")
	{
		document.getElementById("div_email").innerHTML = "Please Enter the Email";
	}
	else if(document.getElementById("mobile_no_text").value == "")
	{
		document.getElementById("div_mobile").innerHTML = "Please Enter the Mobile No";
	}
	else if(document.getElementById("reg_user_level").value == "")
	{
		document.getElementById("div_user_level").innerHTML = "Please Select the User Level";
	}
	else
	{
		save_user_entry();
	}			
}

function save_user_entry()
{
	var urlString = "<?php echo $SERVER_URL; ?>save_values.php?chksql=register_user&user_id="+document.getElementById("user_id_text").value+"&user_name="+document.getElementById("user_name_text").value+
					"&password="+document.getElementById("user_pass_text").value+"&name="+document.getElementById("act_name_text").value+"&email="+document.getElementById("email_text").value+
					"&mobile_no="+document.getElementById("user_pass_text").value+"&user_level="+document.getElementById("reg_user_level").value+"&company="+document.getElementById("edit_newspapers_select").value;
	
	var http = getHTTPObject();
	http.open("POST", urlString , true);
	http.onreadystatechange = function() 
	{
		if (http.readyState == 4)
		{
			if (http.status == 200) 
			{
				document.getElementById("submit_but").disabled = true;
				document.getElementById("display_message").innerHTML = http.responseText;
			} 
			else
			{
				alert("Error Occured : " + http.statusText);
			}
		}
	}
	http.send(null); 
}

function remove_user_name_msg()
{
	if(document.getElementById("div_user_name").innerHTML != "")
	{
		document.getElementById("div_user_name").innerHTML = "";
	}
}

function remove_user_pass_msg()
{
	if(document.getElementById("div_user_pass").innerHTML != "")
	{
		document.getElementById("div_user_pass").innerHTML = "";
	}
}

function remove_user_repass_msg()
{
	if(document.getElementById("user_pass_text").value != document.getElementById("user_repass_text").value)
	{
		document.getElementById("div_user_repass").innerHTML = "Password Mismatch!";
		document.getElementById("user_repass_text").value = "";
		document.getElementById("user_repass_text").focus();
	}
	else
	{
		if(document.getElementById("div_user_repass").innerHTML != "")
		{
			document.getElementById("div_user_repass").innerHTML = "";
		}
	}
}

function remove_act_name_msg()
{
	if(document.getElementById("div_act_name").innerHTML != "")
	{
		document.getElementById("div_act_name").innerHTML = "";
	}
}

function remove_email_msg()
{
	if(document.getElementById("div_email").innerHTML != "")
	{
		document.getElementById("div_email").innerHTML = "";
	}
}

function remove_mobile_msg()
{
	if(document.getElementById("div_mobile").innerHTML != "")
	{
		document.getElementById("div_mobile").innerHTML = "";
	}
}

function remove_user_level_msg()
{
	if(document.getElementById("div_user_level").innerHTML != "")
	{
		document.getElementById("div_user_level").innerHTML = "";
	}
}

function reset_user_entry()
{
	document.location.reload();
}

function display_users()
{
	if(document.getElementById("user_level").value == "")
	{
		document.getElementById("error_msg").innerHTML = "Please Select the user Level";
	}
	else
	{
		document.getElementById("error_msg").innerHTML = "";
		var urlString = "<?php echo $SERVER_URL; ?>load_values.php?chksql=update_user&user_level="+document.getElementById("user_level").value;
		var http = getHTTPObject();
		http.open("POST", urlString , true);
		http.onreadystatechange = function() 
		{
			if (http.readyState == 4)
			{
				if (http.status == 200) 
				{
					document.getElementById("div_users").innerHTML = http.responseText;
					document.getElementById("view_data").style.display = "inline";
				} 
				else
				{
					alert("Error Occured : " + http.statusText);
				}
			}
		}
		http.send(null); 
	}	
}

function hide_error_msg()
{
	if(document.getElementById("user_level").value != "")
	{
		document.getElementById("error_msg").innerHTML = "";
	}
}

function load_user_details()
{
	var urlString = "<?php echo $SERVER_URL; ?>load_values.php?chksql=edit_user&user_id="+document.getElementById("user_names").value+"&user_level="+document.getElementById("user_level").value;
	var http = getHTTPObject();
	http.open("POST", urlString , true);
	http.onreadystatechange = function() 
	{
		if (http.readyState == 4)
		{
			if (http.status == 200) 
			{
				document.getElementById("div_user_setails").innerHTML = http.responseText;
			} 
			else
			{
				alert("Error Occured : " + http.statusText);
			}
		}
	}
	http.send(null); 	
}

function update_user_details()
{
	var modify_status = false;
	if(document.getElementById("hid_user_name").value != document.getElementById("mod_user_name").value)
	{
		modify_status = true;
	}
	else if(document.getElementById("hid_user_pass").value != document.getElementById("mod_user_pass").value)
	{
		modify_status = true;
	}
	else if(document.getElementById("hid_act_name").value != document.getElementById("mod_act_name").value)
	{
		modify_status = true;
	}
	else if(document.getElementById("hid_email").value != document.getElementById("mod_email").value)
	{
		modify_status = true;
	}
	else if(document.getElementById("hid_mobile_no").value != document.getElementById("mod_mobile_no").value)
	{
		modify_status = true;
	}
	else
	{
		modify_status = false;
	}
	if(modify_status == true)
	{	
		var urlString = "<?php echo $SERVER_URL; ?>save_values.php?chksql=save_modified_user&user_id="+document.getElementById("hid_user_id").value+"&user_name="+document.getElementById("mod_user_name").value+
						"&password="+document.getElementById("mod_user_pass").value+"&act_name="+document.getElementById("mod_act_name").value+
						"&email="+document.getElementById("mod_email").value+"&mobile_no="+document.getElementById("mod_mobile_no").value;
						
		var http = getHTTPObject();
		http.open("POST", urlString , true);
		http.onreadystatechange = function() 
		{
			if (http.readyState == 4)
			{
				if (http.status == 200) 
				{
					document.getElementById("update_button").disabled = true;
					document.getElementById("modify_msg").innerHTML = http.responseText;
				} 
				else
				{
					alert("Error Occured : " + http.statusText);
				}
			}
		}
		http.send(null); 		
	}
	else
	{
		document.getElementById("modify_msg").innerHTML = "User details are Not Modified!";
	}	
}

function clear_error_msg()
{
	if(document.getElementById("hid_user_name").value != document.getElementById("mod_user_name").value)
	{
		document.getElementById("modify_msg").innerHTML = "";
	}
	else if(document.getElementById("hid_user_pass").value != document.getElementById("mod_user_pass").value)
	{
		document.getElementById("modify_msg").innerHTML = "";
	}
	else if(document.getElementById("hid_act_name").value != document.getElementById("mod_act_name").value)
	{
		document.getElementById("modify_msg").innerHTML = "";
	}
	else if(document.getElementById("hid_email").value != document.getElementById("mod_email").value)
	{
		document.getElementById("modify_msg").innerHTML = "";
	}
	else if(document.getElementById("hid_mobile_no").value != document.getElementById("mod_mobile_no").value)
	{
		document.getElementById("modify_msg").innerHTML = "";
	}
	else
	{
		document.getElementById("modify_msg").innerHTML = "User details are Not Modified!";
	}
}

function delete_user_details()
{
	var result = confirm("Are u sure! You want to delete the User ID - "+document.getElementById("user_names").value+"!");
	if(result)
	{
		var urlString = "<?php echo $SERVER_URL; ?>save_values.php?chksql=delete_user&user_id="+document.getElementById("user_names").value;
						
		var http = getHTTPObject();
		http.open("POST", urlString , true);
		http.onreadystatechange = function() 
		{
			if (http.readyState == 4)
			{
				if (http.status == 200) 
				{
					document.getElementById("edit_but").disabled = true;
					document.getElementById("delete_usr_button").disabled = true;
					document.getElementById("user_names").disabled = true;
					document.getElementById("user_level").disabled = true;
					document.getElementById("view_button").disabled = true;
					document.getElementById("div_user_setails").innerHTML = "";
					document.getElementById("delete_msg").innerHTML = http.responseText;
				} 
				else
				{
					alert("Error Occured : " + http.statusText);
				}
			}
		}
		http.send(null); 		
	}
	else
	{
		return;
	}
}

		
</script>
</head>				
				
<body onLoad="loadNewMenu(); get_user_id();get_edit_newspapers();">	
<input type="hidden" name="hid_member_id" id="hid_member_id" value="">
  <table width="1087" height="591" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="19" align="right" class="body">&nbsp;&nbsp;&nbsp;Logged 
        In : <?php echo $_SESSION["ses_name"];?> [<?php echo $_SESSION["ses_user_level"];?>]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    </tr>
    <tr> 
      <td width="1087" height="572" valign="top" class="body"> 
        <fieldset class="fieldset">
        <table width="100%" height="591" border="0" cellpadding="0" cellspacing="0">    
          <tr>
            <td width="20%" valign="top"><?php require_once("menu.php"); ?></td> 
            <td width="80%" height="450" valign="top">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="body">
              <tr height="20">
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td class="header_title" height="20">&nbsp;&nbsp;&nbsp;Backoffice User Management</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td width="98%">&nbsp;</td>
                <td width="2%">&nbsp;</td>
              </tr>
              
              <tr>
                <td>
                
<table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr> 
            <td width="80%" height="304"><fieldset class="fieldset">
              <legend class="legend">New User Registration</legend>
              <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="body">
                <tr> 
                  <td width="12%">&nbsp;</td>
                  <td width="19%">&nbsp;</td>
                  <td width="22%">&nbsp;</td>
                  <td width="47%">&nbsp;</td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td class="body">User ID</td>
                  <td><input name="user_id_text" type="text" id="user_id_text" class="body"></td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td align="right"><font color="#FF0000">*</font></td>
                  <td class="body">User Name</td>
                  <td><input name="user_name_text" type="text" id="user_name_text" class="body" onChange="remove_user_name_msg();"></td>
                  <td><div id="div_user_name" class="error"></div></td>
                </tr>
                <tr> 
                  <td align="right"><font color="#FF0000">*</font></td>
                  <td class="body">Password</td>
                  <td><input name="user_pass_text" type="password" id="user_pass_text" maxlength="8" class="body" onChange="remove_user_pass_msg();"></td>
                  <td><div id="div_user_pass" class="error"></div></td>
                </tr>
                <tr> 
                  <td align="right"><font color="#FF0000">*</font></td>
                  <td class="body">Re-type Passowrd</td>
                  <td><input name="user_repass_text" type="password" id="user_repass_text" maxlength="8"  class="body" onChange="remove_user_repass_msg();"></td>
                  <td><div id="div_user_repass" class="error"></div></td>
                </tr>
                <tr> 
                  <td align="right"><font color="#FF0000">*</font></td>
                  <td class="body">Name</td>
                  <td><input name="act_name_text" type="text" id="act_name_text" class="body" onChange="remove_act_name_msg();"></td>
                  <td><div id="div_act_name" class="error"></div></td>
                </tr>
                <tr> 
                  <td align="right"><font color="#FF0000">*</font></td>
                  <td class="body">Email</td>
                  <td><input name="email_text" type="text" id="email_text" class="body" onChange="remove_email_msg();"></td>
                  <td><div id="div_email" class="error"></div></td>
                </tr>
                <tr> 
                  <td align="right"><font color="#FF0000">*</font></td>
                  <td class="body">Mobile No</td>
                  <td><input name="mobile_no_text" type="text" id="mobile_no_text" class="body" onChange="remove_mobile_msg();"></td>
                  <td><div id="div_mobile" class="error"></div></td>
                </tr>
                <tr> 
                  <td align="right"><font color="#FF0000">*</font></td>
                  <td class="body">User Level</td>
                  <td><select name="reg_user_level" size="1" id="reg_user_level" class="body" onChange="remove_user_level_msg();">
                      <option selected>--- Please Select ---</option>
                      <option value="ADMIN">Admin</option>
                      <option value="NORMAL">Normal</option>
                    </select> </td>
                  <td><div id="div_user_level" class="error"></div></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td colspan="3">[Only applicable for ADMIN users]</td>
                  </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>Newspaper Company</td>
                  <td colspan="2"><div id="newspapers_div"></div></td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td colspan="2"><div id="display_message" class="body"></div></td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td><input type="button" name="submit_but" value=" Save " class="body" onClick="validate_user_entry();"> 
                    <input type="button" name="reset_but" value="Reset" class="body" onClick="reset_user_entry();">                  </td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
              </fieldset></td>
            </tr>
          <tr> 
            <td width="80%"> <fieldset class="fieldset">
              <legend class="legend">Modify User Information</legend>
              <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="body">
                <tr> 
                  <td width="8%">&nbsp;</td>
                  <td width="17%">&nbsp;</td>
                  <td width="23%"></td>
                  <td width="17%">&nbsp;</td>
                  <td width="35%">&nbsp;</td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td>User Level</td>
                  <td><select name="user_level" size="1" id="user_level" class="body" onChange="hide_error_msg();">
                      <option selected>--- Please Select ---</option>
                      <option value="ADMIN">Admin</option>
					  <option value="NORMAL">Normal</option>
                    </select> </td>
                  <td><input type="Button" name="view_button" value=" View Details " class="body" onClick="display_users();"></td>
                  <td><div id="error_msg" class="error"></div></td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
              <div id="view_data" style="display:none;"> 
                <table width="100%" border="0" align="center" class="body">
                  <tr> 
                    <td width="8%">&nbsp;</td>
                    <td width="17%">Users</td>
                    <td width="23%"><div id="div_users"></div></td>
                    <td width="17%"><input name="edit_but" type="button" id="edit_but" value="  Edit Details  " class="body" onClick="load_user_details();"></td>
                    <td width="35%"><input name="delete_usr_button" type="button" id="delete_usr_button" value="  Delete User " class="body" onClick="delete_user_details();"></td>
                  </tr>
                  <tr> 
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td colspan="3"><div id="delete_msg"></div></td>
                  </tr>
                </table>
              </div>
              </fieldset></td>
            </tr>
          <tr> 
            <td height="21"><div id="div_user_setails"></div></td>
            </tr>
          <tr>
            <td height="21">&nbsp;</td>
            </tr>
        </table>                
                
                </td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>            
            </td>
          </tr>
          <tr>
            <td height="20" colspan="2"><?php require_once("footer.php"); ?></td>
          </tr>
        </table>
        </fieldset></td>
    </tr>
  </table>
 
</body>
</html>

