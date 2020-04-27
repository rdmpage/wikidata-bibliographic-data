<?php

// Given list of URLs match to Wikidata and update local publications table

require_once (dirname(__FILE__) . '/wikidata.php');

$filename = 'urls.txt';


$file_handle = fopen($filename, "r");
while (!feof($file_handle)) 
{
	$guid = trim(fgets($file_handle));
	
	echo "-- $guid\n";
	
	$done = false;
	
	if (!$done)
	{
		if (preg_match('/https?:\/\/www.jstor.org\/stable\/(?<id>.*)/', $guid, $m))
		{
			$jstor = $m['id'];
			
			$item = wikidata_item_from_jstor($jstor);
			if ($item)
			{
				echo "UPDATE publications SET wikidata='" . $item . "' WHERE guid='" . $guid . "';" . "\n";
				$done = true;
			}
		}			
	}

	if (!$done)
	{
		if (preg_match('/^10\.\d+\//', $guid, $m))
		{
			$item = wikidata_item_from_doi($guid);
			if ($item)
			{
				echo "UPDATE publications SET wikidata='" . $item . "' WHERE guid='" . $guid . "';" . "\n";
				$done = true;
			}
		}			
	}
	
	if (!$done)
	{
		if (preg_match('/biodiversitylibrary.org\/part\/(?<id>\d+)/', $guid, $m))
		{
			$bhl_part = $m['id'];
			
			$item = wikidata_item_from_bhl_part($bhl_part);
			if ($item)
			{
				echo "UPDATE publications SET wikidata='" . $item . "' WHERE guid='" . $guid . "';" . "\n";
				$done = true;
			}
		}			
	}
	
	
	

	if (!$done)
	{
		$item = wikidata_item_from_url($guid);
		if ($item)
		{
			echo "UPDATE publications SET wikidata='" . $item . "' WHERE guid='" . $guid . "';" . "\n";
			$done = true;
		}		
	}
	
	
	

}

fclose($file_handle);

?>
