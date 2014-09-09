<?php
require_once("ad.class.php");


$adObj = new Ad();

$function = $_GET['chksql'];

if($function == "getImageAdID"){	
		
	$vid = $adObj -> getImageAdID(); 
	$vid .= $adObj -> randomDigit(4); 

	echo $vid;	
}

if($function == "getAdID"){	
		
	$vid = $adObj -> getAdID(); 
	$vid .= $adObj -> randomDigit(4); 

	echo $vid;	
}

if($function == "updateInquiry"){
	
	$id = $_GET['id'];
	$status = $_GET['status'];	
	$date = $_GET['date'];
		
	$msg = "";
	$result = $adObj -> updateInquiry($id,$status,$date);  
	if($result){
		$msg = "Inquiry Saved Successfully";
	}else{
		$msg = "Error Occured!";
	}
	echo $msg;	
}

if($function == "getTenderNoticeID"){	
		
	$vid = $adObj -> getTenderNoticeID(); 
	$vid .= $adObj -> randomDigit(4); 

	echo $vid;	
}


if($function == "calculateAmount"){
	
	$newspaper = $_GET['newspaper'];
	$no_of_words = $_GET['no_of_words'];
	$amount = 0;
	$amount = $adObj -> calculateAmount($newspaper, $no_of_words);
	
		if($pic == "true")
		echo $amount + 500;
		else
		echo $amount;
}

if($function == "calculateImageAmount"){
	
	$size = $_GET['size'];
	$page = $_GET['page'];
	$amount = 0;
	$amount = $adObj -> calculateImageAmount($size, $page);
		
	echo $amount;
}

if($function == "saveAd"){
	
	$id = $_GET['id'];
	$cat = $_GET['cat'];
	$sub_cat = $_GET['sub_cat'];
	$pub_date = $_GET['pub_date'];
	$image = $_GET['image'];
	$ad = $_GET['ad'];
	$total = $_GET['total'];
	$newspaper = $_GET['newspaper'];
	$user = $_SESSION['ses_user_id'];
	
	$msg = "";
	$result = $adObj -> createTextAd($id,$cat,$sub_cat,$pub_date,$ad,$total,$newspaper,$user,$image);
	if($result == 0)
		$msg = "ERROR";
	else
		$msg = $id;	
		
	echo $msg;
}

if($function == "saveImageAd"){
	
	$id = $_GET['id'];
	$size = $_GET['size'];
	$page = $_GET['page'];
	$newspaper = $_GET['newspaper'];
	$publish_date = $_GET['publish_date'];
	$amount = $_GET['amount'];
	$user = $_SESSION['ses_user_id'];

	$msg = "";
	$result = $adObj -> createImageAd($id,$size,$page,$newspaper,$publish_date,$amount,$user);
	if($result)
		$msg = "OK";
	else
		$msg = "ERROR";	
		
	echo $msg;
}


if($function == "saveTenderNotice"){
	
	$id = $_GET['id'];
	$cat = $_GET['cat'];
	$user = $_SESSION['ses_user_id'];

	$msg = "";
	$result = $adObj -> createTenderNotice($id,$cat,$user);
	if($result)
		$msg = "Added Succressufully!";
	else
		$msg = "Error Occured!";	
		
	echo $msg;
}

if($function == "savePayment"){
	
	$id = $_GET['id'];
	$fname = $_GET['fname'];
	$lname = $_GET['lname'];
	$cctype = $_GET['cctype'];
	$ccno = $_GET['ccno'];
	$cvno = $_GET['cvno'];
	$amount = $_GET['amount'];
	
	$msg = "";
	$result = $adObj -> savePayment($id,$fname,$lname,$cctype,$ccno,$cvno,$amount);
	if($result)
		$msg = "OK";
	else
		$msg = "ERROR";	
		
	echo $msg;
}


if($function == "loadSlideShow"){	
	$cat = $_GET['cat'];
	$fdate = $_GET['fdate'];
	$tdate = $_GET['tdate'];
	$details = array();
	$details =  $adObj -> getTenderNoticeDetails($cat,$fdate,$tdate); 
	
	$m_out = "";
		
	if(count($details) > 1){
		$i = 0;	
		$rowCount = 1;
		while($i < (count($details)/3)){
			$m_out = $m_out. "<div class='imageElement'>
								<h3>".$details['id'.$rowCount]." - ".ucfirst($details['cat'.$rowCount])." - ".$details['date'.$rowCount]."</h3>
								<p>&nbsp;</p>
								<a href='#' title='open image' class='open'></a>
								<img src='uploaded_images/".$details['id'.$rowCount]."/".$details['id'.$rowCount].".jpg' class='full' />
								<img src='uploaded_images/".$details['id'.$rowCount]."/".$details['id'.$rowCount].".jpg' class='thumbnail' />
							</div>";	
			
			$rowCount += 1;					
			$i +=1;						
		}
	}

	echo $m_out;	
}

if($function == "loadClassifieds"){	
	
	$user = $_SESSION['ses_user_id'];
	//echo $user;
	$details = array();
	$details = $adObj -> getClassifiedsByUser($user);  
	$m_out = "";
	//echo count($details);
	if(count($details) > 1){
		$i = 0;
		$rowCount = 1;
		$m_out =  "<table width='100%'  border='0' cellspacing='0' cellpadding='0' class='text'> 
							 <tr class='heading' height='20'> 
								<td class='heading' width='5%' align='left'>ID</td>
								<td class='heading' width='12%' align='left'>Category</td>
								<td class='heading' width='12%' align='left'>Sub Cat</td>
								<td class='heading' width='15%' align='left'>Newspapers</td>
								<td class='heading' width='25%' align='left'>Ad</td>
								<td class='heading' width='15%' align='left'>Date</td>
								<td class='heading' width='10%' align='left'>Amount</td>
								<td class='heading' width='6%' align='left'></td>
							</tr>";
						
		while ($i < (count($details)/7)) {
				
				
			$m_out = $m_out."<tr height='20' class='normal' onMouseOver=this.className='highlight' onMouseOut=this.className='normal'>   
								<td>".$details['id'.$rowCount]."</td> 
								<td>".$details['cat'.$rowCount]."</td> 
								<td>".$details['sub'.$rowCount]."</td> 
								<td>".$details['news'.$rowCount]."</td> 
								<td>".$details['ad'.$rowCount]."</td> 
								<td>".$details['date'.$rowCount]."</td> 
								<td>".$details['amount'.$rowCount]."</td> 
								<td><input type='button' id='inq_but".$i."' name='inq_but".$i."' value='Inquiry' onClick='loadInq(".$i.");'></td> 	
								<input type='hidden' id='id".$i."' name='id".$i."' value='".$details['id'.$rowCount]."'>							
							</tr>  ";
			
			$i += 1;
			$rowCount += 1;
		}
		
		$m_out = $m_out."</table>";
			
	}else{
		$m_out =  "<table width='100%' border='0' class='body'>
					<tr> 
					<td>No Records Found!</td> 
					</tr>
				</table>";					
	}
		
	echo $m_out;
}

if($function == "loadImageAds"){	
	
	$user = $_SESSION['ses_user_id'];
	//echo $user;
	$details = array();
	$details = $adObj -> getImageAdsByUser($user);  
	$m_out = "";
	//echo count($details);
	if(count($details) > 1){
		$i = 0;
		$rowCount = 1;
		$m_out =  "<table width='100%'  border='0' cellspacing='0' cellpadding='0' class='text'> 
							 <tr class='heading' height='20'> 
								<td class='heading' width='15%' align='left'>ID</td>
								<td class='heading' width='15%' align='left'>Size</td>
								<td class='heading' width='15%' align='left'>Page</td>
								<td class='heading' width='25%' align='left'>Newspapers</td>
								<td class='heading' width='15%' align='left'>Amount</td>
								<td class='heading' width='15%' align='left'>Date</td>
							</tr>";
						
		while ($i < (count($details)/6)) {
				
				
			$m_out = $m_out."<tr height='20' class='normal' onMouseOver=this.className='highlight' onMouseOut=this.className='normal'>   
								<td>".$details['id'.$rowCount]."</td> 
								<td>".$details['size'.$rowCount]."</td> 
								<td>".$details['page'.$rowCount]."</td> 
								<td>".$details['news'.$rowCount]."</td> 
								<td>".$details['amount'.$rowCount]."</td> 								
								<td>".$details['date'.$rowCount]."</td> 							
							</tr>  ";
			
			$i += 1;
			$rowCount += 1;
		}
		
		$m_out = $m_out."</table>";
			
	}else{
		$m_out =  "<table width='100%' border='0' class='body'>
					<tr> 
					<td>No Records Found!</td> 
					</tr>
				</table>";					
	}
		
	echo $m_out;
}

if($function == "load_newspapers"){	

	$db = $DB;
	$connect = mysql_connect($HOST,$USER,$PASSWORD) or die ("Unable to connect");
	mysql_select_db($db) or die ("Unamble to select database");
		
	$query = " SELECT newspaper_id,display_name FROM tbl_newspapers; ";
			 
	mysql_query($query) or die ("Error in query : $query.".mysql_error());
	$result = mysql_query($query) or die ("Error in query : $query.".mysql_error());
	$m_select = "";
	$m_option = "";
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		$m_option = $m_option."<option value='".$row['newspaper_id']."'>".$row['display_name']."</option>";
	}
	$m_select = "<select name='newspaper' id='newspaper' class='text' onChange='calculateAmount();'><option value='-'>--Select Newspaper--</option>".$m_option."</select>";	
	echo $m_select;
		
	mysql_free_result($result);
	mysql_close($connect);	
}
?>
