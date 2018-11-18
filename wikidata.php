<?php

require_once 'vendor/autoload.php';
use LanguageDetection\Language;

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
// Does wikidata have this DOI?
function wikidata_item_from_doi($doi)
{
	$item = '';
	
	$sparql = 'SELECT * WHERE { ?work wdt:P356 "' . strtoupper($doi) . '" }';
	
	$url = 'https://query.wikidata.org/bigdata/namespace/wdq/sparql?query=' . urlencode($sparql);
	$json = get($url, '', 'application/json');
		
	if ($json != '')
	{
		$obj = json_decode($json);
		if (isset($obj->results->bindings))
		{
			if (count($obj->results->bindings) != 0)	
			{
				$item = $obj->results->bindings[0]->work->value;
				$item = preg_replace('/https?:\/\/www.wikidata.org\/entity\//', '', $item);
			}
		}
	}
	
	return $item;
}

//----------------------------------------------------------------------------------------
// Does wikidata have this JSTOR id?
function wikidata_item_from_jstor($jstor)
{
	$item = '';
	
	$sparql = 'SELECT * WHERE { ?work wdt:P888 "' . $jstor . '" }';
	
	$url = 'https://query.wikidata.org/bigdata/namespace/wdq/sparql?query=' . urlencode($sparql);
	$json = get($url, '', 'application/json');
		
	if ($json != '')
	{
		$obj = json_decode($json);
		if (isset($obj->results->bindings))
		{
			if (count($obj->results->bindings) != 0)	
			{
				$item = $obj->results->bindings[0]->work->value;
				$item = preg_replace('/https?:\/\/www.wikidata.org\/entity\//', '', $item);
			}
		}
	}
	
	return $item;
}


//----------------------------------------------------------------------------------------
// Does wikidata have this BioStor id?
function wikidata_item_from_biostor($biostor)
{
	$item = '';
	
	$sparql = 'SELECT * WHERE { ?work wdt:P5315 "' . $biostor . '" }';
	
	$url = 'https://query.wikidata.org/bigdata/namespace/wdq/sparql?query=' . urlencode($sparql);
	$json = get($url, '', 'application/json');
		
	if ($json != '')
	{
		$obj = json_decode($json);
		if (isset($obj->results->bindings))
		{
			if (count($obj->results->bindings) != 0)	
			{
				$item = $obj->results->bindings[0]->work->value;
				$item = preg_replace('/https?:\/\/www.wikidata.org\/entity\//', '', $item);
			}
		}
	}
	
	return $item;
}


//----------------------------------------------------------------------------------------
// Does wikidata have this PDF
function wikidata_item_from_pdf($pdf)
{
	$item = '';
	
	// URI
	$sparql = 'SELECT * WHERE { ?work wdt:P953 <' . $pdf . '> }';
	
	$url = 'https://query.wikidata.org/bigdata/namespace/wdq/sparql?query=' . urlencode($sparql);
	$json = get($url, '', 'application/json');
			
	if ($json != '')
	{
		$obj = json_decode($json);
		if (isset($obj->results->bindings))
		{
			if (count($obj->results->bindings) != 0)	
			{
				$item = $obj->results->bindings[0]->work->value;
				$item = preg_replace('/https?:\/\/www.wikidata.org\/entity\//', '', $item);
			}
		}
	}
	
	return $item;
}

//----------------------------------------------------------------------------------------
// Do we have a journal with this ISSN?
function wikidata_item_from_issn($issn)
{
	$cached_issn = array(
		'0067-0464' => 'Q15214730', // Records of the Auckland Institute and Museum
		'0001-804X' => 'Q58814054', // Adansonia nouvelle série
	);

	$item = '';
	
	if (isset($cached_issn[$issn]))
	{
		$item = $cached_issn[$issn];
	}
	else
	{
	
		$sparql = 'SELECT * WHERE { ?work wdt:P236 "' . strtoupper($issn) . '" }';
	
		$url = 'https://query.wikidata.org/bigdata/namespace/wdq/sparql?query=' . urlencode($sparql);
		$json = get($url, '', 'application/json');
	
		if ($json != '')
		{
			$obj = json_decode($json);
			if (isset($obj->results->bindings))
			{
				if (count($obj->results->bindings) != 0)	
				{
					$item = $obj->results->bindings[0]->work->value;
					$item = preg_replace('/https?:\/\/www.wikidata.org\/entity\//', '', $item);
				}
			}
		}
	}
		
	return $item;
}

//----------------------------------------------------------------------------------------
function wikidata_item_from_journal_name($name)
{
	$item = '';
	
	// Try English description
	$sparql = 'SELECT * WHERE { ?item rdfs:label "' . addcslashes($name, '"') . '"@en . ?item wdt:P31 wd:Q5633421}';
	
	// echo $sparql . "\n";
	
	$url = 'https://query.wikidata.org/bigdata/namespace/wdq/sparql?query=' . urlencode($sparql);
	$json = get($url, '', 'application/json');
	
	if ($json != '')
	{
		$obj = json_decode($json);
		if (isset($obj->results->bindings))
		{
			if (count($obj->results->bindings) != 0)	
			{
				$item = $obj->results->bindings[0]->item->value;
				$item = preg_replace('/https?:\/\/www.wikidata.org\/entity\//', '', $item);
			}
		}
	}
	
	return $item;
}

//----------------------------------------------------------------------------------------
function wikidata_item_from_orcid($orcid)
{
	$item = '';
	
	$sparql = 'SELECT * WHERE { ?author wdt:P496 "' . $orcid . '" }';
	
	// echo $sparql . "\n";
	
	$url = 'https://query.wikidata.org/bigdata/namespace/wdq/sparql?query=' . urlencode($sparql);
	$json = get($url, '', 'application/json');
	
	if ($json != '')
	{
		$obj = json_decode($json);
		
		//print_r($obj);
		
		if (isset($obj->results->bindings))
		{
			if (count($obj->results->bindings) == 1)	
			{
				$item = $obj->results->bindings[0]->author->value;
				$item = preg_replace('/https?:\/\/www.wikidata.org\/entity\//', '', $item);
			}
		}
	}
	
	return $item;
}

//----------------------------------------------------------------------------------------
function wikidata_item_from_wikispecies_author($wikispecies)
{
	$item = '';
	
	$sparql = 'SELECT * WHERE { VALUES ?article {<https://species.wikimedia.org/wiki/' . urlencode($wikispecies) . '> } ?article schema:about ?author . ?author wdt:P31 wd:Q5 . }';
	
	//echo $sparql . "\n";
	//echo urlencode($sparql) . "\n";
	
	$url = 'https://query.wikidata.org/bigdata/namespace/wdq/sparql?query=' . urlencode($sparql);
	$json = get($url, '', 'application/json');
	
	if ($json != '')
	{
		$obj = json_decode($json);
		
		//print_r($obj);
		
		if (isset($obj->results->bindings))
		{
			if (count($obj->results->bindings) == 1)	
			{
				$item = $obj->results->bindings[0]->author->value;
				$item = preg_replace('/https?:\/\/www.wikidata.org\/entity\//', '', $item);
			}
		}
	}
	
	return $item;
}

//----------------------------------------------------------------------------------------
// Convert a csl json object to Wikidata quickstatments
function csljson_to_wikidata($work, $check = true)
{

	$quickstatements = '';
	
	// Map language codes to Wikidata items
	$language_map = array(
		'en' => 'Q1860',
		'fr' => 'Q150',
		'de' => 'Q188'
	);
	

	// Do we have this already in wikidata?
	$item = '';
	
	if ($check)
	{
	
	
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

	}
	
	
	if ($item == '')
	{
		$item = 'LAST';
	}
	
	$w = array();
	
	/*
$this->props = array(
			'pmid' => 'P698' ,
			'pmcid' => 'P932' ,
			'doi' => 'P356' ,
			'title' => 'P1476' ,
			'published in' => 'P1433' ,
			'original language' => 'P364' ,
			'volume' => 'P478' ,
			'page' => 'P304' ,
			'issue' => 'P433' ,
			'publication date' => 'P577' ,
			'main subject' => 'P921' ,
			'author' => 'P50' ,
			'short author' => 'P2093' ,
			'order' => 'P1545' ,
		) ;*/
		
	$wikidata_properties = array(
		'type'		=> 'P31',
		'BHL' 		=> 'P687',
		'BIOSTOR' 	=> 'P5315',
		'DOI' 		=> 'P356',
		'HANDLE'	=> 'P1184',
		'JSTOR'		=> 'P888',
		'PMID'		=> 'P698',
		'PMC' 		=> 'P932',
		'URL'		=> 'P953',	// https://twitter.com/EvoMRI/status/1062785719096229888
		'title'		=> 'P1476',	
		'volume' 	=> 'P478',
		'issue' 	=> 'P433',
		'page' 		=> 'P304',
		'PDF'		=> 'P953',
	);
	
	// Need to think how to handle multi tag
	
	foreach ($work->message as $k => $v)
	{
		switch ($k)
		{
			case 'type':
				switch ($v)
				{
					case 'article-journal':
					case 'journal-article':
					default:
						$w[] = array('P31' => 'Q13442814');
						break;
				}
				break;
		
			case 'title':
				// Handle multiple languages
				$done = false;
				
				if (isset($work->message->multi))
				{
					if (isset($work->message->multi->_key->title))
					{					
						foreach ($work->message->multi->_key->title as $language => $v)
						{
							// title
							$w[] = array($wikidata_properties[$k] => $language . ':' . '"' . addcslashes($v, '"') . '"');
							// label
							$w[] = array('L' . $language => '"' . addcslashes($v, '"') . '"');
						}					
						$done = true;
					}					
				}
			
				if (!$done)
				{			
					$title = $v;
					if (is_array($v))
					{
						$title = $v[0];
					}				
				
					// We always want a title for the English language, even if
					// it isn't English
					$language = 'en';					
					$title = strip_tags($title);
					
					/*
					// title
					$w[] = array($wikidata_properties[$k] => $language . ':' . '"' . addcslashes($title, '"') . '"');
					// label
					$w[] = array('L' . $language => '"' . addcslashes($title, '"') . '"');
					*/
										
					
					if (1)
					{
						// Detect language of title
						$ld = new Language(['fr', 'en', 'de']);						
						$language = $ld->detect($title)->__toString();
						
						if ($language == 'en')
						{
							// Assume work is English
							$w[] = array('P407' => $language_map[$language]);

							// title
							$w[] = array($wikidata_properties[$k] => $language . ':' . '"' . addcslashes($title, '"') . '"');
							// label
							$w[] = array('L' . $language => '"' . addcslashes($title, '"') . '"');
							
							
						}
						else											
						{
							// title
							$w[] = array($wikidata_properties[$k] => $language . ':' . '"' . addcslashes($title, '"') . '"');
							// label
							$w[] = array('L' . $language => '"' . addcslashes($title, '"') . '"');
							
							// language of work (assume it is the same as the title)
							$w[] = array('P407' => $language_map[$language]);							
							
							// add label in English anyway
							$w[] = array('Len' => '"' . addcslashes($title, '"') . '"');
							
						}	
					}
					
			
				}
				break;
				
			case 'author':
				// For now just use author names, but will want to do lookup to see if there is an item for each person
				// in which case we would only add the item, not the name (can have one or the other)
				// Note that we can't seem to add language codes to author names, they are just dumb strings
				$count = 1;
				foreach ($work->message->author as $author)
				{
					/*
					if (isset($author->multi))
					{
						if (isset($author->multi->_key->literal))
						{
							foreach ($author->multi->_key->literal as $language => $v)
							{
								$w[] = array('P2093' => $language . ':' . '"' . addcslashes($v, '"') . '"' . "\tP1545\t\"$count\"");
							}											
						}
					}
					*/
					
					$done = false;
					
					if (!$done)
					{
						if (isset($author->ORCID))
						{
							$orcid = $author->ORCID;
							$orcid = preg_replace('/https?:\/\/orcid.org\//', '', $orcid);
						
							$author_item = wikidata_item_from_orcid($orcid);
						
							if ($author_item != '')
							{							
								$w[] = array('P50' => $author_item . "\tP1545\t\"$count\"");
								$done = true;
							}						
						}						
					}
					
					if (!$done)
					{
						if (isset($author->WIKISPECIES))
						{
							$author_item = wikidata_item_from_wikispecies_author($author->WIKISPECIES);
						
							if ($author_item != '')
							{							
								$w[] = array('P50' => $author_item . "\tP1545\t\"$count\"");
								$done = true;
							}						
						}						
					}
					
					if (!$done)
					{
						$name = '';
						if (isset($author->literal))
						{
							$name = $author->literal;
						}
						else
						{
							$parts = array();
							if (isset($author->given))
							{
								$parts[] = $author->given;
							}
							if (isset($author->family))
							{
								$parts[] = $author->family;
							}
							$name = join(' ', $parts);				
						}
						$w[] = array('P2093' => '"' . addcslashes($name, '"') . '"' . "\tP1545\t\"$count\"");
					}
					$count++;
				}
				break;
		
			case 'volume':
			case 'issue':
			case 'page':
				$w[] = array($wikidata_properties[$k] => '"' . addcslashes($v, '"') . '"');
				break;
				
			case 'BHL':
				$w[] = array($wikidata_properties[$k] => '"' . $v . '"');
				break;

			case 'BIOSTOR':
				$w[] = array($wikidata_properties[$k] => '"' . $v . '"');
				break;
				
			case 'DOI':
				$w[] = array($wikidata_properties[$k] => '"' . strtoupper($v) . '"');
				break;
				
			case 'JSTOR':
				$w[] = array($wikidata_properties[$k] => '"' . $v . '"');
				break;
				
			// BioStor CSL-JSON
			case 'bhl_pages':
				// Get first element of page array
				// https://stackoverflow.com/a/42066999/9684
				$w[] = array($wikidata_properties['BHL'] => '"' . current($v) . '"');
				break;
			
			
			case 'URL':
				if (is_array($v))
				{
					foreach ($v as $url)
					{
						$go = true;
						
						if (preg_match('/https?:\/\/www.jstor.org/', $url))
						{
							// force JSTOR to be https						
							$url = preg_replace('/http:\/\/www.jstor.org/', 'https://www.jstor.org', $url);
							// For now ignore JSTOR URLs
							$go = false;
						}						
					
						if ($go)
						{
							$w[] = array($wikidata_properties[$k] => '"' . $url . '"');
						}
					}
				}
				else
				{		
					$url = $v;
					$go = true;
					
					if (preg_match('/https?:\/\/www.jstor.org/', $url))
					{
						// force JSTOR to be https						
						$url = preg_replace('/http:\/\/www.jstor.org/', 'https://www.jstor.org', $url);
						// For now ignore JSTOR URLs
						$go = false;
					}						
				
					if ($go)
					{
						$w[] = array($wikidata_properties[$k] => '"' . $url . '"');
					}
				}
				break;
				
			case 'WIKISPECIES':
				$w[] = array('Sspecieswiki' => $v);
				break;
				
			case 'link':
				foreach ($v as $link)
				{
					if ($link->{'content-type'} == 'application/pdf')
					{
						$w[] = array($wikidata_properties['PDF'] => '"' . $link->URL . '"');
					}
				}
				break;
								
			case 'container-title':
				$container = $v;
				if (is_array($v))
				{
					$container = $v[0];
				}
				
				// OK, we need to link this to a Wikidata item
				
				// try via ISSN
				$journal_item = '';
				
				if ($journal_item == '')
				{
					if (isset($work->message->ISSN))
					{
						$n = count($work->message->ISSN);
						$i = 0;
						while (($journal_item == '') && ($i < $n))
						{
							$journal_item = wikidata_item_from_issn($work->message->ISSN[$i]);
							$i++;
						}
					}
				}	
				
				if ($journal_item == '')
				{
					$journal_item = wikidata_item_from_journal_name($container);
				}
				
				// If we have the container in Wikidata link to it
				if ($journal_item != '')
				{
					$w[] = array('P1433' => $journal_item);
				}
				break;
				
			// based on https://bitbucket.org/magnusmanske/sourcemd/src/6c998c4809df/sourcemd.php?at=master
			case 'issued':			
				$date = '';
				$d = $v->{'date-parts'}[0];
				if ( count($d) > 0 ) $year = $d[0] ;
				if ( count($d) > 1 ) $month = preg_replace ( '/^0+(..)$/' , '$1' , '00'.$d[1] ) ;
				if ( count($d) > 2 ) $day = preg_replace ( '/^0+(..)$/' , '$1' , '00'.$d[2] ) ;
				if ( isset($month) and isset($day) ) $date = "+$year-$month-$day"."T00:00:00Z/11";
				else if ( isset($month) ) $date = "+$year-$month-00T00:00:00Z/10";
				else if ( isset($year) ) $date = "+$year-00-00T00:00:00Z/9";
				
				$w[] = array('P577' => $date);
				break;
				
			case 'reference':
				foreach ($v as $reference)
				{
					if (isset($reference->DOI))
					{
						// for now just see if this already exists
						$cited = wikidata_item_from_doi($reference->DOI);
						if ($cited != '')
						{
							$w[] = array('P2860' => $cited);
						}					
					}
				}
				break;
				
	
			default:
				break;
		}
	}
	
	// echo "--------------------------\n";
	
	// assume create
	if ($item == 'LAST')
	{
		echo "CREATE\n";
	}	
	
	foreach ($w as $statement)
	{
		foreach ($statement as $property => $value)
		{
			$row = array();
			$row[] = $item;
			$row[] = $property;
			$row[] = $value;
		
			$quickstatements .= join("\t", $row) . "\n";
			
		}
	}
	
	// echo "--------------------------\n";
	
	
	
	return $quickstatements;

	
}

//----------------------------------------------------------------------------------------
// list of items already in Wikidata for a journal
// could use as basis for RIS export for matching, etc.
function works_for_journal($issn)
{
	$works = array();
	$sparql = 'SELECT ?work (group_concat(?author;separator=";") as ?authors) ?title ?volume ?issue ?pages ?doi 
	WHERE { 
	?container wdt:P236 "' . strtoupper($issn) . '" .
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
GROUP BY ?work ?title ?volume ?issue ?pages ?doi ';

	
	$url = 'https://query.wikidata.org/bigdata/namespace/wdq/sparql?query=' . urlencode($sparql);
	$json = get($url, '', 'application/json');
		
	if ($json != '')
	{
		$obj = json_decode($json);
		
		
		if (isset($obj->results->bindings))
		{
			foreach ($obj->results->bindings as $binding)
			{
				$work = new stdclass;
				
				foreach ($binding as $k => $v)
				{
					$work->{$k} = $v->value;
				}
				
				$works[] = $work;

			}
		}
	}
	
	return $works;

}

//----------------------------------------------------------------------------------------
// OpenURL lookup using ISSN, volume, spage
function wikidata_item_from_openurl($issn, $volume, $spage)
{
	$item = '';
	
	$sparql = 'SELECT * WHERE 
{ 
  VALUES ?issn {"' . $issn . '" } .
  VALUES ?volume {"' . $volume . '" } .
  VALUES ?firstpage {"^' . $spage . '(–[0-9]+)?$" } .
  
  ?work wdt:P1433 ?container .
  ?container wdt:P236 ?issn.
  ?work wdt:P478 ?volume .
  ?work wdt:P304 ?pages .
  FILTER regex(?pages,?firstpage,"i")
}';
	
	
	$url = 'https://query.wikidata.org/bigdata/namespace/wdq/sparql?query=' . urlencode($sparql);
	$json = get($url, '', 'application/json');
		
	if ($json != '')
	{
		$obj = json_decode($json);
		
		//print_r($obj);
		
		if (isset($obj->results->bindings))
		{
			if (count($obj->results->bindings) != 0)	
			{
				$item = $obj->results->bindings[0]->work->value;
				$item = preg_replace('/https?:\/\/www.wikidata.org\/entity\//', '', $item);
			}
		}
	}
	
	return $item;
}



//----------------------------------------------------------------------------------------
// Fetch CrossRef DOI
function get_work($doi)
{
	$obj = null;
	
	$url = 'https://api.crossref.org/v1/works/http://dx.doi.org/' . $doi;
	
	$json = get($url);
	
	if ($json != '')
	{
		$obj = json_decode($json);
	}
	return $obj;
}

//----------------------------------------------------------------------------------------

// tests
if (0)
{

/*
// DOI
$doi = '10.1080/00222933.2010.520169';
$doi = '10.3956/2011-13.1';
$doi = '10.3969/J.ISSN.2095-0845.2001.02.002';
$item = wikidata_item_from_doi($doi);
echo "$doi $item\n";

// ISSN
$issn = '1175-5326';
$issn = '0001-6799';
$item = wikidata_item_from_issn($issn);
echo "$issn $item\n";

// Journal name
$name = 'Allertonia';
//$name = 'Munis Entomology & Zoology';
//$name = 'The Pan-Pacific entomologist';
$item =  wikidata_item_from_journal_name($name);
echo "$name $item\n";

// BioStor
$biostor = 217669;
$item =  wikidata_item_from_biostor($biostor);
echo "$biostor $item\n";

// Add from microcitation
$guid = '10.3969/j.issn.2095-0845.2001.02.002';
$guid = '10.13346/j.mycosystema.140275';
$guid = '10.3969/j.issn.1005-9628.2005.01.005';

// JSTOR only
//$guid = 'http://www.jstor.org/stable/23187393';

// PDF is GUID, need to have OpenURL and/or PDF lookup to check doesn't exist
//$guid = urlencode('http://www.museunacional.ufrj.br/publicacoes/wp-content/arquivos/Arqs%2065%20n%204%20p%20485-504%20Calvo%20et%20al.pdf');

$json = get('http://localhost/~rpage/microcitation/www/citeproc-api.php?guid=' . $guid);


// BioStor examples
$biostor = 240296;
$biostor = 217669;

//$json = get('http://biostor.org/api.php?id=biostor/' . $biostor . '&format=citeproc');


$obj = json_decode($json);

//print_r($obj);

$work = new stdclass;
$work->message = $obj;

csljson_to_wikidata($work);

// works for a journal 
$issn = '0079-8835';

// $works = works_for_journal($issn);
// print_r($works);

// OpenURL


$issn	= "1175-5326";
$volume = "2528";
$spage 	= "1";

$item = wikidata_item_from_openurl($issn, $volume, $spage);
echo "$issn  $volume  $spage $item\n";

*/

/*
$doi = '10.1371/journal.pone.0029715';
$doi = '10.1111/aen.12333'; // I've added this
$work = get_work($doi);
if ($work)
{
	// print_r($work);
	csljson_to_wikidata($work);
}
*/

// JSTOR-based journal

$issn = '1174-9202';
$works = works_for_journal($issn);
print_r($works);

$guid = 'http://www.jstor.org/stable/42905863';

$guid = urlencode('http://www.guihaia-journal.com/ch/reader/view_abstract.aspx?file_no=1986Z1003&flag=1');

$guid = urlencode('http://www.guihaia-journal.com/ch/reader/view_abstract.aspx?file_no=20070426&flag=1');


$json = get('http://localhost/~rpage/microcitation/www/citeproc-api.php?guid=' . $guid);


$obj = json_decode($json);

//print_r($obj);

$work = new stdclass;
$work->message = $obj;

csljson_to_wikidata($work);

}

?>
