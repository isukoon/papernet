<?php

unlink('my-archive.zip');


$val = array("C2015336","C2029225","C2034938","C2041158");
$arrlength=count($val);



$src = "../uploaded_images/C2029225";
$src1 = "../ads/C2029225";

$dst = 'img';
recurse_copy($src,$dst);
recurse_copy($src1,$dst);
/*
for($x=0;$x<$arrlength;$x++)
  {
  //echo var_export()$val[$x], true);
  

		
  }*/
  
zipmake('img');



function zipmake($zipfolder){
ini_set('max_execution_time', 5000);


$zip = new ZipArchive();


if ($zip->open('my-archive.zip', ZIPARCHIVE::CREATE) !== TRUE) {
    die ("Could not open archive");
}


$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator("$zipfolder/"));


foreach ($iterator as $key=>$value) {
    $zip->addFile(realpath($key), $key) or die ("ERROR: Could not add file: $key");
}


$zip->close();
echo "Archive created successfully.";


}

/*
$files = glob('img/*'); 
foreach($files as $file){ 
  if(is_file($file))
    unlink($file); 
}*/



function recurse_copy($src,$dst) { 
    $dir = opendir($src); 
    @mkdir($dst); 
    while(false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            
                copy($src . '/' . $file,$dst . '/' . $file); 
          //  } 
        } 
    } 
    closedir($dir); 
} 

?>