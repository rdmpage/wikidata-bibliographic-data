<?php

// Add records to Wikidata from mEDRA DOI
// Metadata from these need some post-processing

require_once (dirname(__FILE__) . '/wikidata.php');


$dois=array();


$dois=array(
//'10.12905/0380.sydowia66(1)2014-0099',
//'10.4404/hystrix-22.1-4473',
//'10.12905/0380.phyton54(2)2014-0197',
//'10.22092/ijb.2017.107596.1132', // fail
//'10.3264/FG.2017.1221',
//'10.3301/ijg.2013.10',

//'10.12905/0380.phyton56(2)2016-0255',

// '10.22092/ijb.2017.107596.1132', fail

//'10.3264/FG.2017.1221',

'10.12905/0380.phyton57-2018-0019'
);



// True to update existing record, false to skip
$update = false;
//$update = true;

$check = true; // set to false if we are sure that record will exist with DOI


$detect_languages = array('en');

$detect_languages = array('en', 'it', 'de', 'fr', 'pt', 'es', 'ja', 'zh', 'ru');


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
		
		$work->message->title = preg_replace('/\s+ISSN\s+.*$/u', '', $work->message->title);
		
		if (isset($work->message->ISSN))
		{
		
			$work->message->ISSN = preg_replace('/^ISSN\s+/', '', $work->message->ISSN);
		
			// hystrix
			$issns = array();
			
			if (preg_match('/(?<one>[0-9]{7}([0-9]|X))(,\s*(?<two>[0-9]{7}([0-9]|X)))?/i', $work->message->ISSN, $m))
			{
				$issns[] = substr($m['one'], 0, 4) . '-' . substr($m['one'], 4);
				if ($m['two'])
				{
					$issns[] = substr($m['two'], 0, 4) . '-' . substr($m['two'], 4);
				}
			}
			
			if (count($issns) > 0)
			{
				$work->message->ISSN = $issns;
			}
		
		}
		
		if (!isset($work->message->ISSN))
		{
			if (isset($work->message->publisher) && ($work->message->publisher == 'Forum Geobotanicum'))
			{
				$work->message->ISSN=array('1867-9315');
			}
		
		}
		
		// language
		if (isset($work->message->language))
		{
			switch ($work->message->language)
			{
				case 'ger':
					$detect_languages = array('de');
					break;
					
				defauklt:
					break;
			}
			
		}
		
		
		print_r($work);
		
		if ($work)
		{
			$source = array();
			
			$source[] = 'S248';
			$source[] = 'Q100312513'; // mEDRA
							
			$source[] = 'S854';
			$source[] = '"' . $url . '"';
			
			
			// post processing...
			
			
		
			$q = csljson_to_wikidata(
				$work, 
				$check, 	// check if already exists
				$update, // true to update an existing record, false to skip an existing record
				$detect_languages,
				$source,
				true
				);
		
			echo $q;
			echo "\n";
		}
	}	


}


?>
