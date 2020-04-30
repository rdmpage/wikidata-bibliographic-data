<?php

// Add records to Wikidata from DOI

require_once (dirname(__FILE__) . '/wikidata.php');


$dois=array();


// True to update existing record, false to skip
$update = false;
//$update = true;

$check = true; // set to false if we are sure that record will exist with DOI

$detect_languages = array('en', 'fr', 'de');
$detect_languages = array('en','pt', 'es');

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
		$crossref = true;
		
		if (preg_match('/10.1071\/MR/i', $doi))
		{
			$crossref = false;
		}
	
		if ($crossref)
		{
			$work = get_work($doi);
		}
		else
		{
			$json = get('http://localhost/~rpage/microcitation/www/citeproc-api.php?guid=' . urlencode($doi));
						
			$obj = json_decode($json);
			$work = new stdclass;
			$work->message = $obj;		
		}
	
		//print_r($work);
	
		if ($work)
		{
			$source = array();
			
			if ($crossref)
			{
				$source[] = 'S248';
				$source[] = 'Q5188229';
				$source[] = 'S854';
				$source[] = '"https://api.crossref.org/v1/works/' . $doi . '"';
			}
		
		
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
