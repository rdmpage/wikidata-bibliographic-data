<?php

// Get Wikidata id for items

require_once (dirname(__FILE__) . '/wikidata.php');

$filename = '1174-9202.tsv';
$filename = 'quickstatements/0067-0464.tsv';


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
	
	$jstor = preg_replace('/https?:\/\/www.jstor.org\/stable\//', '', $guid);
	
	$item = wikidata_item_from_jstor($jstor);
	
	if ($item != '')
	{
		echo 'UPDATE publications SET wikidata="' . $item . '" WHERE jstor="' . $jstor . '";' . "\n";
	}
			
			

	

}

fclose($file_handle);

?>
