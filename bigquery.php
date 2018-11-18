<?php

// Do a big SPARQL query


$issn = '1174-9202';
$issn = '0001-804X';

$queries = array();

$queries['works'] = 
'SELECT ?work ?issn (group_concat(?author;separator=";") as ?authors) ?title ?volume ?issue ?pages ?doi 
	WHERE {

	VALUES ?issn {"' . strtoupper($issn) . '"} 
	VALUES ?volume {"5"} 


	?container wdt:P236 ?issn .
  ?work wdt:P1433 ?container .
  
  ?work wdt:P1476 ?title .
  
  ?work wdt:P2093 ?author .
  
  ?work wdt:P478 ?volume .
  OPTIONAL {
    ?work wdt:P433 ?issue .
   }
  ?work wdt:P304 ?pages .
  
  OPTIONAL {
    ?work wdt:P356 ?doi .
   }  
}
GROUP BY ?work ?issn ?title ?volume ?issue ?pages ?doi';




//----------------------------------------------------------------------------------------
// get
function get($url, $format = "application/json")
{
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: " . $format));
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

	$response = curl_exec($ch);
	if($response == FALSE) 
	{
		$errorText = curl_error($ch);
		curl_close($ch);
		die($errorText);
	}
	
	$info = curl_getinfo($ch);
	$http_code = $info['http_code'];
	
	curl_close($ch);
	
	return $response;
}
//----------------------------------------------------------------------------------------

$heading = array();
$first = true;

$page = 100;
$offset = 0;

$done = false;

while (!$done)
{



	$sparql = $queries['works'];
		
	$sparql .= "\nLIMIT $page";
	$sparql .= "\nOFFSET $offset";

	//echo $sparql . "\n";


		$url = 'https://query.wikidata.org/bigdata/namespace/wdq/sparql?query=' . urlencode($sparql);

		//echo $url;

		$json = get($url);
		
		//echo $json;

		$obj = json_decode($json);
		
		//print_r($obj);

		foreach ($obj->results as $results)
		{
			foreach ($results as $binding)
			{
				//print_r($binding);
				
				// dump results 
				
				$row = array();
				
				foreach ($binding as $k => $v)
				{
					if (!isset($heading[$k]))
					{
						$heading[] = $k;
					}
					
					$row[] = $v->value;					
					
				
				}
				
				if ($first)
				{
					echo join("\t", $heading) . "\n";
					$first = false;
				}
				echo join("\t", $row) . "\n";
		
						
			}
		}

	if (count($obj->results->bindings) < $page)
	{
		$done = true;
	}
	else
	{
		$offset += $page;
	}
	
	
}

?>

