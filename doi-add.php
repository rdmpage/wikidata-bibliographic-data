<?php

// Add records to Wikidata from DOI

require_once (dirname(__FILE__) . '/wikidata.php');


$dois=array(
'10.1071/MR02013',
);

foreach ($dois as $doi)
{
	$item = wikidata_item_from_doi($doi);
	
	if ($item != '')
	{
		echo "Have already $item\n";
	}
	else
	{
		$crossref = true;
		
		if (preg_match('/10.1071\/MR/i', $doi))
		{
			$crossref = false;
		}
	
		if ($crossref)
		{
			$work = get_work($doi);
		}
		else
		{
			$json = get('http://localhost/~rpage/microcitation/www/citeproc-api.php?guid=' . urlencode($doi));
						
			$obj = json_decode($json);
			$work = new stdclass;
			$work->message = $obj;		
		}
	
		print_r($work);
	
		if ($work)
		{
			$q = csljson_to_wikidata($work);
		
			echo $q;
			echo "\n";
		}
	}	


}


?>
