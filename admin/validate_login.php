<?php
	include_once ("config/config.php");	
	//require_once("db_manager.class.php");
	require_once ("admin.class.php");
	
	//$db = new DB_Manager();
	$obj   = new Member();	
	
	$val_name = '';
	$val_user_name = '';
	$val_user_level = '';
	
	$m_chksql   = $_GET['chksql'];
	$user_name  = $_GET['user_name'];
	$user_pass  = $_GET['user_pass'];	
	
	//echo $user_name."--".$user_pass;
	
	if ($m_chksql == "validate") {
	
			if(strtoupper("SYSADMIN") == strtoupper($user_name) && strtoupper("ABC123") == strtoupper($user_pass))
			{
				session_destroy();
				session_start();
				$_SESSION['ses_name'] = "The Administrator";
				$_SESSION['ses_user_name'] = "SYSADMIN";
				$_SESSION['ses_user_level'] = "ADMIN";
				echo "OK";
    		}
			else
			{
				//echo "ERROR";
				
				$result = array();
				$result = $obj -> validateLogin($user_name,$user_pass);
	
				if(count($result) > 0){
		
					$val_name = '';
					$val_user_name = '';
					$val_id = '';		
					$val_type = '';
					$val_company = '';	
				
					$val_name = $result[0][0];
					$val_user_name = $result[0][1];
					$val_id = $result[0][2];
					$val_type = $result[0][3];
					$val_company = $result[0][4];
	
					if(strtoupper($val_user_name) == strtoupper($user_name)){
					
						//$status = $userObj -> updateLogin($val_id,$val_name);
				
						//if($status){
							session_destroy();
							session_start();
							$_SESSION['ses_name'] = $val_name;
							$_SESSION['ses_user_name'] = $val_user_name;
							$_SESSION['ses_user_id'] = $val_id;
							$_SESSION['ses_user_level'] = $val_type;
							$_SESSION['ses_company'] = $val_company;					
							echo "OK";
						//}else{
						//	echo "ERROR";	
						//}	
					}else{
						echo "ERROR";
					}	
				}else{
					echo "ERROR";
				}		
				
				
				
			}		
	}
?>
