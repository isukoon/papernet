<?php

$ad_id = "";

$type = $_FILES["uploadfile"]["type"];
$size = $_FILES["uploadfile"]["size"];
$ext  = pathinfo($_FILES["uploadfile"]["name"], PATHINFO_EXTENSION);
$name = $_FILES["uploadfile"]["name"];
$ad_id = $_POST["vid"];


if($ad_id != ""){
	define("UPLOAD_DIR","./uploaded_images/".$ad_id."/");
	define("SOURCE", $_FILES["uploadfile"]["tmp_name"]);
	define("FILENAME", strtolower($_FILES["uploadfile"]["name"]));
	
		  
	if(!is_file(UPLOAD_DIR.FILENAME)){

		if(!is_dir(UPLOAD_DIR)){ 
			mkdir(UPLOAD_DIR); chmod(UPLOAD_DIR, 0777);
   		}
		$NEWNAME = "";
		$NEWNAME = $ad_id.".".$ext;

		if((move_uploaded_file(SOURCE,UPLOAD_DIR. $NEWNAME)) === false){
			echo "error";
		}else{
			$filecount = 0;
			if (glob(UPLOAD_DIR . "*.*") != false){
				$filecount = count(glob(UPLOAD_DIR . "*.*"));
			}else{
				$filecount = 0;
			}
			$files_str = "";
			if($filecount > 0){
				$files = glob(UPLOAD_DIR . "*.*");
				foreach($files as $file){
					$files_str .= $file."@";
				}
			}
			echo "success#".$files_str; 			
		}
	}else{ 
		echo "Upload error: ".$name." already exists!";
	}
}
else{ 
	echo "error";
}

function setVid(){
return $ad_id;
}
			

?>