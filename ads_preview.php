<?php 
	include_once ("config/config.php");
	require_once("ad.class.php");

	$obj = new Ad();

	$id = $_GET['id'];
	
	$data = $obj -> fetchAdDetailsById($id);
	//echo $data;

	// ad_category, ad_sub_category, newspapers, ad_body, publish_date, ad_amount, ad_layout
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

function confirmAndPay(){
	if(navigator.appName == "Microsoft Internet Explorer"){
		document.location.href("<?php echo $SERVER_URL; ?>ads_payment.php?id=<?php echo $id; ?>&type=classified");
	}else{
		window.location = "<?php echo $SERVER_URL; ?>ads_payment.php?id=<?php echo $id; ?>&type=classified";
	}
}


</script>

</head>
<body onLoad="">
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
			    <td class="text"><?php echo $data[0][0]; ?></td>
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
			    <td class="text"><?php echo $data[0][1]; ?></td>
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
			    <td class="text"><?php echo $data[0][4]; ?></td>
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
			    <td class="text">Layout</td>
			    <td class="text"><?php echo $data[0][6]; ?></td>
			    <td class="text">&nbsp;</td>
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
			    <td class="text">Advertisement</td>
			    <td class="text"><?php echo $data[0][3]; ?></td>
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
			    <td class="text">Amount</td>
			    <td class="text"><?php echo $data[0][5]; ?></td>
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
			    <td class="text">&nbsp;</td>
			    <td class="text">&nbsp;<input type="button" name="sub_button" id="sub_button" value="Confirm &amp; Pay" class="text" onClick="confirmAndPay();"></td>
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