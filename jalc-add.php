<?php

// Add records to Wikidata from JaLC DOI
// Metadata from these need some post-processing
// Will need to add English titles for Japanese work separately

require_once (dirname(__FILE__) . '/wikidata.php');


$dois=array();


$dois=array(
//'10.11238/jmammsocjapan1987.15.47', // English
//'10.11369/jji1950.35.1', // English
//'10.20695/edaphologia.87.0_9', // English
//'10.18942/bunruichiri.KJ00001077451', // Japanese
'10.11238/mammalianscience.58.175', // Japanese
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
		$url = 'https://doi.org/' . $doi;	
		$json = get($url, '', 'application/vnd.citationstyles.csl+json');
						
		$obj = json_decode($json);
		$work = new stdclass;
		$work->message = $obj;		
	
				
		// clean
		if (!isset($work->message->type))
		{
			$work->message->type = 'journal-article';
		}		
		
		if (isset($work->message->ISSN))
		{
		
			// hystrix
			$issns = array();
			
			foreach ($work->message->ISSN as $issn)
			{
				$issns[] = substr($issn, 0, 4) . '-' . substr($issn, 4);
			}
			
			if (count($issns) > 0)
			{
				$work->message->ISSN = $issns;
			}
		
		}
		
		print_r($work);
		
		if ($work)
		{
			$source = array();
			
			$source[] = 'S248';
			$source[] = 'Q100319347'; // JaLC
							
			$source[] = 'S854';
			$source[] = '"' . $url . '"';
			
			
			// post processing...
			
			
		
			$q = csljson_to_wikidata(
				$work, 
				$check, 	// check if already exists
				$update, // true to update an existing record, false to skip an existing record
				$detect_languages,
				$source,
				false // don't add English label if title not English (we can add these later)
				);
		
			echo $q;
			echo "\n";
		}
	}	


}


?>
