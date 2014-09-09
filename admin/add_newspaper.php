<?php
	ob_start();
	include_once ("config/config.php");
	if($_SESSION["ses_user_name"] == null || $_SESSION["ses_user_name"] == "" || !isset($_SESSION["ses_user_name"])){
		session_destroy();
		header("Location:".$SERVER_URL."index.php");
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
<link rel="stylesheet" href="css/ui.datepicker.css" type="text/css" media="screen" title="core css file" charset="utf-8" />

<script src="javascript/XMLHTTP.js" type="text/javascript" charset="utf-8"></script>	
<script src="javascript/common.js" type="text/javascript" charset="utf-8"></script>
<script src="javascript/cssverticalmenu.js" type="text/javascript" charset="utf-8"></script>	
<script src="javascript/jquery.js" type="text/javascript" charset="utf-8"></script>	
<script src="javascript/messages.js" type="text/javascript" charset="utf-8"></script>
<script src="javascript/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>

<script language="JavaScript" type="text/javascript">  

function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);

function get_newspaper_id()
{
	var urlString = "<?php echo $SERVER_URL; ?>load_values.php?chksql=get_newspaper_id";
	var http = getHTTPObject();
	http.open("POST", urlString , true);
	http.onreadystatechange = function() 
	{
		if (http.readyState == 4)
		{
			if (http.status == 200) 
			{
				document.getElementById("newspaper_id_text").value = http.responseText;
				document.getElementById("newspaper_id_text").disabled = true;
				document.getElementById("newspaper_name_text").focus();
			} 
			else
			{
				alert("Error Occured : " + http.statusText);
			}
		}
	}
	http.send(null); 	
}

function validate_entry()
{
	if(document.getElementById("newspaper_name_text").value == "")
	{
		document.getElementById("div_newspaper_name").innerHTML = "Please Enter the Newspaper Name";
	}
	else if(document.getElementById("newspaper_disp_name_text").value == "")
	{
		document.getElementById("div_newspaper_disp_name").innerHTML = "Please Enter the Display Name";
	}
	else
	{
		save_entry();
	}			
}

function save_entry()
{
	var urlString = "<?php echo $SERVER_URL; ?>save_values.php?chksql=save_newspaper&newspaper_id="+document.getElementById("newspaper_id_text").value+"&newspaper_name="+document.getElementById("newspaper_name_text").value+"&newspaper_disp_name="+document.getElementById("newspaper_disp_name_text").value;
	
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


function reset_entry()
{
	document.location.reload();
}

function remove_msg(){
	if(document.getElementById("newspaper_name_text").value != "")
	{
		document.getElementById("div_newspaper_name").innerHTML = "";
	}
	if(document.getElementById("newspaper_disp_name_text").value != "")
	{
		document.getElementById("div_newspaper_disp_name").innerHTML = "";
	}	
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
				document.getElementById("div_newspaper_edit").innerHTML = http.responseText;
			} 
			else
			{
				alert("Error Occured : " + http.statusText);
			}
		}
	}
	http.send(null); 	
}

function check_errors(){
	if(document.getElementById("edit_newspapers_select").value != ""){
		document.getElementById("error_msg").innerHTML = "";
	}
}

function hide_errors(){
	if(document.getElementById("newspaper_disp_name_text2").value != "")
	{
		document.getElementById("newspaper_err_div").innerHTML = "";
	}
	if(document.getElementById("newspaper_disp_name_text2").value != "")
	{
		document.getElementById("newspaper_err_div").innerHTML = "";
	}		
}

function display_newspaper(){
	if(document.getElementById("edit_newspapers_select").value == ""){
		document.getElementById("error_msg").innerHTML = "Please Select the Newspaper";
	}
	else{
		var urlString = "<?php echo $SERVER_URL; ?>load_values.php?chksql=load_newspapers_details&newspaper_id="+document.getElementById("edit_newspapers_select").value;
		var http = getHTTPObject();
		http.open("POST", urlString , true);
		http.onreadystatechange = function() 
		{
			if (http.readyState == 4)
			{
				if (http.status == 200) 
				{
					document.getElementById("div_newspaper_details").innerHTML = http.responseText;
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

function edit_newspaper(){
	
	if(document.getElementById("newspaper_name_text2").value == "" || document.getElementById("newspaper_disp_name_text2").value == "")
	{
		document.getElementById("newspaper_err_div").innerHTML = "Please Enter a Values!";
	}
	else{
		var urlString = "<?php echo $SERVER_URL; ?>save_values.php?chksql=edit_newspaper&newspaper_id="+document.getElementById("edit_newspapers_select").value+"&newspaper_name="+document.getElementById("newspaper_name_text2").value+"&newspaper_disp_name="+document.getElementById("newspaper_disp_name_text2").value;
		
		var http = getHTTPObject();
		http.open("POST", urlString , true);
		http.onreadystatechange = function() 
		{
			if (http.readyState == 4)
			{
				if (http.status == 200) 
				{
					document.getElementById("result_div").innerHTML = http.responseText;
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

function delete_newspaper(){
	if(document.getElementById("newspaper_name_text2").value == "" || document.getElementById("newspaper_disp_name_text2").value == "")
	{
		document.getElementById("newspaper_err_div").innerHTML = "Please Enter a Values!";
	}
	else{
		var urlString = "<?php echo $SERVER_URL; ?>save_values.php?chksql=delete_newspaper&newspaper_id="+document.getElementById("edit_newspapers_select").value+"&newspaper_disp_name="+document.getElementById("newspaper_disp_name_text2").value;
		
		var http = getHTTPObject();
		http.open("POST", urlString , true);
		http.onreadystatechange = function() 
		{
			if (http.readyState == 4)
			{
				if (http.status == 200) 
				{
					document.getElementById("result_div").innerHTML = http.responseText;
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
//-->
</script>
</head>

<body onLoad="loadNewMenu();get_newspaper_id();get_edit_newspapers();">			
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
                <td class="header_title" height="20">&nbsp;&nbsp;&nbsp;Add | Edit Newspaper</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td width="98%">&nbsp;</td>
                <td width="2%">&nbsp;</td>
              </tr>
              
              <tr>
                <td>
                
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="body">
          <tr> 
            <td width="80%" height="304"><fieldset class="fieldset">
              <legend class="legend">New Newspaper </legend>
              <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr> 
                  <td width="12%">&nbsp;</td>
                  <td width="19%">&nbsp;</td>
                  <td width="22%">&nbsp;</td>
                  <td width="47%">&nbsp;</td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td class="body">Newspaper ID </td>
                  <td><input name="newspaper_id_text" type="text" id="newspaper_id_text" class="body"></td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td align="right">&nbsp;</td>
                  <td class="body">Newspaper  Name</td>
                  <td><input name="newspaper_name_text" type="text" id="newspaper_name_text" class="body" onChange="remove_msg();"></td>
                  <td><div id="div_newspaper_name" class="error"></div></td>
                </tr>
                <tr>
                  <td align="right">&nbsp;</td>
                  <td class="body">Display  Name</td>
                  <td><input name="newspaper_disp_name_text" type="text" id="newspaper_disp_name_text" class="body" onChange="remove_msg();"></td>
                  <td><div id="div_newspaper_disp_name" class="error"></div></td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td colspan="2"><div id="display_message" class="body"></div></td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td><input type="button" name="submit_but" value=" Save " class="body" onClick="validate_entry();"> 
                    <input type="button" name="reset_but" value="Reset" class="body" onClick="reset_entry();">                  </td>
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
              <legend class="legend">Modify Newspaper Information</legend>
              <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="body">
                <tr> 
                  <td width="12%">&nbsp;</td>
                  <td width="19%">&nbsp;</td>
                  <td width="22%"></td>
                  <td width="18%">&nbsp;</td>
                  <td width="29%">&nbsp;</td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td>Newspaper </td>
                  <td><div id="div_newspaper_edit"></div></td>
                  <td><input type="Button" name="view_button" value=" View Details " class="body" onClick="display_newspaper();"></td>
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
              <div id="div_newspaper_details"></div>			  
              </fieldset></td>
            </tr>
          <tr> 
            <td height="21"></td>
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

