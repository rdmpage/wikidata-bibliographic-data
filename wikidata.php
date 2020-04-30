<?php

require_once 'vendor/autoload.php';
use LanguageDetection\Language;


//----------------------------------------------------------------------------------------
// trim a string nicelt
function nice_shorten($str, $length = 250) {
	if (mb_strlen($str) > $length)
	{
		$str = mb_substr($str, 0, $length - 1);
		
		$pos = mb_strrpos($str, ' ');
		if ($pos === false) {
		} else {
			$str = mb_substr($str, 0, $pos);		
		}
		
		$str .= '…';	
	}

	return $str;
}


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
		
		$opts[CURLOPT_HTTPHEADER] = array(
			"Accept: " . $content_type, 
			"User-agent: Mozilla/5.0 (iPad; U; CPU OS 3_2_1 like Mac OS X; en-us) AppleWebKit/531.21.10 (KHTML, like Gecko) Mobile/7B405" 
		);
		
	}
	
	$ch = curl_init();
	curl_setopt_array($ch, $opts);
	$data = curl_exec($ch);
	$info = curl_getinfo($ch); 
	curl_close($ch);
	
	return $data;
}

//----------------------------------------------------------------------------------------
// Does wikidata have this funder with a Crossref funder DOI
function wikidata_funder_from_doi($doi)
{
	$item = '';
	
	$id = $doi;
	$id = strtoupper(str_replace('10.13039/', '', $id));
	
	$sparql = 'SELECT * WHERE { ?funder wdt:P3153 "' . $id . '" }';
	
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
				$item = $obj->results->bindings[0]->funder->value;
				$item = preg_replace('/https?:\/\/www.wikidata.org\/entity\//', '', $item);
			}
		}
	}
	
	return $item;
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
// Does wikidata have this URL?
function wikidata_item_from_url($url)
{
	$item = '';
	
	$sparql = 'SELECT * WHERE { ?work wdt:P953 <' . $url . '> }';
	
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
// Does wikidata have this BHL part id?
function wikidata_item_from_bhl_part($bhl_part)
{
	$item = '';
	
	$sparql = 'SELECT * WHERE { ?work wdt:P6535 "' . $bhl_part . '" }';
	
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
// Does wikidata have this CNKI?
function wikidata_item_from_cnki($cnki)
{
	$item = '';
	
	$sparql = 'SELECT * WHERE { ?work wdt:P6769 "' . $cnki . '" }';
	
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
// Does wikidata have this Handle id?
function wikidata_item_from_handle($handle)
{
	$item = '';
	
	$sparql = 'SELECT * WHERE { ?work wdt:P1184 "' . $handle . '" }';
	
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
// Do we have a book with this ISBN-10?
function wikidata_item_from_isbn10($isbn10)
{
	$item = '';

	$sparql = 'SELECT * WHERE { ?work wdt:P957 "' . strtoupper($isbn10) . '" }';

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
// Do we have a book with this ISBN-13?
function wikidata_item_from_isbn13($isbn13)
{
	$item = '';

	$sparql = 'SELECT * WHERE { ?work wdt:P212 "' . strtoupper($isbn13) . '" }';

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
function wikidata_item_from_journal_name($name, $language = 'en')
{
	$item = '';
	
	// Try  description
	$sparql = 'SELECT * WHERE { ?item rdfs:label "' . addcslashes($name, '"') . '"@' . $language . ' . ?item wdt:P31 wd:Q5633421}';

	
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
	
	//echo $sparql . "\n";
	
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
function wikidata_item_from_persee($perse)
{
	$item = '';
	
	$sparql = 'SELECT * WHERE { ?author wdt:P2732 "' . $perse . '" }';
	
	//echo $sparql . "\n";
	
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
function csljson_to_wikidata($work, $check = true, $update = true, $languages_to_detect = array('en'), $source = array())
{

	$MAX_LABEL_LENGTH = 250;

	$quickstatements = '';
	
	// Map language codes to Wikidata items
	$language_map = array(
		'da' => 'Q9035',
		'de' => 'Q188',
		'en' => 'Q1860',
		'es' => 'Q1321',
		'fr' => 'Q150',
		'ja' => 'Q5287',
		'nl' => 'Q7411',
		'pt' => 'Q5146',
		'ru' => 'Q7737',
		'th' => 'Q9217',
		'zh' => 'Q7850',		
	);
	

	// Do we have this already in wikidata?
	$item = '';
	
	if ($check)
	{
	
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

		// CNKI
		if ($item == '')
		{
			if (isset($work->message->CNKI))
			{
				$item = wikidata_item_from_cnki($work->message->CNKI);
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
		
		// URL
		if ($item == '')
		{
			if (isset($work->message->URL))
			{
				$item = wikidata_item_from_url($work->message->URL);
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

	}
	
	if ($item != '')
	{
		// already exists, if $update is false exit
		
		//echo "Have item $item\n";
		
		if (!$update)
		{
			return;
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
		'type'					=> 'P31',
		'BHL' 					=> 'P687',
		'BHLPART' 				=> 'P6535',
		'BIOSTOR' 				=> 'P5315',
		'CNKI'					=> 'P6769',
		'DOI' 					=> 'P356',
		'HANDLE'				=> 'P1184',
		'JSTOR'					=> 'P888',
		'PMID'					=> 'P698',
		'PMC' 					=> 'P932',
		'URL'					=> 'P953',	// https://twitter.com/EvoMRI/status/1062785719096229888
		'title'					=> 'P1476',	
		'volume' 				=> 'P478',
		'issue' 				=> 'P433',
		'page' 					=> 'P304',
		'PDF'					=> 'P953',
		'ARCHIVE'				=> 'P724',
		'ZOOBANK_PUBLICATION' 	=> 'P2007',
		'abstract'				=> 'P1922', // first line
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
							$w[] = array($wikidata_properties[$k] => $language . ':' . '"' . str_replace('"', '""', $v) . '"');

							// label
							$w[] = array('L' . $language => '"' . str_replace('"', '""', nice_shorten($v, $MAX_LABEL_LENGTH)) . '"');
						}					
						$done = true;
					}					
				}
			
				if (!$done)
				{			
					$title = $v;
					if (is_array($v))
					{
						if (count($v) == 0)
						{
							$title = '';
						}
						{
							$title = $v[0];
						}
					}				
					
					if ($title != '')
					{
				
						// We always want a title for the English language, even if
						// it isn't English
						$language = 'en';					
						$title = strip_tags($title);
						
						$title = html_entity_decode($title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
					
						/*
						// title
						$w[] = array($wikidata_properties[$k] => $language . ':' . '"' . addcslashes($title, '"') . '"');
						// label
						$w[] = array('L' . $language => '"' . addcslashes($title, '"') . '"');
						*/
										
					
						if (1)
						{
							$language == 'en';
							
							$detect = true;
							
							if (count($languages_to_detect) == 1 && $languages_to_detect[0] == 'en')
							{
								//echo "Assume English\n";
							
								// English is default
								$detect = false;
								
								
							}
							
							if ($detect)
							{			
								//echo "Detect language\n";
											
								// Detect language of title
								$ld = new Language($languages_to_detect);						
								$language = $ld->detect($title)->__toString();
							}
						
							if ($language == 'en')
							{
								// Assume work is English
								$w[] = array('P407' => $language_map[$language]);

								// title
								$w[] = array($wikidata_properties[$k] => $language . ':' . '"' . str_replace('"', '""', $title) . '"');

								// label
								$w[] = array('L' . $language => '"' . str_replace('"', '""', nice_shorten($title, $MAX_LABEL_LENGTH)) . '"');
							
							
							}
							else											
							{
								if (in_array('2175-7860', $work->message->ISSN))
								{
									if ($language == 'es')
									{
										$language = 'pt';
									}								
								}
							
								// title
								$w[] = array($wikidata_properties[$k] => $language . ':' . '"' . str_replace('"', '""', $title) . '"');

								// label
								$w[] = array('L' . $language => '"' . str_replace('"', '""', nice_shorten($title, $MAX_LABEL_LENGTH)) . '"');
							
								// language of work (assume it is the same as the title)
								$w[] = array('P407' => $language_map[$language]);							
							
								// add label in English anyway
								$w[] = array('Len' => '"' . str_replace('"', '""', nice_shorten($title, $MAX_LABEL_LENGTH)) . '"');
							
							}	
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
					
					
					// Do we have an ORCID?
					if (!$done)
					{
						if (isset($author->ORCID))
						{
							$orcid = $author->ORCID;
							$orcid = preg_replace('/https?:\/\/orcid.org\//', '', $orcid);
							
							// echo "orcid =$orcid\n"; 
						
							$author_item = wikidata_item_from_orcid($orcid);
						
							if ($author_item != '')
							{							
								$w[] = array('P50' => $author_item . "\tP1545\t\"$count\"");
								$done = true;
							}						
						}						
					}
					
					// Do we have WIKISPECIES?
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
					
					// Do we have PERSEE?
					if (!$done)
					{
						if (isset($author->PERSEE))
						{
							$author_item = wikidata_item_from_persee($author->PERSEE);
						
							if ($author_item != '')
							{							
								$w[] = array('P50' => $author_item . "\tP1545\t\"$count\"");
								$done = true;
							}						
						}						
					}
					
					
					// If we've reached this point we only have literals, so add these
					
					if (!$done)
					{
						$name = '';
						
						// multilingual?
						if (isset($author->multi->_key->literal))
						{
							$strings = array();
							
							foreach ($author->multi->_key->literal as $language => $v)
							{
								$strings[] = $v;
							}
							
							$name = join("/", $strings);				
						}
						else 
						{						
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
						}
					
						$qualifier = "\tP1545\t\"$count\"";
					
						if (isset($author->affiliation))
						{
							foreach ($author->affiliation as $affiliation)
							{
								if (isset($affiliation->name))
								{
									$qualifier .= "\tP6424\t\"" . addcslashes($affiliation->name, '"') . '"';
								}
							}						
						}						
					
						$w[] = array('P2093' => '"' . addcslashes($name, '"') . '"' . $qualifier);

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

			case 'BHLPART':
				$w[] = array($wikidata_properties[$k] => '"' . $v . '"');
				break;

			case 'BIOSTOR':
				$w[] = array($wikidata_properties[$k] => '"' . $v . '"');
				break;

			case 'CNKI':
				$w[] = array($wikidata_properties[$k] => '"' . $v . '"');
				break;
				
			case 'DOI':
				$w[] = array($wikidata_properties[$k] => '"' . strtoupper($v) . '"');
				break;
				
			case 'JSTOR':
				$w[] = array($wikidata_properties[$k] => '"' . $v . '"');
				break;
								
			case 'HANDLE':
				$w[] = array($wikidata_properties[$k] => '"' . strtoupper($v) . '"');
				break;								
				
			case 'ARCHIVE':
				$w[] = array($wikidata_properties[$k] => '"' . $v . '"');
				break;
				
			case 'PMID':
				$w[] = array($wikidata_properties[$k] => '"' . strtoupper($v) . '"');
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
						
						// Cybium
						$url = preg_replace('/\x{A0}/u', '%C2%A0', $url);
						
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
					
					// Cybium
					$url = preg_replace('/\x{A0}/u', '%C2%A0', $url);
					
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
				
			case 'ZOOBANK':
				$w[] = array($wikidata_properties['ZOOBANK_PUBLICATION'] => '"' . $v . '"');
				break;				
				
			case 'link':
				foreach ($v as $link)
				{
					if ($link->{'content-type'} == 'application/pdf')
					{
						// do we have an archive version?
						if (isset($work->message->WAYBACK))
						{
							$wayback = $work->message->WAYBACK;
							
							if (!preg_match('/^\//', $wayback))
							{
								$wayback = '/' . $wayback;
							}
						
							$qualifier = "\tP1065\t\"https://web.archive.org" . $wayback . '"';
							$w[] = array($wikidata_properties['PDF'] => '"' . $link->URL . '"' . $qualifier);
						}
						else
						{
							$w[] = array($wikidata_properties['PDF'] => '"' . $link->URL . '"');
						}
						
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
					// try to find from name
					$journal_item = wikidata_item_from_journal_name($container, $languages_to_detect[0]);
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
				

/*				
funder: [
{
DOI: "10.13039/501100001659",
name: "Deutsche Forschungsgemeinschaft",
doi-asserted-by: "publisher",
award: [
"PA 1818/3-1",
"HU 1561/1-1, 1-2"
]
},
{
name: "European Union Improving Human Potential program SYNTHESYS",
award: [
"GB-TAF-3410",
"GB-TAF-5177"
]
}
],
*/

			case 'funder':
				foreach ($v as $funder)
				{
					//print_r($funder);
					if (isset($funder->DOI))
					{
						$funder_qid = wikidata_funder_from_doi($funder->DOI);
						if ($funder_qid != '')
						{
							$w[] = array('P859' => $funder_qid);
						}
					}				
				}
				break;
				
			case 'license':
				if (isset($v[0]->URL))
				{
				
					// map to Wikidata
					$license_item = '';
					switch ($v[0]->URL)
					{
						case 'https://creativecommons.org/licenses/by-nd/4.0/':						
							// CC-BY-ND 4.0 
							$license_item = 'Q36795408';
							break;
							
						case 'http://creativecommons.org/licenses/by-nc/3.0/':						
						case 'http://creativecommons.org/licenses/by-nc/3.0/nl/':						
							// CC-BY-NC 
							$license_item = 'Q18810331';					
							break;
							
						case 'http://creativecommons.org/licenses/by-sa/3.0/nl/':
							// CC-BY-SA 
							$license_item = 'Q14946043';												
							break;
					
						default:
							break;
					}
					
					if ($license_item != '')
					{
						$w[] = array('P275' => $license_item);
					}					
					
					
				}
				break;
				
			case 'abstract':
				// Handle multiple languages
				$done = false;
				
				if (isset($work->message->multi))
				{
					if (isset($work->message->multi->_key->abstract))
					{					
						foreach ($work->message->multi->_key->abstract as $language => $text)
						{
							$text = preg_replace('/^(SUMMARY|Abstract|ABSTRACT|INTRODUCTION)/u', '', $text);
							$text = preg_replace('/^<jats:p>/u', '', $text);
							$text = strip_tags($text);
						
				
							
							$sentences = '';
							
							switch ($language)
							{
								case 'zh':
									$sentences = preg_split('/。/u', $text);
									break;							
							
								case 'en':
								default:
									// sentence split (assumes English-style text)
									// see https://stackoverflow.com/a/16377765/9684 for some ideas
									$sentences = preg_split('/(?<=[a-z\)])[.?!](?=\s+[A-Z])/u', $text);
									break;
							}
							
								
							if (count($sentences) != 0)
							{
								$first_line = $sentences[0] . '.';	
								$first_line = preg_replace('/\n/u', ' ', $first_line);
								$first_line = preg_replace('/\s\s+/u', ' ', $first_line);								
								$first_line = nice_shorten($first_line);
				
								$w[] = array($wikidata_properties[$k] => $language . ':' . '"' . addcslashes($first_line, '"') . '"');
							}
						}					
						$done = true;
					}					
				}
			
				if (!$done)
				{			
					// one language only
					$text = $v;
				
					// for now just single language 9to do: multilingual)
				
					// clean
					$text = preg_replace('/^(SUMMARY|Abstract|ABSTRACT|INTRODUCTION)/u', '', $text);
					$text = preg_replace('/^<jats:p>/u', '', $text);
					$text = strip_tags($text);
				
					// sentence split (assumes English-style text)
					// see https://stackoverflow.com/a/16377765/9684 for some ideas
					$sentences = preg_split('/(?<=[a-z\)])[.?!](?=\s+[A-Z])/u', $text);
								
					if (count($sentences) != 0)
					{
						$first_line = $sentences[0] . '.';
						$first_line = preg_replace('/\n/u', ' ', $first_line);
						$first_line = preg_replace('/\s\s+/u', ' ', $first_line);								
						
						$first_line = nice_shorten($first_line);
				
						// Detect language of first_line
						$ld = new Language($languages_to_detect);						
						$language = $ld->detect($first_line)->__toString();
						
						// We don't seem to detect Portguese
						if (in_array('2175-7860', $work->message->ISSN))
						{
							if ($language == 'es')
							{
								$language = 'pt';
							}								
						}
						

						$w[] = array($wikidata_properties[$k] => $language . ':' . '"' . addcslashes($first_line, '"') . '"');
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
		
			$quickstatements .= join("\t", $row);
			
			// labels don't get references 
			if (count($source) > 0 && !preg_match('/^L/', $property))
			{
				$quickstatements .= "\t" . join("\t", $source);
			}
			
			$quickstatements .= "\n";
			
		}
	}
	
	// echo "--------------------------\n";
	
	
	
	return $quickstatements;

	
}

//----------------------------------------------------------------------------------------
// list of items already in Wikidata for a journal
// from ISSN, could use as basis for RIS export for matching, etc.
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
// list of items already in Wikidata for a journal
// from Wikidata Q, could use as basis for RIS export for matching, etc.
function works_for_journal_from_qid($qid)
{
	$works = array();
	$sparql = 'SELECT ?work (group_concat(?author;separator=";") as ?authors) ?title ?volume ?issue ?pages ?doi 
	WHERE { 
	VALUES ?container { wd:' . $qid . '}
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
  VALUES ?firstpage {"^' . $spage . '[^0-9]" } .
  
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
	
	$url = 'https://api.crossref.org/v1/works/' . $doi;
	
	$json = get($url);
	
	if ($json != '')
	{
		$obj = json_decode($json);
	}
	return $obj;
}




//----------------------------------------------------------------------------------------
// Try to locate an item using any identifier or metadata that we have
function wikidata_find_from_anything ($work)
{
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
		$terms = array();
				
		$issn = $volume = $spage = '';
		
		if (isset($work->message->ISSN))
		{
			$terms[] = $work->message->ISSN;
		}		
		
		if (isset($work->message->volume))
		{
			$terms[] = $work->message->volume;
		}

		if (isset($work->message->{'page-first'}))
		{
			$terms[] = $work->message->{'page-first'};
		}
			
		if (count(terms) == 3)
		{
			foreach ($terms[0] as $issn)
			{
				$hit = wikidata_item_from_openurl($issn, $terms[1], $terms[2]);
				if ($hit <> '')
				{
					$item = $hit;
				}
			}
		}

	}	
	
	return $item;	


}

function googlebooks_to_wikidata($isbn, $update = true)
{

	$MAX_LABEL_LENGTH = 250;

	$quickstatements = '';
	
	$source = array();
	
	// Map language codes to Wikidata items
	$language_map = array(
		'da' => 'Q9035',
		'de' => 'Q188',
		'en' => 'Q1860',
		'es' => 'Q1321',
		'fr' => 'Q150',
		'ja' => 'Q5287',
		'nl' => 'Q7411',
		'pt' => 'Q5146',
		'ru' => 'Q7737',
		'th' => 'Q9217',
		'zh' => 'Q7850',		
	);
	

	// Do we have this already in wikidata?
	$item = '';
	
	if ($item == '')
	{
		$item = wikidata_item_from_isbn10($isbn);
	}
	if ($item == '')
	{
		$item = wikidata_item_from_isbn13($isbn);
	}
	
	if ($item != '' && !$update)
	{
		return $quickstatements;
	}
	
	$url = 'https://www.googleapis.com/books/v1/volumes?q=isbn:' . $isbn;
	
	$json = get($url);
	
	$obj = json_decode($json);
	
	//print_r($obj);
	
	if (count($obj->items) == 1)
	{		
						
		if ($item == '')
		{						
			// double check for existence
			foreach($obj->items[0]->volumeInfo->industryIdentifiers as $identifier)
			{
				if ($identifier->type == 'ISBN_10')
				{
					$item = wikidata_item_from_isbn10($identifier->identifier);
				}
				if ($identifier->type == 'ISBN_13')
				{
					$item = wikidata_item_from_isbn13($identifier->identifier);
				}		
			}
		}		
	
		if ($item == '')
		{
			$item = 'LAST';
		}	
		else
		{
			if (!$update)
			{
				return $quickstatements;
			}
		}
		
		$w = array();			
		
		// Type (here be dragons)
		// simple model is to have a "book" item with ISBN
		// Wikidata book project has model where each "book" has a work item and 
		// one or more expressions (which have unique ISBNs).
		
		$w[] = array('P31' => 'Q47461344'); // written work
		
		//$w[] = array('P31' => 'Q3331189');  // version, edition, or translation
		
		
		// Google Books
		$w[] = array('P675' => '"' . $obj->items[0]->id . '"' );
		
		// Google Books is the source
		$source[] = 'S248';
		$source[] = 'Q206033';
		$source[] = 'S854';
		$source[] = '"' . $url . '"';
				
		// ISBNs
		foreach($obj->items[0]->volumeInfo->industryIdentifiers as $identifier)
		{
			if ($identifier->type == 'ISBN_10')
			{
				$w[] = array('P957' => '"' . $identifier->identifier . '"' );
			}
			if ($identifier->type == 'ISBN_13')
			{
				$w[] = array('P212' => '"' . $identifier->identifier . '"' );
			}		
		}
		
		// title
		if (isset($obj->items[0]->volumeInfo->title))
		{
			$title = $obj->items[0]->volumeInfo->title;
		
			// language
			$language == 'en';
			
			if (isset($obj->items[0]->volumeInfo->language))
			{
				$language = $obj->items[0]->volumeInfo->language;
			}
			
			if ($language == 'en')
			{
				// Assume work is English
				$w[] = array('P407' => $language_map[$language]);

				// title
				$w[] = array('P1476' => $language . ':' . '"' . str_replace('"', '""', $title) . '"');

				// label
				$w[] = array('L' . $language => '"' . str_replace('"', '""', nice_shorten($title, $MAX_LABEL_LENGTH)) . '"');
			
			
			}
		
		}
		
		// authors
		if (isset($obj->items[0]->volumeInfo->authors))
		{		
			$count = 1;
			foreach ($obj->items[0]->volumeInfo->authors as $name)
			{
				$qualifier = "\tP1545\t\"$count\"";
				$w[] = array('P2093' => '"' . $name . '"' . $qualifier);	
				
				$count++;		
			}
			
			// Generate a human-friendly description
			$n = count($obj->items[0]->volumeInfo->authors);
			$names = array();
			if ($n > 1)
			{
				$names = array_slice($obj->items[0]->volumeInfo->authors, 0, $n - 1);
			}
			$description = "Book by " . join(", ", $names) . " and " . $obj->items[0]->volumeInfo->authors[$n - 1];
			
			$w[] = array('Den' => '"' . $description . '"');	
			
		}
		
		
		// pages
		if (isset($obj->items[0]->volumeInfo->pageCount))
		{
			$w[] = array('P304' => '"' . $obj->items[0]->volumeInfo->pageCount . '"' );
		}

		// date
		if (isset($obj->items[0]->volumeInfo->publishedDate))
		{
			$year = $obj->items[0]->volumeInfo->publishedDate;
			
			// assume year
			$date = "+$year-00-00T00:00:00Z/9";
		
			$w[] = array('P577' => $date);
		}
		
		
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
		
				$quickstatements .= join("\t", $row);
			
				// labels don't get references 
				if (count($source) > 0 && !preg_match('/^[D|L]/', $property))
				{
					$quickstatements .= "\t" . join("\t", $source);
				}
			
				$quickstatements .= "\n";
			
			}
		}
		
	
	
	}


	return $quickstatements;	

}

if (0)
{
	// Bats of the Indian Subcontinent
	$quickstatements = googlebooks_to_wikidata('0951731319');

	echo $quickstatements . "\n";
}



?>
