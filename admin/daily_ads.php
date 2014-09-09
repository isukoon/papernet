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
jQuery(function($){
$("#req_date").datepicker();
$("#to_date").datepicker();
});

function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);

function setCursor(){
	setDefaultDate();
	loadAdsByDate();
}

function setDefaultDate(){
	var currentDate = new Date();
	var month = currentDate.getMonth()+1;
	var day = currentDate.getDate();
	var year = currentDate.getFullYear();	
	//alert(String(month).length);
	if(String(month).length == 1){
		month = "0"+month;
	}if(String(day).length == 1){
		day = "0"+day;
	}		
	document.getElementById("req_date").value = month+"/"+day+"/"+year;
	document.getElementById("to_date").value = month+"/"+day+"/"+year;
}


function loadAdsByDate(){
	document.getElementById("item_list_div").innerHTML = "<img src='images/loading.gif'>";
	var date = document.getElementById("req_date").value;
	var to_date = document.getElementById("to_date").value;
	var type = document.getElementById("ad_type").value;
	var news = document.getElementById("edit_newspapers_select").value;
	var urlString = "<?php echo $SERVER_URL; ?>admin.logic.php?chksql=loadAdsByDate&date="+date+"&tdate="+to_date+"&type="+type+"&news="+news;
	//alert(urlString);
	var http = getHTTPObject();
	http.open("POST", urlString , true);
	http.onreadystatechange = function() {
		if (http.readyState == 4){
			if (http.status == 200) {
				var result = http.responseText;
				document.getElementById("serach_result_div").style.display="inline";
				document.getElementById("legend_div").innerHTML = "All Ads By Date";
				document.getElementById("item_list_div").innerHTML = "";
				document.getElementById("item_list_div").innerHTML = result;						
			} else{
				alert("Error Occured 1: " + http.statusText);
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

function generatePDF(){
	
	var date = document.getElementById("req_date").value;
	var to_date = document.getElementById("to_date").value;
	var type = document.getElementById("ad_type").value;
	var news = document.getElementById("edit_newspapers_select").value;
	
	if(navigator.appName == "Microsoft Internet Explorer"){
	document.location.href("<?php echo $SERVER_URL; ?>ad_rpt.php?date="+date+"&tdate="+to_date+"&type="+type+"&news="+news);
	}else{
	window.location = "<?php echo $SERVER_URL; ?>ad_rpt.php?date="+date+"&tdate="+to_date+"&type="+type+"&news="+news;
	}
}

function generateSummaryPDF(){
	if(navigator.appName == "Microsoft Internet Explorer"){
		document.location.href("<?php echo $SERVER_URL; ?>ad_summary_rpt.php");
	}else{
		window.location = "<?php echo $SERVER_URL; ?>ad_summary_rpt.php";
	}
}

function resetPage(){
	document.location.reload();
}				
</script>
</head>				
				
<body onLoad="loadNewMenu(); get_edit_newspapers(); setCursor();">	
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
                <td class="header_title" height="20">&nbsp;&nbsp;&nbsp;Daily Advertisements</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td width="98%">&nbsp;</td>
                <td width="2%">&nbsp;</td>
              </tr>
              
              <tr>
                <td>
                <fieldset class="fieldset">
                <legend class="legend">Filter Ads By Date</legend>
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="body">
                  <tr>
                    <td width="4%">&nbsp;</td>
                    <td width="16%">&nbsp;</td>
                    <td width="23%">&nbsp;</td>
                    <td width="10%">&nbsp;</td>
                    <td width="42%">&nbsp;</td>
                    <td width="5%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><strong>Search By</strong></td>
                    <td>&nbsp;</td>
                    <td valign="middle">&nbsp;</td>
                    <td valign="middle">&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                                   
                  <tr>
                    <td>&nbsp;</td>
                    <td>Request Date              From</td>
                    <td><input name="req_date" type="text" class="body" id="req_date">&nbsp;&nbsp;</td>
                    <td valign="middle">To</td>
                    <td valign="middle"><input name="to_date" type="text" class="body" id="to_date"></td>
                    <td>&nbsp;</td>
                  </tr>                  
                  
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td valign="middle">&nbsp;</td>
                    <td valign="middle">&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Advertisement Type</td>
                    <td><select name="ad_type" id="ad_type">
                      <option value="CLASSIFIED">Classified</option>
                      <option value="IMAGE">Image</option>
                      <option value="ALL" selected>-- All --</option>
                      </select></td>
                    <td valign="middle">Newspaper</td>
                    <td valign="middle"><div id="newspapers_div"></div></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td valign="middle">&nbsp;</td>
                    <td valign="middle">&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><input type="button" name="find_but" id="find_but" value=" Find " class="body" onClick="loadAdsByDate();">
                      <input type="button" name="reset_but1" id="reset_but1" value="Reset" class="body" onClick="resetPage();"></td>
                    <td>&nbsp;</td>
                    <td><input name="Button" type="button" class="body" id="button" value="Generate PDF" onClick="generatePDF();">
                      <input name="button" type="button" class="body" id="button2" value="Generate Summary PDF" onClick="generateSummaryPDF();"></td>
                    <td>&nbsp;</td>
                  </tr>                  
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </table>
                </fieldset>                </td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>
                <div id="serach_result_div" style="display:none">
                <fieldset class="fieldset">
                <legend class="legend"><div id="legend_div"></div></legend>
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="body">
                  <tr>
                    <td width="1%">&nbsp;</td>
                    <td width="98%">&nbsp;</td>
                    <td width="1%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><div id="item_list_div"></div></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </table>
                </fieldset>  
                </div>                </td>
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

