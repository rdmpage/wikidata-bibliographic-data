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

//'10.12905/0380.phyton57-2018-0019'
);

$dois=array(
"10.12905/0380.phyton55(1)2015-0001",
"10.12905/0380.phyton55(1)2015-0017",
"10.12905/0380.phyton55(1)2015-0031",
"10.12905/0380.phyton55(1)2015-0041",
"10.12905/0380.phyton55(1)2015-0069",
"10.12905/0380.phyton55(1)2015-0121",
"10.12905/0380.phyton55(1)2015-0131",
"10.12905/0380.phyton55(1)2015-0149",
"10.12905/0380.phyton55(1)2015-0159",
"10.12905/0380.phyton55(1)2015-0181",
"10.12905/0380.phyton55(1)2015-0191",
"10.12905/0380.phyton55(2)2015-0193",
"10.12905/0380.phyton55(2)2015-0201",
"10.12905/0380.phyton55(2)2015-0215",
"10.12905/0380.phyton55(2)2015-0233",
"10.12905/0380.phyton55(2)2015-0251",
"10.12905/0380.phyton55(2)2015-0271",
"10.12905/0380.phyton55(2)2015-0279",
"10.12905/0380.phyton55(2)2015-0297",
"10.12905/0380.phyton55(2)2015-0313",
"10.12905/0380.phyton56(1)2016-0001",
"10.12905/0380.phyton56(1)2016-0015",
"10.12905/0380.phyton56(1)2016-0027",
"10.12905/0380.phyton56(1)2016-0039",
"10.12905/0380.phyton56(1)2016-0049",
"10.12905/0380.phyton56(1)2016-0061",
"10.12905/0380.phyton56(1)2016-0077",
"10.12905/0380.phyton56(1)2016-0103",
"10.12905/0380.phyton56(1)2016-0111",
"10.12905/0380.phyton56(1)2016-0121",
"10.12905/0380.phyton56(2)2016-0129",
"10.12905/0380.phyton56(2)2016-0153",
"10.12905/0380.phyton56(2)2016-0161",
"10.12905/0380.phyton56(2)2016-0181",
"10.12905/0380.phyton56(2)2016-0193",
"10.12905/0380.phyton56(2)2016-0201",
"10.12905/0380.phyton56(2)2016-0209",
"10.12905/0380.phyton56(2)2016-0225",
"10.12905/0380.phyton56(2)2016-0241",
"10.12905/0380.phyton56(2)2016-0255",
"10.12905/0380.phyton56(2)2016-0267",
"10.12905/0380.phyton56(2)2016-0277",
"10.12905/0380.phyton56(2)2016-0293",
"10.12905/0380.phyton56(2)2016-0303",
"10.12905/0380.phyton57-2018-0019",
"10.12905/0380.phyton57-2018-0037",
"10.12905/0380.phyton57-2018-0047",
"10.12905/0380.phyton57-2018-0059",
"10.12905/0380.phyton57-2018-0069",
"10.12905/0380.phyton57-2018-0079",
"10.12905/0380.phyton57-2018-0091",
"10.12905/0380.phyton57-2018-0107",
"10.12905/0380.phyton57-2018-0113",
"10.12905/0380.phyton57-2018-0129",
"10.12905/0380.phyton57-2018-0137",
"10.12905/0380.phyton57-2018-0143",
"10.12905/0380.phyton54(2)2014-0161",
"10.12905/0380.phyton54(2)2014-0197",
"10.12905/0380.phyton54(2)2014-0205",
"10.12905/0380.phyton54(2)2014-0215",
"10.12905/0380.phyton54(2)2014-0223",
"10.12905/0380.phyton54(2)2014-0233",
"10.12905/0380.phyton54(2)2014-0235",
"10.12905/0380.phyton54(2)2014-0245",
"10.12905/0380.phyton54(2)2014-0251",
"10.12905/0380.phyton54(2)2014-0275",
"10.12905/0380.phyton54(2)2014-0285",
"10.12905/0380.phyton54(2)2014-0305",
"10.12905/0380.phyton54(2)2014-0321",
"10.12905/0380.phyton54(2)2014-0333",
"10.12905/0380.phyton54(2)2014-0343",
"10.12905/0380.phyton54(2)2014-0353",);

$dois=array(
'10.22092/BOTANY.2014.101238',
);

$dois=array(
"10.19269/sugapa2020.13(1).01",
"10.19269/sugapa2020.13(1).02",
"10.19269/sugapa2020.13(1).03",
"10.19269/sugapa2020.13(1).04",
"10.19269/sugapa2020.13(1).05",
"10.19269/sugapa2020.13(1).06",
"10.19269/sugapa2020.13(1).07",
"10.19269/sugapa2020.13(1).08",
"10.19269/sugapa2020.13(1).09",
"10.19269/sugapa2020.12(2).01",
"10.19269/sugapa2020.12(2).02",
"10.19269/sugapa2020.12(2).03",
"10.19269/sugapa2020.12(2).04",
"10.19269/sugapa2019.12(1).01",
"10.19269/sugapa2019.12(1).02",
"10.19269/sugapa2019.12(1).03",
"10.19269/sugapa2019.12(1).04",
"10.19269/sugapa2019.12(1).05",
"10.19269/sugapa2019.11(2).01",
"10.19269/sugapa2019.11(2).02",
"10.19269/sugapa2019.11(2).03",
"10.19269/sugapa2019.11(2).04",
"10.19269/sugapa2019.11(2).05",
"10.19269/sugapa2019.11(2).06",
"10.19269/sugapa2019.11(2).07",
"10.19269/sugapa2018.11(1).01",
"10.19269/sugapa2018.11(1).02",
"10.19269/sugapa2018.11(1).03",
"10.19269/sugapa2018.11(1).05",
"10.19269/sugapa2018.11(1).06",
"10.19269/sugapa2017.10(2).01",
"10.19269/sugapa2017.10(2).02",
"10.19269/sugapa2017.10(2).03",
"10.19269/sugapa2017.10(2).04",
"10.19269/sugapa2017.10(2).05",
"10.19269/sugapa2017.10(2).06",
"10.19269/sugapa2017.10(2).07",
"10.19269/sugapa2016.10(1).01",
"10.19269/sugapa2016.10(1).02",
"10.19269/sugapa2016.10(1).03",
"10.19269/sugapa2016.10(1).04",
"10.19269/sugapa2021.13(2).01",
"10.19269/sugapa2021.13(2).02",
"10.19269/sugapa2021.13(2).03",
"10.19269/sugapa2021.13(2).04",
);


// True to update existing record, false to skip
$update = false;
//$update = true;

$check = true; // set to false if we are sure that record will exist with DOI


$detect_languages = array('en');

//$detect_languages = array('en', 'it', 'de', 'fr', 'pt', 'es', 'ja', 'zh', 'ru');


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
	
		// print_r($work);
		
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
		
		if (isset($work->message->{'container-title-short'}))
		{
			switch ($work->message->{'container-title-short'})
			{
				case 'ger':
					$work->message->ISSN=array('1608-4306');
					break;
					
				default:
					break;
			}
		
		}
		
		if (isset($work->message->{'container-title'}))
		{
			if ($work->message->{'container-title'} == 'SUGAPA')
			{
				$work->message->ISSN = array('1978-9807');
			}
			
			if (isset($work->message->issue))
			{
				if (preg_match('/(?<volume>\d+)\s*\((?<issue>\d+)\)/i', $work->message->issue, $m))
				{
					$work->message->volume = $m['volume'];
					$work->message->issue = $m['issue'];
					
					
				}
				
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

				case 'per':
					$detect_languages = array('fa');
					break;

					
				default:
					break;
			}
			
		}
		
		if (!isset($work->message->DOIagency))	
		{
			$work->message->DOIAgency = 'medra';
		}		
		
		
		// print_r($work);
		
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
