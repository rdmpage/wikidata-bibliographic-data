<?php

// Check whether record with DOI exists in Wikidata

require_once (dirname(__FILE__) . '/wikidata.php');

$filename = 'ipni-doi.tsv';


$file_handle = fopen($filename, "r");
while (!feof($file_handle)) 
{
	$doi = trim(fgets($file_handle));
	
	echo "-- $doi\n";
	
	$item = wikidata_item_from_doi($doi);
	if ($item)
	{
		echo "UPDATE names SET wikidata='" . $item . "' WHERE doi='" . $doi . "';" . "\n";
	}
	

}

fclose($file_handle);

?>
