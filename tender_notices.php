<?php
	include_once ("config/config.php");
?>
<html>
<head>
<title>On-Line Newspaper Advertisement Submition Agent...</title>
<html>
<meta http-equiv="Content-Type"	content="text/html; charset=windows-1251">
<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" title="core css file" charset="utf-8" />
<link rel="stylesheet" type="text/css" href="css/slideshow.css">
<link rel="stylesheet" href="css/jd.gallery1.css" type="text/css" media="screen" charset="utf-8" />
<link rel="stylesheet" href="css/ui.datepicker.css" type="text/css" media="screen" title="core css file" charset="utf-8" />

<script src="scripts/XMLHTTP.js" type="text/javascript"></script>
<script src="scripts/jquery.js" type="text/javascript" charset="utf-8"></script>	
<script src="scripts/mootools-1.2.1-core-yc.js" type="text/javascript"></script>
<script src="scripts/mootools-1.2-more.js" type="text/javascript"></script>
<script src="scripts/jd.gallery.js" type="text/javascript"></script>
<script src="scripts/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>
<script language="JavaScript">

jQuery(function($){
$("#publish_date_from").datepicker();
$("#publish_date_to").datepicker();
});

function initiateEntry(){
	setDefaultDate();
	loadSlideShow();
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
	document.getElementById("publish_date_from").value = month+"/"+day+"/"+year;
	document.getElementById("publish_date_to").value = month+"/"+day+"/"+year;
}

function loadSlideShow(){
	var from_date = document.getElementById("publish_date_from").value;
	var to_date = document.getElementById("publish_date_to").value;
	var cat =document.getElementById("cat_select").value;
	var urlString = "<?php echo $SERVER_URL;?>ad.logic.php?chksql=loadSlideShow&cat="+cat+"&fdate="+from_date+"&tdate="+to_date;
	var http = getHTTPObject();
	http.open("POST", urlString , true);
	http.onreadystatechange = function() {
		if (http.readyState == 4){
			if (http.status == 200) {
				document.getElementById("myGallery").innerHTML = http.responseText;
				startGallery();
			}else{
				alert("Error Occured : " + http.statusText);
			}
		}
	}
	http.send(null);
}


function startGallery() {
	//alert("call");
	var myGallery = new gallery($('myGallery'), {
	timed: true
	});
}

		
</script>

</head>
<body onLoad="initiateEntry();">
<table align="center" width="950" border="0" cellspacing="0" cellpadding="0" class="text">
  
  
  <tr>
    <td><?php require_once("header.php"); ?></td>
  </tr>
  <tr>
    <td><table bgcolor="#FFFFFF" width="100%" border="0" cellspacing="0" cellpadding="0" class="text">
      <tr>
        <td width="10%">&nbsp;</td>
        <td width="80%">&nbsp;</td>
        <td width="10%">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><select name="cat_select" id="cat_select" class="text" onChange="loadSlideShow();">
          <option value="-">-- Please Select --</option>
          <option value="Governement" selected>Governement</option>
          <option value="Private Sector">Private Sector</option>
        </select>
        - Publish Date From
        <input type="text" name="publish_date_from" id="publish_date_from" value="click to select" class="text" size="20" onChange="loadSlideShow();"> 
        To
        <input type="text" name="publish_date_to" id="publish_date_to" value="click to select" class="text" size="20" onChange="loadSlideShow();"></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>
        <div class="content">
        	<div id="myGallery"></div>
        </div>        </td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><?php require_once("footer.php"); ?></td>
  </tr>
</table>
</body>
</html>
