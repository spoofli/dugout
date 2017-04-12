<?php
/*
*
* One Time Download
* Jacob Wyke
* jacob@frozensheep.com
*
*/

//The directory where the download files are kept - keep outside of the web document root
$strDownloadFolder = "/check/";

//If you can download a file more than once
$boolAllowMultipleDownload = 0;

//connect to the DB
$resDB = mysql_connect("localhost", "expdug", "");
mysql_select_db("expdug", $resDB);

if(!empty($_GET['key'])){
	//check the DB for the key
	$resCheck = mysql_query("SELECT * FROM downloads WHERE downloadkey = '".mysql_real_escape_string($_GET['key'])."' LIMIT 1");
	$arrCheck = mysql_fetch_assoc($resCheck);
	if(!empty($arrCheck['file'])){
		//check that the download time hasnt expired
		if($arrCheck['expires']>=time()){
			if(!$arrCheck['downloads'] OR $boolAllowMultipleDownload){
				//everything is hunky dory - check the file exists and then let the user download it
				$strDownload = $strDownloadFolder.$arrCheck['file'];
				
				if(file_exists($strDownload)){
					
					
					//update the DB to say this file has been downloaded
					mysql_query("UPDATE downloads SET downloads = downloads + 1 WHERE downloadkey = '".mysql_real_escape_string($_GET['key'])."' LIMIT 1");
					
					exit;
					
				}else{
					header('Location: doTrain.php');
				}
			}else{
				//this file has already been downloaded and multiple downloads are not allowed
				echo "This file has already been downloaded.";
			}
		}else{
			//this download has passed its expiry date
			echo "This download has expired.";
		}
	}else{
		//the download key given didnt match anything in the DB
		echo "No file was found to download.";
	}
}else{
	//No download key wa provided to this script
	echo "No download key was provided. Please return to the previous page and try again.";
}

?>