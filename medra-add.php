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

$dois=array(
'10.12905/0380.sydowia66(2)2014-0171',
'10.12905/0380.sydowia67-2015-0175',
'10.12905/0380.sydowia69-2017-0009',
'10.12905/0380.sydowia69-2017-0047',
'10.12905/0380.sydowia69-2017-0115',
'10.12905/0380.sydowia69-2017-0161',
'10.12905/0380.sydowia69-2017-0215',
'10.12905/0380.sydowia70-2018-0059',
'10.12905/0380.sydowia70-2018-0037',
'10.12905/0380.sydowia70-2018-0155',
'10.12905/0380.sydowia67-2015-0157',
'10.12905/0380.sydowia70-2018-0193',
'10.12905/0380.sydowia70-2018-0185',
'10.12905/0380.sydowia70-2018-0179',
'10.12905/0380.sydowia70-2018-0169',
'10.12905/0380.sydowia70-2018-0161',
'10.12905/0380.sydowia70-2018-0141',
'10.12905/0380.sydowia70-2018-0099',
'10.12905/0380.sydowia70-2018-0089',
'10.12905/0380.sydowia70-2018-0051',
'10.12905/0380.sydowia70-2018-0027',
'10.12905/0380.sydowia69-2017-0171',
'10.12905/0380.sydowia69-2017-0153',
'10.12905/0380.sydowia69-2017-0147',
'10.12905/0380.sydowia69-2017-0135',
'10.12905/0380.sydowia69-2017-0131',
'10.12905/0380.sydowia69-2017-0123',
'10.12905/0380.sydowia69-2017-0105',
'10.12905/0380.sydowia69-2017-0097',
'10.12905/0380.sydowia69-2017-0073',
'10.12905/0380.sydowia69-2017-0023',
'10.12905/0380.sydowia69-2017-0019',
'10.12905/0380.sydowia69-2017-0001',
'10.12905/0380.sydowia68-2016-0193',
'10.12905/0380.sydowia68-2016-0187',
'10.12905/0380.sydowia68-2016-0163',
'10.12905/0380.sydowia68-2016-0151',
'10.12905/0380.sydowia68-2016-0131',
'10.12905/0380.sydowia68-2016-0119',
'10.12905/0380.sydowia68-2016-0113',
'10.12905/0380.sydowia68-2016-0107',
'10.12905/0380.sydowia68-2016-0099',
'10.12905/0380.sydowia68-2016-0063',
'10.12905/0380.sydowia68-2016-0057',
'10.12905/0380.sydowia68-2016-0049',
'10.12905/0380.sydowia68-2016-0041',
'10.12905/0380.sydowia68-2016-0035',
'10.12905/0380.sydowia68-2016-0027',
'10.12905/0380.sydowia68-2016-0017',
'10.12905/0380.sydowia68-2016-0007',
'10.12905/0380.sydowia68-2016-0001',
'10.12905/0380.sydowia67-2015-0217',
'10.12905/0380.sydowia67-2015-0197',
'10.12905/0380.sydowia67-2015-0189',
'10.12905/0380.sydowia67-2015-0167',
'10.12905/0380.sydowia67-2015-0133',
'10.12905/0380.sydowia67-2015-0127',
'10.12905/0380.sydowia67-2015-0075',
'10.12905/0380.sydowia67-2015-0065',
'10.12905/0380.sydowia67-2015-0051',
'10.12905/0380.sydowia67-2015-0045',
'10.12905/0380.sydowia67-2015-0033',
'10.12905/0380.sydowia67-2015-0025',
'10.12905/0380.sydowia67-2015-0021',
'10.12905/0380.sydowia67-2015-0011',
'10.12905/0380.sydowia67-2015-0001',
'10.12905/0380.sydowia66(2)2014-0335',
'10.12905/0380.sydowia66(2)2014-0309',
'10.12905/0380.sydowia66(2)2014-0289',
'10.12905/0380.sydowia66(2)2014-0257',
'10.12905/0380.sydowia66(2)2014-0249',
'10.12905/0380.sydowia66(2)2014-0241',
'10.12905/0380.sydowia66(2)2014-0229',
'10.12905/0380.sydowia70-2018-0211',
'10.12905/0380.sydowia70-2018-0199',
'10.12905/0380.sydowia70-2018-0129',
'10.12905/0380.sydowia70-2018-0107',
'10.12905/0380.sydowia70-2018-0081',
'10.12905/0380.sydowia70-2018-0067',
'10.12905/0380.sydowia70-2018-0011',
'10.12905/0380.sydowia70-2018-0001',
'10.12905/0380.sydowia69-2017-0229',
'10.12905/0380.sydowia69-2017-0205',
'10.12905/0380.sydowia69-2017-0199',
'10.12905/0380.sydowia69-2017-0183',
'10.12905/0380.sydowia69-2017-0081',
'10.12905/0380.sydowia69-2017-0037',
'10.12905/0380.sydowia69-2017-0029',
'10.12905/0380.sydowia68-2016-0173',
'10.12905/0380.sydowia68-2016-0139',
'10.12905/0380.sydowia68-2016-0087',
'10.12905/0380.sydowia68-2016-0069',
'10.12905/0380.sydowia67-2015-0119',
'10.12905/0380.sydowia67-2015-0081',
'10.12905/0380.sydowia66(2)2014-0325',
'10.12905/0380.sydowia66(2)2014-0313',
'10.12905/0380.sydowia66(2)2014-0299',
'10.12905/0380.sydowia73-2020-0001',
'10.12905/0380.sydowia73-2020-0013',
'10.12905/0380.sydowia73-2020-0021',
'10.12905/0380.sydowia73-2020-0031',
'10.12905/0380.sydowia73-2020-0045',
'10.12905/0380.sydowia72-2020-0231',
'10.12905/0380.sydowia73-2020-0061',
'10.12905/0380.sydowia73-2020-0069',
'10.12905/0380.sydowia73-2020-0075',
'10.12905/0380.sydowia73-2020-0083',
'10.12905/0380.sydowia73-2020-0089',
'10.12905/0380.sydowia73-2020-0113',
'10.12905/0380.sydowia73-2020-0163',
'10.12905/0380.sydowia73-2020-0133',
'10.12905/0380.sydowia73-2020-0171',
'10.12905/0380.sydowia73-2020-0185',
'10.12905/0380.sydowia73-2021-0197',
'10.12905/0380.sydowia73-2021-0217',
'10.12905/0380.sydowia73-2021-0209',
'10.12905/0380.sydowia73-2021-0233',
'10.12905/0380.sydowia73-2021-0245',
'10.12905/0380.sydowia73-2021-0257',
'10.12905/0380.sydowia74-2021-0001',
'10.12905/0380.sydowia74-2021-0015',
'10.12905/0380.sydowia73-2021-0271',
'10.12905/0380.sydowia74-2021-0033',
'10.12905/0380.sydowia74-2021-0065',
'10.12905/0380.sydowia74-2021-0093',
'10.12905/0380.sydowia74-2021-0107',
'10.12905/0380.sydowia74-2021-0121',
'10.12905/0380.sydowia74-2021-0133',
'10.12905/0380.sydowia74-2021-0153',
'10.12905/0380.sydowia74-2021-0071',
'10.12905/0380.sydowia74-2021-0143',
'10.12905/0380.sydowia74-2021-0163',
'10.12905/0380.sydowia74-2021-0079',
'10.12905/0380.sydowia74-2021-0175',
'10.12905/0380.sydowia74-2021-0193',
'10.12905/0380.sydowia74-2021-0181',
'10.12905/0380.sydowia74-2021-0287',
'10.12905/0380.sydowia74-2021-0335',
'10.12905/0380.sydowia74-2021-0263',
'10.12905/0380.sydowia74-2021-0277',
'10.12905/0380.sydowia74-2021-0303',
'10.12905/0380.sydowia74-2021-0315',
'10.12905/0380.sydowia74-2021-0327',
'10.12905/0380.sydowia74-2021-0251',
'10.12905/0380.sydowia74-2021-0343',
);

$dois=array(
'10.12905/0380.sydowia66(1)2014-0025',
'10.12905/0380.sydowia66(2)2014-0217',
'10.12905/0380.sydowia66(1)2014-0055',
'10.12905/0380.sydowia66(1)2014-0019',
'10.12905/0380.sydowia66(1)2014-0029',
'10.12905/0380.sydowia66(1)2014-0143',
'10.12905/0380.sydowia66(2)2014-0203',


);

$dois=array(
'10.22092/botany.2021.351400.1213'
);

$dois=array(
"10.23788/IEF-1147",
"10.23788/IEF-1165",
"10.23788/IEF-1142",
"10.23788/IEF-1158",
"10.23788/IEF-1168",
"10.23788/IEF-1176",
"10.23788/IEF-1169",
"10.23788/IEF-1170",
"10.23788/IEF-1173",
"10.23788/IEF-1174",
"10.23788/IEF-1102",
"10.23788/IEF-1103",
"10.23788/IEF-1130",
"10.23788/IEF-1139",
"10.23788/IEF-1161",
"10.23788/IEF-1164",
"10.23788/IEF-1067",
"10.23788/IEF-1091",
"10.23788/IEF-1081",
"10.23788/IEF-1096",
"10.23788/IEF-1095",
"10.23788/IEF-1082",
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
	
		//print_r($work);
		
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
			
			if (preg_match('/IEF/', $work->message->DOI))
			{
				$work->message->type = 'article-journal';
			}
			
		
		}
		
		if (!isset($work->message->ISSN))
		{
			if (isset($work->message->publisher) && ($work->message->publisher == 'Forum Geobotanicum'))
			{
				$work->message->ISSN=array('1867-9315');
			}
			
			if (preg_match('/IEF/', $work->message->DOI))
			{
				$work->message->ISSN=array('0936-9902');
				$work->message->type = 'article-journal';
				$work->message->{'container-title'} = 'Ichthyological Exploration of Freshwaters';
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
		
		
		//print_r($work);
		
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
