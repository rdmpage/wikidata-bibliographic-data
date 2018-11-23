<?php

//----------------------------------------------------------------------------------------
function get($url, $user_agent='', $content_type = '')
{	
	$data = null;

	$opts = array(
	  CURLOPT_URL =>$url,
	  CURLOPT_FOLLOWLOCATION => TRUE,
	  CURLOPT_RETURNTRANSFER => TRUE
	);

	if ($content_type != '')
	{
		$opts[CURLOPT_HTTPHEADER] = array("Accept: " . $content_type);
	}
	
	$ch = curl_init();
	curl_setopt_array($ch, $opts);
	$data = curl_exec($ch);
	$info = curl_getinfo($ch); 
	curl_close($ch);
	
	return $data;
}


//----------------------------------------------------------------------------------------
// replace matching author string with author entity (i.e., "strings to things")
function update_works_author($works, $author_name, $author_qid)
{
	$statements = array();	

	foreach ($works as $q)
	{
		// get Wikidata JSON for works

		// if P50 for author doesn't exist, create quickstaments to add author 

		$url = 'https://www.wikidata.org/wiki/Special:EntityData/' . $q . '.json';

		$json = get($url);

		$obj = json_decode($json);

		//echo $json;

		//echo json_encode($obj, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n";

		$authors = array();
		$author_strings = array();

		// get list of authors (as Wikidata items)
		if (isset($obj->entities->{$q}->claims->P50))
		{
			foreach ($obj->entities->{$q}->claims->P50 as $claim )
			{
				$author = $claim->mainsnak->datavalue->value->id;

				$order = -1;
	
				if (isset($claim->qualifiers->P1545))
				{
					$order = $claim->qualifiers->P1545[0]->datavalue->value;
				}
				$authors[$order] = $author;
			}
		}

		// Get list of authors as strings
		if (isset($obj->entities->{$q}->claims->P2093))
		{
			foreach ($obj->entities->{$q}->claims->P2093 as $claim )
			{
				$author_string = $claim->mainsnak->datavalue->value;

				$order = -1;
	
				if (isset($claim->qualifiers->P1545))
				{
					$order = $claim->qualifiers->P1545[0]->datavalue->value;
				}
				$author_strings[$order] = $author_string;
			}
		}

		echo "authors\n";
		print_r($authors);

		echo "author_string\n";
		print_r($author_strings);

		// If author name occurs in list of author strings, create quickstatements 
		foreach ($author_strings as $order => $author_string )
		{
			if (!isset($authors[$order]))
			{
				if ($author_string == $author_name)
				{
					echo "Add $author_string\n";
		
					// Add author 
					$statements[] = array($q, 'P50', $author_qid, 'P1545', '"' . $order . '"');
				
					// Delete author string
					$statements[] = array('-' . $q, 'P2093', '"' . $author_name . '"');
				}
		
			}	
		}
	}
	
	return $statements;

}

//----------------------------------------------------------------------------------------
// Find works for given journal that have author string
// restricting to journal helps minimise mistaken matches
function works_with_author_string($author_name, $issn)
{
	$works = array();

	$sparql = 'SELECT ?work
	WHERE {
	   ?journal wdt:P236 "' . $issn . '".
	   ?work wdt:P1433 ?journal.
	   ?work wdt:P2093 "' . $author_name . '".	
	}';

	$url = 'https://query.wikidata.org/bigdata/namespace/wdq/sparql?query=' . urlencode($sparql);

	$json = get($url, '', 'application/json');

	$obj = json_decode($json);

	foreach ($obj->results as $results)
	{
		foreach ($results as $binding)
		{
			foreach ($binding as $k => $v)
			{			
				$works[] = preg_replace('/https?:\/\/www.wikidata.org\/entity\//', '', $v->value);					
			}		
		}
	}

	return $works;
}


//----------------------------------------------------------------------------------------


$data = array();

$row_count = 0;

$header = array();
$header_lookup = array();

$filename = 'Auckland Museum/Auckland Museum Article Authors - Sheet1.tsv';

$file = @fopen($filename, "r") or die("couldn't open $filename");		
$file_handle = fopen($filename, "r");
while (!feof($file_handle)) 
{
	$row = fgetcsv(
		$file_handle, 
		0, 
		"\t"
		);

	$go = is_array($row);
	
			
	if ($go && ($row_count == 0))
	{
		$header = $row;
		
		$n = count($header);
		for ($i = 0; $i < $n; $i++)
		{
			$header_lookup[$header[$i]] = $i;
		}
				
		$go = false;
	}
	if ($go)
	{
		
		$obj = new stdclass;
		
		foreach ($row as $k => $v)
		{
			if ($v != '')
			{
				$obj->{$header[$k]} = $v;
			}
		}
		
		$data[] = $obj;
		
		
	}

	$row_count++;
}

//----------------------------------------------------------------------------------------


//print_r($data);

$issn = '1174-9202';

$done = array();


$count = 0;

$quickstatments = '';

foreach ($data as $row)
{
	echo $row->author . "\n";
	echo $row->{'wikidata link'} . "\n";
	
	$author_name = $row->author;
	$author_qid = $row->{'wikidata link'};
	
	$author_qid = preg_replace('/https?:\/\/www.wikidata.org\/wiki\//', '', $author_qid);
	
	if (!in_array($author_name, $done))
	{
	
		$works = works_with_author_string($author_name, $issn);
	
		echo "Works\n";
		print_r($works);
	
		if (count($works) > 0)
		{
			$statements = update_works_author($works, $author_name, $author_qid);
			print_r($statements);
		
			foreach ($statements as $st)
			{		
				$quickstatments .= join("\t", $st) . "\n";
			}
		}
	
		/*
		if ($count++ > 15)
		{
			break;
	
		}
		*/
		
		$done[] = $author_name;
	}
}

echo $quickstatments . "\n";


?>
