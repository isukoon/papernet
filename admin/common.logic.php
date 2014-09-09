<?php
require_once ("config/config.php");
require_once ("common.class.php");
	
$m_chksql = $_GET['chksql'];

$objCF = new Common_Functions();


if($m_chksql == "loadMenu"){
	$menu = "";
	$menu =  $objCF -> loadMenu(); 
	echo $menu;			
}

if($m_chksql == "loadNewMenu"){
	
	$company = $_SESSION["ses_company"];
	$menu = "";
	$menu =  $objCF -> loadNewMenu($company); 
	echo $menu;			
}

?>
