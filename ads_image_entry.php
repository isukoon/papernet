<?php 
	include_once ("config/config.php");
	
	
?>
<html>
<head>
<title>On-Line Newspaper Advertisement Submition Agent...</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" title="core css file" charset="utf-8" /> 
<link rel="stylesheet" type="text/css" href="css/uploadstyles.css" />
<link rel="stylesheet" href="css/ui.datepicker.css" type="text/css" media="screen" title="core css file" charset="utf-8" />
<link rel="stylesheet" href="css/messages.css" type="text/css" media="screen" title="core css file" charset="utf-8" />

<script src="scripts/XMLHTTP.js" type="text/javascript"></script>
<script src="scripts/jquery.js" type="text/javascript" charset="utf-8"></script>	
<script src="scripts/messages.js" type="text/javascript" charset="utf-8"></script>
<script src="scripts/jquery-1.3.2.js" type="text/javascript"></script>
<script src="scripts/ajaxupload.3.5.js" type="text/javascript"></script>
<script src="scripts/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">

jQuery(function($){
$("#publish_date").datepicker({minDate: 1});
});

function initiateEntry(){
	getImageAdID();
	loadNewspapers();
	loadNewspapers1();
	loadNewspapers2();
	setDefaultDate();
}

function getImageAdID(){
	var urlString = "<?php echo $SERVER_URL;?>ad.logic.php?chksql=getImageAdID";
	var http = getHTTPObject();
	http.open("GET", urlString , true);
	http.onreadystatechange = function() {
		if (http.readyState == 4){
			if (http.status == 200) {
				document.getElementById("ad_id").value = trim(http.responseText);
			}else{
				alert("Error Occured : " + http.statusText);
			}
		}
	}
	http.send(null); 		
}

function calculateAmount(){
	var size = document.getElementById("size_select").value;
	var page = document.getElementById("page_select").value;
	
	if(size != "-" && page != "-"){
		var urlString = "<?php echo $SERVER_URL;?>ad.logic.php?chksql=calculateImageAmount&size="+size+"&page="+page;
		var http = getHTTPObject();
		http.open("GET", urlString , true);
		http.onreadystatechange = function() {
			if (http.readyState == 4){
				if (http.status == 200) {
					document.getElementById("amount_div").innerHTML = trim(http.responseText);
				}else{
					alert("Error Occured : " + http.statusText);
				}
			}
		}
		http.send(null); 	
	}
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
	document.getElementById("publish_date").value = month+"/"+day+"/"+year;
}

function validate(){
	var id = document.getElementById("ad_id").value;
	var size = document.getElementById("size_select").value;
	var page = document.getElementById("page_select").value;
	var newspaper = document.getElementById("newspaper").value;
	var publish_date = document.getElementById("publish_date").value;
	var image = document.getElementById("files").innerHTML;
	var amount = document.getElementById("amount_div").innerHTML;
	
	if(newspaper == "-"){
		inlineMsg('newspaper','<strong>Error</strong><br />Please select the Newspaper!',2);
	} else if(size == "-"){
		inlineMsg('size_select','<strong>Error</strong><br />Please select the Size!',2);
	}else if(page == "-"){
		inlineMsg('page_select','<strong>Error</strong><br />Please select the Page!',2);
	}else if(image == ""){
		inlineMsg('upload','<strong>Error</strong><br />Please Upload the image!',2);
	}else{
		var urlString = "<?php echo $SERVER_URL; ?>ad.logic.php?chksql=saveImageAd&id="+id+"&size="+size+"&page="+page+
						"&newspaper="+newspaper+"&publish_date="+publish_date+"&amount="+amount;
		//alert(urlString);
		var http = getHTTPObject();
		http.open("POST", urlString , true);
		http.onreadystatechange = function() {
			if (http.readyState == 4){
				if (http.status == 200) {
					var result = http.responseText;
					//alert(result);
					if(result.indexOf("ERROR") > -1){
						alert("Error Occured! Please Try Again!");
					}else{
						if(navigator.appName == "Microsoft Internet Explorer"){
							document.location.href("<?php echo $SERVER_URL; ?>images_preview.php?id="+id);
						}else{
							window.location = "<?php echo $SERVER_URL; ?>images_preview.php?id="+id;
						}	
					}
				} else{
					alert("Error Occured : " + http.statusText);
				}
			}
		}
		http.send(null);

	}
}


function startUpload(){
	var ad_id =  document.getElementById("ad_id").value;	
	//alert(ad_id);
	var btnUpload=$('#upload');
	var status=$('#status');
	new AjaxUpload(btnUpload, {
		action: 'upload.php',
		name: 'uploadfile',
		onSubmit: function(file, ext){
			 if (! (ext && /^(jpg|png|jpeg|gif|pdf|doc)$/.test(ext))){ 
				status.text('Invalid File Type');
				return false;
			}
			this.setData({'vid': ad_id});
			document.getElementById("loading_div").innerHTML = "Uploading...<img src='images/loading.gif'>";
		},
		onComplete: function(file, response){
			document.getElementById("loading_div").innerHTML = "";
			var folderName = '';
			var extension = '';
			folderName = document.getElementById("ad_id").value;
			extension = file.substring(file.indexOf("."),file.length);
			if(response.indexOf("success") > -1){
				var files = response.substring(response.indexOf("#")+1,response.length - 1);
				loadFiles(files);
			} else{
				alert(response);
			}
		}
	});	
}
	
function loadFiles(paths){
	var m_files =  '';
	m_files = trim(paths).split('@');	
	document.getElementById("files").innerHTML = "";
	var displayFiles = '';
	//var ad_id =  document.getElementById("hid_upload_id").value;	
	for(i = 0;i<= m_files.length-1; i++){		
		var url = '';
		var name = '';
		url = trim(m_files[i]).replace("./","");
		name = url.substring(url.lastIndexOf("/")+1,url.length);
		displayFiles = displayFiles + "<a href='<?php echo $SERVER_URL; ?>"+url+"'>"+name+"</a><br>";
	}	
	document.getElementById("files").innerHTML = displayFiles;
}	

function resetPage(){
	document.location.reload();
}

function randomString() {
	var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
	var string_length = 8;
	var randomstring = '';
	for (var i=0; i<string_length; i++) {
		var rnum = Math.floor(Math.random() * chars.length);
		randomstring += chars.substring(rnum,rnum+1);
	}
	return randomstring;
}

function trim(str, chars) {
	return ltrim(rtrim(str, chars), chars);
}
 
function ltrim(str, chars) {
	chars = chars || "\\s";
	return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
}
 
function rtrim(str, chars) {
	chars = chars || "\\s";
	return str.replace(new RegExp("[" + chars + "]+$", "g"), "");
}

function loadNewspapers() {
	var urlString = "<?php echo $SERVER_URL; ?>ad.logic.php?chksql=load_newspapers";
	var http = getHTTPObject();
	http.open("POST", urlString , true);
	http.onreadystatechange = function() {
		if (http.readyState == 4) {
			if (http.status == 200){
				document.getElementById("newspapers_div").innerHTML = http.responseText;
			} else {
				alert("Error Occured : " + http.statusText);
			}
		}
	}
	http.send(null); 	
}
function loadNewspapers1() {
	var urlString = "<?php echo $SERVER_URL; ?>ad.logic.php?chksql=load_newspapers";
	var http = getHTTPObject();
	http.open("POST", urlString , true);
	http.onreadystatechange = function() {
		if (http.readyState == 4) {
			if (http.status == 200){
				document.getElementById("newspapers_div1").innerHTML = http.responseText;
			} else {
				alert("Error Occured : " + http.statusText);
			}
		}
	}
	http.send(null); 	
}
function loadNewspapers2() {
	var urlString = "<?php echo $SERVER_URL; ?>ad.logic.php?chksql=load_newspapers";
	var http = getHTTPObject();
	http.open("POST", urlString , true);
	http.onreadystatechange = function() {
		if (http.readyState == 4) {
			if (http.status == 200){
				document.getElementById("newspapers_div2").innerHTML = http.responseText;
			} else {
				alert("Error Occured : " + http.statusText);
			}
		}
	}
	http.send(null); 	
}
</script>

</head>
<body onLoad="initiateEntry(); ">
<input type="hidden" name="ad_id" id="ad_id" value="">
<?php include_once("header.php"); ?>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="739">
  <tr>
    <td> 
      <table bgcolor="#FFFFFF" width="950" height="501" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td width="5%" height="469"></td>
          <td width="90%" valign="top"><fieldset>
            <legend class="text"><font color="blue">Advertisement Details</font></legend>				
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			  <tr>
			    <td width="5%">&nbsp;</td>
			    <td width="34%">&nbsp;</td>
			    <td width="37%">&nbsp;</td>
			    <td width="19%">&nbsp;</td>
			    <td width="5%">&nbsp;</td>
			  </tr>
			  <tr>
			    <td>&nbsp;</td>
			    <td class="text">Newspapers</td>
			    <td class="text"><div id="newspapers_div"></div></td>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
				<td class="text"><div id="newspapers_div1"></div></td>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
				<td class="text"><div id="newspapers_div2"></div></td>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
			  </tr>
			  <tr>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
			    <td></td>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
			  </tr>
			  <tr>
			    <td>&nbsp;</td>
			    <td class="text">Image Size</td>
			    <td><select name="size_select" id="size_select" class="text" onChange="calculateAmount();">
			      <option value="-">-- Please Select --</option>
			      <option value="FULL">Full Page</option>
			      <option value="HALF">Half Page</option>
			      <option value="QUARTER">Quarter Page</option>
			      </select>			    </td>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
			  </tr>
			  <tr>
			    <td>&nbsp;</td>
			    <td class="text">&nbsp;</td>
			    <td></td>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
			  </tr>
			  <tr>
			    <td>&nbsp;</td>
                <td><span class="text">Page</span></td>
			    <td class="text"><select name="page_select" id="page_select" class="text" onChange="calculateAmount();">
			      <option value="-">-- Please Select --</option>
			      <option value="FRONT">Front Page</option>
			      <option value="BACK">Back Page</option>
			      <option value="INNER">Inner Page</option>
                </select></td>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
		      </tr>
			  <tr>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
                <td>&nbsp;</td>
		      </tr>
			  <tr>
			    <td>&nbsp;</td>
			    <td class="text">Amount</td>
			    <td class="text"><div id="amount_div">0.00</div></td>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
		      </tr>
			  <tr>
			    <td>&nbsp;</td>
			    <td class="text">&nbsp;</td>
			    <td class="text">&nbsp;</td>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
		      </tr>
			  <tr>
			    <td>&nbsp;</td>
			    <td class="text">Published Date </td>
			    <td class="text"><input type="text"  name="publish_date" id="publish_date" value="click to select" class="text" size="20">&nbsp;MM/DD/YYYY</td>
			    <td>&nbsp;</td>
                <td>&nbsp;</td>
		      </tr>
			  <tr>
			    <td>&nbsp;</td>
			    <td class="text">&nbsp;</td>
			    <td class="text"></td>
			    <td>&nbsp;</td>
                <td>&nbsp;</td>
		      </tr>
			  
			  
			  <tr>
			    <td>&nbsp;</td>
			    <td class="text">Upload Advertisement</td>
			    <td class="text"><div id="upload" onClick="startUpload();">Upload Images</div></td>
			    <td><div id="loading_div" class="text"></div></td>
			    <td>&nbsp;</td>
		      </tr>
			  <tr>
			    <td>&nbsp;</td>
			    <td class="text">&nbsp;</td>
			    <td colspan="2" class="text"><ul id="files" class="text"></ul></td>
			    <td>&nbsp;</td>
		      </tr>
			  <tr>
			    <td>&nbsp;</td>
			    <td class="text">&nbsp;</td>
			    <td colspan="2" class="text"><div id="display_message" class="text"></div></td>
			    <td>&nbsp;</td>
		      </tr>
			  <tr>
			    <td>&nbsp;</td>
			    <td class="text">&nbsp;</td>
			    <td class="text"><input type="button" name="button" id="button" value="Reset" class="text" onClick="resetPage();">
		        <input type="button" name="button2" id="button2" value="Save &amp; Preview Ad" class="text" onClick="validate();"></td>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
		      </tr>
			  <tr>
			    <td>&nbsp;</td>
			    <td class="text">&nbsp;</td>
			    <td class="text">&nbsp;</td>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
		      </tr>
			</table>
            </fieldset>
          </td>
          <td width="5%">&nbsp;</td>
        </tr>
      </table>
	</td>
  </tr>
</table>
<?php include_once("footer.php"); ?>
</body>
</html>