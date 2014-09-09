<?php
require_once ("config/config.php");
require_once ("admin.class.php");
require_once ("common.class.php");
require_once("db_manager.class.php");
	
$m_chksql = $_GET['chksql'];

$obj   = new Member();
$objC  = new Common_Functions();

if($m_chksql == "loadDashBoard"){	
		
	$vid = $obj -> getDashBoard(); 

	echo $vid;	
}

if($m_chksql == "getCategoryID"){	
		
	$vid = $obj -> getCategoryID(); 
	$vid .= $obj -> randomDigit(4); 

	echo $vid;	
}

if($m_chksql == "loadCategories"){	
	
	$returnStr = "";
	$selStr = "<select name='cateogry_names' size='1' id='cateogry_names' class='body' onChange='check_option();'><option value=''>--Select Category--</option>";
	$optStr = "";
	$details = array();
	$details = $obj -> getCategoryList();  
		
	$i = 0;
	while ($i < count($details)) {
		$optStr = $optStr."<option value='".$details[$i][0]."'>".ucfirst($details[$i][1])."</option>";			
		$i +=1;
	}
	
	$returnStr = $selStr.$optStr."</select>";
	echo $returnStr;	

}

if($m_chksql == "saveCategory"){	
	
	$id = $_GET['id'];
	$name = $_GET['name'];
	
	$msg = "";
	$result = $obj -> saveCategory($id,$name);
	
	if($result)
		$msg = "Save Successfully!";
	else
		$msg = "Error Occured!";	
		
	echo $msg;	
}

if($m_chksql == "loadAdsByDate"){	
	
	$date = $_GET['date'];
	$tdate = $_GET['tdate'];
	$type = $_GET['type'];
	$news = $_GET['news'];
	$item_details = array();	
	$item_details = $obj -> getAllAdsByDate($date,$tdate,$type,$news);  
	
	if(count($item_details) > 1){
	
		$m_out = $m_out."<table width='100%' border='0' cellspacing='0' cellpadding='0' class='body'>
						  <tr class='heading' height='20'>
							<td width='14%' align='left'>ID</td>
							<td width='17%' align='left'>Category</td>
							<td width='17%' align='left'>Sub Cat</td>
							<td width='20%' align='left'>Newspapers</td>
							<td width='20%' align='left'>Date</td>
							<td width='12%' align='left'>Amount</td>
						  </tr> ";
		
		$num = 0;
		$color = "";
		$rowCount = 1;
		$i = 0;
		$total = 0;
		while($i < (count($item_details)/7)){
								

			$m_out = $m_out."<tr height='20' class='normal' onMouseOver=this.className='highlight' onMouseOut=this.className='normal'>   
								<td>".$item_details['id'.$rowCount]."</td> 
								<td>".$item_details['cat'.$rowCount]."</td> 
								<td>".$item_details['sub'.$rowCount]."</td> 
								<td>".$item_details['news'.$rowCount]."</td> 
								<td>".$item_details['date'.$rowCount]."</td> 
								<td>".$item_details['amount'.$rowCount]."</td> 								
							</tr>  ";	
			$total += $item_details['amount'.$rowCount];	
			$rowCount += 1;		
			$i += 1;			
		}
				
		$m_out = $m_out."<tr class='heading' height='20'>
							<td colspan='5' align='right'>Total Amount&nbsp;&nbsp;&nbsp;</td>
							<td align='left'>".$total."</td>
						  </tr> ";				
		$m_out = $m_out."</table>";						
											
	} else {
		$m_out = $m_out."<table width='100%' border='0' cellspacing='0' cellpadding='0' class='body'> ".
				 " <tr>  ".
				 "	<td>&nbsp;</td> ".
				 " </tr> ".		
				 " <tr height='20'>  ".
				 "	<td align='center'>No Records Found!</td> ".
				 " </tr> ".
				 " <tr>  ".
				 "	<td>&nbsp;</td> ".
				 " </tr> ".				 
				 "</table>";
	}
	echo $m_out;		
}

if($m_chksql == "loadRefundAds"){	
	
	$fdate = $_GET['fdate'];
	$tdate = $_GET['tdate'];
	$news = $_GET['news'];
	
	$item_details = array();	
	$item_details = $obj -> getRefundAds($fdate,$tdate,$news);  //
	
	if(count($item_details) > 1){
	
		$m_out = $m_out."<table width='100%' border='0' cellspacing='0' cellpadding='0' class='body'>
						  <tr class='heading' height='20'>
							<td width='11%' align='left'>ID</td>
							<td width='12%' align='left'>Category</td>
							<td width='12%' align='left'>Sub Cat</td>
							<td width='15%' align='left'>Newspapers</td>
							<td width='25%' align='left'>Ad</td>
							<td width='15%' align='left'>Date</td>
							<td width='10%' align='left'>Amount</td>
						  </tr> ";
		
		$num = 0;
		$color = "";
		$rowCount = 1;
		$i = 0;
		$total = 0;
		while($i < (count($item_details)/7)){
								

			$m_out = $m_out."<tr height='20' class='normal' onMouseOver=this.className='highlight' onMouseOut=this.className='normal'>   
								<td>".$item_details['id'.$rowCount]."</td> 
								<td>".$item_details['cat'.$rowCount]."</td> 
								<td>".$item_details['sub'.$rowCount]."</td> 
								<td>".$item_details['news'.$rowCount]."</td> 
								<td>".$item_details['ad'.$rowCount]."</td> 
								<td>".$item_details['date'.$rowCount]."</td> 
								<td>".$item_details['amount'.$rowCount]."</td> 								
							</tr>  ";	
			$total += $item_details['amount'.$rowCount];	
			$rowCount += 1;		
			$i += 1;			
		}
				
		$m_out = $m_out."<tr class='heading' height='20'>
							<td colspan='6' align='right'>Total Amount&nbsp;&nbsp;&nbsp;</td>
							<td align='left'>".$total."</td>
						  </tr> ";				
		$m_out = $m_out."</table>";						
											
	} else {
		$m_out = $m_out."<table width='100%' border='0' cellspacing='0' cellpadding='0' class='body'> ".
				 " <tr>  ".
				 "	<td>&nbsp;</td> ".
				 " </tr> ".		
				 " <tr height='20'>  ".
				 "	<td align='center'>No Records Found!</td> ".
				 " </tr> ".
				 " <tr>  ".
				 "	<td>&nbsp;</td> ".
				 " </tr> ".				 
				 "</table>";
	}
	echo $m_out;		
}


if($m_chksql == "uploadAds"){
	$m_date = $_GET['date'];
			
	$adsStr = $obj -> getAdsId($m_date);
	
	$i = 0;
		$details = array();
		
		while ($i < count($adsStr)) {
		
			$stringData = $stringData .$adsStr[$i][0]."-".$adsStr[$i][1]."-".$adsStr[$i][2]."-".$adsStr[$i][3]."-".$adsStr[$i][5]."-".$adsStr[$i][6]."\r\n";
			$stringData = $stringData .$adsStr[$i][4]."\r\n";
			$stringData = $stringData ."---------------------------------------\r\n";
			$i +=1;
			
			$adsString = $obj -> getAdsAsString($adsStr[$i][0]);
			
			$adFile = "C:\\wamp\\www\\papernet\\ads\\".$adsStr[$i][0]."_ads.txt";
			
			if (file_exists($adFile)){
				$fh = fopen($adFile, 'a') or die("can't open file");
				fwrite($fh, $adsString);		
			}else{
				$fh = fopen($adFile, 'w') or die("can't open file");
				fwrite($fh, $adsString);
			}
			fclose($fh);
			
	
		}	

}

if($m_chksql == "downloadAds"){
	$TrackDir=opendir("C:\\wamp\\www\\papernet\\ads\\"); 
	
	$flag = false;
	while ($file = readdir($TrackDir)) { 
		//echo $file;
		$file_url = "http://localhost/papernet/ads/".$file;
		if ($file == "." || $file == "..") { 
			$flag = true;
		}
		else {
			print "<tr><td class='body'><a href='".$file_url."'>$file</a></td><br>";
			$flag = false;
		} 
		
	}
	
	if($flag)
		print "<tr><td class='error'>No Files Uploaded!</td><br>";
		
	closedir($TrackDir); 
	return; 
}

if($m_chksql == "loadAdsToUpload"){	
	
	//$date = $_GET['date'];
	$company = $_SESSION['ses_company'];
	
	$item_details = array();	
	$item_details = $obj -> getAllAdsToUpload($company);  
	
	if(count($item_details) > 1){
	
		$m_out = $m_out."<table width='100%' border='0' cellspacing='0' cellpadding='0' class='body'>
						  <tr class='heading' height='20'>
							<td width='15%' align='left'>Date</td>
							<td width='65%' align='left'>Newspapers</td>
							<td width='20%' align='left'>Process</td>
						  </tr> ";
		
		$num = 0;
		$color = "";
		$rowCount = 1;
		$i = 0;
		$total = 0;
		while($i < (count($item_details)/2)){
								

			$m_out = $m_out."<tr height='20' class='normal' onMouseOver=this.className='highlight' onMouseOut=this.className='normal'>   
								<td>".$item_details['date'.$rowCount]."</td> 
								<td>".$item_details['news'.$rowCount]."</td> 
								<td><input type='button' id='upload".$i."' name='upload".$i."' value='Upload' onClick='uploadAds(".$i.");'></td>
								<input type='hidden' id='date".$i."' name='date".$i."' value='".$item_details['date'.$rowCount]."'>								
							</tr>  ";	
			//$total += $item_details['amount'.$rowCount];	
			$rowCount += 1;		
			$i += 1;			
		}							
		$m_out = $m_out."</table>";						
											
	} else {
		$m_out = $m_out."<table width='100%' border='0' cellspacing='0' cellpadding='0' class='body'> ".
				 " <tr>  ".
				 "	<td>&nbsp;</td> ".
				 " </tr> ".		
				 " <tr height='20'>  ".
				 "	<td align='center'>No Records Found!</td> ".
				 " </tr> ".
				 " <tr>  ".
				 "	<td>&nbsp;</td> ".
				 " </tr> ".				 
				 "</table>";
	}
	echo $m_out;		
}

if($m_chksql == "loadMembersReport"){	

	$item_details = array();	
	$item_details = $obj -> getAllRegisteredMembers();  
	
	if(count($item_details) > 1){
	
		$m_out = $m_out."<table width='100%' border='0' cellspacing='0' cellpadding='0' class='body'>
						  <tr class='heading' height='20'>
							<td width='10%' align='left'>User ID</td>
							<td width='30%' align='left'>Name</td>
							<td width='30%' align='left'>Email</td>
							<td width='30%' align='left'>Contact No</td>
						  </tr> ";
		
		$num = 0;
		$color = "";
		$rowCount = 1;
		$i = 0;
		
		while($i < (count($item_details)/4)){
								

			$m_out = $m_out."<tr height='20' class='normal' onMouseOver=this.className='highlight' onMouseOut=this.className='normal'>   
								<td>".$item_details['id'.$rowCount]."</td> 
								<td>".$item_details['name'.$rowCount]."</td> 
								<td>".$item_details['email'.$rowCount]."</td> 
								<td>".$item_details['contact'.$rowCount]."</td> 
							</tr>  ";	
				
			$rowCount += 1;		
			$i += 1;			
		}
				
		$m_out = $m_out."</table>";						
											
	} else {
		$m_out = $m_out."<table width='100%' border='0' cellspacing='0' cellpadding='0' class='body'> ".
				 " <tr>  ".
				 "	<td>&nbsp;</td> ".
				 " </tr> ".		
				 " <tr height='20'>  ".
				 "	<td align='center'>No Records Found!</td> ".
				 " </tr> ".
				 " <tr>  ".
				 "	<td>&nbsp;</td> ".
				 " </tr> ".				 
				 "</table>";
	}
	echo $m_out;		
}

if($m_chksql == "loadTextAds"){	

	$item_details = array();	
	$item_details = $obj -> getAllTextAds();  
	
	if(count($item_details) > 1){
	
		$m_out = $m_out."<table width='100%' border='0' cellspacing='0' cellpadding='0' class='body'>
						  <tr class='heading' height='20'>
							<td width='5%' align='left'>ID</td>
							<td width='15%' align='left'>Category</td>
							<td width='15%' align='left'>Sub Cat</td>
							<td width='15%' align='left'>Newspapers</td>
							<td width='25%' align='left'>Ad</td>
							<td width='15%' align='left'>Date</td>
							<td width='10%' align='left'>Amount</td>
						  </tr> ";
		
		$num = 0;
		$color = "";
		$rowCount = 1;
		$i = 0;
		
		while($i < (count($item_details)/7)){
								

			$m_out = $m_out."<tr height='20' class='normal' onMouseOver=this.className='highlight' onMouseOut=this.className='normal'>   
								<td>".$item_details['id'.$rowCount]."</td> 
								<td>".$item_details['cat'.$rowCount]."</td> 
								<td>".$item_details['sub'.$rowCount]."</td> 
								<td>".$item_details['news'.$rowCount]."</td> 
								<td>".$item_details['ad'.$rowCount]."</td> 
								<td>".$item_details['date'.$rowCount]."</td> 
								<td>".$item_details['amount'.$rowCount]."</td> 								
							</tr>  ";	
				
			$rowCount += 1;		
			$i += 1;			
		}
				
		$m_out = $m_out."</table>";						
											
	} else {
		$m_out = $m_out."<table width='100%' border='0' cellspacing='0' cellpadding='0' class='body'> ".
				 " <tr>  ".
				 "	<td>&nbsp;</td> ".
				 " </tr> ".		
				 " <tr height='20'>  ".
				 "	<td align='center'>No Records Found!</td> ".
				 " </tr> ".
				 " <tr>  ".
				 "	<td>&nbsp;</td> ".
				 " </tr> ".				 
				 "</table>";
	}
	echo $m_out;		
}

if($m_chksql == "loadImageAds"){	

	$item_details = array();	
	$item_details = $obj -> getAllImageAds();  
	
	if(count($item_details) > 1){
	
		$m_out = $m_out."<table width='100%' border='0' cellspacing='0' cellpadding='0' class='body'>
						  <tr class='heading' height='20'>
							<td width='15%' align='left'>ID</td>
							<td width='15%' align='left'>Size</td>
							<td width='15%' align='left'>Page</td>
							<td width='25%' align='left'>Newspapers</td>
							<td width='15%' align='left'>Amount</td>
							<td width='15%' align='left'>Date</td>
						  </tr> ";
		
		$num = 0;
		$color = "";
		$rowCount = 1;
		$i = 0;
		
		while($i < (count($item_details)/6)){
								

			$m_out = $m_out."<tr height='20' class='normal' onMouseOver=this.className='highlight' onMouseOut=this.className='normal'>   
								<td>".$item_details['id'.$rowCount]."</td> 
								<td>".$item_details['size'.$rowCount]."</td> 
								<td>".$item_details['page'.$rowCount]."</td> 
								<td>".$item_details['news'.$rowCount]."</td> 
								<td>".$item_details['amount'.$rowCount]."</td> 								
								<td>".$item_details['date'.$rowCount]."</td> 
							</tr>  ";	
				
			$rowCount += 1;		
			$i += 1;			
		}
				
		$m_out = $m_out."</table>";						
											
	} else {
		$m_out = $m_out."<table width='100%' border='0' cellspacing='0' cellpadding='0' class='body'> ".
				 " <tr>  ".
				 "	<td>&nbsp;</td> ".
				 " </tr> ".		
				 " <tr height='20'>  ".
				 "	<td align='center'>No Records Found!</td> ".
				 " </tr> ".
				 " <tr>  ".
				 "	<td>&nbsp;</td> ".
				 " </tr> ".				 
				 "</table>";
	}
	echo $m_out;		
}

?>
