<?php

	session_start();

	$host = "localhost";
	$user = "root";
	$pass = "UcSc2009";
	
	
$m_chksql = $_GET['chksql'];
	


if($m_chksql == "get_user_id")
{	
	$db = "papernet";
	$connect = mysql_connect($host,$user,$pass) or die ("Unable to connect");
	mysql_select_db($db) or die ("Unamble to select database");
	
	$query = " SELECT MAX(user_id)+1 FROM papernet.tbl_users; ";
	
	mysql_query($query) or die ("Error in query : $query.".mysql_error());
	$result = mysql_query($query) or die ("Error in query : $query.".mysql_error());
	$user_id = "";
	if(mysql_num_rows($result) > 0)
	{
		$row = mysql_fetch_row($result);
		$user_id = $row[0];
	}
	echo $user_id;
	mysql_free_result($result);
	mysql_close($connect);	
}

if($m_chksql == "get_newspaper_id")
{	
	$db = "papernet";
	$connect = mysql_connect($host,$user,$pass) or die ("Unable to connect");
	mysql_select_db($db) or die ("Unamble to select database");
	
	$query = " SELECT MAX(newspaper_id)+1 FROM papernet.tbl_newspapers; ";
	
	mysql_query($query) or die ("Error in query : $query.".mysql_error());
	$result = mysql_query($query) or die ("Error in query : $query.".mysql_error());
	$user_id = "";
	if(mysql_num_rows($result) > 0)
	{
		$row = mysql_fetch_row($result);
		$user_id = $row[0];
	}
	echo $user_id;
	mysql_free_result($result);
	mysql_close($connect);	
}

else if($m_chksql == "get_category_id")
{	
	$db = "papernet";
	$connect = mysql_connect($host,$user,$pass) or die ("Unable to connect");
	mysql_select_db($db) or die ("Unamble to select database");
	
	$query = " SELECT MAX(category_id)+1 FROM papernet.tbl_ad_category; ";
	
	mysql_query($query) or die ("Error in query : $query.".mysql_error());
	$result = mysql_query($query) or die ("Error in query : $query.".mysql_error());
	$user_id = "";
	if(mysql_num_rows($result) > 0)
	{
		$row = mysql_fetch_row($result);
		$user_id = $row[0];
	}
	echo $user_id;
	mysql_free_result($result);
	mysql_close($connect);	
}


else if($m_chksql == "update_user")
{
	$db = "papernet";
	$m_user_level = $_GET['user_level'];
	
	$connect = mysql_connect($host,$user,$pass) or die ("Unable to connect");
	mysql_select_db($db) or die ("Unamble to select database");
		
	$query = " SELECT user_id,user_name FROM papernet.tbl_users WHERE user_level = '".$m_user_level."'; ";
			 
	mysql_query($query) or die ("Error in query : $query.".mysql_error());
	$result = mysql_query($query) or die ("Error in query : $query.".mysql_error());
	$m_option = "";
	$m_select = "";
	$m_out = "";
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		$m_option = $m_option."<option value='".$row['user_id']."'>".$row['user_id']." - ".$row['user_name']."</option>";
	}
	$m_select = "<select name='user_names' size='1' id='user_names' class='body'>".$m_option."</select>";	
	echo $m_select;
		
	mysql_free_result($result);
	mysql_close($connect);	
}

else if($m_chksql == "load_subcategory")
{
	$db = "papernet";
	$m_category_id = $_GET['category_id'];
	
	$connect = mysql_connect($host,$user,$pass) or die ("Unable to connect");
	mysql_select_db($db) or die ("Unamble to select database");
		
	$query = " SELECT category_id,sub_category_name FROM papernet.tbl_ad_sub_category WHERE category_id = '".$m_category_id."'; ";
			 
	mysql_query($query) or die ("Error in query : $query.".mysql_error());
	$result = mysql_query($query) or die ("Error in query : $query.".mysql_error());
	$m_option = "";
	$m_select = "";
	$m_out = "";
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		$m_option = $m_option."<option value='".$row['sub_category_name']."'>".$row['sub_category_name']."</option>";
	}
	$m_select = "<select name='subcategory_names' size='1' id='subcategory_names' class='body'>".$m_option."</select>";	
	echo $m_select;
		
	mysql_free_result($result);
	mysql_close($connect);	
}

else if($m_chksql == "load_subcategory_1")
{
	$db = "papernet";
	$m_category_id = $_GET['category_id'];
	
	$connect = mysql_connect($host,$user,$pass) or die ("Unable to connect");
	mysql_select_db($db) or die ("Unamble to select database");
		
	$query = " SELECT category_id,sub_category_name FROM papernet.tbl_ad_sub_category WHERE category_id = '".$m_category_id."'; ";
			 
	mysql_query($query) or die ("Error in query : $query.".mysql_error());
	$result = mysql_query($query) or die ("Error in query : $query.".mysql_error());
	$m_option = "";
	$m_select = "";
	$m_out = "";
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		$m_option = $m_option."<option value='".$row['sub_category_name']."'>".$row['sub_category_name']."</option>";
	}
	$m_select = "<select name='sub_cat_select' size='1' id='sub_cat_select' class='text'>".$m_option."</select>";	
	echo $m_select;
		
	mysql_free_result($result);
	mysql_close($connect);	
}

else if($m_chksql == "load_categories")
{	
	$db = "papernet";
	$connect = mysql_connect($host,$user,$pass) or die ("Unable to connect");
	mysql_select_db($db) or die ("Unamble to select database");
		
	$query = " SELECT category_id,category_name FROM papernet.tbl_ad_category ORDER BY category_id; ";
			 
	mysql_query($query) or die ("Error in query : $query.".mysql_error());
	$result = mysql_query($query) or die ("Error in query : $query.".mysql_error());
	$m_select = "";
	$m_option = "";
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		$m_option = $m_option."<option value='".$row['category_id']."'>".$row['category_id']." - ".$row['category_name']."</option>";
	}
	$m_select = "<select name='cateogry_names' size='1' id='cateogry_names' class='body' onChange='check_option();'><option value=''>--Select Category--</option>".$m_option."</select>";	
	echo $m_select;
		
	mysql_free_result($result);
	mysql_close($connect);	
}

else if($m_chksql == "load_categories_1")
{	
	$db = "papernet";
	$connect = mysql_connect($host,$user,$pass) or die ("Unable to connect");
	mysql_select_db($db) or die ("Unamble to select database");
		
	$query = " SELECT category_id,category_name FROM papernet.tbl_ad_category ORDER BY category_id; ";
			 
	mysql_query($query) or die ("Error in query : $query.".mysql_error());
	$result = mysql_query($query) or die ("Error in query : $query.".mysql_error());
	$m_select = "";
	$m_option = "";
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		$m_option = $m_option."<option value='".$row['category_id']."'>".$row['category_id']." - ".$row['category_name']."</option>";
	}
	$m_select = "<select name='category_select' size='1' id='category_select' class='text' onChange='load_sub_categories();'><option value=''>--Select Category--</option>".$m_option."</select>";	
	echo $m_select;
		
	mysql_free_result($result);
	mysql_close($connect);	
}

else if($m_chksql == "load_edit_categories")
{	
	$db = "papernet";
	$connect = mysql_connect($host,$user,$pass) or die ("Unable to connect");
	mysql_select_db($db) or die ("Unamble to select database");
		
	$query = " SELECT category_id,category_name FROM papernet.tbl_ad_category ORDER BY category_id; ";
			 
	mysql_query($query) or die ("Error in query : $query.".mysql_error());
	$result = mysql_query($query) or die ("Error in query : $query.".mysql_error());
	$m_select = "";
	$m_option = "";
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		$m_option = $m_option."<option value='".$row['category_id']."'>".$row['category_id']." - ".$row['category_name']."</option>";
	}
	$m_select = "<select name='edit_cateogry_names' size='1' id='edit_cateogry_names' class='body' onChange='check_option();'><option value=''>--Select Category--</option>".$m_option."</select>";	
	echo $m_select;
		
	mysql_free_result($result);
	mysql_close($connect);	
}


else if($m_chksql == "load_newspapers")
{	
	$db = "papernet";
	$connect = mysql_connect($host,$user,$pass) or die ("Unable to connect");
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
	$m_select = "<select name='newspapers_select' id='newspapers_select' class='body' onChange='check_errors();'><option value=''>--Select Newspaper--</option>".$m_option."</select>";	
	echo $m_select;
		
	mysql_free_result($result);
	mysql_close($connect);	
}


else if($m_chksql == "load_newspapers_edit")
{	
	$db = "papernet";
	$connect = mysql_connect($host,$user,$pass) or die ("Unable to connect");
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
	$m_select = "<select name='edit_newspapers_select' id='edit_newspapers_select' class='body' onChange=''><option value='-'>--Select Newspaper--</option>".$m_option."</select>";	
	echo $m_select;
		
	mysql_free_result($result);
	mysql_close($connect);	
}

else if($m_chksql == "edit_user")
{	
	$db = "papernet";
	$m_user_id  = $_GET['user_id'];
	$m_user_level = $_GET['user_level'];
	
	$connect = mysql_connect($host,$user,$pass) or die ("Unable to connect");
	mysql_select_db($db) or die ("Unamble to select database");
		
	$query = " SELECT user_id,user_name,user_password,first_name,email,contact_no FROM papernet.tbl_users where user_id = '".$m_user_id."' and user_level = '".$m_user_level."'; ";
			 
	mysql_query($query) or die ("Error in query : $query.".mysql_error());
	$result = mysql_query($query) or die ("Error in query : $query.".mysql_error());
	$m_out = "";
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		$m_out = "<tr> ".
			"<input type=\"hidden\" name=\"hid_user_id\" value=\"".$row['user_id']."\"> ".
			"<input type=\"hidden\" name=\"hid_user_name\" value=\"".$row['user_name']."\"> ".
			"<input type=\"hidden\" name=\"hid_user_pass\" value=\"".$row['user_password']."\"> ".
			"<input type=\"hidden\" name=\"hid_act_name\" value=\"".$row['first_name']."\"> ".
			"<input type=\"hidden\" name=\"hid_email\" value=\"".$row['email']."\"> ".
			"<input type=\"hidden\" name=\"hid_mobile_no\" value=\"".$row['contact_no']."\"> ".
            "<td height=\"159\">&nbsp;</td> ".
            "<td><fieldset class=\"body\"><legend>User Details</legend> ".
            "<table width=\"100%\" border=\"0\" class=\"body\"> ".
            "<tr>  ".
            "<td width=\"8%\">&nbsp;</td> ".
            "<td width=\"17%\">&nbsp;</td> ".
            "<td width=\"23%\">&nbsp;</td> ".
            "<td width=\"35%\">&nbsp;</td> ".
            "<td width=\"17%\">&nbsp;</td> ".
            "</tr> ".
            "<tr>  ".
            "<td>&nbsp;</td> ".
            "<td>User Name</td> ".
            "<td><input type=\"text\" name=\"mod_user_name\" value=\"".$row['user_name']."\"  class=\"body\" onChange=\"clear_error_msg();\"></td> ".
            "<td>&nbsp;</td> ".
            "<td>&nbsp;</td> ".
            "</tr> ".
            "<tr>  ".
            "<td>&nbsp;</td> ".
            "<td>Password</td> ".
            "<td><input type=\"password\" name=\"mod_user_pass\" value=\"".$row['user_password']."\"  class=\"body\" onChange=\"clear_error_msg();\"></td> ".
            "<td>&nbsp;</td> ".
            "<td>&nbsp;</td> ".
            "</tr> ".
            "<tr>  ".
            "<td>&nbsp;</td> ".
            "<td>Name</td> ".
            "<td><input type=\"text\" name=\"mod_act_name\" value=\"".$row['first_name']."\"  class=\"body\" onChange=\"clear_error_msg();\"></td> ".
            "<td>&nbsp;</td> ".
            "<td>&nbsp;</td> ".
            "</tr> ".
            "<tr>  ".
            "<td>&nbsp;</td> ".
            "<td>Email</td> ".
            "<td><input type=\"text\" name=\"mod_email\" value=\"".$row['email']."\"  class=\"body\" onChange=\"clear_error_msg();\"></td> ".
            "<td>&nbsp;</td> ".
            "<td>&nbsp;</td> ".
            "</tr> ".
            "<tr>  ".
            "<td>&nbsp;</td> ".
            "<td>Mobile</td> ".
            "<td><input type=\"text\" name=\"mod_mobile_no\" value=\"".$row['contact_no']."\"  class=\"body\"  maxlength=\"10\" onChange=\"clear_error_msg();\"></td> ".
            "<td>&nbsp;</td> ".
            "<td>&nbsp;</td> ".
            "</tr> ".
            "<tr> ".
            "<td>&nbsp;</td> ".
            "<td>&nbsp;</td> ".
            "<td>&nbsp;</td> ".
            "<td>&nbsp;</td> ".
            "<td>&nbsp;</td> ".
            "</tr> ".			
            "<tr> ".
            "<td>&nbsp;</td> ".
            "<td>&nbsp;</td> ".
            "<td><input type=\"button\" name=\"update_button\" value=\"Update Details\" class=\"body\" onClick=\"update_user_details();\"></td> ".
            "<td><div id=\"modify_msg\"  class=\"error\"></div></td> ".
            "<td>&nbsp;</td> ".
            "</tr> ".
            "</table> ".
            "<p>&nbsp;</p> ".
            "</fieldset>&nbsp;</td> ".
            "<td>&nbsp;</td> ".
          	"</tr> ";
	}	
	echo $m_out;
		
	mysql_free_result($result);
	mysql_close($connect);	
}

else if($m_chksql == "edit_category")
{
	$db = "papernet";
	$m_category_id  = $_GET['category_id'];
	
	$connect = mysql_connect($host,$user,$pass) or die ("Unable to connect");
	mysql_select_db($db) or die ("Unamble to select database");
		
	$query = " SELECT category_id,category_name FROM papernet.tbl_ad_category WHERE category_id = '".$m_category_id."'; ";
			 
	mysql_query($query) or die ("Error in query : $query.".mysql_error());
	$result = mysql_query($query) or die ("Error in query : $query.".mysql_error());
	$m_out = "";
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		$m_out = "<tr> ".
			"<input type=\"hidden\" name=\"hid_category_id\" value=\"".$row['category_id']."\"> ".
			"<input type=\"hidden\" name=\"hid_category_name\" value=\"".$row['category_name']."\"> ".
            "<td height=\"159\">&nbsp;</td> ".
            "<td><fieldset class=\"fieldset\"><legend class='legend'>Category Details</legend> ".
            "<table width=\"100%\" border=\"0\" class='body'> ".
            "<tr>  ".
            "<td width=\"11%\">&nbsp;</td> ".
            "<td width=\"20%\">&nbsp;</td> ".
            "<td width=\"23%\">&nbsp;</td> ".
            "<td width=\"17%\">&nbsp;</td> ".
            "<td width=\"29%\">&nbsp;</td> ".
            "</tr> ".
            "<tr>  ".
            "<td>&nbsp;</td> ".
            "<td>Category Name</td> ".
            "<td><input type=\"text\" name=\"mod_category_name\" value=\"".$row['category_name']."\"  class=\"body\" onChange=\"clear_error_msg();\"></td> ".
            "<td>&nbsp;</td> ".
            "<td>&nbsp;</td> ".
            "</tr> ".
            "<tr> ".
            "<td>&nbsp;</td> ".
            "<td>&nbsp;</td> ".
            "<td>&nbsp;</td> ".
            "<td>&nbsp;</td> ".
            "<td>&nbsp;</td> ".
            "</tr> ".			
            "<tr> ".
            "<td>&nbsp;</td> ".
            "<td>&nbsp;</td> ".
            "<td><input type=\"button\" name=\"update_button\" value=\"Update Details\" class=\"body\" onClick=\"update_category_details();\"></td> ".
            "<td><div id=\"modify_msg\"  class=\"error\"></div></td> ".
            "<td>&nbsp;</td> ".
            "</tr> ".
            "</table> ".
            "<p>&nbsp;</p> ".
            "</fieldset>&nbsp;</td> ".
            "<td>&nbsp;</td> ".
          	"</tr> ";
	}	
	echo $m_out;
		
	mysql_free_result($result);
	mysql_close($connect);	
}

else if($m_chksql == "edit_subcategory")
{
	$db = "papernet";
	$m_category_id  = $_GET['category_id'];
	$m_sub_category  = $_GET['sub_category'];
	
	$connect = mysql_connect($host,$user,$pass) or die ("Unable to connect");
	mysql_select_db($db) or die ("Unamble to select database");
		
	$query = " SELECT category_id,sub_category_name FROM papernet.tbl_ad_sub_category WHERE category_id = '".$m_category_id."' AND sub_category_name = '".$m_sub_category."'; ";
			 
	mysql_query($query) or die ("Error in query : $query.".mysql_error());
	$result = mysql_query($query) or die ("Error in query : $query.".mysql_error());
	$m_out = "";
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		$m_out = "<tr> ".
			"<input type=\"hidden\" name=\"hid_category_id\" value=\"".$row['category_id']."\"> ".
			"<input type=\"hidden\" name=\"hid_sub_category\" value=\"".$row['sub_category_name']."\"> ".
            "<td height=\"159\">&nbsp;</td> ".
            "<td><fieldset class=\"fieldset\"><legend class='legend'>Sub Category Details</legend> ".
            "<table width=\"100%\" border=\"0\" class='body'> ".
            "<tr>  ".
            "<td width=\"11%\">&nbsp;</td> ".
            "<td width=\"20%\">&nbsp;</td> ".
            "<td width=\"23%\">&nbsp;</td> ".
            "<td width=\"17%\">&nbsp;</td> ".
            "<td width=\"29%\">&nbsp;</td> ".
            "</tr> ".
            "<tr>  ".
            "<td>&nbsp;</td> ".
            "<td>Category Name</td> ".
            "<td><input type=\"text\" name=\"mod_sub_category_name\" value=\"".$row['sub_category_name']."\"  class=\"body\" onChange=\"clear_error_msg();\"></td> ".
            "<td>&nbsp;</td> ".
            "<td>&nbsp;</td> ".
            "</tr> ".
            "<tr> ".
            "<td>&nbsp;</td> ".
            "<td>&nbsp;</td> ".
            "<td>&nbsp;</td> ".
            "<td>&nbsp;</td> ".
            "<td>&nbsp;</td> ".
            "</tr> ".			
            "<tr> ".
            "<td>&nbsp;</td> ".
            "<td>&nbsp;</td> ".
            "<td><input type=\"button\" name=\"update_button\" value=\"Update Details\" class=\"body\" onClick=\"update_sub_category_details();\"></td> ".
            "<td><div id=\"modify_msg\"  class=\"error\"></div></td> ".
            "<td>&nbsp;</td> ".
            "</tr> ".
            "</table> ".
            "<p>&nbsp;</p> ".
            "</fieldset>&nbsp;</td> ".
            "<td>&nbsp;</td> ".
          	"</tr> ";
	}	
	echo $m_out;
		
	mysql_free_result($result);
	mysql_close($connect);	
}


else if($m_chksql == "load_advertisement"){
	$db = "papernet";
	$ad_id = $_GET['adId'];
	
	$connect = mysql_connect($host,$user,$pass) or die ("Unable to connect");
	mysql_select_db($db) or die ("Unamble to select database");
	
	$query = " SELECT ad_type, ad_category, ad_sub_category, newspapers, ad_body, publish_date, free_word, ad_amount, ent_date, ent_by, ad_status, ad_layout ".
			 " FROM tbl_advertisement WHERE ad_id = '".$ad_id."'; ";
	
	mysql_query($query) or die ("Error in query : $query.".mysql_error());
	$result = mysql_query($query) or die ("Error in query : $query.".mysql_error());
	$out_data = "";
	if(mysql_num_rows($result) > 0)
	{
		$row = mysql_fetch_row($result);
		$out_data = "<table width='100%' border='0' cellspacing='0' cellpadding='0' class='body'>".
					"<tr><td width='10%' colspan='3'>&nbsp;</td></tr>".		
					"<tr><td width='10%'>&nbsp;</td><td width='80%'><fieldset><legend>Advertisement Details</legend>".
					"<table width='100%' border='0' cellspacing='0' cellpadding='0'>".
					"<tr><td width='11%' colspan='4'>&nbsp;</td></tr>".
					"<tr><td width='11%'>&nbsp;</td><td width='24%'>Ad Type </td><td width='55%'>".$row[0]."</td><td width='10%'>&nbsp;</td></tr>".
					"<tr><td colspan='4'>&nbsp;</td></tr>".
					"<tr><td>&nbsp;</td><td>Ad Category</td><td>".$row[1]."</td><td>&nbsp;</td></tr>".
					"<tr><td colspan='4'>&nbsp;</td></tr>".
					"<tr><td>&nbsp;</td><td>Ad Sub Category</td><td>".$row[2]."</td><td>&nbsp;</td></tr>".
					"<tr><td colspan='4'>&nbsp;</td></tr>".
					"<tr><td>&nbsp;</td><td>Newspapers</td><td>".$row[3]."</td><td>&nbsp;</td></tr>".
					"<tr><td colspan='4'>&nbsp;</td></tr>".
					"<tr><td>&nbsp;</td><td>Advertisement</td><td>".$row[4]."</td><td>&nbsp;</td></tr>".
					"<tr><td colspan='4'>&nbsp;</td></tr>".
					"<tr><td>&nbsp;</td><td>Published Date </td><td>".$row[5]."</td><td>&nbsp;</td></tr>".
					"<tr><td colspan='4'>&nbsp;</td></tr>".
					"<tr><td>&nbsp;</td><td>Free word </td><td>".$row[6]."</td><td>&nbsp;</td></tr>".
					"<tr><td colspan='4'>&nbsp;</td></tr>".
					"<tr><td>&nbsp;</td><td>Ad Amount </td><td>".$row[7]."</td><td>&nbsp;</td></tr>".
					"<tr><td colspan='4'>&nbsp;</td></tr>".
					"<tr><td>&nbsp;</td><td>Entered Date </td><td>".$row[8]."</td><td>&nbsp;</td></tr>".
					"<tr><td colspan='4'>&nbsp;</td></tr>".
					"<tr><td>&nbsp;</td><td>Entered By </td><td>".$row[9]."</td><td>&nbsp;</td></tr>".
					"<tr><td colspan='4'>&nbsp;</td></tr>".
					"<tr><td>&nbsp;</td><td>Ad Status </td><td>".$row[10]."</td><td>&nbsp;</td></tr>".
					"<tr><td colspan='4'>&nbsp;</td></tr>".
					"<tr><td>&nbsp;</td><td>Ad Layout </td><td>".$row[11]."</td><td>&nbsp;</td></tr>".
					"<tr><td colspan='4'>&nbsp;</td></tr>".
					"</table></fieldset></td><td width='10%'>&nbsp;</td>".
					"</tr><tr><td colspan='3'>&nbsp;</td></tr></table>";
	}else{
		$out_data = "No Records Found!";
	}
	
	mysql_free_result($result);
	mysql_close($connect);
	  
	echo $out_data;			
	
}

else if($m_chksql == "load_user"){
	$db = "papernet";
	$user_id = $_GET['user'];
	
	$connect = mysql_connect($host,$user,$pass) or die ("Unable to connect");
	mysql_select_db($db) or die ("Unamble to select database");
	
	$query = " SELECT first_name, last_name, salutation, id_no, date_of_birth, maritial_status, email, mobile_no, ".
			 " landphone_no, home_address, company_name, designation, officephone_no, office_address ".
			 " FROM tbl_users WHERE user_id = '".$user_id."' ; ";
			 
			 // OR user_name LIKE '%".$user_id."%'
	
	mysql_query($query) or die ("Error in query : $query.".mysql_error());
	$result = mysql_query($query) or die ("Error in query : $query.".mysql_error());
	$out_data = "";
	if(mysql_num_rows($result) > 0)
	{
		$row = mysql_fetch_row($result);
		$out_data = "<table width='100%' border='0' cellspacing='0' cellpadding='0' class='body'>".
					"<tr><td width='10%' colspan='3'>&nbsp;</td></tr>".		
					"<tr><td width='10%'>&nbsp;</td><td width='80%'><fieldset><legend>User Details</legend>".
					"<table width='100%' border='0' cellspacing='0' cellpadding='0'>".
					"<tr><td width='11%' colspan='4'>&nbsp;</td></tr>".
					"<tr><td width='11%'>&nbsp;</td><td width='24%'>First Name</td><td width='55%'>".$row[0]."</td><td width='10%'>&nbsp;</td></tr>".
					"<tr><td colspan='4'>&nbsp;</td></tr>".
					"<tr><td>&nbsp;</td><td>Last Name</td><td>".$row[1]."</td><td>&nbsp;</td></tr>".
					"<tr><td colspan='4'>&nbsp;</td></tr>".
					"<tr><td>&nbsp;</td><td>Salutation</td><td>".$row[2]."</td><td>&nbsp;</td></tr>".
					"<tr><td colspan='4'>&nbsp;</td></tr>".
					"<tr><td>&nbsp;</td><td>NIC No</td><td>".$row[3]."</td><td>&nbsp;</td></tr>".
					"<tr><td colspan='4'>&nbsp;</td></tr>".
					"<tr><td>&nbsp;</td><td>Date Of Birth </td><td>".$row[4]."</td><td>&nbsp;</td></tr>".						
					"<tr><td colspan='4'>&nbsp;</td></tr>".
					"<tr><td>&nbsp;</td><td>Martial Status</td><td>".$row[5]."</td><td>&nbsp;</td></tr>".
					"<tr><td colspan='4'>&nbsp;</td></tr>".
					"<tr><td>&nbsp;</td><td>Email </td><td>".$row[6]."</td><td>&nbsp;</td></tr>".
					"<tr><td colspan='4'>&nbsp;</td></tr>".
					"<tr><td>&nbsp;</td><td>Mobile No </td><td>".$row[7]."</td><td>&nbsp;</td></tr>".
					"<tr><td colspan='4'>&nbsp;</td></tr>".
					"<tr><td>&nbsp;</td><td>Land No </td><td>".$row[8]."</td><td>&nbsp;</td></tr>".
					"<tr><td colspan='4'>&nbsp;</td></tr>".
					"<tr><td>&nbsp;</td><td>Address </td><td>".$row[9]."</td><td>&nbsp;</td></tr>".
					"<tr><td colspan='4'>&nbsp;</td></tr>".
					"<tr><td>&nbsp;</td><td>Company Name </td><td>".$row[10]."</td><td>&nbsp;</td></tr>".
					"<tr><td colspan='4'>&nbsp;</td></tr>".
					"<tr><td>&nbsp;</td><td>Designation </td><td>".$row[11]."</td><td>&nbsp;</td></tr>".
					"<tr><td colspan='4'>&nbsp;</td></tr>".
					"<tr><td>&nbsp;</td><td>Office No </td><td>".$row[12]."</td><td>&nbsp;</td></tr>".
					"<tr><td colspan='4'>&nbsp;</td></tr>".
					"<tr><td>&nbsp;</td><td>Office Address </td><td>".$row[13]."</td><td>&nbsp;</td></tr>".									
					"<tr><td colspan='4'>&nbsp;</td></tr>".
					"</table></fieldset></td><td width='10%'>&nbsp;</td>".
					"</tr><tr><td colspan='3'>&nbsp;</td></tr></table>";
	}else{
		$out_data = "No Records Found!";
	}
	
	mysql_free_result($result);
	mysql_close($connect);
	  
	echo $out_data;				
}


else if($m_chksql == "load_newspapers_details"){
	$db = "papernet";
	$newspaper_id = $_GET['newspaper_id'];
	
	$connect = mysql_connect($host,$user,$pass) or die ("Unable to connect");
	mysql_select_db($db) or die ("Unamble to select database");
	
	$query = " SELECT newspaper_name, display_name ".
			 " FROM tbl_newspapers WHERE newspaper_id = '".$newspaper_id."' ; ";
			 
			 // OR user_name LIKE '%".$user_id."%'
	
	mysql_query($query) or die ("Error in query : $query.".mysql_error());
	$result = mysql_query($query) or die ("Error in query : $query.".mysql_error());
	$out_data = "";
	if(mysql_num_rows($result) > 0)
	{
		$row = mysql_fetch_row($result);
		$out_data = "<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='body'>".
            "    <tr> ".
            "      <td width='12%'>&nbsp;</td>".
            "      <td width='19%'>&nbsp;</td>".
            "      <td width='22%'></td>".
            "      <td width='18%'>&nbsp;</td>".
            "      <td width='29%'>&nbsp;</td>".
            "    </tr>".
            "    <tr>".
            "      <td>&nbsp;</td>".
            "      <td>Newspaper Name </td>".
            "      <td>Display Name </td>".
            "      <td colspan='2'><div id='newspaper_err_div' class='error'></div></td>".
            "    </tr>".
            "    <tr> ".
            "      <td>&nbsp;</td>".
            "      <td><input name='newspaper_name_text2' type='text' id='newspaper_name_text2' class='body' value='".$row[0]."' onChange='hide_errors()();'></td>".
            "      <td><input name='newspaper_disp_name_text2' type='text' id='newspaper_disp_name_text2' class='body' value='".$row[1]."' onChange='hide_errors();'></td>".
            "      <td><input name='edit_but' type='button' id='edit_but' value='  Save Details  ' class='body' onClick='edit_newspaper();'></td>".
            "      <td><input name='delete_usr_button' type='button' id='delete_usr_button' value=' Delete Newspaper' class='body' onClick='delete_newspaper();'></td>".
            "    </tr>".
            "    <tr> ".
            "      <td colspan='5'>&nbsp;</td>".
            "    </tr>".
            "    <tr> ".
            "      <td colspan='5'><div id='result_div'></div></td>".
            "    </tr>".			
			"</table>";
	}else{
		$out_data = "No Records Found!";
	}
	
	mysql_free_result($result);
	mysql_close($connect);
	  
	echo $out_data;				
}

else if($m_chksql == "load_prices"){
	$db = "papernet";
	$newspaper = $_GET['newspaper'];
	$ad_type = $_GET['ad_type'];
	
	$connect = mysql_connect($host,$user,$pass) or die ("Unable to connect");
	mysql_select_db($db) or die ("Unamble to select database");
	
	$query = " SELECT no_of_words, amount ".
			 " FROM tbl_ad_prices WHERE newspaper_id = '".$newspaper."' AND ad_type = '".$ad_type."' ; ";
			 
	
	mysql_query($query) or die ("Error in query : $query.".mysql_error());
	$result = mysql_query($query) or die ("Error in query : $query.".mysql_error());
	
	if(mysql_num_rows($result) > 0){
		$out_data = "<fieldset><legend class='body'>Price Details</legend>".
					" <table width='100%' border='0' cellspacing='0' cellpadding='0' class='body'>".
					"      <tr>".
					"        <td colspan='4'>&nbsp;</td>".
					"      </tr>".
					"      <tr>".
					"        <td width='10%'>&nbsp;</td>".
					"        <td width='40%'>No of Words </td>".
					"        <td width='40%'>Amount</td>".
					"        <td width='10%'>&nbsp;</td>".
					"      </tr>";
					
		while($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			$out_data = $out_data . "<tr>".
						 "   <td>&nbsp;</td>".
						 "   <td>".$row['no_of_words']."</td>".
						 "   <td>".$row['amount']."</td>".
						 "   <td>&nbsp;</td>".
						 " </tr>";
		}
		$out_data = $out_data ."</table></fieldset>";
	}else{
		$out_data = "No Records Found!";
	}
	mysql_free_result($result);
	mysql_close($connect);
	  
	echo $out_data;			
	
}


else if($m_chksql == "load_upload_ads"){
	$db = "papernet";
	
	$connect = mysql_connect($host,$user,$pass) or die ("Unable to connect");
	mysql_select_db($db) or die ("Unamble to select database");
	
	$query = "  SELECT date_format(ent_date,'%Y-%m-%d') ent_date, count(ad_id) no_of_ads,ad_status ".
			 "	FROM tbl_advertisement ".
			 "	WHERE ad_status = 'PAID' AND send_status is null ".
			 "	GROUP BY date_format(ent_date,'%Y-%m-%d'),ad_status ".
			 "	ORDER BY date_format(ent_date,'%Y-%m-%d'); ";
			 
	mysql_query($query) or die ("Error in query : $query.".mysql_error());
	$result = mysql_query($query) or die ("Error in query : $query.".mysql_error());
	
	if(mysql_num_rows($result) > 0){
		$out_data = "<table width='100%' border='0' cellspacing='0' cellpadding='0'>".
					"      <tr class='head'>".
					"        <td width='29%'>Entered Date </td>".
					"        <td width='21%'>No. of Ads </td>".
					"        <td width='25%'>Ad status </td>".
					"        <td width='25%'>&nbsp;</td>".				
					"      </tr>";
		$count = 1;			
		while($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			$out_data = $out_data . "<tr class='body'>".
						 "   <td>".$row['ent_date']."</td>".
						 "   <td>".$row['no_of_ads']."</td>".
						 "   <td>".$row['ad_status']."</td>".
						 "   <td><input type='button' name='send_but".$count."' value=' Process ' class='body' onClick=write_ads(".$count.");></td>".
						 "	 <input type='hidden' name='ent_date_".$count."'  id='ent_date_".$count."' value='".$row['ent_date']."' ".					 
						 " </tr>";
						 
			$count = $count + 1;			 
		}
		$out_data = $out_data ."</table>";
	}else{
		$out_data = "No Records Found!";
	}
	mysql_free_result($result);
	mysql_close($connect);
	  
	echo $out_data;			
	
}

if($m_chksql == "download_ads"){
	DirDisply(); 
}

function DirDisply() { 

	$TrackDir=opendir("C:\\wamp\\www\\BackOffice\\Ads\\"); 
	
	$flag = false;
	while ($file = readdir($TrackDir)) { 
		//echo $file;
		$file_url = "http://localhost/BackOffice/Ads/".$file;
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
