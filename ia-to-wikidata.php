<?php

// Given list of Internet Archive ids match to Wikidata and update local publications table

require_once (dirname(__FILE__) . '/wikidata.php');

$filename = 'ia.txt';


$file_handle = fopen($filename, "r");
while (!feof($file_handle)) 
{
	$guid = trim(fgets($file_handle));
	
	echo "-- $guid\n";
	
	$item = wikidata_item_from_internet_archive($guid);
	if ($item)
	{
		echo "UPDATE publications SET wikidata='" . $item . "' WHERE internetarchive='" . $guid . "';" . "\n";
		$done = true;
	}

}

fclose($file_handle);

?>
