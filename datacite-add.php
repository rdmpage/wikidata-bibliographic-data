<?php

// Add records to Wikidata from DataCite DOI
// Metadata from these are horribly incpomplete so we'll need to do some post-processing

require_once (dirname(__FILE__) . '/wikidata.php');


$dois=array();


$dois=array(
//'10.25664/art-0013',
//'10.15781/T25W5G',
//'10.13140/RG.2.2.17303.68008',
//'10.5281/zenodo.159691',
//'10.5169/seals-89438',
//'10.13130/2039-4942/5248',
'10.5169/seals-401351',
);



// True to update existing record, false to skip
$update = false;
//$update = true;

$check = true; // set to false if we are sure that record will exist with DOI


$detect_languages = array('en');

$detect_languages = array('en', 'it', 'fr', 'de', 'pt', 'es', 'ja', 'zh', 'ru');


foreach ($dois as $doi)
{
	$go = true;
	
	$item = wikidata_item_from_doi($doi);
	
	if ($item != '')
	{
		if (!$update)
		{
			//echo "Have $item already $item\n";
			
			$go = false;
		}
	}
	if ($go)
	{
		$url = 'https://data.datacite.org/application/vnd.citationstyles.csl+json/' . urlencode($doi);
		$json = get($url);
						
		$obj = json_decode($json);
		$work = new stdclass;
		$work->message = $obj;		
	
		print_r($work);
		
		
	
		if ($work)
		{
			$source = array();
			
			$source[] = 'S248';
			$source[] = 'Q821542'; // DataCite
							
			$source[] = 'S854';
			$source[] = '"' . $url . '"';
			
			
			// post processing...
			
			
		
			$q = csljson_to_wikidata(
				$work, 
				$check, 	// check if already exists
				$update, // true to update an existing record, false to skip an existing record
				$detect_languages,
				$source
				);
		
			echo $q;
			echo "\n";
		}
	}	


}


?>
