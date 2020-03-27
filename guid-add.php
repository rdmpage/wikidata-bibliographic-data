<?php

// Add records to Wikidata from microcitation database

require_once (dirname(__FILE__) . '/wikidata.php');


$guids=array(
'http://peckhamia.com/peckhamia/PECKHAMIA_141.1.pdf',
);

foreach ($guids as $guid)
{
	$json = get('http://localhost/~rpage/microcitation/www/citeproc-api.php?guid=' . urlencode($guid));
				
	$obj = json_decode($json);
	$work = new stdclass;
	$work->message = $obj;		

	print_r($work);

	$item = wikidata_find_from_anything ($work);
	
	if ($item != '')
	{
		echo "Have already $item\n";
		
		// for debugging, or updating
		if (1)
		{
			$q = csljson_to_wikidata($work);
	
			echo $q;
			echo "\n";		
		}
	}
	else
	{
		$q = csljson_to_wikidata($work);
	
		echo $q;
		echo "\n";
	}	


}


?>
