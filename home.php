<?php
	include_once ("config/config.php");
?>
<html>
<head>
<title>On-Line Newspaper Advertisement Submition Agent...</title>
<html>
<meta http-equiv="Content-Type"	content="text/html; charset=windows-1251">
<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" title="core css file" charset="utf-8" />
<link rel="stylesheet" href="css/ui.datepicker.css" type="text/css" media="screen" title="core css file" charset="utf-8" />
<link rel="stylesheet" href="css/messages.css" type="text/css" media="screen" title="core css file" charset="utf-8" />
<link rel="stylesheet" href="css/scroller.css" type="text/css" media="screen" title="core css file" charset="utf-8" />
<link rel="stylesheet" type="text/css" href="css/slideshow.css">

<script src="scripts/scroller.js" type="text/javascript"></script>
<script src="scripts/XMLHTTP.js" type="text/javascript"></script>
<script src="scripts/jquery.js" type="text/javascript" charset="utf-8"></script>	
<script src="scripts/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>
<script src="scripts/messages.js" type="text/javascript" charset="utf-8"></script>
<script src="scripts/mootools-1.3.2-core.js" type="text/javascript" charset="utf-8"></script>
<script src="scripts/mootools-1.3.2.1-more.js" type="text/javascript" charset="utf-8"></script>
<script src="scripts/slideshow.js" type="text/javascript" charset="utf-8"></script>
<script src="scripts/slideshow.flash.js" type="text/javascript" charset="utf-8"></script>

<script language="JavaScript">

	window.addEvent('domready', function(){
			var data = { '1.jpg': { }, 
						 '2.jpg': { }, 
						 '3.jpg': { }}; 
		new Slideshow.Flash('flash', data, { color: ['#fff', '#fff', '#fff'], height: 250, hu: 'images/', width: 640 });
	});	

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
							resetPage();							
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
	
	function loadTextAdvertisementEntry(){
		if(navigator.appName == "Microsoft Internet Explorer"){
			document.location.href("<?php echo $SERVER_URL; ?>ads_entry.php");
		}else{
			window.location = "<?php echo $SERVER_URL; ?>ads_entry.php";
		}		
	}
	
	function loadImageAdvertisementEntry(){
		if(navigator.appName == "Microsoft Internet Explorer"){
			document.location.href("<?php echo $SERVER_URL; ?>ads_image_entry.php");
		}else{
			window.location = "<?php echo $SERVER_URL; ?>ads_image_entry.php";
		}		
	}	
	
	function loadTenderNoticeEntry(){
		if(navigator.appName == "Microsoft Internet Explorer"){
			document.location.href("<?php echo $SERVER_URL; ?>tenders_notice_entry.php");
		}else{
			window.location = "<?php echo $SERVER_URL; ?>tenders_notice_entry.php";
		}		
	}
	
	function searchKeyPress(e){
		if (window.event) { e = window.event; }
		if (e.keyCode == 13){
			validateLogin();
		}
	}		
		
	function resetPage(){
		document.location.reload();
	}		
</script>

<style type="text/css">
<!--
.style1 {
	font-size: 16px;
	color: #0033CC;
	font-weight: bold;
}
.style2 {font-size: 16px}
-->
</style>
</head>
<body>
<table align="center" width="950" border="0" cellspacing="0" cellpadding="0" class="text">
  <tr>
    <td><?php require_once("header.php"); ?></td>
  </tr>
  <tr>
    <td>
      <table bgcolor="#FFFFFF" width="950" border="0" cellspacing="0" cellpadding="0" class="text">
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="300" valign="top" class="loginborder">
        <?php if($_SESSION["ses_user_name"] == null || $_SESSION["ses_user_name"] == ""){ ?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="text">
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td colspan="2" class="style1">Welcome GUEST!</td>
            </tr>
          <tr>
            <td width="12%" height="36">&nbsp;</td>
            <td width="30%">&nbsp;</td>
            <td width="58%">&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
           
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
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
           
          </tr>
          <tr>
            <td>&nbsp;</td>
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
        </table>
        <?php } else {?>
		<table width="100%" border="0" cellpadding="0" cellspacing="0" class="text">
			<tr>
				<td colspan="2" align="center"></td>
			</tr>
			<tr>
			  <td>&nbsp;</td>
			  <td class="text">&nbsp;</td>
			  </tr>
			<tr>
				<td width="12%">&nbsp;</td>
				<td width="88%" class="style1">Welcome <?php echo $_SESSION["ses_user_name"]; ?> !</td>
			  </tr>
			<tr>
			  <td colspan="2">&nbsp;</td>
			  </tr>
			<tr>
			  <td>&nbsp;</td>
			  <td><p><a href="register.php">Update Profile</a><br>
			    <br>
			    <a href="my_classifieds.php">View My Classifieds</a><br>
			    <br>
			    <a href="my_imageAds.php">View My Image Ads</a><br>
			    <br>
			    <a href="logout.php">Logout</a></p></td>
			  </tr>            
			<tr>
			  <td colspan="2">&nbsp;</td>
			  </tr>
			<tr>
			  <td colspan="2">&nbsp;</td>
			  </tr>            
			<tr>
			  <td colspan="2">&nbsp;</td>
			  </tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			  </tr>
		    <tr>
			 	<td colspan="2">&nbsp;</td>
			  </tr>
		</table>						
        <?php } ?>        </td>
        <td width="5">&nbsp;</td>
        <td width="645" valign="top">        
                    <div id="flash" class="slideshow">
                        <img src="images/1.jpg" alt="1">   
                        <div class="slideshow-controller" />                    </div>        </td>
      </tr>
      
      <tr>
        <td colspan="3"><hr></td>
        </tr>
      
      <tr>
        <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center" style="cursor:pointer" class="imageborder"><img src="images/classified.jpg" width="300" height="140" onClick="loadTextAdvertisementEntry();"/></td>
            <td align="center" style="cursor:pointer" class="imageborder"><img src="images/image.jpg" width="300" height="140" onClick="loadImageAdvertisementEntry();" /></td>
            <td align="center" style="cursor:pointer" class="imageborder"><img src="images/tender.jpg" width="300" height="140" onClick="loadTenderNoticeEntry();" /></td>
          </tr>
        </table></td>
        </tr>
      
      <tr>
        <td colspan="3">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><?php require_once("footer.php"); ?></td>
  </tr>
</table>
</body>
</html>
