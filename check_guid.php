<?php

// Get Wikidata item ids for a list of guids

require_once (dirname(__FILE__) . '/wikidata.php');


// Proceedings of the California Academy of Sciences
$filename = 'quickstatements/0068-547X.txt';
$filename = 'quickstatements/札幌博物学会会報.txt';
$filename = 'urls.txt';

$file_handle = fopen($filename, "r");
while (!feof($file_handle)) 
{
	$guid = trim(fgets($file_handle));
	
	
	$url = 'http://localhost/~rpage/microcitation/www/citeproc-api.php?guid=' . $guid;

	$json = get($url);
	

	$obj = json_decode($json);
	
	$work = new stdclass;
	$work->message = $obj;
	
	// Do we have this already in wikidata?
	$item = '';
	
	
	// DOI
	if (isset($work->message->DOI))
	{
		$item = wikidata_item_from_doi($work->message->DOI);
	}

	// JSTOR
	if ($item == '')
	{
		if (isset($work->message->JSTOR))
		{
			$item = wikidata_item_from_jstor($work->message->JSTOR);
		
		}
	}	
	
	
	// HANDLE
	if ($item == '')
	{
		if (isset($work->message->HANDLE))
		{
			$item = wikidata_item_from_handle($work->message->HANDLE);
		
		}
	}					

	// BioStor
	if ($item == '')
	{
		if (isset($work->message->BIOSTOR))
		{
			$item = wikidata_item_from_biostor($work->message->BIOSTOR);
		}
	}		

	// PDF
	if ($item == '')
	{
		if (isset($work->message->link))
		{
			foreach ($work->message->link as $link)
			{
				if ($link->{'content-type'} == 'application/pdf')
				{
					$item = wikidata_item_from_pdf($link->URL);
				}
			}
		}
	}
	
	// OpenURL
	if ($item == '')
	{
		$parts = array();

		if (isset($work->message->ISSN))
		{
			$parts[] = $work->message->ISSN[0];
		}
		if (isset($work->message->volume))
		{
			$parts[] = $work->message->volume;
		}
		if (isset($work->message->page))
		{
			if (preg_match('/^(?<spage>\d+)(-\d+)?/', $work->message->page, $m))
			{
				$parts[] = $m['spage'];
			}
		}
		
		//print_r($parts);

		if (count($parts == 3))
		{
			$item = wikidata_item_from_openurl($parts[0], $parts[1], $parts[2]);
		}
	}
	
	if ($item != '')
	{
		// already exists, if $update is false exit
		
		echo "UPDATE publications SET wikidata='" . $item . "' WHERE guid='" . $guid . "';\n";
		
		
	}
	

}

fclose($file_handle);

?>
