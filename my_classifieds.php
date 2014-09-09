<?php 
	include_once ("config/config.php");
	
	if($_SESSION["ses_user_name"] == null || $_SESSION["ses_user_name"] == ""){
		session_destroy();
		header("Location:login.php");
	}
?>
<html>
<head>
<title>On-Line Newspaper Advertisement Submition Agent...</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" title="core css file" charset="utf-8" />
<script src="scripts/XMLHTTP.js" type="text/javascript"></script>
<script type="text/javascript">

function initiateEntry(){
	loadClassifieds();
}


function loadClassifieds(){
	var urlString = "<?php echo $SERVER_URL; ?>ad.logic.php?chksql=loadClassifieds";
	var http = getHTTPObject();
	http.open("GET", urlString , true);
	http.onreadystatechange = function() {
		if (http.readyState == 4){
			if (http.status == 200) {
				var result = http.responseText;
				document.getElementById("ads_div").innerHTML = result;
			} else{
				alert("Error Occured : " + http.statusText);
			}
		}
	}
	http.send(null);
}


function loadInq(lno){
	var id = document.getElementById("id"+lno).value;
	if(navigator.appName == "Microsoft Internet Explorer"){
		document.location.href("<?php echo $SERVER_URL; ?>ad_inquiry.php?id="+id);
	}else{
		window.location = "<?php echo $SERVER_URL; ?>ad_inquiry.php?id="+id;
	}
}
</script>

</head>
<body onLoad="initiateEntry();">
<?php include_once("header.php"); ?>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="739">
  <tr>
    <td> 
      <table bgcolor="#FFFFFF" width="950" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td width="5%">&nbsp;</td>
          <td width="90%" valign="top"><div id="ads_div"></div></td>
          <td width="5%">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
	</td>
  </tr>
</table>
<?php include_once("footer.php"); ?>
</body>
</html>