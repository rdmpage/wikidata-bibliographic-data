<?php

// Check whether record with DOI exists in Wikidata

require_once (dirname(__FILE__) . '/wikidata.php');

$filename = 'urls.txt';


$file_handle = fopen($filename, "r");
while (!feof($file_handle)) 
{
	$guid = trim(fgets($file_handle));
	
	echo "-- $guid\n";
	
	$item = wikidata_item_from_url($guid);
	if ($item)
	{
		echo "UPDATE publications SET wikidata='" . $item . "' WHERE guid='" . $guid . "';" . "\n";
	}
	

}

fclose($file_handle);

?>
