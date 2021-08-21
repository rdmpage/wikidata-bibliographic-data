<?php

// Given list of URLs match to Wikidata based on metadata
// Use this if there are no external identifiers availabel for the work

require_once (dirname(__FILE__) . '/wikidata.php');

$filename = 'urls.txt';


$file_handle = fopen($filename, "r");
while (!feof($file_handle)) 
{
	$guid = trim(fgets($file_handle));
	
	echo "-- $guid\n";
	
	$url = 'http://localhost/~rpage/microcitation/www/citeproc-api.php?guid=' . urlencode($guid);
	
	// tmp
//	$url = 'http://localhost/~rpage/microcitation/www/citeproc-api.php?guid=' . urlencode($guid). '&table=publications_tmp';

	$json = get($url);
	
	// echo $json;
	
	$work = json_decode($json);
	
	// print_r($work);
	
	$parts = array();
	
	$item = '';

	if (isset($work->ISSN))
	{
		$parts[] = $work->ISSN[0];
	}
	if (isset($work->volume))
	{
		$parts[] = $work->volume;
	}
	if (isset($work->page))
	{
		if (preg_match('/^(?<spage>\d+)(-\d+)?/', $work->page, $m))
		{
			$parts[] = $m['spage'];
		}
	}
	
	if (isset($work->{'issued'}))
	{
		$parts[] = $work->{'issued'}->{'date-parts'}[0][0];
	}
	
	// print_r($parts);

	if (count($parts) == 4)
	{
		$item = wikidata_item_from_openurl_issn($parts[0], $parts[1], $parts[2], $parts[3]);
	}
	
	if ($item != '')
	{
		echo "UPDATE publications SET wikidata='" . $item . "' WHERE guid='" . $guid . "';" . "\n";
	}
	
	

}

fclose($file_handle);

?>
