<?php
require_once("db_manager.class.php");

class User extends DB_Manager{

	function validateUserName($user_name){
	
		$query = " SELECT COUNT(*) FROM tbl_users WHERE user_name = '".$user_name."'; ";

		$result = "";
		$result = $this -> executeQuery($query);
		
		return $result[0][0];		
	}
	
	function createUser($userName,$password,$salu,$fname,$lname,$nic_no,$b_date,$status,$email,$tp,$home_addr,$company,$desig,$ofc_phone,$ofc_addr,$promo,$terms){
	
		$query = " INSERT INTO tbl_users 
				  (user_name, user_password, salutation, first_name, last_name, id_no, maritial_status, email, contact_no, home_address, company_name, designation, officephone_no, office_address, promotion_status, condition_status, date_of_birth, user_level) 
				  VALUES('".$userName."','".$password."','".$salu."','".$fname."','".$lname."','".$nic_no."','".$status."','".$email."','".$tp."','".$home_addr."','".$company."','".$desig."','".$ofc_phone."','".$ofc_addr."','".$promo."','".$terms."','".$this->dateconvert($b_date,1)."','NORMAL') ";
		//$this -> logData("QUERY - ".$query);
		$result = "";
		$result = $this -> executeInsertQuery($query);
		//$this -> logData("RESULT - ".$result);
		return $result;		
	}
	
	function getUserDetailsById($id){
	
		$query = "  SELECT user_name, user_password, salutation, first_name, last_name, id_no, maritial_status, email, contact_no, home_address, company_name, 
					designation, officephone_no, office_address, promotion_status, condition_status, date_of_birth, user_level
					FROM tbl_users
					WHERE user_id = '".$id."'; ";
				 
		$result = "";
		$result = $this -> executeQuery($query);	
		
		if(count($result) > 0){
			$details = array("user_name"=>$result[0][0],"user_password"=>$result[0][1],"salutation"=>$result[0][2],"first_name"=>$result[0][3],"last_name"=>$result[0][4],
							 "id_no"=>$result[0][5],"maritial_status"=>$result[0][6],"email"=>$result[0][7],"contact_no"=>$result[0][8],
							 "home_address"=>$result[0][9],"company_name"=>$result[0][10],"designation"=>$result[0][11],
							 "officephone_no"=>$result[0][12],"office_address"=>$result[0][13],"promotion_status"=>$result[0][14],"condition_status"=>$result[0][15],
							 "date_of_birth"=>$this -> dateconvert($result[0][16],2),"user_level"=>$result[0][17]);
		
			return $details;
		}else{
			return "NO_DATA";
		}
	
	}	
}
?>
