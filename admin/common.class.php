<?php

class Common_Functions{

	function loadNewMenu($company){
		$menu = "";
		
		if($company == "" || $company == null || !isset($company)){
			$menu = " <ul id='verticalmenu' class='glossymenu'> ".
					"	<li><a href='home.php' ><img src='images/home.jpg' width='110' height='40' border='0'></a></li> ".
					"	<li><a href='users_summary.php'>Users Summary</a> ".
					"	</li> ".				
					"	<li><a href='daily_ads.php'>Daily Advertisements</a> ".
					"	</li> ".
					"	<li><a href='download_ads.php'>Download Advertisements</a> ".
					"		<ul> ".
					"		<li><a href='upload_ads.php'>Upload Advertisements</a></li> ".
					"		<li><a href='download_ads.php'>Download Advertisements</a></li> ".
					"		</ul> ".
					"	</li> ".				
					"	<li><a href='#'>Maintainence</a> ".
					"		<ul> ".
					"		<li><a href='add_category.php'>Add/Edit Category</a></li> ".
					"		<li><a href='add_subcategory.php'>Add/Edit Sub Category</a></li> ".
					"		<li><a href='add_newspaper.php'>Add/Edit Newspaper</a></li> ".
					"		<li><a href='add_user.php'>Add/Edit Users</a></li> ".
					"		</ul> ".
					"	</li> ".
					"	<li><a href='#'><img src='images/logout.jpg' width='110' height='40' border='0'></a> ".
					"		<ul> ".
					"		<li><a href='logout.php'>Logout</a></li> ".
					"		</ul> ".
					"	</li> ".								
					"	</ul> ";
		}else{
			$menu = " <ul id='verticalmenu' class='glossymenu'> ".
					"	<li><a href='home.php' ><img src='images/home.jpg' width='110' height='40' border='0'></a></li> ".
					"	<li><a href='users_summary.php'>Users Summary</a>".
					"	</li> ".				
					"	<li><a href='daily_ads.php'>Daily Advertisements</a> ".
					"	</li> ".
					"	<li><a href='download_ads.php'>Download Advertisements</a> ".
					"	</li> "./*				
					"	<li><a href='#'>Maintainence</a> ".
					"		<ul> ".
					"		<li><a href='add_category.php'>Add/Edit Category</a></li> ".
					"		<li><a href='add_subcategory.php'>Add/Edit Sub Category</a></li> ".
					"		<li><a href='add_newspaper.php'>Add/Edit Newspaper</a></li> ".
					"		<li><a href='add_user.php'>Add/Edit Users</a></li> ".
					"		</ul> ".
					"	</li> ".*/
					"	<li><a href='#'><img src='images/logout.jpg' width='110' height='40' border='0'></a> ".
					"		<ul> ".
					"		<li><a href='logout.php'>Logout</a></li> ".
					"		</ul> ".
					"	</li> ".								
					"	</ul> ";
			
		}
		return $menu;
	
	}	

	
	function logData($data){		
		$log_path = "C:\\wamp\\www\\papernet\\logs\\";
		$file_name = $log_path. date("Y_m_d").".txt";
		$data = $data." \r\n";
		$file = fopen($file_name, "a");
		fwrite($file, $data);
		fclose($file);
	}

	function dateconvert($date,$func){
		if ($func == 1){ //insert conversion
			list($month, $day, $year) = split('[/.-]', $date);
			$date = "$year-$month-$day";
			return $date;
		}if ($func == 2){ //output conversion
			list($year, $month, $day) = split('[-.]', $date);
			$date = "$month/$day/$year";
			return $date;
		}
	} 


}
?>
