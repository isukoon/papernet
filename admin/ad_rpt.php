<?php
	require_once ("common.class.php");

	$objC  = new Common_Functions();
	
	session_start();
	//$m_rpt_type = $_GET['report_type'];
	$m_user_name = $_SESSION["ses_user_name"];
	$fdate = $_GET["date"];
	$tdate = $_GET["tdate"];
	$type = $_GET["type"];
	$news = $_GET["news"];
	
	$host = "localhost";
	$user = "root";
	$pass = "";
	$db = "papernet";	
	
	$date = date( 'F d, Y' );
	echo $date;
	// create a pdf document in memory
	$pdf = pdf_new();
	pdf_open_file($pdf, '');
	
	pdf_set_info($pdf, "Creator", "ad_summary_rpt.php");
	pdf_set_info($pdf, "Author", "034");
	pdf_set_info($pdf, "Title", "PaperNET Backoffice System");
	
	// set up name of font for later use
	$fontname = 'Times-Roman';
	
	//  create  pdf page
	$width = 595;
	$height = 842;
	pdf_begin_page($pdf, $width, $height);
	
	// add heading
	$font = pdf_findfont($pdf, $fontname, 'host', 0);
	
	//$image = pdf_open_image_file($pdf, "jpeg", "edit.jpg");
	//pdf_place_image($pdf, $image, 50, 785, 0.5);
	// draw a line top of the page
	pdf_moveto($pdf, 20, 780);
	pdf_lineto($pdf, 575, 780);
	pdf_stroke($pdf);
	
	// draw another line near the bottom of the page 
	pdf_moveto($pdf, 20, 50); 
	pdf_lineto($pdf, 575, 50);
	pdf_stroke($pdf);
	
	
	$startx = 50;
	$font = pdf_findfont($pdf, $fontname, 'host', 0);
	if ($font)
	pdf_setfont($pdf, $font, 12);
	//add text beging of page
	pdf_show_xy($pdf, "PaperNET Advertisements (pvt) Ltd.", 50, 790);
	pdf_show_xy($pdf, "$date",  450, 790);
		
	if ($font)
	pdf_setfont($pdf, $font, 15);	
	pdf_show_xy($pdf, 'Advertisemets Report', 50, 735);
	
	if ($font)
	pdf_setfont($pdf, $font, 12);	
	
	$connect = mysql_connect($host,$user,$pass) or die ("Unable to connect");
	mysql_select_db($db) or die ("Unamble to select database");
			

		if($news == "-"){
			$news = "%";
		}
		
		if($type == "ALL"){
		
		$query = "  SELECT ad_id, (SELECT category_name FROM tbl_ad_category WHERE category_id = ad_category) ad_cat, (SELECT display_name FROM tbl_newspapers WHERE newspaper_id = newspapers) newspaper, ad_amount 
					FROM tbl_text_ads
					WHERE DATE_FORMAT(ent_date,'%Y-%m-%d') >= '".$objC->dateconvert($fdate,1)."' AND 
						  DATE_FORMAT(ent_date,'%Y-%m-%d') <= '".$objC->dateconvert($tdate,1)."' AND 
						  newspapers LIKE '".$news."'
					UNION ALL
					SELECT ad_id, size ad_cat, (SELECT display_name FROM tbl_newspapers WHERE newspaper_id = newspapers) newspaper, amount ad_amount
					FROM tbl_image_ad
					WHERE  DATE_FORMAT(added_date,'%Y-%m-%d') >= '".$objC->dateconvert($fdate,1)."' AND 
						   DATE_FORMAT(added_date,'%Y-%m-%d') <= '".$objC->dateconvert($tdate,1)."' AND
						   newspapers LIKE '".$news."' ";
		
		} else if ($type == "CLASSIFIED"){
		$query = "  SELECT ad_id, (SELECT category_name FROM tbl_ad_category WHERE category_id = ad_category) ad_cat, (SELECT display_name FROM tbl_newspapers WHERE newspaper_id = newspapers) newspaper, ad_amount 
					FROM tbl_text_ads
					WHERE DATE_FORMAT(ent_date,'%Y-%m-%d') >= '".$objC->dateconvert($fdate,1)."' AND 
						  DATE_FORMAT(ent_date,'%Y-%m-%d') <= '".$objC->dateconvert($tdate,1)."' AND newspapers LIKE '".$news."'";			
		} else {
		$query = "  SELECT ad_id, size ad_cat, (SELECT display_name FROM tbl_newspapers WHERE newspaper_id = newspapers) newspaper, amount ad_amount
					FROM tbl_image_ad
					WHERE  DATE_FORMAT(added_date,'%Y-%m-%d') >= '".$objC->dateconvert($fdate,1)."' AND 
						   DATE_FORMAT(added_date,'%Y-%m-%d') <= '".$objC->dateconvert($tdate,1)."' AND newspapers LIKE '".$news."'";			
		}
		
	mysql_query($query) or die ("Error in query : $query.".mysql_error());
	$result = mysql_query($query) or die ("Error in query : $query.".mysql_error());
	$num_rows = mysql_num_rows($result);
	//$objC-> logData($num_rows);	
	if($num_rows > 0)
	{
		pdf_show_xy($pdf, 'Ad ID'		,$startx, 700) ;
		pdf_show_xy($pdf, 'Category'	,$startx+100, 700) ;
		pdf_show_xy($pdf, 'Newspaper'		,$startx+250, 700) ;
		pdf_show_xy($pdf, 'Amount'	,$startx+400, 700) ;
			
		$y_pos = 675;
		while($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			$ent_date 	  	= $row["ad_id"];
			$no_of_ads 	= $row["ad_cat"];
			$ad_amt		  	= $row["newspaper"];
			$ad_status	= $row["ad_amount"];
			
			pdf_show_xy($pdf, "$ent_date"	,$startx, $y_pos) ;
			pdf_show_xy($pdf, "$no_of_ads"	,$startx+100, $y_pos) ;
			pdf_show_xy($pdf, "$ad_amt"		,$startx+250, $y_pos) ;
			pdf_show_xy($pdf, "$ad_status"	,$startx+400, $y_pos) ;
				
			$y_pos -= 25;
		}
	}
	else
	{
		pdf_show_xy($pdf, 'No Records Found!'		,50, 700) ;
	}		
	//  write some text under it
	pdf_show_xy($pdf, "MIT UCSC ", 225, 35);
	
	// finish up the page and prepare to output
	pdf_end_page($pdf);
	pdf_close($pdf);
	$data = pdf_get_buffer($pdf);
	// generate the headers to help a browser choose the correct application
	header('Content-Type: application/pdf');
	header('Content-Disposition: inline; filename=client_report.pdf');
	header('Content-Length: ' . strlen($data));
	// output PDF
	echo $data;

?>
