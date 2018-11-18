<?php

// Add records to Wikidata

require_once (dirname(__FILE__) . '/wikidata.php');

$filename = '1174-9202.tsv';

$filename = 'quickstatements/0067-0464.tsv';

$filename = 'quickstatements/1005-9628.tsv';

$filename = 'quickstatements/0001-804X.tsv';

$file_handle = fopen($filename, "r");
while (!feof($file_handle)) 
{
	$guid = trim(fgets($file_handle));
	
	//echo $guid . "\n";
	
	$url = 'http://localhost/~rpage/microcitation/www/citeproc-api.php?guid=' . $guid;

	$json = get($url);
	

	$obj = json_decode($json);

	//print_r($obj);
	
	// do we have this already?
	$ok = true;
	
	$parts = array();
	
	if (isset($obj->ISSN))
	{
		$parts[] = $obj->ISSN[0];
	}
	if (isset($obj->volume))
	{
		$parts[] = $obj->volume;
	}
	if (isset($obj->page))
	{
		if (preg_match('/^(?<spage>\d+)(-\d+)?/', $obj->page, $m))
		{
			$parts[] = $m['spage'];
		}
	}
	
	//print_r($parts);
	
	if (count($parts == 3))
	{
		$item = wikidata_item_from_openurl($parts[0], $parts[1], $parts[2]);
		if ($item != '')
		{
			echo "*** Have already: $item ***\n";
			$ok = false;
		}
		else
		{
			// echo "Not found\n";
		}
	}
	
	if ($ok)
	{
		$work = new stdclass;
		$work->message = $obj;

		$quickstatements = csljson_to_wikidata($work);
		
		echo $quickstatements . "\n\n";
	}
	
	

}

fclose($file_handle);

?>
