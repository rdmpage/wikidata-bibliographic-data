<?php

// Add additional info based on file listing the microcitation GUIDs

require_once (dirname(__FILE__) . '/wikidata.php');



// Journal of The American Mosquito Control Association
$filename = 'quickstatements/8756-971X.txt';


// flags
$check = true; // make sure record doesn't alreday exist

$update = true; // Update any existing records

$languages = array('en'); // assume everything is in English

$count++;

$file_handle = fopen($filename, "r");
while (!feof($file_handle)) 
{
	$guid = trim(fgets($file_handle));
	
	
	$url = 'http://localhost/~rpage/microcitation/www/citeproc-api.php?guid=' . urlencode($guid);

	$json = get($url);
	

	$obj = json_decode($json);

	//print_r($obj);
	
	$source = array();
	
	$work = new stdclass;
	$work->message = $obj;
	
	$item = wikidata_find_from_anything ($work);
	
	if ($item != '')
	{
		//echo "Found $item\n";
		
		$w = array();
		
		$wikidata_properties = array(
			'type'					=> 'P31',
			'BHL' 					=> 'P687',
			'BHLPART' 				=> 'P6535',
			'BIOSTOR' 				=> 'P5315',
			'CNKI'					=> 'P6769',
			'DOI' 					=> 'P356',
			'HANDLE'				=> 'P1184',
			'JSTOR'					=> 'P888',
			'PMID'					=> 'P698',
			'PMC' 					=> 'P932',
			'URL'					=> 'P953',	// https://twitter.com/EvoMRI/status/1062785719096229888
			'title'					=> 'P1476',	
			'volume' 				=> 'P478',
			'issue' 				=> 'P433',
			'page' 					=> 'P304',
			'PDF'					=> 'P953',
			'ARCHIVE'				=> 'P724',
			'ZOOBANK_PUBLICATION' 	=> 'P2007',
			'abstract'				=> 'P1922', // first line
		);		
		
		// what are we going to add?
		
		
		$to_add = array('ARCHIVE', 'BHLPART');
		
		foreach ($to_add as $k)	
		{
			if (isset($work->message->{$k}))
			{
				$w[] = array($wikidata_properties[$k] => '"' . $work->message->{$k} . '"');		
			}
		}
		
		$quickstatements = '';
		foreach ($w as $statement)
		{
			foreach ($statement as $property => $value)
			{
				$row = array();
				$row[] = $item;
				$row[] = $property;
				$row[] = $value;
		
				$quickstatements .= join("\t", $row);
			
				// labels don't get references 
				$properties_to_ignore = array();
			
							
				if (count($source) > 0 && !preg_match('/^[D|L]/', $property) && !in_array($property, $properties_to_ignore))
				{
					$quickstatements .= "\t" . join("\t", $source);
				}
			
				$quickstatements .= "\n";
			
			}
		}		
		
		
		echo $quickstatements . "\n";

		// Give server a break every 10 items
		if (($count++ % 10) == 0)
		{
			$rand = rand(1000000, 3000000);
			//echo "\n-- ...sleeping for " . round(($rand / 1000000),2) . ' seconds' . "\n\n";
			usleep($rand);
		}
	}

}

fclose($file_handle);

?>
