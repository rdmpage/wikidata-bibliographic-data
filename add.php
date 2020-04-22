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

// Studies on the Fauna of Suriname and other Guyanas
$filename = 'quickstatements/0300-5488.txt';

// Proceedings of the California Academy of Sciences
$filename = 'quickstatements/0068-547X.txt';

// 札幌博物学会会報 Sapporo
$filename = 'quickstatements/札幌博物学会会報.txt';

// Proceedings of the California Academy of Sciences suppliements with comma in file name
$filename = 'quickstatements/0068-547X-supplements.txt';

// Journal of The Malayan Branch of The Royal Asiatic Society
$filename = 'quickstatements/2304-7550.txt';
$filename = 'quickstatements/2304-7550-extra.txt';

// Beaufortia
$filename = 'quickstatements/0067-4745.txt';

// Bijdragen Tot de Dierkunde
$filename = 'quickstatements/0067-8546.txt';

// Cahiers de Biologie Marine (DataCite DOI)
$filename = 'quickstatements/0007-9723.txt';

// Proceedings of the Malacological Society of London
$filename = 'quickstatements/0025-1194.txt';

// Braueria
$filename = 'quickstatements/1026-3632.txt';

// Molluscan Research CSIRO
$filename = 'quickstatements/1323-5818-2002-2004.txt';
$filename = 'quickstatements/1323-5818-2005-2013.txt';

// Selbyana
$filename = 'quickstatements/0361-185X.txt';

// Sida
$filename = 'quickstatements/0036-1488.txt';
$filename = 'quickstatements/long.txt';

// Tettigonia
$filename = 'quickstatements/1341-6707.txt';

// Melbourne
$filename = 'quickstatements/0311-9548.txt';
$filename = 'quickstatements/0083-5986.txt';
$filename = 'quickstatements/0814-1827.txt';
$filename = 'quickstatements/1447-2546.txt';

// flags
$check = false;// don't check (only do this if we are sure we're adding new stuff)
$check = true; // make sure record doesn't alreday exist

$update = true; // Update any existing records
$update = false; // Leave existing record alone

$languages = array('en'); // assume everything is in English
//$languages = array('ja','en','de');
//$languages = array('en', 'de', 'nl');
//$languages = array('en', 'nl', 'de', 'fr');
//$languages = array('en', 'de');
$languages = array('ja', 'en');

$count++;

$file_handle = fopen($filename, "r");
while (!feof($file_handle)) 
{
	$guid = trim(fgets($file_handle));
	
	
	$url = 'http://localhost/~rpage/microcitation/www/citeproc-api.php?guid=' . urlencode($guid);

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
		
		if ($quickstatements != '')
		{
			echo $quickstatements . "\n\n";
		}
	}
	
	// Give server a break every 10 items
	if (($count++ % 10) == 0)
	{
		$rand = rand(1000000, 3000000);
		//echo "\n-- ...sleeping for " . round(($rand / 1000000),2) . ' seconds' . "\n\n";
		usleep($rand);
	}


}

fclose($file_handle);

?>
