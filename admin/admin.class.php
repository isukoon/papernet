<?php
require_once("db_manager.class.php");

class Member extends DB_Manager{

	function validateLogin($username,$password){
	
		$query = " SELECT first_name,user_name,user_id,user_level,company
				   FROM tbl_users 
				   WHERE UPPER(user_name) = UPPER('".$username."') AND 
				 		 UPPER(user_password)  = UPPER('".$password."'); ";
									 
		$result = $this -> executeQuery($query);				 
		return $result;
	}
	

	function getDashBoard(){
		
		$query = "  SELECT
					(SELECT COUNT(DISTINCT user_id) FROM tbl_users)  AS no_of_users,
					(SELECT  COUNT(DISTINCT ad_id) FROM tbl_text_ads) AS no_of_ads,
					(SELECT  COUNT(DISTINCT ad_id) FROM tbl_image_ad) AS no_of_img,
					(SELECT COUNT(DISTINCT ad_id) FROM tbl_text_ads) AS no_of_tender
					FROM DUAL; ";
		$result = $this -> executeQuery($query);
			 
		$ref = "";
		$ref = $result[0][0]."#".$result[0][1]."#".$result[0][2]."#".$result[0][3];
			
		return $ref;	
	}

	function getCategoryID(){
	
		$query = " SELECT CONCAT('C',number+1) FROM ref_sequence WHERE type = 'CATEGORY';  ";
				 
		$result = $this -> executeQuery($query);
			 
		$ref = "";
		$ref = $result[0][0];
			
		return $ref;
	
	}
	
	function saveCategory($id,$name){
	
		$query = "INSERT INTO tbl_ad_category 
				  (category_id, category_name) 
				  VALUES('".$id."','".$name."'); ";
		
		$result = "";
		$result = $this -> executeInsertQuery($query);
		
		return $result;			
	}	
	
	function getCategoryList(){
	
		$query = " SELECT category_id,category_name FROM tbl_ad_category ORDER BY category_name;  ";
				 
		$result = $this -> executeQuery($query);
			 		
		return $result;	
	}
	
	function getAdsId($date){
		$query = "  SELECT ad_id 
					FROM tbl_text_ads
					WHERE DATE_FORMAT(ent_date,'%Y-%m-%d') = '".$date."'; ";
						
		$result = "";
		$result = $this -> executeQuery($query);	
		/*
		$i = 0;
		$details = array();
		$stringData = "---------------------------------------\r\n";
		while ($i < count($result)) {
		
			$stringData = $stringData .$result[$i][0]."-".$result[$i][1]."-".$result[$i][2]."-".$result[$i][3]."-".$result[$i][5]."-".$result[$i][6]."\r\n";
			$stringData = $stringData .$result[$i][4]."\r\n";
			$stringData = $stringData ."---------------------------------------\r\n";
			$i +=1;
		}	*/
		return $result;
		//return $result;
	}
	
	
	
	function getAdsAsString($date){
		$query = "  SELECT ad_id, ad_category, ad_sub_category, newspapers, ad_body, publish_date, ad_amount 
					FROM tbl_text_ads
					WHERE ad_id = '".$date."'; ";
						
		$result = "";
		$result = $this -> executeQuery($query);	
		
		$i = 0;
		$details = array();
		$stringData = "---------------------------------------\r\n";
		while ($i < count($result)) {
		
			$stringData = $stringData .$result[$i][0]."-".$result[$i][1]."-".$result[$i][2]."-".$result[$i][3]."-".$result[$i][5]."-".$result[$i][6]."\r\n";
			$stringData = $stringData .$result[$i][4]."\r\n";
			$stringData = $stringData ."---------------------------------------\r\n";
			$i +=1;
		}	
		return $stringData;
		//return $result;
	}
	
	
	function getAllAdsByDate($date,$tdate,$type,$news){
		
		if($news == "-"){
			$news = "%";
		}
		
		if($type == "ALL"){
		
		$query = "  SELECT ad_id, (SELECT category_name FROM tbl_ad_category WHERE category_id = ad_category), ad_sub_category, (SELECT display_name FROM tbl_newspapers WHERE newspaper_id = newspapers), ad_body, ent_date, ad_amount 
					FROM tbl_text_ads
					WHERE DATE_FORMAT(ent_date,'%Y-%m-%d') >= '".$this->dateconvert($date,1)."' AND 
						  DATE_FORMAT(ent_date,'%Y-%m-%d') <= '".$this->dateconvert($tdate,1)."' AND 
						  newspapers LIKE '".$news."'
					UNION ALL
					SELECT ad_id, size, page, (SELECT display_name FROM tbl_newspapers WHERE newspaper_id = newspapers), '', added_date, amount 
					FROM tbl_image_ad
					WHERE  DATE_FORMAT(added_date,'%Y-%m-%d') >= '".$this->dateconvert($date,1)."' AND 
						   DATE_FORMAT(added_date,'%Y-%m-%d') <= '".$this->dateconvert($tdate,1)."' AND
						   newspapers LIKE '".$news."' ";
		
		} else if ($type == "CLASSIFIED"){
		$query = "  SELECT ad_id, (SELECT category_name FROM tbl_ad_category WHERE category_id = ad_category), ad_sub_category, (SELECT display_name FROM tbl_newspapers WHERE newspaper_id = newspapers), ad_body, ent_date, ad_amount 
					FROM tbl_text_ads
					WHERE DATE_FORMAT(ent_date,'%Y-%m-%d') >= '".$this->dateconvert($date,1)."' AND 
						  DATE_FORMAT(ent_date,'%Y-%m-%d') <= '".$this->dateconvert($tdate,1)."' AND newspapers LIKE '".$news."'";			
		} else {
		$query = "  SELECT ad_id, size, page, (SELECT display_name FROM tbl_newspapers WHERE newspaper_id = newspapers), '', added_date, amount 
					FROM tbl_image_ad
					WHERE  DATE_FORMAT(added_date,'%Y-%m-%d') >= '".$this->dateconvert($date,1)."' AND 
						   DATE_FORMAT(added_date,'%Y-%m-%d') <= '".$this->dateconvert($tdate,1)."' AND newspapers LIKE '".$news."'";			
		}
		$result = "";
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

	function getAllAdsToUpload($company){
		
		if($company == "" || $company == null || !isset($company)){
			$company =  "%";
		}
		
		$query = "  select (SELECT display_name FROM tbl_newspapers WHERE newspaper_id = newspapers),DATE_FORMAT(ent_date,'%Y-%m-%d') from tbl_text_ads where newspapers LIKE '".$company."' group by newspapers, DATE_FORMAT(ent_date,'%Y-%m-%d')  ORDER BY ent_date";
									
		$result = "";
		$result = $this -> executeQuery($query);	
		
		$i = 0;
		$details = array();
		$details = "";
		while ($i < count($result)) {
			$details["news".($i+1)] = $result[$i][0];
			$details["date".($i+1)] = $result[$i][1];
			$i +=1;
		}
		return $details;
	}					
	
	function getAllRegisteredMembers(){
		
		$query = "  SELECT user_id, first_name, last_name, email, contact_no FROM tbl_users; ";
									
		$result = "";
		$result = $this -> executeQuery($query);	
		
		$i = 0;
		$details = array();
		$details = "";
		while ($i < count($result)) {
			$details["id".($i+1)] = $result[$i][0];
			$details["name".($i+1)] = $result[$i][1]." ".$result[$i][2];
			$details["email".($i+1)] = $result[$i][3];
			$details["contact".($i+1)] = $result[$i][4];
			$i +=1;
		}
		return $details;
	}
	
	function getAllTextAds(){
		
		$query = "  SELECT ad_id, (SELECT category_name FROM tbl_ad_category WHERE category_id = ad_category), ad_sub_category, (SELECT display_name FROM tbl_newspapers WHERE newspaper_id = newspapers), ad_body, publish_date, ad_amount FROM tbl_text_ads; ";
									
		$result = "";
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
	
	function getRefundAds($fdate,$tdate,$news){
		
		if($news == "-"){
			$news = "%";
		}
		
		$query = "  SELECT ad_id, (SELECT category_name FROM tbl_ad_category WHERE category_id = ad_category), ad_sub_category, 
					(SELECT display_name FROM tbl_newspapers WHERE newspaper_id = newspapers), ad_body, publish_date, ad_amount 
					FROM tbl_text_ads 
					WHERE DATE_FORMAT(ent_date,'%Y-%m-%d') >= '".$this->dateconvert($fdate,1)."' AND 
						  DATE_FORMAT(ent_date,'%Y-%m-%d') <= '".$this->dateconvert($tdate,1)."' AND newspapers LIKE '".$news."' AND status = 'REFUND'; ";
									
		$result = "";
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

	function getAllImageAds(){
		
		$query = "  SELECT ad_id, size, page, (SELECT display_name FROM tbl_newspapers WHERE newspaper_id = newspapers), amount, publish_date FROM tbl_image_ad; ";
									
		$result = "";
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
}
?>
