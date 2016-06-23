<?php
	set_time_limit(0);
	ini_set('max_execution_time',0);
	$fp = fopen("cronLog.txt", 'wb');
	
	if ($fp === FALSE)
	{
		echo "ERROR: File not opened";
		exit;
	}
	else 
	{ 
		$response = "File opened at ".date("Y-m-d H:i:s")."\n\n";
		fputs($fp, $response);
		fclose($fp);
	}
?>