<?php 
	ob_start();
	include_once ("config/config.php");
	require_once ("user.class.php");
	
	if($_SESSION["ses_user_name"] != null && $_SESSION["ses_user_name"] != "" && isset($_SESSION["ses_user_id"])){
		$obj  = new User();
		$id = $_SESSION["ses_user_id"];
		
		$details = array();
		$details = $obj -> getUserDetailsById($id);
	}
	ob_end_flush();	
?>
<html>
<head>
<title>On-Line Newspaper Advertisement Submition Agent...</title>
<html:base/>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" title="core css file" charset="utf-8" />
<link rel="stylesheet" href="css/ui.datepicker.css" type="text/css" media="screen" title="core css file" charset="utf-8" />
<link rel="stylesheet" href="css/messages.css" type="text/css" media="screen" title="core css file" charset="utf-8" />

<script src="scripts/XMLHTTP.js" type="text/javascript"></script>
<script src="scripts/jquery.js" type="text/javascript" charset="utf-8"></script>	
<script src="scripts/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>
<script src="scripts/messages.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" >

jQuery(function($){
$("#birth_date").datepicker();
});

function initiateEntry(){
	setDefaultDate();
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
	document.getElementById("birth_date").value = month+"/"+day+"/"+year;
}

function checkUserAvailability(){
	var userName = document.getElementById("user_name").value;
	if(userName == ""){
		inlineMsg('user_name','<strong>Error</strong><br />Please enter the user name!',2);
	}else {
		var urlString = "<?php echo $SERVER_URL; ?>register.logic.php?chksql=validateUserName&user_name="+userName;
		var http = getHTTPObject();
		http.open("POST", urlString , true);
		http.onreadystatechange = function() {
			if (http.readyState == 4){
				if (http.status == 200) {
					var result = http.responseText;		
					if(result > 0){	
						document.getElementById("valid_username").value = false;
						document.getElementById("avail_check").innerHTML = "<img src='images/error.jpg' width='15' height='15'>  Not Available!";
					}else{
						document.getElementById("valid_username").value = true;
						document.getElementById("avail_check").innerHTML = "<img src='images/ok.jpg' width='15' height='15'>  Available!";
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

function validateEntry(){

	var user_name = document.getElementById("user_name").value;
	var password = document.getElementById("password").value;
	var repassword = document.getElementById("repassword").value;
	var salutation = document.getElementById("salutation_select").value;
	var first_name = document.getElementById("first_name").value;
	var last_name = document.getElementById("last_name").value;
	var nic_no = document.getElementById("nic_no").value;
	var birth_date = document.getElementById("birth_date").value;
	var martial_status = document.getElementById("martial_status").value;
	var email = document.getElementById("email").value;
	var contact_number = document.getElementById("contact_number").value;
	var home_address = document.getElementById("home_address").value;
	var company_name = document.getElementById("company_name").value;
	var designation = document.getElementById("designation").value;
	var ofc_phone = document.getElementById("ofc_phone").value;
	var ofc_address = document.getElementById("ofc_address").value;
	var promo_check = document.getElementById("promo_check").checked;
	var terms_check = document.getElementById("terms_check").checked;
	var valid = document.getElementById("valid_username").value;
	
	var yearFromNIC = nic_no.substring(0,2);
	var yearFromBDate = birth_date.substring(birth_date.length-2, birth_date.length);
	
	if(user_name == ""){
		inlineMsg('user_name','<strong>Error</strong><br />Please enter the user name!',2);
	}else if(valid == ""){
		inlineMsg('validate_but','<strong>Error</strong><br />Click to validate user name!',2);
	}else if(!valid){
		inlineMsg('user_name','<strong>Error</strong><br />User Name not available!',2);
	}else if(password == ""){
		inlineMsg('password','<strong>Error</strong><br />Please enter the password!',2);
	}else if(repassword == ""){
		inlineMsg('repassword','<strong>Error</strong><br />Please re-enter the password!',2);
	}else if(password != repassword){
		inlineMsg('password','<strong>Error</strong><br />Password Mismatch!',2);
	}else if(first_name == ""){
		inlineMsg('first_name','<strong>Error</strong><br />Please enter the first name!',2);
	}else if(last_name == ""){
		inlineMsg('last_name','<strong>Error</strong><br />Please enter the last name!',2);
	}else if(nic_no == ""){
		inlineMsg('nic_no','<strong>Error</strong><br />Please enter the NIC no!',2);
	}else if(yearFromNIC != yearFromBDate){
		inlineMsg('birth_date','<strong>Error</strong><br />Birth date does not match with the NIC no!',2);
	}else if(email == ""){
		inlineMsg('email','<strong>Error</strong><br />Please enter the email!',2);
	}else if(!checkEmail(email)){
		inlineMsg('email','<strong>Error</strong><br />Invalid Email!',2);
	}else if(contact_number == ""){
		inlineMsg('contact_number','<strong>Error</strong><br />Please enter the contact no!',2);
	}else if(!terms_check){
		inlineMsg('terms_check','<strong>Error</strong><br />Please Select to Approve Terms & Conditions!',2);
	}else{
		var urlString = "<?php echo $SERVER_URL; ?>register.logic.php?chksql=createUser&user_name="+user_name+"&password="+password+"&salutation="+salutation+
						"&first_name="+first_name+"&last_name="+last_name+"&nic_no="+nic_no+"&birth_date="+birth_date+"&martial_status="+martial_status+"&email="+email+
						"&contact_number="+contact_number+"&home_address="+home_address+"&company_name="+company_name+"&designation="+designation+"&ofc_phone="+ofc_phone+
						"&ofc_address="+ofc_address+"&promo="+promo_check+"&terms="+terms_check;
		//alert(urlString);
		var http = getHTTPObject();
		http.open("POST", urlString , true);
		http.onreadystatechange = function() {
			if (http.readyState == 4){
				if (http.status == 200) {
					var result = http.responseText;		
					document.getElementById("save_msg").innerHTML = result;
					setTimeout("resetEntry()",2000);
				} 
				else{
					alert("Error Occured : " + http.statusText);
				}
			}
		}
		http.send(null);	
	}
	
}

function checkEmail(email) {
	if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)){
		return (true);
	}
	return (false);
}

function resetEntry(){
	document.location.reload();
}

</script>


</head>

<body onLoad="initiateEntry();">
<?php include_once("header.php"); ?>
<input type="hidden" name="valid_username" id="valid_username" value="">
<table border="0" cellspacing="0" cellpadding="0" align="center" width="739">
  <tr>
    <td> 
      <table bgcolor="#FFFFFF" width="950" height="99" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td width="10%"></td>
          <td width="80%"><fieldset>
            <legend class="text"><font color="blue">New User Registration</font></legend>
            <table width="100%" border="0" cellpadding="0" cellspacing="0" class="text">              
              <tr height="20"> 
                <td width="10%"></td>
                <td width="24%"></td>
                <td width="27%"></td>
                <td width="39%"></td>              
              </tr>
              <tr> 
                <td width="10%" align="right"><div><font color="#FF0000">*&nbsp;&nbsp;</font></div></td>
                <td width="24%">Preffered Username</td>
                <td width="27%"><input type="text" name="user_name" class="text" id="user_name" value="<?php echo $details['user_name']; ?>"></td>
                <td width="39%"><input type="button" name="validate_but" id="validate_but" value="Check Availability" class="text" onClick="checkUserAvailability();"></td>
              </tr>
              <tr> 
                <td align="right"><div><font color="#FF0000">*&nbsp;&nbsp;</font></div></td>
                <td>Preffered Password</td>
                <td><input type="password" name="password" class="text" id="password" value="<?php echo $details['user_password']; ?>"></td>
                <td><div id="avail_check"></div></td>
              </tr>
              <tr> 
                <td align="right"><div><font color="#FF0000">*&nbsp;&nbsp;</font></div></td>
                <td>Re-Enter Password</td>
                <td><input type="password" name="repassword" class="text" id="repassword" value="<?php echo $details['user_password']; ?>"></td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td colspan="2">(Please remember that the username and password 
                  are case sensitive)</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td><strong>Personal Information</strong></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td align="right">&nbsp;</td>
                <td>Salutation</td>
                <td><select name="salutation_select" id="salutation_select" class="text">
                	<option value="-">-- Please Select --</option>
                	<option value="MR">Mr.</option>
                    <option value="MISS">Miss.</option>
                    <option value="MRS">Mrs.</option>
                    <option value="HON">Hon.</option>
                    </select>                </td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td align="right"><div><font color="#FF0000">*&nbsp;&nbsp;</font></div></td>
                <td>First Name</td>
                <td><input type="text" name="first_name" id="first_name" class="text" value="<?php echo $details['first_name']; ?>"></td>
                <td></td>
              </tr>
              <tr> 
                <td align="right"><div><font color="#FF0000">*&nbsp;&nbsp;</font></div></td>
                <td>Last Name</td>
                <td><input type="text" name="last_name" id="last_name" class="text" value="<?php echo $details['last_name']; ?>"></td>
                <td></td>
              </tr>
              <tr> 
                <td align="right"><div><font color="#FF0000">*&nbsp;&nbsp;</font></div></td>
                <td>NIC</td>
                <td><input type="text" name="nic_no" id="nic_no" class="text" value="<?php echo $details['id_no']; ?>"></td>
                <td></td>
              </tr>
              <tr> 
                <td height="21">&nbsp;</td>
                <td>&nbsp;</td>
                <td colspan="2"> (Your NIC will be requested for identification 
                  at the event)</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td>Date of Birth</td>
                <td colspan="2"><input type="text" name="birth_date" id="birth_date" value="<?php echo $details['date_of_birth']; ?>" class="text" size="20">
                  &nbsp;MM/DD/YYYY&nbsp;&nbsp;</td>
                </tr>
              <tr> 
                <td>&nbsp;</td>
                <td>Marital status</td>
                <td><select name="martial_status" id="martial_status" class="text">
                	<option value="-">-- Please Select --</option>
                	<option value="SINGLE">Single</option>
                    <option value="MARRIED">Married</option>
                </select></td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td colspan="4">&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td><strong>Contact Information</strong></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td align="right"><div><font color="#FF0000">*&nbsp;&nbsp;</font></div></td>
                <td>Email Address</td>
                <td><input type="text" name="email" id="email" class="text" value="<?php echo $details['email']; ?>"></td>
                <td></td>
              </tr>
              <tr> 
                <td align="right"><div><font color="#FF0000">*&nbsp;&nbsp;</font></div></td>
                <td>Contact Number</td>
                <td><input type="text" name="contact_number" id="contact_number" class="text" value="<?php echo $details['contact_no']; ?>"></td>
                <td></td>
              </tr>
              
              <tr> 
                <td>&nbsp;</td>
                <td valign="top">Home Address</td>
                <td><textarea name="home_address" id="home_address" cols="22" rows="5" class="text"><?php echo $details['home_address']; ?></textarea></td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td colspan="4">&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td><strong>Office Information</strong></td>
                <td><strong>(Optional )</strong></td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td>Company Name</td>
                <td><input type="text" name="company_name" id="company_name" class="text" value="<?php echo $details['company_name']; ?>"></td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td>Designation</td>
                <td><input type="text" name="designation" id="designation" class="text" value="<?php echo $details['designation']; ?>"></td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td>Office Telephone</td> 
                <td><input type="text" name="ofc_phone" id="ofc_phone" class="text" value="<?php echo $details['officephone_no']; ?>"></td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td valign="top">Office Address</td>
                <td><textarea name="ofc_address" id="ofc_address" cols="22" rows="5" class="text"><?php echo $details['office_address']; ?></textarea></td>
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
                <td align="right"><input type="checkbox" name="promo_check" id="promo_check" class="text"></td>
                <td colspan="2">Keep me informed of special promotions on paperNET 
                  (Optional)</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td align="right"><font color="#FF0000">*</font><input type="checkbox" name="terms_check" id="terms_check" class="text"></td>
                <td colspan="2">I have read and accept the Terms &amp; Conditions</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td colspan="2"></td>            
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><input type="button" name="button" id="button" value="Register" class="text" onClick="validateEntry();">
                    <input type="button" name="button2" id="button2" value="Reset" class="text" onClick="resetEntry();">                </td>
                <td><div class="text" id="save_msg" class="errortext"></div></td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>
            <p>&nbsp;</p>
            </fieldset>
            &nbsp;</td>
          <td width="10%">&nbsp;</td>
        </tr>
      </table>      
	</td>
  </tr>
</table>
<?php include_once("footer.php"); ?>
</body>
</html>