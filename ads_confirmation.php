<?php 
	
	
	include_once("config/config.php");
	require_once("ad.class.php");
	require_once("user.class.php");

	alert($_SESSION['mobile']);
	$obj = new Ad();
	//$objU  = new User();

	$id = $_GET['id'];
	
	$data = $obj -> fetchPaymentDetailsById($id);
	
	/*
	include_once("ViaNettSMS.php");

	$receiver = "";
	// Declare variables.
	$Username = "sachithkapu@gmail.com";
	$Password = "w5wyd";
	$MsgSender = "+94777953480";
	$DestinationAddress = $receiver;
	$Message = "Hello World!";

	// Create ViaNettSMS object with params $Username and $Password
	$ViaNettSMS = new ViaNettSMS($Username, $Password);
	try
	{
		// Send SMS through the HTTP API
		$Result = $ViaNettSMS->SendSMS($MsgSender, $DestinationAddress, $Message);
		// Check result object returned and give response to end user according to success or not.
		if ($Result->Success == true)
			$Message = "Message successfully sent!";
		else
			$Message = "Error occured while sending SMS<br />Errorcode: " . $Result->ErrorCode . "<br />Errormessage: " . $Result->ErrorMessage;
	}
	catch (Exception $e)
	{
		//Error occured while connecting to server.
		$Message = $e->getMessage();
	}*/

	

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
<script type="text/javascript">

function printReceipt(){
	window.print();
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
          <td width="10%"></td>
          <td width="80%">&nbsp;</td>
          <td width="10%">&nbsp;</td>
        </tr>
        <tr> 
          <td ></td>
          <td valign="top"><fieldset>
            <legend class="text"><font color="blue">Payment Details</font></legend>
            <table width="100%" border="0" cellpadding="0" cellspacing="0" class="text">
              <tr> 
                <td width="13%">&nbsp;</td>
                <td width="25%" colspan="2"><b>Thank you for your payment!</b></td>
                <td width="30%"><img src="images/paid.jpg" width="175" height="100"></td>
                <td width="6%">&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td width="25%" class="text">&nbsp;</td>
                <td width="26%" class="text">&nbsp;</td>
                <td class="text">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td>Payment Date</td>
                <td colspan="2"><?php echo $data[0][7]; ?></td>
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
                <td>Transaction ID</td>
                <td><?php echo $data[0][1]; ?></td>
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
                <td>Advertisement ID </td>
                <td><?php echo $id; ?></td>
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
                <td>Credit Card Type </td>
                <td><?php echo $data[0][2]; ?></td>
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
                <td>Credit Card Number</td>
                <td>XXXX XXXX XXXX <?php echo substr($data[0][3], -4, 4); ?></td>
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
                <td>Customer Name</td>
                <td colspan="2"><?php echo $data[0][5]; ?>&nbsp;<?php echo $data[0][6]; ?></td>
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
                <td>Amount (LKR)</td>
                <td><?php echo $data[0][0]; ?></td>
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
            </table>
            </fieldset></td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td ></td>
          <td valign="top">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td></td>
          <td align="center"><input type="submit" name="Submit3" class="text" value=" Print Receipt" onClick="printReceipt();"></td>
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
