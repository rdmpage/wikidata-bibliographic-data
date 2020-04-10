<?php

// Add records to Wikidata based on file listing the microcitation GUIDs

require_once (dirname(__FILE__) . '/wikidata.php');

$filename = '1174-9202.tsv';

$filename = 'quickstatements/0067-0464.tsv';

$filename = 'quickstatements/1005-9628.tsv';

$filename = 'quickstatements/0001-804X.tsv';

$filename = 'quickstatements/brittonia.tsv';

$filename = 'quickstatements/extra.tsv';

$filename = 'quickstatements/0035-9181.txt';

$filename = 'quickstatements/0372-1361.txt';

// Records of the Indian Museum
$filename = 'quickstatements/0375-099X.txt';

// Transactions And Proceedings of The Royal Society of New Zealand
$filename = 'quickstatements/1176-6166.txt';

// Basteria
$filename = 'quickstatements/0005-6219.txt';

// Test cases
//$filename = 'quickstatements/test.txt';

// Zoologische Mededelingen
$filename = 'quickstatements/0024-0672.txt';

// Pacific Insects
$filename = 'quickstatements/0030-8714.txt';

// Odonatologica
$filename = 'quickstatements/0375-0183.txt';

// Bulletin of the Osaka Museum of Natural History
$filename = 'quickstatements/0078-6675.txt';

// Journal of Arachnology
$filename = 'quickstatements/0161-8202.txt';

// Bulletin of The British Arachnological Society
$filename = 'quickstatements/0524-4994.txt';


// flags
$check = true; // make sure record doesn't alreday exist
$check = false;// don't check (only do this if we are sure we're adding new stuff)

$update = true; // Update any existing records
$update = false; // Leave existing record alone

$languages = array('en'); // assume everything is in English

$file_handle = fopen($filename, "r");
while (!feof($file_handle)) 
{
	$guid = trim(fgets($file_handle));
	
	
	$url = 'http://localhost/~rpage/microcitation/www/citeproc-api.php?guid=' . $guid;

	$json = get($url);
	

	$obj = json_decode($json);

	//print_r($obj);
	
	// do we have this already? (now down in csljson_to_wikidata)
	$ok = true;
	
	/*
	
	$parts = array();
	
	if (isset($obj->ISSN))
	{
		$parts[] = $obj->ISSN[0];
	}
	if (isset($obj->volume))
	{
		$parts[] = $obj->volume;
	}
	if (isset($obj->page))
	{
		if (preg_match('/^(?<spage>\d+)(-\d+)?/', $obj->page, $m))
		{
			$parts[] = $m['spage'];
		}
	}
	
	//print_r($parts);
	
	if (count($parts == 3))
	{
		$item = wikidata_item_from_openurl($parts[0], $parts[1], $parts[2]);
		if ($item != '')
		{
			echo "*** Have already: $item ***\n";
			//$ok = false;
		}
		else
		{
			// echo "Not found\n";
		}
	}
	*/
	
	if ($ok)
	{
		$work = new stdclass;
		$work->message = $obj;

		//$quickstatements = csljson_to_wikidata($work, true, true, array('en', 'nl', 'de', 'fr'));
		
		$quickstatements = csljson_to_wikidata($work, 
			$check, 
			$update, 
			$languages
			);
		
		echo $quickstatements . "\n\n";
	}
	
	

}

fclose($file_handle);

?>
