<?php

	session_start();

	$host = "localhost";
	$user = "root";
	$pass = "";
	$db = "papernet";
	
$m_chksql = $_GET['chksql'];
	
if($m_chksql == "register_user")
{
	$m_user_id    = $_GET['user_id'];
	$m_user_name  = $_GET['user_name'];
	$m_password   = $_GET['password'];
	$m_name       = $_GET['name'];
	$m_email      = $_GET['email'];
	$m_mobile_no  = $_GET['mobile_no'];
	$m_user_level = $_GET['user_level'];
	$m_company = $_GET['company'];
	
	$connect = mysql_connect($host,$user,$pass) or die ("Unable to connect");
	mysql_select_db($db) or die ("Unamble to select database");
	
	$query = " INSERT into papernet.tbl_users ".
			 " (user_id,user_name,user_password,first_name,email,contact_no,user_level,company) ".
			 " VALUES ('".$m_user_id."','".$m_user_name."','".$m_password."','".$m_name."','".$m_email."','".$m_mobile_no."','".$m_user_level."','".$m_company."')";

	
	mysql_query($query) or die ("Error in query : $query.".mysql_error());
	mysql_close($connect);
	
	echo "New User '".$m_user_name."' Saved Successfully! Click <a href='add_user.php'>here</a> to add another user!";	
}

if($m_chksql == "register_category")
{
	$db = "papernet";
	$m_category_id    = $_GET['category_id'];
	$m_category_name  = $_GET['category_name'];
	
	$connect = mysql_connect($host,$user,$pass) or die ("Unable to connect");
	mysql_select_db($db) or die ("Unamble to select database");
	
	$query = " INSERT into papernet.tbl_ad_category ".
			 " VALUES ('".$m_category_id."',UPPER('".$m_category_name."'))";

	
	mysql_query($query) or die ("Error in query : $query.".mysql_error());
	mysql_close($connect);
	
	echo "New Category '".$m_category_name."' Saved Successfully! Click <a href='add_category.php'>here</a> to add another Category!";	
}

if($m_chksql == "register_subcategory")
{
	$db = "papernet";
	$m_category_id    = $_GET['category_id'];
	$m_category_name  = $_GET['subcategory_name'];
	
	$connect = mysql_connect($host,$user,$pass) or die ("Unable to connect");
	mysql_select_db($db) or die ("Unamble to select database");
	
	$query = " INSERT into papernet.tbl_ad_sub_category ".
			 " VALUES ('".$m_category_id."','".$m_category_name."')";

	
	mysql_query($query) or die ("Error in query : $query.".mysql_error());
	mysql_close($connect);
	
	echo "New Sub Category '".$m_category_name."' Saved Successfully! Click <a href='add_subcategory.php'>here</a> to add another Sub Category!";	
}

else if($m_chksql == "save_modified_user")
{
	$m_user_id    = $_GET['user_id'];
	$m_user_name  = $_GET['user_name'];
	$m_password   = $_GET['password'];
	$m_act_name   = $_GET['act_name'];
	$m_email      = $_GET['email'];
	$m_mobile_no  = $_GET['mobile_no'];
	
	$connect = mysql_connect($host,$user,$pass) or die ("Unable to connect");
	mysql_select_db($db) or die ("Unamble to select database");
	
	$query = " UPDATE papernet.tbl_users ".
			 " SET ".
			 " 	user_name = '".$m_user_name."', ".
			 " 	user_password  = '".$m_password."', ".
			 " 	first_name      = '".$m_act_name."', ".
			 " 	email     = '".$m_email."', ".
			 "	contact_no = '".$m_mobile_no."' ".
			 " WHERE user_id   = ".$m_user_id." ";

	
	
	mysql_query($query) or die ("Error in query : $query.".mysql_error());
	mysql_close($connect);
	
	echo "User Id- '".$m_user_id."' Modified Successfully! Click <a href='add_user.php'>here</a> to modify another user!";	
}


else if($m_chksql == "save_modified_category")
{
	$db = "papernet";
	$m_category_id    = $_GET['category_id'];
	$m_category_name  = $_GET['category_name'];
	
	$connect = mysql_connect($host,$user,$pass) or die ("Unable to connect");
	mysql_select_db($db) or die ("Unamble to select database");
	
	$query = " UPDATE papernet.tbl_ad_category ".
			 " SET category_name = '".$m_category_name."' ".
			 " WHERE category_id   = ".$m_category_id." ";

	
	
	mysql_query($query) or die ("Error in query : $query.".mysql_error());
	mysql_close($connect);
	
	echo "Category Id- '".$m_category_id."' Modified Successfully! Click <a href='add_category.php'>here</a> to modify another Category!";	
}

else if($m_chksql == "save_modified_subcategory")
{
	$db = "papernet";
	$m_category_id    = $_GET['category_id'];
	$m_sub_category_name  = $_GET['category_name'];
	
	$connect = mysql_connect($host,$user,$pass) or die ("Unable to connect");
	mysql_select_db($db) or die ("Unamble to select database");
	
	$query = " UPDATE papernet.tbl_ad_sub_category ".
			 " SET ".
			 " 	sub_category_name = '".$m_sub_category_name."' ".
			 " WHERE category_id   = ".$m_category_id." ";

	
	
	mysql_query($query) or die ("Error in query : $query.".mysql_error());
	mysql_close($connect);
	
	echo "Sub Category Id- '".$m_sub_category_name."' Modified Successfully! Click <a href='add_subcategory.php'>here</a> to modify another Sub Category!";	
}

else if($m_chksql == "save_price")
{
	$db = "papernet";
	$m_newspaper  = $_GET['newspaper'];
	$m_noof_words = $_GET['noof_words'];
	$m_ad_type    = $_GET['ad_type'];
	$m_ad_amount  = $_GET['ad_amount'];	
	
	$connect = mysql_connect($host,$user,$pass) or die ("Unable to connect");
	mysql_select_db($db) or die ("Unamble to select database");
	
	$query = " INSERT into papernet.tbl_ad_prices (newspaper_id, no_of_words, amount, ad_type) ".
			 " VALUES ('".$m_newspaper."','".$m_noof_words."','".$m_ad_amount."','".$m_ad_type."')";

	
	mysql_query($query) or die ("Error in query : $query.".mysql_error());
	mysql_close($connect);
	
	echo "New Price '".$m_ad_amount."' Saved Successfully! Click <a href='add_price.php'>here</a> to add another Price!";	
}

else if($m_chksql == "save_newspaper")
{
	$db = "papernet";
	$m_newspaper_id  = $_GET['newspaper_id'];
	$m_newspaper_name = $_GET['newspaper_name'];
	$m_disp_name    = $_GET['newspaper_disp_name'];
	
	$connect = mysql_connect($host,$user,$pass) or die ("Unable to connect");
	mysql_select_db($db) or die ("Unamble to select database");
	
	$query = " INSERT into papernet.tbl_newspapers (newspaper_id, newspaper_name, display_name) ".
			 " VALUES ('".$m_newspaper_id."','".$m_newspaper_name."','".$m_disp_name."')";

	
	mysql_query($query) or die ("Error in query : $query.".mysql_error());
	mysql_close($connect);
	
	echo "New Newspaper '".$m_disp_name."' Saved Successfully! Click <a href='add_newspaper.php'>here</a> to add another Newspaper!";	
}

else if($m_chksql == "edit_newspaper")
{
	$db = "papernet";
	$m_newspaper_id  = $_GET['newspaper_id'];
	$m_newspaper_name = $_GET['newspaper_name'];
	$m_disp_name    = $_GET['newspaper_disp_name'];
	
	$connect = mysql_connect($host,$user,$pass) or die ("Unable to connect");
	mysql_select_db($db) or die ("Unamble to select database");
	
	$query = " UPDATE papernet.tbl_newspapers  ".
	         " SET newspaper_name='".$m_newspaper_name."', ".
			 "     display_name='".$m_disp_name."' ".
			 " WHERE newspaper_id = '".$m_newspaper_id."' ";

	
	mysql_query($query) or die ("Error in query : $query.".mysql_error());
	mysql_close($connect);
	
	echo "Newspaper '".$m_disp_name."' Edit Successfully! Click <a href='add_newspaper.php'>here</a> to edit another Newspaper!";	
}

else if($m_chksql == "delete_user")
{
	$m_user_id    = $_GET['user_id'];
	
	$connect = mysql_connect($host,$user,$pass) or die ("Unable to connect");
	mysql_select_db($db) or die ("Unamble to select database");
	
	//$query = " CALL papernet.delete_user_details(); ";
	
	$query = " DELETE FROM papernet.tbl_users ".
    		 " WHERE user_id = ".$m_user_id." ";
	
	
	mysql_query($query) or die ("Error in query : $query.".mysql_error());
	mysql_close($connect);
	
	echo "User Id- '".$m_user_id."' Deleted Successfully! Click <a href='add_user.php'>here</a> to modify another user!";	
}

else if($m_chksql == "delete_category")
{
	$db = "papernet";
	$m_category_id    = $_GET['category_id'];
	
	$connect = mysql_connect($host,$user,$pass) or die ("Unable to connect");
	mysql_select_db($db) or die ("Unamble to select database");
	
	$query = " DELETE FROM papernet.tbl_ad_category ".
    		 " WHERE category_id = ".$m_category_id." ";
	
	
	mysql_query($query) or die ("Error in query : $query.".mysql_error());
	mysql_close($connect);
	
	echo "Category Id- '".$m_category_id."' Deleted Successfully! Click <a href='add_category.php'>here</a> to modify another Category!";	
}

else if($m_chksql == "delete_subcategory")
{
	$db = "papernet";
	$m_category_id    = $_GET['category_id'];
	$m_sub_category   = $_GET['sub_category'];
	
	$connect = mysql_connect($host,$user,$pass) or die ("Unable to connect");
	mysql_select_db($db) or die ("Unamble to select database");
	
	$query = " DELETE FROM papernet.tbl_ad_sub_category ".
    		 " WHERE category_id = ".$m_category_id." and sub_category_name = '".$m_sub_category."'; ";
	
	
	mysql_query($query) or die ("Error in query : $query.".mysql_error());
	mysql_close($connect);
	
	echo "Sub Category - '".$m_sub_category."' Deleted Successfully! Click <a href='add_subcategory.php'>here</a> to delete another Sub Category!";	
}


else if($m_chksql == "delete_newspaper")
{
	$db = "papernet";
	$m_newspaper_id  = $_GET['newspaper_id'];
	$m_disp_name    = $_GET['newspaper_disp_name'];
	
	$connect = mysql_connect($host,$user,$pass) or die ("Unable to connect");
	mysql_select_db($db) or die ("Unamble to select database");
	
	$query = " DELETE FROM papernet.tbl_newspapers ".
    		 " WHERE newspaper_id = ".$m_newspaper_id." ; ";
	
	
	mysql_query($query) or die ("Error in query : $query.".mysql_error());
	mysql_close($connect);
	
	echo "Newspaper - '".$m_disp_name."' Deleted Successfully! Click <a href='add_newspaper.php'>here</a> to delete another Newspaper";	
}

if($m_chksql == "upload_ads"){
	$return_result = "FALSE";
	$db = "papernet";
	$m_date = $_GET['date'];
	
	$connect = mysql_connect($host,$user,$pass) or die ("Unable to connect");
	mysql_select_db($db) or die ("Unamble to select database");
	
	$query = "  SELECT ad_id,ad_body FROM tbl_advertisement WHERE ent_date = '".$m_date."'; ";
			 
	mysql_query($query) or die ("Error in query : $query.".mysql_error());
	$result = mysql_query($query) or die ("Error in query : $query.".mysql_error());
	$stringData = "";
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		$stringData = $stringData .$row['ad_id']."-".$row['ad_body']."\r\n";
			 
	}
	//$out_data = $out_data ."</table>";
	mysql_free_result($result);
	mysql_close($connect);	
		
		
	//$date = date("d-M-Y");// g:i:s
	$myFile = "C:\\wamp\\www\\BackOffice\\Ads\\".$m_date."_Ads.txt";
			
	if (file_exists($myFile)){
		$fh = fopen($myFile, 'a') or die("can't open file");
		fwrite($fh, $stringData);		
	}else{
		$fh = fopen($myFile, 'w') or die("can't open file");
		fwrite($fh, $stringData);
	}
	fclose($fh);
	
	$connect = mysql_connect($host,$user,$pass) or die ("Unable to connect");
	mysql_select_db($db) or die ("Unamble to select database");
	
	$query = " UPDATE tbl_advertisement ".
			 " SET send_status = 'PROCESSED' ".
    		 " WHERE ent_date = '".$m_date."' ; ";
	
	
	mysql_query($query) or die ("Error in query : $query.".mysql_error());
	mysql_close($connect);	
	
	$return_result = "TRUE";	
	echo $return_result;
}

function dateconvert($date,$func) 
{
	if ($func == 1)
	{ //insert conversion
		list($month, $day, $year) = split('[/.-]', $date);
		$date = "$year-$month-$day";
		return $date;
	}
	if ($func == 2)
	{ //output conversion
		list($year, $month, $day) = split('[-.]', $date);
		$date = "$month/$day/$year";
		return $date;
	}
} 


?>
