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
<link rel="stylesheet" type="text/css" href="css/uploadstyles.css" />
<link rel="stylesheet" href="css/ui.datepicker.css" type="text/css" media="screen" title="core css file" charset="utf-8" />
<link rel="stylesheet" href="css/messages.css" type="text/css" media="screen" title="core css file" charset="utf-8" />

<script src="scripts/XMLHTTP.js" type="text/javascript"></script>
<script src="scripts/jquery.js" type="text/javascript" charset="utf-8"></script>	
<script src="scripts/messages.js" type="text/javascript" charset="utf-8"></script>
<script src="scripts/jquery-1.3.2.js" type="text/javascript"></script>
<script src="scripts/ajaxupload.3.5.js" type="text/javascript"></script>

<script type="text/javascript">

function init(){
	getTenderNoticeID();
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

function getTenderNoticeID(){
	var urlString = "<?php echo $SERVER_URL;?>ad.logic.php?chksql=getTenderNoticeID";
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
		displayFiles = displayFiles + "<img src='<?php echo $SERVER_URL;?>"+url+"' /><br>";
	}	
	document.getElementById("files").innerHTML = displayFiles;
}	

function resetPage(){
	document.location.reload();
}

function validateEntry(){
	var id = document.getElementById("ad_id").value;
	var cat = document.getElementById("cat_select").value;
	var files = document.getElementById("files").innerHTML;
				
	if(cat == "-"){
		inlineMsg('cat_select','<strong>Error</strong><br />Please select the Category!',2);
	}else if(files == ""){
		inlineMsg('upload','<strong>Error</strong><br />Please upload the Tender Notice!',2);
	}else{
		var urlString = "<?php echo $SERVER_URL; ?>ad.logic.php?chksql=saveTenderNotice&id="+id+"&cat="+cat;
		//alert(urlString);
		var http = getHTTPObject();
		http.open("POST", urlString , true);
		http.onreadystatechange = function() {
			if (http.readyState == 4){
				if (http.status == 200) {
					var result = http.responseText;
					//document.getElementById("files").innerHTML = result;
					
					if(result.indexOf("ERROR") > -1){
						alert("Error Occured! Please Try Again!");
					}else{
						if(navigator.appName == "Microsoft Internet Explorer"){
							document.location.href("<?php echo $SERVER_URL; ?>ad_payment.php?id="+id+"&type=TENDER");
						}else{
							window.location = "<?php echo $SERVER_URL; ?>ad_payment.php?id="+id+"&type=TENDER";
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

</script>

</head>
<body onLoad="init();">
<input type="hidden" name="ad_id" id="ad_id" value="">
<?php include_once("header.php"); ?>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="739">
  <tr>
    <td> 
      <table bgcolor="#FFFFFF" width="950" height="402" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td width="5%" height="370"></td>
          <td width="90%" valign="top"><fieldset>
            <legend class="text"><font color="blue">Online Ad Details</font></legend>				
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			  <tr>
			    <td width="5%">&nbsp;</td>
			    <td width="34%">&nbsp;</td>
			    <td width="28%">&nbsp;</td>
			    <td width="28%">&nbsp;</td>
			    <td width="5%">&nbsp;</td>
			  </tr>
			  
			  <tr>
			    <td>&nbsp;</td>
			    <td class="text">Category</td>
			    <td><select name="cat_select" id="cat_select" class="text">
                	<option value="-">-- Please Select --</option>
                	<option value="Governement">Governement</option>
                	<option value="Private Sector">Private Sector</option>
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
			    <td class="text">Upload Online Ad Image</td>
			    <td class="text"><div id="upload" onClick="startUpload();">Upload Images</div></td>
			    <td><div id="loading_div" class="text"></div></td>
			    <td>&nbsp;</td>
		      </tr>
			  <tr>
			    <td>&nbsp;</td>
			    <td colspan="2" class="text"><ul id="files" class="text"></ul></td>
			    <td>&nbsp;</td>
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
		        <input type="button" name="button2" id="button2" value="Add Online Ad" class="text" onClick="validateEntry();"></td>
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