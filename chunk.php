<?php

$quickstatements_filename = 'kew.txt';
//$quickstatements_filename = 'z.txt';

$basename = 'qs';
$chunks= 200;
$total = 0;

$delay = 30;

$handle = null;
$output_filename = '';

$chunk_files = array();

$count = 0;

$file_handle = fopen($quickstatements_filename, "r");
while (!feof($file_handle)) 
{
	if ($count == 0)
	{
		$output_filename = $basename . '-' . $total . '.txt';
		$chunk_files[] = $output_filename;
		
		// wipe file
		$handle = fopen($output_filename, 'w');
		fclose($handle);
		
		$handle = fopen($output_filename, 'a');
	}

	$line = fgets($file_handle);
	
	fwrite($handle, $line);
	
	if (strlen(trim($line)) == 0)
	{
		$count++;
	}
	
	if ($count == $chunks)
	{
		fclose($handle);
		
		$total += $count;
		
		echo $total . "\n";
		$count = 0;
		
	}
}

fclose($handle);


echo "--- curl upload.sh ---\n";
$curl = "#!/bin/sh\n\n";


$count = 0;

foreach ($chunk_files as $filename)
{
	$curl .= "echo '$filename'\n";
	
/*
curl https://tools.wmflabs.org/quickstatements/api.php \
	-d action=import \
	-d submit=1 \
	-d username=Rdmpage \
	-d "batchname=THE NAME OF THE BATCH" \
	--data-raw 'token=$2y$10$JCxH5QRtnSIn0JOCb2Sqh.vqm2KaO5XZzQieuvJYjomPyNz8MXwju' \
	--data-urlencode data@test.qs
*/	
	
	
	$curl .= "curl https://tools.wmflabs.org/quickstatements/api.php \\" . "\n"; 
	
	$curl .= "-d action=import \\" . "\n";
	$curl .= "-d submit=1 \\" . "\n";
	$curl .= "-d username=Rdmpage \\" . "\n";
	$curl .= "-d \"batchname=batch-$count\" \\" . "\n";
	$curl .= "--data-raw 'token=$2y$10$JCxH5QRtnSIn0JOCb2Sqh.vqm2KaO5XZzQieuvJYjomPyNz8MXwju' \\" . "\n";
	$curl .= "--data-urlencode data@" . $filename . " \\" . "\n";	
	
	$curl .= "--progress-bar | tee /dev/null\n";
	
	
	$curl .= "echo ''\n";
	$curl .= "sleep $delay\n";
	
	$curl .= "\n\n";
	
	$count++;
	
	echo $curl;
	
	exit();
	
}

file_put_contents(dirname(__FILE__) . '/upload.sh', $curl);

	
?>	
