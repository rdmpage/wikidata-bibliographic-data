<?php

// Given list of URLs match to Wikidata 

require_once (dirname(__FILE__) . '/wikidata.php');

$filename = 'urls.txt';

$to_do = array();

$file_handle = fopen($filename, "r");
while (!feof($file_handle)) 
{
	$guid = trim(fgets($file_handle));
	
	echo "-- $guid\n";
	
	$done = false;

	
	if (!$done)
	{
		if (preg_match('/^10\.\d+\//', $guid, $m))
		{
			$item = wikidata_item_from_doi($guid);
			if ($item)
			{
				echo "UPDATE `references` SET wikidata='" . $item . "' WHERE doi='" . $guid . "';" . "\n";
				
				// echo "found $item\n";
				
				$done = true;
			}
			else
			{
				$to_do[] = $guid;
			}
		}			
	}

	

}

fclose($file_handle);

print_r($to_do);

?>
