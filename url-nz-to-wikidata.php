<?php

// Given list of URLs match to Wikidata and update NZ

require_once (dirname(__FILE__) . '/wikidata.php');

$filename = 'nzurls.txt';

$not_found = array();


$file_handle = fopen($filename, "r");
while (!feof($file_handle)) 
{
	$parts = explode("\t", trim(fgets($file_handle)));
	
	$id = $parts[0];
	$guid = $parts[1];
	
	echo "-- $guid\n";
	
	$done = false;
	
	/*
	if (!$done)
	{
		if (preg_match('/pmid:(?<id>\d+)/', $guid, $m))
		{
			$pmid = $m['id'];
			
			$item = wikidata_item_from_pmid($pmid);
			if ($item)
			{
				echo "UPDATE names SET wikidata='" . $item . "' WHERE pmid='" . $pmid . "';" . "\n";
				$done = true;
			}
		}			
	}
		*/
	
	if (!$done)
	{
		if (preg_match('/https?:\/\/www.jstor.org\/stable\/(?<id>.*)/', $guid, $m))
		{
			$jstor = $m['id'];
			
			//echo $jstor . "\n";
			
			$item = wikidata_item_from_jstor($jstor);
			if ($item)
			{
				echo 'REPLACE INTO nz_id(id, namespace, identifier) VALUES (' . $id . ',"wikidata","' . $item . '");' . "\n";
				$done = true;
			}
		}			
	}
	

	if (!$done)
	{
		if (preg_match('/^10\.\d+\//', $guid, $m))
		{
			$item = wikidata_item_from_doi($guid);
			if ($item)
			{
				echo 'REPLACE INTO nz_id(id, namespace, identifier) VALUES (' . $id . ',"wikidata","' . $item . '");' . "\n";
				$done = true;
			}
			else
			{
				$not_found[] = $guid;
			}
		}			
	}

	
	if (!$done)
	{
		if (preg_match('/\d+\/[A-Z0-9_]+/', $guid))
		{
			//$bhl_part = $m['id'];
			
			$item = wikidata_item_from_handle($guid);
			if ($item)
			{
				echo 'REPLACE INTO nz_id(id, namespace, identifier) VALUES (' . $id . ',"wikidata","' . $item . '");' . "\n";
				$done = true;
			}
		}			
	}	
	
	


	// CINII
	if (!$done)
	{
		if (preg_match('/https?:\/\/ci.nii.ac.jp\/naid\/(?<id>\d+)/', $guid, $m))
		{
			$cinii = $m['id'];
						
			$item = wikidata_item_from_cinii($cinii);
			if ($item)
			{
				echo "UPDATE names SET wikidata='" . $item . "' WHERE cinii='" . $guid . "';" . "\n";
				$done = true;
			}
		}			
	}				
	
	/*
	if (!$done)
	{
		$item = wikidata_item_from_url($guid);
		if ($item)
		{
			echo "UPDATE names SET wikidata='" . $item . "' WHERE url='" . $guid . "';" . "\n";
			$done = true;
		}		
	}
	*/
	

	
	

}

fclose($file_handle);

print_r($not_found);

?>
