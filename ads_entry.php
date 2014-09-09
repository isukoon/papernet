<?php 
	include_once ("config/config.php");
	
	
?>
<html>
<head>
<title>On-Line Newspaper Advertisement Submition Agent...</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" title="core css file" charset="utf-8" />
<link rel="stylesheet" href="css/ui.datepicker.css" type="text/css" media="screen" title="core css file" charset="utf-8" />
<link rel="stylesheet" href="css/messages.css" type="text/css" media="screen" title="core css file" charset="utf-8" />
<link rel="stylesheet" type="text/css" href="css/uploadstyles.css" />

<script src="scripts/XMLHTTP.js" type="text/javascript"></script>
<script src="scripts/jquery.js" type="text/javascript" charset="utf-8"></script>	
<script src="scripts/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>
<script src="scripts/messages.js" type="text/javascript" charset="utf-8"></script>
<script src="scripts/ajaxupload.3.5.js" type="text/javascript"></script>
<script type="text/javascript">

jQuery(function($){
$("#publish_date").datepicker({minDate: 1});
}); 

function initiateEntry(){
	getAdID();
	load_categories();
	loadNewspapers();
	loadNewspapers1();
	loadNewspapers2();
	setDefaultDate();
}

function getAdID(){
	var urlString = "<?php echo $SERVER_URL;?>ad.logic.php?chksql=getAdID";
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

function saveAd(){
	var id = document.getElementById("ad_id").value;
	var cat = document.getElementById("category_select").value;
	var subcat = document.getElementById("sub_cat_select").value;
	var newspaper = document.getElementById("newspaper").value;
	var text_ad = document.getElementById("text_ad").value;
	var pub_date = document.getElementById("publish_date").value;
	var amount = document.getElementById("amount").value;
	var amount1 = document.getElementById("amount1").value;
	var amount2 = document.getElementById("amount2").value;
	
	var image = document.getElementById("files").innerHTML;
	/*
	var newspapers = "";
	if(paper1)
		newspapers = "Daily News";
	if(paper2)
		newspapers = "Sunday Observer";
	if(paper1 && paper2)
		newspapers = "Daily News,Sunday Observer";
	*/			
	if(cat == "-"){
		inlineMsg('category_select','<strong>Error</strong><br />Please select the Category!',2);
	}else if(subcat == "-"){
		inlineMsg('sub_cat_select','<strong>Error</strong><br />Please select the Sub Category!',2);
	}else if(text_ad == ""){
		inlineMsg('text_ad','<strong>Error</strong><br />Please enter the Advertisement!',2);
	}else if(newspaper == "-"){
		inlineMsg('newspaper','<strong>Error</strong><br />Please select the Newspaper!',2);
	}else{
		var urlString = "<?php echo $SERVER_URL; ?>ad.logic.php?chksql=saveAd&id="+id+"&cat="+cat+"&sub_cat="+subcat+"&pub_date="+pub_date+
						"&ad="+text_ad+"&total="+amount+"&newspaper="+newspaper+"&image="+image;
		
		var urlString1 = "<?php echo $SERVER_URL; ?>ad.logic.php?chksql=saveAd&id="+id+"&cat="+cat+"&sub_cat="+subcat+"&pub_date="+pub_date+
						"&ad="+text_ad+"&total="+amount1+"&newspaper="+newspaper+"&image="+image;
		
		var urlString2 = "<?php echo $SERVER_URL; ?>ad.logic.php?chksql=saveAd&id="+id+"&cat="+cat+"&sub_cat="+subcat+"&pub_date="+pub_date+
						"&ad="+text_ad+"&total="+amount2+"&newspaper="+newspaper+"&image="+image;
		
		
		//alert(urlString);
		var http = getHTTPObject();
		http.open("POST", urlString , true);
		http.open("POST", urlString1 , true);
		http.open("POST", urlString2 , true);
		
		http.onreadystatechange = function() {
			if (http.readyState == 4){
				if (http.status == 200) {
					var result = http.responseText;
					//alert(result);
					if(result.indexOf("ERROR") > -1){
						alert("Error Occured! Please Try Again!");
					}else{
						if(navigator.appName == "Microsoft Internet Explorer"){
							document.location.href("<?php echo $SERVER_URL; ?>ads_preview.php?id="+result);
						}else{
							window.location = "<?php echo $SERVER_URL; ?>ads_preview.php?id="+result;
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

function checkLength(){
	//alert("call");
	var count = getWordCount();
	document.getElementById("no_of_words_div").innerHTML = count;
	var text_ad = document.getElementById("text_ad").value;	
	if(count > 45){
	    document.getElementById("max_words_warning_div").innerHTML = "You have exceed the maximum no. of words.";
		document.getElementById("text_ad").value = text_ad.substring(0,text_ad.lastIndexOf(" "));
	}else{
		document.getElementById("max_words_warning_div").innerHTML = "";
	}
}

function getWordCount(){
	var text_ad = document.getElementById("text_ad").value;
	var wordCount = 0;
	text_ad = text_ad.replace(/(^\s*)|(\s*$)/gi,"");
	text_ad = text_ad.replace(/[ ]{2,}/gi," ");
	text_ad = text_ad.replace(/\n /,"\n");
	wordCount = text_ad.split(' ').length;
	return wordCount;
}

function calculateAmount(){
	//alert(obj.checked);
	var newspaper = document.getElementById("newspaper").value;
	if(newspaper != "-"){
		var wordCount = 0;
		wordCount = getWordCount();
		
		if(wordCount > 0 && wordCount <= 15)
			wordCount = 15;
		else if(wordCount > 15 && wordCount <= 20)
			wordCount = 20;
		else if(wordCount > 20 && wordCount <= 25)
			wordCount = 25;
		else if(wordCount > 25 && wordCount <= 30)
			wordCount = 30;
		else if(wordCount > 30 && wordCount <= 35)
			wordCount = 35;
		else if(wordCount > 35 && wordCount <= 40)
			wordCount = 40;
		else if(wordCount > 40 && wordCount <= 45)
			wordCount = 45;
	
		var urlString = "<?php echo $SERVER_URL; ?>ad.logic.php?chksql=calculateAmount&newspaper="+newspaper+"&no_of_words="+wordCount;
		//alert(urlString);
		var http = getHTTPObject();
		http.open("POST", urlString , true);
		http.onreadystatechange = function() {
		if (http.readyState == 4){
			if (http.status == 200) {
				var result = http.responseText;
				var result1 = http.responseText;	
				var result2 = http.responseText;					
				document.getElementById("amount").value = parseFloat(result);
				document.getElementById("amount1").value = 500;
				document.getElementById("amount2").value = 500;
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

function load_categories(){
	var urlString = "<?php echo $SERVER_URL; ?>admin/load_values.php?chksql=load_categories_1";
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

function load_sub_categories()
{
	var urlString = "<?php echo $SERVER_URL; ?>admin/load_values.php?chksql=load_subcategory_1&category_id="+document.getElementById("category_select").value;
	var http = getHTTPObject();
	http.open("POST", urlString , true);
	http.onreadystatechange = function() 
	{
		if (http.readyState == 4)
		{
			if (http.status == 200) 
			{
				document.getElementById("subcategory_div").innerHTML = http.responseText;
			} 
			else
			{
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
		displayFiles = displayFiles + "<a href='<?php echo $SERVER_URL; ?>"+url+"'>"+name+"</a><br>";
	}	
	document.getElementById("files").innerHTML = displayFiles;
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
<body onLoad="initiateEntry();">
<input type="hidden" name="ad_layout" id="ad_layout" value="1">
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
			    <td class="text">Advertiesment Category </td>
			    <td><div id="category_div"></div></td>
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
                <td><span class="text">Adverisement Sub Category</span></td>
			    <td class="text"><div id="subcategory_div">-</div></td>
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
			    <td class="text">Published Date </td>
			    <td class="text"><input type="text" name="publish_date" id="publish_date" value="click to select" class="text" size="20">&nbsp;MM/DD/YYYY</td>
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
			    <td class="text"> Image</td>
			    <td class="text"><div id="upload" onClick="startUpload();">Upload Images</div></td>
			    <td><div id="loading_div" class="text"></div></td>
			    <td>&nbsp;</td>
			    </tr>
			  <tr>
			    <td>&nbsp;</td>
			    <td colspan="3" class="text"><ul id="files" class="text"></ul></td>
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
			    <td colspan="3" class="text">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="text">
                    <tr> 
                      <td width="12%"><strong>Advertisement</strong></td>
                      <td width="40%" align="left"></td>
                    </tr>
                    <tr> 
                      <td valign="top"><textarea name="text_ad" id="text_ad" cols="60" rows="10" class="text" onKeyUp="checkLength();"></textarea> </td>
                      <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="text">
                          <tr> 
                            <td width="4%">&nbsp;</td>
                            <td width="54%"><strong>Newspaper</strong></td>
                            <td width="24%" align="right"><strong>Amount</strong></td>
                            <td width="5%">&nbsp;</td>
                          </tr>
                          <tr> 
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
						                            <tr> 
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
						   
                          
                          <tr> 
                            <td>&nbsp;</td>
                            <td><div id="newspapers_div"></div></td>
                            <td align="right"><input id="amount" name="amount" type="text" size="8" class="text" value="0" disabled></td>
                            <td>&nbsp;</td>
                          </tr>
						  <tr> 
                            <td>&nbsp;</td>
                            <td><div id="newspapers_div1"></div></td>
                            <td align="right"><input id="amount1" name="amount1" type="text" size="8" class="text" value="0" disabled></td>
                            <td>&nbsp;</td>
                          </tr>
						  <tr> 
                            <td>&nbsp;</td>
                            <td><div id="newspapers_div2"></div></td>
                            <td align="right"><input id="amount2" name="amount" type="text" size="8" class="text" value="0" disabled></td>
                            <td>&nbsp;</td>
                          </tr>
						  <tr> 
                            <td>&nbsp;</td>
                            <td>Total</div></td>
                            <td align="right"><input id="amount3" name="amount" type="text" size="8" class="text" value="0" disabled></td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr> 
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          </table>
                        <p>&nbsp;</p></td>
                    </tr>
                    <tr>
                      <td height="20" valign="top"><table width="100%" class="text" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td>No. Of words </td>
                          <td><div id="no_of_words_div">0</div></td>
                        </tr>
                      </table></td>
                      <td height="20" valign="top"><div id="max_words_warning_div" class="errortext"></div></td>
                    </tr>
                </table></td>
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
			    <td class="text">&nbsp;</td>
			    <td class="text"><input type="button" name="rst_button" id="rst_button" value="Reset" class="text" onClick="resetPage();">
			    &nbsp;&nbsp;<input type="button" name="sub_button" id="sub_button" value="Save &amp; Preview Ad" class="text" onClick="saveAd();"></td>
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
            </fieldset>          </td>
          <td width="5%">&nbsp;</td>
        </tr>
        <tr>
          <td></td>
          <td valign="top">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
	</td>
  </tr>
</table>
<?php include_once("footer.php"); ?>
</body>
</html>