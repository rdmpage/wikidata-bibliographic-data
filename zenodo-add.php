<?php

// Add records to Wikidata from Zenodo DOI

require_once (dirname(__FILE__) . '/wikidata.php');


$dois=array();



$dois=array(
//'10.5281/zenodo.4044276',
//'10.5281/zenodo.1219120',
//'10.5281/zenodo.3694249',
//'10.5281/zenodo.3685541',

'10.5281/zenodo.3685541',
'10.5281/zenodo.3693156',
'10.5281/zenodo.3693900',
'10.5281/zenodo.3694249',
'10.5281/zenodo.4593168',
'10.5281/zenodo.4593168',
'10.5281/zenodo.4593168',
'10.5281/zenodo.4593168',
'10.5281/zenodo.4593168',
'10.5281/zenodo.4593168',
'10.5281/zenodo.4593250',
'10.5281/zenodo.5512985',
'10.5281/zenodo.5519140',
'10.5281/zenodo.5608835',
'10.5281/zenodo.5768172',
'10.5281/zenodo.6026502',
'10.5281/zenodo.6415937',
'10.5281/zenodo.6497956',
'10.5281/zenodo.6831180',

);

// True to update existing record, false to skip
$update = false;
//$update = true;

$check = true; // set to false if we are sure that record will exist with DOI


$detect_languages = array('en');


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
		$zenodo_id = str_replace('10.5281/zenodo.', '', $doi);
		
		$url = 'https://zenodo.org/api/records/' . $zenodo_id;
		$json = get($url, '', 'application/vnd.citationstyles.csl+json');
						
		$obj = json_decode($json);
		$work = new stdclass;
		$work->message = $obj;		
	
		//print_r($work);
		
		
	
		if ($work)
		{
			$source = array();
			
			$source[] = 'S248';
			$source[] = 'Q22661177'; // Zenodo
							
			$source[] = 'S854';
			$source[] = '"https://zenodo.org/record/' . $zenodo_id  . '"';
			
			
			// post processing...
			// container_title FFS!
			if (isset($work->message->{'container_title'}))
			{
				if (preg_match('/Holotipus rivista di zoologia sistematica e tassonomia/i', $work->message->{'container_title'}, $m))
				{
					$work->message->ISSN = array('2704-7547');
					$work->message->{'container-title'} = 'Holotipus rivista di zoologia sistematica e tassonomia';
				}
				
				if ( $work->message->{'container_title'} == "Israel Journal of Entomology")
				{
					$work->message->ISSN = array('0075-1243');
					$work->message->{'container-title'} = 'Israel Journal of Entomology';
				}

				if ( $work->message->{'container_title'} == "ZooNova")
				{
					$work->message->ISSN = array('1759-0116');
					$work->message->{'container-title'} = 'ZooNova';
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
		}
	}	


}


?>
