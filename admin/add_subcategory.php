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

function load_categories(){
	var urlString = "<?php echo $SERVER_URL; ?>load_values.php?chksql=load_categories";
	var http = getHTTPObject();
	http.open("POST", urlString , true);
	http.onreadystatechange = function() 
	{
		if (http.readyState == 4)
		{
			if (http.status == 200) 
			{
				document.getElementById("category_div").innerHTML = http.responseText;
			} 
			else
			{
				alert("Error Occured : " + http.statusText);
			}
		}
	}
	http.send(null); 
}

function load_edit_categories(){
	var urlString = "<?php echo $SERVER_URL; ?>load_values.php?chksql=load_edit_categories";
	var http = getHTTPObject();
	http.open("POST", urlString , true);
	http.onreadystatechange = function() 
	{
		if (http.readyState == 4)
		{
			if (http.status == 200) 
			{
				document.getElementById("edit_category_div").innerHTML = http.responseText;
			} 
			else
			{
				alert("Error Occured : " + http.statusText);
			}
		}
	}
	http.send(null); 
}

function validate_category_entry()
{
	if(document.getElementById("cateogry_names").value == "")
	{
		document.getElementById("div_subcategory_id").innerHTML = "Please Select the Category";
	}
	else if(document.getElementById("sub_category_name_text").value == "")
	{
		document.getElementById("div_category_name").innerHTML = "Please Enter the Sub Category Name";
	}
	else
	{
		save_category_entry();
	}			
}

function save_category_entry()
{
	var cat = document.getElementById("cateogry_names").value;
	var subcat = document.getElementById("sub_category_name_text").value;
	var urlString = "<?php echo $SERVER_URL; ?>save_values.php?chksql=register_subcategory&category_id="+cat+"&subcategory_name="+subcat;
	
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

function remove_category_name_msg()
{
	if(document.getElementById("div_category_name").innerHTML != "")
	{
		document.getElementById("div_category_name").innerHTML = "";
	}
}

function reset_user_entry()
{
	document.location.reload();
}

function display_categories()
{
	if(document.getElementById("edit_cateogry_names").value == "")
	{
		document.getElementById("error_msg").innerHTML = "Please Select the Category";
		document.getElementById("view_data").style.display = "none";
	}
	else
	{
		document.getElementById("error_msg").innerHTML = "";
		var urlString = "<?php echo $SERVER_URL; ?>load_values.php?chksql=load_subcategory&category_id="+document.getElementById("edit_cateogry_names").value;
		var http = getHTTPObject();
		http.open("POST", urlString , true);
		http.onreadystatechange = function() 
		{
			if (http.readyState == 4)
			{
				if (http.status == 200) 
				{
					document.getElementById("div_sub_category").innerHTML = http.responseText;
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

function load_sub_category_details()
{
	
	var urlString = "<?php echo $SERVER_URL; ?>load_values.php?chksql=edit_subcategory&category_id="+document.getElementById("edit_cateogry_names").value+"&sub_category="+document.getElementById("subcategory_names").value;
	//alert(urlString);
	var http = getHTTPObject();
	http.open("POST", urlString , true);
	http.onreadystatechange = function() 
	{
		if (http.readyState == 4)
		{
			if (http.status == 200) 
			{
				document.getElementById("div_sub_category_dtails").innerHTML = http.responseText;
			} 
			else
			{
				alert("Error Occured : " + http.statusText);
			}
		}
	}
	http.send(null); 	
}

function update_sub_category_details()
{
	var modify_status = false;
	if(document.getElementById("hid_sub_category").value != document.getElementById("mod_sub_category_name").value)
	{
		modify_status = true;
	}
	if(modify_status == true)
	{	
		var urlString = "<?php echo $SERVER_URL; ?>save_values.php?chksql=save_modified_subcategory&category_id="+document.getElementById("hid_category_id").value+"&category_name="+document.getElementById("mod_sub_category_name").value;
						
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
		document.getElementById("modify_msg").innerHTML = "Sub Category details are Not Modified!";
	}	
}

function clear_error_msg()
{
	if(document.getElementById("hid_sub_category").value != document.getElementById("mod_sub_category_name").value)
	{
		document.getElementById("modify_msg").innerHTML = "";
	}
	else
	{
		document.getElementById("modify_msg").innerHTML = "Sub Category details are Not Modified!";
	}
}

function delete_sub_category_details()
{
	var result = confirm("Are u sure! You want to delete the Sub Category - "+document.getElementById("subcategory_names").value+"!");
	if(result)
	{
		var urlString = "<?php echo $SERVER_URL; ?>save_values.php?chksql=delete_subcategory&category_id="+document.getElementById("edit_cateogry_names").value+"&sub_category="+document.getElementById("subcategory_names").value;
						
		alert(urlString);				
		var http = getHTTPObject();
		http.open("POST", urlString , true);
		http.onreadystatechange = function() 
		{
			if (http.readyState == 4)
			{
				if (http.status == 200) 
				{
					document.getElementById("edit_but").disabled = true;
					document.getElementById("delete_subcat_button").disabled = true;
					document.getElementById("view_button").disabled = true;
					document.getElementById("div_sub_category_dtails").innerHTML = "";
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

function check_option(){
	if(document.getElementById("div_subcategory_id").innerHTML != "")
		document.getElementById("div_subcategory_id").innerHTML = "";
}

//-->
</script>
</head>

<body onLoad="loadNewMenu(); load_categories();load_edit_categories();">				
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
                <td class="header_title" height="20">&nbsp;&nbsp;&nbsp;Add | Edit Sub Category</td>
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
            <td width="80%" height="166"><fieldset class="fieldset">
              <legend class="legend">New Sub Category </legend>
              <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="body">
                <tr> 
                  <td width="12%">&nbsp;</td>
                  <td width="19%">&nbsp;</td>
                  <td width="22%">&nbsp;</td>
                  <td width="47%">&nbsp;</td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td class="body">Ad. Category</td>
                  <td><div id="category_div"></div></td>
                  <td><div id="div_subcategory_id" class="error"></div></td>
                </tr>
                <tr> 
                  <td align="right">&nbsp;</td>
                  <td class="body">Sub Category  Name</td>
                  <td><input name="sub_category_name_text" type="text" id="sub_category_name_text" class="body" onChange="remove_category_name_msg();"></td>
                  <td><div id="div_category_name" class="error"></div></td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td colspan="2"><div id="display_message" class="body"></div></td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td><input type="button" name="submit_but" value=" Save " class="body" onClick="validate_category_entry();"> 
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
              <legend class="legend">Modify Sub Category Information</legend>
              <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="body">
                <tr> 
                  <td width="12%">&nbsp;</td>
                  <td width="19%">&nbsp;</td>
                  <td width="22%">&nbsp;</td>
                  <td width="14%">&nbsp;</td>
                  <td width="33%">&nbsp;</td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td>Ad. Category </td>
                  <td><div id="edit_category_div"></div></td>
                  <td><input type="Button" name="view_button" value=" View Details " class="body" onClick="display_categories();"></td>
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
                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="body">
                  <tr> 
                    <td width="12%">&nbsp;</td>
                    <td width="19%">Sub Category</td>
                    <td width="22%"><div id="div_sub_category"></div></td>
                    <td width="14%"><input name="edit_but" type="button" id="edit_but" value="  Edit Details  " class="body" onClick="load_sub_category_details();"></td>
                    <td width="33%"><input name="delete_subcat_button" type="button" id="delete_subcat_button" value="  Delete Sub Category " class="body" onClick="delete_sub_category_details();"></td>
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
            <td height="21"><div id="div_sub_category_dtails"></div></td>
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

