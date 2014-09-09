<?php 


	include_once ("config/config.php");
	require_once("ad.class.php");

	
	$obj = new Ad();

	$type = "";
	$id = $_GET['id'];
	$type = $_GET['type'];
	
	$amount = 0;
	//$pos = strrpos($id, "T");
	//echo $pos;
	if ($type == "image") { 
		$data = $obj -> fetchImageAdDetailsById($id);
		$amount = $data[0][3];
	}else if ($type == "TENDER") { 
		$data = $obj -> getTenderNoticeDetailsById($id);
		$amount = 100.00;
	}else{			
		$data = $obj -> fetchAdDetailsById($id);
		$amount = $data[0][5];		
	}
	//echo $id;

	// ad_category, ad_sub_category, newspapers, ad_body, publish_date, ad_amount, ad_layout
	
	// size, page, newspapers, amount, publish_date, added_by, added_date
?>
<html>
<head>
<title>On-Line Newspaper Advertisement Submition Agent...</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" title="core css file" charset="utf-8" />
<link rel="stylesheet" href="css/ui.datepicker.css" type="text/css" media="screen" title="core css file" charset="utf-8" />
<link rel="stylesheet" href="css/messages.css" type="text/css" media="screen" title="core css file" charset="utf-8" />

<script src="scripts/XMLHTTP.js" type="text/javascript"></script>
<script src="scripts/jquery.js" type="text/javascript" charset="utf-8"></script>	
<script src="scripts/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>
<script src="scripts/messages.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" language="javascript1.2">

function validateEnry(){
	var firstName = document.getElementById("firstName").value;
	var lastName = document.getElementById("lastName").value;
	var creditCardType = document.getElementById("creditCardType").value;
	var creditCardNumber = document.getElementById("creditCardNumber").value;
	var expdate_month = document.getElementById("expdate_month").value;
	var expdate_year = document.getElementById("expdate_year").value;
	var cvv2Number = document.getElementById("cvv2Number").value;
	var confirmCheck = document.getElementById("confirmCheck").checked;
	
	if(firstName == ""){
		inlineMsg('firstName','<strong>Error</strong><br />Please enter the First Name!',2);
	}else if(lastName == ""){
		inlineMsg('lastName','<strong>Error</strong><br />Please enter the Last Name!',2);
	}else if(creditCardType == "-"){
		inlineMsg('creditCardType','<strong>Error</strong><br />Please select the Card Type!',2);
	}else if(creditCardNumber == ""){
		inlineMsg('creditCardNumber','<strong>Error</strong><br />Please enter the Card No!',2);
	}else if(cvv2Number == ""){
		inlineMsg('cvv2Number','<strong>Error</strong><br />Please enter the Card Verification No!',2);
	}else if(confirmCheck == false){
		inlineMsg('confirmCheck','<strong>Error</strong><br />Please check Terms & Conditions!',2);
	}else{

		var urlString = "<?php echo $SERVER_URL; ?>ad.logic.php?chksql=savePayment&id=<?php echo $id; ?>&fname="+firstName+"&lname="+lastName+
						"&cctype="+creditCardType+"&ccno="+creditCardNumber+"&cvno="+cvv2Number+"&amount=<?php echo $amount; ?>";
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
							document.location.href("<?php echo $SERVER_URL; ?>ads_confirmation.php?id=<?php echo $id; ?>");
						}else{
							window.location = "<?php echo $SERVER_URL; ?>ads_confirmation.php?id=<?php echo $id; ?>";
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

function resetEntry(){
	document.location.reload();
}

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

function isString(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123)) {
        return true;
    }
    return false;
}

function validateEmail(emailField){
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

        if (reg.test(emailField.value) == false) 
        {
            alert('Invalid Email Address');
			
            return false;
        }

        return true;

}

function checkInput(elem){
    if(elem.value.length != 16){
        alert("This value needs to be 16 characters long!");
        elem.value = ""; // Reset the textbox
    }
    
}

function checkInput1(elem){
    if(elem.value.length != 3){
        alert("This value needs to be 3 characters long!");
        elem.value = ""; // Reset the textbox
    }
    
}

function checkInput2(elem){
    if(elem.value.length != 10){
        alert("This value needs to be 10 characters long!");
        elem.value = ""; // Reset the textbox
    }
    
}


</script>

</head>

<body onLoad="">
<?php include_once("header.php"); ?>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="739">
  <tr>
    <td> 
      <table bgcolor="#FFFFFF" width="950" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td ></td>
          <td valign="top">
		  
		  <fieldset>
            <legend class="text"><font color="blue">Advertisement Details</font></legend>     
            <?php if($type == "AD"){ ?>       
            <table width="100%" border="0" cellpadding="0" cellspacing="0" class="text">
              <tr> 
                <td width="13%">&nbsp;</td>
                <td width="25%">&nbsp;</td>
                <td width="19%">&nbsp;</td>
                <td width="17%">&nbsp;</td>
                <td width="26%">&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td class="text">Newspapers</td>
                <td colspan="2" class="text"><?php echo $data[0][2]; ?></td>
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
                <td class="text">Ad Category</td>
                <td class="text"><?php echo $data[0][0]; ?></td>
                <td>Ad Sub Category</td>
                <td><?php echo $data[0][1]; ?></td>
              </tr>
              
              <tr>
                <td>&nbsp;</td>
                <td class="text">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>  
                <td>&nbsp;</td>
                <td class="text">Published Date</td>
                <td><?php echo $data[0][4]; ?></td>
                <td>Layout</td>
                <td><?php echo $data[0][6]; ?></td>
              </tr>
              
              <tr>
                <td>&nbsp;</td>
                <td class="text">&nbsp;</td>
                <td colspan="2">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td class="text">Advertisement</td>
                <td colspan="2"><?php echo $data[0][3]; ?></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td class="text">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td class="text">Amount</td>
                <td colspan="2"><?php echo $amount; ?></td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table> 
            <?php } else if($type == "IMAGE"){ ?>
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="text">
              <tr> 
                <td width="13%">&nbsp;</td>
                <td width="25%">&nbsp;</td>
                <td width="19%">&nbsp;</td>
                <td width="17%">&nbsp;</td>
                <td width="26%">&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td class="text">Newspapers</td>
                <td colspan="2" class="text"><?php echo $data[0][2]; ?></td>
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
                <td class="text">Ad Size</td>
                <td class="text"><?php echo $data[0][0]; ?></td>
                <td>Ad Page</td>
                <td><?php echo $data[0][1]; ?></td>
              </tr>
              
              <tr>
                <td>&nbsp;</td>
                <td class="text">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>  
                <td>&nbsp;</td>
                <td class="text">Published Date</td>
                <td><?php echo $data[0][4]; ?></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td class="text">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td class="text">Amount</td>
                <td colspan="2"><?php echo $amount; ?></td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>
            <?php } else { ?>
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="text">
              <tr> 
                <td width="13%">&nbsp;</td>
                <td width="25%">&nbsp;</td>
                <td width="19%">&nbsp;</td>
                <td width="17%">&nbsp;</td>
                <td width="26%">&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td class="text">Category</td>
                <td colspan="2" class="text"><?php echo $data[0][0]; ?></td>
                <td>&nbsp;</td>
              </tr>
              
              <tr>
                <td>&nbsp;</td>
                <td class="text">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>  
                <td>&nbsp;</td>
                <td class="text">Published Date</td>
                <td><?php echo $data[0][1]; ?></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td class="text">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td class="text">Amount</td>
                <td colspan="2"><?php echo $amount; ?></td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>            
            <?php } ?>            
            </fieldset> </td>
		  
           
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td ></td>
          <td valign="top">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>        
        <tr> 
          <td width="10%" ></td>
          <td width="80%" valign="top"><fieldset>
            <legend class="text"><font color="blue">Payment Details</font></legend>            
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="13%">&nbsp;</td>
                <td width="25%">&nbsp;</td>
                <td width="37%">&nbsp;</td>
                <td width="19%">&nbsp;</td>
                <td width="6%">&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td class="text">Cardholder's First Name</td>
                <td class="text"><input name="firstName" id="firstName" type="text" class="text" value="" onkeypress="return isString(event)"></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td class="text">&nbsp;</td>
                <td colspan="2" class="text"></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td class="text">Cardholder's Last Name</td>
                <td class="text"><input name="lastName" id="lastName" type="text" class="text" value="" onkeypress="return isString(event)"></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td class="text">&nbsp;</td>
                <td colspan="2" class="text"></td>
                <td>&nbsp;</td>
              </tr>
			  <tr> 
                <td>&nbsp;</td>
                <td class="text">Email Address</td>
                <td class="text"><input name="email" id="email" type="text" class="text" value="" onblur="validateEmail(this);" ></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td class="text">&nbsp;</td>
                <td colspan="2" class="text"></td>
                <td>&nbsp;</td>
              </tr>
			  <tr> 
                <td>&nbsp;</td>
                <td class="text">Mobile No</td>
                <td class="text"><input name="mobile" id="mobile" type="text" class="text" value="" onblur="checkInput2(this)" maxlength="10" size="10" onkeypress="return isNumber(event)"></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
		
              <tr>
                <td>&nbsp;</td>
                <td class="text">&nbsp;</td>
                <td colspan="2" class="text"></td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td class="text">Credit Card Type</td>
                <td class="text"> <select id="creditCardType" name="creditCardType" class="text">
                    <option value="-">-- Please Select the Card Type --</option>
                    <option value="Visa">Visa</option>
                    <option value="MasterCard">MasterCard</option>
                    <option value="Discover">Discover</option>
                    <option value="Amex">American Express</option>
                  </select> </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td class="text">&nbsp;</td>
                <td colspan="2" class="text"></td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td class="text">Credit Card Number</td>
                <td class="text"><input type="text" id="creditCardNumber" name="creditCardNumber" class="text" onblur="checkInput(this)" maxlength="16" size="16" onkeypress="return isNumber(event)"></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td class="text">&nbsp;</td>
                <td colspan="2"></td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td class="text">Expiration Date</td>
                <td> <select id="expdate_month" name="expdate_month" class="text">
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                  </select> <select id="expdate_year" name="expdate_year" class="text">
                    <option value="2014" selected>2014</option>
                    <option value="2015">2015</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
					<option value="2018">2018</option>
					<option value="2019">2019</option>
                  </select> </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td class="text">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td class="text">Card Verification Number</td>
                <td><input name="cvv2Number" type="text" class="text" id="cvv2Number" onblur="checkInput1(this)" maxlength="3" size="8" onkeypress="return isNumber(event)"></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td colspan="2"></td>
                <td>&nbsp;</td>
              </tr>
            </table>
            </fieldset></td>
          <td width="10%">&nbsp;</td>
        </tr>
        <tr> 
          <td ></td>
          <td valign="top">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td ></td>
          <td valign="top"><fieldset>
            <legend class="text"><font color="blue">Advertisement Confirmation</font></legend>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="13%">&nbsp;</td>
                <td width="25%">&nbsp;</td>
                <td width="37%">&nbsp;</td>
                <td width="19%">&nbsp;</td>
                <td width="6%">&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td colspan="2" class="text">I confirm that I have read and accept 
                  the Terms &amp; Conditions
                  <input type="checkbox" class="text" id="confirmCheck" name="confirmCheck" value="checkbox">
                <br></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td colspan="2" class="text"></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>
            </fieldset>
          </td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td></td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td></td>
          <td align="center"><input name="button2" type="button" id="button2" value="Reset " class="text" onClick="resetEntry();">
            &nbsp;&nbsp;
            <input type="button" name="val_button" id="val_button" value=" Pay " class="text" onClick="validateEnry();"></td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td></td>
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
