<?php

// Add records to Wikidata from DOI using my custom resolver

require_once (dirname(__FILE__) . '/wikidata.php');


$dois=array('10.11833/j.issn.2095-0756.2014.06.004');
$dois=array('10.11680/entomotax.2021017');


// True to update existing record, false to skip
$update = false;
//$update = true;

$check = true; // set to false if we are sure that record will exist with DOI

$detect_languages = array('en');

$detect_languages = array('en', 'zh');

//$detect_languages = array('en', 'it', 'fr', 'de', 'pt', 'es', 'ja', 'zh', 'ru');



$count = 1;

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
		$url = 'http://localhost/~rpage/doitocsl/?doi=' . urlencode($doi);	
		$json = get($url);
		
						
		$obj = json_decode($json);
		$work = new stdclass;
		$work->message = $obj[0];		
				
		//
		
					
		
		print_r($work);
		
		if ($work)
		{
			$source = array();
			
			if (preg_match('/10.11833/', $doi))
			{
				$work->message->DOIAgency = 'istic';
				
				$source[] = 'S854';
				$source[] = '"' . $work->message->URL . '"';
			}
			
			if (preg_match('/10.11680/', $doi))
			{
				$work->message->DOIAgency = 'istic';
				
				$source[] = 'S854';
				$source[] = '"' . $work->message->URL . '"';
				
				if (isset($work->message->{'published-online'}))
				{
					$work->message->issued = $work->message->{'published-online'};
				}

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
			
			// Give server a break every 10 items
			if (($count++ % 10) == 0)
			{
				$rand = rand(1000000, 3000000);
				usleep($rand);
			}
			
			
		}
	}	


}


?>
