<?php
	include_once ("config/config.php");	
	require_once("db_manager.class.php");
	
	$db = new DB_Manager();
	
	$val_name = '';
	$val_user_name = '';
	$val_user_level = '';
	
	$m_chksql   = $_GET['chksql'];
	$user_name  = $_GET['user_name'];
	$user_pass  = $_GET['user_pass'];	
	
	//echo $user_name."--".$user_pass;
	
	if ($m_chksql == "validate") {
	
		$query = " SELECT COUNT(*) 
				   FROM tbl_users 
				   WHERE UPPER(user_name) = UPPER('".$user_name."') AND 
				 		 UPPER(user_password)  = UPPER('".$user_pass."'); ";
						 
		$result = $db -> executeQuery($query);
			 
		$count = 0;
		$count = $result[0][0];
	
		if($count > 0){
		
			$query = " SELECT first_name,user_name,user_level,user_id
					   FROM tbl_users 
					   WHERE UPPER(user_name) = UPPER('".$user_name."') AND 
					 		 UPPER(user_password)  = UPPER('".$user_pass."'); ";
							 
			$result = $db -> executeQuery($query);				 
		
			$val_name = $result[0][0];
			$val_user_name = $result[0][1];
			$val_user_level = $result[0][2];
			$val_user_id = $result[0][3];

			//echo $val_name."--".$val_user_name;
			
			if(strtoupper($val_user_name) == strtoupper($user_name))
			{
				session_destroy();
				session_start();
				$_SESSION['ses_name'] = strtoupper($val_name);
				$_SESSION['ses_user_name'] = strtoupper($val_user_name);
				$_SESSION['ses_user_level'] = $val_user_level;
				$_SESSION['ses_user_id'] = $val_user_id;
				echo "OK";
    		}
			else
			{
				echo "ERROR";
			}
		}
		else
		{
			echo "ERROR";
		}
	}
?>
