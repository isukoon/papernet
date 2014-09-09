

<?php

$mailBody = "<html>
						<head>
						<title>Advertismen successfull Papernet.lk</title>
						<style>
						.body {font-family: Verdana; font-size: 11px; color: #000000; }
						</style> 
						</head>
                        <body>
			<table width='100%' border='0' cellpadding='0' cellspacing='0' class='text'>
              <tr> 
                <td width='13%'>&nbsp;</td>
                <td width='25%' colspan='2'><p>Dear ".$details['first_name'].",</p>
                <p><b>Your Advertiesment successfully scheduled. </b></p>
                <p><b>Thank you for your payment!</b></p></td>
                <td width='30%'></td>
                <td width='6%'>&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td width='25%' class='text'>&nbsp;</td>
                <td width='26%' class='text'>&nbsp;</td>
                <td class='text'>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td>Payment Date</td>
                <td colspan='2'>".$data[0][7]."</td>
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
                <td>".$data[0][1]."</td>
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
                <td>".$id."</td>
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
                <td>".$data[0][2]."</td>
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
                <td>XXXX XXXX XXXX ".substr($data[0][3], -4, 4)."</td>
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
                <td colspan='2'>".$data[0][5]."&nbsp;".$data[0][6]."</td>
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
                <td>".$data[0][0]."</td>
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
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td>Thank You.</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>	
              <tr> 
                <td>&nbsp;</td>
                <td>Papernet.lk Team!.</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>				  		  			  			  
            </table></body>
						</html>";

?>