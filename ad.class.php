<?php
require_once("db_manager.class.php");

class Ad extends DB_Manager{

	function getImageAdID(){
	
		$query = " SELECT CONCAT('I',number+1) FROM ref_sequence WHERE type = 'IMAGE';  ";
				 
		$result = $this -> executeQuery($query);
			 
		$ref = "";
		$ref = $result[0][0];
			
		return $ref;
	
	}
	
	function getAdID(){
	
		$query = " SELECT CONCAT('C',number+1) FROM ref_sequence WHERE type = 'CLASSIFIED';  ";
				 
		$result = $this -> executeQuery($query);
			 
		$ref = "";
		$ref = $result[0][0];
			
		return $ref;
	
	}	
	
	function getTenderNoticeDetailsById($id){
	
		$query = " SELECT category, added_date FROM tbl_tender_notices WHERE ad_id = '".$id."';  ";

		$result = $this -> executeQuery($query);
		
		return $result;	
	}	

	function getTenderNoticeID(){
	
		$query = " SELECT CONCAT('T',number+1) FROM ref_sequence WHERE type = 'TENDER';  ";
				 
		$result = $this -> executeQuery($query);
			 
		$ref = "";
		$ref = $result[0][0];
			
		return $ref;
	
	}

	function calculateAmount($newspaper, $no_of_words){
	
		$query = " SELECT amount FROM tbl_ad_prices WHERE newspaper_id = ".$newspaper." AND no_of_words = ".$no_of_words."; ";

		$result = "";
		$result = $this -> executeQuery($query);
		
		return $result[0][0];		
	}
	
	function calculateImageAmount($size, $page){
	
		$query = " SELECT amount FROM tbl_image_ad_prices WHERE size = '".$size."' AND page = '".$page."'; ";

		$result = "";
		$result = $this -> executeQuery($query);
		
		return $result[0][0];		
	}
	
	function updateSequence($option){

		$query = " UPDATE ref_sequence
				   SET number = number + 1
				   WHERE type = '".$option."' ";
		
		$result = "";		   
		$result = $this -> executeUpdateQuery($query);
		return $result;
	}
		
	function updateInquiry($id,$status,$date){
		
		if($status != ""){
			$query = " UPDATE tbl_text_ads
					   SET status = 'REFUND'
					   WHERE ad_id = '".$id."' ";		
		}
		
		if($date != ""){
			$query = " UPDATE tbl_text_ads
					   SET publish_date = '".$date."'
					   WHERE type = '".$this->dateconvert($date,1)."' ";				
		}

		$this -> logData("RESULT - ".$query);
		$result = "";		   
		$result = $this -> executeUpdateQuery($query);
		return $result;
	}		
		
	function createTextAd($id, $cat,$sub_cat,$pub_date,$ad,$total,$newspapers,$user,$image){
	
		$query = " INSERT INTO tbl_text_ads 
				  (ad_id, ad_category, ad_sub_category, newspapers, ad_body, publish_date, ad_amount, ent_date, ent_by, ad_status, ad_layout) 
				  VALUES('".$id."','".$cat."','".$sub_cat."','".$newspapers."','".$ad."','".$this->dateconvert($pub_date,1)."','".$total."',now(),'".$user."','ENTRY','".$image."') ";
		//$this -> logData("QUERY - ".$query);
		$result = "";
		$result = $this -> executeInsertQuery($query);
		//$this -> logData("RESULT - ".$result);
		
		if($result){
			$result = $this -> updateSequence('CLASSIFIED');
		}
		
		return $result;			
	}
	
	function createImageAd($id,$size,$page,$newspaper,$publish_date,$amount,$user){
	
		$query = " INSERT INTO tbl_image_ad 
				  (ad_id, size, page, newspapers, amount, publish_date, added_by, added_date) 
				  VALUES('".$id."','".$size."','".$page."','".$newspaper."',".$amount.",'".$this->dateconvert($publish_date,1)."','".$user."',now()); ";
		//$this -> logData("QUERY - ".$query);
		$result = "";
		$result = $this -> executeInsertQuery($query);
		//$this -> logData("RESULT - ".$result);
		
		if($result){
			$result = $this -> updateSequence('IMAGE');
		}
		
		return $result;			
	}	
		
	function createTenderNotice($id,$cat,$user){
	
		$query = " INSERT INTO tbl_tender_notices 
				  (ad_id, category, added_by, added_date) 
				  VALUES('".$id."','".$cat."','".$user."',now()); ";
		//$this -> logData("QUERY - ".$query);
		$result = "";
		$result = $this -> executeInsertQuery($query);
		//$this -> logData("RESULT - ".$result);
		
		if($result){
			$result = $this -> updateSequence('TENDER');
		}
		
		return $result;			
	}		
	
	function fetchAdDetailsById($id){
		
		$query = "  SELECT (SELECT category_name FROM tbl_ad_category WHERE category_id = ad_category), 
					ad_sub_category, newspapers, ad_body, publish_date, ad_amount, ad_layout, status
					FROM tbl_text_ads
					WHERE ad_id = '".$id."'; ";

		$result = $this -> executeQuery($query);
		
		return $result;	
	
	}
	
	
	function fetchImageAdDetailsById($id){
	
		$query = "  SELECT size, page, (SELECT display_name FROM tbl_newspapers WHERE newspaper_id = newspapers), amount, publish_date, added_by, added_date
					FROM tbl_image_ad
					WHERE ad_id = '".$id."'; ";

		$result = $this -> executeQuery($query);
		
		return $result;	
	
	}	
	
	
	function fetchPaymentDetailsById($id){
	
		$query = "  SELECT amount, tran_id, cc_type, cc_number, cvv_no, first_name, last_name, payment_date 
					FROM tbl_ad_payment
					WHERE ad_id = '".$id."'; ";

		$result = $this -> executeQuery($query);
		
		return $result;	
	
	}	
	
	function  randomDigit($digits)  {   
		  static  $startseed  =  0;   
		  if  (!$startseed)  { 
				$startseed  =  (double)microtime()*getrandmax();   
				srand($startseed); 
		  } 
		  $range  =  8; 
		  $start  =  1; 
		  $i  =  1; 
		  while  ($i<$digits)  { 
				$range  =  $range  .  9; 
				$start  =  $start  .  0; 
				$i++; 
		  } 
		  return  (rand()%$range+$start);   
	}	
	
	
	function savePayment($id,$fname,$lname,$cctype,$ccno,$cvno,$amount){
	
	
		$query = " INSERT INTO tbl_ad_payment 
				  (ad_id, amount, tran_id, cc_type, cc_number, exp_date, cvv_no, first_name, last_name, payment_date) 
				  VALUES('".$id."',".$amount.",'".$this->randomDigit(6)."','".$cctype."','".$ccno."','','".$cvno."','".$fname."','".$lname."',now()); ";
		
		//$this -> logData("QUERY - ".$query);
		
		$result = "";
		$result = $this -> executeInsertQuery($query);
		//$this -> logData("RESULT - ".$result);
		return $result;			
	}
	
	
	function getTenderNoticeDetails($cat,$fdate,$tdate){
	
		$query = " SELECT ad_id, category, added_date FROM tbl_tender_notices WHERE category = '".$cat."' AND 
					DATE_FORMAT(added_date,'%Y-%m-%d') >= '".$this->dateconvert($fdate,1)."' AND 
					DATE_FORMAT(added_date,'%Y-%m-%d') <= '".$this->dateconvert($tdate,1)."';  ";
				 
		$result = $this -> executeQuery($query);
		
		//$this-> logData($query);
			 		
		$i = 0;
		$details = array();
		$details = "";
		while ($i < count($result)) {		
				
			$details["id".($i+1)] = $result[$i][0];
			$details["cat".($i+1)] = $result[$i][1];
			$details["date".($i+1)] = $result[$i][2];
			$i +=1;
		}
		
		return $details;
	}	
	
	function getClassifiedsByUser($user){
	
		$query = "   SELECT ad_id, ad_category, ad_sub_category, newspapers, ad_body, publish_date, ad_amount
					 FROM tbl_text_ads
					 WHERE ent_by = '".$user."';  ";
				 
		$result = $this -> executeQuery($query);
			 		
		$i = 0;
		$details = array();
		$details = "";
		while ($i < count($result)) {		
				
			$details["id".($i+1)] = $result[$i][0];
			$details["cat".($i+1)] = $result[$i][1];
			$details["sub".($i+1)] = $result[$i][2];
			$details["news".($i+1)] = $result[$i][3];
			$details["ad".($i+1)] = $result[$i][4];
			$details["date".($i+1)] = $result[$i][5];
			$details["amount".($i+1)] = $result[$i][6];
			$i +=1;
		}
		
		return $details;
	}	
		
	function getImageAdsByUser($user){
	
		$query = "   SELECT ad_id, size, page, newspapers, amount, publish_date
					 FROM tbl_image_ad
					 WHERE added_by = ".$user.";  ";
				 
		$result = $this -> executeQuery($query);
			 		
		$i = 0;
		$details = array();
		$details = "";
		while ($i < count($result)) {		
				
			$details["id".($i+1)] = $result[$i][0];
			$details["size".($i+1)] = $result[$i][1];
			$details["page".($i+1)] = $result[$i][2];
			$details["news".($i+1)] = $result[$i][3];
			$details["amount".($i+1)] = $result[$i][4];
			$details["date".($i+1)] = $result[$i][5];
			$i +=1;
		}
		
		return $details;
	}		
}
?>
