<table align="center" id="Table_01" width="950" height="120" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="7"><a href="index.php"><img src="images/header.gif" width="950" height="94" alt="" border="0"></a></td>
	</tr>
	<tr>
		<td><a href="index.php"><img src="images/home.gif" width="70" height="26" alt="" border="0"></a></td>
		<td><a href="about_us.php"><img src="images/about.gif" width="88" height="26" alt="" border="0"></a></td>
		<td><a href="tender_notices.php"><img src="images/tender.gif" width="131" height="26" alt="" border="0"></a></td>
		<td><a href="contact_us.php"><img src="images/contact.gif" width="101" height="26" alt="" border="0"></a></td>
		<td><img src="images/menu.gif" width="412" height="26" alt=""></td>
        <?php if($_SESSION["ses_user_name"] == null || $_SESSION["ses_user_name"] == ""){ ?>
		<td><a href="register.php"><img src="images/register.gif" width="73" height="26" alt="" border="0"></a></td>
		<td><a href="login.php"><img src="images/login.gif" width="75" height="26" alt="" border="0"></a></td>
        <?php } else { ?>
		<td><img src="images/register_logout.gif" width="73" height="26" alt="" border="0"></td>
		<td><a href="logout.php"><img src="images/logout.gif" width="75" height="26" alt="" border="0"></a></td>        
        <?php } ?>
	</tr>
</table>
