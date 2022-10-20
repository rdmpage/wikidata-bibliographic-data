<?php

// Add records to Wikidata from CSJ-JSON as JSONL

require_once (dirname(__FILE__) . '/wikidata.php');


// True to update existing record, false to skip
$update = false;
//$update = true;

$check = true; // set to false if we are sure that record will exist with DOI
//$check = false;

$detect_languages = array('en');
//$detect_languages = array('en', 'ko');
//$detect_languages = array('en', 'it');
//$detect_languages = array('en', 'zh');
//$detect_languages = array('en', 'es');

$filename = '1.jsonl';
$filename = '/Users/rpage/Dropbox/Mac M1/ik.json';
$filename = '/Users/rpage/Dropbox/Mac M1/wikidata/ased.jsonl';
$filename = '/Users/rpage/Dropbox/Mac M1/extra.jsonl';
$filename = '/Users/rpage/Dropbox/Mac M1/wikidata/kjsz.jsonl';
$filename = '/Users/rpage/Dropbox/Mac M1/wikidata/kjszold.jsonl';
$filename = '/Users/rpage/Dropbox/Mac M1/wikidata/o.jsonl';
$filename = '/Users/rpage/Dropbox/Mac M1/wikidata/hl.jsonl';
$filename = 'z.jsonl';
$filename = '/Users/rpage/Dropbox/Mac M1/wikidata/q.jsonl';
$filename = '/Users/rpage/Dropbox/Mac M1/zs.jsonl';
$filename = '/Users/rpage/Dropbox/Mac M1/zs3.jsonl';
$filename = '/Users/rpage/Dropbox/Mac M1/sol.jsonl';
$filename = '/Users/rpage/Dropbox/Mac M1/dit.jsonl';
$filename = '/Users/rpage/Dropbox/Mac M1/b2.jsonl';


$file_handle = fopen($filename, "r");
while (!feof($file_handle)) 
{
	$json = trim(fgets($file_handle));
	
	$obj = json_decode($json);
		
	if ($obj)
	{
		$work = new stdclass;
		$work->message = $obj;
		
		// hacks
		if ($work->message->{'container-title'} == 'Insecta Koreana')
		{
			$work->message->ISSN = array('1225-0104');
		}
		// hacks
		if ($work->message->{'container-title'} == 'Animal Systematics, Evolution and Diversity')
		{
			$work->message->ISSN = array('2234-6953');
		}
		// hacks
		if ($work->message->{'container-title'} == 'Animal Systematics, Evolution and Diversity')
		{
			$work->message->ISSN = array('1018-192X');
		}
		if ($work->message->{'container-title'} == 'Animal Systematics, Evolution And Diversity')
		{
			$work->message->ISSN = array('1018-192X');
		}
		
		//print_r($work);
		
		$source = array();
		
		if ($work->message->ISSN[0] == '1123-6787')
		{
			$source[] = 'S854';
			$source[] = '"http://www.ssnr.it/quad.htm"';		
		}

		if ($work->message->ISSN[0] == '1070-4140')
		{
			$source[] = 'S854';
			$source[] = '"' . $work->message->URL . '"';		
		}
		
		// www.zobodat.at
		if (isset($obj->URL) && preg_match('/www.zobodat.at/i', $obj->URL, $m))
		{
			$source[] = 'S248';
			$source[] = 'Q55153845';
			$source[] = 'S854';
			$source[] = '"' . $obj->URL . '"';	
			
			// identifier
			if (preg_match('/www.zobodat.at\/publikation_articles.php\?id=(?<id>\d+)/', $obj->URL, $m))
			{
				$work->message->ZOBODAT = $m['id'];
			}
		}
		
		if ($work->message->ISSN[0] == '1021-5506')
		{
			$source[] = 'S854';
			$source[] = '"' . $work->message->URL . '"';	
			$work->message->doi_agency = 'airiti';	
		}
		
		//print_r($work);
	
		$q = csljson_to_wikidata(
			$work, 
			$check, 	// check if already exists
			$update, // true to update an existing record, false to skip an existing record
			$detect_languages,
			$source,
			true // true to add non-English titles if no English is available
			);
		
		echo $q;
		echo "\n";
	}	
}


?>
