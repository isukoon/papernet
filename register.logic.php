<?php
require_once("user.class.php");

$userObj = new User();

$function = $_GET['chksql'];

if($function == "validateUserName"){
	
	$userName = $_GET['user_name'];
	$count = 0;
	$count = $userObj -> validateUserName($userName);
		
	echo $count;
}

if($function == "createUser"){
	
	$userName = $_GET['user_name'];
	$password = $_GET['password'];
	$salu = $_GET['salutation'];
	$fname = $_GET['first_name'];
	$lname = $_GET['last_name'];
	$nic_no = $_GET['nic_no'];
	$b_date = $_GET['birth_date'];
	$status = $_GET['martial_status'];
	$email = $_GET['email'];
	$tp = $_GET['contact_number'];
	$home_addr = $_GET['home_address'];
	$company = $_GET['company_name'];
	$desig = $_GET['designation'];
	$ofc_phone = $_GET['ofc_phone'];
	$ofc_addr = $_GET['ofc_address'];
	$promo = $_GET['promo_check'];
	$terms = $_GET['terms_check'];	
	
	$msg = "";
	$result = $userObj -> createUser($userName,$password,$salu,$fname,$lname,$nic_no,$b_date,$status,$email,$tp,$home_addr,$company,$desig,$ofc_phone,$ofc_addr,$promo,$terms);
	if($result)
		$msg = "Save Successfully!";
	else
		$msg = "Error Occured!";	
		
	echo $msg;
}

?>
